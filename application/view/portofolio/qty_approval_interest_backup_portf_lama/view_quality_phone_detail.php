
<form name="frmQualityActivity">
<fieldset class="corner" style="margin-top:-3px;border-radius:5px;padding:5px 0px 10px 0px;">
<?php echo form()->legend(lang(array('Call Activity')), "fa-phone"); ?>
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Phone Number'));?> </div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('PhoneNumber','select tolong xchosen', CustomerContactPhone( $Customers->get_value('CustomerId'), 1) ,$Callhistory['CallNumber'], null); ?></div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Add Phone Number'));?>  </div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('AddPhoneNumber','select tolong xchosen',CustomerAdditionalPhone($Customers->get_value('CustomerId')),$Callhistory['CallNumber'], null, array('disabled'=>true)); ?></div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Call Status'));?> </div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('CallStatus','select tolong xchosen', OutboundCategory(), $Customers->get_value('CallReasonCategoryId'),null,array('disabled'=>true)); ?></div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Call Result'));?> </div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('CallResult','select tolong xchosen',CallResultByCategory($Customers->get_value('CallReasonCategoryId')), $Customers->get_value('CallReasonId'),null,array('disabled'=>true)); ?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell center"></div>
			<div class="ui-widget-form-cell left">
				<?php echo form()->checkbox("edit_policy_box", NULL, $Policy->get_value('ProductId'),array('change'=>'Ext.DOM.EeventFromProduct(this);') );?> 
				<span style="color:red;font-size:11px;"><?php echo lang(array('Edit Form'));?></span> 
			</div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell center"></div>
			<div class="ui-widget-form-cell left"></div>
		</div>
		
		<div class="ui-widget-form-row baris1">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell center"></div>
			<div class="ui-widget-form-cell">
				<span class="<?php //echo $Disabled;?>" style="cursor:pointer;color:red;vertical-align:center;" onclick="dialCustomer();"><img class="image-calls <?php //echo $Disabled;?>" src="<?php echo base_url(); ?>/library/gambar/PhoneCall.png" width="35px" height="35px" style="cursor:pointer;" title="Dial..." > Call</span>	
				<span class="<?php //echo $Disabled;?>" style="cursor:pointer;color:red;vertical-align:center;" onclick="hangupCustomer();"><img class="image-hangup <?php //echo $Disabled;?>" src="<?php echo base_url(); ?>/library/gambar/HangUp.png" width="35px" height="35px" style="cursor:pointer;" title="Hangup..." > HangUp</span>
				
			</div>
		</div>
		
	</div>	

</fieldset>

<fieldset class="corner" style="margin-top:12px;border-radius:5px;padding:5px 0px 10px 0px;">
<?php echo form()->legend(lang(array('Quality Activity')), "fa-pencil"); ?>
	<div class="ui-widget-form-table-compact">	
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Quality Status'));?> </div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('QualityStatus',"select tolong xchosen ui-widget-qty-disabled ", QualityStatus(), QualityParentStatus($Customers->get_value('CallReasonQue')), array("change" => "Ext.DOM.SetQualityReason(this);") ); ?></div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Reason Status'));?> </div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left" id="ui-widget-qty-reason"><?php echo form()->combo('QualityReasonStatus','select tolong xchosen ui-widget-qty-disabled', QualityReason( $Customers->get_value('CallReasonQue') ) , $Customers->get_value('CallReasonQue'), null ); ?></div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Quality Remarks'));?> </div>
			<div class="ui-widget-form-cell center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->textarea('QualityRemarks','textarea ui-widget-qty uppercase tolong',$ResultPoints['ApprovalRemark'], null,array('style' => 'height:150px;color:#333BBB;'));?></div>
		</div>	
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell center"></div>
			<div class="ui-widget-form-cell left">
				<?php echo form()->button('ButtonbSave',"button save {$Disabled}",'Save', array("click" =>"Ext.DOM.SaveQualityActivity();"));?>
				<?php echo form()->button('ButtonbCancel','button cancel','Cancel', array("click" =>"Ext.DOM.CancelActivity();"));?>
			</div>
		</div>
	</div>
</fieldset>	
</form>