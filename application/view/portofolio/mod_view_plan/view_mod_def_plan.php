 <fieldset class="corner" style="padding:10px 5px 8px 5px;border-radius:5px;">
	<?php echo form()->legend(lang(array("Plan")),"fa-edit");?>
	<form name="frmUpdateLabel">
			<div class="ui-widget-form-table-compact table-body-content">
				<div class="ui-widget-form-row ui-widget-header table-row-header">
					<div class="ui-widget-form-cell text_caption"> From Label </div>
					<div class="ui-widget-form-cell text_caption">&nbsp;</div>
					<?php foreach( call_product_plan() as $sf => $Label ) : ?>	
						<div class="ui-widget-form-cell"> <?php echo $Label; ?> </div>	
					<?php endforeach; ?>
				</div>	
				
				<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"> To Label </div>
				<div class="ui-widget-form-cell text_caption">&nbsp;</div>
					<?php foreach( call_product_plan() as $sf => $input ) : ?>	
						<div class="ui-widget-form-cell"> <?php echo form()->input("label_{$sf}", "input_text long", $input, null,array('style' => 'width:99%;') );?> </div>
					<?php endforeach; ?>
				</div>	
				
				<div class="ui-widget-form-row">
					<div class="ui-widget-form-cell text_caption">&nbsp;</div>
					<div class="ui-widget-form-cell text_caption">&nbsp;</div>
					<div class="ui-widget-form-cell text_caption left"><?php echo form()->button("btnlabel", "button update", lang(array("Update","Label")), array("click" => "Ext.DOM.UpdateLabel();") );?></div>
				</div>
			</div>
	</form>
</fieldset>