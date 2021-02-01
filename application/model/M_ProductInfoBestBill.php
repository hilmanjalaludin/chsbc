<?php 
class M_ProductInfoBestBill extends EUI_Model
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
	
	function _get_list_bestbill_product(){
		$_datap = array();
		$sql = "SELECT distinct Product FROM t_lk_product_best_bill";
		$qry = $this->db->query($sql);

		#var_dump( $this->db->last_query() );die();
		foreach( $qry -> result_assoc() as $rows ) {
			$_datap[$rows['Product']] = $rows['Product'];
		}
		return $_datap;
	}
	
	function _get_list_bestbill_jenis_jasa($bestbill_product){
		$_datap = array();
		$sql = "SELECT distinct JenisJasa FROM t_lk_product_best_bill WHERE Product = '".$bestbill_product."'";
		$qry = $this->db->query($sql);

		// var_dump( $this->db->last_query() );die();
		foreach( $qry -> result_assoc() as $rows ) {
			$_datap[$rows['JenisJasa']] = $rows['JenisJasa'];
		}
		return $_datap;
	}
	
	function _get_list_bestbill_prefix($bestbill_product, $jenis_jasa){
		$_datap = array();
		$sql = "SELECT distinct Prefix FROM t_lk_product_best_bill WHERE Product = '".$bestbill_product."' AND JenisJasa = '".$jenis_jasa."'";
		$qry = $this->db->query($sql);

		// var_dump( $this->db->last_query() );die();
		foreach( $qry -> result_assoc() as $rows ) {
			$_datap[$rows['Prefix']] = $rows['Prefix'];
		}
		return $_datap;
	}
	
	function _get_bestbill_nopel_validity($bestbill_product, $jenis_jasa, $prefix){
		$_datap = array();
		if($bestbill_product == "PLN"){
			$sql = "SELECT distinct Nopelvalidity FROM t_lk_product_best_bill WHERE Product = '".$bestbill_product."'";
		}else{
			$sql = "SELECT distinct Nopelvalidity FROM t_lk_product_best_bill WHERE Product = '".$bestbill_product."'";
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
	
	function _set_deleteBestBill($Customer, $Id){
		$_datap['delete'] = 0;
		$sql = "DELETE FROM t_gn_frm_best_bill WHERE CustomerId = ".$Customer." AND Id = ".$Id;
		$qry = $this->db->query($sql);

		// var_dump( $this->db->last_query() );die();
		if( $this->db->affected_rows() > 0 ){
			$_datap['delete'] = 1;
		}
		return $_datap;
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
		
		$sql = "SELECT a.*, b.Recsource, c.tnc FROM t_gn_attr_best_bill a
				left join t_gn_customer b ON a.CustomerId = b.CustomerId
				left join t_gn_frm_best_bill c on c.CustomerId = b.CustomerId	
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
		$sql = "SELECT a.Id, a.Product, a.JenisJasa, a.Prefix, a.NomorPelanggan, a.NamaPelanggan FROM t_gn_frm_best_bill a WHERE a.CustomerId = '".$_cust_id."'";
		$qry = $this->db->query($sql);
		
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
	
	public function _set_row_save_bestbill($out=null) {
		if( !$out->fetch_ready() OR !_get_is_login() ){
			return (bool)FALSE;
		}
		
		// $tenor = $out->get_value('key_tenor','intval');
		// $loans = $this->_get_data_loans($out->get_value('CustomerId','intval'),$out->get_value('key_tenor','intval'));
		// $obloans =new EUI_Object($loans);
		// $loan = ($out->get_value('vartiering','intval')>0?(($loans[$tenor]['LoanAmount']*$out->get_value('vartiering','intval'))/100):$loans[$tenor]['LoanAmount']);
		
		
		$customer = $this->_get_data_form($out->get_value('CustomerId','intval'));
		$obcustomer =new EUI_Object($customer);
		$obOut   =& get_class_instance('M_SysUser');
		$obUsr   =& Objective($obOut->_getUserDetail(_get_session('UserId')));
		
		$tanggal = date("j");
		$tahun = date("Y");
		if($tanggal>25){
			$time = strtotime(date("Y/m/d"));
			$bulan = date("m", strtotime("+2 month", $time));
		}else{
			$time = strtotime(date("Y/m/d"));
			$bulan = date("m", strtotime("+1 month", $time));
		}
		$TGLEFECTIF = '01'.$bulan.$tahun;
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

		$this->db->reset_write();
		$this->db->set('CustomerId'	,$obcustomer->get_value('CustomerId','intval'));
		$this->db->set('tnc'	,'YES');
		$this->db->set('Custno'		,$obcustomer->get_value('CUSTNO1','strtoupper')); 
		$this->db->set('Acct'		,$obcustomer->get_value('Accno','intval'));
		$this->db->set('Cardno'		,$obcustomer->get_value('cardno','intval')); 
		$this->db->set('NoHpCustomer'	,$out->get_value('NoHpCustomer','strtoupper')); 
		$this->db->set('NomorPelanggan'	,$out->get_value('NomorPelanggan','strtoupper'));
		$this->db->set('NamaPelanggan'	,$out->get_value('NamaPelanggan','strtoupper'));
		$this->db->set('Product'		,$out->get_value('Product','strtoupper'));
		$this->db->set('JenisJasa'		,$out->get_value('JenisJasa','strtoupper'));
		$this->db->set('Prefix'			,$out->get_value('Prefix','strtoupper'));
		$this->db->set('TELPYBS'		,$out->get_value('NoHpCustomer','strtoupper'));
		$this->db->set('EXP'			,$obcustomer->get_value('dbase_expire_dt'));
		$this->db->set('TGLEFECTIF'		,$TGLEFECTIF);
		$this->db->set('KD_KEL'			,10);
		$this->db->set('BB'				,$obcustomer->get_value('Recsource').$obcustomer->get_value('REF_CARDNO'));
		$this->db->set('USERINPUT'		,'UM'.$obUsr->get_value('Username').'ARSLV');
		$this->db->set('RECSOURCE_NAME'	,$obcustomer->get_value('Recsource'));
		$this->db->set("CreatedAt"		,date('Y-m-d H:i:s'));
		$this->db->set("CreatedBy"		,$obUsr->get_value('UserId','intval'));
		
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
		
		$this->db->insert('t_gn_frm_best_bill');
		// var_dump($this->db->last_query());die();
		if( $this->db->affected_rows() > 0 ){
			$bestbillid = $this->db->insert_id();
			return true;
		}else{
			$this->db->reset_write();
			$this->db->set('CustomerId'	,$obcustomer->get_value('CustomerId','intval'));
			$this->db->set('Custno'		,$obcustomer->get_value('CUSTNO1','strtoupper')); 
			$this->db->set('Acct'		,$obcustomer->get_value('Accno','intval'));
			$this->db->set('Cardno'		,$obcustomer->get_value('cardno','intval')); 
			$this->db->set('tnc'		,'YES'); 
			$this->db->set('NoHpCustomer'	,$out->get_value('NoHpCustomer','strtoupper')); 
			$this->db->set('NomorPelanggan'	,$out->get_value('NomorPelanggan','strtoupper'));
			$this->db->set('NamaPelanggan'	,$out->get_value('NamaPelanggan','strtoupper'));
			$this->db->set('Product'		,$out->get_value('Product','strtoupper'));
			$this->db->set('JenisJasa'		,$out->get_value('JenisJasa','intval'));
			$this->db->set('Prefix'			,$out->get_value('Prefix','strtoupper'));
			$this->db->set('TELPYBS'		,$out->get_value('NoHpCustomer','strtoupper'));
			$this->db->set('EXP'			,$obcustomer->get_value('dbase_expire_dt'));
			$this->db->set('TGLEFECTIF'		,$TGLEFECTIF);
			$this->db->set('KD_KEL'			,10);
			$this->db->set('BB'				,$obcustomer->get_value('Recsource').$obcustomer->get_value('REF_CARDNO'));
			$this->db->set('USERINPUT'		,'UM'.$obUsr->get_value('id').'ARSLV');
			$this->db->set('RECSOURCE_NAME'	,$obcustomer->get_value('Recsource'));
			$this->db->set("UpdateDate"		,date('Y-m-d H:i:s'));
			$this->db->set("CreatedBy"		,$obUsr->get_value('UserId','intval'));

			$this->db->where('CustomerId',$obcustomer->get_value('CustomerId'));
			$this->db->update('t_gn_frm_best_bill');
			
			if( $this->db->affected_rows() > 0 ){
				return (bool)TRUE;
			}else{
				return false;
			}
		}echo MYSQL_ERROR();
	}
}


?>