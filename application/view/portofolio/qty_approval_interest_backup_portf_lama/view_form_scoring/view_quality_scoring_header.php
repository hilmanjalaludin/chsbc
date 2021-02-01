<?php  
if ( $countcallmon == "1" ) {
	$disabledform = "disabledform ";
} else {
	$disabledform = "";
}

if ( $fetchScore != "error" ) {
	$fs = $fetchScore;
} else {
	$fetchScore = "";
}
?>

<form class="<?= $disabledform; ?>submitScoring<?= $formfor; ?>" name="submitScoring<?= $formfor; ?>">

<input type="hidden" name="CustomerId" value="<?= $Customers->get_value('CustomerId'); ?>">
<input type="hidden" name="Status_Callmon" value="<?= $statuscallmon; ?>">
<table class="table1">
	<tr>
		<td>Form Name</td>
		<td><b>Direct Sales Outbound</b></td>
	</tr>
	<tr>
		<td>Name of the Agent</td>
		<td>
			<input required="required" class="required_scoring" type="text" name="Name_Of_Agent" value="<?= $Seller->full_name; ?>">
		</td>
	</tr>
	<tr>
		<td>Agent ID</td>
		<td><input required="required" class="required_scoring" type="text" name="Agent_ID" value="<?= $Seller->code_user; ?>"></td>
	</tr>
	<tr>
		<td>Evaluator Name</td>
		<td><input required="required" class="required_scoring" type="text" name="Evaluator_Name" value="<?= $Agent->full_name; ?>"></td>
	</tr>
	<tr>
		<td>Customer Segment</td>
		<td>
			<select required="required" class="required_scoring" name="Customer_Segment">
				<option value=""> - </option>
				<option <?= _selected("Premier",$fs->Customer_Segment); ?> value="Premier">Premier</option>
				<option <?= _selected("Advance",$fs->Customer_Segment); ?> value="Advance">Advance</option>
				<option <?= _selected("Mass",$fs->Customer_Segment); ?> value="Mass">Mass</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>New to Skill?</td>
		<td class="yellow">
			<select required="required" class="required_scoring" name="New_Skill">
				<option <?= _selected("",$fs->New_Skill); ?> value=""> - </option>
				<option <?= _selected("Yes",$fs->New_Skill); ?> value="Yes">Yes</option>
				<option <?= _selected("No",$fs->New_Skill); ?> value="No">No</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>PVC</td>
		<td class="yellow">
			<select required="required" class="required_scoring" name="PVC">
				<option <?= _selected("",$fs->PVC); ?> value=""> - </option>
				<option <?= _selected("Yes",$fs->PVC); ?> value="Yes">Yes</option>
				<option <?= _selected("No",$fs->PVC); ?> value="No">No</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>In Academy</td>
		<td class="yellow">
			<select required="required" class="required_scoring" name="In_Academy">
				<option <?= _selected("",$fs->In_Academy); ?> value=""> - </option>
				<option <?= _selected("Yes",$fs->In_Academy); ?> value="Yes">Yes</option>
				<option <?= _selected("No",$fs->In_Academy); ?> value="No">No</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Language</td>
		<td>
			<select required="required" class="required_scoring" name="Language">
				<option <?= _selected("",$fs->Language); ?> value=""> - </option>
				<option <?= _selected("English",$fs->Language); ?> value="English">English</option>
				<option <?= _selected("Cantonese",$fs->Language); ?> value="Cantonese">Cantonese</option>
				<option <?= _selected("Mandarin",$fs->Language); ?> value="Mandarin">Mandarin</option>
				<option <?= _selected("Bahasa",$fs->Language); ?> value="Bahasa">Bahasa</option>
				<option <?= _selected("Hindi",$fs->Language); ?> value="Hindi">Hindi</option>
				<option <?= _selected("Sinhalese",$fs->Language); ?> value="Sinhalese">Sinhalese</option>
				<option <?= _selected("Filipino",$fs->Language); ?> value="Filipino">Filipino</option>
				<option <?= _selected("Vietnamese",$fs->Language); ?> value="Vietnamese">Vietnamese</option>
				<option <?= _selected("Bengali",$fs->Language); ?> value="Bengali">Bengali</option>
			</select>
		</td>
	</tr>
