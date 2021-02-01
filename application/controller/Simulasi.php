<?php
define('FINANCIAL_MAX_ITERATIONS', 128);
define('FINANCIAL_PRECISION', 1.0e-08);

class Simulasi extends EUI_Controller 
{
	function __construct() 
	{
		parent::__construct();	
		$this->load->model(array(
			'M_Simulasi'
		));
		$this->load->helper(array('EUI_Object'));
	}
	
	function get_effective_rate(){
		$efrate = array("effective_rate"=>0);
		$eff_rate = $this -> {base_class_model($this)} -> EFF_RATE();
		$efrate["effective_rate"] = $eff_rate;
		__(json_encode($efrate));
	}
	
	public function CashbackCalculation($loan=null,$interest=null){
		$tenor = array(12 => 1.10,
					24 => 1.20,
					36 => 1.20,
					48 => 1.24,
					60 => 1.30);
					
		$cashback = array();
		for($no = 1; $no<=3; $no++){
			// foreach($tenor as $key => $val){
				$cashback[$no][$key] = (($loan * $no * ($interest/100)) > 10000000? 10000000:($loan * $no * ($interest/100)));
			// }
		}
		return $cashback;
	}
	
	function Cashbacktable(){
		$loan = _get_post("loan");
		$interest = _get_post("interestrate");
		$cashback = $this->CashbackCalculation($loan,$interest);
			$tenor = array(12 => 1.10,
				24 => 1.20,
				36 => 1.20,
				48 => 1.24,
				60 => 1.30);
			$arr_header = array(
				"12" => "12",
				"24" => "24",
				"36" => "36",
				"48" => "48",
				"60" => "60"
			);
			$arr_class = array(
				"12" => "content-middle",
				"24" => "content-middle",
				"36" => "content-middle",
				"48" => "content-middle",
				"60" => "content-lasted"
			);
			$arr_interset = array('1.10%','1.20%','1.20%','1.24%','1.30%');
			
				echo	"<table border=0 cellspacing=1 width=\"100%\">".
				"<tr height=\"30\"> ".
						"<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>". lang("Gratis Bunga") ."<br>".lang("(X Bulan)")."</th>".
						"<th class=\"ui-corner-top ui-state-default center th-lasted\" width=\"2%\" nowrap>". lang("Free Interest") ."</th>";
					// "</tr> ".
					// "<tr height=\"30\"> ";
					// "<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>". lang("label_data_no") ."</th>";
					// foreach( $arr_interset as $field => $value ){
						// echo "<th class=\"ui-corner-top ui-state-default th-lasted {$arr_align[$field]}\" width=\"{$arr_width[$field]}\"><span class=\"header_order\" title=\"Sort By {$value}\" onclick=\"Ext.DOM.CallHistory({page:0, orderby:'{$field}', type:'{$next_order}' });\">&nbsp;{$value}</span></th>";
					// }
					// echo "</tr> ".
					// "<tr height=\"30\"> ";
				// foreach( $arr_header as $field => $value ){
					// echo "<th class=\"ui-corner-top ui-state-default th-lasted {$arr_align[$field]}\" width=\"{$arr_width[$field]}\"><span class=\"header_order\" title=\"Sort By {$value}\" onclick=\"Ext.DOM.CallHistory({page:0, orderby:'{$field}', type:'{$next_order}' });\">&nbsp;{$value}</span></th>";
				// }
				echo "</tr>";
				
				foreach($cashback as $key => $row){
						echo "<tr bgcolor=\"{$back_color}\" class=\"onselect\" height=\"35\">".
							"<td class=\"content-first\" nowrap>".$key."</td>";
							foreach($row as $keys => $val){
								echo "<td class=\"content-first\" nowrap>".number_format($cashback[$key][$keys], 0, '.', ',')."</td>";
							}
						echo "</tr>";
				}
			echo "</table>";
	}
	
	function CalculatePMT(){
		$PMT = array("PMT"=>0);
		$getPMT = $this -> {base_class_model($this)} -> GET_PMT();
		$PMT["PMT"] = $getPMT['M'];
		$PMT["pym_scheme"] = $getPMT['pym_scheme'];
			$arr_header = array(
					"Installment" => lang("Installment"),
					"os"=> lang("O/S"),
					"Interest"=> lang("Insterest"),
					"Principal"=> lang("Principal")
				);
				$arr_class = array(
					"Installment" =>"content-middle",
					"os"=>"content-middle",
					"Interest"=>"content-middle",
					"Principal"=>"content-lasted"
				);

				echo	"<table border=0 cellspacing=1 width=\"100%\">".
					"<tr height=\"30\"> ".
					"<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>". lang("label_data_no") ."</th>";
					// "<th class=\"ui-corner-top ui-state-default center th-first\" width=\"2%\" nowrap>#</th>";
				foreach( $arr_header as $field => $value ){
					echo "<th class=\"ui-corner-top ui-state-default th-lasted {$arr_align[$field]}\" width=\"{$arr_width[$field]}\"><span class=\"header_order\" title=\"Sort By {$value}\" onclick=\"Ext.DOM.CallHistory({page:0, orderby:'{$field}', type:'{$next_order}' });\">&nbsp;{$value}</span></th>";
				}
				echo "</tr>";
				foreach($getPMT['pym_scheme'] as $key => $row){
					echo "<tr bgcolor=\"{$back_color}\" class=\"onselect\" height=\"35\">".
						"<td class=\"content-first\" nowrap>".$key."</td>".
						"<td class=\"content-first\" nowrap>".($row['installment']=NULL?"":number_format($row['installment'], 0, '.', ','))."</td>".
						"<td class=\"content-first\" nowrap>".($row['os']=NULL?"":number_format($row['os'], 0, '.', ','))."</td>".
						"<td class=\"content-first\" nowrap>".($row['interest']=NULL?"":number_format($row['interest'], 0, '.', ','))."</td>".
						"<td class=\"content-first\" nowrap>".($row['principal']=NULL?"":number_format($row['principal'], 0, '.', ','))."</td>".
					"</tr>";
				}
			echo "</table>";
		// __(json_encode($PMT));
	}

	public function index() {
		$this->load->view("mod_simulasi_hospin/view_main_simulasi");	 
	}
}
?>