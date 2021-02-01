// --------------------------------------------------------------------------------------

/*
 * Modul 		launcer js layout every layout ackomodir here
 * 
 * @pack		all project layout 
 * @auth		uknown user 
 * 
 */

 var getScriptURL = (function() 
{
   var scripts  = (document.getElementsByTagName('script')),
	   index = ((scripts.length)-1), 
	   myScript = (scripts[index]);
    
   return function(){
	  return myScript.src; 
   }
   
})();
//----------------------------------------------------------
;(function($fn){
  var conf_class_layout = {
	layout : "razakier",
	root   : "js"
  };
  
  var launcher = function( conf_root_class )
 {
	var conf_base_url = $fn.System.view_library_url(),
		conf_base_tms = $fn.Date().getDuration(),
		conf_base_ver = $fn.define.version;
		 
	
  // simulate return of function object class ---------------------------------------------------------------
	return {
		isload : { },		
		load :function( file ) 
		{
			this.isload[conf_base_url] = conf_base_url;
			this.isload[conf_root_class] = conf_root_class;
			this.isload[conf_class_layout.layout] = conf_class_layout.layout;
			this.isload[conf_class_layout.root] = conf_class_layout.root;
			
			if( this.isload.length != 0)
			{
				var _BASE_ROOT_URL = Object.keys(this.isload).join("/"),
					_BASE_ARR_URL = _BASE_ROOT_URL +'/'+ file +'.js?layout='+ conf_class_layout.layout +'&amp;version='+conf_base_ver+'&amp;time='+ conf_base_tms;
				
				if( _BASE_ARR_URL ) {
					document.write("<script language=\"text/javascript\" type=\"text/javascript\" src=\""+ _BASE_ARR_URL +"\"></script>");
				}
			}
			
		},
		core : function( jsfile ){
			if( getScriptURL().indexOf('dev')!=-1 ){
				return new Array('dev',jsfile).join('/');
			}
			else if( getScriptURL().indexOf('min') !=-1 ){
				return new Array('min',jsfile).join('/');
			}
		},
		self : function( jsfile ){
			if( getScriptURL().indexOf('dev')!=-1 ){
				return new Array('dev',jsfile).join('/');
			}
			else if( getScriptURL().indexOf('min')!= -1 ){
				return new Array('min',jsfile).join('/');
			}
		} 
	}	
 }

// ---------- call class ------------------------------ 
var DeployLayout = new launcher("styles"); 

// ------------------------ end function ----------------------------------
// ---------------------------------------------------------------------------

/* Modul 			loader automatic class EUI Core && view 
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */
 
 new Ext.Inialize("EUI").View(DeployLayout.core('EUI.Main'));
 new Ext.Inialize("EUI").View(DeployLayout.core('EUI.Contact'));
 
// ---------------------------------------------------------------------------

/* Modul 			loader automatic class EUI Core && view 
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */
 
 new Ext.Inialize("EUI").Helper(DeployLayout.core("EUI.jQueryMsg"));
 new Ext.Inialize("EUI").Helper(DeployLayout.core("EUI.Purr"));
 new Ext.Inialize("EUI").Helper(DeployLayout.core("EUI.jQuery"));
 new Ext.Inialize("EUI").Helper(DeployLayout.core("EUI.ActiveMenu"));
 new Ext.Inialize("EUI").Helper(DeployLayout.core("EUI.CTIScript"));
 new Ext.Inialize("EUI").Helper(DeployLayout.core("EUI.Dialog"));
 new Ext.Inialize("EUI").Helper(DeployLayout.core("EUI.Media"));
 new Ext.Inialize("EUI").Helper(DeployLayout.core("EUI.Masking"));
 new Ext.Inialize("EUI").Helper(DeployLayout.core("EUI.Chat"));
 //new Ext.Inialize("EUI").Helper(DeployLayout.core("EUI.MenuRole"));
 // new Ext.Inialize("EUI").Helper(DeployLayout.core("EUI.Spell"));
 //new Ext.Inialize("EUI").Helper(DeployLayout.core("EUI.Lang")); 
 



// include if IE Browser version 
if( window.isMSIE ){
	new Ext.Inialize("EUI").View(DeployLayout.core("EUI.1.3.15.IE"));
}
// ---------------------------------------------------------------------------

/* Modul 			loader local class object js every layout like here 
 * 
 * @pack 			object class EUI 
 * @auth 			uknown 
 */
 
 DeployLayout.load( DeployLayout.self("razakier.user") );
 DeployLayout.load( DeployLayout.self("metisMenu") );
 DeployLayout.load( DeployLayout.self("sb-razakier-2") );
 
})(Ext);