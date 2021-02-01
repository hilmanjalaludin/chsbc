<?php echo javascript(); ?>

<script type="text/javascript">
 Ext.DOM.initUser  = 0; 

 /**
 ** javscript prototype system
 ** version v.0.1
 **/
 
 Ext.DOM.onload= (function(){
	Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
 })()
 	
/**
 ** callculation pages 
 ** render to jquery
 **/

 
 Ext.DOM.datas = {
	key_words : '<?php echo $this -> URI -> _get_post('key_words'); ?>'
 } 
 
/**
 ** callculation pages 
 ** render to jquery
 **/
 Ext.EQuery.TotalPage   = '<?php echo $page -> _get_total_page(); ?>';
 Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';

/**
 ** callculation pages 
 ** render to jquery
 **/
 
 $(function(){
	$('#toolbars').extToolbars({
		extUrl    : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle  : [['Enable Menu'],['Disable Menu'],['Edit Menu'],['Add Menu'],['Remove'],[],['Search']],
		extMenu   : [['EnableMenu'],['DisableMenu'],['EditMenu'],['AddMenu'],['DeleteMenu'],[],['Search']],
		extIcon   : [['accept.png'],['cancel.png'],['application_form_edit.png'],['add.png'],['cross.png'],[],['magnifier.png']],
		extText   : true,
		extInput  : true,
		extOption : [{
					 render	: 5,
					 type	: 'text',
					 value  : Ext.DOM.datas.key_words,
					 id		: 'keyword_data', 
					 name	: 'keyword_data',
					 width	: 160
					}]
	});
 });

/**
 ** callculation pages 
 ** render to jquery
 **/
 Ext.Cmp('keyword_data').listener({
	onKeyup : function( e ){
		if( e.keyCode == 13 )
		{
			Ext.EQuery.construct(Ext.DOM.Navigation, {
				key_words : e.target.value
			})
			Ext.EQuery.postContent();
		}
	} 
 });
 
 
/**
 ** callculation pages 
 ** render to jquery
 **/
 Ext.DOM.Navigation = {
	custnav : Ext.DOM.INDEX+'/SysMenu/index', 
	custlist : Ext.DOM.INDEX+'/SysMenu/content', 
};
 Ext.EQuery.construct(Ext.DOM.Navigation, Ext.DOM.datas);
 Ext.EQuery.postContentList();
 
		
/**
 ** callculation pages 
 ** render to jquery
 **/
 
 // Ext.DOM.initclass = Ext.DOM.SYSTEM+'/controller/class.menu.assign.php';

 
 /**
  **
  **/
  
 Ext.DOM.Search = function(){
	Ext.EQuery.construct(Ext.DOM.Navigation, {
		key_words : Ext.Cmp('keyword_data').getValue()
	})
	Ext.EQuery.postContent();
	
 } 
 /**
 ** callculation pages 
 ** render to jquery
 **/
 
 Ext.DOM.assignMenu = function()
 {
	var menu_id = Ext.Cmp('chk_menu').getChecked();
	var assign_id =  Ext.Cmp('prefile_menu').getChecked();
	
	if( menu_id!='')
	{
		var Error = ( 
			Ext.Ajax({
				url 	: Ext.DOM.INDEX+'/SysMenu/AssignMenu',
				method 	: 'POST',
				param  	: {
					menuid	 : menu_id,
					assignto : assign_id
				}
			}).json()
		);
		if( Error.success ) { 
			alert("Success,Assign Menu");
			(assign_id?showMenu(assign_id):null);
		}
		else{
			alert("Failed, Assign Menu");
		}
	}
}
		
/**
 ** callculation pages 
 ** render to jquery
 **/
 
Ext.DOM.choiceGroup = function( menu )
{
	Ext.Ajax({
		url : Ext.DOM.INDEX+'/SysMenu/setGroupMenu',
		method : 'POST',
		param  : {
			menuid :menu
		}
	}).load("menu_"+menu);
}	
	
/**
 ** callculation pages 
 ** render to jquery
 **/	
 
