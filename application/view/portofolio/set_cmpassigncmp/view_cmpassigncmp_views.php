<?php

/*
 * @ def		called name of template download
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
 
 $num = 0; // default num from 0 to (n);
 $_set_views.= "<h1 style='margin:4px;color:green;font-size:12px;font-family:Arial;'> Campaign Data </h1>";
 $_set_views.= '<table width="80%" style="margin:4px;border-collapse:collapse;border:1px solid #FFCCCC;">';
 
/*
 * @ def		called name of template download
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
 
 
$_column = ( isset( $result[0] ) ? $result[0] : array() );
$_labels = array(); $_lbl = 0;

$_set_views .= '<tr>'; 
foreach(  $_column as $label => $name)
{
	$_set_views .= '<th style="font-family:Arial;font-size:12px;padding:8px;border:1px solid #FFCCCC;background-color:#eee;">' . $label .' </th>';
	$_labels[$_lbl] = $label;
	$_lbl++; 	
 }
 
$_set_views .= '</tr>'; 
/*
 * @ def		start number 
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
 
 $num = $num+1; 
 
/*
 * @ def		set rows datas 
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
 
 foreach( $result as $keys  => $rows )
 {
	$_set_views .= '<tr>'; 
	foreach($_labels as $cols => $_label_keys ) {
		$_set_views .= '<td style="font-family:Arial;font-size:11px;padding:6px;border:1px solid #FFCCCC;background-color:#fffccc;">'. $rows[$_label_keys] . '</td>';
	}
	$_set_views .= '</tr>'; 
	$num++;
 }

 $_set_views .='</table>';
/*
 * @ def		close ( exit after finished download content )
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
?>
<!DOCTYPE HTML>
<html>
<head>
<title> <?php echo ucfirst(base_layout());?> :: Campaign Data </title>
</head>
<body style="margin:0px;">
	<?php echo $_set_views; ?>
</body>
</html>	
