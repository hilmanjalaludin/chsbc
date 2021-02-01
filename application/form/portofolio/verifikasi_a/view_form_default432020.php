<script>

 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  
window.TriggerOpenForm = function() {
	
	var verResultData = Ext.Cmp('ver_status').getValue();
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
			ro.Cmp('CallStatus').setValue(rs.RESULT);
			ro.Cmp('CallResult').setValue(rs.STATUS);
		});
		
		
	// kemudian set data berikut ini untuk validasi 
	// data2 tersebut .
	
		Ext.Cmp('CallStatus').disabled(true);
		Ext.Cmp('CallResult').disabled(true); 
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

/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */
  
  
$(document).ready( function()
{
	console.log('CustomerId', Ext.Cmp('CustomerId').getValue());
	$('#expiry_date').mask("00/00", { placeholder: "__/__"});
	$('#jatuh_tempo').mask("00-00-0000", { placeholder: "__-__-____"});
	$('#count_additional_cc').hide();
	$('#limit_cc').prop('disabled', true);
	$('#expiry_date').prop('disabled', true);
	$('#no_telp').prop('disabled', true);
	$('#total_jenis_cc').prop('disabled', true);
	$('#jenis_cc').prop('disabled', true);
	$('#jatuh_tempo').prop('disabled', true);

	var bambang = <?php echo $stat ?>;
	if(bambang==1)	{
		$('#default').hide();
		$('#rejected').hide();
		$('#verified').show();
		Ext.Cmp('ver_status').setValue(1)
	}else if (bambang==2){
		$('#default').hide();
		$('#rejected').show();
		$('#verified').hide();
	}else{
		$('#default').show();
		$('#rejected').hide();
		$('#verified').hide();
	}
	
	$("#limit_cc").keyup(function(){
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
	PARAM2['CustomerId'] = Ext.Cmp('CustomerId').getValue();
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
							$('#additional_cc').prop('disabled', false);
							$('#limit_cc').prop('disabled', true);
							$('#expiry_date').prop('disabled', true);
							$('#no_telp').prop('disabled', true);
							$('#total_jenis_cc').prop('disabled', true);
							$('#jenis_cc').prop('disabled', true);
							$('#jatuh_tempo').prop('disabled', true);
						} else if (indarr == 1) {
							$('#additional_cc').prop('disabled', true);
							$('#limit_cc').prop('disabled', false);
							$('#expiry_date').prop('disabled', true);
							$('#no_telp').prop('disabled', true);
							$('#total_jenis_cc').prop('disabled', true);
							$('#jenis_cc').prop('disabled', true);
							$('#jatuh_tempo').prop('disabled', true);
						} else if (indarr == 2) {
							$('#additional_cc').prop('disabled', true);
							$('#limit_cc').prop('disabled', true);
							$('#expiry_date').prop('disabled', false);
							$('#no_telp').prop('disabled', true);
							$('#total_jenis_cc').prop('disabled', true);
							$('#jenis_cc').prop('disabled', true);
							$('#jatuh_tempo').prop('disabled', true);
						} else if (indarr == 3) {
							$('#additional_cc').prop('disabled', true);
							$('#limit_cc').prop('disabled', true);
							$('#expiry_date').prop('disabled', true);
							$('#no_telp').prop('disabled', false);
							$('#total_jenis_cc').prop('disabled', true);
							$('#jenis_cc').prop('disabled', true);
							$('#jatuh_tempo').prop('disabled', true);
						} else if (indarr == 4) {
							$('#additional_cc').prop('disabled', true);
							$('#limit_cc').prop('disabled', true);
							$('#expiry_date').prop('disabled', true);
							$('#no_telp').prop('disabled', true);
							$('#total_jenis_cc').prop('disabled', false);
							$('#jenis_cc').prop('disabled', true);
							$('#jatuh_tempo').prop('disabled', true);
						} else if (indarr == 5) {
							$('#additional_cc').prop('disabled', true);
							$('#limit_cc').prop('disabled', true);
							$('#expiry_date').prop('disabled', true);
							$('#no_telp').prop('disabled', true);
							$('#total_jenis_cc').prop('disabled', true);
							$('#jenis_cc').prop('disabled', false);
							$('#jatuh_tempo').prop('disabled', true);
						} else if (indarr == 6) {
							$('#additional_cc').prop('disabled', true);
							$('#limit_cc').prop('disabled', true);
							$('#expiry_date').prop('disabled', true);
							$('#no_telp').prop('disabled', true);
							$('#total_jenis_cc').prop('disabled', true);
							$('#jenis_cc').prop('disabled', true);
							$('#jatuh_tempo').prop('disabled', false);
						} else {
							$('#additional_cc').prop('disabled', false);
							$('#limit_cc').prop('disabled', true);
							$('#expiry_date').prop('disabled', true);
							$('#no_telp').prop('disabled', true);
							$('#total_jenis_cc').prop('disabled', true);
							$('#jenis_cc').prop('disabled', true);
							$('#jatuh_tempo').prop('disabled', true);
						}
						var ind = parseInt(index)+1;
						console.log('indexsaveyo', index);
						if (arr[index].ver_status == 1) {
							// Ext.Cmp('ver_status').setValue(1)
							$('#ask_'+ ind +'_success').show();
							$('#ask_'+ ind +'_default').hide();
						} else {
							$('#ask_'+ ind +'_failed').show();
							$('#ask_'+ ind +'_default').hide();
						}
					})
					
				});
			}
		}).post();
	// cek apakah ini adalah content funsi jika ya tampilkan 
	 try{
		window.TriggerOpenForm(); 
	 } catch( error ){
		 console.log( error )
	 }
	 // end 
});

