// --------------------------------------------------------------------------------------

/*
 * Modul 		launcer js layout every layout ackomodir here
 * 
 * @pack		all project layout 
 * @auth		uknown user 
 * 
 */
 
;(function( core ){
 core.prototype.Inialize = function( core )
{

 var quick_class_load = {};
 var core_class_root = core;

 var init = {  
  url 	: Ext.System.view_library_url(),
  time 	: Ext.Date().getDuration(),
  ver	: Ext.define.version
 }; return  {
		quick_class_views  : {},
		quick_class_helper : {},
		quick_class_plugin : {},
		
		View : function( view ){
			this.quick_class_views[view] = init.url +"/"+ core_class_root +"/views/"+view+".js?version="+ init.ver +"&amp;time="+ init.time;
			this.loader(this.quick_class_views);
		},
			
		Helper : function( helper ){
			this.quick_class_helper[helper] = init.url+"/"+core_class_root+"/helper/"+helper +".js?version="+ init.ver +"&amp;time="+ init.time;
			this.loader(this.quick_class_helper);
		},
			
		loader : function( obj ){
			if( typeof(obj)=='object')
				for( var q in obj )
			{
				document.write('<script language="text/javascript" type="text/javascript" src="'+ obj[q] +'"></script>');
			}
		},
		$ : function( plugin ){
			this.quick_class_plugin[plugin] = init.url+"/"+core_class_root+"/"+plugin +".js?version="+ init.ver +"&amp;time="+ init.time;
			$(function(){
				for( var i in this.quick_class_plugin ){
					$.getScript(this.quick_class_plugin[i],function(data){ });
				}
			});
		}
	};
 }
 
})(E_ui);


// --------------------------------------------------------------------------- end quick


 