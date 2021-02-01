<?php 
class M_Dashboard extends EUI_Model
{
  
  private $limit = "";
  private static $Instance = null;
  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  public static function &Instance()
 {
	if( is_null( self::$Instance ) ) 
	{
		self::$Instance = new self();
	}
	return self::$Instance;
 }
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public  function __construct(){ 
 
 }
  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  protected function _select_row_tree_join( $data = '' ) 
{
	if( !is_array($data) ){  
		return $data;
	}
	
	return join("-", $data); 
 } 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
  protected function _select_row_total_atempt( $UserId = 0, $cond = 'MGR')
{
 $total_data = 0;
 $InoDB = "";
 
 $sql = "SELECT COUNT(a.CallHistoryId) as tot, date(a.CallHistoryCallDate) as tgl
		FROM t_gn_callhistory a {$InoDB} 
		left join t_gn_customer c on a.CustomerId=c.CustomerId
		WHERE 1=1 ";
			
 if( $cond == 'MGR' ){ 
	$sql = "SELECT COUNT(a.CallHistoryId) as tot, date(a.CallHistoryCallDate) as tgl
			FROM t_gn_callhistory a {$InoDB} 
			LEFT JOIN tms_agent b on a.AMGRCode=b.id
			LEFT JOIN t_gn_customer c on a.CustomerId=c.CustomerId
			WHERE 1=1 ";
	
 }
 
 if( $cond == 'ATM' ){ 
	$sql = "SELECT COUNT(a.CallHistoryId) as tot, date(a.CallHistoryCallDate) as tgl
			FROM t_gn_callhistory a  {$InoDB} 
			LEFT JOIN tms_agent b on a.ATMCode=b.id
			LEFT JOIN t_gn_customer c on a.CustomerId=c.CustomerId
			WHERE 1=1 ";

 }
	
 if( $cond == 'SPV' ){
	$sql = "SELECT COUNT(a.CallHistoryId) as tot, date(a.CallHistoryCallDate) as tgl
			FROM t_gn_callhistory a {$InoDB} 
			LEFT JOIN tms_agent b on a.SPVCode=b.id
			LEFT JOIN t_gn_customer c on a.CustomerId=c.CustomerId
			WHERE 1=1 ";
 }
	
 if( $cond == 'AGENT' ){
	$sql = "SELECT COUNT(a.CallHistoryId) as tot, date(a.CallHistoryCallDate) as tgl
			FROM t_gn_callhistory a {$InoDB} 
			LEFT JOIN tms_agent b on a.AgentCode=b.id
			LEFT JOIN t_gn_customer c on a.CustomerId=c.CustomerId
			WHERE 1=1 ";
 }
 
 
// -------------- set filter --------------------
 $sql .=" AND b.UserId={$UserId} AND a.HistoryType = 0 ";
 $out = new EUI_Object( _get_all_request() );
 
 if( _get_have_post('dsb_start_date') 
	AND  _get_have_post('dsb_end_date') ) 
 {
	$sql.=" AND a.CallHistoryCallDate>='". $out->get_value('dsb_start_date', 'StartDate') ."'
			AND a.CallHistoryCallDate<='". $out->get_value('dsb_end_date', 'EndDate') ."'";
 }
 
 // -------------- set filter --------------------
 
 if(_get_have_post('dsb_campaign') 
	AND count( $out->get_array_value('dsb_campaign') ) >0  )
 {
	$CampaignId = implode(",", $out->get_array_value('dsb_campaign'));  
	$sql .= " AND c.CampaignId IN($CampaignId) ";
 }
 
 $sql.=" GROUP BY tgl";
 // ------------ execute --------------------------------
 
$rs = $this->db->query($sql);
 if( $rs->num_rows() > 0 ) 
	 foreach( $rs->result_assoc() as $row )
 {
	$total_data+= $row['tot'];
 }	
 
 return (int)$total_data;
 
 }
 
  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  protected function _select_row_total_solicited( $UserId = 0, $cond = 'MGR')
{
  $total_data = 0;
  $InoDB = "";
  
 $sql = "SELECT COUNT(a.CustomerId) as tot 
			FROM t_gn_callhistory a {$InoDB}
			LEFT JOIN t_gn_customer c on a.CustomerId=c.CustomerId
			WHERE 1=1 ";
			
 if( $cond == 'MGR' ){ 
	$sql = "SELECT COUNT(a.CustomerId) as tot 
			FROM t_gn_callhistory a {$InoDB}
			LEFT JOIN tms_agent b on a.AMGRCode=b.id
			LEFT JOIN t_gn_customer c on a.CustomerId=c.CustomerId
			WHERE 1=1 ";
	
 }
 
 if( $cond == 'ATM' ){ 
	$sql = "SELECT COUNT(a.CustomerId) as tot 
			FROM t_gn_callhistory a {$InoDB}
			LEFT JOIN tms_agent b on a.ATMCode=b.id
			LEFT JOIN t_gn_customer c on a.CustomerId=c.CustomerId
			WHERE 1=1 ";

 }
	
 if( $cond == 'SPV' ){
	$sql = "SELECT COUNT(a.CustomerId) as tot 
			FROM t_gn_callhistory a {$InoDB}
			LEFT JOIN tms_agent b on a.SPVCode=b.id
			LEFT JOIN t_gn_customer c on a.CustomerId=c.CustomerId
			WHERE 1=1 ";
 }
	
 if( $cond == 'AGENT' ){
	$sql = "SELECT COUNT(a.CustomerId) as tot 
			FROM t_gn_callhistory a {$InoDB}
			LEFT JOIN tms_agent b on a.AgentCode=b.id
			LEFT JOIN t_gn_customer c on a.CustomerId=c.CustomerId
			WHERE 1=1 ";
 }
 
 $sql.=" AND b.UserId={$UserId} AND a.HistoryType = 0 ";
   
// -------------- set filter --------------------
 $out = new EUI_Object( _get_all_request() );
 
 if( _get_have_post('dsb_start_date') 
	AND  _get_have_post('dsb_end_date') ) 
 {
	$sql.=" AND a.CallHistoryCreatedTs>='". $out->get_value('dsb_start_date', 'StartDate') ."'
			AND a.CallHistoryCreatedTs<='". $out->get_value('dsb_end_date', 'EndDate') ."'";
 }
 
// -------------- filter Campaign ---------------------------------
 
 if(_get_have_post('dsb_campaign') 
	AND count( $out->get_array_value('dsb_campaign') ) >0  )
 {
	$CampaignId = implode(",", $out->get_array_value('dsb_campaign'));  
	$sql .= " AND c.CampaignId IN($CampaignId) ";
 }
 
 $sql .=" GROUP BY a.CustomerId"; 
 
 $rs = $this->db->query($sql);
 if( $rs->num_rows() > 0 ) 
	 foreach( $rs->result_assoc() as $row )
 {
	$total_data+= $row['tot'];
 }	
 
 return (int)$total_data;
 
 }
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  protected function _select_row_total_policy( $AssignAmgr = 0, $AssignSpv = 0, $AssignLeader = 0, $AssignSellerId = 0  )
{
 
 $arr_total_data = array( 'interest' => 0, 'premi' => 0 );
 $InoDB = " USE INDEX(CustomerId,PolicyNumber) ";
 
 $sql = "SELECT COUNT(distinct(a.CustomerId)) AS interest,( 
			SELECT SUM(ROUND(pc.PolicyPremi)) AS Premi 
			FROM t_gn_policy pc 
			WHERE pc.PolicyNumber=a.PolicyNumber 
		) AS premi, ( 
			SELECT pc.PolicySalesDate AS Premi 
			FROM t_gn_policy pc 
			WHERE pc.PolicyNumber=a.PolicyNumber 
		) AS PolicySalesDate
		
