<?php  
if ( $fetchScore != "error" ) {
	$fs = $fetchScore;
	$SSection1 = (object)json_decode($fs->Score_Section4);
} else {
	$fs = "";
	$SSection1 = "";
}
?>
<table name="section1" class="scoring">
	<thead>
		<tr>
			<th>Technical Adherence</th>
			<th>Question</th>
			<th>Answer</th>
			<th>Score</th>
		</tr>
	</thead>

	<tbody>
		<tr rowspan="2">
			<td>Internal P & P</td>
			<td>Did the agent follow proper policies and procedures?</td>
			<td class="center">
				<select required="required" triggerto="section4_1_val<?= $formfor; ?>" name="Section4_1" class="section4<?= $formfor; ?>">
					<option value=""   valuejs="0">- choose one -</option>
					<option <?= _selected("Yes",$SSection1->Section4_1); ?> value="Yes" valuejs="10">Yes</option>
					<option <?= _selected("Minor Error",$SSection1->Section4_1); ?> value="Minor Error"  valuejs="5">Minor Error</option>
					<option <?= _selected("Major Error",$SSection1->Section4_1); ?> value="Major Error"  valuejs="0">Major Error</option>
					<option <?= _selected("Major Error - Section Fail",$SSection1->Section4_1); ?> value="Major Error - Section Fail" fatal="true"  valuejs="0">Major Error - Section Fail</option>
				</select>	
			</td>
			<td class="center section4_1_val<?= $formfor; ?>">0</td>
		</tr>
		<tr>
			<td>Reg & CMP Stand.</td>
			<td>Did the agent follow the correct regulation and compliance standards ?</td>
			<td class="center">
				<select required="required" triggerto="section4_2_val<?= $formfor; ?>" name="Section4_2" class="fatalityform_1 section4<?= $formfor; ?>">
					<option value=""   valuejs="0">- choose one -</option>
					<option <?= _selected("Yes",$SSection1->Section4_2); ?> value="Yes" valuejs="20">Yes</option>
					<option <?= _selected("Minor Error",$SSection1->Section4_2); ?> value="Minor Error" valuejs="10">Minor Error</option>
					<option <?= _selected("Major Error - Section Fail",$SSection1->Section4_2); ?> value="Major Error - Section Fail" fatal="true"  valuejs="0">Major Error - Section Fail</option>
					<option <?= _selected("Major Error - Form Fail",$SSection1->Section4_2); ?> value="Major Error - Form Fail" fatality="true" valuejs="0">Major Error - Form Fail</option>
				</select>	
			</td>
			<td class="center section4_2_val<?= $formfor; ?>">0</td>
		</tr>
		<tr>
			<td align="right" colspan="3">Section Total</td>
			<td class="center totalscore_section4<?= $formfor; ?> totalsection<?= $formfor; ?>">
				<?php echo isset($fs->TotalScoreSec4) ? $fs->TotalScoreSec4 : 0; ?>
			</td>
		</tr>
	</tbody>
</table>