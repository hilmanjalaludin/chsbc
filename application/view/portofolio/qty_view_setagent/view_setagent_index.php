<?php get_view(array("qty_view_setagent","view_setagent_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-person"></span><?php echo lang("<span id='ui-title-tabs'></span>");?></a>
		</li>
	</ul>	
	
	<div id="ui-widget-add-content" class="ui-widget-table-form-maximum"> 
		<div class="ui-widget-table-form-maximum" >
			<div class="ui-widget-table-form-row">
				<div class="ui-widget-form-cell ui-widget-content-top" style="width:50%;"><?php get_view(array("qty_view_setagent", "view_setagent_avail")); ?></div>
				<div class="ui-widget-form-cell ui-widget-content-top" style="width:50%;"><?php get_view(array("qty_view_setagent", "view_setagent_quality")); ?></div>
			</div>
		</div>
		
	</div>
	
</div>	
	