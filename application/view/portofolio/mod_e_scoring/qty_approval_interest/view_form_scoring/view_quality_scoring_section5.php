<?php  
if ( $fetchScore != "error" ) {
	$fs = $fetchScore;
	$SSection1 = (object)json_decode($fs->Score_Section5);
} else {
	$fs = "";
	$SSection1 = "";
}
?>
<table name="section1" class="scoring">
	<thead>
		<tr>
			<th>Customer Outcome</th>
			<th>Question</th>
			<th>Answer</th>
			<th>Score</th>
		</tr>
	</thead>

	<tbody>
		<tr rowspan="2">
			<td>Customer Outcome</td>
			<td>Was remedial action required and completed?</td>
			<td class="center">
				<select required="required" triggerto="section5_1_val<?= $formfor; ?>" name="Section5_1" class="section5<?= $formfor; ?>">
					<option value=""   valuejs="0">- choose one -</option>
					<option <?= _selected("Yes",$SSection1->Section5_1); ?> value="Yes" valuejs="0">Yes</option>
					<option <?= _selected("No",$SSection1->Section5_1); ?> value="No" valuejs="0">No</option>
				</select>	
			</td>
			<td class="center">N/A</td>
		</tr>

		<tr>
			<td align="right" colspan="3">Total Score</td>
			<td class="center totalscore_all<?= $formfor; ?> yellow bold">
				<?php echo isset($fs->Enter_New_Score) ? $fs->Enter_New_Score : 0; ?>
			</td>
		</tr>
	</tbody>
</table>