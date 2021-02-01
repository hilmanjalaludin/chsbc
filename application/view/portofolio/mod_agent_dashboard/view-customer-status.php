
<fieldset class="corner" style="padding:5px 5px 10px 8px;margin:-10px 0px 5px 0px;">
<?php echo form()->legend(lang("Summary Result Data"), "fa-bars"); ?>

<div class="ui-widget-form-table-compact" style="padding:-8px 0px 8px 0px; width:95%;margin:-5px 0px 5px 0px;">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Campaign Name');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('CampaignId','select superlong xzselect', CampaignId(), null, array("change"=>"getByCampaign(this.value);"));?> </div>
		</div>	
	</div>
	
	<div class="ui-widget-form-tale-compact" id="content-customer-result" style="padding:5px 5px 5px 5px;margin:20px 0px 10px 0px;"> 
	</div>
</div>
</fieldset>	
