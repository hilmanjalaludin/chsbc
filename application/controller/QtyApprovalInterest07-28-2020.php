<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class QtyApprovalInterest extends EUI_Controller
{

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function QtyApprovalInterest() 
{
	parent::__construct();
	$this->load->model(array( base_class_model($this)));	
	$this->load->helper('EUI_Object');
	
 }
 /*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function QualityDetail()
{
	
	$out =new EUI_Object( _get_all_request() );	
	$CustomerId = $out->get_value('CustomerId'); 
//---------- load object by instance ------------

	
	$objQtyResult =& get_class_instance('M_SetResultQuality');
	$objQuality   =& get_class_instance('M_QtyApprovalInterest');
	$objCustomer  =& get_class_instance('M_SrcCustomerList');
	$objUser      =& get_class_instance('M_SysUser');
	$objectCustomer = $objCustomer->_getDetailCustomer($CustomerId);
	#var_dump(ApprovalPoint());die();
// --------- load view data ------------------------------------
	 $this->load->view('qty_approval_interest/view_quality_detail',array 
	(
		'Customers' 	   => new EUI_Object($objectCustomer), 
		'Accurate'		   => new EUI_Object( $this->{base_class_model($this)}->_fetch_row_accurate_data( $CustomerId ) ) , 
		'Callhistory' 	   => $objQuality->_getLastCallHistory( $CustomerId ),
		'Seller'		   => (object)$objUser->_get_user($objectCustomer["SellerId"]) ,
		'Agent'		       => (object)$objUser->_get_user(_get_session("UserId")) ,
		'Disabled'		   => $objQuality->_select_row_data_quality_status( $CustomerId),
		'QualityApprove'   => $this->QualityResult(),
		'ResultPoints' 	   => ApprovalPoint(),
		'JsonAssesment'    => JsonAssesment(),
		'QtyScoring' 	   => QualityScoring(),
		'Assesment' 	   => Assesment(),
		'QualityScoring'   => ContentScoring(),
		'ComboScoring'     => ComboScoring(), 
		'scoring'	 	   => $this->M_Scoring
	));
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function _getCombo()
 {
	$_serialize = array();
	$_combo = $this ->M_Combo->_getSerialize();
	foreach( $_combo as $keys => $method )
	{
		if((STRTOLOWER($keys)!='serialize') AND (STRTOLOWER($keys)!='instance') 
			AND (STRTOLOWER($keys)!='nstruct') AND (STRTOLOWER($keys)!='t'))
		{
			$_serialize[$keys] = $this ->M_Combo->$method(); 	
		}
	}
	
	return $_serialize;
 }
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

public function index()
{
 if(_have_get_session('UserId') && class_exists('M_QtyApprovalInterest') )
 {
	$this->load->view('qty_approval_interest/view_approval_interest_nav',array( 
		'page' => $this->{base_class_model($this)}->_get_default()  
	));
 }
 
}
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function Content()
{

  if(_have_get_session('UserId') ) 
  {
	$_EUI['page'] = $this->{base_class_model($this)}->_get_resource();    // load content data by pages 
	$_EUI['num']  = $this->{base_class_model($this)}->_get_page_number(); // load content data by pages 
	
	// sent to view data 
	if( is_array($_EUI) && is_object($_EUI['page']) ) {
		$this -> load -> view('qty_approval_interest/view_approval_interest_list',$_EUI);
	 }	
  }	
}
 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function QualityResult()
{
	$_conds= array();
	$_conds = $this->M_SetResultQuality->_getQualityResult();
	
	foreach( $_conds as $k => $rows )
	{
		$_conds[$k] = $rows['name']; 
	}
	
	return $_conds;
}


/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
function LastCallHistory( $CustomerId = 0 )
{	
	$_conds = array();
	
	if( $this -> EUI_Session->_have_get_session('UserId') )
	{
		$_conds = $this -> {base_class_model($this)}->_getLastCallHistory( $CustomerId );
	}
	
	return $_conds;
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
function CallResultId()
{
	$_conds = array();
	$datas = $this -> M_SetCallResult->_getCallReasonId();
	foreach($datas as $k => $rows )
	{
		$_conds[$k] = $rows['name'];
	}
	
	return $_conds;
}

 
function Recording()
{
	$param = array(
		'CustomerId' => $this->URI->_get_post('CustomerId'),
		'pages' => $this->URI->_get_post('Pages'),
	);
	
	$ListView =  array( 
		'data'  => $this->{base_class_model($this)}->_getListVoice($param), 
		'page'  => $this->{base_class_model($this)}->_getPages($param),
		'records' => $this->{base_class_model($this)}->_getCountVoice($param),
		'current' => $this->URI->_get_post('Pages')
		);
	
	
	if( $ListView )
	{
		$this -> load -> view('qty_approval_interest/view_quality_recording',$ListView);
	}
}

/*
 * @ def 		:  remove this function Not Use for this version 
 * -------------------------------------------
 
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function CallHistory()  {
   exit('Modul move on ');
}

// ---------------------------------------------------------------------------
/*
 * @ def 		: approval save point 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function SaveQualityActivity()
{
  $cond = array("success" => 0);
  $out= new EUI_Object( _get_all_request() );
  if( !$out->fetch_ready() ){ 
	return FALSE; 
  }
  
 // --------------------------------------------------------- 
  $obClass =& get_class_instance(base_class_model($this));

  if (  $obClass->_save_row_quality_data($out)  ) {
	$cond = array("success" => 1);  
	echo json_encode($cond);  
	return false;
  }	  
  
  echo json_encode(array("success" => 0 ));
}

public function SaveAccurate()
{
  $cond = array("success" => 0);
  $out= new EUI_Object( _get_all_request() );
  if( !$out->fetch_ready() ){ 
	return FALSE; 
  }
  
 // --------------------------------------------------------- 
  $obClass =& get_class_instance(base_class_model($this));

  if (  $obClass->_save_row_accurate_data($out)  ) {
 	echo json_encode(array("success" => 1 ));
 	return false;
  }	  
  
  echo json_encode(array("success" => 0 ));
}

// ---------------------------------------------------------------------------
/*
 * @ def 		: approval save point 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function SetQualityReason()
{
	$out =new EUI_Object( _get_all_request() );
	$QualityStatus = $this->{base_class_model($this)}->_select_quality_status( $out->get_value('CustomerId'));
	echo form()->combo('QualityReasonStatus','select tolong xchosen ui-widget-qty-disabled', QualityReason($out->get_value('QualityStatus')), $QualityStatus);
}

 // ---------------------------------------------------------------------------
/*
 * @ def 		: approval save point 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function saveScoring () {
	if ( isset($_POST) ) :
		$this->M_Scoring->saveScore($_POST);
	endif;
 }


/*
 * @ def 		: approval save point 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
public function DetailInsured()
{
  
  $out =new EUI_Object(_get_all_request());
  if( !$out-> fetch_ready() ){
	  return FALSE;
  }

// ------------------------------------------------------------------------  
  $objInsured =& get_class_instance('M_Insured');
  $objUnderwrite =& get_class_instance('M_Underwriting');
  $objBenefiecery =& get_class_instance('M_Benefiecery');
  
 //--------------------------------------------------------------------------
  $objQuality   =& get_class_instance('M_QtyApprovalInterest');
  $arr_insured =new EUI_Object( $objInsured->_getInsureId($out->get_value('InsuredId')) );
  
  //print_r($arr_insured);
  
  
  $arr_output = array (
		
		'Insured' => $arr_insured,
		'Disabled' => $objQuality->_select_row_data_quality_status( $arr_insured->get_value('CustomerId') ),
		'Question' => $objUnderwrite->_getUnderwriting( 
			$arr_insured->get_value('ProductId'),
			$arr_insured->get_value('CustomerId'),
			$arr_insured->get_value('InsuredId')
		),
		 'QtyUnderwriting'=> $objUnderwrite->_getExitsUnderwriting(
			$arr_insured->get_value('ProductId'),
			$arr_insured->get_value('CustomerId'),
			$arr_insured->get_value('InsuredId')
		 ));
  
  $this -> load -> view("qty_approval_interest/view_detail_insured", $arr_output );
	
}


/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

function PlayBySessionId() 
{
  $_success = array('success'=>0);
	
  $FTP = $this -> M_Configuration -> _getFTP();
  $sql ="SELECT b.id as RecId FROM cc_call_session a  
		 LEFT JOIN cc_recording b ON a.session_id=b.session_key 
		 WHERE a.session_id='{$this -> URI->_get_post('RecordId')}'";
			 
  $qry = $this -> db ->query($sql);
  if( $rows = $qry -> result_first_assoc() )
  {
	 $voice  = $this -> {base_class_model($this)}->_getVoiceResult($rows['RecId']);
	 if( is_array($voice) )
	 {
		$this->load->library('Ftp');
		
		$PBX = $this->M_Pbx ->InstancePBX($voice['agent_ext']);
		$this->Ftp->connect(array(
			'hostname' => $FTP["FTP_SERVER{$PBX}"],
			'port' => $FTP["FTP_PORT{$PBX}"],
			'username' => $FTP["FTP_USER{$PBX}"],
			'password' => $FTP["FTP_PASSWORD{$PBX}"]
		));
		
		if( ($this -> Ftp->_is_conn()!=FALSE) 
			&& (isset($voice['file_voc_loc'])) )
		{
			$_found   = null;
			$this->Ftp->changedir($voice['file_voc_loc']); 
			
			$_ftplist = $this -> Ftp -> list_files('.');
			foreach($_ftplist as $k => $src )
			{
				if( ($src == $voice['file_voc_name'])) {
					$_found = $src;
				}
			}
			
		/** def location to local download **/
		
			if(!defined('RECPATH') ) 
				define('RECPATH',str_replace('system','application', BASEPATH)."temp");
				
		/** if match fil then download **/
		
			if( !is_null($_found) )
			{
				$_original_path = RECPATH;
				if($this -> Ftp -> download(RECPATH . '/' . $_found, $_found))
				{	
					exec("sox {$_original_path}/{$_found} {$_original_path}/{$_found}.wav");
					$voice['file_voc_name'] = "{$_found}.wav";
					
					@unlink( $_original_path ."/". $_found );
					
					$_success = array('success'=>1, 'data' => $voice );
				}
			}
		}
	}
	
	
	}
	
	echo json_encode($_success);
	
} 



