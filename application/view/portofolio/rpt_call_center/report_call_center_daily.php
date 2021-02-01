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
	 
__('<table cellspacing=1 cellpadding=0 width="99%">
	<tr height=22 >
	 <th class="ui-state-default ui-corner-top ui-state-focus ">&nbsp;No.</th>
	 <th class="ui-state-default ui-corner-top ui-state-focus">&nbsp;Call</th>
	 <th class="ui-state-default ui-corner-top ui-state-focus">&nbsp;Conected</th>
	 <th class="ui-state-default ui-corner-top ui-state-focus">&nbsp;Abandone</th>
	 <th class="ui-state-default ui-corner-top ui-state-focus">&nbsp;(%)&nbsp;Connected</th>
	 <th class="ui-state-default ui-corner-top ui-state-focus">&nbsp;(%)&nbsp;Abandone</th>
	 <th class="ui-state-default ui-corner-top ui-state-focus">&nbsp;Talk Time</th>
	 <th class="ui-state-default ui-corner-top ui-state-focus">&nbsp;Avg Talk</th>
	</tr>'
);

// echo "<pre>";
// print_r($view);
// echo "</pre>";
/** content table of content rows **/


$total_calls = 0;
$total_connected = 0;
$total_abandone = 0;
$total_talk = 0;
$no  = 0;

while(true)  
{
	$percent_connected 	= 0;
	$percent_abandone 	= 0;
	$talktime_agent 	= 0;
	$avg_talk_time		= 0;
	
	$estart_date 		= $start_date;
	$color 				= ($no%2!=0?'#FFFEEE':'#FFFFFF');
	$percent_connected 	= ($view[$AgentId][$estart_date]['tots_call']?(round($view[$AgentId][$estart_date]['tots_connected']/$view[$AgentId][$estart_date]['tots_call'],2)*100) : 0);
	$percent_abandone 	= ($view[$AgentId][$estart_date]['tots_call']?(round($view[$AgentId][$estart_date]['tots_abandone']/$view[$AgentId][$estart_date]['tots_call'],2)*100) : 0);
	$talktime_agent 	= _getDuration(($view[$AgentId][$estart_date]['tots_talk']?$view[$AgentId][$estart_date]['tots_talk']:0)); 						
	$avg_talk_time		= _getDuration(($view[$AgentId][$estart_date]['tots_call']?($view[$AgentId][$estart_date]['tots_talk']/$view[$AgentId][$estart_date]['tots_connected']):0));
	
	__("<tr height=\"22\" bgcolor=\"$color\">
			 <td class=\"content-first\">$start_date</td>
			 <td class=\"content-middle right\">&nbsp;".(($view[$AgentId][$estart_date]['tots_call']?$view[$AgentId][$estart_date]['tots_call']:'')) ."</td>
			 <td class=\"content-middle right\">&nbsp;".(($view[$AgentId][$estart_date]['tots_connected']?$view[$AgentId][$estart_date]['tots_connected']:'')) ."</td>
			 <td class=\"content-middle right\">&nbsp;".(($view[$AgentId][$estart_date]['tots_abandone']?$view[$AgentId][$estart_date]['tots_abandone']:'')) ."</td>
			 
			 <td class=\"content-middle right\">&nbsp;".(($percent_connected?$percent_connected:'')) ."</td>
			 <td class=\"content-middle right\">&nbsp;".(($percent_abandone?$percent_abandone:'')) ."</td>
			 <td class=\"content-middle right\">&nbsp;".(($talktime_agent?$talktime_agent:'')) ."</td>
			 <td class=\"content-lasted right\">&nbsp;".(($avg_talk_time?$avg_talk_time:0)) ."</td>
	 </tr>" );
		
// sum for bottom data 
	
	$total_calls 	 += $view[$AgentId][$estart_date]['tots_call'];
	$total_connected += $view[$AgentId][$estart_date]['tots_connected'];
	$total_abandone  += $view[$AgentId][$estart_date]['tots_abandone'];
	$total_talk 	 += $view[$AgentId][$estart_date]['tots_talk'];
		  
	if ( $start_date == $end_date ) break;
		$start_date = _getNextDate($start_date);

	$no++;	
 }
 
 // footer calculation
 
 $tots_percent_connected = ($total_calls?(round($total_connected/$total_calls,2)*100) : 0);
 $tots_percent_abandone  = ($total_calls?(round($total_abandone/$total_calls,2)*100) : 0);
 $tots_talktime_agent 	 = _getDuration(($total_talk?$total_talk:0)); 						
 $tots_avg_talk_time	 = _getDuration(($total_talk?$total_talk/$total_connected:0));

 __("<tr height=\"22\" bgcolor=\"#eaf6fa\">
		<td class=\"content-first\" colspan=1>&nbsp;<b>Summary</b></td>
		<td class=\"content-middle right\">&nbsp;<b>".$total_calls."</b></td>
		<td class=\"content-middle right\">&nbsp;<b>".$total_connected."</b></td>
		<td class=\"content-middle right\">&nbsp;<b>".$total_abandone."</b></td>
		<td class=\"content-middle right\">&nbsp;<b>".$tots_percent_connected."</b></td>
		<td class=\"content-middle right\">&nbsp;<b>".$tots_percent_abandone."</b></td>
		<td class=\"content-middle right\">&nbsp;<b>".$tots_talktime_agent."</b></td>
		<td class=\"content-lasted right\">&nbsp;<b>".$tots_avg_talk_time."</b></td>	
	</tr>
	</table>");


}		 



}		 