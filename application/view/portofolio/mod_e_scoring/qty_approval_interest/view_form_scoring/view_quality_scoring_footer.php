<?php  
if ( $fetchScore != "error" ) {
	$fs = $fetchScore;
} else {
	$fs = "";
}
?>
<table class="scoring">
	<tbody>
		<tr>
			<td style="background:#deedf7;">General Call Feedback</td>
			<td class="center">
				<textarea name="General_Call_Feedback" class="section1"><?= $fs->General_Call_Feedback; ?></textarea>
			</td>
		</tr>
	</tbody>
</table>



<table class="scoring">
	<thead>
		<tr>
			<th>Call Quality</th>
			<th>Rating</th>
			<th>Attribute 1</th>
			<th>Attribute 2</th>
			<th>Attribute 3</th>
			<th>Attribute 4</th>
			<th>Attribute 5</th>
		</tr>
	</thead>

	<tbody>
		<tr>
			<td>Rapport</td>
			<td><input type="text" value="<?= $fs->CQ_Rating_Rapport; ?>" name="CQ_Rating_Rapport" class="call_quality1 required_scoring"></td>
			<td>
				<select name="Rapport_Attr1">
					<option <?= _selected("",$fs->Rapport_Attr1); ?> value=""> - </option>
					<option <?= _selected("Outstanding - R01 (Genuine empathy displayed)",$fs->Rapport_Attr1); ?> value="Outstanding - R01 (Genuine empathy displayed)">Outstanding - R01 (Genuine empathy displayed)</option>
					<option <?= _selected("Outstanding - R02 (Free information  used)",$fs->Rapport_Attr1); ?> value="Outstanding - R02 (Free information  used)">Outstanding - R02 (Free information  used)</option>
					<option <?= _selected("Outstanding - R03 (Good relationship built)",$fs->Rapport_Attr1); ?> value="Outstanding - R03 (Good relationship built)">Outstanding - R03 (Good relationship built)</option>
					<option <?= _selected("Strong - R04 (Demonstrated empathy where appropriate)",$fs->Rapport_Attr1); ?> value="Strong - R04 (Demonstrated empathy where appropriate)">Strong - R04 (Demonstrated empathy where appropriate)</option>
					<option <?= _selected("Strong - R05 (Free information acknowledged)",$fs->Rapport_Attr1); ?> value="Strong - R05 (Free information acknowledged)">Strong - R05 (Free information acknowledged)</option>
					<option <?= _selected("Strong - R06 (Interest shown in the customer)",$fs->Rapport_Attr1); ?> value="Strong - R06 (Interest shown in the customer)">Strong - R06 (Interest shown in the customer)</option>
					<option <?= _selected("Needs Improvement - R07 (Limited Empathy)",$fs->Rapport_Attr1); ?> value="Needs Improvement - R07 (Limited Empathy)">Needs Improvement - R07 (Limited Empathy)</option>
					<option <?= _selected("Needs Improvement - R08 (Free information  is not acknowledged)",$fs->Rapport_Attr1); ?> value="Needs Improvement - R08 (Free information  is not acknowledged)">Needs Improvement - R08 (Free information  is not acknowledged)</option>
					<option <?= _selected("Needs Improvement - R09 (Focus on the transaction)",$fs->Rapport_Attr1); ?> value="Needs Improvement - R09 (Focus on the transaction)">Needs Improvement - R09 (Focus on the transaction)</option>
					<option <?= _selected("Below Standard - R10 (Customer dissatisfaction issue)",$fs->Rapport_Attr1); ?> value="Below Standard - R10  (Customer dissatisfaction issue)">Below Standard - R10 (Customer dissatisfaction issue)</option>
				</select>
			</td>
			<td>
				<select name="Rapport_Attr2">
					<option <?= _selected("",$fs->Rapport_Attr2); ?> value=""> - </option>
					<option <?= _selected("Outstanding - R01 (Genuine empathy displayed)",$fs->Rapport_Attr2); ?> value="Outstanding - R01 (Genuine empathy displayed)">Outstanding - R01 (Genuine empathy displayed)</option>
					<option <?= _selected("Outstanding - R02 (Free information  used)",$fs->Rapport_Attr2); ?> value="Outstanding - R02 (Free information  used)">Outstanding - R02 (Free information  used)</option>
					<option <?= _selected("Outstanding - R03 (Good relationship built)",$fs->Rapport_Attr2); ?> value="Outstanding - R03 (Good relationship built)">Outstanding - R03 (Good relationship built)</option>
					<option <?= _selected("Strong - R04 (Demonstrated empathy where appropriate)",$fs->Rapport_Attr2); ?> value="Strong - R04 (Demonstrated empathy where appropriate)">Strong - R04 (Demonstrated empathy where appropriate)</option>
					<option <?= _selected("Strong - R05 (Free information acknowledged)",$fs->Rapport_Attr2); ?> value="Strong - R05 (Free information acknowledged)">Strong - R05 (Free information acknowledged)</option>
					<option <?= _selected("Strong - R06 (Interest shown in the customer)",$fs->Rapport_Attr2); ?> value="Strong - R06 (Interest shown in the customer)">Strong - R06 (Interest shown in the customer)</option>
					<option <?= _selected("Needs Improvement - R07 (Limited Empathy)",$fs->Rapport_Attr2); ?> value="Needs Improvement - R07 (Limited Empathy)">Needs Improvement - R07 (Limited Empathy)</option>
					<option <?= _selected("Needs Improvement - R08 (Free information  is not acknowledged)",$fs->Rapport_Attr2); ?> value="Needs Improvement - R08 (Free information  is not acknowledged)">Needs Improvement - R08 (Free information  is not acknowledged)</option>
					<option <?= _selected("Needs Improvement - R09 (Focus on the transaction)",$fs->Rapport_Attr2); ?> value="Needs Improvement - R09 (Focus on the transaction)">Needs Improvement - R09 (Focus on the transaction)</option>
					<option <?= _selected("Below Standard - R10 (Customer dissatisfaction issue)",$fs->Rapport_Attr2); ?> value="Below Standard - R10  (Customer dissatisfaction issue)">Below Standard - R10 (Customer dissatisfaction issue)</option>				</select>
			</td>
			<td>
				<select name="Rapport_Attr3">
					<option <?= _selected("",$fs->Rapport_Attr3); ?> value=""> - </option>
					<option <?= _selected("Outstanding - R01 (Genuine empathy displayed)",$fs->Rapport_Attr3); ?> value="Outstanding - R01 (Genuine empathy displayed)">Outstanding - R01 (Genuine empathy displayed)</option>
					<option <?= _selected("Outstanding - R02 (Free information  used)",$fs->Rapport_Attr3); ?> value="Outstanding - R02 (Free information  used)">Outstanding - R02 (Free information  used)</option>
					<option <?= _selected("Outstanding - R03 (Good relationship built)",$fs->Rapport_Attr3); ?> value="Outstanding - R03 (Good relationship built)">Outstanding - R03 (Good relationship built)</option>
					<option <?= _selected("Strong - R04 (Demonstrated empathy where appropriate)",$fs->Rapport_Attr3); ?> value="Strong - R04 (Demonstrated empathy where appropriate)">Strong - R04 (Demonstrated empathy where appropriate)</option>
					<option <?= _selected("Strong - R05 (Free information acknowledged)",$fs->Rapport_Attr3); ?> value="Strong - R05 (Free information acknowledged)">Strong - R05 (Free information acknowledged)</option>
					<option <?= _selected("Strong - R06 (Interest shown in the customer)",$fs->Rapport_Attr3); ?> value="Strong - R06 (Interest shown in the customer)">Strong - R06 (Interest shown in the customer)</option>
					<option <?= _selected("Needs Improvement - R07 (Limited Empathy)",$fs->Rapport_Attr3); ?> value="Needs Improvement - R07 (Limited Empathy)">Needs Improvement - R07 (Limited Empathy)</option>
					<option <?= _selected("Needs Improvement - R08 (Free information  is not acknowledged)",$fs->Rapport_Attr3); ?> value="Needs Improvement - R08 (Free information  is not acknowledged)">Needs Improvement - R08 (Free information  is not acknowledged)</option>
					<option <?= _selected("Needs Improvement - R09 (Focus on the transaction)",$fs->Rapport_Attr3); ?> value="Needs Improvement - R09 (Focus on the transaction)">Needs Improvement - R09 (Focus on the transaction)</option>
					<option <?= _selected("Below Standard - R10 (Customer dissatisfaction issue)",$fs->Rapport_Attr3); ?> value="Below Standard - R10  (Customer dissatisfaction issue)">Below Standard - R10 (Customer dissatisfaction issue)</option>
				</select>
			</td>
			<td>
				<select name="Rapport_Attr4">
					<option <?= _selected("",$fs->Rapport_Attr4); ?> value=""> - </option>
					<option <?= _selected("Outstanding - R01 (Genuine empathy displayed)",$fs->Rapport_Attr4); ?> value="Outstanding - R01 (Genuine empathy displayed)">Outstanding - R01 (Genuine empathy displayed)</option>
					<option <?= _selected("Outstanding - R02 (Free information  used)",$fs->Rapport_Attr4); ?> value="Outstanding - R02 (Free information  used)">Outstanding - R02 (Free information  used)</option>
					<option <?= _selected("Outstanding - R03 (Good relationship built)",$fs->Rapport_Attr4); ?> value="Outstanding - R03 (Good relationship built)">Outstanding - R03 (Good relationship built)</option>
					<option <?= _selected("Strong - R04 (Demonstrated empathy where appropriate)",$fs->Rapport_Attr4); ?> value="Strong - R04 (Demonstrated empathy where appropriate)">Strong - R04 (Demonstrated empathy where appropriate)</option>
					<option <?= _selected("Strong - R05 (Free information acknowledged)",$fs->Rapport_Attr4); ?> value="Strong - R05 (Free information acknowledged)">Strong - R05 (Free information acknowledged)</option>
					<option <?= _selected("Strong - R06 (Interest shown in the customer)",$fs->Rapport_Attr4); ?> value="Strong - R06 (Interest shown in the customer)">Strong - R06 (Interest shown in the customer)</option>
					<option <?= _selected("Needs Improvement - R07 (Limited Empathy)",$fs->Rapport_Attr4); ?> value="Needs Improvement - R07 (Limited Empathy)">Needs Improvement - R07 (Limited Empathy)</option>
					<option <?= _selected("Needs Improvement - R08 (Free information  is not acknowledged)",$fs->Rapport_Attr4); ?> value="Needs Improvement - R08 (Free information  is not acknowledged)">Needs Improvement - R08 (Free information  is not acknowledged)</option>
					<option <?= _selected("Needs Improvement - R09 (Focus on the transaction)",$fs->Rapport_Attr4); ?> value="Needs Improvement - R09 (Focus on the transaction)">Needs Improvement - R09 (Focus on the transaction)</option>
					<option <?= _selected("Below Standard - R10 (Customer dissatisfaction issue)",$fs->Rapport_Attr4); ?> value="Below Standard - R10  (Customer dissatisfaction issue)">Below Standard - R10 (Customer dissatisfaction issue)</option>
				</select>
			</td>
			<td>
				<select name="Rapport_Attr5">
					<option <?= _selected("",$fs->Rapport_Attr5); ?> value=""> - </option>
					<option <?= _selected("Outstanding - R01 (Genuine empathy displayed)",$fs->Rapport_Attr5); ?> value="Outstanding - R01 (Genuine empathy displayed)">Outstanding - R01 (Genuine empathy displayed)</option>
					<option <?= _selected("Outstanding - R02 (Free information  used)",$fs->Rapport_Attr5); ?> value="Outstanding - R02 (Free information  used)">Outstanding - R02 (Free information  used)</option>
					<option <?= _selected("Outstanding - R03 (Good relationship built)",$fs->Rapport_Attr5); ?> value="Outstanding - R03 (Good relationship built)">Outstanding - R03 (Good relationship built)</option>
					<option <?= _selected("Strong - R04 (Demonstrated empathy where appropriate)",$fs->Rapport_Attr5); ?> value="Strong - R04 (Demonstrated empathy where appropriate)">Strong - R04 (Demonstrated empathy where appropriate)</option>
					<option <?= _selected("Strong - R05 (Free information acknowledged)",$fs->Rapport_Attr5); ?> value="Strong - R05 (Free information acknowledged)">Strong - R05 (Free information acknowledged)</option>
					<option <?= _selected("Strong - R06 (Interest shown in the customer)",$fs->Rapport_Attr5); ?> value="Strong - R06 (Interest shown in the customer)">Strong - R06 (Interest shown in the customer)</option>
					<option <?= _selected("Needs Improvement - R07 (Limited Empathy)",$fs->Rapport_Attr5); ?> value="Needs Improvement - R07 (Limited Empathy)">Needs Improvement - R07 (Limited Empathy)</option>
					<option <?= _selected("Needs Improvement - R08 (Free information  is not acknowledged)",$fs->Rapport_Attr5); ?> value="Needs Improvement - R08 (Free information  is not acknowledged)">Needs Improvement - R08 (Free information  is not acknowledged)</option>
					<option <?= _selected("Needs Improvement - R09 (Focus on the transaction)",$fs->Rapport_Attr5); ?> value="Needs Improvement - R09 (Focus on the transaction)">Needs Improvement - R09 (Focus on the transaction)</option>
					<option <?= _selected("Below Standard - R10 (Customer dissatisfaction issue)",$fs->Rapport_Attr5); ?> value="Below Standard - R10  (Customer dissatisfaction issue)">Below Standard - R10 (Customer dissatisfaction issue)</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Ownership</td>
			<td><input type="text" value="<?= $fs->CQ_Rating_Ownership; ?>" name="CQ_Rating_Ownership" class="call_quality2 required_scoring"></td>
		<td>
				<select name="Ownership_Attr1">
					<option <?= _selected("",$fs->Ownership_Attr1); ?> value=""> - </option>
					<option <?= _selected("Outstanding - O01 (Agent took actions)",$fs->Ownership_Attr1); ?> value="Outstanding - O01 (Agent took actions)">Outstanding - O01 (Agent took actions)</option>
					<option <?= _selected("Outstanding - O02 (Excellent summation)",$fs->Ownership_Attr1); ?> value="Outstanding - O02 (Excellent summation)">Outstanding - O02 (Excellent summation)</option>
					<option <?= _selected("Outstanding - O03 (Sincere apology)",$fs->Ownership_Attr1); ?> value="Outstanding - O03 (Sincere apology)">Outstanding - O03 (Sincere apology)</option>
					<option <?= _selected("Strong - O04 (Takes all necessary and available steps)",$fs->Ownership_Attr1); ?> value="Strong - O04 (Takes all necessary and available steps)">Strong - O04 (Takes all necessary and available steps)</option>
					<option <?= _selected("Strong - O05 (Agent summarizes next steps)",$fs->Ownership_Attr1); ?> value="Strong - O05 (Agent summarizes next steps)">Strong - O05 (Agent summarizes next steps)</option>
					<option <?= _selected("Strong - O06 (Apologizes when appropriate)",$fs->Ownership_Attr1); ?> value="Strong - O06 (Apologizes when appropriate)">Strong - O06 (Apologizes when appropriate)</option>
					<option <?= _selected("Needs Improvement - O07 (poor knowledge)",$fs->Ownership_Attr1); ?> value="Needs Improvement - O07 (poor knowledge)">Needs Improvement - O07 (poor knowledge)</option>
					<option <?= _selected("Needs Improvement - O08 (Little attempt to summarize)",$fs->Ownership_Attr1); ?> value="Needs Improvement - O08 (Little attempt to summarize)">Needs Improvement - O08 (Little attempt to summarize)</option>
					<option <?= _selected("Needs Improvement - O09 (Failed to apologize)",$fs->Ownership_Attr1); ?> value="Needs Improvement - O09 (Failed to apologize)">Needs Improvement - O09 (Failed to apologize)</option>
					<option <?= _selected("Below Standard - O10 (Customer dissatisfaction issue)",$fs->Ownership_Attr1); ?> value="Below Standard - O10 (Customer dissatisfaction issue)">Below Standard - O10 (Customer dissatisfaction issue)</option>
				</select>
			</td>
			<td>
				<select name="Ownership_Attr2">
					<option <?= _selected("",$fs->Ownership_Attr2); ?> value=""> - </option>
					<option <?= _selected("Outstanding - O01 (Agent took actions)",$fs->Ownership_Attr2); ?> value="Outstanding - O01 (Agent took actions)">Outstanding - O01 (Agent took actions)</option>
					<option <?= _selected("Outstanding - O02 (Excellent summation)",$fs->Ownership_Attr2); ?> value="Outstanding - O02 (Excellent summation)">Outstanding - O02 (Excellent summation)</option>
					<option <?= _selected("Outstanding - O03 (Sincere apology)",$fs->Ownership_Attr2); ?> value="Outstanding - O03 (Sincere apology)">Outstanding - O03 (Sincere apology)</option>
					<option <?= _selected("Strong - O04 (Takes all necessary and available steps)",$fs->Ownership_Attr2); ?> value="Strong - O04 (Takes all necessary and available steps)">Strong - O04 (Takes all necessary and available steps)</option>
					<option <?= _selected("Strong - O05 (Agent summarizes next steps)",$fs->Ownership_Attr2); ?> value="Strong - O05 (Agent summarizes next steps)">Strong - O05 (Agent summarizes next steps)</option>
					<option <?= _selected("Strong - O06 (Apologizes when appropriate)",$fs->Ownership_Attr2); ?> value="Strong - O06 (Apologizes when appropriate)">Strong - O06 (Apologizes when appropriate)</option>
					<option <?= _selected("Needs Improvement - O07 (poor knowledge)",$fs->Ownership_Attr2); ?> value="Needs Improvement - O07 (poor knowledge)">Needs Improvement - O07 (poor knowledge)</option>
					<option <?= _selected("Needs Improvement - O08 (Little attempt to summarize)",$fs->Ownership_Attr2); ?> value="Needs Improvement - O08 (Little attempt to summarize)">Needs Improvement - O08 (Little attempt to summarize)</option>
					<option <?= _selected("Needs Improvement - O09 (Failed to apologize)",$fs->Ownership_Attr2); ?> value="Needs Improvement - O09 (Failed to apologize)">Needs Improvement - O09 (Failed to apologize)</option>
					<option <?= _selected("Below Standard - O10 (Customer dissatisfaction issue)",$fs->Ownership_Attr2); ?> value="Below Standard - O10 (Customer dissatisfaction issue)">Below Standard - O10 (Customer dissatisfaction issue)</option>
				</select>
			</td>
			<td>
				<select name="Ownership_Attr3">
					<option <?= _selected("",$fs->Ownership_Attr3); ?> value=""> - </option>
					<option <?= _selected("Outstanding - O01 (Agent took actions)",$fs->Ownership_Attr3); ?> value="Outstanding - O01 (Agent took actions)">Outstanding - O01 (Agent took actions)</option>
					<option <?= _selected("Outstanding - O02 (Excellent summation)",$fs->Ownership_Attr3); ?> value="Outstanding - O02 (Excellent summation)">Outstanding - O02 (Excellent summation)</option>
					<option <?= _selected("Outstanding - O03 (Sincere apology)",$fs->Ownership_Attr3); ?> value="Outstanding - O03 (Sincere apology)">Outstanding - O03 (Sincere apology)</option>
					<option <?= _selected("Strong - O04 (Takes all necessary and available steps)",$fs->Ownership_Attr3); ?> value="Strong - O04 (Takes all necessary and available steps)">Strong - O04 (Takes all necessary and available steps)</option>
					<option <?= _selected("Strong - O05 (Agent summarizes next steps)",$fs->Ownership_Attr3); ?> value="Strong - O05 (Agent summarizes next steps)">Strong - O05 (Agent summarizes next steps)</option>
					<option <?= _selected("Strong - O06 (Apologizes when appropriate)",$fs->Ownership_Attr3); ?> value="Strong - O06 (Apologizes when appropriate)">Strong - O06 (Apologizes when appropriate)</option>
					<option <?= _selected("Needs Improvement - O07 (poor knowledge)",$fs->Ownership_Attr3); ?> value="Needs Improvement - O07 (poor knowledge)">Needs Improvement - O07 (poor knowledge)</option>
					<option <?= _selected("Needs Improvement - O08 (Little attempt to summarize)",$fs->Ownership_Attr3); ?> value="Needs Improvement - O08 (Little attempt to summarize)">Needs Improvement - O08 (Little attempt to summarize)</option>
					<option <?= _selected("Needs Improvement - O09 (Failed to apologize)",$fs->Ownership_Attr3); ?> value="Needs Improvement - O09 (Failed to apologize)">Needs Improvement - O09 (Failed to apologize)</option>
					<option <?= _selected("Below Standard - O10 (Customer dissatisfaction issue)",$fs->Ownership_Attr3); ?> value="Below Standard - O10 (Customer dissatisfaction issue)">Below Standard - O10 (Customer dissatisfaction issue)</option>
				</select>
			</td>
			<td>
				<select name="Ownership_Attr4">
					<option <?= _selected("",$fs->Ownership_Attr4); ?> value=""> - </option>
					<option <?= _selected("Outstanding - O01 (Agent took actions)",$fs->Ownership_Attr4); ?> value="Outstanding - O01 (Agent took actions)">Outstanding - O01 (Agent took actions)</option>
					<option <?= _selected("Outstanding - O02 (Excellent summation)",$fs->Ownership_Attr4); ?> value="Outstanding - O02 (Excellent summation)">Outstanding - O02 (Excellent summation)</option>
					<option <?= _selected("Outstanding - O03 (Sincere apology)",$fs->Ownership_Attr4); ?> value="Outstanding - O03 (Sincere apology)">Outstanding - O03 (Sincere apology)</option>
					<option <?= _selected("Strong - O04 (Takes all necessary and available steps)",$fs->Ownership_Attr4); ?> value="Strong - O04 (Takes all necessary and available steps)">Strong - O04 (Takes all necessary and available steps)</option>
					<option <?= _selected("Strong - O05 (Agent summarizes next steps)",$fs->Ownership_Attr4); ?> value="Strong - O05 (Agent summarizes next steps)">Strong - O05 (Agent summarizes next steps)</option>
					<option <?= _selected("Strong - O06 (Apologizes when appropriate)",$fs->Ownership_Attr4); ?> value="Strong - O06 (Apologizes when appropriate)">Strong - O06 (Apologizes when appropriate)</option>
					<option <?= _selected("Needs Improvement - O07 (poor knowledge)",$fs->Ownership_Attr4); ?> value="Needs Improvement - O07 (poor knowledge)">Needs Improvement - O07 (poor knowledge)</option>
					<option <?= _selected("Needs Improvement - O08 (Little attempt to summarize)",$fs->Ownership_Attr4); ?> value="Needs Improvement - O08 (Little attempt to summarize)">Needs Improvement - O08 (Little attempt to summarize)</option>
					<option <?= _selected("Needs Improvement - O09 (Failed to apologize)",$fs->Ownership_Attr4); ?> value="Needs Improvement - O09 (Failed to apologize)">Needs Improvement - O09 (Failed to apologize)</option>
					<option <?= _selected("Below Standard - O10 (Customer dissatisfaction issue)",$fs->Ownership_Attr4); ?> value="Below Standard - O10 (Customer dissatisfaction issue)">Below Standard - O10 (Customer dissatisfaction issue)</option>
				</select>
			</td>
			<td>
				<select name="Ownership_Attr5">
					<option <?= _selected("",$fs->Ownership_Attr5); ?> value=""> - </option>
					<option <?= _selected("Outstanding - O01 (Agent took actions)",$fs->Ownership_Attr5); ?> value="Outstanding - O01 (Agent took actions)">Outstanding - O01 (Agent took actions)</option>
					<option <?= _selected("Outstanding - O02 (Excellent summation)",$fs->Ownership_Attr5); ?> value="Outstanding - O02 (Excellent summation)">Outstanding - O02 (Excellent summation)</option>
					<option <?= _selected("Outstanding - O03 (Sincere apology)",$fs->Ownership_Attr5); ?> value="Outstanding - O03 (Sincere apology)">Outstanding - O03 (Sincere apology)</option>
					<option <?= _selected("Strong - O04 (Takes all necessary and available steps)",$fs->Ownership_Attr5); ?> value="Strong - O04 (Takes all necessary and available steps)">Strong - O04 (Takes all necessary and available steps)</option>
					<option <?= _selected("Strong - O05 (Agent summarizes next steps)",$fs->Ownership_Attr5); ?> value="Strong - O05 (Agent summarizes next steps)">Strong - O05 (Agent summarizes next steps)</option>
					<option <?= _selected("Strong - O06 (Apologizes when appropriate)",$fs->Ownership_Attr5); ?> value="Strong - O06 (Apologizes when appropriate)">Strong - O06 (Apologizes when appropriate)</option>
					<option <?= _selected("Needs Improvement - O07 (poor knowledge)",$fs->Ownership_Attr5); ?> value="Needs Improvement - O07 (poor knowledge)">Needs Improvement - O07 (poor knowledge)</option>
					<option <?= _selected("Needs Improvement - O08 (Little attempt to summarize)",$fs->Ownership_Attr5); ?> value="Needs Improvement - O08 (Little attempt to summarize)">Needs Improvement - O08 (Little attempt to summarize)</option>
					<option <?= _selected("Needs Improvement - O09 (Failed to apologize)",$fs->Ownership_Attr5); ?> value="Needs Improvement - O09 (Failed to apologize)">Needs Improvement - O09 (Failed to apologize)</option>
					<option <?= _selected("Below Standard - O10 (Customer dissatisfaction issue)",$fs->Ownership_Attr5); ?> value="Below Standard - O10 (Customer dissatisfaction issue)">Below Standard - O10 (Customer dissatisfaction issue)</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Communication</td>
			<td><input type="text" value="<?= $fs->CQ_Rating_Communication; ?>" name="CQ_Rating_Communication" class="call_quality3 required_scoring"></td>
			<td>
				<select name="Communication_Attr1">
					<option <?= _selected("",$fs->Communication_Attr1); ?> value=""> - </option>
					<option <?= _selected("Outstanding - C01 (Excellent explanations)",$fs->Communication_Attr1); ?> value="Outstanding - C01 (Excellent explanations)">Outstanding - C01 (Excellent explanations)</option>
					<option <?= _selected("Outstanding - C02 (Excellent confidence)",$fs->Communication_Attr1); ?> value="Outstanding - C02 (Excellent confidence)">Outstanding - C02 (Excellent confidence)</option>
					<option <?= _selected("Outstanding - C03 (Asks open, probing questions)",$fs->Communication_Attr1); ?> value="Outstanding - C03 (Asks open, probing questions)">Outstanding - C03 (Asks open, probing questions)</option>
					<option <?= _selected("Outstanding - C04 (Demonstrates excellent objection handling)",$fs->Communication_Attr1); ?> value="Outstanding - C04 (Demonstrates excellent objection handling)">Outstanding - C04 (Demonstrates excellent objection handling)</option>
					<option <?= _selected("Outstanding - C05 (Excellent call flow and control)",$fs->Communication_Attr1); ?> value="Outstanding - C05 (Excellent call flow and control)">Outstanding - C05 (Excellent call flow and control)</option>
					<option <?= _selected("Outstanding - C06 (Matches customer’s pace and language)",$fs->Communication_Attr1); ?> value="Outstanding - C06 (Matches customer’s pace and language)">Outstanding - C06 (Matches customer’s pace and language)</option>
					<option <?= _selected("Outstanding - C07 (Achievement above polite and friendly)",$fs->Communication_Attr1); ?> value="Outstanding - C07 (Achievement above polite and friendly)">Outstanding - C07 (Achievement above polite and friendly)</option>
					
					<option <?= _selected("Strong - C08 (Clear explanations)",$fs->Communication_Attr1); ?> value="Strong - C08 (Clear explanations)">Strong - C08 (Clear explanations)</option>
					<option <?= _selected("Strong - C09 (Acts in a calm and confident)",$fs->Communication_Attr1); ?> value="Strong - C09 (Acts in a calm and confident)">Strong - C09 (Acts in a calm and confident)</option>
					<option <?= _selected("Strong - C10 (Active listening)",$fs->Communication_Attr1); ?> value="Strong - C10 (Active listening)">Strong - C10 (Active listening)</option>
					<option <?= _selected("Strong - C11 (Demonstrates objection handling to necessary procedures)",$fs->Communication_Attr1); ?> value="Strong - C11 (Demonstrates objection handling to necessary procedures)">Strong - C11 (Demonstrates objection handling to necessary procedures)</option>
					<option <?= _selected("Strong - C12 (Good call flow and control)",$fs->Communication_Attr1); ?> value="Strong - C12 (Good call flow and control)">Strong - C12 (Good call flow and control)</option>
					<option <?= _selected("Strong - C13 (Steady pace and tone)",$fs->Communication_Attr1); ?> value="Strong - C13 (Steady pace and tone)">Strong - C13 (Steady pace and tone)</option>
					<option <?= _selected("Strong - C14 (Polite, courteous and friendly)",$fs->Communication_Attr1); ?> value="Strong - C14 (Polite, courteous and friendly)">Strong - C14 (Polite, courteous and friendly)</option>
					<option <?= _selected("Strong - C15 (Uses customer’s name)",$fs->Communication_Attr1); ?> value="Strong - C15 (Uses customer’s name)">Strong - C15 (Uses customer’s name)</option>

					<option <?= _selected("Needs Improvement - C16 (explain in a poor manner)",$fs->Communication_Attr1); ?> value="Needs Improvement - C16 (explain in a poor manner)">Needs Improvement - C16 (explain in a poor manner)</option>
					<option <?= _selected("Needs Improvement - C17 (lack of confidence)",$fs->Communication_Attr1); ?> value="Needs Improvement - C17 (lack of confidence)">Needs Improvement - C17 (lack of confidence)</option>
					<option <?= _selected("Needs Improvement - C18 (Failed to ask sufficient questions)",$fs->Communication_Attr1); ?> value="Needs Improvement - C18 (Failed to ask sufficient questions)">Needs Improvement - C18 (Failed to ask sufficient questions)</option>
					<option <?= _selected("Needs Improvement - C19 (Limited attempt to overcome objections)",$fs->Communication_Attr1); ?> value="Needs Improvement - C19 (Limited attempt to overcome objections)">Needs Improvement - C19 (Limited attempt to overcome objections)</option>
					<option <?= _selected("Needs Improvement - C20 (Struggles to maintain call control)",$fs->Communication_Attr1); ?> value="Needs Improvement - C20 (Struggles to maintain call control)">Needs Improvement - C20 (Struggles to maintain call control)</option>
					<option <?= _selected("Needs Improvement - C21 (dead air)",$fs->Communication_Attr1); ?> value="Needs Improvement - C21 (dead air)">Needs Improvement - C21 (dead air)</option>
					<option <?= _selected("Needs Improvement - C22 (Inappropriate pace or tone)",$fs->Communication_Attr1); ?> value="Needs Improvement - C22 (Inappropriate pace or tone)">Needs Improvement - C22 (Inappropriate pace or tone)</option>
					<option <?= _selected("Needs Improvement - C23 (Poor personalization)",$fs->Communication_Attr1); ?> value="Needs Improvement - C23 (Poor personalization)">Needs Improvement - C23 (Poor personalization)</option>

					<option <?= _selected("Below Standard - C24 (Customer dissatisfaction issue)",$fs->Communication_Attr1); ?> value="Below Standard - C24 (Customer dissatisfaction issue)">Below Standard - C24 (Customer dissatisfaction issue)</option>
				</select>
			</td>
			<td>
				<select name="Communication_Attr2">
					<option <?= _selected("",$fs->Communication_Attr2); ?> value=""> - </option>
					<option <?= _selected("Outstanding - C01 (Excellent explanations)",$fs->Communication_Attr2); ?> value="Outstanding - C01 (Excellent explanations)">Outstanding - C01 (Excellent explanations)</option>
					<option <?= _selected("Outstanding - C02 (Excellent confidence)",$fs->Communication_Attr2); ?> value="Outstanding - C02 (Excellent confidence)">Outstanding - C02 (Excellent confidence)</option>
					<option <?= _selected("Outstanding - C03 (Asks open, probing questions)",$fs->Communication_Attr2); ?> value="Outstanding - C03 (Asks open, probing questions)">Outstanding - C03 (Asks open, probing questions)</option>
					<option <?= _selected("Outstanding - C04 (Demonstrates excellent objection handling)",$fs->Communication_Attr2); ?> value="Outstanding - C04 (Demonstrates excellent objection handling)">Outstanding - C04 (Demonstrates excellent objection handling)</option>
					<option <?= _selected("Outstanding - C05 (Excellent call flow and control)",$fs->Communication_Attr2); ?> value="Outstanding - C05 (Excellent call flow and control)">Outstanding - C05 (Excellent call flow and control)</option>
					<option <?= _selected("Outstanding - C06 (Matches customer’s pace and language)",$fs->Communication_Attr2); ?> value="Outstanding - C06 (Matches customer’s pace and language)">Outstanding - C06 (Matches customer’s pace and language)</option>
					<option <?= _selected("Outstanding - C07 (Achievement above polite and friendly)",$fs->Communication_Attr2); ?> value="Outstanding - C07 (Achievement above polite and friendly)">Outstanding - C07 (Achievement above polite and friendly)</option>
					
					<option <?= _selected("Strong - C08 (Clear explanations)",$fs->Communication_Attr2); ?> value="Strong - C08 (Clear explanations)">Strong - C08 (Clear explanations)</option>
					<option <?= _selected("Strong - C09 (Acts in a calm and confident)",$fs->Communication_Attr2); ?> value="Strong - C09 (Acts in a calm and confident)">Strong - C09 (Acts in a calm and confident)</option>
					<option <?= _selected("Strong - C10 (Active listening)",$fs->Communication_Attr2); ?> value="Strong - C10 (Active listening)">Strong - C10 (Active listening)</option>
					<option <?= _selected("Strong - C11 (Demonstrates objection handling to necessary procedures)",$fs->Communication_Attr2); ?> value="Strong - C11 (Demonstrates objection handling to necessary procedures)">Strong - C11 (Demonstrates objection handling to necessary procedures)</option>
					<option <?= _selected("Strong - C12 (Good call flow and control)",$fs->Communication_Attr2); ?> value="Strong - C12 (Good call flow and control)">Strong - C12 (Good call flow and control)</option>
					<option <?= _selected("Strong - C13 (Steady pace and tone)",$fs->Communication_Attr2); ?> value="Strong - C13 (Steady pace and tone)">Strong - C13 (Steady pace and tone)</option>
					<option <?= _selected("Strong - C14 (Polite, courteous and friendly)",$fs->Communication_Attr2); ?> value="Strong - C14 (Polite, courteous and friendly)">Strong - C14 (Polite, courteous and friendly)</option>
					<option <?= _selected("Strong - C15 (Uses customer’s name)",$fs->Communication_Attr2); ?> value="Strong - C15 (Uses customer’s name)">Strong - C15 (Uses customer’s name)</option>

					<option <?= _selected("Needs Improvement - C16 (explain in a poor manner)",$fs->Communication_Attr2); ?> value="Needs Improvement - C16 (explain in a poor manner)">Needs Improvement - C16 (explain in a poor manner)</option>
					<option <?= _selected("Needs Improvement - C17 (lack of confidence)",$fs->Communication_Attr2); ?> value="Needs Improvement - C17 (lack of confidence)">Needs Improvement - C17 (lack of confidence)</option>
					<option <?= _selected("Needs Improvement - C18 (Failed to ask sufficient questions)",$fs->Communication_Attr2); ?> value="Needs Improvement - C18 (Failed to ask sufficient questions)">Needs Improvement - C18 (Failed to ask sufficient questions)</option>
					<option <?= _selected("Needs Improvement - C19 (Limited attempt to overcome objections)",$fs->Communication_Attr2); ?> value="Needs Improvement - C19 (Limited attempt to overcome objections)">Needs Improvement - C19 (Limited attempt to overcome objections)</option>
					<option <?= _selected("Needs Improvement - C20 (Struggles to maintain call control)",$fs->Communication_Attr2); ?> value="Needs Improvement - C20 (Struggles to maintain call control)">Needs Improvement - C20 (Struggles to maintain call control)</option>
					<option <?= _selected("Needs Improvement - C21 (dead air)",$fs->Communication_Attr2); ?> value="Needs Improvement - C21 (dead air)">Needs Improvement - C21 (dead air)</option>
					<option <?= _selected("Needs Improvement - C22 (Inappropriate pace or tone)",$fs->Communication_Attr2); ?> value="Needs Improvement - C22 (Inappropriate pace or tone)">Needs Improvement - C22 (Inappropriate pace or tone)</option>
					<option <?= _selected("Needs Improvement - C23 (Poor personalization)",$fs->Communication_Attr2); ?> value="Needs Improvement - C23 (Poor personalization)">Needs Improvement - C23 (Poor personalization)</option>

					<option <?= _selected("Below Standard - C24 (Customer dissatisfaction issue)",$fs->Communication_Attr2); ?> value="Below Standard - C24 (Customer dissatisfaction issue)">Below Standard - C24 (Customer dissatisfaction issue)</option>
				</select>
			</td>
			<td>
				<select name="Communication_Attr3">
					<option <?= _selected("",$fs->Communication_Attr3); ?> value=""> - </option>
					<option <?= _selected("Outstanding - C01 (Excellent explanations)",$fs->Communication_Attr3); ?> value="Outstanding - C01 (Excellent explanations)">Outstanding - C01 (Excellent explanations)</option>
					<option <?= _selected("Outstanding - C02 (Excellent confidence)",$fs->Communication_Attr3); ?> value="Outstanding - C02 (Excellent confidence)">Outstanding - C02 (Excellent confidence)</option>
					<option <?= _selected("Outstanding - C03 (Asks open, probing questions)",$fs->Communication_Attr3); ?> value="Outstanding - C03 (Asks open, probing questions)">Outstanding - C03 (Asks open, probing questions)</option>
					<option <?= _selected("Outstanding - C04 (Demonstrates excellent objection handling)",$fs->Communication_Attr3); ?> value="Outstanding - C04 (Demonstrates excellent objection handling)">Outstanding - C04 (Demonstrates excellent objection handling)</option>
					<option <?= _selected("Outstanding - C05 (Excellent call flow and control)",$fs->Communication_Attr3); ?> value="Outstanding - C05 (Excellent call flow and control)">Outstanding - C05 (Excellent call flow and control)</option>
					<option <?= _selected("Outstanding - C06 (Matches customer’s pace and language)",$fs->Communication_Attr3); ?> value="Outstanding - C06 (Matches customer’s pace and language)">Outstanding - C06 (Matches customer’s pace and language)</option>
					<option <?= _selected("Outstanding - C07 (Achievement above polite and friendly)",$fs->Communication_Attr3); ?> value="Outstanding - C07 (Achievement above polite and friendly)">Outstanding - C07 (Achievement above polite and friendly)</option>
					
					<option <?= _selected("Strong - C08 (Clear explanations)",$fs->Communication_Attr3); ?> value="Strong - C08 (Clear explanations)">Strong - C08 (Clear explanations)</option>
					<option <?= _selected("Strong - C09 (Acts in a calm and confident)",$fs->Communication_Attr3); ?> value="Strong - C09 (Acts in a calm and confident)">Strong - C09 (Acts in a calm and confident)</option>
					<option <?= _selected("Strong - C10 (Active listening)",$fs->Communication_Attr2); ?> value="Strong - C10 (Active listening)">Strong - C10 (Active listening)</option>
					<option <?= _selected("Strong - C11 (Demonstrates objection handling to necessary procedures)",$fs->Communication_Attr3); ?> value="Strong - C11 (Demonstrates objection handling to necessary procedures)">Strong - C11 (Demonstrates objection handling to necessary procedures)</option>
					<option <?= _selected("Strong - C12 (Good call flow and control)",$fs->Communication_Attr3); ?> value="Strong - C12 (Good call flow and control)">Strong - C12 (Good call flow and control)</option>
					<option <?= _selected("Strong - C13 (Steady pace and tone)",$fs->Communication_Attr3); ?> value="Strong - C13 (Steady pace and tone)">Strong - C13 (Steady pace and tone)</option>
					<option <?= _selected("Strong - C14 (Polite, courteous and friendly)",$fs->Communication_Attr3); ?> value="Strong - C14 (Polite, courteous and friendly)">Strong - C14 (Polite, courteous and friendly)</option>
					<option <?= _selected("Strong - C15 (Uses customer’s name)",$fs->Communication_Attr3); ?> value="Strong - C15 (Uses customer’s name)">Strong - C15 (Uses customer’s name)</option>

					<option <?= _selected("Needs Improvement - C16 (explain in a poor manner)",$fs->Communication_Attr3); ?> value="Needs Improvement - C16 (explain in a poor manner)">Needs Improvement - C16 (explain in a poor manner)</option>
					<option <?= _selected("Needs Improvement - C17 (lack of confidence)",$fs->Communication_Attr3); ?> value="Needs Improvement - C17 (lack of confidence)">Needs Improvement - C17 (lack of confidence)</option>
					<option <?= _selected("Needs Improvement - C18 (Failed to ask sufficient questions)",$fs->Communication_Attr3); ?> value="Needs Improvement - C18 (Failed to ask sufficient questions)">Needs Improvement - C18 (Failed to ask sufficient questions)</option>
					<option <?= _selected("Needs Improvement - C19 (Limited attempt to overcome objections)",$fs->Communication_Attr3); ?> value="Needs Improvement - C19 (Limited attempt to overcome objections)">Needs Improvement - C19 (Limited attempt to overcome objections)</option>
					<option <?= _selected("Needs Improvement - C20 (Struggles to maintain call control)",$fs->Communication_Attr3); ?> value="Needs Improvement - C20 (Struggles to maintain call control)">Needs Improvement - C20 (Struggles to maintain call control)</option>
					<option <?= _selected("Needs Improvement - C21 (dead air)",$fs->Communication_Attr3); ?> value="Needs Improvement - C21 (dead air)">Needs Improvement - C21 (dead air)</option>
					<option <?= _selected("Needs Improvement - C22 (Inappropriate pace or tone)",$fs->Communication_Attr3); ?> value="Needs Improvement - C22 (Inappropriate pace or tone)">Needs Improvement - C22 (Inappropriate pace or tone)</option>
					<option <?= _selected("Needs Improvement - C23 (Poor personalization)",$fs->Communication_Attr3); ?> value="Needs Improvement - C23 (Poor personalization)">Needs Improvement - C23 (Poor personalization)</option>

					<option <?= _selected("Below Standard - C24 (Customer dissatisfaction issue)",$fs->Communication_Attr3); ?> value="Below Standard - C24 (Customer dissatisfaction issue)">Below Standard - C24 (Customer dissatisfaction issue)</option>
				</select>
			</td>
			<td>
				<select name="Communication_Attr4">
					<option <?= _selected("",$fs->Communication_Attr4); ?> value=""> - </option>
					<option <?= _selected("Outstanding - C01 (Excellent explanations)",$fs->Communication_Attr4); ?> value="Outstanding - C01 (Excellent explanations)">Outstanding - C01 (Excellent explanations)</option>
					<option <?= _selected("Outstanding - C02 (Excellent confidence)",$fs->Communication_Attr4); ?> value="Outstanding - C02 (Excellent confidence)">Outstanding - C02 (Excellent confidence)</option>
					<option <?= _selected("Outstanding - C03 (Asks open, probing questions)",$fs->Communication_Attr4); ?> value="Outstanding - C03 (Asks open, probing questions)">Outstanding - C03 (Asks open, probing questions)</option>
					<option <?= _selected("Outstanding - C04 (Demonstrates excellent objection handling)",$fs->Communication_Attr4); ?> value="Outstanding - C04 (Demonstrates excellent objection handling)">Outstanding - C04 (Demonstrates excellent objection handling)</option>
					<option <?= _selected("Outstanding - C05 (Excellent call flow and control)",$fs->Communication_Attr4); ?> value="Outstanding - C05 (Excellent call flow and control)">Outstanding - C05 (Excellent call flow and control)</option>
					<option <?= _selected("Outstanding - C06 (Matches customer’s pace and language)",$fs->Communication_Attr4); ?> value="Outstanding - C06 (Matches customer’s pace and language)">Outstanding - C06 (Matches customer’s pace and language)</option>
					<option <?= _selected("Outstanding - C07 (Achievement above polite and friendly)",$fs->Communication_Attr4); ?> value="Outstanding - C07 (Achievement above polite and friendly)">Outstanding - C07 (Achievement above polite and friendly)</option>
					
					<option <?= _selected("Strong - C08 (Clear explanations)",$fs->Communication_Attr4); ?> value="Strong - C08 (Clear explanations)">Strong - C08 (Clear explanations)</option>
					<option <?= _selected("Strong - C09 (Acts in a calm and confident)",$fs->Communication_Attr4); ?> value="Strong - C09 (Acts in a calm and confident)">Strong - C09 (Acts in a calm and confident)</option>
					<option <?= _selected("Strong - C10 (Active listening)",$fs->Communication_Attr4); ?> value="Strong - C10 (Active listening)">Strong - C10 (Active listening)</option>
					<option <?= _selected("Strong - C11 (Demonstrates objection handling to necessary procedures)",$fs->Communication_Attr4); ?> value="Strong - C11 (Demonstrates objection handling to necessary procedures)">Strong - C11 (Demonstrates objection handling to necessary procedures)</option>
					<option <?= _selected("Strong - C12 (Good call flow and control)",$fs->Communication_Attr4); ?> value="Strong - C12 (Good call flow and control)">Strong - C12 (Good call flow and control)</option>
					<option <?= _selected("Strong - C13 (Steady pace and tone)",$fs->Communication_Attr4); ?> value="Strong - C13 (Steady pace and tone)">Strong - C13 (Steady pace and tone)</option>
					<option <?= _selected("Strong - C14 (Polite, courteous and friendly)",$fs->Communication_Attr4); ?> value="Strong - C14 (Polite, courteous and friendly)">Strong - C14 (Polite, courteous and friendly)</option>
					<option <?= _selected("Strong - C15 (Uses customer’s name)",$fs->Communication_Attr4); ?> value="Strong - C15 (Uses customer’s name)">Strong - C15 (Uses customer’s name)</option>

					<option <?= _selected("Needs Improvement - C16 (explain in a poor manner)",$fs->Communication_Attr4); ?> value="Needs Improvement - C16 (explain in a poor manner)">Needs Improvement - C16 (explain in a poor manner)</option>
					<option <?= _selected("Needs Improvement - C17 (lack of confidence)",$fs->Communication_Attr4); ?> value="Needs Improvement - C17 (lack of confidence)">Needs Improvement - C17 (lack of confidence)</option>
					<option <?= _selected("Needs Improvement - C18 (Failed to ask sufficient questions)",$fs->Communication_Attr4); ?> value="Needs Improvement - C18 (Failed to ask sufficient questions)">Needs Improvement - C18 (Failed to ask sufficient questions)</option>
					<option <?= _selected("Needs Improvement - C19 (Limited attempt to overcome objections)",$fs->Communication_Attr4); ?> value="Needs Improvement - C19 (Limited attempt to overcome objections)">Needs Improvement - C19 (Limited attempt to overcome objections)</option>
					<option <?= _selected("Needs Improvement - C20 (Struggles to maintain call control)",$fs->Communication_Attr4); ?> value="Needs Improvement - C20 (Struggles to maintain call control)">Needs Improvement - C20 (Struggles to maintain call control)</option>
					<option <?= _selected("Needs Improvement - C21 (dead air)",$fs->Communication_Attr4); ?> value="Needs Improvement - C21 (dead air)">Needs Improvement - C21 (dead air)</option>
					<option <?= _selected("Needs Improvement - C22 (Inappropriate pace or tone)",$fs->Communication_Attr4); ?> value="Needs Improvement - C22 (Inappropriate pace or tone)">Needs Improvement - C22 (Inappropriate pace or tone)</option>
					<option <?= _selected("Needs Improvement - C23 (Poor personalization)",$fs->Communication_Attr4); ?> value="Needs Improvement - C23 (Poor personalization)">Needs Improvement - C23 (Poor personalization)</option>

					<option <?= _selected("Below Standard - C24 (Customer dissatisfaction issue)",$fs->Communication_Attr2); ?> value="Below Standard - C24 (Customer dissatisfaction issue)">Below Standard - C24 (Customer dissatisfaction issue)</option>
				</select>
			</td>
			<td>
				<select name="Communication_Attr5">
					<option <?= _selected("",$fs->Communication_Attr5); ?> value=""> - </option>
					<option <?= _selected("Outstanding - C01 (Excellent explanations)",$fs->Communication_Attr5); ?> value="Outstanding - C01 (Excellent explanations)">Outstanding - C01 (Excellent explanations)</option>
					<option <?= _selected("Outstanding - C02 (Excellent confidence)",$fs->Communication_Attr5); ?> value="Outstanding - C02 (Excellent confidence)">Outstanding - C02 (Excellent confidence)</option>
					<option <?= _selected("Outstanding - C03 (Asks open, probing questions)",$fs->Communication_Attr5); ?> value="Outstanding - C03 (Asks open, probing questions)">Outstanding - C03 (Asks open, probing questions)</option>
					<option <?= _selected("Outstanding - C04 (Demonstrates excellent objection handling)",$fs->Communication_Attr5); ?> value="Outstanding - C04 (Demonstrates excellent objection handling)">Outstanding - C04 (Demonstrates excellent objection handling)</option>
					<option <?= _selected("Outstanding - C05 (Excellent call flow and control)",$fs->Communication_Attr5); ?> value="Outstanding - C05 (Excellent call flow and control)">Outstanding - C05 (Excellent call flow and control)</option>
					<option <?= _selected("Outstanding - C06 (Matches customer’s pace and language)",$fs->Communication_Attr5); ?> value="Outstanding - C06 (Matches customer’s pace and language)">Outstanding - C06 (Matches customer’s pace and language)</option>
					<option <?= _selected("Outstanding - C07 (Achievement above polite and friendly)",$fs->Communication_Attr5); ?> value="Outstanding - C07 (Achievement above polite and friendly)">Outstanding - C07 (Achievement above polite and friendly)</option>
					
					<option <?= _selected("Strong - C08 (Clear explanations)",$fs->Communication_Attr5); ?> value="Strong - C08 (Clear explanations)">Strong - C08 (Clear explanations)</option>
					<option <?= _selected("Strong - C09 (Acts in a calm and confident)",$fs->Communication_Attr5); ?> value="Strong - C09 (Acts in a calm and confident)">Strong - C09 (Acts in a calm and confident)</option>
					<option <?= _selected("Strong - C10 (Active listening)",$fs->Communication_Attr5); ?> value="Strong - C10 (Active listening)">Strong - C10 (Active listening)</option>
					<option <?= _selected("Strong - C11 (Demonstrates objection handling to necessary procedures)",$fs->Communication_Attr5); ?> value="Strong - C11 (Demonstrates objection handling to necessary procedures)">Strong - C11 (Demonstrates objection handling to necessary procedures)</option>
					<option <?= _selected("Strong - C12 (Good call flow and control)",$fs->Communication_Attr5); ?> value="Strong - C12 (Good call flow and control)">Strong - C12 (Good call flow and control)</option>
					<option <?= _selected("Strong - C13 (Steady pace and tone)",$fs->Communication_Attr5); ?> value="Strong - C13 (Steady pace and tone)">Strong - C13 (Steady pace and tone)</option>
					<option <?= _selected("Strong - C14 (Polite, courteous and friendly)",$fs->Communication_Attr5); ?> value="Strong - C14 (Polite, courteous and friendly)">Strong - C14 (Polite, courteous and friendly)</option>
					<option <?= _selected("Strong - C15 (Uses customer’s name)",$fs->Communication_Attr5); ?> value="Strong - C15 (Uses customer’s name)">Strong - C15 (Uses customer’s name)</option>

					<option <?= _selected("Needs Improvement - C16 (explain in a poor manner)",$fs->Communication_Attr5); ?> value="Needs Improvement - C16 (explain in a poor manner)">Needs Improvement - C16 (explain in a poor manner)</option>
					<option <?= _selected("Needs Improvement - C17 (lack of confidence)",$fs->Communication_Attr5); ?> value="Needs Improvement - C17 (lack of confidence)">Needs Improvement - C17 (lack of confidence)</option>
					<option <?= _selected("Needs Improvement - C18 (Failed to ask sufficient questions)",$fs->Communication_Attr5); ?> value="Needs Improvement - C18 (Failed to ask sufficient questions)">Needs Improvement - C18 (Failed to ask sufficient questions)</option>
					<option <?= _selected("Needs Improvement - C19 (Limited attempt to overcome objections)",$fs->Communication_Attr5); ?> value="Needs Improvement - C19 (Limited attempt to overcome objections)">Needs Improvement - C19 (Limited attempt to overcome objections)</option>
					<option <?= _selected("Needs Improvement - C20 (Struggles to maintain call control)",$fs->Communication_Attr5); ?> value="Needs Improvement - C20 (Struggles to maintain call control)">Needs Improvement - C20 (Struggles to maintain call control)</option>
					<option <?= _selected("Needs Improvement - C21 (dead air)",$fs->Communication_Attr5); ?> value="Needs Improvement - C21 (dead air)">Needs Improvement - C21 (dead air)</option>
					<option <?= _selected("Needs Improvement - C22 (Inappropriate pace or tone)",$fs->Communication_Attr5); ?> value="Needs Improvement - C22 (Inappropriate pace or tone)">Needs Improvement - C22 (Inappropriate pace or tone)</option>
					<option <?= _selected("Needs Improvement - C23 (Poor personalization)",$fs->Communication_Attr5); ?> value="Needs Improvement - C23 (Poor personalization)">Needs Improvement - C23 (Poor personalization)</option>

					<option <?= _selected("Below Standard - C24 (Customer dissatisfaction issue)",$fs->Communication_Attr5); ?> value="Below Standard - C24 (Customer dissatisfaction issue)">Below Standard - C24 (Customer dissatisfaction issue)</option>
				</select>
			</td>
		</tr>
	</tbody>
</table>

<?php if ( $countcallmon != "1"  ) : ?>
<input name="send_scoring" type="submit" class="submitScorings submitlong update button" <?= _selected("Outstanding - ",$fs->Section1_1); ?> value="Send Scoring">
<?php endif; ?>


</form>

