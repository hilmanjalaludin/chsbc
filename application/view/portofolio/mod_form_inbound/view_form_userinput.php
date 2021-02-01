
<fieldset class="corner" style="padding:8px 8px 10px 10px;margin:0px 0px 5px 0px;">
<?php echo form()->legend(lang("Caller Incoming"), "fa-phone"); ?>

<div id="result_content_add" class='ui-widget-content-table' style="text-align:center;">
<form name="frmCallInbound">
 <?php __(form()->hidden('CampaignId', null, $Caller['Campaign']['CampaignId']));?>
 <?php __(form()->hidden('CallSessionId', null,  $Caller['CallSessionId']));?>
 
 <div class="ui-widget-content-table-compact">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption "> Campaign Name </div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"> <?php echo form() -> input('CampaignName','input_text superlong', $Caller['Campaign']['CampaignName'], null, array('disabled'=>true));?></div>
			<div class="ui-widget-form-cell text_caption " valign="top"> Caller Number </div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> input('PhoneNumber','input_text superlong',_getPhoneNumber($Caller['CallerId']), null,array('disabled'=>true, 'style'=>'width:98%;'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption "> Customer Name</div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> input('CustomerFirstName','input_text superlong');?></div>
			<div class="ui-widget-form-cell text_caption"> Yes Phone Number </div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> combo('slectPhone','select superlong xselect', array( 'CustomerHomePhoneNum' => 'Home Phone','CustomerWorkPhoneNum' => 'Office Phone', 'CustomerMobilePhoneNum' => 'Mobile Phone'), null, null, array('style'=>'width:99%;')); ?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption "> Customer Gender</div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> combo('GenderId','select superlong xselect',$GenderId);?></div>
			<div class="ui-widget-form-cell text_caption"> Office Phone</div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form() -> input('CustomerWorkPhoneNum','input_text superlong', null, null, array('style'=>'width:98%;'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption ">Mobile Phone</div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"> <?php echo form() -> input('CustomerMobilePhoneNum','input_text superlong');?></div>
			
			<div class="ui-widget-form-cell text_caption "></div>
			<div class="ui-widget-form-cell text_caption center"></div>
			<div class="ui-widget-form-cell left"> <?php get_view(array("mod_form_inbound","view_form_button"));?></div>
			
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption "> Home Phone</div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"> <?php echo form() -> input('CustomerHomePhoneNum','input_text superlong');?></div>
		</div>
	</div>
	
	
	
</form>	
</div>
</fieldset>