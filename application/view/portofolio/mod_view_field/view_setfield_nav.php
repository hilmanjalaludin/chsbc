<?php echo javascript(); ?>
	
<script type="text/javascript"> 

Ext.document('document').ready(function(){

/* load : title every controller */

 Ext.Cmp('ui-widget-title').setText(Ext.System.view_file_name());

/*
 * @ def  : set attribute page 
 * -----------------------------------------------------------------
 * 
 * @ param : - 
 * @ param : -
 * ----------------------------------------------------------------
 */ 

 Ext.DOM.datas = { 
	keywords : '<?php echo _get_exist_session('keywords'); ?>',
	order_by : '<?php echo _get_exist_session('order_by'); ?>',
	type 	 : '<?php echo _get_exist_session('type'); ?>',
 }

/*
 * @ def  : set attribute page 
 * -----------------------------------------------------------------
 * 
 * @ param : - 
 * @ param : -
 * ----------------------------------------------------------------
 */ 

 
 Ext.EQuery.TotalPage   = <?php echo (INT)$page -> _get_total_page(); ?>;
 Ext.EQuery.TotalRecord = <?php echo (INT)$page -> _get_total_record(); ?>;

/*
 * @ def  : set attribute page 
 * -----------------------------------------------------------------
 * 
 * @ param : - 
 * @ param : -
 * ----------------------------------------------------------------
 */ 

 
 Ext.DOM.Page = {
	custnav	 : Ext.DOM.INDEX +'/SetField/index/',
	custlist : Ext.DOM.INDEX +'/SetField/Content/',
}

/*
 * @ def  : loading Ext libs js on Ready 
 * -----------------------------------------------------------------
 * 
 * @ param : - 
 * @ param : -
 * ----------------------------------------------------------------
 */ 
 
 Ext.EQuery.construct(Ext.DOM.Page, Ext.DOM.datas);
 Ext.EQuery.postContentList();
 	
/*
 * @ def  : loading extToolbars jQuery plugin  
 * -----------------------------------------------------------------
 * 
 * @ param : - 
 * @ param : -
 * ----------------------------------------------------------------
 */ 
 	
 $(document).ready(function(){
	$('#toolbars').extToolbars 
	({
	extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
	extTitle :[['Add'],['Delete'],['Copy'],['View'],['Search'],['Clear']],
	extMenu  :[['AddViewLayout'],['Delete'],['Copy'],['View'],['Search'],['Clear']],
	extIcon  :[['add.png'],['delete.png'],['page_copy.png'],['zoom_in.png'],['zoom.png'],['zoom_out.png']],
	extText  :true,
	extInput :true,
	extOption: [{
			render	: 4,
			type	: 'text',
			id		: 'keywords', 	
			name	: 'keywords',
			value	: Ext.DOM.datas.keywords,
			width	: 200
		}]
	});
	
 });	

 
/*
 * @ def  : loading Ext libs js on Ready 
 * -----------------------------------------------------------------
 * 
 * @ param : - 
 * @ param : -
 * ----------------------------------------------------------------
 */ 
 Ext.DOM.Search = function()
{
	$.cookie('selected', 0);
	Ext.EQuery.construct(Ext.DOM.Page, { 
		keywords :  Ext.Cmp('keywords').getValue() 
	});
	Ext.EQuery.postContent();
 
}

 
/*
 * @ def  : loading Ext libs js on Ready 
 * -----------------------------------------------------------------
 * 
 * @ param : - 
 * @ param : -
 * ----------------------------------------------------------------
 */ 
 Ext.DOM.Clear = function()
{
	Ext.Cmp('keywords').setValue("");
	new Ext.DOM.Search();
}
 
/*
 * @ def  : loading Ext libs js on Ready 
 * -----------------------------------------------------------------
 * 
 * @ param : - 
 * @ param : -
 * ----------------------------------------------------------------
 */ 
 Ext.DOM.AddViewLayout = function() {
	Ext.ShowMenu( new Array('SetField','Create'), Ext.System.view_file_name(),{
		time : Ext.Date().getDuration()
	});
}


 
/*
 * @ def  : loading Ext libs js on Ready 
 * -----------------------------------------------------------------
 * 
 * @ param : - 
 * @ param : -
 * ----------------------------------------------------------------
 */ 
 Ext.DOM.Copy = function() {
	var Field_Id = Ext.Cmp('Field_Id').getValue();
	
	if( Field_Id.length == 0  ){
		Ext.Msg('Please select row(s)').Info();
		return false;
	}
	
	if( Field_Id.length > 1 ){
		Ext.Msg('Please select a row(s)').Info();
		return false;
	}

	Ext.ShowMenu( new Array('SetField','Copy'), Ext.System.view_file_name(),{
		Field_Id : Field_Id
	});
}


/*
 * @ def  : loading Ext libs js on Ready 
 * -----------------------------------------------------------------
 * 
 * @ param : - 
 * @ param : -
 * ----------------------------------------------------------------
 */ 
 
 Ext.DOM.Delete = function()
{
	if(Ext.Msg("Do you want to delete this rows").Confirm() ){
		Ext.Ajax ({
			url		: Ext.DOM.INDEX+'/SetField/Delete/',
			method 	: 'POST',
			param 	: {
				Field_Id : Ext.Cmp('Field_Id').getValue()
			},
			ERROR 	: function(e){
				Ext.Util(e).proc(function( items ) {
				if( items.success ) {
					Ext.Msg('Delete Field Layout').Success(); // alert callback 
					Ext.EQuery.postContent(); // reload
				}
				else{
					Ext.Msg('Add Field Layout').Failed();
				}});
			}
		}).post();	
	}	
}
/*
 * @ def  : loading Ext libs js on Ready 
 * -----------------------------------------------------------------
 * 
 * @ param : - 
 * @ param : -
 * ----------------------------------------------------------------
 */ 

Ext.DOM.View = function()
{
	Ext.Window
	({
		url 	: Ext.DOM.INDEX+'/SetField/ViewLayout/',
		width 	: 500,
		height  : 500,
		scrollbars:1,
		resizeable:1,
		param 	: {
			LayoutId : Ext.Cmp('Field_Id').Encrypt(),
		}	
	}).popup();
}
	
}); 

</script>

<fieldset class="corner" style="padding:12px 0px 0px 0px;">
<?php echo form()->legend(lang(""), "fa-gear"); ?>
	<div class="ui-widget-toolbars" id="toolbars"></div>
	<div class="ui-widget-panel-content" id="#panel-content"></div>
	<div class="content_table" id="ui-widget-content_table"></div>
	<div class="ui-widget-pager" id="pager"></div>
	<div class="ui-widget-component" id="ui-widget-component"></div>
</fieldset>	
		
		