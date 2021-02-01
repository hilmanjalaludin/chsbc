<fieldset class='corner'>
<legend class="icon-customers">&nbsp;&nbsp;Play Voice Data </legend>
 <div id="play_voice_mail" style='padding-top:5px;padding-bottom:10px;'></div>
</fieldset>


<?php 

/////////////////////: LOAD DATA :\\\\\\\\\\\\\\\\\\\\\\\ 

$UI=& get_instance(); 
$UI->load->model('M_SrcCustomerList');

/////////////////////: LOAD DATA :\\\\\\\\\\\\\\\\\\\\\\\ 

$Datas =& $UI->M_SrcCustomerList->_getDetailCustomer($frmVoiceContent['assignment_data']);

?>
<fieldset class='corner' style='margin-top:10px;'>
<legend class="icon-customers">&nbsp;&nbsp;User Activity</legend>
<div class='box-shadow' style='padding-top:5px;padding-bottom:10px;'>
<form name="frmActivityData">
	<table width='99%'>
		<tr>
			<td class='text_caption bottom'> Campaign ID </td>
			<td><?php __(form()->combo('CampaignId', 'select long',$frmCampaignId, $frmVoiceContent['CampaignId'], null, array('disabled' => 'true') )); ?></td>
		</tr>
		<tr>
			<td class='text_caption bottom'> Voice Status </td>
			<td><?php __(form()->combo('CallReasonId', 'select long',$frmCombo['CallResultInbound'], $Datas['CallReasonId'] )); ?></td>
		</tr>
		<tr>
			<td class='text_caption bottom'>Memo</td>
			<td><?php __(form()->textarea('VoiceMemo', 'textarea long',$frmVoiceContent['memo'])); ?></td>
		</tr>
		<tr>
			<td class='text_caption'></td>
			<td> 
				<?php __(form()->button('ButtonSave', 'button save','&nbsp;Save')); ?>
				<?php __(form()->button('ButtonClose', 'button close','&nbsp;Cancel')); ?>
			</td>
		</tr>
	</table>
</form>	
</div>
</fieldset>
