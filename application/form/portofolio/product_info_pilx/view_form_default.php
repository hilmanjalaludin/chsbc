<script>
/**
 * Enigma User Interface
 *
 * An open source application development framework for Web 2.0 or newer
 *
 * @package		Enigma User Interface *.js
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2017, razaki, Inc.
 * @license		http://razakitechnology.com/user_guide/license.html
 * @link		http://razakitechnology.com
 * @since		Version 1.3.20
 * @filesource
 */
// ----------------------------------------------------------------------------------------
 	
 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [@overider]
  */	
 Ext.DOM.getLoan = function(val)
{		
	var CustomerId = Ext.Cmp('CustomerId').getValue(),
	    protectData = Ext.EventUrl( new Array('ProductInfoPilx','getLoanPerVariable') );
	  
// please overider by spiner plugin dont event by ext.Ajax 
// cause have the "bugs ", load not perfected .
// will be cache not clear .
	  
	  $('#loans').Spiner ({
		  
		 url  	: protectData.Apply(),
		 method : 'GET',
		 param 	: {
				loansvar : val, 
				CustomerId:CustomerId
		 },
		 complete : function( protectedHtml ){
			$( protectedHtml ).css({ "height" : "100%" });
				// this must be selector replace by html 
				// class jQuery.  
			}
	  });	
}
	
 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [@overider]
  */	
	
Ext.DOM.IncomingColSet = function ()
{
	var incomecol = Ext.Cmp('incomecol').getValue();
	if(incomecol=="Belum Ada Income Doc"){
		Ext.Cmp('incomecol_yn').disabled(false);
		Ext.Cmp('incomecol_tp').disabled(true);
		Ext.Cmp('incomecol_tp_rng').disabled(true);
		Ext.Cmp('incomecol_tp_fix').disabled(true);
	}else{
			Ext.Cmp('incomecol_yn').disabled(true);
			Ext.Cmp('incomecol_tp').disabled(true);
			Ext.Cmp('incomecol_tp_rng').disabled(true);
			Ext.Cmp('incomecol_tp_fix').disabled(true);
		}
	}
		
 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [@overider]
  */
Ext.DOM.IncomingCol = function(){
		var incomecol = Ext.Cmp('incomecol_yn').getValue();
		if(incomecol == "Y"){
			Ext.Cmp('incomecol_tp').disabled(false);
			Ext.Cmp('incomecol_tp_rng').disabled(true);
			Ext.Cmp('incomecol_tp_fix').disabled(true);
		}else if(incomecol == "N"){
			Ext.Cmp('incomecol_tp').disabled(true);
			Ext.Cmp('incomecol_tp_rng').disabled(true);
			Ext.Cmp('incomecol_tp_fix').disabled(true);
			Ext.Cmp('incomecol_tp').setValue('');
			Ext.Cmp('incomecol_tp_rng').setValue('');
			Ext.Cmp('incomecol_tp_fix').setValue('');
		}
	}
	

	// Ext.DOM.tncpilx = function(value){
	// 	if(value=='NO'){
	// 		Ext.Cmp('tnc2').disabled(true);
	// 		document.getElementById("tnc2").value = "";
	// 	}else if (value=='YES'){
	// 		var ScriptId = '5';
	// 		var WindowScript = new Ext.Window 
	// 		({
	// 				url     : Ext.EventUrl(['SetProductScript','ShowProductScriptpilx']).Apply(), 
	// 				name    : 'WinProduct',
	// 				height  : ($(window).innerHeight()),
	// 				width   : ($(window).innerWidth() - ( $(window).innerWidth()/2 )),
	// 				left    : ($(window).innerWidth()/2),
	// 				top	    : ($(window).innerHeight()/2),
	// 				param   : {
	// 					ScriptId : ScriptId,
	// 					Time	 : Ext.Date().getDuration()
	// 				}
	// 			}).newtab();

	// 	// if( ScriptId =='' ) {
	// 	// 	window.close();
	// 	// }
	// 	Ext.Cmp('tnc2').disabled(false);
	// 	//Ext.Cmp('tnc2').value('TNC');
	// 	document.getElementById("tnc2").value = "TNC";
	// 	}else{
	// 		Ext.Cmp('tnc2').disabled(true);		
	// 	}
	// }
 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [@overider]
  */	
