<script>
$(document).ready( function()
{
	$('#i_card_exp').mask("00/00", { placeholder: "__/__"});
	$('#i_cust_dob').mask("00-00-0000", { placeholder: "__-__-____"});
	
	// $('#i_cust_dob').datepicker ({
		// dateFormat : 'dd-mm-yy',
		// changeYear : true, 
		// changeMonth : true,
		// yearRange: "-65:+65",
		// maxDate : "0",
		// minDate : "-65y",
	// });
	
	$(".money").keyup(function(){
		var id = $(this).attr('id');
		var text = Ext.Cmp(id).getValue();
		
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
	
	Ext.DOM.TriggerOpenForm();
});

Ext.DOM.TriggerOpenForm = function()
{
	var RESULT = Ext.Cmp('ver_status').getValue();
		
	if(RESULT=='2'){ // rejected
		var REJECT = ( Ext.Ajax ({
			url 	: Ext.DOM.INDEX +'/SrcCustomerList/get_reject_status/',
			method 	: 'GET',
			param 	: {}
		}).json());
		// console.log(REJECT);
		Ext.Cmp('CallStatus').setValue(REJECT.RESULT);
		getCallReasultId(Ext.Cmp('CallStatus').getElementId());
		Ext.Cmp('CallResult').setValue(REJECT.STATUS); 
		Ext.Cmp('CallStatus').disabled(true);
		Ext.Cmp('CallResult').disabled(true); 
		Ext.DOM.initFunc.isCallPhone = true;
		Ext.DOM.initFunc.isDial 	 = false;
		Ext.DOM.initFunc.isRunCall 	 = false;
		Ext.DOM.initFunc.isCancel 	 = false;
	}
	
	Ext.Cmp('VerifForm').setValue(RESULT);
	if(RESULT=='1'){
		$("#tabs").mytab().tabs().tabs("option", "disabled", []);
	}
	// else{
		// $("#tabs").mytab().tabs().tabs("option", "enabled", []);
	// }
	/* else{
		$("#tabs").mytab().tabs().tabs("option", "disabled", [2,3,4]);
	} */
}

Ext.DOM.CheckVer = function(id)
{
	var dob = Ext.Cmp('i_cust_dob').getValue();
	var card= Ext.Cmp('i_card_number').getValue();
	var exp = Ext.Cmp('i_card_exp').getValue();
	var supp= Ext.Cmp('i_flag_supplement').getValue();
	var bill= Ext.Cmp('i_bill_address').getValue();
	var readycheck = 0;
	
	if(id=="cust_dob"){
		if(dob=="" || dob==null){
			alert('DOB Field is Empty!');
			readycheck = 0;
			return false;
		}else{
			readycheck = 1;
		}
	}else if(id=="card_number"){
		if(card=="" || card==null){
			alert('Card Number is Empty!');
			readycheck = 0;
			return false;
		}else{
			readycheck = 1;
		}
	}else if(id=="card_exp"){
		if(exp=="" || exp==null){
			alert('Card Expired is Empty!');
			readycheck = 0;
			return false;
		}else{
			readycheck = 1;
		}
	}else if(id=="flag_supplement"){
		if(supp=="" || supp==null){
			alert('Supplementary Card is Empty!');
			readycheck = 0;
			return false;
		}else{
			readycheck = 1;
		}
	}else if(id=="bill_address"){
		if(bill=="" || bill==null){
			alert('Billing Statement is Empty!');
			readycheck = 0;
			return false;
		}else{
			readycheck = 1;
		}
	}else{
		readycheck = 0;
	}
	
	if(readycheck == 1){
		var Controller = Ext.Cmp('ViewVerification').getValue();
		var PARAM = [];
		PARAM['CustomerId'] = Ext.Cmp('CustomerId').getValue();
		PARAM['InputId'] 	= id;
		
		Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller,'save_activity']).Apply(),
			method : 'POST',
			param 	: Ext.Join(new Array
				( 
					Ext.Serialize('frm_verification').getElement(),
					PARAM 
				)).object(),
			ERROR  : function(fn)
			{
				Ext.Util(fn).proc(function(save){
					Ext.DOM.LoadVerification();
				});
			}
		}).post();
	}else{
		return false;
	}
}

