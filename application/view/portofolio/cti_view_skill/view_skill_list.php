<?php ?>

<table width="100%" class="custom-grid" cellspacing="0">
<thead>
	<tr height="20"> 
		<th nowrap class="custom-grid th-first center" width="5%">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('chk_skill').setChecked();">#</a></th>	
		<th nowrap class="custom-grid th-middle">&nbsp;No</th>	
        <th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.domain');">&nbsp;Domain</span></th>
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.skill_code');">&nbsp;Skill Code</span></th>   
		<th nowrap class="custom-grid th-middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.skill_type');">&nbsp;Skill Type</span></th>   
		<th nowrap class="custom-grid th-lasted"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.description');">&nbsp;Description</span></th>  
		
	</tr>
</thead>	
<tbody>
<?php
 $no  = $num;
 foreach( $page -> result_assoc() as $rows ) { 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>	
	<tr CLASS="onselect" bgcolor="<?php echo $color;?>">
		<td class="content-first"><input type="checkbox" value="<?php echo $rows['id']; ?>" name="chk_skill" id="chk_skill"></td>
		<td class="content-middle"><?php echo $no ?></td>
		<td class="content-middle"><?php echo $rows['domain']; ?></td>
		<td class="content-middle"><?php echo $rows['skill_code']; ?></td>
		<td class="content-middle"><?php echo $rows['skill_type']; ?></td>
		<td class="content-lasted"><?php echo $rows['description']; ?></td>
	</tr>	
</tbody>
	<?php
		$no++;
		};
	?>
</table>



