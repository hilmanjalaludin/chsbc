<?php

/*
 * E.U.I 
 *
 
 * subject	: get SetCampaign modul 
 * 			  extends under EUI_Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/sysuser/
 */
 
class SetCampaign extends EUI_Controller
{
	
/*
 * EUI :: index() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
 
 function __construct() {
	parent::__construct();
	$this->load->model(array("M_SetCampaign","M_Utility","M_SetUpload","M_ModOutBoundGoal","M_SetProduct","M_SysUser"));
	$this->load->helper(array('EUI_Object'));
 }
 
/*
 * EUI :: index() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
 
function index()
{

 if( $this -> EUI_Session -> _have_get_session('UserId'))
 {
	$EUI['page'] = $this -> M_SetCampaign -> _get_default();
	$this -> load -> view('set_campaign/view_campaign_nav', $EUI );
 }
 
}

/*
 * EUI :: Content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */

function Content()
{
 if( $this -> EUI_Session -> _have_get_session('UserId'))
 {
	$EUI['page'] = $this->{base_class_model($this)}->_get_resource_query(); // load content data by pages 
	$EUI['num']  = $this->{base_class_model($this)}->_get_page_number(); 	// load content data by pages 
	$EUI['size'] = $this->{base_class_model($this)}->_get_size_campaign();
	
	$this -> load -> view('set_campaign/view_campaign_list', $EUI );
 }
}

/*
 * EUI :: Content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
	
function Add()
{
	if(!_have_get_session('UserId') )  {
		return false;
	}
	$this->load->view('set_campaign/view_campaign_add',array());
}


/*
 * EUI :: Content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
	
 public function Edit()
{	
	if(!_have_get_session('UserId'))  {
		return false;	
	}
	
	$vars =new EUI_Object( _get_all_request() );
	if( !$vars->fetch_ready() ) { return false; }
	
 // ------------------ sent output data to view --------------------------------------------------------
 
	$objRes =& get_class_instance('M_SetCampaign');
	$objPro =& get_class_instance('M_SetProduct');
	
 // ------------------ sent output data to view --------------------------------------------------------
	
	$CampaignList = $objRes->getAttribute( $vars->get_value('CampaignId') );
	$ProductList = $objPro->_getProductCampaignId($vars->get_value('CampaignId'));
	$PayTypeList = $objPro->_getCampaignChannel($vars->get_value('CampaignId'));
	
 // ------------------ sent output data to view --------------------------------------------------------
  
	$this -> load -> view('set_campaign/view_campaign_edit', array(
		'row' => new EUI_Object($CampaignList),
		'ProductList' => $ProductList,
		'PaymentList' => $PayTypeList
	));
	
	//'Utility'=> $this -> M_Utility,
		//'OutboundGoals' => $this ->M_ModOutBoundGoal->_getOuboundGoals(),
		//'ProductCampaign' => $this->M_SetProduct->_getProductCampaignId($this -> URI->_get_post('CampaignId')),
		//'Campaign' => $objRes->getAttribute(_get_post('CampaignId'))
		// 'Action' => $this->{base_class_model($this)}->_getMethodAction(), 
		// 'Method' => $this->{base_class_model($this)}->_getMethodDirection(),
		// 'Avail' => $this->{base_class_model($this)}->_getCampaignGoals(2),
		//'PaymentChannelList' => $this->M_SetProduct->_getCampaignChannel($this -> URI->_get_post('CampaignId'))
	//));
}

/*
 * EUI :: Content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
	
function EditTarget()
{
	if( $this -> EUI_Session -> _have_get_session('UserId')) 
	{
		//$alias_str_list = $this->M_SetCampaign->_getAliasFieldList($this -> URI->_get_post('CampaignId'));
		$UI = array
		(
			'Campaign' => $this->{base_class_model($this)}->getAttribute( $this -> URI->_get_post('CampaignId')),
			'Target' => $this->{base_class_model($this)}->getTarget( $this -> URI->_get_post('CampaignId'))
		); 
		$this -> load -> view('set_campaign/view_campaign_target',$UI);

	}
}

/*
 * EUI :: Content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */

