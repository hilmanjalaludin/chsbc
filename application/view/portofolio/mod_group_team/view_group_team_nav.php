<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *  @ def   : mod_view_field/view_setfield_nav.php 
 * -------------------------------------------------------------------------
 *  @ param : unit layout attribute navigation 
 *  @ param : - 
 * -------------------------------------------------------------------------
 */
 
/* load all js default **/

__(javascript(array( 
	array('_file' => base_jquery().'/plugins/extToolbars.js', 'eui_'=>'1.0.0', 'time'=>time()),
	array('_file' => base_jquery().'/plugins/Paging.js', 'eui_'=>'1.0.0', 'time'=>time()),
	array('_file' => base_enigma().'/helper/EUI_Dialog.js', 'eui_'=>'1.0.0', 'time'=>time()))));

?>

<script type="text/javascript"> 

Ext.document('document').ready(function(){

/* load : title every controller */

 Ext.Cmp('legend_title').setText(Ext.System.view_file_name());

/*
 * @ def  : set attribute page 
 * -----------------------------------------------------------------
 * 
 * @ param : - 
 * @ param : -
 * ----------------------------------------------------------------
 */ 

 Ext.DOM.datas = { 
	keywords : '<?php echo _get_post('keywords'); ?>',
	order_by : '<?php echo _get_post('order_by'); ?>',
	type 	 : '<?php echo _get_post('type'); ?>',
 }

 Ext.EQuery.TotalPage   = <?php echo (INT)$page -> _get_total_page(); ?>;
 Ext.EQuery.TotalRecord = <?php echo (INT)$page -> _get_total_record(); ?>;
 
 Ext.DOM.Page = {
	custnav	 : Ext.DOM.INDEX +'/SetGroupTeam/index/',
	custlist : Ext.DOM.INDEX +'/SetGroupTeam/Content/',
}

/*
 * @ def  : loading Ext libs js on Ready 
 * -----------------------------------------------------------------
 * 
 * @ param : - 
 * @ param : -
 * ----------------------------------------------------------------
 */ 
 
 Ext.EQuery.construct(Ext.DOM.Page, Ext.DOM.datas);
 Ext.EQuery.postContentList();
 
/*
 * @ def  : loading Ext libs js on Ready 
 * -----------------------------------------------------------------
 * 
 * @ param : - 
 * @ param : -
 * ----------------------------------------------------------------
 */ 
	
/*
 * @ def  : loading extToolbars jQuery plugin  
 * -----------------------------------------------------------------
 * 
 * @ param : - 
 * @ param : -
 * ----------------------------------------------------------------
 */ 
 	
 Ext.query('#toolbars').extToolbars 
 ({
	extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
	extTitle :[['Add'],['Edit'],['User'],['Delete'],['View'],['Search']],
	extMenu  :[['AddViewLayout'],['EditViewLayout'],['Capacity'],['Delete'],['View'],['Search']],
	extIcon  :[['add.png'],['application_edit.png'],['user_add.png'],['delete.png'],['zoom.png'],['zoom.png']],
	extText  :true,
	extInput :true,
	extOption: [{
			render	: 5,
			type	: 'text',
			id		: 'keywords', 	
			name	: 'keywords',
			value	: Ext.DOM.datas.keywords,
			width	: 200
		}]
 });

 
Ext.DOM.Search = function(){
	Ext.EQuery.construct(Ext.DOM.Page, { keywords :  Ext.Cmp('keywords').getValue() });
	Ext.EQuery.postContent();
 
}


Ext.DOM.Capacity = function(){

if(Ext.Cmp('GroupId').empty()){
	Ext.Msg('Please Select Group Team').Info();
}
else
{
	Ext.EQuery.Ajax
	({
		url 	: Ext.DOM.INDEX+'/SetGroupTeam/UserCapacity/',
		method 	: 'GET',
		param 	: 
		{
			GroupId : Ext.Cmp('GroupId').getValue(),
			ControllerId : Ext.DOM.INDEX +'/SetGroupTeam/index/'
		}
	});
  }	
} 
 
/*
 * @ def  : loading Ext libs js on Ready 
 * -----------------------------------------------------------------
 * 
 * @ param : - 
 * @ param : -
 * ----------------------------------------------------------------
 */ 
 
Ext.DOM.EditViewLayout = function(){

if(Ext.Cmp('GroupId').empty()){
	Ext.Msg('Please Select Group Team').Info();
}
else
{
	Ext.Ajax
	({
		url 	: Ext.DOM.INDEX+'/SetGroupTeam/EditGroupTeam/',
		method 	: 'GET',
		param 	: {
			GroupId : Ext.Cmp('GroupId').getValue()
		}
	}).load("top-panel-content");
}	
}

 
/*
 * @ def  : loading Ext libs js on Ready 
 * -----------------------------------------------------------------
 * 
 * @ param : - 
 * @ param : -
 * ----------------------------------------------------------------
 */ 
Ext.DOM.AddViewLayout = function(){
Ext.Ajax
({
	url 	: Ext.DOM.INDEX+'/SetGroupTeam/AddGroupTeam/',
	method 	: 'GET',
	param 	: {
		time : Ext.Date().getDuration()
	}
}).load("top-panel-content");
}


/* SaveAddGroupTeam **/

Ext.DOM.SaveAddGroupTeam  = function() {
	var conds = Ext.Serialize('frmAddGroupTeam').Complete();
	if( conds ) {
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX+'/SetGroupTeam/SaveAddGroupTeam/',
			method 	:'POST',
			param 	: Ext.Join([Ext.Serialize('frmAddGroupTeam').getElement() ]).object(),
			
			ERROR : function(e){
				Ext.Util(e).proc(function(response){
					if( response.success ) {
						Ext.Msg("Save Add Group Team ").Success();
						Ext.EQuery.postContent();	
					}
					else{
						Ext.Msg("Save Add Group Team ").Failed();
					}
				});
			}
				
		}).post();
	}
}	