Ext.DOM.IncomingType = function(){
		var incomingtype = Ext.Cmp('incomecol_tp').getValue();
		if(incomingtype=="Fix"){
			Ext.Cmp('incomecol_tp_rng').disabled(true);
			Ext.Cmp('incomecol_tp_fix').disabled(false);
			Ext.Cmp('incomecol_tp_rng').setValue('');
		}else if(incomingtype=="Range"){
			Ext.Cmp('incomecol_tp_rng').disabled(false);
			Ext.Cmp('incomecol_tp_fix').disabled(true);
			Ext.Cmp('incomecol_tp_fix').setValue('');
		}
	}
	
 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [@overider]
  */	
Ext.DOM.CashbackSet = function (){
		var cashback = Ext.Cmp('cashback').getValue();
		if(cashback=="YES"){
			Ext.Cmp('cashback_yn').disabled(false);
		}else{
			Ext.Cmp('cashback_yn').disabled(true);
		}
	}
	
 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [@overider]
  */	
Ext.DOM.IncomeDocSet = function (){
		var cashback = Ext.Cmp('cashback').getValue();
		if(cashback=="YES"){
			Ext.Cmp('incomedoccollec').disabled(true);
		}else{
			Ext.Cmp('incomedoccollec').disabled(true); 
		}
	}
	
	
 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [@overider]
  */	
//tes rangga
Ext.DOM.getVerificationStatus = function (callback){
	var CustomerId = Ext.Cmp('CustomerId').getValue();
	Ext.Ajax({
		url		: Ext.EventUrl(new Array('ProductInfoPilx', 'getVerificationStatus')).Apply(),
		method	:'POST',
		param	:{CustomerId:CustomerId},
		ERROR	: function(fn){
			Ext.Util(fn).proc(function(result){
				// varoc = Verufstat.ver_result;
				console.log("Result test :"+result.ver_result);
				callback(result.ver_result);
				// if(Verufstat.ver_result==1){
					// $('#ButtonUserSave').show()
				// }else{
					// $('#ButtonUserSave').hide()
				// }
			});
		}
	}).post();
}

Ext.DOM.Fallback = function (verification){
	// alert(verification);
	if(verification){
		Ext.DOM.saveProductInfoPilx();
	}else{
		alert('Verifikasi Belum Lengkap!');
		return false;
	}
}
	
Ext.DOM.saveProductInfoPilx = function (){
		// var isVerif = Ext.DOM.getVerificationStatus(Ext.DOM.Fallback);
		// console.log(isVerif);
		// if(!isVerif){
		// 	alert('Verifikasi Belum Lengkap!');
		// 	return false;
		// }
		
		var lengthaccount = document.getElementById('benefaccount').value;
		var tnc2 = $("#tnc2").val();
		
		var checktnc2 = $("#tnc2").val();

		var checkLengthBenefbank = $("#benefaccount").val();
		checkLengthBenefbank = parseInt(checkLengthBenefbank.length)
		var minLenBenef = $("#benefaccount").attr("minlength");
		minLenBenef = parseInt(minLenBenef);

		if ( checkLengthBenefbank < minLenBenef ) {
			var clientMsg  = window.sprintf("Length benef Account is not more than %s minimal ( %s length)", minLenBenef, minLenBenef );
				window.alert( clientMsg );
			return false;
		}

	 //    if( Ext.Cmp('tnc').getValue() == '' ){
		// 	window.alert("tnc Type is kosong!");
		// 	return false;
			
		// }

		if( Ext.Cmp('tnc').getValue() == 'NO' ){
			window.alert("tnc Type not empty pilxsel");
			return false;
			
		}

		if( Ext.Cmp('tnc').getValue() == 0 ){
			window.alert("tnc Type not empty 0 pilxsel !");
			return false;
		}	

		if(Ext.Cmp('benefname').getValue()==""){
			alert('Benef Name is empty!');
			return false;
		}else if(Ext.Cmp('benefbank').getValue()==""){
			alert('Benef Bank is empty!');
			return false;
		}else if(Ext.Cmp('benefaccount').getValue()==""){
			alert('Benef Account is empty!');
			return false;
		}/*else if(lengthaccount.length < 10){
			alert('Account Number less than Requirement!!');
			return false;
		}*/else if(Ext.Cmp('benefbranch').getValue()==""){
			alert('Benef Branch is empty!');
			return false;
		}else if($('input[name=key_tenor]:checked').val()==null){
			alert('Tenor is empty!');
			return false;
		}else{
			var select_tenor = $('input[name=key_tenor]:checked').val();
			var loan_amount = document.getElementById("LoanAmount_"+select_tenor).textContent;
			var Installment = document.getElementById("Installment_"+select_tenor).textContent;
			var Rate = document.getElementById("Rate_"+select_tenor).textContent;
			var AdminFee = document.getElementById("AdminFee_"+select_tenor).textContent;
			var DisburseAmount = document.getElementById("DisburseAmount_"+select_tenor).textContent;
			var pilprotect = document.getElementById("pilprotect").value;
			var incomeDoc_Collected = document.getElementById("incomeDoc_Collected").value;
			var tnc =Ext.Cmp('tnc').getValue();
			if ( incomeDoc_Collected != null ) {
				var r = confirm("Proccessing The Loan as !\nTenor : "+select_tenor+"\nLoan : "+loan_amount+
							"\nInstallment : "+Installment+"\nRate : "+Rate+"\nAdminFee : "+AdminFee+
							"\nDisbursement : "+DisburseAmount+"\nPil Protection : "+pilprotect+"\nIncome Doc Collected : "+incomeDoc_Collected+"\nAre You Sure?"
							);
			} else {
				var r = confirm("Proccessing The Loan as !\nTenor : "+select_tenor+"\nLoan : "+loan_amount+
							"\nInstallment : "+Installment+"\nRate : "+Rate+"\nAdminFee : "+AdminFee+
							"\nDisbursement : "+DisburseAmount+"\nPil Protection : "+pilprotect+"\nAre You Sure?"
							);
			}
			
			if (r == true) {
				Ext.Ajax({
					url		: Ext.EventUrl(new Array('ProductInfoPilx', 'saveLoan')).Apply(),
					method	:'POST',
					param	:Ext.Join(new Array( 
								Ext.Serialize('formProductInfo1').getElement(),
								Ext.Serialize('formProductInfo2').getElement(),
								Ext.Serialize('formProductInfo3').getElement(),
								Ext.Serialize('formProductInfo4').getElement()
							)).object(),
					ERROR  : function(fn){
						Ext.Util(fn).proc(function(save){
							if( save.success ) {
								Ext.Msg("Save Product Info").Success();
								Ext.Cmp('isSave').setValue('1');
								Ext.Cmp('InputForm').setValue('1');
							}else{
								Ext.Msg("Save Product Info").Failed();
							}
						});
					}
				}).post();
			} else {
				return false
			}
		}
	}
	
 /**
  * [_getDetailCustomer description]
  * @param  [type] $CustomerId [description]
  * @return [type]             [@overider]
  */
