<form name="frmReport">

<fieldset class="corner" style='margin-top:-10px;'>
<legend class="icon-menulist">&nbsp;&nbsp;Group Filter </legend>
<div>
	<table cellpadding='4' cellspacing=4>
		<tr>
			<td class="text_caption bottom">Filter By </td>
			<td><?php __(form()->combo('Filter','select long', $group_filter_by, null, array("change" => "Ext.DOM.GroupFilterBy(this);") ));?></td>
		</tr>
		
		<tr>
			<td class="text_caption bottom"><span id="label1">Agent<span></td>
			<td > <span id="Div1"><?php __(form()->combo('AgentId','select long',  array() ));?></span></td>
		</tr>
		
		<tr>
			<td class="text_caption bottom"><span id="label2">Agent<span> </td>
			<td > <span id="Div2"><?php __(form()->combo('CampaignId','select long',  array() ));?></span></td>
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
			<td class='bottom'><?php __(form()->combo('interval','select long', $mode_call_center));?></td>
		</tr>
		<tr>
			<td class="text_caption"> &nbsp;</td>
			<td class='bottom'>
				<?php __(form()->button('','page-go button','Debug',array("click"=>"Ext.DOM.Debug();") ));?>
				<?php __(form()->button('','page-go button','Download',array("click"=>"Ext.DOM.ShowReport();") ));?>
			</td>
		</tr>
	</table>
</div>
</fieldset>
</form>