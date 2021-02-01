<?php 
echo javascript(array( 
	array('_file' => base_spl_plugin() .'/extToolbars.js', 'eui_'=> version(), 'time'=>time()),
	array('_file' => base_spl_plugin() .'/Paging.js', 'eui_'=> version(), 'time'=>time()),
	array('_file' => base_ext_helper() .'/EUI.Media.js', 'eui_'=> version(), 'time'=>time())
));

?>

<script type="text/javascript">
/* create object **/

var KEY_ENTER = 13;
var Reason = [];

Ext.document('document').ready( function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 }); 

 
Ext.EQuery.TotalPage   = '<?php echo $page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';

/* catch of requeet accep browser **/

Ext.DOM.datas = {
	voice_call_result 	: '<?php echo _get_exist_session('voice_call_result');?>',
	voice_campaign_id 	: '<?php echo _get_exist_session('voice_campaign_id');?>',
	voice_cust_name 	: '<?php echo _get_exist_session('voice_cust_name');?>',
	voice_cust_number 	: '<?php echo _get_exist_session('voice_cust_number');?>',
	voice_destination 	: '<?php echo _get_exist_session('voice_destination');?>',
	voice_end_date 		: '<?php echo _get_exist_session('voice_end_date');?>',
	voice_start_date 	: '<?php echo _get_exist_session('voice_start_date');?>',
	voice_user_id 		: '<?php echo _get_exist_session('voice_user_id');?>',
	voice_start_dur     : '<?php echo _get_exist_session('voice_start_dur');?>',
	voice_end_dur       : '<?php echo _get_exist_session('voice_end_dur');?>',
	order_by 			: '<?php echo _get_exist_session('order_by');?>',
	type	 			: '<?php echo _get_exist_session('type');?>'
}
			
/* assign navigation filter **/

Ext.DOM.navigation = {
	custnav : Ext.DOM.INDEX +'/ModVoiceData/index/',
	custlist : Ext.DOM.INDEX +'/ModVoiceData/Content/'
}
		
/* assign show list content **/
		
Ext.EQuery.construct( Ext.DOM.navigation, Ext.DOM.datas)
Ext.EQuery.postContentList();

/* function searching customers **/
	
Ext.DOM.searchCustomer = function()
{
	Ext.EQuery.construct(Ext.DOM.navigation,Ext.Join([
		Ext.Serialize('frmVoiceSearch').getElement()
	]).object() );
	Ext.EQuery.postContent();
}

// simple clear under form document

 Ext.DOM.Clear = function()
{
	Ext.Serialize('frmVoiceSearch').Clear();
	Ext.DOM.searchCustomer();	
}


/* 
 * @ def : play recording via window open 
 * ------------------------------------------
 *
 * @ author : omens 
 * @ create : 20140930
 * @ param : no define
 * @ aksess : procedure  
 */
 
Ext.DOM.NewWindowMediaPlayer = function()
{
var RecordingId = Ext.Cmp('chk_record_call').getValue();
	Ext.Window
	({
		url   : Ext.DOM.INDEX +'/ModVoiceData/NewPlayWindow/',
		width : 600, height :400,
		param : {
			RecordId : RecordingId
		}
	}).popup();
}


/* 
 * @ def : play
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
 Ext.DOM.Play = function() 
{
	var WinUrl  = new Ext.EventUrl([ "QtyApprovalInterest",  "VoicePlay"]), WinHeight = 100, 
		RecordId = Ext.Cmp('RecordId').getValue();
		
	var WinPlay = new Ext.Window
	({
		url    : WinUrl.Apply(),
		name   : 'winplay',
		top    : 0,
		left   : $(window).width(),  
		width  : ($(window).width()/2),
		height : (($(window).height()/2) - WinHeight),
		param  :  {
			RecordId : RecordId
		} 
	});
	
	WinPlay.popup();
}


/* memanggil Jquery plug in */
var Download = function() {
  var RecordId = Ext.Cmp('RecordId').getValue();
  if( RecordId !='' )
  {
		Ext.Ajax
		({
			url 	: Ext.EventUrl(['ModVoiceData','DownloadVoice']).Apply(),
			method 	: 'GET',
			param 	: { RecordId : RecordId },
			ERROR   : function(e)
			{
				Ext.Util(e).proc(function(voice)
				{
					if( voice.success ) 
					{
						Ext.Window
						({
							url 	: Ext.EventUrl(['ModVoiceData','WgetDownload']).Apply(), 
							width 	: 10, 
							height	: 10,
							param 	: {
								VoiceName : Ext.BASE64.encode(voice.data.file_voc_name)
							}
						}).popup();
					} else{
						Ext.Msg("Sorry . File Not Found.").Info();
					}
				});
			}
		}).post();
	}
}

var DownloadGsm = function() {
  var RecordId = Ext.Cmp('RecordId').getValue();
  if( RecordId !='' )
  {
		Ext.Ajax
		({
			url 	: Ext.EventUrl(['ModVoiceData','DownloadVoice']).Apply(),
			method 	: 'GET',
			param 	: { RecordId : RecordId },
			ERROR   : function(e)
			{
				Ext.Util(e).proc(function(voice)
				{
					if( voice.success ) 
					{
						Ext.Window
						({
							url 	: Ext.EventUrl(['ModVoiceData','WgetDownload']).Apply(), 
							width 	: 10, 
							height	: 10,
							param 	: {
								VoiceName : Ext.BASE64.encode(voice.data.file_voc_name)
							}
						}).popup();
					} else{
						Ext.Msg("Sorry . File Not Found.").Info();
					}
				});
			}
		}).post();
	}
}

