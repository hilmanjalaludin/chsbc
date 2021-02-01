<?php
class M_MgtBlacklist extends EUI_Model
{
	private static $instance = null;


	// @singgleton / public static instance
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
	public static function &instance(){
		if( is_null( self::$instance ) ){
			self::$instance = new self();
		}
		return 	self::$instance;
	} 

	// @singgleton / public static instance
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
	 function __construct() { }
 
 
	// @singgleton / public static instance
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
 	function _get_default()
	{
		$this->EUI_Page->_setPage(20); 
		$this->EUI_Page->_setSelect("a.Id");
		$this->EUI_Page->_setFrom("t_lk_blacklist a", TRUE);
		
		// --------- filter default  ----------------------------
		$this->EUI_Page->_setAndCache("a.Upload_Id", "blacklist_file", TRUE);
		$this->EUI_Page->_setLikeCache("a.CIF", "blacklist_id", TRUE);
		$this->EUI_Page->_setLikeCache("a.Customer_Name", "blacklist_name", TRUE);
		
		return $this->EUI_Page;
	}
	
	function _get_content()
	{
		$this->EUI_Page->_postPage(_get_post('v_page'));
		$this->EUI_Page->_setPage(20);
		$this->EUI_Page->_setArraySelect(array(
			"a.Id As Id" => array("Id","Id","primary"),
			"a.CIF as CIF" => array("CIF","ID Number"), 
			"a.Customer_Name as Customer_Name" => array("Customer_Name","Customer Name"), 
			"a.Upload_DateTs as Upload_DateTs" => array("Upload_DateTs","Upload Date"), 
			"b.full_name as Upload_ById" => array("Upload_ById","Upload By"), 
			"CASE WHEN (c.UploadId is not null) THEN c.UploadFileName ELSE '-' END as FileName" => array("FileName","File Name"), 
			
			/* xxxxxxxxxxxxxxxxxxxxx */
		));
		
		$this->EUI_Page->_setFrom("t_lk_blacklist a");
		$this->EUI_Page->_setJoin("t_gn_uploadreport c "," a.Upload_Id=c.UploadId", "LEFT");
		$this->EUI_Page->_setJoin("tms_agent b "," a.Upload_ById=b.UserId", "LEFT", true);
		
		// --------------- set data filtering -------------------------------------------
		$this->EUI_Page->_setAndCache("a.Upload_Id", "blacklist_file", TRUE);
		$this->EUI_Page->_setLikeCache("a.CIF", "blacklist_id", TRUE);
		$this->EUI_Page->_setLikeCache("a.Customer_Name", "blacklist_name", TRUE);

		// set order 
		if( _get_have_post('order_by')){ 
			$this->EUI_Page->_setOrderBy(_get_post('order_by'),_get_post('type'));
		} else {
			$this->EUI_Page->_setOrderBy('a.Id','ASC');	
		}	
		//echo $this->EUI_Page->_getCompiler();
		
		$this->EUI_Page->_setLimit();
	}
	
	function _get_resource()
	{
		self::_get_content();
		if( $this -> EUI_Page -> _get_query()!='')
		{
			//echo $this -> EUI_Page -> _get_query();
			return $this -> EUI_Page -> _result();
		}
	}
	
	function _get_page_number()
	{
		if( $this -> EUI_Page -> _get_query()!='' )
		{
			return $this -> EUI_Page -> _getNo();
		}
	}
	
	function _get_file_name()
	{
		$datas = array();
		
		$sql = "select UploadId,UploadFileName from t_gn_uploadreport where UploadId<>1 and TotalSuccessRows>0 order by UploadDateTs DESC";
		$qry = $this->db->query($sql);
		
		$datas[1] = 'INPUT MANUAL';
		if($qry->num_rows()>0)
		{
			foreach($qry->result_assoc() as $rows)
			{
				$datas[$rows['UploadId']] = $rows['UploadFileName'];
			}
		}
		
		return $datas;
	}
	
