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
	});
	
	Ext.DOM.saveProductInfoPilx = function (){
		if(Ext.Cmp('benefname').getValue()==""){
			alert('Benef Name is empty!');
			return false;
		}else if(Ext.Cmp('benefbank').getValue()==""){
			alert('Benef Bank is empty!');
			return false;
		}else if(Ext.Cmp('benefaccount').getValue()==""){
			alert('Benef Account is empty!');
			return false;
		}else if(Ext.Cmp('benefbranch').getValue()==""){
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
			<div class="ui-widget-form-cell"><?php echo form()->combo("typexsell", "select  tolong", array('Y'=>'YES','N'=>'NO'),'Y',null,array('disabled'=>'disabled'));?></div>
		</div>
	</div>
	<div class="ui-widget-form-table" style="margin-top:-5px;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Var. Tiering");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("vartiering", "select  tolong", array(50=>50,60=>60,70=>70,80=>80,100=>100),($frm['vartiering']>0?$frm['vartiering']:100),array("change"=>"Ext.DOM.getLoan(this.value)"));?></div>
		</div>
	</div>
	<div class="ui-widget-form-table" style="margin-top:-5px;">
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
			<?php echo form()->combo("incomeDoc_Collected", "select incomeDoc_Collected tolong", array('Y'=>'Y','N'=>'N'),'N',null,'');?></div>
		</div>
	</div>
		
	<?php } else {
		echo form()->hidden('incomeDoc_Collected',NULL,NULL);
	}
	?>
	
	
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
				$back_color = ( $num%2!=0 ? '#FFFFFF' :'#FFFEEE');
				if($frm['Tenor']==$tenor){
					$checkedtenor = array("checked"=>"checked");
				}else{
					$checkedtenor = NULL;
				}
				echo	"<tr bgcolor=\"{$back_color}\" class=\"onselect\" height=\"35\">".
						"<td class=\"content-first\" nowrap>{$no}</td>".
						"<td class=\"content-first\" nowrap>".form()->radio( "key_tenor", "content-first", $tenor, null, $checkedtenor)."</td>";
				foreach( array_keys($arr_header) as $k => $fields ){
					if(strtolower($fields) == 'tenor'){
						$numbers = $row->get_value($fields,$arr_function[$fields]);
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
<fieldset class="corner" style="margin-bottom:15px;">
	<?php echo form()->hidden('isSave',NULL,(is_array($result)&&count($result)>0?1:0));?>
	<?php echo form()->hidden('Mode',NULL,$param['Mode']);?>
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
				if(_get_session('HandlingType')==4){
					echo form()->button("ButtonUserSave", "button save", lang('Save Prod. Info'), array('click' => 'Ext.DOM.saveProductInfoPilx();'));
				}
				?>
			</div>
		</div>
		<?php
		}
		?>

	</form>
</fieldset>