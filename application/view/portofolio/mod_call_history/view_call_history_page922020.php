<?php 
 $this->load->helpers(array('EUI_Object','EUI_Page','EUI_Spiner'));
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
 $outs = UR();
 $spiner=& Instance("EUI_Spiner");
 
 
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 $spiner->set_field_order( $outs->get_value('orderby'), $outs->get_value('type'));
 $spiner->set_max_adjust(5); 
 $spiner->set_width_table(100); // "percent"
 $spiner->set_height_row_body(32); // px 
 $spiner->set_height_row_header(27); // px 
 
// $spiner->set_field_add_header(FormbarLabel());

//---------------------------------------------------------------------------------------
/* properties		use function page together 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
if( !$outs->find_value('handler') ){
  $spiner->set_func_page_table("EventPageHistory");
} else {
  $spiner->set_func_page_table( $outs->get_value('handler'));
}

//---------------------------------------------------------------------------------------
/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 $spiner->set_name_table("ui-widget-pager-call-history");
 $spiner->set_content_row_table( $content_pages );
 $spiner->set_total_row_record($total_records);
 $spiner->set_total_row_page($total_pages);
 $spiner->set_select_row_page($select_pages);
 $spiner->set_start_row_page($start_page);
 
// ------------ attribute ---------------------------
//$spiner->set_checkbox_table(array( 'field' => NULL,  'event' => NULL ));
 //---------------------------------------------------------------------------------------

 //$spiner->select_pager_debug();
 
 /* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  
$spiner->set_field_header_wrap(array(
	'CallHistoryCreatedTs' 	=> 'nowrap',
	'CallReasonCategoryName' => 'nowrap',
	'CallReasonDesc' => 'nowrap',
	'init_name' => 'nowrap'
));

// ---- set wrap or not 
 $spiner->set_field_wrap(array(
	'CallHistoryCreatedTs' => 'nowrap',
	'CallReasonCategoryName' => 'wrap',
	'CallReasonDesc' => 'wrap',
	'CallHistoryNotes' => 'wrap',
	'CallReasonDesc' => 'nowrap',
	'CallNumber' => 'wrap',
	'AproveName' => 'wrap',
	'init_name' => 'nowrap'
	
));
 
// --- callback label -------------------------

 $spiner->set_field_header( array(
	"CallHistoryCreatedTs" 	 => lang(array("Activity Date")),
	"init_name"				 => lang(array("Agent Id")),
	"CallReasonCategoryName" => lang(array("Call Status")),	
	"CallReasonDesc" 		 => lang(array("Call Result")),
	//"CallNumber" 			 => lang(array("Phone Number")),
	//"AproveName" 			 => lang(array("Approve Status")),
	"CallHistoryNotes" 		 => lang(array("Notes")) 
));

// ---- call back align 
  
 $spiner->set_field_align(array(
	"CallHistoryCreatedTs" => "center",
	"CallReasonCategoryName" => "left",
	"CallReasonDesc" => "left",
	"CallHistoryNotes" => "left",
	"init_name" => "left"
 ));
 
 
// ---- call back func argv 
 
 $spiner->set_field_call_back(array(
	"CallHistoryCreatedTs" => array("_getDateTime"),
	"init_name"	=> array('strtoupper')
 ));
 
 // ----------------- compile & show ------------------
 
 $spiner->select_spiner_table_page();
 
 ?>