<?php  
/**
	 * View Folder rpt_qa
	 * - view_daily_summary
	 * - view_report_perqa
	 * - view_suspend_duration
	 * - view_param_report
	 * - view_production_callmon
	 * - view_report_ytd
	 *
	 * Model 
	 * - M_ReportQa
*/

?>


<?php  

/**
 * Range Timr Per daily Layout
 */

?>

<div class="ui-widget-form-row">

	  <div class="ui-widget-form-cell ui-widget-content-top" id="hader-panel-content-left" style="width:50%;">
	    <fieldset class="corner" style="margin:15px 5px 5px 5px; padding:2px 17px 12px 8px; border-radius:5px;">
	      <legend class="ui-widget-awesome-context">
	        <span class="fa-stack fa-lg ui-widget-awesome-legend">
	          <i class="fa fa-circle fa-stack-2x"></i>
	          <i class="fa fa-search fa-stack-1x fa-inverse"></i>
	        </span>
	        <label id="ui-widget-title">Performance Range Time Per Daily</label>
	      </legend>

	<form class="rangetimeperdaily" send-to="SuspendDuration">
	<table border="0">
		<tr>
			<td class="text_caption">Choose Date </td>
			<td>
<input name="startdate" id="startdate1" class="input_text startdate date" value="" type="text"> - 
<input name="enddate" id="enddate1" class="input_text enddate date" value="" type="text">
</td>
		</tr>
		<tr>
			<td class="text_caption"></td>
			<td>
 <input id="Show" value="Show" form-name="rangetimeperdaily" class="page-go button" type="button">				 
 <input id="Export" value="Export" form-name="rangetimeperdaily" class="excel button" type="button">	
			</td>
		</tr>	
	</table>
	</form>


	    </fieldset>
	  </div>

<?php  //  end range time per daily ?>

<?php  

/**
 * Daily Summary QA
 */

?>


	<div class="ui-widget-form-cell ui-widget-content-top" id="hader-panel-content-right" style="width:50%;">
	    <fieldset class="corner" style="width:98%;margin:15px 5px 5px 5px; padding:8px;border-radius:5px;">
	      <legend class="ui-widget-awesome-context">
	        <span class="fa-stack fa-lg ui-widget-awesome-legend">
	          <i class="fa fa-circle fa-stack-2x"></i>
	          <i class="fa fa-search fa-stack-1x fa-inverse"></i>
	        </span>
	      <label id="ui-widget-title">Performance Daily Summary QA</label>
	      </legend>

	<form class="dailysummaryqa" send-to="DailySummary">
	<table border="0">
		<tr>
			<td class="text_caption">Choose Date </td>
			<td>
<input name="startdate" id="startdate2" class="input_text startdate date" value="" type="text"> - 
<input name="enddate" id="enddate2" class="input_text enddate date" value="" type="text">
</td>
		</tr>
		<tr>
			<td class="text_caption"></td>
			<td>
 <input id="Show" value="Show" form-name="dailysummaryqa" class="page-go button" type="button">				 
 <input id="Export" value="Export" form-name="dailysummaryqa" class="excel button" type="button">

			</td>
		</tr>	
	</table>
	</form>


	    </fieldset>
	</div>

</div>


<?php // end for Summary Daily  QA ?>

<?php  

/**
 *  Range date Per Qa or All
 */

?>

<div class="ui-widget-form-row">


	  <div class="ui-widget-form-cell ui-widget-content-top" id="hader-panel-content-left" style="width:50%;">
	    <fieldset class="corner" style="margin:15px 5px 5px 5px; padding:2px 17px 12px 8px; border-radius:5px;">
	      <legend class="ui-widget-awesome-context">
	        <span class="fa-stack fa-lg ui-widget-awesome-legend">
	          <i class="fa fa-circle fa-stack-2x"></i>
	          <i class="fa fa-search fa-stack-1x fa-inverse"></i>
	        </span>
	        <label id="ui-widget-title">Performance Range Date Per QA</label>
	      </legend>

	<form class="rangedateperqa" send-to="ReportperQa">
	<table border="0">
		<tr>
			<td class="text_caption">Choose Date </td>
			<td>
