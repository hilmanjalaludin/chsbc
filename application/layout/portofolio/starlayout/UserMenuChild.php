<?php 
/* 
 * load date iconinc 
 * -------------------------------------------------------*/
 
 $this->load->layout(base_layout() . "/UserIconic");

 
/* 
 * load date iconinc 
 * -------------------------------------------------------*/
 $arr_skip_group_id  = array(10); // if you wanto skip group menu . set Group Id
 $g_ListMenu =& base_menu_model($arr_skip_group_id); 

 echo "<ul class=\"nav navbar-top-links navbar-right\">";
 if( is_array($g_ListMenu) ) 
	foreach( $g_ListMenu as $MasterName => $arr_master_result )
 {
	if( is_array( $arr_master_result ) ) 
		foreach( $arr_master_result as $arr_detail_id => $arr_detail_rows )
	{
			
		$out =new EUI_Object($arr_detail_rows);
		$menuname = strtolower($out->get_value('file_name'));
		echo "<li id=\"".  join("_", array($out->get_value('id'),_get_session('UserId'))) ."\" > ".
						"<a href=\"javascript:void(0);\"  id=\"". $out->get_value('id') ."\" onclick=\"Ext.ShowMenu('". $out->get_value('file_name') ."','". $out->get_value('menu') ."');\" >".
						"<i class=\" ". Awesome($menuname) ." \"></i> ". $out->get_value('menu') .
					"</a> ".
				"</li>";
			$i++;	
	}		
 }
	   
	$UserFullname = strtolower(_get_session('Fullname'));
	echo "<li class=\"dropdown\">
			<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:void(0);\">
				<i class=\"fa fa-user fa-fw\"></i> ". lang(array(ucwords($UserFullname)))  ." <i class=\"fa fa-caret-down\"></i>
            </a>
			<ul class=\"dropdown-menu dropdown-user\">
				<li><a href=\"javascript:void(0);\" id=\"user-widget-profile\" onclick=\"Ext.MyProfile();\"><i class=\"fa fa-user fa-fw\"></i> My Profile</a></li>
				<li><a href=\"javascript:void(0);\" id=\"user-widget-password\" onclick=\"Ext.ChangeMyPassword();\"><i class=\"fa fa-key fa-fw\"></i> Change Password</a></li>
                <li class=\"divider\"></li> 
				<li data-toggle=\"modal\" data-target=\"#AboutUs\"><a href=\"javascript:void(0);\"><i class=\"fa fa-info-circle fa-fw\"></i> About Us</a></li>
				<li><a href=\"javascript:void(0);\" id=\"user-widget-logout\" onclick=\"Ext.AuthLogout();\"><i class=\"fa fa-sign-out fa-fw\"></i> Logout</a></li>
            </ul>
       </li>";
				
echo "</ul>";

?>