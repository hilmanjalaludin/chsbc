<style> .ui-widget-display-none { display:none; } .ui-widget-display-yes { display:yes; } </style>
<fieldset class="corner ui-widget-fieldset" style="width:auto;margin:5px; border-radius:5px;">
<?php echo form()->legend(lang(array("Filter","Of", "Report")),"fa-file-text-o");?>

 <form name="ecoaching" class="ECoaching">
	<input type="hidden" name="report_type" value="callactivity">
	<div class="ui-widget-form-table-compact">		
		<div id="ui-widget-row1" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row1">Manager</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row1">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-user-row1"><?php echo form()->combo('user_manager_id','select user_manager_id tolong', $MgrId , "" , "" );?></div>
		</div>
		
		
		<div id="ui-widget-row3" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row3">Supervisor</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row3">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-user-row3">
				<select name="user_spv_id" id="user_spv_id" class="select user_spv_id tolong" multiple>
					<option value="">- choose -</option>
				</select>
			</div>
		</div>
		
		<div id="ui-widget-row4" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row4">Agent</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row4">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-user-row4">
				<select name="user_tmr_id" id="user_tmr_id" class="select user_tmr_id tolong" multiple>
					<option value="">- choose -</option>
				</select>
			</div>
		</div>

		<div id="ui-widget-row5" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row5">Interval</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row5">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-row5"> <?php echo form()->input('start_date_ec','input_text box startdate date');?> &nbsp - <?php echo form()->input('end_date_ec','input_text box enddate date');?></div>
		</div>

		<div id="ui-widget-row7" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row7"></div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row7"></div>
			<div class="ui-widget-form-cell" id="ui-widget-content-row7"> 
				<input name="ShowHtml"  id="ShowHtml" for="" onclick="ShowReport.Do(this)" dates-to="_createbydate" value="Show" class="page-go reporthtml button" type="button">
				<input name="ShowExcel" id="ShowExcel" for="" dates-to="_createbydate" value="Export" class="excel reportexcel button" type="button">
			</div>
		</div>
		
		
	</div>
</form>

</fieldset>
