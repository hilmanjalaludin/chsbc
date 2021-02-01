<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(0);
$http = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 's' : '') . '://';
$fo = ( isset($_SERVER['SCRIPT_NAME']) ? str_replace("index.php","", $_SERVER['SCRIPT_NAME']) : '');
$port = ( isset($_SERVER['SERVER_PORT']) ?  ($_SERVER['SERVER_PORT']!=80?(":".$_SERVER['SERVER_PORT']):"") : ''); 

/*
 * E.U.I  1.0.0
 
 * setup & rooutes & autoladder  
 
 *@ Configuration settup application 
 *@ session prefix and other settup  
 **/
 
 
 
/**
 *@def  : rooute 
 *@stt  : routing  will load  in core file. first load of Controller class 
 *@link : /system/core/EUI_Config.php
 **/ 

$config['base_url']    			= "$http". ( isset($_SERVER['SERVER_NAME'] ) ? $_SERVER['SERVER_NAME'] :'').$port.$fo;
$config['index_page'] 			= 'index.php';
$config['uri_protocol']			= 'AUTO';
$config['url_suffix'] 			= '';
$config['language']				= 'english';
$config['charset'] 				= 'UTF-8';
$config['enable_hooks'] 		= FALSE;
$config['subclass_prefix'] 		= 'EUI_';
$config['class_prefix'] 		= 'EUI_';
$config['permitted_uri_chars'] 	= 'a-z 0-9~%.:_\-';
$config['allow_get_array']		= TRUE;
$config['enable_query_strings'] = FALSE;
$config['controller_trigger']	= 'c';
$config['function_trigger']		= 'm';
$config['directory_trigger']	= 'd'; 
$config['log_threshold'] 		= 0;
$config['log_path'] 			= '';
$config['log_date_format'] 		= 'Y-m-d H:i:s';
$config['cache_path'] 			= '';
$config['encryption_key'] 		= 'BE21Z';
$config['sess_cookie_name']		= 'eui_session';
$config['sess_expiration']		= 7200;
$config['sess_expire_on_close']	= FALSE;
$config['sess_encrypt_cookie']	= FALSE;
$config['sess_use_database']	= FALSE;
$config['sess_table_name']		= 'eui_sessions';
$config['sess_match_ip']		= FALSE;
$config['sess_match_useragent']	= TRUE;
$config['sess_time_to_update']	= 300;
$config['sess_prefix']			= 'newportofr1_';
$config['cookie_prefix']		= "";
$config['cookie_domain']		= "";
$config['cookie_path']			= "/";
$config['cookie_secure']		= FALSE;
$config['global_xss_filtering'] = FALSE;
$config['csrf_protection'] 		= FALSE;
$config['csrf_token_name'] 		= 'csrf_test_name';
$config['csrf_cookie_name'] 	= 'csrf_cookie_name';
$config['csrf_expire'] 			= 7200;
$config['compress_output'] 		= FALSE;
$config['time_reference'] 		= 'local';
$config['rewrite_short_tags'] 	= FALSE;
$config['proxy_ips'] 			= '';

/*
 * @ def 	: base layout && application 
 * ----------------------------------------
 *
 * @ param : configuration;
 */

$config['base_layout'] 			= 'hsbctele';
$config['base_application'] 	= 'portofolio';

/**
 *@def  : rooute 
 *@stt  : routing  will load  in core file. first load of Controller class 
 *@link : /system/core/EUI_Routes.php
**/ 


$route['default_controller'] = "Auth";
$route['404_override'] = '';

/*
|* -------------------------------------------------------------------
|* Auto-load Libraries
|* -------------------------------------------------------------------
|* These are the classes located in the system/libraries folder
|* or in your application/libraries folder.
|*
|* These are the things you can load automatically:
|* 1. Packages
|* 2. Libraries
|* 3. Helper files
|* 4. Custom config files
|* 5. Language files
|* 6. Models
|*
|* link : /system/core/EUI_Loader.php
*/

$autoload['helper']    = array(	'url','string','language', 'EUI_Common', 
							    'EUI_Json','EUI_Sess','EUI_Form','EUI_Tools', 
								'EUI_Excel','EUI_ReadText','EUI_WriteLog','EUI_Flexible',
								'EUI_OleRead','EUI_Layout','EUI_Server','EUI_Version','EUI_Page','EUI_Dropdown'
							);
								
$autoload['libraries'] = array('database','Session','encrypt',
							   'Services_JSON','EUI_Tools','EUI_Page','EUI_Version'
							   );
							   
$autoload['language']  = array('default');
$autoload['plugin']    = array('Browser');
$autoload['packages']  = array();
$autoload['config']    = array();
$autoload['model'] 	   = array();


/**
 *@def  : mime types 
 *@stt  : This file contains an array of mime types.  It is used by the
		  Upload class to help identify allowed file types.				
 *@link : /system/core/EUI_Output.php
**/ 

