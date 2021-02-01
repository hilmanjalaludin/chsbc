<?php echo javascript(); ?>

<script type="text/javascript">

Ext.document('document').ready( function(){
	Ext.Cmp('ui-widget-title').setText( Ext.System.view_file_name());
 }); 
 
		
var datas= {
	order_by  : '<?php echo _get_post('order_by');?>',
	type 	  : '<?php echo _get_post('type');?>',
	keywords  : '<?php echo _get_post('keywords');?>'
 }

Ext.query(function(){
	Ext.query('#toolbars').extToolbars
	({
		extUrl    : Ext.DOM.LIBRARY+ '/gambar/icon',
		extTitle  : [['Export'],['Export Block'],['Hidden'],['Show'],['Delete'],['Search']],
		extMenu   : [['SaveExcel'],['ExportBlacklist'],['Hidden'],['Show'],['Delete'],['Search']],
		extIcon   : [['page_white_excel.png'],['page_white_excel.png'],['monitor_delete.png'],['monitor_add.png'],['cross.png'],['zoom.png']],
		extText   : true,
		extInput  : true,
		extOption : [{
			render	: 5,
			type	: 'text',
			id		: 'akeywords', 	
			name	: 'akeywords',
			value	: '<?php echo _get_post('keywords');?>',
			width	: 200
		}]
	});

});

/* create object **/
	
Ext.EQuery.TotalPage   = '<?php __($page->_get_total_page()); ?>';
Ext.EQuery.TotalRecord = '<?php __($page->_get_total_record()); ?>';


Ext.DOM.navigation = {
	custnav	 : Ext.DOM.INDEX +'/ModUploadDetail/index',
	custlist : Ext.DOM.INDEX +'/ModUploadDetail/Content'
};
	
	
/* assign show list content **/
// --------------------------------------------------------
			
Ext.EQuery.construct(Ext.DOM.navigation,datas)
Ext.EQuery.postContentList();


/* assign show list content **/
// --------------------------------------------------------
	
Ext.DOM.Search = function(){
	Ext.EQuery.construct(Ext.DOM.navigation,{
		keywords : Ext.Cmp("akeywords").getValue()
	});
	
	Ext.EQuery.postContent();
}

// Ext.DOM.Hidden
// --------------------------------------------------------
	
		
Ext.DOM.Hidden = function(){
	var UploadId = Ext.Cmp('ftp_upload_id').getValue();
	if( Ext.Cmp('ftp_upload_id').empty() ) {
		Ext.Msg("Please select a row(s)").Info(); }
	else
	{
		Ext.Ajax({
			url 	: Ext.DOM.INDEX +'/ModUploadDetail/hidden/',
			method 	: 'POST',
			param 	: {
				FTP_UploadId : UploadId,
				Active : 0
			},
			ERROR : function(e){
				Ext.Util(e).proc(function(hidden){
					if( hidden.success ) {
						Ext.Msg("Hidden rows").Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg("Hidden rows").Failed();
					}
				});
			}
		}).post();
	}	
	
}

// Ext.DOM.Hidden
// --------------------------------------------------------
	
		
Ext.DOM.Delete = function(){
	var UploadId = Ext.Cmp('ftp_upload_id').getValue();
	if( Ext.Cmp('ftp_upload_id').empty() ) {
		Ext.Msg("Please select a row(s)").Info(); }
	else
	{
		if(Ext.Msg("Do you want to deleted this row(s) ").Confirm() )
		{
			Ext.Ajax({
				url 	: Ext.DOM.INDEX +'/ModUploadDetail/Delete/',
				method 	: 'POST',
				param 	: {
					FTP_UploadId : UploadId
				},
				ERROR : function(e){
					Ext.Util(e).proc(function(Delete){
						if( Delete.success ) {
							Ext.Msg("Delete rows").Success();
							Ext.EQuery.postContent();
						}
						else{
							Ext.Msg("Delete rows").Failed();
						}
					});
				}
			}).post();
		}	
	}	
	
}


// --------------------------------------------------------
	
Ext.DOM.Show = function()
{
	var UploadId = Ext.Cmp('ftp_upload_id').getValue();
	if( Ext.Cmp('ftp_upload_id').empty() ) {
		Ext.Msg("Please select a row(s)").Info(); }
	else
	{
		Ext.Ajax({
			url 	: Ext.DOM.INDEX +'/ModUploadDetail/hidden/',
			method 	: 'POST',
			param 	: {
				FTP_UploadId : UploadId,
				Active : 1
			},
			ERROR : function(e){
				Ext.Util(e).proc(function(hidden){
					if( hidden.success ) {
						Ext.Msg("Show rows").Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg("Show rows").Failed();
					}
				});
			}
		}).post();
	}	
	
}

// --------------------------------------------------------

Ext.DOM.ExportBlacklist = function()
{
	var ChecklistId = Ext.Cmp('ftp_upload_id').getValue();
	if( ChecklistId !='')
	{
		if(Ext.Msg("Do you want to download this file ?") )
		{
			Ext.Window
			({
				url 	: Ext.DOM.INDEX+"/ModUploadDetail/ExportBlacklist/",
				param 	: {
					Ftp_upload_id : ChecklistId
				}
			}).newtab();
		}
	}
	else{
		Ext.Msg("Please select a row(s)").Info(); 
	}
}
			
Ext.DOM.SaveExcel = function()
{
		var ChecklistId = Ext.Cmp('ftp_upload_id').getValue();
		if( ChecklistId !='')
		{
			if(Ext.Msg("Do you wan to download this file ?") )
			{
				Ext.Window
				({
					url 	: Ext.DOM.INDEX+"/ModUploadDetail/SaveExcel/",
					param 	: {
						Ftp_upload_id : ChecklistId
					}
				}).newtab();
			}
		}
		else{
			Ext.Msg("Please select a row(s)").Info(); 
		}
	}
	
// --------------------------------------------------------
var CheckDuplicateData = function()
	{
		var ChecklistId = doJava.checkedValue('ftp_upload_id');
		if( ChecklistId !='')
		{
			doJava.File = '../class/class.ftpupload.info.php';
			doJava.Params ={
				action:'check_duplicate',
				Ftp_upload_id : ChecklistId
			}
			window.open(doJava.File+'?'+doJava.ArrVal())
		}
	}	
// --------------------------------------------------------
		
</script>
<fieldset class="corner">
<?php echo form()->legend(lang("Upload Detail"), "fa-gear"); ?>

 <div class="ui-widget-toolbars" id="toolbars"></div>
 <div class="ui-widget-panel-content" id="#panel-content"></div>
 <div class="content_table" id="ui-widget-content_table"></div>
 <div class="ui-widget-pager" id="pager"></div>
 <div class="ui-widget-component" id="ui-widget-component"></div>
	
	<!--
	<div id="toolbars"></div>
	<div class="box-shadow" style="background-color:#FFFFFF;margin-top:10px;">	
		<div class="content_table"></div>
		<div id="pager"></div>
	</div>	-->
</fieldset>	