	function _SaveInput($param)
	{
		$_conds = false;
		
		$this->db->insert('t_lk_blacklist',array(
			'CIF' 			=> $param['id_number'],
			'Customer_Name' => $param['cust_name'],
			'Upload_DateTs' => date('Y-m-d H:i:s'),
			'Upload_ById' 	=> _get_session('UserId'),
			'Upload_Id' 	=> 1,
		));
		
		if($this->db->affected_rows()>0)
		{
			$_conds = true;
		}
		
		return $_conds;
	}
	
	/* FUNCTION OF BLACKLIST && X-DAYS */
	function _CheckBlacklist($param)
	{
		$conds = false;
		
		$sql = "select Id from t_lk_blacklist where CIF='".$param['CIF']."'";
		$qry = $this->db->query($sql);
		#var_dump( $this->db->last_query() ); die();
		#var_dump( $param ); die();
		
		if($qry->num_rows()>0)
		{
			$this->db->insert('t_gn_blacklist_trx',array(
				'CIF' 			=> $param['CIF'],
				'Customer_Name' => $param['NAME'],
				'Upload_DateTs' => date('Y-m-d H:i:s'),
				'Upload_ById' 	=> _get_session('UserId'),
				'Upload_Id' 	=> $param['UploadId'],
				'Upload_Notes' 	=> 'BLOCKING CUSTOMER',
			));
			
			$conds=true;
		}
		
		return $conds;
	}
	
