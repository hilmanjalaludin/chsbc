<script>
ToolsProcessData.closeEditCoachSpv();
</script>

<form name="frmEditCoachingSpv" class="frmEditCoachingSpv" display="none">
<div style="margin:5px;">
 <fieldset class="corner">
 <legend class="icon-application"> &nbsp;&nbsp;&nbsp;Add Coaching</legend>
	
		<table border=0 cellspacing="6">
			<tr>

				<input type="hidden" id="CoachingId_edit" name="CoachingId_edit" value="<?= $Coach["CoachingId"]; ?>">

				<td class="text_caption">AOC Number</td> 
				<td><?php echo form()->combo('AgentId_edit','select tolong long', $AOC , $Coach["AgentId"] ); ?></td>

				<td class="text_caption">Periode</td> 
				<td><?php echo form()->input('Periode_edit','input_text long', $Coach["Periode"] ); ?></td>

				
			</tr>	
			<tr>
				<td class="text_caption">Coaching Type</td> 
				<td><?php echo form()->combo('CoachingType_edit','select tolong long',array(
					"Coaching By Weekly" => "Coaching By Weekly" , 
					"Realtime Monitoring" => "Realtime Monitoring"
				) , $Coach["CoachingType"] ); ?></td>

				<td class="text_caption">Coaching Date</td> 
				<td><?php echo form()->input('CoachingDate_edit','input_text long', $Coach["CoachingDate"] ); ?></td>
			</tr>
			<tr>
				<td class="text_caption">Notes From Previous Coaching</td> 
				<td><?php echo form()->textarea('NotePrevCoach_edit','input_text textarea', $Coach["NotePrevCoach"] ); ?></td>

				<td class="text_caption">Discussion Point(s)</td> 
				<td><?php echo form()->textarea('DiscussionPoint_edit','input_text textarea', $Coach["DiscussionPoint"] ); ?></td>

			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="button" class="save AddCoach button" value="Aknowledge SPV" onclick="ToolsProcessData.saveCoachSpv();">
					<input type="button" class="cancel button closeeditcoachspv" value="Cancel">
				</td>
			</tr>
		</table>

</fieldset>
	</div>	
</form>	