<fieldset class='corner' style="margin:10px;">
	<legend class="icon-menulist">&nbsp;&nbsp;Add Group Team </legend>
	<div style='margin-top:8px;'>
	<form name="frmAddGroupTeam">
		<table cellpadding='8px' cellspacing='4px'>
			<tr>
				<td class='text_caption bottom'>* Group Name</td>
				<td><?php __(form()->input('GroupName','input_text long', null) )?></td>
			</tr>
			
			<tr>
				<td class='text_caption bottom'>* Group Description</td>
				<td><?php __(form()->input('GroupDescription','input_text long', null) )?></td>
			</tr>
			<tr>
				<td class='text_caption bottom'>Status</td>
				<td><?php __(form()->combo('GroupFlags','select long', array('1' => 'Active','0' => 'Not Active'), '1') )?></td>
			</tr>
			
			<tr>
				<td class='text_caption'>&nbsp;</td>
				<td>
					<?php __(form()->button('ButtonSave','save button','Save', array('click' => 'Ext.DOM.SaveAddGroupTeam();') ) )?>
					<?php __(form()->button('ButtonClose','close button','Close', array('click' => "Ext.Cmp('top-panel-content').setText('');")) )?>
				</td>
			</tr>
		</table>
		</form>
	</div>
</fieldset>