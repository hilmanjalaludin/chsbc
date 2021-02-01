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

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  
  $pager->set_source_table($page, $num);
  $pager->set_title_row_content('click row for followup data');
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
/*
Array
(
    [CustomerId] => CustomerId
    [CampaignName] => CampaignName
    [CIF] => CIF
    [CustomerFirstName] => CustomerFirstName
    [CallReasonDesc] => CallReasonDesc
    [AproveName] => AproveName
    [CustomerUpdatedTs] => CustomerUpdatedTs
    [CustomerRejectedDate] => CustomerRejectedDate
)
 */
/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  $pager->set_align_cols( array
 (
	'CampaignName' => 'left',
	'CallReasonDesc' => 'left',
	'CustomerFirstName' => 'left',
	'AproveName'=> 'left',
	'CustomerUpdatedTs' => 'center',
	'Supervisor' =>'left',
	'CustomerRejectedDate' => 'center',
	'CustomerNumber'	=> 'left',
	'QAstaff' => 'left',
	'PolicyNumber' => 'left',
	'UserId' => 'left',
	'PolicySalesDate' => 'center',
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
	'CustomerNumber' => array('_setCapital','_setBoldColor'),
	'PolicyNumber'	=> array('_setBoldColor'),
	'CustomerFirstName' => array('_setCapital','_setBoldColor','_setWordWrap'),
	'UserId' => array('_setCapital','_setWordWrap'),
	'QAstaff' => array('_setCapital','_setWordWrap'),
	'CustomerUpdatedTs' => array('_getDateTime'),
	'CustomerRejectedDate' => array('_getDateTime'),
	'PolicySalesDate' => array('_getDateTime'),
	'Duration' => array('_getDuration'),
	'CustomerDOB' => array('_getDateIndonesia'),
	'CustomerAge' => array('_getAge'),
	'Supervisor' => array('strtoupper')
  ));  

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $pager->set_event_row_click(array('onclick' => 'SetEventCallData') );
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $pager->select_pager_content();
 $pager->reset_pager_object();
 
// ------------------------------------END VIEW ---------------------------------
?>


