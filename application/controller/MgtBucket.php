<?php


// ini_set("error_reporting", 1);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors',1);
// error_reporting(E_ALL);

/*
 * E.U.I 
 *
 
 * subject	: get SetCampaign modul 
 * 			  extends under EUI_Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysuser/
 */
 
if(!defined( 'EXCEL' )) define('EXCEL','XLS');
if(!defined( 'TEXT' ))  define('TEXT','TXT');

 
class MgtBucket extends EUI_Controller
{
	
/*
 * EUI :: __constructor() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
 
public function __construct() 
{
	parent::__construct();
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object'));
 }
 
  /*
 * EUI :: getCampaignName() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	

function SaveByCheckedATM()
{	
	$_success = array('success'=>0, 'mesages' => '0');
		
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{ 
		$post = array (
			'CampaignId' => $this -> URI->_get_post('campaign_id'),
			'BucketId' => $this -> URI -> _get_array_post('ftp_list_id'),
			'atm'=>	$this -> URI->_get_post('atm')
		);
		
		if(class_exists('M_ModDistribusi'))
		{
			// $total_data = $this ->M_ModDistribusi ->_setDistribusi($post,'saveByChecked');
			$total_data = $this ->M_ModDistribusi ->_setDistribusi($post,'SaveByCheckedATM');
			if( $total_data > 0 )
			{
				$_success = array('success'=>1, 'mesages' => $total_data );
			} 
		}
	}
	
	echo json_encode($_success);
	
}
 
 
function getCampaignName()
{
	$datas = array();
	if(class_exists('M_SetCampaign') )
	{
		$datas = $this -> M_SetCampaign -> _get_campaign_name();
	}
	
	echo json_encode($datas);
		
}


function getATMName()
{
 	$datas = array();
	if(class_exists('M_User') )
	{
		$datas = $this -> M_User -> _getATM();

	}
	echo json_encode($datas);
 } 
 
 /*
 * EUI :: index() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
 
public function index() 
{
	$oClass =& get_class_instance(base_class_model($this)); 
	$this->load->view("mgt_bucket_data/view_bucket_nav", array 
	(
		'WorkArea' 	=> $this->M_WorkArea->_get_branch_work(),
		'Filename' 	=> $this->M_ModViewUpload->_getModFilename(),
		'page'		=> $oClass->_get_default()
	));
 }
 
/*
 * EUI :: Content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
 
public function Content() 
{
	$oClass =& get_class_instance(base_class_model($this));
	if(_have_get_session('UserId') )
	{
		$this->load->view("mgt_bucket_data/view_bucket_list", array(
			'page' => $oClass->_get_resource(),
			'num'  => $oClass->_get_page_number()	
		));	
	}	
}
 

/*
 * EUI :: UploadBucket() 
 * -----------------------------------------
 *
 * @ def		will process on modul upload only 
 * @ param		not assign parameter
 */	

private function _getFileName()
{ 
	$_name = null; $_data = explode('.',$_FILES['fileToupload']['name'] );
	if(is_array($_data) )
	{
		$_name = strtoupper( $_data[count($_data)-1] );
	}
	
	return $_name;
} 

/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 
 * @update 	2017/07/06 
 * @auth 	omen 
 
