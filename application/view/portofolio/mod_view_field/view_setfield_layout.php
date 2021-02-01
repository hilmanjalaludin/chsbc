<fieldset class="corner ui-widget-fieldset" style="margin:-10px 2px 2px -10px; padding:9px 15px 8px 15px;">
<?php echo form()->legend(lang("Add"),"fa-plus");?>
<form name="frmFieldOption">
	<div class="ui-widget-form-table-maximum">
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Campaign Name");?> </div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('CampaignId','select superlong', $CampaignId);?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Header Name");?> </div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input('Field_Header','input_text superlong');?></div>
		</div>	
			
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Columns Size");?> </div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input('Field_Columns','input_text superlong', 2);?></div>
		</div>
			
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Status");?> </div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('Field_Active','select superlong',$Status,1);?></div>
		</div>
			
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang("Field Size");?> </div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('Field_size','select superlong',$view_field_size, null,array('change'=>'Ext.DOM.ViewLayoutGenerate(this.value);'));?></div>
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"></div>
			<div class="ui-widget-form-cell text_caption center"></div>
			<div class="ui-widget-form-cell"><?php echo form()->button("btnSave", "button save", lang("Submit"), array("click" => "Ext.DOM.SaveGenerateField();"));?></div>
		</div>
	</div>
	</form>
</fieldset>
