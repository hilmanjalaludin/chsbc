<fieldset class="corner" style='margin-top:-10px;'>
<legend class="icon-menulist">&nbsp;&nbsp;Raw Data Filter </legend>
<div>
	<table cellpadding='4' cellspacing=4>
		<tr>
			<td class="text_caption bottom">Filter By </td>
			<td><?php __(form()->combo('FilterBy','select long', $filter_by, null, array("change" => "Ext.DOM.Campaign(this);") ));?></td>
		</tr>
		
		<tr>
			<td class="text_caption bottom">Campaign </td>
			<td > <span id="DivCmp"><?php __(form()->combo('CampaignId','select',  array() ));?></span></td>
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
			<td class='bottom'><?php __(form()->combo('ModeBy','select long', $mode_by));?></td>
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