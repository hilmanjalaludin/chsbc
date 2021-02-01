<fieldset class="corner ui-widget-fieldset" style="margin:-5px 2px 2px -5px; padding:8px 15px 8px 8px;">
<?php echo form()->legend(lang("Create Template"),"fa-pencil");?>
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row">
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Database Table </div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo('table_name','select superlong', $plist, 'xxx');?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Mode Input </div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell" ><?php echo form() -> combo('mode_input','select superlong',$ModeType,NULL,array("change"=>"getTableColumns(this);"));?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">File Type </div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell" ><?php echo form() -> combo('file_type','select superlong',$FileType,NULL,array('change'=>'Ext.DOM.Delimiter(this);'));?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Delimiter </div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell" ><?php echo form() -> input('delimiter_type','input_text superlong',NULL,null);?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Template Name </div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form() -> input('templ_name',' input_text superlong',NULL);?></div>
			</div>
						
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Compare Blacklist</div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell" ><?php echo form() -> combo('black_list',' select superlong',$BlackList, 'Y');?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">X-Days</div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell" ><?php echo form() -> combo('expired_days',' select superlong',$LimitDays, 90);?></div>
			</div>
						
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption">Bucket Data</div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell" ><?php echo form() -> combo('bucket_data',' select superlong',$BlackList, 'N');?></div>
			</div>
						
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"></div>
				<div class="ui-widget-form-cell text_caption center"></div>
				<div class="ui-widget-form-cell">
					<input type="button" class="save button" onclick="Ext.DOM.SaveTemplate();" value="Save">
				</div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"></div>
				<div class="ui-widget-form-cell text_caption center"></div>
				<div class="ui-widget-form-cell"></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"></div>
				<div class="ui-widget-form-cell text_caption center"></div>
				<div class="ui-widget-form-cell" style="color:#3D5D9E;line-height:20px;font-style:italic;font-family:Consolas;font-size:11px;">
					<?php echo lang("Silahkan pilih ");?>,<?php echo lang('Database Table');?>,  
					<?php echo lang('Mode Input');?><?php echo lang("dan");?> <br><?php echo lang('File Type');?>
					<?php echo lang('Untuk Manampilakan Layout Upload <br>database '); ?> .
				</div>
			</div>
		</div>
	</div>	
 </fieldset>
 