/*
 * User Login javascript Modul 
 *
 */
 
 Ext.DOM.IMAGE 	 = Ext.System.view_library_url();
 Ext.DOM.URL 	 = Ext.System.view_app_url();
 Ext.DOM.SYSTEM  = Ext.System.view_sytem_url();
 Ext.DOM.INDEX   = Ext.System.view_page_index();
 Ext.DOM.ENTER	 = 13;
 
$(document).ready(function(){

// --------------------------------------------------------------------------

 $(document).bind("resize", function(){
	$('body').css("height", $(window).height());
 });
 
 $('body').css("height", $(window).height());

// --------------------------------------------------------------------------

/* 
 * Modul 			Ext.DOM.UserLogin
 *
 * @param			username 
 * @param			password
 */
 
var SUCCESS_LOGIN = 1,
	READY_LOGIN  = 2,
	LOGIN_BROWSER = 3,
	EXPIRED_LOGIN = 4,
	BLOCKING_LOGIN = 5;
	
// --------------------------------------------------------------------------

/* 
 * Modul 			Ext.DOM.UserLogin
 *
 * @param			username 
 * @param			password
 */
 
 Ext.DOM.UserLogin = function()
{
 var frmLogin = Ext.Serialize("frmLogin").Required(["username","password"]);
 if( frmLogin ) 
 {
	Ext.Ajax 
	({ 
		url 	: Ext.DOM.INDEX+'/Auth/login',
		method  : 'POST',
		param   : {
			username : Ext.Cmp('username').Encrypt(),
			password : Ext.Cmp('password').Encrypt()
		},
		ERROR : function( e ){
			
			Ext.Util(e).proc(function(response)
			{
				console.log( "#RESPONE" );
				console.log( response.success );
				if( response.success==1 ){
					Ext.DOM.location = Ext.DOM.INDEX
					return true;
				} else if( response.success == READY_LOGIN ){
					Ext.Msg("\nYour account already login on ( "+ response.location + " ).\nPlease contact Your Administrator").Info();  
					return false;
				}
				else if( response.success == LOGIN_BROWSER){
					Ext.Msg("Your account already login").Info();
					return false;
				}
				else if( response.success == EXPIRED_LOGIN){
					Ext.Msg("Incorrect Username Or Password").Error();
					return false;
				}
				else {
					Ext.Msg("Incorrect Username Or Password").Error();
					return false;
				}
			});
		}
	}).post();
 }
 
}

// --------------------------------------------------------------------------

/* 
 * Modul 			Ext.DOM.UserLogin
 *
 * @param			username 
 * @param			password
 */
 
 $(window).bind("keydown", function( e ){
	if( e.keyCode == Ext.DOM.ENTER )
		return Ext.DOM.UserLogin();
	});
});