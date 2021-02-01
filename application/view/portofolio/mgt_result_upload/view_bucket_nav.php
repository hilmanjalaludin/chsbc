<?php echo javascript(); ?>
<script type="text/javascript"> 

	// Ext.EQuery.TotalPage   = '<?php #echo $page -> _get_total_page(); ?>';
	// Ext.EQuery.TotalRecord = '<?php #echo $page -> _get_total_record(); ?>';
	// var totals_pages 	= Ext.EQuery.TotalPage;
	// var totals_records 	= Ext.EQuery.TotalRecord;
	// var query_list_data = ''; 	//<#?php echo mysql_escape_string($db -> Pages -> _get_query());?>';

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
	
	Ext.DOM.export = function()
	{
		var TemplateId = $("#bucket_file_id").val();
		if( TemplateId =='' ) {
			alert('Choose File Name Upload '); return false;
		}

		if( (TemplateId!='') )
		{
			var WindowWin = new Ext.Window({
				url   : Ext.DOM.INDEX+'/MgtBucket/downloadUploadInvalid/', 
				param : {
					TemplateId : TemplateId,
					Mode      : "EXCEL"
				}
			}).newtab();
		}
	}

	Ext.DOM.show = function()
	{
		var TemplateId = $("#bucket_file_id").val();
		if( TemplateId =='' ) {
			alert('Choose File Name Upload '); return false;
		}

		if( (TemplateId!='') )
		{
			var WindowWin = new Ext.Window({
				url   : Ext.DOM.INDEX+'/MgtBucket/downloadUploadInvalid/', 
				param : {
					TemplateId : TemplateId,
					Mode      : "SHOW"
				}
			}).newtab();
		}
	}
			
	</script>	

	<fieldset class="corner">
		<?php echo form()->legend(lang("Result Upload"), "fa-gear"); ?>
		<div id="result_content_add" class="ui-widget-panel-form"> 
			<form name="frmBucketData">
				<div class="ui-widget-form-table-compact">

					<div class="ui-widget-form-row baris-1">
						<div class="ui-widget-form-cell text_caption"><?php echo lang(array('File Name Upload'));?></div>
						<div class="ui-widget-form-cell text_caption center">:</div>
						<div class="ui-widget-form-cell left"><?php echo form()->combo('bucket_file_id','select superlong',$Filename, _get_exist_session('bucket_file_id')); ?></div>
					</div>
					
					<div class="ui-widget-form-row baris-1">
						<div class="ui-widget-form-cell text_caption">
							<?php echo form()->button("export-excel", "button save ui-button-max", lang('Export'), array('click' => 'Ext.DOM.export();'));?>
						</div>
						<div class="ui-widget-form-cell text_caption center" style="color:#FFF;">:</div>
						<div class="ui-widget-form-cell left">
							<?php echo form()->button("show-excel", "button search ui-button-max", lang('Show'), array('click' => 'Ext.DOM.show();'));?>
						</div>
					</div>
					
				</div>
			</form>
		</div>
	</fieldset>
