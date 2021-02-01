<?php ?>
<table class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th width="2%"  nowrap class="custom-grid th-first center">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_cmp').setChecked();">#</a></th>		
		<th width="5%"  nowrap class="custom-grid th-middle left">&nbsp;No</th>
		<th width="10%" nowrap class="custom-grid th-middle left">&nbsp;<span class="header_order" id ="a.CampaignNumber" onclick="Ext.EQuery.orderBy(this.id);">Campaign ID.</th>     
		<th width="10%" nowrap class="custom-grid th-middle left">&nbsp;<span class="header_order" id ="a.CampaignName" onclick="Ext.EQuery.orderBy(this.id);">Campaign Name.</th> 
		<th width="10%" nowrap class="custom-grid th-middle left">&nbsp;<span class="header_order" id ="b.Description" onclick="Ext.EQuery.orderBy(this.id);">Call Type.</th> 
		<th width="20%" nowrap class="custom-grid th-middle center">&nbsp;<span class="header_order" id ="a.CampaignId" onclick="Ext.EQuery.orderBy(this.id);">Data Size.</th>        
		<th width="20%" nowrap class="custom-grid th-lasted center">&nbsp;<span class="header_order" id ="a.CampaignId" onclick="Ext.EQuery.orderBy(this.id);">Available Size.</th>        
        
	</tr>
</thead>	
<tbody>
<?php
$no  = $num;
foreach( $page -> result_assoc() as $rows )
{ 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF'); ?>
	
	<tr class="onselect" bgcolor="<?php echo $color;?>">
		<td class="content-first"><input type="checkbox" value="<?php echo $rows['CampaignId']; ?>" id="chk_cmp" name="chk_cmp"></td>
		<td class="content-middle"><?php echo $no; ?></td>
		<td class="content-middle"><?php echo $rows['CampaignNumber'];?></td>
		<td class="content-middle"><b style="color:green;"><?php echo $rows['CampaignName'];?></b></td>
		<td class="content-middle"><?php echo $rows['Description'];?></b></td>
		<td class="content-middle" align="center"><?php echo $Model -> _get_count_privileges($rows['CampaignId'],1); ?></td>
		<td class="content-lasted" align="center"><?php echo 0; ?></td>
	</tr>			
</tbody>
<?php $no++; }; ?>
</table>