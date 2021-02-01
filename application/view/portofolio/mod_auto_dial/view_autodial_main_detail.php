<?php 
//debug($Detail);
echo javascript(array( 
	array('_file' => base_spl_plugin().'/extToolbars.js', 'eui_'=> version(), 'time'=>time()),
	array('_file' => base_ext_views() .'/EUI.Contact.js', 'eui_'=> version(), 'time'=>time())));?>

<?php $this ->load ->view('mod_auto_dial/view_autodial_javascript');?>

<!-- detail content -->
<!--<fieldset class="corner" style="border-radius:5px;"> -->
	<?php //echo form()->legend(lang('Contact Detail'), "fa-user"); ?>
	<div id="toolbars" class="ui-widget-toolbars"></div>
	
	<div class="contact_detail" style="margin-left:-8px;">
		<?php echo form()->hidden('ControllerId',NULL,_get_post("ControllerId"));?>
		<?php echo form()->hidden('dialAutomatic',NULL,_get_post("PhoneNum"));?>
		<?php echo form()->hidden('AutoKey',NULL,_get_post("AutoKey"));?>
		<?php echo form()->hidden('bolAddress',NULL, 0);?>
		<?php echo form()->hidden('CampaignId',NULL, $Detail->get_value('CampaignId') );?>
		<?php echo form()->hidden('TableDetail',NULL, $Detail->get_value('TableDetail') );?>
		<?php echo form()->hidden('ViewVerification',NULL, $Detail->get_value('ViewVerification') );?>
		<?php echo form()->hidden('ViewProductInfo',NULL, $Detail->get_value('ViewProductInfo') );?>
		<?php echo form()->hidden('callUiDisable',NULL, $Detail->get_value('flag_abandon') );?>
		
		<div class="ui-widget-form-table-compact" style="width:99%;">
			<div class="ui-widget-form-row" style="vertical-align:top;">
				<div class="ui-widget-form-cell ui-widget-content-top ">
					<?php $this->load->view('mod_auto_dial/view_autodial_default_detail');?>
					<?php $this->load->view('mod_auto_dial/view_autodial_history_detail');?>
				</div>
				<div class="ui-widget-form-cell" style="vertical-align:top;">
					<?php $this ->load ->view('mod_auto_dial/view_autodial_phone_detail');?>
				</div>
			</div>
		</div>
		
		<div id="WindowUserDialog" ></div>
	</div>
<!--</fieldset>	-->