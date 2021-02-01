<script>
$(function() {
	$("#LastCallStartDate").datepicker({showOn: 'button', buttonImage: Ext.DOM.LIBRARY +'/gambar/calendar.gif', buttonImageOnly: true, dateFormat:'dd-mm-yy',changeYear:true,changeMonth:true});
	$("#LastCallEndDate").datepicker({showOn: 'button', buttonImage: Ext.DOM.LIBRARY +'/gambar/calendar.gif', buttonImageOnly: true, dateFormat:'dd-mm-yy',changeYear:true,changeMonth:true});
});
</script>

<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Edit Last Call</legend>
	<?php echo form()->hidden('LastCallId',null,$Data['LastCallId']);?>
	<table cellpadding="6px;">
		<tr>
			<td class="text_header">* Interval Date </td>
			<td>
				<?php echo form()-> input('LastCallStartDate','input_text date',$this -> EUI_Tools->_date_indonesia($Data['LastCallStartDate']));?> 
				<?php echo form()-> input('LastCallEndDate','input_text date',$this -> EUI_Tools->_date_indonesia($Data['LastCallEndDate']));?> 
			</td>
		</tr>
		<tr>
			<td class="text_header" >* Interval Time </td>
			<td class="text_header" style="text-align:left;">
				<?php echo form()-> input('LastCallStartTime','input_text box',$Data['LastCallStartTime']);?> &nbsp;:&nbsp;  
				<?php echo form()-> input('LastCallEndTime','input_text box',$Data['LastCallEndTime']);?> 
			</td>
		</tr>
		<tr>
			<td class="text_header">* Reason </td>
			<td><?php echo form()-> textarea('LastCallReason','textarea long',$Data['LastCallReason']);?> </td>
		</tr>
		<tr>
			<td class="text_header">* Status</td>
			<td><?php echo form()-> combo('LastCallStatus','select long',array('1'=>'Active','0'=>'Not Active'),$Data['LastCallStatus']);?></td>
		</tr>
		<tr>
			<td class="text_header">&nbsp;</td>
			<td>
				<input type="button" class="update button" onclick="Ext.DOM.UpdateWorkTime();" value="Update">
				<input type="button" class="close button" onclick="Ext.Cmp('span_top_nav').setText('');" value="Close">
			</td>
		</tr>
	</table>
</div>