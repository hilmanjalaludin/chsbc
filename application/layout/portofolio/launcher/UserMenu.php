<?php $g_ListMenu =& base_menu_model(array(10)); ?>

 <div id="ribbon">
	<span class="ribbon-window-title application-title">
		<span class="fa-stack fa-lg ui-widget-awesome-toolbar">
			<i class="fa fa-circle fa-stack-2x" ></i>
			<i class="fa fa-user fa-stack-1x fa-inverse"></i>
		</span> 
		<b><?php __(strtoupper(_get_session('Username')));?></b>
		<span style="color:#ddd4d3;">|</span>
        <?php __(strtoupper(_get_session('Fullname')));?>		
	</span>
	
	
<?php

$cascade = 1;
if(is_array($g_ListMenu)) 
	foreach( $g_ListMenu as $GroupMenu => $ArrGroupMenu ) 
{  
	$g_GroupMenuId = join('-', array( strtolower(str_replace(" ","", $GroupMenu)), $cascade) ); 
	$g_GroupMenuName = ucwords(strtolower($GroupMenu));
	
	if( count( $ArrGroupMenu )  > 0 )
	{
		echo "<div class=\"ribbon-tab\" id=\"{$g_GroupMenuId}-tab\">".
				"<span class=\"ribbon-title\">{$g_GroupMenuName}</span>";
					
		if( is_array($ArrGroupMenu) and count($ArrGroupMenu) > 0 ) 
			foreach( $ArrGroupMenu as $g_MenuId => $a_MenuId ) 
		{  
			$out =new EUI_Object($a_MenuId);
			echo "<div class=\"ribbon-section\">".
					"<div class=\"ribbon-button ribbon-button-large\" id=\"{$g_MenuId}\" ".
					" onclick=\"Ext.ShowMenu('{$out->get_value('file_name')}','{$out->get_value('menu')}');\">".
					" <span class=\"button-title\">{$out->get_value('menu')}</span>";
						
						if( !is_null($out->get_value('images')) ) {
							echo "<img class=\"ribbon-icon ribbon-normal\" src=\"". base_image_layout() ."/icons/{$out->get_value('images')}_c.png\" width=\"36\" height=\"36\"/>".
								 "<img class=\"ribbon-icon ribbon-hot\" src=\"". base_image_layout() ."/icons/{$out->get_value('images')}_o.png\" width=\"36\" height=\"36\"/>".
								 "<img class=\"ribbon-icon ribbon-disabled\" src=\"". base_image_layout() ."/icons/{$out->get_value('images')}_d.png\" width=\"36\" height=\"36\"/>";
							
						} else {
							echo "<img class=\"ribbon-icon ribbon-normal\" src=\"". base_image_layout() ."/icons/new-page_c.png\" width=\"36\" height=\"36\"/>".
								 "<img class=\"ribbon-icon ribbon-hot\" src=\"". base_image_layout()."/icons/new-page_o.png\" width=\"36\" height=\"36\"/>".
								 "<img class=\"ribbon-icon ribbon-disabled\" src=\"". base_image_layout()."/icons/new-page_d.png\" width=\"36\" height=\"36\"/>";	
						
						
						}
						
					echo "</div>".
						 "</div>"; 
				} 
			echo "</div>";
	} 	
	
	$cascade++;
}
		
	$this->load->layout(base_layout().'/UserAboutUs');
	
echo "</div>";


?>


