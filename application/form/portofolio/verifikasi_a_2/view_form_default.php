<script>

 /*
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  
window.TriggerOpenForm_2nd = function() {
	
	var verResultData = Ext.Cmp('ver_status_2nd').getValue();
		console.log( window.sprintf("ver_status : %s", verResultData));
		
	if( verResultData == '2' ) {
		// rejected
		var row = Ext.Json( "SrcCustomerList/get_reject_status", {
			verResultData : verResultData	
		});
		
		// ini adalah ambil row jika sucess data 
		// return json .
		
		row.dataItemEach(function( rs, xh, ro ){
			console.log( rs );
			ro.Cmp('CallStatus_2nd').setValue(rs.RESULT);
			ro.Cmp('CallResult_2nd').setValue(rs.STATUS);
		});
		
		
	// kemudian set data berikut ini untuk validasi 
	// data2 tersebut .
	
		Ext.Cmp('CallStatus_2nd').disabled(true);
		Ext.Cmp('CallResult_2nd').disabled(true); 
		Ext.DOM.initFunc.isCallPhone = true;
		Ext.DOM.initFunc.isDial 	 = false;
		Ext.DOM.initFunc.isRunCall 	 = false;
		Ext.DOM.initFunc.isCancel 	 = false;
	}
	
	
  // kemudian set juga untuk mal function form .
  // test .
  
	Ext.Cmp('VerifForm').setValue( verResultData );
	if( verResultData == '1' ){
		$("#tabs").mytab().tabs().tabs("option", "disabled", []);
	}
}

/*
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  
$(document).ready( function()
{
	console.log('flag_type', Ext.Cmp('FlagType_2nd').getValue());
	$('#expiry_date_2nd').mask("00/00", { placeholder: "__/__"});
	$('#jatuh_tempo_2nd').mask("00-00-0000", { placeholder: "__-__-____"});
	$('#count_additional_cc_2nd').hide();
	$('#limit_cc_2nd').prop('disabled', false);
	$('#additional_cc_2nd').prop('disabled', true);
	$('#statement_2nd').prop('disabled', true);
	// $('#expiry_date').prop('disabled', true);
	// $('#no_telp').prop('disabled', true);
	$('#total_jenis_cc_2nd').prop('disabled', true);
	// $('#jenis_cc').prop('disabled', true);
	$('#jatuh_tempo_2nd').prop('disabled', true);
	$('#jenis_cc_2nd').hide();

	var bambang = <?php echo $stat ?>;
	if(bambang==1)	{
		$('#default_2nd').hide();
		$('#rejected_2nd').hide();
		$('#verified_2nd').show();
	}else if (bambang==2){
		$('#default_2nd').hide();
		$('#rejected_2nd').show();
		$('#verified_2nd').hide();
	}else{
		$('#default_2nd').show();
		$('#rejected_2nd').hide();
		$('#verified_2nd').hide();
	}
	
	$("#limit_cc_2nd").keyup(function(){
		var id = $(this).attr('id'), 
			text = Ext.Cmp(id).getValue();
			
		if(text!=''){
			text = Ext.Money(text).ToInt();
			Ext.Cmp(id).setValue(Ext.Money(text).ToRupiah());
		}
		else{
			Ext.Cmp(id).setValue(0);
		}
	});
	
	$(".numeric").keyup(function(){
		var id = $(this).attr('id');
		var text = Ext.Cmp(id).getValue();
		
		if(text!=''){
			text = Ext.Money(text).ToNumeric();
			Ext.Cmp(id).setValue(text);
		}
	});

	var Controller2 = Ext.Cmp('ViewVerification').getValue();
	var PARAM2 = [];
	PARAM2['CustomerId'] = Ext.Cmp('CustomerId_2nd').getValue();
	Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller2,'jj']).Apply(),
			method : 'POST',
			param 	: Ext.Join(new Array
				( 
					PARAM2 
				)).object(),
			ERROR  : function(fn)
			{
				Ext.Util(fn).proc(function(save){
					console.log('saveyo', save)
					save.map(function(save, index, arr) {
						console.log('saveyolength', arr.length);
						var indarr = arr.length;
						if (indarr == 0) {
							$('#limit_cc_2nd').prop('disabled', false);
							$('#statement_2nd').prop('disabled', true);
							$('#additional_cc_2nd').prop('disabled', true);
							$('#total_jenis_cc_2nd').prop('disabled', true)
						} else if (indarr == 1) {
							$('#limit_cc_2nd').prop('disabled', true);
							$('#statement_2nd').prop('disabled', false);
							$('#additional_cc_2nd').prop('disabled', true);
							$('#total_jenis_cc_2nd').prop('disabled', true);
						} else if (indarr == 2) {
							$('#limit_cc_2nd').prop('disabled', true);
							$('#statement_2nd').prop('disabled', true);
							$('#additional_cc_2nd').prop('disabled', false);
							$('#total_jenis_cc_2nd').prop('disabled', true);
						} else if (indarr == 3) {
							$('#limit_cc_2nd').prop('disabled', true);
							$('#statement_2nd').prop('disabled', true);
							$('#additional_cc_2nd').prop('disabled', true);
							$('#total_jenis_cc_2nd').prop('disabled', false);
						} else if (indarr == 4) {
							$('#limit_cc_2nd').prop('disabled', true);
							$('#statement_2nd').prop('disabled', true);
							$('#additional_cc_2nd').prop('disabled', true);
							$('#total_jenis_cc_2nd').prop('disabled', true);
						} else if (indarr == 5) {
							$('#additional_cc_2nd').prop('disabled', true);
							$('#limit_cc_2nd').prop('disabled', true);
							$('#expiry_date_2nd').prop('disabled', true);
							$('#no_telp_2nd').prop('disabled', true);
							$('#total_jenis_cc_2nd').prop('disabled', true);
							$('#jenis_cc_2nd').prop('disabled', false);
							$('#jatuh_tempo_2nd').prop('disabled', true);
						} else if (indarr == 6) {
							$('#additional_cc_2nd').prop('disabled', true);
							$('#limit_cc_2nd').prop('disabled', true);
							$('#expiry_date_2nd').prop('disabled', true);
							$('#no_telp_2nd').prop('disabled', true);
							$('#total_jenis_cc_2nd').prop('disabled', true);
							$('#jenis_cc_2nd').prop('disabled', true);
							$('#jatuh_tempo_2nd').prop('disabled', false);
						} else {
							$('#additional_cc_2nd').prop('disabled', false);
							$('#limit_cc_2nd').prop('disabled', true);
							$('#expiry_date_2nd').prop('disabled', true);
							$('#no_telp_2nd').prop('disabled', true);
							$('#total_jenis_cc_2nd').prop('disabled', true);
							$('#jenis_cc_2nd').prop('disabled', true);
							$('#jatuh_tempo_2nd').prop('disabled', true);
						}
						var ind = parseInt(index)+1;
						console.log('indexsaveyo', index);
						if (arr[index].ver_status == 1) {
							// Ext.Cmp('ver_status').setValue(1)
							$('#ask_'+ ind +'_success_2nd').show();
							$('#ask_'+ ind +'_default_2nd').hide();
						} else {
							$('#ask_'+ ind +'_failed_2nd').show();
							$('#ask_'+ ind +'_default_2nd').hide();
						}
					})
					
				});
			}
		}).post();
	
	// cek apakah ini adalah content funsi jika ya tampilkan 
	 try{
		window.TriggerOpenForm_2nd(); 
	 } catch( error ){
		 console.log( error )
	 }
	 // end 
});



/*
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

// tambahan irul
Ext.DOM.CheckAsk_1_2nd = function(id) {
	var val = Ext.Cmp('limit_cc_2nd').getValue();
	var readycheck = 0;
	
	if(val=="" || val==null){
		alert('Limit CC Field is Empty!');
		readycheck = 0;
		return false;
	} else {
		readycheck = 1;
	}
	
	if(readycheck == 1){
		var Controller = Ext.Cmp('ViewVerification_2nd').getValue();
		var PARAM = [];
		PARAM['CustomerId'] = Ext.Cmp('CustomerId_2nd').getValue();
		PARAM['InputId'] 	= id;
		Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller,'save_action_2nd']).Apply(),
			method : 'POST',
			param 	: Ext.Join(new Array
				( 
					Ext.Serialize('frm_verification_2nd').getElement(),
					PARAM 
				)).object(),
			ERROR  : function(fn)
			{
				Ext.Util(fn).proc(function(save){
					console.log('save', save)
					if (save.status == 1) {
						$('#ask_1_default_2nd').hide();
						$('#ask_1_success_2nd').show();
						$('#limit_cc_2nd').val('');
					} else {
						$('#ask_1_default_2nd').hide();
						$('#ask_1_failed_2nd').show();
						$('#limit_cc_2nd').val('');
					}

					if (save.conds == true) {
						$('#limit_cc_2nd').prop('disabled', true);
						$('#statement_2nd').prop('disabled', false);
						$('#ask_1_button_2nd').prop('disabled', true);
					} else {
						$('#default_2nd').hide();
						$('#rejected_2nd').show();
						$('#CallStatus_2nd').val(4);
						$('#CallResult_2nd').append("<option value='9'>Reject Verification</option>");
						$('#CallResult_2nd').val(9);
						$('#CallStatus_2nd').prop('disabled', true).trigger("chosen:updated");
						$('#CallResult_2nd').prop('disabled', true).trigger("chosen:updated");
					}

					if (save.verified == true) {
						$('#default_2nd').hide();
						$('#rejected_2nd').hide();
						$('#verified_2nd').show();

						if (Ext.Cmp('CampaignId_2nd').getValue() == 5 || Ext.Cmp('CampaignId_2nd').getValue() == 6 || Ext.Cmp('CampaignId_2nd').getValue() == 9) {
							if (Ext.Cmp('FlagType_2nd').getValue() == 'ADV') {
								$('#product-tabs').removeClass("ui-state-disabled")
							} else {
								$('#cdd-tabs').removeClass("ui-state-disabled")
							}
						} else {
							$('#product-tabs').removeClass("ui-state-disabled")
						}
					}

					$('#total_additional_cc_2nd').prop('disabled', true);
					$('#additional_cc_2nd').prop('disabled', true);
					$('#ask_1_button_2nd').prop('disabled', true);
					// Ext.DOM.LoadVerification();
				});
			}
		}).post();
	}else{
		return false;
	}
}

Ext.DOM.CheckAsk_2_2nd = function(id) {
	var statement = Ext.Cmp('statement_2nd').getValue();
	var email = Ext.Cmp('email_2nd').getValue();
	var readycheck = 0;

	if(statement=="" || statement==null){
		alert('E-Statement Field is Empty!');
		readycheck = 0;
		return false;
	} else {
		if (statement == 1) {
			console.log('asss',statement);
			if (email== "" || email==null) {
				alert('Email Field is Empty!');
				readycheck = 0;
				return false;
			} else {
				readycheck = 1;
			}
		} else {
			readycheck = 1;
		}
	}
	
	if(readycheck == 1){
		var Controller = Ext.Cmp('ViewVerification_2nd').getValue();
		var PARAM = [];
		PARAM['CustomerId'] = Ext.Cmp('CustomerId_2nd').getValue();
		PARAM['InputId'] 	= id;
		Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller,'save_action_2nd']).Apply(),
			method : 'POST',
			param 	: Ext.Join(new Array
				( 
					Ext.Serialize('frm_verification_2nd').getElement(),
					PARAM 
				)).object(),
			ERROR  : function(fn)
			{
				Ext.Util(fn).proc(function(save){
					console.log('save', save)
					if (save.status == 1) {
						$('#ask_2_default_2nd').hide();
						$('#ask_2_success_2nd').show();
						$('#statement_2nd').val('');
						$('#email_2nd').val('');
					} else {
						$('#ask_2_default_2nd').hide();
						$('#ask_2_failed_2nd').show();
						$('#statement_2nd').val('');
						$('#email_2nd').val('');
					}

					if (save.conds == true) {
						$('#additional_cc_2nd').prop('disabled', false);
					} else {
						$('#default_2nd').hide();
						$('#rejected_2nd').show();
						$('#CallStatus_2nd').val(4);
						$('#CallResult_2nd').append("<option value='9'>Reject Verification</option>");
						$('#CallResult_2nd').val(9);
						$('#CallStatus_2nd').prop('disabled', true).trigger("chosen:updated");
						$('#CallResult_2nd').prop('disabled', true).trigger("chosen:updated");
					}

					if (save.verified == true) {
						$('#default_2nd').hide();
						$('#rejected_2nd').hide();
						$('#verified_2nd').show();
						Ext.DOM.getVerificationStatus();

						if (Ext.Cmp('CampaignId_2nd').getValue() == 5 || Ext.Cmp('CampaignId_2nd').getValue() == 6 || Ext.Cmp('CampaignId_2nd').getValue() == 9) {
							if (Ext.Cmp('FlagType_2nd').getValue() == 'ADV') {
								$('#product-tabs').removeClass("ui-state-disabled")
							} else {
								$('#cdd-tabs').removeClass("ui-state-disabled")
							}
						} else {
							$('#product-tabs').removeClass("ui-state-disabled")
						}
					}

					$('#email_2nd').prop('disabled', true);
					$('#statement_2nd').prop('disabled', true);
					$('#ask_2_button_2nd').prop('disabled', true);
					// Ext.DOM.LoadVerification();
				});
			}
		}).post();
	}else{
		return false;
	}
}

Ext.DOM.CheckAsk_3_2nd = function(id) {
	var additional_cc = Ext.Cmp('additional_cc_2nd').getValue();
	var total_additional_cc = Ext.Cmp('total_additional_cc_2nd').getValue();
	var readycheck = 0;

	if(additional_cc=="" || additional_cc==null){
		alert('Additional CC Field is Empty!');
		readycheck = 0;
		return false;
	} else {
		if (additional_cc == 1) {
			console.log('asss',additional_cc);
			if (total_additional_cc== "" || total_additional_cc==null) {
				alert('Total Additional CC Field is Empty!');
				readycheck = 0;
				return false;
			} else {
				readycheck = 1;
			}
		} else {
			readycheck = 1;
		}
	}
	
	
	
	if(readycheck == 1){
		var Controller = Ext.Cmp('ViewVerification_2nd').getValue();
		var PARAM = [];
		PARAM['CustomerId'] = Ext.Cmp('CustomerId_2nd').getValue();
		PARAM['InputId'] 	= id;
		Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller,'save_action_2nd']).Apply(),
			method : 'POST',
			param 	: Ext.Join(new Array
				( 
					Ext.Serialize('frm_verification_2nd').getElement(),
					PARAM 
				)).object(),
			ERROR  : function(fn)
			{
				Ext.Util(fn).proc(function(save){
					console.log('save', save)
					if (save.status == 1) {
						$('#ask_3_default_2nd').hide();
						$('#ask_3_success_2nd').show();
						$('#additional_cc_2nd').val('');
						$('#total_additional_cc_2nd').val('');
					} else {
						$('#ask_3_default_2nd').hide();
						$('#ask_3_failed_2nd').show();
						$('#additional_cc_2nd').val('');
						$('#total_additional_cc_2nd').val('');
						
					}

					if (save.conds == true) {
							$('#total_jenis_cc_2nd').prop('disabled', false);
						
					} else {
						$('#default_2nd').hide();
						$('#rejected_2nd').show();
						$('#CallStatus_2nd').val(4);
						$('#CallResult_2nd').append("<option value='9'>Reject Verification</option>");
						$('#CallResult_2nd').val(9);
						$('#CallStatus_2nd').prop('disabled', true).trigger("chosen:updated");
						$('#CallResult_2nd').prop('disabled', true).trigger("chosen:updated");
					}

					if (save.verified == true) {
						$('#default_2nd').hide();
						$('#rejected_2nd').hide();
						$('#verified_2nd').show();
						$('#total_jenis_cc_2nd').prop('disabled', true);

						if (Ext.Cmp('CampaignId_2nd').getValue() == 5 || Ext.Cmp('CampaignId_2nd').getValue() == 6 || Ext.Cmp('CampaignId_2nd').getValue() == 9) {
							if (Ext.Cmp('FlagType_2nd').getValue() == 'ADV') {
								$('#product-tabs').removeClass("ui-state-disabled")
							} else {
								$('#cdd-tabs').removeClass("ui-state-disabled")
							}
						} else {
							$('#product-tabs').removeClass("ui-state-disabled")
						}
					}

					$('#total_additional_cc_2nd').prop('disabled', true);
					$('#additional_cc_2nd').prop('disabled', true);
					$('#ask_3_button_2nd').prop('disabled', true);
					// Ext.DOM.LoadVerification();
				});
			}
		}).post();
	}else{
		return false;
	}
}

Ext.DOM.CheckAsk_4_2nd = function(id) {
	var total_jenis_cc = Ext.Cmp('total_jenis_cc_2nd').getValue();
	var jenis_cc = Ext.Cmp('jenis_cc_2nd').getValue();
	var readycheck = 0;;
	
	if(total_jenis_cc=="" || total_jenis_cc==null){
		alert('total_jenis_cc Field is Empty!');
		readycheck = 0;
		return false;
	} else {
		if (total_jenis_cc > 0) {
			console.log('asss',total_jenis_cc);
			if (jenis_cc== "" || jenis_cc==null||jenis_cc==0) {
				alert('jenis_cc Field is Empty!');
				readycheck = 0;
				return false;
			} else {
				readycheck = 1;
			}
		} else {
			readycheck = 1;
		}
	}
	
	if(readycheck == 1){
		var Controller = Ext.Cmp('ViewVerification_2nd').getValue();
		var PARAM = [];
		PARAM['CustomerId'] = Ext.Cmp('CustomerId_2nd').getValue();
		PARAM['InputId'] 	= id;
		Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller,'save_action_2nd']).Apply(),
			method : 'POST',
			param 	: Ext.Join(new Array
				( 
					Ext.Serialize('frm_verification_2nd').getElement(),
					PARAM 
				)).object(),
			ERROR  : function(fn)
			{
				Ext.Util(fn).proc(function(save){
					console.log('save', save)
					if (save.status == 1) {
						$('#ask_4_default_2nd').hide();
						$('#ask_4_success_2nd').show();
						$('#total_jenis_cc_2nd').val('');
						$('#jenis_cc_2nd').val('');
					} else {
						$('#ask_4_default_2nd').hide();
						$('#ask_4_failed_2nd').show();
						$('#total_jenis_cc_2nd').val('');
						$('#jenis_cc_2nd').val('');
					}

					if (save.conds == true) {
						$('#total_jenis_cc_2nd').prop('disabled', true);
						$('#jenis_cc_2nd').prop('disabled', true);
					} else {
						$('#default_2nd').hide();
						$('#rejected_2nd').show();
						$('#CallStatus_2nd').val(4);
						$('#CallResult_2nd').append("<option value='9'>Reject Verification</option>");
						$('#CallResult_2nd').val(9);
						$('#CallStatus_2nd').prop('disabled', true).trigger("chosen:updated");
						$('#CallResult_2nd').prop('disabled', true).trigger("chosen:updated");
					}

					if (save.verified == true) {
						$('#default_2nd').hide();
						$('#rejected_2nd').hide();
						$('#verified_2nd').show();
						Ext.DOM.getVerificationStatus();
						if (Ext.Cmp('CampaignId_2nd').getValue() == 5 || Ext.Cmp('CampaignId_2nd').getValue() == 6 || Ext.Cmp('CampaignId_2nd').getValue() == 9) {
							if (Ext.Cmp('FlagType_2nd').getValue() == 'ADV') {
								$('#product-tabs').removeClass("ui-state-disabled")
							} else {
								$('#cdd-tabs').removeClass("ui-state-disabled")
							}
						} else {
							$('#product-tabs').removeClass("ui-state-disabled")
						}
					}

					$('#no_telp_2nd').prop('disabled', true);
					$('#ask_4_button_2nd').prop('disabled', true);
					// Ext.DOM.LoadVerification();
				});
			}
		}).post();
	}else{
		return false;
	}
}

Ext.DOM.CheckAsk_5_2nd = function(id) {
	var val = Ext.Cmp('total_jenis_cc_2nd').getValue();
	var readycheck = 0;
	
	if(val=="" || val==null){
		alert('Jumlah jenis cc Field is Empty!');
		readycheck = 0;
		return false;
	} else {
		readycheck = 1;
	}
	
	if(readycheck == 1){
		var Controller = Ext.Cmp('ViewVerification_2nd').getValue();
		var PARAM = [];
		PARAM['CustomerId'] = Ext.Cmp('CustomerId_2nd').getValue();
		PARAM['InputId'] 	= id;
		Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller,'save_action_2nd']).Apply(),
			method : 'POST',
			param 	: Ext.Join(new Array
				( 
					Ext.Serialize('frm_verification_2nd').getElement(),
					PARAM 
				)).object(),
			ERROR  : function(fn)
			{
				Ext.Util(fn).proc(function(save){
					console.log('save', save)
					if (save.status == 1) {
						$('#ask_5_default_2nd').hide();
						$('#ask_5_success_2nd').show();
						$('#total_jenis_cc_2nd').val('');
					} else {
						$('#ask_5_default_2nd').hide();
						$('#ask_5_failed_2nd').show();
						$('#total_jenis_cc_2nd').val('');
					}

					if (save.conds == true) {
						$('#jenis_cc_2nd').prop('disabled', true);
					} else {
						$('#default_2nd').hide();
						$('#rejected_2nd').show();
						$('#CallStatus_2nd').val(4);
						$('#CallResult_2nd').append("<option value='9'>Reject Verification</option>");
						$('#CallResult_2nd').val(9);
						$('#CallStatus_2nd').prop('disabled', true).trigger("chosen:updated");
						$('#CallResult_2nd').prop('disabled', true).trigger("chosen:updated");
					}

					if (save.verified == true) {
						$('#default_2nd').hide();
						$('#rejected_2nd').hide();
						$('#verified_2nd').show();

						if (Ext.Cmp('CampaignId_2nd').getValue() == 5 || Ext.Cmp('CampaignId_2nd').getValue() == 6 || Ext.Cmp('CampaignId_2nd').getValue() == 9) {
							if (Ext.Cmp('FlagType_2nd').getValue() == 'ADV') {
								$('#product-tabs').removeClass("ui-state-disabled")
							} else {
								$('#cdd-tabs').removeClass("ui-state-disabled")
							}
						} else {
							$('#product-tabs').removeClass("ui-state-disabled")
						}
					}

					$('#total_jenis_cc_2nd').prop('disabled', true);
					$('#ask_5_button_2nd').prop('disabled', true);
					// Ext.DOM.LoadVerification();
				});
			}
		}).post();
	}else{
		return false;
	}
}

Ext.DOM.CheckAsk_6_2nd = function(id) {
	var val = Ext.Cmp('total_jenis_cc_2nd').getValue();
	var readycheck = 0;
	
	if(val=="" || val==null){
		alert('Jumlah jenis cc Field is Empty!');
		readycheck = 0;
		return false;
	} else {
		readycheck = 1;
	}
	
	if(readycheck == 1){
		var Controller = Ext.Cmp('ViewVerification_2nd').getValue();
		var PARAM = [];
		PARAM['CustomerId'] = Ext.Cmp('CustomerId_2nd').getValue();
		PARAM['InputId'] 	= id;
		Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller,'save_action_2nd']).Apply(),
			method : 'POST',
			param 	: Ext.Join(new Array
				( 
					Ext.Serialize('frm_verification_2nd').getElement(),
					PARAM 
				)).object(),
			ERROR  : function(fn)
			{
				Ext.Util(fn).proc(function(save){
					console.log('save', save)
					if (save.status == 1) {
						$('#ask_5_default_2nd').hide();
						$('#ask_5_success_2nd').show();
					} else {
						$('#ask_5_default_2nd').hide();
						$('#ask_5_failed_2nd').show();
					}

					if (save.conds == true) {
						$('#jatuh_tempo_2nd').prop('disabled', true);
					} else {
						$('#default_2nd').hide();
						$('#rejected_2nd').show();
						$('#CallStatus_2nd').val(4);
						$('#CallResult_2nd').append("<option value='9'>Reject Verification</option>");
						$('#CallResult_2nd').val(9);
						$('#CallStatus_2nd').prop('disabled', true).trigger("chosen:updated");
						$('#CallResult_2nd').prop('disabled', true).trigger("chosen:updated");
					}

					if (save.verified == true) {
						$('#default_2nd').hide();
						$('#rejected_2nd').hide();
						$('#verified_2nd').show();

						if (Ext.Cmp('CampaignId_2nd').getValue() == 5 || Ext.Cmp('CampaignId_2nd').getValue() == 6 || Ext.Cmp('CampaignId_2nd').getValue() == 9) {
							if (Ext.Cmp('FlagType_2nd').getValue() == 'ADV') {
								$('#product-tabs').removeClass("ui-state-disabled")
							} else {
								$('#cdd-tabs').removeClass("ui-state-disabled")
							}
						} else {
							$('#product-tabs').removeClass("ui-state-disabled")
						}
					}

					$('#total_jenis_cc_2nd').prop('disabled', true);
					$('#ask_5_button_2nd').prop('disabled', true);
					// Ext.DOM.LoadVerification();
				});
			}
		}).post();
	}else{
		return false;
	}
}

Ext.DOM.CheckAsk_7_2nd = function(id) {
	var val = Ext.Cmp('jatuh_tempo_2nd').getValue();
	var readycheck = 0;
	
	if(val=="" || val==null){
		alert('Jumlah jenis cc Field is Empty!');
		readycheck = 0;
		return false;
	} else {
		readycheck = 1;
	}
	
	if(readycheck == 1){
		var Controller = Ext.Cmp('ViewVerification_2nd').getValue();
		var PARAM = [];
		PARAM['CustomerId'] = Ext.Cmp('CustomerId_2nd').getValue();
		PARAM['InputId'] 	= id;
		Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller,'save_action_2nd']).Apply(),
			method : 'POST',
			param 	: Ext.Join(new Array
				( 
					Ext.Serialize('frm_verification_2nd').getElement(),
					PARAM 
				)).object(),
			ERROR  : function(fn)
			{
				Ext.Util(fn).proc(function(save){
					console.log('save', save)
					if (save.status == 1) {
						$('#ask_7_default_2nd').hide();
						$('#ask_7_success_2nd').show();
					} else {
						$('#ask_7_default_2nd').hide();
						$('#ask_7_failed_2nd').show();
					}

					if (save.conds == false) {
						$('#default_2nd').hide();
						$('#rejected_2nd').show();
						$('#CallStatus_2nd').val(4);
						$('#CallResult_2nd').append("<option value='9'>Reject Verification</option>");
						$('#CallResult_2nd').val(9);
						$('#CallStatus_2nd').prop('disabled', true).trigger("chosen:updated");
						$('#CallResult_2nd').prop('disabled', true).trigger("chosen:updated");
					}

					if (save.verified == true) {
						$('#default_2nd').hide();
						$('#rejected_2nd').hide();
						$('#verified_2nd').show();

						if (Ext.Cmp('CampaignId_2nd').getValue() == 5 || Ext.Cmp('CampaignId_2nd').getValue() == 6 || Ext.Cmp('CampaignId_2nd').getValue() == 9) {
							if (Ext.Cmp('FlagType_2nd').getValue() == 'ADV') {
								$('#product-tabs').removeClass("ui-state-disabled")
							} else {
								$('#cdd-tabs').removeClass("ui-state-disabled")
							}
						} else {
							$('#product-tabs').removeClass("ui-state-disabled")
						}
					}
					
					$('#jatuh_tempo_2nd').prop('disabled', true);
					$('#ask_7_button_2nd').prop('disabled', true);
					// Ext.DOM.LoadVerification();
				});
			}
		}).post();
	}else{
		return false;
	}
}

function showEmail2() {
	
	var statement = Ext.Cmp('statement_2nd').getValue();

	if (statement == 'Yes') {
		$('#email_2nd').show();
	} else {
		$('#email_2nd').hide();
		$('#email_2nd').val(0);
	}

}
 
function showTotalAcc_2nd() {
	
	var additional_cc = Ext.Cmp('additional_cc_2nd').getValue();

	if (additional_cc == 1) {
		$('#total_additional_cc_2nd').show();
		$('#total_additional_cc_2nd').prop('disabled', false);
		
	} else {
		$('#total_additional_cc_2nd').hide();
		$('#total_additional_cc_2nd').val(0);
	}

}

function showtotalJJ_2nd() {
	
	var total_jenis_cc = Ext.Cmp('total_jenis_cc_2nd').getValue();

	if (total_jenis_cc > 0) {
		$('#jenis_cc_2nd').show();
	} else {
		$('#jenis_cc_2nd').hide();
		$('#jenis_cc_2nd').val(0);
	}

}
// tutup tambahan irul
</script>
<!--
2016-07-11
NOTES OF CODE ID <abie> :
c = count (max value of error input),
a = attempt (number of error input),
s = status (0=uncompleted, 1=pass, 2=failed),
o = database value for comparison input text to database,
i = id of input or select form,
b = id of button check,
r = id of div result verify
-->
<?php
$_urut_a = (isset($urutan['A'][1])?null:array('disabled'=>true));
$_urut_b = (isset($urutan['B'][1])?null:array('disabled'=>true));

$_klik_a = (isset($urutan['A'][1])?null:'style="pointer-events:none;cursor:default;"');
$_klik_b = (isset($urutan['B'][1])?null:'style="pointer-events:none;cursor:default;"');
?>
<?php echo form()->hidden('Mode_2nd',NULL,$param['Mode']);?>
<form name="frm_verification_2nd">
	<!--HEADER VERIFICATION-->
	<div style="margin-bottom:15px;margin-top:-10px;">
		<div class="ui-widget-form-table-compact">
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell" style="font-size:15pt;">
					<i class="fa fa-check-square-o" aria-hidden="true"></i>
					<?php
						$_v_res = (isset($result['ver_result'])?$result['ver_result']:0);
						
					?>
					<?php echo lang(array('Verification Result'));?>
					<?php echo form() -> hidden('ver_status_2nd',null, $_v_res);?>
				</div>
				<div class="ui-widget-form-cell center" style="font-size:15pt;">:</div>
				<div id="span_ver_status_2nd" class="ui-widget-form-cell left" style="font-size:15pt;">
					<b style="color:red;" hidden id="rejected_2nd">FAILED</b>
					<b style="color:green;" hidden id="verified_2nd">VERIFIED</b>
					<b style="color:blue;" id="default_2nd">NOT PASSED</b>
				</div>
			</div>
		</div>
	</div>
	<!--END OF HEADER VERIFICATION-->

	<fieldset class="corner" style="margin-bottom:15px;">
		<?php echo form()->legend(lang(array('Pertanyaan')), "fa-tasks"); ?>
		<div class="ui-widget-form-table-compact">
			<!--INPUT ADDITIONAL CC-->
				<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Limit Kartu Kredit HSBC'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="limit_cc_2nd" id="limit_cc_2nd" class="input_text long" style="padding-left:10px;" placeholder="">
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_cust_dob" 
						class="btn btn-success btn-sm" id="ask_1_button_2nd" onclick="Ext.DOM.CheckAsk_1_2nd('ask_1');" title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_cust_dob" class="ui-widget-form-cell left">
					<b style="color:green;" id="ask_1_success_2nd" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_1_failed_2nd" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_1_default_2nd"><i class="fa fa-minus" aria-hidden="true"></i></b>
				</div>
			</div>
			<!--END OF INPUT ADDITIONAL CC-->

			<!--INPUT LIMIT CC-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Lembar Tagihan by E-Statement?'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<?php echo form() -> combo('statement_2nd','select long', array('Yes'=>'YES','No'=>'NO'), $v_i_additional_cc, array("change"=>"showEmail2()"), (isset($result['ver_result'])?array('disabled'=>true):$x_i_additional_cc) );?>
					<input type="text" name="email_2nd" class="input_text long " id="email_2nd" style="padding-left:10px;width:160px;" placeholder="" hidden>
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_cust_dob" 
						class="btn btn-success btn-sm" id="ask_2_button_2nd" onclick="Ext.DOM.CheckAsk_2_2nd('ask_2');" 
					title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_cust_dob" class="ui-widget-form-cell left">
					<b style="color:green;" id="ask_2_success_2nd" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_2_failed_2nd" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_2_default_2nd"><i class="fa fa-minus" aria-hidden="true"></i></b>
				</div>
			</div>
			<!--END OF INPUT LIMIT CC-->

			<!--INPUT EXPIRY DATE CC-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Punya kartu kredit tambahan di HSBC?'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<?php echo form() -> combo('additional_cc_2nd','select long', array('1'=>'YES','0'=>'NO'), $v_i_additional_cc, array("change"=>"showTotalAcc_2nd()"), (isset($result['ver_result'])?array('disabled'=>true):$x_i_additional_cc) );?>
					<input type="text" name="total_additional_cc_2nd" class="input_text long " id="total_additional_cc_2nd" style="padding-left:10px;width:160px;" placeholder="" hidden>
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_cust_dob" 
						class="btn btn-success btn-sm" id="ask_3_button_2nd" onclick="Ext.DOM.CheckAsk_3_2nd('ask_3');" 
					title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_cust_dob" class="ui-widget-form-cell left">
					<b style="color:green;" id="ask_3_success_2nd" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_3_failed_2nd" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_3_default_2nd"><i class="fa fa-minus" aria-hidden="true"></i></b>
				</div>
			</div>
			<!--END OF EXPIRY DATE CC-->

			<!--INPUT NO TELP 
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php// echo lang(array('Nomor Telepon (rumah/kantor)'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="no_telp_2nd" id="no_telp_2nd" class="input_text long numeric" placeholder="">
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_cust_dob_2nd" 
						class="btn btn-success btn-sm" id="ask_4_button_2nd" onclick="Ext.DOM.CheckAsk_4_2nd('ask_4');" title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_cust_dob_2nd" class="ui-widget-form-cell left">
					<b style="color:green;" id="ask_4_success_2nd" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_4_failed_2nd" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_4_default_2nd"><i class="fa fa-minus" aria-hidden="true"></i></b>
				</div>
			</div>
			END OF INPUT NO TELP -->

			<!--INPUT JENIS KARTU KREDIT -->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Berapa jenis kartu kredit HSBC yang Bapak/Ibu miliki ?'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="total_jenis_cc_2nd" id="total_jenis_cc_2nd" class="input_text long" placeholder="" style="width:100px" onchange="showtotalJJ_2nd()">
					<?php echo form() -> combo('jenis_cc_2nd','select long', array('1'=>'Classic Card','2'=>'Gold Card', '3'=>'Cashback Card', '4'=>'Platinum Card', '5'=>'Signature Card', '6'=>'Premier Card'), $v_i_jenis_cc);?>
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_cust_dob" 
						class="btn btn-success btn-sm" id="ask_4_button_2nd" onclick="Ext.DOM.CheckAsk_4_2nd('ask_4');" title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_cust_dob" class="ui-widget-form-cell left">
					<b style="color:green;" id="ask_4_success_2nd" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_4_failed_2nd" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_4_default_2nd"><i class="fa fa-minus" aria-hidden="true"></i></b>
				</div>
			</div>
			<!--END OF INPUT JENIS KARTU KREDIT -->

			<!--INPUT JENIS KARTU KREDIT 2 
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Berapa jenis kartu kredit HSBC yang Bapak/Ibu miliki ?'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<?php// echo form() -> combo('jenis_cc_2nd','select long', array('1'=>'Classic Card','2'=>'Gold Card', '3'=>'Cashback Card', '4'=>'Platinum Card', '5'=>'Signature Card', 'Premier Card'), $v_i_jenis_cc, null, (isset($result['ver_result'])?array('disabled'=>true):$x_i_jenis_cc) );?>
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_cust_dob_2nd" 
						class="btn btn-success btn-sm" id="ask_6_button" onclick="Ext.DOM.CheckAsk_6_2nd('ask_6');" title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_cust_dob_2nd" class="ui-widget-form-cell left">
					<b style="color:green;" id="ask_6_success_2nd" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_6_failed_2nd" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_6_default_2nd"><i class="fa fa-minus" aria-hidden="true"></i></b>
				</div>
			</div>
			END OF INPUT JENIS KARTU KREDIT 2 -->

			<!--INPUT JENIS KARTU KREDIT 2 
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Tanggal jatuh tempo'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="jatuh_tempo_2nd" id="jatuh_tempo_2nd" class="input_text long" placeholder="__-__-____">
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_cust_dob_2nd" 
						class="btn btn-success btn-sm" id="ask_7_button_2nd" onclick="Ext.DOM.CheckAsk_7_2nd('ask_7');" title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_cust_dob_2nd" class="ui-widget-form-cell left">
					<b style="color:green;" id="ask_7_success_2nd" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_7_failed_2nd" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_7_default_2nd"><i class="fa fa-minus" aria-hidden="true"></i></b>
				</div>
			</div>
			END OF INPUT JENIS KARTU KREDIT 2 -->

		</div>
	</fieldset>
	
</form>