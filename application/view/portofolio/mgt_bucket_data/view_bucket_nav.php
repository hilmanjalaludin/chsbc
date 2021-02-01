<?php echo javascript(); ?>
<script type="text/javascript"> 

/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */

Ext.EQuery.TotalPage   = '<?php echo $page -> _get_total_page(); ?>';
Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';
	
	
var totals_pages 	= Ext.EQuery.TotalPage;
var totals_records 	= Ext.EQuery.TotalRecord;

var query_list_data = ''; 	//<#?php echo mysql_escape_string($db -> Pages -> _get_query());?>';

/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 	
var getListCampaign = ( function()
{
  return ( 
	Ext.Ajax({
			url : Ext.DOM.INDEX +'/MgtBucket/getCampaignName/',
			method :'GET',
			param :{
				action:'get_campaign'
			}
		}).json()
	)
})(); 

var getListATM = ( function()
{
  return ( 
	Ext.Ajax({
			url : Ext.DOM.INDEX +'/MgtBucket/getATMName/',
			method :'GET',
			param :{
				action:'getATMName'
			}
		}).json()
	)
})(); 

/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */

if( window.LEVEL.USER_UPLOADER == Ext.Session('HandlingType').getSession() ){
	var EXTTITLE  = [['Upload Manual']],
		EXTMENU   = [['UploadManual']],
		EXTICON   = [['database_go.png']],
		EXTOPTION = [];
 } else {
 	/*
 	* Delete Upload Manual for ROOT and Admin
 	* 
 	var EXTTITLE  = [['Back'],['Find'],[],[],[],[],['By CheckList'],['By Amount'],['Upload Manual']],
		EXTMENU   = [['backtohome'],['FindBucket'],[],[],[],[],['Ext.DOM.DistribueByChecklist'],['Ext.DOM.ProcessAmount'],['UploadManual']],
		EXTICON   = [['house.png'],['find.png'],[],[],[],[],['drive_disk.png'],['drive_disk.png'],['database_go.png']],
		EXTOPTION = [{
	*/
	var EXTTITLE  = [['Find'],['Upload Manual']],
		EXTMENU   = [['FindBucket'],['UploadManual']],
		EXTICON   = [['find.png'],['database_go.png']],
		EXTOPTION = [];	
}	
 
 
$(function(){
	$('#toolbars').extToolbars({
		extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle : EXTTITLE, //[['Back'],['Find'],[],[],[],[],['By CheckList'],['By Amount'],['Upload Manual']],
		extMenu  : EXTMENU, //[['backtohome'],['FindBucket'],[],[],[],[],['Ext.DOM.DistribueByChecklist'],['Ext.DOM.ProcessAmount'],['UploadManual']],
		extIcon  : EXTICON, //[['house.png'],['find.png'],[],[],[],[],['drive_disk.png'],['drive_disk.png'],['database_go.png']],		
		extText  : true,
		extInput : true,
		extOption: EXTOPTION
	});
	
	$('.date').datepicker
	({
		changeYear		: true, 
		changeMonth		: true,
		buttonImage		: Ext.Image('calendar.gif'), 
		buttonImageOnly	: true, 
		showOn			: 'button', 
		dateFormat		: 'dd-mm-yy'});	
		
	$('.select').chosen();
	$('#find_sum_dta').attr("disabled", true);
	
	
});


/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
Ext.DOM.UploadManual = function(){
	Ext.ShowMenu(new Array('MgtBucket','ManualUpload'), 
		"Bucket Data", {
			time : Ext.Date().getDuration()
	});
}


