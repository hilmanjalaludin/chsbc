<?php
class M_ModUserWindow extends EUI_Model
{

 function ModUserWindow(){}
 
	
 /*
 * @ def 		: _get_page_number // constructor class 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */	
 function _setSaveApproveItem($d=null)
 {
	$_conds = 0;
	$this -> db->set('CustomerId',$d['CustomerId'],TRUE);
	$this -> db->set('ApprovalItemId',$d['ApproveItem'],TRUE);
	$this -> db->set('CreatedById',$this->EUI_Session->_get_session('UserId'),TRUE);
	$this -> db->set('ApprovalOldValue','NULL',TRUE);
	$this -> db->set('ApprovalNewValue',$d['ApproveNumber']);
	$this -> db->set('ApprovalApprovedFlag',0,TRUE);
	$this -> db->set('ApprovalCreatedTs',date('Y-m-d H:i:s'));
	$this -> db->set('ApprovalUpdatedTs',NULL,TRUE);
	$this -> db->set('ApprovePhoneType',$d['ApproveItem'],TRUE);
	
	if( $this -> db->insert('t_gn_approvalhistory')){
		$_conds++;
	}
	
	return $_conds; 
 }
 
  
}
?>