Ext.DOM.UpdateMenu = function()
{
	Ext.Ajax({
		url 	: Ext.DOM.INDEX+'/SysMenu/update_menu',
		method 	: 'POST',
		param  	: {
			id 	: Ext.Cmp('menu_edit_id').getValue(),
			menu : Ext.Cmp('menu_name_edit').getValue(),
			file_name: Ext.Cmp('menu_filename_edit').getValue(),
			group_menu : Ext.Cmp('menu_group_edit').getValue(),
			el_id : Ext.Cmp('menu_id_edit').getValue(),
			OrderId : Ext.Cmp('menu_order_by').getValue()
		},
		
		ERROR : function( e ) {
			var error = JSON.parse(e.target.responseText);
				if( error.success ){
					alert("Success, Update Menu")
					Ext.EQuery.postContent();
				}	
				else{
					alert("Failed, Update Menu")
				}
		}
	}).post();
}
/**
 ** callculation pages 
 ** render to jquery
 **/
 
Ext.DOM.AddMenu = function( menu )
{
	Ext.Ajax({
		url : Ext.DOM.INDEX+'/SysMenu/addMenuTpl',
		method : 'POST',
		param  : {
			action:'menu_add_tpl'
		}
	}).load("top_header");
}
 
/**
 ** callculation pages 
 ** render to jquery
 **/
  
Ext.DOM.SaveMenu = function()
{
 if( Ext.Cmp('menu_name_add').empty()) {
	alert("Please input Menu Name !");
	Ext.Cmp('menu_name_add').setFocus();
 }
 else 
 {
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX+'/SysMenu/add_menu',
		method 	: 'POST',
		param  	: {
			group_menu : Ext.Cmp('menu_group_add').getValue(),
			menu : Ext.Cmp('menu_name_add').getValue(),
			file_name : Ext.Cmp('menu_filename_add').getValue(),
			el_id : Ext.Cmp('menu_id_add').getValue(),
			OrderId : Ext.Cmp('menu_order_by').getValue()
		},
		ERROR : function(e){
			Ext.Util(e).proc(function(save){
				if(save.success){
					Ext.Msg("Save Menu!").Success();
					Ext.EQuery.postContent();
				}
				else{
					Ext.Msg("Save Menu !").Failed();
					return false;
				}
			});
		}
	}).post();
  }
}

/**
 ** callculation pages 
 ** render to jquery
 **/
 
Ext.DOM.EditMenu = function()
{
	var menu_id = Ext.Cmp('chk_menu').getChecked();
	
	if( menu_id!='' )
	{
		if( menu_id.length==1)
		{
			Ext.Ajax({
				url 	: Ext.DOM.INDEX+'/SysMenu/EditMenuTpl',
				method  : 'POST',
				param   : {
					menu_id : menu_id
				}
			}).load('top_header');
		}
		else
			alert('Please select one rows!')
	}
	else
		alert("Please select rows!");
}

		
/** start < disabled_menu menu if click current usergroup >
 ** start < disabled_menu menu if click current usergroup >
 **	return < void >
 **/

		
/** start < disabled_menu menu if click current usergroup >
 ** start < disabled_menu menu if click current usergroup >
 **	return < void >
 **/
 
 Ext.DOM.DisableMenu = function( opt )
 {		var Error = 
				( 
					Ext.Ajax({
						url		: Ext.DOM.INDEX+'/SysMenu/DisabledMenu',
						method	: 'POST',
						param	: {
							menuid : Ext.Cmp('chk_menu').getChecked()
						}
					}).json()
				);
		
		if( Error.success)
		{ 
			alert("Success, Disable Menu");
			Ext.EQuery.postContent();
		}
		else{
			alert("Failed, Disable Menu");
		}
	}		
		