 public function SaveTarget()
{
	$_conds = array("success"=>0);
	$param = $this -> URI -> _get_all_request();
	if( isset( $param ) AND count($param) > 0 ) 
	{
		if( $this->{base_class_model($this)}->set_save_event_target( $param ) )
		{
			$_conds = array("success" => 1);
		}
	}
	
	echo json_encode($_conds);
}

/*
 * EUI :: Content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */

function View()
{
	$_post_data = $this -> URI -> _get_array_post("CampaignId");
	if(is_array($_post_data)) 
	{
		$data = array("result" => $this ->{base_class_model($this)}-> _getDataCampaignId($_post_data) );
		$this -> load -> view('set_campaign/view_campaign_views',$data);
	}
}


/*
 * EUI :: Content() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */

function Manage()
{
	if( $this -> EUI_Session -> _have_get_session('UserId')) {
		$UI = array
		(
		'Method' => $this->{base_class_model($this)}->_getMethodDirection(),
		'AvailOut' => $this->{base_class_model($this)}->_getCampaignGoals(2),
		'AvailIn' => $this->{base_class_model($this)}->_getCampaignGoals(1)
		); 
		$this -> load -> view('set_campaign/view_manage_campaign',$UI);
	}
}


/*
 * EUI :: Export() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
	
	
function Export()
{

 $_post_data = $this -> URI -> _get_array_post("CampaignId");
 
 if(is_array($_post_data) AND is_array($_post_data))
 {
	$data = array("result" => $this ->{base_class_model($this)}-> _getDataCampaignId($_post_data) );
	$this -> load -> view('set_campaign/view_campaign_export',$data);
 }
 
}


/*
 * EUI :: SaveCampaign() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
	
 public function Update()
{
	
 $cond = array('success'=> 0, 'error'=> ''); 
 if( !_have_get_session('UserId') ) { 
	return false;	
 }
	
// -------------------------------------------------------------- 	

  $obj =& get_class_instance('M_SetCampaign');
  $out =new EUI_Object( _get_all_request() );
 
  if( $obj->_set_event_update_campaign( $out ) ){
	 $cond = array('success'=> 1 ); 	
  }
  
  echo json_encode($cond);
}


/*
 * EUI :: SaveCampaign() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
	
 public function Submit()
{
	
 $cond = array('success'=> 0, 'error'=> ''); 
 if( !_have_get_session('UserId') ) { 
	return false;	
 }
	
// -------------------------------------------------------------- 	

  $obj =& get_class_instance('M_SetCampaign');
  $out =new EUI_Object( _get_all_request() );
 
  if( $obj->_set_save_campaign( $out ) ){
	 $cond = array('success'=> 1 ); 	
  }
  
  echo json_encode($cond);
}


/*
 * EUI :: SaveCampaign() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
 
 public function Delete()
{
  
  $cond = array('success'=> 0, 'error'=> ''); 
  if( !_have_get_session('UserId') ) { 
	return false;	
  }
	
// -------------------------------------------------------------- 	

  $obj =& get_class_instance('M_SetCampaign');
  $out =new EUI_Object( _get_all_request() );
 
  if( $obj->_set_event_delete_campaign( $out ) ){
	 $cond = array('success'=> 1 ); 	
  }
  
  echo json_encode($cond);
}	

/*
 * EUI :: getDataInbound() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
	
function getDataInbound()
{
	$_success = array('success'=> 0, 'data'=> 0 ); 
	
	if( $this -> EUI_Session->_have_get_session('UserId'))
	{
		$data = $this -> {base_class_model($this)}->_getDataInbound($this -> URI->_get_post('CampaignId'));
		if( !is_null($data) 
			AND (INT)$data > 0 )
		{
			$_success = array('success'=> 1, 'data'=> $data ); 
		}	
	}
	
	echo json_encode($_success);
}

/*
 * EUI :: ManageCampaign() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */
function ManageCampaign()
{
	$_success = array('success'=> 0); 
		
	if( $this -> EUI_Session->_have_get_session('UserId'))
	{
		$parameter = $this->URI->_get_all_request();
		if( is_array($parameter))
		{
			$jumlah = $this->{base_class_model($this)}->_setManageCampaign($parameter);
			
			if($jumlah)
			{
				$_success = array('success'=>1, 'data' => $jumlah);
			}
		}	
	}
	
	echo json_encode($_success);
}

function DownloadTemplate()
{
	if( $this -> URI -> _get_have_post('CampaignId'))
	{
		$cmp_id		= $this->URI->_get_post('CampaignId');
		$cmp_ref	= $this->{base_class_model($this)}->_get_cmp_ref($cmp_id);
		
		$tmp_result = $this ->M_SetUpload-> _get_name_template($cmp_ref['TemplateId']);
		
		$data = array
		(
			'template' => $this ->M_SetUpload-> _get_download_template($cmp_ref['TemplateId']),
			'filename' => $tmp_result['TemplateName'],
			'filetype' => $tmp_result['TemplateFileType'],
			'sparator' => $tmp_result['TemplateSparator'],
		);
		
		if($tmp_result['TemplateFileType']=='txt')
			$this -> load -> view('set_temp_upload/view_download_data_txt',$data);
		else{
			$this -> load -> view('set_temp_upload/view_download_data_xls',$data);
		}	
	}
	else{
		show_error("No have template ID ");
	}
}

/*		SECTION PDS		*/
/*
 * (F) campaignPds  [list campaign PDS]
 */
function campaignPds()
{
	if( $this->EUI_Session->_have_get_session('UserId'))
 	{
		$EUI['page'] = $this->M_SetCampaign->_get_default_pds();
		$this->load->view('set_campaign_pds/view_campaign_nav', $EUI );
 	}
}

/*
 * (F) addPds [view add form campaign PDS]
 */
function addPds()
{
	if(!_have_get_session('UserId') )  {
		return false;
	}
	
	$ListSPV = $this->M_SysUser->_get_supervisor();
	
	$this->load->view('set_campaign_pds/view_campaign_add',array("ListSPV"=>$ListSPV));
}


public function submitPds()
{
 	$cond = array('success'=> 0, 'error'=> ''); 
 	if( !_have_get_session('UserId') ) { 
		return false;	
 	}
	
  	$obj =& get_class_instance('M_SetCampaign');
  	$out =new EUI_Object( _get_all_request() );
  	// var_dump( $out ); die();
  	if( $obj->_set_save_campaign_PdS( $out ) ){
		$cond = array('success'=> 1 ); 	
  	}
  	echo json_encode($cond);
}


function ContentPds()
{
	if( $this->EUI_Session->_have_get_session('UserId'))
	{
		$EUI['page'] = $this->M_SetCampaign->_get_resource_query_pds(); // load content data by pages 
		$EUI['num']  = $this->M_SetCampaign->_get_page_number(); 	// load content data by pages 
		// $EUI['size'] = $this->{base_class_model($this)}->_get_size_campaign();
		
		$this->load->view('set_campaign_pds/view_campaign_list', $EUI );
	}
}


public function checkStatusPds()
{
	$cond = array('status'=>0); 
	$obj =& get_class_instance('M_SetCampaign');
	$out =new EUI_Object( _get_all_request() );
	$status = $obj->_getcheckStatusPds( $out );
	if( count($status) > 0 ) {
		$cond   = array('status'=> $status['StatusRunning'] ); 	
	}
  	echo json_encode($cond);	
}

public function ClearCmpPds()
{
	$cond = array('status'=>0); 
	$obj =& get_class_instance('M_SetCampaign');
	$out =new EUI_Object( _get_all_request() );
	$status = $obj->_ClearCmpPds( $out );
	if( $status ) {
		$cond   = array('status'=> 1 ); 	
	}
  	echo json_encode($cond);
}

public function ClearAgentPds()
{
	$cond = array('status'=>0); 
	$obj =& get_class_instance('M_SetCampaign');
	$out =new EUI_Object( _get_all_request() );
	$status = $obj->_ClearAgentPds( $out );
	if( $status ) {
		$cond   = array('status'=> 1 ); 	
	}
  	echo json_encode($cond);
}


public function setStatusPds()
{
	$result 		 = array('success' => 0, 'msg'=> 'Invalid PDS');
	$PDS_SERVER_HOST = PDS_SERVER_HOST;
	$PDS_SERVER_PORT = PDS_SERVER_PORT;

	$obj    =& get_class_instance('M_SetCampaign');
	$outs   =new EUI_Object( _get_all_request() );
	$runningCount = $obj->getPDSRunnnigCount( $outs );
	$id     = (int)$outs->get_value('CampaignId');
	$status = (int)$outs->get_value('Status');
	$msg    = array();
	
	// if($runningCount>0 and $status == 1){
		// $result = array('success' => 0, 'msg'=> 'PDS sudah pernah dijalankan!');
		// echo json_encode( $result );
		// die();
	// }
	
	if( $status == 0 ) {
		// STOP
		$out  = "Command: Stop Campaign\r\n";
		$msg  = 'CLICK STOP';
	}
	if( $status == 1 ) {
		// RUNNING
		$out  = "Command: Start Campaign\r\n";
		$msg  = 'CLICK START';
	}
	if( $status == 2 ) {
		// RUNNING
		$out  = "Command: Pause Campaign\r\n";
		$msg  = 'CLICK PAUSE';
	}

	$fp = fsockopen($PDS_SERVER_HOST, $PDS_SERVER_PORT, $errno, $errstr, 30);
	if (!$fp) {
		echo "$errstr ($errno) <br />\n";
		$msgf = "$errstr ($errno) !";
		echo "Invalid Connect Socket <br />\n";
		$result = array('success' => 0, 'msg'=> $msgf);
	} else {
		echo "success {$msg} <br />\n"; echo $out;

		$out .= "CampaignId: $id\r\n";
		$out .= "\r\n";
		fwrite($fp, $out);
		$res =  fgets($fp, 255);
		fclose($fp);

		// insert table
		$ress = $obj->_setStatusPds( $outs );
	}
	
	if( $ress ) {
		$result = array('success' => 1, 'msg'=> 'Success PDS');
	}
	
	echo json_encode( $result );
	// return $ress;
}

public function editPds()
{	
	if(!_have_get_session('UserId')) {
		return false;	
	}
	
	$vars =new EUI_Object( _get_all_request() );
	if( !$vars->fetch_ready() ) { return false; }
	
	$objRes =& get_class_instance('M_SetCampaign');
	
	$CampaignList   = $objRes->getAttribute( $vars->get_value('CampaignId') );
	$dataCampaignPds= $objRes->_getDataCampaignPds( $vars );
	$GroupList 		= $objRes->_getGroupCampaignPds($vars );
	$ListSPV 		= $this->M_SysUser->_get_supervisor();
	$ListedSPV 		= $objRes->get_current_assigned_pds_spv($vars->get_value('CampaignId') );
	$CallPreList    = $this->callPrefaranceList( $dataCampaignPds );
	
	// print_r($ListedSPV);
	// $objPro =& get_class_instance('M_SetProduct');
	// $ProductList = $objPro->_getProductCampaignId($vars->get_value('CampaignId'));
	// $PayTypeList = $objPro->_getCampaignChannel($vars->get_value('CampaignId'));
	
	$this->load->view('set_campaign_pds/view_campaign_edit', array(
		'row' 		  		 => new EUI_Object($dataCampaignPds),
		'GroupList'   		 => $GroupList,
		'CallPreList' 		 => $CallPreList,
		'ListSPV' 		 	 => $ListSPV,
		'ListedSPV' 		 => $ListedSPV
	));
}

public function updatePds()
{
	$cond = array('success'=> 0, 'error'=> ''); 
 	if( !_have_get_session('UserId') ) { 
		return false;	
 	}
	
  	$obj =& get_class_instance('M_SetCampaign');
  	$out =new EUI_Object( _get_all_request() );
  	// var_dump( $out ); die();
  	if( $obj->_set_event_update_campaign_pds( $out ) ) {
  		$cond = array('success'=> 1 ); 	
  	}
  	echo json_encode($cond);
}


public function callPrefaranceList( $params )
{
	$result = array();
	if( !is_array($params) ) {
		return $result;
	}

	$data = array(
		'1' => 'Mobile Phone',
		'2' => 'Home Phone',
		'3' => 'Work Phone');
	$call = explode(",", $params['CallPreference'] );
	foreach ($call as $value) {
		if ( array_key_exists($value, $data) )
		{
			$result[$value] = $data[$value];
		}
	}
	// var_dump($result); die();
	return $result;
}
	
}
 // ================ END CLASS =========================

?>