 */

function UploadBucket()
{
	// var_dump( "DEBUG"); die();
  // pre define all object variable on modul bucket upload 
  // for properies .
  $this->success 	= 1;  
  $this->failed 	= 0;
  
  // pre define all object variable on modul bucket upload 
  // for properies .
  $this->fls = FL(); $this->out = UR();  $this->cok = CK();	
  // pre define all object variable on modul bucket upload 
  // for properies .
  $this->ar_val_extn = array( EXCEL, TEXT );
  $this->ar_val_data = $this->out->get_value();
  $this->ar_val_file = $this->fls->get_value();
 
  // nilai default untuk setiap process upload 
  $this->callbackMsg = array('success' => $this->failed, 'mesages'=> 'File Not Found');
	
  // ubah variable array ke bentuk object 	untuk 
  // di process lebih lanjut.
  $this->stm = $this->fls->field('fileToupload', 'Objective');
   
   // cek validation 
   // if( is_object( $this->fls ) and ( !$this->stm->find_value('name') OR !$this->out->find_value('CampaignId')  OR !$this->out->find_value('recsource') OR !$this->out->field('recsource','strlen') ))
   if( is_object( $this->fls ) and ( !$this->stm->find_value('name') OR !$this->out->find_value('CampaignId') ))
   {
	   $this->callbackUpl = 'Form upload not complete.';	
	   $this->callbackMsg = array( 'success' => $this->failed, 'mesages' => $this->callbackUpl);	
	   printf('%s', json_encode( $this->callbackMsg) );
	   return FALSE;
   }

 
  // panggil modul template untuk process cek file 
  // berdasarkan template .
  $this->upl =& Singgleton('M_Upload');
  $this->tpl =& Singgleton('M_Template');
  
  // get detail row of template . 
  $this->cmp = $this->tpl->_get_template_by_campaign( $this->out->field('CampaignId') );
  
  // cek apakah data berisi array ?
  if( !is_array( $this->cmp ) ){
	printf('%s', json_encode( $this->callbackMsg) );
	return false;
  }

 // next process berikutnya . convert data ke dalam bentuk object 
 // class helper.
 $this->tpo = Objective( $this->cmp );
 if( !$this->tpo->find_value('TemplateId') ){
	printf('%s', json_encode( $this->callbackMsg) );
	return false;
 }

  // ambil detail template -nya && extension yang di maksud oleh 
  // data upload .
  $this->tdb = $this->tpl->_getDetailTemplate( $this->tpo->field('TemplateId') );
  $this->ext = $this->_getFileName();
  
  // ambil detail template -nya && extension yang di maksud oleh 
  // data upload .  
  $this->tpd = Objective( $this->tdb); 
  
  // cek validation dari extension file tersebut  
  if( is_null( $this->ext ) ){
	printf('%s', json_encode( $this->callbackMsg) );
	return false;
  }
  
  // lanjut ke process berikutnya . this will default of message callbackUpl
  $this->callbackUpl = null;
 
  // jika bukan ke 2 type file ini.
  if( !in_array( $this->ext,  $this->ar_val_extn ) ) 
  {
	 $this->callbackUpl = 'File extension no suported.';
	 $this->callbackMsg = array('success' => $this->failed, 'mesages' => $this->callbackUpl );
	 
	 // return 
	 printf('%s', json_encode( $this->callbackMsg) );
	 return false;
  }
  
  // jika data yang akan di upload tidak masuk terlebih dahule ke table
  // bucket customer melainkan ke table yang sudah di tentukan oleh user .
  if( $this->tpd->find_value('TemplateBucket') and (  !strcmp($this->tpd->field('TemplateBucket'), 'N') OR !strcmp($this->tpd->field('TemplateBucket'), 'Y') ) )  
  {
	// #var_dump( "DEBUG"); die();
	// set parameter tambahan disini .
	$this->param = array( 'CampaignId' => $this->out->field('CampaignId'),
						  'recsource'  => $this->out->field('recsource'),
						  'TemplateId' => $this->tpo->field('TemplateId'));
							
	// kemudian akan di sesuikan berdasarkan kondisi 
	// berikut ini. INSERT|UPDATE
	$this->tpm = $this->tpd->field('TemplateMode','strtoupper'); /*var_dump($this->tpm);die();*/
	// jika kondisi yang di minta adalaha insert 
	// ketable yang dimaksud.
// 	$this->upl =& Singgleton('M_Upload');
//   $this->tpl =& Singgleton('M_Template');

	if(!strcmp( $this->tpm, 'INSERT')) {
		// echo "masuk sini";
		// die;
		$this->callbackUpl = $this->upl->setInsertUpload( 
							 array( 'file_attribut' => $this->ar_val_file, 'request_attribut' => $this->param ), 
							 array( 'Upload_DateTs' => date('Y-m-d H:i:s'), 'Upload_ById'     => $this->cok->field('UserId')));
		
		$this->callbackMsg = array( 'success' => $this->success, 'mesages' => $this->callbackUpl );		
	} 	
	
	// jika kondisi yang di minta adalaha insert 
	// ketable yang dimaksud.
	if(!strcmp( $this->tpm, 'UPDATE')) {
		$this->callbackUpl = $this->upl->setUpdateUpload( 
							 array( 'file_attribut' => $this->ar_val_file, 'request_attribut' => $this->param ), 
							 array( 'Upload_DateTs' => date('Y-m-d H:i:s'), 'Upload_ById'     => $this->cok->field('UserId')));
		
		$this->callbackMsg = array( 'success' => $this->success, 'mesages' => $this->callbackUpl );	
	}
		
 }
  
  // return callbackMsg 
	printf('%s', json_encode( $this->callbackMsg ) );
	return false;
	
 }
 /**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
 function ManualUpload()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$Template = array('Template' => $this -> {base_class_model($this)} ->_get_template() );
		$this -> load -> view("mgt_bucket_data/view_bucket_upload", $Template);
	}	
 }
 
// ----------------------------------------------------------------------------------
/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
  
public function saveByAmount()
{
// -------- call object -------------------
	$out =new EUI_Object( _get_all_request() );
	
	$_success = array('success'=>0, 'mesages' => '0');
	if( !$out->fetch_ready() ){
		echo json_encode( $_success );
		return false;	
	}
	
// -------------------------next off process data distribute ----------------------------------

	$vars_array = array 
  (
		'AmountSize' 	=> $out->get_value('amount_size'),  
		'AmountAssign' 	=> $out->get_value('amount_assign'),  
		'AssignStatus' 	=> $out->get_value('assign_status'),  
		'CampaignId' 	=> $out->get_value('campaign_name'), 
		'FilenameId' 	=> $out->get_value('fileupload'), 
		'StartDate' 	=> $out->get_value('start_date'),  
		'EndDate' 		=> $out->get_value('end_date') 
	);
	
// ---------- if class Exist from this ---------------------------------------------------
	
	if(class_exists('M_ModDistribusi'))
	{
		$objClass =& get_class_instance('M_ModDistribusi');
		$message= $objClass->_setDistribusi($vars_array ,'saveByAmount');
		
		if( !is_null($message) OR is_array($message) ) {
			$_success = array('success'=>1, 'mesages' => $message );
		} 
	}
	
	echo json_encode($_success);
}

// ----------------------------------------------------------------------------------

/*
 * @ package 		distribute from bucket saveByAmount() 
 *
 * @ def			function get detail content list page 
 * @ param			not assign parameter
 */	
  
  
public function saveByAmountATM()
{
	$_success = array('success'=>0, 'mesages' => '0');
	
	$post = array
	(
		'AmountSize' => ($this -> URI->_get_have_post('amount_size') ? $this -> URI->_get_post('amount_size') : false ),
		'AmountAssign' => ($this -> URI->_get_have_post('amount_assign') ? $this -> URI->_get_post('amount_assign') : false ),
		'AssignStatus' => ($this -> URI->_get_have_post('assign_status') ? $this -> URI->_get_post('assign_status') : false ),
		'CampaignId' => ($this -> URI->_get_have_post('campaign_name') ? $this -> URI->_get_post('campaign_name') : false ),
		'FilenameId' => ($this -> URI->_get_have_post('fileupload') ? $this -> URI->_get_post('fileupload') : false ),
		'StartDate' => ($this -> URI->_get_have_post('start_date') ? $this -> URI->_get_post('start_date') : false ),
		'EndDate' => ($this -> URI->_get_have_post('end_date') ? $this -> URI->_get_post('end_date') : false ),
		'atm' => ($this -> URI->_get_have_post('atm') ? $this -> URI->_get_post('atm') : false )
	);
	
	if(class_exists('M_ModDistribusi'))
	{
		$total_data = $this ->M_ModDistribusi ->_setDistribusi($post,'saveByAmountATM');
		if( $total_data > 0 )
		{
			$_success = array('success'=>1, 'mesages' => $total_data );
		} 
	}
	
	echo json_encode($_success);
}

 
/*
 * EUI :: SaveByChecked() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	

function SaveByChecked()
{	
	$_success = array('success'=>0, 'mesages' => '0');
		
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{ 
		$post = array (
			'CampaignId' => $this -> URI->_get_post('campaign_id'),
			'BucketId' => $this -> URI -> _get_array_post('ftp_list_id')	
		);
		
		if(class_exists('M_ModDistribusi'))
		{
			$total_data = $this ->M_ModDistribusi ->_setDistribusi($post,'saveByChecked');
			if( $total_data > 0 )
			{
				$_success = array('success'=>1, 'mesages' => $total_data );
			} 
		}
	}
	
	echo json_encode($_success);
	
}
/**
 * @author BAP
 * (F) resultUpload
 */
public function resultUpload() 
{
	$oClass =& get_class_instance(base_class_model($this)); 
	$this->load->view("mgt_result_upload/view_bucket_nav", array (
		// 	'WorkArea' 	=> $this->M_WorkArea->_get_branch_work(),
			'Filename' 	=> $this->M_ModViewUpload->_getModFilenameUpload(),
		// 	'page'		=> $oClass->_get_default()
		)
	);
}

public function downloadUploadInvalid()
{
	$objClass =& get_class_instance('M_MgtBucket');
	if( $this->URI->_get_have_post('TemplateId') )
	{
		$params = array(
			'data' => $objClass->_getUploadInvalid( $this->URI->_get_post('TemplateId') ),
			'mode' => $this->URI->_get_post('Mode')
		);
	
		$this->load->view('mgt_result_upload/view_upload_invalid',$params);
	} else{
		show_error("No have template ID ");
	}
}



 
}

?>