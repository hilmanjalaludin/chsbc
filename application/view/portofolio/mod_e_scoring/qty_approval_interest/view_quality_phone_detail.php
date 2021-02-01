
<form name="frmQualityActivity">
<fieldset class="corner" style="display:none;margin-top:-3px;border-radius:5px;padding:5px 0px 10px 0px;">
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
				<?php echo form()->checkbox("edit_policy_box", NULL, $Customers->get_value('ProductId'),array('change'=>'Ext.DOM.EeventFromProduct(this);') );?> 
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
</form>