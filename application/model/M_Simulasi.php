<?php 
class M_Simulasi extends EUI_Model
{


	private static $Instance = null;	

	public static function &Instance()
	{
		if( is_null(self::$Instance) ){
			self::$Instance = new self();
		}
		return self::$Instance;
	}

	function __construct(){ }

	public function _select_attr_product( $ProductPlanId = 0 )
	{
		$this->db->reset_select();
		$this->db->select("a.*, b.ProductName", FALSE);
		$this->db->from("t_gn_productplan a ");
		$this->db->join("t_gn_product b ","a.ProductId=b.ProductId","LEFT");
		$this->db->where("a.ProductPlanId", $ProductPlanId);
		
		$rs = $this->db->get();
		if( $rs->num_rows() > 0 ){
			return new EUI_Object( $rs->result_first_assoc() );
		}
		return new EUI_Object( array() );
	}

	function _select_page_product_benefit( $out = null )
	{	
		$attr = $this->_select_attr_product( $out->get_value('ProductPlanId'));
		$arr_call_history = array();
		$this->db->reset_select();
		$this->db->select(" a.ProductPlan as PlanId,
			(select pln.ProductPlanName from t_gn_productplan pln where pln.ProductPlan=a.ProductPlan limit 1 )  as Plan,
			a.ProductPlanBenefitDesc as ProductPlanBenefitDesc,
			a.ProductPlanBenefit as ProductPlanBenefit", 
		FALSE);

		$this->db->from("t_gn_productplanbenefit a ");
		$this->db->where("a.ProductId", $attr->get_value('ProductId','intval')); 
		$this->db->where("a.ProductPlan", $attr->get_value('ProductPlan','intval')); 

		if( _get_have_post("orderby") ){
			$this->db->order_by(_get_post("orderby"), _get_post("type"));
		} else {
			$this->db->order_by("a.ProductPlan", "ASC");
		}

		$rs = $this->db->get();
		if( $rs->num_rows() > 0 ){
		  $arr_call_history = (array)$rs->result_assoc();
		}
		return (array)$arr_call_history;
	}

