<form name="fltQualityUnAssign">
					<fieldset class="corner" style="border-radius:5px;margin:0px 8px 8px 25px;padding:5px 5px 10px 5px;">
						<?php echo form()->legend(lang('Option Filter'), "fa-edit"); ?>
						<div class="ui-widget-form-table" style="margin-top:-5px;">
							<div class="ui-widget-form-row">
								<div class="ui-widget-form-cell text_caption"><?php echo lang("Campaign Name");?></div>
								<div class="ui-widget-form-cell text_caption">:</div>
								<div class="ui-widget-form-cell"><?php echo form()->combo("pull_from_campaign_id", "select  tolong",CampaignId());?></div>
							</div>
							
							<div class="ui-widget-form-row">
								<div class="ui-widget-form-cell text_caption"><?php echo lang("Field Data ");?></div>
								<div class="ui-widget-form-cell text_caption">:</div>
								<div class="ui-widget-form-cell"><?php echo form()->combo("pull_field_value1", "select  tolong", FieldValue());?></div>
							</div>
							
							<div class="ui-widget-form-row">
								<div class="ui-widget-form-cell text_caption"><?php echo lang("Logical");?></div>
								<div class="ui-widget-form-cell text_caption">:</div>
								<div class="ui-widget-form-cell"><?php echo form()->combo("pull_field_filter1", "select  tolong",FilterValue());?></div>
							</div>	
							
							<div class="ui-widget-form-row">
								<div class="ui-widget-form-cell text_caption"><?php echo lang("Parameter");?></div>
								<div class="ui-widget-form-cell text_caption">:</div>
								<div class="ui-widget-form-cell" ><?php echo form()->textarea("pull_field_text1", "textarea tolong");?></div>
							</div>	
							
							<div class="ui-widget-form-row">
								<div class="ui-widget-form-cell text_caption"><?php echo lang("Call Result");?></div>
								<div class="ui-widget-form-cell text_caption">:</div>
								<div class="ui-widget-form-cell"><?php echo form()->combo("pull_call_result_id", "select  tolong", CallResult());?></div>
							</div>
							
							
							<div class="ui-widget-form-row">
								<div class="ui-widget-form-cell text_caption"><?php echo lang("From Group");?></div>
								<div class="ui-widget-form-cell text_caption">:</div>
								<div class="ui-widget-form-cell"><?php echo form()->combo("pull_from_user_group", "select  tolong", DitributeUserLevel(),null, array('change' =>'Ext.DOM.SelectUserPullByGroup(this);'));?></div>
							</div>	
							
							<div class="ui-widget-form-row">
								<div class="ui-widget-form-cell text_caption"><?php echo lang("From User");?></div>
								<div class="ui-widget-form-cell text_caption">:</div>
								<div class="ui-widget-form-cell" id="ui-user-pull-list"><?php echo form()->combo("pull_form_user_list", "select tolong", array());?></div>
							</div>	
							
							
							<div class="ui-widget-form-row">
								<div class="ui-widget-form-cell text_caption"><?php echo lang("Last Call Date");?></div>
								<div class="ui-widget-form-cell text_caption">:</div>
								<div class="ui-widget-form-cell"><?php echo form()->input("pull_call_start_date", "input_text date");?><?php echo lang("to"); ?><?php echo form()->input("pull_end_start_date", "input_text date");?></div>
							</div>
							
							<div class="ui-widget-form-row">
								<div class="ui-widget-form-cell text_caption"></div>
								<div class="ui-widget-form-cell text_caption"></div>
								<div class="ui-widget-form-cell">
									<?php echo form()->button("BtnPullFilter","button search", lang("Search"), array('click' => 'Ext.DOM.SearchPullData();'));?>
									<?php echo form()->button("BtnPullReset","button clear", lang(array("Clear","&nbsp;&nbsp;")), array('click' => 'Ext.DOM.ClearPullData();'));?>	
								</div>
							</div> 
						</div>	
					</fieldset>	
					</form>