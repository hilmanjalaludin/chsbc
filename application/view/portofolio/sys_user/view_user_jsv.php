<script>
// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
Ext.DOM.RoleBack = function()
{
	if( Ext.Msg('Are you sure ?').Confirm() )
	{
		var is_home = Ext.Cmp('is_home').getValue();
		if( is_home == 1 ){
			new Ext.BackHome();
		} else {
			new Ext.ShowMenu("SysUser", Ext.System.view_file_name());	
		}
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
 
 Ext.DOM.Update=function()
{
	
 var frmEditUser = Ext.Serialize('frmEditUser'),
     frmAddCond = frmEditUser.Required( new Array (
		'userid','fullname',
		'textAgentcode','password', 
		'repassword','profile',
		'user_active'
	));
 
 if( !frmAddCond )
 { 
	Ext.Msg('form input not complete!').Info();
	return false; }	 
 
  if( Ext.Cmp('password').getValue() != Ext.Cmp('repassword').getValue() )
 {
	Ext.Msg('check your password!').Info();
	return false; }


// ------------- save data user ----------------------------------------------
	
    Ext.Ajax
   ({
	   url 	 	: Ext.EventUrl(['SysUser','update_user']).Apply(),
	   method 	: 'POST',
	   param  	: Ext.Join(new Array(
					frmEditUser.getElement() 
				 )).object(),
				 
	   ERROR	: function (e) 
	   {
		  Ext.Util(e).proc(function( response )
		  {
			  if( response.success ) {
				  Ext.Msg("Update User").Success();
			  } 
			  else {
				Ext.Msg("Update User").Failed();
				return false;
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
 
 Ext.DOM.SaveUser = function()
{
	
 var frmAddUser = Ext.Serialize('frmAddUser'),
     frmAddCond = frmAddUser.Required( new Array (
		'userid','fullname','textAgentcode',
		'password', 'repassword','profile',
		'user_telphone','user_active',
		'cc_group'
	 ));
 
 if( !frmAddCond )
 { 
	Ext.Msg('form input not complete!').Info();
	return false; }	 
 
  if( Ext.Cmp('password').getValue() != Ext.Cmp('repassword').getValue() )
 {
	Ext.Msg('check your password!').Info();
	return false; }


// ------------- save data user ----------------------------------------------
	
    Ext.Ajax
   ({
	   url 	 	: Ext.EventUrl(['SysUser','add_user']).Apply(),
	   method 	: 'POST',
	   param  	: Ext.Join(new Array(
					frmAddUser.getElement() 
				 )).object(),
				 
	   ERROR	: function (e) 
	   {
		  Ext.Util(e).proc(function( response )
		  {
			  if( response.success )
			  {
				  Ext.Msg("Add User").Success();
				  if( Ext.Msg('Do you want to add again ?').Confirm()  ){
					  new Ext.DOM.addUser();
				  }
			  } 
			  else {
				Ext.Msg("Add User").Failed();
				return false;
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
 
 Ext.DOM.UpdatePassword =function() 
{
  var frmChangePassword = Ext.Serialize('frmChangePassword');
  
  if( frmChangePassword.Required(['new_password','renew_password']) )	
  {
		if( Ext.Cmp('new_password').getValue().length <4 ){
		  Ext.Msg("Minimum password 4 ( four ) character").Info();
		  return false;
		}
	  
		if( Ext.Cmp('renew_password').getValue().length <4 ){
		  Ext.Msg("Minimum password 4 ( four ) character").Info();
		  return false;
		}
		
	   if( Ext.Cmp('new_password').getValue() ==  Ext.Cmp('renew_password').getValue()  )
	  {
		  if( Ext.Msg('Are you sure to change Password?').Confirm() ) 
		  {
			  Ext.Ajax
			 ({
				   url 	 	: Ext.EventUrl(['SysUser','ChangePassword']).Apply(),
				   method 	: 'POST',
				   param  	: Ext.Join([ frmChangePassword.getElement() ]).object(),
				   ERROR	: function (e) 
				   {
					  Ext.Util(e).proc(function( response )
					  {
						  if( response.success )
						  {
							  Ext.Msg("Change Password").Success();
							  if( Ext.Msg('Do you want to close from this session?').Confirm()  ){
								 Ext.BackHome();
							  }
						  } 
						  else {
							Ext.Msg("Change Password").Failed();
							return false;
						  }
					  });
				  } 	
			   }).post();   
		  }
		  return false;
	  }
	   else {
			Ext.Msg('Wrong password!').Info();
			return false;
	  }	  
  } else {
	  Ext.Msg('Input form not complete!').Info();
	  return false;
  }
}

// --------------------------------------------------------------------------------------------------------------------------
/*
 * @ package  	user searc data .
 * @ note		eweh note.
 */
$(document).ready( function()
{
  $('#ui-widget-add-campaign').mytab().tabs();
  $('#ui-widget-add-campaign').mytab().tabs("option", "selected", 0);
  $('#ui-widget-add-campaign').css({'background-color':'#FFFFFF'});
  $('#ui-widget-add-content').css({'background-color':'#FFFFFF'});
  $("#ui-widget-add-campaign").mytab().close(function(){
	  Ext.DOM.RoleBack();
  });
  
 //-------- disabled by select class --------------------
  $('.cell-disabled').each(function(){
	  $(this).attr('disabled','true');
  });
  $('.select').chosen();
});
</script>