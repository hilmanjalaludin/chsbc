<?php

if(!defined('TEMP') ) 
define('TEMP',str_replace('system','application', BASEPATH)."temp");
/*
 * @ def		called name of template download
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
  
 $_list_ext = null;
 
/*
 * @ def		called name of template download
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
 
 
 WriteLog() -> _relative_write_filename( TEMP ,"CTI_extension" .date('YmdHi') . ".conf");
 
 
/*
 * @ def		called name of template download
 *
 * @ package 	 view
 * @ params 	 Content line write
 */

 if( !$data -> EOF() )
 {
	foreach( $data -> result_assoc() as $rows )
	{
		if( $rows['ext_number']!='')
		{
			$_list_ext.= "[$rows[ext_number]]\n"."type=friend\n"."secret=$rows[ext_number]\n"."context=centerback\n"."host=dynamic\n"."nat=no\n"."qualify=yes\n"."canreinvite=no\n".";call-limit=3\n"."mailbox=1234@default\n\r";
		}
	}
 }
 
/*
 * @ def		called name of template download
 *
 * @ package 	 view
 * @ params 	 Content line write
 */
  
 WriteLog() -> _write_content($_list_ext);
 
/*
 ^ @ def		close ( exit after finished download content )
 *
 * @ package 	 view
 * @ params 	 Content line write
 */

 WriteLog() -> _download_content();
 
// END OF FILE 
// END OF FILE 
?>