/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function VoicePlay()
{
	$success = array('success'=>0);
	
//----------- load all model ----------------------------
	
	$objConf =& get_class_instance('M_Configuration');
	$objQty  =& get_class_instance(base_class_model($this));
	$objOut  =new EUI_Object( _get_all_request() );
	$FTP  = new EUI_Object($objConf->_getFTP());	
	
	$row  = $objQty->_getVoiceResult($objOut->get_value('RecordId')) ;
	//print_r($row);
	
	
	$output =new EUI_Object( $row );
	if( !$output->fetch_ready() )  { 
		exit('Recording Not Found');
	}
	
	$this->load->library('Ftp');
	$PBX = (string)$this->M_Pbx->InstancePBX( $output->get_value('agent_ext') );
	
	$this->Ftp->connect(array(
		'hostname' 	=> $FTP->get_value("FTP_SERVER$PBX"),
		'port' 		=> $FTP->get_value("FTP_PORT$PBX"),
		'username' 	=> $FTP->get_value("FTP_USER$PBX"),
		'password' 	=> $FTP->get_value("FTP_PASSWORD$PBX")
	));
	
	
// -------------------------------------------------------------------------------------
	if( $this->Ftp->_is_conn() != TRUE ) {
		exit("Connection lost to {$output->get_value('PBX')}. please check FTP your service!");
	}
	
 //-------------------------------------------------------------------------------------
	
	if( $output->get_value('file_voc_loc','strlen') == 0  ){
		exit('File not found .');	
	}	
	
 //-------------------------------------------------------------------------------------
	
	$out_file_name = null;
	
	$this->Ftp->changedir( $output->get_value('file_voc_loc') );
	$arr_ftp_list = $this->Ftp->list_files('.');
	//print_r($this->Ftp);
	
	if(  is_array($arr_ftp_list) and count($arr_ftp_list) > 0 ) 
		foreach( $arr_ftp_list as $k => $src )
	{
		
		if( strcmp( $src, $output->get_value('file_voc_name')) == 0  ) 
		{
			$out_file_name = $output->get_value('file_voc_name');
		}
	}
	
 //-------------------------------------------------------------------------------------
	if( strlen($out_file_name)== 0  OR is_null($out_file_name) ){
		exit('File not found .');
	}	
	
	if( !defined('RECPATH') ){
		define('RECPATH',str_replace('system','application', BASEPATH)."temp");
	}	
	
	$path_original = RECPATH;
	$download = $this-> Ftp->download( join('/', array($path_original, $out_file_name)), $out_file_name);
	if( !$download ){
		exit('Failed to download file.');
	}
	
// -------------------------------------------------------------------------------------
	$file_original_wavs = str_replace("gsm","wav", $out_file_name);
	$file_original_gsm = join("/", array($path_original, $out_file_name));
	$file_original_wav = join("/", array($path_original, $file_original_wavs ));
	
	$_wavvoice  = preg_replace('/gsm/i','wav',$_found);
	$_wavvoice  = preg_replace('(_[0-9]+_)','_xxxxxxxx_',$_wavvoice);
	
	 if( file_exists( $file_original_wav ) )
	{ 
		@unlink($file_original_wav);	
	}	
	
	exec("sox $file_original_gsm $file_original_wav");
	$row['file_voc_name'] = $file_original_wavs;
	@unlink(join("/", array($path_original, $out_file_name)));
	
// -------------------------------------------------------------------------------------
	
	 if( is_array($row) and count($row) )
	{
		$this->load->view("mod_voice_data/view_voice_play", array( 'raw' => $row ) );
	}
}