/** start < enable menu if click current usergroup >
 ** start < enable menu if click current usergroup >
 **	return < void >
 **/
 
 Ext.DOM.EnableMenu = function( opt )
 {		var Error = 
				( 
					Ext.Ajax({
						url		: Ext.DOM.INDEX+'/SysMenu/EnabledMenu',
						method	: 'POST',
						param	: {
							menuid : Ext.Cmp('chk_menu').getChecked()
						}
					}).json()
				);
		
		if( Error.success)
		{ 
			alert("Success, Enable Menu");
			Ext.EQuery.postContent();
		}
		else{
			alert("Failed, Enabled Menu");
		}
	}
/**
 ** callculation pages 
 ** render to jquery
 **/
 Ext.DOM.showMenu = function(userGroup)
 {
	Ext.Ajax({
		url 	: Ext.DOM.INDEX+'/SysMenu/showMenu',
		method 	: 'POST',
		param  	: {
			GroupId	: userGroup
		}
	}).load("menu_available");
	
}
	

/**
 ** callculation pages 
 ** render to jquery
 **/
 
Ext.DOM.DeleteMenu = function()
{
  var menu_list_id = Ext.Cmp('chk_menu').getChecked();
  
  if( menu_list_id!='')
  {
	  if( confirm('Do you want to remove this menu '))
		{
			var Error = ( Ext.Ajax({
				url		: Ext.DOM.INDEX+'/SysMenu/DeleteMenu',
				method	: 'POST',
				param	: {
					menuid : menu_list_id
				}
			}).json() );
			
			if( Error.success){
				alert("Success, Remove Menu ");
				Ext.EQuery.postContent();
			}
			else{
				alert("Failed, Remove Menu ");
				return false;
			}
		}
	}
	else
		alert("Please select a rows !")
}
			
/**
 ** callculation pages 
 ** render to jquery
 **/
 Ext.DOM.Remove = function()
 {
	var avail_menu = Ext.Cmp('avail_menu').getValue();
	var User  = Ext.Cmp('prefile_menu').getValue();
	var Error = ( 
		Ext.Ajax({
			url 	: Ext.DOM.INDEX+'/SysMenu/RemoveMenu',
			method 	: 'POST',
			param  	: {
				user	: User,
				menuid	: avail_menu
			}
		}).json()
	);
	
	if( Error.success )
		alert("Success, Remove Menu");
	else
		alert("Failed, Remove Menu");
	
	showMenu(User);						
}
		
/**
 ** callculation pages 
 ** render to jquery
 **/
 
 Ext.DOM.updateMenu = function(group,menu)
 {
	Ext.Ajax({
		url 	: Ext.DOM.INDEX+'/SysMenu/UpdateSelGroup',
		method 	: 'POST',
		param  	: {
			menu	: menu,
			group	: group
		}
	}).load("textm_"+menu);
	
	Ext.Cmp('menu_'+menu).setText('');
	
}

</script>
<fieldset class="corner">
	<legend class="icon-menulist">&nbsp;&nbsp;<span id="legend_title"></span></legend>
	<div id="toolbars" class="toolbars"></div>
	<div id="top_header" style="margin-top:8px;"></div>	
	<div class="content_table"></div>
	<div id="pager"></div>
	
	<fieldset id="userGroup" style="margin-left:6px;border:1px solid #ddd;margin-top:8px;">
		<legend style="color:red;font-size:12px;"> Action Option</legend>
		<table border=0>
			<tr>
				<td valign="top" ><p style="font-size:13px;">User Group</p></td>
				<td valign="top" ><div style="padding:0px;border:1px solid #dddddd;">
					<?php echo form()->listCombo('prefile_menu',null,$User,null,array('change'=>'showMenu(this.value);')); ?></div></td>
				<td valign="top"><p style="font-size:13px;">&nbsp; Menu &nbsp;</p></td>
				<td valign="top"> <div id="menu_available" style="padding:5px;border:1px solid #dddddd;"></div></td>
			</tr>
			<tr>
				<td valign="top">&nbsp;</td>
				<td colspan="2"><input type="button" class="assign button" value="Assign" onclick="Ext.DOM.assignMenu();"></td>
				<td><input type="button" class="remove button" value="&nbsp;Remove" onclick="Ext.DOM.Remove();"></td>
			</tr>	
		</table>
	</fieldset>	
	</fieldset>