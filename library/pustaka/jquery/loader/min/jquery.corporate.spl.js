/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	jquery.corporate.spl.js
 * @ Date		:	3/17/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

var Spl=function(){this.getScriptURL=function(){var a=(document.getElementsByTagName("script")),b=((a.length)-1),c=(a[b]);return c.src},this.Arr=function(a){var b={remove:function(g,f){var e,c=[];if(typeof(g)!="object"){g=[g]}for(var d=0;d<g.length;d++){if(f){for(e=a.length;e--;){if(a[e]===g[d]){c.push(a.splice(e,1))}}}else{e=a.indexOf(g[d]);if(e>-1){c.push(a.splice(e,1))}}}return c}};return(typeof(b)=="object"?b:{})},this.parse_url=function(){var e=this.getScriptURL().split("/"),d={},h=[],c="/&/";this.Arr(e).remove(["loader","dev","min"],true);for(var g in e){if(e[g]==""||e[g].toString().match(/[&]/g)==null){if(e[g]!=="spl"){d[e[g]]=e[g]}}if(e[g]!=""&&e[g].toString().match(/[&]/)!=null){h.push(e[g])}}var a={};var b=h.map(function(i){var k=i.split("?")[1].split("&");for(var j in k){a[k[j].split("=")[0]]=k[j].split("=")[1]}});var f=Object.keys(d).join("/");return{url:Object.keys(d).join("/"),time:a.time,ver:a.version}},this.Core=function(a){var d="min";if(this.getScriptURL().indexOf("dev")!=-1){d="dev"}var c=new Array("cores",d);var b=new Array(a,"js");return new Array(c.join("/"),b.join(".")).join("/")},this.Frame=function(c){var d="min";if(this.getScriptURL().indexOf("dev")!=-1){d="dev"}var a=new Array("frame",d);var b=new Array(c,"js");return new Array(a.join("/"),b.join(".")).join("/")},this.Plugin=function(a){var d="min";if(this.getScriptURL().indexOf("dev")!=-1){d="dev"}var c=new Array("plugin",d),b=new Array(a,"js");return new Array(c.join("/"),b.join(".")).join("/")},this.Inialize=function(b){var a=this.parse_url();for(var c in b){var d=a.url+"/"+b[c]+"?version="+a.ver+"&amp;time="+a.time;document.write("<script type='text/javascript' src='"+d+"'><\/script>\n")}};return this};var Spl=new Spl();Spl.Inialize([Spl.Frame("jquery-ui"),Spl.Plugin("jquery.bgiframe"),Spl.Plugin("extToolbars"),Spl.Plugin("jquery.choose"),Spl.Plugin("jquery.cookies"),Spl.Plugin("jquery.seletdown"),Spl.Plugin("jquery.customizetab"),Spl.Plugin("jquery.autocomplete"),Spl.Plugin("jquery.mask"),Spl.Plugin("jquery.spiner"),Spl.Plugin("jquery.notifyomen"),Spl.Plugin("jquery.treetable")]);