$(document).ready(function() {
	// $("#ButtonUserSave").hide()
// benef bank


        $("#tnc").change(function() {
            //console.log(Ext.Cmp('CustomerId').getValue());

			var value = $(this).val()
			
			if(value=='NO'){	
				Ext.Cmp('tnc2').disabled(true);
				document.getElementById("tnc2").value = "";
			}else if (value=='YES'){
				var ScriptId = Ext.Cmp('CampaignId').getValue();
				var WindowScript = new Ext.Window 
				({
						url     : Ext.EventUrl(['SetProductScript','ShowProductScriptpilx']).Apply(), 
						name    : 'WinProduct',
						height  : ($(window).innerHeight()),
						width   : ($(window).innerWidth() - ( $(window).innerWidth()/2 )),
						left    : ($(window).innerWidth()/2),
						top	    : ($(window).innerHeight()/2),
						param   : {
							ScriptId : ScriptId,
							Time	 : Ext.Date().getDuration()
						}
					}).newtab();

				// if( ScriptId =='' ) {
				// 	window.close();
				// }
				Ext.Cmp('tnc2').disabled(false);
				//Ext.Cmp('tnc2').value('TNC');
				document.getElementById("tnc2").value = "TNC";
			}else{
				Ext.Cmp('tnc2').disabled(true);		
			}	
		})


		$("#benefbank").change(function(){
		
		var valueBenef    = $(this).val(),
			BenefAccounts = $("#benefaccount"),
			protectDataSendurl = Ext.EventUrl( new Array('SrcCustomerList','getDigitBank', valueBenef) );  
				
				// Ext.DOM.INDEX + "/SrcCustomerList/getDigitBank/" + valueBenef;
			
			var getDigit = {
				url  	 : protectDataSendurl.Apply() , 
				type 	 : "POST" , 
				dataType : 'json' , 
				success  : function (digit) {

					// console.log(digit);

					var MinDigit = digit.minlength;
					var MaxDigit = digit.maxlength;

					$(BenefAccounts).attr('minlength',MinDigit);
					$(BenefAccounts).attr('maxlength',MaxDigit);
				}
			};
			
			$.ajax(getDigit);
		});
		
		
		$("#benefaccount").keydown(function (e) {
			// Allow: backspace, delete, tab, escape, enter and .
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
				 // Allow: Ctrl+A, Command+A
				(e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
				 // Allow: home, end, left, right, down, up
				(e.keyCode >= 35 && e.keyCode <= 40)) {
					 // let it happen, don't do anything
					 return;
			}
			// Ensure that it is a number and stop the keypress
			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
			}
		});
		$('#benefname').bind("cut copy paste",function(e) {
			e.preventDefault();
		});
		$('#benefaccount').bind("cut copy paste",function(e) {
			e.preventDefault();
		});
		$('#benefbranch').bind("cut copy paste",function(e) {
			e.preventDefault();
		});

		Ext.DOM.IncomingColSet();
		Ext.DOM.CashbackSet();
		Ext.DOM.IncomeDocSet();
		// Ext.DOM.getVerificationStatus();
	
		
		$(".money").keyup(function(){
				var id = $(this).attr('id');
				var text = Ext.Cmp(id).getValue();
				
				if(text!=''){
					text = Ext.Money(text).ToInt();
					Ext.Cmp(id).setValue(Ext.Money(text).ToDollar());
				}
				else{
					Ext.Cmp(id).setValue(0);
				}
			});
	});
	
	
	
	
