<?php
/*
 * @ def		called name of template download
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
 
 $num = 0;
 
/*
 * @ def		called name of template download
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
 
 Excel() -> xlsWriteHeader("CTI_extension_data_xls".time());

 /*
 * @ def		called name of template download
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
 
 foreach( $cols as $k => $name)
 {
	Excel() -> xlsWriteLabel( $num, $k, $name );
 }

/*
 * @ def		content download
 *
 * @ package 	 view
 * @ params 	 Content line write
 */ 
 
 $num+=1;
 foreach( $data -> result_assoc() as $rows )
 {
	Excel() -> xlsWriteLabel( $num, 0, $rows['id'] );
	Excel() -> xlsWriteLabel( $num, 1, $rows['pbx'] );
	Excel() -> xlsWriteLabel( $num, 2, $rows['ext_number'] );
	Excel() -> xlsWriteLabel( $num, 3, $rows['ext_desc'] );
	Excel() -> xlsWriteLabel( $num, 4, $rows['ext_type'] );
	Excel() -> xlsWriteLabel( $num, 5, $rows['ext_status'] );
	Excel() -> xlsWriteLabel( $num, 6, $rows['ext_location'] );
	
	$num+=1;
 }
	
/*
 ^ @ def		close ( exit after finished download content )
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
 
 Excel() -> xlsClose();
?>