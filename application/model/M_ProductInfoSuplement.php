<?php 
class M_ProductInfoSuplement extends EUI_Model
{
	private static $Instance = null;
	var $income_reason = array();
	public static function & Instance(){
		if( is_null(self::$Instance)){
			self::$Instance = new self();
		}
		return self::$Instance;
	}

	function __construct(){
		$this->load->model(array('M_ProductForm','M_SysUser'));
		$this->income_reason = array(
			'Fix'=>'Outbound Income Update Recorded',
			'Range'=>'Range',
			'HouseWife'=>'Outbound Recorded - Housewife'
		);
    }
    
    public function getIdentificationType() {
        $sql = 'SELECT * FROM t_lk_identificationtype WHERE flag=1';
        $qry = $this->db->query($sql);
        return $qry->result_assoc();      
    }

    public function getSalutation() {
        $sql = 'SELECT * FROM t_lk_salutation WHERE flag=1';
        $qry = $this->db->query($sql);
        return $qry->result_assoc();
    }

    public function getGender() {
        $sql = 'SELECT * FROM t_lk_gender';
        $qry = $this->db->query($sql);
        return $qry->result_assoc();
    }

    public function getMaritalStatus() {
        $sql = 'SELECT * FROM t_lk_maritalstatus WHERE  flag=1';
        $qry = $this->db->query($sql);
        return $qry->result_assoc();
    }

    public function getOccupation() {
        $sql = 'SELECT *FROM t_lk_occupation WHERE flag=1';
        $qry = $this->db->query($sql);
        return $qry->result_assoc();
    }

    public function getRelationship() {
        $sql = 'SELECT *FROM t_lk_relationshiptype WHERE RelationshipTypeFlags=1';
        $qry = $this->db->query($sql);
        return $qry->result_assoc();
    }

    public function getCountry() {
        $sql = 'SELECT *FROM t_lk_country WHERE CountryFlagStatus=1';
        $qry = $this->db->query($sql);
        return $qry->result_assoc();
    }

    public function getArea() {
        $sql = 'SELECT *FROM t_lk_area WHERE flag=1';
        $qry = $this->db->query($sql);
        return $qry->result_assoc();
    }
	
	function _get_list_suplement_product(){
		$_datap = array();
		$sql = "SELECT distinct Product FROM t_lk_product_best_bill";
		$qry = $this->db->query($sql);

		#var_dump( $this->db->last_query() );die();
		foreach( $qry -> result_assoc() as $rows ) {
			$_datap[$rows['Product']] = $rows['Product'];
		}
		return $_datap;
	}
	
	function _get_list_suplement_jenis_jasa($suplement_product){
		$_datap = array();
		$sql = "SELECT distinct JenisJasa FROM t_lk_product_best_bill WHERE Product = '".$suplement_product."'";
		$qry = $this->db->query($sql);

		// var_dump( $this->db->last_query() );die();
		foreach( $qry -> result_assoc() as $rows ) {
			$_datap[$rows['JenisJasa']] = $rows['JenisJasa'];
		}
		return $_datap;
	}
	
	function _get_list_suplement_prefix($suplement_product, $jenis_jasa){
		$_datap = array();
		$sql = "SELECT distinct Prefix FROM t_lk_product_best_bill WHERE Product = '".$suplement_product."' AND JenisJasa = '".$jenis_jasa."'";
		$qry = $this->db->query($sql);

		// var_dump( $this->db->last_query() );die();
		foreach( $qry -> result_assoc() as $rows ) {
			$_datap[$rows['Prefix']] = $rows['Prefix'];
		}
		return $_datap;
	}
	
	function _get_suplement_nopel_validity($suplement_product, $jenis_jasa, $prefix){
		$_datap = array();
		if($suplement_product == "PLN"){
			$sql = "SELECT distinct Nopelvalidity FROM t_lk_product_best_bill WHERE Product = '".$suplement_product."'";
		}else{
			$sql = "SELECT distinct Nopelvalidity FROM t_lk_product_best_bill WHERE Product = '".$suplement_product."'";
			if($jenis_jasa){
				$sql .= "AND JenisJasa = '".$jenis_jasa."'";
			}else{
				$sql .= "AND JenisJasa is NULL";
			}
			if($prefix){
				$sql .= "AND Prefix = '".$prefix."'";
			}else{
				$sql .= "AND Prefix is NULL";
			}
		}
		
		$qry = $this->db->query($sql);
		// var_dump( $this->db->last_query() );die();
		foreach( $qry -> result_assoc() as $rows ) {
			$_datap['Nopelvalidity'] = $rows['Nopelvalidity'];
		}
		return $_datap;
	}
	