		FROM t_gn_policyautogen a {$InoDB}
		INNER JOIN t_gn_assignment b ON a.CustomerId=b.CustomerId  
		LEFT JOIN t_gn_customer c on a.CustomerId=c.CustomerId
		WHERE TRUE ";
		 
	
// -------------------------------------------------------------------	
 if( !empty($AssignAmgr) AND $AssignAmgr ){ 
	$sql.= " AND b.AssignAmgr={$AssignAmgr}";
 }

// -------------------------------------------------------------------
 
 if( !empty($AssignSpv) AND $AssignSpv ){ 
	$sql.= " AND b.AssignSpv={$AssignSpv}";
 }

// -------------------------------------------------------------------
 
 if( !empty($AssignLeader) AND $AssignLeader ){ 
	$sql .= " AND b.AssignLeader={$AssignLeader}";
 }

// ------------------------------------------------------------------- 

 if( !empty($AssignSellerId) AND $AssignSellerId ){ 
	$sql.= " AND b.AssignSelerId={$AssignSellerId}";
 }
  
// -------------- filter Campaign ---------------------------------
 
 $out = new EUI_Object( _get_all_request() );
 
 if(_get_have_post('dsb_campaign') 
	AND count( $out->get_array_value('dsb_campaign') ) >0  )
 {
	$CampaignId = implode(",", $out->get_array_value('dsb_campaign'));  
	$sql .= " AND c.CampaignId IN($CampaignId) ";
 }
 
 
// -------------- group by ----------------------------------------
 
  $sql.=" GROUP BY a.PolicyNumber ";
  
// ------------------------ set filter -------------------------------
 
