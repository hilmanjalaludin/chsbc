<script>
/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
Ext.query(function(){
 Ext.query("#tabs-panels" ).tabs();
 Ext.query("#tabs" ).tabs();
 Ext.query('#toolbars').extToolbars
 ({
		extUrl    : Ext.DOM.LIBRARY +'/gambar/icon',
		extTitle  : [['Product Script'],[]],
		extMenu   : [[],[]],
		extIcon   : [['page_white_acrobat.png'],[]],
		extText   : true,
		extInput  : true,
		extOption  : [{
				render : 1,
				type   : 'combo',
				header : null,
				id     : 'v_result_script', 	
				name   : 'v_result_script',
				triger : 'ShowWindowScript',
				width  : 220,
				store  : [Ext.Ajax({url:Ext.DOM.INDEX+'/SetProductScript/getScript/'}).json()]
			}]
	});
});




/* 
 * @ def : UpdatePayer
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
Ext.DOM.UpdateBenefiacery = function()
{
	var param = [];
	Ext.Serialize("frmBenefiecery").procedure(function(items){
		for( var i in items ){
			if( i!= 'BeneficiaryId' ){
				if( !Ext.Cmp(i).getAttribute().NodeValue('class').match(/disabled/g) ) {
					param[i] = items[i];
				}
			}
		}
	});
	
	// update Beneficiary data 
	
	param['BeneficiaryId'] = Ext.Cmp('BeneficiaryId').getChecked();
	if(Ext.Cmp('BeneficiaryId').getChecked().length > 0 ) {
		Ext.Ajax
		({  
			url 	: Ext.DOM.INDEX +"/QtyApprovalInterest/UpdateBenefiacery/", 
			method 	: 'POST',
			param 	: Ext.Join([param]).object() 
		}).json();
	}	
}
	
 
/* 
 * @ def : UpdatePayer
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
Ext.DOM.UpdatePayer =function () {
	var param = [];
	Ext.Serialize("frmPayer").procedure(function(items){
		for( var i in items ){
			if( !Ext.Cmp(i).getAttribute().NodeValue('class').match(/disabled/g) ) {
				param[i] = items[i];
			}
		}
	});
	
	// update payer data 
	
	param['CustomerId'] = Ext.Cmp('CustomerId').getValue();
	if( !Ext.Cmp('CustomerId').empty() )
	{
		Ext.Ajax
		({ 
			url 	: Ext.DOM.INDEX +"/QtyApprovalInterest/UpdatePayer/",
			method 	: 'POST',
			param 	: Ext.Join([param]).object(),
			ERROR 	: function(e){
				Ext.Util(e).proc(function(response){
					if(response.success){
						Ext.Msg("update Payer").Success();
					}
					else{
						Ext.Msg("update Payer").Failed();
					}
				});
			}
		}).post();
	}	
}

/* 
 * @ def : UpdateInsured
 * ------------------------------------------
 
 * @ param : no define
 * @ aksess : procedure  
 */
 
Ext.DOM.UpdateInsured =function () {
	var param = [];
	Ext.Serialize("InsuredDetailForm").procedure(function(items){
		for( var i in items ){
			if( !Ext.Cmp(i).getAttribute().NodeValue('class').match(/disabled/g) ) {
				param[i] = items[i];
			}
		}
	});
	
	// update payer data 
	
	param['InsuredId'] = Ext.Cmp('InsuredId').getValue();
	if( !Ext.Cmp('InsuredId').empty() )
	{
		Ext.Ajax
		({ 
			url 	: Ext.DOM.INDEX +"/QtyApprovalInterest/UpdateInsured/",
			method 	: 'POST',
			param 	: Ext.Join([param]).object(),
			ERROR 	: function(e){
				Ext.Util(e).proc(function(response){
					if(response.success){
						Ext.DOM.UpdateBenefiacery();
						Ext.Msg("update Insured").Success();
					}
					else{
						Ext.Msg("update Insured").Failed();
					}
				});
			}
		}).post();
	}	
}


