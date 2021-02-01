<div id="ui-widget-content-markup-tabs" class="ui-widget-content-frame">
	<ul>
		<li class="ui-tab-li-none"> <a href="#ui-widget-content-pertama">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Simulasi");?> </a>
		</li>
		
		<li class="ui-tab-li-lasted"><a href="#ui-widget-content-kedua">
			<span class="ui-icon ui-icon-person"></span><?php echo lang("Benefit");?> </a>
		</li>
		
	</ul>
	
	<div id="ui-widget-content-pertama" class="ui-widget-content-frame">
		<?php get_view(array("mod_view_simulasi","view_content_simulasi_pertama"));?>
	</div>
	
	<div id="ui-widget-content-kedua" class="ui-widget-content-frame">
		<?php get_view(array("mod_view_simulasi","view_content_simulasi_kedua"));?>
	</div>
</div>