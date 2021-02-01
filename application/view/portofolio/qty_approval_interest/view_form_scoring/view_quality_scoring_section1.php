<?php  
if ( $fetchScore != "error" ) {
	$fs = $fetchScore;
	$SSection1 = (object)json_decode($fs->Score_Section1);
} else {
	$fs = "";
	$SSection1 = "";
}
?>

<table name="section1" class="scoring">
	<thead>
		<tr>
			<th>Call Basics</th>
			<th>Question</th>
			<th>Answer</th>
			<th>Score</th>
		</tr>
	</thead>

	<tbody>
		<tr rowspan="2">
			<td>Call Opening</td>
			<td>Was the agent ready to make call?</td>
			<td class="center">
				<select required="required" triggerto="section1_1_val<?= $formfor; ?>" name="Section1_1" class="section1<?= $formfor; ?>">
					<option value=""    valuejs="0">- choose one -</option>
					<option  <?= _selected("Yes",$SSection1->Section1_1); ?> value="Yes" valuejs="2">Yes</option>
				    <option <?= _selected("No",$SSection1->Section1_1); ?>  value="No"  fatal="true" valuejs="0">No - Section Fail</option>
				</select>	
			</td>
			<td class="center section1_1_val<?= $formfor; ?>">0</td>
		</tr>
		<tr>
			<td></td>
			<td>Was the business standard greeting used?</td>
			<td class="center">
				<select required="required" triggerto="section1_2_val<?= $formfor; ?>" name="Section1_2" class="section1<?= $formfor; ?>">
					<option value=""   valuejs="0">- choose one -</option>
					<option <?= _selected("Yes",$SSection1->Section1_2); ?> value="Yes" valuejs="2">Yes</option>
					<option <?= _selected("No",$SSection1->Section1_2); ?> value="No"  valuejs="0">No</option>
				</select>	
			</td>
			<td class="center section1_2_val<?= $formfor; ?>">0</td>
		</tr>
		<tr>
			<td>Call Closing</td>
			<td>Did the agent close the call correctly? </td>
			<td class="center">
				<select required="required" triggerto="section1_3_val<?= $formfor; ?>" name="Section1_3" class="section1<?= $formfor; ?>">
					<option value=""   valuejs="0">- choose one -</option>
					<option <?= _selected("Yes",$SSection1->Section1_3); ?> value="Yes" valuejs="1">Yes</option>
					<option <?= _selected("No",$SSection1->Section1_3); ?> value="No"  valuejs="0">No</option>
					<option <?= _selected("N/A",$SSection1->Section1_3); ?> value="N/A" jsonfor=".section1_1_val<?= $formfor; ?>,.section1_2_val<?= $formfor; ?>" valuejs="2.5">N/A</option>
				</select>	
			</td>
			<td class="center section1_3_val<?= $formfor; ?>">0</td>
		</tr>
		<tr>
			<td align="right" colspan="3">Section Total</td>
			<td class="center totalscore_section1<?= $formfor; ?> totalsection<?= $formfor; ?>">
				<?php echo isset($fs->TotalScoreSec1) ? $fs->TotalScoreSec1 : 0; ?>
			</td>
		</tr>
	</tbody>
</table>
