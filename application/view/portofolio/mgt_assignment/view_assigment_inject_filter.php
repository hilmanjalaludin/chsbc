<fieldset class="corner" style="width:auto;padding: 4px 4px 2px 4px;margin:-12px 5px 5px 5px; border-radius:5px;">
<?php echo form()->legend(lang("Filter Campaign Transfer"),"fa-search");?>
	<form name="formInjectFilter">
	<div class="ui-widget-form-table" style="margin-top:-5px;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Campaign Name");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("inject_from_campaign_id", "select  tolong",CampaignId());?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Call Result");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("inject_call_result_id", "select  tolong", CallResultTransfer());?></div>
		</div>
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("From Group");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("inject_from_user_group", "select  tolong",DitributeUserLevel(),null, array('change' =>'Ext.DOM.SelectUserPullByGroup(this);'));?></div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("From User");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell" id="ui-user-inject-list"><?php echo form()->combo("inject_form_user_list", "select tolong", array());?></div>
		</div>	
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Last Call Date");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("inject_call_start_date", "input_text date");?><?php echo lang("to"); ?><?php echo form()->input("inject_end_start_date", "input_text date");?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell">
				<?php echo form()->button("BtnInjectFilter","button search", lang("Search"), array('click' => 'Ext.DOM.SearchDataInject();'));?>
				<?php echo form()->button("BtnInjectReset","button clear", lang(array("Clear","&nbsp;&nbsp;")), array('click' => 'Ext.DOM.ClearDataInject();'));?>	
			</div>
		</div> 
	</div>
	</form>
</fieldset>