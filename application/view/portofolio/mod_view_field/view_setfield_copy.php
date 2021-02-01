<?php get_view(array("mod_view_field","view_setfield_jsv")); ?>
<div id="ui-widget-template-tabs" class="tabs corner ">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-template-content">
			<span class="ui-icon ui-icon-plus"></span><?php echo lang("Copy Field Campaign");?> </a>
		</li>
	</ul>	
	
	<div id="ui-widget-template-content" style="width:98.4%;">
		<div class="ui-widget-form-table-compact" style="width:99%;">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell ui-widget-content-top" style="width:50%"><?php get_view(array("mod_view_field","view_setfield_original"));?></div>
				<div class="ui-widget-form-cell ui-widget-content-top" style="width:50%"><?php get_view(array("mod_view_field","view_setfield_copying"));?></div>
			</div>
		</div>
	</div>
	
</div>	
	
	