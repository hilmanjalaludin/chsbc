<fieldset class="corner" style="margin-top:-3px;border-radius:5px;padding:5px 0px 10px 0px;">
<?php echo form()->legend(lang(array('Confirm Activity')), "fa-phone"); ?>
<div style="overflow:auto;margin-top:3px;" class="ui-widget-form-table-compact">
 <?php echo form()->hidden("CallingNumber",NULL, $Detail->get_value('CustomerMobilePhoneNum')); ?>
	<form name="frmActivityCall">
	<?php //echo form()->hidden('QualityStatus',NULL,$Detail->get_value('CallReasonQue') );?>
	<?php echo form()->hidden('InputForm',NULL,0);?>
	<?php echo form()->hidden('VerifForm',NULL,0);?>
	
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Phone Number");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('PhoneNumber','select tolong select-chosen', CustomerContactPhone($Detail->get_value('CustomerId')), $Detail->get_value('CustomerMobilePhoneNum'),array("change" =>"Ext.Cmp('CallingNumber').setValue(this.value);") ); ?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Add Phone");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('AddPhoneNumber','select tolong select-chosen',CustomerAdditionalPhone($Detail->get_value('CustomerId')), null, array("change" =>"Ext.Cmp('CallingNumber').setValue(this.value);")); ?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell center"></div>
			<div class="ui-widget-form-cell">
				<span style="cursor:pointer;color:red;vertical-align:center;" onclick="dialCustomer();"><img class="image-calls" src="<?php echo base_url(); ?>/library/gambar/PhoneCall.png" width="35px" height="35px" style="cursor:pointer;" title="Dial..." > Call</span>	
				<span style="cursor:pointer;color:red;vertical-align:center;" onclick="hangupCustomer();"><img class="image-hangup" src="<?php echo base_url(); ?>/library/gambar/HangUp.png" width="35px" height="35px" style="cursor:pointer;" title="Hangup..." > HangUp</span>
				
			</div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Confirm Status");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"> <?php echo form()->combo('QualityStatus','select tolong select-chosen',_getApproveStatusTMR(), null, array('change'=>'Ext.DOM.HandleDisagreeX();') );?></div>
		</div>
		<?php echo form()->hidden('CallStatus',null,$Detail->get_value('CallReasonCategoryId')); ?>
		<?php echo form()->hidden('CallResult',null,$Detail->get_value('CallReasonId')); ?>
		<?php echo form()->hidden('date_call_later'); ?>
		<?php echo form()->hidden('hour_call_later'); ?>
		<?php echo form()->hidden('minute_call_later'); ?>
		<!--
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><x?php echo lang("Call Status");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><x?php echo form()->combo('CallStatus','select tolong select-chosen', OutboundCategory(),$Detail->get_value('CallReasonCategoryId'),array('change'=>"getCallReasultId(this);")); ?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><x?php echo lang("Call Result");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell" id="DivCallResultId"><x?php echo form()->combo('CallResult','select tolong select-chosen',CallResultByCategory($Detail->get_value('CallReasonCategoryId')), $Detail->get_value('CallReasonId'),array('change'=>'getEventSale(this);')); ?> </div>
		</div>
		-->
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Disagree");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('CallDisagree','select tolong select-chosen',_getDisagree($Detail->get_value('CampaignId')), $Detail->get_value('CustomerMobilePhoneNum'),null,array('disabled'=>true)); ?> </div>
		</div>
		<!--
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><x?php echo lang("Call Later");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell">
				<x?php echo form()->input('date_call_later','input_text box date',null,null,array('disabled'=>true)); ?>&nbsp;
				<x?php echo form()->combo('hour_call_later','select boox select-chosen',ListHour(), '00', null,array('style'=>'width:60px;margin-top:2px;','disabled'=>true)); ?> :
				<x?php echo form()->combo('minute_call_later','select boox select-chosen',ListMinute(),'00', null, array('style'=>'width:60px;margin-top:2px;','disabled'=>true));?>
			</div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><x?php echo lang("Product");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"> <x?php echo form()->combo('ProductForm','select tolong select-chosen',CustomerProductId($Detail->get_value('CustomerId')), null, array('change'=>'Ext.DOM.EeventFromProduct(this);'),array('disabled' => true));?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><x?php echo lang("Email Address");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><x?php echo form()->input("CustomerEmail", "input_text tolong", $Detail->get_value('CustomerEmail'));?></div>
		</div>
		-->
				
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Note");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->textarea("call_remarks", "textarea tolong uppercase", null, null, array('style'=> 'height:120px;'));?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell center"></div>
			<div class="ui-widget-form-cell">
				<?php echo form()->button("ButtonUserSave", "button save", lang('Save'), array('click' => 'Ext.DOM.saveActivity();'));?>
				<?php echo form()->button("ButtonUserCancel", "button cancel", lang('Cancel'), array('click' => 'Ext.DOM.CancelActivity();'));?>
			</div>
		</div>
		
	 </div>
	
	</form>
	</div>	
</fieldset>	