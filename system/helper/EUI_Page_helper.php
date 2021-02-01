<?php 

/*
 * @ def 	:  under lib EUI_Page Libraries 
 * --------------------------------------------------------------
 *
 * @ notes  : get local json functionality if nout found on PHP
 * @ param 	: array data 
 * @ akses 	: public function 
 */
 
 
 if( !function_exists('page_font_family') )
 {
	function page_font_family( $font = null  ) 
	{
		$UI = & get_instance();
		if( class_exists('EUI_Page') ) {
			return $UI->EUI_Page->_set_font_family($font);	
		}
	}
	
 }

// ----------------------------------------
/*
 * @ page : page_set_link 
 */ 
if( !function_exists('page_set_link') )
{
  function page_set_link($arr_label = NULL, $arr_value=0, $arr_func = NULL )
 {
 // ------- check of typeof ---------------------> 
	 if( is_null($arr_func) ) 
	 {
		return NULL;
	 }
	 
  // if have value id 
	 
	 if( ($arr_value) AND (!is_null($arr_label)) )
	 {
		$arr_on_event = null;
		$arr_on_funct = null;
		
		$arr_events = array('click' => 'onClick','change'=> 'onChange');
		foreach( array_map('trim', array_keys( $arr_func )) 
			as $k => $_value  )
		{
			if( in_array($_value, array_keys($arr_events)) )
			{
				$arr_on_event = $arr_events[$_value];
				$arr_on_funct = $arr_func[$_value];
			}	
		}

  // finalize of event handler ------------------------------
  
		if( !is_null( $arr_on_event ) 
			AND  !is_null( $arr_on_funct ) )
		{
			return "<a href=\"javascript:void(0);\" style=\"font-weight:bold;color:brown;text-decoration:none;\" $arr_on_event =\"$arr_on_funct('$arr_value');\">$arr_label</a>";
		}	
	 }
  }
} 
 
 /*
 * @ def 	:  under lib EUI_Page Libraries 
 * --------------------------------------------------------------
 *
 * @ notes  : get local json functionality if nout found on PHP
 * @ param 	: $field
 * @ param  : $rows 
 * @ param  : $func  
 * @ akses 	: public function 
 */
 
 if(!function_exists('page_call_function'))
 {
	function page_call_function( $field=NULL, $rows = NULL, $func = NULL)
	{	
		$result = NULL;
		if( in_array($field, array_keys($func) ) )
		{
		
		 // -------------- get of link js  ---------- 
			if( is_array($func[$field]) )
			{
				return page_set_link( $rows[$field], $rows[$func[$field]['primary']], $func[$field]); 
			}
			
		// --------------- if not link  ----------------------	
		
			if( in_array( $func[$field], array('_getCurrency')) )
			{
				if( function_exists($func[$field]) ){
					$result = call_user_func($func[$field],$rows[$field]); 
					return ( $result ? $result : '-&nbsp;'); 
				} 
			}
			else
			{
				if( function_exists($func[$field]) ){
					return call_user_func($func[$field],$rows[$field]); 
				}
			}
		}		
		else{
			return ( $rows[$field] ? $rows[$field] : '-');
		}
	}
 }
/*
 * @ def 	:  font_size
 * --------------------------------------------------------------
 *
 * @ notes  : get local json functionality if nout found on PHP
 * @ param 	: array data 
 * @ akses 	: public function 
 */
  
  if( !function_exists('page_font_size') )
 {
	function page_font_size( $size = null  ) 
	{
		$UI = & get_instance();
		if( class_exists('EUI_Page') ) 
		{
			$UI->EUI_Page->_set_font_size($size);	
		}
	}
	
 }
 
/*
 * @ def 	:  font_color
 * --------------------------------------------------------------
 *
 * @ notes  : get local json functionality if nout found on PHP
 * @ param 	: array data 
 * @ akses 	: public function 
 */
  
  if( !function_exists('page_font_color') )
 {
	function page_font_color( $color = null  ) 
	{
		$UI = & get_instance();
		if( class_exists('EUI_Page') ) 
		{
			$UI->EUI_Page->_set_font_color($color);	
		}
	}
	
 }
 
