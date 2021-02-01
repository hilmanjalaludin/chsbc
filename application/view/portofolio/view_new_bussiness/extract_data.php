<script type="text/javascript">
	
	// cek if loaded documnet call($this);
	function datepickerData (elements) {

		// date picker 
			Ext.query('#'+elements).datepicker({
				buttonImage : Ext.DOM.LIBRARY+'/gambar/calendar.gif', 
				buttonImageOnly	: true, 
				dateFormat : 'yy-mm-dd',
				readonly:true ,
				showOn : 'button', 
				/* onSelect : function (dates) {
		            $('#'+elements).val($(this).datepicker(''));
				} */
			}); 
	}
	
	var datePickerLoad = [ "1" , '2' ];

	for ( dpl in datePickerLoad ) {
		datepickerData("startdate"+dpl);
		datepickerData("enddate"+dpl);
	}



	// rangetimeperdaily
	// dailysummaryqa
	// rangedateperqa

var urlDefault = Ext.DOM.INDEX;

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

		if ( startdates == "" ) {
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

			if ( status == "Summary" ) {
				status = "ui";
			}

		if ( formName == "reportdailyqa" ) {
			reportBy = "ReportDailyQa";
		}
		if ( selectQa == undefined ) {
			selectQa = "";
		}

		//startdate
		//enddate
		
		var start = new Date(startdates);
	    var end = new Date(enddates);

	    if ( startdates == enddates ) {
			window.open(
				urlDefault+"/NewBussines/Extract/"+startdates+"/"
			, '_blank');
	    	return false;
	    } 



	    while( start < end ){
	    	var getFullYears = start.getFullYear();
	    	var getMonths = parseInt(start.getMonth()+1);
	    	var getDates = start.getDate();

	       if ( getMonths < 10 ) {
	       		var getMonths = '0'+getMonths;
	       }
	       if ( getDates < 10 ) {
	       		var getDates  = '0'+getDates;
	       }

	       var getByDate = getFullYears+"-"+getMonths+"-"+getDates;    
	       
	       // check dates ; alert(getByDate);
			
			window.open(
				urlDefault+"/NewBussines/Extract/"+getByDate+"/"
			, '_blank');

			//alert(urlDefault+"/NewBussines/Extract/"+getByDate+"/");


	       var newDate = start.setDate(start.getDate() + 1);
	       start = new Date(newDate);

	    }

	    return false;

	});	
}

ReportQaStatus("Export");


$(function () {
	var summary = $("#Summary");
	$(summary).click(function () {
		var statusShow = $(this).attr("status-show");
		
		if ( statusShow == "closed" ) {
			$(".showsummary").fadeIn();	
			$(this).attr("status-show","open");
		} else if ( statusShow == "open" ) {
			$(".showsummary").fadeOut();	
			$(this).attr("status-show","closed");
		}
		
		
		
	});
	
});


$(function () {
	
	$(".select").chosen();

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
		} else {
			$(".appenddata").html("");
		}
	});
});



</script>

<style>
.totalPremi {
	width:100%;
	border-collapse:collapse;
	border:1px solid #149EC4;
	border-radius:6px;
	box-shadow:inner 2px 2px #149EC4;
}

.totalPremi thead td {
	background :#149EC4;
	color:white;
	font-weight:bold;
	font-size:16px;
}

.totalPremi tr td {
	padding:10px;
	font-size:13px;
}


</style>

<div class="ui-widget-form-row">
	<div class="ui-widget-form-cell ui-widget-content-top" id="hader-panel-content-right" style="width:50%;">
	    <fieldset class="corner" style="width:98%;margin:15px 5px 5px 5px; padding:8px;border-radius:5px;">
	      <legend class="ui-widget-awesome-context">
	        <span class="fa-stack fa-lg ui-widget-awesome-legend">
	          <i class="fa fa-circle fa-stack-2x"></i>
	          <i class="fa fa-search fa-stack-1x fa-inverse"></i>
	        </span>
	      <label id="ui-widget-title">Export Extract Data</label>
	      </legend>

	<form class="dailysummaryqa" send-to="DailySummary">
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
			
			
 <input id="Export" value="Export" form-name="dailysummaryqa" class="page-go button" type="button">
 <input id="Summary" value="Show All Summary" form-name="" status-show="closed" class="page-go button" type="button">
 
			</td>
		</tr>	
	
	</form>
	

	</table>
	 
	 
	 
	    </fieldset>
	</div>
</div>


<?php
$EUI = get_instance();
$loadAllSummary = "select 
		count( distinct a.CustomerId) as TotalPIF ,
		sum(c.PolicyPremi) as TotalPremi
		from t_gn_customer a
		inner join t_gn_policyautogen b on a.CustomerId=b.CustomerId
		inner join t_gn_policy c on b.PolicyNumber=c.PolicyNumber
		where a.CallReasonQue in (15,16)
		and a.CampaignId not in(19,20,21)
		#group by b.PolicyNumber";
$totalDataExtract = $EUI->db->query($loadAllSummary);
if ( $totalDataExtract == true AND $totalDataExtract->num_rows() > 0 ) {
	$tde = $totalDataExtract->row();
	$totalPIF = $tde->TotalPIF;
	$totalPremi = $tde->TotalPremi;
} else {
	$totalPIF = 0;
	$totalPremi = 0;
}
?>

<div class="ui-widget-form-row showsummary" style="display:none;" >
	<div class="ui-widget-form-cell ui-widget-content-top" id="hader-panel-content-right" style="width:50%;">
	    <fieldset class="corner" style="width:98%;margin:15px 5px 5px 5px; padding:8px;border-radius:5px;">
	      <legend class="ui-widget-awesome-context">
	        <span class="fa-stack fa-lg ui-widget-awesome-legend">
	          <i class="fa fa-circle fa-stack-2x"></i>
	          <i class="fa fa-search fa-stack-1x fa-inverse"></i>
	        </span>
	      <label id="ui-widget-title">Summary Extract Data</label>
	      </legend>
		  
		  <table class="totalPremi">
			<thead>
				<tr>
					<td>Total Customer</td>
					<td>Total Premi</td>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><?= _getCurrency($totalPIF); ?></td>
					<td><?=  _getCurrency($totalPremi); ?></td>
				</tr>
			</tbody>
		  </table>
			
			
	    </fieldset>
	</div>
</div>



