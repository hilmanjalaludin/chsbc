<?php 
echo javascript(array( 
	array('_file' => base_jquery().'/plugins/extToolbars.js', 'eui_'=>'1.0.0', 'time'=>time()),
	array('_file' => base_enigma().'/views/EUI_Contact.js', 'eui_'=>'1.0.0', 'time'=>time()),
	array('_file' => base_enigma().'/helper/EUI_Media.js', 'eui_'=>'1.0.0', 'time'=>time()),
	array('_file' => base_enigma().'/helper/EUI_Dialog.js', 'eui_'=>'1.0.0', 'time'=>time())
));?>
	
<?php $this ->load ->view('qty_approval_scoring/view_quality_javascript');?>

<!-- detail content -->

<fieldset class="corner"> 
<legend class="icon-customers"> &nbsp;&nbsp;Quality Scoring Detail </legend>
<div id="toolbars" class="contact"></div>

<!-- START :: hidden -->

<input type="hidden" name="ControllerId" id="ControllerId" value="<?php echo _get_post("ControllerId"); ?>"/>
<input type="hidden" name="CustomerId" id="CustomerId" value="<?php echo $Customers['CustomerId']; ?>" />
<input type="hidden" name="CustomerNumber" id="CustomerNumber" value="<?php echo $Customers['CustomerNumber']; ?>" />

<!-- END :: hidden -->
<div class="contact_detail" style="margin-left:-8px;">
	<table width="100%" border=0>
		<tr>
			<td  width="70%" valign="top">
				<?php $this ->load ->view('qty_approval_scoring/view_quality_default_detail');?>
				<?php $this ->load ->view('qty_approval_scoring/view_quality_history_detail');?>
			</td>
			<td  width="30%" rowspan="2" valign="top">
				<?php $this ->load ->view('qty_approval_scoring/view_quality_phone_detail');?>
			</td>
		</tr>
	</table>
	<div id="change_request_dialog" >
</div>
</fieldset>	
