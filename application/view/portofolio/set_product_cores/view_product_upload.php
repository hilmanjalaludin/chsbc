<fieldset class="corner">
<?php echo form()->legend(lang("Upload"), "fa-upload"); ?>

<div id="ui-widget-upload-panel" class="ui-widget-form-table-compact">
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Upload File'));?></div>
		<div class="ui-widget-form-cell text_caption center">:</div>
		<div class="ui-widget-form-cell"><?php echo form()->upload("UploadProduct");?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption"></div>
		<div class="ui-widget-form-cell text_caption center"></div>
		<div class="ui-widget-form-cell"><?php echo form()->button("BtnUpload", "button upload", lang("Upload"), array("click" => "Ext.DOM.UploadProduct();"));?></div>
	</div>
	
	<div class="ui-widget-form-row">
		<div class="ui-widget-form-cell text_caption"></div>
		<div class="ui-widget-form-cell text_caption center"></div>
		<div class="ui-widget-form-cell" style="color:#3D5D9E;line-height:20px;font-style:italic;font-family:Consolas;font-size:11px;">
			<?php echo lang("*)");?>
			<?php echo lang("Format upload data yang diperkenankan adalah<br>data file dengan extension (.txt), <br>Dengan Pemisah (tab) ");?>
		</div>		
	</div>
</div>

</fieldset>