/**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [description]
  */

// tambahan irul
Ext.DOM.CheckAsk_1 = function(id) {
	var additional_cc = Ext.Cmp('additional_cc').getValue();
	var total_additional_cc = Ext.Cmp('total_additional_cc').getValue();
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
		var Controller = Ext.Cmp('ViewVerification').getValue();
		var PARAM = [];
		PARAM['CustomerId'] = Ext.Cmp('CustomerId').getValue();
		PARAM['InputId'] 	= id;
		Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller,'save_action']).Apply(),
			method : 'POST',
			param 	: Ext.Join(new Array
				( 
					Ext.Serialize('frm_verification').getElement(),
					PARAM 
				)).object(),
			ERROR  : function(fn)
			{
				Ext.Util(fn).proc(function(save){
					console.log('save', save)
					if (save.status == 1) {
						$('#ask_1_default').hide();
						$('#ask_1_success').show();
						$('#additional_cc').val('');
						$('#total_additional_cc').val('');
					} else {
						$('#ask_1_default').hide();
						$('#ask_1_failed').show();
						$('#additional_cc').val('');
						$('#total_additional_cc').val('');
					}

					if (save.conds == true) {
						$('#limit_cc').prop('disabled', false);
					} else {
						$('#default').hide();
						$('#rejected').show();
						$('#CallStatus').val(4);
						$('#CallResult').append("<option value='9'>Reject Verification</option>");
						$('#CallResult').val(9);
						$('#CallStatus').prop('disabled', true).trigger("chosen:updated");
						$('#CallResult').prop('disabled', true).trigger("chosen:updated");
					}

					if (save.verified == true) {
						$('#default').hide();
						$('#rejected').hide();
						$('#verified').show();
						Ext.DOM.getVerificationStatus();

						if (Ext.Cmp('CampaignId').getValue() == 5 || Ext.Cmp('CampaignId').getValue() == 6 || Ext.Cmp('CampaignId').getValue() == 9) {
							if (Ext.Cmp('FlagType').getValue() == 'ADV') {
								$('#product-tabs').removeClass("ui-state-disabled")
							} else {
								$('#cdd-tabs').removeClass("ui-state-disabled")
							}
						} else {
							$('#product-tabs').removeClass("ui-state-disabled")
						}
					}

					$('#total_additional_cc').prop('disabled', true);
					$('#additional_cc').prop('disabled', true);
					$('#ask_1_button').prop('disabled', true);
					// Ext.DOM.LoadVerification();
				});
			}
		}).post();
	}else{
		return false;
	}
}

