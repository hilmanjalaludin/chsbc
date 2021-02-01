<fieldset class="corner" style="margin-top:-3px;border-radius:5px;padding:5px 0px 10px 0px;">
<?php echo form()->legend(lang(array('Customer','Information')), "fa-info"); ?>

<div id="contact_default_info" class="box-left-top">
<form name="frmInfoCustomer">
<?php echo form()->hidden('CustomerId',NULL, $Detail->get_value('CustomerId') );?>
<?php echo form()->hidden('CustomerNumber',NULL, $Detail->get_value('CustomerNumber') );?>

<!-- start detail default -->

<div class="ui-widget-form-table-compact">
	<div class="ui-widget-form-row baris1">
		<div class="ui-widget-form-cell text_caption"><?php echo lang('Customer Name');?></div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input('CustomerFirstName','input_text superlong ui-disabled',$Detail->get_value('CustomerFirstName','_setCapital'),NULL,1);?></div>
		
		<div class="ui-widget-form-cell text_caption"><?php echo lang('Gender');?></div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo('GenderId','select superlong select-chosen ui-disabled',Gender(), $Detail->get_value('GenderId'),NULL,1);?></div>
	</div>
	
	<div class="ui-widget-form-row baris2">
		
		<div class="ui-widget-form-cell text_caption"><?php echo lang('Age');?></div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input('Age','input_text superlong ui-disabled',$Detail->get_value('CustomerDOB','_getAge'),NULL,1);?></div>
		
		<div class="ui-widget-form-cell text_caption"><?php echo lang('City');?></div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input('CustomerCity','input_text superlong ui-disabled',$Detail->get_value('CustomerCity'),NULL,1);?></div>
		
	</div>
	
	<div class="ui-widget-form-row baris2"></div>
	<div class="ui-widget-form-row baris2"></div>
	
	
</div>
<!-- stop: detail default -->
</form>
</div>
</fieldset>	

<?php $this ->load ->view('mod_contact_detail/view_customer_info');?>