Ext.DOM.CheckPhone = function(id)
{
	var phonenumber = Ext.Cmp('i_phone_number').getValue();
	var readycheck = 0;
	
	if(id=="phone_number"){
		if(phonenumber == "" || phonenumber == null){
			alert('Phone Number is Empty!');
			readycheck = 0;
			return false;
		}else{
			readycheck = 1;
		}
	}else{
		readycheck = 0;
	}
	
	if(readycheck==1){
		var Controller = Ext.Cmp('ViewVerification').getValue();
		var PARAM = [];
		PARAM['CustomerId'] = Ext.Cmp('CustomerId').getValue();
		PARAM['InputId'] 	= id;
		
		Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller,'save_ver_phone']).Apply(),
			method : 'POST',
			param 	: Ext.Join(new Array
				( 
					Ext.Serialize('frm_verification').getElement(),
					PARAM 
				)).object(),
			ERROR  : function(fn)
			{
				Ext.Util(fn).proc(function(save){
					Ext.DOM.LoadVerification();
				});
			}
		}).post();
	}else{
		return false;
	}
}

Ext.DOM.CrLimit = function(id)
{
	var crelim = Ext.Cmp('i_credit_limit').getValue();
	var readycheck = 0;
	
	if(id=="credit_limit"){
		if(crelim == "" || crelim == null){
			alert('Credit Limit is Empty!');
			readycheck = 0;
			return false;
		}else{
			readycheck = 1;
		}
	}else{
		readycheck = 0;
	}
	
	if(readycheck==1){
		var Controller = Ext.Cmp('ViewVerification').getValue();
		var _FORM = Ext.Serialize('frm_verification').getElement();
		var PARAM = [];
		
		PARAM['CustomerId'] = Ext.Cmp('CustomerId').getValue();
		PARAM['InputId'] 	= id;
		
		_FORM['i_credit_limit'] = Ext.Money(_FORM['i_credit_limit']).ToInt();
		
		Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller,'save_ver_crlimit']).Apply(),
			method : 'POST',
			param 	: Ext.Join(new Array
				( 
					_FORM,
					PARAM 
				)).object(),
			ERROR  : function(fn)
			{
				Ext.Util(fn).proc(function(save){
					Ext.DOM.LoadVerification();
				});
			}
		}).post();
	}else{
		return false;
	}
}