	function _set_deleteSuplement($Customer, $Id){
		$_datap['delete'] = 0;
		$sql = "DELETE FROM t_gn_frm_suplement WHERE CustomerId = ".$Customer." AND Id = ".$Id;
		$qry = $this->db->query($sql);

		// var_dump( $this->db->last_query() );die();
		if( $this->db->affected_rows() > 0 ){
			$_datap['delete'] = 1;
		}
		return $_datap;
	}
	
	function getSuplementById($supId) {
		$sql = "SELECT * FROM t_gn_frm_suplement WHERE Id = ".$supId;
		$qry = $this->db->query($sql)->row_array();
		$res = array(
			'data' => $qry
		);
		return $res;
	}
	
	/* OLD QUARY */
	
	/**
	 * (F) _get_data_form description]
	 * @param  Int $_cust_id
	 * query-mssql	[OK]
	 */
	function _get_data_form($_cust_id)
	{
		$_datas = array();
		
		$sql = "SELECT a.*, b.Recsource FROM t_gn_attr_suplement a
				left join t_gn_customer b ON a.CustomerId = b.CustomerId
				left join t_gn_frm_suplement c on c.CustomerId = b.CustomerId	
				WHERE a.CustomerId = '".$_cust_id."'";
				
		$qry = $this->db->query($sql);
		
		// var_dump($this->db->last_query());die();
		if($qry->num_rows()>0)
		{
			$_datas = $qry->result_first_assoc();
		}
		
		return $_datas;
	}
	
	function _get_ver_result($_cust_id)
	{
		$_datas = array();
		// SELECT a.ver_result from t_gn_ver_result a WHERE a.cust_id = '890394'
		$sql = "SELECT a.ver_result from t_gn_ver_status a
				WHERE a.cust_id = '".$_cust_id."'";
				
		$qry = $this->db->query($sql);
		
		// echo $sql;
		// var_dump($this->db->last_query()); //die();
		if($qry->num_rows()>0){
			$_datas = $qry->result_first_assoc();
		}else{
			$_datas = array("ver_result"=>0);
		}
		// var_dump($_datas);
		return $_datas;
	}
	
	function _get_data_inc_frm($_cust_id)
	{
		$_datas = array();
		$sql = "SELECT TOP 3 a.Id, a.fullname, a.gender, a.mobilePhoneNo, a.CustomerId,a.Custno FROM t_gn_frm_suplement a WHERE a.CustomerId = ".$_cust_id;
		$qry = $this->db->query($sql);
		
		// var_dump($sql);
		// die();
		// var_dump($this->db->last_query());die();
		foreach( $qry -> result_assoc() as $rows ) {
			$_datas[$rows['Id']] = $rows;
		}
		
		return $_datas;
	}
	
	/**
	 * (F) _get_data_loans description]
	 * @param  Int $custid
	 * @param  Int $tenor
	 * query-mssql [OK]
	 */
	function _get_data_loans($custid, $tenor = NULL){
		$_datap = array();
		//$sql = "select * from t_gn_loan_tiering a where a.CustomerId = '".$custid."'";
		//edit irul - jika loanamount nya 0 maka tidak tampil di product info
		$sql = "select * from t_gn_loan_tiering a where a.CustomerId = '".$custid."' AND a.LoanAmount>0";
		//tutup edit irul
		if($tenor!=NULL){
			$sql.=" AND a.Tenor=".$tenor;
		}
		$qry = $this->db->query($sql);

		#var_dump( $this->db->last_query() );die();
		foreach( $qry -> result_assoc() as $rows ) {
			$_datap[$rows['Tenor']]['LoanAmount'] = $rows['LoanAmount'];
			$_datap[$rows['Tenor']]['Installment'] = $rows['Installment'];
			$_datap[$rows['Tenor']]['Rate'] = $rows['Rate'];
			$_datap[$rows['Tenor']]['AdminFee'] = $rows['AdminFee'];
			$_datap[$rows['Tenor']]['DisburseAmount'] = $rows['DisburseAmount'];
			$_datap[$rows['Tenor']]['Tenor'] = $rows['Tenor'];
			$_datap[$rows['Tenor']]['CustomerId'] = $rows['CustomerId'];
		}
		return $_datap;
	}
	
