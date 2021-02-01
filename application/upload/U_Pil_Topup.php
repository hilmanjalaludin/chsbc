<?php
ini_set('max_execution_time', 0);
ini_set('max_execution_time', '0');
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
 
// ini_set("error_reporting", 1);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors',1);
// error_reporting(E_ALL);


class U_Pil_Topup extends EUI_Upload
{
	/**
	* @param  [type] $CustomerId [description]
	* @return [type]             [description]
	*/	
	var $_upload_table_name 	= null;
	var $_upload_table_data 	= null;
	var $_tots_rowselect 		= 0;
	var $_tots_success 			= 0;
	var $_tots_failed 			= 0;
	var $_tots_duplicate 		= 0;
	var $_tots_expired			= 0;
	var $_tots_blacklist		= 0;
   	
	private $_field_additional 	= array(); 
	private $_field_uploadId 	= 0;
	private $_is_complete 		= FALSE;
	private $_campaignId 		= 0;
	private $_recsource 		= 0;
	private $_recsource_ftp		= "";
	private $_uploadid_ftp 		= "";
	protected $_class_tools 	= null;
	private static $Instance 	= null;

	private $_campaignName = NULL;
	
	/**
	  * @param  [type] $CustomerId [description]
	  * @return [type]             [description]
	*/
 	function U_Pil_Topup() {
	 	$this->_get_campaignId();
	 	$this->load->model(array('M_SysUser','M_Tools','M_MgtBlacklist'));
	 	$this->load->helpers("EUI_Object");
	 
		if( is_null($this->_class_tools) ) {
			$this->_class_tools = Singgleton('M_Tools');
		}
	}

	 /**
	  * @param  [type] $CustomerId [description]
	  * @return [type]             [description]
	  */
	public static function &Instance() {
		if( is_null(self::$Instance) )  {
			self::$Instance = new self();
		}
		return self::$Instance;
	}
			
	 /**
	  * @param  [type] $CustomerId [description]
	  * @return [type]             [description]
	  */
	private function _reset_class_run( $ar_reset_items ) {
		foreach ( $ar_reset_items as $items => $items_default ) {
			if(trim($items) ) {
				$this->$items = $items_default;
			}
		}
	} 

