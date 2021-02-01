
<?php get_view(array("mgt_assignment","view_assignment_jsv"));?>
<div id="ui-widget-user-assigment" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-none">
			<a href="#ui-widget-asg-distribute">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Distribute Data");?> </a>
		</li>
		
		<li class="ui-tab-li-none">
			<a href="#ui-widget-asg-transfer">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Transfer Data");?> </a>
		</li>
		
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-asg-pooling">
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Pull The Data");?> </a>
		</li>
		<!-- Belum tahu apa ya ? 
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-cmp-distribute">
			<span class="ui-icon ui-icon-pencil"></span>< ?php echo lang("Campaign Transfer");?> </a>
		</li>-->
	</ul>

	<!-- start content data ------>
	<div id="ui-widget-asg-distribute"><?php get_view(array("mgt_assignment","view_assigment_distribute"));?></div>	
	<div id="ui-widget-asg-transfer"><?php get_view(array("mgt_assignment","view_assigment_transfer"));?></div>
	<div id="ui-widget-asg-pooling"><?php get_view(array("mgt_assignment","view_assigment_pull"));?></div>
	
	<!--<div id="ui-widget-cmp-distribute">< ?php get_view(array("mgt_assignment","view_assigment_inject"));?></div>-->
	
</div>
	