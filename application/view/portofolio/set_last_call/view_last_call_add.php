<script>
$(function() {
	$("#LastCallStartDate").datepicker({showOn: 'button', buttonImage: Ext.DOM.LIBRARY +'/gambar/calendar.gif', buttonImageOnly: true, dateFormat:'dd-mm-yy'});
	$("#LastCallEndDate").datepicker({showOn: 'button', buttonImage: Ext.DOM.LIBRARY +'/gambar/calendar.gif', buttonImageOnly: true, dateFormat:'dd-mm-yy'});
});
</script>

<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Add Last Call</legend>
	<table cellpadding="6px;">
		<tr>
			<td class="text_header">* Interval Date </td>
			<td>
				<?php echo form()-> input('LastCallStartDate','input_text date');?> 
				<?php echo form()-> input('LastCallEndDate','input_text date');?> 
			</td>
		</tr>
		<tr>
			<td class="text_header" >* Interval Time </td>
			<td class="text_header" style="text-align:left;">
				<?php echo form()-> input('LastCallStartTime','input_text box');?> &nbsp;:&nbsp;  
				<?php echo form()-> input('LastCallEndTime','input_text box');?> 
			</td>
		</tr>
		<tr>
			<td class="text_header">* Reason </td>
			<td><?php echo form()-> textarea('LastCallReason','textarea long');?> </td>
		</tr>
		<tr>
			<td class="text_header">* Status</td>
			<td><?php echo form()-> combo('LastCallStatus','select long',array('1'=>'Active','0'=>'Not Active') );?></td>
		</tr>
		<tr>
			<td class="text_header">&nbsp;</td>
			<td>
				<input type="button" class="save button" onclick="Ext.DOM.SaveWorkTime();" value="Save">
				<input type="button" class="close button" onclick="Ext.Cmp('span_top_nav').setText('');" value="Close">
			</td>
		</tr>
	</table>
</div>