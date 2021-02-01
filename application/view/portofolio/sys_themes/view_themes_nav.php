<?php echo javascript(); ?>
<script type="text/javascript">
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.onload= (function(){
	Ext.Cmp('legend_title').setText( Ext.System.view_file_name());
 })();
 
/**
 ** javscript prototype system
 ** version v.0.1
 **/
  
var saveThemes = function()
{
  if( confirm('Do you want to Change Themes') ){
	Ext.Ajax({
		url		: Ext.DOM.INDEX+'/SysThemes/SaveThemes',
		method	: 'POST',
		param :{
			themes_value: Ext.Cmp('themes_active').getValue(),
		},
		ERROR : function(e){
			var ERROR = JSON.parse(e.target.responseText);
			if( ERROR.success ){
				alert("Success, Change Web Themes !");
				if( confirm('Do you want reload page !')){
					window.document.location = Ext.DOM.INDEX+'/main';
				}	
			}
		}
	}).post();
  }	
}	
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.AddLayout = function(){
	Ext.Ajax
	({
		url	  : Ext.DOM.INDEX+'/SysThemes/AddLayout/',
		param : {
			time : Ext.Date().getDuration()
		}
	}).load('panel-content');
}
/**
 ** javscript prototype system
 ** version v.0.1
 **/
 
Ext.DOM.EditLayout = function()
{
 var LayoutId = Ext.Cmp('LayoutId').getValue();
 if( LayoutId.length==1)
 {	
	Ext.Ajax
	({
		url	  : Ext.DOM.INDEX+'/SysThemes/EditLayout/',
		
		param : {
			LayoutId : LayoutId,
			time : Ext.Date().getDuration()
		}
	}).load('panel-content');
 }
 
}


Ext.DOM.UpdateLayout = function(){
	
	Ext.Ajax
	({
		url	   : Ext.DOM.INDEX+'/SysThemes/UpdateLayout/',
		method :'POST',
		param  : Ext.Join([Ext.Serialize('frmEditLayout').getElement()]).object(),
		ERROR  : function(e)
		{
			Ext.Util(e).proc(function(update){
				if( update.success ){
					Ext.Msg("Update Layout").Success();
					Ext.EQuery.Ajax
					({
						url 	: Ext.DOM.INDEX +"/SysThemes/index/",
						param 	: { 
							time : Ext.Date().getDuration()
						}
					});
				}
				else{
					Ext.Msg("Update Layout").Failed();
				}
			});
		}		
	}).post();
}


Ext.DOM.SaveLayout = function(){
	
	if( Ext.Cmp('LayoutName').empty()) {
		Ext.Msg("Layout Name is empty").Info();
	}
	else if( Ext.Cmp('LayoutAuthor').empty()) {
		Ext.Msg("Layout Author is empty").Info();
	}
	else if( Ext.Cmp('LayoutDesc').empty()) {
		Ext.Msg("Layout Description is empty").Info();
	}
	else
	{
		Ext.Ajax ({
			url	   : Ext.DOM.INDEX+'/SysThemes/SaveLayout/',
			method :'POST',
			param  : 
			{
				Name 		: Ext.Cmp('LayoutName').getValue(),
				Description : Ext.Cmp('LayoutDesc').getValue(),
				Author 		: Ext.Cmp('LayoutAuthor').getValue(),
				Flags 		: 1
			},
			ERROR : function(e){
				Ext.Util(e).proc(function(save){
					if( save.success ){
						Ext.Msg("Save Layout").Success();
						Ext.EQuery.Ajax
						({
							url 	: Ext.DOM.INDEX +"/SysThemes/index/",
							param 	: { 
								time : Ext.Date().getDuration()
							}
						});
					}
					else{
						Ext.Msg("Save Layout").Failed();
					}
				});
			}
		}).post();
	}
}

Ext.DOM.DisableLayout= function(){
	var LayoutId = Ext.Cmp('LayoutId').getValue();
	if(LayoutId.length> 0 )
	{
		Ext.Ajax
		({
			url		: Ext.DOM.INDEX+'/SysThemes/SaveActive/',
			method	: 'POST',
			param   : {
				LayoutId : LayoutId,
				Active : 0
			},
			ERROR : function(e){
				Ext.Util(e).proc(function(active){
					if( active.success ){
						Ext.Msg("Disable Layout").Success();
						Ext.EQuery.Ajax
						({
							url 	: Ext.DOM.INDEX +"/SysThemes/index/",
							param 	: { 
								time : Ext.Date().getDuration()
							}
						});
					}
					else{
						Ext.Msg("Disable Layout").Failed();
					}
				});
			}
		
		}).post();
	}
}