Ext.DOM.CheckAsk_2 = function(id) {
	var val = Ext.Cmp('limit_cc').getValue();
	var readycheck = 0;
	
	if(val=="" || val==null){
		alert('Limit CC Field is Empty!');
		readycheck = 0;
		return false;
	} else {
		readycheck = 1;
	}
	
	if(readycheck == 1){
		var Controller = Ext.Cmp('ViewVerification').getValue();
		var PARAM = [];
		PARAM['CustomerId'] = Ext.Cmp('CustomerId').getValue();
		PARAM['InputId'] 	= id;
		Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller,'save_action']).Apply(),
			method : 'POST',
			param 	: Ext.Join(new Array
				( 
					Ext.Serialize('frm_verification').getElement(),
					PARAM 
				)).object(),
			ERROR  : function(fn)
			{
				Ext.Util(fn).proc(function(save){
					console.log('save', save)
					if (save.status == 1) {
						$('#ask_2_default').hide();
						$('#ask_2_success').show();
						$('#limit_cc').val('');
						
					} else {
						$('#ask_2_default').hide();
						$('#ask_2_failed').show();
						$('#limit_cc').val('');
					}

					if (save.conds == true) {
						$('#limit_cc').prop('disabled', true);
						$('#expiry_date').prop('disabled', false);
						$('#ask_2_button').prop('disabled', true);
					} else {
						$('#default').hide();
						$('#rejected').show();
						// $('#expiry_date').prop('disabled', false);
						// $('#ask_2_button').prop('disabled', false);
						$('#CallStatus').val(4);
						$('#CallResult').append("<option value='9'>Reject Verification</option>");
						$('#CallResult').val(9);
						$('#CallStatus').prop('disabled', true).trigger("chosen:updated");
						$('#CallResult').prop('disabled', true).trigger("chosen:updated");
					}

					if (save.verified == true) {
						$('#default').hide();
						$('#rejected').hide();
						$('#verified').show();
						$('#cdd-tabs').removeClass( "ui-state-disabled")
						Ext.DOM.getVerificationStatus();

						if (Ext.Cmp('CampaignId').getValue() == 5 || Ext.Cmp('CampaignId').getValue() == 6 || Ext.Cmp('CampaignId').getValue() == 9) {
							if (Ext.Cmp('FlagType').getValue() == 'ADV') {
								$('#product-tabs').removeClass("ui-state-disabled")
							} else {
								$('#cdd-tabs').removeClass("ui-state-disabled")
							}
						} else {
							$('#product-tabs').removeClass("ui-state-disabled")
						}
					}
					// Ext.DOM.LoadVerification();
				});
			}
		}).post();
	}else{
		return false;
	}
}

Ext.DOM.CheckAsk_3 = function(id) {
	var val = Ext.Cmp('expiry_date').getValue();
	var readycheck = 0;
	var HomePhone=Ext.Cmp('homephone').getValue();
	var WorkPhone=Ext.Cmp('workphone').getValue();


	
	if(val=="" || val==null){
		alert('Expiry Date Field is Empty!');
		readycheck = 0;
		return false;
	} else {
		readycheck = 1;
	}
	
	if(readycheck == 1){
		var Controller = Ext.Cmp('ViewVerification').getValue();
		var PARAM = [];
		PARAM['CustomerId'] = Ext.Cmp('CustomerId').getValue();
		PARAM['InputId'] 	= id;
		Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller,'save_action']).Apply(),
			method : 'POST',
			param 	: Ext.Join(new Array
				( 
					Ext.Serialize('frm_verification').getElement(),
					PARAM 
				)).object(),
			ERROR  : function(fn)
			{
				Ext.Util(fn).proc(function(save){
					console.log('save', save)
					if (save.status == 1) {
						$('#ask_3_default').hide();
						$('#ask_3_success').show();
						$('#expiry_date').val('');
					} else {
						$('#ask_3_default').hide();
						$('#ask_3_failed').show();
						$('#expiry_date').val('');
						$('#no_telp').prop('disabled', true);
					}

					if (save.conds == true) {
						if(HomePhone!=''|| WorkPhone!=''){
							$('#no_telp').prop('disabled', false);
						}else{
							$('#total_jenis_cc').prop('disabled', false);
						}
					} else {
						$('#default').hide();
						$('#rejected').show();
						$('#CallStatus').val(4);
						$('#CallResult').append("<option value='9'>Reject Verification</option>");
						$('#CallResult').val(9);
						$('#CallStatus').prop('disabled', true).trigger("chosen:updated");
						$('#CallResult').prop('disabled', true).trigger("chosen:updated");
					}

					if (save.verified == true) {
						$('#default').hide();
						$('#rejected').hide();
						$('#verified').show();
						Ext.DOM.getVerificationStatus();

						if (Ext.Cmp('CampaignId').getValue() == 5 || Ext.Cmp('CampaignId').getValue() == 6 || Ext.Cmp('CampaignId').getValue() == 9) {
							if (Ext.Cmp('FlagType').getValue() == 'ADV') {
								$('#product-tabs').removeClass("ui-state-disabled")
							} else {
								$('#cdd-tabs').removeClass("ui-state-disabled")
							}
						} else {
							$('#product-tabs').removeClass("ui-state-disabled")
						}
					}

					$('#expiry_date').prop('disabled', true);
					$('#ask_3_button').prop('disabled', true);
					// Ext.DOM.LoadVerification();
				});
			}
		}).post();
	}else{
		return false;
	}
}

