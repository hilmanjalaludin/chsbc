<?php
/*=================================================================================================
 *=================================================================================================
 *
 * @ def	: Layout Helpers 
 * ----------------------------------------- 
 * 
 * @ notes 	: Please use in view mode for && if 
 *			  you use in frame class You can Used 
			  $this ->Layout -> (optional);
 * @ param  : paramter helper	
 * ================================================================================================ 
 */

if( !function_exists('base_layout'))
{
 function base_layout() 
 {
	$LYT =& get_instance();
	return $LYT ->Layout ->base_layout();
 }
}

/*=================================================================================================
 *=================================================================================================
 *
 * @ def	: Layout Helpers 
 * ----------------------------------------- 
 * 
 * @ notes 	: Please use in view mode for && if 
 *			  you use in frame class You can Used 
			  $this ->Layout -> (optional);
 * @ param  : paramter helper	
 * ================================================================================================ 
 */

if( !function_exists('base_ext_roots'))
{
 function base_ext_roots() 
 {
	$LYT =& get_instance();
	return $LYT->Layout->base_layout_enigma();
 }
}


/*=================================================================================================
 *=================================================================================================
 *
 * @ def	: Layout Helpers 
 * ----------------------------------------- 
 * 
 * @ notes 	: Please use in view mode for && if 
 *			  you use in frame class You can Used 
			  $this ->Layout -> (optional);
 * @ param  : paramter helper	
 * ================================================================================================ 
 */

if( !function_exists('base_ext_form'))
{
 function base_ext_form() 
 {
	$LYT =& get_instance();
	$base_spl_form = array($LYT->Layout->base_layout_enigma(),'form', 'dev');
	if( ENVIRONMENT != 'DEPLOVMENT' ){
		$base_spl_form = array($LYT->Layout->base_layout_enigma(),'form', 'min');
	}
	return (string)join("/",$base_spl_form);
	
 }
}

/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_js_layout
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
 
if( !function_exists('base_enigma'))
{  function base_enigma()
 {
	$LYT =& get_instance();
	$URI = $LYT ->Layout ->base_layout_enigma();
	return ( $URI ? $URI : null );
 }
}	
/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_js_layout
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
 
if( !function_exists('base_fonts_style')) 
{ 
  function base_fonts_style() 
  {
	$LYT =& get_instance(); 
	return $LYT->Layout->base_fonts_style();
 }
 
}
/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_js_layout
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
 
 
if( !function_exists('base_web_editor')){
	
	function base_web_editor()
	{
		$LYT =& get_instance();
		return $LYT ->Layout ->base_web_editor();
	}
}

/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_js_layout
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
 
 
if( !function_exists('base_jquery'))
{ 
 function base_jquery()
 {
	$LYT =& get_instance();
	return $LYT ->Layout ->base_layout_jquery();
 }
}	


/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_spl_cores 
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
 
 
if( !function_exists('base_spl_cores'))
{ 
 function base_spl_cores()
 {
	$LYT =& get_instance();
	$base_spl_core = array($LYT->Layout->base_layout_jquery(),'cores', 'dev');
	if( ENVIRONMENT != 'DEPLOVMENT' ){
		$base_spl_core = array($LYT->Layout->base_layout_jquery(),'cores', 'min');
	}
	
	return (string)join('/', $base_spl_core);
 }
}	

/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_spl_loader 
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
 
 
if( !function_exists('base_spl_loader'))
{ 
 function base_spl_loader()
 {
	$LYT =& get_instance();
	$base_spl_loader = array($LYT->Layout->base_layout_jquery(),'loader', 'dev');
	if( ENVIRONMENT != 'DEPLOVMENT' ){
		$base_spl_loader = array($LYT->Layout->base_layout_jquery(),'loader', 'min');
	}
	
	$base_spl_loader = array(join('/', $base_spl_loader), join(".", array('jquery', base_layout(), 'spl', 'js')));
	return (string)join('/', $base_spl_loader);
	
 }
}	



/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_spl_frame 
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
 
 
if( !function_exists('base_spl_frame'))
{ 

 function base_spl_frame()
 {
	 
	$LYT =& get_instance();
	$base_spl_frame = array($LYT->Layout->base_layout_jquery(),'frame', 'dev');
	if( ENVIRONMENT != 'DEPLOVMENT' ){
		$base_spl_frame = array($LYT->Layout->base_layout_jquery(),'frame', 'min');
	}
	return (string)join('/', $base_spl_frame);
 }
}	


