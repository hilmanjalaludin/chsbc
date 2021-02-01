<?php echo javascript(); ?>
<script type="text/javascript">
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.onload = (function(){
	Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
 })();
 
/**
 ** javscript prototype system
 ** version v.0.1
 **/		
 
var datas={
	keywords : '<?php echo _get_post('keywords');?>',
	order_by : '<?php echo _get_post('order_by');?>',
	type	 : '<?php echo _get_post('type');?>',	
}
 
/**
 ** javscript prototype system
 ** version v.0.1
 **/		
$(function(){
	$('#toolbars').extToolbars({
				extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
				extTitle :[['Enable'],['Disable'],['Edit'],['Add'],['Delete'],['Cancel'],['Search']],
				extMenu  :[['ENABLE_LAST_CALL'],['DISABLE_LAST_CALL'],['EDIT_LAST_CALL'],['ADD_RESULT'],['deleteResult'],['cancelResult'],['SEARCH_TIME']],
				extIcon  :[['accept.png'],['lock.png'], ['clock_edit.png'],['add.png'],['delete.png'],['cancel.png'], ['zoom.png']],
				extText  :true,
				extInput :true,
				extOption: [{
						render:6,
						type:'text',
						id:'WorkTime', 	
						name:'WorkTime',
						value: datas.keywords,
						width:200
					}]
			});
			
		});
		

Ext.EQuery.TotalPage   = <?php echo $page -> _get_total_page(); ?>;
Ext.EQuery.TotalRecord = <?php echo $page -> _get_total_record(); ?>;

/* assign navigation filter **/
		
var navigation = 
{
	custnav : Ext.DOM.INDEX +'/SetLastCall/index/',
	custlist : Ext.DOM.INDEX +'/SetLastCall/Content/'
}
		
	/* assign show list content **/
		
Ext.EQuery.construct(navigation,datas)
Ext.EQuery.postContentList();
		
	//	doJava.File = '../class/class.last.call.php' 
		
		
Ext.DOM.SEARCH_TIME = function(){
  Ext.EQuery.construct(navigation,{
	keywords : Ext.Cmp('WorkTime').getValue()
  });
  Ext.EQuery.postContent();
}
		
//** edit category ****/	
		
Ext.DOM.ADD_RESULT = function(){
	Ext.Ajax
	({
		url  : Ext.DOM.INDEX +'/SetLastCall/AddView/',
		method : 'GET',
		param : {
			duration : Ext.Date().getDuration()
		}
	}).load('span_top_nav');
}

//** edit category ****/	

Ext.DOM.EDIT_LAST_CALL = function()
{
	Ext.Ajax ({
		url  	: Ext.DOM.INDEX +'/SetLastCall/EditView/',
		method 	: 'GET',
		param 	: {
			LastCallId : Ext.Cmp('chk_lastcall').getValue(),
			duration : Ext.Date().getDuration()
		}
	}).load('span_top_nav');
}
	
//** edit category ****/	
		
