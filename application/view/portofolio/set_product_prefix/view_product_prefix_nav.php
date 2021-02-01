<?php echo javascript(); ?>
<script type="text/javascript">

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
Ext.DOM.onload = (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 })();



// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 Ext.DOM.datas = 
{
	prefix_kode_number  : '<?php echo _get_exist_session('prefix_kode_number');?>',
	prefix_product_id	: '<?php echo _get_exist_session('prefix_product_id');?>',
	prefix_product_name	: '<?php echo _get_exist_session('prefix_product_name');?>',
	prefix_status		: '<?php echo _get_exist_session('prefix_status');?>',
	order_by 			: '<?php echo _get_exist_session('order_by');?>',
	type	 			: '<?php echo _get_exist_session('type'); ?>'	
}
 

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 Ext.EQuery.TotalPage   = eval('<?php echo $page->_get_total_page(); ?>');
 Ext.EQuery.TotalRecord = eval('<?php echo $page->_get_total_record(); ?>');


// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 Ext.DOM.navigation = {
	custnav : Ext.DOM.INDEX+'/SetPrefix/index', 
	custlist : Ext.DOM.INDEX+'/SetPrefix/content', 
 }

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
Ext.EQuery.construct( Ext.DOM.navigation, Ext.DOM.datas )
Ext.EQuery.postContentList();

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
Ext.DOM.Disable = function()
{
	var PrefixId = Ext.Cmp("prefix_id").getValue();
	Ext.Ajax({
		url : Ext.DOM.INDEX +'/SetPrefix/SetActive/',
		method : "GET",
		param : {
			active : 0,
			PrefixId : PrefixId,
		},
		ERROR : function(fn){
			try{
				var ERR = JSON.parse(fn.target.responseText);
				if( ERR.success ){
					Ext.Msg("Disable Prefix Number ").Success();
					Ext.EQuery.postContent();
				}
				else{
					Ext.Msg("Disable Prefix Number ").Failed();
				}
			}
			catch(e){
				Ext.Msg(e).Info();
			}
		}
	}).post();
}

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
Ext.DOM.Enable = function()
{
	var PrefixId = Ext.Cmp("prefix_id").getValue();
	Ext.Ajax
	({
		url : Ext.DOM.INDEX +'/SetPrefix/SetActive/',
		method : "GET",
		param : {
			active : 1,
			PrefixId : PrefixId,
		},
		ERROR : function(fn){
			try{
				var ERR = JSON.parse(fn.target.responseText);
				if( ERR.success ){
					Ext.Msg("Enable Prefix Number ").Success();
					Ext.EQuery.postContent();
				}
				else{
					Ext.Msg("Enable Prefix Number ").Failed();
				}
			}
			catch(e){
				Ext.Msg(e).Info();
			}
		}
	}).post();
}

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
Ext.DOM.DeletePrefix = function()
{
	var PrefixId = Ext.Cmp("PrefixNumberId").getValue();
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/SetPrefix/Delete/',
		method 	: "POST",
		param 	: {
			PrefixId : PrefixId,
		},
		ERROR : function(fn){
			Ext.Util(fn).proc(function(Delete){
				if( Delete.success ){
					Ext.Msg("Delete Prefix Number ").Success(); 
					Ext.EQuery.postContent(); 
				}
				else
				{
					Ext.Msg("Delete Prefix Number ").Failed(); }
			});
		}
	}).post();
}


// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
Ext.DOM.searchResult = function()
{
	console.log(Ext.Serialize('FrmPrefix').getElement());
	Ext.EQuery.construct( Ext.DOM.navigation, 
		Ext.Join( 
			new Array( Ext.Serialize('FrmPrefix').getElement()) 
		).object());
	Ext.EQuery.postContent();
}



// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
Ext.DOM.cancelResult = function() 
{
  Ext.Serialize('FrmPrefix').Clear();
  new Ext.DOM.searchResult();
}


// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */

Ext.DOM.addResult = function()
{
	var Time =  Ext.Date().getDuration();
	Ext.ShowMenu( new Array("SetPrefix","AddPrefix"), Ext.System.view_file_name(),{
		Time : Time
	});
}

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
 Ext.DOM.EditProduct = function()
{
	var PrefixNumberId =  Ext.Cmp('PrefixNumberId').getValue();
	Ext.ShowMenu( new Array("SetPrefix","EditPrefix"), Ext.System.view_file_name(),{
		PrefixId : PrefixNumberId
	});
}


// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
$(document).ready(function(){
	$('#toolbars').extToolbars({
		extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle :[['Enable'],['Disable'],['Edit'],['Add'],['Delete'],['Clear'],['Search']],
		extMenu  :[['Enable'],['Disable'],['EditProduct'],['addResult'],['DeletePrefix'],['cancelResult'],['searchResult']],
		extIcon  :[['accept.png'],['cancel.png'],['application_edit.png'],['add.png'],['delete.png'],['cancel.png'], ['zoom.png']],
		extText  :true,
		extInput :true,
		extOption: []
	});	
	
	$('.select').chosen();
	
});
</script>


<fieldset class="corner">
 <?php echo form()->legend(lang(""), "fa-bars"); ?>
<div id="result_content_add" class="ui-widget-panel-form"> 
<form name="FrmPrefix">
	<div class="ui-widget-form-table-compact">
		<div class="ui-widget-form-row baris-1">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Product','Code'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->combo('prefix_product_id','select superlong',Product(), _get_exist_session('prefix_product_id'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang('Product Prefix');?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell left"><?php echo form()->input('prefix_kode_number','input_text superlong', _get_exist_session('prefix_kode_number'));?></div>
		</div>
		
		<div class="ui-widget-form-row baris-2">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Product','Name'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->input('prefix_product_name','input_text superlong',_get_exist_session('prefix_product_name'));?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Status'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('prefix_status','select superlong',Flags(),_get_exist_session('prefix_status') );?></div>
		</div>
	</div>
	</form>
</div>

<div class="ui-widget-toolbars" id="toolbars"></div>
<div class="ui-widget-panel-content" id="#panel-content"></div>
<div class="content_table" id="ui-widget-content_table"></div>
<div class="ui-widget-pager" id="pager"></div>
<div class="ui-widget-component" id="ui-widget-component"></div>
	<!-- stop : content -->
	