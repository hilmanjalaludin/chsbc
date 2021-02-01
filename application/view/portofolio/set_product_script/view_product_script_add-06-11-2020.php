<!-- start : layout add campaign -->
<?php get_view(array("set_product_script","view_product_script_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-plus"></span><?php echo lang("Add Product Script");?> </a>
		</li>
	</ul>	
	
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
		<fieldset class="corner ui-widget-fieldset" style="margin:5px; padding:10px 10px 10px 10px ; border-radius:5px;">
		<?php echo form()->legend(lang(array("Add")),"fa-plus");?>
		
		<form name="FrmUploadScript">
		
		<div class="ui-widget-form-table-compact" >
			<div class="ui-widget-form-row" >
				<div class="ui-widget-form-cell text_caption" ><?php echo lang("Product Name");?> </div>
				<div class="ui-widget-form-cell text_caption" >:</div>
				<div class="ui-widget-form-cell" ><?php echo form()->combo("ProductName","select superlong", Campaign() );?></div>
			</div>
			
			<div class="ui-widget-form-row" >
				<div class="ui-widget-form-cell text_caption" ><?php echo lang("File Name");?></div>
				<div class="ui-widget-form-cell text_caption" >:</div>
				<div class="ui-widget-form-cell" ><?php echo form()->upload('ScriptFileName');?></div>
			</div>
			
			<div class="ui-widget-form-row" >
				<div class="ui-widget-form-cell text_caption"><?php echo lang("Title");?> </div>
				<div class="ui-widget-form-cell text_caption center" >:</div>
				<div class="ui-widget-form-cell"><?php echo form()->input("Description","input_text superlong");?></div>
			</div>
			
			<div class="ui-widget-form-row" >
				<div class="ui-widget-form-cell text_caption" ><?php echo lang("Status");?>  </div>
				<div class="ui-widget-form-cell text_caption" >:</div>
				<div class="ui-widget-form-cell" ><?php echo form()->combo("ScriptFlagStatus","select superlong",Flags(),1);?></div>
			</div>
			
			<div class="ui-widget-form-row" >
				<div class="ui-widget-form-cell" >&nbsp;</div>
				<div class="ui-widget-form-cell" ></div>
				<div class="ui-widget-form-cell" ><?php echo form()->button("ButnUpload","button upload",lang(array('Upload')),array("click" =>"Ext.DOM.UploadScript();" ));?></div>
			</div>
		</div>
		</form>
		
	</div>
	
</div>
<!--
<fieldset class="corner" style="margin:8px;">
	<legend class="pdf">&nbsp;&nbsp; Add Product Script</legend>	
	<div class="content-panel box-shadow">
		
	</div>
</fieldset>-->