Ext.DOM.DueDate = function(id)
{
	var duedate = Ext.Cmp('i_due_date').getValue();
	var readycheck = 0;
	
	if(id=="due_date"){
		if(duedate == "" || duedate == null){
			alert('Due Date is Empty!');
			readycheck = 0;
			return false;
		}else{
			readycheck = 1;
		}
	}else{
		readycheck = 0;
	}
	
	if(readycheck==1){
		var Controller = Ext.Cmp('ViewVerification').getValue();
		var PARAM = [];
		PARAM['CustomerId'] = Ext.Cmp('CustomerId').getValue();
		PARAM['InputId'] 	= id;
		
		Ext.Ajax
		({
			url 	: Ext.EventUrl([Controller,'save_ver_duedate']).Apply(),
			method : 'POST',
			param 	: Ext.Join(new Array
				( 
					Ext.Serialize('frm_verification').getElement(),
					PARAM 
				)).object(),
			ERROR  : function(fn)
			{
				Ext.Util(fn).proc(function(save){
					Ext.DOM.LoadVerification();
				});
			}
		}).post();
	}else{
		return false;
	}
}
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
					<?php
					switch($_v_res)
					{
						case 1:
						if($campaign['CampaignId'] == 9) {
						?>
						<script>
							var address = confirm("Is The Address Correct With This ? \n <?php echo $alamatVerif['alamat']; ?>");
							if (address == true) {
								Ext.Cmp('bolAddress').setValue(1);
								bolAddress = 1;
							} else {
								Ext.Cmp('bolAddress').setValue(2);
								bolAddress = 2;
							}
						</script>
						<?php }?>
						
						<b style="color:green;">VERIFIED</b><?php
						break;
						
						case 2:
						?><b style="color:red;">REJECTED</b><?php
						break;
						
						default:
						?><b style="color:blue;">NOT PASSED</b><?php
						break;
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<!--END OF HEADER VERIFICATION-->
	
	
	<fieldset class="corner" style="margin-bottom:15px;">
		<?php echo form()->legend(lang(array('SET','A')), "fa-tasks"); ?>
		<div class="ui-widget-form-table-compact">
			<!--INPUT DOB-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Customer DOB (DD-MM-YYYY)'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<?php
					$v_a_cust_dob = (isset($input['cust_dob']['ver_attempt'])?$input['cust_dob']['ver_attempt']:0);
					$v_s_cust_dob = (isset($input['cust_dob']['ver_status'])?$input['cust_dob']['ver_status']:0);
					$f_s_cust_dob = (isset($input['cust_dob']['ver_status'])&&$input['cust_dob']['ver_status']!=0?'style="pointer-events:none;cursor:default;"':null);
					// $v_i_cust_dob = (isset($input['cust_dob']['ver_status'])&&$input['cust_dob']['ver_status']==1?$input['cust_dob']['ver_input']:null);
					$x_i_cust_dob = (isset($input['cust_dob']['ver_status'])&&$input['cust_dob']['ver_status']!=0?array('disabled'=>true):null);
				?>
				<div class="ui-widget-form-cell left">
					<?php echo form() -> hidden('c_cust_dob',null, 1);?>
					<?php echo form() -> hidden('a_cust_dob',null, $v_a_cust_dob);?>
					<?php echo form() -> hidden('s_cust_dob',null, $v_s_cust_dob);?>
					<?php echo form() -> hidden('o_cust_dob',null, _getDateIndonesia($datas['CustomerDOB']) );?>
					<?php echo form() -> input('i_cust_dob','input_text box', $v_i_cust_dob, null, (isset($result['ver_result'])?array('disabled'=>true):$x_i_cust_dob) );?>
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_cust_dob" 
						class="btn btn-success btn-sm" 
						<?=(isset($result['ver_result'])?'style="pointer-events:none;cursor:default;"':$f_s_cust_dob)?> 
						onclick="Ext.DOM.CheckVer('cust_dob');" 
					title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_cust_dob" class="ui-widget-form-cell left">
					<?php
						switch($v_s_cust_dob)
						{
							case 1:
								?><b style="color:green;"><i class="fa fa-check" aria-hidden="true"></i> (<?=$v_a_cust_dob?>)</b><?php
							break;
							
							case 2:
								?><b style="color:red;"><i class="fa fa-close" aria-hidden="true"></i> (<?=$v_a_cust_dob?>)</b><?php
							break;
							
							default :
								?><b style="color:blue;"><i class="fa fa-minus" aria-hidden="true"></i> (<?=$v_a_cust_dob?>)</b><?php
							break;
						}
					?>
				</div>
			</div>
			<!--END OF INPUT DOB-->
		</div>
	</fieldset>

	<fieldset class="corner" style="margin-bottom:15px;">
		<?php echo form()->legend(lang(array('SET','B')), "fa-tasks"); ?>
		<div class="ui-widget-form-table-compact">
			<!--INPUT CARD NUMBER-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Card Number'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<?php
					$v_a_card_number = (isset($input['card_number']['ver_attempt'])?$input['card_number']['ver_attempt']:0);
					$v_s_card_number = (isset($input['card_number']['ver_status'])?$input['card_number']['ver_status']:0);
					$f_s_card_number = (isset($input['card_number']['ver_status'])&&$input['card_number']['ver_status']!=0?'style="pointer-events:none;cursor:default;"':$_klik_a);
					// $v_i_card_number = (isset($input['card_number']['ver_status'])&&$input['card_number']['ver_status']==1?$input['card_number']['ver_input']:null);
					$x_i_card_number = (isset($input['card_number']['ver_status'])&&$input['card_number']['ver_status']!=0?array('disabled'=>true):$_urut_a);
				?>
				<div class="ui-widget-form-cell left">
					<?php echo form() -> hidden('c_card_number',null, 2);?>
					<?php echo form() -> hidden('a_card_number',null, $v_a_card_number);?>
					<?php echo form() -> hidden('s_card_number',null, $v_s_card_number);?>
					<?php echo form() -> hidden('o_card_number',null, $datas['card_no']);?>
					<?php echo form() -> input('i_card_number','input_text long numeric', $v_i_card_number, null, (isset($result['ver_result'])?array('disabled'=>true):$x_i_card_number) );?>
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_card_number" 
						class="btn btn-success btn-sm" 
						<?=(isset($result['ver_result'])?'style="pointer-events:none;cursor:default;"':$f_s_card_number)?> 
						onclick="Ext.DOM.CheckVer('card_number');" 
					title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_card_number" class="ui-widget-form-cell left">
					<?php
						switch($v_s_card_number)
						{
							case 1:
								?><b style="color:green;"><i class="fa fa-check" aria-hidden="true"></i> (<?=$v_a_card_number?>)</b><?php
							break;
							
							case 2:
								?><b style="color:red;"><i class="fa fa-close" aria-hidden="true"></i> (<?=$v_a_card_number?>)</b><?php
							break;
							
							default :
								?><b style="color:blue;"><i class="fa fa-minus" aria-hidden="true"></i> (<?=$v_a_card_number?>)</b><?php
							break;
						}
					?>
				</div>
			</div>
			<!--END OF INPUT CARD NUMBER-->
			
			<!--INPUT CREDIT LIMIT-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Credit Limit'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<?php
					$v_a_credit_limit = (isset($input['credit_limit']['ver_attempt'])?$input['credit_limit']['ver_attempt']:0);
					$v_s_credit_limit = (isset($input['credit_limit']['ver_status'])?$input['credit_limit']['ver_status']:0);
					$f_s_credit_limit = (isset($input['credit_limit']['ver_status'])&&$input['credit_limit']['ver_status']!=0?'style="pointer-events:none;cursor:default;"':$_klik_a);
					// $v_i_credit_limit = (isset($input['credit_limit']['ver_status'])&&$input['credit_limit']['ver_status']==1?number_format($input['credit_limit']['ver_input'],0,',','.'):0);
					$x_i_credit_limit = (isset($input['credit_limit']['ver_status'])&&$input['credit_limit']['ver_status']!=0?array('disabled'=>true):$_urut_a);
				?>
				<div class="ui-widget-form-cell left">
					<?php echo form() -> hidden('c_credit_limit',null, 1);?>
					<?php echo form() -> hidden('a_credit_limit',null, $v_a_credit_limit);?>
					<?php echo form() -> hidden('s_credit_limit',null, $v_s_credit_limit);?>
					<?php echo form() -> hidden('o_credit_limit',null, $datas['credit_limit']);?>
					<?php echo form() -> input('i_credit_limit','input_text long money', $v_i_credit_limit, null, (isset($result['ver_result'])?array('disabled'=>true):$x_i_credit_limit) );?>
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_credit_limit" 
						class="btn btn-success btn-sm" 
						<?=(isset($result['ver_result'])?'style="pointer-events:none;cursor:default;"':$f_s_credit_limit)?> 
						onclick="Ext.DOM.CrLimit('credit_limit');" 
					title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_credit_limit" class="ui-widget-form-cell left">
					<?php
						switch($v_s_credit_limit)
						{
							case 1:
								?><b style="color:green;"><i class="fa fa-check" aria-hidden="true"></i> (<?=$v_a_credit_limit?>)</b><?php
							break;
							
							case 2:
								?><b style="color:red;"><i class="fa fa-close" aria-hidden="true"></i> (<?=$v_a_credit_limit?>)</b><?php
							break;
							
							default :
								?><b style="color:blue;"><i class="fa fa-minus" aria-hidden="true"></i> (<?=$v_a_credit_limit?>)</b><?php
							break;
						}
					?>
				</div>
			</div>
			<!--END OF INPUT CREDIT LIMIT-->
			
			<!--INPUT DUE DATE-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Due Date (DD)'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<?php
					$v_a_due_date = (isset($input['due_date']['ver_attempt'])?$input['due_date']['ver_attempt']:0);
					$v_s_due_date = (isset($input['due_date']['ver_status'])?$input['due_date']['ver_status']:0);
					$f_s_due_date = (isset($input['due_date']['ver_status'])&&$input['due_date']['ver_status']!=0?'style="pointer-events:none;cursor:default;"':$_klik_a);
					// $v_i_due_date = (isset($input['due_date']['ver_status'])&&$input['due_date']['ver_status']==1?$input['due_date']['ver_input']:null);
					$x_i_due_date = (isset($input['due_date']['ver_status'])&&$input['due_date']['ver_status']!=0?array('disabled'=>true):(is_null($_urut_a)?array('length'=>2):$_urut_a));
				?>
				<div class="ui-widget-form-cell left">
					<?php echo form() -> hidden('c_due_date',null, 1);?>
					<?php echo form() -> hidden('a_due_date',null, $v_a_due_date);?>
					<?php echo form() -> hidden('s_due_date',null, $v_s_due_date);?>
					<?php echo form() -> hidden('o_due_date',null, $datas['due_date']);?>
					<?php echo form() -> input('i_due_date','input_text long numeric', $v_i_due_date, null, (isset($result['ver_result'])?array('disabled'=>true):$x_i_due_date) );?>
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_due_date" 
						class="btn btn-success btn-sm" 
						<?=(isset($result['ver_result'])?'style="pointer-events:none;cursor:default;"':$f_s_due_date)?> 
						onclick="Ext.DOM.DueDate('due_date');" 
					title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_due_date" class="ui-widget-form-cell left">
					<?php
						switch($v_s_due_date)
						{
							case 1:
								?><b style="color:green;"><i class="fa fa-check" aria-hidden="true"></i> (<?=$v_a_due_date?>)</b><?php
							break;
							
							case 2:
								?><b style="color:red;"><i class="fa fa-close" aria-hidden="true"></i> (<?=$v_a_due_date?>)</b><?php
							break;
							
							default :
								?><b style="color:blue;"><i class="fa fa-minus" aria-hidden="true"></i> (<?=$v_a_due_date?>)</b><?php
							break;
						}
					?>
				</div>
			</div>
			<!--END OF INPUT DUE DATE-->
			
			<!--INPUT CARD EXPIRE-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Card Expired (MM/YY)'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<?php
					$v_a_card_exp = (isset($input['card_exp']['ver_attempt'])?$input['card_exp']['ver_attempt']:0);
					$v_s_card_exp = (isset($input['card_exp']['ver_status'])?$input['card_exp']['ver_status']:0);
					$f_s_card_exp = (isset($input['card_exp']['ver_status'])&&$input['card_exp']['ver_status']!=0?'style="pointer-events:none;cursor:default;"':$_klik_a);
					// $v_i_card_exp = (isset($input['card_exp']['ver_status'])&&$input['card_exp']['ver_status']==1?$input['card_exp']['ver_input']:null);
					$x_i_card_exp = (isset($input['card_exp']['ver_status'])&&$input['card_exp']['ver_status']!=0?array('disabled'=>true):(is_null($_urut_a)?array('length'=>5):$_urut_a));
				?>
				<div class="ui-widget-form-cell left">
					<?php echo form() -> hidden('c_card_exp',null, 1);?>
					<?php echo form() -> hidden('a_card_exp',null, $v_a_card_exp);?>
					<?php echo form() -> hidden('s_card_exp',null, $v_s_card_exp);?>
					<?php echo form() -> hidden('o_card_exp',null, $datas['card_exp']);?>
					<?php echo form() -> input('i_card_exp','input_text long', $v_i_card_exp, null, (isset($result['ver_result'])?array('disabled'=>true):$x_i_card_exp) );?>
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_card_exp" 
						class="btn btn-success btn-sm" 
						<?=(isset($result['ver_result'])?'style="pointer-events:none;cursor:default;"':$f_s_card_exp)?> 
						onclick="Ext.DOM.CheckVer('card_exp');" 
					title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_card_exp" class="ui-widget-form-cell left">
					<?php
						switch($v_s_card_exp)
						{
							case 1:
								?><b style="color:green;"><i class="fa fa-check" aria-hidden="true"></i> (<?=$v_a_card_exp?>)</b><?php
							break;
							
							case 2:
								?><b style="color:red;"><i class="fa fa-close" aria-hidden="true"></i> (<?=$v_a_card_exp?>)</b><?php
							break;
							
							default :
								?><b style="color:blue;"><i class="fa fa-minus" aria-hidden="true"></i> (<?=$v_a_card_exp?>)</b><?php
							break;
						}
					?>
				</div>
			</div>
			<!--END OF INPUT CARD EXPIRE-->
			
			<!--INPUT PHONE NUMBER-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Phone Number'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<?php
					$v_a_phone_number = (isset($input['phone_number']['ver_attempt'])?$input['phone_number']['ver_attempt']:0);
					$v_s_phone_number = (isset($input['phone_number']['ver_status'])?$input['phone_number']['ver_status']:0);
					$f_s_phone_number = (isset($input['phone_number']['ver_status'])&&$input['phone_number']['ver_status']!=0?'style="pointer-events:none;cursor:default;"':$_klik_a);
					// $v_i_phone_number = (isset($input['phone_number']['ver_status'])&&$input['phone_number']['ver_status']==1?$input['phone_number']['ver_input']:null);
					$x_i_phone_number = (isset($input['phone_number']['ver_status'])&&$input['phone_number']['ver_status']!=0?array('disabled'=>true):$_urut_a);
				?>
				<div class="ui-widget-form-cell left">
					<?php echo form() -> hidden('c_phone_number',null, 1);?>
					<?php echo form() -> hidden('a_phone_number',null, $v_a_phone_number);?>
					<?php echo form() -> hidden('s_phone_number',null, $v_s_phone_number);?>
					<?php echo form() -> hidden('o_phone_number_1',null, $datas['CustomerHomePhoneNum']);?>
					<?php echo form() -> hidden('o_phone_number_2',null, $datas['CustomerMobilePhoneNum']);?>
					<?php echo form() -> hidden('o_phone_number_3',null, $datas['CustomerWorkPhoneNum']);?>
					<?php echo form() -> input('i_phone_number','input_text long numeric', $v_i_phone_number, null, (isset($result['ver_result'])?array('disabled'=>true):$x_i_phone_number) );?>
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_phone_number" 
						class="btn btn-success btn-sm" 
						<?=(isset($result['ver_result'])?'style="pointer-events:none;cursor:default;"':$f_s_phone_number)?> 
						onclick="Ext.DOM.CheckPhone('phone_number');" 
					title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_phone_number" class="ui-widget-form-cell left">
					<?php
						switch($v_s_phone_number)
						{
							case 1:
								?><b style="color:green;"><i class="fa fa-check" aria-hidden="true"></i> (<?=$v_a_phone_number?>)</b><?php
							break;
							
							case 2:
								?><b style="color:red;"><i class="fa fa-close" aria-hidden="true"></i> (<?=$v_a_phone_number?>)</b><?php
							break;
							
							default :
								?><b style="color:blue;"><i class="fa fa-minus" aria-hidden="true"></i> (<?=$v_a_phone_number?>)</b><?php
							break;
						}
					?>
				</div>
			</div>
			<!--END OF INPUT PHONE NUMBER-->
		</div>
	</fieldset>

	<fieldset class="corner" style="margin-bottom:15px;">
		<?php echo form()->legend(lang(array('SET','C')), "fa-tasks"); ?>
		<div class="ui-widget-form-table-compact">
			<!--INPUT SUPPLEMENT-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Have Supplementry Card'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<?php
					$v_a_flag_supplement = (isset($input['flag_supplement']['ver_attempt'])?$input['flag_supplement']['ver_attempt']:0);
					$v_s_flag_supplement = (isset($input['flag_supplement']['ver_status'])?$input['flag_supplement']['ver_status']:0);
					$f_s_flag_supplement = (isset($input['flag_supplement']['ver_status'])&&$input['flag_supplement']['ver_status']!=0?'style="pointer-events:none;cursor:default;"':$_klik_b);
					$v_i_flag_supplement = (isset($input['flag_supplement']['ver_status'])&&$input['flag_supplement']['ver_status']==1?$input['flag_supplement']['ver_input']:null);
					$x_i_flag_supplement = (isset($input['flag_supplement']['ver_status'])&&$input['flag_supplement']['ver_status']!=0?array('disabled'=>true):$_urut_b);
				?>
				<div class="ui-widget-form-cell left">
					<?php echo form() -> hidden('c_flag_supplement',null, 1);?>
					<?php echo form() -> hidden('a_flag_supplement',null, $v_a_flag_supplement);?>
					<?php echo form() -> hidden('s_flag_supplement',null, $v_s_flag_supplement);?>
					<?php echo form() -> hidden('o_flag_supplement',null, $datas['flag_suplement']);?>
					<?php echo form() -> combo('i_flag_supplement','select long', array('1'=>'YES','0'=>'NO'), $v_i_flag_supplement, null, (isset($result['ver_result'])?array('disabled'=>true):$x_i_flag_supplement) );?>
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_flag_supplement" 
						class="btn btn-success btn-sm" 
						<?=(isset($result['ver_result'])?'style="pointer-events:none;cursor:default;"':$f_s_flag_supplement)?> 
						onclick="Ext.DOM.CheckVer('flag_supplement');" 
					title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_flag_supplement" class="ui-widget-form-cell left">
					<?php
						switch($v_s_flag_supplement)
						{
							case 1:
								?><b style="color:green;"><i class="fa fa-check" aria-hidden="true"></i> (<?=$v_a_flag_supplement?>)</b><?php
							break;
							
							case 2:
								?><b style="color:red;"><i class="fa fa-close" aria-hidden="true"></i> (<?=$v_a_flag_supplement?>)</b><?php
							break;
							
							default :
								?><b style="color:blue;"><i class="fa fa-minus" aria-hidden="true"></i> (<?=$v_a_flag_supplement?>)</b><?php
							break;
						}
					?>
				</div>
			</div>
			<!--END OF INPUT SUPPLEMENT-->
			
			<!--INPUT BILLING STATEMENT-->
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Billing Statement Address'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<?php
					$v_a_bill_address = (isset($input['bill_address']['ver_attempt'])?$input['bill_address']['ver_attempt']:0);
					$v_s_bill_address = (isset($input['bill_address']['ver_status'])?$input['bill_address']['ver_status']:0);
					$f_s_bill_address = (isset($input['bill_address']['ver_status'])&&$input['bill_address']['ver_status']!=0?'style="pointer-events:none;cursor:default;"':$_klik_b);
					$v_i_bill_address = (isset($input['bill_address']['ver_status'])&&$input['bill_address']['ver_status']==1?$input['bill_address']['ver_input']:null);
					$x_i_bill_address = (isset($input['bill_address']['ver_status'])&&$input['bill_address']['ver_status']!=0?array('disabled'=>true):$_urut_b);
				?>
				<div class="ui-widget-form-cell left">
					<?php echo form() -> hidden('c_bill_address',null, 1);?>
					<?php echo form() -> hidden('a_bill_address',null, $v_a_bill_address);?>
					<?php echo form() -> hidden('s_bill_address',null, $v_s_bill_address);?>
					<?php echo form() -> hidden('o_bill_address',null, $datas['billing_address']);?>
					<?php echo form() -> combo('i_bill_address','select long', array('1'=>'Paper Statement','2'=>'E-Statement'), $v_i_bill_address, null, (isset($result['ver_result'])?array('disabled'=>true):$x_i_bill_address) );?>
				</div>
				<div class="ui-widget-form-cell left">
					<a id="b_bill_address" 
						class="btn btn-success btn-sm" 
						<?=(isset($result['ver_result'])?'style="pointer-events:none;cursor:default;"':$f_s_bill_address)?> 
						onclick="Ext.DOM.CheckVer('bill_address');" 
					title="Verify">
							<i class="fa fa-check-square-o"></i>
					</a>
				</div>
				<div id="r_bill_address" class="ui-widget-form-cell left">
					<?php
						switch($v_s_bill_address)
						{
							case 1:
								?><b style="color:green;"><i class="fa fa-check" aria-hidden="true"></i> (<?=$v_a_bill_address?>)</b><?php
							break;
							
							case 2:
								?><b style="color:red;"><i class="fa fa-close" aria-hidden="true"></i> (<?=$v_a_bill_address?>)</b><?php
							break;
							
							default :
								?><b style="color:blue;"><i class="fa fa-minus" aria-hidden="true"></i> (<?=$v_a_bill_address?>)</b><?php
							break;
						}
					?>
				</div>
			</div>
			<!--END OF INPUT BILLING STATEMENT-->
		</div>
	</fieldset>
</form>