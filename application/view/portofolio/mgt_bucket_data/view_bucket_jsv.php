<script>
// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
Ext.DOM.RoleBack = function(){
	if( Ext.Msg('Are you sure ?').Confirm() ){
		Ext.ShowMenu("MgtBucket", Ext.System.view_file_name());	
	}
}

// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
 Ext.DOM.test = function(val){
	 // alert(val);
	 //Ext.Cmp('recsource').setValue(val);
 }
 
Ext.DOM.Upload = function()
{
	
	// --------------------------------------------------------------	
	Ext.Progress( "ui-widget-image-loading", {
		height  : '17px',  
		title   : 'Please Wait...'
	}).start();
	
	// --------------------------------------------------------------
	Ext.Ajax
	({
		url 	: Ext.EventUrl(["MgtBucket","UploadBucket"]).Apply(), 
		method 	: 'POST',
		param	: {
			CampaignId 	: Ext.Cmp('upload_campaign').getValue(),
			recsource 	: Ext.Cmp('recsource').getValue(),
		},
		complete : function( xhr )  {
			 try   {
				 Ext.Util( xhr ).proc(function( data ) {
					console.log("## DEBUG ##"); console.log( data );
					if( data.success  == 1 ) { 
						var callMsg = null, callRow;
						if( typeof( data.mesages ) == 'object' ) {
							callRow = data.mesages[0];
							callMsg = window.sprintf("\n=================================\nTotal Row : %s\nSuccess : %s\nFailed : %s\nDuplicate : %s\nBlacklist : %s\nExpired : %s\n=================================\n", callRow.R, callRow.Y, callRow.N, callRow.D, callRow.B, callRow.X );	
						} else {
							callMsg = data.mesages;
						}
					    Ext.Msg( callMsg ).Info();	
					}

					if( data.success  == 0 ) {
						Ext.Msg( data.mesages ).Info();
					}

				 });
				 
				 Ext.Progress("ui-widget-image-loading").stop();
			 }
			 
			 // jika terjadi error misal malfunction dari script -nya 
			 // dan akan di keluarkan error stringnya.
			 
			 catch( errUpload ){
				 window.alert( errUpload );
				 Ext.Progress("ui-widget-image-loading").stop();
			 }
		}
	}).upload();
	
 }
 
// ---------------------------------------------------------------------------------------------------------------
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
$(document).ready( function()
{
  var date = new Date();
  $('#ui-widget-uplaod-bucket').mytab().tabs();
  $('#ui-widget-uplaod-bucket').mytab().tabs("option", "selected", 0);
  $('#ui-widget-uplaod-bucket').css({'background-color':'#FFFFFF'});
  $('#ui-widget-upload-content').css({'background-color':'#FFFFFF'});
  $("#ui-widget-uplaod-bucket").mytab().close(function(){ 
		Ext.DOM.RoleBack();
  });
  
  $('.xzselect').chosen();
});

</script>