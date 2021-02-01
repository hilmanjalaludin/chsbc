<?php echo javascript(); ?>
<script type="text/javascript">
/*
 ** javscript prototype system
 ** version v.0.1
 */
 
Ext.DOM.onload = (function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 })();
 
/*
 ** javscript prototype system
 ** version v.0.1
 */
		
Ext.DOM.datas = { 
	script_file_name 	 : "<?php echo _get_exist_session('script_file_name'); ?>",
	script_product_id	 : "<?php echo _get_exist_session('script_product_id'); ?>",
	script_product_name	 : "<?php echo _get_exist_session('script_product_name'); ?>",
	script_product_title : "<?php echo _get_exist_session('script_product_title'); ?>",
	script_status		 : "<?php echo _get_exist_session('script_status'); ?>",
	script_user_id		 : "<?php echo _get_exist_session('script_user_id'); ?>",
	order_by 			 : "<?php echo _get_exist_session('order_by'); ?>",
	type 	 			 : "<?php echo _get_exist_session('type');?>",
}
 

Ext.EQuery.TotalPage   = <?php echo (INT)$page -> _get_total_page(); ?>;
Ext.EQuery.TotalRecord = <?php echo (INT)$page -> _get_total_record(); ?>;
	
//---------------------------------------------------------------------------------------
/*
 * @ package 		Search function 
 */
 
 
Ext.DOM.navigation = {
	custnav	 : Ext.DOM.INDEX +'/SetProductScript/index/',
	custlist : Ext.DOM.INDEX +'/SetProductScript/Content/',
}
		
//---------------------------------------------------------------------------------------
/*
 * @ package 		Search function 
 */
 
 

Ext.EQuery.construct(Ext.DOM.navigation, Ext.DOM.datas);
Ext.EQuery.postContentList();


//---------------------------------------------------------------------------------------
/*
 * @ package 		Search function 
 */
 
 
 Ext.DOM.Search = function()
{
	
var frmProductScript = Ext.Serialize('frmProductScript');
	$.cookie("selected", 0);
	Ext.EQuery.construct(Ext.DOM.navigation, 
	Ext.Join([frmProductScript.getElement()]).object() );
    Ext.EQuery.postContent();
}


//---------------------------------------------------------------------------------------
/*
 * @ package 		Search function 
 */
 
 Ext.DOM.Clear = function()
{
	Ext.Serialize('frmProductScript').Clear();
	new  Ext.DOM.Search();
} 
 

//---------------------------------------------------------------------------------------
/*
 * @ package 		Search function 
 */
 

 Ext.DOM.AddScript = function()
{
	Ext.ShowMenu(new Array("SetProductScript","AddScript"), 
		Ext.System.view_file_name(),{
			time : Ext.Date().getDuration()
	});
}


//---------------------------------------------------------------------------------------
/*
 * @ package 		Search function 
 */
 

Ext.DOM.ShowWindowScript = function()
{
 var ScriptId = Ext.Cmp('ScriptId').getValue();
 
 if( ScriptId.length == 0 || ScriptId.length >1  ){
	Ext.Msg("Please select a row ").Info();
	return false;
 }
	//console.log(ScriptId);
// ------------------- get data script --------------------

	var WindowScript = new Ext.Window 
	({
			url     : Ext.EventUrl(['SetProductScript','ShowProductScript']).Apply(), 
			name    : 'WinProduct',
			height  : ($(window).innerHeight()),
			width   : ($(window).innerWidth() - ( $(window).innerWidth()/2 )),
			left    : ($(window).innerWidth()/2),
			top	    : ($(window).innerHeight()/2),
			param   : {
				ScriptId : Ext.BASE64.encode(ScriptId.join('')),
				Time	 : Ext.Date().getDuration()
			}
		}).popup();
		
	if( ScriptId =='' ) {
		window.close();
	}
}


//Disable
		
