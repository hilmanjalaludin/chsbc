
<table cellspacing=1 cellpadding=0 width='99%'>
<thead>
<tr height=22 >
	<th class="ui-state-default ui-corner-top ui-state-focus">&nbsp;Tots. Call</th>
	<th class="ui-state-default ui-corner-top ui-state-focus">&nbsp;Conected</th>
	<th class="ui-state-default ui-corner-top ui-state-focus">&nbsp;Abandone</th>
	<th class="ui-state-default ui-corner-top ui-state-focus">&nbsp;(%)&nbsp;Connected</th>
	<th class="ui-state-default ui-corner-top ui-state-focus">&nbsp;(%)&nbsp;Abandone</th>
	<th class="ui-state-default ui-corner-top ui-state-focus">&nbsp;Talk Time</th>
	<th class="ui-state-default ui-corner-top ui-state-focus">&nbsp;Avg Talk</th>
</tr>
</thead>
<tbody>
<?php 
$no = 1;
$total_calls = 0;
$total_connected = 0;
$total_abandone = 0;
$total_talk =0;
foreach( $view as $numbers =>  $rows ) :

	$color 				= ($no%2!=0?'#FFFEEE':'#FFFFFF');
	$percent_connected 	= ($rows['tots']?(round($rows['tot_connected']/$rows['tots'],2)*100) : 0);
	$percent_abandone 	= ($rows['tots']?(round($rows['tot_abandone']/$rows['tots'],2)*100) : 0);
	$talktime_agent 	= _getDuration(($rows['tot_talk']?$rows['tot_talk']:0)); 						
	$avg_talk_time		= _getDuration(($rows['tots']?($rows['tot_talk']/$rows['tot_connected']):0));
	
?>
<tr height='22' bgcolor='<?php __($color); ?>'>
	<td class="content-first right" >&nbsp;<?php __(($rows['tots']?$rows['tots']:0));?></td>
	<td class="content-middle right">&nbsp;<?php __(($rows['tot_connected']?$rows['tot_connected']:0));?></td>
	<td class="content-middle right">&nbsp;<?php __(($rows['tot_abandone']?$rows['tot_abandone']:0));?></td>
	<td class="content-middle right">&nbsp;<?php __($percent_connected);?></td>
	<td class="content-middle right">&nbsp;<?php __($percent_abandone);?></td>
	<td class="content-middle right">&nbsp;<?php __($talktime_agent);?></td>
	<td class="content-lasted right">&nbsp;<?php __($avg_talk_time);?></td>
</tr>
<?php 

$total_calls 	 += $rows['tots'];
$total_connected += $rows['tot_connected'];
$total_abandone  += $rows['tot_abandone'];
$total_talk 	 += $rows['tot_talk'];
$no++; 
endforeach;


$tots_percent_connected = ($total_calls?(round($total_connected/$total_calls,2)*100) : 0);
$tots_percent_abandone 	= ($total_calls?(round($total_abandone/$total_calls,2)*100) : 0);
$tots_talktime_agent 	= _getDuration(($total_talk?$total_talk:0)); 						
$tots_avg_talk_time		= _getDuration(($total_talk?$total_talk/$total_connected:0));

?>
<tr height='22' bgcolor='#eaf6fa'>
	<td class="content-first right">&nbsp;<b><?php __($total_calls);?></b></td>
	<td class="content-middle right">&nbsp;<b><?php __($total_connected);?></b></td>
	<td class="content-middle right">&nbsp;<b><?php __($total_abandone);?></b></td>
	<td class="content-middle right">&nbsp;<b><?php __($tots_percent_connected);?></b></td>
	<td class="content-middle right">&nbsp;<b><?php __($tots_percent_abandone);?></b></td>
	<td class="content-middle right">&nbsp;<b><?php __($tots_talktime_agent );?></b></td>
	<td class="content-lasted right">&nbsp;<b><?php __($tots_avg_talk_time);?></b></td>
</tr>

</tbody>
</table>