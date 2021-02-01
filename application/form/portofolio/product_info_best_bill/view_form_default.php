<script>
/*
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
	Ext.DOM.getJenisJasa = function (Product){
		Ext.Ajax({
			url 	: Ext.DOM.INDEX +'/ProductInfoBestBill/getJenisJasa/',
			method  : 'GET',
			param  : {
				BestbillProduct : Product
			}	
		}).load("divJenisJasa");
	}
	
	Ext.DOM.getPrefix = function (JenisJasa){
		var Product = Ext.Cmp('Product').getValue();
		Ext.Ajax({
			url 	: Ext.DOM.INDEX +'/ProductInfoBestBill/getBestbillPrefix/',
			method  : 'GET',
			param  : {
				BestbillProduct : Product, BestbillJenisJasa : JenisJasa
			}	
		}).load("divPrefix");
	}
	
	Ext.DOM.FallbackNopelLimiter = function (getNopelLimiter){
		// Ext.DOM.getNopelLimiter (Ext.DOM.FallbackNopelLimiter);
		if(getNopelLimiter || getNopelLimiter!='undefined'){
			Ext.DOM.getVerificationStatus(Ext.DOM.Fallback);
		}else{
			alert('Lengkapi Form!');
			// Ext.DOM.getVerificationStatus();
			return false;
		}
	}
	
	Ext.DOM.getNopelLimiter = function (callback){
		var Product = Ext.Cmp('Product').getValue();
		var JenisJasa = Ext.Cmp('JenisJasa').getValue();
		var Prefix = Ext.Cmp('Prefix').getValue();
		Ext.Ajax({
			url		: Ext.EventUrl(new Array('ProductInfoBestBill', 'getBestbillNopelLimiter')).Apply(),
			method	:'POST',
			param	:{BestbillProduct:Product,BestbillJenisJasa:JenisJasa,BestbillPrefix:Prefix},
			ERROR	: function(fn){
				Ext.Util(fn).proc(function(result){
					console.log("Result set :"+result.Nopelvalidity);
					Ext.Cmp('nopel_limiter').setValue(result.Nopelvalidity);
					callback(result.Nopelvalidity);
					// if(result.Nopelvalidity){
						// Ext.Cmp('NomorPelanggan').disabled(false);
						// Ext.Cmp('NamaPelanggan').disabled(false);
					// }
					// callback(result.ver_result);
				});
			}
		}).post();
	}
	
	Ext.DOM.deleteBill = function (billingid){
		var CustomerId = Ext.Cmp('CustomerId').getValue();
		var confm = confirm("Are you sure!?");
		if(confm){
			Ext.Ajax({
				url		: Ext.EventUrl(new Array('ProductInfoBestBill', 'deleteBestBill')).Apply(),
				method	:'POST',
				param	:{billingid:billingid,CustomerId:CustomerId},
				ERROR	: function(fn){
					Ext.Util(fn).proc(function(result){
						if(result.delete){
							// alert('Delete Success!');
							Ext.DOM.reloadBestBill();
						}else{
							alert('Delete Fail!');
						}
					});
				}
			}).post();
		}else{
			return false;
		}
	}
	
	Ext.DOM.getVerificationStatus = function (callback){
		Ext.DOM.getNopelLimiter();
		var CustomerId = Ext.Cmp('CustomerId').getValue();
		Ext.Ajax({
			url		: Ext.EventUrl(new Array('ProductInfoBestBill', 'getVerificationStatus')).Apply(),
			method	:'POST',
			param	:{CustomerId:CustomerId},
			ERROR	: function(fn){
				Ext.Util(fn).proc(function(result){
					// console.log("Result test :"+result.ver_result);
					callback(result.ver_result);
				});
			}
		}).post();
	}

	Ext.DOM.Fallback = function (verification){
		if(verification){
			Ext.DOM.saveProductInfoBestbill();
		}else{
			alert('Verifikasi Belum Lengkap!');
			//Ext.DOM.saveProductInfoBestbill();
			return false;
		}
	}
	
	Ext.DOM.NopelValidator = function(minmax,nopel){
		if(minmax[0]==minmax[1]){
			if(nopel==minmax[1]){
				return true;
			}else{
				return false;
			}
		}else{
			if(nopel>=minmax[0] && nopel<=minmax[1]){
				return true;
			}else{
				return false;
			}
		}
	}
	
	Ext.DOM.saveProductInfoBestbill = function (){
		// check NomorPelanggan
		var NomorPelanggan = document.getElementById('NomorPelanggan').value;
		var nopel_limiter = document.getElementById('nopel_limiter').value;
		var NomorPelangganLength = parseInt(NomorPelanggan.length);
		var minmax = nopel_limiter.split("-");
		var tnc2 = $("#tnc2").val();
		
		var checktnc2 = $("#tnc2").val();
		var nopelV = Ext.DOM.NopelValidator(minmax,NomorPelangganLength);
		console.log('Nopel = '+NomorPelangganLength);
		// alert(nopel_limiter);
		// return false;

		// if(Ext.Cmp('Product').getValue()==""){
			// alert('Product is empty!');
			// return false;
		// }else 
		if( Ext.Cmp('tnc2').getValue() == '' ){
			window.alert("tnc Type is Empty!");
			return false;
		}

		if( Ext.Cmp('tnc').getValue() == 0 ){
			window.alert("tnc Type is Empty!");
			return false;
		}

		if(nopel_limiter==false  || nopel_limiter=='undefined'){
			alert('Please Complete the Form!');
			return false;
		}else if(Ext.Cmp('NoHpCustomer').getValue()==""){
			alert('No Hp Customer is empty!');
			return false;
		}else if(Ext.Cmp('NomorPelanggan').getValue()==""){
			alert('Nomor Pelanggan is empty!');
			return false;
		}else if(Ext.Cmp('NamaPelanggan').getValue()==""){
			alert('Nama Pelanggan is empty!');
			return false;
		}else if(nopelV==false){
			alert('Nomer Pelanggan hanya '+nopel_limiter+' karakter!');
			return false;
		}else{
			Ext.Ajax({
				url		: Ext.EventUrl(new Array('ProductInfoBestBill', 'saveProductBestbill')).Apply(),
				method	:'POST',
				param	:Ext.Join(new Array( 
							Ext.Serialize('formProductInfo1').getElement()
							// Ext.Serialize('formProductInfo2').getElement(),
							// Ext.Serialize('formProductInfo3').getElement(),
							// Ext.Serialize('formProductInfo4').getElement()
						)).object(),
				ERROR  : function(fn){
					Ext.Util(fn).proc(function(save){
						if( save.success ) {
							Ext.Msg("Save Product Info").Success();
							Ext.Cmp('isSave').setValue('1');
							Ext.Cmp('InputForm').setValue('1');
							Ext.DOM.reloadBestBill();
						}else{
							Ext.Msg("Save Product Info").Failed();
						}
					});
				}
			}).post();
		}
	}
	
	Ext.DOM.reloadBestBill = function(){
		var CustomerId = Ext.Cmp('CustomerId').getValue();
		Ext.Ajax({
			url 	: Ext.DOM.INDEX +'/ProductInfoBestBill/reloadBestBill/',
			method  : 'GET',
			param  : {
				CustomerId : CustomerId
			}	
		}).load("Billlist");
	}
	
// ----------------------------------------------------------------------------------------

	Ext.DOM.getLoan = function(val){		
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
	

	Ext.DOM.IncomingColSet = function (){
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

	$(document).ready(function() {

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

	// $("#ButtonUserSave").hide()
		Ext.Cmp('NomorPelanggan').disabled(false);
		Ext.Cmp('NamaPelanggan').disabled(false);
		
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
	<?php echo form()->legend(lang("Product Info Best Bill"), "fa-tasks");?>
	<?php echo form()->hidden('isSave',NULL,(is_array($result)&&count($result)>0?1:0));?>
	<?php echo form()->hidden('Mode',NULL,$param['Mode']);?>
	<?php echo form()->hidden('isVerif',NULL,$ver_result['ver_result']);?>
	
	<form name="formProductInfo1">
	<?php echo form()->hidden('CustomerId',NULL, $param['CustomerId'] );?>
	<div class="ui-widget-form-table-compact" style="width:99%;margin-top:-5px;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("No HP Customer");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("NoHpCustomer", "select  tolong", $frm['NoHpCustomer'],null,array("change"=>""));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Produk");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("Product", "select  tolong", $bestbill_product,$frm['Product'],array("change"=>"Ext.DOM.getJenisJasa(this.value)"));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Jenis Jasa");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell" id="divJenisJasa"><?php echo form()->combo("JenisJasa", "select  tolong", array(),null,array("change"=>"Ext.DOM.getPrefix(this.value)"),array('disabled'=>'disabled'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Prefiks");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell" id="divPrefix"><?php echo form()->combo("Prefix", "select  tolong", array(),null,null,array('disabled'=>'disabled'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("No Pelanggan");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"  id="divNomorPelanggan">
				<?php echo form()->hidden('nopel_limiter',NULL,NULL); //Default 1-32 Char?>
				<?php echo form()->input("NomorPelanggan", "select  tolong", $frm['NomorPelanggan'],null,array('disabled'=>'disabled'));?>
			</div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Nama Pelanggan");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("NamaPelanggan", "select  tolong", $frm['NamaPelanggan'],null,array('disabled'=>'disabled'));?></div>
			
			<?php
				if($param['Mode']!='VIEW'){
			?>
			<div class="ui-widget-form-cell">&nbsp;</div>
			<div class="ui-widget-form-cell">&nbsp;</div>
			<div class="ui-widget-form-cell" >
				<?php //echo form()->button("ButtonUserSave", "button save", lang('Save Prod. Info'), array('click' => 'Ext.DOM.saveProductInfoPilx();'));?>
				<?php 
				// if(_get_session('HandlingType')==4 || _get_session('HandlingType')==8){
						// echo form()->button("ButtonUserSave", "button save", lang('Save Prod. Info'), array('click' => 'Ext.DOM.saveProductInfoPilx();'));
					// echo form()->button("ButtonUserSave", "button save", lang('Save Prod. Info'), array('click' => 'Ext.DOM.getVerificationStatus(Ext.DOM.Fallback);'));
					echo form()->button("ButtonUserSave", "button save", lang('Save Prod. Info'), array('click' => 'Ext.DOM.getNopelLimiter(Ext.DOM.FallbackNopelLimiter);'));
				// }
				?>
                <br>
	            <div>
					 <input type="text" name="tnc2" id="tnc2" class="select  tolong" value="<?php echo $frm['tnc'] === 'YES' ? 'TNC' : '' ?>" disabled="" style="width: 110px;  margin-right:-190px">
				</div>
				
			</div>
		</div>






		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Pembacaan TnC");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
			
			<select name="tnc" id="tnc" class="select tolong">
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
			<?php
				}
			?>
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
			<div id="Billlist">
				<?php
				$arr_header = array(
					"Product"=> lang("Product"),
					"JenisJasa" => lang("Jenis Jasa"),
					"Prefix" => lang("Prefix"),
					"NomorPelanggan"=> "Nomor Pelanggan",
					"NamaPelanggan"=> lang("Nama Pelanggan"),
					"Action"=> lang(" Action ")
				);
				$arr_class = array(
					"Product"=> "content-middle",
					"JenisJasa" => "content-middle",
					"Prefix" => "content-middle",
					"NomorPelanggan"=> "content-middle",
					"NamaPelanggan"=> "content-middle",
					"Action"=> "content-lasted"
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
		if( is_array($frm) ){
			$no = 1;
			$tenor = 0;
			$checkedtenor = NULL;
			foreach( $frm as $num => $rows ){
				$row = new EUI_Object( $rows );
				// $tenor = $row->get_value('Tenor',$arr_function['Tenor']);
				
				$back_color = ( $num%2!=0 ? '#FFFFFF' :'#FFFEEE');
				// if($frm['Tenor']==$tenor){
					// $checkedtenor = array("checked"=>"checked");
				// }else{
					// $checkedtenor = NULL;
				// }

				// if ($tenor[0] == 3) {
					// $font_color = 'blue';
				// } else if ($tenor[0] == 6 || $tenor[0] ==12) {
					// $font_color = 'black';
				// } else if ($tenor[0] == 18) {
					// $font_color = 'magenta';
				// } else if ($tenor[0] == 24) {
					// $font_color = 'red';
				// } else {
					// $font_color = 'green';
				// }

				echo	"<tr bgcolor=\"{$back_color}\" style=\"color:black\" class=\"onselect\" height=\"35\">".
						"<td class=\"content-first\" nowrap>{$no}</td>".
						"<td class=\"content-first\" nowrap>".form()->radio( "key_bill", "content-first", $num, null, array("disabled"=>"disabled"))."</td>";
				foreach( array_keys($arr_header) as $k => $fields ){
					$numbers = $row->get_value($fields,$arr_function[$fields]);
					
					if(strtolower($fields) == 'action'){
						echo  "<td align='right' id=\"".$fields."\" class=\"".$arr_class[$fields]." ui-widget-unselect-order ".$arr_align[$fields]."\" ".$arr_wrap[$fields].">
							<button type='button' value='".$num."' onclick='Ext.DOM.deleteBill(this.value)'>Delete</button></td>";
					}else{
						// if(strtolower($fields) == 'rate'){
							// $numbera = $row->get_value($fields,$arr_function[$fields])*100;
							// $numbers = number_format($numbera, 2, '.', ',')."%";
						// }else{
							// $numbers = number_format($row->get_value($fields,$arr_function[$fields]), 0, '.', ',');
							// $loansvar = $frm['vartiering'];
							// $numbers = number_format($row->get_value($fields,$arr_function[$fields]), 0, '.', ',');
							// $numbers = $row->get_value($fields,$arr_function[$fields]);
							// if($loansvar>40){
								// $loan = ($numbers * $loansvar)/100;
								// $numbers = number_format($loan, 0, '.', ',');
							// }else{
								// $numbers = number_format($row->get_value($fields,$arr_function[$fields]), 0, '.', ',');
							// }
						// }
						echo  "<td align='right' id=\"".$fields."\" class=\"".$arr_class[$fields]." ui-widget-unselect-order ".$arr_align[$fields]."\" ".$arr_wrap[$fields].">".$numbers."</td>";
					}
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




</fieldset>






