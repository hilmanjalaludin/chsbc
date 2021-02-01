
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function ProductPremiTable( obj ) 
{	
 
  var frmSimulasi = Ext.Serialize('frmSimulasi');
  $('#ui-widget-pcroduct-premi').Spiner 
  ({
		url 	: new Array('Simulasi','PagePremi'),
		param 	: Ext.Join(new Array( frmSimulasi.getElement() )).object(),
		order   : {
			order_type : obj.type,
			order_by   : obj.orderby,
			order_page : obj.page	
		}, 
		complete : function( obj ){
			var uid = new Array("#", $(obj).attr('id')).join("");
			$(uid).attr("style", "");
			$(uid).css({ "padding" : "4px 4px 4px 4px"});
			$('#ui-widget-content-markup-tabs').mytab().tabs("option", "selected", 0);
		}
	});		
}
	
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function ProductBenefitTable( obj ) 
{	
 
 $('#ui-widget-pcroduct-benefit').Spiner 
  ({
		url 	: new Array('Simulasi','PageBenefit'),
		param 	:{ 
			ProductPlanId : obj.ProductPlanId
		},
		order   : {
			order_type : obj.type,
			order_by   : obj.orderby,
			order_page : obj.page	
		}, 
		complete : function( obj ){
			var uid = new Array("#", $(obj).attr('id')).join("");
			var ProductName = $('#ProductName').val();
				$(uid).attr("style", "");
				$(uid).css({ "padding" : "4px 4px 4px 4px"});
				$('#ui-widget-content-markup-tabs').mytab().tabs("option", "selected",1);
				$('#title-product').html( " ( " +  ProductName +" ) ");
		}
	});		
}	
	
function ShowProductBenefit(ProductPlanId )
{
	if ( !Ext.Msg("Do you want to open detail benefit ?").Confirm() ){
		return false;
	}	
   new ProductBenefitTable ({ orderby : '',  type: '', page: 0, ProductPlanId : ProductPlanId});	
}	
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function ShowProductPremi() {
	new ProductPremiTable ({ orderby : '',  type: '', page: 0	 });	
}
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function ClearProductPremi()
{
	Ext.Serialize('frmSimulasi').Clear();
	new ProductPremiTable ({ orderby : '',  type: '', page: 0	 });	
	$('#ui-widget-pcroduct-benefit').html("");	
	$('#title-product').html("");
}

//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
$(document).ready(function(){
	$('#ui-widget-content-markup-tabs').mytab().tabs();	
	$('#ui-widget-content-markup-tabs').mytab().tabs("option", "selected", 0);
	$("#ui-widget-content-markup-tabs").mytab().close({}, true);
	$('.ui-widget-content-frame').css("background-color","#FFFFFF");
	$('.select').chosen();
	new ShowProductPremi();
	
	$('body').css({ "margin" : "8px"});
});
	
 
 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