Ext.DOM.CheckAsk_4 = function(id) {
	var val = Ext.Cmp('no_telp').getValue();
	var readycheck = 0;
	
	if(val=="" || val==null){
		// start commit a0907e46 
		alert('Nomor Telepon Field is Empty!');
		// end commit a0907e46 
		readycheck = 0;
		return false;
	} else {
		readycheck = 1;
	}
	
	if(readycheck == 1){
		var Controller = Ext.Cmp('ViewVerification').getValue();
		var PARAM = [];
		PARAM['CustomerId'] = Ext.Cmp('CustomerId').getValue();
		PARAM['InputId'] 	= id;
		Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller,'save_action']).Apply(),
			method : 'POST',
			param 	: Ext.Join(new Array
				( 
					Ext.Serialize('frm_verification').getElement(),
					PARAM 
				)).object(),
			ERROR  : function(fn)
			{
				Ext.Util(fn).proc(function(save){
					console.log('save', save)
					if (save.status == 1) {
						$('#ask_4_default').hide();
						$('#ask_4_success').show();
						$('#no_telp').val('');
					} else {
						$('#ask_4_default').hide();
						$('#ask_4_failed').show();
						$('#no_telp').val('');
					}

					if (save.conds == true) {
						$('#total_jenis_cc').prop('disabled', true);
					} else {
						$('#default').hide();
						$('#rejected').show();
						$('#CallStatus').val(4);
						$('#CallResult').append("<option value='9'>Reject Verification</option>");
						$('#CallResult').val(9);
						$('#CallStatus').prop('disabled', true).trigger("chosen:updated");
						$('#CallResult').prop('disabled', true).trigger("chosen:updated");
					}

					if (save.verified == true) {
						$('#default').hide();
						$('#rejected').hide();
						$('#verified').show();
						Ext.DOM.getVerificationStatus();

						if (Ext.Cmp('CampaignId').getValue() == 5 || Ext.Cmp('CampaignId').getValue() == 6 || Ext.Cmp('CampaignId').getValue() == 9) {
							if (Ext.Cmp('FlagType').getValue() == 'ADV') {
								$('#product-tabs').removeClass("ui-state-disabled")
							} else {
								$('#cdd-tabs').removeClass("ui-state-disabled")
							}
						} else {
							$('#product-tabs').removeClass("ui-state-disabled")
						}
					}

					$('#no_telp').prop('disabled', true);
					$('#ask_4_button').prop('disabled', true);
					// Ext.DOM.LoadVerification();
				});
			}
		}).post();
	}else{
		return false;
	}
}

