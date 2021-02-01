<?php
echo javascript(array( 
	array('_file' => base_spl_plugin().'/extToolbars.js', 'eui_'=> version(), 'time'=>time()),
	array('_file' => base_ext_views() .'/EUI.Contact.js', 'eui_'=> version(), 'time'=>time())
	));
	
	if(isset($SecondDetail) OR !empty($SecondDetail)){
		$SecondProduct = TRUE;
	}else{
		$SecondProduct = FALSE;
	}
?>
<?php $this ->load ->view('mod_auto_dialss/view_contact_javascript');?>

<!-- detail content -->
<fieldset id="first_product" class="corner" style="border-radius:5px;"> 
<?php echo form()->legend(lang('Contact Detail'), "fa-user"); ?>
<div id="toolbars" class="ui-widget-toolbars"></div>

<div class="contact_detail" style="margin-left:-8px;">
<?php echo form()->hidden('ControllerId',NULL,_get_post("ControllerId"));?>
<?php echo form()->hidden('ver_status_flexi',NULL, 0);?>

<?php echo form()->hidden('dialAutomatic',NULL,_get_post("PhoneNum"));?>
<?php echo form()->hidden('AutoKey',NULL,_get_post("AutoKey"));?>
<?php echo form()->hidden('bolAddress',NULL, 0);?>

<?php echo form()->hidden('SecondProduct',NULL,$SecondProduct);?>
<?php echo form()->hidden('CampaignId',NULL, $Detail->get_value('CampaignId') );?>
<?php echo form()->hidden('TableDetail',NULL, $Detail->get_value('TableDetail') );?>
<?php echo form()->hidden('ViewVerification',NULL, $Detail->get_value('ViewVerification') );?>
<?php echo form()->hidden('ViewProductInfo',NULL, $Detail->get_value('ViewProductInfo') );?>
<?php echo form()->hidden('ViewCdd',NULL, $Detail->get_value('ViewCdd') );?>
<?php echo form()->hidden('callUiDisable',NULL, $Detail->get_value('flag_abandon') );?>
<?php echo form()->hidden('FlagType',NULL, $Detail->get_value('flag_type') );?>

	<!-- start : detail -->
	<div class="ui-widget-form-table-compact" style="width:99%;">
		<div class="ui-widget-form-row" style="vertical-align:top;">
			<div class="ui-widget-form-cell ui-widget-content-top">
				<?php $this->load->view('mod_auto_dialss/view_contact_default_detail');?>
				<?php $this->load->view('mod_auto_dialss/view_contact_history_detail');?>
				
			</div>
			<div class="ui-widget-form-cell" style="vertical-align:top;">
				<?php $this ->load ->view('mod_auto_dialss/view_contact_phone_detail');?>
			</div>
		</div>
	</div>
	<!-- stop : detail -->
	
	<div id="WindowUserDialog" >
</div>
</fieldset>

<?php if($Detail->get_value('CampaignId')==5){ ?>
<fieldset id="second_product" class="corner" style="border-radius:5px;">
	<?php $this->load->view('mod_auto_dialss/view_contact_second_product');?>
</fieldset>
<?php } ?>
