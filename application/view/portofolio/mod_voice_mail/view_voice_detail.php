

<!-- start : nav js -->
<?php $this->load->view("mod_voice_mail/view_voice_javascript"); ?>
<!-- stop : nav js -->

<fieldset class='corner'>
<legend class='icon-menulist'>&nbsp;&nbsp;Voice Mail Detail </legend>
<?php __(form()->hidden('VoiceMailId', null, _get_post('VoiceMailId')));?>
<div style='margin-top:-5px;'>
	<table width='100%' border=0>
		<tr>
			<td width='70%' valign='top'><?php $this->load->view("mod_voice_mail/view_voice_west");?></td>
			<td width='30%' valign='top'><?php $this->load->view("mod_voice_mail/view_voice_east");?></td>
		</tr>
	</table>
</div>
</fieldset>