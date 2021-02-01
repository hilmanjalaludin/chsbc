<?php 
/**
 * 1 Form mempunyai masing2 parameter yang berbeda 
* dengan class yang sama 

* Contoh :
* Parameter 1 Manager
* Parameter 2 Spv
* Parameter 3 Agent 

// Without Above
* 1. StartDate
* 2. EndDate
*/

?>

<script>

$(document).ready(function () {
  $('#ui-report-tab-panel').mytab().tabs();
  $('#ui-report-tab-panel').mytab().tabs("option", "selected", 0);
  $("#ui-report-tab-panel").mytab().close();
  $('.ui-widget-panel-class-tabs').css({'background-color':'#FFFFFF'});
  
  // -------- date picker  ----------------------
  $('.date').datepicker ({ 
	   	showOn : 'button', 
	    buttonImage : Ext.Image("calendar.gif"),  
	    buttonImageOnly	: true, 
		dateFormat : 'dd-mm-yy', 
		readonly:true, 
		changeYear:true, 
		changeMonth:true 
  });
  var class_data = $(".time");
	$(class_data).attr('maxlength','5');
	$(class_data).keyup(function () {
		var value_data = $(this).val();
		if ( !isNaN(value_data) ) {
			var checkLength = parseInt(value_data.length);
			if ( checkLength >= 4 ) {
				var char_time = value_data[0];
				char_time += value_data[1];
				char_time += ":";
				char_time += value_data[2];
				char_time += value_data[3];
				$(this).attr('value',char_time);
			}
		} else {
			//alert("This is not number!");
			return false;
		}
	});



  $('#ui-widget-tabs-title').html( Ext.System.view_file_name() ); 

});


