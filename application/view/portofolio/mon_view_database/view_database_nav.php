<?php echo javascript(); ?>
<script type="text/javascript">

/**
 ** javscript prototype system
 ** version v.0.1
 **/
var datas = { keyword : '<?php __(_get_post('keyword'));?>' };
 
Ext.DOM.onload = (function(){
	Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
 })();
 
 
Ext.EQuery.TotalPage   = '<?php echo (INT)$pages;?>';
Ext.EQuery.TotalRecord = '<?php echo (INT)$records; ?>';
 
/* assign navigation filter **/
var navigation = {
	custnav	 : Ext.DOM.INDEX +'/DatabaseMonitoring/index/',
	custlist : Ext.DOM.INDEX +'/DatabaseMonitoring/content/',
}
		
// Ext.DOM.ClearResult
// Ext.DOM.ClearResult


Ext.EQuery.construct(navigation,datas)
Ext.EQuery.postContentList();
 
 

// manage database_edit 
 
Ext.DOM.Manage = function()
{
  var chklist = Ext.Cmp('chk_db').getValue();	
  if( chklist.length==1 ) 
  {
     Ext.System.view_name_url('Manage Table : <b>'+ chklist+'</b>'); // set title legend 
	 Ext.EQuery.Ajax
	 ({
		url 	: Ext.DOM.INDEX +'/ManageDatabase/index/',
		method  :'GET',
		param	: 
		{
			database : chklist,
			ControllId : Ext.DOM.INDEX +'/DatabaseMonitoring/index/'
		}
	 });	
  }
  else
  {
	Ext.Msg("Please select a rows ").Info();
	return false;
  }
  
}

// Backup
Ext.DOM.Backup = function(){
 if((Ext.Session('HandlingType').getSession() == Ext.DOM.USER_SYSTEM_LEVEL) ) 
 {
	Ext.Window
	({
		url : Ext.DOM.INDEX +'/DatabaseMonitoring/Backup/',
		method :'GET',
		param :{
			time:Ext.Date().getDuration()
		}
	}).newtab();
 }
 else{
	Ext.Msg("You not have aksess ").Info();
 }  
}

// Ext OptionsBackup

Ext.DOM.OptionsBackup = function(){
	Ext.Ajax({
		url : Ext.DOM.INDEX +'/DatabaseMonitoring/ViewOptions/',
		param :{
			time : Ext.Date().getDuration()
		}	
	}).load("span_top_nav");
	
	Ext.DOM.loadList();
}

// Ext.DOM.RemoveOptionBackup()

Ext.DOM.RemoveOptionBackup = function(){
	var listTables = Ext.Cmp("list_tables").getValue();
	Ext.Ajax ({
			url : Ext.DOM.INDEX +'/DatabaseMonitoring/DellOptionsList/',
			param :{
				table : listTables,
				time : Ext.Date().getDuration()
			},
			ERROR : function(e){
				Ext.Util(e).proc(function(del){
					if( del.success ){ }
					Ext.DOM.loadList();
					Ext.Cmp("list_tables").setChecked();
				});
			}
		}).post();
		
}

// Ext.DOM.loadList

Ext.DOM.loadList = function(){
	Ext.Ajax 
	({
		url : Ext.DOM.INDEX +'/DatabaseMonitoring/viewOptionsList/',
		param :{ time : Ext.Date().getDuration() },
	}).load("lstId");
}

// Ext.DOM.SaveOptionBackup()

Ext.DOM.SaveOptionBackup = function(){
	if(Ext.Cmp('fileNameBackup').empty()){
		Ext.Msg("Please input file Name ").Info();
		return false;
	}
	else{
		Ext.Window
		({
			url : Ext.DOM.INDEX +'/DatabaseMonitoring/OtionsBackup/',
			method :'GET',
			param :{
				time	: Ext.Date().getDuration(),
				name 	: Ext.Cmp('fileNameBackup').getValue(),
				table 	: Ext.Cmp("list_tables").getValue()
			}
		}).newtab();
	}
}

// Ext.DOM.AddOptionBackup

Ext.DOM.AddOptionBackup = function(){
	 var chklist = Ext.Cmp('chk_db').getValue();	
	 if( chklist ) 
	 {
		Ext.Ajax ({
			url : Ext.DOM.INDEX +'/DatabaseMonitoring/AddOptionsList/',
			param :{
				table : chklist,
				time : Ext.Date().getDuration()
			},
			ERROR : function(e){
				Ext.Util(e).proc(function(add){
					if( add.success ){ }
					Ext.DOM.loadList();
					Ext.Cmp("list_tables").setChecked();
				});
			}
		}).post();
	 }
}

Ext.DOM.EmptyTable = function(){
	var chklist = Ext.Cmp('chk_db').getValue();	
	if((chklist!='')) {
	
	 if( Ext.Msg("Recomended for backup before empty this table.\nDo You want to empty this table.. ?").Confirm() )
	 {
		Ext.Ajax
		({
			url : Ext.DOM.INDEX +'/DatabaseMonitoring/EmptyTable/',
			method : 'POST',
			param :{
				table : chklist,
				time : Ext.Date().getDuration()
			},
			ERROR : function(e){
				Ext.Util(e).proc(function(add){
					if( add.success ){ 
						Ext.Msg("Empty Table").Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg("Empty Table").Failed();
					}
				});
			}
		}).post();
	  }	
	}
	else{
		Ext.Msg("Please select a rows ").Info();
	}
}

/* ready function **/
 
Ext.query(function(){
if( Ext.Session('HandlingType').getSession() == Ext.DOM.LEVEL.USER_ROOT ) {
	var EXT_TITLE  = [['Backup'],['Options Backup'],['Empty Table'],['Manage'],['Search']];
	var EXT_MENU   = [['Backup'],['OptionsBackup'],['EmptyTable'],['Manage'],['SearchConfig']];
	var EXT_ICON   = [['database_save.png'],['database_save.png'],['table_delete.png'],['database_edit.png'],['zoom.png']];
	var EXT_RENDER = 4;
}
else{
	var EXT_TITLE = [['Backup'],['Options Backup'],['Search']];
	var EXT_MENU  = [['Backup'],['OptionsBackup'],['SearchConfig']];
	var EXT_ICON  = [['database_save.png'],['database_save.png'],['zoom.png']];
	var EXT_RENDER = 2;
}

Ext.query('#toolbars').extToolbars
({
    extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
	extTitle : EXT_TITLE,
	extMenu  : EXT_MENU,
	extIcon  : EXT_ICON,
	extText  : true,
	extInput : true,
	extOption: [{
		render	: EXT_RENDER,
		type	: 'text',
		id		: 'KeysConfig', 	
		name	: 'KeysConfig',
		value	: datas.keyword,
		width	: 200
	}]
  });

});


Ext.DOM.SearchConfig = function() {
	Ext.EQuery.construct(navigation,{keyword : Ext.Cmp('KeysConfig').getValue() });
	Ext.EQuery.postContent();
}
 
		
		
</script> 
<!-- start : content -->
<fieldset class="corner">
	<legend class="icon-application">&nbsp;&nbsp;<span id="legend_title"></span> </legend>	
 <div id="toolbars"></div>
 <div id="span_top_nav"></div>
 <div class="content_table" id="pagelist"></div>
 <div id="pager"></div>
</fieldset>	
		
	<!-- stop : content -->
	