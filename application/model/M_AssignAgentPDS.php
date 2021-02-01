<?php


class M_AssignAgentPDS extends EUI_Model{
	
	private static $Instance = null;
	
	public static function &Instance(){
		if( is_null(self::$Instance)){
			self::$Instance = new self();
		}	
		return self::$Instance;
	}

	function __construct(){
		$this -> load->model('M_SysUser');
	}
	
	function _get_default(){
		$out  = new EUI_Object(_get_all_request());
		
		$this->EUI_Page->_setPage(10); 
		$this->EUI_Page->_setSelect("a.id");
		$this->EUI_Page->_setFrom("cc_agent_group a ");
		$this->EUI_Page->_setJoin("t_gn_campaign_assignment c "," a.id=c.GroupLeaderId","LEFT");
		$this->EUI_Page->_setJoin("t_gn_campaign_pds d "," c.CampaignId=d.CampaignId","LEFT");
		$this->EUI_Page->_setJoin("t_gn_spv_assignment_pds e "," d.CampaignId=e.CampaignId","LEFT", true);
		
		if(_get_session("HandlingType")!=1){
			$this->EUI_Page->_setAnd('e.GroupLeaderId', _get_session("UserId"));
		}else{
			$this->EUI_Page->_setAnd('d.CreatedById', _get_session("UserId"));
		}
		
		$this->EUI_Page->_setAnd('a.Id>1');
		
		$this->EUI_Page->_setGroupBy('a.id,a.description');
		return $this->EUI_Page;
	}
	
	function _get_content(){
		$out  = new EUI_Object(_get_all_request());

		$this->EUI_Page->_postPage(_get_post('v_page'));
		$this->EUI_Page->_setPage(10);
		$this->EUI_Page->_setArraySelect(array(
			"a.id As GroupId"														=> array("GroupId", "GroupId","primary"),
			"a.description As GroupCode"											=> array("GroupCode","Group Name"),
			"max(d.CampaignName) As CampaignName"									=> array("CampaignName", "Campaign Name"),
			"(SELECT COUNT(ass.UserId) FROM tms_agent ass WHERE ass.user_state = 1
				AND ass.handling_type = 4 ".
				(_get_session('HandlingType')==1?" AND ass.admin_id = "._get_session('UserId')." AND ass.spv_id in (SELECT azz.GroupLeaderId FROM t_gn_spv_assignment_pds AS azz WHERE azz.CampaignId = d.CampaignId) ": " AND ass.spv_id = "._get_session('UserId'))."
				AND ass.group_id = a.Id) as totalAssignedAgent"						=> array("totalAssignedAgent", "Total Assigned Agent")
		));

		$this->EUI_Page->_setFrom("cc_agent_group a");
		// $this->EUI_Page->_setJoin("t_gn_campaign_assignment c "," a.id=c.GroupLeaderId","LEFT");
		$this->EUI_Page->_setJoin("t_gn_campaign_pds d "," a.id=d.CcGroup","LEFT");
		$this->EUI_Page->_setJoin("t_gn_spv_assignment_pds e "," d.CampaignId=e.CampaignId","LEFT", true);
		
		if(_get_session("HandlingType")!=1){
			$this->EUI_Page->_setAnd('e.GroupLeaderId', _get_session("UserId"));
		}else{
			$this->EUI_Page->_setAnd('d.CreatedById', _get_session("UserId"));
		}
		
		$this->EUI_Page->_setAnd('a.Id>1');
		$this->EUI_Page->_setGroupBy('a.id,a.description,d.CampaignId');

		if( !_get_have_post('order_by')){
			$this->EUI_Page->_setOrderBy('a.id','ASC');
		} else {
			$this->EUI_Page->_setOrderBy(_get_post('order_by'), _get_post('type'));
		}	
		// echo $this->EUI_Page->_getCompiler();