var DownloadGsm = function() {
  	var RecordId = Ext.Cmp('RecordId').getValue();
  	if( RecordId !='' )
  	{
		Ext.Ajax({
			url 	: Ext.EventUrl(['ModVoiceData','DownloadVoiceGsm']).Apply(),
			method 	: 'GET',
			param 	: { RecordId : RecordId },
			ERROR   : function(e)
			{
				Ext.Util(e).proc(function(voice)
				{
					if( voice.success ) {
						Ext.Window({
							url 	: Ext.EventUrl(['ModVoiceData','WgetDownloadGsm']).Apply(), 
							width 	: 10, 
							height	: 10,
							param 	: {
								VoiceName : Ext.BASE64.encode(voice.data.file_voc_name)
							}
						}).popup();
					} else {
						Ext.Msg("Sorry . File Not Found.").Info();
					}
				});
			}
		}).post();
	}
}
 
$(function(){
	
 var arr_aksess = new Array( window.LEVEL.USER_ROOT, window.LEVEL.USER_UPLOADER);
 var arr_handling = Ext.Session('HandlingType').getSession();

 var on_handling = ['1','2','8','5'];
 var title = ""; menu=""; icon="";
 if( on_handling.indexOf(arr_handling) >= 0 ) {
 	// alert( on_handling.indexOf(arr_handling) );
 	var title = "Download GSM"; menu="DownloadGsm"; icon="page_save.png";
 }
 
 var obj_ext_toolbars = {
	title  : [['Search'],['Clear'],['Play'],['Download'],[title]],
	menu   : [['searchCustomer'],['Clear'],['Play'],['Download'],[menu]],
	icon   : [['zoom.png'], ['cancel.png'],['control_play_blue.png'],['page_save.png'],[icon]],
	option : [{
			render : 4,
			type   : 'label',
			id     : 'voice-list-wait', 	
			name   : 'voice-list-wait',
			label  : '<span style="color:#dddddd;">-</span>'
		}]
 }
 console.log(arr_aksess);
 console.log($.inArray(parseInt(arr_handling), arr_aksess));
 console.log(parseInt(arr_handling));
 
  /* if( $.inArray(parseInt(arr_handling), arr_aksess) < 0 ) 
 {
	obj_ext_toolbars = {
		title  : [['Search'],['Clear'],['Play'],[]],
		menu   : [['searchCustomer'],['Clear'],['Play'],[]],
		icon   : [['zoom.png'], ['cancel.png'],['control_play_blue.png'],[]],
		option : [{
				render : 3,
				type   : 'label',
				id     : 'voice-list-wait', 	
				name   : 'voice-list-wait',
				label  : '<span style="color:#dddddd;">-</span>'
			}]
	}
  } */
  
	$('#toolbars').extToolbars
	({
		extUrl    : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle  : obj_ext_toolbars.title,
		extMenu   : obj_ext_toolbars.menu,
		extIcon   : obj_ext_toolbars.icon,
		extText   : true,
		extInput  : true,
		extOption : obj_ext_toolbars.option
	});
	
	$('.date').datepicker({ 
		showOn: 'button',  buttonImage: Ext.DOM.LIBRARY+'/gambar/calendar.gif',  buttonImageOnly: true, 
		dateFormat:'dd-mm-yy', readonly:true, changeYear:true, changeMonth:true });
	$('.select').chosen();	
});


</script>

<fieldset class="corner">
<?php echo form()->legend(lang(""), "fa-user"); ?>
 <div id="result_content_add" class="ui-widget-panel-form"> 
	<form name="frmVoiceSearch">
		<div class="ui-widget-form-table-compact">
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Customer','ID'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left"><?php echo form()->input('voice_cust_number','input_text long',_get_exist_session('voice_cust_number')); ?></div>
				
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Campaign Name'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left"><?php echo form()->combo('voice_campaign_id','select superlong',CampaignId(),_get_exist_session('voice_campaign_id')); ?></div>
				
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Agent Id'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left"><?php echo form()->combo('voice_user_id','select superlong',$UserId,_get_exist_session('voice_user_id')); ?></div>
			</div>
			
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Customer Name'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left"><?php echo form()->input('voice_cust_name','input_text long',_get_exist_session('voice_cust_name')); ?></div>
				
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Call Result'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left"><?php echo form()->combo('voice_call_result','select superlong',CallResult(),_get_exist_session('voice_call_result')); ?></div>
				
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Destination'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left"><?php echo form()->input('voice_destination','input_text superlong',_get_exist_session('voice_destination')); ?></div>
			</div>
			
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Call Date'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<?php echo form()->input('voice_start_date','input_text date',_get_exist_session('voice_start_date')); ?> <?php echo lang(array('to'))?>
					<?php echo form()->input('voice_end_date','input_text date',_get_exist_session('voice_end_date')); ?> 
				</div>
				
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Duration(s)'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<?php echo form()->input('voice_start_dur','input_text box',_get_exist_session('voice_start_dur')); ?> <?php echo lang(array('to'))?>
					<?php echo form()->input('voice_end_dur','input_text box',_get_exist_session('voice_end_dur')); ?> 
				</div>
				
			</div>
			
		</div>
	</form>
 </div>

<div class="ui-widget-toolbars" id="toolbars"></div>
<div class="ui-widget-panel-content" id="#panel-content"></div>
<div class="content_table" id="ui-widget-content_table"></div>
<div class="ui-widget-pager" id="pager"></div>
<div class="ui-widget-component" id="ui-widget-component"></div>

</fieldset>	