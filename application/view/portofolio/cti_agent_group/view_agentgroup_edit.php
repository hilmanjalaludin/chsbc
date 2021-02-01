<div id="result_content_add" class="box-shadow" style="margin-top:10px;">
<fieldset class="corner" style="background-color:white;margin:3px;">
 <legend class="icon-application">&nbsp;&nbsp;&nbsp;Edit Group Type </legend>	
  <form name="frmEditReasonType">
	<table cellpadding="6px;">
	<?php foreach( $FieldName as $key => $label ) {
		if( $label!='id' ) {  ?>
			<tr>
				<td class="text_caption">* <?php echo  ucfirst($label); ?></td>
				<td><?php echo form() -> input($label,'input_text long', $Reason[$label]);?></td>
			</tr>
	<?php 
	} else {
		echo form() -> hidden($label,'input_text long', $Reason[$label]);
	} } ?>
	
	<tr>
		<td class="text_caption">&nbsp;</td>
		<td>
			<input type="button" class="update button" onclick="Ext.DOM.Update();" value="Update">
			<input type="button" class="close button" onclick="Ext.Cmp('top-panel').setText('');" value="Close">
		</td>
	</tr>
</table>
 </form>
</fieldset>
</div>