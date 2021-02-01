/*
 * @ def : Meadia Player plugin 
 * -------------------------------------------
 *
 * @ param  : onject data 
 * @ type   : helpers 
 * @ author : razaki team 
 */
 
// --------------------------------------------------------------------------------
 
 function Masking( filename ){
	var $objective =  filename.length;
	var $ArrObject = new Array();
	for( var $i = 0 ; $i < $objective;  $i++ ){
		$ArrObject[$i] = "x";
	}	
	
	return $ArrObject.join('');
 }
 
// -------------------------------------------------------------------------------- 

 function SetMasking( filename )
{
 this.arr_masking_data = filename;
 var arr_aksess = new Array( window.opener.LEVEL.USER_ROOT, window.opener.LEVEL.USER_UPLOADER);
 var arr_handling = window.opener.Ext.Session('HandlingType').getSession();
 
 var arr_result = {};	
 var arr_split = filename.split("_");
 
 if( typeof(arr_split) == 'object' ){
	 if( $.inArray(parseInt(arr_handling), arr_aksess) < 0 ) 
	{
		CallerId = Masking(arr_split[2]);
		arr_result[arr_split[0]] = 	arr_split[0];
		arr_result[arr_split[1]] = 	arr_split[1];
		arr_result[CallerId] = CallerId;
		arr_result[arr_split[3]] = 	arr_split[3];
		
		this.arr_masking_data = Object.keys(arr_result).join("_");
	}	
 }
 
 
 return this.arr_masking_data;
 
} 

 
;(function(UI, Ext){

// ui player object libs
	UI.prototype.EUIPlayer = function( arg, fn ){
		var _player = [];
		
		// WMP < Windows Media Player > 
		
		_player['WMP'] =  {
				name : 'OBJECT',
				attr : {
					ID 		: 'MediaPlayer',
					WIDTH	: '350',
					HEIGHT	: '69',
					CLASSID : 'CLSID:22D6F312-B0F6-11D0-94AB-0080C74C7E95',
					STANDBY	: 'Loading Windows Media Player components...',
					TYPE	: 'application/x-oleobject',
					param 	: [	
								{name : 'FileName', value  : ( fn.url ? fn.url : '') },
								{name : 'ShowControls', value : 'true' },
								{name : 'ShowStatusBar', value : 'true' },
								{name : 'ShowDisplay', value : 'true' }
							 ],
					embed : {
							TYPE : 'application/x-mplayer2', 
							SRC  : ( fn.url ? fn.url : ''),
							NAME : 'MediaPlayer', 
							WIDTH : ( fn.width ? fn.width : 300),
							HEIGHT : ( fn.height ? fn.height : 100),
							ShowControls : ( fn.options.ShowControls ? fn.options.ShowControls : 1 ),
							ShowStatusBar : ( fn.options.ShowStatusBar ? fn.options.ShowStatusBar : 0 ),
							ShowDisplay : ( fn.options.ShowDisplay ? fn.options.ShowDisplay : 0 ),
							autostart : ( fn.options.autostart ? fn.options.autostart : 1 )
					}
				}
			};
			
		// MP 3 < Multimedia Player 3 > 	
		
		_player['MP3'] =  {
				name : 'OBJECT',
				attr : {
					ID 		: 'MediaPlayer',
					WIDTH	: '350',
					HEIGHT	: '69',
					CLASSID : 'CLSID:22D6F312-B0F6-11D0-94AB-0080C74C7E95',
					STANDBY	: 'Loading Windows Media Player components...',
					TYPE	: 'application/x-oleobject',
					param 	: [	
								{name : 'FileName', value  : ( fn.url ? fn.url : '') },
								{name : 'ShowControls', value : 'true' },
								{name : 'ShowStatusBar', value : 'true' },
								{name : 'ShowDisplay', value : 'true' }
							 ],
					embed : {
							TYPE : 'application/x-mplayer2', 
							SRC  : ( fn.url ? fn.url : ''),
							NAME : 'MediaPlayer', 
							WIDTH : ( fn.width ? fn.width : 300),
							HEIGHT : ( fn.height ? fn.height : 100),
							ShowControls : ( fn.options.ShowControls ? fn.options.ShowControls : 1 ),
							ShowStatusBar : ( fn.options.ShowStatusBar ? fn.options.ShowStatusBar : 0 ),
							ShowDisplay : ( fn.options.ShowDisplay ? fn.options.ShowDisplay : 0 ),
							autostart : ( fn.options.autostart ? fn.options.autostart : 1 )
					}
				}
			};	
			
		_player['GSM'] =  {
				name : 'object',
				attr : {
					ID 		: 'QuikTime',
					WIDTH	: '350',
					HEIGHT	: '69',
					CLASSID : 'clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B',
					STANDBY	: 'Quick Time player...',
					TYPE	: 'audio/x-gsm',
					param 	: [	
								{name : 'FileName', value  : ( fn.url ? fn.url : '') },
								{name : 'ShowControls', value : ( fn.options.ShowControls ? fn.options.ShowControls :'true' ) },
								{name : 'ShowStatusBar', value : ( fn.options.ShowStatusBar ? fn.options.ShowStatusBar : '' ) },
								{name : 'ShowDisplay', value : ( fn.options.ShowDisplay ? fn.options.ShowDisplay : 'true') },
								{name : 'autoplay', value : ( fn.url ? fn.options.autoplay : 'true') }
							 ],
					embed : {
							TYPE : 'audio/x-gsm', 
							SRC  : ( fn.url ? fn.url : ''),
							NAME : 'QuickTime', 
							WIDTH : ( fn.width ? fn.width : 300),
							HEIGHT : ( fn.height ? fn.height : 100),
							ShowControls : ( fn.options.ShowControls ? fn.options.ShowControls : 1 ),
							ShowStatusBar : ( fn.options.ShowStatusBar ? fn.options.ShowStatusBar : 0 ),
							ShowDisplay : ( fn.options.ShowDisplay ? fn.options.ShowDisplay : 0 ),
							autoplay : ( fn.options.autoplay ? fn.options.autoplay : 1 )
					}
				}
			};		
		
		return ( typeof(_player[arg])=='object' ? 
				_player[arg] : null );
		
	},
	
	// media data 
	
	UI.prototype.Media = function( arg , fn ){
		var SWF = {
			WAVPlayer : function(){
				var WMP = Ext.EUIPlayer('WMP',fn );
				var WMPObject = Ext.Create(WMP.name ).element();
				
				if( typeof(WMP.attr)=='object'){
					for( var e in WMP.attr ){
						if( typeof(WMP.attr[e]) != 'object' )
							WMPObject.setAttribute(e, WMP.attr[e]);
						else
						{
							var params = WMP.attr[e];
							if( e == 'param'){
								if( typeof(params) =='object' ){
									var _SWFParams = [];
									for( var p in params ) {
										_SWFParams[p] = Ext.Create('param').element();
										if( typeof(params[p])=='object' ){
											_SWFParams[p].setAttribute(params[p].name, params[p].value);
										}
										
										WMPObject.appendChild((_SWFParams[p] != 'undefined' ? _SWFParams[p] : '' ));
									}
								}
							}
							if((e=='embed')){
								var SWFembed = Ext.Create('embed').element(),
									OBJembed = WMP.attr[e];
									if( typeof(OBJembed) =='object' ) {
										for( var b in OBJembed )
											SWFembed.setAttribute(b,OBJembed[b]);
									}
								WMPObject.appendChild( (SWFembed != 'undefined' ? SWFembed : '' ));	
							}
							
						}
					}
				}
				
				Ext.Cmp(arg).setText('');
				Ext.Cmp(arg).getElementId().appendChild(WMPObject);
			},
			
			//  GSM 
			
			GSMPlayer : function(){
				var GSM = Ext.EUIPlayer('GSM',fn );
				var GSMObject = Ext.Create(GSM.name ).element();
				
				if( typeof(GSM.attr)=='object'){
					for( var e in GSM.attr ){
						if( typeof(GSM.attr[e]) != 'object' )
							GSMObject.setAttribute(e, GSM.attr[e]);
						else
						{
							var params = GSM.attr[e];
							if( e == 'param'){
								if( typeof(params) =='object' ){
									var _SWFParams = [];
									for( var p in params ) {
										_SWFParams[p] = Ext.Create('param').element();
										if( typeof(params[p])=='object' ){
											_SWFParams[p].setAttribute(params[p].name, params[p].value);
										}
										
										GSMObject.appendChild((_SWFParams[p] != 'undefined' ? _SWFParams[p] : '' ));
									}
								}
							}
							if((e=='embed')){
								var SWFembed = Ext.Create('embed').element(),
									OBJembed = GSM.attr[e];
									if( typeof(OBJembed) =='object' ) {
										for( var b in OBJembed )
											SWFembed.setAttribute(b,OBJembed[b]);
									}
								GSMObject.appendChild( (SWFembed != 'undefined' ? SWFembed : '' ));	
							}
							
						}
					}
				}
				
				Ext.Cmp(arg).setText('');
				Ext.Cmp(arg).getElementId().appendChild(GSMObject);
			}
		}
		
		return ( typeof(SWF)=='object' ? 
			SWF : null );
	},
	
	UI.prototype.Tpl = function(container, voice){
		var eval = {
			Compile : function(){
				var Tmp = Ext.Create("div").element();
					Tmp.setAttribute("id","div-voice-container");
					Tmp.innerHTML = "<div class='box-shadow' style='margin-top:12px;z-index:99999;clear:both;'>"+
						"<table width='100%'>"+
						"<tr>"+
							"<td class='text_caption' width='12%'>Call Date</td>"+ 
							"<td class='center' width='2%'>:</td>"+
							"<td class='input_text long left'>"+(typeof(voice)=='object' ? voice.start_time:'')+"</td>"+
						"</tr>"+
						"<tr>"+
							"<td class='text_caption' width='12%'>File Name</td>"+ 
							"<td class='center' width='2%'>:</td>"+
							"<td class='input_text long left'>"+(typeof(voice)=='object' ? SetMasking( voice.file_voc_name ):'')+"</td>"+
						"</tr>"+
						"<tr>"+
							"<td class='text_caption' width='12%'>File Size </td>"+ 
							"<td class='center' width='2%'>:</td>"+
							"<td class='input_text long left'>"+(typeof(voice)=='object' ? voice.file_voc_size:'')+"</td>"+
						"</tr>"+
						"<tr>"+
							"<td class='text_caption' width='12%'>Duration </td>"+ 
							"<td class='center' width='2%'>:</td>"+
							"<td class='input_text long left'>"+(typeof(voice)=='object' ? voice.duration:'')+"</td>"+
						"</tr></table></div>";
											
				if( typeof(Tmp) =='object'){							
					Ext.Cmp(container).getElementId().appendChild(Tmp);
				}
			} 
		}
		
		return (typeof(eval)=='object' ?
				eval : null );
	}
})(E_ui, Ext);


