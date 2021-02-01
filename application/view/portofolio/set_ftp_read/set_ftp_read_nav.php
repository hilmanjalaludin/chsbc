<?php
require(dirname(__FILE__)."/../../system/database/MYSQLConnect.php");
require(dirname(__FILE__)."/../../system/system/System.php");

// check avail session 

 $db -> View -> _load_sesion_view();
 
// set query pages limit 0, 20

 $db -> Pages-> _setPage(20); 

// set query content to execute 

 $db -> Pages-> _setQuery("SELECT * FROM tms_ftp_read a ");

// set filter 

 $db -> Pages-> _setWhere();
 $db -> Pages-> _setOrderBy("a.ftp_read_id","DESC");
  
// call attribut js
// echo  $db -> Pages-> _get_syntax();
  $db -> View -> _load_js_view();

?>
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
 
$(function(){
	$('#toolbars').extToolbars({
				extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
				extTitle :[['Add'],['Edit'],['Delete'],['Not Active Schedule'],['Active Schedule'],['Cancel']],
				extMenu  :[['FTP_adding'],['FTP_edit'],['FTP_delete'],['FTP_noactiva_schedule'],['FTP_activa_schedule'],['cancelResult']],
				extIcon  :[['add.png'],['calendar_edit.png'],['delete.png'],['clock_add.png'],['clock_add.png'],['cancel.png']],
				extText  :true,
				extInput :false,
				extOption: []
			});
			
		});
		
	var datas={}

extendsJQuery.totalPage   = <?php echo $db -> Pages -> _get_total_page(); ?>;
extendsJQuery.totalRecord = <?php echo $db -> Pages -> _get_total_record(); ?>;

	/* assign navigation filter **/
		
		var navigation = {
			custnav : 'set_ftp_read_nav.php',
			custlist : 'set_ftp_read_list.php'
		}
		
	/* assign show list content **/
		
		extendsJQuery.construct(navigation,'')
		extendsJQuery.postContentList();
		
		var cancelResult=function(){
			doJava.dom('span_top_nav').innerHTML='';
		}
		
		var FTP_adding = function()
		{
			doJava.File = '../class/class.config.readftp.php' 
			doJava.Params ={ action:'add_ftp_setting' }	
			doJava.Load('span_top_nav');
		}

/* active schedule ****/

 var FTP_noactiva_schedule = function()
  {
	var inResultCheck = doJava.checkedValue('ftp_id');
	if( inResultCheck=='' ) { alert('Please select a rows !') }
	else
	{
		doJava.File = '../class/class.config.readftp.php'
		doJava.Params =
		{ 
			action :'dsb_ftp_setting',
			ftp_id : inResultCheck
		}
		
		var error = doJava.eJson();
		if( error.result) { 
			alert("Success, Non Active Schedule Read FTP !"); 
			$('#content_load').load('set_ftp_read_nav.php'); 
		}
		else{  
			alert("Failed, Non Active Schedule Read FTP !");  
			return false; 
		}
	}
  
  }

  
/* active schedule ****/
	
  var FTP_activa_schedule = function()
  {
	var inResultCheck = doJava.checkedValue('ftp_id');
	if( inResultCheck=='' ) { alert('Please select a rows !') }
	else
	{
		doJava.File = '../class/class.config.readftp.php'
		doJava.Params =
		{ 
			action :'enb_ftp_setting',
			ftp_id : inResultCheck
		}
		
		var error = doJava.eJson();
		if( error.result) { alert("Success, Active Schedule Read FTP !"); 
			$('#content_load').load('set_ftp_read_nav.php'); 
		}
		else{  alert("Failed, Active Schedule Read FTP !");  return false; }
	}
	
  }	
/* edit category ****/
	
	var FTP_edit = function()
	{
			var inResultCheck = doJava.checkedValue('ftp_id');
			var inArray = inResultCheck.split(',');
			
			if( inResultCheck!=''){	
			if( inArray.length>1){
				alert('Please Select One Rows');
			}
			else{
				doJava.File = '../class/class.config.readftp.php' 
				doJava.Params ={ 
					action:'edt_ftp_setting',
					ftp_id:inArray
				}	
				doJava.Load('span_top_nav');
			}
		  }
		  else { alert('Please select rows !'); }
	}
		
/* ** delete **/	
	
	var FTP_delete = function()
		{
				var inResultCheck = doJava.checkedValue('ftp_id');
				if( inResultCheck!='')
				{
					if(confirm('Do you want to delete this FTP Config ?'))
					{
						doJava.File = '../class/class.config.readftp.php' 
						doJava.Params = {
							action:'del_ftp_setting',
							ftp_id: inResultCheck
						}
						var error = doJava.eJson();
							if( error.result)
							{
								alert("Success, Deleting Read Config ! ");
								extendsJQuery.postContent();
							}
							else{ 
								alert("Failed, Deleting Read Config!"); 
								return false; 
							}
					}	
				}
				else{
					alert("Please select a row!")
				}
		}
		
