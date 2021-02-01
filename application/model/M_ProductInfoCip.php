<?php 
/**
 * moduln product info CIP
 */
class M_ProductInfoCip extends EUI_Model
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
	
	/**
	 * (F) _get_data_form description]
	 * @param  Int $_cust_id
	 * query-mssql	[OK]
	 */
	function _get_data_form($_cust_id)
	{
		$_datas = array();

		$table = $this->_getTableAttr($_cust_id);
		if( empty($table) ) {
			return $_datas;
		}
		
		// t_gn_attr_pil_xsell
		// $sql = "SELECT a.*, b.* FROM  {$table['TableDetail']} a
		// 		left join t_gn_customer b ON a.CustomerId = b.CustomerId
		// 		WHERE a.CustomerId = '".$_cust_id."'";
		$sql = "SELECT a.*, b.*, c.tnc 
		FROM  {$table['TableDetail']} a
				left join t_gn_customer b ON a.CustomerId = b.CustomerId
				left JOIN t_gn_frm_cip c ON c.CustomerId = b.CustomerId
				WHERE a.CustomerId = '".$_cust_id."'";
				
				
		$qry = $this->db->query($sql);
		
		#var_dump($this->db->last_query());die();
		if($qry->num_rows()>0)
		{
			$_datas = $qry->result_first_assoc();
		}
		
		return $_datas;
	}
	
	function _get_data_inc_frm($_cust_id)
	{
		$_datas = array();
		// $sql = "SELECT * FROM t_gn_frm_pil_xsel a WHERE a.CustomerId = '".$_cust_id."'";
		
		$condition = "if(b.flagCashback = 1, 'Y', 'N') as isCashback, "; // mode mysql

		if ( QUERY == 'mssql' ) {
			$condition = "CASE WHEN b.flagCashback = 1 THEN 'Y' ELSE 'N' END AS isCashback, ";
		}

		$sql = "SELECT a.*, 
				{$condition}				
				c.Collection, c.CollectionType, c.Amount as incAmount
				
				/*FROM t_gn_frm_pil_xsel a*/
				FROM t_gn_frm_cip a
				left join t_gn_incomecash b ON a.CustomerId = b.CustomerId
				left join t_gn_incomecolldoc c ON a.CustomerId = c.CustomerId
				WHERE a.CustomerId = '".$_cust_id."'";
		$qry = $this->db->query($sql);
		
		#var_dump($this->db->last_query());die();
		if($qry->num_rows()>0){
			$_datas = $qry->result_first_assoc();
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
		$_datap = array(); $i=1;
		//$sql = "select * from t_gn_loan_tiering a where a.CustomerId = '".$custid."'";
		//edit irul - jika loanamount nya 0 maka tidak tampil di product info
		$sql = "select * from t_gn_loan_tiering a where a.CustomerId = '".$custid."' AND a.LoanAmount>0";
		//tutup edit irul
		if($tenor!=NULL){
			$sql.=" AND a.Tenor=".$tenor;
		}

		//edit irul - jika tenor NULL maka tidak tampil di product info
		else if ($tenor == NULL) {
			$sql.=" AND a.Tenor IS NOT NULL";
		}
		//tutup edit irul

		#$sql .= " ORDER BY a.Tenor ASC";
		$sql .= " ORDER BY a.Tenor, a.Desc_Card ASC, a.LoanAmount DESC";
		$qry = $this->db->query($sql);
		#var_dump( $this->db->last_query() );die();

		// jml card:
		$card = FALSE;
		$this->db->reset_select();
		$this->db->where('CustomerId', $custid);
		$this->db->where('Desc_Card', "CARD 2");
		$res = $this->db->get('t_gn_loan_tiering', 1);
		if( $res->num_rows() > 0 ) {
			$card = TRUE;
		}
		#var_dump( $this->db->last_query() );die();

		foreach( $qry -> result_assoc() as $rows ) {
			$_datap[$i][$rows['Tenor']]['ID']   		= $rows['Id'];
			$_datap[$i][$rows['Tenor']]['LoanAmount']   = $rows['LoanAmount'];
			$_datap[$i][$rows['Tenor']]['Installment']  = $rows['Installment'];
			$_datap[$i][$rows['Tenor']]['Rate']		    = $rows['Rate'];
			$_datap[$i][$rows['Tenor']]['AdminFee']     = $rows['AdminFee'];
			$_datap[$i][$rows['Tenor']]['DisburseAmount'] = $rows['DisburseAmount'];
			$_datap[$i][$rows['Tenor']]['Tenor'] 		  = $rows['Tenor'];
			$_datap[$i][$rows['Tenor']]['CustomerId'] 	  = $rows['CustomerId'];
			$_datap[$i][$rows['Tenor']]['Desc_Card'] 	  = $rows['Desc_Card'];
			$_datap[$i][$rows['Tenor']]['Card']			  = $card;

			// $_datap[$rows['Tenor']]['LoanAmount']   = $rows['LoanAmount'];
			// $_datap[$rows['Tenor']]['Installment']  = $rows['Installment'];
			// $_datap[$rows['Tenor']]['Rate']		    = $rows['Rate'];
			// $_datap[$rows['Tenor']]['AdminFee']     = $rows['AdminFee'];
			// $_datap[$rows['Tenor']]['DisburseAmount'] = $rows['DisburseAmount'];
			// $_datap[$rows['Tenor']]['Tenor'] 		  = $rows['Tenor'];
			// $_datap[$rows['Tenor']]['CustomerId'] 	  = $rows['CustomerId'];
			$i++;
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
	
	public function _set_row_save_cip($out=null) {
		if( !$out->fetch_ready() OR !_get_is_login() ){
			return (bool)FALSE;
		}
		
		#$tenor 		= $out->get_value('key_tenor','intval');
		$tenorCardOne   = (int)$out->get_value('TenorCardOne','intval');
		$tenorCardTwo   = (int)$out->get_value('TenorCardTwo','intval');
		// $loans 		= $this->_get_data_loans( $out->get_value('CustomerId','intval'), $out->get_value('key_tenor','intval') );
		// $obloans 	= new EUI_Object($loans);
		$customer 	= $this->_get_data_form($out->get_value('CustomerId','intval'));
		$obcustomer = new EUI_Object($customer);
		// $loan 		= ( $out->get_value('vartiering','intval')>0 ? ( ($loans[$tenor]['LoanAmount']*$out->get_value('vartiering','intval'))/100) : $loans[$tenor]['LoanAmount']);
		$obOut   	=& get_class_instance('M_SysUser');
		$obUsr   	=& Objective($obOut->_getUserDetail(_get_session('UserId')));
		$obnpwp 	= $obcustomer->get_value('NEED_NPWP_PIL');
		#var_dump( $obcustomer ); die();

		// echo $obnpwp;
		$NPWP = "YES";
		if($obnpwp=="Sudah Punya NPWP" OR $obnpwp=="Sudah Punya NPWP SID"){
			$NPWP = 'Y';
		}else if($obnpwp=="Belum Punya NPWP"){
			$NPWP = 'N';
		}

		$log   = FALSE;
		$this->db->reset_write();
		$this->db->where('CustomerId', $obcustomer->get_value('CustomerId','intval'));
		$query = $this->db->get('t_gn_frm_cip');

		if( $query->num_rows() > 0 ) {
			$data = $query->result_array();
			$this->db->reset_write();
			$this->db->set('Value', json_encode($data));			
			$this->db->set('CustomerId', $obcustomer->get_value('CustomerId','intval'));			
			$this->db->set('CreateTs', date('Y-m-d H:i:s'));
			$log = $this->db->insert('t_gn_frm_log');		
		}
		
		// CARD 1
		if ( $tenorCardOne > 0 ) :
			$this->db->reset_write();
			$this->db->set('CustomerId'		,$obcustomer->get_value('CustomerId','intval'));
			$this->db->set('tnc'		    ,$out->get_value('tnc'));
			$this->db->set('Bank'			,$out->get_value('benefbank','intval')); 
			$this->db->set('Cardno'			,$obcustomer->get_value('Cardno','intval')); 
			$this->db->set('BankBranch'		,$out->get_value('benefbranch','strtoupper'));
			$this->db->set('BenefAccount'	,$out->get_value('benefaccount','strtoupper'));
			// $this->db->set('Name'			,$obcustomer->get_value('Name','strtoupper'));
			$this->db->set('Name'			,$out->get_value('benefname','strtoupper'));
			$this->db->set('Custno'			,$obcustomer->get_value('CustomerNumber','strtoupper')); // Customer Number Amount_Class
			$this->db->set('TransferAmount'	,str_replace(array(".",","), "", $out->get_value('loan_amount','strtoupper')) );
			$this->db->set('Cbid'			,$out->get_value('benefbank','intval')); // BANK CODE
			$this->db->set('DobObc'			,$obcustomer->get_value('DOB','strtoupper'));
			$this->db->set('HsbcName'		,$obcustomer->get_value('Name','strtoupper'));
			$this->db->set('LimitOtb'		,$obcustomer->get_value('Limit','strtoupper'));
			$this->db->set('Cycle'			,$obcustomer->get_value('cycle','strtoupper'));
			$this->db->set('BankType'		,"non BPD");
			// $this->db->set('Tenor'			,$tenor);
			$this->db->set('Tenor'			,$tenorCardOne);
			$this->db->set('Rate'			,$out->get_value('Rate','strtoupper'));
			$this->db->set('AmountLogged'	,str_replace(array(".",","), "", $out->get_value('loan_amount','strtoupper')) );
			$this->db->set('Fee'			,'');
			$this->db->set('AuthorizationRemark'	,'');
			$this->db->set('Card_Mu_Remark'			,'');
			$this->db->set("NewBalance"				,''); 
			$this->db->set("MobilePhone"			,$obcustomer->get_value('MOBILE'));
			$this->db->set('Urn'					,$obcustomer->get_value('Recsource').$obcustomer->get_value('refno'));
			$this->db->set('CardExpDate'			,str_replace(array(".",","), "", $obcustomer->get_value('card_expr_txt')) );
			$this->db->set("Tier1"					,str_replace(array(".",","), "", $obcustomer->get_value('tier1')) );
			$this->db->set("Tier2"					,str_replace(array(".",","), "", $obcustomer->get_value('tier2')) );
			$this->db->set("Tier3"					,str_replace(array(".",","), "", $obcustomer->get_value('tier3')) );
			$this->db->set("Tier4"					,str_replace(array(".",","), "", $obcustomer->get_value('tier4')) );
			$this->db->set("CipType"				,$obcustomer->get_value('CIP_TYPE'));
			$this->db->set("AccNo"					,$obcustomer->get_value('accno'));
			$this->db->set("CreateDate"				,date('Y-m-d H:i:s'));
			$this->db->set("CreateBy"				,$obUsr->get_value('UserId','intval'));

			$this->db->set("Installment"			,str_replace(array(".",","), "", $out->get_value('Installment','strtoupper')) );
			$this->db->set("AdminFee"				,str_replace(array(".",","), "", $out->get_value('AdminFee','strtoupper')) );
			$this->db->set("DisburseAmount"			,str_replace(array(".",","), "", $out->get_value('DisburseAmount','strtoupper')) );
			$this->db->set("Pilprotect"				,str_replace(array(".",","), "", $out->get_value('pilprotect','strtoupper')) );
			$this->db->set("IncomeDocCollected"		,str_replace(array(".",","), "", $out->get_value('incomeDoc_Collected','strtoupper')) );
			$this->db->set("LoansVar"				,str_replace(array(".",","), "", $out->get_value('loan_var','strtoupper')) );
			$this->db->set("IdTiering"				,str_replace(array(".",","), "", $out->get_value('idTiering','strtoupper')) );
			$this->db->set("FreeInterest"			,str_replace(array(".",","), "", $out->get_value('FreeInterest','strtoupper')) );
			$this->db->set("CampaignId"				,$obcustomer->get_value('CampaignId','intval'));
			// $this->db->insert('t_gn_frm_cip');

			if( $log ) {
				// update
				$this->db->set('UpdateDate', date('Y-m-d H:i:s'));
				$this->db->where('CustomerId', $obcustomer->get_value('CustomerId','intval'));
				$res = $this->db->update('t_gn_frm_cip');
			} else {
				// insert
				$this->db->set('CustomerId', $obcustomer->get_value('CustomerId','intval'));
				$this->db->set("CreateDate", date('Y-m-d H:i:s'));
				$res = $this->db->insert('t_gn_frm_cip');
			}

		endif;


		// CARD 2 :
		if( $tenorCardTwo > 0 ) {

			$this->db->reset_write();
			$this->db->set('Bank'			,$out->get_value('benefbank','intval')); 
			$this->db->set('tnc'		    ,$out->get_value('tnc'));
			$this->db->set('Cardno'			,$obcustomer->get_value('map_Cardno')); 
			$this->db->set('BankBranch'		,$out->get_value('benefbranch','strtoupper'));
			$this->db->set('BenefAccount'	,$out->get_value('benefaccount','strtoupper'));
			// $this->db->set('Name'			,$obcustomer->get_value('Name','strtoupper'));
			$this->db->set('Name'			,$out->get_value('benefname','strtoupper'));
			$this->db->set('Custno'			,$obcustomer->get_value('CustomerNumber','strtoupper')); // Customer Number Amount_Class
			$this->db->set('TransferAmount'	,str_replace(array(".",","), "", $out->get_value('loan_amount2','strtoupper')) );
			$this->db->set('Cbid'			,$out->get_value('benefbank','intval')); // BANK CODE
			$this->db->set('DobObc'			,$obcustomer->get_value('DOB','strtoupper'));
			$this->db->set('HsbcName'		,$obcustomer->get_value('Name','strtoupper'));
			$this->db->set('LimitOtb'		,$obcustomer->get_value('Limit','strtoupper'));
			$this->db->set('Cycle'			,$obcustomer->get_value('cycle','strtoupper'));
			$this->db->set('BankType'		,"non BPD");
			// $this->db->set('Tenor'			,$tenor);
			$this->db->set('Tenor'			,$tenorCardTwo);
			$this->db->set('Rate'			,$out->get_value('Rate2','strtoupper'));
			$this->db->set('AmountLogged'	,str_replace(array(".",","), "", $out->get_value('loan_amount2','strtoupper')) );
			$this->db->set('Fee'			,'');
			$this->db->set('AuthorizationRemark'	,'');
			$this->db->set('Card_Mu_Remark'			,'');
			$this->db->set("NewBalance"				,''); 
			$this->db->set("MobilePhone"			,$obcustomer->get_value('MOBILE'));
			$this->db->set('Urn'					,$obcustomer->get_value('Recsource').$obcustomer->get_value('refno'));
			$this->db->set('CardExpDate'			,str_replace(array(".",","), "", $obcustomer->get_value('card_expr_txt')) );
			$this->db->set("Tier1"					,str_replace(array(".",","), "", $obcustomer->get_value('map_tier1')) );
			$this->db->set("Tier2"					,str_replace(array(".",","), "", $obcustomer->get_value('map_tier2')) );
			$this->db->set("Tier3"					,str_replace(array(".",","), "", $obcustomer->get_value('map_tier3')) );
			$this->db->set("Tier4"					,str_replace(array(".",","), "", $obcustomer->get_value('map_tier4')) );
			$this->db->set("CipType"				,$obcustomer->get_value('CIP_TYPE'));
			$this->db->set("AccNo"					,$obcustomer->get_value('map_accno'));
			$this->db->set("CreateBy"				,$obUsr->get_value('UserId','intval'));

			$this->db->set("Installment"			,str_replace(array(".",","), "", $out->get_value('Installment2','strtoupper')) );
			$this->db->set("AdminFee"				,str_replace(array(".",","), "", $out->get_value('AdminFee2','strtoupper')) );
			$this->db->set("DisburseAmount"			,str_replace(array(".",","), "", $out->get_value('DisburseAmount2','strtoupper')) );
			$this->db->set("Pilprotect"				,str_replace(array(".",","), "", $out->get_value('pilprotec2t','strtoupper')) );
			$this->db->set("IncomeDocCollected"		,str_replace(array(".",","), "", $out->get_value('incomeDoc_Collected2','strtoupper')) );
			$this->db->set("LoansVar"				,str_replace(array(".",","), "", $out->get_value('loan_var2','strtoupper')) );
			$this->db->set("IdTiering"				,str_replace(array(".",","), "", $out->get_value('idTiering2','strtoupper')) );
			$this->db->set("FreeInterest"			,str_replace(array(".",","), "", $out->get_value('FreeInterest2','strtoupper')) );
			$this->db->set("CampaignId"				,$obcustomer->get_value('CampaignId','intval'));

			$this->db->set('CustomerId', $obcustomer->get_value('CustomerId','intval'));
			$this->db->set("CreateDate", date('Y-m-d H:i:s'));
			$res = $this->db->insert('t_gn_frm_cip');
		}
		// END CARD 2

		return $res; /****** STOP *******/

		#var_dump( $this->db->last_query() ); die();
		if( $this->db->affected_rows() > 0 ){
			$hospinid = $this->db->insert_id();
				/** Income Coll **/
				$this->db->reset_write();
				$this->db->set('CustomerId'	,$obcustomer->get_value('CustomerId','intval'));
				$this->db->set('Custno'		,$obcustomer->get_value('CustomerNumber','strtoupper')); 
				$this->db->set('Cardno'		,$obcustomer->get_value('Cardno','strtoupper')); 
				$this->db->set('CampaignId'	,$obcustomer->get_value('CampaignId','intval'));
				
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
				
				/** Cashback **/
				if(strtolower($out->get_value('cashback_yn'))=="y"){
					$this->db->reset_write();
					$this->db->set('CustomerId'	, $obcustomer->get_value('CustomerId','intval'));
					$this->db->set('Custno'		, $obcustomer->get_value('Custno1','strtoupper')); 
					$this->db->set('Cardno'		, $obcustomer->get_value('cardno','intval')); 
					$this->db->set('CampaignId'	, 5);
					$this->db->set('Amount'		, 100000);
					$this->db->set('TC'			, "0422");
					$this->db->set('Narrative'	, "PIL Cashback 100rb (".date('md').") A");
					$this->db->set('AOC'		, $obUsr->get_value('UserId','intval'));
					$this->db->set('IncomingDate'	, date('Y-m-d H:i:s'));
					$this->db->set('flagCashback'			, 1);
					
					if($out->get_value('cashback')=="YES"){
						$this->db->insert('t_gn_incomecash');
					}
				}else{
					$this->db->reset_write();
					$this->db->set('CustomerId'	, $obcustomer->get_value('CustomerId','intval'));
					$this->db->set('Custno'		, $obcustomer->get_value('Custno1','strtoupper')); 
					$this->db->set('Cardno'		, $obcustomer->get_value('cardno','intval')); 
					$this->db->set('CampaignId'	, 5);
					$this->db->set('Amount'		, 100000);
					$this->db->set('TC'			, "0422");
					$this->db->set('Narrative'	, "PIL Cashback 100rb (".date('md').") A");
					$this->db->set('AOC'		, $obUsr->get_value('UserId','intval'));
					$this->db->set('IncomingDate'	, date('Y-m-d H:i:s'));
					$this->db->set('flagCashback'			, 0);

					if($out->get_value('cashback')=="YES"){
						$this->db->insert('t_gn_incomecash');
					}
				}
				/** End of Cashback **/
				
			// echo MYSQL_ERROR();
			return true;
		}else{
			$this->db->reset_write();
			$this->db->set('CustomerId'		,$obcustomer->get_value('CustomerId','intval'));
			$this->db->set('Bank'			,$out->get_value('benefbank','intval')); 
			$this->db->set('Cardno'			,$obcustomer->get_value('Cardno','intval')); 
			$this->db->set('BankBranch'		,$out->get_value('benefbranch','strtoupper'));
			$this->db->set('BenefAccount'	,$out->get_value('benefaccount','strtoupper'));
			$this->db->set('Name'			,$obcustomer->get_value('Name','strtoupper'));
			$this->db->set('Custno'			,$obcustomer->get_value('CustomerNumber','strtoupper')); // Customer Number Amount_Class
			$this->db->set('TransferAmount'	,str_replace(array(".",","), "", $out->get_value('loan_amount','strtoupper')) );
			$this->db->set('Cbid'			,$out->get_value('benefbank','intval')); // BANK CODE
			$this->db->set('DobObc'			,$obcustomer->get_value('DOB','strtoupper'));
			$this->db->set('HsbcName'		,$obcustomer->get_value('Name','strtoupper'));
			$this->db->set('LimitOtb'		,$obcustomer->get_value('Limit','strtoupper'));
			$this->db->set('Cycle'			,$obcustomer->get_value('cycle','strtoupper'));
			$this->db->set('BankType'		,"non BPD");
			$this->db->set('Tenor'			,$tenor);
			$this->db->set('Rate'			,$out->get_value('Rate','strtoupper'));
			$this->db->set('AmountLogged'	,str_replace(array(".",","), "", $out->get_value('loan_amount','strtoupper')) );
			$this->db->set('Fee'			,'');
			$this->db->set('AuthorizationRemark'	,'');
			$this->db->set('Card_Mu_Remark'			,'');
			$this->db->set("NewBalance"				,''); 
			$this->db->set("MobilePhone"			,$obcustomer->get_value('MOBILE'));
			$this->db->set('Urn'					,$obcustomer->get_value('Recsource').$obcustomer->get_value('refno'));
			$this->db->set('CardExpDate'			,str_replace(array(".",","), "", $obcustomer->get_value('card_expr_txt')) );
			$this->db->set("Tier1"					,str_replace(array(".",","), "", $obcustomer->get_value('tier1')) );
			$this->db->set("Tier2"					,str_replace(array(".",","), "", $obcustomer->get_value('tier2')) );
			$this->db->set("Tier3"					,str_replace(array(".",","), "", $obcustomer->get_value('tier3')) );
			$this->db->set("Tier4"					,str_replace(array(".",","), "", $obcustomer->get_value('tier4')) );
			$this->db->set("CipType"				,$obcustomer->get_value('CIP_TYPE'));
			$this->db->set("AccNo"					,$obcustomer->get_value('accno'));
			$this->db->set("Installment"			,str_replace(array(".",","), "", $out->get_value('Installment','strtoupper')) );
			$this->db->set("AdminFee"				,str_replace(array(".",","), "", $out->get_value('AdminFee','strtoupper')) );
			$this->db->set("DisburseAmount"			,str_replace(array(".",","), "", $out->get_value('DisburseAmount','strtoupper')) );
			$this->db->set("Pilprotect"				,str_replace(array(".",","), "", $out->get_value('pilprotect','strtoupper')) );
			$this->db->set("IncomeDocCollected"		,str_replace(array(".",","), "", $out->get_value('incomeDoc_Collected','strtoupper')) );
			$this->db->set("LoansVar"				,str_replace(array(".",","), "", $out->get_value('loan_var','strtoupper')) );
			$this->db->set("IdTiering"				,str_replace(array(".",","), "", $out->get_value('idTiering','strtoupper')) );

			$this->db->set("CreateBy"	,$obUsr->get_value('UserId','intval'));
			$this->db->set('UpdateDate',date('Y-m-d H:i:s'));

			$this->db->where('CustomerId',$obcustomer->get_value('CustomerId'));
			$this->db->update('t_gn_frm_cip');
			
			if( $this->db->affected_rows() > 0 ){
					$this->db->reset_write();
					$this->db->set('CustomerId'	,$obcustomer->get_value('CustomerId','intval'));
					$this->db->set('Custno'		,$obcustomer->get_value('CustomerNumber','strtoupper')); 
					$this->db->set('Cardno'		,$obcustomer->get_value('Cardno','strtoupper')); 
					$this->db->set('CampaignId'	,$obcustomer->get_value('CampaignId','intval'));

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
					if($out->get_value('incomecol')=="Belum Ada Income Doc"){
						if(strtolower($out->get_value('incomecol_yn'))=="y" || strtolower($out->get_value('incomecol_yn'))=="n"){
							$this->db->update('t_gn_incomecolldoc');
						}
					}
					
					/** Cashback **/
					if(strtolower($out->get_value('cashback_yn'))=="y"){
						$this->db->reset_write();
						$this->db->set('CustomerId'	, $obcustomer->get_value('CustomerId','intval'));
						$this->db->set('Custno'		,$obcustomer->get_value('CustomerNumber','strtoupper')); 
						$this->db->set('Cardno'		,$obcustomer->get_value('Cardno','strtoupper'));
						$this->db->set('CampaignId'	,$obcustomer->get_value('CampaignId','intval'));
						$this->db->set('Amount'		, 100000);
						$this->db->set('TC'			, "0422");
						$this->db->set('Narrative'	, "PIL Cashback 100rb (".date('md').") A");
						$this->db->set('AOC'		, $obUsr->get_value('UserId','intval'));
						$this->db->set('IncomingDate'	, date('Y-m-d H:i:s'));
						$this->db->set('flagCashback'			, 1);
						
						$this->db->where('CustomerId',$obcustomer->get_value('CustomerId'));
						if($out->get_value('cashback')=="YES"){
							$this->db->update('t_gn_incomecash');
						}
					}else{
						$this->db->reset_write();
						$this->db->set('CustomerId'	, $obcustomer->get_value('CustomerId','intval'));
						$this->db->set('Custno'		, $obcustomer->get_value('CustomerNumber','strtoupper')); 
						$this->db->set('Cardno'		, $obcustomer->get_value('Cardno','intval')); 
						$this->db->set('CampaignId'	, $obcustomer->get_value('CampaignId','intval'));
						$this->db->set('Amount'		, 100000);
						$this->db->set('TC'			, "0422");
						$this->db->set('Narrative'	, "PIL Cashback 100rb (".date('md').") A");
						$this->db->set('AOC'		, $obUsr->get_value('UserId','intval'));
						$this->db->set('IncomingDate'	, date('Y-m-d H:i:s'));
						$this->db->set('flagCashback'   , 0);
						
						$this->db->where('CustomerId',$obcustomer->get_value('CustomerId'));
						if($out->get_value('cashback')=="YES"){
							$this->db->update('t_gn_incomecash');
						}
					}
					/** End of Cashback **/
					
					return (bool)TRUE;
			}else{
				return false;
			}
		}//echo MYSQL_ERROR();
	}

	public function _getTableAttr($customerId=0)
	{
		$result = array();

		$this->db->select('*');
		$this->db->from('t_gn_customer a');
		$this->db->join('t_gn_campaign_ref b', 'a.CampaignId = b.CampaignId', 'INNER');
		$this->db->where('CustomerId', $customerId);
		$this->db->limit(1);
		$res =  $this->db->get();
		#var_dump($this->db->last_query());die();

		if( $res->num_rows() > 0 ) {
			$result = $res->row_array();
		}
		return $result;
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