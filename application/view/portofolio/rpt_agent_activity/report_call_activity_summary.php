<?php
$no = 1;
$total_calls = 0;
$total_connected = 0;
$total_abandone = 0;
$total_talk =0;

// table main content grider 

__("<table cellspacing=1 cellpadding=0 class='report data'> 
		<tr height=\"18\">
			<th class=\"ui-state-default ui-corner-top ui-state-focus\" rowspan=\"2\" nowrap>&nbsp;No.&nbsp;</th>
			<th class=\"ui-state-default ui-corner-top ui-state-focus\" rowspan=\"2\" nowrap>&nbsp;Username&nbsp;</th>
			<th class=\"ui-state-default ui-corner-top ui-state-focus\" rowspan=\"2\" nowrap>&nbsp;Login Hour&nbsp;</th>
			<th class=\"ui-state-default ui-corner-top ui-state-focus\" rowspan=\"2\" nowrap>&nbsp;Talk Time&nbsp;</th>
			<th class=\"ui-state-default ui-corner-top ui-state-focus\" rowspan=\"2\" nowrap>&nbsp;Busy&nbsp;</th>
			<th class=\"ui-state-default ui-corner-top ui-state-focus\" rowspan=\"2\" nowrap>&nbsp;ACW&nbsp;</th>
			<th class=\"ui-state-default ui-corner-top ui-state-focus\" rowspan=\"2\" nowrap>&nbsp;Ready&nbsp;</th>
			<th class=\"ui-state-default ui-corner-top ui-state-focus center\" colspan=\"".COUNT($Reason)."\">&nbsp;Not Ready</th>
		</tr>");
		
// automatioc detect
 		
__("<tr height=\"18\">");
	foreach( $Reason as $index => $reason ):
		__("<th class=\"ui-state-default ui-corner-top ui-state-focus\">&nbsp;" . $reason['reason_code']. "&nbsp;</th>");
	endforeach;
__("</tr>");		


// content data grid OR rows 
$number = 1;

$tots_login_hours = 0;
$tots_talk_times = 0;
$tots_busy_times = 0;
$tots_acw_time = 0;
$tots_ready_time = 0;
$tots_all_reason = null;

 
foreach( $param['AgentId'] as $num => $AgentId )
{
  
  $color = ($number%2!=0?'#FFFEEE':'#FFFFFF');
	
  if( $Agents = $Users[$AgentId] )
  {
	$LogiHours = (($view[$AgentId]['busy'])+
				  ($view[$AgentId]['acw'])+
				  ($view[$AgentId]['ready'])+ 
				  ($view[$AgentId]['notready']));
				  
	
		__("<tr height='22' bgcolor='{$color}' class='onselect'>
		<td class=\"content-first\">{$number}</td>
		<td class=\"content-middle left\">{$Agents['name']}</td>
		<td class=\"content-middle right\">"._getDuration($LogiHours)."</td>
		<td class=\"content-middle right\">"._getDuration($view[$AgentId]['TalkTime'])."</td>
		<td class=\"content-middle right\">"._getDuration($view[$AgentId]['busy'])."</td>
		<td class=\"content-middle right\">"._getDuration($view[$AgentId]['acw'])."</td>
		<td class=\"content-middle right\">"._getDuration($view[$AgentId]['ready'])."</td>"
	  );
		
		foreach( $Reason as $keys=> $reason ) :
			__("<td class=\"content-lasted right\">"._getDuration($Timer[$AgentId][$reason['reasonid']])."</td>");
			$tots_all_reason[$reason['reasonid']] += $Timer[$AgentId][$reason['reasonid']];
		endforeach;
	__("</tr>");

// *** test total 
	
	$tots_login_hours += $LogiHours;
	$tots_talk_times += $view[$AgentId]['TalkTime'];
	$tots_busy_times += $view[$AgentId]['busy'];
	$tots_acw_time += $view[$AgentId]['acw'];
	$tots_ready_time += $view[$AgentId]['ready'];
 }	
 
$number++;
}


__("<tr height='22' bgcolor='#eaf6fa'>
	<td class=\"content-first\" colspan=2>&nbsp;<b>Summary</b></td>
	<td class=\"content-middle right\">&nbsp;<b>"._getDuration($tots_login_hours)."</b></td>
	<td class=\"content-middle right\">&nbsp;<b>"._getDuration($tots_talk_times)."</b></td>
	<td class=\"content-middle right\">&nbsp;<b>"._getDuration($tots_busy_times)."</b></td>
	<td class=\"content-middle right\">&nbsp;<b>"._getDuration($tots_acw_time)."</b></td>
	<td class=\"content-middle right\">&nbsp;<b>"._getDuration($tots_ready_time)."</b></td>");
	foreach( $tots_all_reason as $k => $rows ):
		__("<td class=\"content-middle right\">&nbsp;<b>". _getDuration($rows)."</b></td>");
	endforeach;
__("</table>");

?>