<form name="formTransFilter">
<fieldset class="corner" style="width:auto;padding: 4px 4px 2px 4px;margin:-10px 5px 10px 5px; border-radius:5px;">
<?php echo form()->legend(lang("Filter Transfer"),"fa-search");?>
	<div class="ui-widget-form-table" style="margin-top:-5px;">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Campaign Name");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("trans_from_campaign_id", "select  tolong",CampaignId());?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Field Data ");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("trans_field_value1", "select  tolong", FieldValue());?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Logical");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("trans_field_filter1", "select  tolong",FilterValue());?></div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Parameter");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell" ><?php echo form()->textarea("trans_field_text1", "textarea tolong", null,null, array("style"=> "height:30px;") );?></div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Call Status");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("trans_call_status_id", "select  tolong", OutboundCategory());?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Call Result");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("trans_call_result_id", "select  tolong", CallResultNotInterest(),null,array('change'=>'Ext.DOM.CallStatCheck2(this)'));?></div>
		</div>

		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Disagree Code</div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div id="aading2" class="ui-widget-form-cell">
			<select name="disagree2" id="disagree2" disabled class="select tolong"><option>Choose</option></select>
			</div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Call Atempt");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell">
				<?php echo form()->input("trans_start_call_atempt", "input_text box", null, null, array("style" =>"width:85px;" ));?>
				<span style="margin:0px 5px 0px 5px;"><?php echo lang("to");?></span>
				<?php echo form()->input("trans_end_call_atempt", "input_text box", null, null, array("style" =>"width:85px;" ));?>
			</div>
		</div>
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("From Group");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("trans_from_user_group", "select  tolong",DitributeUserLevel(),null, array('change' =>'Ext.DOM.SelectUserTransByGroup(this);'));?></div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("From User");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell" id="ui-user-trans-list"><?php echo form()->combo("trans_form_user_list", "select tolong", array());?></div>
		</div>	
		
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Last Call Date");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("trans_call_start_date", "input_text date");?><?php echo lang("to"); ?><?php echo form()->input("trans_end_start_date", "input_text date");?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Record/Page");?></div>
			<div class="ui-widget-form-cell text_caption">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("trans_record_page", "input_text tolong", 20);?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell">
				<?php echo form()->button("BtnTransFilter","button search", lang("Search"), array('click' => 'Ext.DOM.SearchDataTrans();'));?>
				<?php echo form()->button("BtnTransReset","button clear", lang(array("Clear","&nbsp;&nbsp;")), array('click' => 'Ext.DOM.ClearDataTrans();'));?>	
			</div>
		</div> 
	</div>
</fieldset>
</form>