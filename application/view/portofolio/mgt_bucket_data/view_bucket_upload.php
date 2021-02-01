<?php
/* @ def 	 : view upload manual
 * 
 * @ param	 : sesion  
 * @ package : bucket data 
 */
 
?>

<?php get_view(array("mgt_bucket_data","view_bucket_jsv")); ?>
<div id="ui-widget-uplaod-bucket" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-upload-content">
			<span class="ui-icon ui-icon-disk"></span><?php echo lang("Upload Bucket");?> </a>
		</li>
	</ul>	
	
	<div id="ui-widget-upload-content">
		<fieldset class="corner ui-widget-fieldset" style="margin:5px; border-radius:5px;">
		<?php echo form()->legend(lang("Upload"),"fa-upload");?>
			
		<div class="ui-widget-form-table-compact">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Campaign'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell "><?php echo form() -> combo('upload_campaign', 'select superlong xzselect', Campaign()); ?></div>
			</div>
			<div class="ui-widget-form-row" style="display: none;">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Recsource'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell "><?php echo form() -> input('recsource','input_text superlong'); ?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Upload','File'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell "><?php echo form() -> upload('fileToupload',null,array("change"=>"Ext.DOM.test(this.value)")); ?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"></div>
				<div class="ui-widget-form-cell text_caption center"></div>
				<div class="ui-widget-form-cell" id="ui-widget-image-loading"></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"></div>
				<div class="ui-widget-form-cell text_caption center"></div>
				<div class="ui-widget-form-cell ">
					<input type="button" class="save button" onclick="Ext.DOM.Upload();" value="Upload">
				</div>
			</div>
			
		</div>
		</fieldset>
	</div>
</div>
