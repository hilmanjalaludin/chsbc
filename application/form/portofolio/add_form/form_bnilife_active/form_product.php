<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/*
 * @ def    : include payer page HTML on layout form 
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 */
?>

 <fieldset class="corner" style="font-family:Trenuchet MS;margin:5px 10px 10px 12px; padding:5px 8px 15px 8px;border-radius:5px;">
	<?php echo form()->legend(lang("Product"),"fa-bars");?>
	<form name="frmDataProduct">	
	<?php echo form()->hidden('CustomerId',NULL,_get_64post('CustomerId'));?>
		<div class="ui-widget-form-table" style="width:99%;">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang('Product');?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo("ProductId","select long",$Product['ProductId'],$ProductId, null, array('disabled'=>true));?></div>
				<div class="ui-widget-form-cell text_caption"><?php echo lang('Sales Date');?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->input("SalesDate","input_text long",$Product['SalesDate']);?></div>
				
				<div class="ui-widget-form-cell text_caption"><?php echo lang('Policy Number');?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->input("PolicyNumber","input_text long",$Product['PolicyNumber'], null, array('disabled' => true));?></div>
				
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang('Pecah Policy');?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo("PecahPolicy","select long",$Product['PecahPolicy'],'0', null, array('disabled' => true));?></div>
				<div class="ui-widget-form-cell text_caption"><?php echo lang('Efective Date');?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->input("EfectiveDate","input_text long",$Product['EfectiveDate']);?></div>
			</div>
		</div>
	</form>
</fieldset>	
