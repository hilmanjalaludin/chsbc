<script type="text/javascript">
Ext.document('document').ready(function()
{
  // Ext.Serialize('frmScoring').prop(function(items){
	// for( var component in items ) {
		//Ext.Cmp(component).setAttribute('disabled',true);
	// }	
  // });
  
  var element = Ext.Cmp('cekscore').getName();
  for( var i = 0; i<element.length; i++ ){
	element[i].disabled = true;	
  }
  
});


// get all total score per group
function getTotalAllscore () {
	var totalScor = $(".totalScore");
	var totalScoring = 0;

	totalScor.each(function () {
		var scores = $(this).html();
		if ( !isNaN(scores) && scores.length != 0 ) {
			totalScoring += parseInt(scores);
		} else {
			totalScoring += 0;
		}
	});
	// print score total 
	$(".scoretotalAll").html(totalScoring);
	
	// create persentation
	var scoreTotalss 	 = $(".scoretotalAll").html();
	var paramScoreTotal  = $(".scoreparam").html();
	if ( paramScoreTotal == 0 ) {
		var resultFromDivide = 0;
	} else {
		var resultFromDivide = 	Math.floor((scoreTotalss / paramScoreTotal) * 100);
	}
	$(".persentation").html(resultFromDivide);
	$(".finalvalue").val(resultFromDivide);
	checkCompetency(resultFromDivide);
	// end of persentations score!
}


// check between value
function checkCompetency ( values ) {
	//background:#008000;">Good (85-100)
	//background:#B2CA00;">Average (70-84)
	//background:#FF0000;">Poor (1-69)
	//background:#000000;">NA (0)
	if ( values == 0 ) {
		$(".status_score").css("background","#000000");
		$(".status_score").html("N/A");
	} else if ( (values >= 1) && (values <= 69) ) {
		$(".status_score").css("background","#FF0000");
		$(".status_score").html("POOR");
	} else if ( (values >= 70) && (values <= 84) ) {
		$(".status_score").css("background","#B2CA00");
		$(".status_score").html("AVERAGE");
	}  else if ( (values >= 85) && (values <= 100) ) {
		$(".status_score").css("background","#008000");
		$(".status_score").html("GOOD");
	}

}

		// change count Y and N
function countYorN( selectGroups , changefor , group_points ) {
	var changes = "";
	selectGroups.each(function () {
		$(this).find(".chooseagree option:selected").each(function () {
			var valueNorY = $(this).html();	
			//callaccurates
			//trickyindications
			//fraudindications
			if ( changefor == "callaccurates" ) {
				if ( valueNorY == "N" ) {
					changes += valueNorY;
					$(".callaccurates").html(changes.length);//N
				} else {
					$(".callaccurates").html(changes.length);//N
				}
			} if ( changefor == "trickyindications" ) {
				if ( valueNorY == "Y" ) {
					changes += valueNorY;
					$(".trickyindications").html(changes.length);//Y
				} else {
					$(".trickyindications").html(changes.length);//Y
				}
			} if ( changefor == "fraudindications" ) {
				if ( valueNorY == "Y" ) {
					changes += valueNorY;
					$(".fraudindications").html(changes.length);//Y
				} else {
					$(".fraudindications").html(changes.length);//Y
				}
			} if ( changefor == "underwritingproccess" ) {
				if ( valueNorY == "Y" ) {
					changes += valueNorY;
					$(".underwritingproccess").html(changes.length);//Y
				} else {
					$(".underwritingproccess").html(changes.length);//Y
				}
			} 
		});
	});
	//totalScoreAll



}
// end change count Y and N


function changeParam () {
	//scoreparam
	var totalScoreAlls = $(".totalScoreAll");
	var scoreParam     = $(".scoreparam");


	var Value_totalScoreAlls = totalScoreAlls.html();
	var Value_scoreParam     = scoreParam.html();
	if ( Value_totalScoreAlls == 0 ) {
		scoreParam.html(69);
	} else if ( Value_scoreParam > 0 ) {
		scoreParam.html(0);
	}
}

