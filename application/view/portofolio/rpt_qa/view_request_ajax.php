<?php  
// request get All Qa

if ( $requesttype == "getAllQa" ) {
	if ( is_array( $resultQa ) ) {
		echo "<tr><td class=' text_caption'>QA</td>
		<td><select class='selectQa select superlong' name='idQa'><option value=''> --choose qa-- </option>";
		foreach ( $resultQa as $rq ) {
			echo "<option value='".$rq->UserId."'>".$rq->full_name."</option>";
		}
		echo "<option value='ALL'>All QA</option></select></td></tr>";
	} else {

	}
} 


// end request qa



?>