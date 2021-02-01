/*
 * @ def : Panel plugin 
 * -------------------------------------------
 *
 * @ param  : onject data 
 * @ type   : helpers 
 * @ author : razaki team 
 */
 
(function(Core, Ext){
 Core.prototype.Panel = function(fn){
	return ({
		load : function( options )
		{
			var element = Ext.Cmp('dialog-container').getElementId();
			if( element == null )
			{
				var CurrStyles = new Ext.Css(fn);	
				var element = Ext.Create("div").element()
					element.setAttribute("id","dialog-container");
					element.setAttribute("class","ExtDialog box-shadow");
					element.setAttribute('style', CurrStyles.curCSS(options.style));
					
				var div1 = Ext.Create("div").element();
					div1.setAttribute("class","dialog-content-close");
					div1.setAttribute("id","dialog-content-close");
					div1.innerHTML="<a href='javascript:void(0);' id='panel-close-header' title='close'><span class='close' style='padding-bottom:4px;padding-right:6px;float:center;margin-right:6px;'></span><a>";
					element.appendChild(div1);
					
				var div2 = Ext.Create("div").element();
					div2.setAttribute("class","dialog-content-html");
					div2.setAttribute("id","dialog-content-html");
					element.appendChild(div2);	
					
					Ext.Cmp(fn).getElementId().appendChild(element);
					
				
				// run css settup 
				
					Ext.Cmp("panel-close-header").getElementId().onclick=function(){
						var removeId = Ext.Cmp('dialog-container').getElementId();
							removeId.parentNode.removeChild(removeId);
							removeId = null;
					}
					
				// run option
					
					
					
				options.content({ dialog : element.id, header : div1.id, content : div2.id });	
			}
		}
	});
 }
})(E_ui,Ext);