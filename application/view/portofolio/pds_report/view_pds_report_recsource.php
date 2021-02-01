<?php
	$this->load->view('pds_report/view_call_tracking_style');
	// echo "<pre>";
	// print_r($PDSData);
	// echo "</pre>";
?>
<title>PDS Report</title>
PDS Report <br> Date <?=$param['start_date']?> to <?=$param['end_date']?> <br>
Printed By: <?=_get_session('Username')?> <br>
Print Date: <?=date('m/d/Y H:i:s')?><p></p>

<table border=0 cellpadding=1 cellspacing=1 style='border-collapse:collapse;'>
	<tr>
		<td class=xl66>Recsource</td>
		<td class=xl66>Total Data</td>
		<td class=xl66>Total Number PDS Call</td>
		<td class=xl66>Total Data (No Have Phone Number)</td>
		<td class=xl67>Cancel PDS</td>
		<td class=xl66>UnContacted</td>
		<td class=xl66>Receive Agent</td>
		<td class=xl66>Not Yet Call</td>
		<td class=xl66>Abandon</td>
	</tr>
	<?php
		foreach($PDSData as $Recs => $Rows){
			echo "<tr calss=x174>";
				foreach($Rows as $val){
					echo "<td class=xl71>".$val."</td>";
				}
			$SumTot	 +=$Rows['Total'];
			$SumCall +=$Rows['TotalCall'];
			$SumLig  +=$Rows['lightening'];
			$SumCan  +=$Rows['Cancel'];
			$SumNot  +=$Rows['Notyet'];
			$SumUnc  +=$Rows['Uncontacted'];
			$SumSuc  +=$Rows['Success'];
			$SumAbd  +=$Rows['Abandon'];
			echo "</tr>";
		}
	?>
	<tr>
		<td class=xl66>Total</td>
		<td class=xl66><?php echo $SumTot; ?></td>
		<td class=xl66><?php echo $SumCall; ?></td>
		<td class=xl66><?php echo $SumLig; ?></td>
		<td class=xl66><?php echo $SumCan; ?></td>
		<td class=xl66><?php echo $SumUnc; ?></td>
		<td class=xl66><?php echo $SumSuc; ?></td>
		<td class=xl66><?php echo $SumNot; ?></td>
		<td class=xl86><?php echo $SumAbd; ?></td>
	</tr>
</table>