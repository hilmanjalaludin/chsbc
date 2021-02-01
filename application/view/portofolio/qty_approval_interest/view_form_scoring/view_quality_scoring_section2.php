<?php  
if ( $fetchScore != "error" ) {
	$fs = $fetchScore;
	$SSection1 = (object)json_decode($fs->Score_Section2);
} else {
	$fs = "";
	$SSection1 = "";
}
?>
<table name="section2" class="scoring">
	<thead>
		<tr>
			<th>Call Quality</th>
			<th>Question</th>
			<th>Answer</th>
			<th>Score</th>
		</tr>
	</thead>

	<tbody>
		<tr rowspan="2">
			<td>Rapport</td>
			<td>What level of rapport did the agent display to engage the customer?</td>
			<td class="center">
				<select required="required" triggerto="section2_1_val<?= $formfor; ?>" name="Section2_1" appendto="call_quality1" class="section2<?= $formfor; ?>">
					<option value=""   valuejs="0">- choose one -</option>
					<option <?= _selected("Outstanding",$SSection1->Section2_1); ?> value="Outstanding" valuejs="15">Outstanding</option>
					<option <?= _selected("Strong",$SSection1->Section2_1); ?> value="Strong" valuejs="10">Strong</option>
					<option <?= _selected("Needs Improvement",$SSection1->Section2_1); ?> value="Needs Improvement" valuejs="5">Needs Improvement</option>
					<option <?= _selected("Below Standard",$SSection1->Section2_1); ?> value="Below Standard"  fatal="true" valuejs="0">Below Standard</option>
				</select>	
			</td>
			<td class="center section2_1_val<?= $formfor; ?>">0</td>
		</tr>
		<tr>
			<td>Ownership</td>
			<td>What level of ownership did the agent display?</td>
			<td class="center">
				<select required="required" triggerto="section2_2_val<?= $formfor; ?>" name="Section2_2" appendto="call_quality2" class="section2<?= $formfor; ?>">
					<option value=""   valuejs="0">- choose one -</option>
					<option <?= _selected("Outstanding",$SSection1->Section2_2); ?> value="Outstanding" valuejs="15">Outstanding</option>
					<option <?= _selected("Strong",$SSection1->Section2_2); ?> value="Strong" valuejs="10">Strong</option>
					<option <?= _selected("Needs Improvement",$SSection1->Section2_2); ?> value="Needs Improvement" valuejs="5">Needs Improvement</option>
					<option <?= _selected("Below Standard",$SSection1->Section2_2); ?> value="Below Standard" fatal="true" valuejs="0">Below Standard</option>
				</select>	
			</td>
			<td class="center section2_2_val<?= $formfor; ?>">0</td>
		</tr>
		<tr>
			<td>Communication</td>
			<td>How effective were the agent's communication skills? </td>
			<td class="center">
				<select required="required" triggerto="section2_3_val<?= $formfor; ?>" name="Section2_3" appendto="call_quality3" class="section2<?= $formfor; ?>">
					<option value=""   valuejs="0">- choose one -</option>
					<option <?= _selected("Outstanding",$SSection1->Section2_3); ?> value="Outstanding" valuejs="15">Outstanding</option>
					<option <?= _selected("Strong",$SSection1->Section2_3); ?> value="Strong" valuejs="10">Strong</option>
					<option <?= _selected("Needs Improvement",$SSection1->Section2_3); ?> value="Needs Improvement" valuejs="5">Needs Improvement</option>
					<option <?= _selected("Below Standard",$SSection1->Section2_3); ?> value="Below Standard"  fatal="true" valuejs="0">Below Standard</option>
				</select>
			</td>
			<td class="center section2_3_val<?= $formfor; ?>">0</td>
		</tr>
		<tr>
			<td align="right" colspan="3">Section Total</td>
			<td class="center totalscore_section2<?= $formfor; ?> totalsection<?= $formfor; ?>">
				<?php echo isset($fs->TotalScoreSec2) ? $fs->TotalScoreSec2 : 0; ?>
			</td>
		</tr>
	</tbody>
</table>