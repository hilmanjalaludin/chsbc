<?php
/* @ def 	 : view upload manual
 * 
 * @ param	 : sesion  
 * @ package : bucket data 
 */
 
?>
<script>
Ext.DOM.RoleBack = function(){
	if( Ext.Msg('Are you sure ?').Confirm() ){
		Ext.ShowMenu("MgtBlacklist", Ext.System.view_file_name());	
	}
}

$(document).ready( function()
{
	var date = new Date();
	$('#ui-widget-uplaod-bucket').mytab().tabs();
	$('#ui-widget-uplaod-bucket').mytab().tabs("option", "selected", 0);
	$('#ui-widget-uplaod-bucket').css({'background-color':'#FFFFFF'});
	$('#ui-widget-upload-content').css({'background-color':'#FFFFFF'});
	$("#ui-widget-uplaod-bucket").mytab().close(function(){ 
		Ext.DOM.RoleBack();
	});
  
	$('.xzselect').chosen();
});

/* -------------------------------------------------------------------------------- */
Ext.DOM.Upload = function()
{
	Ext.Progress( "ui-widget-image-loading", {
		height  : '17px',  
		title   : 'Please Wait...'
	}).start();
	
	Ext.Ajax 
	({
		url    : Ext.EventUrl(["MgtBlacklist", "StartUpload"]).Apply(),
		method : 'POST',
		file   : ['fileToupload'],
		param  : {
			time : Ext.Date().getDuration()
		},
		complete : function(e)
		{
			Ext.Util(e).proc(function( upload ){
				if(  typeof(upload) == 'object' ){
					Ext.Progress("ui-widget-image-loading").stop();
					var msg = "\nTotal xls row : "+ upload.tot_xls_vl_row +"\n"+
							  "Total xls success row :"+ upload.tot_xls_ok_row +"\n"+
							  "Total xls failed row :"+ upload.tot_xls_fl_row;
							  
					Ext.Msg(msg).Success();
				}
			});
		}		
	}).upload();
}
</script>
<div id="ui-widget-uplaod-bucket" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-upload-content">
			<span class="ui-icon ui-icon-disk"></span><?php echo lang("Upload Blacklist");?> </a>
		</li>
	</ul>	
	
	<div id="ui-widget-upload-content">
		<fieldset class="corner ui-widget-fieldset" style="margin:5px; border-radius:5px;">
		<?php echo form()->legend(lang("Upload"),"fa-upload");?>
			
		<div class="ui-widget-form-table-compact">
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Upload','File'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell "><?php echo form() -> upload('fileToupload'); ?></div>
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
