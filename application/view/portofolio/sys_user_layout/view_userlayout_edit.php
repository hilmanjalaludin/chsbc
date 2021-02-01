<?php get_view(array("sys_user_layout","view_userlayout_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-plus"></span><?php echo lang("Edit Group Layout");?> </a>
		</li>
	</ul>	
	
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
	 
	 <fieldset class="corner ui-widget-fieldset" style="margin:5px; border-radius:5px;">
		<?php echo form()->legend(lang("Edit"),"fa-edit");?>
		<form name="frmEditLayout">
			<input type="hidden" id="LayoutId" name="LayoutId" value="<?php echo $LayoutData['Id'];?>"/>
			<table cellpadding="8px" cellspacing="8px">
				<tr>
					<td class="text-caption">Layout Themes </td>
					<td class=""><?php echo form() -> combo('UserThemes','select superlong',$UserThemes,$LayoutData['Themes']);?></td>
				</tr>
				<tr>
					<td class="text-caption">Layout Name</td>
					<td class=""><?php echo form() -> combo('UserLayout','select superlong', $UserLayout,$LayoutData['LayoutId']);?></td>
				</tr>
				<tr>
					<td class="text-caption">User Group</td>
					<td class=""><?php echo form() -> combo('UserGroup','select superlong',$UserGroup,$LayoutData['GroupId']);?></td>
				</tr>
				<tr>
					<td class="text-caption"></td>
					<td class=""> <input type="button" class="update button" onclick="Ext.DOM.UpdateLayout();" value="Update"></td>
					
				</tr>
			</table>	
		</form>
	  </fieldset>	
	</div>	
</div>	