/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */

 Ext.DOM.ProcessByATMChecked = function()
{
	var atm = Ext.Cmp('combo_filter_atm').getValue();
	var ftp_list_id = Ext.Cmp('CustomerId').getValue();
	var campaign_id = Ext.Cmp('combo_filter_campaign').getValue();
	if( ftp_list_id =='' ) { alert('Please select a rows !'); return false; }
	else if( campaign_id=='') { alert('Please select a campaign !'); return false; }
	else if( atm=='') { alert('Please select User ATM !'); return false; }
	else 
	{
		Ext.Ajax({
			url 	: Ext.DOM.INDEX+'/MgtBucket/SaveByCheckedATM/',
			method  : 'POST',
			param   : {
				ftp_list_id : ftp_list_id,
				campaign_id : campaign_id,
				atm : atm
			},
			ERROR : function( fn ) {
				try
				{
					var ERR = JSON.parse( fn.target.responseText ); 
					Ext.Msg("Assign Data, Sucess : "+ERR.mesages._success +" , Duplicate :"+ERR.mesages._duplicate).Info();
				}
				catch(e){
					Ext.Msg(e).Error();
				}
			} 
		}).post();
	}
}
 
 
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
 Ext.DOM.ProcessAmount = function()
{
	
	var amount_size = Ext.Cmp('find_sum_dta').getValue(),
		amount_assign = Ext.Cmp('text_sum_asg').getValue(),
		campaign_name = Ext.Cmp('combo_filter_campaign').getValue(),
		fileupload = Ext.Cmp('bucket_file_id').getValue(),
		assign_status = Ext.Cmp('bucket_assign_status').getValue(),
		end_date	= Ext.Cmp('bucket_end_date').getValue(),
		start_date	= Ext.Cmp('bucket_start_date').getValue();
	
	if (fileupload==''){ 
		Ext.Msg("Please select file type").Info(); }
	else if (campaign_name==''){ 
		Ext.Msg("Please select campaign").Info();}
	else if( parseInt(amount_assign) < 1 ) { 
		Ext.Msg('Assign data can\'t zero').Info();}
	else
	{
		if( parseInt(amount_size) >= parseInt(amount_assign) )
		{
		 var ERROR = Ext.Ajax ({
				url 	: Ext.DOM.INDEX+'/MgtBucket/saveByAmount/',
				method  : 'POST',
				param 	: {
					amount_size   : amount_size,
					amount_assign : amount_assign,
					campaign_name : campaign_name,
					fileupload	  : fileupload,
					assign_status : assign_status,
					start_date 	  : start_date, 
					end_date	  :	end_date
				},
				ERROR : function(fn){
					try
					{
						var ERR = JSON.parse( fn.target.responseText ); 
						Ext.Msg("Assign Data, Sucess : "+ERR.mesages._success +" , Duplicate :"+ERR.mesages._duplicate).Info();
						Ext.EQuery.postContent();
					}
					catch(e){
						Ext.Msg(e).Error();
					}
				}
				
			}).post();
		}
		else{
			Ext.Msg("Assign Data").Failed();
		}
	}
 }

 Ext.DOM.ProcessAmountATM = function()
 {
	
	var atm = Ext.Cmp('combo_filter_atm').getValue(),
		amount_size = Ext.Cmp('find_sum_dta').getValue(),
		amount_assign = Ext.Cmp('text_sum_asg').getValue(),
		campaign_name = Ext.Cmp('combo_filter_campaign').getValue(),
		fileupload = Ext.Cmp('file_upload_id').getValue(),
		assign_status = Ext.Cmp('assign_data').getValue(),
		end_date	= Ext.Cmp('start_date').getValue(),
		start_date	= Ext.Cmp('start_date').getValue();
	
	if (fileupload==''){ 
		Ext.Msg("Please select file type").Info(); }
	else if (campaign_name==''){ 
		Ext.Msg("Please select campaign").Info();}
	else if (atm==''){ 
		Ext.Msg("Please select User ATM").Info();}
	else if( parseInt(amount_assign) < 1 ) { 
		Ext.Msg('Assign data can\'t zero').Info();}
	else
	{
		if( parseInt(amount_size) >= parseInt(amount_assign) )
		{
		 var ERROR = Ext.Ajax ({
				url 	: Ext.DOM.INDEX+'/MgtBucket/saveByAmountATM/',
				method  : 'POST',
				param 	: {
					amount_size   : amount_size,
					amount_assign : amount_assign,
					campaign_name : campaign_name,
					fileupload	  : fileupload,
					assign_status : assign_status,
					start_date 	  : start_date, 
					end_date	  :	end_date,
					atm     	  : atm
				},
				ERROR : function(fn){
					try
					{
						var ERR = JSON.parse( fn.target.responseText ); 
						Ext.Msg("Assign Data, Sucess : "+ERR.mesages._success +" , Duplicate :"+ERR.mesages._duplicate).Info();
					}
					catch(e){
						Ext.Msg(e).Error();
					}
				}
				
			}).post();
		}
		else{
			Ext.Msg("Assign Data").Failed();
		}
	}
 }
 
 
// ----------------------------------------------------------------------------- 
/*
 * @ package	: ---- function distribute by checklist ------------------------
 * 
 * @ notes 		:   
 */
 	
 Ext.DOM.DistribueByChecklist = function()
{
	var ftp_list_id = Ext.Cmp('CustomerId').getValue();
	var campaign_id = Ext.Cmp('combo_filter_campaign').getValue();
	
	if( ftp_list_id =='' ) { 
		alert('Please select a rows !'); 
		return false;  }
	else if( campaign_id=='') { 
		alert('Please select a campaign !'); 
			return false; }
	else 
	{
		Ext.Ajax
		({
			url 	: Ext.EventUrl(["MgtBucket","SaveByChecked"]).Apply(), //Ext.DOM.INDEX+'/MgtBucket/SaveByChecked/',
			method  : 'POST',
			param   : {
				ftp_list_id : ftp_list_id,
				campaign_id : campaign_id
			},
			ERROR : function( fn ) {
				try {
					var ERR = JSON.parse( fn.target.responseText ); 
					Ext.Msg("Assign Data, Sucess : "+ERR.mesages._success +" , Duplicate :"+ERR.mesages._duplicate).Info();
					Ext.EQuery.postContent();
				}
				catch(e){
					Ext.Msg(e).Error();
				}
			} 
		}).post();
	}
}

