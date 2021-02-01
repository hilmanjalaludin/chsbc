<style> .ui-widget-display-none { display:none; } .ui-widget-display-yes { display:yes; } </style>
<fieldset class="corner ui-widget-fieldset" style="width:auto;margin:5px; border-radius:5px;">
<?php echo form()->legend(lang(array("Generate","Schedule", "Report")),"fa-file-text-o");?>

 <form name="reportschedule" class="ScheduleAgent">
	<input type="hidden" name="report_type" value="reportschedule">
	<div class="ui-widget-form-table-compact">		
		<div id="ui-widget-row1" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row1">Month</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row1">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-user-row1"><?php echo form()->combo('month','select month tolong', month_of_years() , "" , "" );?></div>
		</div>
		
		
		<div id="ui-widget-row3" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row3">Monday - Friday</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row3">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-user-row3">
				<?php echo form()->input('starttime_att_monfri','input_text box time startdate' , setScheduleTime('','start') );?> 
								&nbsp - 
				<?php echo form()->input('endtime_att_monfri','input_text box time enddate' , setScheduleTime('','end') );?>
			</div>
		</div>
		
		<div id="ui-widget-row4" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row4">Saturday</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row4">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-user-row4">
				<?php echo form()->input('starttime_att_sat','input_text time box startdate' , setScheduleTime('Sabtu','start') );?> 
								&nbsp - 
				<?php echo form()->input('endtime_att_sat','input_text time box enddate' , setScheduleTime('Sabtu','end') );?>

			</div>
		</div>

		<div id="ui-widget-row7" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row7"></div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row7"></div>
			<div class="ui-widget-form-cell" id="ui-widget-content-row7"> 
				<input name="ShowHtml"  id="ShowHtml" for="" dates-to="_createbydate" value="Show" class="page-go reporthtml button" type="button">
				<input name="ShowExcel" id="ShowExcel" for="" dates-to="_createbydate" value="Export" class="excel reportexcel button" type="button">
			</div>
		</div>
		
		
	</div>
</form>

</fieldset>

