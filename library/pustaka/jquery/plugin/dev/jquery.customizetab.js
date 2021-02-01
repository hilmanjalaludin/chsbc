/*
 *  @modul 			Plugin jquery tab customize with close 
 
 *
 *  @pack 			plugin 
 *  @auth 			omen 
 */
 
 (function() {
	var 
		fullScreenApi = { 
			supportsFullScreen: false,
			isFullScreen: function() { return false; }, 
			requestFullScreen: function() {}, 
			cancelFullScreen: function() {},
			fullScreenEventName: '',
			prefix: ''
		},
		browserPrefixes = 'webkit moz o ms khtml'.split(' ');
		//console.log(browserPrefixes);
		
	// check for native support
	if (typeof document.cancelFullScreen != 'undefined') {
		fullScreenApi.supportsFullScreen = true;
	} else {	 
		// check for fullscreen support by vendor prefix
		for (var i = 0, il = browserPrefixes.length; i < il; i++ ) {
			fullScreenApi.prefix = browserPrefixes[i];
			
			if (typeof document[fullScreenApi.prefix + 'CancelFullScreen' ] != 'undefined' ) {
				fullScreenApi.supportsFullScreen = true;
				
				break;
			}
		}
	}
	
	// update methods to do something useful
	if (fullScreenApi.supportsFullScreen) {
		fullScreenApi.fullScreenEventName = fullScreenApi.prefix + 'fullscreenchange';
		
		fullScreenApi.isFullScreen = function() {
			switch (this.prefix) {	
				case '':
					return document.fullScreen;
				case 'webkit':
					return document.webkitIsFullScreen;
				default:
					return document[this.prefix + 'FullScreen'];
			}
		}
		fullScreenApi.requestFullScreen = function(el) {
			return (this.prefix === '') ? el.requestFullScreen() : el[this.prefix + 'RequestFullScreen']();
		}
		fullScreenApi.cancelFullScreen = function(el) {
			return (this.prefix === '') ? document.cancelFullScreen() : document[this.prefix + 'CancelFullScreen']();
		}		
	}

	// jQuery plugin
	if (typeof jQuery != 'undefined') {
		jQuery.fn.requestFullScreen = function() {
	
			return this.each(function() {
				var el = jQuery(this);
				if (fullScreenApi.supportsFullScreen) {
					fullScreenApi.requestFullScreen(el);
				}
			});
		};
	}
	window.fullScreenApi = fullScreenApi;	
})();

(function($){
	$.isCollape = false;
	
 if( typeof($.fn.mytab) !=='function')
 {
	$.fn.mytab = function()
	{ 
	    $uniq = {} 
		$fn = $(this);
		$id = [$(this).attr('id'), 'close'].join("-");
		$uniq[$(this).attr('id')] = $id;
		
	// -------------------------------------------------------------------------------------------
	
	/*
	 * @ pack 		define object xtends on attribute ( $ )
	 * @ notes 		easy simple method 
     */	
		var class_extends =  
		{
			 collapse : function( elem )
			{
				var fsElement = document.getElementById(elem);
				if( fullScreenApi.isFullScreen() ) {
					window.fullScreenApi.cancelFullScreen(fsElement);
					$.isCollape = true;
					return;
				} 
				
				if( !fullScreenApi.isFullScreen() ) {
					window.fullScreenApi.requestFullScreen(fsElement);
					$(fsElement).css({'overflow' : 'auto', 'overflow-x' : 'hidden', 'background-color': '#FFFEEE'});
					$.isCollape = false;
					return;
				}	
			},
				
			close : function( func_argc, option )  
			{
				$fn = $(this);
				$id = [$(this).attr('id'), 'close'].join("-");
				 if( typeof( option ) == 'boolean' ) 
				{	
					if( $("#"+ $id ).length == 0 )
					{
						var $min = "<div id=\""+$id+"-minimize\"></div>";
							$($fn.selector +' li.ui-tab-li-lasted').after($min);
							$btn = $("#"+$id+"-minimize");
							$btn.css("-moz-user-select", "none");
							$btn.css("float", "right");
							$btn.css("margin", "2px 5px 0px 2px");
							$btn.css({ "padding": "3px 2px -1px 3px" });
							$btn.attr("unselectable","off");
							$btn.addClass("ui-icon ui-icon-plusthick ui-widget-tab-close-customize");
							$btn.bind("click", function()
							{
								$div = $(this).parent();
								if( $div.parent().attr('id') !=='' )
							  {	
								 class_extends.collapse( $div.parent().attr('id') );
								 if( $.isCollape ){
									$(this).removeClass("ui-icon-minusthick");
									$(this).addClass("ui-icon-plusthick");
								 } else {
									$(this).removeClass("ui-icon-plusthick");
									$(this).addClass("ui-icon-minusthick");
								 }	
							   }	
							});
					}	
				}
				
				 for( var arr in $uniq ) 
				 {
					if(  $("#"+ $uniq[arr] ).length == 0   ) 
					{
						if( typeof( func_argc ) =='function') 
						{
							$(this).find($uniq[arr]).remove();
							var $html = "<div id=\""+$uniq[arr]+"\"></div>";
							$("#"+arr+" li.ui-tab-li-lasted").after($html);
							thisClose = $("#"+ $uniq[arr]);
							thisClose.css({"-moz-user-select" : "none", "float" : "right", "margin" : "2px 5px 0px 2px", "padding" : "3px 2px -1px 3px", "unselectable" : "off" });
							thisClose.addClass("ui-icon ui-icon-closethick ui-widget-tab-close-customize");
							thisClose.bind("click", function() {
								if( typeof( func_argc ) =='function') {
									func_argc( $fn );
								}
							});	
						}
					}	
				}
			},	
		
			
			add: function( id )
			{
				$fn = $(this);
				var $html = "<div id=\""+id+"\"></div>";
					$($fn.selector+' li.ui-tab-li-add').after($html);
					$close = $("#"+id);
					$close.css("-moz-user-select", "none");
					$close.css("float", "right");
					$close.css("font-weight", "normal");
					$close.css("font-size", "11px");
					$close.css("margin", "5px 5px 0px 2px");
					$close.attr("unselectable","off");
			}
		}	
		
	// -------------------------------------------------------------------------------------------
	
	/*
	 * @ pack 		return extends class on jQuery ( $ )
	 * @ notes 		easy simple method 
     */	
	 
		for( var n in class_extends ) {
			if( typeof( class_extends[n] ) == 'function' ) 
				$fn[n] = class_extends[n];
		}
		
		return $fn;
	}
	
 }
 
})(jQuery) 


