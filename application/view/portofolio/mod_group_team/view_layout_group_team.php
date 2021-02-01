<?php  
/* loader HTML **/

$this->load->helper('EUI_Html');

__(doctype());
__(html('start'));
__(head('start'));
	__(title('View Group Team'));
	__(link_tag(array('type'=> 'text/css','rel'=> 'stylesheet','href'=> base_themes_style($website['_web_themes']). '/ui.all.css?time='. time())));		
	__(link_tag(array('type'=> 'text/css', 'rel'=> 'stylesheet', 'href'=> base_layout_style(). '/styles.cores.css?time='. time())));	
__(head('stop'));
__(body('start'));
__("<fieldset class='corner' style='margin:10px;'> 
	<legend class='icon-menulist'>&nbsp;&nbsp;Group Team 01</legend>
	<div>
		<table width='100%'>
			<tr>
				<td class='font-standars ui-corner-top ui-state-default middle center'> No </td>
				<td class='font-standars ui-corner-top ui-state-default middle center'> User Name </td>
			</tr>");
				
				$no = 1;
				foreach( $UserTeam as $key => $rows )
				{
					$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
					
					__("<tr bgcolor='". $color ."' class='onselect' style='cursor:pointer;'> 
						<td class='content-first ' width='10%'>{$no}</td> <td class='content-middle'>". strtoupper($rows['full_name']) . "</td> </tr>");
					$no++;
				} 
		__("</table>
	</div>
</fieldset>");

__(body('stop'));
__(html('stop'));