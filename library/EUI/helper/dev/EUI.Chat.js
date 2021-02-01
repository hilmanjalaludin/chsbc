/*

Copyright (c) 2009 Anant Garg (anantgarg.com | inscripts.com)

This script may be used for non-commercial purposes only. For any
commercial purposes, please contact the author at 
anant.garg@inscripts.com

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
*/

/*
 * -------------------------------------------------------------------------------
 * @ CHANGE : UPDATE TO ACOMODIR WITH TWO TITLE ON CHATBOX CUSTOMIZE DATA 
 * ------------------------------------------------------------------------------
 
 * @ AUTHOR : OMENS< jombi_par@yahoo.com
 * @ CREATE : 2015-09-03
 * -------------------------------------------------------------------------------
 */

var windowFocus = true;
var username;
var aliasname;
var chatHeartbeatCount = 0;
var minChatHeartbeat = 5000;
var maxChatHeartbeat = 33000;
var chatHeartbeatTime = minChatHeartbeat;
var originalTitle;
var blinkOrder = 0;
var chatboxFocus = new Array();
var newMessages = new Array();
var newMessagesWin = new Array();
var chatBoxes = new Array();
var chattitle = new Array();
var eventUser = null;

// ----------------------------------------------------------------
/* --------------------------------------------------------------
 * @ pack  : handle global eevent URL on here 
 * @ akses : global  
 * @ chat  : - 
 *  -------------------------------------------------------------
 */ 

$(function(){
	eventUser = Ext.EventUrl ([ 'UserChat', 'index']).Apply();
});

// ----------------------------------------------------------------
/* --------------------------------------------------------------
 * @ pack  : on ready document object ( DOMload )
 * @ akses : global  
 * @ chat  : - 
 *  -------------------------------------------------------------
 */ 
$(document).ready(function()
{
	originalTitle = document.title;
	startChatSession();

	$([window, document]).blur(function(){
		windowFocus = false;
	}).focus(function(){
		windowFocus = true;
		document.title = originalTitle;
	});
});

// ----------------------------------------------------------------
/* --------------------------------------------------------------
 * @ pack  : restructureChatBoxes() 
 * @ akses : global  
 * @ chat  : - 
 *  -------------------------------------------------------------
 */ 
 
function restructureChatBoxes() 
{
align = 0;
	var obj_chatBoxes = {};
	for( var t in chatBoxes ){
		chatboxtitle = chatBoxes[t];
		if( $("#chatbox_"+chatboxtitle).css('display') !='none' 
			&& typeof($("#chatbox_"+chatboxtitle).css('display'))!='undefined')
		{
			obj_chatBoxes[chatBoxes[t]] = chatBoxes[t]; 
		}
	}
	chatBoxes = Object.keys(obj_chatBoxes);
	 for ( x in chatBoxes) 
	{
		chatboxtitle = chatBoxes[x];

		if ( $("#chatbox_"+chatboxtitle).css('display') !='none') {
			if( $("#chatbox_"+chatboxtitle).css('display') !='undefined')  
		 {	
			if (align == 0) {
				$("#chatbox_"+chatboxtitle).css('right', '20px');
			} else {
				width = (align)*(225+7)+20;
				$("#chatbox_"+chatboxtitle).css('right', width+'px');
			}
			align++;
		 }
		}
	}
}

// ----------------------------------------------------------------
/* --------------------------------------------------------------
 * @ pack  : chatWith(argv1 = array ) 
 * @ akses : global  
 * @ chat  : - 
 *  -------------------------------------------------------------
 * @ bugs : key duplicated by (object)
 */ 
 