Ext.DOM.CheckAsk_5 = function(id) {
	var val = Ext.Cmp('total_jenis_cc').getValue();
	var readycheck = 0;
	
	if(val=="" || val==null){
		alert('Jumlah jenis cc Field is Empty!');
		readycheck = 0;
		return false;
	} else {
		readycheck = 1;
	}
	
	if(readycheck == 1){
		var Controller = Ext.Cmp('ViewVerification').getValue();
		var PARAM = [];
		PARAM['CustomerId'] = Ext.Cmp('CustomerId').getValue();
		PARAM['InputId'] 	= id;
		Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller,'save_action']).Apply(),
			method : 'POST',
			param 	: Ext.Join(new Array
				( 
					Ext.Serialize('frm_verification').getElement(),
					PARAM 
				)).object(),
			ERROR  : function(fn)
			{
				Ext.Util(fn).proc(function(save){
					console.log('save', save)
					if (save.status == 1) {
						$('#ask_5_default').hide();
						$('#ask_5_success').show();
						$('#total_jenis_cc').val('');
					} else {
						$('#ask_5_default').hide();
						$('#ask_5_failed').show();
						$('#total_jenis_cc').val('');
					}

					if (save.conds == true) {
						$('#jenis_cc').prop('disabled', false);
					} else {
						$('#default').hide();
						$('#rejected').show();
						$('#CallStatus').val(4);
						$('#CallResult').append("<option value='9'>Reject Verification</option>");
						$('#CallResult').val(9);
						$('#CallStatus').prop('disabled', true).trigger("chosen:updated");
						$('#CallResult').prop('disabled', true).trigger("chosen:updated");
					}

					if (save.verified == true) {
						$('#default').hide();
						$('#rejected').hide();
						$('#verified').show();
						// start commit a0907e46 
						$('#jenis_cc').prop('disabled', true);
						// end commit a0907e46 
						if (Ext.Cmp('CampaignId').getValue() == 5 || Ext.Cmp('CampaignId').getValue() == 6 || Ext.Cmp('CampaignId').getValue() == 9) {
							if (Ext.Cmp('FlagType').getValue() == 'ADV') {
								$('#product-tabs').removeClass("ui-state-disabled")
							} else {
								$('#cdd-tabs').removeClass("ui-state-disabled")
							}
						} else {
							$('#product-tabs').removeClass("ui-state-disabled")
						}
					}

					$('#total_jenis_cc').prop('disabled', true);
					$('#ask_5_button').prop('disabled', true);
					// Ext.DOM.LoadVerification();
				});
			}
		}).post();
	}else{
		return false;
	}
}

Ext.DOM.CheckAsk_6 = function(id) {
	// start commit a0907e46 
	var val = Ext.Cmp('jenis_cc').getValue();
	// end commit a0907e46 
	var readycheck = 0;
	
	if(val=="" || val==null){
		alert('Jumlah jenis cc Field is Empty!');
		readycheck = 0;
		return false;
	} else {
		readycheck = 1;
	}
	
	if(readycheck == 1){
		var Controller = Ext.Cmp('ViewVerification').getValue();
		var PARAM = [];
		PARAM['CustomerId'] = Ext.Cmp('CustomerId').getValue();
		PARAM['InputId'] 	= id;
		Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller,'save_action']).Apply(),
			method : 'POST',
			param 	: Ext.Join(new Array
				( 
					Ext.Serialize('frm_verification').getElement(),
					PARAM 
				)).object(),
			ERROR  : function(fn)
			{
				Ext.Util(fn).proc(function(save){
					console.log('save', save)
					if (save.status == 1) {
						$('#ask_5_default').hide();
						$('#ask_5_success').show();
					} else {
						$('#ask_5_default').hide();
						$('#ask_5_failed').show();
					}

					if (save.conds == true) {
						$('#jatuh_tempo').prop('disabled', true);
					} else {
						$('#default').hide();
						$('#rejected').show();
						$('#CallStatus').val(4);
						$('#CallResult').append("<option value='9'>Reject Verification</option>");
						$('#CallResult').val(9);
						$('#CallStatus').prop('disabled', true).trigger("chosen:updated");
						$('#CallResult').prop('disabled', true).trigger("chosen:updated");
					}

					if (save.verified == true) {
						$('#default').hide();
						$('#rejected').hide();
						$('#verified').show();

						if (Ext.Cmp('CampaignId').getValue() == 5 || Ext.Cmp('CampaignId').getValue() == 6 || Ext.Cmp('CampaignId').getValue() == 9) {
							if (Ext.Cmp('FlagType').getValue() == 'ADV') {
								$('#product-tabs').removeClass("ui-state-disabled")
							} else {
								$('#cdd-tabs').removeClass("ui-state-disabled")
							}
						} else {
							$('#product-tabs').removeClass("ui-state-disabled")
						}
					}

					$('#total_jenis_cc').prop('disabled', true);
					$('#ask_5_button').prop('disabled', true);
					// Ext.DOM.LoadVerification();
				});
			}
		}).post();
	}else{
		return false;
	}
}

