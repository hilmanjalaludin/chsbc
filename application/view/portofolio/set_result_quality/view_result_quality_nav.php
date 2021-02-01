<?php echo javascript(); ?>
<script type="text/javascript">

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.onload = (function(){
	Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
 })();
 
//param data

var datas = {
	keywords : '<?php echo _get_post('keywords');?>',
	order_by : '<?php echo _get_post('order_by');?>',
	type 	 : '<?php echo _get_post('type');?>'
}

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
$(function(){
	$('#toolbars').extToolbars({
		extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle :[['Enable'],['Disable'] ,['Add'],['Edit'],['Delete'],['Cancel'],[],['Search']],
		extMenu  :[['EnableQuality'],['DisableQuality'],['AddQuality'],['EditQuality'],['DeleteQuality'],['CancelQuality'],[],['SearchQuality']],
		extIcon  :[['accept.png'],['cancel.png'], ['add.png'],['calendar_edit.png'],['delete.png'],['cancel.png'],[],['zoom.png']],
		extText  :true,
		extInput :true,
		extOption: [{
						render	:6,
						type	:'text',
						id		:'QualityResult', 	
						name	:'QualityResult',
						value	: datas.keywords,
						width	:200
					}]
			});
			
		});
		
 Ext.EQuery.TotalPage   = <?php echo (INT)$page -> _get_total_page(); ?>;
 Ext.EQuery.TotalRecord = <?php echo (INT)$page -> _get_total_record(); ?>;

		
/* assign navigation filter **/
		
var navigation = {
	custnav : Ext.DOM.INDEX +'/SetResultQuality/index/',
	custlist :Ext.DOM.INDEX +'/SetResultQuality/Content/'
}
		
/* assign show list content **/
		
Ext.EQuery.construct(navigation,datas);
Ext.EQuery.postContentList();
		

/* assign show list content **/
		
Ext.DOM.SearchQuality = function(){
	Ext.EQuery.construct(navigation,{
		keywords : Ext.Cmp("QualityResult").getValue()
	});
	Ext.EQuery.postContent();
}		

/* assign show list content **/

Ext.DOM.CancelQuality=function() {
	Ext.Cmp('span_top_nav').setText('');
}

/* assign show list content **/
// assign show list content

Ext.DOM.AddQuality = function(){
	Ext.Ajax
	({
		url  : Ext.DOM.INDEX +'/SetResultQuality/AddView/',
		method : 'GET',
		param : {
			duration : Ext.Date().getDuration()
		}
	}).load('span_top_nav');
}

//** edit category ****/	

var EditQuality = function()
{
	Ext.Ajax ({
		url  	: Ext.DOM.INDEX +'/SetResultQuality/EditView/',
		method 	: 'GET',
		param 	: {
			QualityId : Ext.Cmp('chk_quality').getValue(),
			duration : Ext.Date().getDuration()
		}
	}).load('span_top_nav');
}
		
/* * delete **/	
/* * delete **/	
		
Ext.DOM.DeleteQuality = function()
{
 if( QualityResultId = Ext.Cmp('chk_quality').empty()!=true ) {
	if( Ext.Msg("Do you want delete this rows ").Confirm() )
	{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX +'/SetResultQuality/Delete/',
			method 	: 'POST',
			param 	: { 
				QualityResultId : Ext.Cmp('chk_quality').getValue()
			},
			ERROR 	: function(fn)
			{
				try
				{
					var ERR = JSON.parse(fn.target.responseText);
					if( ERR.success ){
						Ext.Msg("Delete Quality Result").Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg("Delete Quality Result").Failed();
					}
				}
				catch(e){
					Ext.Msg(e).Error();
				}
			}
		}).post();
	}	
 }
 else{ Ext.Msg("Please select a row!").Info(); }
}
	
		
// Ext.DOM.ClearResult
// Ext.DOM.ClearResult

Ext.DOM.DisableQuality=function()
{
  var QualityResultId = Ext.Cmp('chk_quality').getValue();
  if( QualityResultId!='')
  {
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/SetResultQuality/SetActive/',
		method 	: 'POST',
		param 	: { 
			QualityResultId : QualityResultId, 
			Active		 : 0,
		},
		ERROR 	: function(fn)
		{
			try{
				var ERR = JSON.parse(fn.target.responseText);
				if( ERR.success ){
					Ext.Msg("Disable Quality Result").Success();
					Ext.EQuery.postContent();
				}
				else{
					Ext.Msg("Disable Quality Result").Failed();
				}
			}
			catch(e){
				Ext.Msg(e).Error();
			}
		}
	}).post();
  }
  else{ Ext.Msg("Please select a row!").Info(); }
}
		
// Ext.DOM.ClearResult
// Ext.DOM.ClearResult

