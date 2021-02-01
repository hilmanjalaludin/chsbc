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
 
 Excel() -> xlsWriteHeader(preg_replace('/\s+/', '_', $filename) ."_". time() );

 /*
 * @ def		called name of template download
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
 
 foreach( $template as $k => $name)
 {
	Excel() -> xlsWriteLabel(0, $num, $name );
	$num++;
 }

/*
 ^ @ def		close ( exit after finished download content )
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
 
 Excel() -> xlsClose();
?>