Ext.DOM.CheckAsk_7 = function(id) {
	var val = Ext.Cmp('jatuh_tempo').getValue();
	var readycheck = 0;
	
	if(val=="" || val==null){
		alert('Jumlah jenis cc Field is Empty!');
		readycheck = 0;
		return false;
	} else {
		readycheck = 1;
	}
	
	if(readycheck == 1){
		var Controller = Ext.Cmp('ViewVerification').getValue();
		var PARAM = [];
		PARAM['CustomerId'] = Ext.Cmp('CustomerId').getValue();
		PARAM['InputId'] 	= id;
		Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller,'save_action']).Apply(),
			method : 'POST',
			param 	: Ext.Join(new Array
				( 
					Ext.Serialize('frm_verification').getElement(),
					PARAM 
				)).object(),
			ERROR  : function(fn)
			{
				Ext.Util(fn).proc(function(save){
					console.log('save', save)
					if (save.status == 1) {
						$('#ask_7_default').hide();
						$('#ask_7_success').show();
					} else {
						$('#ask_7_default').hide();
						$('#ask_7_failed').show();
					}

					if (save.conds == false) {
						$('#default').hide();
						$('#rejected').show();
						$('#CallStatus').val(4);
						$('#CallResult').append("<option value='9'>Reject Verification</option>");
						$('#CallResult').val(9);
						$('#CallStatus').prop('disabled', true).trigger("chosen:updated");
						$('#CallResult').prop('disabled', true).trigger("chosen:updated");
					}

					if (save.verified == true) {
						$('#default').hide();
						$('#rejected').hide();
						$('#verified').show();

						if (Ext.Cmp('CampaignId').getValue() == 5 || Ext.Cmp('CampaignId').getValue() == 6 || Ext.Cmp('CampaignId').getValue() == 9) {
							if (Ext.Cmp('FlagType').getValue() == 'ADV') {
								$('#product-tabs').removeClass("ui-state-disabled")
							} else {
								$('#cdd-tabs').removeClass("ui-state-disabled")
							}
						} else {
							$('#product-tabs').removeClass("ui-state-disabled")
						}
					}
					
					$('#jatuh_tempo').prop('disabled', true);
					$('#ask_7_button').prop('disabled', true);
					// Ext.DOM.LoadVerification();
				});
			}
		}).post();
	}else{
		return false;
	}
}
 
