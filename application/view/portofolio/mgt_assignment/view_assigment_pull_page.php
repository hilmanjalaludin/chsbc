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
  $spiner->set_func_page_table("ViewTransferData");
} else {
  $spiner->set_func_page_table( $outs->get_value('handler'));
}

//---------------------------------------------------------------------------------------
/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */

 $spiner->set_name_table("ui-widget-pager-pull-list");
 $spiner->set_content_row_table( $content_pages );
 $spiner->set_total_row_record($total_records);
 $spiner->set_total_row_page($total_pages);
 $spiner->set_select_row_page($select_pages);
 $spiner->set_start_row_page($start_page);
 
/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
$spiner->set_checkbox_table(array('field' =>'PullAssignId',  'event' => null ));
 

 //---------------------------------------------------------------------------------------

//$spiner->select_pager_debug();
 
/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
$spiner->set_field_header( array(
	"CampaignName" 		 	 => lang(array("Campaign")),
	"Recsource" 		 	 => lang(array("Recsource")),
	"CustomerFirstName"  	 => lang(array("Customer Name")),
	"GenderId"			 	 => lang(array("Gender")),
    "CustomerDOB" 		 	 => lang(array("DOB")),
	"CustomerAge" 		 	 => lang(array("Age")),
	
	"CustomerMktKode"		 => lang(array("CustomerMktKode")),	
	"Username" 				 => lang(array('Agent ID')),
	"CallStatus"		 	 => lang(array("Call Status")),
	"CallReasonId"	 	 	 => lang(array("Call Result")),
	"DisagreeId"			 => lang(array("DisagreeId")),
	"LastCallDate"		 	 => lang(array("Last Call Date")),
	"Atempt"			 	 => lang(array("Call Atempt")),
	"CustomerUploadedTs" 	 => lang(array('Upload Date')),
	
	"CustomerCity" 	 	 	 => lang(array("City")),
	"CustomerAddressLine1"	 => lang(array("CustomerAddressLine1")),
	"CustomerAddressLine2"	 => lang(array("CustomerAddressLine2")),
	"CustomerAddressLine3"	 => lang(array("CustomerAddressLine3")),
	"CustomerAddressLine4"	 => lang(array("CustomerAddressLine4"))
	
));


// ---- set wrap or not 
 $spiner->set_field_wrap(array(
	"CustomerFirstName" => 'wrap',
    "CustomerDOB" 		=> 'wrap',
	"CustomerCity" 		=> 'wrap',
	"CallReasonId"		=> 'wrap',
	"DisagreeId"		 => 'wrap',
	"Atempt" 			=> 'wrap',
	"UserId" 			=> 'wrap',
	"LastCallDate" 		=> 'wrap',
	"CampaignName" 		=> 'wrap'
	
));
 
/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  
$spiner->set_field_header_wrap(array(
	"CustomerMktKode"	 => 'nowrap',
	"CampaignName" 		 => 'nowrap',
	"Recsource" 		 => 'nowrap',
	"CustomerFirstName"  => 'nowrap',
    "CustomerDOB" 		 => 'nowrap',
	"GenderId"			 => 'nowrap',
	"CallReasonId"		 => 'nowrap',
	"CallStatus"		 => 'nowrap',
	"DisagreeId"		 => 'nowrap',
	"LastCallDate"		 => 'nowrap',
	"Atempt"			 => 'nowrap',
	"CustomerUploadedTs" => 'nowrap',
	"CustomerAddressLine1"=> 'nowrap',
	"CustomerAddressLine2"=> 'nowrap',
	"CustomerAddressLine3"=> 'nowrap',
	"CustomerAddressLine4"=> 'nowrap',
	"Username"			  => 'nowrap'
	
));
// ---- set wrap or not 
 $spiner->set_field_wrap(array(
	"CampaignName" 		 => 'wrap',
	"Recsource" 		 => 'nowrap',
	"CustomerAddressLine1"=> 'nowrap',
	"CustomerFirstName"  => 'wrap',
    "CustomerDOB" 		 => 'nowrap',
	"GenderId"			 => 'nowrap',
	"CallReasonId"		 => 'wrap',
	"CallStatus"		 => 'wrap',
	"LastCallDate"		 => 'nowrap',
	"Atempt"			 => 'wrap',
	"CustomerUploadedTs" => 'nowrap',
	"Username"			 => 'wrap'
	
));

// set_header_align
$spiner->set_header_align(array(
	"CustomerMktKode"	 => 'center',
	"CampaignName" 		 => 'left',
	"Recsource" 		 => 'left',
	"CustomerFirstName"  => 'left',
    "CustomerDOB" 		 => 'left',
	"CustomerAge"		 => 'center',
	"GenderId"			 => 'left',
	"CallStatus"		 => 'center',
	"CallReasonId"	 	 => 'center',
	"DisagreeId"	 	 => 'center',
	"LastCallDate"		 => 'center',
	"Atempt"			 => 'center',
	"CustomerUploadedTs" => 'center'
 ));
// ---- call back align 
  
 $spiner->set_field_align(array(
	"CampaignName" 		 => 'left',
	"Recsource" 		 => 'left',
	"CustomerFirstName"  => 'left',
    "CustomerDOB" 		 => 'center',
	"CustomerAge"		 => 'center',
	"CustomerMktKode"	 => 'center',
	"GenderId"			 => 'left',
	"CallStatus"		 => 'left',	
	"CallReasonId"	 	 => 'left',
	"DisagreeId"	 	 => 'left',
	"LastCallDate"		 => 'center',
	"Atempt"			 => 'center',
	"CustomerUploadedTs" => 'center'
 ));
 /// 
 
// ---- call back func argv 
 
 $spiner->set_field_call_back(array(
	"CustomerAddressLine1"	=> array("SetAddressLine"),
	"CustomerAddressLine2"	=> array("SetAddressLine"),
	"CustomerAddressLine3"	=> array("SetAddressLine"),
	"CustomerAddressLine4"	=> array("SetAddressLine"),
	"CustomerCity"		  	=> array("SetAddressLine"),
	"Recsource" 		 	=> array("SetCapital"),
	"CustomerFirstName"  	=> array("SetCapital"),
    "CustomerDOB" 		 	=> array("SetDate"),
	"GenderId"			 	=> array("Gender"),
	"CustomerMktKode"		=> array("SetCapital"),
	"CallStatus"			=> array("CallStatusId","SetCapital"),
	"CallReasonId"	 		=> array("CallResultId","SetCapital"),
	"DisagreeId"	 		=> array("DisagreeId","SetCapital"),
	"LastCallDate"		 	=> array("SetDateTime"),
	"Atempt"			 	=> array("SetCapital"),
	"CustomerUploadedTs" 	=> array("SetDateTime"),
	"Username"				=> array("AllUser","SetCapital")
	
 ));
 
 // ----------------- compile & show ------------------
 
 $spiner->select_spiner_table_page();
 
 print("<div class='ui-widget-info-error'> 
			<p> * ) Tidak Termasuk data yang sedang di \"Review\" </p>
			<p> * ) Filter Data Akan Di process jika Memilih \"Campaign Name\" Terlebih dahulu </p>	
		</div>");
 
 ?>