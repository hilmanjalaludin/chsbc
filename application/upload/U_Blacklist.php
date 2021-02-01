<?php
ini_set('max_execution_time', 0);
ini_set('max_execution_time', '0');
ini_set('memory_limit', '-1');
set_time_limit(0);

class U_Blacklist extends EUI_Upload
{
	private static $Instance = null;
	
	var $arr_row_callback = array(
		'tot_xls_vl_row' => 0,
		'tot_xls_ok_row' => 0,
		'tot_xls_fl_row' => 0,
		'tot_xls_du_row' => 0,
		'tot_xls_fc_row' => 0
	);
  
	function U_Blacklist()
	{
		
	}
	
	public static function &Instance()
	{
		if(is_null(self::$Instance) )
		{
			self::$Instance = new self();
		}	
		return self::$Instance;
	}
	
	function index()
	{
		echo 'ASU';
	}
	
	function import_row_promo_excel( $out )
	{
		$objXls =& ExcelImport();
		$file_destination = join("/", array(APPPATH.'temp',$out->get_value('name')));
		$file_original = $out->get_value('tmp_name');
		
		if( !move_uploaded_file($file_original, $file_destination ) ){
			return false;
		}
		else{
			$this->db->reset_write();
			$this->db->set('UploadFileName',$out->get_value('name'));
			$this->db->set('UploadTemporaryLocation',$file_destination);
			$this->db->set('UploadByUserId',_get_session('UserId'));
			$this->db->set('UploadDateTs',date('Y-m-d H:i:s'));
			
			$this->db->insert("t_gn_uploadreport");
			
			if( $this->db->affected_rows()>0 ){
				$UploadID = $this->db->insert_id();
			} else {
				return false;
			}
		}
		
		if( file_exists($file_destination) )
		{
			$ar_contact_value = array(); 
			$ar_caller_value = array(); 
			
			$objXls->_ReadData($file_destination);
			$xls_row_count = $objXls->rowcount(0);
			$xls_row_val = 2;
			$arr_row_val = 0;
			while( $xls_row_val<= $xls_row_count ) 
			{
				if( (strlen($objXls->val( $xls_row_val,1)) > 0) && (strlen($objXls->val( $xls_row_val,2)) > 0) ) 
				{
					$ar_contact_value[$arr_row_val]['CIF'] = strtoupper($objXls->val( $xls_row_val, 1));
					$ar_contact_value[$arr_row_val]['Customer_Name'] = strtoupper($objXls->val( $xls_row_val, 2));
					$ar_contact_value[$arr_row_val]['Upload_DateTs'] = date('Y-m-d H:i:s');
					$ar_contact_value[$arr_row_val]['Upload_ById'] = _get_session('UserId');
					$ar_contact_value[$arr_row_val]['Upload_Id'] = $UploadID;
										
					$arr_row_val++;
				} else {
					$xls_fc_val++;
				}
				
				$xls_row_val++;
			}
			
			
		//--------- if count lebih dari satu --------------------------
			$xls_ok_val = 0;
			$xls_fl_val = 0;
			$xls_du_val = 0;
			
			if( count($ar_contact_value)> 0 ) 
				foreach( $ar_contact_value as $num => $rows  ) 
			{
				$this->db->reset_write();
				$row =& new EUI_Object( $rows );
				foreach( $rows as $field => $value  ){
					$this->db->set($field,$row->get_value( $field ));
				}
				
				$this->db->insert("t_lk_blacklist");
				
				if( $this->db->affected_rows()>0 ){
					$xls_ok_val++;
				} else {
					$xls_fl_val++;
				}
			}
			
			$this->db->update('t_gn_uploadreport',array(
				'TotalDataRows'		=> $arr_row_val,
				'TotalSuccessRows'	=> $xls_ok_val,
				'TotalFailedRows'	=> $xls_fl_val,
			),array(
				'UploadId'=>$UploadID
			));
			
			// ------------------- array -------------
			$this->arr_row_callback = array(
				'tot_xls_vl_row' => $arr_row_val,
				'tot_xls_ok_row' => $xls_ok_val,
				'tot_xls_fl_row' => $xls_fl_val,
				'tot_xls_du_row' => $xls_du_val,
				'tot_xls_fc_row' => $xls_fc_val
			);
		}
	}
	
	public function _select_row_xls_call_back()
	{
		if( is_array($this->arr_row_callback) ){
			return $this->arr_row_callback;	
		} else {
			return FALSE;
		}
	}
}
?>