</script>
<?php

	$newDate = date("d-m-Y", strtotime($param['CustomerDOB']));
	
	
	/* COMBO-COMBO */
	$coverage = array(2=>"Main Card Holder",4=>"Main & Spouse",3=>"Main & Child",1=>"Main & Family");
	$plan 	  = array(1=>"Infinite",2=>"Advance",3=>"Premiere");
	$sex 	  = array(1=>"Pria",2=>"Wanita");
	$incomecol= array('Y'=>'Yes', 'N'=>'No');
	$incomecol_tp = array('Fix'=>'Fix','Range'=>'Range');
	$incomecol_tp_range = array();
	for($i=1;$i<10;$i++){
		if($i == 1){
			$incomecol_tp_range[$i] = "< 3 Juta";
			$i+=1;
		}else{
			$incomecol_tp_range[$i] = $i." Juta";
		}
	}
	for($i=10;$i<=60;$i+=10){
		if($i > 10){
			if($i==60){
				$incomecol_tp_range['>50 Juta'] = ">50 Juta";
			}else{
				$incomecol_tp_range[($i-9)."-".$i." Juta"] = ($i-9)."-".$i." Juta";
			}
		}else{
			$incomecol_tp_range[$i." Juta"] = $i." Juta";
		}
	}
	/* END OF COMBO-COMBO */
	
?>

<fieldset class="corner" style="margin-bottom:15px;">
	<?php echo form()->legend(lang("Product Info Xsel"), "fa-tasks");?>
	<?php echo form()->hidden('isSave',NULL,(is_array($result)&&count($result)>0?1:0));?>
	<?php echo form()->hidden('Mode',NULL,$param['Mode']);?>
	<form name="formProductInfo1">
	<?php echo form()->hidden('CustomerId',NULL, $param['CustomerId'] );?>
	<div class="ui-widget-form-table-compact" style="width:99%;margin-top:-5px;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Use NPWP");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("typexsell", "select  tolong", array('Y'=>'YES','N'=>'NO'),'Y',null,array('disabled'=>'disabled'));?></div>
			
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Var. Tiering");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("vartiering", "select  tolong", array(50=>50,60=>60,70=>70,80=>80,100=>100),($frm['vartiering']>0?$frm['vartiering']:100),array("change"=>"Ext.DOM.getLoan(this.value)"));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("PIL Protection");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("pilprotect", "select tolong", array('Y'=>'Y','N'=>'N'),'N',null,array('disabled'=>'disabled'));?></div>
		</div>
		
	</div>
	
	
	<?php
	$incomeDoc_Collected = $result["incomeDocs_collected"];
	if ( $incomeDoc_Collected == 'Y' ) { ?>
	<div class="ui-widget-form-table" style="margin-top:-5px;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Income Doc Collected");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
			<?php 
			//print_r($result);
			//echo $result["incomeDocs_collected"];
			?>
			<?php echo form()->combo("incomeDoc_Collected", "select incomeDoc_Collected tolong", array('Y'=>'Y','N'=>'N'),'Y',null,'');?></div>
		</div>
	</div>
		
	<?php } else {
		echo form()->hidden('incomeDoc_Collected',NULL,NULL);
	}
	?>
	
	
	</form> 
