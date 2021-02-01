<!DOCTYPE html>
<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns="http://www.w3.org/TR/REC-html40">
<head>
<title><?php echo title_header("Report");?></title>

<meta name="description" content="<?php echo description();?>"/>
<meta name="version" content="<?php echo version();?>"/>
<meta name="author" content="<?php echo author();?>"/>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<!-- start : css -->
<link type="text/css" rel="shortcut icon"  href="<?php echo base_image_layout();?>/favicon.png?version=<?php echo version();?>&amp;time=<?php echo time();?>">
<style id="Book1_10476_Styles">
	<?php $this->load->view("mod_view_tracking/view_calltrack_header_summary_styles_html"); ?>
</style>

</head>
<body>

<!-- start : title -->
<div style="margin:20px 0px 10px 5px;width:100%;">
	<?php $this->load->view("mod_view_tracking/view_calltrack_notes_header_title"); ?>
</div>
<!-- end : title -->
<div style="padding-right:10px;">