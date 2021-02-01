<?php get_view(array("mod_view_field","view_setfield_jsv")); ?>
<div id="ui-widget-template-tabs" class="tabs corner ">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-template-content">
			<span class="ui-icon ui-icon-plus"></span><?php echo lang("Add Field Campaign");?> </a>
		</li>
	</ul>	
	
	<div id="ui-widget-template-content" style="width:98.4%;">
		<div class="ui-widget-form-table-compact" style="width:99%;">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell ui-widget-content-top" id="ui-field-options" style="width:35%"><?php get_view(array("mod_view_field","view_setfield_layout"));?></div>
				<div class="ui-widget-form-cell ui-widget-content-top" id="ui-field-generator" style="width:75%"></div>
			</div>
		</div>
	</div>
</div>	
	
	