/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_spl_plugin 
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
 
 
if( !function_exists('base_spl_plugin'))
{ 
 function base_spl_plugin()
 {
	$LYT =& get_instance();
	$base_spl_plugin = array($LYT->Layout->base_layout_jquery(),'plugin', 'dev');
	if( ENVIRONMENT != 'DEPLOVMENT' ){
		$base_spl_plugin = array($LYT->Layout->base_layout_jquery(),'plugin', 'min');
	}
	return (string)join('/', $base_spl_plugin);
 }
}	


/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_spl_layout 
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
if( !function_exists('base_spl_layout'))
{ 
 function base_spl_layout()
 {
	$LYT =& get_instance();
	$base_spl_layout = array(base_js_layout(), 'dev');
	if( ENVIRONMENT != 'DEPLOVMENT' ){
		$base_spl_layout = array(base_js_layout(), 'min');
	}
	return (string)join('/', $base_spl_layout);
 }
 
}


/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_spl_layout 
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
if( !function_exists('base_jsp_layout'))
{ 
 function base_jsp_layout()
 {
	$base_jsp_layout= array(base_layout(), "js");
	return (string)join('/', array(base_spl_layout(), join(".", $base_jsp_layout)));
 }
 
}



/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_ext_cores 
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
 
if( !function_exists('base_ext_cores'))
{ 
 function base_ext_cores()
 {
	$LYT =& get_instance();
	$base_ext_cores = array($LYT->Layout->base_layout_enigma(),'cores', 'dev');
	if( ENVIRONMENT != 'DEPLOVMENT' ){
		$base_ext_cores = array($LYT->Layout->base_layout_enigma(),'cores', 'min');
	}
	return (string)join('/', $base_ext_cores);
 }
}

/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_ext_views 
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
 
if( !function_exists('base_ext_views'))
{ 
 function base_ext_views()
 {
	$LYT =& get_instance();
	$base_ext_view = array($LYT->Layout->base_layout_enigma(),'views', 'dev');
	if( ENVIRONMENT != 'DEPLOVMENT' ){
		$base_ext_view = array($LYT->Layout->base_layout_enigma(),'views', 'min');
	}
	return (string)join('/', $base_ext_view);
 }
}

/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_ext_helper 
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
if( !function_exists('base_ext_helper'))
{ 
 function base_ext_helper()
 {
	$LYT =& get_instance();
	$base_ext_helper = array($LYT->Layout->base_layout_enigma(),'helper', 'dev');
	if( ENVIRONMENT != 'DEPLOVMENT' ){
		$base_ext_helper = array($LYT->Layout->base_layout_enigma(),'helper', 'min');
	}
	return (string)join('/', $base_ext_helper);
 }
}




/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_js_layout
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
 
if( !function_exists('base_js_layout'))
{ 
 function base_js_layout()
 {
	$LYT =& get_instance();
	return $LYT ->Layout ->base_js_layout();
 }
}	
/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_js_layout
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
 
if( !function_exists('base_image_system'))
{
	function base_image_system() 
	{
		$LYT =& get_instance(); 
		return $LYT->Layout ->base_image_system();
	}
}

/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_js_layout
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
 
if( !function_exists('base_image_layout'))
{
	function base_image_layout() 
	{
		$LYT =& get_instance(); 
		return $LYT ->Layout ->base_image_layout();
	}
}

/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_js_layout
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
 
if( !function_exists('base_themes_style'))
{
 function base_themes_style($style=null)
 {
	$LYT =& get_instance(); 
	return $LYT -> Layout ->base_themes_style($style);
 }
}

/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_js_layout
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
 
/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_js_layout
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
 
if( !function_exists('base_style'))
{
  function base_style() 
  {
	$LYT =& get_instance(); 
	return $LYT -> Layout ->base_style();
  }  
}
 
/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_js_layout
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
 
if( !function_exists('base_menu_model') ) 
{
 function base_menu_model( $escape = 0 )
 {
	$_conds = null;
	$EUI =& get_instance();
	$EUI -> load -> Model('M_Menu');
	
	if( class_exists('M_Menu') ) {
		$data= $EUI->M_Menu-> _get_acess_menu( $escape );
		if( is_array($data) )
		{
			$_conds = $data;
		}
	}
	
	return $_conds;	
 }
}

 
/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_js_layout
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
 
if( !function_exists('base_menu_group') ) 
{
 function base_menu_group( $group = 0 )
 {
	$_conds = null;
	$EUI =& get_instance();
	$EUI -> load -> Model('M_Menu');
	
	if( class_exists('M_Menu') ) 
	{
		$data= $EUI->M_Menu-> _get_acess_menu_group( $group );
		if( is_array($data) )
		{
			$_conds = $data;
		}
	}
	
	return $_conds;	
 }
}