/*
 * @ def 	:  background_color
 * --------------------------------------------------------------
 *
 * @ notes  : get local json functionality if nout found on PHP
 * @ param 	: array data 
 * @ akses 	: public function 
 */
  
  if( !function_exists('page_background_color') )
 {
	function page_background_color( $color = null  ) 
	{
		$UI = & get_instance();
		if( class_exists('EUI_Page') ) 
		{
			$UI->EUI_Page->_set_background_color($color);	
		}
	}
 }
 
/*
 * @ def 	:  select_header
 * --------------------------------------------------------------
 *
 * @ notes  : get local json functionality if nout found on PHP
 * @ param 	: array data 
 * @ akses 	: public function 
 */
  
   if( !function_exists('page_header') )
 {
	function page_header( $header = null  ) 
	{
		$UI = & get_instance();
		if( class_exists('EUI_Page') ) 
		{
			return $UI->EUI_Page->_selected_header($header);	
		}
	}
 }

/*
 * @ def 	:  select_column
 * --------------------------------------------------------------
 *
 * @ notes  : get local json functionality if nout found on PHP
 * @ param 	: array data 
 * @ akses 	: public function 
 */
 
 
  if( !function_exists('column') )
 {
	function page_column( $column = null  ) 
	{
		$UI = & get_instance();
		if( class_exists('EUI_Page') ) 
		{
			return $UI->EUI_Page->_selected_columns($column);	
		}
	}
 }
 
 /*
 * @ def 	:  select_column
 * --------------------------------------------------------------
 *
 * @ notes  : get local json functionality if nout found on PHP
 * @ param 	: array data 
 * @ akses 	: public function 
 */
 
 
  if( !function_exists('page_labels') )
 {
	function page_labels() 
	{
		$UI = & get_instance();
		if( class_exists('EUI_Page') ) 
		{
			return $UI->EUI_Page->_getLabels();	
		}
	}
 }
 
  /*
 * @ def 	:  select_column
 * --------------------------------------------------------------
 *
 * @ notes  : get local json functionality if nout found on PHP
 * @ param 	: array data 
 * @ akses 	: public function 
 */
 
 
  if( !function_exists('page_style') )
 {
	function page_style() 
	{
		$UI = & get_instance();
		if( class_exists('EUI_Page') ) 
		{
			return $UI->EUI_Page->_get_order_style();	
		}
	}
 }

/*
 * @ def 	:  select_column
 * --------------------------------------------------------------
 *
 * @ notes  : get local json functionality if nout found on PHP
 * @ param 	: array data 
 * @ akses 	: public function 
 */
 
  if( !function_exists('page_set_style') )
 {
  function page_set_style( $key = NULL, $value='' ) 
	{
		$UI = & get_instance();
		if( class_exists('EUI_Page') ) 
		{
			return $UI->EUI_Page->_set_style( $key, $value);	
		}
	}
 }
 
 /*
 * @ def 	:  SELECT PRIMARY SHOWING 
 * --------------------------------------------------------------
 *
 * @ notes  : get local json functionality if nout found on PHP
 * @ param 	: array data 
 * @ akses 	: public function 
 */
 
  if( !function_exists('page_primary') )
 {
	function page_primary() 
	{
		$UI = & get_instance();
		if( class_exists('EUI_Page') ) 
		{
			return $UI->EUI_Page->_getPrimary();	
		}
	}
 }
 
 
/*
 * @ def 	:  SELECT PRIMARY SHOWING 
 * --------------------------------------------------------------
 *
 * @ notes  : get local json functionality if nout found on PHP
 * @ param 	: array data 
 * @ akses 	: public function 
 */
 
  if( !function_exists('page_get_align') )
 {
	function page_get_align() 
	{
		$UI = & get_instance();
		if( class_exists('EUI_Page') ) 
		{
			return $UI->EUI_Page->_getAlign();	
		}
	}
 } 
 
