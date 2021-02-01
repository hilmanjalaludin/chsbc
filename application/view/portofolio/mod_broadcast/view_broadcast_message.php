<?php echo javascript();  ?>
<script>
/**
 ** javscript prototype system
 ** version v.0.1
 **/

Ext.document('document').ready(function(){
 Ext.Cmp('legend_title').setText(Ext.System.view_file_name());
 
 // get user online 
 Ext.Ajax
 ({
	url 	: Ext.DOM.INDEX +'/ModBroadcastMsg/getUserOnline/',
	method	: 'GET',
	param	: {}
  }).load("users");
  
})



/* SendOnlineUser **/

Ext.DOM.SendOnlineUser = function() {
	if(Ext.Cmp('Users').empty() ){  
		Ext.Msg("Please Select User").Info();  return false; 
	}
	else
	{
		if ( Ext.Cmp('text_message').empty()){ 
			Ext.Msg("Text message is empty").Error();
			return false;
		}
		else
		{
			Ext.Ajax
			({
				url 	: Ext.DOM.INDEX +'/ModBroadcastMsg/SendUserOnline/',
				method 	: 'POST',
				param 	: {
					UserData 	: Ext.Cmp('Users').getValue(),
					TextMessage :  Ext.Cmp('text_message').getValue()
				},
				ERROR : function(e)
				{
					var ERR = JSON.parse( e.target.responseText );
					
					if( ERR.success ) {
						Ext.Msg("Send Message").Success();
					}
					else {
						Ext.Msg("Send Message").Failed();
					}
				}
			}).post();
		}
	}
}
	
/*  SendOfflineUser ***/
Ext.DOM.SendOfflineUser = function()
{
	if(Ext.Cmp('Users').empty()){  
	   Ext.Msg("Please Select User").Info();  return false; }
	else
	{
		if ( Ext.Cmp('text_message').empty()){ 
			Ext.Msg("Text message is empty").Error();
			return false;
		}
		else
		{
			Ext.Ajax
			({
				url 	: Ext.DOM.INDEX +'/ModBroadcastMsg/SendUserOffline/',
				method 	: 'POST',
				param 	: {
					UserData 	: Ext.Cmp('Users').getValue(),
					TextMessage :  Ext.Cmp('text_message').getValue()
				},
				ERROR : function(e)
				{
					var ERR = JSON.parse( e.target.responseText );
					
					if( ERR.success ) {
						Ext.Msg("Send Message").Success();
					}
					else {
						Ext.Msg("Send Message").Failed();
					}
				}
			}).post();
		}
	}
}
	
/* SendAllUser ******/

Ext.DOM.SendAllUser = function()
{
	if(Ext.Cmp('Users').empty()){  
	   Ext.Msg("Please Select User").Info();  return false; }
	else
	{
		if ( Ext.Cmp('text_message').empty()){ 
			Ext.Msg("Text message is empty").Error();
			return false;
		}
		else
		{
			Ext.Ajax
			({
				url 	: Ext.DOM.INDEX +'/ModBroadcastMsg/SendUserAll/',
				method 	: 'POST',
				param 	: {
					UserData 	: Ext.Cmp('Users').getValue(),
					TextMessage :  Ext.Cmp('text_message').getValue()
				},
				ERROR : function(e)
				{
					var ERR = JSON.parse( e.target.responseText );
					
					if( ERR.success ) {
						Ext.Msg("Send Message").Success();
					}
					else {
						Ext.Msg("Send Message").Failed();
					}
				}
			}).post();
		}
	}
}

Ext.DOM.HandlingTypeAct = function(e)
{
	var hand=Ext.Cmp('Handling').getValue()
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/ModBroadcastMsg/getUserBy/',
		method	: 'GET',
		param	: {
			handling 	: Ext.Cmp('Handling').getValue(),
		}
	}).load("users");
}
	
/* jquery reader on ready ******/

$(function()
{
	$('#toolbars').extToolbars
	({
		extUrl    : Ext.DOM.LIBRARY +'/gambar/icon',
		extTitle  : [['Send to User Online'],['Send to User Offline'],['Send to all User'],],
		extMenu   : [['SendOnlineUser'],['SendOfflineUser'],['SendAllUser']],
		extIcon   : [['user_suit.gif'],['user_red.png'],['group.png']],
		extText   : true,
		extInput  : false,
		extOption : [
			  {
				render	: 1,
				type	: 'text',
				id		: 'v_benefit', 	
				name	: 'v_benefit',
				value	: '',
				width	: 200
			  }
			]
	});
});
</script>

<fieldset class="corner" style="border:1px solid #ddd;">
	<legend class="icon-menulist"> &nbsp;&nbsp;&nbsp;<span id="legend_title"></span></legend>
	<div id="toolbars" style="margin-bottom:5px;margin-top:2px;"></div>
	<div class="box-shadow" style="margin-top:5px;">
		<div style="margin-top:15px; margin-bottom:15px; margin-left:5px;" >
		<?php if( $this -> EUI_Session -> _get_session('HandlingType')!= USER_SUPERVISOR)
		{?>
		<span>Handling Type : &nbsp;</span><span>
		<select name="Handling" id="Handling" class="select tolong" onchange='Ext.DOM.HandlingTypeAct(this)'>
			<option value="">chosee</option>
			<?php
				if ($this -> EUI_Session -> _get_session('HandlingType')== USER_ADMIN) {?>
					<option value="1">QA</option>
			<?php	}
			?>
			<option value="2">AM</option>
			<option value="3">SPV</option>
			<option value="4">Agent</option>
		</select>
		</span>
		<?php } ?>	
		</div>
		<table cellpadding="4px" border=0>
			<tr>
				<td>
					<div id="users" style="height:480px;overflow:auto;width:450px;padding:2px;"></div>
				</td>
				<td valign="top">
				<div class="box-shadow">
					<fieldset style="border:1px solid #dddddd;">
						<legend class="icon-menulist"> &nbsp; &nbsp;<b>Text Message</b></legend>
						<textarea name="text_message" id="text_message" 
							style="border:0px solid #dddddd; font-family:consolas;
								  font-size:12px;margin-right:2px;margin-left:2px;margin-top:-5px;
								  color:green;background-color:#fffccc;height:200px;width:400px;"></textarea>
					</fieldset>
				</div>	
				</td>
			</tr>	
		</table>	
	</div>
</fieldset>	