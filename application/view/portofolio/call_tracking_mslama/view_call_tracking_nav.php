<?php
	$this->load->view('call_tracking/view_call_tracking_js');
?>

<style> .ui-widget-display-none { display:none; } .ui-widget-display-yes { display:yes; } </style>
<fieldset class="corner ui-widget-fieldset" style="width:auto;margin:5px; border-radius:5px;">
<?php echo form()->legend(lang(array("Filter","Of", "Report")),"fa-file-text-o");?>

 <form name="frmReport">
	<div class="ui-widget-form-table-compact">
		
		<div class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption">Group Type</div>
			<div class="ui-widget-form-cell text_caption center">:</div>
			<div class="ui-widget-form-cell"><?php echo form()->combo('group_type','select tolong', $report_type, null, array("change" => "Ext.DOM.DoSomething(this)") );?></div>
		</div>
		
		<div id="ui-widget-row1" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row0">Campaign</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row0">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-row0"><?php echo form()->combo('Campaign','select tolong',  $report_campaign, null, array("change" => "Ext.DOM.LoadRecsource(this)") );?></div>
		</div>
		
		<div id="ui-widget-row1" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row0">Recsource</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row0">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-row1"><?php echo form()->combo('Recsource','select tolong',  array() );?></div>
		</div>
	
		<div id="ui-widget-row3" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row3">Spv Name</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row3">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-row3"><?php echo form()->combo('spvId','select tolong', array() );?></div>
		</div>
		
		<div id="ui-widget-row4" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row4">TMR Name</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row4">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-row4"><?php echo form()->combo('TmrId','select tolong', array() );?></div>
		</div>
		
		<div id="ui-widget-row6" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row6">Mode</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row5">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-row5"><?php echo form()->combo('mode','select tolong', $report_mode, null, array("change" => "Ext.DOM.DoSomething2(this)") );?></div>
		</div>
		
		<div id="ui-widget-row5" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row5">Interval</div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row6">:</div>
			<div class="ui-widget-form-cell" id="ui-widget-content-row6"> <?php echo form()->input('start_date','input_text box date');?> &nbsp- <?php echo form()->input('end_date','input_text box date');?></div>
			
		</div>
		
		<div id="ui-widget-row7" class="ui-widget-form-row">
			<div class="ui-widget-form-cell text_caption" id="ui-widget-label-row7"></div>
			<div class="ui-widget-form-cell text_caption center" id="ui-widget-separator-row7"></div>
			<div class="ui-widget-form-cell" id="ui-widget-content-row7"> 
				<?php echo form()->button('','page-go button','Show',array("click"=>"new ShowReport();"));?>
				<?php echo form()->button('','excel button','Export',array("click"=>"new ShowExcel();"));?>
			</div>
		</div>
		
		
	</div>
</form>

</fieldset>
