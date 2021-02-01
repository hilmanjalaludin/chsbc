<fieldset class="corner" style="margin-top:10px;">
	<legend class="icon-application">&nbsp;&nbsp;Options </legend>
<div>
	<table cellspacing=1 cellpadding=6>
		<tr>
			<td class="text_caption bottom" valign=top>List Tables </td>
			<td class="bottom"><span id="lstId"></span></td>
		</tr>
		<tr>
			<td class="text_caption bottom">File Name</td>
			<td class="bottom">
				<?php __(form()->input('fileNameBackup','input_text long',null, null,array('style'=>'width:220px;'))); ?>
			</td>
		</tr>
		
		<tr>
			<td class="text_caption bottom">&nbsp;</td>
			<td class="bottom">
				<?php __(form()->button('button','add button','Add',array('click'=>'Ext.DOM.AddOptionBackup();')));?>
				<?php __(form()->button('button','add button','Remove',array('click'=>'Ext.DOM.RemoveOptionBackup();')));?><br>
				<?php __(form()->button('donwload','save button','Save',array('click'=>'Ext.DOM.SaveOptionBackup();'))); ?>
				<?php __(form()->button('button','close button','Close',array("click"=>"Ext.Cmp('span_top_nav').setText('');")));?>
			</td>
		</tr>
	</table>
</div>	
	
</fieldset>
<?php



?>