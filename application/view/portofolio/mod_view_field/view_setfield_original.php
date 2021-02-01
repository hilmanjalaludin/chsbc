<fieldset class="corner ui-widget-fieldset" style="margin:0px 2px 2px -10px; padding:9px 15px 8px 15px;">
			<?php echo form()->legend(lang("Original"),"fa-plus");?>
			<form name="frmFieldOriginal">
				<?php echo form()->hidden("Field_Id", null, $output->get_value('Field_Id'));?>
				<div class="ui-widget-form-table-maximum">
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption"><?php echo lang("Campaign Name");?> </div>
						<div class="ui-widget-form-cell text_caption center">:</div>
						<div class="ui-widget-form-cell"><?php echo form()->combo('CampaignId','select superlong cell-disabled', $CampaignId, $output->get_value('CampaignId'));?></div>
					</div>
					
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption"><?php echo lang("Header Name");?> </div>
						<div class="ui-widget-form-cell text_caption center">:</div>
						<div class="ui-widget-form-cell"><?php echo form()->input('Field_Header','input_text superlong cell-disabled', $output->get_value('Field_Header'));?></div>
					</div>	
						
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption"><?php echo lang("Columns Size");?> </div>
						<div class="ui-widget-form-cell text_caption center">:</div>
						<div class="ui-widget-form-cell"><?php echo form()->input('Field_Columns','input_text superlong cell-disabled', $output->get_value('Field_Columns'));?></div>
					</div>
						
					
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption"><?php echo lang("Status");?> </div>
						<div class="ui-widget-form-cell text_caption center">:</div>
						<div class="ui-widget-form-cell"><?php echo form()->combo('Field_Active','select superlong cell-disabled',$Status,$output->get_value('Field_Active'));?></div>
					</div>
						
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption"><?php echo lang("Field Size");?> </div>
						<div class="ui-widget-form-cell text_caption center">:</div>
						<div class="ui-widget-form-cell"><?php echo form()->combo('Field_size','select superlong cell-disabled',$view_field_size, $output->get_value('Field_Size'));?></div>
					</div>
				</div>
			</form>
		</fieldset>