function totalQualityScore ( selectors ) {
	var totalsQuality = 0;
	jQuery.each( selectors , function ( int , value ) {
		var selectorQuality = $("."+value).html();
		if ( !isNaN(selectorQuality) && selectorQuality.length != 0  ) {
			totalsQuality += parseInt(selectorQuality);
		}
	});
	$(".totalScoreAll").html(totalsQuality);
	changeParam();
}
 
function unrequire ( selectname ) {
	$("."+selectname).change(function () {
		$(this).css({
			"border" : "1px solid #ccc" , 
			"box-shadow" : "none"
		});
	});
}

$(function () {

	// check question by qa
	$(".chooseagree").change(function () {
		var id_data = $(this).attr("id");
		var thisval = $(this).val();
		var htmlto = "resultq_"+id_data;
		$("#"+htmlto).attr("value",thisval);

		if ( thisval != "" ) {
			$(this).css({
					"border" : "1px solid #ccc" , 
					"box-shadow" : "none"
			});
		}
		var id_group = $(this).attr("id-group");
		var groupname = $(this).attr("group-name");

		// check status Y and N
		var group_point = $(this).attr("group-point");
		var totalScore = 0;
		var selectGroup = $(".grup-"+id_group);
		

		//callaccurates
		//trickyindications
		//fraudindications
		

		countYorN( selectGroup , groupname , group_point );
		totalQualityScore([ 
			"callaccurates" , 
			"trickyindications" , 
			"fraudindications" 
		]);

		//count point 
		selectGroup.each(function () {
			$(this).find(".value_scoring").each(function () {
				var check_value = $(this).val();
				if(!isNaN(check_value) && check_value.length != 0) {
			        totalScore += parseInt(check_value)*group_point;
			    }
			});	
		});
		$(".grup-"+id_group+" .totalScore").html(totalScore);

		getTotalAllscore();

	});

	var sendScoring = $(".sendScoring");
	var sendScoring = $(sendScoring);
	sendScoring.submit(function () {
		var check_value = 0;
		var require_value = $(".require_value");
		require_value.each(function () {
			var thisval = $(this).val();
			var thisid = $(this).attr("require-id");
			if ( thisval == "" ) {
				if ( thisid == undefined ) {
					$(this).css({
						"border" : "1px solid red" , 
						"box-shadow" : "0px 0px 3px red"
					});
					check_value += 1;
				} else {
					$(".require_"+thisid).css({
						"border" : "1px solid red" , 
						"box-shadow" : "0px 0px 3px red"
					});
					check_value += 1;	
				}
			} else {
				check_value += 0;
			}
		});

		if ( check_value != 0 ) {
			return false;
		} else {
			var urlSend = Ext.DOM.INDEX+"/QtyApprovalInterest/saveScoring/";
			var dataSend = $(this).serialize();
			jQuery.ajax({
				url : urlSend ,
				data : dataSend , 
				type : "POST" , 
				dataType : "text" , 
				success : function (data) {
					alert(data);
				} , 
				beforeSend : function () {
					
				} 
			});
		}
		return false;
	});

});


unrequire("statusclose");



// auto completion scoring
 
function printFinalValue () {
	$(".finalvalue").val($(".persentation").html());
}

function getDividePercentage () { // get divide from scoretotal and param total
	var scoreTotalss 	 = $(".scoretotalAll").html();
	var paramScoreTotal  = $(".scoreparam").html();
	var resultFromDivides = Math.floor((scoreTotalss / paramScoreTotal) * 100);
	if ( resultFromDivides == "Infinity" ) {
		return 0;
	} else {
		return resultFromDivides;
	}
}

function checkNaN( values ) {
	if ( !isNaN(values) && values.length != 0 ) {
		return parseInt(values);
	} else {
		return false;
	}
}

