<?php
ini_set('max_execution_time', 0);
ini_set('max_execution_time', '0');
ini_set('memory_limit', '-1');
set_time_limit(0);

/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
class U_Suplement extends EUI_Upload
{
	 	/**
	  	* @param  [type] $CustomerId [description]
	  	* @return [type]             [description]
	  	*/	
		var $_upload_table_name = null;
		var $_upload_table_data = null;
		var $_tots_rowselect 	= 0;
		var $_tots_success 		= 0;
		var $_tots_failed 		= 0;
		var $_tots_duplicate 	= 0;
		var $_tots_expired	  	= 0;
		var $_tots_blacklist 	= 0;
	
	 	/**
	 	 * @param  [type] $CustomerId [description]
	  	* @return [type]             [description]
	  	*/
		private $_field_additional = array(); 
		private $_field_uploadId = 0;
		private $_is_complete = FALSE;
		private $_campaignId = 0;
		private $_recsource = 0;
		private $_recsource_ftp = "";
		private $_uploadid_ftp 	= "";
		protected $_class_tools = null;
		private static $Instance = null; 

		private $_campaignName = NULL;
		
	/**
	 * Parse out the attributes
	 *
	 * Some of the functions use this
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
 	function U_Suplement()
	{
  		$this->_get_campaignId();
  		$this->load->model(array('M_SysUser','M_Tools','M_MgtBlacklist'));
  		$this->load->helpers("EUI_Object");
  
  		if(is_null( $this->_class_tools)) {
			$this->_class_tools =& Singgleton('M_Tools');
  		}
	}
	
	/**
	 * Parse out the attributes
	 *
	 * Some of the functions use this
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	string
	 */	
 	public static function &Instance() {
		if( is_null(self::$Instance) )  {
			self::$Instance = new self();
		}
		return self::$Instance;
	}
			
	/**
	 * Parse out the attributes
	 *
	 * Some of the functions use this
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
 	private function _reset_class_run( $ar_reset_items )  
	{
		foreach ( $ar_reset_items as $items => $items_default ) {
			if(trim($items) ) {
				$this->$items = $items_default;
			}
		}
	} 

	/**
	 * Parse out the attributes
	 *
	 * Some of the functions use this
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
 	protected function _reset_class_argvs() 
	{
  		$ar_items_reset = array(
			'_tots_rowselect' 	 => 0,
			'_tots_success'		 => 0,
			'_tots_failed'		 => 0,
			'_campaignId'		 => 0,
			'_field_uploadId'	 => 0,
			'_tots_duplicate'	 => 0,
			'_is_complete'		 => FALSE,
			'_class_tools'		 => NULL, 
			'_upload_table_name' => NULL,
			'_upload_table_data' => NULL,
			'_field_additional'  => array() );
	  	$this->_reset_class_run( $ar_items_reset );
	}

	/**
	 * Parse out the attributes
	 *
	 * Some of the functions use this
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
  	public function _get_class_callback() 
	{
  		$ar_items_back = array (
			 'TOTAL_UPLOAD' 	=> $this->_tots_rowselect,
			 'TOTAL_SUCCES' 	=> $this->_tots_success,
			 'TOTAL_FAILED' 	=> $this->_tots_failed,
			 'TOTAL_DUPLICATE' 	=> $this->_tots_duplicate, 
			 'TOTAL_EXPIRED'	=> $this->_tots_expired,
			 'TOTAL_BLACKLIST'  => $this->_tots_blacklist
	 	);
	  	return (object)$ar_items_back;
	}
	 
	/**
	 * Parse out the attributes
	 *
	 * Some of the functions use this
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	string
	 */	 
	public function _set_additional( $field = null, $values=null  )  {
		if( !is_null($field) ) {
			$this->_field_additional[$field] = $values;
		}	
	}

	/**
	 * Parse out the attributes
	 *
	 * Some of the functions use this
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	string
	 */	
	public function _get_campaignId() 
	{
		if( $this->URI->_get_have_post('CampaignId')) 
		{
			$this->_campaignId = $this->URI->_get_post('CampaignId');
		}	
		
		return $this->_campaignId;
	}
	
	/**
	 * Parse out the attributes
	 *
	 * Some of the functions use this
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	string
	 */	
	public function _set_campaignId( $CampaignId = null ) 
	{
		if( !is_null( $CampaignId ) ){
			$this->_campaignId = $CampaignId;
		}

		if( !is_null( $CampaignId ))
		{
			$this->_campaignId =(int)_get_post('CampaignId');
		}
		
		return $this->_campaignId;
	}