/* 
 * @ def : PlayByCallSession
 * ------------------------------------------
 *
 * @ param :  - 
 * @ aksess : -   
 */
 
Ext.DOM.PlayByCallSession = function(SessionId) 
{
	$('#tabs').tabs( "option", "selected", 2 );
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX+"/QtyApprovalInterest/PlayBySessionId/",
		method 	: 'GET',
		param  	: { RecordId : SessionId },
		ERROR 	: function(e){
			Ext.Util(e).proc(function(fn){
				if(fn.success) {
					Ext.Media("tabs-3",{ 
						url 	: Ext.System.view_app_url() +'/temp/'+ fn.data.file_voc_name,
						width 	: '50%',
						height 	: '30%',
						options : {
							ShowControls 	: 'true',
							ShowStatusBar 	: 'true',
							ShowDisplay 	: 'true',
							autoplay 		: 'true'
						}
					}).WAVPlayer();
						
					Ext.Tpl("play_panel", fn.data).Compile();
					Ext.Cmp('MediaPlayer').setAttribute('class','textarea');
					Ext.Css('play_panel').style({'text-align' : 'left',  'padding-left' : "8px",  'padding-top' : "20px" });
					Ext.Css('div-voice-container').style({ "margin-top" : "5px", "width" : "40%", "margin-bottom" : "20px"  });
				}
			})
		}
	}).post();
}



/* 
 * @ def : ShowWindowScript
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */

Ext.DOM.PlayRecording = function(check) {

var chk = Ext.Cmp('recordId').getName();
if( check.checked ) {
  for(var c in chk ) {
	if( chk[c].checked) {
		if( chk[c].value!=check.value )  chk[c].checked = false;
		else 
		{
			$('#tabs').tabs( "option", "selected", 2 );
			Ext.Ajax
			({
				url 	: Ext.DOM.INDEX+"/QtyApprovalInterest/VoicePlay/",
				method 	: 'GET',
				param  	: { RecordId : check.value },
				ERROR 	: function(e){
					Ext.Util(e).proc(function(fn){
					
						if( fn.success ) 
						{
							Ext.Media("tabs-3",{ 
								url 	: Ext.System.view_app_url() +'/temp/'+ fn.data.file_voc_name,
								width 	: '50%',
								height 	: '30%',
								options : {
									ShowControls 	: 'true',
									ShowStatusBar 	: 'true',
									ShowDisplay 	: 'true',
									autoplay 		: 'true'
								}
							}).WAVPlayer();
							
							Ext.Tpl("tabs-3", fn.data).Compile();
							
							Ext.Tpl("play_panel", fn.data).Compile();
							Ext.Cmp('MediaPlayer').setAttribute('class','textarea');
							Ext.Css('play_panel').style({'text-align' : 'left',  'padding-left' : "8px",  'padding-top' : "20px" });
							Ext.Css('div-voice-container').style({ "margin-top" : "5px", "width" : "40%", "margin-bottom" : "20px"  });
						}	
					});	
					
				}
			}).post();
		}
	}
}}}

/* 
 * @ def : ShowWindowScript
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */

Ext.DOM.ShowWindowScript = function(ScriptId)
{
	var WindowScript = new Ext.Window ({
			url    : Ext.DOM.INDEX +'/SetProductScript/ShowProductScript/',
			name    : 'WinProduct',
			height  : (Ext.Layout(window).Height()),
			width   : (Ext.Layout(window).Width()),
			left    : (Ext.Layout(window).Width()/2),
			top	    : (Ext.Layout(window).Height()/2),
			param   : {
				ScriptId : Ext.BASE64.encode(ScriptId),
				Time	 : Ext.Date().getDuration()
			}
		}).popup();
		
	if( ScriptId =='' ) {
		window.close();
	}
}


/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
Ext.DOM.CancelActivity =function()
 {
	ControllerId = Ext.Cmp("ControllerId").getValue();
	Ext.EQuery.Ajax ({
		url 	: ControllerId,
		method 	: 'GET',
		param 	: { act : 'back-to-list' }
	});
 }
 
