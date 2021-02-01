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
class U_Cip_Reguler extends EUI_Upload
{

 	var $_upload_table_name 	= null;
 	var $_upload_table_data 	= null;	
 	var $_tots_rowselect 		= 0;
 	var $_tots_success 		= 0;
 	var $_tots_failed 			= 0;
 	var $_tots_duplicate 		= 0;
 	var $_tots_expired	  		= 0;
 	var $_tots_blacklist 		= 0;
	
 	private $_field_additional = array(); 
 	private $_is_complete 		= FALSE;
 	private $_campaignId 		= 0;
 	private $_recsource 		= 0;
 	private $_recsource_ftp 	= "";
 	private $_uploadid_ftp 	= "";
 	private $_field_uploadId 	= 0;
 
 	protected $_class_tools 	= null;
 	private static $Instance 	= null;

 	private $_campaignName = NULL;
 
	 /**
	  * [U_Cip_Reguler description]
	  * @param  [type] $CustomerId [description]
	  * @return [type]             [description]
	  */
	function U_Cip_Reguler()
	{
		$this->_get_campaignId();
		$this->load->model(array('M_SysUser','M_Tools','M_MgtBlacklist'));
		$this->load->helpers("EUI_Object");
		
		// @ pack : set tools data ===============================> 
		if(is_null($this->_class_tools)) {
			$this->_class_tools =& get_class_instance('M_Tools');
		}
	}
	
	 /**
	  * [U_Cip_Reguler description]
	  * @param  [type] $CustomerId [description]
	  * @return [type]             [description]
	  */
	public static function &Instance()
	{
		if( is_null(self::$Instance) ) 
		{
			self::$Instance = new self();
		}
	  
		return self::$Instance;
	}
			
	 /**
	  * [U_Cip_Reguler description]
	  * @param  [type] $CustomerId [description]
	  * @return [type]             [description]
	  */
	private function _reset_class_run( $ar_reset_items )
	{
		foreach ( $ar_reset_items as $items => $items_default )
		{
			if(trim($items) )
			{
				$this->$items = $items_default;
			}
		}
	 } 

	/**
	 * [U_Cip_Reguler description]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
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
			'_field_additional'  => array() 
	  	);
	  	$this->_reset_class_run( $ar_items_reset );
	}

	/**
	 * [U_Cip_Reguler description]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	public function _get_class_callback()
	{
	  	$ar_items_back = array 
	  	(
			'TOTAL_UPLOAD' 	=> $this->_tots_rowselect,
			'TOTAL_SUCCES' 	=> $this->_tots_success,
			'TOTAL_FAILED' 	=> $this->_tots_failed,
			'TOTAL_DUPLICATE' 	=> $this->_tots_duplicate,
			'TOTAL_EXPIRED'	=> $this->_tots_expired,
			'TOTAL_BLACKLIST'  => $this->_tots_blacklist
	  	);
	  	return (object)$ar_items_back;
	}
	 
	public function _set_additional( $field = null, $values=null  ) 
	{
		if( !is_null($field) )
		{
			$this->_field_additional[$field] = $values;
		}	
	}

	/**
	 * [U_Cip_Reguler description]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
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
	 * [U_Cip_Reguler description]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
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
	 * [U_Cip_Reguler description]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
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
	 * [U_Cip_Reguler description]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
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
  	public function _get_iswrite_bucket()
 	{ 
		$arr_template = array();
		$sql = sprintf("select * from t_gn_template a where a.TemplateTableName = '%s'",  $this->_upload_table_name );
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
	 * [U_Cip_Reguler description]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	public function _set_uploadId( $_set_uploadId = 0 ) {
 		if( $_set_uploadId ){
			$this->_field_uploadId= $_set_uploadId;
 		}	
	}

	/**
	 * [U_Cip_Reguler description]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */	
	public function _set_table( $table = null )
	{
	  	if( !is_null( $table ) ) 
	  	{
		 	$this->_upload_table_name = $table;
	  	}
	}

