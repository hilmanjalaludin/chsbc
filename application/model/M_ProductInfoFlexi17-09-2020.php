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
		
			
		$sql = "SELECT * ,c.tnc
		FROM t_gn_attr_flexi a
		left join t_gn_customer b ON a.CustomerId = b.CustomerId
		left JOIN t_gn_frm_cip c ON c.CustomerId = b.CustomerId
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
	
	
	function _getVerifAddress () {
		$call_back = FALSE ; 
		
		$_get_all = _get_all_request();
		
		//print_r($_get_all);
		
		//[CheckAddress] => 1
		//[CustomerId] => 315973
		
		if ( isset($_get_all["CheckAddress"]) ) {
			
			$_checkaddress = isset($_get_all['CheckAddress']) ? $_get_all["CheckAddress"] : null;
			$CustomerId = isset($_get_all['CustomerId']) ? $_get_all["CustomerId"] : null;
			
			$this->db->reset_select();
			
			$this->db->set( "AddressVerif" , $_checkaddress );
			$this->db->where( "CustomerId" , $CustomerId );
			$this->db->update("t_gn_frm_flexi");
			
			//echo $this->db->last_query();
			
			if ( $this->db->affected_rows() > 0 ) {
				$call_back = TRUE;
			}
			
		}
		
		return $call_back;
		
	}
	
	function _get_data_loans($custid, $tenor = NULL){
		$_datap = array();
		//$sql = "select * from t_gn_loan_tiering a where a.CustomerId = '".$custid."'";
		//edit irul - jika loanamount nya 0 maka tidak tampil di product info
		$sql = "select * from t_gn_loan_tiering a where a.CustomerId = '".$custid."' AND a.LoanAmount>0 AND a.Desc_Card IS NULL ";
		//tutup edit irul
		//echo $sql;
		//$sql = "select * from t_gn_loan_tiering a where a.CustomerId = '33157'";
		
		if($tenor!=NULL){
			$sql.=" AND a.Tenor=".$tenor;
		}
		$qry = $this->db->query($sql);
		#var_dump( $this->db->last_query()); die();
		foreach( $qry -> result_assoc() as $rows ) {
			$_datap[$rows['Tenor']]['LoanAmount'] = $rows['LoanAmount'];
			
			//edit hilman andi start
			$_datap[$rows['Tenor']]['Installment'] = $rows['Installment'];
			$_datap[$rows['Tenor']]['AdminFee'] = $rows['AdminFee'];
			$_datap[$rows['Tenor']]['DisburseAmount'] = $rows['DisburseAmount'];
			//edit hilman andi end
			
			$_datap[$rows['Tenor']]['Rate'] = $rows['Rate'];
			$_datap[$rows['Tenor']]['Tenor'] = $rows['Tenor'];
			$_datap[$rows['Tenor']]['CustomerId'] = $rows['CustomerId'];
		}
		return $_datap;
	}

	function _get_data_loans_2nd($custid, $tenor = NULL){
		$_datap = array();
		//$sql = "select * from t_gn_loan_tiering a where a.CustomerId = '".$custid."'";
		//edit irul - jika loanamount nya 0 maka tidak tampil di product info
		$sql = "select * from t_gn_loan_tiering a where a.CustomerId = '".$custid."' AND a.LoanAmount>0 AND a.Desc_Card='CARD 99' ";
		//tutup edit irul
		//echo $sql;
		//$sql = "select * from t_gn_loan_tiering a where a.CustomerId = '33157'";
		
		if($tenor!=NULL){
			$sql.=" AND a.Tenor=".$tenor;
		}
		$qry = $this->db->query($sql);
		#var_dump( $this->db->last_query()); die();
		foreach( $qry -> result_assoc() as $rows ) {
			$_datap[$rows['Tenor']]['LoanAmount'] = $rows['LoanAmount'];
			//$_datap[$rows['Tenor']]['Installment'] = $rows['Installment'];
			
			//edit hilman andi start
			$_datap[$rows['Tenor']]['Installment'] = $rows['Installment'];
			$_datap[$rows['Tenor']]['AdminFee'] = $rows['AdminFee'];
			$_datap[$rows['Tenor']]['DisburseAmount'] = $rows['DisburseAmount'];
			//edit hilman andi end

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
	//AdressVerif update buat ipenk
	public function _set_row_save_flexi($out=null){
		if( !$out->fetch_ready() OR !_get_is_login() ){
			return (bool)FALSE;
		}
		#var_dump($out);die();
		$tenors = ($out->get_value('key_tenor_2nd','intval')===0?6:$out->get_value('key_tenor_2nd','intval'));
		$tenor = $out->get_value('key_tenor_2nd','intval');
		$addressVerif = $out->get_value('addressVerif_2nd','intval');
		$NewBillingAddress = $out->get_value('NewBillingAddress');
		
		if($out->get_value('vartiering_2nd')==99){
			$loans = $this->_get_data_loans_2nd($out->get_value('CustomerId_2nd','intval'),$tenors);
		}else{
			$loans = $this->_get_data_loans($out->get_value('CustomerId_2nd','intval'),$tenors);
		}
		
		// $loans = $this->_get_data_loans($out->get_value('CustomerId_2nd','intval'),$tenors);
		
		$customer = $this->_get_data_form($out->get_value('CustomerId_2nd','intval'));
		$obloans =new EUI_Object($loans);
		$obcustomer =new EUI_Object($customer);
		
		if($out->get_value('vartiering_2nd')!=99){
			$loan = ($loans[$tenors]['LoanAmount']*$out->get_value('vartiering_2nd','intval'))/100;
		}else{
			$loan = $loans[$tenors]['LoanAmount'];
		}

		
		$benefaccount = $out->get_value('benefaccount_2nd');
		// echo $benefaccount;
		$benefname = $out->get_value('benefname_2nd','strtoupper');
		$benefbank = $out->get_value('benefbank_2nd');
		// echo $benefbank;
		$benefbranch = $out->get_value('benefbranch_2nd','strtoupper');
		
		$obOut   =& get_class_instance('M_SysUser');
		$obUsr   =& Objective($obOut->_getUserDetail(_get_session('UserId')));

		//edit hilman andi start
		$inst=  $loans[$tenor]['Installment'];
		if($out->get_value('vartiering_2nd')  > 89){
			$var_teiring=100;
		}else{
			$var_teiring= $out->get_value('vartiering_2nd');;
		}
		$hasil=($var_teiring / 100) * $inst;
		$Installment= $hasil;
		$AF=($var_teiring / 100) * $loans[$tenor]['AdminFee'];
		 
		$AdminFee		=$AF ;	
		
		$Disbu =  $loans[$tenor]['DisburseAmount'];



        $Disburse=($var_teiring / 100) * $Disbu;
		$DisburseAmount = $Disburse;
		//edit hilman andi end

         
		if($obcustomer->get_value('CustomerId','intval') == 0){
			$obcustomer=$out;
		}else{
			$obcustomer=$obcustomer;
		}
		// var_dump($obcustomer->get_value('CustomerId','intval') == 0 ? $obcustomer->get_value('CustomerId_2nd','intval') : $obcustomer->get_value('CustomerId','intval'));
  //        die();  

		$this->db->reset_write();
        //edit hilman andi start
		$this->db->set('Installment'	,$Installment);
		$this->db->set('AdminFee'	,$AdminFee);
		$this->db->set('DisburseAmount'	,$DisburseAmount);
		$this->db->set('tnc'	,'YES');
		 //edit hilman andi end

		// $this->db->set('CustomerId'	,$obcustomer->get_value('CustomerId','intval'));
		 $this->db->set('CustomerId'	,$obcustomer->get_value('CustomerId','intval') == 0 ? $obcustomer->get_value('CustomerId_2nd','intval') : $obcustomer->get_value('CustomerId','intval'));

		$this->db->set('Custno'		,$obcustomer->get_value('Custno','strtoupper'));
		$this->db->set('typexsell'	,$out->get_value('typexsell_2nd','strtoupper'));
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
		$this->db->set('vartiering'		,$out->get_value('vartiering_2nd'));
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
		$this->db->set("AddressVerif"	,$addressVerif);
		$this->db->set("NewBillingAddress"	,$NewBillingAddress);

		$this->db->insert('t_gn_frm_flexi');
		#var_dump( MYSQL_ERROR());
		//var_dump( $this->db->last_query());die;
		$cus= $obcustomer->get_value('CustomerId','intval') == 0 ? $obcustomer->get_value('CustomerId_2nd','intval') : $obcustomer->get_value('CustomerId','intval');
			//$hospinid = $this->db->insert_id();
		$query ="SELECT a.CustomerId,b.* FROM t_gn_frm_flexi a
			INNER JOIN tms_agent b ON b.UserId = a.CreateBy
			WHERE 
			a.CustomerId=$cus";
         $test = $this->db->query($query)->row_array();
         $this->db->set('AssignAmgr'	,$test['act_mgr']);
			$this->db->set('AssignMgr'	,$test['mgr_id']);
			$this->db->set('AssignSpv'	,$test['spv_id']);
			//$this->db->set('AssignLeader'	,$test['UserId']);
			$this->db->set('AssignSelerId'	,$test['UserId']);
			$this->db->where('CustomerId',$test['CustomerId']);
			$this->db->update('t_gn_assignment');
		// var_dump($this->db->last_query());
		// die;	
		if( $this->db->affected_rows() > 0 ){
			$hospinid = $this->db->insert_id();
			return true;
		}else{
			$this->db->reset_write();

			//edit hilman andi start
			$this->db->set('Installment',$Installment);
			$this->db->set('AdminFee'	,$AdminFee);
			$this->db->set('DisburseAmount'	,$DisburseAmount);
			$this->db->set('tnc'	,'YES');
			//edit hilman andi end

			// $this->db->set('CustomerId'	,$obcustomer->get_value('CustomerId','intval'));
			$this->db->set('CustomerId'	,$obcustomer->get_value('CustomerId','intval') == 0 ? $obcustomer->get_value('CustomerId_2nd','intval') : $obcustomer->get_value('CustomerId','intval'));

			$this->db->set('Custno'		,$obcustomer->get_value('Custno','strtoupper'));
			$this->db->set('typexsell'	,$out->get_value('typexsell_2nd','strtoupper'));
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
			$this->db->set('vartiering'		,$out->get_value('vartiering_2nd'));
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
			$this->db->set("AddressVerif"	,$addressVerif);
			$this->db->set("NewBillingAddress"	,$NewBillingAddress);

			$this->db->where('CustomerId',$obcustomer->get_value('CustomerId','intval') == 0 ? $obcustomer->get_value('CustomerId_2nd','intval') : $obcustomer->get_value('CustomerId','intval'));
			$this->db->update('t_gn_frm_flexi');
			//var_dump( $this->db->last_query());die;
			// edit16092020
			$cus= $obcustomer->get_value('CustomerId','intval') == 0 ? $obcustomer->get_value('CustomerId_2nd','intval') : $obcustomer->get_value('CustomerId','intval');
			
			$query ="SELECT a.CustomerId,b.* FROM t_gn_frm_flexi a
				INNER JOIN tms_agent b ON b.UserId = a.CreateBy
				WHERE 
				a.CustomerId=$cus";
                $test = $this->db->query($query)->row_array();
                

			$this->db->reset_write();		
			$this->db->set('AssignAmgr'	,$test['act_mgr']);
			$this->db->set('AssignMgr'	,$test['mgr_id']);
			$this->db->set('AssignSpv'	,$test['spv_id']);
			//$this->db->set('AssignLeader'	,$test['UserId']);
			$this->db->set('AssignSelerId'	,$test['UserId']);
			$this->db->where('CustomerId',$test['CustomerId']);
			// edit16092020
			$this->db->update('t_gn_assignment');
			if( $this->db->affected_rows() > 0 ){
				return (bool)TRUE;
			}else{
				return false;
			}
		}
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
}


?>