var ShowReport = {

	echo : function ( text , event ) {
		alert(text);
		event.preventDefault();
		return false;
	} ,

	printr : function ( objectData ) {
		console.log(objectData);
		return false;
	} ,

	Do : function () {
		var ShowHTML  = $(".reporthtml");
		var ShowEXCEL = $(".reportexcel");

		/**
		 * [description]
		 * @param  {[type]} ) {			var      ClosestForm [description]
		 * @return {[type]}   [description]
		 */
		
		$(ShowHTML).click(function (event) {
			var ClosestForm = $(this).closest("form");
			var NameForm  = ClosestForm.attr("name");
			var ClassForm = $("." + ClosestForm.attr("class") );

			if ( NameForm == "reportschedule" ) {
				var month = $( "#month" , ClassForm ).val();
				var starttime_att_monfri = $( "#starttime_att_monfri" , ClassForm ).val();
				var endtime_att_monfri = $( "#endtime_att_monfri" , ClassForm ).val();

				// start date and enddate
				var starttime_att_sat = $( "#starttime_att_sat" , ClassForm ).val();
				var endtime_att_sat = $( "#endtime_att_sat" , ClassForm ).val();
				var month = $( "#month" , ClassForm ).val();

				if ( month     == "" ) ShowReport.echo("Month Cannot be Empty!");
				if ( starttime_att_monfri     == "" ) ShowReport.echo("Starttime Cannot be Empty!");
				if ( endtime_att_monfri   == "" ) ShowReport.echo("Endtime Cannot be Empty!");
				if ( starttime_att_sat == "" ) ShowReport.echo("Start Time Cannot be Empty!");
				if ( endtime_att_sat   == "" ) ShowReport.echo("End Time Cannot be Empty!");

				var UrlWindow = Ext.DOM.INDEX + "/AllReport/ShowReport/?";
				UrlWindow += "month="+month;
				UrlWindow += "&starttime_sat="+starttime_att_sat;
				UrlWindow += "&endtime_sat="+endtime_att_sat;
				UrlWindow += "&starttime_monfri="+starttime_att_monfri;
				UrlWindow += "&endtime_monfri="+endtime_att_monfri;
				UrlWindow += "&get_report="+NameForm;
				UrlWindow += "&mode=HTML";
			} else {
				var MgrId = $( ".user_manager_id" , ClassForm ).val();
				var SpvId = $( ".user_spv_id" , ClassForm ).val();
				var AgentId = $( ".user_tmr_id" , ClassForm ).val();

				// start date and enddate
				var StartDate = $( ".startdate" , ClassForm ).val();
				var EndDate = $( ".enddate" , ClassForm ).val();

				var UrlWindow = Ext.DOM.INDEX + "/AllReport/ShowReport/?";

				if ( MgrId     == "" ) ShowReport.echo("Manager Cannot be Empty!");
				if ( SpvId     == "" ) ShowReport.echo("Supervisor Cannot be Empty!");
				// if ( AgentId   == "" ) ShowReport.echo("Agent Cannot be Empty!");
				if ( StartDate == "" ) ShowReport.echo("Start Date Cannot be Empty!");
				if ( EndDate   == "" ) ShowReport.echo("End Date Cannot be Empty!");

				UrlWindow += "StartDate="+StartDate;
				UrlWindow += "&EndDate="+EndDate;
				UrlWindow += "&MgrId="+MgrId;
				UrlWindow += "&SpvId="+SpvId;
				UrlWindow += "&AgentId="+AgentId;
				UrlWindow += "&get_report="+NameForm;
				UrlWindow += "&mode=HTML";
			}
			

			event.stopImmediatePropagation();
		    event.preventDefault();
			window.open(UrlWindow);
			//alert(UrlWindow);

		
			
		});

		/**
		 * [description]
		 * @param  {[type]} ) {			var      ClosestFormExcel [description]
		 * @return {[type]}   [description]
		 */
		$(ShowEXCEL).click(function (event) {
			var ClosestForm = $(this).closest("form");
			var NameForm  = ClosestForm.attr("name");
			var ClassForm = $("." + ClosestForm.attr("class") );

			if ( NameForm == "reportschedule" ) {
				var month = $( "#month" , ClassForm ).val();
				var starttime_att_monfri = $( "#starttime_att_monfri" , ClassForm ).val();
				var endtime_att_monfri = $( "#endtime_att_monfri" , ClassForm ).val();

				// start date and enddate
				var starttime_att_sat = $( "#starttime_att_sat" , ClassForm ).val();
				var endtime_att_sat = $( "#endtime_att_sat" , ClassForm ).val();
				var month = $( "#month" , ClassForm ).val();

				if ( month     == "" ) ShowReport.echo("Month Cannot be Empty!");
				if ( starttime_att_monfri     == "" ) ShowReport.echo("Starttime Cannot be Empty!");
				if ( endtime_att_monfri   == "" ) ShowReport.echo("Endtime Cannot be Empty!");
				if ( starttime_att_sat == "" ) ShowReport.echo("Start Time Cannot be Empty!");
				if ( endtime_att_sat   == "" ) ShowReport.echo("End Time Cannot be Empty!");

				var UrlWindow = Ext.DOM.INDEX + "/AllReport/ShowReport/?";
				UrlWindow += "month="+month;
				UrlWindow += "&starttime_sat="+starttime_att_sat;
				UrlWindow += "&endtime_sat="+endtime_att_sat;
				UrlWindow += "&starttime_monfri="+starttime_att_monfri;
				UrlWindow += "&endtime_monfri="+endtime_att_monfri;
				UrlWindow += "&get_report="+NameForm;
				UrlWindow += "&mode=EXCEL";

			} else {
				var MgrId = $( ".user_manager_id" , ClassForm ).val();
				var SpvId = $( ".user_spv_id" , ClassForm ).val();
				var AgentId = $( ".user_tmr_id" , ClassForm ).val();

				// start date and enddate
				var StartDate = $( ".startdate" , ClassForm ).val();
				var EndDate = $( ".enddate" , ClassForm ).val();


				if ( MgrId     == "" ) ShowReport.echo("Manager Cannot be Empty!");
				if ( SpvId     == "" ) ShowReport.echo("Supervisor Cannot be Empty!");
				if ( AgentId   == "" ) ShowReport.echo("Agent Cannot be Empty!");
				if ( StartDate == "" ) ShowReport.echo("Start Date Cannot be Empty!");
				if ( EndDate   == "" ) ShowReport.echo("End Date Cannot be Empty!");

				var UrlWindow = Ext.DOM.INDEX + "/AllReport/ShowReport/?";
				UrlWindow += "StartDate="+StartDate;
				UrlWindow += "&EndDate="+EndDate;
				UrlWindow += "&MgrId="+MgrId;
				UrlWindow += "&SpvId="+SpvId;
				UrlWindow += "&AgentId="+AgentId;
				UrlWindow += "&get_report="+NameForm;
				UrlWindow += "&mode=EXCEL";
			}
			

			event.stopImmediatePropagation();
		    event.preventDefault();

			window.open(UrlWindow);
			
		});

	} , 

	ShowReport : function () {
		window.open(this.UrlData);
	} , 

	ShowSpv : function () {
		$(".user_manager_id").change(function () {
			var value_manager = $(this).val();
			var FormName = $("."+ $(this).closest("form").attr("class"));
			
			// Send Post Data
			var URLSend = Ext.DOM.INDEX + "/" ;
			$.post( URLSend+"AllReport/SetSelectSpv/"+value_manager , { GetSpv : '1' } , function(data) {
				$("#user_spv_id" , FormName).html(data);			
			});

		});
	} , 

	ShowAgent : function () {
		$(".user_spv_id").change(function () {
			var value_spv = $(this).val();
			var FormName = $("."+ $(this).closest("form").attr("class"));
			
			// Send Post Data
			var URLSend = Ext.DOM.INDEX + "/" ;
			$.post( URLSend+"AllReport/SetSelectAgent/"+value_spv , { GetAgent : '1', value_spv: value_spv } , function(data) {
				$("#user_tmr_id" , FormName).html(data);			
			});

		});
	}

};

ShowReport.Do();
ShowReport.ShowSpv();
ShowReport.ShowAgent();



</script>	