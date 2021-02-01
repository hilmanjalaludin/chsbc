//-----------------------------------------------------------------------
/*
 * modul  		 	User Role On Menu Controller 
 *
 * @akses 			public & of run window  
 * @author 			uknown 
 * @notes			this trial model 
 */
 
 
(function( $eui ){
 
 $eui.prototype.Role = function( $obj )
 {
	var $arr_obj = [Ext.System.view_page_index(), $obj,"Role"],  $role_back = {},
		$arr_extend = { 
			title   : new Array(), 
			icon    : new Array(), 
			event   : new Array(),
			key     : ''
		}, 
		$arr_title = {}, $arr_event = new Array(), $arr_icon = new Array(), 
		
	$obj_arr_role = Ext.Ajax
	({ 
		url   : $arr_obj.join("/"),
		param : { 
			modul : $obj
		}  
	}).json(), 
		
		$r = {	
		$role  : $obj, 	
		extend : function( $obj ){
			if( $obj.length!=0 ){
				$obj.map(function(item){
					$arr_extend.key = item.key;
					$arr_extend.title.push( new Array(item.title));
					$arr_extend.icon.push( new Array(item.icon));
					$arr_extend.event.push( new Array( item.event));
				});
			}
		},
		
		title : function(){
		  try
		 {	
			if( typeof( $obj_arr_role.title ) == 'undefined' ){
				throw new Array();
			}
			
			$obj_arr_role.title.map(function(item){ 
				$arr_title[item] = item; 
			});
			
			if( !$arr_extend.title.length==0 ) {
				$arr_extend.title.map(function(item){
					$arr_title[item] = item;
				});
		    }
			
			return Object.keys($arr_title);
			
		  } catch ( error ){
			 return error;
		  }
		  
		},
		
		icon : function(){
		   try
		  {
				if( typeof( $obj_arr_role.title ) == 'undefined' ){
					throw new Array();
				}
				$obj_arr_role.icon.map(function(item){ 
					$arr_icon[item] = item;
				});
				
				if( !$arr_extend.icon.length==0 ){
					$arr_extend.icon.map(function(item){
						$arr_icon[item] = item;
					});
				}
				return Object.keys($arr_icon);
				
		   } catch(error){
			  return error;
		   }
		   
		},	
		event : function(){ 
		   try 
		 {
			if( typeof( $obj_arr_role.title ) == 'undefined' ){
				throw new Array();
			}
			
		    $obj_arr_role.event.map(function(item){ 
				$arr_event[item] = item;
		    });
			
			if( !$arr_extend.event.length==0 ){
				$arr_extend.event.map(function(item){
					$arr_event[item] = item;
				});
			}
			return Object.keys($arr_event);
			
		 }catch(error){
			return error;
		 }
		},
		last : function(){
		  try
		  {
			if( typeof( $obj_arr_role.title ) == 'undefined' )
				throw new Array();
			
			var count_std = this.title().length, 
				count_extd = $arr_extend.title.length,
				$last = (count_std - count_extd);
			return $last;
			
		  } catch( error ){
			 return error;
		  }
		  
		},
		image : function(){
			var $img = [Ext.System.view_library_url(),"gambar","icon"];
			return $img.join("/");
		},
		render: function( n ){
			var $kept = (this.last() - n);
			return $kept;
		},
		action : function( event ){
			var $url_post_role = [Ext.System.view_page_index(),this.$role, event], 
				$role_index = $url_post_role.join("/");
			return $role_index;
		},
		
		getValue : function(){
			var eval_obj = ''; 
			if( typeof( $arr_extend.key ) == 'string' ){
				if( !Ext.Cmp( $arr_extend.key ).IsNull() ){
					eval_obj = Ext.Cmp( $arr_extend.key ).getValue();
				}
			}
			return eval_obj;
		},
        
		pageIndex :function() {
			var page = [Ext.System.view_page_index(), this.$role, 'index'];
			return page.join("/");
		},

		pageContent :  function(){
			var page = [Ext.System.view_page_index(), this.$role, 'content'];
			return page.join("/");
		},
		
		roleback : function(){
		   try {
			var $title = Ext.System.view_file_name();
			Ext.ShowMenu(this.$role, $title, Ext.DOM.datas );
		  } catch( e ){
			console.log(e);
		  }
		}
		
		
	}
	
	return $r;
 }
 
})(E_ui);
