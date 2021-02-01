<?php echo javascript(); ?>
<script type="text/javascript">

Ext.document('document').ready( function(){
	Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
}); 

// Ext.DOM.SetHide
Ext.DOM.SetHide = function(box) {
var Action = ( box.checked ? 'Save' : 'Delete');
  Ext.Ajax 
  ({
	 url 	 : Ext.DOM.INDEX+'/ManageDatabase/'+Action,
	 method  : 'POST',
	 param   :{ 
		table_field_name : box.value, 
		table_name 		 : Ext.Cmp('schema').getValue()
	},
	 ERROR 	 : function(e){
		Ext.Util(e).proc(function(items){
			if( items.success ){
				//Ext.Msg(items.msg).Success();
			}
			else{
				//Ext.Msg(items.msg).Failed();
			}
		});
	 }	
  
  }).post()		
}


Ext.DOM.SetHideOnLevel = function(box)
{
	var Action = ( box.checked ? 'Save' : 'Delete');
	Ext.Ajax 
	({
	 url 	 : Ext.DOM.INDEX+'/ManageDatabase/'+Action,
	 method  : 'POST',
	 param   :{ 
		table_field_name : Ext.Cmp('schema').getValue(), 
		table_name 		 : box.value
	},
	 ERROR 	 : function(e){
		Ext.Util(e).proc(function(items){
			if( items.success ){
				//Ext.Msg(items.msg).Success();
			}
			else{
				//Ext.Msg(items.msg).Failed();
			}
		});
	 }	
  
  }).post();	
}


// Ext.DOM.BackToDatabase()

Ext.DOM.BackToDatabase = function(){
	Ext.System.view_name_url('Database Monitoring');
	Ext.EQuery.Ajax
	({
		url 	: Ext.Cmp('ControllId').getValue(),
		method 	: 'GET',
		param 	: {
			time : Ext.Date().getDuration()
		}
	});
}

// BackupTable

Ext.DOM.BackupTable = function(){
	Ext.Window({
		url :Ext.DOM.INDEX+"/DatabaseMonitoring/BackupTable/",
		param:{
			table : Ext.Cmp('schema').getValue()
		}
	}).newtab();
}

</script> 	
<fieldset class="corner">
<legend class="icon-customers">&nbsp;&nbsp;<span id="legend_title"></span></legend>
<div>
<?php echo form()->hidden('schema',null,$param['database']);?>
<?php echo form()->hidden('ControllId',null,$param['ControllId']);?>
 <table border=0>
	<tr>
		<td valign="top"><?php $this -> load->view('mod_manage_database/view_database_fields');?></td>
		<td valign="top"><?php $this -> load->view('mod_manage_database/view_database_schema');?></td>
		<td valign="top"><?php $this -> load->view('mod_manage_database/view_database_levels');?></td>
	</tr>
 </table>
</div>
</fieldset>