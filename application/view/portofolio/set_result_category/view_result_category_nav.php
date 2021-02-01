<?php echo javascript(); ?>
<script type="text/javascript">
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.onload = (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 })();

/**
 ** javscript prototype system
 ** version v.0.1
 **/

Ext.DOM.datas= {
	keywords : '<?php echo _get_post('keywords'); ?>',
	order_by : '<?php echo _get_post('order_by'); ?>',
	type 	 : '<?php echo _get_post('type'); ?>'
 }
 
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.EQuery.TotalPage   = <?php echo $page -> _get_total_page(); ?>;
Ext.EQuery.TotalRecord = <?php echo $page -> _get_total_record(); ?>;

/**
 ** javscript prototype system
 ** version v.0.1
 **/
		
Ext.DOM.navigation = {
	custnav  : Ext.EventUrl(new Array('SetResultCategory', 'index')).Apply(), 
	custlist : Ext.EventUrl(new Array('SetResultCategory', 'Content')).Apply() 
}
	
//---------------------------------------------------------------------------------------

/* properties		set_checkbox_func 
 *
 * @param 			set checked = false , oncheked rows = false 
 * @author			uknown 
 */
Ext.EQuery.construct(navigation,datas)
Ext.EQuery.postContentList();

//---------------------------------------------------------------------------------------

/* properties		set_checkbox_func 
 *
 * @param 			set checked = false , oncheked rows = false 
 * @author			uknown 
 */
 Ext.DOM.Search = function()
{
	$.cookie('selected', 0);
	Ext.EQuery.construct(navigation,{
		keywords : Ext.Cmp("CategoryName").getValue()
	});
	Ext.EQuery.postContent();
}

//---------------------------------------------------------------------------------------

/* properties		set_checkbox_func 
 *
 * @param 			set checked = false , oncheked rows = false 
 * @author			uknown 
 */
 
Ext.DOM.Clear = function() {
	Ext.Cmp("CategoryName").setValue("");
	new Ext.DOM.Search();
}

//---------------------------------------------------------------------------------------

/* properties		set_checkbox_func 
 *
 * @param 			set checked = false , oncheked rows = false 
 * @author			uknown 
 */
Ext.DOM.CancelResult=function(){
	Ext.Cmp('span_top_nav').setText('');
}

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
Ext.DOM.EditResult = function()
{
	if( Ext.Cmp('CategoryId').empty() ){ 
		Ext.Msg("Please select rows ").Info(); }
	else 
	{
		if( Ext.Cmp('CategoryId').getValue().length > 1 ) { 
			Ext.Msg("Please select a rows ").Info(); }
		else
		{
			Ext.ShowMenu(new Array("SetResultCategory", "EditView"),
			Ext.System.view_file_name(), {
				duration 	: Ext.Date().getDuration(),
				CategoryId 	: Ext.Cmp('CategoryId').getValue()
			});
		}	
	}	
	
}

//---------------------------------------------------------------------------------------

/* properties		set_checkbox_func 
 *
 * @param 			set checked = false , oncheked rows = false 
 * @author			uknown 
 */
Ext.DOM.DeleteCategory = function()
{
 if( CategoryId = Ext.Cmp('CategoryId').empty()!=true ) {
	if( Ext.Msg("Do you want delete this rows ").Confirm() )
	{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/SetResultCategory/Delete/',
			method 	: 'POST',
			param 	: { 
				CategoryId : Ext.Cmp('CategoryId').getValue(), 
				Active	: 0,
			},
			ERROR 	: function(fn)
			{
				try
				{
					var ERR = JSON.parse(fn.target.responseText);
					if( ERR.success ){
						Ext.Msg("Delete Result Category ").Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg("Delete Result Category ").Failed();
					}
				}
				catch(e){
					Ext.Msg(e).Error();
				}
			}
		}).post();
	}	
 }
 else{ Ext.Msg("Please select a row!").Info(); }
}
	
//---------------------------------------------------------------------------------------

/* properties		set_checkbox_func 
 *
 * @param 			set checked = false , oncheked rows = false 
 * @author			uknown 
 */
Ext.DOM.DisableResult=function()
{
 var CategoryId = Ext.Cmp('CategoryId').getValue();
 if( CategoryId !='') 
 {
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/SetResultCategory/SetActive/',
		method 	: 'POST',
		param 	: { 
			CategoryId : CategoryId, 
			Active	: 0,
		},
		ERROR 	: function(fn)
		{
			try{
				var ERR = JSON.parse(fn.target.responseText);
				if( ERR.success ){
					Ext.Msg("Disable Result Category ").Success();
					Ext.EQuery.postContent();
				}
				else{
					Ext.Msg("Disable Result Category ").Failed();
				}
			}
			catch(e){
				Ext.Msg(e).Error();
			}
		}
	}).post();
 }
 else{ Ext.Msg("Please select a row!").Info(); }
 
}
//---------------------------------------------------------------------------------------

/* properties		set_checkbox_func 
 *
 * @param 			set checked = false , oncheked rows = false 
 * @author			uknown 
 */
Ext.DOM.EnableResult=function()
{
 var CategoryId = Ext.Cmp('CategoryId').getValue();
 if( CategoryId !='') 
 {
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/SetResultCategory/SetActive/',
		method 	: 'POST',
		param 	: { 
			CategoryId : CategoryId, 
			Active	: 1,
		},
		ERROR 	: function(fn)
		{
			try{
				var ERR = JSON.parse(fn.target.responseText);
				if( ERR.success ){
					Ext.Msg("Enable Result Category ").Success();
					Ext.EQuery.postContent();
				}
				else{
					Ext.Msg("Enable Result Category ").Failed();
				}
			}
			catch(e){
				Ext.Msg(e).Error();
			}
		}
	}).post();
 }
 else{ Ext.Msg("Please select a row!").Info(); }
 
}



//---------------------------------------------------------------------------------------

/* properties		set_checkbox_func 
 *
 * @param 			set checked = false , oncheked rows = false 
 * @author			uknown 
 */
 $(document).ready( function()
{
	$('#toolbars').extToolbars
	({
		extUrl    : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle  : [['Enable'],['Disable'] ,['Add'],['Edit'],['Delete'],[],['Search'],['Clear']],
		extMenu   : [['EnableResult'],['DisableResult'],['AddCategory'],['EditResult'],['DeleteCategory'],[],['Search'],['Clear']],
		extIcon   : [['accept.png'],['cancel.png'], ['add.png'],['calendar_edit.png'],['delete.png'],[],['zoom.png'],['zoom_out.png']],
		extText   : true,
		extInput  : true,
		extOption : [{
						render	: 4,
						type	: 'text',
						id		: 'CategoryName', 	
						name	: 'CategoryName',
						value	: datas.keywords,
						width	: 200
					}]
	});
});

</script>
<!-- start : content -->

<fieldset class="corner fieldset">
<?php echo form()->legend(lang("ui-widget-title"), "fa-gear"); ?>
<div class="ui-widget-toolbars" id="toolbars"></div>
<div class="ui-widget-panel-content" id="#panel-content"></div>
<div class="content_table" id="ui-widget-content_table"></div>
<div class="ui-widget-pager" id="pager"></div>
<div class="ui-widget-component" id="ui-widget-component"></div>
<!--	
		<div id="toolbars"></div>
		<div id="span_top_nav"></div>
		<div class="content_table"></div>
		<div id="pager"></div>
		<div id="ViewCmp"></div>
-->
		
</fieldset>	
	
	
	