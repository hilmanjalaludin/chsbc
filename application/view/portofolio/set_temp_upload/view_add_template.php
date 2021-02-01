<?php get_view(array("set_temp_upload","view_template_jsv")); ?>
<div id="ui-widget-template-tabs" class="tabs corner ">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-template-content">
			<span class="ui-icon ui-icon-plus"></span><?php echo lang("Add Template");?> </a>
		</li>
	</ul>	
	
	<div id="ui-widget-template-content">
		<form name="frmCreateTemplate">
			<div class="ui-widget-form-table-compact ui-widget-form-table-maximum">
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell" style="vertical-align:top;width:30%;"> <?php get_view(array("set_temp_upload","view_template_option")); ?></div>
					<div class="ui-widget-form-cell" style="vertical-align:top;width:1%;"></div>
					<div class="ui-widget-form-cell" style="vertical-align:top;width:70%;" id="list_columns"></div>
				</div>
			</div>	
		</form>	
	</div>
	
</div>	
	
	
