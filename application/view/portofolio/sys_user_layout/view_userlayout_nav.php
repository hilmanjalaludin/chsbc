<?php echo javascript(); ?>
<script type="text/javascript">

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.onload= (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 })()
 

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */

Ext.DOM.datas = 
{
	layout_name 		: "<?php echo _get_exist_session('layout_name'); ?>",
	layout_status		: "<?php echo _get_exist_session('layout_status'); ?>",
	layout_themes 		: "<?php echo _get_exist_session('layout_themes'); ?>",
	layout_user_group 	: "<?php echo _get_exist_session('layout_user_group'); ?>",
	order_by 			: "<?php echo _get_exist_session('order_by'); ?>",  
	type 	 			: "<?php echo _get_exist_session('type'); ?>" 
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
  Ext.DOM._content_page = 
{
	custnav  : Ext.EventUrl(['SysUserLayout','index']).Apply(),  
	custlist : Ext.EventUrl(['SysUserLayout','Content']).Apply()  	
 }	
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */

 Ext.EQuery.TotalPage = '<?php echo $page -> _get_total_page(); ?>';
 Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.searchWork = function()
 {
	$.cookie('selected',0)	
	
	var FrmGroupLayout  = Ext.Serialize("FrmGroupLayout");
		console.log( FrmGroupLayout.getElement());
	Ext.EQuery.construct( Ext.DOM._content_page,Ext.Join([ 
			FrmGroupLayout.getElement() 
		]).object());
	Ext.EQuery.postContent();	
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.Clear = function()
 {
	Ext.Serialize("FrmGroupLayout").Clear();
	new Ext.DOM.searchWork();
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
Ext.EQuery.construct(Ext.DOM._content_page, datas )
Ext.EQuery.postContentList();

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
Ext.DOM.DisableUserLayout = function()
{
	Ext.Ajax
	({
		url : Ext.DOM.INDEX +'/SysUserLayout/SetLayout/',
		method : 'POST',
		param :{
			SetLayout : 0,
			LayoutId : Ext.Cmp('LayoutId').getValue()		
		},
		ERROR : function(fn){
			var ERR = JSON.parse(fn.target.responseText);
			if(ERR.success){
				Ext.Msg("Disable Layout").Success();
				Ext.EQuery.construct(Ext.DOM._content_page, datas )
				Ext.EQuery.postContent();
			}
			else{
				Ext.Msg("Disable Layout").Failed();
			}
		}
	}).post();
} 	
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
Ext.DOM.EnableUserLayout = function()
{
	Ext.Ajax
	({
		url : Ext.DOM.INDEX +'/SysUserLayout/SetLayout/',
		method : 'POST',
		param :{
			SetLayout : 1,
			LayoutId : Ext.Cmp('LayoutId').getValue()	
		},
		ERROR : function(fn){
			var ERR = JSON.parse(fn.target.responseText);
			if(ERR.success){
				Ext.Msg("Enable Layout").Success();
				Ext.EQuery.construct(Ext.DOM._content_page, datas )
				Ext.EQuery.postContent();
			}
			else{
				Ext.Msg("Enable Layout").Failed();
			}
		}
	}).post();
}
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 

 Ext.DOM.EditLayout = function()
{
	Ext.ShowMenu( new Array('SysUserLayout','EditUserLayout'), 
		Ext.System.view_file_name(), {
			act : 'edit-layout-user',
			LayoutId : Ext.Cmp('LayoutId').getValue()
		}	
	);
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 

 Ext.DOM.Delete = function()
{
 var LayoutId = Ext.Cmp('LayoutId').getValue();
 if( LayoutId.length == 0 ){
	Ext.Msg("Please select rows! ").Info();
	return false;
	
 }
 
 if( !Ext.Msg('Do you want to delete this row?').Confirm() ){
	 return false;
 }
 
	 Ext.Ajax
	({
		url 	: Ext.EventUrl(['SysUserLayout','DeleteLayout']).Apply(),  //Ext.DOM.INDEX +'/SysUserLayout/UpdateLayout/',
		method 	: 'POST',
		param 	: {
			LayoutId : LayoutId
		},
		ERROR : function( err ){
			Ext.Util( err ).proc(function( response ){
				if( response.success ){
					Ext.Msg("Delete Layout").Success();
					Ext.EQuery.postContent();	
				} else {
					Ext.Msg("Delete Layout").Failed();
				}	
			});
		}
	}).post();
}


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 	
 Ext.DOM.addUserLayout = function()
{
	Ext.ShowMenu( new Array('SysUserLayout','AddUserLayout'), 
		Ext.System.view_file_name(), {
			act : 'add-layout-user'
		}	
	);
}
	


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 $(document).ready(function() {
	$('#toolbars').extToolbars
	({
		extUrl    : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle  : [['Search'],['Clear'],['Enable'],['Disable'] ,['Add'],['Edit'],['Delete']],
		extMenu   : [['searchWork'],['Clear'],['EnableUserLayout'],['DisableUserLayout'],['addUserLayout'],['EditLayout'],['Delete']],
		extIcon   : [['zoom.png'],['zoom_out.png'],['accept.png'],['cancel.png'], ['add.png'],['calendar_edit.png'],['delete.png']],
		extText   : true,
		extInput  : false,
		extOption : []
	});
	$('.select').chosen();
 });
 
	
</script>

<!-- start : content -->
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-users"); ?>
  <div id="result_content_add" class="ui-widget-panel-form"> 
	<form name="FrmGroupLayout">
		<div class="ui-widget-table-compact">
			<div class="ui-widget-form-row">		
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Layput Name'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->input("layout_name", "input_text superlong", _get_exist_session('layout_name') );?></div>
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('User Group'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo("layout_user_group", "select superlong", _setCapital(UserPrivilege()), _get_exist_session('layout_user_group') );?></div>
			</div>
			
			<div class="ui-widget-form-row">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Layout Themes'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo("layout_themes", "select superlong", LayoutThemes(), _get_exist_session('layout_themes') );?></div>
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Layout Status'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell"><?php echo form()->combo("layout_status", "select superlong", Flags(), _get_exist_session('layout_status') );?></div>
			</div>
		</div>
	</form>
	</div>
	
	<div class="ui-widget-toolbars" id="toolbars"></div>
	<div class="ui-widget-panel-content" id="#panel-content"></div>
	<div class="content_table" id="ui-widget-content_table"></div>
	<div class="ui-widget-pager" id="pager"></div>
	<div class="ui-widget-component" id="ui-widget-component"></div>
</fieldset>	