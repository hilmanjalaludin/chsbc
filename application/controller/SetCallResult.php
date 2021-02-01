<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for SysUser 
 * 			  extends under Controller class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/controller/sysuser/
 */
 
class SetCallResult extends EUI_Controller
{


 
/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 function __construct() {
	parent::__construct();
	$this -> load -> model( array(base_class_model($this),'M_SetResultCategory'));
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
	if( $this ->EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> {base_class_model($this)} -> _get_default();
		if( is_array($_EUI) ) 
		{
			$this -> load -> view('set_result_call/view_result_call_nav',$_EUI);
		}	
	}	
 }
 
/*
 * @ def 		: content / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function Content()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$_EUI['page'] = $this -> {base_class_model($this)} -> _get_resource();    // load content data by pages 
		$_EUI['num']  = $this -> {base_class_model($this)} -> _get_page_number(); // load content data by pages 
		if( is_array($_EUI) && is_object($_EUI['page']) )  
		{
			$this -> load -> view('set_result_call/view_result_call_list',$_EUI);
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

 function SetActive()
 {
	$_conds = array('success' => 0 );
	
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this->{base_class_model($this)}->_setActive(
			array( 
				'CallReasonId' => $this -> URI -> _get_array_post('CallResultId'),
				'Active' => $this -> URI -> _get_post('Active') 
			)
		)) 
		{	
			$_conds = array('success' =>1);	
		}	
		
	}
	
	echo json_encode($_conds);
 }
 

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */

function getReasonCategoryId()
{
	$Inbound  = $this ->M_SetResultCategory ->_getInboundCategory(); 
	$Outbound = $this ->M_SetResultCategory ->_getOutboundCategory();
	
	$CallCategory = array();
	
	foreach( array( $Inbound,$Outbound ) as $keys => $values )
	{
		if(is_array($values))
		{
			foreach($values as $CallCategoryId => $CallCategoryName ){
				$CallCategory[$CallCategoryId] = $CallCategoryName; 
			}
		}
	}
	
	return $CallCategory;
}  

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
function _getOrders()
{
	$_conds = array();
	
	if(class_exists('M_SetResultCategory'))
	{
		$_conds = $this ->M_SetResultCategory ->_getOrder(200);
	}	
	
	return $_conds;
}

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function SaveCallResult()
{
	$_conds = array('success' => 0 );
	
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this->{base_class_model($this)}->_setSaveCallResult( $this->URI->_get_all_request())) 
		{	
			$_conds = array('success' =>1);	
		}	
		
	}
	
	echo json_encode($_conds);
}

