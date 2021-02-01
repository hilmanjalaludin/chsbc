<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="author" content="<?php echo author(); ?>"/>
<meta name="version" content="<?php echo version();?>"/>
<meta name="description" content="<?php echo description();?>"/>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta http-equiv="Content-Style-Type" content="text/css"/>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="X-UA-Compatible" content="IE=9,IE=10,chrome=1">

<title><?php echo description();?> </title>
<link type="text/css" rel="stylesheet" href="<?php echo base_themes_style( themes() );?>/ui.all.css?time=<?php echo time();?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_fonts_style();?>/font-awesome.min.css?version=<?php echo version();?>&amp;time=<?php echo time();?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo base_layout_style();?>/styles.cores.css?time=<?php echo time();?>" />
<link type="text/css" rel="shortcut icon"  	href="<?php echo base_image_layout();?>/favicon.png?version=<?php echo version();?>&amp;time=<?php echo time();?>">

<!-- loader all js file -->
<script type="text/javascript" src="<?php echo base_spl_cores();  ?>/jquery-1.4.4.js?time=<?php echo time();?>"></script>   
<script type="text/javascript" src="<?php echo base_spl_loader(); ?>?version=<?php echo date('Ymd');?>&amp;time=<?php echo time();?>"></script>
<script type="text/javascript" src="<?php echo base_ext_cores();  ?>/EUI.1.3.15.js?version=<?php echo date('Ymd');?>&amp;time=<?php echo time();?>"></script> 
<script type="text/javascript" src="<?php echo base_ext_cores();  ?>/EUI.Loader.1.3.15.js?version=<?php echo date('Ymd');?>&amp;time=<?php echo time();?>"></script> 
<script type="text/javascript" src="<?php echo base_jsp_layout(); ?>?version=<?php echo date('Ymd');?>&amp;time=<?php echo time();?>"></script> 
</head>