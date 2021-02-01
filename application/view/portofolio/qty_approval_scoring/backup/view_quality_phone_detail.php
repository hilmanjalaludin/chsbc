<fieldset class="corner" style="margin-top:-3px;"> 
	<legend class="icon-menulist"> &nbsp;&nbsp; Quality Activity</legend> 
<div style="overflow:auto;margin-top:3px;" class="activity-content box-shadow">
<form name="frmQualityActivity">
<table class="activity-table" cellpadding="0px;" border=0 cellspacing="1px">
	<tr>
		<td nowrap class="text_caption">Phone Number </td>
		<td nowrap id="phone_primary_number"><?php __(form()->combo('PhoneNumber','select long', $Phones,$Callhistory['CallNumber'], null, array('disabled'=>true))); ?></td>
	</tr>	
	<tr>
		<td nowrap class="text_caption">Add Phone Number </td>
		<td nowrap id="phone_additional_number"><?php __(form()->combo('AddPhoneNumber','select long',$AddPhone,$Callhistory['CallNumber'], null, array('disabled'=>true))); ?></td>
	</tr>	
	<tr>
		<td class="text_caption" valign="top">Call Status </td>
		<td> <?php __(form()->combo('CallStatus','select long', $CallCategoryId,$Customers['CallReasonCategoryId'],null,array('disabled'=>true))); ?></td>
	</tr>	
	<tr>
		<td class="text_caption">Call Result</td>
		<td><?php __(form()->combo('CallResult','select long',$CallResultId, $Customers['CallReasonId'],null,array('disabled'=>true))); ?></td>
	</tr>
	<!--
	<tr>
		<td class="text_caption" valign="top">Approve Status </td>
		<td> <@?php echo form()->combo('QualityStatus','select long', $QualityApprove, $Customers['CallReasonQue']); ?></td>
	</tr>
-->	
	<tr>
		<td class="text_caption" valign="top">Notes A</td>
		<td><?php __(form()->textarea('call_remarksa','textarea',$ResultPoints['ApprovalRemark'], null,array(
			'style' => 'height:150px;width:180px;color:#333BBB;','disabled' => true)));?></td>
	</tr>	
	
	<tr>
		<td class="text_caption" valign="top">Notes B</td>
		<td><?php __(form()->textarea('call_remarksb','textarea',$QtyScoring['remarks'], null,array(
			'style' => 'height:150px;width:180px;color:#333BBB;')));?></td>
	</tr>
	<tr>
		<td align="center">&nbsp;</td>
		<td>
			<?php __(form()->button('ButtonbSave','button save','Save', array("click" =>"Ext.DOM.SaveQualityActivity();") ));?>
			<?php __(form()->button('ButtonbCancel','button close','Cancel', array("click" =>"Ext.DOM.CancelActivity();") ));?>
		</td>
	</tr>
	</table>	
	</form>
	</div>	
</fieldset>	