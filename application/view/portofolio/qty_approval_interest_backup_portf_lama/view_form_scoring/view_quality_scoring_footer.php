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
			<td></td>
			<td>
				<select name="Rapport_Attr1">
					<option <?= _selected("",$fs->Rapport_Attr1); ?> value=""> - </option>
					<option <?= _selected("Outstanding - R01",$fs->Rapport_Attr1); ?> value="Outstanding - R01">Outstanding - R01</option>
					<option <?= _selected("Outstanding - R02",$fs->Rapport_Attr1); ?> value="Outstanding - R02">Outstanding - R02</option>
					<option <?= _selected("Outstanding - R03",$fs->Rapport_Attr1); ?> value="Outstanding - R03">Outstanding - R03</option>
					<option <?= _selected("Strong - R04",$fs->Rapport_Attr1); ?> value="Strong - R04">Strong - R04</option>
					<option <?= _selected("Strong - R05",$fs->Rapport_Attr1); ?> value="Strong - R05">Strong - R05</option>
					<option <?= _selected("Strong - R06",$fs->Rapport_Attr1); ?> value="Strong - R06">Strong - R06</option>
					<option <?= _selected("Needs Improvement - R07",$fs->Rapport_Attr1); ?> value="Needs Improvement - R07">Needs Improvement - R07</option>
					<option <?= _selected("Needs Improvement - R08",$fs->Rapport_Attr1); ?> value="Needs Improvement - R08">Needs Improvement - R08</option>
					<option <?= _selected("Needs Improvement - R09",$fs->Rapport_Attr1); ?> value="Needs Improvement - R09">Needs Improvement - R09</option>
					<option <?= _selected("Below Standard - R10",$fs->Rapport_Attr1); ?> value="Below Standard - R10">Below Standard - R10</option>
				</select>
			</td>
			<td>
				<select name="Rapport_Attr2">
					<option <?= _selected("",$fs->Rapport_Attr2); ?> value=""> - </option>
					<option <?= _selected("Outstanding - R01",$fs->Rapport_Attr2); ?> value="Outstanding - R01">Outstanding - R01</option>
					<option <?= _selected("Outstanding - R02",$fs->Rapport_Attr2); ?> value="Outstanding - R02">Outstanding - R02</option>
					<option <?= _selected("Outstanding - R03",$fs->Rapport_Attr2); ?> value="Outstanding - R03">Outstanding - R03</option>
					<option <?= _selected("Strong - R04",$fs->Rapport_Attr2); ?> value="Strong - R04">Strong - R04</option>
					<option <?= _selected("Strong - R05",$fs->Rapport_Attr2); ?> value="Strong - R05">Strong - R05</option>
					<option <?= _selected("Strong - R06",$fs->Rapport_Attr2); ?> value="Strong - R06">Strong - R06</option>
					<option <?= _selected("Needs Improvement - R07",$fs->Rapport_Attr2); ?> value="Needs Improvement - R07">Needs Improvement - R07</option>
					<option <?= _selected("Needs Improvement - R08",$fs->Rapport_Attr2); ?> value="Needs Improvement - R08">Needs Improvement - R08</option>
					<option <?= _selected("Needs Improvement - R09",$fs->Rapport_Attr2); ?> value="Needs Improvement - R09">Needs Improvement - R09</option>
					<option <?= _selected("Below Standard - R10",$fs->Rapport_Attr2); ?> value="Below Standard - R10">Below Standard - R10</option>
				</select>
			</td>
			<td>
				<select name="Rapport_Attr3">
					<option <?= _selected("",$fs->Rapport_Attr3); ?> value=""> - </option>
					<option <?= _selected("Outstanding - R01",$fs->Rapport_Attr3); ?> value="Outstanding - R01">Outstanding - R01</option>
					<option <?= _selected("Outstanding - R02",$fs->Rapport_Attr3); ?> value="Outstanding - R02">Outstanding - R02</option>
					<option <?= _selected("Outstanding - R03",$fs->Rapport_Attr3); ?> value="Outstanding - R03">Outstanding - R03</option>
					<option <?= _selected("Strong - R04",$fs->Rapport_Attr3); ?> value="Strong - R04">Strong - R04</option>
					<option <?= _selected("Strong - R05",$fs->Rapport_Attr3); ?> value="Strong - R05">Strong - R05</option>
					<option <?= _selected("Strong - R06",$fs->Rapport_Attr3); ?> value="Strong - R06">Strong - R06</option>
					<option <?= _selected("Needs Improvement - R07",$fs->Rapport_Attr3); ?> value="Needs Improvement - R07">Needs Improvement - R07</option>
					<option <?= _selected("Needs Improvement - R08",$fs->Rapport_Attr3); ?> value="Needs Improvement - R08">Needs Improvement - R08</option>
					<option <?= _selected("Needs Improvement - R09",$fs->Rapport_Attr3); ?> value="Needs Improvement - R09">Needs Improvement - R09</option>
					<option <?= _selected("Below Standard - R10",$fs->Rapport_Attr3); ?> value="Below Standard - R10">Below Standard - R10</option>
				</select>
			</td>
			<td>
				<select name="Rapport_Attr4">
					<option <?= _selected("",$fs->Rapport_Attr4); ?> value=""> - </option>
					<option <?= _selected("Outstanding - R01",$fs->Rapport_Attr4); ?> value="Outstanding - R01">Outstanding - R01</option>
					<option <?= _selected("Outstanding - R02",$fs->Rapport_Attr4); ?> value="Outstanding - R02">Outstanding - R02</option>
					<option <?= _selected("Outstanding - R03",$fs->Rapport_Attr4); ?> value="Outstanding - R03">Outstanding - R03</option>
					<option <?= _selected("Strong - R04",$fs->Rapport_Attr4); ?> value="Strong - R04">Strong - R04</option>
					<option <?= _selected("Strong - R05",$fs->Rapport_Attr4); ?> value="Strong - R05">Strong - R05</option>
					<option <?= _selected("Strong - R06",$fs->Rapport_Attr4); ?> value="Strong - R06">Strong - R06</option>
					<option <?= _selected("Needs Improvement - R07",$fs->Rapport_Attr4); ?> value="Needs Improvement - R07">Needs Improvement - R07</option>
					<option <?= _selected("Needs Improvement - R08",$fs->Rapport_Attr4); ?> value="Needs Improvement - R08">Needs Improvement - R08</option>
					<option <?= _selected("Needs Improvement - R09",$fs->Rapport_Attr4); ?> value="Needs Improvement - R09">Needs Improvement - R09</option>
					<option <?= _selected("Below Standard - R10",$fs->Rapport_Attr4); ?> value="Below Standard - R10">Below Standard - R10</option>
				</select>
			</td>
			<td>
				<select name="Rapport_Attr5">
					<option <?= _selected("",$fs->Rapport_Attr5); ?> value=""> - </option>
					<option <?= _selected("Outstanding - R01",$fs->Rapport_Attr5); ?> value="Outstanding - R01">Outstanding - R01</option>
					<option <?= _selected("Outstanding - R02",$fs->Rapport_Attr5); ?> value="Outstanding - R02">Outstanding - R02</option>
					<option <?= _selected("Outstanding - R03",$fs->Rapport_Attr5); ?> value="Outstanding - R03">Outstanding - R03</option>
					<option <?= _selected("Strong - R04",$fs->Rapport_Attr5); ?> value="Strong - R04">Strong - R04</option>
					<option <?= _selected("Strong - R05",$fs->Rapport_Attr5); ?> value="Strong - R05">Strong - R05</option>
					<option <?= _selected("Strong - R06",$fs->Rapport_Attr5); ?> value="Strong - R06">Strong - R06</option>
					<option <?= _selected("Needs Improvement - R07",$fs->Rapport_Attr5); ?> value="Needs Improvement - R07">Needs Improvement - R07</option>
					<option <?= _selected("Needs Improvement - R08",$fs->Rapport_Attr5); ?> value="Needs Improvement - R08">Needs Improvement - R08</option>
					<option <?= _selected("Needs Improvement - R09",$fs->Rapport_Attr5); ?> value="Needs Improvement - R09">Needs Improvement - R09</option>
					<option <?= _selected("Below Standard - R10",$fs->Rapport_Attr5); ?> value="Below Standard - R10">Below Standard - R10</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Ownership</td>
			<td></td>
