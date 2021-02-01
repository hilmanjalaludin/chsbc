<script type="text/javascript">
	
	// cek if loaded documnet call($this);
	function datepickerData (elements) {

		// date picker 
			Ext.query('#'+elements).datepicker({
				buttonImage : Ext.DOM.LIBRARY+'/gambar/calendar.gif', 
				buttonImageOnly	: true, 
				dateFormat : 'dd-mm-yy',
				readonly:true ,
				showOn : 'button', 
				onSelect : function (dates) {
		            $('#'+elements).val($(this).datepicker(dateFormat));
				}
			}); 
	}
	
	var datePickerLoad = [ "1" , "2" , "3" , "4" , "5" , "6" , "7" , "8" ];

	for ( dpl in datePickerLoad ) {
		datepickerData("startdate"+dpl);
		datepickerData("enddate"+dpl);
	}



	// rangetimeperdaily
	// dailysummaryqa
	// rangedateperqa

var urlDefault = Ext.DOM.INDEX;

$("#TmrId").toogle();


function ReportQaStatus ( status  ) {

	$(document).on("click" , "#"+status , function () {
		var formName = $(this).attr("form-name"); // get form name
		var forms = $("."+formName); // formname
		
		// attribute send
		var startdates = forms.find(".startdate").val();
		var reportBy = forms.find(".reportBy").val();
		var enddates = forms.find(".enddate").val();
		var selectQa = forms.find(".selectQa").val();

		var sendTo = forms.attr("send-to");

		if ( reportBy == "RealTimeUpdate" ) {

		} else if ( reportBy == "reportdailyqa" || reportBy == "callmon" ) {
			if ( startdates == "reportdailyqa"  ) {
				alert("Date is empty!");
				forms.find(".startdate").css("border" ," 1px solid red");
				return false;
			} else {
				forms.find(".startdate").css("border","1px solid #cccddd");
			} if ( enddates == "" ) {
				alert("Date is empty!");
				forms.find(".enddate").css("border" ," 1px solid red");
				return false;
			} else {
				forms.find(".enddate").css("border","1px solid #cccddd");
			} if ( reportBy == "" ) {
				alert("Choose Report!");
				return false;
			}
		}
		

			if ( status == "Show" ) {
				status = "ui";
			}

		if ( formName == "reportdailyqa" ) {
			reportBy = "ReportDailyQa";
		} else if ( formName == "callmon" ) {
			reportBy = "CallMon";
		}

		if ( selectQa == undefined ) {
			selectQa = "";
		}

		if ( reportBy == "RealTimeUpdate" ) {
			window.open(
				urlDefault+"/ReportQa/"+reportBy+"/"+status+"/"
			);
		} else if ( reportBy == "ReportDailyQa" ) {
			var TmrId = forms.find("#TmrId").val();
			var reportByWhat = forms.find(".reportByWhat").val();
			if ( reportByWhat == 0 ) {
				alert("Report By is Empty!");
				return false;
			} else {
				if ( reportByWhat == "TMR" ) {
					if ( TmrId == 0 ) {
						alert("Choose Agent!");
						return false;
					}
				} else {

				}
			}
			
			window.open(
				urlDefault+"/ReportQa/"+reportBy+"/"+status+"/"+reportByWhat+"/"+startdates+"/"+enddates+"/?agent="+TmrId
			);

		} else {
			window.open(
				urlDefault+"/ReportQa/"+reportBy+"/"+status+"/"+startdates+"/"+enddates+"/"+selectQa
			);
		}


	});	
}

ReportQaStatus("Show");
ReportQaStatus("Export");


function checkReportBy () {
	$(".reportByWhat").change(function () {
		var valueByWhat = $(this).val();
		if ( valueByWhat == "TMR" ) {
			$(".namaAgent").fadeIn();
		} else if ( valueByWhat == "DATE" ) {
			$(".namaAgent").fadeOut();
		}
	});


}


checkReportBy();


$(function () {
	
	$(".selectchosen").chosen();

	$(".reportBy").change(function () {
		if ( $(this).val() == "ReportperQa" ) {
			$.ajax({
				url : urlDefault+"/ReportQa/getAllQa" , 
				type : "POST" , 
				dataType : "html" , 
				success : function (data) {
					$(".appenddata").append(data);
					$(".select").chosen();
				} , 
				beforeSend : function () {

				}
			});
		} else if ( $(this).val() == "RealTimeUpdate" ) {
			$(".selectDate").fadeOut();
		} else {
			$(".appenddata").html("");
			$(".selectDate").fadeIn();
		}
	});
});



</script>