function showTotalAcc() {
	
	var additional_cc = Ext.Cmp('additional_cc').getValue();

	if (additional_cc == 1) {
		$('#total_additional_cc').show();
	} else {
		$('#total_additional_cc').hide();
		$('#total_additional_cc').val(0);
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
// var_dump($check_data->CustomerWorkPhoneNum);die();
?>
<?php echo form()->hidden('Mode',NULL,$param['Mode']);?>
<form name="frm_verification">
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
					<?php echo form() -> hidden('ver_status',null, $_v_res);?>
				</div>
				<div class="ui-widget-form-cell center" style="font-size:15pt;">:</div>
				<div id="span_ver_status" class="ui-widget-form-cell left" style="font-size:15pt;">
					<b style="color:red;" hidden id="rejected">FAILED</b>
					<b style="color:green;" hidden id="verified">VERIFIED</b>
					<b style="color:blue;" id="default">NOT PASSED</b>
				</div>
			</div>
		</div>
	</div>
	<!--END OF HEADER VERIFICATION-->

	<input type="hidden" value="<?php echo $check_data->CustomerHomePhoneNum?>" id="homephone">
	<input type="hidden" value="<?php echo $check_data->CustomerWorkPhoneNum?>" id="workphone">

	<fieldset class="corner" style="margin-bottom:15px;">
		<?php echo form()->legend(lang(array('Pertanyaan')), "fa-tasks"); ?>
		<div class="ui-widget-form-table-compact">
			<!--INPUT ADDITIONAL CC-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Punya kartu kredit tambahan di HSBC?'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<?php echo form() -> combo('additional_cc','select long', array('1'=>'YES','0'=>'NO'), $v_i_additional_cc, array("change"=>"showTotalAcc()"), (isset($result['ver_result'])?array('disabled'=>true):$x_i_additional_cc) );?>
					<input type="text" name="total_additional_cc" class="input_text long numeric" id="total_additional_cc" style="padding-left:10px;width:60px;" placeholder="" hidden>
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_cust_dob" 
						class="btn btn-success btn-sm" id="ask_1_button" onclick="Ext.DOM.CheckAsk_1('ask_1');" 
					title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_cust_dob" class="ui-widget-form-cell left">
					<b style="color:green;" id="ask_1_success" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_1_failed" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_1_default"><i class="fa fa-minus" aria-hidden="true"></i></b>
				</div>
			</div>
			<!--END OF INPUT ADDITIONAL CC-->

			<!--INPUT LIMIT CC-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Limit Kartu Kredit HSBC'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="limit_cc" id="limit_cc" class="input_text long" style="padding-left:10px;" placeholder="">
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_cust_dob" 
						class="btn btn-success btn-sm" id="ask_2_button" onclick="Ext.DOM.CheckAsk_2('ask_2');" title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_cust_dob" class="ui-widget-form-cell left">
					<b style="color:green;" id="ask_2_success" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_2_failed" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_2_default"><i class="fa fa-minus" aria-hidden="true"></i></b>
				</div>
			</div>
			<!--END OF INPUT LIMIT CC-->

			<!--INPUT EXPIRY DATE CC-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Tanggal expiry Kartu Kredit (MM/YY)'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="expiry_date" id="expiry_date" class="input_text long" placeholder="__/__">
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_cust_dob" 
						class="btn btn-success btn-sm" id="ask_3_button" onclick="Ext.DOM.CheckAsk_3('ask_3');" title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_cust_dob" class="ui-widget-form-cell left">
					<b style="color:green;" id="ask_3_success" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_3_failed" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_3_default"><i class="fa fa-minus" aria-hidden="true"></i></b>
				</div>
			</div>
			<!--END OF EXPIRY DATE CC-->

			<!--INPUT NO TELP -->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Nomor Telepon (rumah/kantor)'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="no_telp" id="no_telp" class="input_text long numeric" placeholder="">
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_cust_dob" 
						class="btn btn-success btn-sm" id="ask_4_button" onclick="Ext.DOM.CheckAsk_4('ask_4');" title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_cust_dob" class="ui-widget-form-cell left">
					<b style="color:green;" id="ask_4_success" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_4_failed" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_4_default"><i class="fa fa-minus" aria-hidden="true"></i></b>
				</div>
			</div>
			<!--END OF INPUT NO TELP -->

			<!--INPUT JENIS KARTU KREDIT -->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Berapa jenis kartu kredit HSBC yang Bapak/Ibu miliki ?'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="total_jenis_cc" id="total_jenis_cc" class="input_text long" placeholder="" style="width:100px">
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_cust_dob" 
						class="btn btn-success btn-sm" id="ask_5_button" onclick="Ext.DOM.CheckAsk_5('ask_5');" title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_cust_dob" class="ui-widget-form-cell left">
					<b style="color:green;" id="ask_5_success" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_5_failed" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_5_default"><i class="fa fa-minus" aria-hidden="true"></i></b>
				</div>
			</div>
			<!--END OF INPUT JENIS KARTU KREDIT -->

			<!--INPUT JENIS KARTU KREDIT 2 -->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Berapa jenis kartu kredit HSBC yang Bapak/Ibu miliki ?'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<?php echo form() -> combo('jenis_cc','select long', array('1'=>'Classic Card','2'=>'Gold Card', '3'=>'Cashback Card', '4'=>'Platinum Card', '5'=>'Signature Card', 'Premier Card'), $v_i_jenis_cc, null, (isset($result['ver_result'])?array('disabled'=>true):$x_i_jenis_cc) );?>
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_cust_dob" 
						class="btn btn-success btn-sm" id="ask_6_button" onclick="Ext.DOM.CheckAsk_6('ask_6');" title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_cust_dob" class="ui-widget-form-cell left">
					<b style="color:green;" id="ask_6_success" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_6_failed" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_6_default"><i class="fa fa-minus" aria-hidden="true"></i></b>
				</div>
			</div>
			<!--END OF INPUT JENIS KARTU KREDIT 2 -->

			<!--INPUT JENIS KARTU KREDIT 2 -->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Tanggal jatuh tempo'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="jatuh_tempo" id="jatuh_tempo" class="input_text long" placeholder="__-__-____">
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_cust_dob" 
						class="btn btn-success btn-sm" id="ask_7_button" onclick="Ext.DOM.CheckAsk_7('ask_7');" title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_cust_dob" class="ui-widget-form-cell left">
					<b style="color:green;" id="ask_7_success" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_7_failed" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_7_default"><i class="fa fa-minus" aria-hidden="true"></i></b>
				</div>
			</div>
			<!--END OF INPUT JENIS KARTU KREDIT 2 -->

		</div>
	</fieldset>
	
</form>
