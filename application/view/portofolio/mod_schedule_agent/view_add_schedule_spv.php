<style>
.generate_month {
	border-collapse: collapse;
	width: 400px;
}

.generate_month tbody {
	border-collapse: collapse;
	width: 400px;
}

.generate_month th {
	border-top-left-radius: 6px;
	border-top-right-radius: 6px ;
}

.generate_month tr th {
	text-align: center;
	padding: 7px 18px;
	margin: 3px;
	background: #EAEAEA;
}

.generate_month td {
	text-align: left;
	padding: 9px;
	border: 1px solid #D0D0D0;
	font-size: 14px;
}

.generate_month tbody tr:hover {
	background: #D8D8D8;
	cursor: pointer;
	color: white;
	font-weight: bold;
}

.blocked {
	display: inline-block;
	vertical-align: top;
}

</style>

<?php  

?>

<div width="100%" style="margin:5px;">
 <fieldset class="corner">
 <legend class="icon-application"> &nbsp;&nbsp;&nbsp;Add Schedule</legend>
	<div class="blocked">
		<input type="hidden" value="" class="UserIdAgent" name="UserIdAgent">
		<table class="blocked" border="0" cellspacing="6">
			<tr>
				<td class="text_caption">User Name</td> 
				<td><?php echo form()->input('AgentId','disabled input_text long',null); ?></td>				
			</tr>	
			<tr>
				<td class="text_caption">Full Name</td> 
				<td><?php echo form()->input('FullName','disabled input_text long',null); ?>
					
				</td>
			</tr>
			<tr>
				<td class="text_caption">Month</td> 
				<td><?php 
				$year = date('Y');
				echo form()->combo('selectMonthPeriode','select tolong date_month',
					month_of_years()
				); ?>
				</td>
			</tr>
			<tr>
				<td class="text_caption"></td> 
				<td style="width:1100px;">
					<div class="block" style="height:300px;overflow-y:scroll;width:40%;display:inline-block;vertical-align:top;">
						<table class="generate_month">
							<tr>
								<th class="text_caption">Date</th> 
								<th class="text_caption">Day</th> 
								<th class="text_caption">Reason</th> 
								<th class="text_caption">Att. From</th> 
								<th class="text_caption">Att. End</th> 
							</tr>

							<tbody class="content_generate_month">
									
								
							</tbody>


						</table>
					</div>
					<div class="block" style="width:40%;display:inline-block;vertical-align:top;">
						<table border="0" cellspacing="6">
						<tr>
							<td class="text_caption">Date :</td> 
							<td><?php echo form()->input('DateSchedule','input_text long date',null); ?></td>				
						</tr>	
						<tr>
							<td class="text_caption">Day</td> 
							<td><?php echo form()->input('DayName','input_text long',null); ?></td>
						</tr>
						<tr>
							<td class="text_caption">Attendance</td> 
							<td>
								<?php echo form()->input('starttime_att','input_text box startdate' , _get_exist_session('starttime_att') );?> 
								&nbsp - 
								<?php echo form()->input('endtime_att','input_text box enddate' , _get_exist_session('endtime_att'));?>
							</td>
						</tr>
						<tr>
							<td class="text_caption">Reason</td> 
							<td><?php echo form()->combo('ReasonId','select tolong',ReasonSchedule()); ?></td>
						</tr>
						<tr>
							<td class="text_caption"></td> 
							<td>
								<button class="save button saveschedule" onclick="ToolsProcessData.SaveSchedule();">Save Schedule</button>
							</td>
						</tr>
						</table>
					</div>
				</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<input type="button" class="cancel button closeaddcoach" value="Cancel">
				</td>
			</tr>
		</table>
	</div>

		

</fieldset>
	</div>	
