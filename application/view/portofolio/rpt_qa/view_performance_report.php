<?php 
$filterBy = array(
	"SuspendDuration" => "Performance Range Time Per Daily " , 
	"DailySummary" => "Performance Daily Summary QA" , 
	"ReportperQa" => "Performance Range Date Per QA" , 
	"ReportCallMonperMon" => "Performance CallMon Per Range Date" , 
	"ReportYtd" => "Performance QA Per Year" ,
	"ActivityQa" => "Activity Quality Assurance" ,
	"RealTimeUpdate" => "Real Time Update QA / Dashboard" 
);

?>
<div class="ui-widget-form-row">

<?php // Start Report Performance  ?>
	  <div class="ui-widget-form-cell ui-widget-content-top" id="hader-panel-content-left" style="width:50%;">
	    <fieldset class="corner" style="margin:15px 5px 5px 5px; padding:2px 17px 12px 8px; border-radius:5px;">
	      <legend class="ui-widget-awesome-context">
	        <span class="fa-stack fa-lg ui-widget-awesome-legend">
	          <i class="fa fa-circle fa-stack-2x"></i>
	          <i class="fa fa-search fa-stack-1x fa-inverse"></i>
	        </span>
	        <label id="ui-widget-title">Performance QA</label>
	      </legend>

	<form class="performancereport" send-to="ReportperQa">
	<table border="0">
		<tr>
			<td class="text_caption">Choose Report </td>
			<td>
				<select class="reportBy selectchosen superlong" class="chosen-container chosen-container-single" name="">
					<option value=""> --choose-- </option>
					<?php  
					
					foreach ( $filterBy as $f => $b ) {
						echo "<option value='".$f."'>".$b."</option>";
					}

					?>
				</select>

			</td>
		</tr>

		<tbody class="appenddata">

		</tbody>
		

		<tr class="selectDate">
			<td class="text_caption">Choose Date </td>
			<td>
<input name="startdate" id="startdate1" class="input_text startdate date" value="" type="text"> - 
<input name="enddate" id="enddate1" class="input_text enddate date" value="" type="text">
			</td>
		</tr>

		<tr>
			<td class="text_caption"></td>
			<td>
 <input id="Show" value="Show" form-name="performancereport" class="page-go button" type="button">				 
 <input id="Export" value="Export" form-name="performancereport" class="excel button" type="button">
			</td>
		</tr>	
	</table>
	</form>

	    </fieldset>
	  </div>

<?php // END Report Performance  ?>



<?php // Start Report Performance  ?>
	  <div class="ui-widget-form-cell ui-widget-content-top" id="hader-panel-content-left" style="width:50%;">
	    <fieldset class="corner" style="margin:15px 5px 5px 5px; padding:2px 17px 12px 8px; border-radius:5px;">
	      <legend class="ui-widget-awesome-context">
	        <span class="fa-stack fa-lg ui-widget-awesome-legend">
	          <i class="fa fa-circle fa-stack-2x"></i>
	          <i class="fa fa-search fa-stack-1x fa-inverse"></i>
	        </span>
	        <label id="ui-widget-title">Report Daily QA</label>
	      </legend>

	<form class="reportdailyqa" send-to="CallMon">
	<table border="0">
		<tr>
			<td class="text_caption">Choose Report </td>
			<td>
				<select class="reportBy reportByWhat selectchosen superlong" class="chosen-container chosen-container-single" name="">
					<option value="0"> --choose-- </option>
					<option value="TMR">Per Telemarketing</option>
					<option value="DATE">Per Date</option>
				</select>

			</td>
		</tr>
		<tr class="namaAgent">
			<td class="text_caption">Agent Name</td>
			<td >
				<select type="combo" name="TmrId" id="TmrId" class="tolong select long">
					<option value="0"> --choose-- </option>

					<?php  
					foreach ( $this->M_ReportQa->getAllAgent()->result() as $gaa ) {
						echo "<option value='".$gaa->UserId."'>".$gaa->init_name."</option>";
					}
					?>
				</select>

			</td>
		</tr>
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
 <input id="Show" value="Show" form-name="reportdailyqa" class="page-go button" type="button">				 
 <input id="Export" value="Export" form-name="reportdailyqa" class="excel button" type="button">
			</td>
		</tr>	
	</table>
	</form>

	    </fieldset>
	  </div>

<?php // END Report Performance  ?>

<br><br>

<?php // Start Report Callmon   ?>
	  <div class="ui-widget-form-cell ui-widget-content-top" id="hader-panel-content-left" style="width:50%;">
	    <fieldset class="corner" style="margin:15px 5px 5px 5px; padding:2px 17px 12px 8px; border-radius:5px;">
	      <legend class="ui-widget-awesome-context">
	        <span class="fa-stack fa-lg ui-widget-awesome-legend">
	          <i class="fa fa-circle fa-stack-2x"></i>
	          <i class="fa fa-search fa-stack-1x fa-inverse"></i>
	        </span>
	        <label id="ui-widget-title">Report Callmon QA</label>
	      </legend>

	<form class="callmon" send-to="ReportperQa">
	<table border="0">
		<tr>
			<td class="text_caption">Choose Date </td>
			<td>
<input name="startdate" id="startdate3" class="input_text startdate date" value="" type="text"> - 
<input name="enddate" id="enddate3" class="input_text enddate date" value="" type="text">
			</td>
		</tr>



		<tr>
			<td class="text_caption"></td>
			<td>
 <input id="Show" value="Show" form-name="callmon" class="page-go button" type="button">				 
 <input id="Export" value="Export" form-name="callmon" class="excel button" type="button">
			</td>
		</tr>	
	</table>
	</form>

	    </fieldset>
	  </div>

<?php // END Report Performance  ?>



</div>
