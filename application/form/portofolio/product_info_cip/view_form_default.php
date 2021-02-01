<!-- 
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
 */ --> 
<script>
var rowData = 0;
var rowData1 = ""; 
var rowData2 = "";
var tenorCard1= "";
var tenorCard2= "";

Ext.DOM.getLoan = function(val)
{	
	console.log("## val"+val);
	if( val == "" ) {
		return false; return false;
	}

	var CustomerId = Ext.Cmp('CustomerId').getValue(),
	    protectData = Ext.EventUrl( new Array('ProductInfoCip','getLoanPerVariable') );
	  
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
				  
			}
	});	
}
	
Ext.DOM.IncomingColSet = function ()
{
	var incomecol = Ext.Cmp('incomecol').getValue();
	console.log( "## incomecol" );
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
	
Ext.DOM.CashbackSet = function (){
	var cashback = Ext.Cmp('cashback').getValue();
	if(cashback=="YES"){
		Ext.Cmp('cashback_yn').disabled(false);
	}else{
		Ext.Cmp('cashback_yn').disabled(true);
	}
}
	
Ext.DOM.IncomeDocSet = function (){
	var cashback = Ext.Cmp('cashback').getValue();
	if(cashback=="YES"){
		Ext.Cmp('incomedoccollec').disabled(true);
	}else{
		Ext.Cmp('incomedoccollec').disabled(true); 
	}
}

Ext.DOM.getVerificationStatus = function (){
	var CustomerId = Ext.Cmp('CustomerId').getValue();
	console.log(CustomerId);
	Ext.Ajax({
		url		: Ext.EventUrl(new Array('ProductInfoCip', 'getVerificationStatus')).Apply(),
		method	:'POST',
		param	:{CustomerId:CustomerId},
		ERROR  : function(fn){
			Ext.Util(fn).proc(function(Result){
				console.log('res', Result);
				if(Result.ver_result==1){
		$('#ButtonUserSave').show()
	}else{
		$('#ButtonUserSave').hide()
	}
			});
		}
	}).post();
}
	
Ext.DOM.saveProductInfoCip = function () {
	console.log("## saveProductInfoCip");
	// var isVerif = Ext.DOM.getVerificationStatus();
	// if(!isVerif){
	// 	alert('Verifikasi Belum Lengkap!');
	// 	return false;
	// }
	// var lengthaccount = document.getElementById('benefaccount').value;
	var lengthaccount = document.getElementById('benefaccount').value;
	var checkLengthBenefbank = $("#benefaccount").val();
	checkLengthBenefbank = parseInt(checkLengthBenefbank.length)
	var minLenBenef = $("#benefaccount").attr("minlength");
	minLenBenef = parseInt(minLenBenef);

	if ( checkLengthBenefbank < minLenBenef ) {
		var clientMsg  = window.sprintf("Length benef Account is not more than %s minimal ( %s length)", minLenBenef, minLenBenef );
			window.alert( clientMsg );
		return false;
	}
	//buka edit hilman 6-11-2020
	if( Ext.Cmp('tnc2').getValue() == '' ){
			window.alert("tnc Type is Empty!");
			return false;
		}

	if( Ext.Cmp('tnc').getValue() == 0 ){
			window.alert("tnc Type is Empty!");
			return false;
	}
	//tutup edit hilman 6-11-2020

	if(Ext.Cmp('benefname').getValue()=="") {
		alert('Benef Name is empty!');
		return false;
	} else if (Ext.Cmp('benefbank').getValue()=="") {
		alert('Benef Bank is empty!');
		return false;
	} else if (Ext.Cmp('benefaccount').getValue()=="") {
		alert('Benef Account is empty!');
		return false;
	}
	/*else if(lengthaccount.length < 10){
		alert('Account Number less than Requirement!!');
		return false;
	}*/
	else if(Ext.Cmp('benefbranch').getValue()==""){
		alert('Benef Branch is empty!');
		return false;
	}else if($('input[name=key_tenor]:checked').val()==null){
		alert('Tenor is empty!');
		return false;
	}else{
		// var select_tenor = $('input[name=key_tenor]:checked').val();
		/*var select_tenor = rowData;
		var loan_amount  = document.getElementById("LoanAmount_"+select_tenor).textContent;
		var Installment  = document.getElementById("Installment_"+select_tenor).textContent;
		var Rate 		 = document.getElementById("Rate_"+select_tenor).textContent;
		var AdminFee 	 = document.getElementById("AdminFee_"+select_tenor).textContent;
		var DisburseAmount = document.getElementById("DisburseAmount_"+select_tenor).textContent;
		var FreeInterest   = document.getElementById("FreeInterest_"+select_tenor).textContent;
		var pilprotect 	   = document.getElementById("pilprotect").value;
		var incomeDoc_Collected = document.getElementById("incomeDoc_Collected").value;
		var loan_var = $("#vartiering").val();
		var idTiering= rowData.split("_");*/

		var r = "";
		var params1 = {};
		var params2 = {};
		if( rowData1 != "" ) {
			// var select_tenor = rowData1;
			var select_tenor = rowData1;
			var loan_amount  = document.getElementById("LoanAmount_"+select_tenor).textContent;
			var Installment  = document.getElementById("Installment_"+select_tenor).textContent;
			var Rate 		 = document.getElementById("Rate_"+select_tenor).textContent;
			var AdminFee 	 = document.getElementById("AdminFee_"+select_tenor).textContent;
			var DisburseAmount = document.getElementById("DisburseAmount_"+select_tenor).textContent;
			var FreeInterest   = document.getElementById("FreeInterest_"+select_tenor).textContent;
			var pilprotect 	   = document.getElementById("pilprotect").value;
			var incomeDoc_Collected = document.getElementById("incomeDoc_Collected").value;
			var loan_var = $("#vartiering").val();
			// var idTiering= rowData.split("_");
			var idTiering= rowData1.split("_");

			params1 = "";
			params1 = {'loan_amount':loan_amount, 'Installment':Installment, 'Rate':Rate, 'AdminFee':AdminFee, 'DisburseAmount': DisburseAmount, 'pilprotect':pilprotect, 'incomeDoc_Collected':incomeDoc_Collected, 'loan_var':loan_var,'idTiering':idTiering[0], 'FreeInterest':FreeInterest, 'TenorCardOne':tenorCard1 };

			r = "Proccessing The Loan as !\nTenor : "+idTiering[1]+"\nLoan : "+loan_amount+ "\nInstallment : "+Installment+"\nRate : "+Rate+"\nAdminFee : "+AdminFee+ "\nDisbursement : "+DisburseAmount+"\nFree Interest : "+FreeInterest+ "\nPil Protection : "+pilprotect+"\nIncome Doc Collected : "+incomeDoc_Collected+"\nCARD : CARD 1";
		}

		if( rowData2 != "" ) {
			var select_tenor2 = rowData2;
			var loan_amount2  = document.getElementById("LoanAmount_"+select_tenor2).textContent;
			var Installment2  = document.getElementById("Installment_"+select_tenor2).textContent;
			var Rate2 		 = document.getElementById("Rate_"+select_tenor2).textContent;
			var AdminFee2 	 = document.getElementById("AdminFee_"+select_tenor2).textContent;
			var DisburseAmount2 = document.getElementById("DisburseAmount_"+select_tenor2).textContent;
			var FreeInterest2   = document.getElementById("FreeInterest_"+select_tenor2).textContent;
			var pilprotect2 	   = document.getElementById("pilprotect").value;
			var incomeDoc_Collected2 = document.getElementById("incomeDoc_Collected").value;
			var loan_var = $("#vartiering").val();
			var idTiering2= rowData2.split("_");

			params2 = "";
			params2 = {'loan_amount2' : loan_amount2,'Installment2' : Installment2, 'Rate2' : Rate2,'AdminFee2' : AdminFee2,'DisburseAmount2': DisburseAmount2,'pilprotect2' : pilprotect2,'incomeDoc_Collected2' : incomeDoc_Collected2,'loan_var2' : loan_var,'idTiering2': idTiering2[0],'FreeInterest2': FreeInterest2, 'TenorCardTwo':tenorCard2 };

			r += "\n\nTenor : "+idTiering2[1]+"\nLoan : "+loan_amount2+ "\nInstallment : "+Installment2+"\nRate : "+Rate2+"\nAdminFee : "+AdminFee2+ "\nDisbursement : "+DisburseAmount2+"\nFree Interest : "+FreeInterest2+ "\nPil Protection : "+pilprotect2+"\nIncome Doc Collected : "+incomeDoc_Collected2+"\nCARD : CARD 2";

		}
			
		if ( incomeDoc_Collected != null ) {
			/*var r = confirm("Proccessing The Loan as !\nTenor : "+idTiering[1]+"\nLoan : "+loan_amount+
					"\nInstallment : "+Installment+"\nRate : "+Rate+"\nAdminFee : "+AdminFee+
					"\nDisbursement : "+DisburseAmount+"\nFree Interest : "+FreeInterest+
					"\nPil Protection : "+pilprotect+"\nIncome Doc Collected : "+incomeDoc_Collected+"\nAre You Sure?"
				);*/
				r += "\n\nAre You Sure?";
				var rs = confirm(r);
		} else {
			/*var r = confirm("Proccessing The Loan as !\nTenor : "+idTiering[1]+"\nLoan : "+loan_amount+
				"\nInstallment : "+Installment+"\nRate : "+Rate+"\nAdminFee : "+AdminFee+
				"\nDisbursement : "+DisburseAmount+"\nFree Interest : "+FreeInterest+"\nPil Protection : "+pilprotect+"\nAre You Sure?"
			);*/
			r += "\n\nAre You Sure?";
			var rs = confirm(r);
		}
		// return  false;	
		if (rs == true) {
			Ext.Ajax({
				url		: Ext.EventUrl(new Array('ProductInfoCip', 'saveLoan')).Apply(),
				method	:'POST',
				param	:Ext.Join(new Array( 
							Ext.Serialize('formProductInfo1').getElement(),
							Ext.Serialize('formProductInfo2').getElement(),
							Ext.Serialize('formProductInfo3').getElement(),
							Ext.Serialize('formProductInfo4').getElement(),
							params1,params2
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

// start commit d67085a8

function formatRupiah(angka, prefix){
	var number_string = angka.toString().replace(/[^,\d]/g, ''),
	split   		= number_string.split(','),
	sisa     		= split[0].length % 3,
	rupiah     		= split[0].substr(0, sisa),
	ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

	// tambahkan titik jika yang di input sudah menjadi angka ribuan
	if(ribuan){
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}

	rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
	return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}


// end commit d67085a8
	
$(document).ready(function() {

	// buka edit hilman 6-11-2020
	 //tnc
    $("#tnc").change(function() {

			var value = $(this).val()
			
			if(value=='NO'){	
				Ext.Cmp('tnc2').disabled(true);
				document.getElementById("tnc2").value = "";
			}else if (value=='YES'){
				var ScriptId = Ext.Cmp('CampaignId').getValue();
				var WindowScript = new Ext.Window 
				({
						url     : Ext.EventUrl(['SetProductScript','ShowProductScripttncCipReguler']).Apply(), 
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

	// tutup edit hilman 6-11-2020


	// RADIO BUTTON TENOR CHANGE
	var jml   = 0;
	var card1 = "";
	var card2 = "";

	// start commit d67085a8
	var rowLoan1 = 0;
	var rowLoan2 = 0;
	var rowInstall1 = 0;
	var rowInstall2 = 0;
	// end commit d67085a8

	$("#key_tenor").live("change", function() {
		if( !$(this).hasClass("cek_checkbox") ) {
			var row = $(this).closest("td");
	   		rowData  = row.attr("data");
	   		rowCard  = row.attr("card");
	   		rowData1 = row.attr("data");
	   		rowData2 = "";
	   		tenorCard1 = $(this).val();

	   		console.log("## One Card");
	   		console.log("## Tenor"+$(this).val());
	   		console.log("##"+rowData);
	   		console.log("##"+rowCard);
		}
	});

	// start commit f8c736cf 
	$(".clearing").live("click", function() {
		jml   = 0;
		card1 = "";
		card2 = "";
		$(".cek_checkbox").prop("checked", false);
		alert("Clearing success")
	})
	// end commit f8c736cf 

	// $("#key_tenor").live("change", function() {
	$(".cek_checkbox").live("change", function() {
   		/*var row = $(this).closest("td");
   		rowData = row.attr("data");
   		console.log("##"+rowData);*/

   		var row = $(this).closest("td");
   		rowData = row.attr("data");
   		rowCard = row.attr("card");
   		// start commit d67085a8
   		rowLoan = row.attr("loan");
		rowInstall = row.attr("install");
		// end commit d67085a8

   		// Checked
   		if( $(this).prop("checked") ) {
   			
   			if( jml > 1 ) {
   				alert("Invalid Checklist");
   				$(this).prop("checked", false);
   				return false;
   			}

   			if( rowCard == "CARD 1") {
   				rowData1 = row.attr("data");
   				// start commit d67085a8
   				rowLoan1 = row.attr("loan");
				rowInstall1 = row.attr("install");
				// end commit d67085a8
   				if( card1 == rowCard ) {
   					alert("Invalid Checklist");
   					$(this).prop("checked", false);
   					return false;
   				}
   				card1 	   = rowCard;
   				tenorCard1 = $(this).val();
   				console.log("## Tenor Card 1"+$(this).val());
   			}
   			if( rowCard == "CARD 2") {
   				rowData2 = row.attr("data");
   				// start commit d67085a8
   				rowLoan2 = row.attr("loan");
				rowInstall2 = row.attr("install");
   				// end commit d67085a8
   				if( card2 == rowCard ) {
   					alert("Invalid Checklist");
   					$(this).prop("checked", false);
   					return false;
   				}
   				card2 	   = rowCard;
   				tenorCard2 = $(this).val();
   				console.log("## Tenor Card 2"+$(this).val());
   			}
			jml++;

    	} else {
    		
    		// Unchecked
    		if( jml > 0 ) {
    			jml--;
    		}

    		if( rowCard == "CARD 1") {
   				card1   = "";
   				rowData1= "";
   				tenorCard1= "";
   				// start commit d67085a8
   				rowLoan1 = 0;
				rowInstall1 = 0;
				// end commit d67085a8

   			}
   			if( rowCard == "CARD 2") {
   				card2 	= "";
   				rowData2= "";
   				tenorCard2= "";
   				// start commit d67085a8
   				rowLoan2 = 0;
				rowInstall2 = 0;
				// end commit d67085a8
   			}

    	}

    	// start commit d67085a8
    	var totalLoan = parseInt(rowLoan1) + parseInt(rowLoan2);
		var totalInstall = parseInt(rowInstall1) + parseInt(rowInstall2);
		$('#totalLoan').html(formatRupiah(totalLoan))
		$('#totalInstall').html(formatRupiah(totalInstall))
		// end commit d67085a8

   		console.log("##"+rowData);
   		console.log("##"+rowCard);
	});


	// benef bank
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
				console.log(digit);
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
	Ext.DOM.getVerificationStatus();
		
	$(".money").keyup(function(){
		var id = $(this).attr('id');
		var text = Ext.Cmp(id).getValue();
				
		if(text!='') {
			text = Ext.Money(text).ToInt();
			Ext.Cmp(id).setValue(Ext.Money(text).ToDollar());
		} else {
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

	// start commit f2b69a10
	function getTypeCard($id, $type) {
		$rec = '';
		$UI =& get_instance();
		
		$sql = "select a.prod, a.map_prod from t_gn_attr_cip_cc a
				INNER JOIN t_gn_loan_tiering b ON a.CustomerId=b.CustomerId
				where b.Id = '".$id."'";
				
		$qry = $UI->db->query($sql);
		// echo "<pre>";
		// var_dump($qry);
		if($qry->num_rows()>0)
		{
			$_datas = $qry->result_first_assoc();
			if ($type == 'CARD 1') {
				$rec = "- ". $_datas['prod'];
			} else if ($type == 'CARD 2') {
				$rec = "- ". $_datas['map_prod'];
			}
		}
		
		return $rec;
	}
	// end commit f2b69a10

	//Edit rangga&irul 17/01/2020
	function getFrm($id, $type) {
		$UI =& get_instance();
		
		$sql_frm = "SELECT b.Desc_card, a.IdTiering FROM t_gn_frm_cip a 
		INNER JOIN t_gn_loan_tiering b ON a.CustomerId=b.CustomerId
		WHERE a.CampaignId=3 AND a.IdTiering='".$id."' AND b.Desc_card='".$type."'";
				
		$qry = $UI->db->query($sql_frm)->result();
		
		return $qry[0];
	}

	function getCampaign($id) {
		$UI =& get_instance();
		
		$sql = "SELECT a.CampaignId FROM t_gn_customer a 
		WHERE a.CustomerId='".$id."'";
				
		$qry = $UI->db->query($sql)->result();
		// var_dump($qry-);
		return $qry[0]->CampaignId;
	}
?>

<fieldset class="corner" style="margin-bottom:15px;">
	<?php echo form()->legend(lang("Product Info"), "fa-tasks");?>
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
				<div class="ui-widget-form-cell">
					<?php 
						echo form()->combo("vartiering", "select  tolong", array(100=>100), 100, array("change"=>"Ext.DOM.getLoan(this.value)"), array('disabled'=>'disabled'));
						#echo form()->combo("vartiering", "select  tolong", array(50=>50,60=>60,70=>70,80=>80,100=>100),($frm['vartiering']>0?$frm['vartiering']:100),array("change"=>"Ext.DOM.getLoan(this.value)"));
					?>
				</div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang("PIL Protection");?></div>
				<div class="ui-widget-form-cell text_caption">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo("pilprotect", "select tolong", array('Y'=>'Y','N'=>'N'),'N',null,array('disabled'=>'disabled'));?></div>
			</div>

			<!-- // start commit f8c736cf  -->
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell"><?php echo form()->button("clearing", "button save clearing", lang('Clearing'));?></div>
			</div>
			<!-- // end commit f8c736cf  -->
			
		</div>
		
		
		<?php
		$incomeDoc_Collected = $result["incomeDocs_collected"];
		if ( $incomeDoc_Collected == 'Y' ) { ?>
		<div class="ui-widget-form-table" style="margin-top:-5px;">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang("Income Doc Collected");?></div>
				<div class="ui-widget-form-cell text_caption">:</div>
				<div class="ui-widget-form-cell">
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
				"Tenor"			=> lang("Tenor"),
				"LoanAmount" 	=> lang("Loan Amount"),
				"Installment" 	=> lang("Monthly Installment"),
				"Rate"			=> "Rate",
				"AdminFee"		=> lang("Admin Fee"),
				"DisburseAmount"=> lang("Disburse Amount"),
				"Free_Interest" => lang("Free Interest"),
				"Card"			=> lang("Card"),

			);
			$arr_class = array(
				"Tenor"			=> "content-middle",
				"LoanAmount" 	=> "content-middle",
				"Installment" 	=> "content-middle",
				"Rate"			=> "content-middle",
				"AdminFee"		=> "content-middle",
				"DisburseAmount"=> "content-middle",
				"Free_Interest" => "content-middle",
				"Card" 			=> "content-lasted",
			);
			
			echo	"<table border=0 cellspacing=1 width=\"100%\">".
					"<tr height=\"30\"> ".
					"<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>". lang("label_data_no") ."</th>".
					"<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>#</th>";
			foreach( $arr_header as $field => $value ){
					echo "<th class=\"ui-corner-top ui-state-default th-lasted {$arr_align[$field]}\" width=\"{$arr_width[$field]}\"><span class=\"header_order\" title=\"Sort By {$value}\" onclick=\"Ext.DOM.CallHistory({page:0, orderby:'{$field}', type:'{$next_order}' });\">&nbsp;{$value}</span></th>";
			}
			echo "</tr>";

			$arr_num =1; $n = 0; $checkbox = FALSE;
			if( is_array($loans) ){
				$no = 1; $tenor = 0; $checkedtenor = NULL;
				foreach( $loans as $num => $rows ) {
					$tenor =  array_keys($rows);
					$back_color = ( $num%2!=0 ? '#FFFFFF' :'#FFFEEE');
					#var_dump($tenor[0])."<pre>";die();
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
			
					// $row   = new EUI_Object( $rows );
					// $tenor = $row->get_value('Tenor',$arr_function['Tenor']);

					// if($frm['Tenor']==$tenor){
					// 	$checkedtenor = array("checked"=>"checked");
					// }else{
					// 	$checkedtenor = NULL;
					// }
				
					// echo	"<tr bgcolor=\"{$back_color}\" class=\"onselect\" height=\"35\">".
					// 		"<td class=\"content-first\" nowrap>{$no}</td>".
					// 		"<td class=\"content-first\" nowrap>".form()->radio( "key_tenor", "content-first", $tenor, null, $checkedtenor)."</td>".
					// 		"<td class=\"content-first\" nowrap>".$no."</td>";
					// foreach( array_keys($arr_header) as $k => $fields ){
					foreach( $tenor as $value ){
						#echo "<pre>";print_r( $rows ); echo "</pre>";
						$ch_1=getFrm($rows[$value]['ID'], 'CARD 1');
						$ch_2=getFrm($rows[$value]['ID'], 'CARD 2');

						// echo "<pre>";
						// var_dump($ch_1);

						if ($frm['CampaignId'] == 3) {
							if( $ch_1->IdTiering == $rows[$value]['ID'] OR $ch_2->IdTiering == $rows[$value]['ID']) {
								$checkedtenor = array("checked"=>"checked");
							}else{
								$checkedtenor = NULL;
							}
						} else {
						if( $frm['IdTiering'] == $rows[$value]['ID'] ) {
							$checkedtenor = array("checked"=>"checked");
						}else{
							$checkedtenor = NULL;
						}
					}

						$card = "";
						if( $rows[$value]['Desc_Card'] == "CARD 2") {
							$card    = "font-weight:bold;color:#0611FA;";
							$checkbox= TRUE;
						}

						$input = form()->radio("key_tenor", "content-first cek_radio", $value, null, $checkedtenor);
						if( $rows[$value]['Card'] ) {
							$input = form()->checkbox("key_tenor", "content-first cek_checkbox", $value, null, $checkedtenor);
						}

						echo"<tr bgcolor=\"{$back_color}\" style=\"color:{$font_color}\" class=\"onselect\" height=\"35\">".
							"<td class=\"content-first\" nowrap>{$no}</td>".
							// start commit d67085a8 
							"<td data='{$rows[$value]['ID']}_{$value}' card='{$rows[$value]['Desc_Card']}' loan='{$rows[$value]['LoanAmount']}' install='{$rows[$value]['Installment']}' class=\"content-first\" style='{$card}' nowrap>".$input."</td>".
							// end commit d67085a8
							"<td id='Tenor_{$rows[$value]['ID']}_{$value}' class=\"content-first\" style='{$card}' nowrap>".$value."</td>".
							"<td id='LoanAmount_{$rows[$value]['ID']}_{$value}' class=\"content-first\" style='{$card}' nowrap>".number_format($rows[$value]['LoanAmount'], 0, '.', ',')."</td>".
							"<td id='Installment_{$rows[$value]['ID']}_{$value}' class=\"content-first\" style='{$card}' nowrap>".number_format($rows[$value]['Installment'], 0, '.', ',')."</td>".
							"<td id='Rate_{$rows[$value]['ID']}_{$value}' class=\"content-first\" style='{$card}' nowrap>".number_format($rows[$value]['Rate'], 2, '.', ',')."%</td>".
							"<td id='AdminFee_{$rows[$value]['ID']}_{$value}' class=\"content-first\" style='{$card}' nowrap>".number_format($rows[$value]['AdminFee'], 0, '.', ',')."</td>".
							"<td id='DisburseAmount_{$rows[$value]['ID']}_{$value}' class=\"content-first\" style='{$card}' nowrap>".number_format($rows[$value]['DisburseAmount'], 0, '.', ',')."</td>".
							"<td id='FreeInterest_{$rows[$value]['ID']}_{$value}' class=\"content-first\" style='{$card}' nowrap>".number_format($rows[$value]['Free_Interest'], 0, '.', ',')."</td>".
							// start commit f2b69a10
							"<td id='Card_{$rows[$value]['ID']}_{$value}' class=\"content-first\" style='{$card}' nowrap>".$rows[$value]['Desc_Card']." ".getTypeCard($rows[$value]['ID'],$rows[$value]['Desc_Card'])."</td>";
							// end commit f2b69a10 
						// if(strtolower($fields) == 'tenor'){
						// 	$numbers = $row->get_value($fields,$arr_function[$fields]);
						// }else{
						// 	if(strtolower($fields) == 'rate'){
						// 		$numbera = $row->get_value($fields,$arr_function[$fields])*100;
						// 		$numbers = number_format($numbera, 2, '.', ',')."%";
						// 	}else{
						// 		// $numbers = number_format($row->get_value($fields,$arr_function[$fields]), 0, '.', ',');
						// 		$loansvar = $frm['vartiering'];
						// 		// $numbers = number_format($row->get_value($fields,$arr_function[$fields]), 0, '.', ',');
						// 		$numbers = $row->get_value($fields,$arr_function[$fields]);
						// 		if($loansvar>40){
						// 			$loan = ($numbers * $loansvar)/100;
						// 			$numbers = number_format($loan, 0, '.', ',');
						// 		}else{
						// 			$numbers = number_format($row->get_value($fields,$arr_function[$fields]), 0, '.', ',');
						// 		}
						// 	}
						// }
						#echo  "<td align='right' id=\"".$fields."_".$tenor."\" class=\"".$arr_class[$fields]." ui-widget-unselect-order ".$arr_align[$fields]."\" ".$arr_wrap[$fields].">".$numbers."</td>";
						$no++;
						echo "</tr>";
					}
					// echo "</tr>";
					// $no++;
				}
			}
			echo "</table>";
		?>
		</div>
		</form>
	</fieldset>

	<?php #var_dump($frm); ?>
	<fieldset class="corner" style="margin-bottom:15px; border:0px solid #fff;">
		<?php echo form()->hidden('isSave',NULL,(is_array($result)&&count($result)>0?1:0));?>
		<?php echo form()->hidden('Mode',NULL,$param['Mode']);?>
		<form name="formProductInfo3">
		<?php  ?>
		<!-- start commit d67085a8  -->
		<p>Total Loan : Rp. <span id="totalLoan">0</span></p>
		<p>Total Installment : Rp. <span id="totalInstall">0</span></p>
		<!-- end commit d67085a8  -->
		<div class="ui-widget-form-table" style="margin-top:-5px;">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang("Benef Name");?></div>
				<div class="ui-widget-form-cell text_caption">:</div>
				<div class="ui-widget-form-cell">
					<?php 
						#echo form()->input("benefname", "select  tolong", $frm['BenefName'],null,array("change"=>"Ext.DOM.openCoverage(this.value)"));
						echo form()->input("benefname", "select  tolong", $frm['Name'],null,array("change"=>"Ext.DOM.openCoverage(this.value)"));
					?>
				</div>
			</div>
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang("Benef Bank");?></div>
				<div class="ui-widget-form-cell text_caption">:</div>
				<div class="ui-widget-form-cell">
					<?php 
						#echo form()->combo("benefbank", "select  tolong", $listbank,$frm['BenefBank'],null);
						echo form()->combo("benefbank", "select  tolong", $listbank,$frm['Bank'],null);
					?>
				</div>
			</div>
			<!-- buka edit hilman 6-11-2020 -->
			<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Pembacaan TnC");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
			
			<select  onchange="Ext.DOM.tncCipReguler(this.value)" name="tnc" id="tnc" class="select  tolong">
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
			<!--tutup edit hilman 6-11-2020 -->
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
				<div class="ui-widget-form-cell">
					<?php 
						#echo form()->input("benefbranch", "select  tolong",$frm['BenefBranch']);
						echo form()->input("benefbranch", "select  tolong",$frm['BankBranch']);
					?></div>
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
					if(_get_session('HandlingType')==4 || _get_session('HandlingType')==8){
						echo form()->button("ButtonUserSave", "button save", lang('Save Prod. Info'), array('click' => 'Ext.DOM.saveProductInfoCip();'));
					}
					?>
				</div>
			</div>

			<!-- buka edit hilman 6-11-2020 -->
			     <div class="ui-widget-form-row" >
			<div class="ui-widget-form-cell">&nbsp;</div>
			<div class="ui-widget-form-cell">&nbsp;</div>
			<div class="ui-widget-form-cell" align="Right">
				<input type="text" name="tnc2" id="tnc2" class="select  tolong" value="<?php echo $frm['tnc'] === 'YES' ? 'TNC' : '' ?>" disabled="" style="width: 110px">

			</div>
			
		</div>
			<!-- tutup edit hilman 6-11-2020 -->

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