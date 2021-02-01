/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	EUI.Panel.js
 * @ Date		:	2/23/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

(function(b,a){b.prototype.Panel=function(c){return({load:function(d){var f=a.Cmp("dialog-container").getElementId();if(f==null){var h=new a.Css(c);var f=a.Create("div").element();f.setAttribute("id","dialog-container");f.setAttribute("class","ExtDialog box-shadow");f.setAttribute("style",h.curCSS(d.style));var g=a.Create("div").element();g.setAttribute("class","dialog-content-close");g.setAttribute("id","dialog-content-close");g.innerHTML="<a href='javascript:void(0);' id='panel-close-header' title='close'><span class='close' style='padding-bottom:4px;padding-right:6px;float:center;margin-right:6px;'></span><a>";f.appendChild(g);var e=a.Create("div").element();e.setAttribute("class","dialog-content-html");e.setAttribute("id","dialog-content-html");f.appendChild(e);a.Cmp(c).getElementId().appendChild(f);a.Cmp("panel-close-header").getElementId().onclick=function(){var i=a.Cmp("dialog-container").getElementId();i.parentNode.removeChild(i);i=null};d.content({dialog:f.id,header:g.id,content:e.id})}}})}})(E_ui,Ext);
