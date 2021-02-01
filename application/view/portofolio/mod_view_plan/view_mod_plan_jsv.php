<?php ?>
<script>

  
//---------------------------------------------------------------------------------------
// http://192.168.10.236/bnilifeinsurance/index.php/ModViewPlan
/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  

Ext.DOM.RoleBack = function(){
	if( Ext.Msg('Are you sure ?').Confirm() ){
		Ext.ShowMenu("ModViewPlan", Ext.System.view_file_name());	
	}
}

  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 Ext.DOM.UpdatePremi = function( obj )
{
 var Product = new Array();
 var frmSelector = Ext.Serialize(obj.id).getElement();
	 Product['ProductId'] = Ext.Cmp("ProductId").getValue();

   Ext.Ajax
 ({
		url 	: Ext.EventUrl(new Array("ModViewPlan", "UpdatePremi")).Apply(),
		method  : 'POST',
		param   : Ext.Join(new Array( frmSelector, Product)).object(),
		ERROR	: function( e )
		{
			Ext.Util(e).proc(function( data )
			{
				if( data.success == 1 ){
					Ext.Msg("Update Product Premi").Success();
				} else {
					Ext.Msg("Update Product Premi").Failed();
				}
			});
		}	
	}).post();	
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
 Ext.DOM.Reload = function() 
{
  var ProductId = Ext.Cmp('ProductId').getValue();
  if( ProductId == '' ){
	  Ext.Msg("Please select a row(s)").Info();
	  return false;
  }
  
  Ext.ShowMenu(new Array("ModViewPlan", "showPlan") ,
	Ext.System.view_file_name(), {
		ProductId : ProductId	
  });
  
}


//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
 
Ext.DOM.UpdateLabel = function()
{
	var Product = new Array();
	var frmSelector = Ext.Serialize('frmUpdateLabel');
		Product['ProductId'] = Ext.Cmp("ProductId").getValue();
		
	if( !frmSelector.Complete() ){
		Ext.Msg('Form input not complete').Info();
		return false;	
	}
	
	if( !Ext.Msg('Do you want to update label ?').Confirm()  ){
		return false;
	}
	
    Ext.Ajax
   ({
		url 	: Ext.EventUrl(new Array("ModViewPlan", "UpdateLabel")).Apply(),
		method  : 'POST',
		param   : Ext.Join(new Array( frmSelector.getElement(), Product)).object(),
		ERROR	: function( e )
		{
			Ext.Util(e).proc(function( data )
			{
				if( data.success == 1 ){
					Ext.Msg("Update Label Plan").Success();
					new Ext.DOM.Reload();
					
				} else {
					Ext.Msg("Update Label Plan").Failed();
				}
			});
		}	
	}).post();	
}
  

  
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */  
$(document).ready( function()
{
  $('#ui-widget-add-campaign').mytab().tabs();
  $('#ui-widget-add-campaign').mytab().tabs("option", "selected", 0);
  $('#ui-widget-add-campaign').css({'background-color':'#FFFFFF'});
  $('.ui-widget-add-content').css({'background-color':'#FFFFFF'});
  
  $("#ui-widget-add-campaign").mytab().close(function(){
	  Ext.DOM.RoleBack();
  }, true);
  
  $( '.dsbl' ).each(function(){
	  $(this).attr("disabled", true);
  });
  $('.select').chosen();
  $( '.disabled' ).each(function(){
	  Ext.Cmp( $(this).attr('id') ).disabled( true );
  })
});

</script>