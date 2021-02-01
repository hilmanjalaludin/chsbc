<?php
	class M_QAQualityAssuranceReport extends EUI_Model
	{
		private static $instance = null;	

		function M_QAQualityAssuranceReport()
		{
			$this -> load ->model(array('M_Combo','M_SysUser'));
			$this -> start_date = _getDateEnglish( $this -> URI->_get_post('start_date'));
			$this -> end_date 	= _getDateEnglish( $this -> URI->_get_post('end_date'));
			$this -> spv		= _get_post('spv_id');
			$this -> tl			= _get_post('tl_id');
			$this -> tsr		= _get_post('tsr_id');
		}
		
		public static function & get_instance() 
		{
			if( is_null(self::$instance)) 
			{
				self::$instance = new self();
			}
			return self::$instance;
		}
		
		public function FilterBy()
		{
			return array
			(
				'Tsr' => 'TSR'
			);
		}
		
		public function ModeBy()
		{
			return array
			(
				'Summary' => 'Summary'
			);
		}
		
		/* Fungsi Get SPV */
		function _getSPVBaru($spvId)
		{
			// $spv = array();
			$sql = "SELECT
						a.UserId,
						a.full_name AS SPV
					FROM tms_agent a
					WHERE 1=1
						AND a.spv_id = ".$spvId."
						AND a.handling_type = 13
						AND a.UserId NOT IN (310,311,321)
					GROUP BY a.UserId";
			
			$qry = $this->db->query($sql);
			foreach( $qry->result_assoc() as $rows )
			{
				$spv[$rows['UserId']] = $rows['SPV'];
			}
			return $spv;
		}
		
		function _getAtmBaru( $param = null )
		{
			$Atm = array();
			$sql = "SELECT
						a.UserId,
						a.full_name AS ATM
					FROM tms_agent a
					WHERE 1=1
						AND a.handling_type = 3
					GROUP BY a.UserId";
			$qry = $this->db->query($sql);
			foreach( $qry->result_assoc() as $rows )
			{
				$Atm[$rows['UserId']] = $rows['ATM'];
			}
			return $Atm;
		}
		
		/* Fungsi Get SPV */
		function _getTSRBaru($spvId)
		{
			$spv = array();
			$sql = "SELECT
						a.UserId,
						a.full_name AS TSR
					FROM tms_agent a
					WHERE 1=1
						AND a.tl_id = ".$spvId."
						AND a.handling_type = 4
						AND a.user_state = 1
						AND a.UserId NOT IN (312,313,314,315,322)
					GROUP BY a.UserId";
			// echo "<pre>$sql</pre>";
			$qry = $this->db->query($sql);
			foreach( $qry->result_assoc() as $rows )
			{
				$spv[$rows['UserId']] = $rows['TSR'];
			}
			return $spv;
		}
		
		/** 
		 **	Batas
		 **/
		
		/* Fungsi Get ATM */
		function _getAtm( $param = null )
		{
			$Atm = array();
			$sql = "SELECT
						a.UserId,
						a.full_name AS ATM
					FROM tms_agent a
					WHERE 1=1
						AND a.handling_type = 3
						AND a.spv_id = ".$this -> spv."
					GROUP BY a.UserId";
			$qry = $this->db->query($sql);
			
			foreach( $qry->result_assoc() as $rows )
			{
				$Atm[$rows['UserId']]['ATM'] = $rows['ATM'];
			}
			return $Atm;
		}
		
		/* Fungsi Get SPV */
		function _getSPV( $param = null )
		{
			$spv = array();
			$sql = "SELECT
						a.UserId,
						a.full_name AS SPV
					FROM tms_agent a
					WHERE 1=1
						AND a.handling_type = 13
						AND a.tl_id = ".$this -> tl."
						AND a.UserId NOT IN (310,311,321)
					GROUP BY a.UserId";
			
			$qry = $this->db->query($sql);
			
			foreach( $qry->result_assoc() as $rows )
			{
				$spv[$rows['UserId']]['SPV'] = $rows['SPV'];
			}
			return $spv;
		}
		
		/*Fungsi Get Agent */
		function _getAgent( $param = null )
		{
			$agent = array();
			$sql = "SELECT
						a.UserId,
						a.full_name AS Agent
					FROM tms_agent a
						LEFT JOIN t_gn_customer b ON a.UserId = b.SellerId
					WHERE 1=1
						AND a.handling_type = 4
						AND a.spv_id = ".$this -> spv."
						AND a.tl_id = ".$this -> tl."
						AND a.UserId IN (".$this -> tsr.")
						AND a.user_state = 1
						AND a.UserId NOT IN (312,313,314,315,322)
					GROUP BY a.UserId";
			$qry = $this->db->query($sql);
			
			foreach( $qry->result_assoc() as $rows )
			{
				$agent[$rows['UserId']]['Agent'] = $rows['Agent'];
			}
			return $agent;
		}
		
		/* Fungsi Call Monitor, AFR */
		function _getMonitor()
		{
			$monitor = array();
			$sql = "SELECT
						d.UserId,
						COUNT(DISTINCT b.CustomerId) AS Monitor,
						SUM(IF(a.ApprovalStatus=1,1,0)) AS Approve,
						SUM(IF(a.ApprovalStatus=3,1,0)) AS Reject,
						DATEDIFF('".$this->end_date." 23:59:59','".$this->start_date." 00:00:00') AS DiffDate
					FROM t_gn_log_approval a
						LEFT JOIN t_gn_qa_approval b ON a.ApprovalId = b.ApprovalId
						LEFT JOIN t_gn_customer c ON b.CustomerId = c.CustomerId
						LEFT JOIN tms_agent d ON c.SellerId = d.UserId
					WHERE 1=1
						AND d.handling_type = 4
						AND d.spv_id = ".$this -> spv."
						AND d.tl_id = ".$this -> tl."
						AND d.UserId IN (".$this -> tsr.")
						AND a.ApprovalTs >= '".$this->start_date." 00:00:00'
						AND a.ApprovalTs <= '".$this->end_date." 23:59:59'
					GROUP BY d.UserId";
				// echo "<pre>$sql</pre>";
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				$monitor[$rows['UserId']]['Monitor'] = $rows['Monitor'];
				$monitor[$rows['UserId']]['Approve'] = $rows['Approve'];
				$monitor[$rows['UserId']]['Reject'] = $rows['Reject'];
				$monitor[$rows['UserId']]['DiffDate'] = $rows['DiffDate'];
			}
			return $monitor;
		}
		
		function _getScore()
		{
			$monitor = array();
			$sql = "SELECT
						b.SellerId,
						SUM(a.ScoringFinal) AS ScoreFinal
					FROM t_gn_qa_scoring a
						LEFT JOIN t_gn_customer b ON a.CustomerId = b.CustomerId
						LEFT JOIN tms_agent c ON b.SellerId = c.UserId
					WHERE 1=1
						AND c.handling_type = 4
						AND c.spv_id = ".$this -> spv."
						AND c.tl_id = ".$this -> tl."
						AND c.UserId IN (".$this -> tsr.")
						AND a.ScoringCreateTs >= '".$this->start_date." 00:00:00'
						AND a.ScoringCreateTs <= '".$this->end_date." 23:59:59'
					GROUP BY b.SellerId";
				// echo "<pre>$sql</pre>";
			$qry = $this->db->query($sql);
			foreach($qry->result_assoc() as $rows)
			{
				$monitor[$rows['SellerId']]['ScoreFinal'] = $rows['ScoreFinal'];
			}
			return $monitor;
		}
		
		/* Fungsi Get Approval Questoin */
		function Question()
		{
			$question = array();
				$sql = "SELECT
							b.SellerId,
							a.ApprovalPoints AS Question
						FROM t_gn_qa_approval a
						LEFT JOIN t_gn_customer b ON a.CustomerId = b.CustomerId
						LEFT JOIN tms_agent c ON b.SellerId = c.UserId
						WHERE 1=1
							AND c.handling_type = 4
							AND c.UserId IN (".$this -> tsr.")
							AND c.spv_id = ".$this -> spv."
							AND c.tl_id = ".$this -> tl."
						GROUP BY b.SellerId";
				$qry = $this->db->query($sql);
				if($qry->num_rows() > 0)
				{
					foreach($qry->result_assoc() as $rows)
					{
						$question[$rows['SellerId']] = $rows;
					}
				}
		}
		
		function getSummaryApprove()
		{
			$datas = array();
			$sql = "SELECT
						b.CustomerId,
						c.SellerId,
						a.ScoringQuestionId AS ID,
						a.ScoringQuestionValue AS Question
					FROM t_gn_scoring_point a
						LEFT JOIN t_gn_qa_scoring b ON a.ScoringId = b.Id
						LEFT JOIN t_gn_customer c ON b.CustomerId = c.CustomerId
						LEFT JOIN tms_agent d ON c.SellerId = d.UserId
					WHERE 1=1
						AND a.ScoringCategoryId = 5
						AND d.handling_type = 4
						AND d.UserId IN (".$this -> tsr.")
						AND d.spv_id = ".$this -> spv."
						AND d.tl_id = ".$this -> tl."";
				// echo "<pre>$sql</pre>";
			$qry = $this->db->query($sql);
			
			if($qry->num_rows() > 0)
			{
				foreach($qry->result_assoc() as $rows)
				{
					$question = explode(',',$rows['ID']);
					$answer = explode(',',$rows['Question']);
					
					foreach($question as $key => $id)
					{
						// echo $answer[$key];
						$datas[$rows['SellerId']][$rows['CustomerId']][$id] = ($answer[$key]?$answer[$key]:0);
					}
				}
			}
			
			return $datas;
		}
	}
?>