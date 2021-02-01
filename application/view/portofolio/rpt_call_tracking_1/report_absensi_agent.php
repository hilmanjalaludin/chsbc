<style> .ui-widget-display-none { display:none; } .ui-widget-display-yes { display:yes; } </style>
<fieldset class="corner ui-widget-fieldset" style="width:auto;margin:5px; border-radius:5px;">
<?php echo form()->legend(lang(array("Filter","Of", "Report")),"fa-file-text-o");?>

 <form name="frmUserReport">
	<div class="ui-widget-form-table-compact">
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Report Type</div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('user_report_type','select auto', 
				array('user-report-track-absen' => 'Summary Agent Absensi','user-report-track-agenttime' => 'Summary Time Agent'), null, array("change" => "UserShowFilterReport(this);"));?></div>
		</div>
		
		<div id="ui-widget-row1" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row1">Manager</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row1">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-user-row1"><?php echo form()->combo('user_manager_id','select tolong',  $report_manager, $report_user->get_value('act_mgr') , 
				array("change" => "UserShowSpvReportByManger(this);"));?></div>
		</div>
		
		
		<div id="ui-widget-row3" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row3">Supervisor</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row3">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-user-row3"><?php echo form()->combo('user_spv_id','select tolong', $report_spv, $report_user->get_value('tl_id'),
				array("change" => "UserShowAgentReportBySpv(this);") );?></div>
		</div>
		
		<div id="ui-widget-row4" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row4">Agent</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row4">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-user-row4"><?php echo form()->combo('user_tmr_id','select tolong', $report_agent);?></div>
		</div>
		
		<div id="ui-widget-row5" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row5">Interval</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row5">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-user-row5"> <?php echo form()->input('user_start_date','input_text box date');?> &nbsp- <?php echo form()->input('user_end_date','input_text box date');?></div>
		</div>
		
		<div id="ui-widget-row6" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row6">Mode</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row6">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-user-row6"><?php echo form()->combo('user_interval','select auto', $report_mode);?></div>
		</div>
		
		<div id="ui-widget-row7" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row7"></div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row7"></div>
			<div class="ui-widget-form-cell" id="ui-widget-content-user-row7"> 
				<?php echo form()->button('','page-go button','Show',array("click"=>"new UserShowReport();"));?>
				<?php echo form()->button('','excel button','Export',array("click"=>"new UserShowExcel();"));?>
			</div>
		</div>
		
		
	</div>
</form>

</fieldset>
