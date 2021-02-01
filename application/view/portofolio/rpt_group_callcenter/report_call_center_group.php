<fieldset class="corner" style='margin-top:-10px;'>
<legend class="icon-menulist">&nbsp;&nbsp;Group Filter </legend>
<div>
	<table cellpadding='4' cellspacing=4>
		<tr>
			<td class="text_caption bottom">Group Call Center </td>
			<td><?php __(form()->combo('Group','select long', $group_call_center, null));?></td>
		</tr>
		<!--
		<tr>
			<td class="text_caption bottom">Agent </td>
			<td > <span id="DivAgent"><#?php __(form()->combo('AgentId','select long',  array() ));?></span></td>
		</tr>
		-->
		<tr>
			<td class="text_caption bottom">Call Type </td>
			<td ><?php __(form()->combo('CallDirection','select long',  $mode_call_type ));?></td>
		</tr>
		
		<tr>
			<td class="text_caption bottom">Interval </td>
			<td class='bottom'>
				<?php __(form()->input('start_date','input_text box date'));?> &nbsp-
				<?php __(form()->input('end_date','input_text box date'));?>
			</td>
		</tr>
		<tr>
			<td class="text_caption bottom">Mode </td>
			<td class='bottom'><?php __(form()->combo('Mode','select long', $mode_call_center));?></td>
		</tr>
		<tr>
			<td class="text_caption"> &nbsp;</td>
			<td class='bottom'>
				<?php __(form()->button('','page-go button','Show',array("click"=>"Ext.DOM.ShowReport();") ));?>
				<?php __(form()->button('','excel button','Export',array("click"=>"Ext.DOM.ShowExcel();") ));?>
			</td>
		</tr>
	</table>
</div>
</fieldset>