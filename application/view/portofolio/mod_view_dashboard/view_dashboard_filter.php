<form name="frmDsbFilter">
<div class="ui-widget-form-table-compact" style="margin-top:-10px;">
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Campaign Name</div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell left"><?php echo form()->combo('dsb_campaign','select tolong', Campaign());?></div>
		
		
		
	</div>
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Supervisor</div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell left"><?php echo form() -> combo('dsb_supervisor','select tolong', $Supervisor,_get_session('UserId'));?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption">Interval</div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell left">
			<?php echo form()->input('dsb_start_date','input_text date');?>
			<?php echo lang('to');?>
			<?php echo form()->input('dsb_end_date','input_text date');?>
		</div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption"></div>
		<div class="ui-widget-form-cell text_caption center"></div>
		<div class="ui-widget-form-cell left">
			<?php echo form()->button('dsb_button_data','button search',"Show", array("click" => "new ShowDasboard();"));?>
		</div>
	</div>
</div>
</form>