<?php
/* view content data **/


/* view content data **/

foreach( $param['AgentId'] as $num => $AgentId )  
{ 

 if( $Agents = $Users[$AgentId] ) {
 
// get time of the date 
 
	$start_date = _getDateEnglish($param['start_date']);
	$end_date   = _getDateEnglish($param['end_date']);

// create header content 
	

__("<div class='ui-tabs-selected ui-state-active ui-state-focus' 
	 style='padding:4px; width:200px;margin:5px 0px 5px 8px; color:white; 
	 font-weight:bold;background-color:#dee5e7;'> $Agents[name]</div>"); 	
	 
__("<table cellspacing=1 cellpadding=0 class='report data'> 
	<tr height=\"18\">
		<th class=\"ui-state-default ui-corner-top ui-state-focus\" rowspan=\"2\" nowrap>&nbsp;No.&nbsp;</th>
		<th class=\"ui-state-default ui-corner-top ui-state-focus\" rowspan=\"2\" nowrap>&nbsp;Date&nbsp;</th>
		<th class=\"ui-state-default ui-corner-top ui-state-focus\" rowspan=\"2\" nowrap>&nbsp;Login Hour&nbsp;</th>
		<th class=\"ui-state-default ui-corner-top ui-state-focus\" rowspan=\"2\" nowrap>&nbsp;Talk Time&nbsp;</th>
		<th class=\"ui-state-default ui-corner-top ui-state-focus\" rowspan=\"2\" nowrap>&nbsp;Busy&nbsp;</th>
		<th class=\"ui-state-default ui-corner-top ui-state-focus\" rowspan=\"2\" nowrap>&nbsp;ACW&nbsp;</th>
		<th class=\"ui-state-default ui-corner-top ui-state-focus\" rowspan=\"2\" nowrap>&nbsp;Ready&nbsp;</th>
		<th class=\"ui-state-default ui-corner-top ui-state-focus center\" colspan=\"".COUNT($Reason)."\">&nbsp;Not Ready</th>");
		
// automatioc detect
 		
__("<tr height=\"18\">");
	foreach( $Reason as $index => $reason ):
		__("<th class=\"ui-state-default ui-corner-top ui-state-focus\">&nbsp;" . $reason['reason_code']. "&nbsp;</th>");
	endforeach;
__("</tr>");		
		

/** content table of content rows **/
$tots_login_hours = 0;
$tots_talk_times = 0;
$tots_busy_times = 0;
$tots_acw_time = 0;
$tots_ready_time = 0;
$tots_all_reason = null;

$number  = 1;

while(true)  
{
	$percent_connected 	= 0;
	$percent_abandone 	= 0;
	$talktime_agent 	= 0;
	$avg_talk_time		= 0;
	
	$estart_date = $start_date;
	$color = ($number%2!=0?'#FFFEEE':'#FFFFFF');
	$LogiHours = (($view[$AgentId][$estart_date]['busy'])+
				  ($view[$AgentId][$estart_date]['acw'])+
				  ($view[$AgentId][$estart_date]['ready'])+ 
				  ($view[$AgentId][$estart_date]['notready']));
				  
	// content 
	
	__("<tr height='22' bgcolor='{$color}' class='onselect'>
		<td class=\"content-first\">{$number}</td>
		<td class=\"content-middle left\">{$estart_date}</td>
		<td class=\"content-middle right\">"._getDuration($LogiHours)."</td>
		<td class=\"content-middle right\">"._getDuration($view[$AgentId][$estart_date]['TalkTime'])."</td>
		<td class=\"content-middle right\">"._getDuration($view[$AgentId][$estart_date]['busy'])."</td>
		<td class=\"content-middle right\">"._getDuration($view[$AgentId][$estart_date]['acw'])."</td>
		<td class=\"content-middle right\">"._getDuration($view[$AgentId][$estart_date]['ready'])."</td>");
		
	foreach( $Reason as $keys=> $reason ) :
	__("<td class=\"content-lasted right\">"._getDuration($Timer[$AgentId][$estart_date][$reason['reasonid']])."</td>");
		$tots_all_reason[$AgentId][$reason['reasonid']] += $Timer[$AgentId][$estart_date][$reason['reasonid']];
	
	endforeach;
	
	__("</tr>");

// *** test total 
	
	$tots_login_hours += $LogiHours;
	$tots_talk_times += $view[$AgentId][$estart_date]['TalkTime'];
	$tots_busy_times += $view[$AgentId][$estart_date]['busy'];
	$tots_acw_time += $view[$AgentId][$estart_date]['acw'];
	$tots_ready_time += $view[$AgentId][$estart_date]['ready'];

	if ( $start_date == $end_date ) break;
		$start_date = _getNextDate($start_date);

	$number++;	
 }

__("<tr height='22' bgcolor='#eaf6fa'>
	<td class=\"content-first\" colspan=2>&nbsp;<b>Summary</b></td>
	<td class=\"content-middle right\">&nbsp;<b>".($tots_login_hours?_getDuration($tots_login_hours):0)."</b></td>
	<td class=\"content-middle right\">&nbsp;<b>".($tots_talk_times?_getDuration($tots_talk_times):0)."</b></td>
	<td class=\"content-middle right\">&nbsp;<b>".($tots_busy_times?_getDuration($tots_busy_times):0)."</b></td>
	<td class=\"content-middle right\">&nbsp;<b>".($tots_acw_time?_getDuration($tots_acw_time):0)."</b></td>
	<td class=\"content-middle right\">&nbsp;<b>".($tots_ready_time?_getDuration($tots_ready_time):0)."</b></td>");
	foreach( $tots_all_reason[$AgentId] as $rows ) :
		__("<td class=\"content-middle right\">&nbsp;<b>".($rows ? _getDuration($rows) : 0)."</b></td>");
	endforeach;
__("</table>");

}		 



}		 