<?php
/*
 * @ def		create header name of file to process 
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
 
 Excel() -> xlsWriteHeader("Export_data_campaign".time());
 
 /*
 * @ def		called name of template download
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
 
 $num = 0; // default num from 0 to (n);
 
/*
 * @ def		called name of template download
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
 
$_column = ( isset( $result[0] ) ? $result[0] : array() );
$_labels = array(); $_lbl = 0;
 
foreach(  $_column as $label => $name)
{
	Excel() -> xlsWriteLabel( $num , $_lbl, $label );
	$_labels[$_lbl] = $label;
	$_lbl++; 	
 }

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
	foreach($_labels as $cols => $_label_keys ) 
	{
		Excel() -> xlsWriteLabel( $num , $cols, $rows[$_label_keys]);
	}
	$num++;
 }
 

/*
 * @ def		close ( exit after finished download content )
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
 
 Excel() -> xlsClose();
 
?>

