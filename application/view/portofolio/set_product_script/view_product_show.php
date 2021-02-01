<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/*
 * @ def    : include Header page HTML on layout form 
 * ------------------------------------------------------
 *
 * @ param  : $form  
 * @ akses  : public 
 * @ author : razaki team
 *
 */
 
?>

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title><?php echo title_header("Product Script");?></title>
<meta name="viewport" content="width=device-width" />
<script type="text/javascript" src="<?php echo base_spl_cores();  ?>/jquery-2.1.3.js?time=<?php echo time();?>"></script>
<script type="text/javascript" src="<?php echo base_ext_cores();  ?>/EUI.1.3.15.js?version=<?php echo date('Ymd');?>&amp;time=<?php echo time();?>"></script> 
<script>
/*
 * @ def 	: @ ready function document
 * ---------------------------------------------
 *
 * @ param	: document && window
 * @ aksess : public window 
 */
 
 $(document).ready(function() {
	$('#frame').attr('width', $(window).innerWidth());
	$('#frame').attr('height',$(window).innerHeight());	
 });
 
/*
 * @ def 	: @ ready function document
 * ---------------------------------------------
 *
 * @ param	: document && window
 * @ aksess : public window 
 */
 
 $(window).bind("resize", function(){
	$('#frame').attr('width', $(window).innerWidth());
	$('#frame').attr('height',$(window).innerHeight());	
 });
 
/*
 * @ def 	: @ ready function document
 * ---------------------------------------------
 *
 * @ param	: document && window
 * @ aksess : public window 
 */
</script>
</head>
<body style="margin:0px;" oncontextmenu="return false;">
<?php if( file_exists( APPPATH . 'script/' . $Data['ScriptFileName'] ) ) { ?>
 <div style="margin:-8">
	<embed id="frame" src="<?php echo base_url() .'application/script/' . $Data['ScriptFileName']; ?>"></embed>
 </div>
<?php } ?>	
</body>
</html>