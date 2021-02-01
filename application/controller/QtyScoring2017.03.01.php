<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class QtyScoring extends EUI_Controller
{

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 public function QtyScoring() 
 {
	parent::__construct();
		$this->load->model(array(base_class_model($this) ));
 }
 
 
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
	// echo "<pre>";
	// print_r($_combo);
	// echo "</pre>";
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

 
function getAgentReady()
{
	$UserList = array();
	$UserState = $this -> _getCombo();
	
	if( $rows = $this -> {base_class_model($this)}->_getAgentReady())
	{
		foreach( $UserState['User'] as $UserId => $UserName )
		{
			if(in_array($UserId, array_keys($rows))){
				$UserList[$UserId] = $UserName;
			}	
		}
	}
return $UserList;
	
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
 if( $this ->EUI_Session ->_have_get_session('UserId') && class_exists('M_QtyScoring') )
 {
	$_EUI  = array( 
		'page' => $this->{base_class_model($this)} ->_get_default()
		//'Combo' => $this->_getCombo(),
		//'UserState' => $this->getAgentReady()
	);
	// echo "<pre>";
	// print_r($_EUI['Combo']);
	// echo "</pre>";
		// echo "IS NOT AN ARRAY";
	if( is_array($_EUI))
	{
		// echo "SCORING";
		$this -> load ->view('qty_approval_scoring/view_approval_scoring_nav',$_EUI);
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
 
public function Content()
{

  if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this ->{base_class_model($this)} ->_get_resource();    // load content data by pages 
		$_EUI['num']  = $this ->{base_class_model($this)}->_get_page_number(); // load content data by pages 
		$_EUI['quality'] = $this->M_SetResultQuality->_getQualityResult();
		
		// sent to view data 
		
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('qty_approval_scoring/view_approval_scoring_list',$_EUI);
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
	foreach($datas as $k => $rows ) {
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
 
public function QualityDetail()
{
	$CustomerId = $this ->URI->_get_post('CustomerId');
	$UI = array
	(
		'Customers' 	 => $this->M_SrcCustomerList->_getDetailCustomer($CustomerId),
		'Payers' 		 => $this->M_Payers->_getPayerReady($CustomerId),
		'Insured' 		 => $this->M_Insured->_getInsuredById($CustomerId),
		'Policy' 		 => $this->M_Payers->_getPayersInformation($CustomerId),
		'Benefiecery' 	 => $this->M_Benefiecery->_getBeneficiaryCustomerId($CustomerId),	
		'Phones' 		 => $this->M_SrcCustomerList->_getPhoneCustomer($CustomerId),
		'AddPhone' 		 => $this->M_SrcCustomerList->_getApprovalPhoneItems($CustomerId),
		'Callhistory' 	 => $this->LastCallHistory($CustomerId),
		'Product' 		 => $this->M_SrcCustomerList->_getAvailProduct($CustomerId),
		'ResultPoints' 	 => $this->M_QtyPoint->_getApprovalPoint($CustomerId),
		'QtyScoring' 	 => $this->M_QtyPoint->_getQualityScoring($CustomerId),
		'QualityScoring' => $this->M_QtyPoint->_getContentScoring(),
		'ComboScoring' 	 => $this->M_QtyPoint->_comboScoring(),
		'Assesment' 	 => $this->M_QtyPoint->_getAssesment(), 
		'CallCategoryId' => $this->M_SetResultCategory->_getOutboundCategory(),
		'CallResultId' 	 => $this->CallResultId(),
		'QualityApprove' => $this->QualityResult(),
		'Combo' 		 => $this->_getCombo()
	);
			
	// sen view 
	
	if($this ->URI->_get_have_post('CustomerId')) {
		$this -> load -> view('qty_approval_scoring/view_quality_detail',$UI);
	}
}


/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */


/**
[CustomerId] => 49
    [Status_Callmon] => SPV First Callmon
    [Name_Of_Agent] => TELE1_1
    [Agent_ID] => TELE1_1
    [Evaluator_Name] => System Root
    [Customer_Segment] => Premier
    [New_Skill] => Yes
    [PVC] => No
    [In_Academy] => Yes
    [Language] => Cantonese
    [Date_Of_Call] => 2016-07-28
    [Time_Of_Call] => 20:15:51
    [Date_Of_Evaluation] => 28-07-2016
    [Time_Of_Evaluation] => 20:23:22
    [Risk_Type] => High
    [Site] => jhb
    [Call_Type] => Call Type 2
    [In_Score] => Yes
    [Enter_New_Score] => 95
    
    [Section1_1] => Yes
    [Section1_2] => Yes
    [Section1_3] => Yes

    [Section2_1] => Outstanding
    [Section2_2] => Outstanding
    [Section2_3] => Outstanding
    [Section3_1] => Yes
    [Section3_2] => Yes
    [Section3_3] => Yes
    [Section3_4] => Yes
    [Section4_1] => Minor Error
    [Section4_2] => Yes
    [Section5_1] => Yes
    [General_Call_Feedback] => 

    [Rapport_Attr1] => Outstanding - R03
    [Rapport_Attr2] => Outstanding - R03
    [Rapport_Attr3] => Strong - R04
    [Rapport_Attr4] => Outstanding - R01
    [Rapport_Attr5] => Outstanding - R03
    
    [Ownership_Attr1] => Outstanding - R01
    [Ownership_Attr2] => Strong - R04
    [Ownership_Attr3] => Outstanding - R01
    [Ownership_Attr4] => Outstanding - R02
    [Ownership_Attr5] => Outstanding - R02
    
    [Communication_Attr1] => Outstanding - R02
    [Communication_Attr2] => Outstanding - R04
    [Communication_Attr3] => Outstanding - R03
    [Communication_Attr4] => Outstanding - R03
    [Communication_Attr5] => Outstanding - R01
    Remarks_Section3
**/
 
public function SaveScoreQuality()
{
$_conds = array('success' => 0);








  	

  //print_r(_get_all_request());
  $getAllPost = _get_all_request();

  if ( is_array($getAllPost) ) {
  		extract($getAllPost);
  		/**
  		$header_score  = isset($param["header_score"]) ? $param["header_score"] : null;
		$section1	   = isset($param["section1"])  ? $param["section1"] : null;
		$section2 	   = isset($param["section2"])  ? $param["section2"] : null;
		$section3 	   = isset($param["section3"])  ? $param["section3"] : null;
		$section4 	   = isset($param["section4"])  ? $param["section4"] : null;
		$section5 	   = isset($param["section5"])  ? $param["section5"] : null;
		$Rapport       = isset($param["Rapport"])   ? $param["Rapport"] : null;
		$Ownership     = isset($param["Ownership"]) ? $param["Ownership"] : null;
		$Communication = isset($param["Communication"]) ? $param["Communication"] : null;
		**/

		$getAllDataPost = array(
			"header_score" => array(
				"Name_Of_Agent" => $Name_Of_Agent , 
				"Agent_ID" 		=> $Agent_ID , 
				"Evaluator_Name" => $Evaluator_Name , 
				"Customer_Segment"	=> $Customer_Segment , 
				"New_Skill" => $New_Skill , 
				"PVC" => $PVC , 
				"In_Academy" => $In_Academy , 
				"Language" => $Language , 
				"Date_Of_Call" => $Date_Of_Call ,
				"Time_Of_Call" => $Time_Of_Call , 
				"Date_Of_Evaluation" => $Date_Of_Evaluation ,
				"Time_Of_Evaluation" => $Time_Of_Evaluation , 
				"Site" => $Site , 
				"Call_Type" => $Call_Type , 
				"Risk_Type" => $Risk_Type , 
				"In_Score" => $In_Score ,
				"Enter_New_Score" => $Enter_New_Score , 
				"TotalScore" => $TotalScore , 
				"General_Call_Feedback" => $General_Call_Feedback 
			) , 
			"section1" => array(
			    "Section1_1" => $Section1_1 ,
			    "Section1_2" => $Section1_2 ,
			    "Section1_3" => $Section1_3 
			) , 
			"section2" => array(
				"Section2_1" => $Section2_1 ,
			    "Section2_2" => $Section2_2 ,
			    "Section2_3" => $Section2_3
			) , 
			"section3" => array(
 				"Section3_1" => $Section3_1 , 
			    "Section3_2" => $Section3_2 , 
			    "Section3_3" => $Section3_3 , 
			    "Section3_4" => $Section3_4 
			) , 
			"section4" => array(
				"Section4_1" => $Section4_1 , 
			    "Section4_2" => $Section4_2  
			) , 
			"section5" => array(
 				"Section5_1" => $Section5_1
			) , 
			"Rapport" => array(
				"Rapport_Attr1" => $Rapport_Attr1 , 
			    "Rapport_Attr2" => $Rapport_Attr2 , 
			    "Rapport_Attr3" => $Rapport_Attr3 , 
			    "Rapport_Attr4" => $Rapport_Attr4 , 
			    "Rapport_Attr5" => $Rapport_Attr5 
			) , 	
			"Ownership" => array(
				"Ownership_Attr1" => $Ownership_Attr1 , 
			    "Ownership_Attr2" => $Ownership_Attr2 , 
			    "Ownership_Attr3" => $Ownership_Attr3 , 
			    "Ownership_Attr4" => $Ownership_Attr4 , 
			    "Ownership_Attr5" => $Ownership_Attr5 
			) , 
			"Communication" => array(
				"Communication_Attr1" => $Communication_Attr1 , 
			    "Communication_Attr2" => $Communication_Attr2 , 
			    "Communication_Attr3" => $Communication_Attr3 , 
			    "Communication_Attr4" => $Communication_Attr4 , 
			    "Communication_Attr5" => $Communication_Attr5
			) , 
			
			"ValueAllSection" => $ValueAllSection ,
			"CustomerId" => $CustomerId , 
			"Status_Callmon" => $Status_Callmon , 
			"Remarks_Section3" => $Remarks_Section3,
			"AgentSeller" => $AgentSeller
		);

		if( $this->{base_class_model($this)}->_setSaveScoreQuality($getAllDataPost)) {
			$_conds = array('success' => 1);
		} else {


			$_conds = array('success' => 0);
		}


  } else {
		$_conds = array('success' => 0);
  }
}


/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
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
		$this -> load -> view('qty_approval_scoring/view_quality_recording',$ListView);
	}
}

/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function CallHistory()
{
	$CallHistory = null;
	if( $this -> URI->_get_have_post('CustomerId') )
	{
		$CustomerId = $this -> URI->_get_post('CustomerId');
		if( $CustomerId )
		{
			$CallHistory= array('CallHistory' => $this->M_ModSaveActivity->_getCallHistory($CustomerId) );
		}
		
		$this -> load -> view("qty_approval_scoring/view_quality_history_content",$CallHistory);
	}
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
	$_success = array('success'=>0);
	
	// voice data by click user ...
	
	$voice  = $this -> {base_class_model($this)}->_getVoiceResult($this->URI->_get_post('RecordId') );
	
	// if exist data then cek in PBX Server ...
	if( is_array($voice) ) 
	{
		$this->load->library('Ftp');
		
	// set parameter attribute 
	
		$PBX = $this->M_Pbx ->InstancePBX($voice['agent_ext']);
		$this->Ftp->connect(array(
			'hostname' => $FTP["FTP_SERVER{$PBX}"],
			'port' => $FTP["FTP_PORT{$PBX}"],
			'username' => $FTP["FTP_USER{$PBX}"],
			'password' => $FTP["FTP_PASSWORD{$PBX}"]) );
	
	// cek connection ID 
		
		if( ($this -> Ftp->_is_conn()!=FALSE) 
			AND (isset($voice['file_voc_loc'])) )
		{
			$_found   = null;
			
		// change directory on server remote ...
		
			$this->Ftp->changedir($voice['file_voc_loc']); 
			
		// show file on spesific location ..
		
			$_ftplist = $this -> Ftp -> list_files('.');
			foreach($_ftplist as $k => $src )
			{
				if( ($src == $voice['file_voc_name'])) {
					$_found = $src;
				}
			}
			
		// def location to local download 
		
			if(!defined('RECPATH') ) 
				define('RECPATH',str_replace('system','application', BASEPATH)."temp");
				
		// if match fil then download 
		
			if( !is_null($_found) ) {
				if($this -> Ftp -> download(RECPATH . '/' . $_found, $_found ) ) {
					$_success = array('success'=>1, 'data' => $voice );
				}
			}
		}
	}
	
	echo json_encode($_success);
}

 
}