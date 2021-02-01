<div class="panel-product-preview-only" style="width:99%;">

<div class="ui-widget-form-table-compact">
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption left"><?php echo lang('Product Name');?></div>
		<div class="ui-widget-form-cell center">:</div>
		<div class="ui-widget-form-cell"> <?php echo form()->combo('ProductSimulate','select superlong select-chosen', CustomerProductId($Detail->get_value('CustomerId')), null, array('change' => 'Ext.DOM.ProdPreview(this.value);'));?> </div>
	</div>
</div>

<div class="ui-widget-form-table-compact" style="width:99%;">
	<div class="ui-widget-form-table-row" style="width:99%;" id="product_list_preview"></div>
</div>	

</div>