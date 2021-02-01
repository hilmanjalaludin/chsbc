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
 echo "Handling Type => "._get_session('HandlingType')." Group => ". _get_session('agentGroup');
 // echo "<pre>" .var_dump($_SESSION). "</pre>";
 echo "<ul class=\"nav navbar-top-links navbar-right\">";
 
 if(_get_session('agentGroup')>1 && _get_session('HandlingType')==4){
	 echo "PDS";
 }else{
	 if( is_array($g_ListMenu) ) 
		foreach( $g_ListMenu as $MasterName => $arr_master_result ){
			$arr_expose_name = explode(" ", strtolower($MasterName));
			echo "<li class=\"dropdown\" id=\"". str_replace(" ","_", $MasterName) ."-tab\">".
					"<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:void(0);\">".
						"<i class=\"". Awesome($MasterName) ."\"></i> ". ( count($arr_expose_name)==2 ? ucfirst($arr_expose_name[1]) : ucfirst($arr_expose_name[0])) ." <i class=\"fa fa-caret-down\"></i>".
					 "</a>";
			
			echo "<ul class=\"dropdown-menu dropdown-user\">";		
			
			$i=0;
			if( is_array( $arr_master_result ) ) 
				foreach( $arr_master_result as $arr_detail_id => $arr_detail_rows )
			{
				//print_r($arr_detail_rows);
				$out =new EUI_Object($arr_detail_rows);
				echo "<li> ".
							"<a href=\"javascript:void(0);\" id=\"". $out->get_value('id') ."\" onclick=\"Ext.ShowMenu('". $out->get_value('file_name') ."','". $out->get_value('menu') ."');\" >".
								"<i class=\"fa fa-arrow-circle-right fa-fw\"></i> ". $out->get_value('menu') .
							"</a> ".
						"</li>";
					$i++;	
			}
			
			echo "</ul> ";
			echo "</li>";	
	 }
 }
	   
	echo "<li class=\"dropdown\">
			<a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"javascript:void(0);\">
				<i class=\"fa fa-user fa-fw\"></i> ". lang(array(_get_session('Fullname'))) ." <i class=\"fa fa-caret-down\"></i>
            </a>
			<ul class=\"dropdown-menu dropdown-user\">
				<li><a href=\"javascript:void(0);\" onclick=\"Ext.MyProfile();\"><i class=\"fa fa-user fa-fw\"></i> My Profile</a></li>
				<li><a href=\"javascript:void(0);\" onclick=\"Ext.ChangeMyPassword();\"><i class=\"fa fa-key fa-fw\"></i> Change Password</a></li>
                <li class=\"divider\"></li> 
				<li data-toggle=\"modal\" data-target=\"#AboutUs\"><a href=\"javascript:void(0);\"><i class=\"fa fa-info-circle fa-fw\"></i> About Us</a></li>
				<li><a href=\"javascript:void(0);\" onclick=\"Ext.AuthLogout();\"><i class=\"fa fa-sign-out fa-fw\"></i> Logout</a></li>
            </ul>
       </li>";
	   
	
	

			
				
echo "</ul>";

?>