function countGroupPoint ( pointgroup ) {
	var allpoint = 0;
	var groupPoints = $(".grup-"+pointgroup);
	groupPoints.each(function () {
		var multiplicationGroupPoint = parseInt($(this).attr("group-point"));
		var groupnames = $(this).attr("group-name");

		$(this).find(".chooseagree").each(function () {
			var totalScoreAllpointPergroup = parseInt($(this).val()); 
			if ( !isNaN(totalScoreAllpointPergroup) && totalScoreAllpointPergroup.length != 0  ) {
				allpoint+=parseInt(totalScoreAllpointPergroup*multiplicationGroupPoint);
			} else {
				allpoint+=parseInt(0);
			}
		});
		$(".grup-"+pointgroup+" .totalScore").html(allpoint);
		countYorN( groupPoints , groupnames , multiplicationGroupPoint );
		totalQualityScore([ 
			"callaccurates" , 
			"trickyindications" , 
			"fraudindications"
		]);
	});
}

function countAlltotalScores () {
	var sumOfScore = 0;
	$(".totalScore").each(function (u) {
		var totalScoresAll = $(this).html();
		if ( !isNaN(totalScoresAll) && totalScoresAll.length != 0 ) {
			sumOfScore+=parseInt(totalScoresAll);
		}
		$(".scoretotalAll").html(sumOfScore);
		$(".persentation").html(getDividePercentage());
		checkCompetency(getDividePercentage());
	});
}


for ( i = 1; i < 6; i++ ) {
	countGroupPoint(i);
}

countAlltotalScores();
printFinalValue();


// end of auto completion scoring


</script>

<style>
	.panel_score {
		padding:3px;
		border:1px solid #ccc;
		border-radius:5px;
		height:auto;
		margin-bottom:10px;
	}
	.countofvalue {
		margin:10px;
		display:inline-block;
		vertical-align:top;
	}
	.countofvalue .borunder {
		border-bottom:1px solid black;
	}
	.countofvalue td {
		padding:4px;
	}
	.countofvalue .valueof {
		border-bottom:1px solid black;
	}
	.status_score {
		width:180px;
		padding:30px;
		background:#C4C4C4;
		display:inline-block;
		vertical-align:top;
		margin:10px;
		font-weight:bold;
		text-align:center;
		color:white;
		font-size:22px;
	}
	.parameter {
		color:blue;
	}
	.parameter td {
		color:white;
		border-collapse:collapse;
		border-radius:3px;
		padding:4px;
	}
	.custom-grid select {
		border:none;
	}
</style>







<div class="panel_score">
	<table class="countofvalue">
		<tbody>
			<tr>
				<td class="borunder">of Answer "N" in Call Accuracy </td>
				<td>:</td>
				<td class="valueof callaccurates"></td>
			</tr>
			<tr>
				<td class="borunder">of Answer "Y" in Tricky Indications</td>
				<td>:</td>
				<td class="valueof trickyindications"></td>
			</tr>
			<tr>
				<td class="borunder">of Answer "Y" in Fraud Indications</td>
				<td>:</td>
				<td class="valueof fraudindications"></td>
			</tr>
			<tr>
				<td></td>
				<td class="borunder"><b>Quality Score :</b></td>
				<td class="totalScoreAll"></td>
			</tr>
			<tr>
				<td class="borunder">of Answer "Y" in UW Process</td>
				<td>:</td>
				<td class="valueof underwritingproccess"></td>
			</tr>
			<tr>
				<td class="borunder"><b>Overall Score</b></td>
				<td>:</td>
				<td class="valueof borunder">
					<span style="color:red;" class="scoretotalAll">&nbsp;</span> / 
					<span class="scoreparam">69</span> 
					<span style="color:blue">( <span class="persentation"></span>% )</span> 
				</td>
			</tr>
		</tbody>
	</table>

	<div class="status_score">
		-
	</div>

	<div class="parameter">
		<table>
			<tbody>
				<tr>
					<td style="background:#8C8C8C;">Competency :</td>
					<td style="background:#008000;">Good (85-100)</td>
					<td style="background:#B2CA00;">Average (70-84)</td>
					<td style="background:#FF0000;">Poor (1-69)</td>
					<td style="background:#000000;">NA (0)</td>
				</tr>
			</tbody>
		</table>
	</div>


