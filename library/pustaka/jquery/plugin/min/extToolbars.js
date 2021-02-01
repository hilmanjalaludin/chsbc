/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	extToolbars.js
 * @ Date		:	2/23/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

(function(a){a.fn.extToolbars=function(b){var c=a.extend({},a.fn.extToolbars.defaults,b);return this.each(function(){if(!a(".ui-widget-toolbars",this).length){a.fn.extToolbars.defaults.uniqID++;a('<div class="ui-widget-toolbars" id="ui-widget-toolbars-id'+a.fn.extToolbars.defaults.uniqID+'">').appendTo(this);a.fn.extToolbars.defaults.cbs[a.fn.extToolbars.defaults.uniqID]=c.cb;a(".ui-widget-toolbars",this).css(c.css)}var h=a(".ui-widget-toolbars",this);var l=h.attr("id");var f="";var g=c.extIcon.length;var j=c.extMenu.length;var k=(c.extInput!=""?c.extInput:0);f="<ul>";for(var e=0;e<g;e++){var d="middle";if(e==(g-1)){d="lasted"}f+="<li class='"+d+"'>"+(k?a.fn.extToolbars.input(c.extOption,e):"")+"<a href='javascript:void(0);' style='text-decoration:none;' id='"+c.extMenu[e]+"' "+(c.extMenu[e]==0?"":"onclick='"+c.extMenu[e]+"();'")+" style='margin-left:10px;'>"+(c.extIcon[e]!=""?"<img src='"+(c.extUrl?c.extUrl:"")+"/"+c.extIcon[e]+"' border='0' align='middle' style='margin-top:-5px;' alt='0'>":"")+""+(c.extText?"<span class='ui-li-ext-toolbar' style='margin-left:8px;vertical-align:middle;border:0px solid #000000;'>"+c.extTitle[e]+"</span>":"")+"</a></li>"}f+="</ul>";a("#"+l).html(f)})};a.fn.extToolbars.input=function(f,j){var e=f.length;var d="";for(var c=0;c<e;c++){if(f[c].render==j){switch(f[c].type){case"text":d+="<input type='text' name='"+f[c].name+"' id='"+f[c].id+"' "+(f[c].width?"style='width:"+f[c].width+"px;'":"")+" value='"+f[c].value+"'>";break;case"label":d+="<div class='label' id='"+f[c].id+"' "+(f[c].width?"style='border:0px solid #000000;color:red;width:"+f[c].width+"px;'":"")+">"+f[c].label+"</div>";break;case"combo":var h=f[c].store;d+=(f[c].header?"<b>"+f[c].header+"&nbsp;:&nbsp; </b>":"");d+="<select "+(f[c].width?"style='width:"+f[c].width+"px;'":"")+" "+(f[c].triger!=""?"onchange='"+f[c].triger+"(this.value);'":"")+" name='"+f[c].name+"' id='"+f[c].id+"'>";d+="<option value=''>--Choose--</option>";for(var b in h){for(var g in h[b]){if(g==f[c].value){d+="<option value='"+g+"' selected>"+h[b][g]+"</option>"}else{d+="<option value='"+g+"'>"+h[b][g]+"</option>"}}}d+="</select>";break}}}return d};a.fn.extToolbars.defaults={cbs:[],pages:0,current:0,max:10,uniqID:0,flip:false,css:{fontFamily:"arial",border:1},blockCss:{display:"block","float":"left"},borderColor:"#444"}})(jQuery);
