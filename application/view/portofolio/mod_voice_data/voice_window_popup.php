<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @ def 		: play recording view // constructor class 
 * -----------------------------------------
 
 * @ params  	: post & definition paymode 
 * @ author     : omen
 * @ date		: 20140930
 * @ return 	: void(0)
 * @ example    : get by fields ID / Campaign ID
 *
 **/

?>
<!DOCTYPE html>
<html>
<head>
<title>Play Recording</title>
<link type="text/css" rel="stylesheet" href="<?php echo base_themes_style($website['_web_themes']);?>/ui.all.css?time=<?php echo time();?>" />
<link type="text/css" rel="stylesheet" href="<?php echo base_layout_style();?>/styles.cores.css?time=<?php echo time();?>" />
<script type="text/javascript" src="<?php echo base_jquery();?>/ui/jquery-2.0.0.js?time=<?php echo time();?>"></script>  
<script type="text/javascript" src="<?php echo base_enigma();?>/cores/EUI_1.0.2.js?time=<?php echo time();?>"></script> 
<script type="text/javascript" src="<?php echo base_enigma();?>/helper/EUI_Media.js?time=<?php echo time();?>"></script> 
<!-- interval set -->
<script>

/*
 * convert data to object by JSON 
 * please handle for deleted on window.close / beforunload 
 * then deleted file on temp/ .wav 
 */

var data = <?php __(json_encode($rows));?>;

/*
 * on ready document then load all object 
 * generate by javascript
 */
 
Ext.document().ready(function(){

Ext.Media('panel-voice', { 	
	url : window.opener.Ext.System.view_app_url() +'/temp/'+ data.file_voc_name,
	width 	: '100%',
	height 	: '25%',
	options : {
		ShowControls : 'true',
		ShowStatusBar: 'true',
		ShowDisplay  : 'true',
		autoplay 	 : 'true'
	}
}).WAVPlayer(); 	
					
	Ext.Tpl("panel-voice", data).Compile();
	Ext.Cmp('MediaPlayer').setAttribute('class','textarea');
	
	Ext.Css('panel-voice').style
	({
		'text-align' : 'left', 
		'padding-left' : "2px", 
		'padding-top' : "0px",
	});
	
	Ext.Css('div-voice-container').style({
		"margin-top" : "10px", "width" : "100%",
		"margin-bottom" : "20px" 
	});
});					
</script>
</head>
	<body>
		<div id="panel-voice"> </div>
	</body>
</html>