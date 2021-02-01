<?php echo javascript(); ?>
<script type="text/javascript">
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 Ext.DOM.onload= (function(){
	Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
 })()
 	
	
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.datas = {
	order_by : "<?php echo _get_post('order_by');?>",
	type	 : "<?php echo _get_post('type');?>",
	keywords : "<?php echo _get_post('keywords');?>",
}
 	
$('#v_cmp_user').datepicker();
	
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
$(function(){
	$('#toolbars').extToolbars({
		extUrl  : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle:[['Add'],['Remove'],['Edit Agent'],['Cancel'],[],['Search']],
		extMenu :[['AddPrivileges'],['RemovePrivileges'],['EditPrivileges'],['CancelData'],[],['searchAgent']],
		extIcon :[['add.png'],['cross.png'],['group_edit.png'],['cross.png'],[],['zoom.png']],
		extText :true,
		extInput:true,
		extOption:[{
						render	: 4,
						type	: 'text',
						id		: 'v_cmp_user', 	
						name	: 'v_cmp_user',
						value	: Ext.DOM.datas.keywords,
						width	: 120
					}]
	});
	
	
});
	
	var load_images_id = Ext.Cmp('load_images_id');

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
 var _content_page = {
	custnav  : Ext.DOM.INDEX+'/SysPrivileges/index',
	custlist : Ext.DOM.INDEX+'/SysPrivileges/Content'			
 }	
	
Ext.EQuery.construct(_content_page, Ext.DOM.datas);
Ext.EQuery.postContentList();

	
/** 
 ** default generator scripts
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.RemovePrivileges = function()
 {
	var PrivilegeId = Ext.Cmp('chk_privileges').getValue();
	if( PrivilegeId !='')
	{
	  if( confirm('Do you want to remove this user ?') ) 
	  {	
		Ext.Ajax({
			url 	: Ext.DOM.INDEX+'/SysPrivileges/DeletePrivileges/',
			method 	: 'POST',
			param 	: { PrivilegeId  : PrivilegeId  },
			ERROR	: function(fn) {
				try
				{
					var ERROR = JSON.parse(fn.target.responseText);
					if( ERROR.success )
					{
						Ext.Msg('Remove User').Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg('Remove User').Failed();
					}
				}
				catch(e){
					Ext.Msg(e).Error();
				}
			}	
		}).post();
	  }	
	}	
	else{
		alert('Please select rows..!'); return false;
	}
}
	
Ext.DOM.CancelData = function(){
	Ext.Cmp('add-panel-data').setText('');
}	
/** 
 ** default generator scripts
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.AddPrivileges = function()
{
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX +'/SysPrivileges/AddPrivileges/',
		method 	: 'GET',
		param 	: {
			duration : Ext.Date().getDuration()
		}
	}).load('add-panel-data');
}

// UpdatePrivileges

Ext.DOM.UpdatePrivileges = function()
{
	if( Ext.Cmp('name').empty() ){ 
		Ext.Msg("Privilege Name is empty ").Info(); }	
	else
	{
		if( Ext.Msg("Do you want to update this data ").Confirm() )
		{
			Ext.Ajax({
				url : Ext.DOM.INDEX +'/SysPrivileges/UpdatePrivileges/',
				method :'POST',
				param : {
					id : Ext.Cmp('id').getValue(),
					name : Ext.Cmp('name').getValue(),
					updated_by : Ext.Cmp('updated_by').getValue(),
					last_update : Ext.Cmp('last_update').getValue(),
					IsActive : Ext.Cmp('IsActive').getValue()
				},
				ERROR : function(fn){
					try
					{
						var ERR = JSON.parse(fn.target.responseText);
						if( ERR.success){
							Ext.Msg("Update Privileges").Success();
							Ext.EQuery.postContent();
						}
						else{
							Ext.Msg("Update Privileges").Failed();
						}
					}
					catch(e){
						Ext.Msg(e).Error();
					}
				}
			
			}).post();
		}	
  }
  
}


// save privileges 

Ext.DOM.SavePrivileges = function()
{
	if( Ext.Cmp('name').empty() ){ 
		Ext.Msg("Privilege Name is empty ").Info(); }	
	else
	{
		if( Ext.Msg("Do you want to save this data ").Confirm() )
		{
			Ext.Ajax({
				url : Ext.DOM.INDEX +'/SysPrivileges/SavePrivileges/',
				method :'POST',
				param : {
					name : Ext.Cmp('name').getValue(),
					updated_by : Ext.Cmp('updated_by').getValue(),
					last_update : Ext.Cmp('last_update').getValue(),
					IsActive : Ext.Cmp('IsActive').getValue()
				},
				ERROR : function(fn){
					try
					{
						var ERR = JSON.parse(fn.target.responseText);
						if( ERR.success){
							Ext.Msg("Save Add Privileges").Success();
							Ext.EQuery.postContent();
						}
						else{
							Ext.Msg("Save Add Privileges").Failed();
						}
					}
					catch(e){
						Ext.Msg(e).Error();
					}
				}
			
			}).post();
		}	
  }
  
}
/** 
 ** default generator scripts
 ** javscript prototype system
 ** version v.0.1
 **/
 
var EditPrivileges = function() 
{
	var PrivilegeId = Ext.Cmp('chk_privileges').getValue();
	if( PrivilegeId.length==1)
	{
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX+'/SysPrivileges/EditPrivileges/',
			method 	: 'POST',
			param 	: { 	
				PrivilegeId  : PrivilegeId  
			}
		}).load('add-panel-data');
	}	
	else{
		alert('Please select rows..!'); return false;
	}
}

/** 
 ** default generator scripts
 ** javscript prototype system
 ** version v.0.1
 **/
 
 Ext.DOM.searchAgent = function()
 {
	Ext.EQuery.construct( _content_page, {
		keywords : Ext.Cmp('v_cmp_user').getValue()
	})
	Ext.EQuery.postContent();
}

</script>
	<fieldset class="corner" style="background-color:white;">
	<legend class="icon-userapplication">&nbsp;&nbsp;<span id="legend_title"></span></legend>
		<div id="toolbars" class="toolbars"></div>
		<div id="add-panel-data"></div>
		<div class="content_table"></div>
		<div id="pager"></div>
	</fieldset>	
	
<!-- END OF FILE  -->
<!-- location : // ../application/layout/view_user_nav/welcome.php -->
	