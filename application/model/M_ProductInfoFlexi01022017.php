<?php 
class M_ProductInfoFlexi extends EUI_Model
{
	private static $Instance = null;
	public static function & Instance(){
		if( is_null(self::$Instance)){
			self::$Instance = new self();
		}
		return self::$Instance;
	}

	function __construct(){
		$this->load->model(array('M_ProductForm','M_SysUser'));
	}
	
	function _get_data_form($_cust_id)
	{
		$_datas = array();
		
		$sql = "SELECT * FROM t_gn_attr_flexi a
				WHERE a.CustomerId = '".$_cust_id."'";
				
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0)
		{
			$_datas = $qry->result_first_assoc();
		}
		
		return $_datas;
	}
	
	function _get_data_inc_frm($_cust_id)
	{
		$_datas = array();
		$sql = "SELECT * FROM t_gn_frm_flexi a
				WHERE a.CustomerId = '".$_cust_id."'";
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0){
			$_datas = $qry->result_first_assoc();
		}
		
		return $_datas;
	}
	
	function _get_data_loans($custid, $tenor = NULL){
		$_datap = array();
		$sql = "select * from t_gn_loan_tiering a where a.CustomerId = '".$custid."'";
		if($tenor!=NULL){
			$sql.=" AND a.Tenor=".$tenor;
		}
		$qry = $this->db->query($sql);
		foreach( $qry -> result_assoc() as $rows ) {
			$_datap[$rows['Tenor']]['LoanAmount'] = $rows['LoanAmount'];
			$_datap[$rows['Tenor']]['Installment'] = $rows['Installment'];
			$_datap[$rows['Tenor']]['Rate'] = $rows['Rate'];
			$_datap[$rows['Tenor']]['Tenor'] = $rows['Tenor'];
			$_datap[$rows['Tenor']]['CustomerId'] = $rows['CustomerId'];
		}
		return $_datap;
	}
	
	function _get_list_bank(){
		$_datap = array();
		$sql = "select * from t_lk_bank a";
		if($tenor!=NULL){
			$sql.=" AND a.Tenor=".$tenor;
		}
		$qry = $this->db->query($sql);
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
	
	public function _set_row_save_flexi($out=null){
		if( !$out->fetch_ready() OR !_get_is_login() ){
			return (bool)FALSE;
		}
		// print_r($out);
		$tenors = ($out->get_value('key_tenor','intval')===0?6:$out->get_value('key_tenor','intval'));
		$tenor = $out->get_value('key_tenor','intval');
		$AdressVerif = $out->get_value('AdressVerif','intval');
		$loans = $this->_get_data_loans($out->get_value('CustomerId','intval'),$tenors);
		$customer = $this->_get_data_form($out->get_value('CustomerId','intval'));
		$obloans =new EUI_Object($loans);
		$obcustomer =new EUI_Object($customer);
		
		$loan = ($loans[$tenors]['LoanAmount']*$out->get_value('vartiering','intval'))/100;
		
		// echo "<pre>";
		// print_r($obcustomer);
		// print_r($customer);
		// echo "</pre>";
		// exit();
		/*Array(
			[CustomerId] => 13237
			[typexsell] => 0
			[vartiering] => 50
			[tenor_] => 24
			[benefname] => benef
			[benefaccount] => benef
			[benefbranch] => benef
			[benefbank] => 1
		)*/
		
		/*Array
		(
			[6] => Array
				(
					[LoanAmount] => 0.000
					[Installment] => 0.000
					[Rate] => 0.0000
					[Tenor] => 6
					[CustomerId] => 13237
				)

			[12] => Array
				(
					[LoanAmount] => 21000000.000
					[Installment] => 2054500.000
					[Rate] => 0.0145
					[Tenor] => 12
					[CustomerId] => 13237
				)

			[24] => Array
				(
					[LoanAmount] => 21000000.000
					[Installment] => 1179500.000
					[Rate] => 0.0145
					[Tenor] => 24
					[CustomerId] => 13237
				)

			[36] => Array
				(
					[LoanAmount] => 21000000.000
					[Installment] => 887833.333
					[Rate] => 0.0145
					[Tenor] => 36
					[CustomerId] => 13237
				)

		)*/
		
		/*Array
		(
			[id] => 60
			[CustomerId] => 13237
			[CUST_REV_SEGMENT] => 3.REVOLVER
			[CUST_RISK_SEGMENT] => LR
			[Cardno] => 4096750141024123
			[Acct] => 4096750141024123
			[Custno] => 034-259789
			[name] => Flexi Tes 3
			[Sex] => F
			[Product] => VPC
			[Limit] => 25200000
			[DOB] => 08/12/1978
			[Occu_complete] => 03.CLERICAL
			[duedate] => 08/01/2016
			[HOME_PHONE] => 08161414709
			[OFF_PHONE] => 082114289101
			[MOBILE] => 089690099315
			[PROD] => FLEXI1608
			[flag_supplement] => 0
			[Propensity] => M
			[CARD_EXPIRY_DATE] => 10/31/2020
			[flag_statement] => 2
			[NEED_NPWP_PIL] => Belum Punya NPWP
			[Generation_dt] => 07/26/2016
			[EXPIRE_DT] => 09/02/2016
			[FIN_TAX_ID] => 
			[Flexi_mktcode] => XTAB
			[FINAL_LIMIT] => 21000000
			[ref_accno] => ABC0080291458
			[PROG] => Flexi Pre-Approved 2015
			[Loan_Amt_6] => 
			[Loan_Amt_12] => 21000000
			[Loan_Amt_24] => 21000000
			[Loan_Amt_36] => 21000000
			[Instal_6] => 
			[Instal_12] => 2054500
			[Instal_24] => 1179500
			[Instal_36] => 887833.33333333
			[Interest_rate_6] => 
			[Interest_rate_12] => 0.0145
			[Interest_rate_24] => 0.0145
			[Interest_rate_36] => 0.0145
			[flag_bestbill] => Yes
			[EDM_ID] => 16FH100000100074090
			[CARD_HOLDER_NAME] => Flexi Tes 3
			[flag_dormant] => NO
			[STP_ID] => 16FH100000100045678
			[program_available] => Cashback 250 rb
		)*/
		
		$benefaccount = $out->get_value('benefaccount');
		// echo $benefaccount;
		$benefname = $out->get_value('benefname','strtoupper');
		$benefbank = $out->get_value('benefbank');
		// echo $benefbank;
		$benefbranch = $out->get_value('benefbranch','strtoupper');
		
		$obOut   =& get_class_instance('M_SysUser');
		$obUsr   =& Objective($obOut->_getUserDetail(_get_session('UserId')));

		$this->db->reset_write();
		$this->db->set('CustomerId'	,$obcustomer->get_value('CustomerId','intval'));
		$this->db->set('Custno'		,$obcustomer->get_value('Custno','strtoupper'));
		$this->db->set('typexsell'	,$out->get_value('typexsell','strtoupper'));
		$this->db->set('Acct'		,$obcustomer->get_value('Acct','intval'));
		$this->db->set('Cardno'		,$obcustomer->get_value('Cardno','intval')); 
		$this->db->set('SFID'		,$obcustomer->get_value('sex_main','strtoupper')); 
		$this->db->set('STPID'		,$obcustomer->get_value('STP_ID','strtoupper'));
		$this->db->set('NameOnCard'	,$obcustomer->get_value('CARD_HOLDER_NAME','strtoupper'));
		$this->db->set('FlexiMktCode'	,$obcustomer->get_value('Flexi_mktcode','strtoupper'));
		$this->db->set('FlexiLimit'	,$obcustomer->get_value('FINAL_LIMIT','intval'));
		$this->db->set('ProdType'	,$obcustomer->get_value('PROG','strtoupper'));
		$this->db->set('NeedNPWP'	,$obcustomer->get_value('NEED_NPWP_PIL','strtoupper'));
		$this->db->set('BenefAccount'	,$benefaccount);
		$this->db->set('BenefName'		,$benefname);
		$this->db->set('BenefBank'		,$benefbank);
		$this->db->set('BenefBranch'	,$benefbranch);
		$this->db->set('TaxIdNumber'	,$obcustomer->get_value('FIN_TAX_ID'));
		// $this->db->set('Loan'			,($loan<1?NULL:$loan));
		// $this->db->set('Tenor'			,($tenor<1?NULL:$tenor));
		// $this->db->set('Rate'			,$loans[$tenor]['Rate']);
		$this->db->set('Loan'			,$loan);
		$this->db->set('Tenor'			,$tenor);
		$this->db->set('Rate'			,($tenor===0?0:$loans[$tenor]['Rate']));
		$this->db->set('vartiering'		,$out->get_value('vartiering'));
		$this->db->set("AdditionalHPhone"	,""); 
		$this->db->set('AdditionalOPhone'	,"");
		$this->db->set('AdditionalMPhone'	,"");
		$this->db->set('GHI'		,$obcustomer->get_value('coverage','strtoupper'));
		$this->db->set("PunyaNPWP"	,$obcustomer->get_value('NEED_NPWP_PIL','strtoupper'));
		$this->db->set("SubmitNPWP"	,$obcustomer->get_value('NEED_NPWP_PIL','strtoupper'));
		$this->db->set("HomePhone"	,$obcustomer->get_value('HOME_PHONE'));
		$this->db->set("OfficePhone",$obcustomer->get_value('OFF_PHONE'));
		$this->db->set("MobilePhone",$obcustomer->get_value('MOBILE'));
		$this->db->set("CreateDate"	,date('Y-m-d H:i:s'));
		$this->db->set("CreateBy"	,$obUsr->get_value('UserId','intval'));
		$this->db->set("DLFlage"	,0);
		$this->db->set("AddressVerif"	,$AdressVerif);

		$this->db->insert('t_gn_frm_flexi');
		// echo MYSQL_ERROR();
		if( $this->db->affected_rows() > 0 ){
			$hospinid = $this->db->insert_id();
			return true;
		}else{
			$this->db->reset_write();
			$this->db->set('CustomerId'	,$obcustomer->get_value('CustomerId','intval'));
			$this->db->set('Custno'		,$obcustomer->get_value('Custno','strtoupper'));
			$this->db->set('typexsell'	,$out->get_value('typexsell','strtoupper'));
			$this->db->set('Acct'		,$obcustomer->get_value('Acct','intval'));
			$this->db->set('Cardno'		,$obcustomer->get_value('Cardno','intval')); 
			$this->db->set('SFID'		,$obcustomer->get_value('sex_main','strtoupper')); 
			$this->db->set('STPID'		,$obcustomer->get_value('STP_ID','strtoupper'));
			$this->db->set('NameOnCard'	,$obcustomer->get_value('CARD_HOLDER_NAME','strtoupper'));
			$this->db->set('FlexiMktCode'	,$obcustomer->get_value('Flexi_mktcode','strtoupper'));
			$this->db->set('FlexiLimit'	,$obcustomer->get_value('FINAL_LIMIT','intval'));
			$this->db->set('ProdType'	,$obcustomer->get_value('PROG','strtoupper'));
			$this->db->set('NeedNPWP'	,$obcustomer->get_value('NEED_NPWP_PIL','strtoupper'));
			$this->db->set('BenefAccount'	,$benefaccount);
			$this->db->set('BenefName'		,$benefname);
			$this->db->set('BenefBank'		,$benefbank);
			$this->db->set('BenefBranch'	,$benefbranch);
			$this->db->set('TaxIdNumber'	,$obcustomer->get_value('FIN_TAX_ID'));
			// $this->db->set('Loan'			,($loan<1?NULL:$loan));
			// $this->db->set('Tenor'			,($tenor<1?NULL:$tenor));
			// $this->db->set('Rate'			,$loans[$tenor]['Rate']);
			$this->db->set('Loan'			,$loan);
			$this->db->set('Tenor'			,$tenor);
			$this->db->set('Rate'			,($tenor===0?0:$loans[$tenor]['Rate']));
			$this->db->set('vartiering'		,$out->get_value('vartiering'));
			$this->db->set("AdditionalHPhone"	,""); 
			$this->db->set('AdditionalOPhone'	,"");
			$this->db->set('AdditionalMPhone'	,"");
			$this->db->set('GHI'		,$obcustomer->get_value('coverage'));
			$this->db->set("PunyaNPWP"	,$obcustomer->get_value('NEED_NPWP_PIL','strtoupper'));
			$this->db->set("SubmitNPWP"	,$obcustomer->get_value('NEED_NPWP_PIL','strtoupper'));
			$this->db->set("HomePhone"	,$obcustomer->get_value('HOME_PHONE'));
			$this->db->set("OfficePhone",$obcustomer->get_value('OFF_PHONE'));
			$this->db->set("MobilePhone",$obcustomer->get_value('MOBILE'));
			$this->db->set("CreateBy"	,$obUsr->get_value('UserId','intval'));
			$this->db->set('UpdateDate',date('Y-m-d H:i:s'));
			$this->db->set("AddressVerif"	,$AdressVerif);

			$this->db->where('CustomerId',$obcustomer->get_value('CustomerId'));
			$this->db->update('t_gn_frm_flexi');
			
			if( $this->db->affected_rows() > 0 ){
				return (bool)TRUE;
			}else{
				return false;
			}
		}
	}
}


?>