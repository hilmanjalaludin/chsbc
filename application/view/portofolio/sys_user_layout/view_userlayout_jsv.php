<script>
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
Ext.DOM.RoleBack = function()
{
	if( Ext.Msg('Are you sure ?').Confirm() ){
		new Ext.ShowMenu("SysUserLayout", Ext.System.view_file_name());	
		
	}
}


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */

Ext.DOM.SaveLayout=function(){

var frmAddLayout = Ext.Serialize('frmAddLayout');
if( !frmAddLayout.Complete() ){
	Ext.Msg('Form input not complete!').Info();
	return false;
}
	Ext.Ajax
	({
		url 	: Ext.EventUrl(['SysUserLayout','SaveLayout']).Apply(), 
		method  : 'POST',
		param  : {
			UserThemes : Ext.Cmp('UserThemes').getValue(),
			UserLayout : Ext.Cmp('UserLayout').getValue(),
			UserGroup  : Ext.Cmp('UserGroup').getValue()
		},
		ERROR : function(fn) {
			Ext.Util(fn).proc(function( responseText){
				if( responseText.success == 1 ){
					Ext.Msg("Save Layout").Success();
				} else {
					Ext.Msg("Save Layout").Failed();
				}
			});
		}
	}).post();
} 


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 

 Ext.DOM.UpdateLayout = function()
{
	 Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/SysUserLayout/UpdateLayout/',
		method 	: 'POST',
		param 	: {
			LayoutId   : Ext.Cmp('LayoutId').getValue(),
			UserThemes : Ext.Cmp('UserThemes').getValue(),
			UserLayout : Ext.Cmp('UserLayout').getValue(),
			UserGroup  : Ext.Cmp('UserGroup').getValue()
		},
		ERROR : function(fn){
			var ERR = JSON.parse(fn.target.responseText);
			if(ERR.success){
				Ext.Msg("Update Layout").Success();
			}
			else{
				Ext.Msg("Update Layout").Failed();
			}
		}
	}).post();
}


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
$(document).ready( function()
{
  $('#ui-widget-add-campaign').mytab().tabs();
  $('#ui-widget-add-campaign').mytab().tabs("option", "selected", 0);
  $('#ui-widget-add-campaign').css({'background-color':'#FFFFFF'});
  $('#ui-widget-add-content').css({'background-color':'#FFFFFF'});
  $("#ui-widget-add-campaign").mytab().close(function(){
	  Ext.DOM.RoleBack();
  });
  
 //-------- disabled by select class --------------------
  $('.cell-disabled').each(function(){
	  $(this).attr('disabled','true');
  });
  $('.select').chosen();
});
</script>