<?php 
/* 
 * E.U.I ( Enigma User Interface ) Framework 1.0.0 ( betha )
 * 
 * @ param 		: sesion
 * @ packeg  	: layout login user if not have session
 * @ author  	: razaki team
 * @ link		: http://wwww.razakitechnology.com
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 <html xmlns="http://www.w3.org/1999/xhtml">
 <head>
	<meta name="author" content="<?php echo $website['_web_author']; ?>"/>
	<meta name="version" content="<?php echo $website['_web_verion'];?>"/>
	<meta http-equiv="content-type" content="text/html;charset=iso-8859-1"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="Content-Style-Type" content="text/css"/>
	<meta http-equiv="Content-Script-Type" content="text/javascript">
	<title><?php echo $website['_web_title'];?></title>
	<link type="text/css" rel="stylesheet" href="<?php echo base_themes_style($website['_web_themes']); ?>/ui.all.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo base_layout_style();?>/styles.cores.css" />	
	<script type="text/javascript" src="<?php echo base_jquery();?>/ui/jquery-1.3.2.js?time=<?php echo time();?>"></script>    
	<script type="text/javascript" src="<?php echo base_jquery();?>/ui/jquery-ui.js?time=<?php echo time();?>"></script>
	<script type="text/javascript" src="<?php echo base_enigma();?>/cores/EUI_1.0.2_dep.js?time=<?php echo time();?>"></script>   
	<script>
/**
 ** autoload fisrt login by yuser
 ** it's recover before version
 **/
 
 
Ext.DOM.IMAGE 	= Ext.System.view_library_url();
Ext.DOM.URL 	= Ext.System.view_app_url();
Ext.DOM.SYSTEM  = Ext.System.view_sytem_url();
Ext.DOM.INDEX   = Ext.System.view_page_index();

Ext.DOM.WindowLogin  = function()
{
	if( Ext.Cmp('username').empty() ){
		alert('Error, Incorrect Username Or Password. Please try again..!');
		Ext.Cmp('username').setFocus();
	}
	else if( Ext.Cmp('password').empty() ){
		alert('Error, Incorrect Username Or Password. Please try again..!');
		Ext.Cmp('password').setFocus();
	}
	else
	{
		Ext.Ajax({ 
			url 	: Ext.DOM.INDEX+'/Auth/UpdateExpiredPassword/',
			method  : 'POST',
			param   : {
				username : Ext.Cmp('username').Encrypt(),
				old_password : Ext.Cmp('old_password').Encrypt(),
				password : Ext.Cmp('password').Encrypt()
			},
			ERROR : function( e ){
				Ext.Util(e).proc(function(response){
					if( response.success==1 ){
						Ext.DOM.location = Ext.DOM.INDEX
						return true;
					} else if( response.success==2){
						Ext.Msg("Plese input diffrent password ").Info();
						return false;
					} else if( response.success==3) {
						Ext.Msg("Password has been used . \n\rPlease use diffrent password ").Info();
						return false;
					} else {
						Ext.Msg("Update Password").Failed();
						return false;
					}
				});
			}
		}).post();
	}
}
	
/**
 ** autoload fisrt login by yuser
 ** it's recover before version
 **/
 
 Ext.DOM.focus = function() {	
	Ext.Cmp('username').setFocus(); 
 }
 
/**
 ** autoload fisrt login by yuser
 ** it's recover before version
 **/
 
 Ext.DOM.onkeypress = function( e )
 {
	var _window = e;
	if( _window.keyCode ==13){
		Ext.DOM.WindowLogin();
	}
	else if( _window.keyCode==8 ){
		return 0;
	}
	else if( _window.keyCode==27 ){
		Ext.DOM.location= Ext.DOM.location.href
	}
	else
		return;
}
	
/**
 ** autoload fisrt login by yuser
 ** it's recover before version
 **/
 
Ext.DOM.load =(function()
{
   $(document).ready( function(){
	  $("#loginUser").dialog({
		 title 			:'<span style="padding-top:5px;border:0px solid #dddddd;"><img src="'+Ext.DOM.IMAGE+'/gambar/icon/group_key.png"></span> &nbsp; <span style="position:absolute;top:-2;">Change Your Password</span>',
		 width 			: 350, 
		 height 		: 200,
		 show 			: "drop",
		 direction 		: 'up',
		 bgiframe 		: false,
		 autoOpen 		: true, 
		 cache 			: false,
		 modal 			: true, 
		 closeOnEscape 	: false,
		 resizable 		: false,
		 buttons		: {
			Update : function(){ Ext.DOM.WindowLogin(); },
			Cancel: function(){ Ext.DOM.location = Ext.DOM.location.href }
		 }
	  }).dialog("open");
		
		Ext.DOM.focus();
	});
 })(); 
	
</script>
</head>
	<body>
	 <div id="loginUser" style="border:0px solid #000;">
			<table align="center" cellpadding="6px;" width="99%">
				<tr>
					<td width="20%" style="height:25px;font-family:Arial;font-size:12px;">Username</td>
					<td width="69%" style="height:25px;font-family:Arial;font-size:12px;">
					<?php echo form() ->input("username","input_text",_get_session('old_user_agent'),NULL,array('style'=>'width:200px;height:22px;'));?>
					</td>
				</tr>
				<tr>
					<td style="height:30px;font-family:Arial;font-size:12px;" nowrap>Old Password</td>
					<td style="height:30px;font-family:Arial;font-size:12px;">
					<?php echo form() ->password('old_password','input_text',_get_session('old_real_password'),null,array('style'=>'width:200px;height:22px;'));?>
					</td>
				</tr>	
				<tr>
					<td style="height:25px;font-family:Arial;font-size:12px;">Password</td>
					<td style="height:25px;font-family:Arial;font-size:12px;">
					<?php echo form() ->password('password','input_text',null,null,array('style'=>'width:200px;height:22px;'));?>
					</td>
				</tr>	
			</table>
	  </div>    
	</body>
	</html>