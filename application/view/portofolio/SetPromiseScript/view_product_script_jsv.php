<script>
// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : $.RoleBack
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */

 Ext.DOM.RoleBack = function()
{
	if( Ext.Msg('Are you sure ?').Confirm() ){
		Ext.ShowMenu("SetProductScript", Ext.System.view_file_name());	
	}
}

//---------------------------------------------------------------------------------------
/*
 * @ package 		Search function 
 */
 
 Ext.DOM.AddScript = function()
{
	Ext.ShowMenu(new Array("SetPromiseScript","AddScript"), 
		Ext.System.view_file_name(),{
			time : Ext.Date().getDuration()
	});
}

//---------------------------------------------------------------------------------------
/*
 * @ package 		Search function 
 */
 
 Ext.DOM.UploadScript = function()
{
	// alert('ok');
 var FrmUploadScript = Ext.Serialize('FrmUploadScript');
	if( !FrmUploadScript.Complete() ){
		Ext.Msg("form input not complete!").Info();
		return false;
	}
	
// --------- then set its -----------------------------
	
	Ext.Ajax
	({
		url    	 : Ext.EventUrl(['SetPromiseScript','Upload']).Apply(),
		method 	 : 'POST',
		file 	 : 'ScriptFileName',
		param    : {
			ProductName 	: Ext.Cmp('ProductName').getValue(),
			ScriptTitle 	: Ext.Cmp('Description').getValue(),
			Active 			: Ext.Cmp('ScriptFlagStatus').getValue()
		},
		complete : function(fn)
		{
			try  {
				Ext.Util( fn ).proc(function( upload ) {
					if( upload.success ) {
						Ext.Msg("Upload Script").Success();
						if( Ext.Msg("Do you want to add again?").Confirm() ){
							new Ext.DOM.AddScript();
						} 
					} else {
						Ext.Msg("Upload Script").Failed();
					}	
				});
			} catch(e){
				console.log(e);
			}
		}
	}).upload();
}

Ext.DOM.UploadScripttnc = function()
{

    
    var FrmUploadScript = Ext.Serialize('FrmUploadScripttnc');
	if( !FrmUploadScript.Complete() ){
		Ext.Msg("form input not complete!").Info();
		return false;
	}
// console.log(FrmUploadScript);
    // alert('ok');
    // return false;

	
// --------- then set its -----------------------------
	
	Ext.Ajax
	({
		url    	 : Ext.EventUrl(['SetPromiseScript','Uploadtnc']).Apply(),
		method 	 : 'POST',
		file 	 : 'ScriptFileNameTnc',
		param    : {
			ProductName 	: Ext.Cmp('ProductNameTnc').getValue(),
			ScriptTitle 	: Ext.Cmp('DescriptionTnc').getValue(),
			Active 			: Ext.Cmp('ScriptFlagStatusTnc').getValue()
		},
		complete : function(fn)
		{
			try  {
				Ext.Util( fn ).proc(function( upload ) {
					if( upload.success ) {
						Ext.Msg("Upload Script").Success();
						if( Ext.Msg("Do you want to add again?").Confirm() ){
							new Ext.DOM.AddScript();
						} 
					} else {
						Ext.Msg("Upload Script").Failed();
					}	
				});
			} catch(e){
				console.log(e);
			}
		}
	}).upload();
}
		
		
// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : $.ready
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
$(document).ready( function()
{
  var date = new Date();
  $('#ui-widget-add-campaign').mytab().tabs();
  $('#ui-widget-add-campaign').mytab().tabs("option", "selected", 0);
  $('#ui-widget-add-campaign').css({'background-color':'#FFFFFF'});
  $('#ui-widget-add-content').css({'background-color':'#FFFFFF'});
  
  $("#ui-widget-add-campaign").mytab().close(function(){
	  Ext.DOM.RoleBack();
  }, true);
  
  $('.select').chosen();
});
	
	
</script>