	/**
	 * Parse out the attributes
	 *
	 * Some of the functions use this
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	string
	 */	
	public function _get_recsource() 
	{
		if( $this->URI->_get_have_post('recsource')) 
		{
			$this->_recsource = $this->URI->_get_post('recsource');
		}	
		
		return $this->_recsource;
	}
	
	/**
	 * Parse out the attributes
	 *
	 * Some of the functions use this
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	string
	 */	
	public function _set_recsource( $recsource = null ) 
	{
		if( !is_null( $recsource ) ){
			$this->_recsource = $recsource;
		}

		if( !is_null( $recsource ))
		{
			$this->_recsource = _get_post('recsource');
		}
		return $this->_recsource;
	}

	/**
	 * Parse out the attributes
	 *
	 * Some of the functions use this
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	string
	 */	
	public function _set_uploadId( $_set_uploadId = 0 ) 
	{
		if( $_set_uploadId ) 
		{
			$this->_field_uploadId= $_set_uploadId;
		}	
	}
	
	/**
	 * Parse out the attributes
	 *
	 * Some of the functions use this
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	string
	 */	
  	public function _get_iswrite_bucket()
 	{ 
	 	$arr_template = array();
	 	$sql = sprintf("select * from t_gn_template a where a.TemplateTableName = '%s'", 
					$this->_upload_table_name );
	 	$qry = $this->db->query( $sql );
	 	if( $qry && $qry->num_rows() ) {
		 	$arr_template = $qry->result_first_assoc();
	 	}
	 
	 	// validate on object data .
	 	$rd = call_user_func('Objective',$arr_template);
	 	if( $rd->find_value('TemplateBucket') && !strcmp( $rd->field('TemplateBucket'), 'Y') ) {
			return true;
		}
		return false;
 	}
	
	/**
	 * Parse out the attributes
	 *
	 * Some of the functions use this
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
	public function _set_table( $table = null ) {
		if( !is_null( $table ) )  {
		 	$this->_upload_table_name = $table;
	  	}
	}
	 	
	/**
	 * Parse out the attributes
	 *
	 * Some of the functions use this
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	string
	 */		
	public function _get_is_complete()
	{
	  return $this->_is_complete;
	}
	
	/**
	 * Parse out the attributes
	 *
	 * Some of the functions use this
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	string
	 */	
 	function _set_write_filter( $streams = null, $CustomerId = 0 )
 	{
		// exit if condition not match data on rows section .
   		if( !is_array( $streams ) OR !$CustomerId ){
		 	return false;
   		}
		// set an object data process 
		$this->stm = null;
		$this->stm = Objective( $streams );
		$this->stm->add('CustomerId', $CustomerId);
		$this->stm->add('upload_date', date('Y-m-d H:i:s')); 
	
		// 	insert data from here .
		$this->db->reset_write();
		$this->db->set('prod_cust_id', $this->stm->field('CustomerId') );
		$this->db->set('prod_card_type', $this->stm->field('cardtype'));
		$this->db->set('prod_cust_area', $this->stm->field('AREA2'));
		$this->db->set('prod_cust_npwp', $this->stm->field('NEED_NPWP_PIL'));
		$this->db->set('prod_cust_occupation', $this->stm->field('Occupation'));
		$this->db->set('prod_cust_dormant', $this->stm->field('flag_dormant'));
		$this->db->set('prod_cust_available', $this->stm->field('flag_available'));
		$this->db->set('prod_cust_created', $this->stm->field('upload_date'));
		$this->db->insert('t_gn_filter_product');
		return true;
 	}
 
