<?php

 if( !function_exists('SetAgentDisabled') ) {
  function SetAgentDisabled() 
 {
	$arr_class = "";
	if( in_array(_get_session('HandlingType'),  
	array(USER_AGENT_OUTBOUND, USER_AGENT_INBOUND))){
	   $arr_class = "agent_disabled";
	}
	return $arr_class;
  }
}

 $arr_class = "";
 $arr_class = SetAgentDisabled();
?>
<fieldset class="corner" style="margin-top:-3px;border-radius:5px;padding:5px 0px 10px 0px;">
<?php echo form()->legend(lang(array('Call Activity')), "fa-phone"); ?>
<div style="overflow:auto;margin-top:3px;" class="ui-widget-form-table-compact">
 <?php echo form()->hidden("CallingNumber",NULL, $Attrs->get_value('CallNumber', 'intval')); ?>
	<form name="frmActivityCall">
	<?php echo form()->hidden('QualityStatus',NULL,$Detail->get_value('CallReasonQue') );?>
	
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Phone Number");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('PhoneNumber',"select tolong select-chosen {$arr_class}", CustomerContactPhone($Detail->get_value('CustomerId')), $Attrs->get_value('CallNumber', 'intval'),array("change" =>"Ext.Cmp('CallingNumber').setValue(this.value);") ); ?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Add Phone");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('AddPhoneNumber','select tolong select-chosen ui-disabled',CustomerAdditionalPhone($Detail->get_value('CustomerId')), $Attrs->get_value('CallNumber', 'intval'), array("change" =>"Ext.Cmp('CallingNumber').setValue(this.value);")); ?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell center"></div>
			<div class="ui-widget-form-cell">
				<span id="spancall" class="<?php echo $Class->get_value('arr_class_image');?>" style="cursor:pointer;color:red;vertical-align:center;" onclick="dialCustomer();"><img id="callImage" class="image-calls <?php echo $Class->get_value('arr_class_image');?>" src="<?php echo base_url(); ?>/library/gambar/PhoneCall.png" width="35px" height="35px" style="cursor:pointer;" title="Dial..." > Call</span>	
				<span id="spanhangup" class="<?php echo $Class->get_value('arr_class_image');?>" style="cursor:pointer;color:red;vertical-align:center;" onclick="hangupCustomer();"><img id="hangupImage" class="image-hangup <?php echo $Class->get_value('arr_class_image');?>" src="<?php echo base_url(); ?>/library/gambar/HangUp.png" width="35px" height="35px" style="cursor:pointer;" title="Hangup..." > HangUp</span>
			</div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Call Status");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('CallStatus','select tolong select-chosen ui-disabled', OutboundCategory(),$Detail->get_value('CallReasonCategoryId'),array('change'=>"getCallReasultId(this);")); ?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Call Result");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell" id="DivCallResultId"><?php echo form()->combo('CallResult','select tolong select-chosen ui-disabled',CallResultByCategory($Detail->get_value('CallReasonCategoryId')), $Detail->get_value('CallReasonId'),array('change'=>'getEventSale(this);')); ?> </div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Call Later");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell">
				<?php echo form()->input('date_call_later',"input_text box date {$arr_class}"); ?>&nbsp;
				<?php echo form()->combo('hour_call_later',"select boox select-chosen {$arr_class}",ListHour(), '00', null,array('style'=>'width:60px;margin-top:2px;')); ?> :
				<?php echo form()->combo('minute_call_later',"select boox select-chosen {$arr_class}",ListMinute(),'00', null, array('style'=>'width:60px;margin-top:2px;'));?>
			</div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Product");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"> <?php echo form()->combo('ProductForm',"select tolong select-chosen ui-disabled {$arr_class}",CustomerProductId($Detail->get_value('CustomerId')), $Attrs->get_value('ProductId', 'intval'));?></div>
		</div>
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Email Address");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("CustomerEmail", "input_text tolong {$Class->get_value('arr_class_data')} {$arr_class}", $Detail->get_value('CustomerEmail'));?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"> </div>
			<div class="ui-widget-form-cell center"> </div>
			<div class="ui-widget-form-cell"> 
				<?php echo form()->checkbox("edit_policy_box", "{$Class->get_value('arr_class_data')} {$arr_class}", $Attrs->get_value('ProductId', 'intval'), array('change'=>'Ext.DOM.EeventFromProduct(this);') );?> 
				<span class="<?php echo $Class->get_value('arr_class_data');?>" style="font-family:Trebuchet MS;color:red;font-size:12px;">Edit Form</span>
				&nbsp;&nbsp;<?php echo form()->checkbox("pending_policy_box", "{$arr_class}", 1);?> 
				<span style="font-family:Trebuchet MS;color:red;font-size:12px;">Pending Form</span>
			</div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Note");?></div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->textarea("call_remarks", "textarea tolong uppercase {$arr_class}", null, null, array('style'=> 'height:120px;'));?></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell center"></div>
			<div class="ui-widget-form-cell">
				<?php echo form()->button("ButtonUserSave", "button save ". $Class->get_value('arr_class_input') ." {$arr_class}", lang('Save'), array('click' => 'Ext.DOM.saveActivity();'));?>
				<?php echo form()->button("ButtonUserCancel", "button cancel", lang('Cancel'), array('click' => 'Ext.DOM.CancelActivity();'));?>
			</div>
		</div>
		
	 </div>
	
	</form>
	</div>	
</fieldset>	