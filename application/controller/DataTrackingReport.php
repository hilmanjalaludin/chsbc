<?php
/*
 * @ modul : report data tracking controller 
 * @ object : superclass 
 * ----------------------------------------------------------------
  
 * @ param : - 
 * @ param : - 
 */
 
class DataTrackingReport extends EUI_Controller 
{


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
 var $FilterGroupBy = null;
 var $Mode = null;
 var $R_Model = null;


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
 public function __construct()
{
 parent::__construct();
 $this->load->model(array(base_class_model($this)));
 $this->load->helper(array('EUI_Object'));
 
}

//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 public function index()
{
  if( _get_is_login() == FALSE ) { return FALSE; }
  
  $out =& get_class_instance('M_DataTrackingReport');
  $this->load->view("rpt_data_tracking/report_data_track_nav", array
  (
	'report_type' 		=>  $out->_select_report_type(),
	'report_campaign' 	=>  $out->_select_report_campaign(),
	'report_manager' 	=>  $out->_select_report_manager(),
	'report_atm' 		=>  $out->_select_report_atm(),
	'report_spv' 		=>  $out->_select_report_spv(),
	'report_agent' 		=>  $out->_select_report_tmr(),
	'report_mode' 		=>  $out->_select_report_mode(),
	'report_user'		=>  $out->_select_attr_user()
  ));
  
}


//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 public function GroupFilterBy() 
{
	

} 

//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 public function showCampaign()
{
	$obj =& get_class_instance(base_class_model($this));
	return $obj->_getCampaignReady();
}


//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  public function ShowDataCampaignId() 
{


}

//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
public function ShowByAtm()
{
	
}


 public function ShowExcel()
{
	Excel()->HTML_Excel(get_class($this).''.time());
	
	$report_type = _get_post('report_type');
	if( $report_type == 'filter_campaign_group_agent' ){
		$this->load->view("mod_view_datatracking/html/view_campaign_group_agent");
	}
	
	if( $report_type == 'filter_campaign_group_spv' ){
		$this->load->view("mod_view_datatracking/html/filter_campaign_group_spv");
	}
	
	if( $report_type == 'filter_campaign_group_atm' ){
		$this->load->view("mod_view_datatracking/html/view_campaign_group_atm");
	}
	
	if( $report_type == 'filter_campaign_group_mgr' ){
		$this->load->view("mod_view_datatracking/html/view_campaign_group_mgr");
	}
	if( $report_type == 'filter_campaign_group_date' ){
		$this->load->view("mod_view_datatracking/html/view_campaign_group_date");
	}
	
	
	
 }
 
//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  public function showHTML() 
 {
	$report_type = _get_post('report_type');
	if( $report_type == 'filter_campaign_group_agent' ){
		$this->load->view("mod_view_datatracking/html/view_campaign_group_agent");
	}
	
	if( $report_type == 'filter_campaign_group_spv' ){
		$this->load->view("mod_view_datatracking/html/view_campaign_group_spv");
	}
	
	if( $report_type == 'filter_campaign_group_atm' ){
		$this->load->view("mod_view_datatracking/html/view_campaign_group_atm");
	}
	
	if( $report_type == 'filter_campaign_group_mgr' ){
		$this->load->view("mod_view_datatracking/html/view_campaign_group_mgr");
	}
	
	if( $report_type == 'filter_campaign_group_date' ){
		$this->load->view("mod_view_datatracking/html/view_campaign_group_date");
	}

 }
 
//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */ 
 
 function ShowAtmReportByManger() 
{
  $obClass = & get_class_instance('M_DataTrackingReport');
  $atClass = $obClass->_select_attr_user();
  echo form()->combo('AtmId','select tolong', $obClass->_select_report_atm_by_manager( _get_array_post('ManagerId') ), 
	$atClass->get_value('spv_id'), 
   array("change" => "ShowFilterReportByAtm(this);") );
} 

//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 function ShowSpvReportByAtm()
{ 
   $obClass = & get_class_instance('M_DataTrackingReport');
   $atClass = $obClass->_select_attr_user();
   echo form()->combo('spvId','select tolong', $obClass->_select_report_spv_by_atm( _get_array_post('AtmId') ), $atClass->get_value('tl_id'), 
	array("change" => "ShowAgentReportBySpv(this);") );
 }
 
//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function ShowAgentReportBySpv() 
{
  $obClass = & get_class_instance('M_DataTrackingReport');
  echo form()->combo('TmrId','select tolong', $obClass->_select_report_tmr_by_spv( _get_array_post('SpvId'))); 
 }
 
//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 public function ShowReport()
{
	
 $out = new EUI_Object( _get_all_request() );	
 if( $out->get_value('mode','strtolower') == 'html' ) {
	$this->showHTML(); 
 }	
 
 if( $out->get_value('mode','strtolower') == 'excel' )  {
	$this->ShowExcel(); 
 }
 
}
 
}
?>