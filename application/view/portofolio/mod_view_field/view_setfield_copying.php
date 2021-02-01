<fieldset class="corner ui-widget-fieldset" style="margin:0px 8px 2px 10px; padding:9px 15px 8px 15px;">
			<?php echo form()->legend(lang("Copy"),"fa-files-o");?>
			<form name="frmFieldCopying">
				<div class="ui-widget-form-table-maximum">
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption"><?php echo lang("Campaign Name");?> </div>
						<div class="ui-widget-form-cell text_caption center">:</div>
						<div class="ui-widget-form-cell"><?php echo form()->combo('CopyCampaignId','select superlong', $CampaignId);?></div>
					</div>
					
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption"><?php echo lang("Header Name");?> </div>
						<div class="ui-widget-form-cell text_caption center">:</div>
						<div class="ui-widget-form-cell"><?php echo form()->input('CopyField_Header','input_text superlong');?></div>
					</div>	
						
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption"><?php echo lang("Columns Size");?> </div>
						<div class="ui-widget-form-cell text_caption center">:</div>
						<div class="ui-widget-form-cell"><?php echo form()->input('CopyField_Columns','input_text superlong', $output->get_value('Field_Columns'));?></div>
					</div>
						
					
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption"><?php echo lang("Status");?> </div>
						<div class="ui-widget-form-cell text_caption center">:</div>
						<div class="ui-widget-form-cell"><?php echo form()->combo('CopyField_Active','select superlong',$Status,$output->get_value('Field_Active'));?></div>
					</div>
						
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption"><?php echo lang("Field Size");?> </div>
						<div class="ui-widget-form-cell text_caption center">:</div>
						<div class="ui-widget-form-cell"><?php echo form()->combo('CopyField_size','select superlong',$view_field_size,$output->get_value('Field_Size'));?></div>
					</div>
					
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption"></div>
						<div class="ui-widget-form-cell text_caption center"></div>
						<div class="ui-widget-form-cell"><?php echo form()->button("btnSave", "button save", lang("Submit"), array("click" => "Ext.DOM.CopyField();"));?></div>
					</div>
				</div>
			</form>
		</fieldset>	