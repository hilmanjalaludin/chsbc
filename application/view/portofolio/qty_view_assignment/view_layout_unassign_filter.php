
<fieldset class="corner" style="border-radius:5px;margin:2px 8px 8px 20px;padding:8px 35px 10px 5px;">
<?php echo form()->legend(lang('Option Filter'), "fa-edit"); ?>
<form name="fltQualityUnAssign">
<div class="ui-widget-form-table" style="width:99%;margin-top:-5px;">
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption"><?php echo lang("Campaign Name");?></div>
		<div class="ui-widget-form-cell text_caption">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo("qty_from_campaign_id", "select tolong",CampaignId());?></div>
	</div>
		
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption"><?php echo lang("Quality Status");?></div>
		<div class="ui-widget-form-cell text_caption">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->combo("qty_status_id", "select  tolong", QualityStatus());?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption"><?php echo lang("Quality Staff");?></div>
		<div class="ui-widget-form-cell text_caption">:</div>
		<div class="ui-widget-form-cell" id="ui-user-pull-list"><?php echo form()->combo("qty_form_user_list", "select tolong", $QualityGroup);?></div>
	</div>	
							
							
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption"><?php echo lang("Sales Date");?></div>
		<div class="ui-widget-form-cell text_caption">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input("qty_call_start_date", "input_text date");?><?php echo lang("to"); ?><?php echo form()->input("qty_end_start_date", "input_text date");?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption"><?php echo lang("Record/Page");?></div>
		<div class="ui-widget-form-cell text_caption">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->input("qty_record_page", "input_text box", 20);?></div>
	</div>
							
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption"></div>
		<div class="ui-widget-form-cell text_caption"></div>
		<div class="ui-widget-form-cell">
			<?php echo form()->button("BtnPullFilter","button search", lang("Search"), array('click' => 'Ext.DOM.SearchUnAssignData();'));?>
			<?php echo form()->button("BtnPullReset","button clear", lang(array("Clear","&nbsp;&nbsp;")), array('click' => 'Ext.DOM.ClearUnAssignData();'));?>	
		</div>
	</div> 
</div>	
</form>
</fieldset>	


<fieldset class="corner ui-widget-fieldset" style="border-radius:5px;margin:15px 8px 8px 20px;padding:8px 35px 10px 5px;">
<?php echo form()->legend(lang(array("Option","UnAssignment")),"fa-gear");?>
	<form name="frmUnAssignOption">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell"><?php echo form()->ListCheckbox("qty_user_action", DistribusiAction(), null, array("change" =>"Ext.Cmp('qty_user_action').oneChecked(this);ActionCheckData(this);")); ?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Total Data");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("qty_user_total", "input_text tolong");?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Quantity");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("qty_user_quantity", "input_text tolong");?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell">
				<?php echo form()->button("BtnPullData", "button assign",lang("Submit"), array("click" => "Ext.DOM.SubmitQualityUnAssignData();"));?></div>
		</div>
	</div>
	</form>
</fieldset>