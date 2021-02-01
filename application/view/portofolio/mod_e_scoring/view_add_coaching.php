<form name="frmAddCoaching" class="frmAddCoaching" display="none">
<div style="margin:5px;">
 <fieldset class="corner">
 <legend class="icon-application"> &nbsp;&nbsp;&nbsp;Add Coaching</legend>
	
		<table border=0 cellspacing="6">
			<tr>
				<td class="text_caption">AOC Number</td> 
				<td><?php echo form()->combo('AgentId','select tolong long', $AOC ); ?></td>

				<td class="text_caption">Periode</td> 
				<td><?php echo form()->input('Periode','input_text long date',null); ?></td>

				
			</tr>	
			<tr>
				<td class="text_caption">Coaching Type</td> 
				<td><?php echo form()->combo('CoachingType','select tolong long',array(
					"Coaching By Weekly" => "Coaching By Weekly" , 
					"Realtime Monitoring" => "Realtime Monitoring"
				)); ?></td>

				<td class="text_caption">Coaching Date</td> 
				<td><?php echo form()->input('CoachingDate','input_text long date',null); ?></td>
			</tr>
			<tr>
				<td class="text_caption">Notes From Previous Coaching</td> 
				<td><?php echo form()->textarea('NotePrevCoach','input_text textarea',null); ?></td>

				<td class="text_caption">Discussion Point(s)</td> 
				<td><?php echo form()->textarea('DiscussionPoint','input_text textarea',null); ?></td>

			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="button" class="save AddCoach button" value="Aknowledge SPV" onclick="ToolsProcessData.saveCoach();">
					<input type="button" class="cancel button closeaddcoach" value="Cancel">
				</td>
			</tr>
		</table>

</fieldset>
	</div>	
</form>	