<?php  


/**
 * All Report By Ahmad Wahyudin  @ Razaki Development
 * @AllReport , @param 
 */
class AllReport extends EUI_Controller {

	static $BaseFolder;
	static $BaseViewReport;
	static $BaseViewReportExcel;

	public function __construct () {
		parent::__construct();
		self::$BaseFolder = 'allreport/';
		self::$BaseViewReport = self::$BaseFolder . '/rpt_layout_report/report_';
		self::$BaseViewReportExcel = self::$BaseFolder . '/rpt_layout_excel/report_';

		$this->load->helper(array("EUI_Object","date"));

		$this->get_obj = _get_all_request();
		$this->get_obj = new EUI_Object($this->get_obj);

		$this->getreport    = $this->get_obj->get_value("get_report");
		$this->modereport = $this->get_obj->get_value("mode");		
		$this->startdate = $this->get_obj->get_value("StartDate");
		$this->enddate = $this->get_obj->get_value("EndDate");		

		// if request is found for agent 
		$this->agent = $this->get_obj->get_value("AgentId");		
		$this->spv = $this->get_obj->get_value("SpvId");		
		$this->mgr = $this->get_obj->get_value("MgrId");		
	}

	public function index () { 
		$this->load->view(self::$BaseFolder."view_javascript");	
		$this->Layout();	
	}

	public function ShowReportLayout () {
		// check for mode report
		if ( $this->modereport == "HTML" ) {
			$this->ShowReport($this->getreport , true);
		} elseif ( $this->modereport == "EXCEL"  ) {
			$this->ShowReport($this->getreport , false);
		}
	}

	/**
	 * [SetManager description]
	 * Get Data From Manager
	 */
	public function SetManager () {
		$manager = array();
		$getManager = $this->db->query(
			"SELECT * FROM tms_agent a WHERE a.profile_id='2'"
		);	
		if ( $getManager->num_rows() > 0 ) {
			foreach ( $getManager->result() as $rm  ) {
				$manager[$rm->UserId] = $rm->init_name;
			}
		} 

		//print_r($manager);
		return $manager;
	}

	/**
	 * [SetSpv description]
	 * Get Data Spv By MgrId
	 */
	public function SetSpv ( $MgrId = "" ) {
		$supervisor = array();
		$getSpv = $this->db->query(
			"SELECT * FROM tms_agent a WHERE a.profile_id='3' AND a.mgr_id='$MgrId'"
		);	
		if ( $getSpv->num_rows() > 0 ) {
			foreach ( $getSpv->result() as $rs  ) {
				$supervisor[$rs->UserId] = $rs->init_name;
			}
		} 
		return $supervisor;
	}

	/**
	 * [SetAgent description]
	 * Set Agent By Spv Id
	 */
	public function SetAgent ( $SpvId = "" ) {
		$agent = array();
		$getAgent = $this->db->query(
			"SELECT * FROM tms_agent a WHERE a.profile_id='4' AND a.spv_id='$SpvId'"
		);	
		if ( $getAgent->num_rows() > 0 ) {
			foreach ( $getAgent->result() as $ra  ) {
				$agent[$ra->UserId] = $ra->init_name;
			}
		} 
		return $agent;
	}

	function ToOption ( $data = '' ) {
		$option = "<option value=''>- choose -</option>";
		if ( is_array( $data ) ) {
			foreach ( $data as $key => $value ) {
				$option .= "<option value='$key'>$value</option>";
			}
		}
		return $option;

	}

	public function SetSelectSpv ( $MgrId = "" ) {
		echo $this->ToOption($this->SetSpv($MgrId));
	}

	public function SetSelectAgent ( $SpvId = "" ) {
		echo $this->ToOption($this->SetAgent($SpvId));
	}

	public function Layout () {
		$content_stuff = array(
			"MgrId" => $this->SetManager() , 
			"SpvId" => array() , 
			"AgentId" => array() 
		);

		$this->load->view(self::$BaseFolder."view_tabbing" , array( "contents" => $content_stuff ) );
	}

	public function ExcelHeader ( $FileNames = "" ) {
		// Header File Name
		header("Pragma: public");
	  	header("Expires: 0");
	  	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	  	header("Content-Type: application/force-download");
	  	header("Content-Type: application/octet-stream");
	  	header("Content-Type: application/download");
	  	header("Content-type: application/vnd.ms-excel; charset=utf-16");
	  	header("Content-Disposition: attachment; filename=". ($FileNames));
	  	header("Content-Transfer-Encoding: binary");
	  	header("Content-Length: " . ($FileNames));	
	}

