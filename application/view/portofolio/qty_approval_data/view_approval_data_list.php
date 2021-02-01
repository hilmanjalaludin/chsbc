<?php 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $this->load->helpers(array("EUI_Object","EUI_Extendpager")); 
 $pager =& EUI_Extendpager::Instance();
 
//---------------------------------------------------------------------------------------

/* properties		set_checkbox_func 
 *
 * @param 			set checked = false , oncheked rows = false 
 * @author			uknown 
 */
 
 $pager->set_checkbox_func(true, false);

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  $pager->set_source_table($page, $num);
  $pager->set_title_row_content('set checkbox for reject of row(s) data');
  $pager->set_width_table('100%');
  $pager->set_class_table('custom-grid');
  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 //$pager ->select_row_field();
 
  $pager->set_order_style(array
 (
	'background-color' 	=> '#FFFCCC',
	'color' 			=> '#8a1b08',
	'cursor' 			=> 'pointer'
 ));
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  $pager->set_align_cols( array
 (
	'CampaignCode' 		=> 'left',
	'CustomerNumber' 	=> 'left',
	'CampaignName' 		=> 'left',
	'CustomerFirstName' => 'left',
	'PolicyNumber'		=> 'left',
	'PolicySalesDate'   => 'center',
	'ApproveStatus'		=> 'center',
	'AgentName'			=> 'left',
	'ApproveStatus'		=> 'left',
	'CallReasonDesc'	=> 'left',
    'Duration'			=> 'center',
	'CustomerDOB'		=> 'center',
	'CustomerAge'		=> 'center'		
  ));

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  $pager->set_row_format( array
 (
	'PolicyNumber'	=> array('_setBoldColor'),
	'CustomerNumber' => array('_setBoldColor'),
	'ApproveStatus'	=> array('_setBoldColor'),
	'PolicySalesDate' => array('_getDateTime'),
	'Duration'			=> array('_getDuration'),
	'CustomerDOB'		=> array('_getDateIndonesia'),
	'CustomerAge'		=> array('_getAge')
 ));  

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $pager->set_event_row_click(null);
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $pager->select_pager_content();
 $pager->reset_pager_object();
 
// ------------------------------------END VIEW ---------------------------------