</div>


<div id="div_score">
<fieldset class="corner" style='border:0px solid #000;'>
		<form name="frmScoring" class="sendScoring">
	<br>
	Type of sales : 
<select 
style="display:inline-block;vertical-align:top;padding:5px;border:1px solid #ccc;border-radius:2px;" 
class="require_value statusclose" 
name="typeofsales">
			<option value=""> - </option>
			<option value="CLOSE"> Close </option>
			<option value="NON CLOSE"> Non Close </option>
	</select>
	<br><br>
			<?php  
			$agentname     =  $Policy->get_value('full_name'); // name of agent 
			$UserIdAgent   =  $Policy->get_value('UserId'); // name of agent
			$dateofselling =  $Policy->get_value('PolicySalesDate'); // date of selling 
			$productname   =  $Policy->get_value('ProductName'); // product name 
			$programname   =  $Policy->get_value('CampaignName'); // program name 
			
			$idcallhistory = $Callhistory["CallHistoryId"]; 
			$idcustomer    = $Callhistory["CustomerId"];

			$dateofcallmon = date("Y-m-d H:i:s");
			
			$idqa   = ( _have_get_session('UserId') ? _get_session('UserId') : null); //isset($_SESSION["tele2110_UserId"]) ? $_SESSION["tele2110_UserId"] : null;
			$nameqa = ( _have_get_session('Username')? _get_session('Username') : null ); //isset($_SESSION["tele2110_Username"]) ? $_SESSION["tele2110_Username"] : null;
			
			// call monitored take from id session login 
			// date of callmon take from qa checking 
			
			if ( isset($scoring) ) : 
			echo "<input type='hidden' name='id_qa' value='$idqa'>
				  <input type='hidden' name='name_qa' value='$nameqa'>
				  <input type='hidden' name='id_callhistory' value='$idcallhistory'>
				  <input type='hidden' name='id_customer' value='$idcustomer'>
				  <input type='hidden' name='id_agent' value='$UserIdAgent'>
				  <input type='hidden' name='name_agent' value='$agentname'>
				  <input type='hidden' name='date_ofcallmon' value='$dateofcallmon'>
				  <input type='hidden' name='date_ofselling' value='$dateofselling'>
				  <input type='hidden' class='finalvalue' name='sumof_finalvalue' value=''>";?>

				<?php  
				// table of content qa for check
				if ( is_object( $scoring->fetchScoring("group")) ) {
					foreach ( $scoring->fetchScoring("group")->result() as $sg ) { ?>

			<table class="custom-grid  grup-<?php echo  $sg->id_group; ?>" style='border:0px solid #dddddd;' 
				cellspacing='0' group-point="<?= $sg->gruppoint; ?>"  cellpadding='0' width='99%' align='center'> 
				<tr>
					<td class="ui-corner-top ui-state-default " style="padding:5px;" colspan="3">
						<span color="red" style="padding:2px 0px 2px 0px;border-top:0px solid #000000;"><?php echo $sg->name_group; ?> Score : <span class="totalScore"></span></td>
				</tr>

				<?php  
				// fetch all qeustion for qa check
				//var_dump($scoring->fetchScoring("check") );
				if ( $scoring->fetchScoring("check") != "error" ) :
					$no = 1;
					
				//	var_dump($scoring->fetchScoring("param" , $sg->id_group )->result());
					
					foreach ( $scoring->fetchScoring("param" , $sg->id_group )->result() as $sc ) : 
						
						if ( empty($sc->questioneng) ) : $question = $sc->questionid;
						else : $question = $sc->questioneng;
						endif;

						if ( empty($sc->questioneng) ) : $questionid = "";
						else : $questionid = "(".$sc->questionid.")";
						endif;


					?>

				<tr class="onselect">
					<td class="content-first text_caption bottom center"><?php echo $sc->id_question ?></td>

					<td  style="word-wrap:break-word;" class="content-middle text_caption bottom">
					<div  align="left" style="width:300px;"><?php echo wordwrap($question,80,"<br>"); ?><br>
						<span style="color:#919191"><?php echo wordwrap($questionid,80,"<br>"); ?></span>
					</div>
					</td>

					<td class="content-lasted bottom" align="center">
						<select 
						style="display:inline-block;vertical-align:top;padding:5px;border:1px solid #ccc;border-radius:2px;" 
						id-group="<?php echo  $sg->id_group; ?>" id="<?php echo  $sc->id_question; ?>" 
						group-point="<?php echo  $sg->gruppoint; ?>" 
						group-name="<?php echo  $sg->minnamegroup; ?>" 
						class="require_<?php echo  $sc->id_question; ?> require_value chooseagree" 
						require-id="<?php echo  $sc->id_question; ?>" 
						name="question[]">

							<option value="">-</option>	
							
						<?php  
							$values = $scoring->getValue($sc->idvalue);
							$vs = $values->row();

							if ( is_object($values) ) {
								$enumsvalue = (function_exists('convert_enum') ? convert_enum($vs->choosefor) : $vs->choosefor );
								if ( is_array( $enumsvalue ) ) {
									foreach ( $enumsvalue as $ev ) : 
										$en = explode("=",$ev);
										$nameoption = $en[0];
										$valueoption = $en[1];
										if ( $vs->setdefault == $nameoption ) {
 											$selectdefault = ' selected="selected" ';
										} else {
											$selectdefault = '';
										}
									?>
									<option <?= $selectdefault ?> value="<?php echo  $valueoption ?>"><?php echo  $nameoption ?></option>	
									<?php endforeach; ?>
						</select>
<input type="text" id="resultq_<?php echo  $sc->id_question;?>" class="input_text value_scoring" value="<?= $vs->valuedefault; ?>"
readonly="1" style="width:30px;text-align:center;" disabled="true"><br><br>

<?php 
	//echo "Ok";
	//var_dump($sc->grupquestion);
 if ( $sc->grupquestion == "6" ) : ?>

<textarea name="comment[]" class=""  style="display:inline-block;vertical-align:top;padding:5px;border:1px solid #ccc;border-radius:2px;">
</textarea>

<?php else : ?>

<select name="comment[]" class=""  style="width:120px;display:inline-block;vertical-align:top;padding:5px;border:1px solid #ccc;border-radius:2px;">
	<option value=""> - COMMENT - </option>
	<?php  
	$comment = $sc->comment;
	if ( strpos( $comment , "|" )  !== false ) {
		$comment = explode( "|" , $comment );
		foreach ( $comment as $com ) {
			if ( $com != "" ) {
				echo "<option value='$com'>$com</option>";
			}
		}
	} else {	
		echo "<option value='$comment'>$comment</option>";
	}
	
	?>
</select>

<?php endif; ?>


							<?php 
						}
							} else {
								echo "error";
							}
						?>
					</td>
				</tr>

					
				<?php endforeach; endif;
				
				?>


			</table>



			<br><br>
				<?php  } ?>

				<tr class="onselect">
					<td class=" left" colspan="3">
						
						<div width="100%" align="right" style="margin:5px 0px 5px 0px;">
							<table cellpadding="0" cellspacing="0">
								<tr>
									<td class="text_caption">&nbsp;</td>
									<td></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td class="text_caption">
<input type="submit" value=" Save" class="button save">
									</td>
									<td></td>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
									<td class="text_caption"></td>
									<td></td>
									<td>&nbsp;</td>
								</tr>
							</table>
						</div>
					</td>
				</tr>
			


				<?php } else {
					echo 2;
				}


				?>







			<?php else : ?>



			<?php endif; ?>

		</form>
	</fieldset>
</div>