		$this->EUI_Page->_setLimit();
	}
	
	function _get_resource_query(){
		$res = false;
		self::_get_content();
		if( $this -> EUI_Page -> _get_query()!=''){
			$res = $this -> EUI_Page -> _result();
			if($res) return $res;
		}
	}
	
	function _get_page_number(){
		if( $this -> EUI_Page -> _get_query()!='' ){
			return $this -> EUI_Page -> _getNo();
		}
	}
	
	function _getDataGroupPds($out){
		$result = array();
		
		$this->db->reset_select();
		$this->db->select("a.id as GroupId, a.description as GroupCode, max(d.CampaignName) as CampaignName");
		$this->db->from("cc_agent_group a");
		$this->db->join("t_gn_campaign_assignment c "," a.id=c.GroupLeaderId","LEFT");
		$this->db->join("t_gn_campaign_pds d "," c.CampaignId=d.CampaignId","LEFT");
		$this->db->where('a.Id', $out->get_value('GroupId'));
		$this->db->group_by("a.id, a.description");
		
		foreach( $this->db->get()->result_assoc() as $rows ){
			$result['GroupId']		= $rows['GroupId'];
			$result['GroupCode']	= $rows['GroupCode'];
			$result['CampaignName']	= $rows['CampaignName'];
		}
		
		return $result;
	}
	
	function _getAssignedSpv(){
		$result = array();
		$out =new EUI_Object( _get_all_request() );
		
		$this->db->reset_select();
		$this->db->select('a.GroupLeaderId as SPVId, b.CcGroup');
		$this->db->from('t_gn_spv_assignment_pds a');
		$this->db->join('t_gn_campaign_pds b','a.CampaignId = b.CampaignId','LEFT');
		$this->db->where('b.CcGroup', $out->get_value('GroupId'));
		$this->db->group_by('a.GroupLeaderId, b.CcGroup');
		
		$res = $this->db->get();
		// var_dump( $this->db->last_query() ); die();
		if( $res->num_rows() > 0 ) {
			foreach ($res->result_array() as $rows) {
				$result[$rows['SPVId']] = $rows['SPVId'];
			}
		}
		return $result;
	}
	
	function _getGroupCampaignPds($out, $SPVId){
		$result = array();
		
		// $spv_id = implode(",",$SPVId);
		$this->db->reset_select();
		$this->db->select('c.UserId, c.Id, c.full_name');
		$this->db->from('tms_agent c');
		$this->db->where('c.handling_type', 4);
		$this->db->where('c.user_state', 1);
		if(_get_session("HandlingType")==3){
			$this->db->where('c.spv_id', _get_session("UserId"));
		}
		if(_get_session("HandlingType")==1){
			$this->db->where('c.admin_id', _get_session("UserId"));
			$this->db->where_in('c.spv_id', $SPVId);
		}
		$this->db->where_in('c.group_id', array(0,1,$out));
		$res = $this->db->get();
		// var_dump( $this->db->last_query() ); die();
		if( $res->num_rows() > 0 ) {
			foreach ($res->result_array() as $rows) {
				$result[$rows['UserId']] = $rows['Id']." - ". $rows['full_name'];
			}
		}
		return $result;
	}
	
	function _getAssignedGroupCampaignPds($out, $SPVId){
		$result = array();

		$this->db->reset_select();
		$this->db->select('c.UserId, c.Id, c.full_name');
		$this->db->from('tms_agent c');
		$this->db->where('c.handling_type', 4);
		$this->db->where('c.user_state', 1);
		$this->db->where('c.group_id', $out);
		if(_get_session("HandlingType")==3){
			$this->db->where('c.spv_id', _get_session("UserId"));
		}
		if(_get_session("HandlingType")==1){
			$this->db->where('c.admin_id', _get_session("UserId"));
			$this->db->where_in('c.spv_id', $SPVId);
		}
		$res = $this->db->get();
		// var_dump( $this->db->last_query() ); die();
		if( $res->num_rows() > 0 ) {
			foreach ($res->result_array() as $rows) {
				$result[$rows['UserId']] = $rows['Id']." - ". $rows['full_name'];
			}
		}
		return $result;
	}
	
	private function _getAgentToassign($agents=null, $group_id=null){
		if(is_null($group_id)){return false;}
		
		$spv_id = $this->_getAssignedSpv($group_id);
		
		if($agents){
			$this->db->reset_select();
			$this->db->select('c.UserId, c.Id, c.full_name');
			$this->db->from('tms_agent c');
			$this->db->where('c.handling_type', 4);
			$this->db->where('c.user_state', 1);
			$this->db->where('c.group_id', $group_id);
			$this->db->where('UserId in ('.$agents.')');
			if(_get_session('HandlingType')==3){
				$this->db->where('c.spv_id', _get_session("UserId"));
			}else{
				$this->db->where_in('c.spv_id', $spv_id);
				$this->db->where('c.admin_id', _get_session("UserId"));
			}
			$res = $this->db->get();
			// var_dump( $this->db->last_query() ); die();
			if( $res->num_rows() > 0 ) {
				foreach ($res->result_array() as $rows) {
					$result[$rows['UserId']]['UserId']	= $rows['UserId'];
					$result[$rows['UserId']]['Id']		= $rows['Id'];
				}
				return $result;
			}
		}else{
			return false;
		}
	}
	
	private function _update_agent_group($aruser=null, $agent_group=null){
		if(is_array($aruser)){
			$this->db->reset_write();
			$this->db->set("group_id",	$agent_group);
			$this->db->where("UserId", $aruser['UserId']);
			if( $this->db->update("tms_agent") ){
				$this->db->reset_write();
				$this->db->set("agent_group", $agent_group);
				$this->db->where("userid", $aruser['Id']);
				if( $this->db->update("cc_agent") ){
					return true;
				}
			}
		}
		
		return false;
	}
	
	public function _assign2grouprev($out = null){
		if( is_null( $out) ) {  return false;  }
		if( !$out->fetch_ready() ){ return false; }
		// echo "assign on dev";
		$groupid	= $out->get_value('GroupId');
		$unassignagt= $out->get_value('CampaignCallPrefarance');
		$assignagt	= $out->get_value('ListCampaignCallPrefarance');
		$ccasagt 	= $this->_getAgentToassign($assignagt, 1);
		$ccunagt 	= $this->_getAgentToassign($unassignagt, $groupid);
		// print_r($ccasagt); exit();
		if(is_array($ccasagt)){
			foreach($ccasagt as $UserId => $Agent){
				if($this->_update_agent_group($Agent, $groupid)){
					$assign = true;
				}else{
					$assign = false;
				}
			}
		}
		
		if(is_array($ccunagt)){
			foreach($ccunagt as $UserId => $Agent){
				if($this->_update_agent_group($Agent, 1)){
					$unassign = true;
				}else{
					$unassign = false;
				}
			}
		}
		
		if($assign OR $unassign){
			return true;
		}else{
			return false;
		}
	}
	
	public function _assign2group( $out  = null ){
		if( is_null( $out) ) {  return false;  }
		if( !$out->fetch_ready() ){ return false; }
		
		$result = 0;
		$this->db->reset_write();
		$this->db->set("group_id",		$out->get_value('GroupId'));
		$this->db->where('UserId in ('.$out->get_value('ListCampaignCallPrefarance').')');
		if( $this->db->update("tms_agent") ){
			// $setGroup = true;
			$result++;
			// var_dump( $this->db->last_query() ); die();
			$this->db->reset_select();
			$this->db->select('c.UserId, c.Id, c.full_name');
			$this->db->from('tms_agent c');
			$this->db->where('c.handling_type', 4);
			$this->db->where('c.user_state', 1);
			$this->db->where('c.group_id', $out->get_value('GroupId'));
			$this->db->where('UserId in ('.$out->get_value('CampaignCallPrefarance').')');
			$this->db->where('c.spv_id', _get_session("UserId"));
			$res = $this->db->get();
			// var_dump( $this->db->last_query() ); die();
			if( $res->num_rows() > 0 ) {
				foreach ($res->result_array() as $rows) {
					$agent[$rows['UserId']] = $rows['Id']." - ". $rows['full_name'];
				}
			}
			
			foreach($agent as $UserId => $agent){
				$this->db->reset_write();
				$this->db->set("group_id",		1);
				$this->db->where('UserId', $UserId);
				if( $this->db->update("tms_agent") ){
					$result++;
				}
				// var_dump( $this->db->last_query() ); die();
				// if($setGroup || $unsetGroup){
					// $result = true;
				// }else{
					// $result = false;
				// }
			}
		}else{
			$this->db->reset_select();
			$this->db->select('c.UserId, c.Id, c.full_name');
			$this->db->from('tms_agent c');
			$this->db->where('c.handling_type', 4);
			$this->db->where('c.user_state', 1);
			$this->db->where('c.group_id', $out->get_value('GroupId'));
			$this->db->where('UserId in ('.$out->get_value('CampaignCallPrefarance').')');
			$this->db->where('c.spv_id', _get_session("UserId"));
			$res = $this->db->get();
			// var_dump( $this->db->last_query() ); die();
			if( $res->num_rows() > 0 ) {
				foreach ($res->result_array() as $rows) {
					$agent[$rows['UserId']] = $rows['Id']." - ". $rows['full_name'];
				}
			}
			
			foreach($agent as $UserId => $agent){
				$this->db->reset_write();
				$this->db->set("group_id",		1);
				$this->db->where('UserId', $UserId);
				if( $this->db->update("tms_agent") ){
					$result++;
				}
				// var_dump( $this->db->last_query() ); die();
				// if($setGroup || $unsetGroup){
					// $result = true;
				// }else{
					// $result = false;
				// }
			}
		}
		
		
		return $result;
	}
	
	


}

?>