	/**
	 * [U_Cip_Reguler description]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	public function _get_is_complete()
	{
	  return $this->_is_complete;
	}
	
	/**
	 * [U_Cip_Reguler description]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	private function _set_write_bucket()
	{
		if( is_array($this->_upload_table_data)) 
		{

		 	// @ pack : reset array -----------------------
			// $stdClass = $this->_get_ProjectId();
			$array_assoc = array(
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
				'o_phone' 	 => 'CustomerWorkPhoneNum',
				'h_phone' 	 => 'CustomerHomePhoneNum',
				'end_tele' 	 => 'expired_date',
				'cardno' 	 => 'Cardno',
				'custno1' 	 => 'Custno',
				// 'dbase_expire_dt'=> 'expired_date',
				// 'expire_dt' 	 => 'expired_date',
				// 'expiry_date' 	 => 'expired_date',
			);
			$error = null;
			foreach( $this->_upload_table_data as $n => $values )
			{
				$_array_select = null;
				foreach( $values as $field => $value )
				{ 
					if( in_array(strtolower($field), array_keys($array_assoc) ) )  {
						$debug[] = $this->_class_tools->setCallEvent($array_assoc[strtolower($field)],$value);
						$this->db->set($array_assoc[strtolower($field)], $this->_class_tools->setCallEvent($array_assoc[strtolower($field)],$value) );
					}
				}
				#var_dump( $debug ); die();
				
				// _gen_custno
				$this->_recsource = @$values['Recsource'];
				$this->db->set('Recsource', $this->_recsource);
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
	 * [U_Cip_Reguler description]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
	public function _set_content( $ar_items_source = null )
	{
		if( !is_null($ar_items_source) AND is_array($ar_items_source) )
	  	{
			$this->_upload_table_data = $ar_items_source;
		
		  	// additional if have proces not set on other class 
		  	// this will generate add of field not found in 
		  	// rows data .
	  
			/* $this->_set_additional('deb_created_ts', date('Y-m-d H:i:s'));
			$this->_set_additional('deb_cmpaign_id', $this->_campaignId);
			$this->_set_additional('deb_upload_id', $this->_field_uploadId); */
		
