<?php 
echo javascript(array( 
	array('_file' => base_jquery().'/plugins/extToolbars.js', 'eui_'=>'1.0.0', 'time'=>time()),
	array('_file' => base_jquery().'/plugins/Paging.js', 'eui_'=>'1.0.0', 'time'=>time()),
	array('_file' => base_enigma().'/helper/EUI_Media.js', 'eui_'=>'1.0.0', 'time'=>time())
));
?>

<script type="text/javascript">
/* create object **/
Ext.document('document').ready( function(){
	Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
 }); 
 
var Reason = [];

Ext.EQuery.TotalPage   = '<?php echo $page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';

/* catch of requeet accep browser **/
var datas = {
	agent_ext 	: '<?php echo _get_post('agent_ext');?>',
	agent_id 	: '<?php echo _get_post('agent_id');?>',
	agent_group : '<?php echo _get_post('agent_group');?>',
	start_time 	: '<?php echo _get_post('start_time');?>',
	end_time 	: '<?php echo _get_post('end_time');?>',
	b_number	: '<?php echo _get_post('b_number');?>',
	order_by	: '<?php echo _get_post('order_by');?>',
	type		: '<?php echo _get_post('type');?>'
}
			
/* assign navigation filter **/

var navigation = {
	custnav : Ext.DOM.INDEX +'/VoiceLoger/index/',
	custlist : Ext.DOM.INDEX +'/VoiceLoger/content/'
}
		
/* assign show list content **/
		
Ext.EQuery.construct(navigation,datas)
Ext.EQuery.postContentList();

/* function searching customers **/
	
var searchCustomer = function()
{
	Ext.EQuery.construct(navigation,Ext.Join([Ext.Serialize('frmSearch').getElement()]).object() );
	Ext.EQuery.postContent();
}

// simple clear under form document

Ext.DOM.Clear = function(){
	Ext.Serialize('frmSearch').Clear();
}

/* 
 * @ def : play
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
$(function(){
	$('#toolbars').extToolbars
	({
		extUrl    : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle  : [['Search'],['Clear'],['Play GSM'],['Play WAV'],['Stop'],['Download'],[]],
		extMenu   : [['searchCustomer'],['Clear'],['play'],['PlayWav'],['StopPlay'],['Download'],[]],
		extIcon   : [['zoom.png'], ['cancel.png'],['control_play_blue.png'],['control_play_blue.png'],['cancel.png'],['disk.png'],[]],
		extText   : true,
		extInput  : true,
		extOption : [{
			render : 6,
			type   : 'label',
			id     : 'voice-list-wait', 	
			name   : 'voice-list-wait',
			label :'<span style="color:#dddddd;">-</span>'
		}]
	});
	
	$('.box').datepicker({
		showOn: 'button', 
		buttonImage: Ext.DOM.LIBRARY+'/gambar/calendar.gif', 
		buttonImageOnly: true, 
		dateFormat:'dd-mm-yy',readonly:true
	});
});

/* 
 * @ def : play
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
Ext.DOM.play = function()
{
  var RecordingId = Ext.Cmp('voice_loger_id').getChecked();
  if((RecordingId!=''))
  {
	Ext.Cmp("voice-list-wait").setText("<img src="+ Ext.DOM.LIBRARY +"/gambar/loading.gif height='10px;'> <span style='color:red;'>Please Wait...</span>");
	Ext.Ajax({
		url 	: Ext.DOM.INDEX +'/VoiceLoger/VoicePlay/',
		method 	: 'GET',
		param 	: { RecordId : RecordingId },
		ERROR   : function(e)
		{
			Ext.Cmp("voice-list-wait").setText('<span style="color:silver;">done.</span>');
			Ext.Util(e).proc(function(fn){
				if( fn.success )
				{
					Ext.Media('play_panel', { 
						url 	: Ext.System.view_app_url() +'/temp/'+ fn.data.file_voc_name,
						width 	: '40%',
						height 	: '40px',
						options : {
							ShowControls : 'true',
							ShowStatusBar: 'true',
							ShowDisplay  : 'true',
							autoplay 	 : 'true'
						}
					}).GSMPlayer(); 	
					
					Ext.Tpl("play_panel", fn.data).Compile();
					Ext.Cmp('QuikTime').setAttribute('class','textarea');
					Ext.Css('play_panel').style({
						'text-align' : 'left', 
						'padding-left' : "2px", 
						'padding-top' : "0px",
					});
					Ext.Css('div-voice-container').style({
						"margin-top" : "-10px", "width" : "40%",
						"margin-bottom" : "20px" 
					});
				}	
			});
		}	
	}).post();
 }
 else
	Ext.Msg('Please select a row!').Error();
}


// PlayWav 

Ext.DOM.PlayWav = function() {
	var RecordingId = Ext.Cmp('voice_loger_id').getChecked();
  if((RecordingId!=''))
  {
	Ext.Cmp("voice-list-wait").setText("<img src="+ Ext.DOM.LIBRARY +"/gambar/loading.gif height='10px;'> <span style='color:red;'>Please Wait...</span>");
	Ext.Ajax({
		url 	: Ext.DOM.INDEX +'/VoiceLoger/VoicePlay/',
		method 	: 'GET',
		param 	: { 
			RecordId : RecordingId,
			filetype : 'wav'
		},
		ERROR   : function(e)
		{
			Ext.Cmp("voice-list-wait").setText('<span style="color:silver;">done.</span>');
			Ext.Util(e).proc(function(fn){
				if( fn.success )
				{
					Ext.Media('play_panel', { 
						url 	: Ext.System.view_app_url() +'/temp/'+ fn.data.file_voc_name,
						width 	: '40%',
						height 	: '120px',
						options : {
							ShowControls : 'true',
							ShowStatusBar: 'true',
							ShowDisplay  : 'true',
							autoplay 	 : 'true'
						}
					}).WAVPlayer(); 	
					
					Ext.Tpl("play_panel", fn.data).Compile();
					Ext.Cmp('MediaPlayer').setAttribute('class','textarea');
					Ext.Css('play_panel').style({'text-align' : 'left',  'padding-left' : "8px",  'padding-top' : "20px" });
					Ext.Css('div-voice-container').style({ "margin-top" : "5px", "width" : "40%", "margin-bottom" : "20px"  });
				}	
			});
		}	
	}).post();
 }
 else
	Ext.Msg('Please select a row!').Error();
}

/* memanggil Jquery plug in */

