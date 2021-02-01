<?php echo javascript(); ?>
<script type="text/javascript">
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 Ext.DOM.onload= (function(){
	Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
 })()
 	
	
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.datas = {
		UserId	 : "<?php echo $this -> URI -> _get_post('UserId');?>",
		order_by : "<?php echo $this -> URI -> _get_post('order_by');?>",
		type	 : "<?php echo $this -> URI -> _get_post('type');?>",
		param	 : "<?php echo $this -> URI -> _get_post('param');?>",
	}
 	
$('#v_cmp_user').datepicker();
	
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
$(function(){
	$('#toolbars').extToolbars({
		extUrl  : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle:[['Enable'],['Disable'],['Add Agent'],['Remove'],['Edit Agent'],['Reset Password'],['Reset IP'],['PBX Register'],['Search'],[]],
		extMenu :[['enabledUser'],['disabledUser'],['addUser'],['removeUser'],['changeGroup'],['resetPassword'],['resetIP'],['extRegiter'],['searchAgent'],[]],
		extIcon :[['accept.png'],['cancel.png'],['add.png'],['cross.png'],['group_edit.png'],['page_key.png'],['connect.png'],['phone_add.png'],['zoom.png'],[]],
		extText :true,
		extInput:true,
		extOption:[{
						render	: 8,
						type	: 'text',
						id		: 'v_cmp_user', 	
						name	: 'v_cmp_user',
						value	: Ext.DOM.datas.UserId,
						width	: 120
					},{
					  render:9,type:'label',label:'..',id:'load_images_id',name:'load_images_id'		
					}]
	});
	
	
});
	
	var load_images_id = Ext.Cmp('load_images_id');

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 	
 Ext.EQuery.TotalPage = '<?php echo $page -> _get_total_page(); ?>';
 Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';


/**
 ** javscript prototype system
 ** version v.0.1
 **/
 var _content_page = {
	custnav  : Ext.DOM.INDEX+'/SysUser/index',
	custlist : Ext.DOM.INDEX+'/SysUser/Content'			
 }	
	
