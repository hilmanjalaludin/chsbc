<table border=0 align="left" cellspacing=1 width="99%">
	<tr height='24'>
		<td class='class="ui-corner-top ui-state-default center' width="5%">No.</td>
		<td class='class="ui-corner-top ui-state-default center'>Province</td>
		<td class='class="ui-corner-top ui-state-default center'>Kota / Kabupaten</td>
		<td class='class="ui-corner-top ui-state-default center'>Kecamatan</td>
		<td class='class="ui-corner-top ui-state-default center'>Kelurahan</td>
		<td class='class="ui-corner-top ui-state-default center'>Zip Code</td>
	</tr>
	<?php
	if(count($datas) > 0)
	{
		$no = 0;
		// echo "<pre>";
		// print_r($datas);
		// echo "</pre>";
		foreach($datas as $key => $rows)
		{
			$no++;
			$color = ($no%2!=0?'#FFFEEE':'#FFFFFF');
	?>
		<tr class="onselect" style="cursor:pointer;" bgcolor="<?php __($color); ?>" height='20' onclick="Ext.DOM.SelectSearch('<?php __($rows['ZipKotaKab']); ?>','<?php __($rows['ZipKecamatan']); ?>','<?php __($rows['ZipKelurahan']); ?>','<?php __($rows['ZipCode']); ?>');">
			<td class="content-first"><?php __($no); ?></td>
			<td class="content-middle">&nbsp;<?php __($rows['Province']); ?></td>
			<td class="content-middle">&nbsp;<?php __($rows['ZipKotaKab']); ?></td>
			<td class="content-middle">&nbsp;<?php __($rows['ZipKecamatan']); ?></td>
			<td class="content-middle">&nbsp;<?php __($rows['ZipKelurahan']); ?></td>
			<td class="content-lasted">&nbsp;<?php __($rows['ZipCode']); ?></td>
		</tr>
	<?php
		}
	}
	?>
</table>