/*
 * @ def 	:  SELECT PRIMARY SHOWING 
 * --------------------------------------------------------------
 *
 * @ notes  : get local json functionality if nout found on PHP
 * @ param 	: array data 
 * @ akses 	: public function 
 */
 
  if( !function_exists('page_set_align') )
 {
	function page_set_align( $key=NULL, $val='' ) 
	{
		$UI = & get_instance();
		if( class_exists('EUI_Page') ) 
		{
			return $UI->EUI_Page->_setAlign($key, $val);	
		}
	}
 }
 
 
 
  /*
 * @ def 	:  SELECT PRIMARY SHOWING 
 * --------------------------------------------------------------
 *
 * @ notes  : get local json functionality if nout found on PHP
 * @ param 	: array data 
 * @ akses 	: public function 
 */
 
  if( !function_exists('page_hidden') )
 {
	function page_hidden() 
	{
		$UI = & get_instance();
		if( class_exists('EUI_Page') ) 
		{
			return $UI->EUI_Page->_getHidden();	
		}
	}
 }
 
 
// ------------------------------------------------------
/* 
 * resize on grid if OK 
 * @ pack : print empty string 
 */
 
if(!function_exists('page_resize') ) 
{ 
  function page_resize( $argv = null )  
{
	if( is_null($argv) ) {
		return "-";
	}
	else if( strlen($argv)==0 ) {
		return "-";
	}	
	else {
		return "<div class=\"text-content left-text\">{$argv}</div>";
	}
  } 
}

// ------------------------------------------------------
/* 
 * resize on grid if OK 
 * @ pack : print empty string 
 */
 
if(!function_exists('page_border') ) 
{ 
  function page_border()  
{
	$EUI =& get_instance();
		if( $EUI )
	{
		return $EUI->EUI_Page->_get_class_border();
	}
	
  } 
}



 
 
// ------------------------------------------------------
/* 
 * resize on grid if OK 
 * @ pack : print empty string 
 */
 
 if(!function_exists('page_set_wrap') ) 
{ 
	function page_set_wrap( $field=null, $value=null)
	{
		$EUI =& get_instance();
		if( $EUI )
		{
			$EUI->EUI_Page->_setWrap( $field, $value );
		}	
	}
}


// ------------------------------------------------------
/* 
 * resize on grid if OK 
 * @ pack : print empty string 
 */
 
 if(!function_exists('page_get_wrap') ) 
{ 
	function page_get_wrap() 
	{
		$EUI=& get_instance();
		if( $EUI )
		{
			return $EUI->EUI_Page->_getWrap();
		}
	}
}

// ------------------------------------------------------
/* 
 * resize on grid if OK 
 * @ pack : print empty string 
 */
 
 if( !function_exists('page_set_role') )
 {
  function page_set_role( $arr_role_event =null, $check = null ) 
{
	 
// ----------------- set default off event trigger ---------------------
	$arr_event_trigger  = array( 'onEdit'=>0, 'onEvent' => "javaScript:void(0)", 'onChecked' => array("disabled" => "TRUE") );
	
//------------------ set to lower case -------------------------------	
    if( is_array($arr_role_event) ){
		$arr_role_event = array_map('strtolower',$arr_role_event);
	}
//------------------ set to lower case -------------------------------	
	$role =& get_instance();
    $role->load->model('M_UserRole');
	if( class_exists('M_UserRole') ) 
	{
		$arr_rwx =& $role->M_UserRole->select_role_event_write_execute();
		$isRole = 0;
		if(is_array($arr_role_event) )
			foreach( $arr_role_event as $k => $evt )
		{
			if( in_array($evt, array_keys($arr_rwx))){
				$isRole++;
			}	
		}	
	}
// --------------------- then process check by default --------------------------
	if( $isRole > 0 ) 
	{
		$arr_event_trigger  = array(
			'onEvent' => "javaScript:Ext.Cmp('$check').setChecked();",
			'onChecked' => null,
			'onEdit' => 1
		);  
	}
	
	return (object)$arr_event_trigger;
	
  }	
  
  
 }

?>