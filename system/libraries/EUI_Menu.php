<?php
/*
 * E.U.I  1.0.0
 
 * setup & menu on libraries method   
 * will write the content menu on lib 
 * process for extenbility method 
 * you can move to core if do you needed its.
 * this must consitent with layout & template your website 
 
 * author   Razaki Team
 * link 	http://wwww.razakitechnology.com/libraries/menu	 
 **/
 
 
class EUI_Menu 
{
 
 // post menu is array type 
 
 protected $_post_menu;
 
 // assign menu is parameter
 
 protected $_assign_menu;
 
 // assign menu is parameter
 
 protected $_list_menu;
 
 // get instance for class method 
 
 private static $instance;
 
 
/*
 @ __constructor class  
 */
 
 function __construct()
 {
	$this -> _post_menu = array();
	$this -> _assign_menu = array();	
 }
 
/*
 * set menu position left , top && 
 * get assign data is _array asumsition
 * then execute the process 
 * return array[menu] <>
 */
 
public static function &_get_instance()
{
	if( is_null( self::$instance ) )
	{
		self::$instance = new self();
	}
	
	return self::$instance;
}

 
/*
 * set menu position left , top && 
 * get assign data is _array asumsition
 * then execute the process 
 * return array[menu] <>
 */
 
function _set_menu_assign( $_post_menu = 'left', $_assign_menu = array() )
{
	$this -> _post_menu  = $_post_menu;
	$this -> _assign_menu = $_assign_menu;
	
	if( !is_null( $this -> _post_menu ) && is_array( $this -> _assign_menu ) ) 
	{
		foreach( $this -> _post_menu as $menu => $value )
		{
		
		// * show modul menu navigation for user 
		// * diagram then set your positin this
		// * simple method  for advance you must edit ..
		
			if( strchr('menu', $menu)!=FALSE )
			{
				if( $value['_access'] )
				{
					switch( strtolower($value['_pos']) ) 
					{
						case 'left' : self::_write_left_menu(); break;
						case 'top'	: self::_write_top_menu(); break;
						default 	: self::_write_left_menu(); break;
					}
				}	
			}
		
		// * chat modul on application type 
		// * diagram then set your positin this
		// * simple method  for advance you must edit ..
		
			if( strchr('chat', $menu)!=FALSE )
			{
				if( $value['_access'] )
				{
					switch( strtolower($value['_pos']) ) 
					{
						case 'left' : self::_write_left_chat(); break;
						case 'top'	: self::_write_top_chat(); break;
						default 	: self::_write_left_chat(); break;
					}
				}	
			}
		}
	}
}	
/*
 * Create menu to object array 
 * Then return to process 
 */
 
private function _write_left_menu()
{
	$this -> _list_menu  = '<div id="accordion" border="1px solid #000000;">';
	if( is_array( $this -> _assign_menu ) ) 
	{
		foreach( $this -> _assign_menu as $_category => $_menu )
		{
			if( $_category )
			{
				$this -> _list_menu .= '<h3><a href="javascript:void(0)">'.$_category.'</a></h3>';  // create name of category menu 
				$this -> _list_menu .= '<ul>';
				foreach( $_menu as $k => $_list )
				{
					$this -> _list_menu .= '<li>';
						$this -> _list_menu .= '<a href="'.$_list['file_name'].'" id="'.$_list['id'].'" class="'.$_list['style'].'" >'.$_list['menu'].'</a>';
					$this -> _list_menu .= '</li>';	
				}
				$this -> _list_menu.='</ul>';
			}
		}
	}
	
	$this -> _list_menu .= "</div>";
}

/* Create chat include in navigation to object array 
 * then return to process 
 * this sample attribut modul menu 
 */
 
function _write_left_chat()
{
	$this -> _list_menu.= '<div id="accordions" style="border:0px solid #000;width:200px;">
							<h3><a href="javascript:void(0)">Chat Friend List</a></h3>
							<ul class="chat" style="height:100px"></ul>
						  </div>';
}


/*
 * Create menu to object array 
 * then return to process 
 */
 
public function _get_layout_menu()
{
	$_menu = array();
	if( $this -> _list_menu )
	{
		$_menu['menu'] = $this -> _list_menu;
	}
	
	return $_menu;
}

}

// END OF FILE 
// location : ./system/libraries/EUI_Menu.php

?>