<form name="frmEditCoaching" class="frmEditCoaching" display="none">
<div style="margin:5px;">
 <fieldset class="corner">
 <legend class="icon-application"> &nbsp;&nbsp;&nbsp;Feedback Agent</legend>
	
		<table border=0 cellspacing="6">

		<!-- 	<tr>
				<input type="hidden" value="" class="CoachingId">
				<td class="text_caption">Development Required / Agreed</td> 
				<td><?php //echo form()->textarea('DevRequired','input_text textarea',null); ?></td>
			</tr> -->
			<tr>
				<input type="hidden" value="" class="CoachingId">
				<td class="text_caption">Notes</td> 
				<td><?php echo form()->textarea('notes','input_text textarea',null); ?></td>
			</tr>
						
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="button" class="save AddCoach button" value="Aknowledge Agent" onclick="ToolsProcessData.saveCoachAgent();">
					<input type="button" class="cancel button closeeditcoach" value="Cancel" onclick="Ext.DOM.Clear2()">
				</td>
			</tr>
		</table>

</fieldset>
	</div>	
</form>	