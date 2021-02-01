<?php  ?>
<fieldset class="corner" style="border:1px solid #dddddd;margin-top:10px;margin-left:10px;">
<legend class="icon-application">&nbsp;&nbsp;Upload Extension</b></legend>
	<div class="box-shadow">
	<table cellspacing="6">
		<tr>
			<td class="text_caption"> Mode </td>
			<td style="color:#bbb000;"><?php echo form() -> combo('modus_action','select long',array('truncate'=>'Truncate','replace'=>'Replace')); ?></td>
		</tr>
		<tr>
			<td class="text_caption">File To Upload (*.xls)</td>
			<td><?php echo form() -> upload('fileToupload'); ?><td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="2">
				<input type="button" class="upload button" onclick="Ext.DOM.Upload();" value="Upload">
				<input type="button" class="close button" onclick="Ext.Cmp('tpl_header').setText('');" value="Close">
				<span id="loading-image"></span>
			</td>
		</tr>	
	</table>
	
	</div>
</fieldset>		