<fieldset class="corner" style="margin-bottom:15px; border:0px solid #000;">
	<?php echo form()->hidden('isSave',NULL,(is_array($result)&&count($result)>0?1:0));?>
	<?php echo form()->hidden('Mode',NULL,$param['Mode']);?>
	<form name="formProductInfo2">
	<div id="loans">
	<?php 
		$arr_header = array(
			"Tenor"=> lang("Tenor"),
			"LoanAmount" => lang("Loan Amount"),
			"Installment" => lang("Monthly Installment"),
			"Rate"=> "Rate",
			"AdminFee"=> lang("Admin Fee"),
			"DisburseAmount"=> lang("Disburse Amount")
		);
		$arr_class = array(
			"Tenor"=> "content-middle",
			"LoanAmount" => "content-middle",
			"Installment" => "content-middle",
			"Rate"=> "content-middle",
			"AdminFee"=> "content-middle",
			"DisburseAmount"=> "content-lasted"
		);
		
		echo	"<table border=0 cellspacing=1 width=\"100%\">".
				"<tr height=\"30\"> ".
				"<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>". lang("label_data_no") ."</th>".
				"<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>#</th>";
		foreach( $arr_header as $field => $value ){
				echo "<th class=\"ui-corner-top ui-state-default th-lasted {$arr_align[$field]}\" width=\"{$arr_width[$field]}\"><span class=\"header_order\" title=\"Sort By {$value}\" onclick=\"Ext.DOM.CallHistory({page:0, orderby:'{$field}', type:'{$next_order}' });\">&nbsp;{$value}</span></th>";
		}
		echo "</tr>";

		$arr_num =1; $n = 0;
		if( is_array($loans) ){
			$no = 1;
			$tenor = 0;
			$checkedtenor = NULL;
			foreach( $loans as $num => $rows ){
				$row = new EUI_Object( $rows );
				$tenor = $row->get_value('Tenor',$arr_function['Tenor']);
				// if($tenor==6){
					// $tenor=0;
				// }
				$back_color = ( $num%2!=0 ? '#FFFFFF' :'#FFFEEE');
				if($frm['Tenor']==$tenor){
					$checkedtenor = array("checked"=>"checked");
				}else{
					$checkedtenor = NULL;
				}

				if ($tenor[0] == 3) {
					$font_color = 'blue';
				} else if ($tenor[0] == 6 || $tenor[0] ==12) {
					$font_color = 'black';
				} else if ($tenor[0] == 18) {
					$font_color = 'magenta';
				} else if ($tenor[0] == 24) {
					$font_color = 'red';
				} else {
					$font_color = 'green';
				}

				echo	"<tr bgcolor=\"{$back_color}\" style=\"color:{$font_color}\" class=\"onselect\" height=\"35\">".
						"<td class=\"content-first\" nowrap>{$no}</td>".
						"<td class=\"content-first\" nowrap>".form()->radio( "key_tenor", "content-first", $tenor, null, $checkedtenor)."</td>";
				foreach( array_keys($arr_header) as $k => $fields ){
					if(strtolower($fields) == 'tenor'){
						$numbers = $row->get_value($fields,$arr_function[$fields]);
						// if($numbers==6){
							// $numbers=0;
						// }
					}else{
						if(strtolower($fields) == 'rate'){
							$numbera = $row->get_value($fields,$arr_function[$fields])*100;
							$numbers = number_format($numbera, 2, '.', ',')."%";
						}else{
							// $numbers = number_format($row->get_value($fields,$arr_function[$fields]), 0, '.', ',');
							$loansvar = $frm['vartiering'];
							// $numbers = number_format($row->get_value($fields,$arr_function[$fields]), 0, '.', ',');
							$numbers = $row->get_value($fields,$arr_function[$fields]);
							if($loansvar>40){
								$loan = ($numbers * $loansvar)/100;
								$numbers = number_format($loan, 0, '.', ',');
							}else{
								$numbers = number_format($row->get_value($fields,$arr_function[$fields]), 0, '.', ',');
							}
						}
					}
					echo  "<td align='right' id=\"".$fields."_".$tenor."\" class=\"".$arr_class[$fields]." ui-widget-unselect-order ".$arr_align[$fields]."\" ".$arr_wrap[$fields].">".$numbers."</td>";
				}
				echo "</tr>";
				$no++;
			}
		}
		echo "</table>";
	?>
	</div>
	</form>
</fieldset>


