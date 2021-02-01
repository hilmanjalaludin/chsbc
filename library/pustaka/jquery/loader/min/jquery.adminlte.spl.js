/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	jquery.adminlte.spl.js
 * @ Date		:	12/16/2015
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

var Spl=function(){this.getScriptURL=function(){var a=(document.getElementsByTagName("script")),b=((a.length)-1),c=(a[b]);return c.src},this.Arr=function(a){var b={remove:function(g,f){var e,c=[];if(typeof(g)!="object"){g=[g]}for(var d=0;d<g.length;d++){if(f){for(e=a.length;e--;){if(a[e]===g[d]){c.push(a.splice(e,1))}}}else{e=a.indexOf(g[d]);if(e>-1){c.push(a.splice(e,1))}}}return c}};return(typeof(b)=="object"?b:{})},this.parse_url=function(){var e=this.getScriptURL().split("/"),d={},h=[],c="/&/";this.Arr(e).remove(["dev","min"],true);for(var g in e){if(e[g]==""||e[g].toString().match(/[&]/g)==null){if(e[g]!=="spl"){d[e[g]]=e[g]}}if(e[g]!=""&&e[g].toString().match(/[&]/)!=null){h.push(e[g])}}var a={};var b=h.map(function(i){var k=i.split("?")[1].split("&");for(var j in k){a[k[j].split("=")[0]]=k[j].split("=")[1]}});var f=Object.keys(d).join("/");return{url:Object.keys(d).join("/"),time:a.time,ver:a.version}},this.Inialize=function(b){var a=this.parse_url();for(var c in b){var d=a.url+b[c]+"?version="+a.ver+"&amp;time="+a.time;document.write('<script language="text/javascript" type="text/javascript" src="'+d+'"><\/script>')}};return this};Spl().Inialize(["/core/jquery-1.7.2.min.js","/plugins/jquery.bgiframe.js","/plugins/extToolbars.js","/plugins/jquery.timer.js","/plugins/jquery.cookies.js","/plugins/jquery.seletdown.js","/plugins/jquery.customizetab.js","/plugins/jquery.choose.js","/core/jquery-ui-1.8.18.min.js","/plugins/jquery.autocomplete.js","/plugins/jquery.mask.js","/chart/highcharts.src.js","/chart/themes/grid-light.js","/chart/modules/exporting.src.js","/chart/modules/offline-exporting.src.js","/plugins/clipboard.min.js","/plugins/jquery.notifyomen.js","/plugins/jquery.cleditor.min.js"]);
