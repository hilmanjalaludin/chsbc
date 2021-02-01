<?php  
/*
[file_name] => srccustomerlist
[file_name] => srcappoinment
[file_name] => srccustomerclosing
[file_name] => modforminbound
[file_name] => moddashboard
*/		
//--------------------------------------------------
/*
 * Define function on get class Awesome Iconic 
 */ 
 
 if( !function_exists('AwesomeGroupIcon') )
{
 function & AwesomeGroupIcon()
{  
	$arr_awesome_icon = array 
	(
		"moddashboard" 		 => 'fa fa-bar-chart fa-fw',
		"modforminbound" 	 => 'fa fa-file-text-o fa-fw',
		"srccustomerclosing" => 'fa fa-print fa-fw',
		"srcappoinment" 	 => 'fa fa-calendar fa-fw',
		"srccustomerlist" 	 => 'fa fa-users fa-fw',
		"reports" 			 => 'fa fa-book fa-fw',
		"customers" 		 => 'fa fa-phone-square fa-fw',
		"monitoring" 		 => 'fa fa-database fa-fw',
		"recording" 		 => 'fa fa-book fa-fw',
		"system" 			 => 'fa fa-envelope-o fa-fw'
	);
	return $arr_awesome_icon;
 }	
}

//--------------------------------------------------
/*
 * Define function on get class Awesome Iconic 
 */ 
 
if( !function_exists('Awesome') )
{
	function Awesome( $Group  = null )
 {
	$arr_awesome_icon =& AwesomeGroupIcon();
	$Group = str_replace(" ", "_", strtolower($Group));
	if( isset($arr_awesome_icon[$Group]) )
	{
		return $arr_awesome_icon[$Group];
		
	} else {
		return "fa fa-bars fa-fw";
	}	
 }	
	
}

// ============== END layout 

?>	

