// -------------------------------------------------------------------------------------
/*
 * @ package 	 plugin $.fn.Spiner loding data on posted 
 * @ author 	 uknown definition 
 
 */
 
;(function( $ )
{
	if( typeof( $.fn.Spiner ) != 'function' )
	{
		$.fn.Spiner = function( data ) 
		{
			var UrlParams = { }, 
				UrlWindow = ( typeof( data.url ) =='object' ? Ext.EventUrl( data.url ).Apply() : data.url );
			
			if( typeof( data ) == 'object' ) 
			{
			// ------------ restructure object data -----------------	
				if( typeof data.param  == 'object' ){
					for( var v in data.param ){
						UrlParams[v] = data.param[v];
					}	
				}	
				if( typeof data.order  == 'object' ){
					UrlParams['orderby'] = ( data.order.order_by != 'undefined' ? data.order.order_by : '' ) ;
					UrlParams['type'] = ( data.order.order_type != 'undefined' ? data.order.order_type : '' ) ;
					UrlParams['page'] = ( data.order.order_page != 'undefined' ? data.order.order_page : '' ) ;
				}
				
				if( typeof( data.handler ) != 'undefined' ){
					UrlParams['handler'] = ( data.handler ? data.handler : '' );
				}
				
			// ----------- execute posted ajax url ----------------------
				var complete = ((data.complete !=='undefined' && typeof (data.complete) == 'function') ? data.complete : ''),
					failure  = ((data.failure !=='undefined' && typeof (data.failure) == 'function') ? data.failure : ''),
					timeout  = (data.timeout !=='undefined' ? data.timeout  : false );
				
				$(this).html("");
				$(this).removeClass("ui-scroller-width-right-border");
				$(this).css("height", "120px");
				$(this).addClass("ui-widget-ajax-spiner"); 
				$(this).load( UrlWindow, UrlParams,  function( response, status, xhr ) {
					if( status == 'success' ){
						if( typeof( complete )== 'function'){
							complete.apply(this, new Array( $(this), response, status, xhr ));
						}	
					}
					else if( status  == 'timeout' ){
						if( typeof( failure )== 'function'){
							failure.apply(this, new Array( $(this), response, status, xhr ));
						}
					}
					
					$(this).removeClass("ui-widget-ajax-spiner");
					if( status == 'error') { 
						$(this).html('Error 404');	 
					}		
				// -- if have user timeout set on here object . default = false 	
				}, timeout); 	
			}
		}

		$.fn.loader = function( data ) 
		{
			var UrlParams = { }, 
				UrlWindow = ( typeof( data.url ) =='object' ? Ext.EventUrl( data.url ).Apply() : data.url );
			
			if( typeof( data ) == 'object' ) 
			{
			// ------------ restructure object data -----------------	
				if( typeof data.param  == 'object' ){
					for( var v in data.param ){
						UrlParams[v] = data.param[v];
					}	
				}	
				if( typeof data.order  == 'object' ){
					UrlParams['orderby'] = ( data.order.order_by != 'undefined' ? data.order.order_by : '' ) ;
					UrlParams['type'] = ( data.order.order_type != 'undefined' ? data.order.order_type : '' ) ;
					UrlParams['page'] = ( data.order.order_page != 'undefined' ? data.order.order_page : '' ) ;
				}
				
				if( typeof( data.handler ) != 'undefined' ){
					UrlParams['handler'] = (data.handler ? data.handler : '');
				}
				
			// ----------- execute posted ajax url ----------------------
				var complete = ((data.complete !=='undefined' && typeof ( data.complete ) == 'function') ? data.complete : ''),
					failure  = ((data.failure !=='undefined' && typeof ( data.failure ) == 'function') ? data.failure : '')
					timeout  = (data.timeout !=='undefined' ? data.timeout  : false );
				
				
				$(this).html("");
				$(this).css("height", "50px");
				$(this).addClass("ui-widget-ajax-spiner-min"); 
				$(this).load( UrlWindow, UrlParams, function( response, status, xhr )  {
					if( status == 'success' ){
						if( typeof( complete )== 'function'){
							complete.apply(this, new Array( $(this), response, status, xhr ));
						}	
					}
					else if( status  == 'timeout' ){
						if( typeof( failure )== 'function'){
							failure.apply(this, new Array( $(this), response, status, xhr ));
						}
					}
					else if( status == 'error') { 
						$(this).removeClass("ui-widget-ajax-spiner-min");
						$(this).html('Error 404');	 
					}
					
					$(this).removeClass("ui-widget-ajax-spiner-min");	
					
					// -- if have user timeout set on here object . default = false 	
				}, timeout ); 	
			}
		}	
	}	
	
	
})( jQuery );
 