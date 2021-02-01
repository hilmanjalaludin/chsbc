<script>
	
	Ext.DOM.getLoan = function(val){
		var CustomerId = Ext.Cmp('CustomerId').getValue();
		Ext.Ajax({
			url 	: Ext.DOM.INDEX +'/ProductInfoPilx/getLoanPerVariable/',
			method  : 'GET',
			param  : { loansvar : val, CustomerId:CustomerId }	
		}).load("loans");
	}
	
	$(document).ready(function() {
		// benef bank
		$("#benefbank").change(function () {
			var valueBenef    = $(this).val();
			var BenefAccounts = $("#benefaccount");
			
			var Sendurl = Ext.DOM.INDEX + "/SrcCustomerList/getDigitBank/" + valueBenef;
			var getDigit = {
				url  : Sendurl , 
				type : "POST" , 
				dataType : 'text' , 
				success : function (digit) {
					$(BenefAccounts).attr('maxlength',digit);
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

		Ext.DOM.getVerificationStatus();
	});
	
	Ext.DOM.getVerificationStatus = function (){
	var CustomerId = Ext.Cmp('CustomerId').getValue();
	console.log(CustomerId);
	Ext.Ajax({
		url		: Ext.EventUrl(new Array('ProductInfoTop', 'getVerificationStatus')).Apply(),
		method	:'POST',
		param	:{CustomerId:CustomerId},
		ERROR  : function(fn){
			Ext.Util(fn).proc(function(Result){
				console.log("Result test :"+Result);
				if(Result.ver_result==1){
		$('#ButtonUserSave').show()
	}else{
		$('#ButtonUserSave').hide()
	}
			});
		}
	}).post();
}
	
	Ext.DOM.saveProductInfoFlexi = function (){
		var isVerif = document.getElementById('ver_status').value;
	// var isVerif = Ext.DOM.getVerificationStatus();
		if(!isVerif){
			alert('Verifikasi Belum Lengkap!');
			return false;
		}
		var select_tenor = $('input[name=key_tenor]:checked').val();
		var loan_amount = document.getElementById("LoanAmount_"+select_tenor).textContent;
		var Installment = document.getElementById("Installment_"+select_tenor).textContent;
		var Rate = document.getElementById("Rate_"+select_tenor).textContent;
		// var DisburseAmount = document.getElementById("DisburseAmount_"+select_tenor).textContent;
		var pilprotect = document.getElementById("pilprotect").value;
		var r = confirm("Proccessing The Loan as !\nTenor : "+select_tenor+"\nLoan : "+loan_amount+
						"\nInstallment : "+Installment+"\nRate : "+Rate+
						"\nPil Protection : "+pilprotect+"\nAre You Sure?");
		if (r == true) {
			Ext.Ajax({
				url		: Ext.EventUrl(new Array('ProductInfoTop', 'saveLoan')).Apply(),
				method	:'POST',
				param	:Ext.Join(new Array( 
							Ext.Serialize('formProductInfo1').getElement(),
							Ext.Serialize('formProductInfo2').getElement(),
							Ext.Serialize('formProductInfo3').getElement()
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

</script>
<?php
	$newDate = date("d-m-Y", strtotime($param['CustomerDOB']));
	
	/* COMBO-COMBO */
	$coverage = array(2=>"Main Card Holder",4=>"Main & Spouse",3=>"Main & Child",1=>"Main & Family");
	$plan 	  = array(1=>"Infinite",2=>"Advance",3=>"Premiere");
	$sex 	  = array(1=>"Pria",2=>"Wanita");
	/* END OF COMBO-COMBO */
	
?>

<fieldset class="corner" style="margin-bottom:15px;">
	<?php echo form()->legend(lang("Product Info"), "fa-tasks");?>
	<?php echo form()->hidden('isSave',NULL,(is_array($result)&&count($result)>0?1:0));?>
	<?php echo form()->hidden('Mode',NULL,$param['Mode']);?>
	<form name="formProductInfo1">
	<?php echo form()->hidden('CustomerId',NULL, $param['CustomerId'] );?>
	<div class="ui-widget-form-table" style="margin-top:-5px;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Use NPWP");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("typexsell", "select  tolong", array('Y'=>'YES','N'=>'NO'),'Y',null);?></div>
		</div>
	</div>
	<div class="ui-widget-form-table" style="margin-top:-5px;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("PIL Protection");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("pilprotect", "select tolong", array('Y'=>'Y','N'=>'N'),'N',null);?></div>
		</div>
	</div>
	
	</form>
</fieldset>
<fieldset class="corner" style="margin-bottom:15px;">
	<?php echo form()->hidden('isSave',NULL,(is_array($result)&&count($result)>0?1:0));?>
	<?php echo form()->hidden('Mode',NULL,$param['Mode']);?>
	<form name="formProductInfo2">
	<div id="loans">
	<?php 
		$arr_header = array(
			"Tenor"=> lang("Tenor"),
			"LoanAmount" => lang("Loan Amount"),
			"Installment" => lang("Monthly Installment"),
			"DisburseAmount"=> lang("Disburse Amount"),
			"Rate"=> lang("Rate"),
			"NeedNPWP"=> lang("Perlu NPWP/Tidak"),
			"OutstandingTenor"=> lang("Outstanding Tenor"),
			"PilProPremi"=> lang("Pil Pro Premium"),
			"TotalTenorNew"=> lang("Total Tenor New")
		);
		$arr_class = array(
			"Tenor"=> "content-middle",
			"LoanAmount" => "content-middle",
			"Installment" => "content-middle",
			"DisburseAmount"=> "content-middle",
			"Rate"=> "content-middle",
			"NeedNPWP"=> "content-middle",
			"OutstandingTenor"=> "content-middle",
			"PilProPremi"=> "content-middle",
			"TotalTenorNew"=> "content-lasted"
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
		// print_r($loans);
		if( is_array($loans) ){
			$no = 1;
			$tenor = 0;
			foreach( $loans as $num => $rows ){
				$row = new EUI_Object( $rows );
				$tenor = $row->get_value('Tenor',$arr_function['Tenor']);
				$back_color = ( $num%2!=0 ? '#FFFFFF' :'#FFFEEE');
				echo	"<tr bgcolor=\"{$back_color}\" class=\"onselect\" height=\"35\">".
						"<td class=\"content-first\" nowrap>{$no}</td>".
						"<td class=\"content-first\" nowrap>".form()->radio( "key_tenor", "content-first", $tenor)."</td>";
				foreach( array_keys($arr_header) as $k => $fields ){
					if(strtolower($fields) == 'tenor'){
						$numbers = $row->get_value($fields,$arr_function[$fields]);
					}else{
						if(strtolower($fields) == 'rate'){
							$numbera = $row->get_value($fields,$arr_function[$fields])*100;
							$numbers = number_format($numbera, 2, '.', ',')."%";
						}else if(strtolower($fields) == 'neednpwp'){
							$numbers = $row->get_value($fields,$arr_function[$fields]);
						}else{
							$numbers = number_format($row->get_value($fields,$arr_function[$fields]), 0, '.', ',');
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
<fieldset class="corner" style="margin-bottom:15px;">
	<?php echo form()->hidden('isSave',NULL,(is_array($result)&&count($result)>0?1:0));?>
	<?php echo form()->hidden('Mode',NULL,$param['Mode']);?>
	<form name="formProductInfo3">
	<?php  ?>
	<div class="ui-widget-form-table" style="margin-top:-5px;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Benef Name");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("benefname", "select  tolong", null,null,null);?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Benef Bank");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("benefbank", "select  tolong", $listbank,null,null);?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Benef Account");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("benefaccount", "select  tolong");?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Benef branch");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("benefbranch", "select  tolong");?></div>
		</div>
	</div>
	
	<div class="ui-widget-form-table" style="margin-top:-5px;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Benef Name (Ori)");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("benefnameori", "select  tolong", $result['Transfer_Name'],null,array("disabled"=>"disabled"));?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Benef Bank (Ori)");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("benefbankori", "select  tolong", $result['Transfer_Bank'],null,array("disabled"=>"disabled"));?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Benef Account (Ori)");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("benefaccountori", "select  tolong",$result['Transfer_AccNo'],null,array("disabled"=>"disabled"));?></div>
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Benef branch (Ori)");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("benefbranchori", "select  tolong",$result['Transfer_Branch'],null,array("disabled"=>"disabled"));?></div>
		</div>
	</div>
	<?php
		if($param['Mode']!='VIEW'){
		?>
		<div class="ui-widget-form-row" align="Right">
			<div class="ui-widget-form-cell">&nbsp;</div>
			<div class="ui-widget-form-cell">&nbsp;</div>
			<div class="ui-widget-form-cell" align="Right">
				<?php echo form()->button("ButtonUserSave", "button save", lang('Save Prod. Info'), array('click' => 'Ext.DOM.saveProductInfoFlexi();'));?>
			</div>
		</div>
		<?php
		}
		?>
	</form>
</fieldset>