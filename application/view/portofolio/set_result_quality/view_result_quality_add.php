<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Add Quality Result </legend>
<table cellpadding="6px;" cellspacing='5'>
	<tr>
		<td class="text_caption">* Quality Result Code </td>
		<td><?php echo form()->input('AproveCode','input_text long');?></td>
		<td class="text_caption">* Quality Result Name</td>
		<td><?php echo form()->input('AproveName','input_text long');?></td>
	</tr>
	<tr>
		<td class="text_caption">* Eskalasi <d>
		<td><?php echo form()->combo('ApproveEskalasi','select long',$Event);?></td>
		<td class="text_caption">* To User Privileges <d>
		<td><?php echo form()->combo('UserPrivileges','select long',$UserLevel);?></td>
	</tr>
	<tr>
		<td class="text_caption">* Confirm <d>
		<td><?php echo form()->combo('ConfirmFlags','select long',$Event);?></td>
		<td class="text_caption">* Cancel <d>
		<td><?php echo form()->combo('CancelFlags','select long',$Event);?></td>
	</tr>
	
	<tr>
		<td class="text_caption">* Verified <d>
		<td><?php echo form()->combo('AproveVeryfied','select long',$Event);?></td>
		<td class="text_caption">* Status</td>
		<td><?php echo form()->combo('AproveFlags','select long',array('1'=>'Active','0'=>'Not Active'));?></td>
	</tr>
	<tr>
		<td class="text_caption">&nbsp;</td>
		<td>
			<input type="button" class="save button" onclick="Ext.DOM.SaveQualityResult();" value="Save">
			<input type="button" class="close button" onclick="Ext.Cmp('span_top_nav').setText('');" value="Close">
		</td>
	</tr>
</table>
</fieldset>
</div>