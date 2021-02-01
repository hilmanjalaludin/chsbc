<?php $this->load->view("mod_view_plan/view_mod_plan_jsv"); ?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-none">
			<a href="#ui-widget-add-content1">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Definition");?> </a>
		</li>
		
		<li class="ui-tab-li-none">
			<a href="#ui-widget-add-content2">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Plan");?> </a>
		</li>
		
		
		<!--
		<li class="ui-tab-li-none">
			<a href="#ui-widget-add-content3">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Benefit");?> </a>
		</li>-->
		
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content4">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang(array("Plan","&", "Premi"));?> </a>
		</li>
		
	</ul>	
	
<!-- content ---------->
	<?php echo form()->hidden("ProductId",null, call_product_id() );?>
	
	<div id="ui-widget-add-content1" class="ui-widget-add-content ui-frame-with">
		<?php $this->load->view("mod_view_plan/view_mod_def_product");?>
	</div>
	
	<div id="ui-widget-add-content2" class="ui-widget-add-content ui-frame-with">
		<?php $this->load->view("mod_view_plan/view_mod_def_plan");?>
	</div>
	<!--
	<div id="ui-widget-add-content3" class="ui-widget-add-content ui-frame-with">
		<#?php $this->load->view("mod_view_plan/view_mod_def_benefit");?>
	</div>
	-->
	<div id="ui-widget-add-content4" class="ui-widget-add-content ui-frame-with">
		<?php $this->load->view("mod_view_plan/view_mod_def_option");?>
	</div>
	
</div>