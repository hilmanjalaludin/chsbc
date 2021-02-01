<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link type="text/css" rel="stylesheet" href="<?php echo base_themes_style($website['_web_themes']);?>/ui.all.css?time=<?php echo time();?>" />
</head>
<body>
<?php

if( $this -> EUI_Session -> _have_get_session('UserId') ) 
{
	__("<title>Show data detail</title>");
	__("<style>table{font-family:Arial;font-size:11px;} h1{font-family:Arial;font-size:14px;}</style>");
	__("<h1> SHOW DATA DETAIL</h1>");
	__("<table cellpadding=\"0\" cellspacing=\"1\" border=0 width=\"100%\"><tr height=\"25\">");

	foreach($views_field as $k => $colname ){
			__("<th bgcolor='red' class='ui-corner-top ui-state-default' style=\"padding:4px 4px 4px 4px;border-left:1px solid #dddddd;font-family:Arial;font-size:12px;\">{$colname}<th>");	
		}	
		
	__("</tr>");	

	$num = 0;
	foreach( $views_data-> result_assoc() as $rows )
	{
		$_color = (($num%2!=0)?'#FFFCCC':'FFFFDD');
		__("<tr bgcolor=\"{$_color}\" height=\"24\">");
		foreach($views_field as $k => $colname )
		{
			if( $colname=='SellerId'){
				$UserData = $User ->_get_detail_user($rows[$colname]);
				__("<td nowrap style=\"padding-left:4px;border-left:1px solid #dddddd;border-bottom:1px solid #dddddd;\">". ( $UserData['full_name']? $UserData['full_name']:'-')."<td>");	
			}
			else if( $colname=='CallReasonId'){
				__("<td nowrap style=\"padding-left:4px;border-left:1px solid #dddddd;border-bottom:1px solid #dddddd;\">". ( $rows[$colname] ? $combo['CallResult'][$rows[$colname]]:'-')."<td>");	
			}
			else{
				__("<td nowrap style=\"padding-left:4px;border-left:1px solid #dddddd;border-bottom:1px solid #dddddd;\">". ( $rows[$colname] ? $rows[$colname]:'-')."<td>");	
			}
		}
		__("</tr>");
		$num++;
	}
	__("</table>");

}

?>
</body>
</html>