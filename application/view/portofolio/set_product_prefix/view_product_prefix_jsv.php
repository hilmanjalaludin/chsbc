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
		Ext.ShowMenu("SetPrefix", Ext.System.view_file_name());	
	}
}


// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
 Ext.DOM.Continue = function()
{
	Ext.ShowMenu( new Array('SetPrefix','AddPrefix'),
	Ext.System.view_file_name(), {
		time : Ext.Date().getDuration()	
	});
}


// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
 Ext.DOM.UpdatePrefix = function()
{
	Ext.Ajax
	({
		url	   : Ext.EventUrl(new Array("SetPrefix","Update") ).Apply(),
		method : 'POST',
		param  : Ext.Join([Ext.Serialize("frmEditPrefix").getElement()]).object(),
		ERROR  : function(fn){
			try {
				var ERR = JSON.parse(fn.target.responseText);
				if( ERR.success ){ 
					Ext.Msg("Update Product Prefix ").Success(); 
				}
				else {
					Ext.Msg("Update Product Prefix ").Failed();
				}	
			}
			catch(e){
				Ext.Msg(e).Error();
			}
		}
	}).post();
}
 

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
Ext.DOM.savePrefix = function()
{
var frmProductPrefix = Ext.Serialize('frmProductPrefix');
	if( !frmProductPrefix.Complete(new Array('form_edit')))
	{
		Ext.Msg("Form Input not completed!").Info();
		return false;
	}
		
		if(  Ext.Msg("Do you want to save this Prefix").Confirm())
	{
			Ext.Ajax
			({
				url 	: Ext.EventUrl(new Array("SetPrefix","SavePrefix") ).Apply(), 
				method 	: 'POST',
				param 	: {
					result_length 		: Ext.Cmp('result_length').getValue(),
					result_code 		: Ext.Cmp('result_code').getValue(),
					status_active 		: Ext.Cmp('status_active').getValue(),
					form_input 			: Ext.Cmp('form_input').getValue(),
					form_edit 			: Ext.Cmp('form_edit').getValue(),
					result_method 		: Ext.Cmp('result_method').getValue(),
					result_head_level 	: Ext.Cmp('result_head_level').getValue()
				},
				ERROR : function(e){
					var ERR = JSON.parse(e.target.responseText);
					if( ERR.success ){
						Ext.Msg("Save Prefix").Success();
						if( Ext.Msg("Do you want to add again?").Confirm() ){
							Ext.DOM.Continue();
						}
					}
					else{
						 Ext.Msg("Save Prefix").Failed();
						 return false; 
					}
				}
				
			}).post();	
		}
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
  });
  
  $('.select').chosen();
});
	
	
</script>