<fieldset class="corner" style="margin-bottom:15px; border:0px solid #fff;">
	<?php echo form()->hidden('isSave',NULL,(is_array($result)&&count($result)>0?1:0));?>
	<?php echo form()->hidden('Mode',NULL,$param['Mode']);?>
	<?php echo form()->hidden('isVerif',NULL,$ver_result['ver_result']);?>
	<form name="formProductInfo3">
	<?php  ?>
	<div class="ui-widget-form-table" style="margin-top:-5px;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Benef Name");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("benefname", "select  tolong", $frm['BenefName'],null,array("change"=>"Ext.DOM.openCoverage(this.value)"));?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Benef Bank");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("benefbank", "select  tolong", $listbank,$frm['BenefBank'],null);?></div>
		</div>
         
         <?php  
            
         ?>
		 <div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Pembacaan TnC");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<select  name="tnc" id="tnc" class="select  tolong">
							<?php  if($frm['tnc']==='YES'){?> 
							<option value="0">Choose</option>
							<option selected="" value="YES">YES</option>
							<option value="NO">NO</option>
							<?php }else{ ?>
							<option value="0">Choose</option>
							<option value="YES">YES</option>
							<option value="NO">NO</option>
		    	<?php } ?>
				</select>	
			</div>
		</div>


			<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell">
			<span><p style="font-size: 10px;color: red ;font-weight:bold">(PASTIKAN PEMBACAAN TNC LENGKAP)</p></span>
			</div>
		</div>

	</div>
	
	<div class="ui-widget-form-table" style="margin-top:-5px;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Benef Account");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("benefaccount", "select  tolong",$frm['BenefAccount']);?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Benef branch");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("benefbranch", "select  tolong",$frm['BenefBranch']);?></div>
		</div>
	</div>
	<?php
		if($param['Mode']!='VIEW'){
		?>
		<div class="ui-widget-form-row" align="Right">
			<div class="ui-widget-form-cell">&nbsp;</div>
			<div class="ui-widget-form-cell">&nbsp;</div>
			<div class="ui-widget-form-cell" align="Right">
				<?php //echo form()->button("ButtonUserSave", "button save", lang('Save Prod. Info'), array('click' => 'Ext.DOM.saveProductInfoPilx();'));?>
				<?php 
				// if(_get_session('HandlingType')==4 || _get_session('HandlingType')==8){
						// echo form()->button("ButtonUserSave", "button save", lang('Save Prod. Info'), array('click' => 'Ext.DOM.saveProductInfoPilx();'));
						echo form()->button("ButtonUserSave", "button save", lang('Save Prod. Info'), array('click' => 'Ext.DOM.getVerificationStatus(Ext.DOM.Fallback);'));
				// }
				?>
			</div>
		</div>
		<div class="ui-widget-form-row" >
			<div class="ui-widget-form-cell">&nbsp;</div>
			<div class="ui-widget-form-cell">&nbsp;</div>
			<div class="ui-widget-form-cell" align="Right">
			    <input type="text" name="tnc2" id="tnc2" class="select  tolong" value="<?php echo $frm['tnc'] === 'YES' ? 'TNC' : '' ?>" disabled="" style="width: 110px">
 			</div>
			
		</div>
		<?php
		}
		?>

	</form>
</fieldset>

<fieldset class="corner" style="margin-bottom:15px;border:0px solid #fff;">
	<form name="formProductInfo4">
	<?php echo form()->hidden('incomecol',NULL,$result['Eligible_Pil_Protection']); //Eligible_PIL_Protection?>
	<?php echo form()->hidden('cashback', NULL,$result['flag_dormant']);?>
	<?php  ?>
	<div class="ui-widget-form-table" style="margin-top:-5px;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Income Collection");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("incomecol_yn", "select  tolong", $incomecol,$frm['Collection'],array("change"=>"Ext.DOM.IncomingCol();"));?></div>
			<div class="ui-widget-form-cell" align="Right"><?php echo form()->combo("incomecol_tp", "select", $incomecol_tp,$frm['CollectionType'],array("change"=>"Ext.DOM.IncomingType();"));?></div>
			<div class="ui-widget-form-cell"><?php echo form()->input("incomecol_tp_fix", "select middle money", $frm['incAmount'],null);?></div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("incomecol_tp_rng", "select middle", $incomecol_tp_range,$frm['incAmount'],null);?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Cash Back");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("cashback_yn", "select  tolong", $incomecol,$frm['isCashback'],null);?></div>
		</div>
	</div>
	</form>
</fieldset>

</fieldset>