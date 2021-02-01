<?php

class M_PaymentType extends EUI_Model
{

public function M_PaymentType(){
}


/*
 * @ def 		: __construct // constructor class 
 * -----------------------------------------
 *
 * @ params  	: customerId if tru section not / all  
 * @ return 	: array();
 */
 
 
public function _getCampaignPaymentType( $CustomerId= NULL) 
{

	$_PaymentChannelType = array();
	
	$this -> db->select('a.CampaignPayChannelId, a.PaymentChannelId');
	$this -> db->from('t_gn_campaignpaychannel a');
	$this -> db->join('t_gn_customer b ',' a.CampaignId=b.CampaignId ','LEFT');
	$this -> db->where('b.CustomerId',$CustomerId); 
	
	foreach( $this -> db-> get() -> result_assoc()  as $rows ) {
		$_PaymentChannelType[$rows['CampaignPayChannelId']] = $rows['PaymentChannelId']; 
	}
	
	return $_PaymentChannelType;
}

	

 
}

?>