<script>
$(document).ready(function(){
	$(".disabled").each(function(){
		var ObjectId = $(this).attr('id');
		Ext.Cmp(ObjectId).disabled(true);	
	});
 });
 </script>
 
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Product'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input("PProductName", "input_text disabled tolong", $Policy->get_value('ProductName'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Campaign Name'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input("PCampaignName", "input_text disabled tolong", $Policy->get_value('CampaignName') );?></div>
			
		</div>
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Closing ID'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("PPolicyNumber", "input_text disabled tolong", $Policy->get_value('PolicyNumber'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Sales Date'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input("PPolicySalesDate", "input_text disabled tolong", $Policy->get_value('PolicySalesDate','_getDateTime'));?></div>
		</div>		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Effective Date'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input("PPolicyEffectiveDate", "input_text disabled tolong", $Policy->get_value('PolicyEffectiveDate','_getDateTime'));?></div>
		</div>	
	</div>

