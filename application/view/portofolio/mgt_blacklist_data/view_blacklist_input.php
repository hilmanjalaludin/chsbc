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
Ext.DOM.Save = function()
{
	var _count = 0;
	$('.wajib').each(function(i, obj) {
		if(obj.value!=''){
			Ext.Css(obj.id).style({'border-color':'#CCCDDD'});
		}
		else{
			Ext.Css(obj.id).style({'border-color':'red','border-width': '1px'});
			_count++;
		}
	});
	
	if(_count>0){
		alert('Input not completed!');
		return false;
	}
	else{
		Ext.Progress( "ui-widget-image-loading", {
			height  : '17px',  
			title   : 'Please Wait...'
		}).start();
		
		Ext.Ajax({
			url 	: Ext.DOM.INDEX+'/MgtBlacklist/SaveInput/',
			method  : 'POST',
			param   : Ext.Join(new Array( 
				Ext.Serialize('frmInput').getElement()
			)).object(),
			ERROR : function( fn ) {
				Ext.Util(fn).proc(function(save){
					if( save.success ) {
						Ext.Progress("ui-widget-image-loading").stop();
						if(confirm('Save success!\nDo you want to input other blacklist?')){
							Ext.ShowMenu(new Array('MgtBlacklist','ManualInput'), 
								"Input Blacklist", {
									time : Ext.Date().getDuration()
							});
						}
						else{
							Ext.ShowMenu("MgtBlacklist", Ext.System.view_file_name());
						}
					}
					else{
						alert('Save Failed!');
						Ext.Progress("ui-widget-image-loading").stop();
						return false;
					}
				});
			} 
		}).post();
	}
}
</script>
<div id="ui-widget-uplaod-bucket" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-upload-content">
			<span class="ui-icon ui-icon-disk"></span><?php echo lang("Input Blacklist");?> </a>
		</li>
	</ul>	
	
	<div id="ui-widget-upload-content">
		<fieldset class="corner ui-widget-fieldset" style="margin:5px; border-radius:5px;">
		<?php echo form()->legend(lang("Input Manual"),"fa-edit");?>
			<form name="frmInput">
				<div class="ui-widget-form-table-compact">
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption"><?php echo lang(array('ID Number'));?></div>
						<div class="ui-widget-form-cell text_caption center">:</div>
						<div class="ui-widget-form-cell "><?php echo form() -> input('id_number','wajib input_text long'); ?></div>
					</div>
					
					<div class="ui-widget-form-row">
						<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Customer Name'));?></div>
						<div class="ui-widget-form-cell text_caption center">:</div>
						<div class="ui-widget-form-cell "><?php echo form() -> input('cust_name','wajib input_text long'); ?></div>
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
							<input type="button" class="save button" onclick="Ext.DOM.Save();" value="Save">
						</div>
					</div>
				</div>
			</form>
		</fieldset>
	</div>
</div>
