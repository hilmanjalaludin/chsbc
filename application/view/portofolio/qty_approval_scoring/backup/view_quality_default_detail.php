<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<fieldset class="corner" style="margin-top:-3px;"> 
<legend class="icon-menulist"> &nbsp;&nbsp;Application Information</legend> 
<div id="tabs-panels" class="box-shadow" style='border:0px solid #dddddd;'>
	<ul>
			<li><a href="#tabs-4" id="aPolicy">Application</a></li>
			<li><a href="#tabs-5" id="aPayer">Policy Holder</a></li>
			<li><a href="#tabs-6" id="aInsured">Insured</a></li>
			<li><a href="#tabs-7" id="aBenefiecery">Detail</a></li>
			<li><a href="#tabs-8" id="aChecklistA">Checklist A</a></li>
			<li><a href="#tabs-9" id="aChecklistB">Checklist B </a></li>
	</ul>
	
	<!-- this load by php file :: not javascript -->
		<div id="tabs-4" style="background-color:#FFFFFF;overflow:auto;">
			<?php $this->load->view('qty_approval_scoring/view_quality_policy');?>
		</div>
		<div id="tabs-5" style="background-color:#FFFFFF;overflow:auto;">
			<?php $this->load->view('qty_approval_scoring/view_quality_payers');?>
		</div>
		<div id="tabs-6" style="background-color:#FFFFFF;overflow:auto;">
			<?php $this->load->view('qty_approval_scoring/view_quality_insured');?>	
		</div>
		<div id="tabs-7" style="background-color:#FFFFFF;overflow:auto;">
			
		</div>
		
		<div id="tabs-8" style="background-color:#FFFFFF;overflow:auto;">
			<?php $this->load->view('qty_approval_scoring/view_quality_form');?>
		</div>
		
		<div id="tabs-9" style="background-color:#FFFFFF;overflow:auto;">
			<?php $this->load->view('qty_approval_scoring/view_quality_scoring');?>
		</div>
</div>
</fieldset>