	/**
	 * Parse out the attributes
	 *
	 * Some of the functions use this
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	string
	 */	
	private function _set_write_bucket()
	{
		// cek bucket kontext .
		if( is_array($this->_upload_table_data)) 
		{

			// @ pack : reset array -----------------------
			// $stdClass = $this->_get_ProjectId();
			$array_assoc = array(
				'cardno'	 => 'Cardno',
				'custno1'	 => 'Custno',
				'name' 		 => 'CustomerFirstName',
				'dob' 		 => 'CustomerDOB',
				'phone1' 	 => 'CustomerHomePhoneNum',
				'phone2' 	 => 'CustomerWorkPhoneNum',
				'mobile' 	 => 'CustomerMobilePhoneNum',
				'addr1' 	 => 'CustomerAddressLine1',
				'addr2' 	 => 'CustomerAddressLine2',
				'addr3' 	 => 'CustomerAddressLine3',
				'addr4' 	 => 'CustomerAddressLine4',
				'zip' 		 => 'CustomerZipCode',
				'sex' 		 => 'GenderId',
				'occupation' => 'Job_Title',
				'expire_dt'  => 'expired_date',
			);
			
			$error = null;
			foreach( $this->_upload_table_data as $n => $values )
			{
				$_array_select = null;
				foreach( $values as $field => $value )
				{ 
					if( in_array(strtolower($field), array_keys($array_assoc) ) )  {
						$debug[] = $array_assoc[strtolower($field)] ."=".$this->_class_tools->setCallEvent($array_assoc[strtolower($field)],$value);
						$this->db->set($array_assoc[strtolower($field)], $this->_class_tools->setCallEvent($array_assoc[strtolower($field)],$value) );
					}
				}
				#var_dump( $debug ); die();
				
				// _gen_custno
				$this->_recsource = @$values['Recsource'];
				$this->db->set('Recsource', $values['Recsource']);
				$this->db->set('CampaignId', $this->_campaignId);
				$this->db->set('CustomerUploadedTs', date('Y-m-d H:i:s'));
				$this->db->set('FTP_UploadId', $this->_field_uploadId);
				
				// insert here additional 
				$db_is = $this->db->insert("t_gn_bucket_customers", $_array_select);
				
				if( !$db_is )
				{
					$error[] = mysql_error();
				}
					
			}
			// catch its ==============================> 
			
			if(!is_null($error)){
				print_r($error);
			}
			
		}
	} 
	
	/**
	 * Parse out the attributes
	 *
	 * Some of the functions use this
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	string
	 */	
  	public function _set_content( $ar_items_source = null )
	{
		if( !is_null($ar_items_source) && is_array($ar_items_source) )
		{
			$this->_upload_table_data = $ar_items_source;
			$this->_tots_rowselect = count($ar_items_source);
			$this->_is_complete  = TRUE;
		}
	}
	
	/**
	 * Parse out the attributes
	 *
	 * Some of the functions use this
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	string
	 */	
	protected function _set_assignment( $DebiturId = 0 , $AgentCode=null )
	{
		$conds  = FALSE;
	  	$UserId =&_get_session('UserId');
	  
	  	if( $DebiturId && _have_get_session('UserId') ) 
	  	{
			$this->db->set('CustomerId',$DebiturId);
			$this->db->set('AssignDate', date('Y-m-d H:i:s'));
		
			switch( _get_session('HandlingType') )
			{
				case USER_ROOT :
					$this->db->set('AssignAdmin',$UserId);
				break;
				
				case USER_ADMIN :
					$this->db->set('AssignAdmin',$UserId);
				break;
				
				case USER_MANAGER :
					$this->db->set('AssignAdmin',1);
					$this->db->set('AssignMgr',$UserId);
				break;
			}
		
			$this->db->insert('t_gn_assignment');
			// var_dump( $this->db->last_query() ); die();
			if( $this->db->affected_rows() > 0 )
			{
			  	$AssignId = $this->db->insert_id();	
			  	$this->db->set('deb_id',$DebiturId);
			  	$this->db->set('assign_id',$AssignId);
			  	$this->db->set('assign_status','DIS');
			  	$this->db->set('assign_type','ASSIGN.UPLOAD');
			  	$this->db->set('assign_log_created_ts', date('Y-m-d H:i:s'));
			  	$this->db->insert('t_gn_assignment_log');
		  		if( $this->db->affected_rows() > 0 ) {
					$conds++;
		  		}
			}
	  	}
		return (bool)$conds;
	}
	
