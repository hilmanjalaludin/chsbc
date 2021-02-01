<?php get_view(array("set_product_cores", "view_product_jsv"));?>
<div id="ui-widget-product" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-none">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-plus"></span><?php echo lang("Add Product");?> </a>
		</li>
		
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-upload-content">
			<span class="ui-icon ui-icon-plus"></span><?php echo lang("Upload Product");?> </a>
		</li>
	</ul>		
	
	<!-- on nav product -->	
		<div id="ui-widget-add-content">
			<?php get_view(array("set_product_cores","view_product_nav"));?>
		</div>
		
	<!-- on nav customize  -->	
		<div id="ui-widget-upload-content">
			<?php get_view(array("set_product_cores","view_product_upload"));?>
		</div>
	
</div>
	