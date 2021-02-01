<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first center">&nbsp;#</th>	
		<th nowrap class="custom-grid th-middle"><span class="header_order" id ="a.id" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;No</span></th>	
		<th nowrap class="custom-grid th-middle"><span class="header_order" id ="e.Name" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;Direction</span></th>	
		<th nowrap class="custom-grid th-middle"><span class="header_order" id ="a.agent_ext" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;Extension</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" id ="d.description" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;Group</span></th>    
		<th nowrap class="custom-grid th-middle"><span class="header_order" id ="c.name" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;User</span></th>	
        <th nowrap class="custom-grid th-middle"><span class="header_order" id ="a.file_voc_name" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;File Name</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" id ="a.file_voc_size" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;File Size</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" id ="a.start_time" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;Date</span></th>
		<th nowrap class="custom-grid th-lasted"><span class="header_order" id ="a.duration" onclick="Ext.EQuery.orderBy(this.id);">&nbsp;Duration</span></th>
	</tr>
</thead>	
<tbody>
<?php
$no = $num;
foreach( $page -> result_assoc() as $rows ){ 
  $color = ($no%2!=0?'#FFFEEE':'#FFFFFF'); ?>
<tr class="onselect" bgcolor="<?php __($color); ?>">
	<td class="content-first"><?php __(form()->radio('voice_loger_id',null, $rows['id']));?></td>
	<td class="content-middle"><?php __($no); ?></td>
	<td class="content-middle"><?php __($rows['asDirection']); ?></td>
	<td class="content-middle"><?php __($rows['agent_ext']); ?></td>
	<td class="content-middle"><?php __($rows['GroupName']); ?></td>
	<td class="content-middle"><?php __($rows['AgentName']); ?></td>
	<td class="content-middle"><?php __($rows['file_voc_name']); ?></td>
	<td class="content-middle"><?php __(_getFormatSize($rows['file_voc_size'])); ?></td>
	<td class="content-middle"><?php __(_getDateIndonesia($rows['start_time'])); ?></td>
	<td class="content-lasted"><?php __(_getDuration($rows['duration'])); ?></td>
</tr>	
</tbody>
	<?php
		$no++;
		};
	?>
</table>


