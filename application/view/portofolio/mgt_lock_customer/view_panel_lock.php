
<?php get_view(array("mgt_lock_customer","view_lock_js"));?>
<div id="ui-widget-user-lock" class="tabs corner ui-frame-with">
	<ul>
		
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-lock-set">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Set Lock Customer");?></a>
		</li>
	</ul>
	<!-- start content data ------>
	<div id="ui-widget-lock-set"><?php get_view(array("mgt_lock_customer","panel_filter_lock"));?></div>	
</div>
	