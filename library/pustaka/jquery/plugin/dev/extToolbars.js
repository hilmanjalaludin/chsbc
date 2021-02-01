/* ------------------------------------------------------------------ */
/*  
 * @ package 		: toolbars jquery 
 
 * -----------------------------------------------------------------
 
 * @ author		  	: omens
 * @ cretaedate		: 2012-10-14 
 * @ update 		: 2015-12-20
 * 
 * -----------------------------------------------------------------
 */
 
(function($){
	$.fn.extToolbars = function(options)
	{
		var opts = $.extend({ },$.fn.extToolbars.defaults,options);
		
		return this.each(function()
		{
			if (!$('.ui-widget-toolbars',this).length) 
			{
			
				$.fn.extToolbars.defaults.uniqID++;
				$('<div class="ui-widget-toolbars" id="ui-widget-toolbars-id'
					+$.fn.extToolbars.defaults.uniqID+'">') 
					.appendTo(this);

				$.fn.extToolbars.defaults.cbs[$.fn.extToolbars.defaults.uniqID]= opts.cb;


				$('.ui-widget-toolbars',this).css(opts.css);
			}
			
			var $extToolbars = $('.ui-widget-toolbars',this);
			var $extPid = $extToolbars.attr('id'); 
			var html = '';
			
			var $extIcon  =  opts.extIcon.length;
			var $extMenu  =  opts.extMenu.length;
			
			//console.log(typeof(opts.extInput));
			
			var $input	  =  (opts.extInput !='' ? opts.extInput :0);

			html ="<ul>"
			
			for( var i=0; i < $extIcon; i++){

				var isclass = "middle";
				if( i == ( $extIcon - 1 ) ){
					isclass = "lasted";
				}
				html+= "<li class='"+ isclass +"'>"+
					   ""+( $input? $.fn.extToolbars.input(opts.extOption,i) : "" )+
					   "<a href='javascript:void(0);' style='text-decoration:none;' id='"+opts.extMenu[i]+"' "+(opts.extMenu[i]==0?"":"onclick='"+opts.extMenu[i]+"();'")+ " style='margin-left:10px;'>"+
					   ""+(opts.extIcon[i]!=''?"<img src='"+(opts.extUrl?opts.extUrl:"")+"/"+opts.extIcon[i]+"' border='0' align='middle' style='margin-top:-5px;' alt='0'>":'') +""+
					   ""+(opts.extText?"<span class='ui-li-ext-toolbar' style='margin-left:8px;vertical-align:middle;border:0px solid #000000;'>"+opts.extTitle[i]+"</span>":"")+"</a></li>";
			}

			html += "</ul>";
			
			$("#"+$extPid).html(html);
		});
	}
	
	$.fn.extToolbars.input = function($datas,pos){
		var $int = $datas.length;		
		var html = '';
		for( var i = 0; i<$int; i++ ){
			if($datas[i].render==pos){
				switch($datas[i].type){
					case 'text':
						html+="<input type='text' name='"+$datas[i].name+"' id='"+$datas[i].id+"' "+($datas[i].width?"style='width:"+$datas[i].width+"px;'":"") +" value='"+$datas[i].value+"'>"; 
					break;
					
					case 'label':
						html+="<div class='label' id='"+$datas[i].id+"' "+($datas[i].width?"style='border:0px solid #000000;color:red;width:"+$datas[i].width+"px;'":"") +">"+$datas[i].label+"</div>"; 
					break;
					
					case 'combo':
						var $store = $datas[i].store
							html+= ($datas[i].header?'<b>'+$datas[i].header+'&nbsp;:&nbsp; </b>':'');
							html+="<select "+($datas[i].width?"style='width:"+$datas[i].width+"px;'":"") +" "+ ($datas[i].triger!=''?"onchange='"+$datas[i].triger+"(this.value);'":'') +" name='"+$datas[i].name+"' id='"+$datas[i].id+"'>";
							html+="<option value=''>--Choose--</option>";
								for(var x in $store ){
									for (var y in $store[x]){
										if( y==$datas[i].value)
										{
											html+="<option value='"+y+"' selected>"+$store[x][y]+"</option>"
										}
										else
										{
											html+="<option value='"+y+"'>"+$store[x][y]+"</option>"
										}		
									}
								}
							html+="</select>"; 
					break;	
				}
			}	
		}
		return html;
	}
	
	$.fn.extToolbars.defaults = {
		cbs: [], pages: 0, current: 0, max: 10, uniqID: 0, flip: false,
		css: { fontFamily: 'arial', border:1 },
		blockCss: { display:'block', 'float':'left'},
		borderColor: '#444'
	};

})(jQuery);