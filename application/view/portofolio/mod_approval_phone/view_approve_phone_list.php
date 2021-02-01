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
 
 $pager->set_checkbox_func(true, true);

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
 //echo $pager ->select_row_field();
 
  $pager->set_order_style(array
 (
	'background-color' 	=> '#FFFCCC',
	'color' 			=> '#8a1b08',
	'cursor' 			=> 'pointer'
 ));
 
/* 
 : FIELD : 
	[ApprovalHistoryId] => ApprovalHistoryId
	[CustomerNumber] 	=> CustomerNumber
	[CustomerFirstName] => CustomerFirstName
	[ApprovalOldValue] 	=> ApprovalOldValue
	[ApprovalNewValue] 	=> ApprovalNewValue
	[RequestBy] 		=> RequestBy
	[ApprovalCreatedTs] => ApprovalCreatedTs
	[PhoneDesc] 		=> PhoneDesc
*/

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  $pager->set_align_cols( array
 (
	'CustomerNumber'	=> 'left',
	'CustomerFirstName' => 'left',
	'CampaignName' 		=> 'left',
	'ApprovalOldValue' 	=> 'left',
	'ApprovalNewValue'	=> 'left',
	'RequestBy'			=> 'left',
	'ApprovalCreatedTs'	=> 'center',
	'PhoneDesc'			=> 'left'
  ));

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  $pager->set_row_format( array
 (
	'CustomerFirstName' => array('_setBoldColor'),
	'CampaignNumber'	=> array('_setBoldColor'),
	'RequestBy'			=> array('_setCapital'),
	'ApprovalCreatedTs'	=> array('_getDateTime')
 ));  

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $pager->set_event_row_click(array('onclick' => 'ApproveDetail') );
 
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
