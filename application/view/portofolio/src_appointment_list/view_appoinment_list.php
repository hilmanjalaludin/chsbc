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
  $pager->set_title_row_content('click row for detail');
  $pager->set_width_table('100%');
  $pager->set_class_table('custom-grid');
  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 // $pager ->select_row_field();
  
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
	'CustomerNumber'	=> 'left',
	'CampaignName'		=> 'left',
	'CustomerFirstName' => 'left',
	'CustomerCity'      => 'left',
	'CallResultId' 		=> 'left',
	'TryCallTime' 		=> 'center',
	'TryCallDate' 		=> 'center',
	'ApoinmentCreate'	=> 'center',
	'Notes'				=> 'left',
	'Gender'			=> 'left',
	'Status'			=> 'left',
	'AgentId'			=> 'left',
	'Supervisor' 		=> 'left'
	
  ));

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  $pager->set_row_format( array
 (
	'CustomerNumber'=> array('_setCapital','_setBoldColor'),
	'CampaignName' => array('_setCapital'),
	'CustomerCity' => array('_setCapital'),
	'CustomerFirstName'	=> array('_setCapital','_setWordWrap'),
	'AgentId'		=> array('_setCapital','_setWordWrap'),
	'Supervisor' => array('_setCapital','_setWordWrap'),
	'ApoinmentCreate' => array('_getDateTime'),
	'Notes' => array('_setWordWrap')
  ));  

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $pager->set_event_row_click(array('onclick' => 'DetailCustomer') );
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $pager->select_pager_content();
 $pager->reset_pager_object();
 
// ------------------------------------END VIEW ---------------------------------