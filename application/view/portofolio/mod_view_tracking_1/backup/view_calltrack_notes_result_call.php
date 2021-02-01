<?php 
if( is_array( $call_notes ) ) 
{

echo "<table border=0 cellpadding=0 cellspacing=0 class='xl6710476'>
	<tr height='28'>
		<td class='xl6510476 border-h1-top-yes-left-none'>Category</td>
		<td class='xl6510476 border-h2-top-yes-left-none'>Code</td>
		<td class='xl6510476 border-h3-top-yes-left-none'>Detail</td>
	</tr>";
	
	$xls_val = 0;
	if( is_array($call_notes) 
		AND count($call_notes) > 0 )
		foreach( $call_notes as $rows )
	{
		$bg_color = ( $xls_val % 2 == 1 ? "#FFFFFF" : "#FFFFEE");
		
		$out = new EUI_Object( $rows );
		echo "<tr bgcolor='{$bg_color}' height='25'>
				<td class='xl7010476 border-h1-top-yes-left-none font-size-12-color-696868 font-weight-normal'>{$out->get_value('Kategory')}</td>
				<td class='xl7010476 border-top-none-left-none font-size-12-color-696868 font-weight-bold'>{$out->get_value('Kode')}</td>
				<td class='xl7010476 border-top-none-left-none font-size-12-color-696868 font-weight-normal'>{$out->get_value('Detail')}</td>
			  </tr>";
		$xls_val++;	  
	}		  
	echo "</table>";
}	
?>