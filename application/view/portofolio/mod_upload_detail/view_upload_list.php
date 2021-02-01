<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		
		<th nowrap class="custom-grid th-first center">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('ftp_upload_id').setChecked();" >#</a></th>  
		<th nowrap class="custom-grid th-middle">&nbsp;No</th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.FTP_UploadType');"><b style='color:#608ba9;'>Source</b></span></th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.FTP_UploadFilename');"><b style='color:#608ba9;'>File Name</b></span></th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.FTP_UploadRows');"><b style='color:#608ba9;'>Total Data</b></span></th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.FTP_UploadSuccess');"><b style='color:#608ba9;'>Success</b></span></th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.FTP_UploadDuplicate');"><b style='color:#608ba9;'>Duplicate</b></span></th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.FTP_UploadFailed');"><b style='color:#608ba9;'>Failed</b></span></th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;<b style='color:#608ba9;'>Status</b></th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.FTP_Flags');"><b style='color:#608ba9;'>Hidden</b></span></th>
		<th nowrap class="custom-grid th-middle" align="left">&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.FTP_UploadDateTs');"><b style='color:#608ba9;'>Upload Date</b></span></th>
		<th nowrap class="custom-grid th-lasted" align="left">&nbsp;<span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.FTP_UploadBy');"><b style='color:#608ba9;'>Upload By</b></span></th>
		
	</tr>
</thead>	
<tbody>
<?php
$no = $num;
foreach( $page -> result_assoc() as $rows )
{ 
  $color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
  
  // file information status 
  
  $_full_name = basename($rows['FTP_UploadFilename']);
  $_full_path = str_replace('system/', APPPATH, BASEPATH).'temp/'. $_full_name;
	
 // status 
 
  $file_existing = ( file_exists($_full_path) ? 'files are still available': 'files have been deleted');  	
		
 ?>
	<tr class="onselect">
		<td class="content-first center"><?php echo form() -> checkbox('ftp_upload_id',null, $rows['FTP_UploadId']); ?>
		<td class="content-middle">&nbsp;<?php echo $no; ?></td>	
		<td align="left" class="content-middle"><b style="color:green;"><?php echo $rows['FTP_UploadType'];?></td>
		<td align="left" class="content-middle"><b style="color:green;"><?php echo $rows['FTP_UploadFilename'];?></td>
		<td align="left" class="content-middle right"><?php echo ($rows['FTP_UploadRows'] ?$rows['FTP_UploadRows']:0); ?></td>
		<td align="left" class="content-middle right"><?php echo ($rows['FTP_UploadSuccess']?$rows['FTP_UploadSuccess']:0); ?></td>
		<td align="left" class="content-middle right"><?php echo ($rows['FTP_UploadDuplicate']?$rows['FTP_UploadDuplicate']:0); ?></td>
		<td align="left" class="content-middle right"><?php echo ($rows['FTP_UploadFailed']?$rows['FTP_UploadFailed']:0); ?></td>
		<td align="left" class="content-middle"><?php echo $file_existing; ?></td>
		<td align="left" class="content-middle"><?php echo ($rows['FTP_Flags']?'Show':'Hidden'); ?></td>
		<td align="left" class="content-middle left"><?php echo ($rows['FTP_UploadDateTs']?$rows['FTP_UploadDateTs']:'-'); ?></td>
		<td align="left" class="content-lasted left"><?php echo ($rows['FTP_UploadBy']?$rows['FTP_UploadBy']:'-'); ?></td>
	</tr>	
			
</tbody><?php
	$no++;
};
?>
</table>



