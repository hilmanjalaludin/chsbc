<fieldset class="corner" style="margin-top:-3px;border-radius:5px;padding:5px 0px 10px 0px;">
<?php echo form()->legend(lang(array('Call Activity')), "fa-phone"); ?>
<div style="overflow:auto;margin-top:3px;" class="ui-widget-form-table-compact">
 <?php echo form()->hidden("CallingNumber_2nd",NULL, $SecondDetail->get_value('CustomerMobilePhoneNum')); ?>
	<form name="frmActivityCall_2nd">
	<?php echo form()->hidden('QualityStatus_2nd',NULL,$SecondDetail->get_value('CallReasonQue') );?>
	<?php echo form()->hidden('InputForm_2nd',NULL,0);?>
	<?php echo form()->hidden('InputCDD_2nd',NULL,0);?>
	<?php echo form()->hidden('VerifForm_2nd',NULL,0);?>
	
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Phone Number");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('PhoneNumber_2nd','select tolong select-chosen ui-data-disabled', CustomerContactPhone($SecondDetail->get_value('CustomerId')), $SecondDetail->get_value('CustomerMobilePhoneNum'),array("change" =>"Ext.Cmp('CallingNumber').setValue(this.value);Ext.Cmp('AddPhoneNumber').setValue('');") ); ?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption" style="vertical-align:top;"><?php echo lang("Add Phone");?></div>
			<div class="ui-widget-form-cell center" style="vertical-align:top;">:</div>
			<div class="ui-widget-form-cell" id="DivAddPhone"><?php echo form()->combo('AddPhoneNumber_2nd','select tolong select-chosen ui-data-disabled',CustomerAdditionalPhone($SecondDetail->get_value('CustomerId')), null, array("change" =>"Ext.Cmp('CallingNumber').setValue(this.value);Ext.Cmp('PhoneNumber').setValue('');")); ?></div>
		</div>
		
		<div class="ui-widget-form-row baris1" style="margin-top:-12px;">
			<div class="ui-widget-form-cell text_caption" style="margin-top:-12px;"> </div>
			<div class="ui-widget-form-cell center" style="margin-top:-12px;"></div>
			<div class="ui-widget-form-cell" style="margin-top:-12px;"> <?php echo form()->button("ButtonReload", "button input-chart btn-max ui-data-disabled", lang('Refresh'), array('click' => 'Ext.DOM.LoadAddPhone();'));?> </div>
		</div>
		
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell center"></div>
			<div class="ui-widget-form-cell">
				<?php  echo form()->button("btnDialCustomer","button dial ui-button-max ui-data-disabled", "Call", array("click" => "window.dialCustomer('Manual');") ); ?>
				<?php  echo form()->button("btnHanupCustomer","button hangup ui-button-max ui-data-disabled", "Hangup", array("click" => "window.hangupCustomer();")); ?>
			</div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Call Status");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell" id="ui-disposition-parent2nd"><?php echo form()->combo('CallStatus_2nd','select tolong select-chosen ui-data-disabled', OutboundCategory(),$SecondDetail->get_value('CustomerStatus')); ?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Call Result");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell" id="ui-disposition-result"> <?php echo form()->combo('CallResult_2nd','select tolong select-chosen ui-data-disabled',CallDisposition( $SecondDetail->field('CallReasonId') ), $SecondDetail->get_value('CallReasonId'),array('change'=>'getEventSale(this);')); ?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Disagree");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell" id="ui-disagree-data2nd"><?php echo form()->combo('CallDisagree_2nd','select tolong select-chosen ui-data-disabled', 
													callDisagreeID($SecondDetail->field('CampaignId'), $SecondDetail->field('CallReasonId') ), 
												    $SecondDetail->get_value('DisagreeId'), null, array('disabled'=>true)); ?> </div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Call Later");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell">
				<?php echo form()->input('date_call_later_2nd','input_text box date'); ?>&nbsp;
				<?php echo form()->combo('hour_call_later_2nd','select boox select-chosen ui-data-disabled',ListHour(), '00', null,array('style'=>'width:60px;margin-top:2px;')); ?> :
				<?php echo form()->combo('minute_call_later_2nd','select boox select-chosen ui-data-disabled',ListMinute(),'00', null, array('style'=>'width:60px;margin-top:2px;'));?>
			</div>
		</div>
		<!--
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><x?php echo lang("Product");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"> <x?php echo form()->combo('ProductForm','select tolong select-chosen',CustomerProductId($SecondDetail->get_value('CustomerId')), null, array('change'=>'Ext.DOM.EeventFromProduct(this);'),array('disabled' => true));?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><x?php echo lang("Email Address");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><x?php echo form()->input("CustomerEmail", "input_text tolong", $SecondDetail->get_value('CustomerEmail'));?></div>
		</div>
		-->
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Note");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->textarea("call_remarks_2nd", "textarea tolong ui-data-disabled", null, null, array('style'=> 'height:120px;'));?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell center"></div>
			<div class="ui-widget-form-cell">
				<?php #echo form()->button("ButtonUserSave", "button save ui-button-max ui-data-disabled", lang('Save'), array('click' => 'Ext.DOM.saveActivity();'));?>
				<?php echo form()->button("ButtonUserSave", "save_2nd button save ui-button-max ui-data-disabled", lang('Save'), array("click" => "Ext.DOM.saveActivity('2nd');"));?>
				<?php echo form()->button("ButtonUserCancel2nd", "button cancel ui-button-max", lang('Cancel'), array('click' => 'Ext.DOM.CancelActivity();'));?>
			</div>
		</div>
		
	 </div>
	
	</form>
	</div>	
</fieldset>	