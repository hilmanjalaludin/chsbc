
<?php echo javascript(); ?>

<script type="text/javascript">
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.onload= (function(){
	Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
 })()


Ext.DOM.datas ={
	keywords : '<?php echo _get_post('keywords');?>',
	order_by : '<?php echo _get_post('order_by');?>',
	type	 : '<?php echo _get_post('type');?>'
}
 
/**
 ** javscript prototype system
 ** version v.0.1
 **/

$(function()
{
	$('#toolbars').extToolbars({
		extUrl    : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle  : [['Enable'],['Disable'],['Add Group Menu'],['Edit'],['Remove Group Menu'],[]],
		extMenu   : [['enabledGroup'],['disabledGroup'],['addGroup'],['EditGroup'],['removeGroup'],['SearchGroup']],
		extIcon   : [['accept.png'],['cancel.png'],['add.png'],['application_edit.png'],['cross.png'],['zoom.png']],
		extText   : true,
		extInput  : true,
		extOption : [{
					render  : 5,
					type 	: 'text',
					name 	: 'keywords',
					id	 	: 'keywords',
					value	: Ext.DOM.datas.keywords
				}]
	});
});

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 


/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.EQuery.TotalPage   = '<?php echo $page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';
		
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 

Ext.DOM.navigation =  {
	custnav : Ext.DOM.INDEX+'/SysMenuGroup/index', 
	custlist : Ext.DOM.INDEX+'/SysMenuGroup/content', 
}
		
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.EQuery.construct(Ext.DOM.navigation,Ext.DOM.datas)
Ext.EQuery.postContentList();


Ext.DOM.SearchGroup = function()
{
	Ext.EQuery.construct(Ext.DOM.navigation,{
		keywords : Ext.Cmp('keywords').getValue(),
		order_by : Ext.DOM.datas.order_by,
		type	 : Ext.DOM.datas.type
	});
	
	Ext.EQuery.postContent();
	
}
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 		
Ext.DOM.enabledGroup = function()
{
	var GroupId = Ext.Cmp('chk_menu').getChecked();
	if( GroupId!='') {
		Ext.Ajax({
			url		: Ext.DOM.INDEX+'/SysMenuGroup/EnableGroup',
			method  : 'POST',
			param 	: { MenuGroupId : GroupId },
			ERROR	: function(e) {
				var ERROR = JSON.parse( e.target.responseText );
				if( ERROR.success ){
					alert('Success, Enable Group Menu');
					Ext.EQuery.postContent();
				}
				else{
					alert('Failed,  Enable Group Menu');
				}
			}
		}).post();
	}
	else { 
		alert('Please select rows..!'); 
		return false; 
	}
}
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 		
Ext.DOM.disabledGroup = function(){
 var GroupId = Ext.Cmp('chk_menu').getChecked();
	if( GroupId!='') {
		Ext.Ajax({
			url		: Ext.DOM.INDEX+'/SysMenuGroup/DisableGroup',
			method  : 'POST',
			param 	: { MenuGroupId : GroupId },
			ERROR	: function(e) {
				var ERROR = JSON.parse( e.target.responseText );
				if( ERROR.success ){
					alert('Success, Disabled Group Menu');
					Ext.EQuery.postContent();
				}
				else{
					alert('Failed, Disabled Group Menu');
				}
			}
		}).post();
	}
	else { 
		alert('Please select rows..!'); 
		return false; 
	}
}
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 		
Ext.DOM.removeGroup = function()
{
 var MenuGroupId = Ext.Cmp('chk_menu').getValue();
 if( MenuGroupId!='')
  {
		if(confirm('Do you want to remove this rows ?'))
		{
			Ext.Ajax({
				url 	: Ext.DOM.INDEX+'/SysMenuGroup/DeleteMenuGroup',
				method 	: 'POST',
				param 	: { MenuGroupId : MenuGroupId },
				ERROR 	: function(e){
					var ERROR = JSON.parse(e.target.responseText);
					if( ERROR.success ){
						alert('Success, Remove Group Menu');
						Ext.EQuery.postContent();
					}
					else{
						alert('Failed, Remove Group Menu'); return;
					}
				}
			}).post();
		}
	}
	else {
		alert('Please select rows..!'); return;
	}	
}

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 		
Ext.DOM.EditGroup  = function(){
	var GroupId = Ext.Cmp('chk_menu').getValue();
	if( GroupId.length==1)
	{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX+'/SysMenuGroup/EditForm',
			method 	: 'GET',
			param 	: {
				GroupId : GroupId,
				time : Ext.Date().getDuration()
			}	
		}).load('panel-content');
	}
	else{
		Ext.Msg("Please select a rows !").Info();
	}
}
		
/**
 ** javscript prototype system
 ** version v.0.1
 **/
		
Ext.DOM.ShowGroupMenu = function(options)
{
	if( options.checked ) {
		Ext.Ajax({
			url		: Ext.DOM.INDEX+'/SysMenuGroup/ShowMenuGroup',
			method 	: 'POST',
			param 	: { 
				privileges : options.value
			}
		}).load('showOnActive');
	}
	else{
		Ext.Cmp('showOnActive').setText('');
	}
}
		
/**
 ** javscript prototype system
 ** version v.0.1
 **/

