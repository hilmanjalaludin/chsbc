/**  
	@Brodacast Message Plugin extends Jquery 
	@author: omens 
	@version : trial;	
**/ 


(function($){
	$.showMessage=function(b,a){
		settings = $.extend ({
			id:"sliding_message_box",
			position:"bottom",
			size:"90",
			backgroundColor:"rgb(143, 177, 240)",
			delay:1500,
			speed:500,
			fontSize:"14px",
			htmlBody:{
					imgUrl :Ext.DOM.INDEX +'/gambar/icon',
					
					title :{
						icon :'information.png',
						text :'Message Box ',
						id 	 :'message-title'
					},
					
					content	:{
						text	 : '',
						cssBody	 : 'box-shadow',
						id		 : 'message-body',
						hiddenid : ''
					},
					
					close:{
						icon : 'cancel.png',
						css  : 'test'
					}
				}
		},a);
		
	
		
		var htmlBody = " <a href='javascript:void(0);' id='clear-text' style='float:right;margin-top:10px;margin-right:10px;' title='close'> <span id='"+(settings.htmlBody.close.id?settings.htmlBody.close.id:'')+"'>"+
						" <img src='"+(settings.htmlBody.imgUrl?settings.htmlBody.imgUrl:'')+"/"+(settings.htmlBody.close.icon?settings.htmlBody.close.icon:'')+"'></span></a>"+
							
						"<div style=\"border:0px solid #000;\" class='"+(settings.htmlBody.content.cssBody?settings.htmlBody.content.cssBody:'')+"' id='"+(settings.htmlBody.content.id?settings.htmlBody.content.id:'body-text')+"'>"+
							" <div id='"+(settings.htmlBody.title.id?settings.htmlBody.title.id:'')+"' class='ui-widget-header' style='padding:2px 2px 2px 2px;'>"+
								" <span style='border:0px solid #000;padding-left:2px;padding-top:10px;'>"+
								" <img src='"+(settings.htmlBody.imgUrl?settings.htmlBody.imgUrl:'')+"/"+(settings.htmlBody.title.icon?settings.htmlBody.title.icon:'')+"'></span>"+
								" <span id='text-title' style='line-height:22px;'>"+settings.htmlBody.title.text+"</span></div>"+
							" <div id='"+settings.htmlBody.content.html+"' style='width:99%;height:350px;overflow:auto;'>"+(settings.htmlBody.content.text?settings.htmlBody.content.text:'')+"</div>"+
						"</div>";
					
		b = htmlBody;
		
		a=$("#"+settings.id);
		
		if(a.length==0)
			{
				a=$("<div></div>").attr("id",settings.id);
				a.css({	
						"z-index":"99999",
						"background-color":settings.backgroundColor,
						"text-align":"left",
						"position":"absolute",
						"left" :0,
						 right:"0",
						 width:"25%",
						 "line-height":settings.size+"px",
						 "font-size":settings.fontSize
				});
				$("body").append(a);
			}
		a.html(b);
		
	
		if(settings.position=="bottom")
		{
			a.css("bottom","-"+settings.size+"px");
			a.animate({bottom:"0"},settings.speed);
			b='$("#'+settings.id+'").animate({bottom:"-'+settings.size+'px"}, '+settings.speed+");";
			setTimeout(b,settings.delay)
		}
		else if(settings.position=="top")
		{
				a.css("top","-"+settings.size+"px");
				a.animate({top:"0"},settings.speed);
				b='$("#'+settings.id+'").animate({top:"-'+settings.size+'px"}, '+settings.speed+");";
		}
		
		$('#clear-text').click(function() {
			a.html('');
			Ext.Ajax({ url : Ext.DOM.INDEX +"/ModBroadcastMsg/UpdateAll/", 
				param : { 
					UserId : settings.htmlBody.content.hiddenid
				}
			}).json();
		});
}})(jQuery);
	
	
/* variable Reply Bc */
Ext.DOM.OBJBC=[];
// 

/* clear data if call later *****/
	
Ext.DOM.ClearData = function (messageid) {
	Ext.Ajax({ url : Ext.DOM.INDEX +"/ModBroadcastMsg/UpdateMessage/", param : { 
		messageid : messageid }
	}).json();
	
	getMessage();
}

/* reply broadcast */
Ext.DOM.ReplyBC = function(BCID)
{
	// alert(OBJ.UserId);
	chatWith({
		UserId : Ext.DOM.OBJBC[BCID].UserId,
		UserName : Ext.DOM.OBJBC[BCID].UserName,
		PesanBC : Ext.DOM.OBJBC[BCID].lastPesan,
		FromBC : true
	});
}
	
/*  broadcast Messages  **/
/////////////////////////////////////////
	