/* Ext.DOM.SaveEditGroupTeam  **/

Ext.DOM.SaveEditGroupTeam  = function() {
	var conds = Ext.Serialize('frmEditGroupTeam').Complete();
	if( conds ) {
		Ext.Ajax
		({
			url 	: Ext.DOM.INDEX+'/SetGroupTeam/SaveEditGroupTeam/',
			method 	:'POST',
			param 	: Ext.Join([Ext.Serialize('frmEditGroupTeam').getElement() ]).object(),
			
			ERROR : function(e){
				Ext.Util(e).proc(function(response){
					if( response.success ) {
						Ext.Msg("Save Edit Group Team ").Success();
						Ext.EQuery.postContent();	
					}
					else{
						Ext.Msg("Save Edit Group Team ").Failed();
					}
				});
			}
				
		}).post();
	}
}	


/*
 * @ def  : loading Ext libs js on Ready 
 * -----------------------------------------------------------------
 * 
 * @ param : - 
 * @ param : -
 * ----------------------------------------------------------------
 */ 

Ext.DOM.ViewLayoutGenerate = function( n ){
	Ext.Ajax({
		url		: Ext.DOM.INDEX+'/SetField/ViewLayoutGenerate/',
		method 	: 'GET',
		param 	: {
			view_field_size : n
		}
	}).load("field_generator");
}


/*
 * @ def  : loading Ext libs js on Ready 
 * -----------------------------------------------------------------
 * 
 * @ param : - 
 * @ param : -
 * ----------------------------------------------------------------
 */ 
 
Ext.DOM.Delete = function(){
if(Ext.Cmp('GroupId').empty()){
	Ext.Msg('Please Select Group Team').Info();
}
else
{
	if(Ext.Msg("Do you want to delete this Group Team").Confirm() ){
		Ext.Ajax ({
			url		: Ext.DOM.INDEX+'/SetGroupTeam/DeleteGroupTeam/',
			method 	: 'POST',
			param 	: {
				GroupId : Ext.Cmp('GroupId').getValue()
			},
			ERROR 	: function(e){
				Ext.Util(e).proc(function( items ) {
				if( items.success ) {
					Ext.Msg('Delete Group Team ').Success(); // alert callback 
					Ext.EQuery.postContent(); // reload
				}
				else{
					Ext.Msg('Delete Group Team').Failed();
				}});
			}
		}).post();	
	}	
 }	
}
/*
 * @ def  : loading Ext libs js on Ready 
 * -----------------------------------------------------------------
 * 
 * @ param : - 
 * @ param : -
 * ----------------------------------------------------------------
 */ 

Ext.DOM.View = function(){
if(Ext.Cmp('GroupId').empty()){
	Ext.Msg('Please Select Group Team').Info();
}
else
{
	Ext.Window({
		url 	: Ext.DOM.INDEX+'/SetGroupTeam/ViewGroupTeam/',
		width 	: 400, scrollbars : 1, 
		scrolling: 1, height  : 400,
		param 	: {
			GroupId : Ext.Cmp('GroupId').getValue(),
		}	
	}).popup();
}
	
}	
}); 

</script>
<fieldset class="corner">
<legend class="icon-menulist">&nbsp;&nbsp;<span id="legend_title"></span> </legend>	
	<div id="toolbars"></div>
		<div id="top-panel-content"></div>
		<div class="content_table"></div>
	<div id="pager"></div>
</fieldset>	
		
		