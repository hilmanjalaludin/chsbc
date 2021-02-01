<fieldset class="corner" style="margin:15px 5px 5px 5px; padding:2px 17px 12px 8px; border-radius:5px;">
<?php echo form()->legend(lang("Filter"),"fa-search");?>


<script>
$(document).ready(function() {
    $('.date').datepicker({
	   showOn: 'button', 
	   buttonImage: Ext.DOM.LIBRARY+'/gambar/calendar.gif', 
	   buttonImageOnly: true, 
	   dateFormat:'dd-mm-yy',
	   readonly:true
	});
});

</script>

<form name="frmFilterAssingLeft">

<div class="ui-widget-form-table-maximum">
	<div class='ui-widget-form-row'>
		<div class='ui-widget-form-cell text_caption'><?php echo lang("Campaign Name");?></div>
		<div class='ui-widget-form-cell text_caption center'>:</div>
		<div class='ui-widget-form-cell'><?php echo form()->listCombo('CampaignId', "textarea superlong", CampaignId(), 
			null, null, array("height" => "200px","dwidth" => "100%") ); ?></div>	
	</div>

	<div class='ui-widget-form-row'>
		<div class='ui-widget-form-cell text_caption'><?php echo lang("Sales Date");?></div>
		<div class='ui-widget-form-cell text_caption center'>:</div>
		<div class='ui-widget-form-cell'>
			<?php echo form()->input('start_date','date input_text',null); ?>
			<?php echo lang("to");?>
			<?php echo form()->input('end_date','date input_text',null); ?>
		</div>	
	</div>
	
	<!-- d iv class='ui-widget-form-row'>
		<div class='ui-widget-form-cell text_caption'><?php echo lang("Duration");?></div>
		<div class='ui-widget-form-cell text_caption center'>:</div>
		<div class='ui-widget-form-cell'>
			<?#php echo form()->input('start_duration','input_text box',null); ?>(s)
			&nbsp;<?#php echo lang("to");?>
			<?#php echo form()->input('end_duration','input_text box',null); ?>(s)
		</div>	
	</di v -->
</div>
</form>
</fieldset>