<td>
				<select name="Ownership_Attr1">
					<option <?= _selected("",$fs->Ownership_Attr1); ?> value=""> - </option>
					<option <?= _selected("Outstanding - R01",$fs->Ownership_Attr1); ?> value="Outstanding - R01">Outstanding - R01</option>
					<option <?= _selected("Outstanding - R02",$fs->Ownership_Attr1); ?> value="Outstanding - R02">Outstanding - R02</option>
					<option <?= _selected("Outstanding - R03",$fs->Ownership_Attr1); ?> value="Outstanding - R03">Outstanding - R03</option>
					<option <?= _selected("Strong - R04",$fs->Ownership_Attr1); ?> value="Strong - R04">Strong - R04</option>
					<option <?= _selected("Strong - R05",$fs->Ownership_Attr1); ?> value="Strong - R05">Strong - R05</option>
					<option <?= _selected("Strong - R06",$fs->Ownership_Attr1); ?> value="Strong - R06">Strong - R06</option>
					<option <?= _selected("Needs Improvement - R07",$fs->Ownership_Attr1); ?> value="Needs Improvement - R07">Needs Improvement - R07</option>
					<option <?= _selected("Needs Improvement - R08",$fs->Ownership_Attr1); ?> value="Needs Improvement - R08">Needs Improvement - R08</option>
					<option <?= _selected("Needs Improvement - R09",$fs->Ownership_Attr1); ?> value="Needs Improvement - R09">Needs Improvement - R09</option>
					<option <?= _selected("Below Standard - R10",$fs->Ownership_Attr1); ?> value="Below Standard - R10">Below Standard - R10</option>
				</select>
			</td>
			<td>
				<select name="Ownership_Attr2">
					<option <?= _selected("",$fs->Ownership_Attr2); ?> value=""> - </option>
					<option <?= _selected("Outstanding - R01",$fs->Ownership_Attr2); ?> value="Outstanding - R01">Outstanding - R01</option>
					<option <?= _selected("Outstanding - R02",$fs->Ownership_Attr2); ?> value="Outstanding - R02">Outstanding - R02</option>
					<option <?= _selected("Outstanding - R03",$fs->Ownership_Attr2); ?> value="Outstanding - R03">Outstanding - R03</option>
					<option <?= _selected("Strong - R04",$fs->Ownership_Attr2); ?> value="Strong - R04">Strong - R04</option>
					<option <?= _selected("Strong - R05",$fs->Ownership_Attr2); ?> value="Strong - R05">Strong - R05</option>
					<option <?= _selected("Strong - R06",$fs->Ownership_Attr2); ?> value="Strong - R06">Strong - R06</option>
					<option <?= _selected("Needs Improvement - R07",$fs->Ownership_Attr2); ?> value="Needs Improvement - R07">Needs Improvement - R07</option>
					<option <?= _selected("Needs Improvement - R08",$fs->Ownership_Attr2); ?> value="Needs Improvement - R08">Needs Improvement - R08</option>
					<option <?= _selected("Needs Improvement - R09",$fs->Ownership_Attr2); ?> value="Needs Improvement - R09">Needs Improvement - R09</option>
					<option <?= _selected("Below Standard - R10",$fs->Ownership_Attr2); ?> value="Below Standard - R10">Below Standard - R10</option>
				</select>
			</td>
			<td>
				<select name="Ownership_Attr3">
					<option <?= _selected("",$fs->Ownership_Attr3); ?> value=""> - </option>
					<option <?= _selected("Outstanding - R01",$fs->Ownership_Attr3); ?> value="Outstanding - R01">Outstanding - R01</option>
					<option <?= _selected("Outstanding - R02",$fs->Ownership_Attr3); ?> value="Outstanding - R02">Outstanding - R02</option>
					<option <?= _selected("Outstanding - R03",$fs->Ownership_Attr3); ?> value="Outstanding - R03">Outstanding - R03</option>
					<option <?= _selected("Strong - R04",$fs->Ownership_Attr3); ?> value="Strong - R04">Strong - R04</option>
					<option <?= _selected("Strong - R05",$fs->Ownership_Attr3); ?> value="Strong - R05">Strong - R05</option>
					<option <?= _selected("Strong - R06",$fs->Ownership_Attr3); ?> value="Strong - R06">Strong - R06</option>
					<option <?= _selected("Needs Improvement - R07",$fs->Ownership_Attr3); ?> value="Needs Improvement - R07">Needs Improvement - R07</option>
					<option <?= _selected("Needs Improvement - R08",$fs->Ownership_Attr3); ?> value="Needs Improvement - R08">Needs Improvement - R08</option>
					<option <?= _selected("Needs Improvement - R09",$fs->Ownership_Attr3); ?> value="Needs Improvement - R09">Needs Improvement - R09</option>
					<option <?= _selected("Below Standard - R10",$fs->Ownership_Attr3); ?> value="Below Standard - R10">Below Standard - R10</option>
				</select>
			</td>
			<td>
				<select name="Ownership_Attr4">
					<option <?= _selected("",$fs->Ownership_Attr4); ?> value=""> - </option>
					<option <?= _selected("Outstanding - R01",$fs->Ownership_Attr4); ?> value="Outstanding - R01">Outstanding - R01</option>
					<option <?= _selected("Outstanding - R02",$fs->Ownership_Attr4); ?> value="Outstanding - R02">Outstanding - R02</option>
					<option <?= _selected("Outstanding - R03",$fs->Ownership_Attr4); ?> value="Outstanding - R03">Outstanding - R03</option>
					<option <?= _selected("Strong - R04",$fs->Ownership_Attr4); ?> value="Strong - R04">Strong - R04</option>
					<option <?= _selected("Strong - R05",$fs->Ownership_Attr4); ?> value="Strong - R05">Strong - R05</option>
					<option <?= _selected("Strong - R06",$fs->Ownership_Attr4); ?> value="Strong - R06">Strong - R06</option>
					<option <?= _selected("Needs Improvement - R07",$fs->Ownership_Attr4); ?> value="Needs Improvement - R07">Needs Improvement - R07</option>
					<option <?= _selected("Needs Improvement - R08",$fs->Ownership_Attr4); ?> value="Needs Improvement - R08">Needs Improvement - R08</option>
					<option <?= _selected("Needs Improvement - R09",$fs->Ownership_Attr4); ?> value="Needs Improvement - R09">Needs Improvement - R09</option>
					<option <?= _selected("Below Standard - R10",$fs->Ownership_Attr4); ?> value="Below Standard - R10">Below Standard - R10</option>
				</select>
			</td>
			<td>
				<select name="Ownership_Attr5">
					<option <?= _selected("",$fs->Ownership_Attr5); ?> value=""> - </option>
					<option <?= _selected("Outstanding - R01",$fs->Ownership_Attr5); ?> value="Outstanding - R01">Outstanding - R01</option>
					<option <?= _selected("Outstanding - R02",$fs->Ownership_Attr5); ?> value="Outstanding - R02">Outstanding - R02</option>
					<option <?= _selected("Outstanding - R03",$fs->Ownership_Attr5); ?> value="Outstanding - R03">Outstanding - R03</option>
					<option <?= _selected("Strong - R04",$fs->Ownership_Attr5); ?> value="Strong - R04">Strong - R04</option>
					<option <?= _selected("Strong - R05",$fs->Ownership_Attr5); ?> value="Strong - R05">Strong - R05</option>
					<option <?= _selected("Strong - R06",$fs->Ownership_Attr5); ?> value="Strong - R06">Strong - R06</option>
					<option <?= _selected("Needs Improvement - R07",$fs->Ownership_Attr5); ?> value="Needs Improvement - R07">Needs Improvement - R07</option>
					<option <?= _selected("Needs Improvement - R08",$fs->Ownership_Attr5); ?> value="Needs Improvement - R08">Needs Improvement - R08</option>
					<option <?= _selected("Needs Improvement - R09",$fs->Ownership_Attr5); ?> value="Needs Improvement - R09">Needs Improvement - R09</option>
					<option <?= _selected("Below Standard - R10",$fs->Ownership_Attr5); ?> value="Below Standard - R10">Below Standard - R10</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>Communication</td>
			<td></td>