/* update FTP ****/
		
		var FTP_Update = function()
		{
			var ftp_id = doJava.dom('ftp_id').value; 
			var ftp_read_directory = doJava.dom('ftp_read_directory').value; 
			var ftp_read_filetype = doJava.dom('ftp_read_filetype').value; 
			var ftp_read_ctltype = doJava.dom('ftp_read_ctltype').value;
			var ftp_read_dir_history = doJava.dom('ftp_read_dir_history').value;
			var ftp_read_mode = doJava.dom('ftp_read_mode').value;
			var ftp_read_action = doJava.dom('ftp_read_action').value;
			var minute = doJava.dom('minute').value;
			var hour =  doJava.dom('hour').value;
			var days = doJava.dom('days').value;
			var month = doJava.dom('month').value;
			var weeks = doJava.dom('weeks').value;
			
			
		/*  settup get varibel FTP ****/
		
			if( ftp_read_directory=='' ) { alert("In/Out Directory is empty!"); return false; }
			else if( ftp_read_filetype=='' ) { alert("Read/Create File is empty !"); return false; }
			else if( ftp_read_ctltype=='' ) { alert("Control File is empty!"); return false; }
			else if( ftp_read_dir_history=='' ) { alert("Mode  is empty!"); return false; }
			else if( ftp_read_mode=='' ) { alert("Schedule File is empty!"); return false; }
			else if( ftp_read_action=='' ) { alert("Schedule File is empty !"); return false; }
			else if( minute=='' ) { alert("Minute is empty !"); return false; }
			else if( hour=='' ) { alert(" Hour is empty!"); return false; }
			else if( days=='' ) { alert(" Days is empty!"); return false; }
			else if( month=='' ) { alert(" Monthis empty!"); return false; }
			else if( weeks=='' ) { alert(" Weeks is empty!"); return false; }
			
			else
			{
				doJava.File = '../class/class.config.readftp.php'; 
				doJava.Params ={
					action:'upd_ftp_setting',
					ftp_id : ftp_id,
					ftp_read_directory : ftp_read_directory, 
					ftp_read_filetype : ftp_read_filetype, 
					ftp_read_ctltype : ftp_read_ctltype,
					ftp_read_dir_history : ftp_read_dir_history,
					ftp_read_mode : ftp_read_mode,
					ftp_read_action : ftp_read_action, 
					minute: minute, hour : hour, 
					days : days, month : month, 
					weeks : weeks 
				}
					var error = doJava.eJson();
					if( error.result)
					{
						alert("Success, Update FTP Config !");
						extendsJQuery.postContent();
					}
					else{
						alert("Failed, Update FTP Config !");
						return false;
					}
			}
		}
		
/*  save activity ftp config ***/
var FTP_save = function()
{	
	var ftp_read_directory = doJava.dom('ftp_read_directory').value; 
	var ftp_read_filetype = doJava.dom('ftp_read_filetype').value; 
	var ftp_read_ctltype = doJava.dom('ftp_read_ctltype').value;
	var ftp_read_dir_history = doJava.dom('ftp_read_dir_history').value;
	var ftp_read_mode = doJava.dom('ftp_read_mode').value;
	var ftp_read_action = doJava.dom('ftp_read_action').value;
	var minute = doJava.dom('minute').value;
	var hour =  doJava.dom('hour').value;
	var days = doJava.dom('days').value;
	var month = doJava.dom('month').value;
	var weeks = doJava.dom('weeks').value;
			
			
		/*  settup get varibel FTP ****/
		
			if( ftp_read_directory=='' ) { alert("In/Out Directory is empty!"); return false; }
			else if( ftp_read_filetype=='' ) { alert("Read/Create File is empty !"); return false; }
			else if( ftp_read_ctltype=='' ) { alert("Control File is empty!"); return false; }
			else if( ftp_read_dir_history=='' ) { alert("Mode  is empty!"); return false; }
			else if( ftp_read_mode=='' ) { alert("Schedule File is empty!"); return false; }
			else if( ftp_read_action=='' ) { alert("Schedule File is empty !"); return false; }
			else if( minute=='' ) { alert("Minute is empty !"); return false; }
			else if( hour=='' ) { alert(" Hour is empty!"); return false; }
			else if( days=='' ) { alert(" Days is empty!"); return false; }
			else if( month=='' ) { alert(" Monthis empty!"); return false; }
			else if( weeks=='' ) { alert(" Weeks is empty!"); return false; }
			
			else
			{
				doJava.File = '../class/class.config.readftp.php'; 
				doJava.Params ={
					action:'sav_ftp_setting',
					ftp_read_directory : ftp_read_directory, 
					ftp_read_filetype : ftp_read_filetype, 
					ftp_read_ctltype : ftp_read_ctltype,
					ftp_read_dir_history : ftp_read_dir_history,
					ftp_read_mode : ftp_read_mode,
					ftp_read_action : ftp_read_action, 
					minute: minute, hour : hour, 
					days : days, month : month, 
					weeks : weeks 
				}
					var error = doJava.eJson();
					if( error.result)
					{
						alert("Success, Save FTP Config !");
						extendsJQuery.postContent();
					}
					else{
						alert("Failed, Save FTP Config !");
						return false;
					}
			}
}		
</script>
<!-- start : content -->
<fieldset class="corner">
 <legend class="icon-callresult">&nbsp;&nbsp;<span id="legend_title"></span></legend>	
 <div id="toolbars"></div>
 <div id="span_top_nav"></div>
 <div class="content_table"></div>
 <div id="pager"></div>
 <div id="ViewCmp"></div>
</fieldset>	
	
<!-- stop : content -->
	
	
	