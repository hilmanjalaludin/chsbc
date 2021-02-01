<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">

<title><?php echo description();?></title>
<meta name="title" content="<?php echo description();?>"/>
<meta name="description" content="<?php echo description();?>"/>
<meta name="version" content="<?php echo version();?>"/>
<meta name="author" content="<?php echo author();?>"/>
<meta name="theme" content="razakier"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<meta http-equiv="Content-Style-Type" content="text/css"/>
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta http-equiv="X-UA-Compatible" content="IE=9,IE=10,chrome=1">


<!-- start : styles -->

<link type="text/css" rel="stylesheet"  href="<?php echo base_layout_style();?>/styles.plugin.css?version=<?php echo version();?>&amp;time=<?php echo time();?>"/>
<link type="text/css" rel="stylesheet"  href="<?php echo base_layout_style();?>/styles.plugin.css?version=<?php echo version();?>&amp;time=<?php echo time();?>"/>
<link type="text/css" rel="stylesheet"  href="<?php echo base_layout_style();?>/chart/Chart.min.css"/>
<link type="text/css" rel="stylesheet" href="<?php echo base_themes_style();?>/ui.all.css?time=<?php echo time();?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_fonts_style();?>/font-awesome.min.css?time=<?php echo time();?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_layout_style();?>/styles.cores.css?time=<?php echo time();?>" />
<link type="text/css" rel="shortcut icon"  href="<?php echo base_image_layout();?>/favicon.png?version=<?php echo version();?>&amp;time=<?php echo time();?>">

<!-- edit hilman -->
<?php // echo base_spl_layout(); die();?>

<script type="text/javascript" src="<?php echo base_spl_layout();?>/canvasjsiman.min.js?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script>
<script type="text/javascript" src="<?php echo base_spl_layout();?>/chart/Chart.bundle.min.js"></script>
<!-- <script type="text/javascript" src="<?php // echo base_spl_layout();?>/jquery.canvasjs.min.js"></script> -->
<!-- start : script -->
<script type="text/javascript" src="<?php echo base_spl_cores(); ?>/jquery-2.1.3.js?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script>
<script type="text/javascript" src="<?php echo base_spl_layout();?>/bootstrap.min.js?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script>
<script type="text/javascript" src="<?php echo base_spl_loader();?>?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script>
<script type="text/javascript" src="<?php echo base_ext_cores(); ?>/EUI.1.3.15.js?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script>
<script type="text/javascript" src="<?php echo base_ext_cores(); ?>/EUI.Loader.1.3.15.js?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script> 
<script type="text/javascript" src="<?php echo base_jsp_layout();?>?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script> 
<style>
      .canvasjs-chart-credit {
        display: none;
      }
</style>

<script>
document.onkeydown = function(e) {
  if(event.keyCode == 123) {
    do {
      input = prompt("Forbidden: Anda telah melanggar peraturan aplikasi. Silahkan hubungi bagian IT")
    } while(input == null || input == "" || input != "NGAPAIN?")
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)) {
    do {
      input = prompt("Forbidden: Anda telah melanggar peraturan aplikasi. Silahkan hubungi bagian IT")
    } while(input == null || input == "" || input != "NGAPAIN?")
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'C'.charCodeAt(0)) {
    do {
      input = prompt("Forbidden: Anda telah melanggar peraturan aplikasi. Silahkan hubungi bagian IT")
    } while(input == null || input == "" || input != "NGAPAIN?")
     return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)) {
    do {
      input = prompt("Forbidden: Anda telah melanggar peraturan aplikasi. Silahkan hubungi bagian IT")
    } while(input == null || input == "" || input != "NGAPAIN?")
     return false;
  }
  if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)) {
    do {
      input = prompt("Forbidden: Anda telah melanggar peraturan aplikasi. Silahkan hubungi bagian IT")
    } while(input == null || input == "" || input != "NGAPAIN?")
     return false;
  }
}

// document.addEventListener('contextmenu', function(e) {
//   alert('Klik kanan di matikan')
//   e.preventDefault();
// });
</script>
</head>