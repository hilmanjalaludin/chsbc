<?php
class ModDashboard extends EUI_Controller
{	
  function ModDashboard()
  {
	parent::__construct();
	$this -> load -> model(
		array( base_class_model($this), 
		'M_SetCampaign','M_SetCallResult')
	);
  }
  
  
// cek status sale or not 
  
  public function status()
  {
	$_conds = array('Sale' => 0);
	
	$ChkStatus	 = (INT)$this -> URI->_get_post('status');
	$CallResult  = $this -> M_SetCallResult->_getEventSale();
	
	if( is_array($CallResult) )
	{
		if( in_array( $ChkStatus, array_keys($CallResult) ))
		{
			$_conds = array('Sale' => 1);
		}
	}
	
	echo json_encode($_conds);	
  }
  
//index of controller page 
  
  public function index()
  {
	if( $this -> EUI_Session -> _have_get_session('UserId') )
	{
		$Data = array
		(
			'CallResultData' => $this->{base_class_model($this)}->_getSummaryDataResult(),
			'AppointmentDays' => $this->{base_class_model($this)}->_getSummaryAppoinmentData(),
			'CampaignId' => $this->M_SetCampaign->_get_campaign_name()
		);
		
		$this -> load -> view("mod_agent_dashboard/view_agent_dashboard",$Data);	
	}
	
  }

 // get all result replace to dasboard 
 
  public function CallResultData()
  {
	$Data = array('CallResultData' => $this->{base_class_model($this)}->_getSummaryDataResult());
	$this -> load -> view("mod_agent_dashboard/flexible-data-callresult",$Data);	
  }
	
}