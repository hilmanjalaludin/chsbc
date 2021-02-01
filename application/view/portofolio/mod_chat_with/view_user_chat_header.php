<!DOCTYPE html>
<html>
 <head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 <title><?php echo title_header("User Chat");?></title>
 <meta name="viewport" content="width=device-width" />
 
 <link type="text/css" rel="stylesheet" href="<?php echo base_themes_style( themes() );?>/ui.all.css?time=<?php echo time();?>" />
 <link type="text/css" rel="stylesheet" href="<?php echo base_fonts_style();?>/font-awesome.min.css?version=<?php echo version();?>&amp;time=<?php echo time();?>"/>
 <link type="text/css" rel="stylesheet" href="<?php echo base_layout_style();?>/styles.overwriter.css?time=<?php echo time();?>" />
 <link type="text/css" rel="shortcut icon"  	href="<?php echo base_image_layout();?>/favicon.png?version=<?php echo version();?>&amp;time=<?php echo time();?>">
 <script type="text/javascript" src="<?php echo base_spl_cores();?>/jquery-2.0.0.js?time=<?php echo time();?>"></script>   
 <script type="text/javascript" src="<?php echo base_ext_cores();?>/EUI.1.3.15.js?version=<?php echo date('Ymd');?>&amp;time=<?php echo time();?>"></script> 

 <script>
 
 window.ResponePage = function() 
 { 
	$('body').css ({ "padding-top" : "5px", "padding-bottom" : "0px" });
	$('.page-wrapper').css({ "height" : $('.corner').height()-20, "width"  : $('.corner').width()-10, "margin" : "-6px 5px 5px -3px", "float"  : "center" });
	$('a.ui-user-chat').css({"color" : "green" });
	$('a.ui-user-chat:hover').css({"color" : "red" });
 }
 
 $(document).ready(function() { window.ResponePage() });
 $(window).bind("resize", function(e){ window.ResponePage()});

</script>
</head>
<body>