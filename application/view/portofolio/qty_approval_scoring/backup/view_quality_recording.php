<div>
<table border=0 align="left" cellspacing=1 width="100%">
	<tr height='24'>
		<th class="ui-corner-top ui-state-default first" WIDTH="4%">&nbsp;#</th>
		<th class="ui-corner-top ui-state-default first" WIDTH="4%">&nbsp;No</th>
		<th class="ui-corner-top ui-state-default first" WIDTH="12%" nowrap>&nbsp;Phone Number</th>	
		<th class="ui-corner-top ui-state-default first" WIDTH="15%">&nbsp;Voice Name</th>
		<th class="ui-corner-top ui-state-default first" WIDTH="15%">&nbsp;Voice Date</th>
		<th class="ui-corner-top ui-state-default first" WIDTH="15%">&nbsp;Duration</th>
		<th class="ui-corner-top ui-state-default first" WIDTH="15%">&nbsp;Size</th>
	</tr>
	<?php foreach( $data as $num => $rows ) { ?>
		<tr>
			<td class="contact-history-table first center" style="vertical-align:middle;"><?php echo form()->checkbox('recordId',null, $rows['id'],array("click"=>"PlayRecording(this);") ); ?></td>
			<td class="contact-history-table middle"><?php echo $num; ?></td>
			<td class="contact-history-table middle"><?php echo _getPhoneNumber($rows['anumber']); ?></td>
			<td class="contact-history-table middle"><?php echo $rows['file_voc_name']; ?></td>
			<td class="contact-history-table middle"><?php echo $rows['start_time']; ?></td>
			<td class="contact-history-table middle center"><?php echo _getDuration($rows['duration']); ?></td>
			<td class="contact-history-table lasted center"><?php echo _getFormatSize($rows['file_voc_size']); ?></td>
			
		</tr>
	<?php } ?>
	</table>
</div>	
<span style="clear:both;"></span>
<div class="page-web-voice toolbars">
	<ul> 
		<li class="page-web-voice-normal title-pages"><span> Page : </span></li>
		<?php foreach($page as $p => $v ){ ?>
			<?php if( $p==$current ){ ?>
				<li class="page-web-voice-current" id="<?php echo $p; ?>" onclick="Ext.DOM.SelectPages(this);"><a href="javascript:void(0);" > <?php echo $v; ?></a></li> 
			<?php } else {?>
				<li class="page-web-voice-normal" id="<?php echo $p; ?>" onclick="Ext.DOM.SelectPages(this);"><a href="javascript:void(0);"> <?php echo $v; ?></a></li> 
		<?php } } ?>
		<li class="page-web-voice-normal title-pages"><span> Record(s) : <?php echo $records;?> </span></li>
	</ul>
</div>