Ext.DOM.ENABLE_LAST_CALL = function()
{
	var LastCallId = Ext.Cmp('chk_lastcall').getValue();
	if( LastCallId!='')
	{
		Ext.Ajax 
		({
			url 	: Ext.DOM.INDEX +'/SetLastCall/SetActive/',
			method 	: 'POST',
			param 	: { 
				LastCallId : LastCallId, 
				Active		 :1,
			},
			ERROR 	: function(fn)
			{
				try{
					var ERR = JSON.parse(fn.target.responseText);
					if( ERR.success ){
						Ext.Msg("Enable Last Calls Setup").Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg("Enable Last Calls Setup").Failed();
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

/* *************************************** */
/* *************************************** */
	
	var editLastCall = function(){
		var inResultCheck = doJava.checkedValue('chk_lastcall');
			if( inResultCheck!=''){
				$('#span_top_nav').load(doJava.File+'?action=tpl_edit&resultid='+inResultCheck);
			}
			else
				alert("Please select Rows !")
	}	
		
/* *************************************** */
/* *************************************** */

Ext.DOM.DISABLE_LAST_CALL = function()
{
	var LastCallId = Ext.Cmp('chk_lastcall').getValue();
	if( LastCallId!='')
	{
		Ext.Ajax 
		({
			url 	: Ext.DOM.INDEX +'/SetLastCall/SetActive/',
			method 	: 'POST',
			param 	: { 
				LastCallId : LastCallId, 
				Active :0,
			},
			ERROR 	: function(fn)
			{
				try{
					var ERR = JSON.parse(fn.target.responseText);
					if( ERR.success ){
						Ext.Msg("Disable Last Calls Setup").Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg("Disable Last Calls Setup").Failed();
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
		
		
/* *************************************** */
/* *************************************** */
var deleteResult = function(){
			
				var inResultCheck = doJava.checkedValue('chk_lastcall');
				if( inResultCheck!=''){
					doJava.Params = {
						action:'delete_last_call',
						resultid: inResultCheck
					}
					var error = doJava.Post();
						if( error==1)
						{
							alert("Succeeded, Delete Last Call !");
							Ext.EQuery.postContent();
						}
						else{ 
							alert("Failed, Last Call !"); 
							return false; 
						}
				}
				else{
					alert("Please select Rows !")
				}
		}
		
		
/* *************************************** */
/* *************************************** */
Ext.DOM.SaveWorkTime = function()
{

var LastCallStartDate	= Ext.Cmp('LastCallStartDate').getValue(),
	LastCallEndDate		= Ext.Cmp('LastCallEndDate').getValue(),
	LastCallStartTime	= Ext.Cmp('LastCallStartTime').getValue(),
	LastCallEndTime		= Ext.Cmp('LastCallEndTime').getValue(),
	LastCallReason		= Ext.Cmp('LastCallReason').getValue(),
	LastCallStatus		= Ext.Cmp('LastCallStatus').getValue();
	
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/SetLastCall/SaveWorkTime/',
		method 	: 'POST',
		param 	: { 
			LastCallStartDate	: Ext.Cmp('LastCallStartDate').getValue(),
			LastCallEndDate		: Ext.Cmp('LastCallEndDate').getValue(),
			LastCallStartTime	: Ext.Cmp('LastCallStartTime').getValue(),
			LastCallEndTime		: Ext.Cmp('LastCallEndTime').getValue(),
			LastCallReason		: Ext.Cmp('LastCallReason').getValue(),
			LastCallStatus		: Ext.Cmp('LastCallStatus').getValue(),
			LasCallCreateBy		: null,
			LastCallCreateDate 	: null
		},
			
		ERROR :function(fn){
			try 
			{
				var ERR = JSON.parse(fn.target.responseText);
				if( ERR.success ){
					Ext.Msg("Save Last Call Time").Success();
					Ext.EQuery.postContent();
				}
				else{
					Ext.Msg("Save Last Call Time").Failed();
				}
			}
			catch(e){
				Ext.Msg(e).Error();
			}
		}
	}).post();
}
		
/* *************************************** */
/* *************************************** */
Ext.DOM.UpdateWorkTime = function()
{
	
var 
	LastCallId			= Ext.Cmp('LastCallId').getValue(),
	LastCallStartDate	= Ext.Cmp('LastCallStartDate').getValue(),
	LastCallEndDate		= Ext.Cmp('LastCallEndDate').getValue(),
	LastCallStartTime	= Ext.Cmp('LastCallStartTime').getValue(),
	LastCallEndTime		= Ext.Cmp('LastCallEndTime').getValue(),
	LastCallReason		= Ext.Cmp('LastCallReason').getValue(),
	LastCallStatus		= Ext.Cmp('LastCallStatus').getValue();
	
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/SetLastCall/UpdateWorkTime/',
		method 	: 'POST',
		param 	: { 
			LastCallId			: Ext.Cmp('LastCallId').getValue(),
			LastCallStartDate	: Ext.Cmp('LastCallStartDate').getValue(),
			LastCallEndDate		: Ext.Cmp('LastCallEndDate').getValue(),
			LastCallStartTime	: Ext.Cmp('LastCallStartTime').getValue(),
			LastCallEndTime		: Ext.Cmp('LastCallEndTime').getValue(),
			LastCallReason		: Ext.Cmp('LastCallReason').getValue(),
			LastCallStatus		: Ext.Cmp('LastCallStatus').getValue(),
			LasCallCreateBy		: null,
			LastCallCreateDate 	: null
		},
			
		ERROR :function(fn){
			try 
			{
				var ERR = JSON.parse(fn.target.responseText);
				if( ERR.success ){
					Ext.Msg("Update Last Call Time").Success();
					Ext.EQuery.postContent();
				}
				else{
					Ext.Msg("Update Last Call Time").Failed();
				}
			}
			catch(e){
				Ext.Msg(e).Error();
			}
		}
	}).post();
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
	
	
	