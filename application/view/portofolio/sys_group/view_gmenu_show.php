<?php
/*
 * E.U.I 
 *
 
 * subject	: show menu view 
 * 			  extends under view model
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/view/menu/
 */
 

print 
	form() -> listCombo
	(
		'group_menu', // name & id 
		 NULL, // css  
		 $ListGroupMenu, // array data,
		 NULL, // value if use,
		 NULL, // event if set javascript event = click , change, keyup & etc.
		 array('label'=> '') // label , style, etc
	);
	
	
// END OF FILE
// LOCATION : ./application/group_menu/view_gmenu_show.php	

?>