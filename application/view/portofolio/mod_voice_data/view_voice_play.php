<!DOCTYPE html>
<html>
 <head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
 <title>Voice Loger <?php echo version();?></title>
 <meta name="viewport" content="width=device-width" />
 <link type="text/css" rel="stylesheet" href="<?php echo base_themes_style();?>/ui.all.css?time=<?php echo time();?>" />
 <link type="text/css" rel="stylesheet" href="<?php echo base_fonts_style();?>/font-awesome.min.css?time=<?php echo time();?>" />
 <link type="text/css" rel="stylesheet" href="<?php echo base_layout_style();?>/styles.cores.css?time=<?php echo time();?>" />
 <link type="text/css" rel="shortcut icon"  href="<?php echo base_image_layout();?>/favicon.png?version=<?php echo version();?>&amp;time=<?php echo time();?>">

 <!-- load content js by loader customize on layout base -->
 
 <script type="text/javascript" src="<?php echo base_spl_cores(); ?>/jquery-1.4.4.js?version=<?php echo version();?>&amp;time=<?php echo time();?>"></script>
 <script type="text/javascript" src="<?php echo base_spl_loader();?>?version=<?php echo date('Ymd');?>&amp;time=<?php echo time();?>"></script>
 <script type="text/javascript" src="<?php echo base_ext_cores(); ?>/EUI.1.3.15.js?version=<?php echo date('Ymd');?>&amp;time=<?php echo time();?>"></script>
 <script type="text/javascript" src="<?php echo base_ext_cores(); ?>/EUI.Loader.1.3.15.js?version=<?php echo date('Ymd');?>&amp;time=<?php echo time();?>"></script> 
 <script type="text/javascript" src="<?php echo base_ext_helper();?>/EUI.Media.js?version=<?php echo version();?>&amp;time=<?php echo time();?>" ></script>
 <script type="text/javascript" src="<?php echo base_ext_helper();?>/EUI.Browser.js?version=<?php echo version();?>&amp;time=<?php echo time();?>" ></script>
 
 <!-- local script : 2015 -->
 <script>
 var data = <?php echo json_encode($raw); ?>;
 $(document).ready(function()
 {
	 try{
		var EventUrl = [window.opener.Ext.System.view_app_url(),'temp', data.file_voc_name];
	 } catch(e) {
		 var EventUrl = [Ext.System.view_app_url(),'temp', data.file_voc_name];
	 }
	 
	function Play() {
		var sfw = new Ext.Media('play_panel', { 
			url 	: EventUrl.join('/'),
			width 	: '98%',
			height 	: '150px',
				options : {
					ShowControls : 'true',
					ShowStatusBar: 'true',
					ShowDisplay  : 'true',
					autoplay 	 : 'true'
				}
		});
		
		var isMSIE = ( Ext.Browser().getName()=='Microsoft Internet Explorer' );
		if( isMSIE ){ sfw.WAVPlayer();
		} else { sfw.WAVPlayer(); }
		
		Ext.Tpl("play_panel", data).Compile();
		$('#QuikTime').addClass("textarea");
		$('#play_panel').css({'display' : 'table', 'width' : '98%',	'text-align' : 'left',  'padding' : "2px" });
		$('#play_panel').css({ "margin-top" : "0px", "width" : "100%", "margin-bottom" : "20px"});	
	}	
	Play();	
 });		
</script>
</head>
<body>
	<div id="play_panel"> </div>
</body>
</html>