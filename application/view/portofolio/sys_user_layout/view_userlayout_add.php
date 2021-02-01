

<?php get_view(array("sys_user_layout","view_userlayout_jsv"));?>
<div id="ui-widget-add-campaign" class="tabs corner ui-frame-with">
	<ul>
		<li class="ui-tab-li-lasted">
			<a href="#ui-widget-add-content">
			<span class="ui-icon ui-icon-plus"></span><?php echo lang("Add Group Layout");?> </a>
		</li>
	</ul>	
	
	<div id="ui-widget-add-content" class="ui-widget-add-content ui-frame-with">
	 
	 <fieldset class="corner ui-widget-fieldset" style="margin:5px; border-radius:5px;">
		<?php echo form()->legend(lang("Add"),"fa-plus");?>
		<form name="frmAddLayout">
			<table cellpadding="8px" cellspacing="8px">
				<tr>
					<td class="text-caption right">Layout Themes </td>
					<td class="text-caption center">:</td>
					<td class=""><?php echo form() -> combo('UserThemes','select superlong',LayoutThemes());?></td>
				</tr>
				<tr>
					<td class="text-caption right">Layout Name</td>
					<td class="text-caption center">:</td>
					<td class=""><?php echo form() -> combo('UserLayout','select superlong', $UserLayout);?></td>
				</tr>
				<tr>
					<td class="text-caption right">User Group</td>
					<td class="text-caption center">:</td>
					<td class=""><?php echo form()->combo('UserGroup','select superlong',$UserGroup);?></td>
				</tr>
				<tr>
					<td class="text-caption"></td>
					<td class="text-caption"></td>
					<td class=""> <input type="button" class="save button" onclick="Ext.DOM.SaveLayout();" value="Save"></td>
				</tr>
			</table>	
		</form>
	  </fieldset>	
	</div>	
</div>	