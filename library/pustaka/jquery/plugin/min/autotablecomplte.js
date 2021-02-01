/*
 * Script Compressor v1.2.0 
 
 * ---------------------------------------------------------------------------------
 * Copyright (c) 2015 http://razakitechnology.com/application
 * generator compress javascript to minimize script production
 * and GPL licenses.
 * ----------------------------------------------------------------------------------
 
 * @ Depends	:	autotablecomplte.js
 * @ Date		:	2/23/2016
 * @ Author		:	razaki development team
 * @ Email		:	jombi_par@yahoo.com
 *
 */

(function(a){a.fn.tautocomplete=function(c,e){var w=a.extend({width:"500px",columns:[],onchange:null,norecord:"No Records Found",dataproperty:null,regex:"^[a-zA-Z0-9\b]+$",data:null,placeholder:null,theme:"default",ajax:null},c);var g=[["default","adropdown"],["classic","aclassic"],["white","awhite"]];g.filter(function(A,B){if(A[0]==w.theme){w.theme=A[1];return}});var b={ddDiv:a("<div>",{"class":w.theme}),ddTable:a("<table></table>",{style:"width:"+w.width}),ddTableCaption:a("<caption>"+w.norecord+"</caption>"),ddTextbox:a("<input type='text'>")};var o={UP:38,DOWN:40,ENTER:13,TAB:9};var h={columnNA:"Error: Columns Not Defined",dataNA:"Error: Data Not Available"};var q={id:function(){return b.ddTextbox.data("id")},text:function(){return b.ddTextbox.data("text")},searchdata:function(){return b.ddTextbox.val()},isNull:function(){if(b.ddTextbox.data("id")==""){return true}else{return false}}};var x=(function(){var i=0;return function(B,A){clearTimeout(i);i=setTimeout(B,A)}})();var j=false;if(this.is(":focus")){j=true}var l=w.columns.length;var k=this;this.wrap("<div class='acontainer'></div>");this.after(b.ddTextbox);b.ddTextbox.attr("autocomplete","off");b.ddTextbox.css("width",this.width+"px");b.ddTextbox.css("font-size",this.css("font-size"));b.ddTextbox.attr("placeholder",w.placeholder);if(w.columns==""||w.columns==null){b.ddTextbox.attr("placeholder",h.columnNA)}else{if((w.data==""||w.data==null)&&w.ajax==null){b.ddTextbox.attr("placeholder",h.dataNA)}}if(w.dataproperty!=null){for(var z in w.dataproperty){b.ddTextbox.attr("data-"+z,w.dataproperty[z])}}this.after(b.ddDiv);this.hide();b.ddDiv.append(b.ddTable);b.ddTable.attr("cellspacing","0");b.ddTable.append(b.ddTableCaption);var u="<thead><tr>";for(var v=0;v<=l-1;v++){u=u+"<th>"+w.columns[v]+"</th>"}u=u+"</thead></tr>";b.ddTable.append(u);var r="",m="";if(this.val()!=""){var y=this.val().split("#$#");r=y[0];m=y[1]}b.ddTextbox.attr("data-id",r);b.ddTextbox.attr("data-text",m);b.ddTextbox.val(m);if(j){b.ddTextbox.focus()}b.ddTextbox.keyup(function(i){if((i.keyCode<46||i.keyCode>90)&&(i.keyCode!=8)){i.preventDefault();return}x(function(){if(b.ddTextbox.val()==""){n();return}b.ddTableCaption.hide();b.ddTextbox.addClass("loading");if(w.ajax!=null){var B=null;if(a.isFunction(w.ajax.data)){B=w.ajax.data.call(this)}else{B=A}a.ajax({type:w.ajax.type||"GET",dataType:"json",contentType:w.ajax.contentType||"application/json; charset=utf-8",headers:w.ajax.headers||{"Content-Type":"application/x-www-form-urlencoded"},data:B||null,url:w.ajax.url,success:d,error:function(E,C,D){b.ddTextbox.removeClass("loading");alert("Error: "+E.status||" - "||D)}})}else{if(a.isFunction(w.data)){var A=w.data.call(this);p(A)}else{}}},1000)});function d(i){if(w.ajax.success==null||w.ajax.success==""||(typeof w.ajax.success==="undefined")){p(i)}else{if(a.isFunction(w.ajax.success)){var A=w.ajax.success.call(this,i);p(A)}}}b.ddTextbox.keypress(function(B){var A=new RegExp(w.regex);var i=String.fromCharCode(!B.charCode?B.which:B.charCode);if(!A.test(i)){B.preventDefault();return false}});b.ddTextbox.keydown(function(B){var i=b.ddTable.find("tbody");var A=i.find(".selected");if(B.keyCode==o.ENTER){B.preventDefault();s()}if(B.keyCode==o.UP){b.ddTable.find(".selected").removeClass("selected");if(A.prev().length==0){i.find("tr:last").addClass("selected")}else{A.prev().addClass("selected")}}if(B.keyCode==o.DOWN){i.find(".selected").removeClass("selected");if(A.next().length==0){i.find("tr:first").addClass("selected")}else{b.ddTable.find(".selected").removeClass("selected");A.next().addClass("selected")}}});b.ddTable.delegate("tr","mousedown",function(){b.ddTable.find(".selected").removeClass("selected");a(this).addClass("selected");s()});b.ddTextbox.focusout(function(){n();if(a(this).val()!=a(this).data("text")){var i=true;if(a(this).data("text")==""){i=false}a(this).data("text","");a(this).data("id","");a(this).val("");k.val("");if(i){t()}}});function s(){var i=b.ddTable.find("tbody").find(".selected");b.ddTextbox.data("id",i.find("td").eq(0).text());b.ddTextbox.data("text",i.find("td").eq(1).text());b.ddTextbox.val(i.find("td").eq(1).text());k.val(i.find("td").eq(0).text()+"#$#"+i.find("td").eq(1).text());n();t();b.ddTextbox.focus()}function t(){if(a.isFunction(w.onchange)){w.onchange.call(this)}else{}}function n(){b.ddTable.hide();b.ddTextbox.removeClass("inputfocus");b.ddDiv.removeClass("highlight");b.ddTableCaption.hide()}function f(){var A=(b.ddTextbox.height()+20)+"px 1px 0px 1px";var i="1px 1px "+(b.ddTextbox.height()+20)+"px 1px";b.ddDiv.css("top","0px");b.ddDiv.css("left","0px");b.ddTable.css("margin",A);b.ddTextbox.addClass("inputfocus");b.ddDiv.addClass("highlight");b.ddTable.show();if(!isDivHeightVisible(b.ddDiv)){b.ddDiv.css("top",-1*(b.ddTable.height())+"px");b.ddTable.css("margin",i);if(!isDivHeightVisible(b.ddDiv)){b.ddDiv.css("top","0px");b.ddTable.css("margin",A);a("html, body").animate({scrollTop:(b.ddDiv.offset().top-60)},250)}}if(!isDivWidthVisible(b.ddDiv)){b.ddDiv.css("left","-"+(b.ddTable.width()-b.ddTextbox.width()-20)+"px")}}function p(E){try{b.ddTextbox.removeClass("loading");b.ddTable.find("tbody").find("tr").remove();var D=0,B=0;var H=null,A=null;if(E!=null){for(D=0;D<E.length;D++){if(D>=15){continue}var G=E[D];H="";B=0;for(var C in G){if(B<=l){A=G[C];H=H+"<td>"+A+"</td>"}else{continue}B++}b.ddTable.append("<tr>"+H+"</tr>")}}if(D==0){b.ddTableCaption.show()}b.ddTable.find("td:nth-child(1)").hide();b.ddTable.find("tbody").find("tr:first").addClass("selected");f()}catch(F){alert("Error: "+F)}}return q}}(jQuery));function isDivHeightVisible(c){var e=$(window).scrollTop();var d=e+$(window).height();var a=$(c).offset().top;var b=a+$(c).height();return((b>=e)&&(a<=d)&&(b<=d)&&(a>=e))}function isDivWidthVisible(c){var e=$(window).scrollLeft();var d=e+$(window).width();var b=$(c).offset().left;var a=b+$(c).width();return((a>=e)&&(b<=d)&&(a<=d)&&(b>=e))};
