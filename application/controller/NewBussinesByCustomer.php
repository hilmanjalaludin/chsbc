<?php
class NewBussinesByCustomer extends EUI_Controller
{
	var $_dir = '/temp/';
	var $_type = array();
	

	public function Layout () {
		$this->load->view('view_new_bussiness/extract_data');
	}

	public function Extract( $startdate = "" )
	{
		$this->startdate = $startdate;

		$this->load->model(array(
			'M_ByCustomerNewBussines'
		));
		
		$this->_type = array(
			'Policy' => 'getPolicy',
			'Insured' => 'getInsured',
			'Beneficiary' => 'getBeneficiery',
			'Questionnaire' => 'getQuestion',
		);

		$this->paramspull = "
			'MCBM0000000039N',
			'MCBM0000000040N',
			'MCBM0000000044N',
			'MCBM0000000061N',
			'MCBM0000000067N',
			'MCBM0000000072N',
			'MCBM0000000087N',
			'MCBM0000000102N',
			'MCBM0000000143N',
			'MCBM0000000149N',
			'MCBM0000000153N',
			'MCBM0000000157N',
			'MCBM0000000202N',
			'MCBM0000000228N',
			'MCBM0000000240N'
		";

		$this->GetAllDataByText($this->paramspull);	

		//$checkQuery = $this->M_ByCustomerNewBussines->getQuestion( $this->paramspull );
		//echo $checkQuery;
		


		//return false;

		/*
		if ($checkQuery->num_rows > 0){
			foreach ( $checkQuery->result() as $s ) {
				echo $s->policy_id;
			}

		} else {
			echo 'Data not found!';
		}
		*/

	}

	/* REAL */
	
	public function GetAllDataByText  ( $dates_extract = '' )
	{
		//echo "string";
		//die();

		$_content = null;
		
		$_policy 		= $this->M_ByCustomerNewBussines->getPolicy( $dates_extract );
		$_insured 		= $this->M_ByCustomerNewBussines->getInsured( $dates_extract );
		$_benef 		= $this->M_ByCustomerNewBussines->getBeneficiery( $dates_extract );
		$_pertanyaan 	= $this->M_ByCustomerNewBussines->getQuestion( $dates_extract );
		
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
					$_gayung[$key] = str_replace("\"","",str_replace("\r\n"," ",trim($value)));
				}
				
				$_content .= implode("\t",$_gayung)."\r\n";
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
					$_gayung[$key] = str_replace("\"","",str_replace("\r\n"," ",trim($value)));
				}
				
				$_content .= implode("\t",$_gayung)."\r\n";
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
					$_gayung[$key] = str_replace("\"","",str_replace("\r\n"," ",trim($value)));
				}
				
				$_content .= implode("\t",$_gayung)."\r\n";
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
					$_gayung[$key] = str_replace("\"","",str_replace("\r\n"," ",trim($value)));
				}
				
				$_content .= implode("\t",$_gayung)."\r\n";
			}
		}
		
		/* END OF UNDERWRITING */
		
		$directory = '/temp/';
		$filename = 'New_Bussines_'.date('Y-m-d__H:i:s').'.txt';
		
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