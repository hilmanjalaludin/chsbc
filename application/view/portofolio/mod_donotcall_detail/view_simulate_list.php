<table border=0 align="left" cellspacing=1 width="100%">
	<tr height='24'>
		<td class='class="ui-corner-top ui-state-default center'>Group Premi</td>
		<td class='class="ui-corner-top ui-state-default center'>Gender</td>
		<td class='class="ui-corner-top ui-state-default center'>Payment Mode</td>
		<td class='class="ui-corner-top ui-state-default center'>Plan</td>
		<td class='class="ui-corner-top ui-state-default center'>Premi (IDR)</td>
	</tr>
<?php 

$no = 0;

if(is_array($ProductSimulate) ) 
foreach( $ProductSimulate as $key => $rows )
{
	$color = ($key%2!=0?'#FFFEEE':'#FFFFFF');  
	$row = new EUI_Object( $rows );
?>
	<tr height='20' class='onselect' bgcolor='<?php echo $color;?>'>
		<td class="content-first"><b style='color:red;'><?php echo $row->get_value('PremiumGroupName'); ?><b></td>
		<td class="content-middle left"><?php echo $row->get_value('Gender','strtoupper'); ?></td>
		<td class="content-middle center"><?php echo $row->get_value('PayMode','strtoupper'); ?></td>
		<td class="content-middle left"><?php echo $row->get_value('ProductPlanName','strtoupper'); ?></td>
		<td class="content-lasted right"><?php echo $row->get_value('ProductPlanPremium','_getCurrency'); ?></td>
	</tr>
<?php }; ?>
</table>