	  		// additional if have proces not set on other class 
	  		// this will generate add of field not found in 
	  		// rows data .
			$this->_tots_rowselect = count($ar_items_source);
			$this->_is_complete  = TRUE;
	  	}
	}
	
	/**
 	* [U_Cip_Reguler description]
 	* @param  [type] $CustomerId [description]
 	* @return [type]             [description]
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
	 * [U_Cip_Reguler description]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */
 	public function _set_process()
	{
		/* ini_set('display_errors', 1);
		 * ini_set('display_startup_errors',1);
		 * error_reporting(E_ALL);
		 */

		 // disini harus di cek terlebih dahulu , berdasrkan setting 
		 // table "t_gn_template", apakah bernilai Y/N jika Y maka 
		 // masukan data ke Bucket jika N tidak Perlu langsung ke table 
		 // tujuan 
	 	if( $this->_get_iswrite_bucket() ) {
			$this->_set_write_bucket();
	 	}
	 
	 	// define data arrray disini 
	 	$loan_tiering = array();	
	 	$array_assoc = array();
	 
	 	// next of process langsung return false;
	 	$cond = is_array( $this->_upload_table_data );
	 	if( !$cond ) {
		 	return false;
	 	}
	 
	 	// get class block data 
	 	$this->blk = Singgleton( 'M_MgtBlacklist' );
	 
	 	// definisikan setiap field yang akan di masukan ke dalam table 
	 	// tujuan dalam [@array].
	 	// FORMAT : $array_assoc('index_array' => 'field db')
	  	$array_assoc = array(
			'name' 		 		=> 'CustomerFirstName',
			'dob' 		 		=> 'CustomerDOB',
			'phone1' 	 		=> 'CustomerHomePhoneNum',
			'phone2' 	 		=> 'CustomerWorkPhoneNum',
			'mobile' 	 		=> 'CustomerMobilePhoneNum',
			'addr1' 	 		=> 'CustomerAddressLine1',
			'addr2' 	 		=> 'CustomerAddressLine2',
			'addr3' 	 		=> 'CustomerAddressLine3',
			'addr4' 	 		=> 'CustomerAddressLine4',
			'zip' 		 		=> 'CustomerZipCode',
			'sex' 		 		=> 'GenderId',
			'occupation' 		=> 'Job_Title',
			'o_phone' 	 		=> 'CustomerWorkPhoneNum',
			'h_phone' 	 		=> 'CustomerHomePhoneNum',
			'end_tele' 			=> 'expired_date',
			// 'expire_dt' 		=> 'expired_date',
			// 'expiry_date' 	=> 'expired_date',
			
			// TAMBAHAN VERIFIKASI 
			'cardno' 	 		=> 'card_no',
			'limit' 	 		=> 'credit_limit',
			'due_date' 	 		=> 'due_date',
			'duedate' 	 		=> 'due_date',
			'card_expr_txt' 	=> 'card_exp',
			'card_expiry_date' 	=> 'card_exp',
			'card_exp' 	 		=> 'card_exp',
			'flag_supplement' 	=> 'flag_suplement',
			'billing_address' 	=> 'billing_address',
			'cycle_due_date' 	=> 'cycle_due_date',
			'ssvno' 	 		=> 'pil_acc_no',
			'old_instalment' 	=> 'monthly_installment'
	  	);
			
		// then get list foreach this data 
		// on set data.
	 	$error = null;
	 	$i 	= 0;
	 	$msg  = array();
	 	#var_dump( $this->_upload_table_data );die();

	 	// start if $this->_upload_table_data
	 	if( is_array($this->_upload_table_data)) 
	 	{
	   		foreach( $this->_upload_table_data as $n => $values ) 
	 		{
		 		$i++; 
				// get refernece 
				$this->val = Objective( $values );

				/**
			 	 * value name
			 	 * value cusno
			 	 * value campaignID
			 	 * value invalid
			 	 */
			 	$msg_invalid1 = array(
			 		'name' 		=> $this->val->field('Name'), 
			 		'cusno' 	=> ( $this->val->field('Custno1','strlen')  ? trim($this->val->field('Custno1')) : trim($this->val->field('Amount_Class')) ), 
			 		'campaignId'=> $this->_getCampaignName($this->_campaignId)
			 	);

				// push data field additional testing 
				$this->val->add('UploadId', $this->_field_uploadId);
				$this->val->add('table',  't_gn_customer');
				$this->val->add('field',  'CustomerNumber');
				$this->val->add('xdays',  EXP_LIMIT_DATA);
		
			    // cek jika datayang di upload sudah expired jangan di masukan ke 
			    // table customer 
				#var_dump( $this->val->field('Dbase_Expire_dt') ); die();
				$checkFileDataExpired = FALSE;
				/*$checkFileDataExpired = $this->blk->_checkDispositionDataExpired(array(
					// 'expired_date' => $this->val->field('expire_dt')
					'expired_date' => $this->val->field('Dbase_Expire_dt')
				));*/
		
			  	/**
			   	* jika data yang di upload ada dalam table blacklist maka data teresebut 
			   	* akan di exlude atau di skip.
			   	*/
				$checkBlacklist = $this->blk->_CheckBlacklist(array(
					// 'NAME' 		=> $this->val->field('name'),
					// 'CIF' 		=> $this->val->field('Cardno'),
					'CIF' 		=> ( $this->val->field('Custno1','strlen')  ? trim($this->val->field('Custno1')) : trim($this->val->field('Amount_Class')) ),
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
					// 'CIF'      => $this->val->field('Cardno'),
					'NAME'     => $this->val->field('Name'),
					'CIF'      => ( $this->val->field('Custno1','strlen')  ? trim($this->val->field('Custno1')) : trim($this->val->field('Amount_Class')) ),
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
					'NAME'     => $this->val->field('Name'),
					'CIF'      => trim($this->val->field('Custno1')),
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
					'CIF'       => ( $this->val->field('Custno1','strlen')  ? trim($this->val->field('Custno1')) : trim($this->val->field('Amount_Class')) ),
					'CampaignId'=> $this->_campaignId
				));

				/**
			   	* jika data dengan satus INC & TBO ada dalam database dan teridentifikasi 
			   	* dalam file upload maka data tersebut akan di exlude 
			   	* dan tidak dimasukan ke dalam database
			   	*/
			   	$checkDataIncomingTbo = $this->blk->_checkDataIncomingTbo(array(
					'CIF'       => ( $this->val->field('Custno1','strlen')  ? trim($this->val->field('Custno1')) : trim($this->val->field('Amount_Class')) ),
					'CampaignId'=> $this->_campaignId
				));
			   

				/******************* SECTION VALIDATION ***********************/
			 	// jika duplikasi dengan data blacklist then total | SKIP
			  	if ( $checkFileDataExpired ) {
			  		// $msg[$i]['data-expired'] = $values;
			  		$msg[$i] = array_merge($msg_invalid1, array('invalid'=>'data-expired') );
					$this->_tots_expired+=1;
					continue;
			  	}
	  
			 	// jika duplikasi dengan data blacklist then total | SKIP
			 	if( $checkBlacklist ) {
			 		// $msg[$i]['data-blacklist'] = $values;
			 		$msg[$i] = array_merge($msg_invalid1, array('invalid'=>'data-blacklist') );
					$this->_tots_blacklist+=1;
					continue;	
			  	}

			 	// untuk data tbo dan INC | SKIP
			  	if( $checkIncomingTbo  ) {
			  		// $msg[$i]['data-tbo_inc'] = $values;
			  		$msg[$i] = array_merge($msg_invalid1, array('invalid'=>'data-tbo_inc') );
					$this->_tots_duplicate+=1;
					continue;
			  	}
	  
			 	// untuk data yang expired dan status tertentu 
			   	if( $checkDispositionData ) {
				 	$this->_tots_duplicate+=1;
				  	continue;
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
			 	#var_dump( $values ); die();
				$_array_select = null;
				if( is_array($values)) {
					$loan_tiering = array();
				 	foreach( $values as $field => $value ) { 
						if( in_array(strtolower($field), array_keys($array_assoc) ) )  {
							$debug[] = $array_assoc[strtolower($field)] ."=".$this->_class_tools->setCallEvent($array_assoc[strtolower($field)],$value) ."=".$field;
							$this->db->set($array_assoc[strtolower($field)], $this->_class_tools->setCallEvent($array_assoc[strtolower($field)],$value) );
						}

						// loan_tiering
						$loan_tiering[strtolower($field)] = $value;
					}
				}

				#var_dump( $debug ); die();
				#var_dump( $debugloan ); die();

				// generate autonumber if not exist autonumber 
				// $callDisAutoID = ( $this->val->field('Cardno','strlen')  ? $this->val->field('Cardno') : $this->_gen_custno() );
				$callDisAutoID = ( $this->val->field('Custno1','strlen')  ? trim($this->val->field('Custno1')) : trim($this->val->field('Amount_Class')) );
				$this->_recsource = $values['Recsource'];
				$this->db->set('CustomerNumber', 	 $callDisAutoID );
				$this->db->set('Recsource', 	 	 $this->_recsource);
				$this->db->set('CampaignId', 		 $this->_campaignId);
				$this->db->set('UploadId', 			 $this->_field_uploadId);
				$this->db->set('CustomerUploadedTs', date('Y-m-d H:i:s'));
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

				// buka tambah untuk verifikasi new april 2020
				$this->db->set('Flag_Fraud', $values['Flag_Fraud']);
				$this->db->set('E_STATEMENT_FLAG', $values['E_STATEMENT_FLAG']);
				$this->db->set('Email', $values['Email']);
				$this->db->set('Supp_Name_1', $values['Supp_Name_1']);
				$this->db->set('Supp_Name_2', $values['Supp_Name_2']);
				$this->db->set('Supp_Name_3', $values['Supp_Name_3']);
				$this->db->set('Supp_Name_4', $values['Supp_Name_4']);
				$this->db->set('Supp_Name_5', $values['Supp_Name_5']);
				$this->db->set('flag_RUF', $values['flag_RUF']);
				$this->db->set('flag_invited', $values['flag_invited']);
				// tutup tambah untuk verifikasi new april 2020

				$query = $this->db->insert("t_gn_customer", 	 $_array_select);
				#var_dump( $this->db->last_query() ); die();
				
				// jika success insert ke t_gn_customer maka process selanjutnya .
				if( $this->db->affected_rows()>0 )
				{
					
					// get insert last id if exist .
					$callDispositionID = $this->db->insert_id();		
					$this->_set_assignment( $callDispositionID );
					$this->_set_loan_tiering($loan_tiering, $callDispositionID);
					
					// then additional 
					if( !is_null($this->_upload_table_name) ) 
					{
						if( is_array($values)) foreach( $values as $field => $value) {
							$values[$field] = $this->_class_tools->setCallEvent($field, $value);
						}
						
						// push data tambahan 				
						$this->_set_additional("CustomerId", $callDispositionID);
						
						// inject dengan function yang ada .
						if( is_array( $this->_field_additional ) and count($this->_field_additional)>0 ){
							foreach( $this->_field_additional as $field => $value ){
								$values[$field] = $this->_class_tools->setCallEvent($field, $value);
							}
						}
										
						//****** INSERT SESUAI PRODUCT CIP *********/
						$this->db->insert( $this->_upload_table_name, $values );
						#var_dump( $this->db->last_query() ); die();

						if( $this->db->affected_rows()>0 ) {
							$this->_tots_success+=1;
						} else {
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
				} else {
				 	// $msg[$i]['data-failde'] = $values;
				 	$msg[$i] = array_merge($msg_invalid1, array('invalid'=>'data-failed') );
					$this->_tots_failed+=1;
				} 
				// end insert customer 
				
	 		} // end foreach;

	 	} // end if $this->_upload_table_data
	 	
	 	$params = array(
	  		'FTP_UploadId' => $this->_uploadid_ftp,
	  		'Data_Upload'  => $msg
	  	);
	  	$this->_setUploadInvalid( $params );

	}
	
	/**
	 * [U_Cip_Reguler description]
	 * @param  [type] $CustomerId [description]
	 * @return [type]             [description]
	 */	
	function _gen_custno()
	{
 		$this->num = '000000000001';
 		$sql = "select max(CustomerId) as ujung from t_gn_customer";
 		$qry = $this->db->query($sql);
 		if( $qry->num_rows()>0 ) {
			$this->max = ((int)$qry->result_singgle_value()+1);
			$this->num = str_pad($this->max,12,"0",STR_PAD_LEFT);
 		}
 		return $this->num; // add left 0 digit, 12 digit
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

	protected function _set_loan_tiering($loan_tiering = array(), $_cust_id = 0)
	{
		#var_dump('loan', $loan_tiering );
		$tier = array(
			'tier1' => @$loan_tiering['tier1'],
			'tier2' => @$loan_tiering['tier2'],
			'tier3' => @$loan_tiering['tier3'],
			'tier4' => @$loan_tiering['tier4'],
			'tier5' => @$loan_tiering['tier5'],
		);
		$tenor = array(
			'1' => (int)trim(@$loan_tiering['tenor1']),
			'2' => (int)trim(@$loan_tiering['tenor2']),
			'3' => (int)trim(@$loan_tiering['tenor3']),
			'4' => (int)trim(@$loan_tiering['tenor4']),
			'5' => (int)trim(@$loan_tiering['tenor5']),
		);
		$installment = array(
			'1'	=> "month_ins_06_",
			'2' => "month_ins_12_",
			'3' => "month_ins_18_",
			'4' => "month_ins_03_",
			'5' => "month_ins_24_",
		);
		$ins_free = array(
			'1'	=> "NULL",
			'2' => "NULL",
			'3' => "free_interest_t18_",
			'4' => "free_interest_t24_",
			'5' => "NULL",
		);
		$admin_fee = array(
			'1'	=> "NULL",
			'2' => "NULL",
			'3' => "NULL",
			'4' => "admin_fee_t3_",
			'5' => "admin_fee_t4_",
		);

		$card2_tenor = array(
			'map_tenor1' => @$loan_tiering['map_tenor1'],
			'map_tenor2' => @$loan_tiering['map_tenor2'],
			'map_tenor3' => @$loan_tiering['map_tenor3'],
		);
		$card2_tier = array(
			'map_tier1' => @$loan_tiering['map_tier1'],
			'map_tier2' => @$loan_tiering['map_tier2'],
			'map_tier3' => @$loan_tiering['map_tier3'],
			'map_tier4' => @$loan_tiering['map_tier4'],
		);
		$card2_rate = array(
			'map_rate1' => @$loan_tiering['map_rate1'],
			'map_rate2' => @$loan_tiering['map_rate2'],
			'map_rate3' => @$loan_tiering['map_rate3'],
		);
		$card2_install = array(
			'1' => 'map_month_ins_06_',
			'2' => 'map_month_ins_12_',
			'3' => 'map_month_ins_18_',
		);

		$debug = array();
		$jml_tier = 4;
		$no=1;
		for($i=1; $i <= $jml_tier;) {
			// if( (int)trim(@$loan_tiering[$tenor]) ) {
				
				$_rate_no= 1;
				foreach ($tier as $key => $value) {

					$_tenor  = "tenor{$_rate_no}";
					$_amount = "tier{$i}";
					$_rate   = "rate{$_rate_no}";

					$_ins    = $installment[$_rate_no]; 
					$_inst   = $_ins.$i;

					$_ins_fee_ = "free_interest_t".@$loan_tiering[$_tenor]."_".$i;
					$_admfee   = $admin_fee[$_rate_no]; $_admfee_ = $_admfee.$i;
					#var_dump( $tier ); die();

					if( (int)@$loan_tiering[$_amount] > 0 AND (int)@$loan_tiering[$_tenor] > 0 ) 
					{
						$this->db->set('Cardno',@$loan_tiering['cardno']);
						$this->db->set('CampaignId',$this->_get_campaignId());
						$this->db->set('UploadDate', date('Y-m-d H:i:s'));
						$this->db->set('CustomerId',$_cust_id);
						$this->db->set('Tenor',@$loan_tiering[$_tenor] == '' ? NULL : @$loan_tiering[$_tenor]);
						$this->db->set('LoanAmount',@$loan_tiering[$_amount] == '' ? NULL :  round($this->replaceCarakter(@$loan_tiering[$_amount])) );
						$this->db->set('AdminFee',@$loan_tiering[$_admfee_] == '' ? NULL :  round($this->replaceCarakter(@$loan_tiering[$_admfee_])) );
						$this->db->set('Rate',@$loan_tiering[$_rate] == '' ? NULL : @$loan_tiering[$_rate]);
						$this->db->set('Installment',@$loan_tiering[$_inst] == '' ? NULL :  round($this->replaceCarakter(@$loan_tiering[$_inst])) );
						$this->db->set('Free_Interest',@$loan_tiering[$_ins_fee_] == '' ? NULL :  round($this->replaceCarakter(@$loan_tiering[$_ins_fee_])) );
						$this->db->set('Desc_Card', 'CARD 1');
						$this->db->insert('t_gn_loan_tiering');
						$debug[] = $this->db->last_query();
						$no++;
					} $_rate_no++;
				// }
			} $i++;
		}

		// CARD 2 :
		$i = 1;
		foreach ($card2_tier as $key => $value) {
			$rate  = 1;
			$instal= 1;
			
			foreach ($card2_tenor as $keys => $values) {
				$rates = "map_rate".$rate;
				$rates_= $card2_rate[$rates];
			
				$ins   = $card2_install[$instal];
				$ins_  = @$loan_tiering[$ins.$i];

				if( trim($values) != "" ) {
					$this->db->set('Cardno',@$loan_tiering['cardno']);
					$this->db->set('CampaignId',$this->_get_campaignId());
					$this->db->set('UploadDate', date('Y-m-d H:i:s'));
					$this->db->set('CustomerId',$_cust_id);
					$this->db->set('Tenor',@$values == '' ? NULL : @$values);
					$this->db->set('LoanAmount',@$value == '' ? NULL :  round($this->replaceCarakter(@$value)));
					$this->db->set('AdminFee', NULL);
					$this->db->set('Rate',$rates_ == '' ? NULL : @$rates_);
					$this->db->set('Installment',$ins_ == '' ? NULL :  round($this->replaceCarakter(@$ins_)));
					$this->db->set('Free_Interest', NULL);
					$this->db->set('Desc_Card', 'CARD 2');
					$this->db->insert('t_gn_loan_tiering');
				}
				$rate++; $instal++;
			}
			$i++;
		}


		#var_dump( $debug ); die();

		/***
		[0]	=> tier
		[1]	=> admin_fee_t4
		[2] => rate
		***/
		/*$set_field_tearing = array(
			'tenor1' => 'tier1,admin_fee_t4_1,rate1,month_ins_06_1', 
			'tenor2' => 'tier2,admin_fee_t4_2,rate2,month_ins_12_1',
			'tenor3' => 'tier3,admin_fee_t4_3,rate3,month_ins_18_1',
			'tenor4' => 'tier4,admin_fee_t4_4,rate1,month_ins_03_1',
			'tenor5' => 'tier5,admin_fee_t4_5,rate1,Month_ins_24_1',
		);

		foreach($set_field_tearing as $keys => $vals){
			$attr = ""; $attr = explode(",", $vals);
			if( trim(@$loan_tiering[$keys]) != "" ) {
				$this->db->set('Cardno',@$loan_tiering['cardno']);
				$this->db->set('CampaignId',$this->_get_campaignId());
				$this->db->set('Tenor',@$loan_tiering[$keys]);
				$this->db->set('LoanAmount',@$loan_tiering[$attr[0]]);
				$this->db->set('AdminFee',@$loan_tiering[$attr[1]]);
				$this->db->set('Rate',@$loan_tiering[$attr[2]]);
				$this->db->set('Installment',@$loan_tiering[$attr[3]]);
				// $this->db->set('DisburseAmount',$_set_loan_tiering[$keys][$key]['disburse']);
				$this->db->set('CustomerId',$_cust_id);
				$this->db->set('UploadDate', date('Y-m-d H:i:s'));
				$this->db->insert('t_gn_loan_tiering');
				#var_dump( $this->db->last_query() );die();
			}
		}*/
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

 	function testing() {
		return null;
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
	
// ============= END CLASS 	========================
}
?>
