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
form()->listCombo
 (
	'avail_menu',
	'select long', $menu, NULL,  
	 array( 'label' => 'Choose') 
 );
 
// END OF FILE
// location : /application/view/menu/view_show_menu.php 
?>