/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 

Ext.DOM.SaveQualityActivity =function() 
{

var totals = 0, _Quality = Ext.Serialize('frmScoring').getElement();

	for( var key in  _Quality ) {
		if( _Quality[key]=='' ) 
			totals+=1;
	}	
	

if(totals){
	Ext.Msg("Input Not Complete").Info();


	Ext.query('#tabs-panels').tabs( "option", "selected", 5 ); }
 else
 {
	var param = [];

		param['CustomerId'] = Ext.Cmp('CustomerId').getValue();	

		alert(param['CustomerId']);
	Ext.Ajax ({
		url 	: Ext.DOM.INDEX+'/QtyScoring/SaveScoreQuality/',
		method 	: 'POST',
		param	: Ext.Join([Ext.Serialize('frmScoring').getElement(), param, _collection ]).object(),
				
		ERROR	: function(e){
			Ext.Util(e).proc(function(save){
				if(save.success) { 
					Ext.Msg("Save Scoring").Success();
					Ext.DOM.CallHistory(); 
				}
				else{
					Ext.Msg("Save Scoring").Failed();
				}
			});
		}	
	}).post();
} }
 /* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
Ext.DOM.CallHistory = function(){
	Ext.Ajax({
		url 	: Ext.DOM.INDEX+"/QtyApprovalInterest/CallHistory/",
		method 	: 'GET',
		param 	: {
			CustomerId : Ext.Cmp('CustomerId').getValue()
		} }).load("tabs-1");
} 

/* @ def : onload listener 
 * -----------------------------
 *
 * @ param  : public Window
 * @ aksess : public test  
 */
 
Ext.DOM.SelectPages = function(select){
	Ext.Ajax ({
		url : Ext.DOM.INDEX +'/QtyApprovalInterest/Recording/',
		method : 'GET',
		param : { 
			CustomerId : Ext.Cmp('CustomerId').getValue(), 
			Pages: select.id,
			time : Ext.Date().getDuration()	
		}
	}).load('tabs-2');
}


 /* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
Ext.document(document).ready(function(){
 $('#CustomerDOB').datepicker({ 
  dateFormat : 'yy-mm-dd', 
  changeYear : true, 
  changeMonth : true 
 });
 
/* @ def : onload listener 
 * -----------------------------
 *
 * @ param  : public Window
 * @ aksess : public test  
 */
  Ext.DOM.CallHistory();
  Ext.DOM.SelectPages({'id':0});
  
});
  
  Ext.DOM.ProdPreview = function( ProductId ){
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX+"/ModSaveActivity/ProdPreview/",
		method 	: 'GET',
		param 	: {
			CustomerId 	 : Ext.Cmp('CustomerId').getValue(),
			ProductId 	 : ( ProductId ? ProductId : Ext.Cmp('ProductId').getValue()),
			CustomerDOB	 : Ext.Cmp('PayerDOB').getValue(),
			GenderId	 : Ext.Cmp('PayerGenderId').getValue()
		}
	}).load("product_list_preview");
}
  
/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
Ext.DOM.AjaxStart = function(){
		Ext.Cmp("tabs-7").setText("<img src="+ Ext.DOM.LIBRARY +"/gambar/loading.gif height='17px;'>"+
		"<span style='color:red;'>&nbsp;&nbsp;Please Wait...</span>");
  }
  
/* 
 * @ def : toolbars on navigation 
 * ------------------------------------------
 *
 * @ param : no define
 * @ aksess : procedure  
 */
 
Ext.DOM.DetailInsuredForm = function(checkbox){
	if(checkbox.checked) 
	{
		$('#tabs-panels').tabs( "option", "selected", 3 );
		Ext.DOM.AjaxStart();
		Ext.Ajax({
			url 	: Ext.DOM.INDEX +'/QtyApprovalInterest/DetailInsured/',
			mthod 	: 'GET',
			param 	: {
				InsuredId : checkbox.value
			}
		}).load("tabs-7");
	}
	else {
		Ext.Cmp('tabs-7').setText('');
	}
}

</script>