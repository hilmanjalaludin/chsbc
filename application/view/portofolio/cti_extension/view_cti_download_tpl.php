<?php
 /*
 ^ @ def		re  - construction array data 
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
 
 $data_array = array();
 foreach($columns as $k => $name ) {
	if(($k!=0))  $data_array[] = $name; 
 }

/*
 * @ def		called name of template download
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
 
 Excel() -> xlsWriteHeader("CTI_extension_template_".time());

/*
 * @ def		content download
 *
 * @ package 	 view
 * @ params 	 Content line write
 */ 
	$i = 0;
	while( $i < count($data_array)){
		Excel() -> xlsWriteLabel(0, $i, $data_array[$i]);
		$i++;
	}
	
/*
 ^ @ def		close ( exit after finished download content )
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
 
 Excel() -> xlsClose();
?>