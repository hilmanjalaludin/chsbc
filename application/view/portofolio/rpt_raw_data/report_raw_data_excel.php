<?php

Excel() -> xlsWriteHeader("Export_data_campaign".time());

$num = 0; // default num from 0 to (n);
$_column = ( isset( $result[0] ) ? $result[0] : array() );
$_labels = array(); $_lbl = 0;
 
foreach($_column as $label => $name){
	Excel() -> xlsWriteLabel( $num , $_lbl, $label );
	// echo $num ."|". $_lbl."|". $label;
	// echo "<pre>";
// print_r($result);
// echo "</pre>";
	$_labels[$_lbl] = $label;
	$_lbl++; 	
}

$num = $num+1; 
foreach( $result as $keys  => $rows ){
	foreach($_labels as $cols => $_label_keys ){
		Excel() -> xlsWriteLabel( $num , $cols, $rows[$_label_keys]);
	}
	$num++;
}

Excel() -> xlsClose();

?>