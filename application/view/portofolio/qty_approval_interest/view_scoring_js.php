<style>
.table1 {
	border-collapse:collapse;
	display:inline-block;
	vertical-align:top;
	margin-left:20px;
}
.table1 tr td {
	padding:3px;
	border:1px solid #ccc;
}
.table1 select {
	padding:4px;
	width:100%;
	border-radius:4px;
	border:none;
	background:none;
}
.table1 input[type="text"] {
	width:90%;
	padding:4px;
	border-top:none;
	border-left:none;
	border-right:none;
	border-bottom:1px solid #000;
	background:none;
}



.scoring {
	border-collapse:collapse;
	margin-bottom:20px;
	margin-top:20px;
	width:96%;
}
.scoring thead th {
	padding:6px;
	border:1px solid #ccc;
	background:#deedf7;
	color:black;
}
.scoring tr td {
	padding:3px;
	border:1px solid #ccc;
}
.scoring select {
	padding:4px;
	width:95%;
	border:1px solid #ccc;
	border-radius:4px;
}
.scoring input[type="text"] {
	width:90%;
	padding:4px;
	border-top:none;
	border-left:none;
	border-right:none;
	border-bottom:1px solid #000;
	background:none;
}
.scoring textarea {
	width:90%;
	padding:4px;
	border-top:none;
	border-left:none;
	border-right:none;
	border-bottom:1px solid #000;
}

.yellow{
	background:yellow;
}
.bold{
	font-weight: bold;
}

.submitlong {
	margin:auto;
}

</style>


<script>

function toObject(arr) {
   var rv = {};
   for (var i = 0; i < arr.length; ++i)
      rv[i] = arr[i];
   return rv;
}

function submitScorings ( classs ) {
	$("."+classs).submit(function () {
		var allDataSubmit = $(this).serialize();
		
		var dataSendScoring = "";
		$( "." + classs + " .scoring" ).each(function (Numbering) {
			var NameScoring = $(this).attr("name");
			$("select" , this).each(function () {
				var allValueScoring = $( "option:selected" , this).attr("valuejs");
				if ( typeof allValueScoring != "undefined" ) {
					dataSendScoring += allValueScoring + ":";
				}
			});
			dataSendScoring = dataSendScoring.replace(/:\s*$/, "");
			dataSendScoring += ",";
		});

		//alert(dataSendScoring);

		$.ajax({
			url : Ext.DOM.INDEX+"/QtyScoring/SaveScoreQuality/" , 
			type : "POST" , 
			data : allDataSubmit + "&ValueAllSection=" + dataSendScoring , 
			//dataType : "json" , 
			isLocal : true , 
			beforeSend : function () {
				$(".submitlong").attr("disabled","disabled");
			},
			error : function (error) {
				alert("Data Cannot Send Because ..."+error);
			} , 
			success : function (data) {
				$(".submitlong").removeAttr("disabled");
				if ( data == "1" ) {
					alert("Success , Save Scoring!");
				} else {
					alert("Success , Input Failed!");
				}
			} 
		});

		

		return false;
	});
}


$(function () {
	$(".disabledform").each(function () {
		$("input,select,textarea",this).attr("disabled","disabled");
	});
});


// spv 1
changeValueScoring("section1spv1");
changeValueScoring("section2spv1");
changeValueScoring("section3spv1");
changeValueScoring("section4spv1");
changeValueScoring("section5spv1");
// spv 2
changeValueScoring("section1spv2");
changeValueScoring("section2spv2");
changeValueScoring("section3spv2");
changeValueScoring("section4spv2");
changeValueScoring("section5spv2");
// qa 1
changeValueScoring("section1qa1");
changeValueScoring("section2qa1");
changeValueScoring("section3qa1");
changeValueScoring("section4qa1");
changeValueScoring("section5qa1");
// qa 2
changeValueScoring("section1qa2");
changeValueScoring("section2qa2");
changeValueScoring("section3qa2");
changeValueScoring("section4qa2");
changeValueScoring("section5qa2");


submitScorings("submitScoringspv1");
submitScorings("submitScoringspv2");
submitScorings("submitScoringqa1");
submitScorings("submitScoringqa2");




</script>