	function _CheckXDays($param)
	{
		$conds = false;

		$cond  = "";
		$cond0 = $param['field']. " as `primary` ";
		$cond1 = " DATEDIFF(DATE(NOW()),max(b.CustomerUploadedTs)) as last_days ";
		$cond2 = " group by a.".$param['field'];
		$cond3 = " having 1=1 AND last_days < ".$param['XDAYS'];
		if( QUERY == 'mssql') {
			$cond = "b.CustomerNumber, ";
			$cond0 = $param['field']. " as 'primary' ";
			$cond1 = " DATEDIFF(day, CONVERT(varchar, getdate(),120) ,max(b.CustomerUploadedTs) ) as last_days ";
			$cond2 = " group by b.CustomerNumber, a.".$param['field'];
			$cond3 = " HAVING DATEDIFF(day, CONVERT(varchar, getdate(),120) ,max(b.CustomerUploadedTs) ) <= ".$param['XDAYS'];
		}

		$sql = "select
					{$cond} 
					a.{$cond0}, 
					count(a.".$param['field'].") as total, 
					max(b.CustomerUploadedTs) as last_upload, 
					{$cond1} 
				from ".$param['table']." a 
				left join t_gn_customer b on a.CustomerId = b.CustomerId
				where a.".$param['field']." = '".$param['CIF']."'
				{$cond2}
				{$cond3}";
		$qry = $this->db->query($sql);
		// echo $sql;
		if($qry->num_rows()>0)
		{
			$row = $qry->result_assoc();
			
			$this->db->insert('t_gn_blacklist_trx',array(
				'CIF' => $param['CIF'],
				'Customer_Name' => $param['NAME'],
				'Upload_DateTs' => date('Y-m-d H:i:s'),
				'Upload_ById' 	=> _get_session('UserId'),
				'Upload_Id' 	=> $param['UploadId'],
				'Upload_Notes' 	=> 'BLOCKING XDAYS, LAST UPLOAD : '.$row[0]['last_upload'],
			));
			
			$conds=true;
		}
		
		return $conds;
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
	 
	 // $row = $qry->result_assoc();
	 // $this->db->insert('t_gn_blacklist_trx',array(
	 // 'CIF' 			=> $param['CIF'],
	 // 'Customer_Name' => $row[0]['CustomerFirstName'],
	 // 'Upload_DateTs' => date('Y-m-d H:i:s'),
	 // 'Upload_ById' 	=> _get_session('UserId'),
	 // 'Upload_Id' 	=> $param['UploadId'],
	 // 'Upload_Notes' 	=> 'BLOCKING INCOMING, LAST INCOMING : '.$row[0]['last_upload'],
	 // ));
	 // $conds=true;
	function _CheckXDaysIncoming( $val = null  )
	{
		//print_r($val);
		// nilaiu kondisi awal 
	 	$this->con = 0;
		// push data tambhan untuk mempermudah process 
		// filter ke databas -nya 
	  	$this->cok = CK();	
	  	$this->val = Objective( $val );
	  
		// additional field && biar seragam aja .
		#$this->val->add("CallReasonId",   array( TBO, INC ));
		$this->val->add("CallReasonId",   array( 12, 13 ));
	  	$this->val->add("CustomerNumber", $this->val->field('CIF') );
	  	$this->val->add("CustomerXday",   $this->val->field('XDAYS') );
	  
	  	$cond1 = " b.CustomerNumber as `primary`, ";
	  	$cond2 = " DATEDIFF(DATE(NOW()),max(b.CustomerUpdatedTs)) as last_days ";
	  	$cond3 = " GROUP BY b.CustomerNumber ";
		$cond4 = " HAVING 1=1  AND last_days <= ";
		if( QUERY == 'mssql') {
			$cond1 = " b.CustomerNumber, b.CustomerNumber AS 'primary', ";
	  		$cond2 = " DATEDIFF(day, CONVERT(varchar, getdate(),120) ,max(b.CustomerUpdatedTs) ) as last_days ";
	  		$cond3 = " GROUP BY b.CustomerNumber, b.CustomerFirstName ";
	  		$cond4 = " HAVING DATEDIFF(day, CONVERT(varchar, getdate(),120) ,max(b.CustomerUpdatedTs) ) <= ";
		}
		  
	   	// process data query disini ya 	
	  	$sql = sprintf("SELECT {$cond1}
					  COUNT(b.CustomerNumber) as total, b.CustomerFirstName,
					  MAX(b.CustomerUpdatedTs) as last_upload,
					  {$cond2}
					  FROM t_gn_customer b
					  WHERE b.CustomerNumber = '%s'
					  AND b.CallReasonId IN(%s)
					  {$cond3}
					  {$cond4}%d", 
				$this->val->field('CustomerNumber'), 
				$this->val->field('CallReasonId', array('ArrImplode')),  
				$this->val->field('CustomerXday'));
		#echo $sql; die();
		
		// process query && data recsource .
	 	$qry = $this->db->query( $sql );
	  	if( $qry && $qry->num_rows()>0 ) {
		  
			// ambil data object pertama by record selector 
			// on driver class . dan jika datatersebut masukan ke table transaksi baclist sebagai 
			// reference .
			$this->row = $qry->result_first_record();
			if( $this->row->find_value( 'CustomerFirstName' ) ) {
			
				// additional data field from recsource .
				$this->row->add('Upload_ById',   $this->cok->field('UserId') );
				$this->row->add('Upload_Custno', $this->val->field('CustomerNumber'));
				$this->row->add('Upload_Id', 	 $this->val->field('UploadId'));
				$this->row->add('Upload_Notes',  sprintf("BLOCKING INCOMING, LAST INCOMING : %s", $this->row->field('last_upload') ));
				$this->row->add('Upload_DateTs', date('Y-m-d H:i:s'));
				
				// insert data to table 
				$this->db->reset_write();
				$this->db->set('CIF', 			 $this->row->field('Upload_Custno'));
				$this->db->set('Customer_Name',  $this->row->field('CustomerFirstName') );
				$this->db->set('Upload_DateTs',  $this->row->field('Upload_DateTs'));
				$this->db->set('Upload_ById',    $this->row->field('Upload_ById'));
				$this->db->set('Upload_Id', 	 $this->row->field('Upload_Id'));
				$this->db->set('Upload_Notes', 	 $this->row->field('Upload_Notes'));
			
				$this->db->insert("t_gn_blacklist_trx");
				// then will result 
				$this->con+=1;
			}
	   	}

	  	// return $conds;
	   	return $this->con;
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
	function _checkDispositionData( $val = null  )
	{
		$cond1 = " DATE(NOW()) ";
		$cond2 = " DATE_FORMAT((CURDATE()-1),'%%Y-%%m-%%d')  ";
		if( QUERY == 'mssql') {
			$cond1 = " CONVERT(varchar, getdate(),23) ";
			$cond2 = " CONVERT(varchar, GETDATE()-1,23) ";
		}
		$this->tot = 0;

		// additional data process
		$this->prv = _getPrevDate(date('Y-m-d'), -1 );
		$this->val = Objective( $val );
		
		// this set on here .
		if( !$this->val->find_value('CIF') ){
			return false;
		}
		
		// additional data process
		#$this->val->add('CallReasonId', array(WN,MV,BT,ID,NPU));
		$this->val->add('CallReasonId', array(7,3,5,4,6));
		$this->val->add('CustomerNumber', $this->val->field('CIF'));
		
		//CallReasonId
		
		$sql = sprintf("select count(a.CustomerId) as total from t_gn_customer a 
						where a.CustomerNumber = '%s' 
						and a.expired_date >= {$cond1}
						and a.CallReasonId IN(%s)", 
						  $this->val->field('CustomerNumber', array('trim')),  
						  $this->val->field('CallReasonId', array('ArrImplode')));
								
		$qry = $this->db->query( $sql );
		#var_dump( $this->db->last_query() );die();
		if( $qry && $qry->num_rows() > 0 ) {
			$this->tot = (int)$qry->result_singgle_value();
		}
		
		// jika memang ada data tersebut maka lakukan update saja expired - nya menjad today -1  
		// status WN, BT, ID, NPU
		if( $this->tot > 0 ) {
			$sql = sprintf("update t_gn_customer
							set expired_date = {$cond2}
							where CustomerNumber ='%s'  and CallReasonId IN(%s) ", 
							$this->val->field('CustomerNumber', array('trim')),
							$this->val->field('CallReasonId', array('ArrImplode')) );
							
			$this->db->query( $sql );
			#var_dump( $this->db->last_query() );die();
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
	function _checkDispositionDataExpired( $stream = null ) {
		if( is_null($stream) OR !is_array($stream) ){  
			return FALSE; 
	 	}
	 	
	 	// on stream processing 
	 	$this->stream = Objective( $stream );
	 	if( $this->stream->find_value( 'expired_date' ) ){
		 	$expired_date = date('Y-m-d', $this->stream->field('expired_date', 'strtotime') );
		 	if( strtotime( $expired_date ) < strtotime( date('Y-m-d') )  ){
				return TRUE;
		 	}
	 	}
	 	return FALSE;
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
 	function _checkDispositionNotExpired( $val = null )
	{
		$cond1 = " DATE(NOW()) ";
		if( QUERY == 'mssql') {
			$cond1 = " CONVERT(varchar, getdate(),23) ";
		}
		$this->tot = 0;
	
		// additional data process
		$this->prv = _getPrevDate(date('Y-m-d'), -1 );
		$this->val = Objective( $val );
	
		// this set on here .
		if( !$this->val->find_value('CIF') ){
			return false;
		}
	
		// additional data process
		// $this->val->add('CallReasonId', array(WN,MV,BT,ID,NPU, INC,TBO));
		$this->val->add('CallReasonId', array(7,3,5,4,6,13,12));
		$this->val->add('CustomerNumber', $this->val->field('CIF'));
	
		//CallReasonId
		$sql = sprintf("select count(a.CustomerId) as total from t_gn_customer a 
					where a.CustomerNumber = '%s' 
					and a.expired_date>=  {$cond1} and a.CallReasonId NOT IN(%s)", 
					$this->val->field('CustomerNumber', array('trim')),  
					$this->val->field('CallReasonId', array('ArrImplode')));
		//echo $sql;
		$qry = $this->db->query( $sql );
		if( $qry && $qry->num_rows() > 0 ) {
			$this->tot = (int)$qry->result_singgle_value();
		}
		return (  $this->tot ? true  : false );
	}

	/**
	 * @author Budi
	 * (F) _checkNotIncomingTbo description]
	 * 
	 * @param   Array 	$val
	 * @return  Boolean	$result
	 */
	function _checkNotIncomingTbo( $val = null  )
	{
		$result = FALSE;
		$cond1 = " DATE(NOW()) ";
		$cond2 = " DATE_FORMAT((CURDATE()-1),'%%Y-%%m-%%d')  ";
		if( QUERY == 'mssql') {
			$cond1 = " CONVERT(varchar, getdate(),23) ";
			$cond2 = " CONVERT(varchar, GETDATE()-1,23) ";
		}
		$this->tot = 0;

		// additional data process
		$this->prv = _getPrevDate(date('Y-m-d'), -1 );
		$this->val = Objective( $val );
		
		// this set on here .
		if( !$this->val->find_value('CIF') ){
			return $result;
		}
		
		// additional data process | TBO, INC
		$this->val->add("CallReasonId",   array(12,13));
		$this->val->add('CustomerNumber', $this->val->field('CIF'));
		$sql = sprintf("select a.CustomerId, a.expired_date from t_gn_customer a 
						where a.CustomerNumber = '%s'
						and a.CampaignId = '%s'
						and a.expired_date >= '%s'
						and a.CallReasonId NOT IN(%s) ORDER BY a.expired_date DESC", 
						  $this->val->field('CustomerNumber', array('trim')),
						  $this->val->field('CampaignId', array('trim')),
						  date('Y-m-d'),
						  $this->val->field('CallReasonId', array('ArrImplode')));
		$qry = $this->db->query( $sql );
		#var_dump( $this->db->last_query() );die();

		if( $qry && $qry->num_rows() > 0 ) {
			$this->tot = $qry->result_array(); 
		}
		
		// jika memang ada data tersebut maka lakukan update saja expired - nya menjad today -1  
		// status Not In TBO, INC
		if( count($this->tot) > 0 ) {
			/*$sql = sprintf("update t_gn_customer
							set expired_date = {$cond2}
							where CustomerId ='%s'", 
							@$this->tot['CustomerId']);
							
			$this->db->query( $sql );*/
			foreach ( $this->tot as $value) {
				$sql = sprintf("update t_gn_customer
								set expired_date = {$cond2}
								where CustomerId ='%s'", 
								@$value['CustomerId']);
								
				$this->db->query( $sql );
			}
			#var_dump( $this->db->last_query() );die();
			$result = TRUE;	
		}
		return $result;
		
	} 
	
	/**
	 * @author Budi
	 * (F) _checkDataIncomingTbo
	 * 
	 * @param  Array 	$val
	 * @return Int	$result
	 */
	function _checkDataIncomingTbo( $val = null )
	{
		$result = 0;
		
		// this set on here .
		if( !$this->val->find_value('CIF') ){
			return $result;
		}
		
		// additional data process | TBO, INC
		$this->val->add("CallReasonId",   array(12,13));
		$this->val->add('CustomerNumber', $this->val->field('CIF'));
		$sql = sprintf("select a.CustomerId, a.expired_date, a.CallReasonId from t_gn_customer a 
						where a.CustomerNumber = '%s'
						and a.CampaignId = '%s'
						and a.CallReasonId IN(%s) ORDER BY a.expired_date DESC", 
						$this->val->field('CustomerNumber', array('trim')),
						$this->val->field('CampaignId', array('trim')),
						$this->val->field('CallReasonId', array('ArrImplode')));
		$qry = $this->db->query( $sql );
		#var_dump( $this->db->last_query() );die();

		if( $qry && $qry->num_rows() > 0 ) {
			$data  = $qry->row_array(); 
			$result= (int)$data['CallReasonId'];	
		}		
		return $result;
	}
	// ========= END CLASS 	===================
}
?>