Ext.DOM.DeleteLayout= function(){
 var LayoutId = Ext.Cmp('LayoutId').getValue();
 if(LayoutId.length> 0) 
 {
		Ext.Ajax
		({
			url		: Ext.DOM.INDEX+'/SysThemes/Delete/',
			method	: 'POST',
			param   : {
				LayoutId : LayoutId
			},
			ERROR : function(e){
				Ext.Util(e).proc(function(active){
					if( active.success ){
						Ext.Msg("Delete Layout").Success();
						Ext.EQuery.Ajax
						({
							url 	: Ext.DOM.INDEX +"/SysThemes/index/",
							param 	: { 
								time : Ext.Date().getDuration()
							}
						});
					}
					else{
						Ext.Msg("Disable Layout").Failed();
					}
				});
			}
		
		}).post();
	}
}


Ext.DOM.EnableLayout= function()
{
	var LayoutId = Ext.Cmp('LayoutId').getValue();
	if(LayoutId.length> 0) 
	{
		Ext.Ajax
		({
			url		: Ext.DOM.INDEX+'/SysThemes/SaveActive/',
			method	: 'POST',
			param   : {
				LayoutId : LayoutId,
				Active : 1
			},
			ERROR : function(e){
				Ext.Util(e).proc(function(active){
					if( active.success ){
						Ext.Msg("Enable Layout").Success();
						Ext.EQuery.Ajax
						({
							url 	: Ext.DOM.INDEX +"/SysThemes/index/",
							param 	: { 
								time : Ext.Date().getDuration()
							}
						});
					}
					else{
						Ext.Msg("Disable Layout").Failed();
					}
				});
			}
		
		}).post();
	}
}

$(function(){
	$('#toolbars').extToolbars
	({
		extUrl   :Ext.DOM.LIBRARY +'/gambar/icon',
		extTitle :[['Add Layout'],['Edit Layout'], ['Disable Layout'],['EnableLayout'],['Delete']],
		extMenu  :[['AddLayout'],['EditLayout'],['DisableLayout'],['EnableLayout'],['DeleteLayout']],
		extIcon  :[['add.png'],['user_edit.png'],['cancel.png'],['accept.png'],['cross.png']],
		extText  :true,
		extInput :true,
		extOption:[]
	});
});	
</script>
<fieldset class="corner" style="border:1px solid #ddd;">
<legend class="icon-menulist">&nbsp;&nbsp;<span id="legend_title"></span></legend>
<div id="toolbars"></div>
<div id="panel-content"></div>	
 <div style="margin:5px;">
	<table width="100%" class="custom-grid" cellspacing="0">
	<thead>
		<tr height="20"> 
			<th nowrap class="custom-grid th-first"  width="5%" align="center">&nbsp;<b>No</b>&nbsp;</th>
			<th nowrap class="custom-grid th-middle" width="5%" align="center">&nbsp;<b><a href = "javascript:void(0);" onclick="Ext.Cmp('LayoutId').setChecked();"># <a><b></th>
			<th nowrap class="custom-grid th-middle" width="15%" align="center">&nbsp;<b>Name</b>&nbsp;</th>
			<th nowrap class="custom-grid th-middle" width="20%" align="center">&nbsp;<b>Preview</b>&nbsp;</th>
			<th nowrap class="custom-grid th-middle" width="10%" align="center">&nbsp;<b>Author</b>&nbsp;</th>
			<th nowrap class="custom-grid th-middle" width="20%" align="left">&nbsp;<b>Description</b>&nbsp;</th>
			<th nowrap class="custom-grid th-lasted" width="10%" align="center">&nbsp;<b>Status</b>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		$no = 1;
		foreach($layout as $LayoutId => $rows ) {  
		$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');	
	?>
		<tr class="onselect" bgcolor="<?php echo $color;?>">
			<td class="content-first" align="center"><?php echo $no; ?></td>
			<td class="content-middle" align="center"><b><?php echo form() -> checkbox('LayoutId',null, $LayoutId); ?></b></td>
			<td class="content-middle" align="center"><b><?php echo $rows['Name'];?></b></td>
			<td class="content-middle" align="center">
				<div class="box-images">
					<img class="images-style" src="<?php echo $rows['Images']; ?>">
				<div>
			</td>
			<td class="content-middle" valign="top" align="center"><?php echo $rows['Author']; ?></td>
			<td class="content-middle" valign="top" align="justify"><?php echo $rows['Description']; ?></td>
			<td class="content-lasted" valign="top" align="center"><?php echo ($rows['Flags']?'Active':'Not Active'); ?></td>
		</tr>
	<?php 
		$no++;
	} ?>
	</tbody>
	</table>
 </div>
</fieldset>
