
<?php echo form()->legend(lang('Contact Detail'), "fa-user"); ?>
<div id="toolbars2" class="ui-widget-toolbars"></div>

<div class="contact_detail" style="margin-left:-8px;">
<?php echo form()->hidden('ControllerId_2nd',NULL,_get_post("ControllerId"));?>
<?php echo form()->hidden('CampaignId_2nd',NULL, $SecondDetail->get_value('CampaignId') );?>
<?php echo form()->hidden('TableDetail_2nd',NULL, $SecondDetail->get_value('TableDetail') );?>
<?php echo form()->hidden('ViewVerification_2nd',NULL, $SecondDetail->get_value('ViewVerification') );?>
<?php echo form()->hidden('ViewProductInfo_2nd',NULL, $SecondDetail->get_value('ViewProductInfo') );?>
<?php echo form()->hidden('ViewCdd_2nd',NULL, $SecondDetail->get_value('ViewCdd') );?>
<?php echo form()->hidden('callUiDisable_2nd',NULL, $SecondDetail->get_value('flag_abandon') );?>



	
	<!-- start : detail -->
	<div class="ui-widget-form-table-compact" style="width:99%;">
		<div class="ui-widget-form-row" style="vertical-align:top;">
			<div class="ui-widget-form-cell ui-widget-content-top">
				<?php $this->load->view('mod_contact_detail/second_product/view_contact_default_detail');?>
				<?php $this->load->view('mod_contact_detail/second_product/view_contact_history_detail');?>
			</div>
			<div class="ui-widget-form-cell" style="vertical-align:top;">
				<?php $this ->load ->view('mod_contact_detail/second_product/view_contact_phone_detail');?>
			</div>
		</div>
	</div>
	<!-- stop : detail -->
	
	<div id="WindowUserDialog" >
</div>