Ext.DOM.Disable = function()
{
	var ScriptId = Ext.Cmp('ScriptId').getValue();
	if(Ext.Cmp('ScriptId').empty()!=true)
	{
		Ext.Ajax({
			url 	: Ext.DOM.INDEX+ '/SetProductScript/SetActive/',
			method 	:'POST',
			param 	: {
				Active : 0,
				ScriptId : ScriptId
			},
			ERROR : function(e){
				var ERR = JSON.parse(e.target.responseText);
				
				if( ERR.success ) {
					Ext.Msg("Disable Script").Success();
					Ext.EQuery.postContent();
				}
				else{
					Ext.Msg("Disable Script").Failed();
					return false;
				}
			}
		}).post();
	}
	else{
		Ext.Msg("Please select Rows").Error();
	}
}

//Enable
		
Ext.DOM.Enable = function()
{
	var ScriptId = Ext.Cmp('ScriptId').getValue();
	if(Ext.Cmp('ScriptId').empty()!=true)
	{
		Ext.Ajax({
			url 	: Ext.DOM.INDEX+ '/SetProductScript/SetActive/',
			method 	:'POST',
			param 	: {
				Active : 1,
				ScriptId : ScriptId
			},
			ERROR : function(e){
				var ERR = JSON.parse(e.target.responseText);
				
				if( ERR.success ) {
					Ext.Msg("Enable Script").Success();
					Ext.EQuery.postContent();
				}
				else{
					Ext.Msg("Enable Script").Failed();
					return false;
				}
			}
		}).post();
	}
	else{
		Ext.Msg("Please select Rows").Error();
	}
}


//Delete
		
Ext.DOM.Delete = function()
{
	var ScriptId = Ext.Cmp('ScriptId').getValue();
	if(Ext.Cmp('ScriptId').empty()!=true)
	{
		if( Ext.Msg("Do you want delete this rows").Confirm() )
		{
			Ext.Ajax({
				url 	: Ext.DOM.INDEX+ '/SetProductScript/Delete/',
				method 	:'POST',
				param 	: {
					ScriptId : ScriptId
				},
				ERROR : function(e){
					var ERR = JSON.parse(e.target.responseText);
					
					if( ERR.success ) {
						Ext.Msg("Delete Script").Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg("Delete Script").Failed();
						return false;
					}
				}
			}).post();
		}
	}
	else{
		Ext.Msg("Please select Rows").Error();
	}
}

/*
 ** javscript prototype system
 ** version v.0.1
 **/
 		
$(document).ready( function()
{
	$('#toolbars').extToolbars({
		extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle :[['Search'],['Clear'],['Enable'],['Disable'] ,['Add'],['Delete'],['Preview']],
		extMenu  :[['Search'],['Clear'],['Enable'],['Disable'],['AddScript'],['Delete'],['ShowWindowScript']],
		extIcon  :[['zoom.png'], ['zoom_out.png'],['accept.png'],['cancel.png'], ['add.png'],['delete.png'],['page_white_acrobat.png']],
		extText  :true,
		extInput :false,
		extOption: []
	});
	$('.select').chosen();
});
	
</script>
	
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-file-pdf-o"); ?>
	<div id="result_content_add" class="ui-widget-panel-form"> 
		<form name="frmProductScript">
			<div class="ui-widget-form-table-compact">
				<div class="ui-widget-form-row baris-1">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Campaign','Code'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell left"><?php echo form()->combo('script_product_id','select superlong',Campaign(), _get_exist_session('script_product_id'));?></div>
					
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Title'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell left"><?php echo form()->input('script_product_title','input_text superlong',_get_exist_session('script_product_title'));?></div>
					
					
					<div class="ui-widget-form-cell text_caption"><?php echo lang('Upload By');?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell left"><?php echo form()->combo('script_user_id','select superlong',AllUser(), _get_exist_session('script_user_id'));?></div>
				</div>
				
				<div class="ui-widget-form-row baris-2">
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Campaign','Name'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell text_caption left"><?php echo form()->input('script_product_name','input_text superlong',_get_exist_session('script_product_name'));?></div>
					
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('File Name'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell left"><?php echo form()->input('script_file_name','input_text superlong',_get_exist_session('script_file_name'));?></div>
					
					<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Status'));?></div>
					<div class="ui-widget-form-cell text_caption center">:</div>
					<div class="ui-widget-form-cell text_caption left"><?php echo form()->combo('script_status','select superlong',Flags(),_get_exist_session('script_status') );?></div>
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
		
	<!-- stop : content -->
	
	
	