	function _get_list_bank(){
		$_datap = array();
		$sql = "select * from t_lk_bank a";
		if($tenor!=NULL){
			$sql.=" WHERE a.Tenor=".$tenor;
		}
		$qry = $this->db->query($sql);

		#var_dump( $this->db->last_query() );die();
		foreach( $qry -> result_assoc() as $rows ) {
			$_datap[$rows['BankId']] = $rows['BankName'];
		}
		return $_datap;
	}
	
	function _select_personal_premi( $arr_cond = array() ){
		$out = new EUI_Object( $arr_cond );
		$totals = array( 'ProductPlanId' => 0, 'ProductPlanPremium' => 0);
		
		$this->db->reset_select();
		$this->db->select('a.ProductPlanId, a.ProductPlanPremium');
		$this->db->from('t_gn_productplan a');
		
	// --------- ProductId  --------------		
		// $this->db->where('a.ProductId', $out->get_value('ProductId','intval'), FALSE);
		$this->db->where('a.PremiumGroupId', $out->get_value('Coverage','intval'), FALSE);
		// $this->db->where('a.PayModeId', $out->get_value('PayMode','intval'), FALSE);
		$this->db->where('a.ProductPlan', $out->get_value('Plan','intval'), FALSE);
		// $this->db->where('a.GenderId', $out->get_value('GenderId','intval'), FALSE);
		// $this->db->where('a.PremiTypeId', $out->get_value('PremiTypeId','intval'), FALSE);
		if($out->get_value('premiAge','intval')!="child"){
			$this->db->where("{$out->get_value('premiAge','intval')} BETWEEN a.ProductPlanAgeStart AND a.ProductPlanAgeEnd", NULL , FALSE);
		}
		
		
		$rs = $this->db->get();
		// echo $this->db->last_query();
		 if( $rs->num_rows() == 1 )
		{
			return (array)$rs->result_first_assoc();
		} 	
		
		return new EUI_Object($totals);
	}
	
