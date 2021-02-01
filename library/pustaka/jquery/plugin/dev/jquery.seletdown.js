// ----------------------------------------------------------------------------------------------------

/* 
 * Modul 			plugin toogle on select data object
 *
 * @pack 			toogle
 * @pack 			this param 
 * @auth 			<omens> 
 */

(function($){
  if( typeof($.fn.toogle)!=='function')
 {
	$.fn.toogle = function( fn )
	{
		var select = $(this), span_id = select.attr("id"),
			select_join   = [span_id, "selectdown"], 
			selectdown 	  = null,
			select_toogle = select_join.join("-"), 
			ajaxselected  = ["ajaxs", select_toogle].join("-");
		
	// ------------ on default object ----------------------
	
		var posted = function()
		{
			var $obj = {}; for( var i in fn.param ) {
				if( typeof(fn.param[i]) =='object'){
					$obj[i] = fn.param[i].toString();
				} else {
					$obj[i] = fn.param[i];
				}				
			};
			
			if( typeof(fn.elval) =='object'){
				fn.elval.map(function(item){
					$obj[item] = Ext.Cmp(item).getValue();
				});
			}
			
			var $obj_uri = Ext.EventUrl( new Array(fn.url));
			//console.log( $obj_uri.Apply() );
			 $( window.sprintf('#%s', ajaxselected)).loader
			({
				url      : $obj_uri.Apply(),
				method   : 'GET',
				param    : $obj,
				complete : function( obj ){
					$(obj).css({ "height" : "100%" });
					
				}
			});
			
			//$("#"+ajaxselected).load( $obj_uri.join("/"), $obj);
		}
		
	// ------------ on default object ----------------------
		
		this.defaults = function()
		{	
			selectdown = $('#'+select_toogle);
			selectdown.addClass("toggle-active ui-down-default");
			selectdown.bind("click", function()
			{
				var select_class = $(this).attr('class').split(/\s+/); 
				if( select_class[0] == 'toggle-active') 
				{
					select.attr("multiple", "true");
					select.removeClass("select long");
					select.addClass("select_multiple long");
					selectdown.removeClass("toggle-active ui-down-default");
					selectdown.addClass("toggle-notactive ui-down-default");
					
				} else {
					select.removeAttr("multiple");
					select.removeClass("select_multiple long");
					select.addClass("select long");
					selectdown.removeClass("toggle-notactive ui-down-default");
					selectdown.addClass("toggle-active ui-down-default");
				}
			});
		}
		
	// ------------ on ajax object ----------------------
		
		this.AjaxToggle = function()
		{
			selectdown = $('#'+select_toogle);
			selectdown.addClass("toggle-active ui-down-active");
			fn.param.id = span_id;
			fn.param.type = 'dropdown';
			posted();
			selectdown.bind("click", function() 
			{
				var select_class = $(this).attr('class').split(/\s+/); 
				
				if( select_class[0] == 'toggle-active') 
				{
					selectdown.removeClass("toggle-active ui-down-active");
					selectdown.addClass("toggle-notactive ui-down-active");
					
					var obj_id = new Ext.Cmp(span_id);
						fn.param.select = (!obj_id.IsNull() ? obj_id.getValue() : '' );
						fn.param.id = span_id;
						fn.param.type = 'listboxes';
					posted();
					
				} else {
					selectdown.removeClass("toggle-notactive ui-down-active");
					selectdown.addClass("toggle-active ui-down-active");
					
					var obj_id = new Ext.Cmp(span_id);
						fn.param.type = 'dropdown';
						fn.param.id  = span_id;
						fn.param.select = (!obj_id.IsNull() ?obj_id.getValue() : '' );
					posted();
				}	
			});
		}
		
	
		if( typeof(fn) =='undefined' ){
			$("<div id=\""+select_toogle+"\"></div>" ).insertAfter( $(this ) );
			this.defaults();
			
		}	
			
		if( typeof(fn)=='object')
		{
			if( Ext.Cmp("field_"+ $(this).attr('id')).IsNull()==false )
			{
				$attrs = $("#field_"+ $(this).attr('id'));
				$("<div id=\""+ajaxselected+"\"></div>" ).insertBefore($attrs);
				$("<div id=\""+select_toogle+"\"></div>" ).insertAfter($attrs);
				$attrs.remove();
			} else {
				$("<div id=\""+ajaxselected+"\"></div>" ).insertBefore($(this));
				$("<div id=\""+select_toogle+"\"></div>" ).insertAfter($(this));
				$(this).remove();
			}
			this.AjaxToggle();
		}
	}
 }
})(jQuery);