<td>
				<select name="Communication_Attr1">
					<option <?= _selected("",$fs->Communication_Attr1); ?> value=""> - </option>
					<option <?= _selected("Outstanding - R01",$fs->Communication_Attr1); ?> value="Outstanding - R01">Outstanding - R01</option>
					<option <?= _selected("Outstanding - R02",$fs->Communication_Attr1); ?> value="Outstanding - R02">Outstanding - R02</option>
					<option <?= _selected("Outstanding - R03",$fs->Communication_Attr1); ?> value="Outstanding - R03">Outstanding - R03</option>
					<option <?= _selected("Outstanding - R04",$fs->Communication_Attr1); ?> value="Outstanding - R04">Outstanding - R04</option>
					<option <?= _selected("Outstanding - R05",$fs->Communication_Attr1); ?> value="Outstanding - R05">Outstanding - R05</option>
					<option <?= _selected("Outstanding - R06",$fs->Communication_Attr1); ?> value="Outstanding - R06">Outstanding - R06</option>
					<option <?= _selected("Outstanding - R07",$fs->Communication_Attr1); ?> value="Outstanding - R07">Outstanding - R07</option>
					
					<option <?= _selected("Strong - R08",$fs->Communication_Attr1); ?> value="Strong - R08">Strong - R08</option>
					<option <?= _selected("Strong - R09",$fs->Communication_Attr1); ?> value="Strong - R09">Strong - R09</option>
					<option <?= _selected("Strong - R10",$fs->Communication_Attr1); ?> value="Strong - R10">Strong - R10</option>
					<option <?= _selected("Strong - R11",$fs->Communication_Attr1); ?> value="Strong - R11">Strong - R11</option>
					<option <?= _selected("Strong - R12",$fs->Communication_Attr1); ?> value="Strong - R12">Strong - R12</option>
					<option <?= _selected("Strong - R13",$fs->Communication_Attr1); ?> value="Strong - R13">Strong - R13</option>
					<option <?= _selected("Strong - R14",$fs->Communication_Attr1); ?> value="Strong - R14">Strong - R14</option>
					<option <?= _selected("Strong - R15",$fs->Communication_Attr1); ?> value="Strong - R15">Strong - R15</option>

					<option <?= _selected("Needs Improvement - R16",$fs->Communication_Attr1); ?> value="Needs Improvement - R16">Needs Improvement - R16</option>
					<option <?= _selected("Needs Improvement - R17",$fs->Communication_Attr1); ?> value="Needs Improvement - R17">Needs Improvement - R17</option>
					<option <?= _selected("Needs Improvement - R18",$fs->Communication_Attr1); ?> value="Needs Improvement - R18">Needs Improvement - R18</option>
					<option <?= _selected("Needs Improvement - R19",$fs->Communication_Attr1); ?> value="Needs Improvement - R19">Needs Improvement - R19</option>
					<option <?= _selected("Needs Improvement - R20",$fs->Communication_Attr1); ?> value="Needs Improvement - R20">Needs Improvement - R20</option>
					<option <?= _selected("Needs Improvement - R21",$fs->Communication_Attr1); ?> value="Needs Improvement - R21">Needs Improvement - R21</option>
					<option <?= _selected("Needs Improvement - R22",$fs->Communication_Attr1); ?> value="Needs Improvement - R22">Needs Improvement - R22</option>
					<option <?= _selected("Needs Improvement - R23",$fs->Communication_Attr1); ?> value="Needs Improvement - R23">Needs Improvement - R23</option>

					<option <?= _selected("Below Standard - R24",$fs->Communication_Attr1); ?> value="Below Standard - R24">Below Standard - R24</option>
				</select>
			</td>
			<td>
				<select name="Communication_Attr2">
					<option <?= _selected("",$fs->Communication_Attr2); ?> value=""> - </option>
					<option <?= _selected("Outstanding - R01",$fs->Communication_Attr2); ?> value="Outstanding - R01">Outstanding - R01</option>
					<option <?= _selected("Outstanding - R02",$fs->Communication_Attr2); ?> value="Outstanding - R02">Outstanding - R02</option>
					<option <?= _selected("Outstanding - R03",$fs->Communication_Attr2); ?> value="Outstanding - R03">Outstanding - R03</option>
					<option <?= _selected("Outstanding - R04",$fs->Communication_Attr2); ?> value="Outstanding - R04">Outstanding - R04</option>
					<option <?= _selected("Outstanding - R05",$fs->Communication_Attr2); ?> value="Outstanding - R05">Outstanding - R05</option>
					<option <?= _selected("Outstanding - R06",$fs->Communication_Attr2); ?> value="Outstanding - R06">Outstanding - R06</option>
					<option <?= _selected("Outstanding - R07",$fs->Communication_Attr2); ?> value="Outstanding - R07">Outstanding - R07</option>
					
					<option <?= _selected("Strong - R08",$fs->Communication_Attr2); ?> value="Strong - R08">Strong - R08</option>
					<option <?= _selected("Strong - R09",$fs->Communication_Attr2); ?> value="Strong - R09">Strong - R09</option>
					<option <?= _selected("Strong - R10",$fs->Communication_Attr2); ?> value="Strong - R10">Strong - R10</option>
					<option <?= _selected("Strong - R11",$fs->Communication_Attr2); ?> value="Strong - R11">Strong - R11</option>
					<option <?= _selected("Strong - R12",$fs->Communication_Attr2); ?> value="Strong - R12">Strong - R12</option>
					<option <?= _selected("Strong - R13",$fs->Communication_Attr2); ?> value="Strong - R13">Strong - R13</option>
					<option <?= _selected("Strong - R14",$fs->Communication_Attr2); ?> value="Strong - R14">Strong - R14</option>
					<option <?= _selected("Strong - R15",$fs->Communication_Attr2); ?> value="Strong - R15">Strong - R15</option>

					<option <?= _selected("Needs Improvement - R16",$fs->Communication_Attr2); ?> value="Needs Improvement - R16">Needs Improvement - R16</option>
					<option <?= _selected("Needs Improvement - R17",$fs->Communication_Attr2); ?> value="Needs Improvement - R17">Needs Improvement - R17</option>
					<option <?= _selected("Needs Improvement - R18",$fs->Communication_Attr2); ?> value="Needs Improvement - R18">Needs Improvement - R18</option>
					<option <?= _selected("Needs Improvement - R19",$fs->Communication_Attr2); ?> value="Needs Improvement - R19">Needs Improvement - R19</option>
					<option <?= _selected("Needs Improvement - R20",$fs->Communication_Attr2); ?> value="Needs Improvement - R20">Needs Improvement - R20</option>
					<option <?= _selected("Needs Improvement - R21",$fs->Communication_Attr2); ?> value="Needs Improvement - R21">Needs Improvement - R21</option>
					<option <?= _selected("Needs Improvement - R22",$fs->Communication_Attr2); ?> value="Needs Improvement - R22">Needs Improvement - R22</option>
					<option <?= _selected("Needs Improvement - R23",$fs->Communication_Attr2); ?> value="Needs Improvement - R23">Needs Improvement - R23</option>

					<option <?= _selected("Below Standard - R24",$fs->Communication_Attr2); ?> value="Below Standard - R24">Below Standard - R24</option>
				</select>
			</td>
			<td>
				<select name="Communication_Attr3">
					<option <?= _selected("",$fs->Communication_Attr3); ?> value=""> - </option>
					<option <?= _selected("Outstanding - R01",$fs->Communication_Attr3); ?> value="Outstanding - R01">Outstanding - R01</option>
					<option <?= _selected("Outstanding - R02",$fs->Communication_Attr3); ?> value="Outstanding - R02">Outstanding - R02</option>
					<option <?= _selected("Outstanding - R03",$fs->Communication_Attr3); ?> value="Outstanding - R03">Outstanding - R03</option>
					<option <?= _selected("Outstanding - R04",$fs->Communication_Attr3); ?> value="Outstanding - R04">Outstanding - R04</option>
					<option <?= _selected("Outstanding - R05",$fs->Communication_Attr3); ?> value="Outstanding - R05">Outstanding - R05</option>
					<option <?= _selected("Outstanding - R06",$fs->Communication_Attr3); ?> value="Outstanding - R06">Outstanding - R06</option>
					<option <?= _selected("Outstanding - R07",$fs->Communication_Attr3); ?> value="Outstanding - R07">Outstanding - R07</option>
					
					<option <?= _selected("Strong - R08",$fs->Communication_Attr3); ?> value="Strong - R08">Strong - R08</option>
					<option <?= _selected("Strong - R09",$fs->Communication_Attr3); ?> value="Strong - R09">Strong - R09</option>
					<option <?= _selected("Strong - R10",$fs->Communication_Attr3); ?> value="Strong - R10">Strong - R10</option>
					<option <?= _selected("Strong - R11",$fs->Communication_Attr3); ?> value="Strong - R11">Strong - R11</option>
					<option <?= _selected("Strong - R12",$fs->Communication_Attr3); ?> value="Strong - R12">Strong - R12</option>
					<option <?= _selected("Strong - R13",$fs->Communication_Attr3); ?> value="Strong - R13">Strong - R13</option>
					<option <?= _selected("Strong - R14",$fs->Communication_Attr3); ?> value="Strong - R14">Strong - R14</option>
					<option <?= _selected("Strong - R15",$fs->Communication_Attr3); ?> value="Strong - R15">Strong - R15</option>

					<option <?= _selected("Needs Improvement - R16",$fs->Communication_Attr3); ?> value="Needs Improvement - R16">Needs Improvement - R16</option>
					<option <?= _selected("Needs Improvement - R17",$fs->Communication_Attr3); ?> value="Needs Improvement - R17">Needs Improvement - R17</option>
					<option <?= _selected("Needs Improvement - R18",$fs->Communication_Attr3); ?> value="Needs Improvement - R18">Needs Improvement - R18</option>
					<option <?= _selected("Needs Improvement - R19",$fs->Communication_Attr3); ?> value="Needs Improvement - R19">Needs Improvement - R19</option>
					<option <?= _selected("Needs Improvement - R20",$fs->Communication_Attr3); ?> value="Needs Improvement - R20">Needs Improvement - R20</option>
					<option <?= _selected("Needs Improvement - R21",$fs->Communication_Attr3); ?> value="Needs Improvement - R21">Needs Improvement - R21</option>
					<option <?= _selected("Needs Improvement - R22",$fs->Communication_Attr3); ?> value="Needs Improvement - R22">Needs Improvement - R22</option>
					<option <?= _selected("Needs Improvement - R23",$fs->Communication_Attr3); ?> value="Needs Improvement - R23">Needs Improvement - R23</option>

					<option <?= _selected("Below Standard - R24",$fs->Communication_Attr3); ?> value="Below Standard - R24">Below Standard - R24</option>
				</select>
			</td>
			<td>
				<select name="Communication_Attr4">
					<option <?= _selected("",$fs->Communication_Attr4); ?> value=""> - </option>
					<option <?= _selected("Outstanding - R01",$fs->Communication_Attr4); ?> value="Outstanding - R01">Outstanding - R01</option>
					<option <?= _selected("Outstanding - R02",$fs->Communication_Attr4); ?> value="Outstanding - R02">Outstanding - R02</option>
					<option <?= _selected("Outstanding - R03",$fs->Communication_Attr4); ?> value="Outstanding - R03">Outstanding - R03</option>
					<option <?= _selected("Outstanding - R04",$fs->Communication_Attr4); ?> value="Outstanding - R04">Outstanding - R04</option>
					<option <?= _selected("Outstanding - R05",$fs->Communication_Attr4); ?> value="Outstanding - R05">Outstanding - R05</option>
					<option <?= _selected("Outstanding - R06",$fs->Communication_Attr4); ?> value="Outstanding - R06">Outstanding - R06</option>
					<option <?= _selected("Outstanding - R07",$fs->Communication_Attr4); ?> value="Outstanding - R07">Outstanding - R07</option>
					
					<option <?= _selected("Strong - R08",$fs->Communication_Attr4); ?> value="Strong - R08">Strong - R08</option>
					<option <?= _selected("Strong - R09",$fs->Communication_Attr4); ?> value="Strong - R09">Strong - R09</option>
					<option <?= _selected("Strong - R10",$fs->Communication_Attr4); ?> value="Strong - R10">Strong - R10</option>
					<option <?= _selected("Strong - R11",$fs->Communication_Attr4); ?> value="Strong - R11">Strong - R11</option>
					<option <?= _selected("Strong - R12",$fs->Communication_Attr4); ?> value="Strong - R12">Strong - R12</option>
					<option <?= _selected("Strong - R13",$fs->Communication_Attr4); ?> value="Strong - R13">Strong - R13</option>
					<option <?= _selected("Strong - R14",$fs->Communication_Attr4); ?> value="Strong - R14">Strong - R14</option>
					<option <?= _selected("Strong - R15",$fs->Communication_Attr4); ?> value="Strong - R15">Strong - R15</option>

					<option <?= _selected("Needs Improvement - R16",$fs->Communication_Attr4); ?> value="Needs Improvement - R16">Needs Improvement - R16</option>
					<option <?= _selected("Needs Improvement - R17",$fs->Communication_Attr4); ?> value="Needs Improvement - R17">Needs Improvement - R17</option>
					<option <?= _selected("Needs Improvement - R18",$fs->Communication_Attr4); ?> value="Needs Improvement - R18">Needs Improvement - R18</option>
					<option <?= _selected("Needs Improvement - R19",$fs->Communication_Attr4); ?> value="Needs Improvement - R19">Needs Improvement - R19</option>
					<option <?= _selected("Needs Improvement - R20",$fs->Communication_Attr4); ?> value="Needs Improvement - R20">Needs Improvement - R20</option>
					<option <?= _selected("Needs Improvement - R21",$fs->Communication_Attr4); ?> value="Needs Improvement - R21">Needs Improvement - R21</option>
					<option <?= _selected("Needs Improvement - R22",$fs->Communication_Attr4); ?> value="Needs Improvement - R22">Needs Improvement - R22</option>
					<option <?= _selected("Needs Improvement - R23",$fs->Communication_Attr4); ?> value="Needs Improvement - R23">Needs Improvement - R23</option>

					<option <?= _selected("Below Standard - R24",$fs->Communication_Attr1); ?> value="Below Standard - R24">Below Standard - R24</option>
				</select>
			</td>
			<td>
				<select name="Communication_Attr5">
					<option <?= _selected("",$fs->Communication_Attr5); ?> value=""> - </option>
					<option <?= _selected("Outstanding - R01",$fs->Communication_Attr5); ?> value="Outstanding - R01">Outstanding - R01</option>
					<option <?= _selected("Outstanding - R02",$fs->Communication_Attr5); ?> value="Outstanding - R02">Outstanding - R02</option>
					<option <?= _selected("Outstanding - R03",$fs->Communication_Attr5); ?> value="Outstanding - R03">Outstanding - R03</option>
					<option <?= _selected("Outstanding - R04",$fs->Communication_Attr5); ?> value="Outstanding - R04">Outstanding - R04</option>
					<option <?= _selected("Outstanding - R05",$fs->Communication_Attr5); ?> value="Outstanding - R05">Outstanding - R05</option>
					<option <?= _selected("Outstanding - R06",$fs->Communication_Attr5); ?> value="Outstanding - R06">Outstanding - R06</option>
					<option <?= _selected("Outstanding - R07",$fs->Communication_Attr5); ?> value="Outstanding - R07">Outstanding - R07</option>
					
					<option <?= _selected("Strong - R08",$fs->Communication_Attr5); ?> value="Strong - R08">Strong - R08</option>
					<option <?= _selected("Strong - R09",$fs->Communication_Attr5); ?> value="Strong - R09">Strong - R09</option>
					<option <?= _selected("Strong - R10",$fs->Communication_Attr5); ?> value="Strong - R10">Strong - R10</option>
					<option <?= _selected("Strong - R11",$fs->Communication_Attr5); ?> value="Strong - R11">Strong - R11</option>
					<option <?= _selected("Strong - R12",$fs->Communication_Attr5); ?> value="Strong - R12">Strong - R12</option>
					<option <?= _selected("Strong - R13",$fs->Communication_Attr5); ?> value="Strong - R13">Strong - R13</option>
					<option <?= _selected("Strong - R14",$fs->Communication_Attr5); ?> value="Strong - R14">Strong - R14</option>
					<option <?= _selected("Strong - R15",$fs->Communication_Attr5); ?> value="Strong - R15">Strong - R15</option>

					<option <?= _selected("Needs Improvement - R16",$fs->Communication_Attr5); ?> value="Needs Improvement - R16">Needs Improvement - R16</option>
					<option <?= _selected("Needs Improvement - R17",$fs->Communication_Attr5); ?> value="Needs Improvement - R17">Needs Improvement - R17</option>
					<option <?= _selected("Needs Improvement - R18",$fs->Communication_Attr5); ?> value="Needs Improvement - R18">Needs Improvement - R18</option>
					<option <?= _selected("Needs Improvement - R19",$fs->Communication_Attr5); ?> value="Needs Improvement - R19">Needs Improvement - R19</option>
					<option <?= _selected("Needs Improvement - R20",$fs->Communication_Attr5); ?> value="Needs Improvement - R20">Needs Improvement - R20</option>
					<option <?= _selected("Needs Improvement - R21",$fs->Communication_Attr5); ?> value="Needs Improvement - R21">Needs Improvement - R21</option>
					<option <?= _selected("Needs Improvement - R22",$fs->Communication_Attr5); ?> value="Needs Improvement - R22">Needs Improvement - R22</option>
					<option <?= _selected("Needs Improvement - R23",$fs->Communication_Attr5); ?> value="Needs Improvement - R23">Needs Improvement - R23</option>

					<option <?= _selected("Below Standard - R24",$fs->Communication_Attr5); ?> value="Below Standard - R24">Below Standard - R24</option>
				</select>
			</td>
		</tr>
	</tbody>
</table>

<?php if ( $countcallmon != "1"  ) : ?>
<input name="send_scoring" type="submit" class="submitScorings submitlong update button" <?= _selected("Outstanding - ",$fs->Section1_1); ?> value="Send Scoring">
<?php endif; ?>


</form>

