<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportQa extends EUI_Controller {


	/**
	 * View Folder rpt_qa
	 * - view_daily_summary
	 * - view_report_perqa
	 * - view_suspend_duration
	 * - view_param_report
	 * - view_javascript_report
	 *
	 * Model 
	 * - M_ReportQa
	 * 
	 */

	public function __construct() {
		parent::__construct();
		 $this->load->helper(array('EUI_Object'));
		$this->load->model("M_ReportQa");
		$this->paramtime = array(
			"07:00:00" => "09:00:00" ,
			"09:00:00" => "11:00:00" , 
			"11:00:00" => "14:00:00", 
			"14:00:00" => "16:00:00", 
			"16:00:00" => "18:00:00", 
			"18:00:00" => "20:00:00"
		);
	}
	
	

	public function dateFormats ( $date = "" ) {
		if ( strlen($date) > 3 ) {
			$date = explode("-", $date);
			$date = $date[2]."-".$date[1]."-".$date[0];			
		} else {
			$date = $date;
		}
		return $date;
	}

	public function index()
	{
		$this->datenow = date("d-m-Y");

		$this->load->view("rpt_qa/view_performance_report");
		$this->load->view("rpt_qa/view_javascript_report");
	}

	public function getAllQa () {
		$getAllQa = $this->M_ReportQa->getAllQa();
		if ( $getAllQa != false ) {
			$data["requesttype"] = "getAllQa";
			$data["resultQa"] = $getAllQa->result();
			$this->load->view("rpt_qa/view_request_ajax" , $data );
		}
	}

	public function SuspendDuration ( $status = "" , $startdate = "" , $enddate = "" ) {
		

		$data = array( "status" => $status , 
			"startdate" => $startdate , 
			"enddate" => $enddate );

		$this->load->view("rpt_qa/view_suspend_duration",$data);
	}

	public function DailySummary ( $status = "" , $startdate = "" , $enddate = "" ) {
		

		$data = array( "status" => $status , 
			"startdate" => $startdate , 
			"enddate" => $enddate );
		$this->load->view("rpt_qa/view_daily_summary",$data);
	}

	public function ReportperQa ( $status = "" , $startdate = "" , $enddate = "" , $idQa = "" ) {
		

		$data = array( 
			"status" => $status , 
			"startdate" => $startdate , 
			"idQa" => $idQa , 
			"enddate" => $enddate );
		$this->load->view("rpt_qa/view_report_perqa",$data);
	}

	public function ReportCallMonperMon ( $status = "" , $startdate = "" , $enddate = "" ) {
		

		$data = array( "status" => $status , 
			"startdate" => $startdate , 
			"enddate" => $enddate );
		$this->load->view("rpt_qa/view_production_callmon",$data);
	}

	public function ReportYtd ( $status = "" , $startdate = "" , $enddate = "" ) {
		

		$data = array( "status" => $status , 
			"startdate" => $startdate , 
			"enddate" => $enddate );
		$this->load->view("rpt_qa/view_report_ytd",$data);
	}

	public function ReportDailyQa ( $status = "" , $reportby = "" , $startdate = "" , $enddate = "" , $agent = "" ) {

		

		$data = array( 
			"status" 			=>  $status , 
			"reportby"			=>  $reportby , 
			"startdate" 		=>  $startdate , 
			"enddate"		    =>  $enddate ,
			"agent"				=>  isset($_GET["agent"]) ? $_GET["agent"] : null 
		);
		$this->load->view("rpt_qa/view_report_dailyqa",$data);
	}

	public function ReportDetailSummaryQa ( $status = "" , $startdate = "" , $enddate = "" ) {

		

		$data = array( "status" => $status , 
			"startdate" => $startdate , 
			"enddate" => $enddate );
		$this->load->view("rpt_qa/view_report_detaildailyqa",$data);
	}

	public function ReportDetailSummaryQaPerTmr ( $status = "" , $startdate = "" , $userid = "" ) {
		
		$data = array( "status" => $status , 
			"startdate" => $startdate , 
			"enddate" => $enddate , 
			"userid" => $userid );
		$this->load->view("rpt_qa/view_report_detaildailyqa",$data);
	}

	public function ActivityQa ( $status = "" , $startdate = "" , $enddate = "" ) {

		

		$data = array( "status" => $status , 
			"startdate" => $startdate , 
			"enddate" => $enddate );
		$this->load->view("rpt_qa/view_activity_qa",$data);
	}
	
	public function CallMon ( $status = "" , $startdate = "" , $enddate = "" ) {
		

		$data = array( "status" => $status , 
			"startdate" => $startdate , 
			"enddate" => $enddate );
		$this->load->view("rpt_qa/view_callmon",$data);
	}

	public function RealTimeUpdate ( $status = "" , $startdate = "" , $enddate = "" ) {
		

		if ( $status == "getrealtimeupdate" ) {
			if ( $startdate == "productiontmupdate" ) {
				
			} else {

			}
		} else {
			$data = array( "status" => $status , 
				"startdate" => $startdate , 
				"enddate" => $enddate );
			$this->load->view("rpt_qa/view_activity_realtimedashboard",$data);	
		}
	}

	public function CheckDateTime ( $time = "" ) {
		$convertotime = strtotime($time , "H:i:s");
		if ( $convertotime == "" ) {

		} else {

		}
	}


}

/* End of file ReportQa.php */
/* Location: ./application/controller/ReportQa.php */