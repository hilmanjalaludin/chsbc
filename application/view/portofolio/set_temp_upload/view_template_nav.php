<?php echo javascript(); ?>

<script type="text/javascript">
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 
 
 Ext.DOM.onload= (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 })();
 
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 
 $(function(){
	$('#toolbars').extToolbars({
		extUrl   :Ext.DOM.LIBRARY +'/gambar/icon',
		extTitle :[['Add'],['Download'],['Enable'],['Disable'],['Delete']],
		extMenu  :[['CreteTemplate'],['DownloadTemplate'],['Enable'],['Disable'],['Delete']],
		extIcon  :[['add.png'],['page_save.png'],['accept.png'],['cancel.png'],['cross.png']],
		extText  :true,
		extInput :true,
		extOption:[{
			render : 1,
		}]
	});
});

 
Ext.EQuery.TotalPage   = <?php echo $page -> _get_total_page(); ?>;
Ext.EQuery.TotalRecord = <?php echo $page -> _get_total_record(); ?>;

// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 
var Clear = function(){
	Ext.Cmp('table_name').setValue('');
	Ext.Cmp('mode_input').setValue('');
	Ext.Cmp('file_type').setValue('');
	Ext.Cmp('templ_name').setValue('');
	Ext.Cmp('list_columns').setText('');
}
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
Ext.DOM.CreteTemplate=function(){
	
 Ext.ShowMenu(new Array('SetUpload','Create'), 
	'Setup Template',{
	time : Ext.Date().getDuration()	
 });	
} 
 // ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
Ext.DOM.Delete = function() {
	var TemplateId = Ext.Cmp('TemplateId').getValue();
	if( TemplateId.length > 0 )
	{
		if( Ext.Msg("Do you want to delete this template ?").Confirm()) {
			Ext.Ajax({
				url 	: Ext.DOM.INDEX +'/SetUpload/Delete/',
				method  : 'POST',
				param	: { 
					TemplateId : TemplateId
				},
				ERROR   : function(e){
					Ext.Util(e).proc(function(Delete){
						if(Delete.success){
							Ext.Msg('Delete Template').Success();
							Ext.EQuery.construct(Ext.DOM._content_page,Ext.DOM.datas )
							Ext.EQuery.postContent();	
						}
						else{
							Ext.Msg('Delete Template').Failed();
						}
					});
				}
			
			}).post();
		}
	}
}
	
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
	
 Ext.DOM.datas = 
{
	order_by : "<?php echo _get_exist_session('order_by');?>", 
	type 	 : "<?php echo _get_exist_session('type');?>"
} 
	
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 
Ext.DOM._content_page = {
	custnav  : Ext.DOM.INDEX+'/SetUpload/index',
	custlist : Ext.DOM.INDEX+'/SetUpload/Content'			
 }	
	
	
Ext.DOM.Delimiter = function(select){
	if(select.value=='txt')
		Ext.Cmp('delimiter_type').disabled(false);
	else
		Ext.Cmp('delimiter_type').disabled(true);
}	
		
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 
Ext.EQuery.construct(Ext.DOM._content_page,Ext.DOM.datas )
Ext.EQuery.postContentList();	
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */ 
var Enable = function()
{

	var TemplateId = Ext.Cmp('TemplateId').getValue();
	if( (TemplateId!='') )
	{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/SetUpload/Enable/',
			method  : 'POST',
			param	: { 
				TemplateId : TemplateId
			},
			ERROR   : function(e)
			{
				var ERR = JSON.parse(e.target.responseText);
				if( ERR.success ){
					Ext.Msg('Enable Template Upload').Success();
					Ext.EQuery.construct(Ext.DOM._content_page,Ext.DOM.datas )
					Ext.EQuery.postContent();	
				}
				else{
					Ext.Msg('Enable Template Upload').Failed();
				}
			}
		}).post();
	 }
	else{
		Ext.Msg('Enable Template Upload').Error();
	} 
}
// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
 
var Disable = function()
{
	var TemplateId = Ext.Cmp('TemplateId').getValue();
	if( (TemplateId!='') )
	{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/SetUpload/Disable/',
			method  : 'POST',
			param	: { 
				TemplateId : TemplateId
			},
			ERROR   : function(e)
			{
				var ERR = JSON.parse(e.target.responseText);
				if( ERR.success ){
					Ext.Msg('Disable Template Upload').Success();
					Ext.EQuery.construct(Ext.DOM._content_page,Ext.DOM.datas )
					Ext.EQuery.postContent();	
				}
				else{
					Ext.Msg('Disable Template Upload').Failed();
				}
			}
		}).post();
	}
	else{
		Ext.Msg('Disable Template Upload').Error();
	} 
}

// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */

// ---------------------------------------------------------------------	
/*
 * @ package : 	
 * ---------------------------------------------------------------------
 *
 * @ param 	 :  
 * @ param 	 :  
 */
Ext.DOM.DownloadTemplate = function()
	{
		var TemplateId = Ext.Cmp('TemplateId').getValue();
		if( (TemplateId!='') )
		{
			var WindowWin = new Ext.Window({
				url   : Ext.DOM.INDEX+'/SetUpload/DownloadTemplate/', 
				param : {
					TemplateId : TemplateId,
				}
			}).newtab();
		}
	}	

	
</script>

<!-- start : content -->
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-gear"); ?>
<div class="ui-widget-toolbars" id="toolbars" style="margin:10px 5px 5px 5px;"></div>
 <div class="ui-widget-panel-content" id="#panel-content"></div>
 <div class="content_table" id="ui-widget-content_table"></div>
 <div class="ui-widget-pager" id="pager"></div>
 <div class="ui-widget-component" id="ui-widget-component"></div>
</fieldset>	
		