	public function ShowReport () {
		//echo $this->modereport;
		$this->load_request = array(
			"startdate" => $this->startdate , 
			"modereport" => $this->modereport , 
			"enddate"   => $this->enddate , 
			"mgrid"		=> $this->mgr ,
			"spvid"		=> $this->spv ,
			"agentid"	=> $this->agent 
		);

		$this->load->helper('EUI_ExcelWorksheet');

		$this->dateNow = date( "Y-m-d_H:i:s" );

		if ( $this->modereport == "HTML" ) {
			switch ($this->getreport) {
				case "callactivity" :
					$this->load->view( self::$BaseViewReport . "call_activity" , $this->load_request );
				break;
				
				case "absensi" :
					$this->load->view( self::$BaseViewReport . "absensi" , $this->load_request );
				break;

				case "ecoaching" :
					$this->load->view( self::$BaseViewReport . "e_coaching" , $this->load_request );
				break;

				case "callscoring" : 
					$this->load->view( self::$BaseViewReport . "call_scoring" , $this->load_request );
				break;

				case "reportschedule" : 
					$this->load_request = array(
						"starttime_sat" => $this->get_obj->get_value("starttime_sat") , 
						"endtime_sat" => $this->get_obj->get_value("endtime_sat") , 
						"starttime_monfri" => $this->get_obj->get_value("starttime_monfri") , 
						"endtime_monfri" => $this->get_obj->get_value("endtime_monfri") , 
						"get_report" => $this->get_obj->get_value("get_report") , 
						"mode" => $this->get_obj->get_value("mode") ,
						"month" => $this->get_obj->get_value("month")
					);
					$this->load->view( self::$BaseViewReport . "schedule_agent" , $this->load_request );
				break;

				case "refferalneed" :
					$this->load->view( self::$BaseViewReport . "referral_need" , $this->load_request );
				break;

				default : 

				break;  
			} 
		}


		if ( $this->modereport == "EXCEL" ) {

			switch ($this->getreport) {
				case "callactivity" :
				
					$this->FileName = "Report_CallActivity" . $this->dateNow;
					$load_request = array_merge( $this->load_request , array("FileName" => $this->FileName) );
					$this->load->view( self::$BaseViewReportExcel . "call_activity_excel" , $load_request );
				break;
				
				case "absensi" :
				
					$this->FileName = "Report_Absensi" . $this->dateNow;
					$load_request = array_merge( $this->load_request , array("FileName" => $this->FileName) );
					$this->load->view( self::$BaseViewReportExcel . "absensi" , $load_request );
				break;

				case "ecoaching" :
					$this->FileName = "Report_ECoaching" . $this->dateNow;
					$load_request = array_merge( $this->load_request , array("FileName" => $this->FileName) );
					$this->load->view( self::$BaseViewReportExcel . "e_coaching_excel" , $load_request );
				break;

				case "callscoring" : 
					$this->FileName = "Report_CallScoring" . $this->dateNow;
					$load_request = array_merge( $this->load_request , array("FileName" => $this->FileName) );
					$this->load->view( self::$BaseViewReportExcel . "call_scoring_excel" , $load_request );
				break;

				case "reportschedule" : 
					$this->load_request = array(
						"starttime_sat" => $this->get_obj->get_value("starttime_sat") , 
						"endtime_sat" => $this->get_obj->get_value("endtime_sat") , 
						"starttime_monfri" => $this->get_obj->get_value("starttime_monfri") , 
						"endtime_monfri" => $this->get_obj->get_value("endtime_monfri") , 
						"get_report" => $this->get_obj->get_value("get_report") , 
						"mode" => $this->get_obj->get_value("mode") ,
						"month" => $this->get_obj->get_value("month")
					);

					$this->FileName = "Report_ScheduleAgent" . $this->dateNow;
					$load_request = array_merge( $this->load_request , array("FileName" => $this->FileName) );
					$this->load->view( self::$BaseViewReportExcel . "schedule_agent_excel" , $load_request );
				break;

				case "refferalneed" :
					$this->FileName = "Report_ReferralNeed" . $this->dateNow;
					$load_request = array_merge( $this->load_request , array("FileName" => $this->FileName) );
					$this->load->view( self::$BaseViewReportExcel . "referral_need_excel" , $load_request );
				break;

				default : 

				break;  
			} 

			$this->ExcelHeader($this->FileName);

		}

	}

}


?>