</table>


<?php  
/**
 * Array
(
    [CallHistoryId] => 10
    [CallSessionId] => 0
    [CustomerId] => 400
    [CallReasonId] => 39
    [ApprovalStatusId] => 
    [CreatedById] => 33
    [UpdatedById] => 
    [AgentCode] => TELE1_1
    [SPVCode] => SPV1_1
    [ATMCode] => 0
    [AMGRCode] => AMT1
    [MGRCode] => 0
    [ADMINCode] => 0
    [CallHistoryCallDate] => 2016-06-30 20:57:46
    [CallNumber] => 08161414709
    [CallHistoryNotes] => AGENT CALL ACTIVITY - TOLONGGGGG DONG -Auto sent applikasi 
    [CallHistoryCreatedTs] => 2016-06-30 20:57:46
    [CallHistoryUpdatedTs] => 
    [CallBeforeReasonId] => 0
    [HistoryType] => 0
    [CallHirarcyHigh] => 0
)
 */

$Callhistory = $Callhistory["CallHistoryCallDate"];
$Callhistory = explode(" ",$Callhistory);
$CallDate = $Callhistory[0];
$CallTime = $Callhistory[1];

?>
<table class="table1">

	<tr>
		<td>Date of Call</td>
		<td><input class="required_scoring" type="text" name="Date_Of_Call" value="<?= $CallDate; ?>"></td>
	</tr>
	<tr>
		<td>Time of Call</td>
		<td><input class="required_scoring" type="text" name="Time_Of_Call" value="<?= $CallTime; ?>"></td>
	</tr>
	<tr>
		<td>Date of Evaluation</td>
		<td><input class="required_scoring" type="text" name="Date_Of_Evaluation" value="<?= date("d-m-Y"); ?>"></td>
	</tr>
	<tr>
		<td>Time of Evaluation</td>
		<td><input class="required_scoring" type="text" name="Time_Of_Evaluation" value="<?= date("H:i:s"); ?>"></td>
	</tr>
	<tr>
		<td>Risk Type</td>
		<td>
			<select required="required" class="required_scoring" name="Risk_Type">
				<option <?= _selected("",$fs->Risk_Type); ?> value=""> - </option>
				<option <?= _selected("High",$fs->Risk_Type); ?> value="High">High</option>
				<option <?= _selected("Medium",$fs->Risk_Type); ?> value="Medium">Medium</option>
				<option <?= _selected("Low",$fs->Risk_Type); ?> value="Low">Low</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Site</td>
		<td><input class="required_scoring" type="text" name="Site" value="<?= $fs->Site; ?>"></td>
	</tr>
	<tr>
		<td>Call Type</td>
		<td>
			<select required="required" class="required_scoring" name="Call_Type">
				<option <?= _selected("",$fs->Call_Type); ?> value=""> - </option>
				<option <?= _selected("Call Type 1",$fs->Call_Type); ?> value="Call Type 1">Call Type 1</option>
				<option <?= _selected("Call Type 2",$fs->Call_Type); ?> value="Call Type 2">Call Type 2</option>
				<option <?= _selected("Call Type 3",$fs->Call_Type); ?> value="Call Type 3">Call Type 3</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Change in Score?</td>
		<td class="yellow">
			<select required="required" class="required_scoring" name="In_Score">
				<option <?= _selected("",$fs->In_Score); ?> value=""> - </option>
				<option <?= _selected("Yes",$fs->In_Score); ?> value="Yes">Yes</option>
				<option <?= _selected("No",$fs->In_Score); ?> value="No">No</option>
			</select>
		</td>
	</tr>
	<tr>
		<td>Enter new score</td>
		<td class="yellow ">
			<input class="score_result<?= $formfor; ?>" type="text" name="Enter_New_Score" value="<?= $fs->Enter_New_Score; ?>">
		</td>
	</tr>
</table>

