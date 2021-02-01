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

	$('#expiry_date').mask("00/00", { placeholder: "__/__"});
	$('#jatuh_tempo').mask("00-00-0000", { placeholder: "__-__-____"});
	//edit rangga production 1 mask pay acc
	$('#pay_acc').mask("000-000000-000", { placeholder: "__-__-____"});
	//end edit
	$('#count_additional_cc').hide();
	$('#ori_loan').prop('disabled', true);
	$('#phone_num').prop('disabled', true);
	$('#pay_acc ').prop('disabled', true);
	$('#loan_pay_date').prop('disabled', true);
	$('#pay_value').prop('disabled', true);

	var bambang = <?php echo $status ?>;
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

	$("#ori_loan").keyup(function(){
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
//edit baru history rangga
var Controller2 = Ext.Cmp('ViewVerification').getValue();
console.log('Controller2', Controller2)
	var PARAM2 = [];
	PARAM2['CustomerId'] = Ext.Cmp('CustomerId').getValue();
	Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller2,'get_history']).Apply(),
			method : 'POST',
			param 	: Ext.Join(new Array
				( 
					PARAM2 
				)).object(),
			ERROR  : function(fn)
			{
				Ext.Util(fn).proc(function(save){
					console.log('datas', save)
					console.log('datas', save)
					save.row.map(function(save, index, arr) {
						
						var indarr = arr.length;
						console.log('indarr', save)
						//1ac65b73211b257dcedb353b888d65dc9d2b44ee 20-01-2020
						if (indarr == 0) {
							$('#additional_cc').prop('disabled', false);
							$('#ori_loan').prop('disabled', true);
							$('#phone_num').prop('disabled', true);
							$('#pay_acc').prop('disabled', true);
							$('#loan_pay_date').prop('disabled', true);
							$('#pay_value').prop('disabled', true);
						} else if (indarr == 1) {
							if(arr[index].ver_status==1){
								console.log('ver_status',arr[index].ver_status)
								$('#additional_cc').prop('disabled', true);
								$('#ori_loan').prop('disabled', false);
								$('#phone_num').prop('disabled', true);
								$('#pay_acc').prop('disabled', true);
								$('#loan_pay_date').prop('disabled', true);
								$('#pay_value').prop('disabled', true);
							}else{
								if(arr[index].ver_attempt==3){
									console.log('indar 2 true')
									$('#additional_cc').prop('disabled', true);
									$('#ori_loan').prop('disabled', false);
									$('#phone_num').prop('disabled', true);
									$('#pay_acc').prop('disabled', true);
									$('#loan_pay_date').prop('disabled', true);
									$('#pay_value').prop('disabled', true);
								}else{
									$('#additional_cc').prop('disabled', false);
									$('#ori_loan').prop('disabled', true);
									$('#phone_num').prop('disabled', true);
									$('#pay_acc').prop('disabled', true);
									$('#loan_pay_date').prop('disabled', true);
									$('#pay_value').prop('disabled', true);
								}
							}
						} else if (indarr == 2) {
							if(arr[index].ver_status==1){
								console.log('ver_status',arr[index].ver_status)
								$('#additional_cc').prop('disabled', true);
								$('#ori_loan').prop('disabled', true);
								$('#phone_num').prop('disabled', false);
								$('#pay_acc').prop('disabled', true);
								$('#loan_pay_date').prop('disabled', true);
								$('#pay_value').prop('disabled', true);
							}else{
								if(arr[index].ver_attempt==3){
									console.log('indar 2 true')
									$('#additional_cc').prop('disabled', true);
									$('#ori_loan').prop('disabled', true);
									$('#phone_num').prop('disabled', false);
									$('#pay_acc').prop('disabled', true);
									$('#loan_pay_date').prop('disabled', true);
									$('#pay_value').prop('disabled', true);
								}else{
									$('#additional_cc').prop('disabled', true);
									$('#ori_loan').prop('disabled', false);
									$('#phone_num').prop('disabled', true);
									$('#pay_acc').prop('disabled', true);
									$('#loan_pay_date').prop('disabled', true);
									$('#pay_value').prop('disabled', true);
								}
							}
							
						} else if (indarr == 3) {

							if(arr[index].ver_status==1){
								console.log('ver_status',arr[index].ver_status)
								$('#additional_cc').prop('disabled', true);
								$('#ori_loan').prop('disabled', true);
								$('#phone_num').prop('disabled', true);
								$('#pay_acc').prop('disabled', false);
								$('#loan_pay_date').prop('disabled', true);
								$('#pay_value').prop('disabled', true);
							}else{
								if(arr[index].ver_attempt==3){
									console.log('indar 2 true')
									$('#additional_cc').prop('disabled', true);
									$('#ori_loan').prop('disabled', true);
									$('#phone_num').prop('disabled', true);
									$('#pay_acc').prop('disabled', false);
									$('#loan_pay_date').prop('disabled', true);
									$('#pay_value').prop('disabled', true);
								}else{
									$('#additional_cc').prop('disabled', true);
									$('#ori_loan').prop('disabled', true);
									$('#phone_num').prop('disabled', false);
									$('#pay_acc').prop('disabled', true);
									$('#loan_pay_date').prop('disabled', true);
									$('#pay_value').prop('disabled', true);
								}
							}
							
						} else if (indarr == 4) {
							if(arr[index].ver_status==1){
								console.log('ver_status',arr[index].ver_status)
								$('#additional_cc').prop('disabled', true);
								$('#ori_loan').prop('disabled', true);
								$('#phone_num').prop('disabled', true);
								$('#pay_acc').prop('disabled', true);
								$('#loan_pay_date').prop('disabled', true);
								$('#pay_value').prop('disabled', true);
							}else{
								if(arr[index].ver_attempt==3){
									console.log('indar 2 true')
									$('#additional_cc').prop('disabled', true);
									$('#ori_loan').prop('disabled', true);
									$('#phone_num').prop('disabled', true);
									$('#pay_acc').prop('disabled', true);
									$('#loan_pay_date').prop('disabled', true);
									$('#pay_value').prop('disabled', true);
								}else{
									$('#additional_cc').prop('disabled', true);
									$('#ori_loan').prop('disabled', true);
									$('#phone_num').prop('disabled', true);
									$('#pay_acc').prop('disabled', false);
									$('#loan_pay_date').prop('disabled', true);
									$('#pay_value').prop('disabled', true);
								}
							}
						} else if (indarr == 5) {
							$('#additional_cc').prop('disabled', true);
							$('#ori_loan').prop('disabled', true);
							$('#phone_num').prop('disabled', true);
							$('#pay_acc').prop('disabled', true);
							$('#loan_pay_date').prop('disabled', true);
							$('#pay_value').prop('disabled', false);
						} else {
							$('#additional_cc').prop('disabled', false);
							$('#ori_loan').prop('disabled', true);
							$('#phone_num').prop('disabled', true);
							$('#pay_acc').prop('disabled', true);
							$('#loan_pay_date').prop('disabled', true);
							$('#pay_value').prop('disabled', true);
						}

						var ind = parseInt(index)+1;
						if (arr[index].ver_1 == 1) {
							$('#ask_'+ ind +'_success_1').show();
							$('#ask_'+ ind +'_default_1').hide();
						} else if (arr[index].ver_1 == 0){
							$('#ask_'+ ind +'_failed_1').show();
							$('#ask_'+ ind +'_default_1').hide();
						}

						if (arr[index].ver_2 == 1) {
							$('#ask_'+ ind +'_success_2').show();
							$('#ask_'+ ind +'_default_2').hide();
						} else if (arr[index].ver_2 == 0){
							$('#ask_'+ ind +'_failed_2').show();
							$('#ask_'+ ind +'_default_2').hide();
						}

						if (arr[index].ver_3 == 1) {
							$('#ask_'+ ind +'_success_3').show();
							$('#ask_'+ ind +'_default_3').hide();
						} else if (arr[index].ver_3 == 0){
							$('#ask_'+ ind +'_failed_3').show();
							$('#ask_'+ ind +'_default_3').hide();
						}
					})

					if (save.ver_status == 1 || save.ver_status == 2) {
						$('#additional_cc').prop('disabled', true);
						$('#ori_loan').prop('disabled', true);
						$('#phone_num').prop('disabled', true);
						$('#pay_acc').prop('disabled', true);
						$('#loan_pay_date').prop('disabled', true);
						$('#pay_value').prop('disabled', true);
					}
					
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
Ext.DOM.CheckAsk_1= function(id) {
	var additional_cc = Ext.Cmp('additional_cc').getValue();
	var total_additional_cc = Ext.Cmp('total_additional_cc').getValue();
	var readycheck = 0;

	// console.log('Test Data',additional_cc, total_additional_cc ,readycheck)

	if(additional_cc=="" || additional_cc==null){
		alert('Additional CC Field is Empty!');
		readycheck = 0;
		return false;
	} else {
		if (additional_cc == 1) {
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

		console.log('readycheck',Controller,PARAM)
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
				// console.log('json',fn)
				Ext.Util(fn).proc(function(save){
					console.log('save', save)
					
					if (save.status == 1) {
						//ubah check
						if(save.attempt==1){
						$('#ask_1_default_1').hide();
						$('#ask_1_success_1').show();
						$('#additional_cc').attr("disabled","disabled");
						$('#total_additional_cc').prop('disabled', true);
						$('#additional_cc').val('');
						$('#total_additional_cc').val('');
						$('#ori_loan').prop('disabled', false);
						$('#ori_loan').focus();
						$('#additional_cc').val('')
						$('#total_additional_cc').val('')
						}else if(save.attempt==2){
						$('#ask_1_default_2').hide();
						$('#ask_1_success_2').show();
						$('#additional_cc').attr("disabled","disabled");
						$('#total_additional_cc').prop('disabled', true);
						$('#additional_cc').val('');
						$('#total_additional_cc').val('');
						$('#ori_loan').prop('disabled', false);
						$('#ori_loan').focus();
						$('#additional_cc').val('')
						$('#total_additional_cc').val('')
						}else if(save.attempt==3){
						$('#ask_1_default_3').hide();
						$('#ask_1_success_3').show();
						$('#additional_cc').attr("disabled","disabled");
						$('#total_additional_cc').prop('disabled', true);
						$('#additional_cc').val('');
						$('#total_additional_cc').val('');
						$('#ori_loan').prop('disabled', false);
						$('#ori_loan').focus();
						$('#additional_cc').val('')
						$('#total_additional_cc').val('')
						}
					} else {
						if(save.attempt==1){
						$('#ask_1_default_1').hide();
						$('#ask_1_failed_1').show();
						$('#total_additional_cc').focus();
						}else if(save.attempt==2){
						$('#ask_1_default_2').hide();
						$('#ask_1_failed_2').show();
						$('#total_additional_cc').focus();
						}else if(save.attempt==3){
						$('#ask_1_default_3').hide();
						$('#ask_1_failed_3').show();
						$('#additional_cc').prop('disabled', true);
						$('#additional_cc').attr("disabled","disabled");
						$('#ori_loan').prop('disabled', false);
						$('#additional_cc').val('')
						$('#total_additional_cc').val('')
						}else{
							//masih bingung
						}
					}

					if (save.conds == true) {
                        $('#additional_cc').prop('disable',true);
                       
						$('#ori_loan').focus();
					} else {
						$('#default').hide();
						$('#rejected').show();
						$('#CallStatus').val(4);
						$('#CallResult').append("<option value='9'>Reject Verification</option>");
						$('#CallResult').val(9);
						$('#CallStatus_chosen').trigger("chosen:updated");
						$('#CallResult').prop('disabled', true).trigger("chosen:updated");
					}

					if (save.verified == true) {
						$('#default').hide();
						$('#rejected').hide();
						$('#verified').show();
						Ext.DOM.getVerificationStatus();

						if (Ext.Cmp('CampaignId').getValue() == 5 || Ext.Cmp('CampaignId').getValue() == 6 || Ext.Cmp('CampaignId').getValue() == 9) {
							if (Ext.Cmp('FlagType').getValue() != 'ADV') {
								$('#cdd-tabs').removeClass("ui-state-disabled")
							} else {
								$('#product-tabs').removeClass("ui-state-disabled")
							}
						} else {
							$('#product-tabs').removeClass("ui-state-disabled")
						}
					}

					$('#ask_1_button').prop('disabled', true);
					// // Ext.DOM.LoadVerification();
				});
			}
		}).post();
	}else{
		return false;
	}
}

Ext.DOM.CheckAsk_2 = function(id) {
	var val = Ext.Cmp('ori_loan').getValue();
	var readycheck = 0;
	var HomePhone=Ext.Cmp('homephone').getValue();
	if(val=="" || val==null){
		alert('Loan Field is Empty!');
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
						if(save.attempt==1){
						$('#ask_2_default_1').hide();
						$('#ask_2_success_1').show();
						$('#ori_loan').prop('disabled', true);
						$('#ori_loan').val('');
						console.log('test data',HomePhone)
						if(HomePhone!=''){
							$('#phone_num').prop('disabled', false);
							$('#phone_num').focus();
						}else{
							$('#pay_acc').prop('disabled', false);
							$('#pay_acc').focus();
						}
					}else if(save.attempt==2){
						$('#ask_2_default_2').hide();
						$('#ask_2_success_2').show();
						$('#ori_loan').prop('disabled', true);
						$('#ori_loan').val('');
						if(HomePhone!=""){
							$('#phone_num').prop('disabled', false);
							$('#phone_num').focus();	
						}else{
							$('#pay_acc').prop('disabled', false);
							$('#pay_acc').focus();	
						}
					}else if(save.attempt==3){
						$('#ask_2_default_3').hide();
						$('#ask_2_success_3').show();
						$('#ori_loan').prop('disabled', true);
						$('#ori_loan').val('');
						if(HomePhone!=""){
							$('#phone_num').prop('disabled', false);
							$('#phone_num').focus();	
						}else{
							$('#pay_acc').prop('disabled', false);
							$('#pay_acc').focus();	
						}
					}
					} else {
						if(save.attempt==1){
						$('#ask_2_default_1').hide();
						$('#ask_2_failed_1').show();
						$('#ori_loan').focus();
						}else if(save.attempt==2){
						$('#ask_2_default_2').hide();
						$('#ask_2_failed_2').show();
						// $('#total_additional_cc').focus();
						}else if(save.attempt==3){
						$('#ask_2_default_3').hide();
						$('#ask_2_failed_3').show();
						
						// $('#total_additional_cc').prop('disabled', true);
						
						if(HomePhone!=""){
							$('#phone_num').prop('disabled', false);
							$('#ori_loan').prop('disabled', true);
							$('#ori_loan').val('');
						}else{
							$('#ori_loan').prop('disabled', true);
							$('#pay_acc').prop('disabled', false);
							$('#pay_acc').focus();
							$('#ori_loan').val('');	
						}
						
						}
					}
					if (save.conds == true) {
						$('#phone_num').focus();
					} else {
						$('#phone_num').prop('disabled', true);
						$('#default').hide();
						$('#rejected').show();
						$('#expiry_date').prop('disabled', true);
						$('#ask_2_button').prop('disabled', false);
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
							if (Ext.Cmp('FlagType').getValue() != 'ADV') {
								$('#cdd-tabs').removeClass("ui-state-disabled")
							} else {
								$('#product-tabs').removeClass("ui-state-disabled")
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
	var val = Ext.Cmp('phone_num').getValue();
	var readycheck = 0;
	
	if(val=="" || val==null){
		alert('Phone Number Field is Empty!');
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
                            if(save.attempt==1){
                                    $('#ask_3_default_1').hide();
                                    $('#ask_3_success_1').show();
									$('#phone_num').prop('disabled', true);
									$('#phone_num').val('');
                                    $('#pay_acc').prop('disabled', false);
                                    $('#pay_acc').focus();
                                }else if(save.attempt==2){
                                    $('#ask_3_default_2').hide();
                                    $('#ask_3_success_2').show();
									$('#phone_num').prop('disabled', true);
									$('#phone_num').val('');
                                    $('#pay_acc').prop('disabled', false);
                                    $('#pay_acc').focus();
                                }else if(save.attempt==3){
                                    $('#ask_3_default_3').hide();
                                    $('#ask_3_success_3').show();
									$('#phone_num').prop('disabled', true);
									$('#phone_num').val('');
                                    $('#pay_acc').prop('disabled', false);
                                    $('#pay_acc').focus();
                                }
					} else {
                        if(save.attempt==1){
						$('#ask_3_default_1').hide();
						$('#ask_3_failed_1').show();
						$('#phone_num').focus();
						}else if(save.attempt==2){
						$('#ask_3_default_2').hide();
						$('#ask_3_failed_2').show();
                        $('#phone_num').focus();
						// $('#total_additional_cc').focus();
						}else if(save.attempt==3){
						$('#ask_3_default_3').hide();
						$('#ask_3_failed_3').show();
						$('#phone_num').prop('disabled', true);
						// $('#total_additional_cc').prop('disabled', true);
						$('#pay_acc').prop('disabled', false);
						$('#phone_num').val('');
						}
					}

					if ((save.conds == true)) {
						//commit ca1af3c1
						$('#pay_acc').focus();
					} else {
						$('#pay_acc').prop('disabled', true);
						$('#default').hide();
						$('#rejected').show();
						$('#CallStatus').val(4);
						$('#CallResult').append("<option value='9'>Reject Verification</option>");
						$('#CallResult').val(9);
						$('#CallStatus').prop('disabled', true).trigger("chosen:updated");
						$('#CallResult').prop('disabled', true).trigger("chosen:updated");
					}

					if (save.verified == true) {
                        $('#pay_acc').prop('disabled', true);
						$('#default').hide();
						$('#rejected').hide();
						$('#verified').show();
						Ext.DOM.getVerificationStatus();

						if (Ext.Cmp('CampaignId').getValue() == 5 || Ext.Cmp('CampaignId').getValue() == 6 || Ext.Cmp('CampaignId').getValue() == 9) {
							if (Ext.Cmp('FlagType').getValue() != 'ADV') {
								$('#cdd-tabs').removeClass("ui-state-disabled")
							} else {
								$('#product-tabs').removeClass("ui-state-disabled")
							}
						} else {
							$('#product-tabs').removeClass("ui-state-disabled")
						}
					}

					// $('#expiry_date').prop('disabled', true);
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
	var val = Ext.Cmp('pay_acc').getValue();
	var readycheck = 0;
	
	if(val=="" || val==null){
		alert('Payment Account Field is Empty!');
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
                            if(save.attempt==1){
                                    $('#ask_4_default_1').hide();
                                    $('#ask_4_success_1').show();
									$('#pay_acc').prop('disabled', true);
									$('#pay_acc').val('');
                                    $('#loan_pay_date').prop('disabled', false);
                                    $('#loan_pay_date').focus();
                                }else if(save.attempt==2){
                                    $('#ask_4_default_2').hide();
                                    $('#ask_4_success_2').show();
									$('#pay_acc').val('');
									$('#pay_acc').prop('disabled', true);
                                    $('#loan_pay_date').prop('disabled', false);
                                    $('#loan_pay_date').focus();
                                }else if(save.attempt==3){
                                    $('#ask_4_default_3').hide();
                                    $('#ask_4_success_3').show();
									$('#pay_acc').val('');
									$('#pay_acc').prop('disabled', true);
                                    $('#loan_pay_date').prop('disabled', false);
                                    $('#loan_pay_date').focus();
                                }
					} else {
                        if(save.attempt==1){
						$('#ask_4_default_1').hide();
						$('#ask_4_failed_1').show();
						$('#pay_acc').focus();
						}else if(save.attempt==2){
						$('#ask_4_default_2').hide();
						$('#ask_4_failed_2').show();
                        $('#pay_acc').focus();
						// $('#total_additional_cc').focus();
						}else if(save.attempt==3){
						$('#ask_4_default_3').hide();
						$('#ask_4_failed_3').show();
						$('#pay_acc').prop('disabled', true);
						// $('#total_additional_cc').prop('disabled', true);
						$('#loan_pay_date').prop('disabled', false);
						$('#pay_acc').val('');
						}
					}

					if (save.conds == true ) {
						$('#loan_pay_date').prop('disabled', false);
					} else {
						$('#loan_pay_date').prop('disabled', true);
						$('#default').hide();
						$('#rejected').show();
						$('#CallStatus').val(4);
						$('#CallResult').append("<option value='9'>Reject Verification</option>");
						$('#CallResult').val(9);
						$('#CallStatus').prop('disabled', true).trigger("chosen:updated");
						$('#CallResult').prop('disabled', true).trigger("chosen:updated");
					}

					if (save.verified == true) {
                        $('#loan_pay_date').prop('disabled', true);
						$('#default').hide();
						$('#rejected').hide();
						$('#verified').show();
						Ext.DOM.getVerificationStatus();

						if (Ext.Cmp('CampaignId').getValue() == 5 || Ext.Cmp('CampaignId').getValue() == 6 || Ext.Cmp('CampaignId').getValue() == 9) {
							if (Ext.Cmp('FlagType').getValue() != 'ADV') {
								$('#cdd-tabs').removeClass("ui-state-disabled")
							} else {
								$('#product-tabs').removeClass("ui-state-disabled")
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
	var val = Ext.Cmp('loan_pay_date').getValue();
	var readycheck = 0;
	
	if(val=="" || val==null){
		alert('Tanggal cc Field is Empty!');
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
                        if(save.attempt==1){
                                    $('#ask_5_default_1').hide();
                                    $('#ask_5_success_1').show();
									$('#loan_pay_date').prop('disabled', true);
									$('#loan_pay_date').val('');
                                    $('#pay_value').prop('disabled', false);
                                    $('#pay_value').focus();
                                }else if(save.attempt==2){
                                    $('#ask_5_default_2').hide();
                                    $('#ask_5_success_2').show();
									$('#loan_pay_date').prop('disabled', true);
									$('#loan_pay_date').val('');
                                    $('#pay_value').prop('disabled', false);
                                    $('#pay_value').focus();
                                }else if(save.attempt==3){
                                    $('#ask_5_default_3').hide();
                                    $('#ask_5_success_3').show();
									$('#loan_pay_date').prop('disabled', true);
									$('#loan_pay_date').val('');
                                    $('#pay_value').prop('disabled', false);
                                    $('#pay_value').focus();
                                }
					} else {
						if(save.attempt==1){
						$('#ask_5_default_1').hide();
						$('#ask_5_failed_1').show();
						$('#loan_pay_date').focus();
						}else if(save.attempt==2){
						$('#ask_5_default_2').hide();
						$('#ask_5_failed_2').show();
                        $('#loan_pay_date').focus();
						// $('#total_additional_cc').focus();
						}else if(save.attempt==3){
						$('#ask_5_default_3').hide();
						$('#ask_5_failed_3').show();
						$('#loan_pay_date').prop('disabled', true);
						$('#loan_pay_date').val('');
						// $('#total_additional_cc').prop('disabled', true);
						$('#pay_value').prop('disabled', false);
						}
					}

					if (save.conds == true ) {
						$('#pay_value').prop('disabled', false);
					} else {
						$('#pay_value').prop('disabled', true);
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
							if (Ext.Cmp('FlagType').getValue() != 'ADV') {
								$('#cdd-tabs').removeClass("ui-state-disabled")
							} else {
								$('#product-tabs').removeClass("ui-state-disabled")
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
	var val = Ext.Cmp('pay_value').getValue();
	var readycheck = 0;
	
	if(val=="" || val==null){
		alert('BEsar cicilan Field is Empty!');
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
						if(save.attempt==1){
                                    $('#ask_6_default_1').hide();
                                    $('#ask_6_success_1').show();
                                    $('#pay_value').prop('disabled', true);
									$('#pay_value').val('');
                                }else if(save.attempt==2){
                                    $('#ask_6_default_2').hide();
                                    $('#ask_6_success_2').show();
                                    $('#pay_value').prop('disabled', true);
									$('#pay_value').val('');
                                }else if(save.attempt==3){
                                    $('#ask_6_default_3').hide();
                                    $('#ask_6_success_3').show();
                                    $('#pay_value').prop('disabled', true);
									$('#pay_value').val('');
                                }
					} else {
						if(save.attempt==1){
						$('#ask_6_default_1').hide();
						$('#ask_6_failed_1').show();
						$('#pay_value').focus();
						}else if(save.attempt==2){
						$('#ask_6_default_2').hide();
						$('#ask_6_failed_2').show();
                        $('#pay_value').focus();
						// $('#total_additional_cc').focus();
						}else if(save.attempt==3){
						$('#ask_6_default_3').hide();
						$('#ask_6_failed_3').show();
						$('#pay_value').prop('disabled', true);
						$('#pay_value').val('');
						// $('#total_additional_cc').prop('disabled', true);
						}
					}

					if (save.conds == true) {
						$('#pay_value').prop('disabled', true);
					} else {
						$('#pay_acc').prop('disabled', true);
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
							if (Ext.Cmp('FlagType').getValue() != 'ADV') {
								$('#cdd-tabs').removeClass("ui-state-disabled")
							} else {
								$('#product-tabs').removeClass("ui-state-disabled")
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
						$('#CallStatus_chosen').val(3);
						$('#CallResult').append("<option value='9'>Reject Verification</option>");
						$('#CallResult').val(9);
						$('#CallStatus_chosen').trigger("chosen:updated");
						$('#CallResult').prop('disabled', true).trigger("chosen:updated");
					}

					if (save.verified == true) {
						$('#default').hide();
						$('#rejected').hide();
						$('#verified').show();

						if (Ext.Cmp('CampaignId').getValue() == 5 || Ext.Cmp('CampaignId').getValue() == 6 || Ext.Cmp('CampaignId').getValue() == 9) {
							if (Ext.Cmp('FlagType').getValue() != 'ADV') {
								$('#cdd-tabs').removeClass("ui-state-disabled")
							} else {
								$('#product-tabs').removeClass("ui-state-disabled")
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
?>
<?php echo form()->hidden('Mode',NULL,$param['Mode']);?>

<form name="frm_verification">
	<?php //var_dump($check_data->CustomerHomePhoneNum);?>
	<!--HEADER VERIFICATION-->
	<div style="margin-bottom:15px;margin-top:-10px;">
		<div class="ui-widget-form-table-compact">
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell" style="font-size:15pt;">
					<i class="fa fa-check-square-o" aria-hidden="true"></i>
					<?php
						$_v_res = (isset($result['ver_result'])?$result['ver_result']:0); 

						// print_r($status);
						
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

	<fieldset class="corner" style="margin-bottom:15px;">
		<?php echo form()->legend(lang(array('Pertanyaan')), "fa-tasks"); ?>
		<div class="ui-widget-form-table-compact">
			<!--INPUT ADDITIONAL CC-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Punya kartu kredit tambahan di HSBC?'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<?php echo form() -> combo('additional_cc','select long', array('1'=>'YES','0'=>'NO'), $v_i_additional_cc, array("change"=>"showTotalAcc()"), (isset($result['ver_result'])?array('disabled'=>true):$x_i_additional_cc) );?>
					<input type="text" name="total_additional_cc" class="input_text long numeric" id="total_additional_cc" style="padding-left:10px;width:160px;" placeholder="" hidden>
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_cust_dob1" 
						class="btn btn-success btn-sm" id="ask_1_button" onclick="Ext.DOM.CheckAsk_1('ask_1');" 
					title="Verify" id="ver1">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_cust_dob" class="ui-widget-form-cell left">
					<b style="color:green;" id="ask_1_success_1" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_1_failed_1" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_1_default_1"><i class="fa fa-minus" aria-hidden="true"></i></b>
					<b style="color:green;" id="ask_1_success_2" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_1_failed_2" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_1_default_2"><i class="fa fa-minus" aria-hidden="true"></i></b>
					<b style="color:green;" id="ask_1_success_3" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_1_failed_3" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_1_default_3"><i class="fa fa-minus" aria-hidden="true"></i></b>
				</div>
			</div>
			<!--END OF INPUT ADDITIONAL CC-->

			<!--INPUT LIMIT CC-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Besar pinjaman dari Personal Loan HSBC Bapak/Ibu?'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="ori_loan" id="ori_loan" class="input_text long" style="padding-left:10px;" placeholder="">
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_cust_dob" 
						class="btn btn-success btn-sm" id="ask_2_button" onclick="Ext.DOM.CheckAsk_2('ask_2');" title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_cust_dob" class="ui-widget-form-cell left">
					<b style="color:green;" id="ask_2_success_1" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_2_failed_1" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_2_default_1"><i class="fa fa-minus" aria-hidden="true"></i></b>
					<b style="color:green;" id="ask_2_success_2" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_2_failed_2" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_2_default_2"><i class="fa fa-minus" aria-hidden="true"></i></b>
					<b style="color:green;" id="ask_2_success_3" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_2_failed_3" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_2_default_3"><i class="fa fa-minus" aria-hidden="true"></i></b>
				</div>
			</div>
			<!--END OF INPUT LIMIT CC-->

			<!--INPUT EXPIRY DATE CC-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Nomor telpon rumah Bapak/Ibu?'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="phone_num" id="phone_num" class="input_text long" placeholder="">
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_cust_dob" 
						class="btn btn-success btn-sm" id="ask_3_button" onclick="Ext.DOM.CheckAsk_3('ask_3');" title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_cust_dob" class="ui-widget-form-cell left">
					<b style="color:green;" id="ask_3_success_1" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_3_failed_1" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_3_default_1"><i class="fa fa-minus" aria-hidden="true"></i></b>
					<b style="color:green;" id="ask_3_success_2" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_3_failed_2" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_3_default_2"><i class="fa fa-minus" aria-hidden="true"></i></b>
					<b style="color:green;" id="ask_3_success_3" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_3_failed_3" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_3_default_3"><i class="fa fa-minus" aria-hidden="true"></i></b>
				</div>
			</div>
			<!--END OF EXPIRY DATE CC-->

			<!--INPUT NO TELP -->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Nomor rekening Personal Loan HSBC Bapak/Ibu? (payment account)'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="pay_acc" id="pay_acc" class="input_text long " placeholder="">
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_cust_dob" 
						class="btn btn-success btn-sm" id="ask_4_button" onclick="Ext.DOM.CheckAsk_4('ask_4');" title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_cust_dob" class="ui-widget-form-cell left">
					<b style="color:green;" id="ask_4_success_1" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_4_failed_1" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_4_default_1"><i class="fa fa-minus" aria-hidden="true"></i></b>
					<b style="color:green;" id="ask_4_success_2" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_4_failed_2" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_4_default_2"><i class="fa fa-minus" aria-hidden="true"></i></b>
					<b style="color:green;" id="ask_4_success_3" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_4_failed_3" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_4_default_3"><i class="fa fa-minus" aria-hidden="true"></i></b>
				</div>
			</div>
			<!--END OF INPUT NO TELP -->

			<!--INPUT JENIS KARTU KREDIT -->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Tanggal pembayaran cicilan Personal Loan HSBC Bapak/Ibu?'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<input type="text" name="loan_pay_date" id="loan_pay_date" class="input_text long" placeholder="" style="width:100px">
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_cust_dob" 
						class="btn btn-success btn-sm" id="ask_5_button" onclick="Ext.DOM.CheckAsk_5('ask_5');" title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_cust_dob" class="ui-widget-form-cell left">
					<b style="color:green;" id="ask_5_success_1" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_5_failed_1" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_5_default_1"><i class="fa fa-minus" aria-hidden="true"></i></b>
					<b style="color:green;" id="ask_5_success_2" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_5_failed_2" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_5_default_2"><i class="fa fa-minus" aria-hidden="true"></i></b>
					<b style="color:green;" id="ask_5_success_3" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_5_failed_3" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_5_default_3"><i class="fa fa-minus" aria-hidden="true"></i></b>
				</div>
			</div>
			<!--END OF INPUT JENIS KARTU KREDIT -->

			<!--INPUT JENIS KARTU KREDIT 2 -->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Besar cicilan yang harus dibayarkan per bulannya dari Personal Loan HSBC Bapak/Ibu?'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
                <input type="text" name="pay_value" id="pay_value" class="input_text long" placeholder="" style="width:100px">
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_cust_dob" 
						class="btn btn-success btn-sm" id="ask_6_button" onclick="Ext.DOM.CheckAsk_6('ask_6');" title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_cust_dob" class="ui-widget-form-cell left">
					<b style="color:green;" id="ask_6_success_1" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_6_failed_1" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_6_default_1"><i class="fa fa-minus" aria-hidden="true"></i></b>
					<b style="color:green;" id="ask_6_success_2" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_6_failed_2" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_6_default_2"><i class="fa fa-minus" aria-hidden="true"></i></b>
					<b style="color:green;" id="ask_6_success_3" hidden><i class="fa fa-check"></i></b>
					<b style="color:red;" id="ask_6_failed_3" hidden><i class="fa fa-close"></i></b>
					<b style="color:blue;" id="ask_6_default_3"><i class="fa fa-minus" aria-hidden="true"></i></b>
				</div>
			</div>
			<!--END OF INPUT JENIS KARTU KREDIT 2 -->

		</div>
	</fieldset>
	
</form>
