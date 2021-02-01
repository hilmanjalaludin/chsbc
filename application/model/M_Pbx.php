<?php
/*
 * E.U.I 
 *
 
 * subject	: get model data for PBX modul 
 * 			  extends under model class
 * author   : razaki team	
 * link		: http://www.razakitechnology.com/eui/model/M_Pbx.php
 */
 
Class M_Pbx extends EUI_Model
{


function M_Pbx()
{
	 $this -> load -> helper('EUI_Socket');
}


/*@ _get_pbx_setting **/

function _get_pbx_setting()
{ 
	$_data = false;
	
	if( $this -> EUI_Session -> _have_get_session('UserId')!=false )
	{
		$this -> db -> select('a.pbx, a.set_value');
		$this -> db -> from('cc_pbx_settings a');
		$this -> db -> where('a.set_name','host');
		$this -> db -> where('a.pbx','1');
		foreach( $this -> db -> get() -> result_assoc() as $rows ) 
		{
			$_data[$rows['pbx']] = array( 'pbx' => $rows['pbx'], 'value' => $rows['set_value'] );
		}
	}
	
	return $_data;
}

function _select_pbx_by_extension( $exts = '' )
{
	$pbx = "";
	$this->db->reset_select();	
	$this->db->select("b.set_value", false);
	$this->db->from("cc_extension_agent a");
	$this->db->join("cc_pbx_settings b "," a.pbx=b.pbx", "LEFT");
	$this->db->where("a.ext_number", $exts);
	$this->db->where("b.set_name", "host");
	$rs = $this->db->get();
	if( $rs->num_rows() > 0 ){
		$pbx = (string)$rs->result_singgle_value();
	}
	
	return $pbx;
}
// @ def : _get_pbx_host

function _get_pbx_host()
{
	$Host = null;
	
	$this -> db->reset_select();
	$this -> db->select('a.set_value');
	$this -> db->from('cc_pbx_settings a');
	$this -> db->where('a.set_name','host');
	
	$rs = $this -> db->get();
	if( !$rs->EOF() )
	{
		$rows = $rs -> result_first_assoc();
		if( $rows )
		{
			$Host = $rows['set_value'];
		}
	}
	
	return $Host;
}


// @ def : _get_pbx_port

function _get_pbx_port()
{
	$Port = null;
	
	$this -> db -> select('a.set_value');
	$this -> db -> from('cc_pbx_settings a');
	$this -> db -> where('a.set_name','port');
	
	$rs = $this -> db->get();
	if( !$rs->EOF())
	{
		$rows = $rs -> result_first_assoc();
		if( $rows ) {
			$Port = $rows['set_value'];
		}
	}
	
	return $Port;
	
}





/*@ _then_ register to pbx_setting **/

function _set_register_user( $UserId = array() )
{

  $EUI =& EUI_Socket::get_instance();
  
  $_pbx_setting = $this -> _get_pbx_setting();   
  $_avail_agents = self::_get_skill_agents();	
  
  foreach( $UserId as $_keys => $_vals ) 
  {
	if( ($_vals == $_avail_agents[$_vals]['UserId']) && ( $_avail_agents[$_vals]['skill']!=FALSE) )
	{
		// $_pbx_setting[1]['value']
		$EUI -> set_fp_server('192.168.12.12',9800); 
		
		$EUI -> set_fp_command("load-agent\r\n"."agent-id: ".$_avail_agents[$_vals]['AgentId']."\r\n\r\n"); 
		///var_dump($EUI -> send_fp_comand());
			if( $EUI -> send_fp_comand() ){
				
				$datas[] = array
				( 
					'username' => $_avail_agents[$_vals]['full_name'], 
					'status' => ($EUI -> get_fp_response() ? 'Success Register' : 'Failed Register')
				);
			}
			else{
				$datas[]= array
				( 
					'username' => $_avail_agents[$_vals]['full_name'], 
					'status' => ($EUI -> get_fp_response() ? 'Success Register' : 'Failed Register') 
				);
			}	
	}
	else{
		$datas[] = array
		( 
			'username' => $_avail_agents[$_vals]['full_name'], 
			'status' => 'No Skill Agent'
		);
	}
 }
	
	return $datas;
}



/*
 @ get detail skil every agent available   
 */
 
function _get_skill_agents()
{
	$_agent_skill = NULL;
	$consd1 = " IF(isnull(c.skill), 0, c.skill) AS skill ";
	$consd2 = " IF(isnull(c.score),0, c.score) AS score ";
	if( QUERY == 'mssql') {
		$consd1 = " CASE WHEN isnull(c.skill) THEN 0 ELSE c.skill END AS skill ";
		$consd2 = " CASE WHEN isnull(c.score) THEN 0 ELSE c.score END AS score ";
	}
	
	$sql = " SELECT a.UserId, a.id AS Username,  a.full_name, b.id AS AgentId, 
			 {$conds1}, 
			 {$consd2}
			 FROM tms_agent a LEFT JOIN cc_agent b ON a.id=b.userid
			 LEFT JOIN cc_agent_skill c on b.id=c.agent ";
			
	$qry = $this -> db -> query($sql);		
	// if( !$qry -> EOF() ){
	if( $qry->num_rows() > 0 ) {
		foreach( $qry -> result_assoc() as $rows ){
			$_agent_skill[$rows['UserId']] = $rows;
		}
	}
	
	return $_agent_skill;
} 
 
 
 
function InstancePBX($ExtNumber= null)
{
	$instance = 0;
	
	$sql = "SELECT b.pbx FROM cc_extension_agent a 
			LEFT JOIN cc_pbx_settings b  on ( a.pbx=b.pbx AND b.set_name='host' )  
			WHERE a.ext_number = '$ExtNumber'";
		
	$qry = $this ->db -> query($sql);
	if( $rows = $qry -> result_first_assoc() )
	{
		$instance= $rows['pbx'];
	}	
	
	
	return $instance;

} 
 
 


}

// END OF FILE 
// location :./application/model/M_Pbx.php

?>