Ext.DOM.AssignGroupMenu = function()
{
	var MenuGroupList = Ext.Cmp('chk_menu').getChecked();
	var Privileges = Ext.Cmp('privileges').getChecked();
	if( MenuGroupList!='' )
	{
		Ext.Ajax({
			url	: Ext.DOM.INDEX+'/SysMenuGroup/AssignMenuGroup',
			method : 'POST',
			param : {
				Privileges : Privileges,
				GroupMenu : MenuGroupList
			},
			ERROR : function(e){
				var ERROR = JSON.parse(e.target.responseText);
				if( ERROR.success ) {
					alert("Sucess, Assign Group Menu !");
					Ext.Ajax({
						url		: Ext.DOM.INDEX+'/SysMenuGroup/ShowMenuGroup',
						method 	: 'POST',
						param 	: { 
							privileges : Privileges
						}
					}).load('showOnActive');
				}
				else{
					alert("Failed, Assign Group Menu !");
				}
			}
		}).post();
	}
}
		
/**
 ** javscript prototype system
 ** version v.0.1
 **/

Ext.DOM.RemoveGroupMenu = function()
{
	var Privileges = Ext.Cmp('privileges').getChecked();
	var GroupMenu = Ext.Cmp('group_menu').getChecked();
	if( (Privileges!='') && (GroupMenu!='') )
	{
		Ext.Ajax({
			url	: Ext.DOM.INDEX+'/SysMenuGroup/RemoveMenuGroup',
			method : 'POST',
			param : {
				Privileges : Privileges,
				GroupMenu : GroupMenu
			},
			ERROR : function(e){
				var ERROR = JSON.parse(e.target.responseText);
				if( ERROR.success ) {
					alert("Sucess, Remove Group Menu !");
					Ext.Ajax({
						url		: Ext.DOM.INDEX+'/SysMenuGroup/ShowMenuGroup',
						method 	: 'POST',
						param 	: { 
							privileges : Privileges
						}
					}).load('showOnActive');
				}
				else{
					alert("Failed, Remove Group Menu !");
				}
			}
		}).post();
		
		//alert(Privileges+"==>"+GroupMenu);
	}	
}
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.SaveNewGroupMenu = function()
{
	if( Ext.Cmp('GroupName').empty()){
		Ext.Msg("Group Name Is empty").Info();
		Ext.Msg("GroupName").setFocus();
	}
	else if(Ext.Cmp('GroupDesc').empty()){
		Ext.Msg("Group Description Is empty").Info();
		Ext.Msg("GroupDesc").setFocus();
	}
	else{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX+'/SysMenuGroup/SaveNewGroup',
			method 	: 'GET',
			param 	: Ext.Join([Ext.Serialize('frmAddGroupMenu').getElement()]).object(),
			ERROR	: function(e){
				Ext.Util(e).proc(function(save){
					if(save.success){
						Ext.Msg("Save New Group !").Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg("Save New Group !").Failed();
					}
				});
			}
		}).post();
	}
}
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.UpdateNewGroupMenu = function()
{
	if( Ext.Cmp('GroupName').empty()){
		Ext.Msg("Group Name Is empty").Info();
		Ext.Msg("GroupName").setFocus();
	}
	else if(Ext.Cmp('GroupDesc').empty()){
		Ext.Msg("Group Description Is empty").Info();
		Ext.Msg("GroupDesc").setFocus();
	}
	else{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX+'/SysMenuGroup/UpdateGroup',
			method 	: 'GET',
			param 	: Ext.Join([Ext.Serialize('frmEditGroupMenu').getElement()]).object(),
			ERROR	: function(e){
				Ext.Util(e).proc(function(save){
					if(save.success){
						Ext.Msg("Update New Group !").Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg("Update New Group !").Failed();
					}
				});
			}
		}).post();
	}
}



		
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.addGroup = function(){
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX+'/SysMenuGroup/ShowForm',
		method 	: 'GET',
		param 	: {
			time : Ext.Date().getDuration()
		}	
	}).load('panel-content');
}

</script>
<fieldset class="corner">
	<legend class="icon-menulist">&nbsp;&nbsp;<span id="legend_title"></span></legend>
	<div id="toolbars"></div>
	<div id="panel-content"></div>
	<div class="content_table"></div>
	<div id="pager"></div>
	<div class="box-shadow" style="background-color:#FFFFFF;margin-top:5px;" >
	<!-- start : show -->
		<table>
			<tr>
				<td valign="top">
					<fieldset style="background-color:#FFFFFF;border:1px solid #dddddd;margin:5px;padding:8px;">
					<legend> Privileges </legend> 	
						<?php echo form()-> listCombo('privileges','style',$privileges, $_value='', array('change'=>'ShowGroupMenu(this);'), array());?>
						<input type="button" class="assign button" value="Assign" onclick="Ext.DOM.AssignGroupMenu();">
					</fieldset>
				</td>
				<td valign="top"> 
					<fieldset style="background-color:#FFFFFF;border:1px solid #dddddd;margin:5px;padding:8px;">
					<legend> Group Menu </legend> 
						<span id="showOnActive"> <?php echo form()-> listCombo('group_menu','',$menugroup, null, NULL, array());?> </span>
						<input type="button" class="remove button" value="&nbsp;Remove" onclick="Ext.DOM.RemoveGroupMenu();">
					</fieldset>
				</td>
			</tr>	
		</table>	
	<!-- stop : show -->
	</div>
	<div id="ExtDialogMenu"></div>
</fieldset>

	