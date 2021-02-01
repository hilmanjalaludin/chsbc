<script>
//---------------------------------------------------------------------------------------

/* properties		set_checkbox_func 
 *
 * @param 			set checked = false , oncheked rows = false 
 * @author			uknown 
 */
Ext.DOM.AddCategory = function(){

	Ext.ShowMenu(new Array("SetResultCategory", "AddView"),
	Ext.System.view_file_name(), {
		time : Ext.Date().getDuration()
	});
}
//---------------------------------------------------------------------------------------

/* properties		set_checkbox_func 
 *
 * @param 			set checked = false , oncheked rows = false 
 * @author			uknown 
 */
 
 Ext.DOM.SaveCatgory = function()
{
 var frmAddCategory = Ext.Serialize('frmAddCategory');
 if( !frmAddCategory.Complete() ){
	Ext.Msg("Input form not Complete!").Info();
	return false;
 }
	 Ext.Ajax 
	 ({
			url 	: Ext.EventUrl(new Array('SetResultCategory','SaveCategory') ).Apply(), 
			method 	: 'POST',
			param   : Ext.Join(
						new Array( frmAddCategory.getElement() ) 
					).object(),
				
			ERROR 	: function(fn) 
			{
				Ext.Util(fn).proc(function( data ){
					if( data.success ){
						Ext.Msg("Save Result Category ").Success();
						if( Ext.Msg('Do you want to add again?').Confirm() ){
							new Ext.DOM.AddCategory();
						} 
					}else {
						Ext.Msg("Save Result Category ").Failed();
					}	
				});
			}
		}).post();
}

//---------------------------------------------------------------------------------------

/* properties		set_checkbox_func 
 *
 * @param 			set checked = false , oncheked rows = false 
 * @author			uknown 
 */
Ext.DOM.UpdateCategory = function()
{
  var frmEditCategory = Ext.Serialize('frmEditCategory');
  if( !frmEditCategory.Complete() ){
	Ext.Msg("Input form not Complete!").Info();
	return false;
  }
  
	 Ext.Ajax 
	({
		url 	: Ext.EventUrl(new Array('SetResultCategory','UpdateCategory') ).Apply(), 
		method 	: 'POST',
		param   : Ext.Join(
						new Array( frmEditCategory.getElement() ) 
				).object(),
		ERROR : function(fn) {
			Ext.Util(fn).proc(function( data ){
				if( data.success ){
					Ext.Msg("Update Result Category ").Success();
				} else {
					Ext.Msg("Update Result Category ").Failed();
				}	
			});
		}
	}).post();
}
//---------------------------------------------------------------------------------------

/* properties		set_checkbox_func 
 *
 * @param 			set checked = false , oncheked rows = false 
 * @author			uknown 
 */
Ext.DOM.RoleBack = function(){
	if( Ext.Msg('Are you sure ?').Confirm() ){
		Ext.ShowMenu("SetResultCategory", Ext.System.view_file_name());	
	}
}


//---------------------------------------------------------------------------------------

/* properties		set_checkbox_func 
 *
 * @param 			set checked = false , oncheked rows = false 
 * @author			uknown 
 */
$(document).ready( function()
{
  var date = new Date();
  $('#ui-widget-add-campaign').mytab().tabs();
  $('#ui-widget-add-campaign').mytab().tabs("option", "selected", 0);
  $('#ui-widget-add-campaign').css({'background-color':'#FFFFFF'});
  $('#ui-widget-add-content').css({'background-color':'#FFFFFF'});
  
  $("#ui-widget-add-campaign").mytab().close(function(){ Ext.DOM.RoleBack(); });
  
  $('.select').chosen();
  
});

</script>