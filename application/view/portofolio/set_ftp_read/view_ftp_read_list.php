<?php ?>

<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first" width="5%">&nbsp;#</th>	
		<th nowrap class="custom-grid th-middle" align="center">&nbsp;No</th>	
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;In/Out Directory</th>        
        <th nowrap class="custom-grid th-middle" align="left">&nbsp;Read/Create File</th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;Control File</th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;History Directory</th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;Mode</th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;Schedule File</th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;Schedule</th>
		<th nowrap class="custom-grid th-lasted" align="left">&nbsp;Create Date</th>
	</tr>
</thead>	
<tbody>
<?php
 $no  = $num;
 foreach( $page -> result_assoc() as $rows ) { 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>	
	<tr CLASS="onselect" bgcolor="<?php echo $color;?>">
		<td class="content-first"><input type="checkbox" value="<?php echo $rows['ftp_read_id']; ?>" name="ftp_id" id="ftp_id"></td>
		<td class="content-middle"><?php echo $no ?></td>
		<td class="content-middle"><?php echo $rows['ftp_read_directory']; ?></td>
		<td class="content-middle"><?php echo $rows['ftp_read_filetype']; ?></td>
		<td class="content-middle"><?php echo $rows['ftp_read_ctltype']; ?></td>
		<td class="content-middle"><?php echo $rows['ftp_read_dir_history']; ?></td>
		<td class="content-middle"><?php echo $rows['ftp_read_mode']; ?></td>
		<td class="content-middle"><?php echo $rows['ftp_read_action']; ?></td>
		<td class="content-middle"><?php echo $rows['ftp_read_crontab']; ?></td>
		<td class="content-lasted"><?php echo $rows['ftp_read_createts']; ?></td>
	</tr>	
</tbody>
<?php
	$no++;
};
?>
</table>