Ext.DOM.getMessage = function() {	
	var options = {
		id				: 'message_from_top',
		position		: 'top',
		size			: 11,
		backgroundColor	: '#ffffff',
		delay			: 3000,
		speed			: 500,
		fontSize		: '12px',
		htmlBody		: {
			imgUrl	: Ext.DOM.LIBRARY+'/gambar/icon',
			title	: {
				icon	:'information.png',
				text	:'Message Box ',
				id		:'message-title'
			},
			
			content : {
				text	 : 'Hello world',
				cssBody	 : 'box-shadow',
				id		 : 'message-body',
				html	 : 'content-msg',	
				hiddenid : ''
			},
					
			close:{
				icon:'cancel.png',
				css:'test'
			}
		}
	};
			
		
		new ( function(){
			var HTML = '', Json = [];
			var divContent = Ext.Cmp(options.htmlBody.content.html).getElementId();
			Ext.DOM.OBJBC=[];
			Ext.Ajax
			({
				url 	: Ext.DOM.INDEX +"/ModBroadcastMsg/PoolMessage/",
				param 	: { time : Ext.Date().getDuration() },
				ERROR 	: function(e)
				{
					Ext.Util(e).proc(function(JSON){
						if( JSON.pesan.result==1 ) {
						
							var i = 0;
							for(var a in JSON.pesan) {
								if(i==0) 
									HTML = "<p style='margin:4px 0px 4px 0px;color:blue;padding:4px 2px 4px 2px;'><b style='font-size:12px;color:red;'>"+JSON.pesan[a].from+",</b> says : </p>";
								if( JSON.pesan[a].datetime!=undefined )
								{
									Ext.DOM.OBJBC[JSON.pesan[a].msgid] = {
										'lastPesan' : JSON.pesan[a].message,
										'UserId' : JSON.pesan[a].fromId,
										'UserName' : JSON.pesan[a].from,
									};
									HTML += "<p style='padding:4px 2px 4px 2px;margin:4px 0px 4px 0px;font-size:10px;color:#030c7b;'>[ "+JSON.pesan[a].datetime+" ] </p>"
											+"<p style='margin-top:4px;text-align:justifiy;line-height:16px;font-size:11px;'>"+JSON.pesan[a].message+"&nbsp;( <a href='javascript:void(0);' onclick='javascript:ClearData("+JSON.pesan[a].msgid+");'>Clear</a>"
											+" || <a href='javascript:void(0);' onclick='javascript:ReplyBC("+JSON.pesan[a].msgid+");'>Reply</a>)</p>";
									// HTML += "<p style='padding:4px 2px 4px 2px;margin:4px 0px 4px 0px;font-size:10px;color:#030c7b;'>[ "+JSON.pesan[a].datetime+" ] </p>"
											// +"<p style='margin-top:4px;text-align:justifiy;line-height:16px;font-size:11px;'>"+JSON.pesan[a].message+"&nbsp;( <a href='javascript:void(0);' onclick='javascript:ClearData("+JSON.pesan[a].msgid+");'>Clear</a> )</p> ";
								}
									
								
							  i++;
							}
									
							options.htmlBody.content.text =HTML;
							options.htmlBody.content.hiddenid =	0;
							if( i > 0 ) 
								$.showMessage('', options);	
						}
						else{
							if( divContent!=null ) divContent.innerHTML='';
						}
					});
			 }}).post();
		});	
		
		return false;
	};	

(function($,Ext){	
Ext.DOM.CallReminder = function(){
	Ext.Ajax({
		url 	: Ext.DOM.INDEX +'/CallReminder/SelectReminder/',
		method 	: 'POST',
		param 	: { time : 0 },
		ERROR : function(e){
			Ext.Util(e).proc(function(items){
				if( items.count > 0 )
				{
					console.log(items)
					
					var not = $(this).attr('href');
					var link = '<a href="javascript:void(0);" id="reminderId"'
						+'onclick="$(\'#main_content\').load(\'dta_contact_detail.php?customerid='+items.CustomerId+'&campaignid='+items.CampaignId+'\');" '
						+'>'+items.CustomerName+'</a>';		
						
						var notice = '<div class="notice">'
							+ '<div class="notice-body">' 
							+ '<img src="gambar/info.png" alt="" />'
							+ '<h3>Reminder Call For : <br>'+link+'</h3>'
							+ '<p><span>With Status  : '+data.status+'</span></p>'
							+ '</div>'
							+ '<div class="notice-bottom">'
							+ '</div>'
							+ '</div>';
							
					$( notice ).purr({ usingTransparentPNG: true, isSticky: true } );
					Ext.Ajax
					({ 
						url 	: Ext.DOM.INDEX +'/CallReminder/UpdateReminder/', method:'POST', 
						param	: {
							CustomerId : data.customer,
							CallLaterDate : items.tryagain
						}
					}).json();
					return false;
				 }
			});
		}
	}).post()
  }
  
})($,Ext);
		
var ControlWind = window.setInterval("Ext.DOM.getMessage()",10000);	
