<?php
	$this->load->view('call_tracking/view_call_tracking_style');
	
	function dateAsal($dates){
		$newdate = $dates;
		if(strpos($dates,"/")!==false){
			$olddate = explode("/",$dates);
			$newdate = $olddate[2]."-".$olddate[0]."-".$olddate[1];
		}
		return $newdate;
	}
?>
<title>Call Tracking Summary per Recsource</title>
Call Tracking Summary by Recsource Periode of <?php echo dateAsal($param['start_date']); ?> to <?php echo dateAsal($param['end_date']); ?> <br>
Printed By: <?=_get_session('Username')?> <br>
Print Date: <?=date('m/d/Y H:i:s')?><p></p>
