(function(UI, Ext){
 
// under prototype section 
 
UI.prototype.Dialog =function(PlaceWin,config ){


// store data 

 Ext.windialog = {
		place			: PlaceWin,
		images			: [ Ext.DOM.LIBRARY+'/gambar/min.gif', 
						   Ext.DOM.LIBRARY+'/gambar/close.gif', 
						   Ext.DOM.LIBRARY+'/gambar/restore.gif', 
						   Ext.DOM.LIBRARY+'/gambar/resize.gif',
						   Ext.DOM.LIBRARY+'/gambar/loading.gif'],
		ajaxbustcache	: true, 
		ajaxloadinghtml	: '<b>Loading Page. Please wait...</b>', 
		minimizeorder	: 0,
		zIndexvalue		: 99,
		tobjects		: [], 
		lastactivet		: {},

	init:function( WriteID, attr) {
		var domwindow		 = Ext.Create("div").element();  //create dhtml window div
		domwindow.id		 = WriteID;
		domwindow.className	 = "ExtWindow";
		var domwindowdata	 = 'style="border:0px;"';
		domwindowdata		 = '<div class=\'drag-handle\'>';
		domwindowdata		+= 'Ext Window <div class="drag-controls">';
		
		// cek attribute close && minimize 
		if( (typeof(attr)=='object') && (attr.minimize) )
			domwindowdata += '<img src="'+ this.images[0] +'" title="Minimize" />&nbsp;';
		else
			domwindowdata += '<img src="'+ this.images[0] +'" title="" />&nbsp;';
		
		if( (typeof(attr)=='object') && (attr.close) )
			domwindowdata += '<img src="'+ this.images[1] +'" title="Close" /></div>';
		else
			domwindowdata += '<img src="'+ this.images[1] +'" title="" /></div>';
			
		
		domwindowdata		+= '</div>';
		domwindowdata		+= '<div class="drag-contentarea" style="border:0px solid #DDDDDD;"></div>';
		domwindowdata		+= '<div class="drag-statusarea">'+
							   '<div class="drag-resizearea" style="background: transparent url('+this.images[3]+') top right no-repeat; border:0px solid #DDDDDD;">&nbsp;</div></div>';
		domwindowdata		+= '</div>';
		domwindow.innerHTML  = domwindowdata;
		
		if( domwindow ){ Ext.Cmp(Ext.windialog.place).getElementId().appendChild(domwindow) }
		
		var WriteID	= Ext.Cmp(WriteID).getElementId(); divs = WriteID.getElementsByTagName("div");
		
		for (var i=0; i<divs.length; i++){  
			if (/drag-/.test(divs[i].className))
				WriteID[divs[i].className.replace(/drag-/, "")]=divs[i]; 
		}
		
		WriteID.handle._parent		 	= WriteID;
		WriteID.resizearea._parent 	 	= WriteID;
		WriteID.controls._parent	 	= WriteID;
		WriteID.onclose				 	= function(){return true} 
		WriteID.onmousedown			 	= function(){ Ext.windialog.setfocus(this)} 
		WriteID.handle.onmousedown	 	= Ext.windialog.setupdrag;
		WriteID.resizearea.onmousedown  = Ext.windialog.setupdrag;
		WriteID.controls.onclick		= Ext.windialog.enablecontrols;
		WriteID.show					= function(){ Ext.windialog.show(this); };
		WriteID.hide 					= function(){ Ext.windialog.hide(this); };
		WriteID.close 					= function(){ Ext.windialog.close(this); };
		WriteID.setSize 				= function(w, h){ Ext.windialog.setSize(this, w, h); };
		WriteID.moveTo  				= function(x, y){ Ext.windialog.moveTo(this, x, y); };
		WriteID.isResize 				= function(bol){ Ext.windialog.isResize(this, bol)};
		WriteID.isScrolling 			= function(bol){ Ext.windialog.isScrolling(this, bol); };
		WriteID.load 					= function(contenttype, contentsource, title){ Ext.windialog.load(this, contenttype, contentsource, title); };
		this.tobjects[this.tobjects.length] = WriteID;
		
		return WriteID;
	},
	 
	open : function(WinID, contenttype, contentsource, title, attr, recalonload) {
		if ( Ext.Cmp(WinID).IsNull() ) 
			WinID = this.init(WinID,attr); 
		else
			WinID = Ext.Cmp(WinID).getElementId();
			
		this.setfocus(WinID, attr)
		WinID.setSize(( parseInt( (typeof(attr)!='undefined' ? attr.width : 0)) ? 
				parseInt((typeof(attr)!='undefined' ? attr.width : 0)) : 0), 
				( parseInt((typeof(attr)!='undefined' ? attr.height : 0)) ? parseInt((typeof(attr)!='undefined' ? attr.height : 0)) : 0) )
		
		var xpos = (((typeof(attr)!='undefined'?attr.center:'') ? 'middle' : (typeof(attr)!='undefined'? attr.left:'')));
		var ypos = (((typeof(attr)!='undefined'?attr.center:'') ? 'middle' : (typeof(attr)!='undefined'? attr.top:'')));
		
		if (typeof recalonload!="undefined" && recalonload=="recal" && this.scroll_top==0) { 
			if (window.attachEvent && !window.opera) 
				this.addEvent(window, function(){
					setTimeout(function(){WinID.moveTo(xpos, ypos)}, 400);
				}, 'load');
			else
				this.addEvent(window, function(){
					WinID.moveTo(xpos, ypos)
			}, "load");
		}
		

		WinID.isResize( (parseInt((typeof(attr)!='undefined'?attr.resize:0))?parseInt((typeof(attr)!='undefined' ?attr.resize:0)):0) );
		WinID.isScrolling( (parseInt((typeof(attr)!='undefined'?attr.scrolling:0))?parseInt((typeof(attr)!='undefined'? attr.scrolling : 0)):0) );
		
		WinID.style.visibility="visible";
		WinID.style.display="block";
		WinID.contentarea.style.display="block";
		WinID.moveTo(xpos, ypos);
		
		WinID.load(contenttype, contentsource, title);
		
		if (WinID.state=="minimized" && WinID.controls.firstChild.title=="Restore") {
			WinID.controls.firstChild.setAttribute("src",  Ext.windialog.images[0]); //Change "restore" icon within window interface to "minimize" icon
			WinID.controls.firstChild.setAttribute("title", "Minimize");
			WinID.state="fullview"; 
		}
		
		return WinID
	},

	setSize:function(t, w, h){ //set window size (min is 150px wide by 100px tall)
		t.style.width=Math.max(parseInt(w), 150)+"px";
		t.contentarea.style.height=Math.max(parseInt(h), 100)+"px";
	},

	moveTo:function(t, x, y){ 
		this.getviewpoint();
		t.style.left=(x=="middle")? this.scroll_left+(this.docwidth-t.offsetWidth)/2+"px" : this.scroll_left+parseInt(x)+"px";
		t.style.top=(y=="middle")? this.scroll_top+(this.docheight-t.offsetHeight)/2+"px" : this.scroll_top+parseInt(y)+"px";
	},

	isResize:function(t, bol){ //show or hide resize inteface (part of the status bar)
		t.statusarea.style.display=((bol)? "block" : "none");
		t.resizeBool=((bol)? 1 : 0);
	},

	isScrolling:function(t, bol){ //set whether loaded content contains scrollbars
		t.contentarea.style.overflow=((bol)? "auto" : "hidden");
	},
	
	
  // text only 
  
	text : function( content, source){
		Ext.Cmp(content).setText(source);
	},
	
  // get from div element 
  
	division : function( content, source ){
		Ext.Cmp(t.contentarea).setText((Ext.Cmp(source).getElementId().defaultHTML || Ext.Cmp(source).getElementId().innerHTML));
		if (!Ext.Cmp(source).getElementId().defaultHTML) {
			Ext.Cmp(source).getElementId().defaultHTML = Ext.Cmp(source).getElementId().innerHTML; 
			Ext.Cmp(source).setText("");
			Ext.Css(source).style({ 'display' : 'none' });
		}	
	},
	
	// ajax type 
	
	ajax : function( content, source ) {
		Ext.Cmp(content).setText('<span style="float:center;color:red;"><img src="'+this.images[4]+'" height="16px">&nbsp;&nbsp;Please wait..</span>');
		Ext.Ajax({ url : source.url, method : source.method, param : source.param }).load(content);	
	},
	
	iframe : function(content, contentsource, wind){
		content.style.overflow="hidden" //disable window scrollbars, as iframe already contains scrollbars
		if (!content.firstChild || content.firstChild.tagName!="IFRAME") //If iframe tag doesn't exist already, create it first
			content.innerHTML='<iframe src="" style="margin:0; border-bottom:0px; border-top:0px; border-right:0px; border-left:0px; padding:0; width:100%; height: 100%" name="_iframe-'+wind.id+'"></iframe>'
		window.frames["_iframe-"+wind.id].location.replace(contentsource) //set location of iframe window to specified URL
	},
	
	load:function(t, contenttype, contentsource, title){ //loads content into window plus set its title (3 content types: "inline", "iframe", or "ajax")
		
		if (t.isClosed){
			alert("Ext Window has been closed, so no window to load contents into. Open/Create the window again.");
			return
		}
		var contenttype=contenttype.toLowerCase() //convert string to lower case
		if (typeof title!="undefined"){ 
			t.handle.firstChild.nodeValue=title
		}	
		switch( contenttype ) {
			case 'inline' 	: this.text(t.contentarea, contentsource); break;
			case 'div' 		: this.division(t.contentarea, contentsource); break;
			case 'ajax' 	: this.ajax(t.contentarea, contentsource); break;
			case 'iframe'	: this.ajax(t.contentarea, contentsource, t); break;
		}
		
		t.contentarea.datatype=contenttype; 
	},

	setupdrag:function(e) {
		var d= Ext.windialog, t=this._parent;
			d.etarget=this //remember div mouse is currently held down on ("handle" or "resize" div)
			var e=window.event || e;
			d.initmousex=e.clientX ;//store x position of mouse onmousedown
			d.initmousey=e.clientY;
			d.initx=parseInt(t.offsetLeft) //store offset x of window div onmousedown
			d.inity=parseInt(t.offsetTop);
			d.width=parseInt(t.offsetWidth); //store width of window div
			d.contentheight=parseInt(t.contentarea.offsetHeight); //store height of window div's content div
		if (t.contentarea.datatype=="iframe"){ //if content of this window div is "iframe"
			t.style.backgroundColor="#DDDDDD"; //colorize and hide content div (while window is being dragged)
			t.contentarea.style.visibility="hidden";
		}
		document.onmousemove=d.getdistance //get distance travelled by mouse as it moves
		document.onmouseup=function(){
			if (t.contentarea.datatype=="iframe"){ //restore color and visibility of content div onmouseup
				t.contentarea.style.backgroundColor="white";
				t.contentarea.style.visibility="visible";
			}
			d.stop();
		}
		return false;
	},

	getdistance:function(e){
		var d= Ext.windialog;
		var etarget=d.etarget;
		var e=window.event || e;
		d.distancex=e.clientX-d.initmousex; //horizontal distance travelled relative to starting point
		d.distancey=e.clientY-d.initmousey;
		if (etarget.className=="drag-handle") //if target element is "handle" div
			d.move(etarget._parent, e);
		else if (etarget.className=="drag-resizearea") //if target element is "resize" div
			d.resize(etarget._parent, e);
		return false ;//cancel default dragging behavior
	},

	getviewpoint:function(){ //get window viewpoint numbers
		var ie=document.all && !window.opera
			var domclientWidth=document.documentElement && parseInt(document.documentElement.clientWidth) || 100000 //Preliminary doc width in non IE browsers
				this.standardbody=(document.compatMode=="CSS1Compat")? document.documentElement : document.body //create reference to common "body" across doctypes
				this.scroll_top=(ie)? this.standardbody.scrollTop : window.pageYOffset
				this.scroll_left=(ie)? this.standardbody.scrollLeft : window.pageXOffset
				this.docwidth=(ie)? this.standardbody.clientWidth : (/Safari/i.test(navigator.userAgent))? window.innerWidth : Math.min(domclientWidth, window.innerWidth-16)
				this.docheight=(ie)? this.standardbody.clientHeight: window.innerHeight
	},

	rememberattrs:function(t){ //remember certain attributes of the window when it's minimized or closed, such as dimensions, position on page
		this.getviewpoint() //Get current window viewpoint numbers
		t.lastx=parseInt((t.style.left || t.offsetLeft))- Ext.windialog.scroll_left //store last known x coord of window just before minimizing
		t.lasty=parseInt((t.style.top || t.offsetTop))- Ext.windialog.scroll_top
		t.lastwidth=parseInt(t.style.width) //store last known width of window just before minimizing/ closing
	},

	move:function(t, e){
		t.style.left= Ext.windialog.distancex+ Ext.windialog.initx+"px"
		t.style.top= Ext.windialog.distancey+ Ext.windialog.inity+"px"
	},

	resize:function(t, e){
		t.style.width=Math.max( Ext.windialog.width+ Ext.windialog.distancex, 150)+"px"
		t.contentarea.style.height=Math.max( Ext.windialog.contentheight+ Ext.windialog.distancey, 100)+"px"
	},

	enablecontrols:function(e){
		var d= Ext.windialog
		var sourceobj=window.event? window.event.srcElement : e.target //Get element within "handle" div mouse is currently on (the controls)
		if (/Minimize/i.test(sourceobj.getAttribute("title"))) //if this is the "minimize" control
			d.minimize(sourceobj, this._parent)
		else if (/Restore/i.test(sourceobj.getAttribute("title"))) //if this is the "restore" control
			d.restore(sourceobj, this._parent)
		else if (/Close/i.test(sourceobj.getAttribute("title"))) //if this is the "close" control
			d.close(this._parent)
		return false
	},

	minimize:function(button, t){
		Ext.windialog.rememberattrs(t);
		button.setAttribute("src",  Ext.windialog.images[2]);
		button.setAttribute("title", "Restore");
		t.state="minimized" //indicate the state of the window as being "minimized"
		t.contentarea.style.display="none";
		t.statusarea.style.display="none";
		if (typeof t.minimizeorder=="undefined"){ //stack order of minmized window on screen relative to any other minimized windows
			 Ext.windialog.minimizeorder++; //increment order
			t.minimizeorder= Ext.windialog.minimizeorder;
		}
		t.style.left="8px"; //left coord of minmized window
		t.style.width="250px";
		var windowspacing=t.minimizeorder*10; //spacing (gap) between each minmized window(s)
		t.style.top= Ext.windialog.scroll_top+ Ext.windialog.docheight-(t.handle.offsetHeight*t.minimizeorder)-windowspacing+"px";
	},

	restore:function(button, t)
	{
		 Ext.windialog.getviewpoint();
			button.setAttribute("src",  Ext.windialog.images[0]);
			button.setAttribute("title", "Minimize");
			t.state="fullview" //indicate the state of the window as being "fullview"
			t.style.display="block";
			t.contentarea.style.display="block";
			if (t.resizeBool) //if this window is resizable, enable the resize icon
				t.statusarea.style.display="block";
			t.style.left=parseInt(t.lastx)+ Ext.windialog.scroll_left+"px"; //position window to last known x coord just before minimizing
			t.style.top=parseInt(t.lasty)+ Ext.windialog.scroll_top+"px";
			t.style.width=parseInt(t.lastwidth)+"px";
	},


	close:function(t){
		try{
			var closewinbol=t.onclose()
		}
		catch(err){ //In non IE browsers, all errors are caught, so just run the below
			var closewinbol=true;
	 }
		finally{ //In IE, not all errors are caught, so check if variable isn't defined in IE in those cases
			if (typeof closewinbol=="undefined"){
				alert("An error has occured somwhere inside your \"onclose\" event handler");
				var closewinbol=true;
			}
		}
		if (closewinbol){ //if custom event handler function returns true
			if (t.state!="minimized") //if this window isn't currently minimized
				 Ext.windialog.rememberattrs(t); //remember window's dimensions/position on the page before closing
			if (window.frames["_iframe-"+t.id]) //if this is an IFRAME DHTML window
				window.frames["_iframe-"+t.id].location.replace("about:blank");
			else
				t.contentarea.innerHTML="";
			t.style.display="none";
			t.isClosed=true ;//tell script this window is closed (for detection in t.show())
		}
		return closewinbol;
	},


	setopacity:function(targetobject, value){ //Sets the opacity of targetobject based on the passed in value setting (0 to 1 and in between)
		if (!targetobject)
			return;
		if (targetobject.filters && targetobject.filters[0]){ //IE syntax
			if (typeof targetobject.filters[0].opacity=="number") //IE6
				targetobject.filters[0].opacity=value*100;
			else //IE 5.5
				targetobject.style.filter="alpha(opacity="+value*100+")";
			}
		else if (typeof targetobject.style.MozOpacity!="undefined") //Old Mozilla syntax
			targetobject.style.MozOpacity=value;
		else if (typeof targetobject.style.opacity!="undefined") //Standard opacity syntax
			targetobject.style.opacity=value;
	},

	setfocus:function(t){ //Sets focus to the currently active window
		this.zIndexvalue++;
		t.style.zIndex=this.zIndexvalue;
		t.isClosed=false; //tell script this window isn't closed (for detection in t.show())
		this.setopacity(this.lastactivet.handle, 0.5); //unfocus last active window
		this.setopacity(t.handle, 1); //focus currently active window
		this.lastactivet=t;//remember last active window
	},


	show:function(t){
		if (t.isClosed){
			alert("Ext Window has been closed, so nothing to show. Open/Create the window again.")
			return;
		}
		if (t.lastx) //If there exists previously stored information such as last x position on window attributes (meaning it's been minimized or closed)
			 Ext.windialog.restore(t.controls.firstChild, t) //restore the window using that info
		else
			t.style.display="block";
		this.setfocus(t)
		t.state="fullview"; //indicate the state of the window as being "fullview"
	},

	hide:function(t){
		t.style.display="none";
	},

	ajax_loadpage:function(page_request, t) {
		if (page_request.readyState == 4 
		 && (page_request.status==200 
		 || window.location.href.indexOf("http")==-1))
		{
			t.contentarea.innerHTML=page_request.responseText;
		}
	},

	stop:function(){
		 Ext.windialog.etarget=null; //clean up
		document.onmousemove=null;
		document.onmouseup=null;
	},

	addEvent:function(target, functionref, tasktype){ //assign a function to execute to an event handler (ie: onunload)
		var tasktype=(window.addEventListener)? tasktype : "on"+tasktype;
		if (target.addEventListener)
			target.addEventListener(tasktype, functionref, false);
		else if (target.attachEvent)
			target.attachEvent(tasktype, functionref);
	},

	cleanup:function(){
		for (var i=0; i< Ext.windialog.tobjects.length; i++){
			 Ext.windialog.tobjects[i].handle._parent= Ext.windialog.tobjects[i].resizearea._parent= Ext.windialog.tobjects[i].controls._parent=null;
		}
		window.onload=null;
	}
 };

 
var _dialog = {
	mime : ['text/html','ajax/html',['text/text']],
	open : function() {
		this.place();
		var keywords = config.type.toLowerCase();
		if( typeof(config)=='object') 
		{
			switch(keywords) {
				case 'text/html' :  
					Ext.windialog.open();  
				break;
				
				case 'ajax/html' :  
					Ext.windialog.open(
						(typeof(config.ID)!='undefined' ? config.ID : 'ext-window-content-ajax'),'ajax', 
							config, 
								config.title, 
										config.style ); 
				break;
				
				case 'iframe/html' :  
					Ext.windialog.open(
						(typeof(config.ID)!='undefined' ? config.ID : 'ext-window-content-ajax'),'iframe', 
							config, 
								config.title, 
										config.style ); 
				break;
				
				case 'text/text' : 
					Ext.windialog.open(
						(typeof(config.ID)!='undefined' ? config.ID : 'ext-window-content-inline'),'inline', 
							config.text, 
								config.title, 
										config.style ); 
				break;	
			}
		}
	},
	
	place : function() {
		Ext.windialog.place = PlaceWin; 
		if( Ext.Cmp(Ext.windialog.place).IsNull() ){
			var PlaceHoder = Ext.Create("div").element();
				PlaceHoder.setAttribute('id',Ext.windialog.place);
				PlaceHoder.setAttribute('style',"border:0px;");
				
			var body = document.getElementsByTagName('body')[0];
				body.appendChild(PlaceHoder);
		}
		 
		 window.onunload = Ext.windialog.cleanup; 
	}
	
  }
  
	return ( typeof(_dialog)=='object' ? 
	  _dialog : false 
	);
}

 
})(E_ui, Ext);
 