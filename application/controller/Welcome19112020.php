<?php
/*
 * EUI Controller  
 *
 
 * Section  : Welcome first load content on HOME
			  website application enjoy its.
 * author 	: Omens  
 * link		: http://www.razakitechnology.com/eui/controller 
 */
 
class Welcome extends EUI_Controller
{

/*
 @ Constructor 
 */
 
function Welcome() 
{
	parent::__construct();	
	$this->load->Model('M_Website');
	$this->load->helper("EUI_Object");
}	

/*
 @ method index look on URI Segment /index.php/welcome/index 
 @ loading first call on your application 
 */

public function index() {
	
 $out =& get_class_instance('M_Website'); if( is_object( $out ) )  {
		$this->load->view("welcome/Welcome", array(
			'content' => $out->_web_default()
		));
	}	
}


public function updatets(){
	$date=date('y-m-d');
	$this->db->query("update t_gn_customer  set Flag_Followup=0  where Flag_Followup=1
	and CustomerUpdatedTs
	BETWEEN '$date 06:00:00' and  '$date 23:00:00' ");
}

public function ver_Activity_backup () {

	$query=$this->db->query("SELECT a.*, a.id AS id_ver, a.cust_id AS customer_id, b.*,b.id AS id_status,c.CallReasonId, c.Flag_Followup,
	CONVERT(VARCHAR, a.create_date, 8) AS JAM_VERIFIKASI,
	CONVERT(VARCHAR, GETDATE(), 8) AS JAM_SEKARANG,
	DATEDIFF(HOUR, CONVERT(VARCHAR, a.create_date, 8), CONVERT(VARCHAR, GETDATE(), 8)) AS JARAK_JAM
	FROM t_gn_ver_activity a
	LEFT JOIN t_gn_ver_status b ON a.cust_id=b.cust_id
	INNER JOIN t_gn_customer c ON a.cust_id=c.CustomerId
	WHERE 
	 
	c.CallReasonId != 13  AND c.Flag_Followup=0
	AND DATEDIFF(HOUR, CONVERT(VARCHAR, a.create_date, 8), CONVERT(VARCHAR, GETDATE(), 8)) >= 2
	ORDER BY a.create_date DESC
	")->result();
	$date = date('Y-m-d H:i:s');
	$backup=array();
	foreach ($query as $row ) {
		array_push($backup,$row);
		// $this->db->insert('t_gn_ver_activity_backup',array(
		// 	'id_ver' =>$row->id
		// ));
		//$this->db->insert('t_gn_ver_activity_backup',$backup);

		if ($row->ver_result!=2) {
			$this->db->insert('t_gn_ver_activity_backup',array(
				'id_ver'			=> $row->id_ver,
				'cust_id'			=> $row->customer_id,
				'ver_date'			=> $row->ver_date,
				'ver_form'		    => $row->ver_form,
				'ver_value'		    => $row->ver_value,
				'ver_input'		    => $row->ver_input,
				'ver_attempt'	    => $row->ver_attempt,
				'ver_status'		=> $row->ver_status,
				'ver_set'	        => $row->ver_set,
				'create_date'		=>  $row->create_date,
				'create_by'		    => $row->create_by,
				'ver_1'		        => $row->ver_1,
				'ver_2'		        => $row->ver_2,
				'ver_3'		        => $row->ver_3,
				'ver_result'		=> $row->ver_result,
				'id_status'		    => $row->id_status,
				'CallReasonId'		=> $row->CallReasonId,
				'jam_verifikasi'	=> $row->JAM_VERIFIKASI,	
				'jam_deletion'	    => $row->JAM_SEKARANG,	
				'jarak_jam'		    => $row->JARAK_JAM,
				'date_deletion'	    => $date
			));
		}
		

		// $this->db->delete('t_gn_ver_activity');
		// $this->db->where('cust_id',$row->customer_id);

		// $this->db->delete('t_gn_ver_status');
  //   	$this->db->where('cust_id',$row->customer_id);
	
	}
	foreach ($backup AS $value) {
		// echo "<pre>";
		// var_dump($value);
		if ($value->ver_result!=2) {
			$this->db->delete('t_gn_ver_activity');
			$this->db->where('cust_id',$value->customer_id);
        	// echo $this->db->last_query();
			
			$this->db->delete('t_gn_ver_status');
        	$this->db->where('cust_id',$value->customer_id);
		}
			
	// die;
	}
	  // masih guliatin lu bang ya ini di tinggalin bveres ni ya ama gua andi udah docba kalo mau coba lagi juga sok aja
   

    ///$this->db->insert_batch('t_gn_ver_activity_backup',$backup);
	echo "success";


}

// =================== END CLASS ===================================
}

// END OF FILE
// location : ./application/controller/Welcome.php

?>