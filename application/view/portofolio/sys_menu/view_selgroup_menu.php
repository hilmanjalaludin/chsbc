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
 form()->combo
 (
	"group_name",
	"select long", 
	$group, 
	$menuid,
	array( "change" => "Ext.DOM.updateMenu(this.value,$menuid); "), 
	array( "style"  => "border:1px solid red;height:18px;",'label'=>'Choose')
 );
 
// END OF FILE
// location : /application/view/menu/view_show_menu.php 
?>
