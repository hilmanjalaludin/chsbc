<?php 
$idcustomer    = $Callhistory["CustomerId"];
echo javascript(array( 
	array('_file' => base_spl_plugin() . '/extToolbars.js', 'eui_'=> version(), 'time'=>time()),
	array('_file' => base_ext_views()  . '/EUI.Contact.js', 'eui_'=> version(), 'time'=>time()),
	array('_file' => base_ext_helper() . '/EUI.Media.js',   'eui_'=> version(), 'time'=>time()),
	array('_file' => base_ext_helper() . '/EUI.Dialog.js',  'eui_'=> version(), 'time'=>time())
));?>
	
<?php $this ->load ->view('qty_approval_interest/view_quality_javascript');?>

<!-- detail content -->
<fieldset class="corner" style="border-radius:5px;"> 
<?php echo form()->legend(lang('Quality Aprove Detail'), "fa-user"); ?>
<div id="toolbars" class="ui-widget-toolbars"></div>

<!-- START :: hidden -->

<?php echo form()->hidden("ControllerId",null, _get_post("ControllerId")); ?>
<?php echo form()->hidden("CampaignId",null,$Customers->get_value('CampaignId')); ?>
<?php echo form()->hidden("CustomerId",null, $Customers->get_value('CustomerId')); ?>
<?php echo form()->hidden("CustomerNumber",null, $Customers->get_value('CustomerNumber')); ?>

<!-- END :: hidden -->
<div class="contact_detail" style="margin-left:-8px;">
	<div class="ui-widget-form-table-compact" style="width:99%;">
		<div class="ui-widget-form-row" style="vertical-align:top;">
			<div class="ui-widget-form-cell" style="width:71%; vertical-align:top;">
				


<fieldset class="corner" style="margin-top:-3px;border-radius:5px;padding:5px 10px 10px 10px;">
<?php echo form()->legend(lang(array('Application Information')), "fa-info"); ?>

<div id="tabs-panels" style='border:1px solid #dddddd;'>

	<ul>
		<li class="ui-tab-li-none"><a href="#tabs-panel-1" id="aPolicy">
			<span class="ui-icon ui-icon-document"></span><?php echo lang('Application');?></a></li>
		
		<li class="ui-tab-li-none"><a href="#tabs-panel-2" id="aPayer">
			<span class="ui-icon ui-icon-person"></span><?php echo lang('Policy Holder');?></a></li>
		
		<li class="ui-tab-li-none"><a href="#tabs-panel-3" id="aInsured">
			<span class="ui-icon ui-icon-person"></span><?php echo lang('Insured');?></a></li>
			
		<li class="ui-tab-li-none"><a href="#tabs-panel-4" id="aBeneficiary">
			<span class="ui-icon ui-icon-person"></span><?php echo lang('Beneficiary');?></a></li>
			
		<li class="ui-tab-li-none"><a href="#tabs-panel-5" id="aDetailInsured">
			<span class="ui-icon ui-icon-document"></span><?php echo lang('Detail');?></a></li>
			
		<li class="ui-tab-li-lasted"><a href="#tabs-panel-6" id="aChecklistB">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang('Quality Score');?></a></li>
	</ul>
	
	<!-- this load by php file :: not javascript -->
		<div id="tabs-panel-1" style="background-color:#FFFFFF;">
			<?php $this->load->view('qty_approval_interest/view_quality_policy');?>
		</div>
		
		<div id="tabs-panel-2" style="background-color:#FFFFFF;">
			<?php $this->load->view('qty_approval_interest/view_quality_payers');?>
		</div>
		
		<div id="tabs-panel-3" style="background-color:#FFFFFF;">
			<?php $this->load->view('qty_approval_interest/view_quality_insured');?>	
		</div>
		
		<div id="tabs-panel-4" style="background-color:#FFFFFF;">
			<?php $this->load->view('qty_approval_interest/view_quality_benefiecery');?>	
		</div>
		
		<div id="tabs-panel-5" style="background-color:#FFFFFF;">
			<?php $this->load->view('qty_approval_interest/view_quality_insdetail');?>
		</div>
		
		<div id="tabs-panel-6" style="background-color:#FFFFFF;">
		<?php 
			if ( $scoring->countCustomer($idcustomer) > 0 ) {
				$this->load->view('qty_approval_interest/view_edit_quality_scoring');
			} else {
				$this->load->view('qty_approval_interest/view_quality_scoring');
			}
		?>
		</div>
</div>
</fieldset>
			<?php $this ->load ->view('qty_approval_interest/view_quality_history_detail');?>
			</div>
			<div class="ui-widget-form-cell" style="width:29%;vertical-align:top;">
				<?php $this ->load ->view('qty_approval_interest/view_quality_phone_detail');?>
			</div>
		</div>
	</div>
	
</fieldset>	
<div id="change_request_dialog" > </div>