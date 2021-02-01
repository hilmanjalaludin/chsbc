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
		Ext.ShowMenu("SetBenefit", Ext.System.view_file_name());	
	}
}


// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : $.ready
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
 Ext.DOM.SetProductPlan  = function( object )
 {
	Ext.Ajax
	({
		url 	: Ext.EventUrl(['SetBenefit','ViewAddBenefit']).Apply(), 
		method 	: 'GET',
		param 	: {
			ProductId : object.value,
			Duration  : Ext.Date().getDuration(),
		}
	}).load('div_product_plan');
	$('.select').addClass('superlong');
	$('.select').chosen();
	
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
	Ext.ShowMenu( new Array('SetBenefit','AddBenefit'),
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
 
Ext.DOM.saveBenefit= function()
{	

 var frmAddBenefit = Ext.Serialize('frmAddBenefit');
 if( !frmAddBenefit.Complete() ) {
	 Ext.Msg("Form Not Complete!").Info();
	 return false;
 }
 
 
 var conds = Confirm = Ext.Msg('Are you sure ?').Confirm(); 
  if( conds )
{
	Ext.Ajax
	({
		url 	: Ext.EventUrl(['SetBenefit','SaveBenefit']).Apply(),
		method 	: 'POST',
		param 	: Ext.Join(new Array(frmAddBenefit.getElement())).object(),
		ERROR : function(fn) {
			Ext.Util(fn).proc(function( response ){
				if( response.success == 1 ){
					Ext.Msg("Save Benefit").Success();
					if( Ext.Msg('Do you want to add again ?').Confirm() ){
						Ext.DOM.Continue();
					}	
				} else {
					Ext.Msg("Save Benefit").Failed();	
					return false;
				}	
			});
		}
	}).post();
 }	 
 
}

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
 Ext.DOM.UpdataBenefit = function()
{	
  
  var frmEditBenefit = Ext.Serialize("frmEditBenefit");
  if( !frmEditBenefit.Complete() ){
	 Ext.Msg("Form Input Not Complete!").Info();
	 return false;
  } 
  
 // ---------------- save data ajax ---------------------------------------
 
	Ext.Ajax
  ({
		url 	: Ext.EventUrl( new Array('SetBenefit', 'UpdateBenefit')).Apply(),
		method 	: 'POST',
		param 	: Ext.Join( new Array(frmEditBenefit.getElement())).object(),
		ERROR 	: function( e ) {
			Ext.Util(e).proc( function( response ){
				if( response.success == 1 ){
					Ext.Msg("Upadate Product Benefit").Success();
				} else {
					Ext.Msg("Upadate Product Benefit").Failed();
					return false;
				}	
			});
		}	
	}).post();
  
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