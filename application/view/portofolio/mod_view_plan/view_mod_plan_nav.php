<?php
	echo javascript();
?>
<script type="text/javascript">

Ext.document('document').ready( function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 }); 
 	

		
var datas={
	
	order_by : '<?php echo _get_exist_session('order_by');?>', 
	type 	 : '<?php echo _get_exist_session('type');?>'
}

Ext.EQuery.TotalPage   = '<?php echo $page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';

/* assign navigation filter **/

var navigation =  {
	custnav : Ext.DOM.INDEX +'/ModViewPlan/index/',
	custlist : Ext.DOM.INDEX +'/ModViewPlan/Content/',
}
		
//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 

Ext.EQuery.construct(navigation, datas);
Ext.EQuery.postContentList();



//---------------------------------------------------------------------------------------

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 Ext.DOM.Disable = function()
{

 var ProductId = Ext.Cmp('ProductId').getValue();
  if( ProductId == '')
 {
	Ext.Msg("Please select a row(s)").Info();
	return false;	
 }
 
// ----------- set ajax ----------------------------------- 
  Ext.Ajax 
 ({
	url 	: Ext.EventUrl(new Array("ModViewPlan","SetActive")).Apply(), 
	method 	: 'POST',
	param 	: { 
		ProductId : ProductId, 
		Active :0,
	},
		ERROR 	: function( e )
		{
			Ext.Util(e).proc(function( data )
			{
				if( data.success == 1 ){
					Ext.Msg("Disable Product").Success();
					Ext.EQuery.postContent();
				} else {
					Ext.Msg("Disable Product").Failed();
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
 

 Ext.DOM.Enable = function()
{

 var ProductId = Ext.Cmp('ProductId').getValue();
  if( ProductId == '')
 {
	Ext.Msg("Please select a row(s)").Info();
	return false;	
 }
 
// ----------- set ajax ----------------------------------- 
  Ext.Ajax 
 ({
	url 	: Ext.EventUrl(new Array("ModViewPlan","SetActive")).Apply(), 
	method 	: 'POST',
	param 	: { 
		ProductId : ProductId, 
		Active		 :1,
	},
		ERROR 	: function( e )
		{
			Ext.Util(e).proc(function( data )
			{
				if( data.success == 1 ){
					Ext.Msg("Enable Product").Success();
					Ext.EQuery.postContent();
				} else {
					Ext.Msg("Enable Product").Failed();
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
 

 
 Ext.DOM.Show = function()
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
 

 $(document).ready( function()
{
	$('#toolbars').extToolbars
	({
		extUrl    : Ext.DOM.LIBRARY +'/gambar/icon',
		extTitle  : [['Enable'],['Disable'],['Show']],
		extMenu   : [['Enable'],['Disable'],['Show']],
		extIcon   : [['accept.png'],['cancel.png'],['zoom_in.png']],
		extText   : true,
		extInput  : false,
		extOption : []
	});
});
		
</script>
	
<!-- start : content -->
<fieldset class="corner" style="padding:10px 5px 0px 5px;">
<?php echo form()->legend(lang(""), "fa-users"); ?>

<div class="ui-widget-toolbars" id="toolbars"></div>
<div class="ui-widget-panel-content" id="#panel-content"></div>
<div class="content_table" id="ui-widget-content_table"></div>
<div class="ui-widget-pager" id="pager"></div>
<div class="ui-widget-component" id="ui-widget-component"></div>

</fieldset>	
		
	<!-- stop : content -->
	
	
	