	/**
	 * Parse out the attributes
	 *
	 * Some of the functions use this
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
	protected function _set_loan_tiering($loan_tiering = array(), $_cust_id = 0){
		$_set_loan_tiering = array();
		$cardno = 0;
		foreach($loan_tiering as $key => $val){
			if(strtolower($key)=='cardno'){
				$cardno = $val;
			}else if(strtolower($key)!='cardno'){
				$tenor = explode("_",$key);
				if(end($tenor)==12){
					$_set_loan_tiering[$_cust_id][12]['cardno'] = $cardno;
					$_set_loan_tiering[$_cust_id][12][$tenor[0]] = str_replace(array(","),".",$val);
				}else if(end($tenor)==24){
					$_set_loan_tiering[$_cust_id][24]['cardno'] = $cardno;
					$_set_loan_tiering[$_cust_id][24][$tenor[0]] = str_replace(array(","),".",$val);
				}else if(end($tenor)==36){
					$_set_loan_tiering[$_cust_id][36]['cardno'] = $cardno;
					$_set_loan_tiering[$_cust_id][36][$tenor[0]] = str_replace(array(","),".",$val);
				}else if(end($tenor)==48){
					$_set_loan_tiering[$_cust_id][48]['cardno'] = $cardno;
					$_set_loan_tiering[$_cust_id][48][$tenor[0]] = str_replace(array(","),".",$val);
				}else if(end($tenor)==60){
					$_set_loan_tiering[$_cust_id][60]['cardno'] = $cardno;
					$_set_loan_tiering[$_cust_id][60][$tenor[0]] = str_replace(array(","),".",$val);
				}
			}
		}
		
		// echo "<pre>";
		// print_r($_set_loan_tiering);
		// echo "</pre>";
		
		foreach($_set_loan_tiering as $keys => $vals){
			foreach($vals as $key => $val){
				$_rate_no = 1;
				$this->db->set('CustomerId',$_cust_id);
				$this->db->set('Cardno', ($_set_loan_tiering[$keys][$key]['cardno']!="" ? $this->replaceCarakter($_set_loan_tiering[$keys][$key]['cardno']):NULL) );
				$this->db->set('CampaignId',$this->_get_campaignId());
				$this->db->set('Tenor',($key != "" ? $this->replaceCarakter($key):NULL) );
				$this->db->set('LoanAmount',($_set_loan_tiering[$keys][$key]['loan'] !="" ? round(str_replace(",",".",$this->replaceCarakter($_set_loan_tiering[$keys][$key]['loan']))):NULL) );
				$this->db->set('Installment',($_set_loan_tiering[$keys][$key]['install'] != "" ? round(str_replace(",",".",$this->replaceCarakter($_set_loan_tiering[$keys][$key]['install']))):NULL) );
				$this->db->set('AdminFee',($_set_loan_tiering[$keys][$key]['afees'] !="" ? round(str_replace(",",".",$this->replaceCarakter($_set_loan_tiering[$keys][$key]['afees']))):NULL) );
				$this->db->set('DisburseAmount',($_set_loan_tiering[$keys][$key]['disburse'] !="" ? round(str_replace(",",".",$this->replaceCarakter($_set_loan_tiering[$keys][$key]['disburse']))):NULL) );
				$this->db->set('Rate',($_set_loan_tiering[$keys][$key]['interest'] != "" ? $this->replaceCarakter($_set_loan_tiering[$keys][$key]['interest']):NULL) );
				$this->db->set('UploadDate', date('Y-m-d H:i:s'));
				// $this->db->set('Orders',$_rate_no);
				$this->db->insert('t_gn_loan_tiering');
				$debug_loan[] = $this->db->last_query(); 
				if( $this->db->affected_rows() > 0 ) {
					// $conds++;
				}
				// echo MYSQL_ERROR();
				$_rate_no++;
			}
		}
	}
	
	/**
	 * Parse out the attributes
	 *
	 * Some of the functions use this
	 *
	 * @access	private
	 * @param	array
	 * @param	bool
	 * @return	string
	 */
 	public function _set_process( $val = null )
	{
		 // ini_set('display_errors', 1);
		 // ini_set('display_startup_errors',1);
		 // error_reporting(E_ALL);

		 // disini harus di cek terlebih dahulu , berdasrkan setting 
		 // table "t_gn_template", apakah bernilai Y/N jika Y maka 
		 // masukan data ke Bucket jika N tidak Perlu, langsung ke table 
		 // tujuan 
 
	 	if( $this->_get_iswrite_bucket() ){
			$this->_set_write_bucket();
	 	}
 
	 	// define data arrray disini 
	 	$loan_tiering = array();	
	 	$array_assoc = array();
 
		// next of process langsung return false;
	 	$cond = is_array( $this->_upload_table_data );
	 	if( !$cond ){
		 	return false;
	 	}
 
		// get class block data 
	  	$this->blk = Singgleton( 'M_MgtBlacklist' );
	   
	 	// definisikan setiap field yang akan di masukan ke dalam table 
	 	// tujuan dalam [@array].
	  	$array_assoc = array(
			'custno1'			=> 'CustomerNumber',
			'name'				=> 'CustomerFirstName',
			'dob'				=> 'CustomerDOB',
			'phone1'			=> 'CustomerHomePhoneNum',
			'phone2'			=> 'CustomerWorkPhoneNum',
			'mobile'			=> 'CustomerMobilePhoneNum',
			'addr1' 	 		=> 'CustomerAddressLine1',
			'addr2' 	 		=> 'CustomerAddressLine2',
			'addr3' 	 		=> 'CustomerAddressLine3',
			'addr4' 	 		=> 'CustomerAddressLine4',
			'sex'				=> 'GenderId',
			// 'occu_complete' 	=> 'Job_Title',
			'occupation' 		=> 'Job_Title',
			'dbase_expire_dt'	=> 'expired_date',
			'kode_kelompok'		=> 'mkt_code',
			
			// TAMBAHAN untuk data VERIFIKASI 
			
			'cardno'		   	=> 'card_no',
			'limit'			   	=> 'credit_limit',
			'duedate'		   	=> 'due_date',
			'card_expr_txt' 	=> 'card_exp',
			'supplement_flag'  	=> 'flag_suplement',
			'billing_address'  	=> 'billing_address'
			
			// 'cycle_due_date' => 'cycle_due_date',
			// 'ssvno' 	 		=> 'pil_acc_no',
			// 'old_instalment' => 'monthly_installment',
		);
	
		// === loan tiering = ==
		$array_loan_tiering = array(
			'cardno'			 => 'Cardno',
			'loan_amt_12'		 => 'loan_12',
			'loan_amt_24'		 => 'loan_24',
			'loan_amt_36'		 => 'loan_36',
			'loan_amt_48'		 => 'loan_48',
			'loan_amt_60'		 => 'loan_60',
			'instal_12'			 => 'install_12',
			'instal_24'			 => 'install_24',
			'instal_36'			 => 'install_36',
			'instal_48'			 => 'install_48',
			'instal_60'			 => 'install_60',
			'interest_rate_12'	 => 'interest_12',
			'interest_rate_24'	 => 'interest_24',
			'interest_rate_36'	 => 'interest_36',
			'interest_rate_48'	 => 'interest_48',
			'interest_rate_60'	 => 'interest_60',
			'admin_fees_t12' 	 => 'afees_12',
			'admin_fees_t24' 	 => 'afees_24',
			'admin_fees_t36' 	 => 'afees_36',
			'admin_fees_t48' 	 => 'afees_48',
			'admin_fees_t60' 	 => 'afees_60',
			'net_loan_value_t12' => 'disburse_12',
			'net_loan_value_t24' => 'disburse_24',
			'net_loan_value_t36' => 'disburse_36',
			'net_loan_value_t48' => 'disburse_48',
			'net_loan_value_t60' => 'disburse_60' );
											
		// then next process 
	 	$error = null;
	 	$i 	= 0;
	 	$msg  = array();

	 	if(is_array($this->_upload_table_data)) {
			foreach( $this->_upload_table_data as $n => $values )
		 	{
		 		$i++;
				// get refernece 
				$this->val = Objective( $values );
				// var_dump($this->val);
				/**
			 	 * value name
			 	 * value cusno
			 	 * value campaignID
			 	 * value invalid
			 	 */
			 	$msg_invalid1 = array(
			 		'name' 		=> $this->val->field('Name'), 
			 		'cusno' 	=> $this->val->field('CUSTNO1'), 
			 		'campaignId'=> $this->_getCampaignName($this->_campaignId)
			 	);
			
				// push data field additional testing 
				$this->val->add('UploadId', $this->_field_uploadId);
				$this->val->add('table',  't_gn_customer');
				$this->val->add('field',  'CustomerNumber');
				$this->val->add('xdays',   EXP_LIMIT_DATA);
			
		   		// cek jika datayang di upload sudah expired jangan di masukan ke 
		   		// table customer 
		   		$checkFileDataExpired = FALSE;
				/*$checkFileDataExpired = $this->blk->_checkDispositionDataExpired(array(
					// 'expired_date' => $this->val->field('expire_dt')
					'expired_date' => $this->val->field('Expire_dt')
				));*/
			
			  	/**
			   	* jika data yang di upload ada dalam table blacklist maka data teresebut 
			   	* akan di exlude atau di skip.
			   	*/	
				$checkBlacklist = $this->blk->_CheckBlacklist(array(
					// 'NAME' 		=> $this->val->field('name'),
					'CIF' 		=> $this->val->field('CUSTNO1'),
					'NAME' 		=> $this->val->field('Name'),
					'UploadId' 	=> $this->val->field('UploadId')
				));
						
			  	/**
			  	 * jika data dengan satus INC & TBO ada dalam database dan teridentifikasi 
			   	* dalam file upload maka data tersebut akan di exlude 
			   	* dan tidak dimasukan ke dalam database
			   	*/
			    $checkIncomingTbo = FALSE;
				/*$checkIncomingTbo = $this->blk->_CheckXDaysIncoming(array(
					// 'NAME'     => $this->val->field('name'),
					'CIF'      => $this->val->field('Custno1'),
					'NAME'     => $this->val->field('Name'),
					'UploadId' => $this->val->field('UploadId'),
					'table'    => $this->val->field('table'),  
					'field'    => $this->val->field('field'), 
					'XDAYS'    => $this->val->field('xdays')
				));*/
				
			  	/**
			   	* jika ada data sebelumnya dengan status WN,BT,ID,NPU dan belum expired 
			   	* kemudian teridentifikasi kembali pada data upload 
			   	* maka data lama tersebut expired_date akan di update menjadi (today)-1 
			   	*/
			    $checkDispositionData = FALSE;
		   		/*$checkDispositionData = $this->blk->_checkDispositionData(array(
					// 'NAME'     => $this->val->field('name'),
					'CIF'      => $this->val->field('Custno1'),
					'NAME'     => $this->val->field('Name'),
					'UploadId' => $this->val->field('UploadId'),
					'table'    => $this->val->field('table'),  
					'field'    => $this->val->field('field'), 
					'XDAYS'    => $this->val->field('xdays')
			 	));*/
				
			  	/** 		
			   	* jika ada data sebelumnya dengan bukan status WN,BT,ID,NPU dan belum expired 
			   	* kemudian teridentifikasi kembali pada data upload 
			   	* maka data yang di upload akan di exlude kecualia sudah expired  
			   	*/	
				$checkDispositionNotExpired = false;
			
		    	/* $checkDispositionNotExpired = $this->blk->_checkDispositionNotExpired(array(
					'CIF'      => $this->val->field('Custno1'),
					'NAME'     => $this->val->field('name'),
					'UploadId' => $this->val->field('UploadId'),
					'table'    => $this->val->field('table'),  
					'field'    => $this->val->field('field'), 
					'XDAYS'    => $this->val->field('xdays')
			 	));*/

			 	/**
				 * jika ada data sebelumnya dangan status selain TBO, INC dan tidak expired
				 * maka data lama di update expired menjadi (today)-1.
				 */

				$checkNotIncomingTbo = $this->blk->_checkNotIncomingTbo(array(
					'CIF'       => trim($this->val->field('CUSTNO1')),
					'CampaignId'=> $this->_campaignId
				));


				/**
			   	* jika data dengan satus INC & TBO ada dalam database dan teridentifikasi 
			   	* dalam file upload maka data tersebut akan di exlude 
			   	* dan tidak dimasukan ke dalam database
			   	*/
			   	$checkDataIncomingTbo = $this->blk->_checkDataIncomingTbo(array(
					'CIF'      => trim($this->val->field('CUSTNO1'))
				));
			 
			 	/******************* SECTION VALIDATION ***********************/
			 	// jika duplikasi dengan data blacklist then total 
		  		if ( $checkFileDataExpired ){
		  			// $msg[$i]['data-expired'] = $values;
		  			$msg[$i] = array_merge($msg_invalid1, array('invalid'=>'data-expired') );
					$this->_tots_expired+=1;
					continue;
		  		}
		  
		 		// jika duplikasi dengan data blacklist then total 
		 		if( $checkBlacklist ){
		 			// $msg[$i]['data-blacklist'] = $values;
		 			$msg[$i] = array_merge($msg_invalid1, array('invalid'=>'data-blacklist') );
					$this->_tots_blacklist+=1;
					continue;	
		  		}
		  
		 		// untuk data tbo dan INC 
		  		if( $checkIncomingTbo  ){
		  	  		// $msg[$i]['data-tbo_inc'] = $values;
		  	  		$msg[$i] = array_merge($msg_invalid1, array('invalid'=>'data-tbo_inc') );
			  		$this->_tots_duplicate+=1;
			  		continue;
		  		}
		  
		   		// untuk data yang expired dan status tertentu 
		   		if( $checkDispositionData ){
			 		// $this->_tots_duplicate+=1;
			  		// continue;
		   		}
		  
		   		// untuk data Expired dengan status yang belum jelas .
		    	if( $checkDispositionNotExpired  ){
			  		// $this->_tots_duplicate+=1;
			  		// continue;
		    	}

		    	if( (int)$checkDataIncomingTbo > 0 ) {
			 		// TBO
			 		if( $checkDataIncomingTbo == 12 ) {
			 			// $msg[$i]['data-tbo'] = $values;
			 			$msg[$i] = array_merge($msg_invalid1, array('invalid'=>'data-tbo') );
			 		}
			 		// INC
			 		if( $checkDataIncomingTbo == 13 ) {
			 			// $msg[$i]['data-inc'] = $values;
			 			$msg[$i] = array_merge($msg_invalid1, array('invalid'=>'data-inc') );
			 		}
					$this->_tots_duplicate+=1;
					continue;
			 	}
		  
		 		// jika kondisi 2 tersebut tidak terpenuhi process data tersebut
		 		// berikut ini.
		  		$_array_select = null;
			  	if( is_array($values) )  
				  foreach( $values as $field => $value )  {
					if( in_array(strtolower($field), array_keys($array_assoc) ) )  {
						$debug[] = $array_assoc[strtolower($field)] ."=".$this->_class_tools->setCallEvent($array_assoc[strtolower($field)],$value);
						$this->db->set($array_assoc[strtolower($field)], $this->_class_tools->setCallEvent($array_assoc[strtolower($field)],$value) );
					}
				
					if( in_array(strtolower($field), array_keys($array_loan_tiering) ) )  {
						$debugloan[] = $array_loan_tiering[strtolower($field)] ."=".$value;
						$loan_tiering[$array_loan_tiering[strtolower($field)]] = $value;
					}
			  	}

			  	#var_dump( $debugloan ); die();
			  	#var_dump( $debug ); die();
				  $date=date("Y-m-30");
				  
			  	// _gen_custno
				$callDisAutoID = $this->_gen_custno();
				// $this->db->set('CustomerNumber', $callDisAutoID);
				// $this->db->set('Recsource', $values['Recsource']); 
				$this->_recsource = $values['Recsource'];
				$this->db->set('Recsource', $this->_recsource);
				$this->db->set('CampaignId', $this->_campaignId);
				$this->db->set('CustomerUploadedTs', date('Y-m-d H:i:s'));
				$this->db->set('UploadId', $this->_field_uploadId);
				$this->db->set('Recsource_ftp', $this->_recsource_ftp);
				$this->db->set('count_of_supplement', $values['count_of_supplement']);
				$this->db->set('count_of_primary_card', $values['count_of_primary_card']);
				$this->db->set('Classic_card', $values['Classic_card']);
				$this->db->set('Gold_card', $values['Gold_card']);
				$this->db->set('Cashback_card', $values['Cashback_card']);
				$this->db->set('Platinum_card', $values['Platinum_card']);
				$this->db->set('Signature_card', $values['Signature_card']);
				$this->db->set('Premier_card', $values['Premier_card']);
				$this->db->set('flag_type', $values['Flag_type']);
				$this->db->set('E_STATEMENT_FLAG', $values['E_STATEMENT_FLAG']);
				$this->db->set('Email', $values['Email']);
				$this->db->set('Supp_Name_1', $values['Supp_Name_1']);
				$this->db->set('Supp_Name_2', $values['Supp_Name_2']);
				$this->db->set('Supp_Name_3', $values['Supp_Name_3']);
				$this->db->set('Supp_Name_4', $values['Supp_Name_4']);
				$this->db->set('Supp_Name_5', $values['Supp_Name_5']);
				$this->db->set('expired_date', $values['expired_date']);
				// $this->db->set('expired_date', $date);
				$this->db->insert("t_gn_customer", $_array_select);
				// var_dump( $this->db->last_query() ); die();
			
				if( $this->db->affected_rows()>0 ) {
				
					// get insert last id if exist .
					$callDispositionID = $this->db->insert_id();
					$this->_set_assignment( $callDispositionID );
					// $this->_set_loan_tiering($loan_tiering, $callDispositionID);
					
					// tambahan table untuk process filter saja .
					// $this->_set_write_filter( $values, $callDispositionID);
						
					if( !is_null($this->_upload_table_name) )  
					{
						if( is_array($values)) 
							foreach( $values as $field => $value){
							$values[$field] = $this->_class_tools->setCallEvent($field, $value);
						}			
						
						// push data tambahan 				
						$this->_set_additional("CustomerId", $callDispositionID);
						if( is_array($this->_field_additional)  AND count($this->_field_additional)>0 ) {
							foreach( $this->_field_additional as $field => $value ){
								$values[$field] = $this->_class_tools->setCallEvent($field, $value);
							}
						}
						
						// echo "<pre>";
						// print_r($values);
						// echo "</pre>";
						// die;
						
						$this->db->insert( $this->_upload_table_name, $values );
						// var_dump( $this->db->last_query() ); die();
						
						if( $this->db->affected_rows() > 0 ){
							$this->_tots_success+=1;
						}  else {
							// $msg[$i]['data-failde'] = $values;
							$msg[$i] = array_merge($msg_invalid1, array('invalid'=>'data-failed') );
							$this->_tots_failed+=1;
						}
						// end process insert and other 
					} else {
						// $msg[$i]['data-failde'] = $values;
						$msg[$i] = array_merge($msg_invalid1, array('invalid'=>'data-failed') );
						$this->_tots_failed+=1;
					}	
					// end insert table master
			 	} else	{
			 		// $msg[$i]['data-failde'] = $values;
			 		$msg[$i] = array_merge($msg_invalid1, array('invalid'=>'data-failed') );
					$this->_tots_failed+=1;
			 	}
			 	// end insert customer 
			} 
			// end foreach
		}

		$params = array(
	  		'FTP_UploadId' => $this->_uploadid_ftp,
	  		'Data_Upload'  => $msg
	  	);
	  	$this->_setUploadInvalid( $params );

	} // end funct 
	
