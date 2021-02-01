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
		
var datas = { 
	keywords : '<?php echo _get_post('keywords'); ?>',
	order_by : '<?php echo _get_post('order_by'); ?>',
	type 	 : '<?php echo _get_post('type'); ?>',
}
 
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 		
$(function(){
	$('#toolbars').extToolbars({
		extUrl   : Ext.DOM.LIBRARY+'/gambar/icon',
		extTitle :[['Add'],['Edit'],['Delete'],['Search']],
		extMenu  :[['Add'],['Edit'],['Delete'],['Search']],
		extIcon  :[['add.png'],['application_edit.png'],['delete.png'],['zoom.png']],
		extText  :true,
		extInput :true,
		extOption: [{
			render	: 3,
			type	: 'text',
			id		: 'keywords', 	
			name	: 'keywords',
			value	: datas.keywords,
			width	: 200
		}]
	});
});


Ext.EQuery.TotalPage   = <?php echo (INT)$page -> _get_total_page(); ?>;
Ext.EQuery.TotalRecord = <?php echo (INT)$page -> _get_total_record(); ?>;
	
/* assign navigation filter **/
var navigation = {
	custnav	 : Ext.DOM.INDEX +'/CtiCCSetting/index/',
	custlist : Ext.DOM.INDEX +'/CtiCCSetting/content/',
}
		
/* assign show list content **/

Ext.EQuery.construct(navigation,datas)
Ext.EQuery.postContentList();


// Search

Ext.DOM.Search = function(){
  Ext.EQuery.construct(navigation,{
	keywords : Ext.Cmp('keywords').getValue()
  });
  Ext.EQuery.postContent();
}

// cancelResult
		
var cancelResult = function(){
	Ext.Cmp('top-panel').setText("");
}


// Edit

Ext.DOM.Edit = function(){
	Ext.Ajax
	({
		url    : Ext.DOM.INDEX +"/CtiCCSetting/Edit/",
		method : "GET",
		param  : {
			Id : Ext.Cmp('chk_skill').getValue(),
			time : '<?php echo time(); ?>' 
		}
	}).load("top-panel");
}


// AddScript

Ext.DOM.Add = function(){
	Ext.Ajax
	({
		url    : Ext.DOM.INDEX +"/CtiCCSetting/Add/",
		method : "GET",
		param  : {
			time : '<?php echo time(); ?>' 
		}
	}).load("top-panel");
}

//Delete
		
Ext.DOM.Delete = function()
{
	var Id = Ext.Cmp('chk_skill').getValue();
	if(Ext.Cmp('chk_skill').empty()!=true)
	{
		if( Ext.Msg("Do you want delete this rows").Confirm() )
		{
			Ext.Ajax({
				url 	: Ext.DOM.INDEX+'/CtiCCSetting/Delete/',
				method 	:'POST',
				param 	: { Id : Id },
				ERROR : function(e){
					var ERR = JSON.parse(e.target.responseText);
					if( ERR.success ) {
						Ext.Msg("Delete CC Setting").Success();
						Ext.EQuery.postContent();
					}
					else{
						Ext.Msg("Delete CC Setting").Failed();
						return false;
					}
				}
			}).post();
		}
	}
	else{
		Ext.Msg("Please select Rows").Error();
	}
}

//Delete
		
Ext.DOM.Save = function() {
  Ext.Ajax 
  ({
		url 	: Ext.DOM.INDEX+ '/CtiCCSetting/Save/',
		method 	:'POST',
		param 	: Ext.Join([Ext.Serialize('frmAddReasonType').getElement()]).object(),
		ERROR : function(e) {
			Ext.Util(e).proc(function(save){
				if( save.success){
					Ext.Msg("Save CC Setting").Success();
					Ext.EQuery.postContent();
				}
				else{
						Ext.Msg("Save CC Setting").Failed();	
				}	
			});
		}	
	}).post();
}


//Delete
		
Ext.DOM.Update = function() {
	Ext.Ajax 
	({
		url 	: Ext.DOM.INDEX+ '/CtiCCSetting/Update/',
		method 	:'POST',
		param 	: Ext.Join([Ext.Serialize('frmEditReasonType').getElement()]).object(),
		ERROR : function(e) {
			Ext.Util(e).proc(function(Update){
				if( Update.success){
					Ext.Msg("Update CC Setting").Success();
					Ext.EQuery.postContent();
				}
				else{
					Ext.Msg("Update CC Setting").Failed();	
				}	
			});
		}	
	}).post();
}
		
</script>
	
	<!-- start : content -->
	<fieldset class="corner">
			<legend class="icon-menulist">&nbsp;&nbsp;<span id="legend_title"></span> </legend>	
				<div id="toolbars"></div>
				<div id="top-panel"></div>
				<div class="content_table"></div>
				<div id="pager"></div>
		</fieldset>	
		
	<!-- stop : content -->
	
	
	
