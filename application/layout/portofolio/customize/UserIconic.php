<?php  
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
		"quality_assurance" => 'fa fa-users fa-fw',
		"settings" 			=> 'fa fa-gear fa-fw',
		"manage_system" 	=> 'fa fa-gear fa-fw',
		"reports" 			=> 'fa fa-book fa-fw',
		"customers" 		=> 'fa fa-phone-square fa-fw',
		"monitoring" 		=> 'fa fa-database fa-fw',
		"manage_cti" 		=> 'fa fa-asterisk fa-fw',
		"pabx"				=> 'fa fa-asterisk fa-fw',
		"q-assurance"		=> 'fa fa-users fa-fw',
		"manage_data" 		=> 'fa fa-database fa-fw',
		"data"				=> 'fa fa-database fa-fw',
		"system" 			=> 'fa fa-gear fa-fw',
		"moddashboard" 		 => 'fa fa-bar-chart fa-fw',
		"modforminbound" 	 => 'fa fa-file-text-o fa-fw',
		"srccustomerclosing" => 'fa fa-print fa-fw',
		"srcappoinment" 	 => 'fa fa-calendar fa-fw',
		"srccustomerlist" 	 => 'fa fa-users fa-fw',
		"recording" 		 => 'fa fa-book fa-fw',
		
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
		return "fa fa-sign-out fa-fw";
	}	
 }	
	
}

// ============== END layout 

?>	