	 /**
	  * @param  [type] $CustomerId [description]
	  * @return [type]             [description]
	  */
	protected function _reset_class_argvs() {
 		$this->ar_items_reset = array(
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
  		$this->_reset_class_run( $this->ar_items_reset );
	}

	 /**
	  * @param  [type] $CustomerId [description]
	  * @return [type]             [description]
	  */
	public function _get_class_callback() 
	{
 		$this->ar_items_back = array  (
			'TOTAL_UPLOAD' 	  => $this->_tots_rowselect,
			'TOTAL_SUCCES' 	  => $this->_tots_success,
			'TOTAL_FAILED' 	  => $this->_tots_failed,
			'TOTAL_DUPLICATE' => $this->_tots_duplicate,
			'TOTAL_EXPIRED'	  => $this->_tots_expired,
			'TOTAL_BLACKLIST' => $this->_tots_blacklist
 		);
		return (object)$this->ar_items_back;
	}

	/**
	  * @param  [type] $CustomerId [description]
	  * @return [type]             [description]
	*/
	public function _set_additional( $field = null, $values=null  )  {
		if( !is_null($field) )
		{
			$this->_field_additional[$field] = $values;
		}	
	}

 	/**
  	* @param  [type] $CustomerId [description]
  	* @return [type]             [description]
  	*/
	public function _get_campaignId()  {
		if( $this->URI->_get_have_post('CampaignId'))  {
			$this->_campaignId = $this->URI->_get_post('CampaignId');
		}	
		return $this->_campaignId;
	}

	/**
	  * @param  [type] $CustomerId [description]
	  * @return [type]             [description]
	*/
	public function _set_campaignId( $CampaignId = null )  {
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
  	* @param  [type] $CustomerId [description]
  	* @return [type]             [description]
  	*/
	public function _get_recsource() {
		// then is not null get on by set recsource .
		if( !is_null( $this->_recsource ))	{
			 return $this->_recsource;
		}
		
		// get uri data process 
 		$url = UR();
 		if( $url->find_value( 'recsource' ) and $url->field( 'recsource' ) ){
	 		$this->_recsource = $url->field( 'recsource' );
 		}
 		return (string)$this->_recsource;
	}

 	/**
  	* @param  [type] $CustomerId [description]
  	* @return [type]             [description]
  	*/
 	public function _set_recsource( $recsource = null )  
	{
  		$this->url = UR();
 		// get on recsoure data stream on recsource  .
  		if( !is_null( $recsource ) ){
	  		$this->_recsource = $recsource;
  		}
  
  		if( is_null( $recsource )  and $this->url->find_value('recsource')  and $this->url->field('recsource') ) {
	   		$this->_recsource = $this->url->field('recsource');
 		}
  		return (string)$this->_recsource;
	}
	
	/**
  	* @param  [type] $CustomerId [description]
  	* @return [type]             [description]
  	*/	
  	public function _get_iswrite_bucket()
 	{ 
		$arr_template = array();
	 	$sql = sprintf("select a.TemplateBucket from t_gn_template a where a.TemplateTableName = '%s'", 
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
  	* @param  [type] $CustomerId [description]
  	* @return [type]             [description]
  	*/
	public function _set_uploadId( $_set_uploadId = 0 )  {
		if( $_set_uploadId )  {
			$this->_field_uploadId= $_set_uploadId;
		}	
	}

 	/**
  	* @param  [type] $CustomerId [description]
  	* @return [type]             [description]
  	*/
	public function _set_table( $table = null ){
		if( !is_null( $table ) ) {
			$this->_upload_table_name = $table;
	 	}
	}

 	/**
  	* @param  [type] $CustomerId [description]
  	* @return [type]             [description]
  	*/
	public function _get_is_complete(){
		return $this->_is_complete;
	}

 	/**
  	* @param  [type] $CustomerId [description]
  	* @return [type]             [description]
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
	
		// insert into here .	
		$this->db->reset_write();
		$this->db->set('prod_cust_id', $this->stm->field('CustomerId') );
		$this->db->set('prod_cust_cycledudate', $this->stm->field('Cycle_due_date'));
		$this->db->set('prod_cust_area', $this->stm->field('AREA2'));
		$this->db->set('prod_cust_npwp', $this->stm->field('NEED_NPWP1'));
		$this->db->set('prod_cust_occupation', $this->stm->field('Occupation'));
		$this->db->set('prod_cust_flagsfresh', $this->stm->field('flag_fresh'));
		$this->db->set('prod_cust_propensity', $this->stm->field('Propensity'));
		$this->db->set('prod_cust_created', $this->stm->field('upload_date'));
		$this->db->insert('t_gn_filter_product');
		return true;
 	}
 
 	/**
  	* @param  [type] $CustomerId [description]
  	* @return [type]             [description]
  	*/
 	private function _set_write_bucket()
	{
 		$error = null;
 		if( !is_array( $this->_upload_table_data ))  {
	 		return false;
 		}

 		// $stdClass = $this->_get_ProjectId();
	  	$array_assoc = array(
			'cardno'	 => 'Cardno',
			'custno'	 => 'Custno',
			'name' 		 => 'CustomerFirstName',
			'dob' 		 => 'CustomerDOB',
			'h_phone' 	 => 'CustomerHomePhoneNum',
			'o_phone' 	 => 'CustomerWorkPhoneNum',
			'mobile' 	 => 'CustomerMobilePhoneNum',
			'addr1' 	 => 'CustomerAddressLine1',
			'addr2' 	 => 'CustomerAddressLine2',
			'addr3' 	 => 'CustomerAddressLine3',
			'addr4' 	 => 'CustomerAddressLine4',
			'zip' 		 => 'CustomerZipCode',
			'sex' 		 => 'GenderId',
			'occupation' => 'Job_Title',
			'expire_dt'  => 'expired_date'
			// 'Expire_dt'  => 'expired_date'
		);
		
		// jika data berisi stream array maka process selanjutnya .
		// go to : 	
		if(is_array($this->_upload_table_data)) {
			foreach( $this->_upload_table_data as $n => $values )
			{
				$_array_select = null;

				$this->db->reset_write();
				foreach( $values as $field => $value ) {
					if( in_array(strtolower($field), array_keys($array_assoc) ) )  {
						$debug[] = strtolower($field);
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
				$insDispositionQry = $this->db->insert("t_gn_bucket_customers", $_array_select);
				if( !$insDispositionQry ) {
					$error[] = mysql_error();
				}
			}

			// jika error bukan null cetak datanya 
			if(!is_null($error)){
				print_r($error);
			}
		}
	} 

 	/**
  	* @param  [type] $CustomerId [description]
 	* @return [type]             [description]
  	*/
 	public function _set_content( $ar_items_source = null )
	{
  		if( !is_null($ar_items_source)  and  is_array($ar_items_source) ) {
			$this->_upload_table_data = $ar_items_source;
			$this->_tots_rowselect = count($ar_items_source);
			$this->_is_complete  = TRUE;
  		}
	}

 	/**
  	* @param  [type] $CustomerId [description]
  	* @return [type]             [description]
  	*/
 	protected function _set_assignment( $DebiturId = 0 , $AgentCode=null )
	{
		$this->cok = CK(); // get all session stream 
		$this->stm = Objective(array('DebiturId' => $DebiturId ));
	
		// default time define 
		// cek sebelum di process data ke table assigment 
		$conds  = FALSE;
	
		// cek sebelum di process data ke table assigment 
   		$this->stm->add("UserWriteDateTs", date('Y-m-d H:i:s'));
   		$this->stm->add("UserId", $this->cok->field('UserId'));
   		$this->stm->add("AdminId", 1);
   
  		// then 
  		if( $DebiturId and $this->cok->field('UserId') ) 
 		{
			$this->db->reset_write();  
			$this->db->set('CustomerId', $this->stm->field('DebiturId'));
			$this->db->set('AssignDate', $this->stm->field('UserWriteDateTs') );
			
			// switch case data case type 
			switch( $this->cok->field( 'HandlingType' ) ) {
				case USER_ROOT  :  
					$this->db->set('AssignAdmin', $this->stm->field('UserId') );  
				break;
				
				case USER_ADMIN :  
					$this->db->set('AssignAdmin', $this->stm->field('UserId')); 
				break;
				
				case USER_MANAGER :
					$this->db->set('AssignAdmin',$this->stm->field('AdminId'));
					$this->db->set('AssignMgr', $this->stm->field('UserId'));
				break;
			}
		
			// insert into 	"t_gn_assignment"
			$this->db->insert('t_gn_assignment');
			if( $this->db->affected_rows() > 0 ) {
		  		$this->stm->add('AssignId', $this->db->insert_id());
		  		$this->stm->add('StatusId', "DIS");
		  		$this->stm->add('TypedId', "ASSIGN.UPLOAD");
		  
				// then out here 
		  		$this->db->reset_write();
		  		$this->db->set('deb_id', $this->stm->field('DebiturId'));
		  		$this->db->set('assign_id', $this->stm->field('AssignId'));
		  		$this->db->set('assign_status', $this->stm->field('StatusId'));
		  		$this->db->set('assign_type',	 $this->stm->field('TypedId'));
		  		$this->db->set('assign_log_created_ts', $this->stm->field('UserWriteDateTs'));
		  		$this->db->insert('t_gn_assignment_log');
		  		if( $this->db->affected_rows() > 0 ) {
					$conds++;
		  		}
	 		}
   		}
		return (bool)$conds;
	}

 	/**
  	* @param  [type] $CustomerId [description]
  	* @return [type]             [description]
  	*/
	protected function _set_loan_tiering($loan_tiering = array(), $_cust_id = 0){
 		// print_r($loan_tiering);
 		$_set_loan_tiering = array();
 		$cardno = 0;
 		$tenor = 0;
  		foreach($loan_tiering as $key => $val){
			if(strtolower($key)=='cardno'){
				$cardno = $val;
			}else if(strtolower($key)!='cardno'){
				$tenor = explode("_",$key);
				if(end($tenor)==1){
					$_set_loan_tiering[$_cust_id][1]['cardno'] = $cardno;
					$_set_loan_tiering[$_cust_id][1][$tenor[0]] = str_replace(array(","),".",$val);
				}else if(end($tenor)==2){
					$_set_loan_tiering[$_cust_id][2]['cardno'] = $cardno;
					$_set_loan_tiering[$_cust_id][2][$tenor[0]] = str_replace(array(","),".",$val);
				}else if(end($tenor)==3){
					$_set_loan_tiering[$_cust_id][3]['cardno'] = $cardno;
					$_set_loan_tiering[$_cust_id][3][$tenor[0]] = str_replace(array(","),".",$val);
				}else{
					$_set_loan_tiering[$_cust_id][1][$tenor[0]] = str_replace(array(","),".",$val);
					$_set_loan_tiering[$_cust_id][2][$tenor[0]] = str_replace(array(","),".",$val);
					$_set_loan_tiering[$_cust_id][3][$tenor[0]] = str_replace(array(","),".",$val);
				}
			}
			$_set_loan_tiering[$_cust_id][1]['cardno'] = $cardno;
			$_set_loan_tiering[$_cust_id][2]['cardno'] = $cardno;
			$_set_loan_tiering[$_cust_id][3]['cardno'] = $cardno;
		}
		
		// echo "<pre>";
		// print_r($_set_loan_tiering);
		// echo "</pre>";

		foreach($_set_loan_tiering as $keys => $vals){
			foreach($vals as $key => $val){
				$this->db->reset_write();
				$this->db->set('CustomerId',$_cust_id);
				$this->db->set('Cardno', ($_set_loan_tiering[$keys][$key]['cardno'] !="" ? $this->replaceCarakter($_set_loan_tiering[$keys][$key]['cardno']):NULL) );
				$this->db->set('CampaignId',$this->_get_campaignId());
				$this->db->set('Tenor', ($_set_loan_tiering[$keys][$key]['tenor'] != "" ? $this->replaceCarakter($_set_loan_tiering[$keys][$key]['tenor']):NULL) );
				$this->db->set('LoanAmount', ($_set_loan_tiering[$keys][$key]['loan'] !="" ? round(str_replace(",",".",$this->replaceCarakter($_set_loan_tiering[$keys][$key]['loan']))):NULL) );
				$this->db->set('Installment',($_set_loan_tiering[$keys][$key]['installment'] !="" ? round(str_replace(",",".",$this->replaceCarakter($_set_loan_tiering[$keys][$key]['installment']))):NULL) );
				$this->db->set('Rate',($_set_loan_tiering[$keys][$key]['rate'] !="" ? $this->replaceCarakter($_set_loan_tiering[$keys][$key]['rate']):NULL) );
				$this->db->set('RateCode',($_set_loan_tiering[$keys][$key]['ratecode'] !="" ? $this->replaceCarakter($_set_loan_tiering[$keys][$key]['ratecode']):NULL) );
				$this->db->set('DisburseAmount',($_set_loan_tiering[$keys][$key]['topuplimit'] !=""? round(str_replace(",",".",$this->replaceCarakter($_set_loan_tiering[$keys][$key]['topuplimit']))):NULL) );
				$this->db->set('OutstandingTenor',($_set_loan_tiering[$keys][$key]['outstandingtenor'] !="" ? $this->replaceCarakter($_set_loan_tiering[$keys][$key]['outstandingtenor']):NULL) );
				$this->db->set('NeedNPWP',($_set_loan_tiering[$keys][$key]['neednpwp'] !="" ? $this->replaceCarakter($_set_loan_tiering[$keys][$key]['neednpwp']):NULL) );
				$this->db->set('PilProPremi',($_set_loan_tiering[$keys][$key]['pilpropremi'] !="" ? $this->replaceCarakter($_set_loan_tiering[$keys][$key]['pilpropremi']):NULL) );

				$total1 = $this->replaceCarakter($_set_loan_tiering[$keys][$key]['tenor']);
				$total2 = $this->replaceCarakter($_set_loan_tiering[$keys][$key]['outstandingtenor']);

				$this->db->set('TotalTenorNew',$total1+$total2);
				$this->db->set('UploadDate', date('Y-m-d H:i:s'));
				
				$this->db->insert('t_gn_loan_tiering');
				$debug_loan[] = $this->db->last_query();
				if( $this->db->affected_rows() > 0 ) {
				}
			}
		}
	}

 	/**
  	* @param  [type] $CustomerId [description]
  	* @return [type]             [description]
  	*/
	public function _set_process() {
 
		// ini_set('display_errors', 1);
		// ini_set('display_startup_errors',1);
		// error_reporting(E_ALL);

		// disini harus di cek terlebih dahulu , berdasrkan setting 
		// table "t_gn_template", apakah bernilai Y/N jika Y maka 
		// masukan data ke Bucket jika N tidak Perlu langsung ke table 
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
	  	$this->blk= Singgleton('M_MgtBlacklist');
	   
	 	// definisikan setiap field yang akan di masukan ke dalam table 
	 	// tujuan dalam [@array]. 
	 	// FORMAT : $array_assoc('index_array' => 'field db')
	  	$array_assoc = array(
			'custno'			=> 'CustomerNumber',
			'name'				=> 'CustomerFirstName',
			'dob'				=> 'CustomerDOB',
			'h_phone'			=> 'CustomerHomePhoneNum',
			'o_phone'			=> 'CustomerWorkPhoneNum',
			'mobile'			=> 'CustomerMobilePhoneNum',
			'addr1' 	 		=> 'CustomerAddressLine1',
			'addr2' 	 		=> 'CustomerAddressLine2',
			'addr3' 	 		=> 'CustomerAddressLine3',
			'addr4' 	 		=> 'CustomerAddressLine4',
			'sex'				=> 'GenderId',
			'occupation' 		=> 'Job_Title',
			// 'occu_complete' 	=> 'Job_Title',
			'expire_dt'			=> 'expired_date',
		
			/* TAMBAHAN VERIFIKASI */
		
			'card_expiry_date' 	=> 'card_exp',
			'flag_supplement' 	=> 'flag_suplement',
			'billing_address' 	=> 'billing_address',
			'cycle_due_date' 	=> 'cycle_due_date',
			//tambahan irul | for verification
			//'ssvno' 	 		=> 'pil_acc_no',
			//'old_instalment' 	=> 'monthly_installment',
			'count_of_supplement'=> 'count_of_supplement',
			'ori_loan_amt' 		 => 'ORI_LOAN_AMT',
			'old_instalment' 	 => 'Old_Instalment',
			'ssvno' 			 => 'SSVNO',
			'flag_type' 		 => 'flag_type'
			//tutup tambahan irul
		);
		
		// === loan tiering = ==			
	 	$array_loan_tiering = array(
			'ssvno'					=> 'Cardno',
			'tenor1'  				=> 'tenor_1',
			'tenor2'  				=> 'tenor_2',
			'tenor3' 			  	=> 'tenor_3',
			'total_loan_amount1'  	=> 'loan_1',
			'total_loan_amount2'  	=> 'loan_2',
			'total_loan_amount3'  	=> 'loan_3',
			'installment_amount1' 	=> 'installment_1',
			'installment_amount2' 	=> 'installment_2',
			'installment_amount3' 	=> 'installment_3',
			'topup_limit_06' 		=> 'topuplimit_1',
			'topup_limit_12' 		=> 'topuplimit_2',
			'topup_limit_18' 		=> 'topuplimit_3',
			'interest_rate_06' 		=> 'rate_1',
			'interest_rate_12' 		=> 'rate_2',
			'interest_rate_18' 		=> 'rate_3',
			'interest_cd_06' 		=> 'ratecode_1',
			'interest_cd_12' 		=> 'ratecode_2',
			'interest_cd_18' 		=> 'ratecode_3',
			'outstanding_tenor' 	=> 'outstandingtenor',
			'need_npwp1' 			=> 'neednpwp_1',
			'need_npwp2' 			=> 'neednpwp_2',
			'need_npwp3' 			=> 'neednpwp_3',
			'pil_pro_premi_1' 		=> 'pilpropremi_1',
			'pil_pro_premi_2' 		=> 'pilpropremi_2',
			'pil_pro_premi_3' 		=> 'pilpropremi_3' );
				
		
		// then next process 
	  	$error = NULL;
	  	$i 	= 0;
	  	$msg  = array();

	  	// start IF $this->_upload_table_data
	  	if(is_array($this->_upload_table_data)) {
		  	foreach( $this->_upload_table_data as $n => $value )
		 	{
				$i++;
				// konversi data ke lowercase 
				$values = array();
				if( is_array( $value ) ) foreach( $value as $key => $val ){
					$key_lower = strtolower( $key );
					$values[$key_lower] = $val;
				}
			
				// get refernece 
				$this->val = Objective( $values );

				/**
			 	 * value name
			 	 * value cusno
			 	 * value campaignID
			 	 * value invalid
			 	 */
			 	$msg_invalid1 = array(
			 		'name' 		=> $this->val->field('name'), 
			 		'cusno' 	=> $this->val->field('custno'), 
			 		'campaignId'=> $this->_getCampaignName($this->_campaignId)
			 	);
			
				// push data field additional testing 
				$this->val->add('UploadId', $this->_field_uploadId);
				$this->val->add('table',  't_gn_customer');
				$this->val->add('field',  'CustomerNumber');
				$this->val->add('xdays',  EXP_LIMIT_DATA);
			 
		   		// cek jika datayang di upload sudah expired jangan di masukan ke 
		   		// table customer 
		   		$checkFileDataExpired = FALSE;
				/*$checkFileDataExpired = $this->blk->_checkDispositionDataExpired(array(
					'expired_date' => $this->val->field('expire_dt')
				));*/
			 
			    /**
				 * jika data yang di upload ada dalam table blacklist maka data teresebut 
			     * akan di exlude atau di skip.
			     */	
				$checkBlacklist = $this->blk->_CheckBlacklist(array(
					'CIF' 		=> $this->val->field('custno'),
					'NAME' 		=> $this->val->field('name'),
					'UploadId' 	=> $this->val->field('UploadId')
				));
			
			  	/**
			   	* jika data dengan satus INC & TBO ada dalam database dan teridentifikasi 
			   	* dalam file upload maka data tersebut akan di exlude 
			  	* dan tidak dimasukan ke dalam database
			   	*/
			    $checkIncomingTbo = FALSE;
				/*$checkIncomingTbo = $this->blk->_CheckXDaysIncoming(array(
					'CIF'      => $this->val->field('custno'),
					'NAME'     => $this->val->field('name'),
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
					'CIF'      => $this->val->field('custno'),
					'NAME'     => $this->val->field('name'),
					'UploadId' => $this->val->field('UploadId'),
					'table'    => $this->val->field('table'),  
					'field'    => $this->val->field('field'), 
					'XDAYS'    => $this->val->field('xdays')
			  	));	*/

			  	/**
				 * jika ada data sebelumnya dangan status selain TBO, INC dan tidak expired
				 * maka data lama di update expired menjadi (today)-1.
				 */
				$checkNotIncomingTbo = $this->blk->_checkNotIncomingTbo(array(
					'CIF'       => trim($this->val->field('custno')),
					'CampaignId'=> $this->_campaignId
				));

				/**
			   	* jika data dengan satus INC & TBO ada dalam database dan teridentifikasi 
			   	* dalam file upload maka data tersebut akan di exlude 
			   	* dan tidak dimasukan ke dalam database
			   	*/
			   	$checkDataIncomingTbo = $this->blk->_checkDataIncomingTbo(array(
					'CIF'      => trim($this->val->field('custno'))
				));
			 
			 	/******************* SECTION VALIDATION ***********************/
		 		// jika duplikasi dengan data blacklist then total 
		  		if ( $checkFileDataExpired ){
		  			// $msg[$i]['data-expired'] = $values;
		  			$msg[$i] = array_merge($msg_invalid1, array('invalid'=>'data-expired') );
					$this->_tots_expired+=1;
					continue;
		  		}
		  
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
				if( is_array($values)) foreach( $values as $field => $value ){
					if( in_array(strtolower($field), array_keys($array_assoc) ) )  {
						$this->db->set($array_assoc[strtolower($field)], $this->_class_tools->setCallEvent($array_assoc[strtolower($field)],$value) );
					}
						
					if( in_array(strtolower($field), array_keys($array_loan_tiering) ) )  {
						$loan_tiering[$array_loan_tiering[strtolower($field)]] = $value;
					}
				}
			
		  		// generate auto number for set customer ID OR customernumber .
		  		// if exist then get on exist .
				#var_dump( $values );die();
				$callDisAutoID = $this->_gen_custno();
				$this->_recsource = $values['recsource'];
		 	
		 		// $this->db->set('CustomerNumber', $callDisAutoID);
				$this->db->set('Recsource', $this->_recsource);
				$this->db->set('CampaignId', $this->_campaignId);
				$this->db->set('UploadId', $this->_field_uploadId);
				$this->db->set('CustomerUploadedTs', date('Y-m-d H:i:s'));
				$this->db->set('Recsource_ftp', $this->_recsource_ftp);
				$this->db->insert("t_gn_customer", $_array_select);
				#var_dump( $this->db->last_query() );die();
				if( $this->db->affected_rows()>0 )
				{
					// get insert last id if exist .
					$callDispositionID = $this->db->insert_id();
					// set assigmnet data 
					$this->_set_assignment( $callDispositionID );
					// set loan tiering table 
					$this->_set_loan_tiering($loan_tiering, $callDispositionID);
					// tambahan table untuk process filter saja .
					$this->_set_write_filter( $values, $callDispositionID);
					
					
					if( !is_null($this->_upload_table_name) )
					{
						// echo "tiering on and on".$this->_upload_table_name;
						foreach( $values as $field => $value){
							$values[$field] = $this->_class_tools->setCallEvent($field, $value);
						}
						// push data tambahan 							
						$this->_set_additional("CustomerId", $callDispositionID);
						if( is_array($this->_field_additional)  and count($this->_field_additional)>0 ) {
							foreach( $this->_field_additional as $field => $value ){
								$values[$field] = $this->_class_tools->setCallEvent($field, $value);
							}
						}
						
						// print_r($values);
						$this->db->insert( $this->_upload_table_name, $values );
						if( $this->db->affected_rows()>0 ){
								$this->_tots_success+=1;
						} else{
							// $msg[$i]['data-failde'] = $values;
							$msg[$i] = array_merge($msg_invalid1, array('invalid'=>'data-failed') );
							$this->_tots_failed+=1;
						}
						// end process insert and other 
					} else{
						// $msg[$i]['data-failde'] = $values;
						$msg[$i] = array_merge($msg_invalid1, array('invalid'=>'data-failed') );
						$this->_tots_failed+=1;
					}
					// end insert table master
				}else{
					// $msg[$i]['data-failde'] = $values;
					$msg[$i] = array_merge($msg_invalid1, array('invalid'=>'data-failed') );
					$this->_tots_failed+=1;
				} // end insert customer 
		  	} // end foreach
		} // end IF $this->_upload_table_data
	 
	  	$params = array(
	  		'FTP_UploadId' => $this->_uploadid_ftp,
	  		'Data_Upload'  => $msg
	  	);
	  	$this->_setUploadInvalid( $params );

	}
	
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
			$this->num = str_pad( $this->max, 12, '0', STR_PAD_LEFT);
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
 

 	//******* END CLASSS *******
  	
}
?>