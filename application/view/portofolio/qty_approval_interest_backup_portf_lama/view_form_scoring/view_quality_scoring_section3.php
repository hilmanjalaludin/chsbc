<?php  
if ( $fetchScore != "error" ) {
	$fs = $fetchScore;
	$SSection1 = (object)json_decode($fs->Score_Section3);
} else {
	$fs = "";
	$SSection1 = "";
}
?>
<table name="section1" class="scoring">
	<thead>
		<tr>
			<th>Customer Needs</th>
			<th>Question</th>
			<th>Answer</th>
			<th>Score</th>
		</tr>
	</thead>

	<tbody>
		<tr rowspan="2">
			<td>Sales Optimized</td>
			<td>Did the agent clearly communicate  the reason for the call and further engage the customer?<br>
			What was the method of identification of customer's needs? (only if above question is a "Yes")</td>
			<td class="center">
				<select required="required" triggerto="section3_1_val<?= $formfor; ?>" name="Section3_1" class="section3<?= $formfor; ?>">
					<option value=""   valuejs="0">- choose one -</option>
					<option <?= _selected("Yes",$SSection1->Section3_1); ?> value="Yes" valuejs="8">Yes</option>
					<option <?= _selected("Yes",$SSection1->Section3_1); ?> value="No"  fatal="true" valuejs="0">No</option>
				</select>	
			</td>
			<td class="center section3_1_val<?= $formfor; ?>">0</td>
		</tr>
		<tr>
			<td></td>
			<td>Did the agent accurately explain product/ service features and benefits and channels available?</td>
			<td class="center">
				<select required="required" triggerto="section3_2_val<?= $formfor; ?>" name="Section3_2" class="section3<?= $formfor; ?>">
					<option value=""   valuejs="0">- choose one -</option>
					<option <?= _selected("Yes",$SSection1->Section3_2); ?> value="Yes" valuejs="4">Yes</option>
					<option <?= _selected("No", $SSection1->Section3_2); ?> value="No"  valuejs="0">No</option>
				</select>	
			</td>
			<td class="center section3_2_val<?= $formfor; ?>">0</td>
		</tr>
		<tr>
			<td></td>
			<td>Did the agent acknowledge concerns raised by the customer and provide clarification so the customer could make an informed decision?</td>
			<td class="center">
				<select required="required" triggerto="section3_3_val<?= $formfor; ?>" name="Section3_3" class="section3<?= $formfor; ?>">
					<option value=""   valuejs="0">- choose one -</option>
					<option <?= _selected("Yes",$SSection1->Section3_3); ?> value="Yes" valuejs="4">Yes</option>
					<option <?= _selected("No",$SSection1->Section3_3); ?> value="No"  valuejs="0">No</option>
				</select>
			</td>
			<td class="center section3_3_val<?= $formfor; ?>">0</td>
		</tr>
		<tr>
			<td></td>
			<td>Did the agent ask the customer to accept the offer/Individual Solution or agree to next steps?</td>
			<td class="center">
				<select required="required" triggerto="section3_4_val<?= $formfor; ?>" name="Section3_4" class="section3<?= $formfor; ?>">
					<option value=""   valuejs="0">- choose one -</option>
					<option <?= _selected("Yes",$SSection1->Section3_4); ?> value="Yes" valuejs="4">Yes</option>
					<option <?= _selected("No",$SSection1->Section3_4); ?> value="No"  valuejs="0">No</option>
				</select>
			</td>
			<td class="center section3_4_val<?= $formfor; ?>">0</td>
		</tr>
		<tr>
			<td align="right" colspan="3">Section Total</td>
			<td class="center totalscore_section3<?= $formfor; ?> totalsection<?= $formfor; ?>">0</td>
		</tr>
	</tbody>
</table>