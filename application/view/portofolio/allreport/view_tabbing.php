<div id="ui-report-tab-panel" class="ui-widget-panel-class-tabs">
	<ul>
		
		
		<li class="ui-tab-li-lasted"> <a href="#ui-widget-report-1"> 
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Report Call Activity"); ?> </a>
		</li>

		<li class="ui-tab-li-lasted"> <a href="#ui-widget-report-2"> 
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Report E-Coaching"); ?> </a>
		</li>

		<li class="ui-tab-li-lasted"> <a href="#ui-widget-report-3"> 
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Report Call Scoring"); ?> </a>
		</li>

		<li class="ui-tab-li-lasted"> <a href="#ui-widget-report-4"> 
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Report Schedule Agent"); ?> </a>
		</li>

		<li class="ui-tab-li-lasted"> <a href="#ui-widget-report-5"> 
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Report Referral Need Full Filled"); ?> </a>
		</li>

		<li class="ui-tab-li-lasted"> <a href="#ui-widget-report-6"> 
			<span class="ui-icon ui-icon-pencil"></span><?php echo lang("Report Absensi"); ?> </a>
		</li>

	</ul>
	
	<div id="ui-widget-report-1" class="ui-widget-panel-class-tabs"> 
		<?php $this->load->view('allreport/rpt_all_report/report_call_activity' , $contents ); ?>
	</div>
	
	<div id="ui-widget-report-2" class="ui-widget-panel-class-tabs"> 
		<?php $this->load->view('allreport/rpt_all_report/report_e_coaching' , $contents); ?>
	</div>

	<div id="ui-widget-report-3" class="ui-widget-panel-class-tabs"> 
		<?php $this->load->view('allreport/rpt_all_report/report_call_scoring' , $contents); ?>
	</div>

	<div id="ui-widget-report-4" class="ui-widget-panel-class-tabs"> 
		<?php $this->load->view('allreport/rpt_all_report/report_schedule_agent' , $contents); ?>
	</div>

	<div id="ui-widget-report-5" class="ui-widget-panel-class-tabs"> 
		<?php $this->load->view('allreport/rpt_all_report/report_referral_need' , $contents); ?>
	</div>

	<div id="ui-widget-report-6" class="ui-widget-panel-class-tabs"> 
		<?php $this->load->view('allreport/rpt_all_report/report_absensi' , $contents); ?>
	</div>
	
</div>