/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
var Deleted = function()
{
	var ftp_list_id = Ext.Cmp('ftp_list_id').getValue();
	if( ftp_list_id =='' ) { alert('Please select a rows !'); return false; }
	else if( ftp_list_id.length<1 ){ alert('Please select a rows !'); return false; }
	else
	{
		Ext.Ajax({
			url 	: Ext.DOM.SYSTEM+'/controller/EUI_Controll.bucket.php',
			method 	: 'POST',
			param 	: {
				action : 'deleted_to_ftpbucket',
				ftp_list_id : ftp_list_id
			},
			ERROR : function( e ){
				try { 
					var  ERROR = JSON.parse(e.target.responseText );
					if( ERROR.result ){
						alert("Succes, Deleted FTP Bucket data with ( "+ERROR.totals_success+" ) rows data !");
						$('#main_content').load('act_ftp_bucket_nav.php');
					}
					else{
						alert("Failed, Deleted FTP Bucket data with ( "+ERROR.totals_success+" ) rows data !");
						return false;
					}
				}
				catch(e){ alert(e); }
			}
			
		}).post();
	}
}

/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
Ext.DOM.backtohome = function()
{
	 if( Ext.Msg('Do you want to back campaign setup ?').Confirm() )
	{
		Ext.ShowMenu(new Array('SetCampaign','index'),
			'Campaigns Setup',{
			time : Ext.Date().getDuration()
		});
	}
}

/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 	
Ext.DOM.datas=
{ 
	bucket_assign_status : '<?php echo _get_exist_session('bucket_assign_status');?>',
	bucket_start_date	 : '<?php echo _get_exist_session('bucket_start_date');?>',
	bucket_end_date		 : '<?php echo _get_exist_session('bucket_end_date');?>',	
	bucket_file_id		 : '<?php echo _get_exist_session('bucket_file_id');?>',	 
	order_by 			 : '<?php echo _get_exist_session('order_by');?>',
	type	 			 : '<?php echo _get_exist_session('type');?>',
}
	
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 		
Ext.DOM.navigation = 
{
	custnav	 : Ext.DOM.INDEX+'/MgtBucket/index/',
	custlist : Ext.DOM.INDEX+'/MgtBucket/Content/'
}

/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
 Ext.EQuery.construct(Ext.DOM.navigation,datas)
 Ext.EQuery.postContentList();
		
/*
 * @ def	 : function ready 
 * 
 * @ params	 : method on ready pages 
 * @ package : bucket datas 
 */
 
Ext.DOM.FindBucket = function()
{
	var frmBucketData = Ext.Serialize("frmBucketData");
	//console.log(frmBucketData.getElement());
	Ext.EQuery.construct( navigation, Ext.Join([
			frmBucketData.getElement()
		]).object());
	Ext.EQuery.postContent();
}		
			
</script>	


<fieldset class="corner">
<?php echo form()->legend(lang("Bucket Data"), "fa-gear"); ?>
 <div id="result_content_add" class="ui-widget-panel-form"> 
	<form name="frmBucketData">
	
		<div class="ui-widget-form-table-compact">
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Bucket File Name'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left"><?php echo form()->combo('bucket_file_id','select superlong',$Filename, _get_exist_session('bucket_file_id')); ?></div>
			</div>
			
			<div class="ui-widget-form-row baris-1">
				<div class="ui-widget-form-cell text_caption"><?php echo lang(array('Bucket Upload Date'));?></div>
				<div class="ui-widget-form-cell text_caption center">:</div>
				<div class="ui-widget-form-cell left">
					<?php echo form() -> input('bucket_start_date','input_text date',_get_exist_session('bucket_start_date') );?> 
					<?php echo lang(array('to')); ?>
					<?php echo form() -> input('bucket_end_date','input_text date',_get_exist_session('bucket_end_date'));?>
				</div>
			</div>
			
		</div>
		
	</form>
 </div>
 
 <!-- html markup -->
 
 <div class="ui-widget-toolbars" id="toolbars"></div>
 <div class="ui-widget-panel-content" id="#panel-content"></div>
 <div class="content_table" id="ui-widget-content_table"></div>
 <div class="ui-widget-pager" id="pager"></div>
 <div class="ui-widget-component" id="ui-widget-component"></div>
</fieldset>
