<?php
// get menu container 

$_compile = "";
$_compile .= ' <div id="appmenu" class="menu">';
$_compile .= ' <ul class="parent">';
$arr_menu =& base_menu_model(array(10));

$ID = 1;
foreach ( $arr_menu as $category => $keys )
{
	$_compile .= "<li class=\"first-menu\"><a class=\"menu-li\" id=\"". $ID ."\" name=\"".$ID."\" href=\"javascript:void(0);\">".$category."</a>"; 
	$_compile .= ' <div id="submenu"> <ul class="child">';	
	
	/** menu child **/
	$i = 1;
	foreach( $keys as $k => $d) {
		$_compile .= "<li class=\"first-child\" >
				<a href=\"javascript:void(0);\" id=\"{$d['id']}\" class=\"menu-hover ". ($i==1?'pertama':'')."\" style=\"padding:6px 4px 6px 4px;font-size:12px;\" onclick=\"Ext.ShowMenu('".$d['file_name']."','".$d['menu']."');\">&nbsp;&nbsp;".$d['menu']."</a></li>";
		$i++;
	}
	
	$_compile .='</ul></div><li>';
	$ID++;
}

$_compile.="</ul></div>";

// show

echo $_compile;
	
?>

