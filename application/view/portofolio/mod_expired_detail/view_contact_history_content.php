<table border=0 align="left" cellspacing=1 width="100%">
<tr height='24'>
	<th class="ui-corner-top ui-state-default first" WIDTH="15%" nowrap>&nbsp;Call Date</td>
	<th class="ui-corner-top ui-state-default first left" WIDTH="15%" nowrap>&nbsp;Agent</td>
	<th class="ui-corner-top ui-state-default first left" WIDTH="25%">&nbsp;Status</td>
	<th class="ui-corner-top ui-state-default first" width="10%" nowrap>&nbsp;Approve Status</td>
	<th class="ui-corner-top ui-state-default first" >&nbsp;Note</td>
</tr>
<?php if(!is_null($CallHistory) && is_array($CallHistory) ) :   ?>
<?php 

	$i = 0;	
	foreach($CallHistory as $rows ) : 
	
		$color = ($i%2!=0?'#FFFEEE':'#FFFFFF');  ?>
<tr class='onselect' bgcolor='<?php __($color);?>'>
	<td class="content-first" WIDTH="12%" nowrap><?php echo date('d-m-Y H:i:s',strtotime($rows['CallHistoryCreatedTs']));?></td>
	<td class="content-middle" WIDTH="12%" nowrap><?php echo $rows['full_name'];?></td>
	<td class="content-middle" WIDTH="17%">
		<div class="text-content left-text" >
			Status (<span class="call-status"><?php echo $rows['CallReasonCategoryName'];?></span>) - No(<span class="call-status" style="font-color:green;"><?php echo ($rows['CallNumber']?$rows['CallNumber']:'xxx');?></span>) - 
			Reason (<span class="result-status"><?php echo $rows['CallReasonDesc'];?></span>)
		</div>
	</td>
	<td class="content-middle center"><div class="text-content justify-center "><span class="call-status"> <?php __($rows['AproveName']);?></span></div></td>
	<td class="content-lasted" style="word-wrap:break-word;" ><div class="text-content justify-text" style="word-wrap:break-word;" ><?php echo $rows['CallHistoryNotes'];?></div></td>
</tr>
<?php $i++; endforeach; ?>
<?php endif; ?>
</table>
