
// section 1
// =IF(AND(G18="N/A",G16="Yes"),2.5,IF(AND(G18="Yes",G16="Yes"),2,IF(AND(G18="No",G16="Yes"),2,IF(AND(G16="No"),0,0))))
// =IF(AND(G18="N/A",G17="Yes"),2.5,IF(AND(G18="Yes",G17="Yes"),2,IF(AND(G18="No",G17="Yes"),2,IF(AND(G17="No"),0,0))))
// =IF($G$18="Yes",1,IF($G$18="No",0,"N/A"))
// value
// =IF($G$16="No - Section Fail",0,SUM($H$16:$H$18))

// section 2
// =IF($G$21="Outstanding",15,IF($G$21="Strong",10,IF($G$21="Needs Improvement",5,0)))
// =IF($G$22="Outstanding",15,IF($G$22="Strong",10,IF($G$22="Needs Improvement",5,0)))
// =IF($G$23="Outstanding",15,IF($G$23="Strong",10,IF($G$23="Needs Improvement",5,0)))
// value 
// =IF($G$21="Below Standard",0,IF($G$22="Below Standard",0,IF($G$23="Below Standard",0,SUM($H$21:$H$23))))

// section 3
// =IF($G$26="Yes",8,0)
// =IF($G$28="Yes",4,0)
// =IF($G$29="Yes",4,0)
// =IF($G$30="Yes",4,0)
// value 
// =IF(G26="No",0,SUM(H26:H30))

// section 4
// =IF($G$33="Yes",10,IF($G$33="Minor Error",5,0))
// =IF($G$33="Yes",10,IF($G$33="Minor Error",5,0))
// value
// =IF(AND($G$33="Major Error",$G$34="Yes"),10,IF(AND($G$33="Major Error",$G$34="Minor Error"),0,IF($G$33="Major Error - Section Fail",0,IF($G$34="Major Error - Section Fail",0,SUM($H$33:$H$34)))))

// section 5 
// NA
// value 
// =IF($G$34="Major Error - Form Fail",0,SUM($H$35,$H$31,$H$24,$H$19))


function getTotalAllScore ( formfor ) {
	var TotalScoreAll = 0;
		$(".totalsection"+formfor).each(function () {
			var ValueScore = $(this).html();
			if ( !isNaN(ValueScore) ) {
				var CheckSelectedFatality = $("option:selected",".fatalityform_1").attr("fatality");
				if ( CheckSelectedFatality == "true" && CheckSelectedFatality != "undefined" ) {
					TotalScoreAll += 0;
				} else {	
					TotalScoreAll += parseInt(ValueScore);
				}
			} else {
				TotalScoreAll += 0;
			}
		});
	$(".totalscore_all"+formfor).html(TotalScoreAll);
	$(".score_result"+formfor).val(TotalScoreAll);
}

function changeSectionvalue ( classs , formfor ) {
	$(document).on("change" , "."+classs , function () {

		var triggerto = $(this).attr("triggerto");
		var appendto = $(this).attr("appendto");
		var fatalValue = $("option:selected",this).attr("fatal");
		var fatalityValue = $("option:selected",this).attr("fatality");

		if ( $(this).val() == "N/A" ) {
			$("."+triggerto).html("N/A");
		} else {
			$("."+triggerto).html($("option:selected",this).attr("valuejs"));
		}

		if ( typeof appendto != "undefined" ) {
			$("."+appendto).val($(this).val());
			//alert($(this).val());
		} else {
			
		}
		var TotalScore = 0;
		
		$("."+classs).each(function () {

			var FindFatal = $(this).find("option:selected" , this).attr("fatal");
			var FindFatality = $(this).find("option:selected" , this).attr("fatality");

			if ( FindFatal == "true" ) {
				$(".totalscore_"+classs).html(0);
				$(".InputScore_"+classs).val(0);
				getTotalAllScore(formfor);
				setTimeOut(function(){
					return false; 
				} , 1200);
				return false; 
			}

			if ( FindFatality == "true" ) {
				$(".totalscore_all"+formfor).html("0");
				$(".score_result"+formfor).val("0");
			}

			var thisValue  = $("option:selected",this).attr("valuejs");

			var frontValue = $(this).val();

			if ( frontValue == "N/A" ) {
				var jsonfor = $("option:selected",this).attr("jsonfor");
				if ( typeof jsonfor != "undefined" ) {
					$(jsonfor).html(thisValue);

					if ( thisValue == "2.5" )	
						$(".totalscore_"+classs).html(5); 
						$(".InputScore_"+classs).val(5);
						setTimeOut(function () {
							return false;
						} , 2000 );
						return false;

				} else {
					alert("Json is not found!");
				}
			} else {		
				$(".totalscore_"+classs).html(TotalScore);
				$(".InputScore_"+classs).val(TotalScore);
			}

			if ( !isNaN(thisValue)  ) {
				thisValue = parseInt(thisValue); 
			} else {
				thisValue = 0;
			}

			TotalScore += thisValue
		});

		if ( fatalValue != "undefined" && fatalValue == "true" ) {
			$(".totalscore_"+classs).html("0");
			$(".InputScore_"+classs).val("0");
			return false;
		}

		if ( fatalityValue != "undefined" && fatalityValue == "true" ) {
			//alert(".totalscore_all"+formfor);
			//alert(".score_result"+formfor);
			//return false;
			$(".totalscore_all"+formfor).html("0");
			$(".score_result"+formfor).val("0");
			//.totalscore_allspv1
			//.score_resultspv1
			return false;
		} else {
			$(".totalscore_"+classs).html(TotalScore);
			$(".InputScore_"+classs).val(TotalScore);
		}

		getTotalAllScore(formfor);

	});
}


function changeValueScoring ( classses ) {
	$("."+classses).each(function () {
		var triggertoHandle = $(this).attr("triggerto");
		var selectedvalueJsOption = $("option:selected",  this).attr("valuejs");
		$("."+triggertoHandle).html(selectedvalueJsOption);
	});
}


// spv 1
changeSectionvalue("section1spv1" , "spv1");
changeSectionvalue("section2spv1" , "spv1");
changeSectionvalue("section3spv1" , "spv1");
changeSectionvalue("section4spv1" , "spv1");
changeSectionvalue("section5spv1" , "spv1");
// spv 2
changeSectionvalue("section1spv2" , "spv2");
changeSectionvalue("section2spv2" , "spv2");
changeSectionvalue("section3spv2" , "spv2");
changeSectionvalue("section4spv2" , "spv2");
changeSectionvalue("section5spv2" , "spv2");
// qa 1
changeSectionvalue("section1qa1" , "qa1");
changeSectionvalue("section2qa1" , "qa1");
changeSectionvalue("section3qa1" , "qa1");
changeSectionvalue("section4qa1" , "qa1");
changeSectionvalue("section5qa1" , "qa1");
// qa 2
changeSectionvalue("section1qa2" , "qa2");
changeSectionvalue("section2qa2" , "qa2");
changeSectionvalue("section3qa2" , "qa2");
changeSectionvalue("section4qa2" , "qa2");
changeSectionvalue("section5qa2" , "qa2");