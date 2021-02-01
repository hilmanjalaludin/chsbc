<?php 
class M_ProductInfoTop extends EUI_Model
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
		$this->income_reason = array(
			'Fix'=>'Outbound Income Update Recorded',
			'Range'=>'Range',
			'HouseWife'=>'Outbound Recorded - Housewife'
		);
	}
	
	function _get_data_form($_cust_id)
	{
		$_datas = array();
		
		// $sql = "SELECT a.*, b.Recsource FROM t_gn_attr_pil_topup a
		// 		left join t_gn_customer b ON a.CustomerId = b.CustomerId
		// 		WHERE a.CustomerId = '".$_cust_id."'";
		$sql = "SELECT a.*,c.tnc, b.Recsource FROM t_gn_attr_pil_topup a
				left join t_gn_customer b ON a.CustomerId = b.CustomerId
				left join t_gn_frm_pil_topup c ON c.CustomerId = b.CustomerId

				
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
		// $sql = "SELECT * FROM t_gn_frm_pil_topup a WHERE a.CustomerId = '".$_cust_id."'";
		
		$condition = "if(b.flagCashback = 1, 'Y', 'N') as isCashback, "; // mode mysql

		if ( QUERY == 'mssql' ) {
			$condition = "CASE WHEN b.flagCashback = 1 THEN 'Y' ELSE 'N' END AS isCashback, ";
		}

		$sql = "SELECT a.*, 
				{$condition} 
				c.Collection, c.CollectionType, c.Amount as incAmount
				FROM t_gn_frm_pil_topup a
				left join t_gn_incomecash b ON a.CustomerId = b.CustomerId
				left join t_gn_incomecolldoc c ON a.CustomerId = c.CustomerId
				WHERE a.CustomerId = '".$_cust_id."'";
				
		$qry = $this->db->query($sql);
		
		if($qry->num_rows()>0){
			$_datas = $qry->result_first_assoc();
		}
		
		return $_datas;
	}
	
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
		foreach( $qry -> result_assoc() as $rows ) {
			if($tenor!=NULL){
				$_datap['LoanAmount'] = $rows['LoanAmount'];
				// $_datap['Installment'] = $rows['Installment'];
					// edit hilman&andi start
				$_datap['DisburseAmount'] = $rows['DisburseAmount'];
				$_datap['Installment'] = $rows['Installment'];
				$_datap['AdminFee'] = $rows['AdminFee'];
				// edit hilman&andi end

				$_datap['Rate'] = $rows['Rate'];
				$_datap['Tenor'] = $rows['Tenor'];
				$_datap['CustomerId'] = $rows['CustomerId'];
				// $_datap['DisburseAmount'] = $rows['DisburseAmount'];
				$_datap['NeedNPWP'] = $rows['NeedNPWP'];
				$_datap['OutstandingTenor'] = $rows['OutstandingTenor'];
				$_datap['PilProPremi'] = $rows['PilProPremi'];
				$_datap['TotalTenorNew'] = $rows['TotalTenorNew'];
			}else{
				$_datap[$rows['Tenor']]['LoanAmount'] = $rows['LoanAmount'];
				// $_datap[$rows['Tenor']]['Installment'] = $rows['Installment'];
				// edit hilman&andi start
				$_datap[$rows['Tenor']]['DisburseAmount'] = $rows['DisburseAmount'];
				$_datap[$rows['Tenor']]['Installment'] = $rows['Installment'];
				$_datap[$rows['Tenor']]['AdminFee'] = $rows['AdminFee'];
				// edit hilman&andi end

				$_datap[$rows['Tenor']]['Rate'] = $rows['Rate'];
				$_datap[$rows['Tenor']]['Tenor'] = $rows['Tenor'];
				$_datap[$rows['Tenor']]['CustomerId'] = $rows['CustomerId'];
				// $_datap[$rows['Tenor']]['DisburseAmount'] = $rows['DisburseAmount'];
				$_datap[$rows['Tenor']]['NeedNPWP'] = $rows['NeedNPWP'];
				$_datap[$rows['Tenor']]['OutstandingTenor'] = $rows['OutstandingTenor'];
				$_datap[$rows['Tenor']]['PilProPremi'] = $rows['PilProPremi'];
				$_datap[$rows['Tenor']]['TotalTenorNew'] = $rows['TotalTenorNew'];
			}
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
		
		$loans = $this->_get_data_loans($out->get_value('CustomerId','intval'),$out->get_value('key_tenor','intval'));
		$customer = $this->_get_data_form($out->get_value('CustomerId','intval'));
		$obloans =new EUI_Object($loans);
		$obcustomer =new EUI_Object($customer);
		$bank = $this->_get_list_bank();
		// $loan = ($loans['LoanAmount']*$out->get_value('CustomerId','intval'))*100;
		
		// print_r($obloans);
		// echo "=======>";print_r($obcustomer->get_value('CustomerId','intval'));
		// print_r($obcustomer);
		// exit();
		$tenor = $obloans->get_value('Tenor');
		$obOut   =& get_class_instance('M_SysUser');
		$obUsr   =& Objective($obOut->_getUserDetail(_get_session('UserId')));


		// buka edit hilman&andi start
		$Installment= $loans['Installment'];
		$AdminFee =  $loans['AdminFee'];		
		$DisburseAmount =  $loans['DisburseAmount'];
		// tutup edit hilman&andi start

		$this->db->reset_write();
			// edit hilman&andi start
		$this->db->set('Installment'		,$Installment);
		$this->db->set('AdminFee'		,$AdminFee);
		$this->db->set('DisburseAmount'		,$DisburseAmount);
		$this->db->set('tnc',$out->get_value('tnc'));

		// edit hilman&andi end

		$this->db->set('CustomerId'		,$obcustomer->get_value('CustomerId','intval'));
		$this->db->set('Custno'			,$obcustomer->get_value('CUSTNO','strtoupper'));
		$this->db->set('Acct'			,$obcustomer->get_value('SSVNO','strtoupper'));
		$this->db->set('FirstName'		,NULL);
		$this->db->set('LastName'		,NULL);
		$this->db->set('Tenor'			,($tenor=0?"":$tenor));
		$this->db->set('Limit'			,NULL);
		$this->db->set('Loan'			,$loans['DisburseAmount']);
		$this->db->set('Rate'			,$loans['Rate']);
		$this->db->set('BenefName'		,$out->get_value('benefnameori','strtoupper'));
		$this->db->set('BenefBank'		,$out->get_value('benefbankori'));
		$this->db->set('BenefAccount'	,$out->get_value('benefaccountori'));
		$this->db->set('BenefBranch'	,$out->get_value('benefbranchori','strtoupper'));
		$this->db->set('NewBenefName'	,$out->get_value('benefname','strtoupper'));
		$this->db->set('NewBenefBank'	,$out->get_value('benefbank'));
		$this->db->set('NewBenefAccount',$out->get_value('benefaccount'));
		$this->db->set('NewBenefBranch'	,$out->get_value('benefbranch','strtoupper'));
		
		$this->db->set('FGroup'			,'');
		$this->db->set('TglEntry'		,'');
		$this->db->set('vTenorID'		,'');
		$this->db->set('fDownload'		,'');
		$this->db->set('AdditionalHPhone',NULL);
		$this->db->set('AdditionalOPhone',NULL);
		$this->db->set('AdditionalMPhone',NULL);
		$this->db->set('SubmitNPWP'		,$obcustomer->get_value('NEED_NPWP1'));
		$this->db->set('PilProtection'	,$out->get_value('pilprotect','strtoupper'));
		// $this->db->set('UpdateDate'		,$obcustomer->get_value('CustomerId','intval'));
		$this->db->set('CreateDate'		,date('Y-m-d H:i:s'));
		// $this->db->set('DownlDate'		,$obcustomer->get_value('CustomerId','intval'));
		$this->db->set('CreateBy'		,$obUsr->get_value('UserId','intval'));
		$this->db->set('DLFlage'		,0);

		$this->db->insert('t_gn_frm_pil_topup');//echo MYSQL_ERROR();
		if( $this->db->affected_rows() > 0 ){
			$hospinid = $this->db->insert_id();
			/** Income Coll **/
				$this->db->reset_write();
				$this->db->set('CustomerId'	,$obcustomer->get_value('CustomerId','intval'));
				$this->db->set('Custno'		,$obcustomer->get_value('CUSTNO','strtoupper')); 
				$this->db->set('Cardno'		,$obcustomer->get_value('SSVNO')); 
				$this->db->set('CampaignId'	,5);
				
				$this->db->set('Collection'		,$out->get_value('incomecol_yn'));
				if(strtolower($out->get_value('incomecol_yn'))=="y"){
					$reason = $this->income_reason[$out->get_value('incomecol_tp')];
					$this->db->set('CollectionType'	,$out->get_value('incomecol_tp'));
					if(strtolower($out->get_value('incomecol_tp'))=="fix"){
						$this->db->set('Amount'			,($out->get_value('incomecol_tp_fix')>0?str_replace(".","",$out->get_value('incomecol_tp_fix')):0));
					}else if(strtolower($out->get_value('incomecol_tp'))=="range"){
						$this->db->set('Amount'			,($out->get_value('incomecol_tp_rng')>0?$out->get_value('incomecol_tp_rng'):0));
					}
					$this->db->set('Reason'			,$reason);
				}else if(strtolower($out->get_value('incomecol_yn'))=="n"){
					$reason = $this->income_reason['HouseWife'];
					$this->db->set('CollectionType'	,'HouseWife');
					$this->db->set('Amount'			,0);
					$this->db->set('Reason'			,$reason);
				}
				
				$this->db->set('MaintenanceType',"C");
				$this->db->set('Remarks'		,"");
				$this->db->set('AOC'			,$obUsr->get_value('UserId','intval'));
				$this->db->set('IncomeDate'		,date('Y-m-d H:i:s'));
				$this->db->set('RecsourceName'	,$obcustomer->get_value('Recsource','strtoupper'));
				$this->db->set('Flag'			,0);
				
				if(strtolower($out->get_value('incomecol'))=="belum ada income doc"){
					if(strtolower($out->get_value('incomecol_yn'))=="y" || strtolower($out->get_value('incomecol_yn'))=="n"){
						$this->db->insert('t_gn_incomecolldoc');
					}
				}
				/** End of Income Coll **/
			return true;
		}else{
			$this->db->reset_write();
					// edit hilman&andi start
			$this->db->set('Installment'		,$loans['Installment']);
			$this->db->set('AdminFee'			,$loans['AdminFee']);
			$this->db->set('DisburseAmount'		,$loans['DisburseAmount']);
			$this->db->set('tnc',$out->get_value('tnc'));
			// edit hilman&andi end
			$this->db->set('Custno'			,$obcustomer->get_value('CUSTNO','strtoupper'));
			$this->db->set('Acct'			,$obcustomer->get_value('SSVNO','strtoupper'));
			$this->db->set('FirstName'		,NULL);
			$this->db->set('LastName'		,NULL);
			$this->db->set('Tenor'			,($tenor=0?"":$tenor));
			$this->db->set('Limit'			,NULL);
			$this->db->set('Loan'			,$loans['DisburseAmount']);
			$this->db->set('Rate'			,$loans['Rate']);
			$this->db->set('BenefName'		,$out->get_value('benefnameori','strtoupper'));
			$this->db->set('BenefBank'		,$out->get_value('benefbankori'));
			$this->db->set('BenefAccount'	,$out->get_value('benefaccountori'));
			$this->db->set('BenefBranch'	,$out->get_value('benefbranchori','strtoupper'));
			$this->db->set('NewBenefName'	,$out->get_value('benefname','strtoupper'));
			$this->db->set('NewBenefBank'	,$out->get_value('benefbank'));
			$this->db->set('NewBenefAccount',$out->get_value('benefaccount'));
			$this->db->set('NewBenefBranch'	,$out->get_value('benefbranch','strtoupper'));
			$this->db->set('FGroup'			,'');
			$this->db->set('TglEntry'		,'');
			$this->db->set('vTenorID'		,'');
			$this->db->set('fDownload'		,'');
			$this->db->set('AdditionalHPhone',NULL);
			$this->db->set('AdditionalOPhone',NULL);
			$this->db->set('AdditionalMPhone',NULL);
			$this->db->set('SubmitNPWP'		,$out->get_value('typexsell','strtoupper'));
			$this->db->set('PilProtection'	,$out->get_value('pilprotect','strtoupper'));
			// $this->db->set('CreateDate'		,date('Y-m-d H:i:s'));
			// $this->db->set('DownlDate'		,$obcustomer->get_value('CustomerId','intval'));
			// $this->db->set('CreateBy'		,$obUsr->get_value('UserId','intval'));'));
			$this->db->set('UpdateDate',date('Y-m-d H:i:s'));

			$this->db->where('CustomerId',$obcustomer->get_value('CustomerId'));
			$this->db->update('t_gn_frm_pil_topup');
			
			if( $this->db->affected_rows() > 0 ){
				$this->db->reset_write();
					$this->db->set('Custno'		,$obcustomer->get_value('CUSTNO','strtoupper')); 
					$this->db->set('Cardno'		,$obcustomer->get_value('SSVNO')); 
					$this->db->set('CampaignId'	,5);
					
					$this->db->set('Collection'		,$out->get_value('incomecol_yn'));
					if(strtolower($out->get_value('incomecol_yn'))=="y"){
						$reason = $this->income_reason[$out->get_value('incomecol_tp')];
						$this->db->set('CollectionType'	,$out->get_value('incomecol_tp'));
						if(strtolower($out->get_value('incomecol_tp'))=="fix"){
							$this->db->set('Amount'			,($out->get_value('incomecol_tp_fix')>0?str_replace(".","",$out->get_value('incomecol_tp_fix')):0));
						}else if(strtolower($out->get_value('incomecol_tp'))=="range"){
							$this->db->set('Amount'			,($out->get_value('incomecol_tp_rng')>0?$out->get_value('incomecol_tp_rng'):0));
						}
						$this->db->set('Reason'			,$reason);
					}else if(strtolower($out->get_value('incomecol_yn'))=="n"){
						$reason = $this->income_reason['HouseWife'];
						$this->db->set('CollectionType'	,'HouseWife');
						$this->db->set('Amount'			,0);
						$this->db->set('Reason'			,$reason);
					}
					
					$this->db->set('MaintenanceType',"C");
					$this->db->set('Remarks'		,"");
					$this->db->set('AOC'			,$obUsr->get_value('UserId','intval'));
					$this->db->set('IncomeDate'		,date('Y-m-d H:i:s'));
					$this->db->set('RecsourceName'	,$obcustomer->get_value('Recsource','strtoupper'));
					$this->db->set('Flag'			,0);
					
					$this->db->where('CustomerId',$obcustomer->get_value('CustomerId'));
					$this->db->update('t_gn_incomecolldoc');
					
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