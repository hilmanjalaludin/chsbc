<?php
 /*
 * @ def		called name of template download
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
 
 $file_name = APPPATH ."temp/". preg_replace('/\s+/', '_', $filename) . "_".time().".txt";
 $handle = fopen( $file_name , "a+");
 
 foreach( $template as $k => $name)
 {
	$line_write .= "{$name}{$sparator}";
 }

fwrite($handle,substr($line_write, 0, (strlen($line_write)-1)));
fclose($handle);

 if(!file_exists($file_name)) die("I'm sorry, the file doesn't seem to exist.");

    $type = filetype($file_name); 
    $today = date("F j, Y, g:i a"); $time = time();
    header("Content-type: $type");
    header("Content-Disposition: attachment;filename=$file_name");
    header("Content-Transfer-Encoding: binary"); 
    header('Pragma: no-cache'); 
    header('Expires: 0');
    set_time_limit(0); 
    readfile($file_name);
	@unlink($file_name);
	exit(0);

/*
 ^ @ def		close ( exit after finished download content )
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
 
 // Excel() -> xlsClose();
?>