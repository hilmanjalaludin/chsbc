<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Edit User Skill</legend>
 <?php echo form() -> hidden('id', null, $Data['id']);?>
	<table cellpadding="6px;" cellspacing="3px">
		<tr>
			<td class="text_caption">* Agent ID </td>
			<td><?php echo form()->combo('agent','select long',$UserJoin, $Data['agent']);?></td>
		</tr>
		<tr>
			<td class="text_caption" >* Skill</td>
			<td><?php echo form()->combo('skill','select long', $UserSkill,$Data['skill']);?></td>
		</tr>
		<tr>
			<td class="text_caption">* Score</td>
			<td><?php echo form()->input('score','input_text date',$Data['score']);?></td>
		</tr>
		<tr>
			<td class="text_caption">&nbsp;</td>
			<td>
				<input type="button" class="update button" onclick="Ext.DOM.UpdateSkill();" value="Update">
				<input type="button" class="close button" onclick="Ext.Cmp('tpl_header').setText('');" value="Close">
			</td>
		</tr>
	</table>
</div>