	function _select_page_product_premi( $out = null )
	{
		$arr_call_history = array();

		if( !$out->fetch_ready()){
			return (array)$arr_call_history;
		}

		if( !_get_have_post('ProductId') ){
			return (array)$arr_call_history;
		}

		$this->db->reset_select();
		$this->db->select(" a.ProductPlanId As ProductPlanId, b.ProductName As ProductName, c.PayMode As PayMode, d.Gender As Gender, e.PremiumGroupName As PremiGroup,
			( SELECT pn.ProductPlanLevel FROM t_gn_plan_name pn WHERE pn.ProductPlanId=a.ProductPlan AND pn.ProductId =a.ProductId ) as PlanLevel,
			a.ProductPlanName As PlanName, a.ProductPlanAgeStart As StartAge, a.ProductPlanAgeEnd As EndAge, a.ProductPlanPremium As Premi",
		FALSE);

		// from t_gn_productplan a
		$this->db->from('t_gn_productplan a');
		$this->db->join('t_gn_product b','a.ProductId=b.ProductId','LEFT');
		$this->db->join('t_lk_paymode c','a.PayModeId=c.PayModeId','LEFT');
		$this->db->join('t_lk_gender d ','a.GenderId=d.GenderId','LEFT');
		$this->db->join('t_lk_premiumgroup e','a.PremiumGroupId=e.PremiumGroupId', 'LEFT');

		if( _get_have_post('ProductId') ){
			$this->db->where("a.ProductId", $out->get_value('ProductId', 'intval'));
		}
		// -----------------------------------------------------------
		if( _get_have_post('GroupPremi') ){
			$this->db->where("a.PremiumGroupId", $out->get_value('GroupPremi', 'intval'));
		}
		// -----------------------------------------------------------  
		if( _get_have_post('PaymentMode') ){
			$this->db->where("a.PayModeId", $out->get_value('PaymentMode', 'intval'));
		}

		// ----------------------------------------------------------- 
		if( _get_have_post('GenderId') ){
			$this->db->where("a.GenderId", $out->get_value('GenderId', 'intval'));
		}  

		// ----------------------------------------------------------- 
		if( _get_have_post('AgeStart') ){
			$StartAge = $out->get_value('AgeStart');
			$this->db->where("a.ProductPlanAgeStart>='{$StartAge}' 
			AND a.ProductPlanAgeStart<='{$StartAge}'", "", FALSE);
		}  
		// -----------------------------------------------------------

		if( _get_have_post('AgeEnd') ){
			$EndAge = $out->get_value('AgeEnd');
			$this->db->where("a.ProductPlanAgeEnd>='{$EndAge}' 
			AND a.ProductPlanAgeEnd<='{$EndAge}'", "", FALSE);
		}   
		// -----------------------------------------------------------	
		if( _get_have_post("orderby") ){
			$this->db->order_by(_get_post("orderby"), _get_post("type"));
		} else {
			$this->db->order_by("a.ProductPlanId", "ASC");
		}

		// echo $this->db->print_out();

		$rs = $this->db->get();
		if( $rs->num_rows() > 0 ){
			$arr_call_history = (array)$rs->result_assoc();
		}
		return (array)$arr_call_history;
	}

//WISNU -------------------------------------------------------------------------

public function RATE($nper, $pmt, $pv, $fv = 0.0, $type = 0, $guess = 0.1) {

    $rate = $guess;
    if (abs($rate) < FINANCIAL_PRECISION) {
        $y = $pv * (1 + $nper * $rate) + $pmt * (1 + $rate * $type) * $nper + $fv;
    } else {
        $f = exp($nper * log(1 + $rate));
        $y = $pv * $f + $pmt * (1 / $rate + $type) * ($f - 1) + $fv;
    }
    $y0 = $pv + $pmt * $nper + $fv;
    $y1 = $pv * $f + $pmt * (1 / $rate + $type) * ($f - 1) + $fv;

    // find root by secant method
    $i  = $x0 = 0.0;
    $x1 = $rate;
    while ((abs($y0 - $y1) > FINANCIAL_PRECISION) && ($i < FINANCIAL_MAX_ITERATIONS)) {
        $rate = ($y1 * $x0 - $y0 * $x1) / ($y1 - $y0);
        $x0 = $x1;
        $x1 = $rate;

        if (abs($rate) < FINANCIAL_PRECISION) {
            $y = $pv * (1 + $nper * $rate) + $pmt * (1 + $rate * $type) * $nper + $fv;
        } else {
            $f = exp($nper * log(1 + $rate));
            $y = $pv * $f + $pmt * (1 / $rate + $type) * ($f - 1) + $fv;
        }

        $y0 = $y1;
        $y1 = $y;
        ++$i;
    }
    return $rate;
}   //  function RATE()

public function EFF_RATE(){
	$flatrate = _get_post("flatrate")/100;
	$nper = _get_post("tenor");
	$pv = -1;
	$pmt = (1*($flatrate+1/$nper));
	$rate = $this->RATE($nper,$pmt,$pv);
	$effective_rate = round(($rate*12)*100,9);
	return $effective_rate;
}

public function GET_PMT(){
	$Eff_Rate = round($this->EFF_RATE()/100,10);//round(_get_post("effectiverate")/100,10);
	$P = _get_post("principal");
	$N = _get_post("tenor");
	$J = round($Eff_Rate/12,10);
	// $Z = $P * ($J / (1-(pow((1 + $J),-$N))));
	$M = $P * ($J / (1-(pow((1 + $J),-$N))));
	$pym_scheme = array();
	$arr_scheme = array();
	// 26100000 * (0.0280833 / (1-(pow((1 + 0.0280833),-36))))1161536.2821775
	for($i=0; $i<=$N; $i++){
		if($i==0){
			$pym_scheme[$i]['os']			= $P;
			$pym_scheme[$i]['installment']	= NULL;
			$pym_scheme[$i]['interest']		= NULL;//($Eff_Rate/12)*$pym_scheme[$i]['os'];
			$pym_scheme[$i]['principal']	= NULL;//$pym_scheme[$i]['installment']-$pym_scheme[$i]['interest'];
		}else if($i>0){
			$pym_scheme[$i]['installment']	= round($M,10);
			$pym_scheme[$i]['interest']		= round(round($Eff_Rate/12,10)*$pym_scheme[$i-1]['os'],10);
			$pym_scheme[$i]['principal']	= $pym_scheme[$i]['installment'] - $pym_scheme[$i]['interest'];
			$pym_scheme[$i]['os']			= (($pym_scheme[$i-1]['os']-$pym_scheme[$i]['principal'])>0.01?$pym_scheme[$i-1]['os']-$pym_scheme[$i]['principal']:0);
		}
	
	}
	$arr_scheme['M'] = round($M);
	$arr_scheme['pym_scheme'] = $pym_scheme;
	return $arr_scheme;
	// return round($M);
}

// ============= END CLASS ==========================	
}

?>