$mimes['tgz'] 	= array('application/x-tar', 'application/x-gzip-compressed');
$mimes['xls']	= array('application/excel', 'application/vnd.ms-excel', 'application/msexcel');
$mimes['ppt'] 	= array('application/powerpoint', 'application/vnd.ms-powerpoint');
$mimes['pdf'] 	= array('application/pdf', 'application/x-download');
$mimes['exe'] 	= array('application/octet-stream', 'application/x-msdownload');
$mimes['csv'] 	= array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel');
$mimes['zip']	= array('application/x-zip', 'application/zip', 'application/x-zip-compressed');
$mimes['mp3'] 	= array('audio/mpeg', 'audio/mpg', 'audio/mpeg3', 'audio/mp3');
$mimes['jpeg'] 	= array('image/jpeg', 'image/pjpeg');
$mimes['jpg'] 	= array('image/jpeg', 'image/pjpeg');
$mimes['jpe'] 	= array('image/jpeg', 'image/pjpeg');
$mimes['png'] 	= array('image/png',  'image/x-png');
$mimes['log'] 	= array('text/plain', 'text/x-log');
$mimes['word'] 	= array('application/msword', 'application/octet-stream');
$mimes['json'] 	= array('application/json', 'text/json');
$mimes['hqx'] 	= 'application/mac-binhex40';
$mimes['cpt'] 	= 'application/mac-compactpro';
$mimes['bin'] 	= 'application/macbinary';
$mimes['dms'] 	= 'application/octet-stream';
$mimes['lha'] 	= 'application/octet-stream';
$mimes['lzh'] 	= 'application/octet-stream';
$mimes['class'] = 'application/octet-stream';
$mimes['psd'] 	= 'application/x-photoshop';
$mimes['so'] 	= 'application/octet-stream';
$mimes['sea'] 	= 'application/octet-stream';
$mimes['dll'] 	= 'application/octet-stream';
$mimes['oda'] 	= 'application/oda';
$mimes['ai'] 	= 'application/postscript';
$mimes['eps'] 	= 'application/postscript';
$mimes['ps'] 	= 'application/postscript';
$mimes['smi'] 	= 'application/smil';
$mimes['smil'] 	= 'application/smil';
$mimes['mif'] 	= 'application/vnd.mif';
$mimes['wbxml'] = 'application/wbxml';
$mimes['wmlc'] 	= 'application/wmlc';
$mimes['dcr'] 	= 'application/x-director';
$mimes['dir'] 	= 'application/x-director';
$mimes['dxr'] 	= 'application/x-director';
$mimes['dvi'] 	= 'application/x-dvi';
$mimes['gtar'] 	= 'application/x-gtar';
$mimes['gz'] 	= 'application/x-gzip';
$mimes['php'] 	= 'application/x-httpd-php';
$mimes['php4'] 	= 'application/x-httpd-php';
$mimes['php3'] 	= 'application/x-httpd-php';
$mimes['phtml'] = 'application/x-httpd-php';
$mimes['phps'] 	= 'application/x-httpd-php-source';
$mimes['js'] 	= 'application/x-javascript';
$mimes['swf'] 	= 'application/x-shockwave-flash';
$mimes['sit'] 	= 'application/x-stuffit';
$mimes['tar'] 	= 'application/x-tar';
$mimes['xhtml'] = 'application/xhtml+xml';
$mimes['xht'] 	= 'application/xhtml+xml';
$mimes['mid'] 	= 'audio/midi';
$mimes['midi'] 	= 'audio/midi';
$mimes['mpga'] 	= 'audio/mpeg';
$mimes['mp2'] 	= 'audio/mpeg';
$mimes['aif'] 	= 'audio/x-aiff';
$mimes['aiff'] 	= 'audio/x-aiff';
$mimes['aifc'] 	= 'audio/x-aiff';
$mimes['ram'] 	= 'audio/x-pn-realaudio';
$mimes['rm'] 	= 'audio/x-pn-realaudio';
$mimes['rpm'] 	= 'audio/x-pn-realaudio-plugin';
$mimes['ra'] 	= 'audio/x-realaudio';
$mimes['rv'] 	= 'video/vnd.rn-realvideo';
$mimes['wav'] 	= 'audio/x-wav';
$mimes['bmp'] 	= 'image/bmp';
$mimes['gif'] 	= 'image/gif';
$mimes['tiff'] 	= 'image/tiff';
$mimes['tif'] 	= 'image/tiff';
$mimes['css'] 	= 'text/css';
$mimes['html'] 	= 'text/html';
$mimes['htm'] 	= 'text/html';
$mimes['shtml'] = 'text/html';
$mimes['txt'] 	= 'text/plain';
$mimes['text'] 	= 'text/plain';
$mimes['rtx'] 	= 'text/richtext';
$mimes['rtf'] 	= 'text/rtf';
$mimes['xml'] 	= 'text/xml';
$mimes['xsl'] 	= 'text/xml';
$mimes['mpeg'] 	= 'video/mpeg';
$mimes['mpg'] 	= 'video/mpeg';
$mimes['mpe'] 	= 'video/mpeg';
$mimes['qt'] 	= 'video/quicktime';
$mimes['mov'] 	= 'video/quicktime';
$mimes['avi'] 	= 'video/x-msvideo';
$mimes['movie'] = 'video/x-sgi-movie';
$mimes['doc'] 	= 'application/msword';
$mimes['docx'] 	= 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
$mimes['xlsx'] 	= 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
$mimes['xl'] 	= 'application/excel';
$mimes['eml'] 	= 'message/rfc822';