Ext.EQuery.construct(_content_page, Ext.DOM.datas);
Ext.EQuery.postContentList();

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.enabledUser = function()
 {
	var UserId = Ext.Cmp('chk_menu').getValue();
	if( UserId !='') {
		Ext.Ajax({
			url 	: Ext.DOM.INDEX+'/SysUser/enable_user',
			method 	: 'POST',
			param 	: { UserId : UserId },
			ERROR	: function(e) {
				var ERROR = JSON.parse(e.target.responseText);
				if( ERROR.success ) {
					alert('Success, Enable User');
					Ext.EQuery.construct(_content_page,'')
					Ext.EQuery.postContent();
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
	var UserId = Ext.Cmp('chk_menu').getValue();
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
					Ext.EQuery.construct(_content_page,'')
					Ext.EQuery.postContent();
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
	var UserId = Ext.Cmp('chk_menu').getValue();
	
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
	var UserId = Ext.Cmp('chk_menu').getValue();
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
					Ext.EQuery.construct(_content_page,'')
					Ext.EQuery.postContent();
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
	var UserId = Ext.Cmp('chk_menu').getValue();
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
					Ext.EQuery.construct(_content_page,'')
					Ext.EQuery.postContent();
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
	var UserId = Ext.Cmp('chk_menu').getValue();
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
						Ext.EQuery.construct(_content_page,'')
						Ext.EQuery.postContent();
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
		
/** 
 ** default generator scripts
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.SaveUser = function()
{
 var userid     = Ext.Cmp('textUserid').getValue();
 var fullname  = Ext.Cmp('textFullname').getValue();
 var user_mgr  = Ext.Cmp('user_mgr').getValue();
 var user_spv  = Ext.Cmp('user_spv').getValue();
 var profile   = Ext.Cmp('user_profile').getValue();
 var cc_group  = Ext.Cmp('cc_group').getValue();
 var user_telphone = Ext.Cmp('user_telphone').getValue();
 var textAgentcode = Ext.Cmp('textAgentcode').getValue();
 var team_leader  = Ext.Cmp('team_leader').getValue();
 
	
 if( ( Ext.Cmp('textUserid').empty()!=true ) 
	&& ( Ext.Cmp('textFullname').empty()!=true ) 
	&& ( Ext.Cmp('user_profile').empty()!=true ) )
 {
 
  // cek user capability 
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX+'/SysUser/UserCapacity/',
		method 	: 'GET',
		param 	:{ act : Ext.Date().getDuration() },
		ERROR 	: function(e){
			Ext.Util(e).proc(function(Capacity){
				Ext.Ajax
				({
					url 	: Ext.DOM.INDEX+'/SysUser/add_user',
					method  : 'POST',
					param 	: {
						userid			: Ext.Cmp('textUserid').getValue(),
						fullname 		: Ext.Cmp('textFullname').getValue(),
						user_mgr 		: Ext.Cmp('user_mgr').getValue(),
						user_spv 		: Ext.Cmp('user_spv').getValue(),
						profile 		: Ext.Cmp('user_profile').getValue(),
						cc_group 		: Ext.Cmp('cc_group').getValue(),
						user_admin 		: Ext.Cmp('user_admin').getValue(),
						user_leader 	: Ext.Cmp('team_leader').getValue(),
						user_telphone 	: Ext.Cmp('user_telphone').getValue(),
						textAgentcode 	: Ext.Cmp('textAgentcode').getValue()
					},
					ERROR : function(e){
						var ERROR = JSON.parse(e.target.responseText);
						if( ERROR.success ){
							alert('Success, Add User ');
							Ext.EQuery.construct( _content_page,'' )
							Ext.EQuery.postContent();
						}	
						else{ 
							alert('Failed, Add User , \nERROR : '+ ERROR.error );
							return false;
						}		
					}
				}).post();
			});
		}
	}).post();		

 }
	else{
		alert("Input Not Complete..!");
		return false;
}

} 

/** 
 ** default generator scripts
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.addUser = function() 
{
	Ext.Ajax({
		url : Ext.DOM.INDEX+'/SysUser/UserCapacity/',
		method : 'GET',
		param :{
			act : Ext.Date().getDuration()
		},
		ERROR : function(e){
			Ext.Util(e).proc(function(Capacity){
				if( Capacity.success )
				{
					Ext.Ajax
					({
						url 	: Ext.DOM.INDEX+'/SysUser/tpl_add_user',
						method 	: 'GET',
						param 	: {
							time : Ext.Date().getDuration()
						}
					}).load("panel-content");
				}
				else{
					Ext.Msg("User Capacity is Limited").Info();
				}
			});
		}
		
	}).post();
	
	
}

/** 
 ** default generator scripts
 ** javscript prototype system
 ** version v.0.1
 **/
 
 Ext.DOM.UpdateUser=function()
 {
	if( (Ext.Cmp('UserId').empty()!=true) 
		&& ( Ext.Cmp('textFullname').empty()!=true) ) 
	{
		Ext.Ajax({
			url 	: Ext.DOM.INDEX+'/SysUser/update_user',
			method  : 'POST',
			param 	: {
				hiddenUserId : Ext.Cmp('UserId').getValue(),
				userid : Ext.Cmp('textUserid').getValue(),
				mgrid : Ext.Cmp('user_mgr').getValue(),
				spvid : Ext.Cmp('user_spv').getValue(),
				fullname : Ext.Cmp('textFullname').getValue(),
				privilges : Ext.Cmp('user_profile').getValue(),
				user_admin : Ext.Cmp('user_admin').getValue(),
				user_leader : Ext.Cmp('team_leader').getValue(),
				cc_group : Ext.Cmp('cc_group').getValue(),
				user_telphone : Ext.Cmp('user_telphone').getValue(),
				textAgentcode : Ext.Cmp('textAgentcode').getValue()
			},
			ERROR : function(e){
				var ERROR = JSON.parse(e.target.responseText);
				if( ERROR.success){
					alert('Success, Edit User');
					Ext.EQuery.construct(_content_page,'')
					Ext.EQuery.postContent();
				}	
				else{ 
					alert('Failed, Edit User , \nERROR : '+ ERROR.error );
					return false;
				}		
			}
		}).post();
	}else{
		Ext.Msg('Input Not Complete..!').Error(); 
		return;
	}	
 }
 
/** 
 ** default generator scripts
 ** javscript prototype system
 ** version v.0.1
 **/
 
var changeGroup = function() {

 var UserId = Ext.Cmp('chk_menu').getValue();
 if( UserId !='') 
 {
	Ext.Ajax({
		url 	: Ext.DOM.INDEX+'/SysUser/tpl_edit_user/',
		method : 'GET',
		param :{
			UserId : UserId,
			time : Ext.Date().getDuration()
		}
	}).load("panel-content");
	
  }
  else{ 
	Ext.Msg('Please select a rows !').Error(); 
	return false;
  }
  
}

/** 
 ** default generator scripts
 ** javscript prototype system
 ** version v.0.1
 **/
 
 Ext.DOM.searchAgent = function()
 {
	Ext.EQuery.construct( _content_page, {
		UserId : Ext.Cmp('v_cmp_user').getValue()
	})
	Ext.EQuery.postContent();
}

</script>
	<fieldset class="corner" style="background-color:white;">
	<legend class="icon-userapplication">&nbsp;&nbsp;<span id="legend_title"></span></legend>
		<div id="toolbars" class="toolbars"></div>
		<div id="panel-content" style="margin:4px;"></div>
		<div class="content_table"></div>
		<div id="pager"></div>
		<div id="UserTpl"></div>
	</fieldset>	
	
<!-- END OF FILE  -->
<!-- location : // ../application/layout/view_user_nav/welcome.php -->
	