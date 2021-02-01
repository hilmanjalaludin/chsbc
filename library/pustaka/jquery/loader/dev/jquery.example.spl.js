// ----------------------------------------------------------------------------------------------------

/* 
 * Modul 			(SPL) loader jquery 
 *
 * @pack 			spl autoload 
 * @pack 			this param 
 * @auth 			uknown 
 */
 
var Spl = function() {

	this.getScriptURL = function(){
	   var scripts  = (document.getElementsByTagName('script')),
		   index = ((scripts.length)-1), 
		   myScript = (scripts[index]);
	   return myScript.src; 
	},
	
	this.Arr = function( arr ){
		var _arr = 
		{
			remove : function( vals, all ) 
			{
				var i, removedItems = [];
				if( typeof( vals ) != 'object' ) {
					vals = [vals];
				}	
				
				for (var j=0;j<vals.length; j++) 
				{
					  if ( all ) 
					  {
						for(i = arr.length; i--;)
						{
						    if (arr[i] === vals[j]) {
								removedItems.push(arr.splice(i, 1));
							}		
						}
					  }
					  else {
						i = arr.indexOf(vals[j]);
							if(i>-1) {
								removedItems.push(arr.splice(i, 1));
							}		
					  }
				 }
				  return removedItems;
			}
		}	
		return ( typeof( _arr ) == 'object' ? _arr : {});	
	},
	
	this.parse_url = function()
	{	
		var url = this.getScriptURL().split("/"),  arr_url = {}, arr_src = [], patern = "/&/";
		// --------- remove its ------------
		this.Arr(url).remove(["loader","dev","min"], true);
		for( var q in url ) {
			if( url[q]=='' || url[q].toString().match(/[&]/g)==null) {
				if( url[q]!=='spl' ){
					arr_url[url[q]] = url[q];
				}
			}
			
			if( url[q]!='' && url[q].toString().match(/[&]/)!= null) {
				arr_src.push(url[q]); 
			}
		}
		
		var obj_select = {};
		var object_json = arr_src.map(function( item ) {
			var arr_explode = item.split("?")[1].split("&");
			for( var p in arr_explode )
			{
			  obj_select[arr_explode[p].split("=")[0]] = arr_explode[p].split("=")[1];
			}
			
		});
		
		var real_url = Object.keys(arr_url).join("/");
		return {
			url  : Object.keys(arr_url).join("/"),
			time : obj_select.time,
			ver  : obj_select.version	
		}
	},
	
	this.Core = function( filename ){
		var js_native_code = 'min';
		if( this.getScriptURL().indexOf('dev')!=-1 ){ 
			js_native_code = 'dev';
		}	
		
		var dir_js_core = new Array('cores', js_native_code);
		var file_js_core = new Array(filename,'js');
		return new Array(dir_js_core.join('/'), file_js_core.join('.')).join('/');
	},
	
	this.Frame = function( filename ){
		var js_native_code = 'min';
		if( this.getScriptURL().indexOf('dev')!=-1 ){ 
			js_native_code = 'dev';
		}	
		var dir_js_frame = new Array('frame', js_native_code);
		var file_js_frame = new Array(filename,'js');
		return new Array(dir_js_frame.join('/'), file_js_frame.join('.')).join('/');
	},
	
	this.Plugin = function( filename ){
		var js_native_code = 'min';
		if( this.getScriptURL().indexOf('dev')!=-1 ){ 
			js_native_code = 'dev';
		}	
		var dir_js_plugin = new Array('plugin', js_native_code), 
			file_js_plugin = new Array(filename,'js');
		
		return new Array(dir_js_plugin.join('/'), file_js_plugin.join('.')).join('/');
	},
	
	this.Inialize = function( file ){
		var object_url = this.parse_url();
		for( var obj in file ) {
			var arr_file_script = object_url.url +'/'+ file[obj] +"?version="+object_url.ver+"&amp;time="+object_url.time;
			document.write("<script type='text/javascript' src='"+ arr_file_script +"'></script>\n");
		}	
   }
   
   return this;
};

// ----------------------------------------------------------------------------------------------------

/* 
 * Modul 			(SPL) loader jquery 
 *
 * @pack 			spl autoload 
 * @pack 			this param 
 * @auth 			uknown 
 */
var Spl = new Spl();
	Spl.Inialize
	([
		Spl.Frame('jquery-ui'),
		Spl.Plugin('jquery.bgiframe'),
		Spl.Plugin('extToolbars'),
		Spl.Plugin('jquery.autocomplete')
		Spl.Plugin('jquery.notifyomen'),
		Spl.Plugin('jquery.treetable'),
		Spl.Plugin('Scoring') 
		
		 // "/core/jquery-1.7.2.min.js",
		 // "/plugins/jquery.bgiframe.js",
		 // "/plugins/extToolbars.js",
		 // "/plugins/jquery.timer.js",
		 // "/plugins/jquery.cookies.js",
		 // "/plugins/jquery.seletdown.js",
		 // "/plugins/jquery.customizetab.js",
		 // "/plugins/jquery.choose.js",
		 // "/core/jquery-ui-1.8.18.min.js",
		 // "/plugins/jquery.autocomplete.js",
		 // "/plugins/jquery.mask.js",
		 // "/chart/highcharts.src.js",
		 // "/chart/themes/grid-light.js",
		 // "/chart/modules/exporting.src.js",
		 // "/chart/modules/offline-exporting.src.js",
		 // "/plugins/clipboard.min.js",
		 // "/plugins/jquery.notifyomen.js",
		 // "/plugins/jquery.cleditor.min.js"
	]);