<input name="startdate" id="startdate3" class="input_text startdate date" value="" type="text"> - 
<input name="enddate" id="enddate3" class="input_text enddate date" value="" type="text">
			</td>
		</tr>
		<tr>
			<td class="text_caption">Select QA</td>
			<td> 
			<select type="combo" name="id_qa" id="submit_filter" class="select long xzselect">
				<option value=""> -- choose --</option>
				<?php  
					$selectQa = $this->M_ReportQa->getAllqa();
					if ( $selectQa != false ) {
						foreach ( $selectQa->result() as $sq ) {
							echo "<option value='".$sq->UserId."'>".$sq->full_name."</option>";
						}
					}
				?>
				<option value="ALL">All QA</option>
			</select>
			</td>
		</tr>
		<tr>
			<td class="text_caption"></td>
			<td>
 <input id="Show" value="Show" form-name="rangedateperqa" class="page-go button" type="button">				 
 <input id="Export" value="Export" form-name="rangedateperqa" class="excel button" type="button">
			</td>
		</tr>	
	</table>
	</form>

	    </fieldset>
	  </div>


<?php // Start Range date Per Callmon  ?>

	  <div class="ui-widget-form-cell ui-widget-content-top" id="hader-panel-content-left" style="width:50%;">
	    <fieldset class="corner" style="margin:15px 5px 5px 5px; padding:2px 17px 12px 8px; border-radius:5px;">
	      <legend class="ui-widget-awesome-context">
	        <span class="fa-stack fa-lg ui-widget-awesome-legend">
	          <i class="fa fa-circle fa-stack-2x"></i>
	          <i class="fa fa-search fa-stack-1x fa-inverse"></i>
	        </span>
	        <label id="ui-widget-title">Performance Call Mon Per Range Date</label>
	      </legend>

	<form class="callmonpermonth" send-to="ReportCallMonperMon">
	<table border="0">
		<tr>
			<td class="text_caption">Choose Date </td>
			<td>
<input name="startdate" id="startdate4" class="input_text startdate date" value="" type="text"> - 
<input name="enddate" id="enddate4" class="input_text enddate date" value="" type="text">
			</td>
		</tr>
		<tr>
			<td class="text_caption"></td>
			<td>
 <input id="Show" value="Show" form-name="callmonpermonth" class="page-go button" type="button">				 
 <input id="Export" value="Export" form-name="callmonpermonth" class="excel button" type="button">
			</td>
		</tr>	
	</table>
	</form>

	    </fieldset>
	  </div>


<?php // End Range date Per Callmon  ?>


</div>

<?php // end date Range Per Qa ?>




<div class="ui-widget-form-row">

<?php // Start Report YTD  ?>
	  <div class="ui-widget-form-cell ui-widget-content-top" id="hader-panel-content-left" style="width:50%;">
	    <fieldset class="corner" style="margin:15px 5px 5px 5px; padding:2px 17px 12px 8px; border-radius:5px;">
	      <legend class="ui-widget-awesome-context">
	        <span class="fa-stack fa-lg ui-widget-awesome-legend">
	          <i class="fa fa-circle fa-stack-2x"></i>
	          <i class="fa fa-search fa-stack-1x fa-inverse"></i>
	        </span>
	        <label id="ui-widget-title">Performance QA Per Year</label>
	      </legend>

	<form class="rangereportytd" send-to="ReportperQa">
	<table border="0">
		<tr>
			<td class="text_caption">Choose Date </td>
			<td>
<input name="startdate" id="startdate5" class="input_text startdate date" value="" type="text"> - 
<input name="enddate" id="enddate5" class="input_text enddate date" value="" type="text">
			</td>
		</tr>

		<tbody class="additionalform">


		</tbody>

		<tr>
			<td class="text_caption"></td>
			<td>
 <input id="Show" value="Show" form-name="rangereportytd" class="page-go button" type="button">				 
 <input id="Export" value="Export" form-name="rangereportytd" class="excel button" type="button">
			</td>
		</tr>	
	</table>
	</form>

	    </fieldset>
	  </div>

<?php // END Report YTD  ?>


</div>