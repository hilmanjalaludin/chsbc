<?php  // ---------------- context user login ------ ?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"  lang="id-ID"   class="hiperf"  dir="ltr" >
<head>
 <meta name="author" content="<?php echo author(); ?>"/>
 <meta name="version" content="<?php echo version();?>"/>
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
 <title><?php echo lang(array('Login'));?></title>
 
 <!-- style sheet -->
 <link type="text/css" rel="stylesheet" href="<?php echo base_layout_style();?>/styles.plugin.css?version=<?php echo version();?>&amp;time=<?php echo time();?>"/>
 <link type="text/css" rel="stylesheet" href="<?php echo base_themes_style(themes()); ?>/ui.all.css" />
 <link type="text/css" rel="stylesheet" href="<?php echo base_fonts_style();?>/font-awesome.min.css?version=<?php echo version();?>&amp;time=<?php echo time();?>"/>
 <link type="text/css" rel="stylesheet" href="<?php echo base_layout_style();?>/styles.cores.css?version=<?php echo version();?>&amp;time=<?php echo time();?>"/>
 <link type="text/css" rel="stylesheet" href="<?php echo base_layout_style();?>/styles.login.css?version=<?php echo version();?>&amp;time=<?php echo time();?>"/>
 <link type="text/css" rel="shortcut icon" href="<?php echo base_image_layout();?>/favicon.png?version=<?php echo version();?>&amp;time=<?php echo time();?>">

 <!-- Include Js -->
 <script type="text/javascript" src="<?php echo base_spl_cores(); ?>/jquery-2.1.3.js?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script>    
 <script type="text/javascript" src="<?php echo base_spl_loader();?>?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script>
 <script type="text/javascript" src="<?php echo base_ext_cores(); ?>/EUI.1.3.15.js?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script> 
 <script type="text/javascript" src="<?php echo base_ext_helper();?>/EUI.UserLogin.js?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script> 
</head>