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
	
var datas = 
	{
		keywords : '',  //'<#?php echo $_REQUEST['keywords'];?>',
		order_by : '', //'<#?php echo $_REQUEST['order_by'];?>',
		type 	 : '' //'<#?php echo $_REQUEST['type'];?>'
	}
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
$('#toolbars').extToolbars({
		extUrl    : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle :[['Enable'],['Disable'] ,['Add'],['Edit'],['Delete'],['Cancel'],[],['Search']],
		extMenu  :[['enableWork'],['disableWork'],['addWork'],['editWork'],['deleteWork'],['cancelWork'],[],['searchWork']],
		extIcon  :[['accept.png'],['cancel.png'], ['add.png'],['calendar_edit.png'],['delete.png'],['cancel.png'],[],['zoom.png']],
		extText  :true,
		extInput :true,
		extOption: [{
					 render:6,
					 type:'text',
					 id:'v_result', 	
					 name:'v_result',
					 value: datas.keywords,
					 width:200
					}]
	});
	
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
 Ext.DOM._content_page = {
	custnav  : Ext.DOM.INDEX+'/SetWorkArea/index',
	custlist : Ext.DOM.INDEX+'/SetWorkArea/Content'			
 }	
	
/**
 ** javscript prototype system
 ** version v.0.1
 **/

 Ext.EQuery.TotalPage = '<?php echo $page -> _get_total_page(); ?>';
 Ext.EQuery.TotalRecord = '<?php echo $page -> _get_total_record(); ?>';
		
/**
 ** javscript prototype system
 ** version v.0.1
 **/
	var searchWork = function(){
		var keywords = doJava.dom('v_result').value;
		var datas = {
			keywords : keywords
		}
		
		Ext.EQuery.construct( Ext.DOM._content_page,datas)
		Ext.EQuery.postContent();
	}

/**
 ** javscript prototype system
 ** version v.0.1
 **/
	Ext.EQuery.construct(Ext.DOM._content_page, datas )
	Ext.EQuery.postContentList();

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
 var UpdateData = function()
	{
		var BranchId =  doJava.dom('BranchId').value;
		var BranchCode =  doJava.dom('BranchCode').value;
		var BranchName =  doJava.dom('BranchName').value;
		var BranchContact = doJava.dom('BranchContact').value; 
		var BranchAddress =  doJava.dom('BranchAddress').value;
		var BranchManager = doJava.dom('BranchManager').value;
		var BranchEmail = doJava.dom('BranchEmail').value;
		if( BranchCode =='' ) { alert('Please input BranchCode..!'); return false;}
		else if( BranchName =='' ) { alert('Please input BranchName..!'); return false;}
		else
		{
			doJava.File = '../class/class.work.area.php';
			doJava.Params = { 
				action : 'update_work_area',
				BranchId : BranchId,
				BranchCode : BranchCode,
				BranchName : BranchName,
				BranchContact : BranchContact, 
				BranchAddress : BranchAddress,
				BranchManager : BranchManager,
				BranchEmail : BranchEmail
			}
			
			var error = doJava.eJson();
			if( error.result ){
				alert('Success, Update Branch Data..!');
				extendsJQuery.postContent();	
			}
			else{
				alert('Failed, Update Branch Data..!');
			}
		}
	}		

/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
 var saveResult = function()
	{
		var BranchCode =  doJava.dom('BranchCode').value;
		var BranchName =  doJava.dom('BranchName').value;
		var BranchContact = doJava.dom('BranchContact').value; 
		var BranchAddress =  doJava.dom('BranchAddress').value;
		var BranchManager = doJava.dom('BranchManager').value;
		var BranchEmail = doJava.dom('BranchEmail').value;
		
		if( BranchCode =='' ) { alert('Please input BranchCode..!'); return false;}
		else if( BranchName =='' ) { alert('Please input BranchName..!'); return false;}
		else
		{
			doJava.File = '../class/class.work.area.php';
			doJava.Params = { 
				action : 'insert_work_area',
				BranchCode : BranchCode,
				BranchName : BranchName,
				BranchContact : BranchContact, 
				BranchAddress : BranchAddress,
				BranchManager : BranchManager,
				BranchEmail : BranchEmail
			}
			
			var error = doJava.eJson();
			if( error.result ){
				alert('Success, Add Branch Data..!');
				extendsJQuery.postContent();	
			}
			else{
				alert('Failed, Add Branch Data..!');
			}
		}
	}
	
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
var deleteWork = function()
	{
		doJava.File = '../class/class.work.area.php';
		var arr_cbx_list = doJava.checkedValue('BranchId');
		doJava.Params = {
			action :'delete_work_area',
			BranchId : arr_cbx_list 
		}
		
		var result = doJava.eJson();
		if( result.success ){
			alert('Success, Deleted Rows!');
			extendsJQuery.postContent();	

		}
		else
			alert('Failed, Deleted Rows!');
	}
	
/* enabel work ********************/

var enableWork = function()
	{
		doJava.File = '../class/class.work.area.php';
		var arr_cbx_list = doJava.checkedValue('BranchId');
		doJava.Params = {
			action :'enable_work_area',
			BranchId : arr_cbx_list 
		}
		
		var result = doJava.eJson();
		if( result.success ){
			alert('Success Enable Rows!');
			extendsJQuery.postContent();	

		}
		else
			alert('Failed Enable Rows!');
	}
	
/* editWork **/

	var editWork = function(){
	
		var arr_cbx_list = doJava.checkedValue('BranchId').split(',');
		if( arr_cbx_list.length==1){
			doJava.File = '../class/class.work.area.php';
			doJava.Params = 
			{
				action :'edit_work_area',
				BranchId : arr_cbx_list[0] 
			}
			doJava.Load('span_top_nav');
		}
		else{
			alert('please select a rows !')
		}
	}
	
/* disbaled work ***/
	
	var disableWork = function()
	{
		doJava.File = '../class/class.work.area.php';
		var arr_cbx_list = doJava.checkedValue('BranchId');
			doJava.Params = {
				action :'disable_work_area',
				BranchId : arr_cbx_list 
			}
			
			var result = doJava.eJson();
			if( result.success ){
				alert('Success Disable Rows!');
				extendsJQuery.postContent();	
			}
			else
				alert('Failed Disable Rows!');
	}
	
	var addWork = function()
	{
		doJava.File = '../class/class.work.area.php';
		doJava.Params ={ action: 'add_work_area' }
		doJava.Load('span_top_nav');
	}
	
/* cancelWork *************/	
	var cancelWork = function()
	{
		doJava.File = '../class/class.work.area.php';
		doJava.Params ={ action: 'clear_work_area' }
		doJava.Load('span_top_nav');
	}	
</script>

<!-- ///////////////////////////////////////////////////////////////////////////-->
<!-- ///////////////////////////////////////////////////////////////////////////-->
<!-- start : content -->

	<fieldset class="corner">
		<legend class="icon-customers">&nbsp;&nbsp;<span id="legend_title"></span> </legend>	
			<div id="toolbars"></div>
			<div id="span_top_nav" style="margin:5px;"></div>
			<div id="customer_panel" class="box-shadow">
				<div class="content_table" style="background-color:#FFFFFF;"></div>
				<div id="pager"></div>
			</div>
	</fieldset>	
		
<!-- stop : content -->
<!-- ///////////////////////////////////////////////////////////////////////////-->
<!-- ///////////////////////////////////////////////////////////////////////////-->