<?php

class AssignAgentPDS extends EUI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->load->model(array("M_AssignAgentPDS","M_Utility","M_SetUpload","M_ModOutBoundGoal","M_SetProduct"));
		$this->load->helper(array('EUI_Object'));
	}
	
	function index(){
		// echo "agent pds";
		if( $this -> EUI_Session -> _have_get_session('UserId')){
			$EUI['page'] = $this -> M_AssignAgentPDS -> _get_default();
			$this -> load -> view('set_agent_pds/view_campaign_nav', $EUI );
		}
	}
	
	function Content(){
		if( $this -> EUI_Session -> _have_get_session('UserId')){
			$EUI['page'] = $this->{base_class_model($this)}->_get_resource_query(); // load content data by pages 
			$EUI['num']  = $this->{base_class_model($this)}->_get_page_number(); 	// load content data by pages 

			$this -> load -> view('set_agent_pds/view_campaign_list', $EUI );
		}
	}
	
	public function assignAgent2PDS(){
		if(!_have_get_session('UserId')) {
			return false;	
		}
		
		// if(_get_session('HandlingType')!= 3) {
			// return false;
		// }

		$vars =new EUI_Object( _get_all_request() );
		if( !$vars->fetch_ready() ){ return false; }

		$objRes =& get_class_instance('M_AssignAgentPDS');

		// $CampaignList   = $objRes->getAttribute( $vars->get_value('GroupId') );
		$assignedSPV	= $objRes->_getAssignedSpv($vars->get_value('GroupId'));
		$dataCampaignPds = $objRes->_getDataGroupPds( $vars );
		$GroupList		 = $objRes->_getGroupCampaignPds($vars->get_value('GroupId'), $assignedSPV );
		$CallPreList    = $objRes->_getAssignedGroupCampaignPds( $vars->get_value('GroupId'), $assignedSPV );

		// $objPro =& get_class_instance('M_SetProduct');
		// $ProductList = $objPro->_getProductCampaignId($vars->get_value('CampaignId'));
		// $PayTypeList = $objPro->_getCampaignChannel($vars->get_value('CampaignId'));

		$this->load->view('set_agent_pds/view_assign_agent_pds', array(
			'row' 		  		 => new EUI_Object($dataCampaignPds),
			'GroupList'   		 => $GroupList,
			'CallPreList' 		 => $CallPreList
		));
	}
	
	public function Assign2Group(){
		$cond = array('success'=> 0, 'error'=> ''); 
		if( !_have_get_session('UserId') ) { 
			return false;	
		}
		
		$obj =& get_class_instance('M_AssignAgentPDS');
		$out =new EUI_Object( _get_all_request() );
		// var_dump( $out ); die();
		// if( $obj->_assign2group( $out ) ) {
			// $cond = array('success'=> 1 ); 	
		// }
		if( $obj->_assign2grouprev( $out ) ) {
			$cond = array('success'=> 1 ); 	
		}
		
		echo json_encode($cond);
	}
	
}

?>