var Download = function()
{
	
	var RecordingId = Ext.Cmp('voice_loger_id').getChecked();
	if( RecordingId !='' )
	{
		Ext.Cmp("voice-list-wait").setText("<img src="+ Ext.DOM.LIBRARY +"/gambar/loading.gif height='10px;'> <span style='color:red;'>Please Wait...</span>");
		Ext.Ajax({
			url 	: Ext.DOM.INDEX +'/VoiceLoger/DownloadVoice/',
			method 	: 'GET',
			param 	: { RecordId : RecordingId },
			ERROR   : function(e)
			{
				Ext.Util(e).proc(function(voice)
				{
					if( voice.success ) 
					{
						Ext.Cmp("voice-list-wait").setText('<span style="color:silver;">done.</span>');
						Ext.Window
						({
							url : Ext.DOM.INDEX +'/VoiceLoger/WgetDownload/',
							width : 10, height:10,
							param :{
								VoiceName : Ext.BASE64.encode(voice.data.file_voc_name)
							}
						}).popup();
					}
				});
			}
		}).post();
	}
}

/* 
 * @ def : play
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
Ext.DOM.StopPlay = function()
{
	Ext.Cmp("QuikTime").each(function(item){
	var file_name_voice = null, voice_data = [];
	for(var i in item){
		if((typeof(item[i].src) =='string')){
			voice_data = item[i].src.split('/');
		}
	}

	 if( voice_data.length > 2 ){
		Ext.Ajax ({
			url 	: Ext.DOM.INDEX +'/VoiceLoger/Deleted/',
			method 	: 'POST',
			param 	: {
				filename : voice_data[voice_data.length-1]
			},
			ERROR : function(e){
				Ext.Util(e).proc(function(Delete){
					if(Delete.success){
						Ext.Cmp('play_panel').setText("");
					}
				});
			}
		  }).post();
	   }
  });
  
	Ext.Cmp("MediaPlayer").each(function(item){
	var file_name_voice = null, voice_data = [];
	for(var i in item){
		if((typeof(item[i].src) =='string')){
			voice_data = item[i].src.split('/');
		}
	}

	 if( voice_data.length > 2 ){
		Ext.Ajax ({
			url 	: Ext.DOM.INDEX +'/VoiceLoger/Deleted/',
			method 	: 'POST',
			param 	: {
				filename : voice_data[voice_data.length-1]
			},
			ERROR : function(e){
				Ext.Util(e).proc(function(Delete){
					if(Delete.success){
						Ext.Cmp('play_panel').setText("");
					}
				});
			}
		  }).post();
	   }
  });
}

</script>

<!-- start : content -->
<fieldset class="corner" style="background-color:#FFFFFF;">
<legend class="icon-customers">&nbsp;&nbsp;<span id="legend_title"></span></legend>	
<div id="span_top_nav">
	
	<div id="result_content_add" class="box-shadow" style="padding-bottom:4px;margin-top:2px;margin-bottom:8px;">
		<form name="frmSearch">
		<table cellpadding="3px;" border=0>
		<tr>
			<td class="text_caption"> Extension</td>
			<td><?php echo form() -> input('agent_ext','input_text long',_get_post('agent_ext')); ?></td>
			<td class="text_caption"> User Agent</td>
			<td><?php echo form() -> combo('agent_id','select long',$combo['AgentId'],_get_post('agent_id')); ?></td>
			
		</tr>
		<tr>
			<td class="text_caption"> User Group</td>
			<td><?php echo form() -> combo('agent_group','select long',$combo['AgentGroup'],_get_post('agent_group')); ?></td>
			<td class="text_caption"> Interval </td>
			<td>
			<?php echo form() -> input('start_time','input_text box',_get_post('start_time')); ?> - 
			<?php echo form() -> input('end_time','input_text box',_get_post('end_time')); ?> </td>
		</tr>
		<tr>
			<td class="text_caption"> Destination </td>
			<td><?php echo form() -> input('b_number','input_text long',_get_post('b_number')); ?></td>
			
		</tr>
		</table>
		</form>
	</div>
	</div>
	
	<div id="toolbars"></div>
	<div id="play_panel"></div>
	<div id="recording_panel" class="box-shadow">
		<div class="content_table" ></div>
		<div id="pager"></div>
	</div>
</fieldset>	