 if( _get_have_post('dsb_start_date') 
	AND  _get_have_post('dsb_end_date') ) 
 {
	$sql.=" HAVING PolicySalesDate>='". $out->get_value('dsb_start_date', 'StartDate') ."'
			AND PolicySalesDate<='". $out->get_value('dsb_end_date', 'EndDate') ."'";
 }
 

// -------------- execute --------------------------------------------------

  $rs = $this->db->query($sql);
  if( $rs->num_rows() > 0 ) 
	foreach( $rs->result_assoc() as $row )
 {
	$arr_total_data['interest']+= $row['interest'];
	$arr_total_data['premi']+= $row['premi'];
 }	
 
 return new EUI_Object( $arr_total_data );
 
 }
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  protected function _select_row_total_data( $AssignAmgr = 0, $AssignSpv = 0, $AssignLeader = 0, $AssignSellerId = 0  )
{
 
 $total_data = 0;
 $InoDB = " FORCE INDEX(PRIMARY)  ";
 $sql = "SELECT COUNT(a.AssignId) as tot 
			FROM t_gn_assignment a {$InoDB}
			LEFT JOIN t_gn_customer b on a.CustomerId=b.CustomerId
		 WHERE TRUE ";
		 
// ----------------------------------------------------------------------		 
 if( !empty($AssignAmgr) AND $AssignAmgr ){ 
	$sql.= " AND a.AssignAmgr={$AssignAmgr}";
 }
 
// ----------------------------------------------------------------------		 
 if( !empty($AssignSpv) AND $AssignSpv ){ 
    $sql.= " AND a.AssignSpv={$AssignSpv}";
 }
 
// ----------------------------------------------------------------------		 	
 if( !empty($AssignAmgr) AND $AssignLeader ){ 
	$sql .= " AND a.AssignLeader={$AssignLeader}";
 }

// ----------------------------------------------------------------------		 
 if( !empty($AssignSellerId)  AND $AssignSellerId ){ 
	$sql.= " AND a.AssignSelerId={$AssignSellerId}";
 }
 
// ---------------- filter by data -------------------------------------
  
 $out = new EUI_Object( _get_all_request() );
 if( _get_have_post('dsb_start_date') 
	AND  _get_have_post('dsb_end_date') ) 
 {
	$sql.=" AND a.AssignDate>='". $out->get_value('dsb_start_date', 'StartDate') ."'
			AND a.AssignDate<='". $out->get_value('dsb_end_date', 'EndDate') ."'";
 }
 
 // -------------- filter Campaign ---------------------------------
 
 if(_get_have_post('dsb_campaign') 
	AND count( $out->get_array_value('dsb_campaign') ) >0  )
 {
	$CampaignId = implode(",", $out->get_array_value('dsb_campaign'));  
	$sql .= " AND b.CampaignId IN( $CampaignId ) ";
 }
 
 
// ---------------- execute data -----------------------------------

 $rs = $this->db->query($sql);
 if( $rs->num_rows() > 0 ) {
	$total_data = $rs->result_singgle_value();
 }	
 return (int)$total_data;
 
 }
 
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 
 protected function _select_row_dasboard_mgr_by_mgr( $MangerId  = 0)
{
	$arr_total_data = array();
	$this->arr_mgr = array();
	
	$sql = "SELECT 
				a.UserId, a.id, a.init_name,  
				b.id as user_level, a.full_name, a.act_mgr
			FROM tms_agent a 
			INNER JOIN tms_agent_profile b ON a.handling_type=b.id
			WHERE b.id=". USER_ACCOUNT_MANAGER ." 
			AND a.act_mgr={$MangerId} AND a.user_state =1 
			ORDER BY a.id ASC ";
			
	$res = $this->db->query($sql);
	$leave1 = 1;
	
	if( $res->num_rows() > 0 ) 
		 foreach( $res->result_assoc() as $rows )
	{
		$out = new EUI_Object($rows);
		$outs = $this->_select_row_total_policy( $out->get_value('act_mgr'),0,0,0);
		
	// ------------------------------------------------------------------------------------
		
		$arr_total_data   = array(
			"dbsData" 		=> $this->_select_row_total_data( $out->get_value('act_mgr'), 0, 0, 0 ),
			"dbsSolicited"	=> $this->_select_row_total_solicited( $out->get_value('UserId'), 'MGR'),
			"dbsAtempt"		=> $this->_select_row_total_atempt( $out->get_value('UserId'), 'MGR'),
			"dbsInteres"	=> $outs->get_value('interest'),
			"dbsPremi"		=> $outs->get_value('premi')
		);
	// ---------------- total data --------------------------------------	
		
		$this->arr_mgr[$leave1] = array(
			'data-tt-level' 	=> $rows['user_level'],
			'data-tt-id' 		=> $leave1,
			'data-tt-parent-id' => $leave1,
			'data-tt-name' 		=> $rows['full_name'],
			'data-tt-init' 		=> $rows['init_name'],
			'data-tt-user' 		=> $rows['UserId'],
			'data-tt-total' 	=> $arr_total_data,
		    'data-tt-child' 	=> $this->_select_row_dasboard_atm_by_mgr( $out->get_value('UserId'), $leave1 )
		);	
		
		$leave1++;
	 }
	 
	 return $this->arr_mgr;
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 protected function _select_row_atm_filter_by_tl()
{
	$arr_atm_filter = array();
	
	$vars = new EUI_Object(_get_all_request() );
	if( _get_have_post('dsb_supervisor') 
		AND count($vars->get_array_value('dsb_supervisor')) > 0 )
	{
		$this->db->reset_select();
		$this->db->select("distinct(a.spv_id) as AtmId",FALSE);
		$this->db->from("tms_agent a ");
		$this->db->where_in("a.UserId", $vars->get_array_value('dsb_supervisor'));
		$rs = $this->db->get();
		if( $rs->num_rows() > 0 ) 
			foreach( $rs->result_assoc() as $row )
		{
			$arr_atm_filter[$row['AtmId']] = $row['AtmId'];
		}
		return $arr_atm_filter;
    }
	
	return false;
}
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 protected function _select_row_dasboard_atm_by_mgr( $Mgr = 0, $leave1 = 0 )
{
	$this->arr_atm = array();
	$this->arr_spv = $this->_select_row_atm_filter_by_tl();
	
	 $sql = "select a.UserId, a.id, a.init_name,  b.id as user_level, a.full_name, a.spv_id
			from tms_agent a inner join tms_agent_profile b on a.handling_type=b.id
			where b.id=3 and a.act_mgr ='$Mgr' and a.user_state =1 ";
// ----------------------------------------------------------------------------------
			
	 if( is_array($this->arr_spv) 
		AND count($this->arr_spv) > 0 )
	{
		$sql.= " AND a.spv_id IN(". join(',', $this->arr_spv) .") ";
	}	
	
// --------------------------------------------------------	
	$sql .=" ORDER BY a.id ASC {$this->limit}";
// --------------------------------------------------------		
	$res = $this->db->query($sql);
	$leave2 = 1;
	 if( $res->num_rows() > 0 ) 
		 foreach( $res->result_assoc() as $rows )
	{
		$outs = $this->_select_row_total_policy($Mgr, $rows['UserId'], 0,0);
		
	// ------------------------------------------------------------------------------------
	
		$arr_total_data   = array(
			"dbsData" 		=> $this->_select_row_total_data( $Mgr, $rows['UserId'], 0, 0 ),
			"dbsSolicited"	=> $this->_select_row_total_solicited( $rows['UserId'], 'ATM'),
			"dbsAtempt"		=> $this->_select_row_total_atempt( $rows['UserId'], 'ATM'),
			"dbsInteres"	=> $outs->get_value('interest'),
			"dbsPremi"		=> $outs->get_value('premi')
		);
	// ---------------- total data --------------------------------------	
		
		$this->arr_atm[$leave2] = array(
			'data-tt-level' 	=> $rows['user_level'],
			'data-tt-id' 		=> $this->_select_row_tree_join(array($leave1,$leave2)),
			'data-tt-parent-id' => $this->_select_row_tree_join(array($leave1)),
			'data-tt-name' 		=> $rows['full_name'],
			'data-tt-init' 		=> $rows['init_name'],
			'data-tt-user' 		=> $rows['UserId'],
			'data-tt-total' 	=> $arr_total_data,
		    'data-tt-child' 	=> $this->_select_row_dasboard_tl_by_mgr( $rows['spv_id'], $leave1, $leave2 )
		);	
		$leave2++;
	 }
	 
	 return $this->arr_atm;
 }
 
 
 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 protected function _select_row_dasboard_tl_by_mgr( $Atm = 0, $leave1=0, $leave2=0 )
{
	$this->arr_tl = array();
	
	 $sql = "SELECT 
				a.UserId, a.id,a.init_name,  b.id as user_level,  
				a.full_name, a.act_mgr, a.spv_id,a.tl_id 
			FROM tms_agent a 
			INNER JOIN tms_agent_profile b ON a.handling_type=b.id
			WHERE b.id=13 
				AND a.spv_id = '$Atm' 
				AND a.user_state =1 ";
	
	// -------------- filter on here -------------------------------
	
	$vars = new EUI_Object(_get_all_request() );
	if( _get_have_post('dsb_supervisor') 
		AND count( $vars->get_array_value('dsb_supervisor') ) > 0 ) {
		$UserId = join(",", $vars->get_array_value('dsb_supervisor'));
		$sql .= " AND a.UserId IN($UserId) ";
	}
	
	$sql .= " ORDER BY a.id ASC ";
	
	// -------------- filter on here -------------------------------
	$res = $this->db->query($sql);
	
	$leave3 = 1; 
	if( $res->num_rows() > 0 ) 
		 foreach( $res->result_assoc() as $rows )
	{
	
		$outs = $this->_select_row_total_policy($rows['act_mgr'], $rows['spv_id'], $rows['tl_id'], 0 );
    // ---------------------------------------------------	
	
		$arr_total_data   = array(
			"dbsData" 		=> $this->_select_row_total_data( $rows['act_mgr'], $rows['spv_id'], $rows['tl_id'], 0 ),
			"dbsSolicited"	=> $this->_select_row_total_solicited( $rows['UserId'], 'SPV'),
			"dbsAtempt"		=> $this->_select_row_total_atempt( $rows['UserId'], 'SPV'),
			"dbsInteres"	=> $outs->get_value('interest'),
			"dbsPremi"		=> $outs->get_value('premi')
		);
	// ---------------------------------------------------
	
		$this->arr_tl[$leave3]= array(
			'data-tt-id' 		=> $this->_select_row_tree_join(array($leave1, $leave2, $leave3)), 
			'data-tt-parent-id' => $this->_select_row_tree_join(array($leave1, $leave2)), 
			'data-tt-level'   	=> $rows['user_level'],
			'data-tt-name' 	    => $rows['full_name'],
			'data-tt-init' 	    => $rows['init_name'],
			'data-tt-user' 	    => $rows['UserId'],
			'data-tt-total' 	=> $arr_total_data,
			'data-tt-child'     => $this->_select_row_dasboard_agent_by_mgr( $rows['tl_id'], $leave1, $leave2, $leave3) 
		);	
		$leave3++;
	 }
	 
	 return $this->arr_tl;
 }
 
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 protected function _select_row_dasboard_atm_by_atm( $Atm = 0 )
{
	$this->arr_atm = array();
	
	 $sql = "select a.UserId, a.id,a.init_name,  b.id as user_level, a.full_name, a.act_mgr, a.spv_id 
			from tms_agent a inner join tms_agent_profile b on a.handling_type=b.id
			where b.id=3 and a.UserId = '$Atm' and a.user_state =1 order by a.id ASC ";
	
	 $res = $this->db->query($sql);
	 
	 $leave1 = 1; 
	 if( $res->num_rows() > 0 ) 
		 foreach( $res->result_assoc() as $rows )
	{
		
		$outs = $this->_select_row_total_policy( $rows['act_mgr'], $rows['spv_id'], 0, 0 );
		
      // ---------------------------------------------------	
	
		$arr_total_data   = array(
			"dbsData" 		=> $this->_select_row_total_data($rows['act_mgr'], $rows['spv_id'], 0, 0 ),
			"dbsSolicited"	=> $this->_select_row_total_solicited($rows['UserId'], 'ATM'),
			"dbsAtempt"		=> $this->_select_row_total_atempt($rows['UserId'], 'ATM'),
			"dbsInteres"	=> $outs->get_value('interest'),
			"dbsPremi"		=> $outs->get_value('premi')
		);
		
		//------------------------------------------------------
		
		$this->arr_atm[$leave1]= array(
			'data-tt-id' 		=> $leave1, 
			'data-tt-parent-id' => $leave1,
			'data-tt-level'   	=> $rows['user_level'],
			'data-tt-name' 	    => $rows['full_name'],
			'data-tt-init' 	    => $rows['init_name'],
			'data-tt-user' 	    => $rows['UserId'],
			'data-tt-total' 	=> $arr_total_data,
			'data-tt-child'     => $this->_select_row_dasboard_tl_by_atm( $rows['spv_id'], $leave1) 
		);	
		$leave1++;
	 }
	 
	 return $this->arr_atm;
 } 
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 
  protected function _select_row_dasboard_tl_by_tl( $tl_id = 0 ) 
 {
	$this->arr_tl = array();
	$sql = "select a.UserId, a.id,a.init_name,  b.id as user_level, a.full_name, a.act_mgr, a.spv_id, a.tl_id 
			from tms_agent a inner join tms_agent_profile b on a.handling_type=b.id
			where b.id=13 and a.UserId = '$tl_id' and a.user_state=1 ";
	
	
	// -------------- filter on here -------------------------------
	$vars = new EUI_Object(_get_all_request() );
	if( _get_have_post('dsb_supervisor') 
		AND count( $vars->get_array_value('dsb_supervisor') ) > 0 ) {
		$UserId = join(",", $vars->get_array_value('dsb_supervisor'));
		$sql .= " AND a.UserId IN($UserId) ";
	}
	
	 $sql .= " order by a.id ASC ";
	
	// ---------------------------------------------------------------------
	
	$res = $this->db->query($sql);
	 $leave1 = 1; 
	 if( $res->num_rows() > 0 ) 
		 foreach( $res->result_assoc() as $rows )
	{
		$outs = $this->_select_row_total_policy($rows['act_mgr'], $rows['spv_id'], $rows['tl_id'], 0 );
		
      // ---------------------------------------------------	
	  
		$arr_total_data   = array(
			"dbsData" 		=> $this->_select_row_total_data($rows['act_mgr'], $rows['spv_id'], $rows['tl_id'], 0 ),
			"dbsSolicited"	=> $this->_select_row_total_solicited($rows['UserId'], 'SPV'),
			"dbsAtempt"		=> $this->_select_row_total_atempt($rows['UserId'], 'SPV'),
			"dbsInteres"	=> $outs->get_value('interest'),
			"dbsPremi"		=> $outs->get_value('premi')
		);
		
		//------------------------------------------------------
		
		$this->arr_tl[$leave1]= array(
			'data-tt-id' 		=> $leave1,
			'data-tt-parent-id' => $leave1,
			'data-tt-level'   	=> $rows['user_level'],
			'data-tt-name' 	    => $rows['full_name'],
			'data-tt-init' 	    => $rows['init_name'],
			'data-tt-user' 	    => $rows['UserId'],
			'data-tt-total' 	=> $arr_total_data,
			'data-tt-child'     => $this->_select_row_dasboard_agent_by_tl( $rows['tl_id'], $leave1 ) 
		);	
		$leave1++;
	 }
	 
	 return $this->arr_tl;
 }
	

 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 protected function _select_row_dasboard_tl_by_atm( $Atm = 0, $leave1=0 )
{
	$this->arr_tl = array();
	
	 $sql = "select a.UserId, a.id,a.init_name,  b.id as user_level, a.full_name, a.act_mgr, a.spv_id, a.tl_id 
			from tms_agent a inner join tms_agent_profile b on a.handling_type=b.id
			where b.id=". USER_LEADER ." 
			AND a.spv_id={$Atm} 
			AND a.user_state =1 ";
	
	// -------------- filter on here -------------------------------
	
	$vars = new EUI_Object(_get_all_request() );
	if( _get_have_post('dsb_supervisor') 
		AND count( $vars->get_array_value('dsb_supervisor') ) > 0 ) {
		$UserId = join(",", $vars->get_array_value('dsb_supervisor'));
		$sql .= " AND a.UserId IN($UserId) ";
	}
	
	$sql .= " order by a.id ASC ";
	
	// -------------- filter on here -------------------------------
	
	$res = $this->db->query($sql);
	$leave2 = 1; 
	if( $res->num_rows() > 0 ) 
		 foreach( $res->result_assoc() as $rows )
	{
		$outs = $this->_select_row_total_policy($rows['act_mgr'], $rows['spv_id'], $rows['tl_id'], 0 );
		
      // ---------------------------------------------------	
		$arr_total_data   = array(
			"dbsData" 		=> $this->_select_row_total_data($rows['act_mgr'], $rows['spv_id'], $rows['tl_id'], 0 ),
			"dbsSolicited"	=> $this->_select_row_total_solicited($rows['UserId'], 'SPV'),
			"dbsAtempt"		=> $this->_select_row_total_atempt($rows['UserId'], 'SPV'),
			"dbsInteres"	=> $outs->get_value('interest'),
			"dbsPremi"		=> $outs->get_value('premi')
		);
		
		//------------------------------------------------------
		
		$this->arr_tl[$leave2]= array(
			'data-tt-id' 		=> join("-", array($leave1,$leave2)), 
			'data-tt-parent-id' => join("-", array($leave1)),
			'data-tt-level'   	=> $rows['user_level'],
			'data-tt-name' 	    => $rows['full_name'],
			'data-tt-init' 	    => $rows['init_name'],
			'data-tt-user' 	    => $rows['UserId'],
			'data-tt-total' 	=> $arr_total_data,
			'data-tt-child'     => $this->_select_row_dasboard_agent_by_atm( $rows['tl_id'], $leave1, $leave2) 
		);	
		$leave2++;
	 }
	 
	 return $this->arr_tl;
 }
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 protected function _select_row_dasboard_agent_by_mgr( $tl_id = 0, $leave1 = 0 , $leave2 = 0, $leave3=0 )
{
	$this->arr_agent = array();
	
	 $sql = "SELECT 
				a.UserId, a.id, a.init_name, b.id as user_level,
				a.full_name, a.UserId , a.act_mgr, a.spv_id, a.tl_id 
			FROM tms_agent a 
			INNER JOIN tms_agent_profile b on a.handling_type=b.id
			where b.id=". USER_AGENT_OUTBOUND ." 
			AND a.tl_id={$tl_id} AND a.user_state=1 
			ORDER BY a.id ASC {$this->limit} ";
				
			
	 $res = $this->db->query($sql);
	 
	 $leave4 = 1;
	 if( $res->num_rows() > 0 ) 
		 foreach( $res->result_assoc() as $rows )
	{
		$out = new EUI_Object( $rows );
	// -----------------------------------------------
	
		$outs = $this->_select_row_total_policy
		(
			$out->get_value('act_mgr'), 
			$out->get_value('spv_id'), 
			$out->get_value('tl_id'), 
			$out->get_value('UserId')
		);
		
      // --------------------------------------------------------------------	
	  
		$arr_total_data   = array(
			"dbsData" 		=> $this->_select_row_total_data( $out->get_value('act_mgr'), $out->get_value('spv_id'), $out->get_value('tl_id'), $out->get_value('UserId')),
			"dbsSolicited"	=> $this->_select_row_total_solicited($out->get_value('UserId'), 'AGENT'),
			"dbsAtempt"		=> $this->_select_row_total_atempt($out->get_value('UserId'), 'AGENT'),
			"dbsInteres"	=> $outs->get_value('interest'),
			"dbsPremi"		=> $outs->get_value('premi')
		);
		// ----------------------------------------------------------------
		
		$this->arr_agent[$leave4] = array(
			'data-tt-id' 		=> $this->_select_row_tree_join(array($leave1, $leave2, $leave3, $leave4)), 
			'data-tt-parent-id' => $this->_select_row_tree_join(array($leave1, $leave2, $leave3 )),
			'data-tt-level'     => $out->get_value('user_level'),
			'data-tt-name'      => $out->get_value('full_name'),
			'data-tt-init'      => $out->get_value('init_name'),
			'data-tt-user'      => $out->get_value('UserId'),
			'data-tt-total' 	=> $arr_total_data,
			'data-tt-child'     => array()
		);
		
		$leave4++;
	}
	return $this->arr_agent;
 }
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 protected function _select_row_dasboard_agent_by_atm( $tl_id = 0, $leave1=0, $leave2=0 )
{
	$this->arr_agent = array();
	
	 $sql = "select a.UserId, a.id, a.init_name, b.id as user_level, a.full_name, a.UserId, a.act_mgr, a.spv_id, a.tl_id  
			from tms_agent a inner join tms_agent_profile b on a.handling_type=b.id
			where b.id=4 and a.tl_id = '$tl_id' and a.user_state =1 order by a.id ASC ";
			
	 $res = $this->db->query($sql);
	 
	 $leave3 = 1;
	 if( $res->num_rows() > 0 ) 
		 foreach( $res->result_assoc() as $rows )
	{
		$outs = $this->_select_row_total_policy($rows['act_mgr'], $rows['spv_id'], $rows['tl_id'], $rows['UserId']);
      
	  // --------------------------------------------------------------------	
	  
		$arr_total_data   = array(
			"dbsData" 		=> $this->_select_row_total_data($rows['act_mgr'], $rows['spv_id'], $rows['tl_id'], $rows['UserId']),
			"dbsSolicited"	=> $this->_select_row_total_solicited($rows['UserId'], 'AGENT'),
			"dbsAtempt"		=> $this->_select_row_total_atempt($rows['UserId'], 'AGENT'),
			"dbsInteres"	=> $outs->get_value('interest'),
			"dbsPremi"		=> $outs->get_value('premi')
		);
		// --------------------------
		
		$this->arr_agent[$leave3] = array(
			'data-tt-id' 		=> join("-", array($leave1, $leave2, $leave3)), 
			'data-tt-parent-id' => join("-", array($leave1, $leave2)),
			'data-tt-level'     => $rows['user_level'],
			'data-tt-name'      => $rows['full_name'],
			'data-tt-init'      => $rows['init_name'],
			'data-tt-user'      => $rows['UserId'],
			'data-tt-total' 	=> $arr_total_data,
			'data-tt-child'     => array()
		);
		
		$leave3++;
	}
	return $this->arr_agent;
 }
 
 
 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 protected function _select_row_dasboard_agent_by_tl( $tl_id = 0, $leave1 =0 )
{
	$this->arr_agent = array();
	
	$sql = "select a.UserId, a.id, a.init_name, b.id as user_level, a.full_name,  a.act_mgr, a.spv_id, a.tl_id  
			from tms_agent a inner join tms_agent_profile b on a.handling_type=b.id
			where b.id=4 and a.tl_id = '$tl_id' and a.user_state =1 order by a.id ASC ";
	
	$res = $this->db->query($sql);
	 
	 $leave2 = 1;
	 if( $res->num_rows() > 0 ) 
		 foreach( $res->result_assoc() as $rows )
	{
		$outs = $this->_select_row_total_policy($rows['act_mgr'], $rows['spv_id'], $rows['tl_id'], $rows['UserId']);
      
	  // --------------------------------------------------------------------	
	  
		$arr_total_data   = array(
			"dbsData" 		=> $this->_select_row_total_data($rows['act_mgr'], $rows['spv_id'], $rows['tl_id'], $rows['UserId']),
			"dbsSolicited"	=> $this->_select_row_total_solicited($rows['UserId'], 'AGENT'),
			"dbsAtempt"		=> $this->_select_row_total_atempt($rows['UserId'], 'AGENT'),
			"dbsInteres"	=> $outs->get_value('interest'),
			"dbsPremi"		=> $outs->get_value('premi')
		);
		// --------------------------------------------------------
		$this->arr_agent[$leave2] = array(
			'data-tt-id' 		=> join("-", array($leave1,$leave2)), 
			'data-tt-parent-id' => join("-", array($leave1)),
			'data-tt-level'     => $rows['user_level'],
			'data-tt-name'      => $rows['full_name'],
			'data-tt-init'      => $rows['init_name'],
			'data-tt-user'      => $rows['UserId'],
			'data-tt-total' 	=> $arr_total_data,
			'data-tt-child'     => array()
		);
		
		$leave2++;
	}
	return $this->arr_agent;
 }
 
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 protected function _select_row_level_user()
{
	
	
 $this->arr_root = array();
 
// ------------------------ look by MANAGER --------------------------------
 
  if( in_array( _get_session('HandlingType'), array(USER_ROOT, USER_UPLOADER, USER_ADMIN) ) ) 
 {
	$this->arr_root = $this->_select_row_dasboard_mgr_by_mgr( 8 );
 }
 
// ------------------------ look by MANAGER --------------------------------
 
  if( in_array( _get_session('HandlingType'), array(USER_ACCOUNT_MANAGER) ) ) 
 {
	$this->arr_root = $this->_select_row_dasboard_mgr_by_mgr( _get_session('UserId'));
 }
  
 
// ------------------------ look by ATM -------------------------------- 
 if( in_array( _get_session('HandlingType'), array(USER_SUPERVISOR) ) ) 
 {
	$this->arr_root = $this->_select_row_dasboard_atm_by_atm( _get_session('UserId') );
 }
 
// ------------------------ look by ATM -------------------------------- 


 if( in_array( _get_session('HandlingType'), array(USER_LEADER) ) ) 
 {
	$this->arr_root = $this->_select_row_dasboard_tl_by_tl( _get_session('UserId') );
}
  
 
 return $this->arr_root;
}  


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public function _select_row_label_dashboard()
{
	$this->ar_label = array
	(
		"dbsName" 		=> lang(array("Name")),
		"dbsData" 		=> lang(array("Data")),
		"dbsSolicited" 	=> lang(array("Solicited")),
		"dbsAtempt" 	=> lang(array("Call Atempt")),
		"dbsInterest" 	=> lang(array("Interest")),
		"dbsPremi" 		=> lang(array("Premi"))
	);	
	
	return (array)$this->ar_label;
}  


//---------------------------------------------------------------------------------------
/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 public function _select_row_supervisor_by_login()
{
  $this->arr_spv = array();
  
  $sql = " SELECT a.UserId, a.id as InitName FROM tms_agent a 
	       WHERE a.handling_type = 13 ";
	
 // ------------------------ look by MANAGER --------------------------------
 
  if( in_array( _get_session('HandlingType'), array(USER_ACCOUNT_MANAGER) ) )  {
	$sql.= " AND a.act_mgr = ". _get_session('UserId') ." ";
	
  }
  
 
// ------------------------ look by ATM -------------------------------- 
  if( in_array( _get_session('HandlingType'), array(USER_SUPERVISOR) ) ) 
  {
	$sql.= " AND a.spv_id = ". _get_session('UserId') ." ";
  }
 
// ------------------------ look by ATM -------------------------------- 


   if( in_array( _get_session('HandlingType'), array(USER_LEADER) ) )  
  {
	 $sql.= " AND a.UserId = ". _get_session('UserId') ." ";
  }
  
  
  $sql .= " ORDER BY a.id ASC ";
  $rs = $this->db->query($sql);
  
  if( $rs->num_rows() > 0 ) 
	  foreach( $rs->result_assoc() as $rows )
  {
	  $this->arr_spv[$rows['UserId']] = $rows['InitName'];
  }
  
  return (array)$this->arr_spv;
	// 
}


 //---------------------------------------------------------------------------------------
/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public function _select_row_content_dashboard( $out  = null ) 
{
	return $this->_select_row_level_user();
} 
  
// ======================================= END CLASS =======================================  
    
}

?>