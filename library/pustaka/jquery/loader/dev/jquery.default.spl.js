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
	
	this.parse_url = function(){	
		var url = this.getScriptURL().split("/"),  arr_url = {}, arr_src = [], patern = "/&/";
		// --------- remove its ------------
		this.Arr(url).remove(["dev","min"], true);
		
		for( var q in url )
		{
			if( url[q]=='' || url[q].toString().match(/[&]/g)==null)
			{
				arr_url[url[q]] = url[q];
			}
			
			if( url[q]!='' && url[q].toString().match(/[&]/)!= null)
			{
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
	
	this.Inialize = function( file ){
		var object_url = this.parse_url();
		for( var obj in file ) {
			var arr_file_script = object_url.url + file[obj] +"?version="+object_url.ver+"&amp;time="+object_url.time;
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
 
Spl().Inialize([
 "/ui/jquery-1.7.2.min.js",
 "/external/bgiframe/jquery.bgiframe.js",
 "/plugins/extToolbars.js",
 "/plugins/jquery.timer.js",
 "/plugins/jquery.cookies.js",
 "/plugins/jquery.seletdown.js",
 "/plugins/jquery.customizetab.js",
 "/ui/jquery-ui-1.8.18.min.js",
 "/plugins/jquery.autocomplete.js",
 "/plugins/jquery.mask.js",
 "/Highcharts-4.1.8/highcharts.src.js",
 "/Highcharts-4.1.8/themes/grid-light.js",
 "/Highcharts-4.1.8/modules/exporting.js",
 "/plugins/clipboard.min.js"
 
]);
