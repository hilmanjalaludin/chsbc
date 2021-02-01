<script>
$(document).ready(function(){ 

$('.select').chosen();
	
	
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function ProductPremiTable( object ) 
{	
 
  var formDisFilter = Ext.Serialize('formDisFilter');
	$('#ui-widget-dis-list').Spiner ({
		url 	: new Array('MgtAssignment','PageDistribute'),
		param 	: {
			dis_start_upload_date :	Ext.Cmp('dis_start_upload_date').getValue(),
			dis_end_upload_date : Ext.Cmp('dis_end_upload_date').getValue(),
			dis_campaign_name  : Ext.Cmp('dis_campaign_name').getValue(), 	 
			dis_gender_id : Ext.Cmp('dis_gender_id').getValue(),	
			dis_start_dob :	Ext.Cmp('dis_start_dob').getValue(),
			dis_end_dob : Ext.Cmp('dis_end_dob').getValue()
		}, 
		order   : {
			order_type : obj.type,
			order_by   : obj.orderby,
			order_page : obj.page	
		}, 
		complete : function( obj ){
			
		}
	});		
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
 
 
 //---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 

});
</script>