Ext.DOM.EnableQuality=function(){

 var QualityResultId = Ext.Cmp('chk_quality').getValue();
 if( QualityResultId!=''){
	Ext.Ajax ({
		url 	: Ext.DOM.INDEX +'/SetResultQuality/SetActive/',
		method 	: 'POST',
		param 	: { 
			QualityResultId : QualityResultId, 
			Active		 :1,
		},
		ERROR 	: function(fn)
		{
			try{
				var ERR = JSON.parse(fn.target.responseText);
				if( ERR.success ){
					Ext.Msg("Enable Quality Result").Success();
					Ext.EQuery.postContent();
				}
				else{
					Ext.Msg("Enable Quality Result").Failed();
				}
			}
			catch(e){
				Ext.Msg(e).Error();
			}
		}
	}).post();
 }
 else{ Ext.Msg("Please select a row!").Info(); }
}
		

///////////////////////
// SaveQualityResult
	
Ext.DOM.UpdateQualityResult = function()
{	
 var ApproveId 		= Ext.Cmp('ApproveId').getValue(),
	 AproveCode		= Ext.Cmp('AproveCode').getValue(),
	 AproveName		= Ext.Cmp('AproveName').getValue(),
	 ApproveEskalasi= Ext.Cmp('ApproveEskalasi').getValue(),
	 ConfirmFlags	= Ext.Cmp('ConfirmFlags').getValue(),
	 AproveFlags	= Ext.Cmp('AproveFlags').getValue(),
	 CancelFlags	= Ext.Cmp('CancelFlags').getValue(),
	 UserPrivileges	= Ext.Cmp('UserPrivileges').getValue(),
	 AproveVeryfied	= Ext.Cmp('AproveVeryfied').getValue();
	
	if( Ext.Cmp('AproveCode').empty()){ Ext.Msg("Quality Result Code is empty").Info();}
	else if( Ext.Cmp('AproveName').empty()){ Ext.Msg("Quality Result Name Code is empty").Info();	}	
	else if( Ext.Cmp('ApproveEskalasi').empty() ){ Ext.Msg("Eskalasi is empty").Info(); }
	else
	{
		Ext.Ajax({
			url 	: Ext.DOM.INDEX +'/SetResultQuality/UpdateQualityResult/',
			method 	: 'POST',
			param 	: { 
				ApproveId 		: ApproveId,
				AproveCode		: AproveCode,
				AproveName		: AproveName,
				ApproveEskalasi : ApproveEskalasi,
				ConfirmFlags 	: ConfirmFlags,
				AproveFlags 	: AproveFlags,
				CancelFlags 	: CancelFlags,
				UserPrivileges 	: UserPrivileges,
				AproveVeryfied 	: AproveVeryfied
			},
			
			ERROR :function(fn){
				try {
					var ERR = JSON.parse(fn.target.responseText);
					if( ERR.success ){
						Ext.Msg("Update Quality Result").Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg("Update Quality Result").Failed();
					}
				}
				catch(e){
					Ext.Msg(e).Error();
				}
			}
		}).post();
	}
}
		
///////////////////////
// SaveQualityResult
	
Ext.DOM.SaveQualityResult = function()
{	
 var AproveCode		= Ext.Cmp('AproveCode').getValue(),
	 AproveName		= Ext.Cmp('AproveName').getValue(),
	 ApproveEskalasi= Ext.Cmp('ApproveEskalasi').getValue(),
	 ConfirmFlags	= Ext.Cmp('ConfirmFlags').getValue(),
	 AproveFlags	= Ext.Cmp('AproveFlags').getValue(),
	 CancelFlags	= Ext.Cmp('CancelFlags').getValue(),
	 UserPrivileges	= Ext.Cmp('UserPrivileges').getValue(),
	 AproveVeryfied	= Ext.Cmp('AproveVeryfied').getValue();
	
	if( Ext.Cmp('AproveCode').empty()){ Ext.Msg("Quality Result Code is empty").Info();}
	else if( Ext.Cmp('AproveName').empty()){ Ext.Msg("Quality Result Name is empty").Info();	}	
	else if( Ext.Cmp('ApproveEskalasi').empty() ){ Ext.Msg("Eskalasi is empty").Info(); }
	else
	{
		Ext.Ajax({
			url 	: Ext.DOM.INDEX +'/SetResultQuality/SaveQualityResult/',
			method 	: 'POST',
			param 	: { 
				AproveCode		: AproveCode,
				AproveName		: AproveName,
				ApproveEskalasi : ApproveEskalasi,
				ConfirmFlags 	: ConfirmFlags,
				AproveFlags 	: AproveFlags,
				CancelFlags 	: CancelFlags,
				UserPrivileges 	: UserPrivileges,
				AproveVeryfied 	: AproveVeryfied
			},
			
			ERROR :function(fn){
				try {
					var ERR = JSON.parse(fn.target.responseText);
					if( ERR.success ){
						Ext.Msg("Save Quality Result").Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg("Save Quality Result").Failed();
					}
				}
				catch(e){
					Ext.Msg(e).Error();
				}
			}
		}).post();
	}
}
</script>
	
	<!-- start : content -->
	
		<fieldset class="corner">
			<legend class="icon-callresult">&nbsp;&nbsp;<span id="legend_title"></span> </legend>	
				<div id="toolbars"></div>
				<div id="span_top_nav"></div>
				<div class="content_table"></div>
				<div id="pager"></div>
				<div id="ViewCmp"></div>
		</fieldset>	
		
	<!-- stop : content -->
	
	
	