	/**
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */		
	function _gen_custno() {
 		$this->num = '000000000001';
 		$sql = "select max(CustomerId) as ujung from t_gn_customer";
 		$qry = $this->db->query($sql);
 		if( $qry->num_rows()>0 ) {
			$this->max = ((int)$qry->result_singgle_value()+1);
			$this->num = str_pad($this->max,12,"0",STR_PAD_LEFT);
 		}
 		return $this->num;
	}

	/**
	 * (F) _set_recsource_ftp description]
	 * @param Array $params
	 */
	public function _set_recsource_ftp( $params=array() ) 
	{
		$this->_recsource_ftp = @$params['recsource_ftp'];
		$this->_uploadid_ftp  = @$params['uploadid_ftp'];
		return $this->_recsource;
	}

	/**
	 * (F) _setUploadInvalid
	 * @param  Array $params
	 */
	public function _setUploadInvalid( $params )
	{
		if( count(@$params["Data_Upload"]) > 0 ) {
			$data = array(
				'FTP_UploadId'	=> @$params['FTP_UploadId'],
	  			'Data_Upload'   => json_encode( @$params['Data_Upload'] ),
	  			'Create_Ts'		=> date("Y-m-d H:i:s")
			);
			$this->db->insert('t_gn_upload_invalid', $data);
		}
	}

	/**
	 * (F) _getCampaignName [get campaig]
	 * @param  Int $CampaignId
	 */
	public function _getCampaignName($CampaignId=0)
	{
		$result = array();
		if( is_null( $this->_campaignName) ) {
			$this->db->where('CampaignId',$CampaignId);
			$res = $this->db->get('t_gn_campaign');
			if( $res->num_rows() > 0 ) {
				$data = $res->row_array();
				$this->_campaignName = $data['CampaignDesc'];		
			}
		}
		return $this->_campaignName; 
	}

 	/**
	 * (F) replaceCarakter description]
	 * 
	 * @param  String $value 
	 * @param  Array  $carakter
	 * @return String
	 */
 	public function replaceCarakter( $value="", $carakter=array())
 	{
 		if( empty($carakter) ) {
 			$carakter = array("'");
 		}
		return str_replace($carakter, "", $value);
 	}
	

	// == END CLASS UPLOAD ==
}
?>