<?php get_view(array("rpt_data_tracking","report_data_track_jsv"));?>

<div id="ui-report-tab-panel" class="ui-widget-panel-class-tabs">
	<ul>
		<li class="ui-tab-li-lasted"> <a href="#ui-widget-report-navigation"> 
			<span class="ui-icon ui-icon-pencil"></span><?php echo "<span id='ui-widget-tabs-title'></span>"; ?> </a>
		</li>
	</ul>
	
	<div id="ui-widget-report-navigation" class="ui-widget-panel-class-tabs"> 
		<?php get_view(array('rpt_data_tracking','report_data_tracking_group'));?>
	</div>
	
</div>