/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_js_layout
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
 
if( !function_exists('base_layout_style'))
{
  function base_layout_style() 
  {
	$_URI = base_url() ."library/styles/". base_layout() ."/default";
	if( $_URI )
	{
		return $_URI;
	}	
  }
}

/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_js_layout
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
 
if( !function_exists('base_library')) 
{ 
  function base_library() 
  {
	$LYT =& get_instance(); 
	return $LYT -> Layout ->base_library();
 }
 
}

/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_js_layout
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
 
if( !function_exists('base_menu_layout') ) {
 function base_menu_layout( $m = null) 
 {
   $_compile = ''; 
  if(is_array($m) && !is_null($m))
  {
    if( isset($m['data']) && is_array($m) )
   {
	 $_compile .= '<div ';
	 
	// create class div menu 
	 if( isset($m['container']['class']) && !is_null($m['container']['class'])){
		$_compile .= ( $m['container']['class'] ? 'class="'. $m['data']['container']['class'] .'"':'');
	 }	
	
	// create class div id 	
	 if( isset($m['container']['id']) && !is_null($m['container']['id']) ){
		$_compile .= ( $m['container']['id'] ? 'id="'. $m['container']['id'] .'" ':'');
	 }
	
	// create class div extra 	
	 if( isset($m['container']['extra']) && !is_null($m['container']['extra']) ){
		$_compile .= ( $m['container']['extra'] ? $m['container']['extra'] : '' );
	 }
	
	 $_compile .= ">\n";
	
	if( isset($m['data']) && ($m['data']) )
	 {
		foreach( $m['data'] as $c => $r )
		{
			if( $c )
			{
				$_compile.= str_replace('{title}', $c, $m['parent']['ahref'] ) ."\n";
				
				$_compile.= '<ul'; // create ull
				
				if( isset($m['child']['show']) && ( $m['child']['show'] )){
					$_compile.= ( !is_null( $m['child']['class']['ul']) ? $m['child']['class']['ul'] : '' );
				}	
				
				$_compile.= ">";
				foreach( $r as $k => $d )
				{
					$_compile .= '<li';
					$_compile .= ( !is_null($m['child']['class']['li']) ? "class=\"{$m['child']['class']['li']}\"" : "" );  
					$_compile .= '>';
					$_compile .= "<a href=\"javascript:void(0);\" id=\"{$d['id']}\" class=\"{$d['style']}\"";
					$_compile .= (!is_null($m['click']['action'])? "onclick=\"javascript:{$m['click']['action']}('{$d['file_name']}','{$d['menu']}');\"" : "x")." >{$d['menu']}</a>";
					$_compile .= "</li>";	
				}
				
				$_compile .= "</ul>\n";	
			}
		}
	  }
	}
	
	$_compile .= "</div>\n";
 }
 
 return $_compile;
}

/*=================================================================================================
 *=================================================================================================
 * @ pack 				base_js_layout
 * @ function			return ( string )
 *=================================================================================================
 *=================================================================================================
 */
if( !function_exists('base_chat_layout') ) {
 function base_chat_layout( $c = null ) {
  $_compile = '<div';
  if( !is_null($c) && is_array($c) )
  {
	if( isset($c['container'])) {
		$_compile .= ( !is_null( $c['container']['id'] )?' id="'.$c['container']['id'].'"': null);
		$_compile .= ( !is_null( $c['container']['class'])?' class="'.$c['container']['class'].'"': null);
		$_compile .= ( !is_null( $c['container']['extra'])?' style="'.$c['container']['extra'].'"': null);
	}
	
	$_compile.= '>';
	if( isset($c['parent'])){
		$_compile .= ( !is_null($c['parent']['title'] )? $c['parent']['title'] : null);
	}
			
	$_compile.= '<ul';
	if( isset($c['ul'])) {
		$_compile .= ( !is_null( $c['ul']['id'] )?'id="'.$c['ul']['id'].'"': null);
		$_compile .= ( !is_null( $c['ul']['class'])?'class="'.$c['ul']['class'].'"': null);
		$_compile .= ( !is_null( $c['ul']['extra'])?'style="'.$c['ul']['extra'].'"': null);
	}
			
	$_compile.= '>'; $_compile.= '</ul>'; 
  }
   
   $_compile.= '</div>';
   
   return $_compile;
   
 }} 
}

if( !function_exists('base_datatables')) 
{ 
  function base_datatables() 
  {
	$LYT =& get_instance(); 
	return $LYT -> Layout ->base_layout_datatables();
 }
 
}	

// =================== END CLASS HELPER =============================================================
?>