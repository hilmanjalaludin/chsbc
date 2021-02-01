<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 *  @ def   : mod_view_field/view_setfield_list.php 
 * -------------------------------------------------------------------------
 *  @ param : unit layout attribute list page 
 *  @ param : - 
 * -------------------------------------------------------------------------
 */
 
?>


<table width="100%" class="custom-grid" cellspacing="1">
<thead>
	<tr height="24"> 
		<th nowrap class="font-standars ui-corner-top ui-state-default first center" width="5%">&nbsp;<a href="javascript:void(0);" onclick="Ext.Cmp('Field_Id').setChecked();">#</a></th>	
		<th nowrap class="font-standars ui-corner-top ui-state-default middle center">&nbsp;No</th>	
        <th nowrap class="font-standars ui-corner-top ui-state-default middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.GroupName');">&nbsp;Group Name <span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.GroupDescription');">&nbsp;Group Description</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default middle"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('b.GroupCallId');">&nbsp;Direction</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default center"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.Field_Size');">&nbsp;User Capacity</span></th>
		<th nowrap class="font-standars ui-corner-top ui-state-default middle center"><span class="header_order" onclick="JavaScript:Ext.EQuery.orderBy('a.GroupFlags');">&nbsp;Status</span></th>
	</tr>
</thead>	
<tbody>
<?php
 $no  = $num;
 foreach( $page -> result_assoc() as $rows ) { 
	$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
?>	
	<tr CLASS="onselect" bgcolor="<?php echo $color;?>">
		<td class="content-first center"><input type="checkbox" value="<?php __($rows['GroupId']); ?>" name="GroupId" id="GroupId"></td>
		<td class="content-middle center"><?php echo $no ?></td>
		<td class="content-middle"><?php __($rows['GroupName']); ?></td>
		<td class="content-middle"><?php __($rows['GroupDescription']); ?></td>
		<td class="content-middle"><?php __($rows['Direction']); ?></td>
		<td class="content-middle center"><?php __($rows['UserCapacity']); ?></td>
		<td class="content-lasted center"><?php __(($rows['GroupFlags']?'Active' : 'Not Active')); ?></td>
	</tr>	
</tbody>
	<?php
		$no++;
		};
	?>
</table>
