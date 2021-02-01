<?php



class AbandonReview extends EUI_Controller
{


 function __construct()
{
   parent::__construct();
   //M_AbandonReview
   //src_appointment_list
   $this->load->model(array('M_AbandonReview','M_MgtLockCustomer'));
   $this->load->helper(array('EUI_Object'));
}


/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function index()
 {
	if( $this ->EUI_Session ->_have_get_session('UserId') )
	{
		$_EUI  = array(
		'page' => $this ->M_AbandonReview ->_get_default(),
		'recs' => $this->M_MgtLockCustomer->_getUserRecsource(_get_session('UserId'))
		);
		if( is_array($_EUI))
		{
			$this -> load ->view('src_abandon_review/view_appoinment_nav',$_EUI);
		}	
	}
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function Content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this ->M_AbandonReview ->_get_resource();    // load content data by pages 
		$_EUI['num']  = $this ->M_AbandonReview ->_get_page_number(); // load content data by pages 
		
		// sent to view data 
		
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('src_abandon_review/view_appoinment_list',$_EUI);
		}	
	}	
 }

/**
 * [ResetAbandon description]
 * @param string $CustomerId [description]
 */
 public function ResetAbandon ( $CustomerId = "" ) {
 	$callback = array( "success" => 0 );

 	if ( $CustomerId == "" ) {
	 	$out = new EUI_Object( _get_all_request() );
	 	$CustomerId = $out->get_value( "CustomerId" );
 	} 

 	if ( !empty($CustomerId) ) {
 		$resetCustomer   = $this->M_AbandonReview->_update_customer_reset($CustomerId);
 		$insertCallhistory   = $this->M_AbandonReview->_insert_history($CustomerId);
 		
 		if ( $resetCustomer == true && $insertCallhistory == true ) {
 			$callback = array( "success" => 1 );
 		}
 	}

 	echo json_encode( $callback );

 }
 
 
 /**
 * [ResetAbandon description]
 * @param string $CustomerId [description]
 */
 public function ResetAbandonCheckList () {
 	$callback = array( "total" => 0 , "success" => 0);

	$out = new EUI_Object( _get_all_request() );
	$CustomerId = $out->get_value( "CustomerId" );

	$count = 0;
	if ( is_array($CustomerId) ) {		
		foreach ( $CustomerId as $val ) {
			if ( !empty($val) ) {
		 		$resetCustomer   = $this->M_AbandonReview->_update_customer_reset($val);
		 		$insertCallhistory   = $this->M_AbandonReview->_insert_history($val);
		 		if ( $resetCustomer == true && $insertCallhistory == true ) {
		 			$count += 1;
		 		}
		 	}
		}
	}

	$countCustomer = count($CustomerId);
	if ( $count > 0 ) {
		$callback = array( "total" => $countCustomer , "success" => $count);
	}

	echo json_encode($callback); 

 }

 
// ----------------------------------------------------------
/*
 * @ pack 			function call 
 */
 
 public function Update()
{
	$callback = array('success' => 0);
	if(_get_have_post('AppoinmentId') )
	{
		$this->db->set('ApoinmentFlag', 1);
		$this->db->where('AppoinmentId', _get_post('AppoinmentId') , FALSE);
		$this->db->where('UserId',_get_session('UserId') , FALSE);
		
		if( $this->db->update('t_gn_appoinment') )
		{
			$this->db->reset_write();
			$this->db->select("CustomerId", FALSE);
			$this->db->from("t_gn_appoinment");
			$this->db->where("AppoinmentId", _get_post('AppoinmentId'));
			
			$rs = $this->db->get();
			if( $rs->num_rows() > 0 ){
				$CustomerId = $rs->result_singgle_value();
			}
			
			$callback = array( 'success' => 1,  'CustomerId' => $CustomerId );
		}
	}
	
	echo json_encode( $callback );
}	
 
function FilterRecData(){
	
// definition array result 	
	$result_dates = date('Y-m-d');
	$result_array = array();
	
// reset select if multiple select 	

	$this->db->reset_select();
	$this->db->select("a.Recsource as Recsource", false);
	$this->db->from("t_gn_customer a");
	$this->db->where(sprintf("a.expired_date >= '%s' ", $result_dates), '', false);
	
	// filter by keyword OK 
	$keywords = UR()->fields('keyword');
	
	// jika data berupa array lihat ini.
	if( is_array($keywords) ) 
	 foreach( $keywords  as $key => $value ){
		$this->db->or_like("a.Recsource", trim($value));
	}
	$this->db->group_by('a.Recsource ');
	
// $this->db->print_out(); 
// get data source process OK 	
	
	$qry = $this->db->get();
	if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_assoc() as $row ){
		$result_array[$row['Recsource']] = $row['Recsource'];
	}
	
// kembalikan ke nilai data JSON untuk di process di client Server.	
	$result_value = array();
	if( is_array( UR()->fields('recsource')) ) 
	foreach( UR()->fields('recsource') as $key => $val ){
		$result_value[$val] = $val; 	
	}
// result dropdown entitas.	
	printf("%s", form()->combo('src_customerabd_recsource', 'select long cz-autocomplete', $result_array, $result_value, null, array('multiple'=>'multiple' ) ) );
	return false;
}

public function filtered_recsource()
{
	
	if( _get_session('UserId') )
	{
		$recsource = array();
		$out = new EUI_Object(_get_all_request() );
		$campaign = null;
		$islike = null;
		$istext = null;
		$isfield = null;
		// echo "<pre>";
		// print_r($out);
		// echo "</pre>";
		if( _get_have_post('campaign_name') )
		{
			$campaign = $out->get_array_value('campaign_name');
			
		}
		
		if( _get_have_post('trans_from_campaign_id') )
		{
			$campaign = $out->get_array_value('trans_from_campaign_id');
			$islike = $out->get_value('trans_field_filter1');
			$istext = $out->get_value('trans_field_text1');
			$isfield = $out->get_value('trans_field_value1');
		}
		
		if( _get_have_post('pull_from_campaign_id') )
		{
			$campaign = $out->get_array_value('pull_from_campaign_id');
			$islike = $out->get_value('pull_field_filter1');
			$istext = $out->get_value('pull_field_text1');
			$isfield = $out->get_value('pull_field_value1');
		}
		
		if( _get_have_post('clbk_campaign_name') )
		{
			$campaign = $out->get_array_value('clbk_campaign_name');
			$istext = $out->get_value('src_customerabd_keyword');
		}
		
		if( $campaign ) 
		{
			$recsource = Recsource(array(
					'CampaignId'=> $campaign,
					'islike'=> "LIKE",
					'istext'=>$istext,
					'isfield'=>"b.Recsource"
					
				));
		}
		else
		{
			$recsource = Recsource();
		}
		
		// echo "<pre>";
		// print_r($recsource);
		// echo "</pre>";
		
		$OnSelect = $out->get_array_value('select');
		if( $out->get_value('type') == 'dropdown' ) {
			echo form()->combo($out->get_value('id'),"select long",$recsource, first($OnSelect));
		}	
		else if( $out->get_value('type') == 'listboxes' ) 
		{
			
			echo form()->listCombo($out->get_value('id'),"select long", $recsource,$OnSelect, null, array("height" => "200px","dwidth" => "100%"));	
			
		}
	}
	

}

}
?>