// ---------------------- update Insured  on selected insured ID . ---

 public function UpdatePayer() 
{
 $conds = array('success' => 0 );
 $out = new EUI_Object( _get_all_request() );
 
 if( !$out->fetch_ready() ) {
	echo json_encode( $conds );
	return false;
 }
 
 
// ------------ call class ---------------------------------------
 
 $obClass =& get_class_instance('M_Payers');
 if( $obClass-> _UpdateDataPayers( $out ) ) {
	$conds = array('success' => 1); 
 }	 
 
 echo json_encode($conds);
  
}


// ---------------------- update Insured  on selected insured ID . ---

 public function UpdateInsured() 
{
 $conds = array('success' => 0 );
 $out = new EUI_Object( _get_all_request() );
 
 if( !$out->fetch_ready() ) {
	echo json_encode( $conds );
	return false;
 }
 
 
// ------------ call class ---------------------------------------
 
 $obClass =& get_class_instance('M_Insured');
 if( $obClass-> _UpdateDataInsured( $out ) ) {
	$conds = array('success' => 1); 
 }	 
 
  echo json_encode($conds);	
  
}



//UpdateBenefiacery
public function UpdateBenefiacery() 
{

  $_conds = array('success' => 0 );
	$BeneficiaryId = $this -> URI->_get_array_post('BeneficiaryId');
	if( $param = $this -> URI->_get_all_request() 
		AND is_array($BeneficiaryId) )
	{
		$n = 0;
		foreach( $BeneficiaryId as $key => $num )
		{
			$_SET_POST['GenderId'] = $param["BenefGender_{$num}"];
			$_SET_POST['SalutationId'] = $param["BenefSalutationId_{$num}"];
			$_SET_POST['BeneficiaryDOB'] = date('Y-m-d',strtotime($param["BeneficiaryDOB_{$num}"]));
			$_SET_POST['BeneficiaryFirstName'] = $param["BeneficiaryFirstName_{$num}"];
			$_SET_POST['RelationshipTypeId'] = $param["BenefRealtionship_{$num}"];
			$_SET_POST['BeneficiaryAge'] = $param["BeneficiaryAge_{$num}"];
			$_SET_POST['BeneficiaryUpdatedTs'] = date('Y-m-d H:i:s');
			$_SET_POST['BeneficiaryId'] = $num;
			if( $res= $this -> M_Benefiecery -> _UpdateDataBeneficiary($_SET_POST) ){
				$n++;
			}
		}	
		if( $n > 0 ) {
			$_conds = array('success' => 1);
		}	
	}	
	
  __(json_encode($_conds));	
}

// ------------------------------------------------------------------------------
/*
 * @ package  Interested by Handle Random 
 */ 
 
function Interested(){ 
	echo json_encode(array('count' => 0));
} 

}
?>