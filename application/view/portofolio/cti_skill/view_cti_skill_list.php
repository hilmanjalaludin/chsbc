<?php
?>

<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first" width="5%">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_ext').setChecked();">#</a></th>	
		<th nowrap class="custom-grid th-middle" width="5%">&nbsp;No.</th>	
		<th nowrap class="custom-grid th-middle center">&nbsp;<span class="header_order" id ="a.score" onclick="Ext.EQuery.orderBy(this.id);">User Score</span></th>
		<th nowrap class="custom-grid th-middle left">&nbsp;<span class="header_order" id ="b.name"  onclick="Ext.EQuery.orderBy(this.id);">User Name</span></th>
		<th nowrap class="custom-grid th-middle left">&nbsp;<span class="header_order" id ="c.skill_code"  onclick="Ext.EQuery.orderBy(this.id);">User Skill</span></th>        
        <th nowrap class="custom-grid th-lasted left">&nbsp;<span class="header_order" id ="c.description"   onclick="Ext.EQuery.orderBy(this.id);">Description</span> </th>
		
		
	</tr>
</thead>	
<tbody>
<?php
 $no  = $num;
 foreach( $page -> result_assoc() as $rows )
 { 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>	
		<tr class="onselect" bgcolor="<?php echo $color;?>">
			<td class="content-first"><input type="checkbox" value="<?php echo $rows['id']; ?>" name="chk_ext" id="chk_ext"></td>
			<td class="content-middle center"><?php echo $no; ?></td>
			<td class="content-middle center" ><?php echo (isset($rows['score'])?$rows['score']:null); ?></td>
			<td class="content-middle" style="color:blue;"><?php echo (isset($rows['name'])?$rows['name']:null); ?></td>
			<td class="content-middle"><?php echo (isset($rows['skill_code'])?$rows['skill_code']:null); ?></td>
			<td class="content-lasted"><?php echo (isset($rows['description'])?$rows['description']:'-'); ?></td>
		</tr>		
</tbody>
<?php
	$no++;
};
?>
</table>