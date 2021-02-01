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
	user_active 	: "<?php echo _get_exist_session('user_active');?>",
	user_address 	: "<?php echo _get_exist_session('user_address');?>",
	user_id 		: "<?php echo _get_exist_session('user_id');?>",
	user_login 		: "<?php echo _get_exist_session('user_login');?>",
	user_name 		: "<?php echo _get_exist_session('user_name');?>",
	user_privileges : "<?php echo _get_exist_session('user_privileges');?>",
	order_by 		: "<?php echo _get_exist_session('order_by');?>",
	type	 		: "<?php echo _get_exist_session('type');?>"
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
 
Ext.DOM.content_page = {
	custnav  : Ext.DOM.INDEX+'/SysUser/index',
	custlist : Ext.DOM.INDEX+'/SysUser/Content'			
 }	

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
Ext.EQuery.construct(Ext.DOM.content_page, Ext.DOM.datas);
Ext.EQuery.postContentList();



// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.searchAgent = function()
{
	$.cookie('selected',0)	
	var FrmUserRegistration = Ext.Serialize('FrmUserRegistration');
	Ext.EQuery.construct( Ext.DOM.content_page, Ext.Join([
		FrmUserRegistration.getElement()
	]).object())
	
	Ext.EQuery.postContent();
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.Clear = function()
{
	Ext.Serialize('FrmUserRegistration').Clear();
	new Ext.DOM.searchAgent();
}


// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
Ext.DOM.enabledUser = function()
 {
	var UserId = Ext.Cmp('ID').getValue();
	if( UserId !='') {
		Ext.Ajax({
			url 	: Ext.DOM.INDEX+'/SysUser/enable_user',
			method 	: 'POST',
			param 	: { UserId : UserId },
			ERROR	: function(e) {
				var ERROR = JSON.parse(e.target.responseText);
				if( ERROR.success ) {
					alert('Success, Enable User');
					new Ext.DOM.searchAgent();
					
				}
				else{
					alert('Failed, Enable User');
				}
			}	
		}).post();
	}	
	else{
		alert('Please select rows..!'); return false;
	}
}

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.resetIP = function()
 {
	var UserId = Ext.Cmp('ID').getValue();
	if( UserId !='')
	{
	  if( confirm('Do you want to reset user login ?') ) 
	  {		
		Ext.Ajax({
			url 	: Ext.DOM.INDEX+'/SysUser/reset_ip',
			method 	: 'POST',
			param 	: { UserId : UserId },
			ERROR	: function(e) 
			{
				var ERROR = JSON.parse(e.target.responseText);
				if( ERROR.success ) {
					alert('Success, Reset User Login ');
					new Ext.DOM.searchAgent();
				}
				else{
					alert('Failed, Reset Password User ');
				}
			}
			
		}).post();
	   }	
	}
	else{
		alert('Please select rows..!'); return false;
	}
}
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.extRegiter = function()
{
	var UserId = Ext.Cmp('ID').getValue();
	
	if( UserId !='')
	{
		if( confirm('Do you want to User Register In PBX ?')  ) 
		{	
			Ext.Cmp('load_images_id').setText("<span style='color:red;'><img src='"+Ext.DOM.LIBRARY+"/gambar/loading.gif' height='15'> Please wait...</span>");
			Ext.Ajax({
				url 	: Ext.DOM.INDEX+'/SysUser/register_pbx',
				method 	: 'POST',
				param 	: { UserId : UserId },
				ERROR	: function(e) 
				{
					var ERROR = JSON.parse(e.target.responseText);
					if( ERROR.success ) {
						Ext.Cmp('load_images_id').setText('');
					
						var _error_html = ''
						for( var i in ERROR.error ){
							_error_html += ERROR.error[i].username+" ,__"+ERROR.error[i].status +" \n";
						}
						alert(_error_html);
					}
					else{
						alert('Failed, Reset Password User ');
					}
				}
				
			}).post();
		}	
	}
	 else{
		alert('Please select rows..!'); return false;
    }
}
		
/** 
 ** default generator scripts
 ** javscript prototype system
 ** version v.0.1
 **/
 
 Ext.DOM.resetPassword = function()
 {
	var UserId = Ext.Cmp('ID').getValue();
	if( UserId !='')
	{
	  if( confirm('Do you want to reset user password to ( 1234 ) ?') ) 
	  {		
		Ext.Ajax({
			url 	: Ext.DOM.INDEX+'/SysUser/reset_password',
			method 	: 'POST',
			param 	: { UserId : UserId },
			ERROR	: function(e) 
			{
				var ERROR = JSON.parse(e.target.responseText);
				if( ERROR.success ) {
					alert('Success, Reset Password User ');
					new Ext.DOM.searchAgent();
				}
				else{
					alert('Failed, Reset Password User ');
				}
			}
			
		}).post();
	   }	
	}
	else{
		alert('Please select rows..!'); return false;
	}
}	
	
/** 
 ** default generator scripts
 ** javscript prototype system
 ** version v.0.1
 **/
Ext.DOM.disabledUser = function()
 {
	var UserId = Ext.Cmp('ID').getValue();
	if( UserId !='')
	{
		Ext.Ajax({
			url 	: Ext.DOM.INDEX+'/SysUser/disable_user',
			method 	: 'POST',
			param 	: { UserId : UserId },
			ERROR	: function(e) {
				var ERROR = JSON.parse(e.target.responseText);
				if( ERROR.success ) {
					alert('Success, Disable User');
					new Ext.DOM.searchAgent();
				}
				else{
					alert('Failed, Disable User');
				}
			}	
		}).post();
	}	
	else{
		alert('Please select rows..!'); return false;
	}
}
	
/** 
 ** default generator scripts
 ** javscript prototype system
 ** version v.0.1
 **/
 
 Ext.DOM.removeUser = function()
{
	var UserId = Ext.Cmp('ID').getValue();
	if( UserId !='')
	{
	  if( confirm('Do you want to remove this user ?') ) 
	  {	
		Ext.Ajax({
			url 	: Ext.DOM.INDEX+'/SysUser/remove_user',
			method 	: 'POST',
			param 	: { UserId : UserId },
			ERROR	: function(e) {
				var ERROR = JSON.parse(e.target.responseText);
				try{
					if( ERROR.success ) {
						alert('Success, Remove User');
						new Ext.DOM.searchAgent();
					}
					else{
						alert('Failed, Remove User, \nERROR : '+ ERROR.error );
					}
				}
				catch(e){
					alert(e);
				}
			}	
		}).post();
	  }	
	}	
	else{
		alert('Please select rows..!'); return false;
	}
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.UserCapacity = function() {
	return Ext.Ajax ({  url : Ext.EventUrl(['SysUser','UserCapacity']).Apply(),  method  : 'POST', param   : {
			act : Ext.Date().getDuration()
		}
	}).json();
 }
 
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 Ext.DOM.addUser = function() 
{
  var UserCapacity = Ext.DOM.UserCapacity();
  if( !UserCapacity ){
	Ext.Msg("Over load User Capacity!").Info();
	return false;
  }
	
	Ext.ShowMenu(new Array('SysUser','tpl_add_user'), 
	Ext.System.view_file_name(),{
		time : 	Ext.Date().getDuration()
	});
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
 
 Ext.DOM.changeGroup = function() 
{
 var UserId = Ext.Cmp('ID').getValue();
 if(UserId.length == 1 ) 
 {
	Ext.ShowMenu(new Array('SysUser','tpl_edit_user'), 
	Ext.System.view_file_name(),{
		time 	: Ext.Date().getDuration(),
		UserId  : UserId, 
	});
 } else {
	Ext.Msg('Please select a rows !').Info();
	return false;
 }
 
}

Ext.DOM.changePrevileges=function(e) {
	var ADM = "1", MGR = "2", SPV = "3", TL = "4";
	var hdl = $(e).val();
	var previleges 	   = "";
	var previleges_all = ['team_leader','user_spv','user_mgr','account_manager','user_admin'];
	
	// ADM
	if(  hdl == ADM ) {
		previleges = "";
		previleges = ['team_leader','user_spv','user_mgr','account_manager'];
		enableField(previleges_all);
		disableField(previleges); return false;
	}
	// MGR
	if(  hdl == MGR ) {
		previleges = "";
		previleges = ['team_leader','user_spv','user_mgr','account_manager'];
		enableField(previleges_all);
		disableField(previleges); return false;
	}
	// SPV
	if(  hdl == SPV ) {
		previleges = "";
		previleges = ['team_leader','account_manager'];
		enableField(previleges_all);
		disableField(previleges); return false;
	}
	// TL
	if(  hdl == TL ) {
		previleges = "";
		previleges = [''];
		enableField(previleges_all);
		disableField(previleges); return false;
	}
	enableField(previleges_all);
}

Ext.DOM.disableField=function(field) {
	$.each(field, function( index, value ) {
  		Ext.Cmp(value).disabled(true);
	});
}

Ext.DOM.enableField=function(field) {
	$.each(field, function( index, value ) {
		Ext.Cmp(value).disabled(false);
	});
}	
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
 
$(document).ready( function(){
	$('#toolbars').extToolbars
	({
		extUrl  : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle:[['Search'],['Clear'],['Enable'],['Disable'],['Add'],['Remove'],['Edit'],['Reset Password'],['Reset IP'],['PBX Register']],
		extMenu :[['searchAgent'],['Clear'],['enabledUser'],['disabledUser'],['addUser'],['removeUser'],['changeGroup'],['resetPassword'],['resetIP'],['extRegiter']],
		extIcon :[['zoom.png'],['zoom_out.png'],['accept.png'],['cancel.png'],['add.png'],['cross.png'],['group_edit.png'],['page_key.png'],['connect.png'],['phone_add.png']],
		extText :true,
		extInput:true,
		extOption:[]
	});
	
	$('.select').chosen();
});
	

	
</script>
	
<!-- start : content -->
<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-users"); ?>
 <div id="result_content_add" class="ui-widget-panel-form"> 
	<form name="FrmUserRegistration">
	<div class="ui-widget-table-compact">
		
		<div class="ui-widget-form-row">
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('User ID'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("user_id", "input_text long", _get_exist_session('user_id') );?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Privileges'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("user_privileges", "select superlong", _setCapital(UserPrivilege()), _get_exist_session('user_privileges') );?></div>
			
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('IP Address'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("user_address", "input_text superlong",_get_exist_session('user_address') );?></div>
		
		
		</div>
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('User Name'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->input("user_name", "input_text long", _get_exist_session('user_name') );?></div>
			
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('User Active'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("user_active", "select superlong", Flags(), _get_exist_session('user_active') );?></div>
		
			<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Login Status'));?></div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo("user_login", "select superlong", Flags(), _get_exist_session('user_login') );?></div>
		
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
<!--
	<fieldset class="corner" style="background-color:white;">
	<legend class="icon-userapplication">&nbsp;&nbsp;<span id="legend_title"></span></legend>
		<div id="toolbars" class="toolbars"></div>
		<div id="panel-content" style="margin:4px;"></div>
		<div class="content_table"></div>
		<div id="pager"></div>
		<div id="UserTpl"></div>
	</fieldset>	
	-->
<!-- END OF FILE  -->
<!-- location : // ../application/layout/view_user_nav/welcome.php -->
	