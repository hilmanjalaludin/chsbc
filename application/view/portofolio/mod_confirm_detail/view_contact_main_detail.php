<?php 
echo javascript(array( 
	array('_file' => base_spl_plugin().'/extToolbars.js', 'eui_'=> version(), 'time'=>time()),
	array('_file' => base_ext_views() .'/EUI.Contact.js', 'eui_'=> version(), 'time'=>time())));?>
	
<?php $this ->load ->view('mod_confirm_detail/view_contact_javascript');?>
<!-- detail content -->
<fieldset class="corner" style="border-radius:5px;"> 
<?php echo form()->legend(lang('Contact Detail'), "fa-user"); ?>
<div id="toolbars" class="ui-widget-toolbars"></div>

<div class="contact_detail" style="margin-left:-8px;">
<?php echo form()->hidden('ControllerId',NULL,_get_post("ControllerId"));?>
<?php echo form()->hidden('CampaignId',NULL, $Detail->get_value('CampaignId') );?>
<?php echo form()->hidden('QualityStatus',NULL, $Detail->get_value('CallReasonQue') );?>
<?php echo form()->hidden('LastCallPhone',NULL, $Attrs->get_value('CallNumber', 'intval'));?>


<!-- start : detail -->
	<div class="ui-widget-form-table-compact" style="width:99%;">
		<div class="ui-widget-form-row" style="vertical-align:top;">
			<div class="ui-widget-form-cell">
				<?php $this->load->view('mod_confirm_detail/view_contact_default_detail');?>
				<?php $this->load->view('mod_confirm_detail/view_contact_history_detail');?>
			</div>
			<div class="ui-widget-form-cell" style="vertical-align:top;">
				<?php $this ->load ->view('mod_confirm_detail/view_contact_phone_detail');?>
			</div>
		</div>
	</div>
	<!-- stop : detail -->
	
	<div id="WindowUserDialog" >
</div>
</fieldset>	
