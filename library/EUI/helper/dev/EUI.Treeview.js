/*
 * @ def : Treeview plugin 
 * -------------------------------------------
 *
 * @ param  : onject data { } 
 * @ type   : helpers 
 * @ author : razaki team 
 * @ link 	: http://razakitechnology.com/siteraztech/product/web-application/eui-framework
 */
 
(function(Core, Ext){
 Core.prototype.TreeView = function(container) {
	var persisteduls=new Object();
	var treeview = {
		TreeViewId 	: container,
		closefolder : Ext.DOM.LIBRARY+"/gambar/icon/closed.gif",
		openfolder  : Ext.DOM.LIBRARY+"/gambar/icon/open.gif",

	//////////No need to edit beyond here///////////////////////////

		Create : function(enablepersist, persistdays) {
			var ultags=Ext.Cmp(container).getElementId().getElementsByTagName("ul");
			if (typeof persisteduls[container]=="undefined")
				persisteduls[container]=(enablepersist==true && Ext.TreeView(container).getCookie(container)!="")? Ext.TreeView(container).getCookie(container).split(",") : "";
			for (var i=0; i<ultags.length; i++)
				Ext.TreeView(container).buildSubTree(container, ultags[i], i);
			if (enablepersist==true){ //if enable persist feature
			var durationdays=(typeof persistdays=="undefined")? 1 : parseInt(persistdays)
				Ext.TreeView(container).dotask(window, function(){Ext.TreeView(container).rememberstate(container, durationdays)}, "unload"); //save opened UL indexes on body unload
			}
		},
		
		getSelectionModel: function( fn ){
			fn(this);
		},

		//////////No need to edit beyond here///////////////////////////

		buildSubTree : function(treeid, ulelement, index)
		{
			ulelement.parentNode.className="submenu"
			if (typeof persisteduls[treeid]=="object")
			{ 
				if (Ext.TreeView(container).searcharray(persisteduls[treeid], index))
				{
					ulelement.setAttribute("rel", "open");
					ulelement.style.display="block";
					ulelement.parentNode.style.backgroundImage="url("+Ext.TreeView(container).openfolder+")";
				}
				else
					ulelement.setAttribute("rel", "closed");
					
			} 
			else if (ulelement.getAttribute("rel")==null || ulelement.getAttribute("rel")==false) 
				ulelement.setAttribute("rel", "closed");
				
			else if (ulelement.getAttribute("rel")=="open")
				Ext.TreeView(container).expandSubTree(treeid, ulelement);
				
				ulelement.parentNode.onclick=function(e)
				{
					var submenu =this.getElementsByTagName("ul")[0];
					
					if (submenu.getAttribute("rel")=="closed"){
						submenu.style.display="block";
						submenu.setAttribute("rel", "open");
						ulelement.parentNode.style.backgroundImage="url("+Ext.TreeView(container).openfolder+")";
					}
					else if (submenu.getAttribute("rel")=="open"){
						submenu.style.display="none";
						submenu.setAttribute("rel", "closed");
						ulelement.parentNode.style.backgroundImage="url("+Ext.TreeView(container).closefolder+")";
					}
					Ext.TreeView(container).preventpropagate(e);
				}
				ulelement.onclick=function(e){
					Ext.TreeView(container).preventpropagate(e);
				}
		},

		expandSubTree : function(treeid, ulelement)
		{
			var rootnode = Ext.Cmp(treeid).getElementId(),
				currentnode = ulelement;
			
				currentnode.style.display="block";
				currentnode.parentNode.style.backgroundImage="url("+Ext.TreeView(container).openfolder+")";
				
			while (currentnode!=rootnode)
			{
				if (currentnode.tagName=="UL")
				{ 
					currentnode.style.display="block";
					currentnode.setAttribute("rel", "open"); //indicate it's open
					currentnode.parentNode.style.backgroundImage="url("+Ext.TreeView(container).openfolder+")";
				}
				currentnode=currentnode.parentNode;
			}
		},

		flatten : function(treeid, action)
		{ 
			var ultags=Ext.Cmp(treeid).getElementId().getElementsByTagName("ul");
			for (var i=0; i<ultags.length; i++){
			ultags[i].style.display=(action=="expand")? "block" : "none";
			var relvalue=(action=="expand")? "open" : "closed";
			ultags[i].setAttribute("rel", relvalue);
			ultags[i].parentNode.style.backgroundImage=(action=="expand")? "url("+Ext.TreeView(container).openfolder+")" : "url("+Ext.TreeView(container).closefolder+")";
			}
		},

		rememberstate:function(treeid, durationdays)
		{ 
			var ultags=Ext.Cmp(treeid).getElementId().getElementsByTagName("ul");
			var openuls=new Array()
			for (var i=0; i<ultags.length; i++)
			{
				if (ultags[i].getAttribute("rel")=="open")
				openuls[openuls.length]=i; //save the index of the opened UL (relative to the entire list of ULs) as an array element
			}
			if (openuls.length==0) //if there are no opened ULs to save/persist
				openuls[0]="none open"; //set array value to string to simply indicate all ULs should persist with state being closed
			
			Ext.TreeView(container).setCookie(treeid, openuls.join(","), durationdays); //populate cookie with value treeid=1,2,3 etc (where 1,2... are the indexes of the opened ULs)
		},

		////A few utility functions below//////////////////////

		getCookie:function(Name)
		{ 
			var re=new RegExp(Name+"=[^;]+", "i"); //construct RE to search for target name/value pair
			if (document.cookie.match(re)){//if cookie found
				return document.cookie.match(re)[0].split("=")[1]; //return its value
			}
			return '';
		},

		setCookie:function(name, value, days)
		{
			var expireDate = new Date();
			var expstring=expireDate.setDate(expireDate.getDate()+parseInt(days));
			document.cookie = name+"="+value+"; expires="+expireDate.toGMTString()+"; path=/";
		},

		searcharray:function(thearray, value)
		{ 
			var isfound=false
			for (var i=0; i<thearray.length; i++){
			if (thearray[i]==value){
					isfound=true;
					thearray.shift(); 
				break;
			 }
		    }
		 return isfound;
		},

		preventpropagate:function(e){ 
			if (typeof e!="undefined")
				e.stopPropagation();
		else
			event.cancelBubble=true;
		},

		dotask : function(target, functionref, tasktype)
		{ 
			var tasktype=(window.addEventListener)? tasktype : "on"+tasktype;
			
			if (target.addEventListener)
				target.addEventListener(tasktype, functionref, false);
			else if (target.attachEvent)
				target.attachEvent(tasktype, functionref);
		}
   }
   return treeview;
 }
 
})(E_ui,Ext);