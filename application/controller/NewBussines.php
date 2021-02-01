<?php
class NewBussines extends EUI_Controller
{
	var $_dir = '/temp/';
	var $_type = array();
	
	var $_head_id = 0;
	
	var $_total_policy 	 = 0;
	var $_total_insured  = 0;
	var $_total_benef 	 = 0;
	var $_total_question = 0;
	

	public function Layout () {
		$this->load->view('view_new_bussiness/extract_data');
	}
	
	public function replaceWhiteSpace ( $string = "" ) {
		$string = preg_replace('/\s\s+/', ' ', $string);
		return $string;
	}

	public function Extract( $startdate = "" )
	{
		$this->startdate = $startdate;

		$this->load->model(array(
			'M_NewBussines'
		));
		
		$this->_type = array(
			'Policy' => 'getPolicy',
			'Insured' => 'getInsured',
			'Beneficiary' => 'getBeneficiery',
			'Questionnaire' => 'getQuestion',
		);

		$this->GetAllDataByText( $this->startdate );
	}

	/* REAL */
	
	public function GetAllDataByText  ( $dates_extract = '' )
	{
		// echo "string";
		//die();

		$_content = null;
		
		$_bak_mandi = array(
			't_gn_extract_policy' 	=> array(),
			't_gn_extract_insured' 	=> array(),
			't_gn_extract_benef' 	=> array(),
			't_gn_extract_question' => array(),
		);
		
		$directory = 'temp/';
		$filename = 'New_Bussines_'.date('Y-m-d__H:i:s').'_'. $this->M_NewBussines->getCountByDate($dates_extract) .'_'.$dates_extract.'.txt';
		
		$this->db->insert('t_gn_extract_header',array(
			'filename' => FCPATH.$directory.$filename,
			'extract_by' => _get_session('UserId')
		));
		
		if($this->db->affected_rows()>0)
		{
			$this->_head_id = $this->db->insert_id();
		}
		
		$_policy 		= $this->M_NewBussines->getPolicy( $dates_extract );
		$_insured 		= $this->M_NewBussines->getInsured( $dates_extract );
		$_benef 		= $this->M_NewBussines->getBeneficiery( $dates_extract );
		$_pertanyaan 	= $this->M_NewBussines->getQuestion( $dates_extract );
		
		/* ------------------------------------------------------------------------------------------------------ */
		
		/* POLICY */
		
		$_content .= "[Policy]\r\n";
		$_content .= implode("\t",$_policy->list_fields())."\r\n";
		if($_policy->num_rows()>0)
		{
			
			foreach($_policy->result_assoc() as $rows)
			{
				$_gayung = array();
				
				foreach($rows as $key=>$value)
				{
					$_gayung[$key] = str_replace("\"","",str_replace("\r\n"," ",trim($this->replaceWhiteSpace($value))));
				}
				
				$this->db->update('t_gn_policyautogen',array(
					'FlagExport' => 1
				),array(
					'PolicyNumber' => $rows['policy_id']
				));
				
				$_content .= implode("\t",$_gayung)."\r\n";
				
				$rows['header_id'] = $this->_head_id;
				$_bak_mandi['t_gn_extract_policy'][$this->_total_policy] = $rows;
				$this->_total_policy +=1;
			}
		}
		// $_content .= "\r\n";
		
		/* END OF POLICY */
		
		/* ------------------------------------------------------------------------------------------------------ */
		
		/* INSURED */
		
		$_content .= "[Insured]\r\n";
		$_content .= implode("\t",$_insured->list_fields())."\r\n";
		if($_insured->num_rows()>0)
		{
			foreach($_insured->result_assoc() as $rows)
			{
				$_gayung = array();

				foreach($rows as $key=>$value)
				{
					$_gayung[$key] = str_replace("\"","",str_replace("\r\n"," ",trim($this->replaceWhiteSpace($value))));
				}
				
				$_content .= implode("\t",$_gayung)."\r\n";
				
				$rows['header_id'] = $this->_head_id;
				$_bak_mandi['t_gn_extract_insured'][$this->_total_insured] = $rows;
				$this->_total_insured +=1;
			}
			
			
		}
		// $_content .= "\r\n";
		
		/* END OF INSURED */
		
		/* ------------------------------------------------------------------------------------------------------ */
		
		/* BENEFICIERY */
		
		$_content .= "[Beneficiary]\r\n";
		$_content .= implode("\t",$_benef->list_fields())."\r\n";
		if($_benef->num_rows()>0)
		{
			foreach($_benef->result_assoc() as $rows)
			{
				$_gayung = array();

				foreach($rows as $key=>$value)
				{
					$_gayung[$key] = str_replace("\"","",str_replace("\r\n"," ",trim($this->replaceWhiteSpace($value))));
				}
				
				$_content .= implode("\t",$_gayung)."\r\n";
				
				$rows['header_id'] = $this->_head_id;
				$_bak_mandi['t_gn_extract_benef'][$this->_total_benef] = $rows;
				$this->_total_benef +=1;
			}
		}
		// $_content .= "\r\n";
		
		/* END OF BENEFICIERY */
		
		/* ------------------------------------------------------------------------------------------------------ */
		
		/* UNDERWRITING */
		
		$_content .= "[Questionnaire]\r\n";
		$_content .= implode("\t",$_pertanyaan->list_fields())."\r\n";
		if($_pertanyaan->num_rows()>0)
		{
			foreach($_pertanyaan->result_assoc() as $rows)
			{
				$_gayung = array();

				foreach($rows as $key=>$value)
				{
					$_gayung[$key] = str_replace("\"","",str_replace("\r\n"," ",trim($this->replaceWhiteSpace($value))));
				}
				
				$_content .= implode("\t",$_gayung)."\r\n";
				
				$rows['header_id'] = $this->_head_id;
				$_bak_mandi['t_gn_extract_question'][$this->_total_question] = $rows;
				$this->_total_question +=1;
			}
		}
		
		$this->db->update('t_gn_extract_header',array(
			'total_row_policy' 	 => $this->_total_policy,
			'total_row_insured'  => $this->_total_insured,
			'total_row_benef' 	 => $this->_total_benef,
			'total_row_question' => $this->_total_question,
		),array(
			'id' => $this->_head_id
		));
		
		if($this->db->affected_rows()>0)
		{
			foreach($_bak_mandi as $table => $data)
			{
				foreach($data as $idx => $rows){
					$this->db->insert($table,$rows);
				}
			}
		}
		
		// exit(0);
		
		/* END OF UNDERWRITING */
		
		$fp = fopen(FCPATH.$directory.$filename,'wb');

		//if($fp)
		//{
		fputs($fp,$_content);
			//fclose($fp);
		//}
		

		$openfiles = fopen( FCPATH.$directory.$filename,'r' );


		// Convert To Text File
	    header('Content-Type: application/octet-stream');
	    header('Content-Disposition: attachment; filename='.basename($filename));
	    header('Expires: 0');
	    header('Cache-Control: must-revalidate');
	    header('Pragma: public');
	    header('Content-Length: ' . filesize($filename));
	    readfile(FCPATH.$directory.$filename);
	    exit;

	}
	

}
?>