	public function _set_row_edit_suplement($out=null) {
		// echo "test";
		// echo "<pre>";
		// var_dump($out);
		// die;
		if( !$out->fetch_ready() OR !_get_is_login() ){
			return (bool)FALSE;
		}
		
			$this->db->reset_write();
			// $this->db->set('CustomerId'	,$out->get_value('CustomerId','intval'));
			// $this->db->set('tnc'	,'YES');
			// $this->db->set('Custno'		,$out->get_value('CUSTNO1','strtoupper')); 
			// $this->db->set('Acct'		,$out->get_value('Accno','strtoupper'));
			// $this->db->set('Cardno'		,$out->get_value('cardno','strtoupper')); 
			// $this->db->set('UserId'		,$out->get_value('UserId','strtoupper')); 
			// $this->db->set('Recsource'		,$out->get_value('Recsource','strtoupper')); 
		   
			$this->db->set('identificationType'	,$out->get_value('identificationType','strtoupper')); 
			$this->db->set('NoIdentificationType'	,$out->get_value('NoIdentificationType','strtoupper')); 
			$this->db->set('salutation'	,$out->get_value('salutation','strtoupper'));
			$this->db->set('namaDepan'	,$out->get_value('namaDepan','strtoupper'));
			$this->db->set('namaTengah'		,$out->get_value('namaTengah','strtoupper'));
			$this->db->set('namaBelakang'		,$out->get_value('namaBelakang','strtoupper'));
			$this->db->set('fullname'			,$out->get_value('fullname','strtoupper'));
			$this->db->set('nameOnCard'		,$out->get_value('nameOnCard','strtoupper'));
			$this->db->set('formerName'			,$out->get_value('formerName'));
			$this->db->set('gender'		,$out->get_value('gender'));
			$this->db->set('pob'			,$out->get_value('pob'));
			$this->db->set('dob'				,$out->get_value('dob'));
			$this->db->set('maritalStatus'		,$out->get_value('maritalStatus'));
			$this->db->set('mmn'		,$out->get_value('mmn'));
			$this->db->set('occupation'	,$out->get_value('occupation'));
			$this->db->set('addressSuplement'	,$out->get_value('addressSuplement'));
			$this->db->set('relationship'	,$out->get_value('relationship'));
			$this->db->set('nationality'	,$out->get_value('nationality'));
			$this->db->set('cob'	,$out->get_value('cob'));
			$this->db->set('idPlaceIssued'	,$out->get_value('idPlaceIssued'));
			$this->db->set('idDateIssued'	,$out->get_value('idDateIssued'));
			$this->db->set('idExpiredDate'	,$out->get_value('idExpiredDate'));
			$this->db->set('mobilePhoneNo'	,$out->get_value('mobilePhoneNo'));
			$this->db->set('residentPhone'	,$out->get_value('residentPhone'));
			$this->db->set('email'	,$out->get_value('email'));
			$this->db->set('residentArea'	,$out->get_value('residentArea'));
			
			// $this->db->set("CreateExportTs"		,date('Y-m-d H:i:s'));
			$this->db->set("UpdateExportTs"		,date('Y-m-d H:i:s'));

			$this->db->where('Id',$out->get_value('Id'));
			$this->db->update('t_gn_frm_suplement');
			// var_dump($this->db->last_query());die;
			
			if( $this->db->affected_rows() > 0 ){
				return (bool)TRUE;
			}else{
				return false;
			}
	   
    }
	public function _set_row_save_suplement($out=null) {
		if( !$out->fetch_ready() OR !_get_is_login() ){
			return (bool)FALSE;
		}
	

		$check = "select count(a.CustomerId) AS totaldata from t_gn_frm_suplement a
		WHERE a.CustomerId=".$out->get_value('CustomerId');
		$data = $this->db->query($check)->result_assoc();
		// var_dump($data[0]['totaldata']);
		// die;
		if( $data[0]['totaldata'] >= 3 ){
			// echo "lebih dari 3";
			// return (bool)FALSE;
			
			return (bool)false;
		}else {
			//  echo "kurang dari 3";
		
	

		// $tenor = $out->get_value('key_tenor','intval');
		// $loans = $this->_get_data_loans($out->get_value('CustomerId','intval'),$out->get_value('key_tenor','intval'));
		// $obloans =new EUI_Object($loans);
		// $loan = ($out->get_value('vartiering','intval')>0?(($loans[$tenor]['LoanAmount']*$out->get_value('vartiering','intval'))/100):$loans[$tenor]['LoanAmount']);
        // echo "halo <br>";
        // var_dump($out->get_value('addressQuestion'));
        // var_dump($out->get_value('addressSuplement'));
        // var_dump($out);
        // die;
        
        // ini cari tau
        //  $customer = $this->_get_data_form($out->get_value('CustomerId','intval'));
		
		//  var_dump($out->get_value('CustomerId'));
		//  die;
		// $obcustomer =new EUI_Object($customer);
		// $obOut   =& get_class_instance('M_SysUser');
		// $obUsr   =& Objective($obOut->_getUserDetail(_get_session('UserId')));
		
		// $tanggal = date("j");
		// $tahun = date("Y");
		// if($tanggal>25){
		// 	$time = strtotime(date("Y/m/d"));
		// 	$bulan = date("m", strtotime("+2 month", $time));
		// }else{
		// 	$time = strtotime(date("Y/m/d"));
		// 	$bulan = date("m", strtotime("+1 month", $time));
		// }
		// $TGLEFECTIF = '01'.$bulan.$tahun;
		// $obnpwp = $obcustomer->get_value('NEED_NPWP_PIL');
		
		// $NPWP = "YES";
		// if($obnpwp=="Sudah Punya NPWP" OR $obnpwp=="Sudah Punya NPWP SID"){
			// $NPWP = 'Y';
		// }else if($obnpwp=="Belum Punya NPWP"){
			// $NPWP = 'N';
		// }
		
		// print_r($out);echo $out->get_value('benefaccount','intval');
		// print_r($customer);
		// echo $out->get_value('CustomerId','intval'); echo "<br>";
		// var_dump($obUsr);
		
		 $data = array( 
						'islower'=>'1' 
						);
		$this->db->where('CustomerId', $out->get_value('CustomerId','intval'));
		$this->db->update('t_gn_customer', $data);
        

		$this->db->reset_write();
		$this->db->set('CustomerId'	,$out->get_value('CustomerId','intval'));
		$this->db->set('tnc'	,'YES');
		$this->db->set('Custno'		,$out->get_value('CUSTNO1','strtoupper')); 
		$this->db->set('Acct'		,$out->get_value('Accno','strtoupper'));
        $this->db->set('Cardno'		,$out->get_value('cardno','strtoupper')); 
        $this->db->set('UserId'		,$this -> EUI_Session -> _get_session('UserId'));
		$this->db->set('Recsource'		,$out->get_value('Recsource','strtoupper')); 
       
		$this->db->set('identificationType'	,$out->get_value('identificationType','strtoupper')); 
		$this->db->set('NoIdentificationType'	,$out->get_value('NoIdentificationType','strtoupper')); 
		$this->db->set('salutation'	,$out->get_value('salutation','strtoupper'));
		$this->db->set('namaDepan'	,$out->get_value('namaDepan','strtoupper'));
		$this->db->set('namaTengah'		,$out->get_value('namaTengah','strtoupper'));
		$this->db->set('namaBelakang'		,$out->get_value('namaBelakang','strtoupper'));
		$this->db->set('fullname'			,$out->get_value('fullname','strtoupper'));
		$this->db->set('nameOnCard'		,$out->get_value('nameOnCard','strtoupper'));
		$this->db->set('formerName'			,$out->get_value('formerName'));
		$this->db->set('gender'		,$out->get_value('gender'));
		$this->db->set('pob'			,$out->get_value('pob'));
		$this->db->set('dob'				,$out->get_value('dob'));
		$this->db->set('maritalStatus'		,$out->get_value('maritalStatus'));
		$this->db->set('mmn'		,$out->get_value('mmn'));
		$this->db->set('occupation'	,$out->get_value('occupation'));
		$this->db->set('addressQuestion'	,$out->get_value('addressQuestion'));
		$this->db->set('addressSuplement'	,$out->get_value('addressSuplement'));
		$this->db->set('relationship'	,$out->get_value('relationship'));
        $this->db->set('nationality'	,$out->get_value('nationality'));
        $this->db->set('cob'	,$out->get_value('cob'));
        $this->db->set('idPlaceIssued'	,$out->get_value('idPlaceIssued'));
        $this->db->set('idDateIssued'	,$out->get_value('idDateIssued'));
        $this->db->set('idExpiredDate'	,$out->get_value('idExpiredDate'));
        $this->db->set('mobilePhoneNo'	,$out->get_value('mobilePhoneNo'));
        $this->db->set('residentPhone'	,$out->get_value('residentPhone'));
        $this->db->set('email'	,$out->get_value('email'));
        $this->db->set('residentArea'	,$out->get_value('residentArea'));
        $this->db->set('sendAddress'	,$out->get_value('sendAddress'));
        
		$this->db->set("CreateExportTs"		,date('Y-m-d H:i:s'));
		$this->db->set("UpdateExportTs"		,date('Y-m-d H:i:s'));
        
		/* $this->db->set("DLFlage"	,0);
		// $this->db->set('TaxIdNumber'	,$obcustomer->get_value('FIN_TAX_ID','intval'));
		// $this->db->set('Loan'			,$loan);
		// $this->db->set('Tenor'			,$tenor);
		// $this->db->set('Rate'			,$loans[$tenor]['Rate']);
		// $this->db->set('vartiering'		,$out->get_value('vartiering'));
		// $this->db->set('AdminFee'		,$loans[$tenor]['AdminFee']);
		// $this->db->set('DisburseAmount'	,$loans[$tenor]['DisburseAmount']);
		// $this->db->set("AdditionalHPhone"	,$obcustomer->get_value('HOME_PHONE')); 
		// $this->db->set('AdditionalOPhone'	,$obcustomer->get_value('OFF_PHONE'));
		// $this->db->set('AdditionalMPhone'	,$obcustomer->get_value('MOBILE'));
		// $this->db->set('GHI'		,$obcustomer->get_value('coverage'));
		// $this->db->set("PunyaNPWP"	,$NPWP);
		// $this->db->set("SubmitNPWP"	,$NPWP);
		// $this->db->set("HomePhone"	,$obcustomer->get_value('PHONE1'));
		// $this->db->set("OfficePhone",$obcustomer->get_value('PHONE2'));
		// $this->db->set("MobilePhone",$obcustomer->get_value('mobile')); */
		
		$this->db->insert('t_gn_frm_suplement');
		// var_dump($this->db->last_query());die();
		if( $this->db->affected_rows() > 0 ){
			$suplementid = $this->db->insert_id();
			return true;
		}else{
			$this->db->reset_write();
			$this->db->set('CustomerId'	,$out->get_value('CustomerId','intval'));
			$this->db->set('tnc'	,'YES');
			$this->db->set('Custno'		,$out->get_value('CUSTNO1','strtoupper')); 
			$this->db->set('Acct'		,$out->get_value('Accno','strtoupper'));
			$this->db->set('Cardno'		,$out->get_value('cardno','strtoupper')); 
			$this->db->set('UserId'		,$out->get_value('UserId','strtoupper')); 
			$this->db->set('Recsource'		,$out->get_value('Recsource','strtoupper')); 
		   
			$this->db->set('identificationType'	,$out->get_value('identificationType','strtoupper')); 
			$this->db->set('NoIdentificationType'	,$out->get_value('NoIdentificationType','strtoupper')); 
			$this->db->set('salutation'	,$out->get_value('salutation','strtoupper'));
			$this->db->set('namaDepan'	,$out->get_value('namaDepan','strtoupper'));
			$this->db->set('namaTengah'		,$out->get_value('namaTengah','strtoupper'));
			$this->db->set('namaBelakang'		,$out->get_value('namaBelakang','strtoupper'));
			$this->db->set('fullname'			,$out->get_value('fullname','strtoupper'));
			$this->db->set('nameOnCard'		,$out->get_value('nameOnCard','strtoupper'));
			$this->db->set('formerName'			,$out->get_value('formerName'));
			$this->db->set('gender'		,$out->get_value('gender'));
			$this->db->set('pob'			,$out->get_value('pob'));
			$this->db->set('dob'				,$out->get_value('dob'));
			$this->db->set('maritalStatus'		,$out->get_value('maritalStatus'));
			$this->db->set('occupation'	,$out->get_value('occupation'));
			$this->db->set('addressSuplement'	,$out->get_value('addressSuplement'));
			$this->db->set('relationship'	,$out->get_value('relationship'));
			$this->db->set('nationality'	,$out->get_value('nationality'));
			$this->db->set('cob'	,$out->get_value('cob'));
			$this->db->set('idPlaceIssued'	,$out->get_value('idPlaceIssued'));
			$this->db->set('idDateIssued'	,$out->get_value('idDateIssued'));
			$this->db->set('idExpiredDate'	,$out->get_value('idExpiredDate'));
			$this->db->set('mobilePhoneNo'	,$out->get_value('mobilePhoneNo'));
			$this->db->set('residentPhone'	,$out->get_value('residentPhone'));
			$this->db->set('email'	,$out->get_value('email'));
			$this->db->set('residentArea'	,$out->get_value('residentArea'));
			
			$this->db->set("CreateExportTs"		,date('Y-m-d H:i:s'));
			$this->db->set("UpdateExportTs"		,date('Y-m-d H:i:s'));

			$this->db->where('CustomerId',$out->get_value('CustomerId'));
			$this->db->update('t_gn_frm_suplement');
			
			if( $this->db->affected_rows() > 0 ){
				return (bool)TRUE;
			}else{
				return false;
			}
		}
		}echo MYSQL_ERROR();
	}

	public function _set_row_validasi_suplement($out=null) {
		if( !$out->fetch_ready() OR !_get_is_login() ){
			return (bool)FALSE;
		}

		$_datap = $out->get_value('CustomerId');

		$sql = "select * from t_gn_frm_suplement a where a.CustomerId='$_datap' ";
		$qry = $this->db->query($sql);

		#var_dump( $this->db->last_query() );die();
		if( $this->db->affected_rows() > 0 ){
			return (bool)TRUE;
		}else{
			return false;
		}
	}
}
?>