function chatWith( chatuser ) 
{
	
	
 var Users = new Array();
 if( typeof (chatuser) == 'object' ){
	Users = new Array(
		( typeof( chatuser.UserId ) == 'string' ? chatuser.UserId : '0' ),
		( typeof( chatuser.UserName ) == 'string' ? chatuser.UserName : '0' )
	);
	chattitle = new Array(
		( typeof( chatuser.UserId ) == 'string' ? chatuser.UserId : '0' ),
		( typeof( chatuser.UserName ) == 'string' ? chatuser.UserName : '0' )
	);
  }
  
 if( typeof( Users ) == 'object' ) {
	createChatBox( Users );
	$("#chatbox_"+( Users[0] ? Users[0] : '') +" .chatboxtextarea").focus();
 }
 
  if(chatuser.FromBC==true)
 {
	$("#chatbox_"+chatuser.UserId+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom"><i>'+chatuser.UserName+'</i>&nbsp;:&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+chatuser.PesanBC+'</span></div>');
 }
 
}

// ----------------------------------------------------------------
/* --------------------------------------------------------------
 * @ pack  : createChatBox(argv1, argv2 ) 
 * @ akses : global // start chat sessio  with setTime out 
 * @ chat  : - 
 *  -------------------------------------------------------------
 */ 
function createChatBox(chatboxtitle,minimizeChatBox) 
{
	if ($("#chatbox_"+chatboxtitle[0]).length > 0) {
		if ($("#chatbox_"+chatboxtitle[0]).css('display') == 'none') {
			$("#chatbox_"+chatboxtitle[0]).css('display','block');
			restructureChatBoxes();
		}
		$("#chatbox_"+chatboxtitle[0]+" .chatboxtextarea").focus();
		return;
	}
	
	$(" <div />" ).attr("id","chatbox_"+chatboxtitle[0])
	.addClass("chatbox")
	.html('<div class="chatboxhead ui-corner-top ui-state-default"><span class="chatboxtitle">'+chatboxtitle[0]+'</span>&nbsp;::&nbsp;<span class="chatboxtitle2">'+chatboxtitle[1]+'</span><div class="chatboxoptions"><a href="javascript:void(0)" onclick="javascript:toggleChatBoxGrowth(\''+chatboxtitle[0]+'\')"><b>--</b></a> <a href="javascript:void(0)" onclick="javascript:closeChatBox(\''+chatboxtitle[0]+'\')">X</a></div><br clear="all"/></div><div class="chatboxcontent"></div><span class="chatClear"><a href="javascript:void(0)" onClick="javascript:clearChatReason(\''+chatboxtitle[0]+'\')">Clear All</a></span><div class="chatboxinput"><textarea class="chatboxtextarea" onkeydown="javascript:return checkChatBoxInputKey(event,this,\''+chatboxtitle+'\');"></textarea></div>')
	.appendTo($( "body" ));
			   
	$("#chatbox_"+chatboxtitle[0]).css('bottom', '37px');
	
	chatBoxeslength = 0;

	for (x in chatBoxes) {
		if ($("#chatbox_"+chatBoxes[x]).css('display') != 'none') {
			chatBoxeslength++;
		}
	}

	if (chatBoxeslength == 0) {
		$("#chatbox_"+chatboxtitle[0]).css('right', '20px');
	} else {
		width = (chatBoxeslength)*(225+7)+20;
		$("#chatbox_"+chatboxtitle[0]).css('right', width+'px');
	}
	
	chatBoxes.push(chatboxtitle[0]);

	if (minimizeChatBox == 1) {
		minimizedChatBoxes = new Array();
		
		if ($.cookie('chatbox_minimized')) {
			minimizedChatBoxes = $.cookie('chatbox_minimized').split(/\|/);
		}
		minimize = 0;
		for (j=0;j<minimizedChatBoxes.length;j++) {
			if (minimizedChatBoxes[j] == chatboxtitle[0]) {
				minimize = 1;
			}
		}

		if (minimize == 1) {
			$('#chatbox_'+chatboxtitle[0]+' .chatboxcontent').css('display','none');
			$('#chatbox_'+chatboxtitle[0]+' .chatboxinput').css('display','none');
		}
	}
	
	chatboxFocus[chatboxtitle[0]] = false;
	$("#chatbox_"+chatboxtitle[0]+" .chatboxtextarea").blur(function(){
		chatboxFocus[chatboxtitle[0]] = false;
		$("#chatbox_"+chatboxtitle[0]+" .chatboxtextarea").removeClass('chatboxtextareaselected');
	}).focus(function(){
		chatboxFocus[chatboxtitle[0]] = true;
		newMessages[chatboxtitle[0]] = false;
		$('#chatbox_'+chatboxtitle[0]+' .chatboxhead .ui-corner-top ui-state-default ').removeClass('chatboxblink');
		$("#chatbox_"+chatboxtitle[0]+" .chatboxtextarea").addClass('chatboxtextareaselected');
	});

	$("#chatbox_"+chatboxtitle[0]).click(function() {
		if ($('#chatbox_'+chatboxtitle[0]+' .chatboxcontent').css('display') != 'none') {
			$("#chatbox_"+chatboxtitle[0]+" .chatboxtextarea").focus();
		}
	});

	$("#chatbox_"+chatboxtitle[0]).show();
}

// ----------------------------------------------------------------
/* --------------------------------------------------------------
 * @ pack  : chatHeartbeat() 
 * @ akses : global // start chat sessio  with setTime out 
 * @ chat  : - 
 *  -------------------------------------------------------------
 */ 
 
function chatHeartbeat()
{

 var itemsfound = 0;
 if (windowFocus == false) 
 {
	var blinkNumber = 0;
	var titleChanged = 0;
	for (x in newMessagesWin) 
	{
		if (newMessagesWin[x] == true) 
		{
			++blinkNumber;
			if (blinkNumber >= blinkOrder) 
			{
				document.title = x+' says...';
				titleChanged = 1;
				break;	
			}
		}
	}
		
		if (titleChanged == 0) {
			document.title = originalTitle;
			blinkOrder = 0;
		} else {
			++blinkOrder;
		}

	} else {
		for (x in newMessagesWin) {
			newMessagesWin[x] = false;
		}
	}

	for (x in newMessages) {
		if (newMessages[x] == true) {
			if (chatboxFocus[x] == false) {
				//FIXME: add toggle all or none policy, otherwise it looks funny
				$('#chatbox_'+x+' .chatboxhead').toggleClass('chatboxblink');
			}
		}
	}
	
	$.ajax({
	  url: eventUser +"/?action=chatheartbeat",
	  cache: false,
	  dataType: "json",
	  success: function(data) {
		
		$.each(data.items, function(i,item){
			if ( typeof( item ) == 'object' )  
			{ 
				// fix strange ie bug
				chatboxtitle = item.f;
			  
				if ($("#chatbox_"+chatboxtitle).length <= 0)  {
					createChatBox(new Array(chatboxtitle, item.g));
				}
				
				if ($("#chatbox_"+chatboxtitle).css('display') == 'none') {
					$("#chatbox_"+chatboxtitle).css('display','block');
					restructureChatBoxes();
				}
				
				if (item.s == 1) {
					item.f = username;
				}

				if (item.s == 2) {
					$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxinfo">'+item.m+'</span></div>');
				} else {
					newMessages[chatboxtitle] = true;
					newMessagesWin[chatboxtitle] = true;
					$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom"><i>'+item.g+'</i>&nbsp;:&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+item.m+'</span></div>');
				}
				try{
					$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
				}
				catch(e){
					console.log(e);
				}	
				itemsfound += 1;
			}
		});

		chatHeartbeatCount++;

		if (itemsfound > 0) {
			chatHeartbeatTime = minChatHeartbeat;
			chatHeartbeatCount = 1;
		} else if (chatHeartbeatCount >= 10) {
			chatHeartbeatTime *= 2;
			chatHeartbeatCount = 1;
			if (chatHeartbeatTime > maxChatHeartbeat) {
				chatHeartbeatTime = maxChatHeartbeat;
			}
		}
		
		setTimeout('chatHeartbeat();',chatHeartbeatTime);
	}});
}

// ----------------------------------------------------------------
/* --------------------------------------------------------------
 * @ pack  : removeArr( argv ) 
 * @ akses : global // value in array statment 
 * @ chat  : - 
 *  -------------------------------------------------------------
 */ 
 
 
 function removeArr(arr) 
{
    var what, a = arguments, L = a.length, ax;
    while (L > 1 && arr.length) {
        what = a[--L];
        while ((ax= arr.indexOf(what)) !== -1) {
            arr.splice(ax, 1);
        }
    }
    return arr;
} 
// removeArr =================>

// --------------------------------------------------------------
/* --------------------------------------------------------------
 * @ pack  : closeChatBox( argv ) 
 * @ akses : global 
 * @ chat  : - 
 *  -------------------------------------------------------------
 */ 
 
function closeChatBox(chatboxtitle) 
{
  $('#chatbox_'+chatboxtitle).remove();
  restructureChatBoxes();
 // $('#chatbox_'+chatboxtitle).css('display','none');
  
 // @ fix  : bug its minimize then close no clear cookies 
 // @ auth : omens 
 
 var minimizedChatBoxes = new Array();
 var newCookie = "";
 
 if( $.cookie('chatbox_minimized') ){
	minimizedChatBoxes = $.cookie('chatbox_minimized').split(/\|/);	
 }
 
// set new minimize data 
  minimizedChatBoxes = removeArr( minimizedChatBoxes, chatboxtitle );
  
 for (i=0;i<minimizedChatBoxes.length;i++) {
	if( minimizedChatBoxes[i]!='' ){
		newCookie += minimizedChatBoxes[i] +'|';
	}
  }

  newCookie = newCookie.slice(0, -1)
  $.cookie('chatbox_minimized', newCookie);
 $.post( eventUser +"/?action=closechat", { chatbox: chatboxtitle} , function(data){ });
}

// --------------------------------------------------------------
/* --------------------------------------------------------------
 * @ pack  : toggleChatBoxGrowth( argv ) 
 * @ akses : global 
 * @ chat  : - 
 *  -------------------------------------------------------------
 */ 
 
function toggleChatBoxGrowth(chatboxtitle) 
{
	if ($('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display') == 'none') {  
		
		var minimizedChatBoxes = new Array();
		
		if ($.cookie('chatbox_minimized')) {
			minimizedChatBoxes = $.cookie('chatbox_minimized').split(/\|/);
		}

		minimizedChatBoxes = removeArr( minimizedChatBoxes, chatboxtitle );	
		var newCookie = '';
		
		
		for (i=0;i<minimizedChatBoxes.length;i++) {
			newCookie += minimizedChatBoxes[i] +"|";
			// if (minimizedChatBoxes[i] != chatboxtitle) {
				// newCookie += chatboxtitle+'|';
			// }
		}

		newCookie = newCookie.slice(0, -1)


		$.cookie('chatbox_minimized', newCookie);
		$('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','block');
		$('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','block');
		$('#chatbox_'+chatboxtitle+' .chatClear').css('display','block');
		$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
	} else {
		
		var newCookie = chatboxtitle;
		if ( $.cookie('chatbox_minimized') ) { 
			newCookie += "|"+ $.cookie('chatbox_minimized');
		}
		
		$.cookie('chatbox_minimized',newCookie);
		$('#chatbox_'+chatboxtitle+' .chatboxcontent').css('display','none');
		$('#chatbox_'+chatboxtitle+' .chatboxinput').css('display','none');
		$('#chatbox_'+chatboxtitle+' .chatClear').css('display','none');
	}
	
}









// --------------------------------------------------------------
/* --------------------------------------------------------------
 * @ pack  : checkChatBoxInputKey( argv ) 
 * @ akses : global 
 * @ chat  : - 
 *  -------------------------------------------------------------
 */ 
 
function checkChatBoxInputKey(event,chatboxtextarea,chatboxtitle) 
{
	var chatboxtitle = chatboxtitle.split(',');
	if(event.keyCode == 13 && event.shiftKey == 0)  {
		message = $(chatboxtextarea).val();
		message = message.replace(/^\s+|\s+$/g,"");

		$(chatboxtextarea).val('');
		$(chatboxtextarea).focus();
		$(chatboxtextarea).css('height','44px');
		if (message != '') 
		{
			$.post( eventUser +"/?action=sendchat", {to: chatboxtitle[0], aliasname: chatboxtitle[1], message: message} , function(data){
				message = message.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/\"/g,"&quot;");
				$("#chatbox_"+chatboxtitle[0]+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+aliasname+':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+message+'</span></div>');
				$("#chatbox_"+chatboxtitle[0]+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle[0]+" .chatboxcontent")[0].scrollHeight);
			});
		}
		chatHeartbeatTime = minChatHeartbeat;
		chatHeartbeatCount = 1;

		return false;
	}

	var adjustedHeight = chatboxtextarea.clientHeight;
	var maxHeight = 94;

	if (maxHeight > adjustedHeight) {
		adjustedHeight = Math.max(chatboxtextarea.scrollHeight, adjustedHeight);
		if (maxHeight)
			adjustedHeight = Math.min(maxHeight, adjustedHeight);
		if (adjustedHeight > chatboxtextarea.clientHeight)
			$(chatboxtextarea).css('height',adjustedHeight+8 +'px');
	} else {
		$(chatboxtextarea).css('overflow','auto');
	}
	 
}

// --------------------------------------------------------------
/* --------------------------------------------------------------
 * @ pack  : clearChatReason( argv ) 
 * @ akses : global 
 * @ chat  : - 
 *  -------------------------------------------------------------
 */ 
function clearChatReason(chatboxtitle)
{
	$("#chatbox_"+chatboxtitle+" .chatboxcontent").html('');
	$.post( eventUser +"/?action=closechat", { chatbox: chatboxtitle} , function(data){	
	});
}


// --------------------------------------------------------------
/* --------------------------------------------------------------
 * @ pack  : startChatSession( argv ) 
 * @ akses : global 
 * @ chat  : - 
 *  -------------------------------------------------------------
 */ 
function startChatSession()
{  
	$.ajax
 ({
	url: eventUser +"/?action=startchatsession",
	cache: false,
	dataType: "json",
	success: function(data) 
	{
		username = data.username;
		aliasname = data.codeuser
		$.each(data.items, function(i,item)
		{
			if (item)	
			{ 
				// fix strange ie bug
				chatboxtitle = item.f; 
				
				if ($("#chatbox_"+chatboxtitle).length <= 0) {
					createChatBox(new Array(chatboxtitle,item.g),1);
				}
				
				if (item.s == 1) {
					item.f = username;
					item.g = aliasname;
				}

				if (item.s == 2) {
					$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxinfo">'+item.m+'</span></div>');
				} else {	
					$("#chatbox_"+chatboxtitle+" .chatboxcontent").append('<div class="chatboxmessage"><span class="chatboxmessagefrom">'+item.g+':&nbsp;&nbsp;</span><span class="chatboxmessagecontent">'+item.m+'</span></div>');
				}
			}
		});
		
		for (i=0;i<chatBoxes.length;i++) {
			chatboxtitle = chatBoxes[i];
			$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);
			setTimeout('$("#chatbox_"+chatboxtitle+" .chatboxcontent").scrollTop($("#chatbox_"+chatboxtitle+" .chatboxcontent")[0].scrollHeight);', 100); // yet another strange ie bug
		}
	
		setTimeout('chatHeartbeat();',chatHeartbeatTime);
		
	}});
}
