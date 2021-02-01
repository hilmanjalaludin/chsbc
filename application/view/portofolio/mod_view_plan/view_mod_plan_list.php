<?php 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $this->load->helpers(array("EUI_Object","EUI_Extendpager")); 
 $pager =& EUI_Extendpager::Instance();
 
 // $dfl = new EUI_Object( $page->result_assoc());
 // $dfl->debug_field();
  
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
   $pager->set_checkbox_func(true, true);
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
/*[ProductId] => ProductId
    [ProductCode] => ProductCode
    [ProductName] => ProductName
    [PrefixMethod] => PrefixMethod
    [PrefixLength] => PrefixLength
    [PrefixChar] => PrefixChar
*/	
/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
  $pager->set_align_cols( array
 (
	'ProductCode' 		=> 'left',
	'ProductName' 		=> 'left',
	'PrefixMethod' 		=> 'left',
	'PrefixLength' 		=> 'left',
	'PrefixChar' 		=> 'left',
	'StatusFlags'		=> 'center'
  ));

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

  $pager->set_row_format( array(
	'ProductCode'	=> array('_setCapital','_setBoldColor'),
	'ProductName'   => array('strtolower','ucwords'),
  ));  

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $pager->set_event_row_click(array('onclick' => 'gotoCallCustomer') );
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 $pager->select_pager_content();
 $pager->reset_pager_object();
 
// ------------------------------------END VIEW ---------------------------------