<?php 
$idcustomer    = $Callhistory["CustomerId"];

function getCallMons ( $status="" , $CustomerId =0 , $fetch = "" ) {
	if ( $CustomerId != 0 ) {
		$EUI =& get_instance();
		if ( $fetch == true ) {
			$sqlCallmon = "
				SELECT * 
				FROM t_gn_score_result a
				WHERE a.CustomerId='$CustomerId'
				AND a.Status_Callmon='$status'";
			$checkStatusCallmon = $EUI->db->query(
				$sqlCallmon
			);
			if ( $checkStatusCallmon == true AND $checkStatusCallmon->num_rows() > 0 ) {
				return $checkStatusCallmon->row();
			} else {
				return (object)array("0"=>"0");
			}
		} else {
			$sqlCallmon = "
				SELECT a.Status_Callmon 
				FROM t_gn_score_result a
				WHERE a.CustomerId='$CustomerId'
				AND a.Status_Callmon='$status'";
			$checkStatusCallmon = $EUI->db->query(
				$sqlCallmon
			);
			if ( $checkStatusCallmon == true AND $checkStatusCallmon->num_rows() > 0 ) {
				return 1;
			} else {
				return 0;
			}
		}
	} else {
		return 0;
	}
}


function _selected ( $value ="" , $valuedb = "" ) {
	if ( $value == $valuedb ) {
		return " selected='selected' ";
	} else {
		return "";
	}
}	

echo javascript(array( 
	array('_file' => base_spl_plugin() . '/extToolbars.js', 'eui_'=> version(), 'time'=>time()),
	array('_file' => base_ext_views()  . '/EUI.Contact.js', 'eui_'=> version(), 'time'=>time()),
	array('_file' => base_ext_helper() . '/EUI.Media.js',   'eui_'=> version(), 'time'=>time()),
	array('_file' => base_ext_helper() . '/EUI.Dialog.js',  'eui_'=> version(), 'time'=>time())
));?>
	
<?php $this ->load ->view('qty_approval_interest/view_quality_javascript');?>
<?php $this ->load ->view('qty_approval_interest/view_js_product');?>
<?php $this ->load ->view("qty_approval_interest/view_scoring_js"); ?>

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
			<span class="ui-icon ui-icon-document"></span><?php echo lang('Customer Info');?></a>
		</li>
		
		<li class="ui-tab-li-lasted"><a href="#tabs-panel-2" id="aChecklistB">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang('Quality Score 1 SPV');?></a>
		</li>

		<li class="ui-tab-li-lasted"><a href="#tabs-panel-3" id="aChecklistB">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang('Quality Score 2 SPV');?></a>
		</li>
		
		<?php if ( _get_session("HandlingType") != USER_SUPERVISOR ) :  ?>
		<li class="ui-tab-li-lasted"><a href="#tabs-panel-4" id="aChecklistB">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang('Quality Score 1 QA');?></a>
		</li>

		<li class="ui-tab-li-lasted"><a href="#tabs-panel-5" id="aChecklistB">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang('Quality Score 2 QA');?></a>
		</li>
		<?php endif; ?>

	</ul>
	
		<!-- this load by php file :: not javascript -->
		<div id="tabs-panel-1" style="background-color:#FFFFFF;">
			<?php $this->load->view('qty_approval_interest/view_customer_info');?>
		</div>
		
		<div id="tabs-panel-2" style="background-color:#FFFFFF;">
		<?php 
			$StatusCallmonSpv1 = getCallMons("SPV First Callmon" , $Customers->get_Value("CustomerId")); 
			$FetchCallmonSpv1 = getCallMons("SPV First Callmon" , $Customers->get_Value("CustomerId"), true ); 
			$forwho = array(
				"formfor" => "spv1" ,
				"statuscallmon" => "SPV First Callmon" , 
				"countcallmon"	=> $StatusCallmonSpv1 , 
				"fetchScore"	=> $FetchCallmonSpv1
			);

			$this->load->view('qty_approval_interest/view_form_scoring/view_quality_scoring_header'   ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_section1" ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_section2" ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_section3" ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_section4" ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_section5" ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_footer"   ,  $forwho);
		?>
		</div>


		<div id="tabs-panel-3" style="background-color:#FFFFFF;">
		<?php 
			$StatusCallmonSpv2 = getCallMons("SPV Second Callmon" , $Customers->get_Value("CustomerId")); 
			$FetchCallmonSpv2 = getCallMons("SPV Second Callmon" , $Customers->get_Value("CustomerId") , true); 

			$forwho = array(
				"formfor" => "spv2",
				"statuscallmon" => "SPV Second Callmon" , 
				"countcallmon"	=> $StatusCallmonSpv2, 
				"fetchScore"	=> $FetchCallmonSpv2
			);

			$this->load->view('qty_approval_interest/view_form_scoring/view_quality_scoring_header'   ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_section1" ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_section2" ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_section3" ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_section4" ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_section5" ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_footer"   ,  $forwho);
		?>
		</div>

		<?php if ( _get_session("HandlingType") != USER_SUPERVISOR ) : ?>


		<div id="tabs-panel-4" style="background-color:#FFFFFF;">
		<?php 
			$StatusCallmonQa1 = getCallMons("QA First Callmon" , $Customers->get_Value("CustomerId")); 
			$FetchCallmonQa1 = getCallMons("QA First Callmon" , $Customers->get_Value("CustomerId") , true ); 
			
			$forwho = array(
				"formfor" => "qa1" , 
				"statuscallmon" => "QA First Callmon", 
				"countcallmon"	=> $StatusCallmonQa1, 
				"fetchScore"	=> $FetchCallmonQa1
			);

			$this->load->view('qty_approval_interest/view_form_scoring/view_quality_scoring_header'   ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_section1" ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_section2" ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_section3" ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_section4" ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_section5" ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_footer"   ,  $forwho);
		?>
		</div>

		<div id="tabs-panel-5" style="background-color:#FFFFFF;">
		<?php 
			$StatusCallmonQa2 = getCallMons("QA Second Callmon" , $Customers->get_Value("CustomerId")); 
			$FetchCallmonQa2 = getCallMons("QA Second Callmon" , $Customers->get_Value("CustomerId") , true ); 
			
			$forwho = array(
				"formfor" => "qa2", 
				"statuscallmon" => "QA Second Callmon", 
				"countcallmon"	=> $StatusCallmonQa2, 
				"fetchScore"	=> $FetchCallmonQa2
			);

			$this->load->view('qty_approval_interest/view_form_scoring/view_quality_scoring_header'   ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_section1" ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_section2" ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_section3" ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_section4" ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_section5" ,  $forwho);
			$this->load->view("qty_approval_interest/view_form_scoring/view_quality_scoring_footer"   ,  $forwho);
		?>
		</div>
		<?php endif; ?>


</div>
</fieldset>

	<?php $this ->load ->view('qty_approval_interest/view_quality_history_detail');?>
			

			</div>
		</div>
	</div>
	
</fieldset>	
<div id="change_request_dialog" > </div>