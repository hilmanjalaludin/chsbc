<table width="100%" class="custom-grid" cellspacing="1">
<thead>
	<tr height="24"> 
		<th nowrap class="font-standars ui-corner-top ui-state-default first center">&nbsp;#</th>	
		<th nowrap class="font-standars ui-corner-top ui-state-default first left"><span class="header_order" id ="a.id" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;No</span></th>	
		<th nowrap class="font-standars ui-corner-top ui-state-default first left"><span class="header_order" id ="e.Name" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;From Number</span></th>	
		<th nowrap class="font-standars ui-corner-top ui-state-default first left"><span class="header_order" id ="a.agent_ext" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;Destination Number</span></th> 
        <th nowrap class="font-standars ui-corner-top ui-state-default first left"><span class="header_order" id ="a.file_voc_name" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;File Name</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default first left"><span class="header_order" id ="a.file_voc_size" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;File Size</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default first left"><span class="header_order" id ="a.start_time" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;Date</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default first left"><span class="header_order" id ="a.duration" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;Duration</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default first left"><span class="header_order" id ="a.duration" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;Followup Date</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default first left"><span class="header_order" id ="a.duration" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;Status</span></th>
		
	</tr>
</thead>	
<tbody>
<?php
$no = $num;
foreach( $page -> result_assoc() as $rows ){ 
  $color = ($no%2!=0?'#FFFEEE':'#FFFFFF'); ?>
<tr class="onselect" bgcolor="<?php __($color); ?>">
	<td class="content-first"><?php __(form()->checkbox('voice_mail_id',null, $rows['id'], array("click"=>"Ext.DOM.VoiceDetail(this);") ));?></td>
	<td class="content-middle"><?php __($no); ?></td>
	<td class="content-middle"><?php __($rows['anumber']); ?></td>
	<td class="content-middle"><?php __($rows['bnumber']); ?></td>
	<td class="content-middle"><?php __($rows['file_voc_name']); ?></td>
	<td class="content-middle"><?php __(_getFormatSize($rows['file_voc_size'])); ?></td>
	<td class="content-middle"><?php __(_getDateIndonesia($rows['start_time'])); ?></td>
	<td class="content-middle"><?php __(_getDuration($rows['duration'])); ?></td>
	
	<td class="content-middle"><?php __(($rows['CustomerUploadedTs'] ? $rows['CustomerUploadedTs'] : '-')); ?></td>
	<td class="content-lasted"><?php __(($rows['CallReasonDesc']?$rows['CallReasonDesc']:'-')); ?></td>
	
</tr>	
</tbody>
	<?php
		$no++;
		};
	?>
</table>


