<?php echo javascript(); ?>
<script type="text/javascript"> 
Ext.EQuery.TotalPage   = '<?php echo $page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';
	
var totals_pages 	= Ext.EQuery.TotalPage;
var totals_records 	= Ext.EQuery.TotalRecord;

Ext.DOM.Find = function()
{
	Ext.EQuery.construct( navigation, Ext.Join([  
		Ext.Serialize("frmBucketData").getElement() 
	]).object() );
	
	Ext.EQuery.postContent();
}

Ext.DOM.Clear = function()
{
	Ext.Serialize('frmBucketData').Clear();
	Ext.DOM.Find();
}

Ext.DOM.Input = function()
{
	Ext.ShowMenu(new Array('MgtBlacklist','ManualInput'), 
		"Input Blacklist", {
			time : Ext.Date().getDuration()
	});
}

Ext.DOM.Delete = function()
{
	if(confirm('Are you sure want to delete this data?')){
		Ext.Ajax({
			url 	: Ext.DOM.INDEX+'/MgtBlacklist/DeleteData/',
			method  : 'POST',
			param   : {
				ID : Ext.Cmp('Id').getValue()
			},
			ERROR : function( fn ) {
				Ext.Util(fn).proc(function(save){
					if( save.success ) {
						alert('Success delete ('+save.total+') data!');
						Ext.DOM.Find();
					}
					else{
						alert('Delete Failed!');
						return false;
					}
				});
			} 
		}).post();
	}
	else{
		return false;
	}
}

Ext.DOM.Upload = function()
{
	Ext.ShowMenu(new Array('MgtBlacklist','ManualUpload'), 
		"Upload Blacklist", {
			time : Ext.Date().getDuration()
	});
}

$(function(){
	$('#toolbars').extToolbars({
		extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle : [['Search'],['Clear'],['Input Manual'],['Delete'],['Upload Blacklist']],
		extMenu  : [['Find'],['Clear'],['Input'],['Delete'],['Upload']],
		extIcon  : [['zoom.png'],['cancel.png'],['application_form_add.png'],['application_form_delete.png'],['database_go.png']],		
		extText  : true,
		extInput : true,
		extOption: []
	});
});

Ext.DOM.datas=
{ 
	blacklist_file 	: '<?php echo _get_exist_session('blacklist_file');?>',
	blacklist_id	: '<?php echo _get_exist_session('blacklist_id');?>',
	blacklist_name	: '<?php echo _get_exist_session('blacklist_name');?>',
	order_by 		: '<?php echo _get_exist_session('order_by');?>',
	type	 		: '<?php echo _get_exist_session('type');?>',
}
	
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 		
Ext.DOM.navigation = 
{
	custnav	 : Ext.DOM.INDEX+'/MgtBlacklist/index/',
	custlist : Ext.DOM.INDEX+'/MgtBlacklist/Content/'
}

/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
 Ext.EQuery.construct(Ext.DOM.navigation,datas)
 Ext.EQuery.postContentList();
	
</script>
<fieldset class="corner">
<?php echo form()->legend(lang("Blacklist Data"), "fa-tags"); ?>
 <div id="result_content_add" class="ui-widget-panel-form"> 
	<form name="frmBucketData">
		<div class="ui-widget-form-table-compact">
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption" style="padding:5px 5px;"><?php echo lang(array('File Name'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left" style="padding:5px 5px;"><?php echo form()->combo('blacklist_file','select long', $file, _get_exist_session('blacklist_file')); ?></div>
				<div class="ui-widget-form-cell text_caption" style="padding:5px 5px;"><?php echo lang(array('ID Number'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left" style="padding:5px 5px;"><?php echo form()->input('blacklist_id','input_text long', _get_exist_session('blacklist_id')); ?></div>
				<div class="ui-widget-form-cell text_caption" style="padding:5px 5px;"><?php echo lang(array('Name Customer'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left" style="padding:5px 5px;"><?php echo form()->input('blacklist_name','input_text long', _get_exist_session('blacklist_name')); ?></div>
			</div>
		</div>
		
	</form>
 </div>
 
 <!-- html markup -->
 
 <div class="ui-widget-toolbars" id="toolbars"></div>
 <div class="ui-widget-panel-content" id="#panel-content"></div>
 <div class="content_table" id="ui-widget-content_table"></div>
 <div class="ui-widget-pager" id="pager"></div>
 <div class="ui-widget-component" id="ui-widget-component"></div>
</fieldset>