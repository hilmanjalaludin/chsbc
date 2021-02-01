<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Add User Skill</legend>
	<table cellpadding="6px;">
		<tr>
			<td class="text_caption">* Agent ID </td>
			<td><?php echo form()->combo('agent','select long',$UserJoin);?></td>
		</tr>
		<tr>
			<td class="text_caption" >* Skill</td>
			<td><?php echo form()->combo('skill','select long', $UserSkill);?></td>
		</tr>
		<tr>
			<td class="text_caption">* Score</td>
			<td><?php echo form()->input('score','input_text date',100);?></td>
		</tr>
		<tr>
			<td class="text_caption">&nbsp;</td>
			<td>
				<input type="button" class="save button" onclick="Ext.DOM.SaveSkill();" value="Save">
				<input type="button" class="close button" onclick="Ext.Cmp('tpl_header').setText('');" value="Close">
			</td>
		</tr>
	</table>
</div>