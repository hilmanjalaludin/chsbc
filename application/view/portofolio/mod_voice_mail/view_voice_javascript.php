<?php ?>

<script>

/* extends of properties method **/

(function(e){
	e.prototype.Basename = function( path ) {
		if( path!==undefined ){
			return path.split('/').reverse()[0];
		}
	}
})(E_ui);
 
/**
 * @ def 	: play recording by click handle on front 
 *  -----------------------------------------------------
  
 * @ param  : -
 * @ param  : - 
 * 
 */
 
Ext.DOM.AutoPlay  = function() {
Ext.Ajax 
({
	url 	: Ext.DOM.INDEX +'/VoiceMail/VoiceMailPlay/',
	method 	: 'GET',
	param 	: { 
		RecordId : Ext.Cmp('VoiceMailId').getValue(),
		filetype : 'wav'
	},
		
	ERROR   : function(e) {
		Ext.Util(e).proc(function(fn){
			if( fn.success ) {
				Ext.Media('play_voice_mail', { 
					url 	: Ext.System.view_app_url() +'/temp/'+ fn.data.file_voc_name,
					width 	: '99%',
					height 	: '75px',
					options : {
						ShowControls : 'false',
						ShowStatusBar: 'false',
						ShowDisplay  : 'false',
						autostart 	 : 'true'
					} 
				}).WAVPlayer(); 	
				
				Ext.DOM.RemoveWav(); // then deleted from TMP 
			}	
		});
	}	
}).post();


}

/**
 * @ def 	: play recording by click handle on front 
 *  -----------------------------------------------------
  
 * @ param  : -
 * @ param  : - 
 * 
 */
 
 Ext.DOM.RemoveWav = function()
 {
	var file_name_wav = '';
	
		Ext.Cmp("MediaPlayer").each(function(item){
		  for(var i in item)
		  {
				file_name_wav = Ext.Basename(item[i].src);
				if( file_name_wav!='' )
				{
					break;
				}
		   }
		});
	
	if( file_name_wav!='' || file_name_wav!=='undefined')
	{
		return ( Ext.Ajax ({
			url 	: Ext.DOM.INDEX +'/VoiceMail/RemoveWav/',
			method 	: 'POST',
			param 	: { 
				filename : file_name_wav
			}
		}).json() );
	}		
	else
		return 0;
 }

/**
 * @ def 	: play recording by click handle on front 
 *  -----------------------------------------------------
  
 * @ param  : -
 * @ param  : - 
 * 
 */
 
Ext.document().ready(function(){ 
 Ext.DOM.AutoPlay();
 
 
 
/* handle close button ***/
 
 Ext.Cmp('ButtonClose').listener
 ({
	onClick : function(e){
		Ext.DOM.RemoveWav();
		Ext.EQuery.Ajax
		({
			url 	: Ext.DOM.INDEX +'/VoiceMail/index/',
			param 	: {
			
			}
		});
	}
 });
 
Ext.Cmp("ButtonSave").listener({ onClick : function(){

var param_elements = [];
	param_elements['VoiceMailId'] = Ext.Cmp('VoiceMailId').getValue();
	
	//var conds = 
	Ext.Ajax 
	({
		url 	: Ext.DOM.INDEX +"/VoiceMail/SaveVoiceMail/",
		method 	:'POST',
		param 	: Ext.Join([
						Ext.Serialize('frmCustomerData').getElement(),
						Ext.Serialize('frmActivityData').getElement(), 
						param_elements
					]).object(),
					
		ERROR : function(e) {
			Ext.Util(e).proc(function(response){
				if( response.success ){
					Ext.Msg("Save Data").Success();
				}
				else{
					Ext.Msg("Save Data").Failed();
				}
			});	
		}	
	}).post()
  }		
});

});

</script>