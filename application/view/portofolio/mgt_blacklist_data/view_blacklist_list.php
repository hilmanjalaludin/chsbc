<?php 

if( !function_exists('_setCutRows') ){
	function _setCutRows( $data ){
		return wordwrap($data, 20, "<br>");
	}
}
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
  $pager->set_title_row_content('set checkbox for custiomize data');
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
	'CustomerNumber' 		 => 'left',
	'CustomerFirstName' 	 => 'left',
	'CustomerDOB' 			 => 'center',
	'CustomerAddressLine1'	 => 'left',
	'CustomerHomePhoneNum'	 => 'left',
	'CustomerMobilePhoneNum' => 'left',
	'CustomerWorkPhoneNum'	 => 'left',
	'CustomerZipCode'		 => 'center',
	'CustomerUploadedTs'	 => 'center',
	'AssignCampaign'		 => 'center',
	'OnCampaignId'			 => 'left',
  ));

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  $pager->set_row_format( array
 (
	'CustomerNumber' 		 => array('_setCapital','_setBoldColor'),
	'CustomerFirstName' 	 => array('_setCapital'),
	'CustomerDOB' 			 => array('_getDateIndonesia'),
	'CustomerAddressLine1'	 => array('_setCapital','_setBreakWord'),
	'OnCampaignId'			 => array('_setBreakWord'),	
	'CustomerHomePhoneNum'	 => array('_setMasking'),
	'CustomerMobilePhoneNum' => array('_setMasking'),
	'CustomerWorkPhoneNum'	 => array('_setMasking'),
	'CustomerZipCode'		 => array('_setCapital'),
	'CustomerUploadedTs'	 => array('_getDateTime'),
	'AssignCampaign'		 => array('_setCapital')
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
