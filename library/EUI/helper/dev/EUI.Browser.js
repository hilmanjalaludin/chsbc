
/*
 * @ def 		:  detect Browser type 
 * 
 * @ param  	: get handle ActiveBars by JAVASCRIPT 
 * @ Author  	: omens < jombi_par@yahoo.com > 
 * @ Method		: public 
 */
 
(function( Core ){ 
 
Core.prototype.Browser = function( window ) 
{
  var window = ( window ? window : Ext.DOM ), a  = 
  {
	getName :function(){
	    try { return  ( window.navigator.appName ? window.navigator.appName  : null ); }
		catch(e)
		{
			Ext.Error
			({
				log  : e,
				name : window.navigator,
				lineNumber: e.lineNumber
			});  
		}
	},
		
	getCode :function(){
		try { return  ( window.navigator.appCodeName ? window.navigator.appCodeName  : null ); }
		catch(e)
		{
			Ext.Error
			({
				log  : e, name : window.navigator, lineNumber: e.lineNumber
			});  
		}
    },
		
	getVersion:function(){	
		try { return  ( window.navigator.appVersion ? window.navigator.appVersion  : null ); }
		catch(e)
		{
			Ext.Error
			({
				log  : e, name : window.navigator, lineNumber: e.lineNumber
			});  
		}
	},
		
	getBuildID:function()
	{
		try { return  ( window.navigator.buildID ? window.navigator.buildID  : null ); }
		catch(e)
		{
			Ext.Error
			({
				log  : e, name : window.navigator, lineNumber: e.lineNumber
			});  
		}
			
	},
	
	getPlatform : function(){
		try { return  ( window.navigator.platform ? window.navigator.platform  : null ); }
		catch(e)
		{
			Ext.Error
			({
				log  : e, name : window.navigator, lineNumber: e.lineNumber
			});  
		}
	}
	
 }; return ( a ? a: Ext.Error({log : 'Not found of property', name :'Ext.Browser() '})); }
 
})( E_ui );