/*
 * @ def 		: index / Delete
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function UpdateCallResult()
{
	$_conds = array('success' => 0 );
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this->{base_class_model($this)}->_setUpdateCallResult( $this->URI->_get_all_request())) 
		{	
			$_conds = array('success' =>1);	
		}	
		
	}
	
	echo json_encode($_conds);
}

/*
 * @ def 		: index / Delete
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function Delete()
{
	$_conds = array('success' => 0 );
	
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		if( $this->{base_class_model($this)}->_setDeleteCallResult( $this->URI->_get_array_post('CallResultId'))) 
		{	
			$_conds = array('success' =>1);	
		}	
		
	}
	
	echo json_encode($_conds);
}

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function AddView()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$UI = array(
			'Event' => $this->{base_class_model($this)}->_getBoolean(),
			'CallCategoryId' => $this -> getReasonCategoryId(),
			'Orders' => $this -> _getOrders()
			);
		$this -> load -> view('set_result_call/view_result_call_add',$UI);
	}	
 }
 
/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 function EditView()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId') ) 
	{
		$UI = array
		(
			'Event' => $this->{base_class_model($this)}->_getBoolean(),
			'Data' => $this->{base_class_model($this)}->_getDataResult( $this->URI->_get_post('CallReasonId') ),
			'CallCategoryId' => $this -> getReasonCategoryId(),
			'Orders' => $this -> _getOrders()
		);
		
		$this -> load -> view('set_result_call/view_result_call_edit',$UI);
	}	
 } 
 
 
 /**
  * Select
  *
  * Generates the SELECT portion of the query
  *
  * @param	string
  * @return	object
  */
  
 
  function getEventType()
 {
	 
// default arguments on this function / methode 
	 
	$this->out = UR(); 
	$this->cok = CK(); 
	$this->std = Singgleton( $this );
	
	
// data default of message form row data 
	
	$this->msg = array( 'success' => 0 );
	
	
// jika session kosong maka data langsung di move 
// dan exit saja ya.
	
   if( !$this->cok->find_value('UserId') ){
	 printf("%s", json_encode( $this->msg ) );
	 return false;
   }
   
 // jika session kosong maka data langsung di move 
// dan exit saja ya.
	 if( !$this->out->find_value('CallResultId') ){
	 printf("%s", json_encode( $this->msg ) );
	 return false;
   }
   
	
// jika session kosong maka data langsung di move 
// dan exit saja ya.

	$this->arr = $this->std->_getEventType( $this->out->field('CallResultId') );
	if( !is_null( $this->arr )) {
		$this->msg = array( 'success' => 1, 'event' => $this->arr );
	}
	
	 printf("%s", json_encode( $this->msg ) );
	 return false;
	
  }
  
 /**
  * Select
  *
  * Generates the SELECT portion of the query
  *
  * @param	string
  * @return	object
  */
  
	
 function DispositionParent()
 {
	 $this->val = 0; $this->out = UR();  
	 
 // default get all object to process data 
	 
	 $this->std = Singgleton($this);
	 $this->dta = OutboundCategory();
	 
 // then set default selected data 
 // by set object 
 
  if( !$this->out->find_value('dispositionID') ){
	printf("%s", form()->combo('CallStatus','select tolong select-chosen', $this->dta, $this->val ));
  }
	 
// then get by dis position data  //
	 
  $callCustomerID = $this->out->field('callCustomerID');
  $rsltDispositionStatusID = $this->out->field('dispositionID');
	 
 // teh  will get compare of the string 
	
  $actDispositionDataID = $this->std->getDispositionDataID( $callCustomerID );
  $actDispositionCategoryID = $this->std->getCategoryIDByResult( $rsltDispositionStatusID ); 
  $afterDispositionScoreID = $this->std->getScoreCategoryID( $actDispositionCategoryID  ); 
  $beforeDispositionScoreID = $this->std->getScoreCategoryID( $actDispositionDataID ); 
	 
 // jika data account status by call result ID memeiliki score lebih tinggi maka boleh update 
 // ke next category ID berikutnya .
	 
	 $this->val = $actDispositionDataID;
	 if( $afterDispositionScoreID > $beforeDispositionScoreID ){
		 $this->val = $actDispositionCategoryID;
	 } 
	 
 /**
	 printf("
		<fieldset style='padding:5px;margin:0px 6px 5px 0px;'>
			Acc Before  : %s <br>
			Acc Bfscore : %s <br>
			--------------------------------------<br>
			Acc Afscore : %s <br>
			Acc Select  : %s <br>
			Rst Select  : %s <br></fieldset>",
				$actDispositionDataID,
				$beforeDispositionScoreID,
				$afterDispositionScoreID,
				$actDispositionCategoryID, 
				$rsltDispositionStatusID
				
			);
	*/
	
	if($this->out->get_value('campaignId')==9){
		printf("%s", form()->combo('CallStatus_2nd','select tolong select-chosen', $this->dta, $this->val ));
	}else{
		printf("%s", form()->combo('CallStatus','select tolong select-chosen', $this->dta, $this->val ));
	}
	 
 } 
 /**
  * Select
  *
  * Generates the SELECT portion of the query
  *
  * @param	string
  * @return	object
  */
  
 
 function DisagreeDataId()
{
 
 $out  = UR();
 
// get disaggree Dat CustomerId 
// then like this 

  $callDisagreeDataId = array();
  $callDisagreeDataId = callDisagreeID( $out->field('disCampaignId'), $out->field('dispositionID') );
  // print_r($callDisagreeDataId);
  if($out->field('disCampaignId')==5 OR $out->field('disCampaignId')==9){
	if($out->field('disCampaignId')==9){
		printf("%s",  form()->combo('CallDisagree_2nd','select tolong select-chosen ui-data-disabled', $callDisagreeDataId) );
	}else{
		printf("%s",  form()->combo('CallDisagree','select tolong select-chosen ui-data-disabled', $callDisagreeDataId, null, array('change'=>'Ext.DOM.getToSecondProduct(this.value,'.$out->field('disCampaignId').')')) );
	}
  }else{
	printf("%s",  form()->combo('CallDisagree','select tolong select-chosen ui-data-disabled', $callDisagreeDataId) );
  }
}
 
/**
  * Select
  *
  * Generates the SELECT portion of the query
  *
  * @param	string
  * @return	object
  */
  
 function UpdateResultData()
{
	
	//callDispositionID : callDispositionID,
	//callCustomerID : callCustomerID,
	
	$this->out = UR(); $this->valID = 0; 
	$sql = sprintf("select a.CallReasonId from t_gn_customer a where a.CustomerId = '%s'", 
			$this->out->field('callCustomerID'));
	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows() > 0 ){
		$this->valID = $qry->result_value();
	}	
	
// get layout data on here update view 
	
	printf("%s", form()->combo('CallResult','select tolong select-chosen',
				CallDisposition( $this->valID ), $this->valID, 
				array('change'=>'getEventSale(this);')));
				
	// end process ITS
}

 /**
  * Select
  *
  * Generates the SELECT portion of the query
  *
  * @param	string
  * @return	object
  */
	
  
}
?>
