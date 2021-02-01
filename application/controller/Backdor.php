<?php 
//---------------------------------------------------------------------
/*
 * class Backdor for activity It Support .
 */
 
 class Backdor extends EUI_Controller 
{


 function __construct()
{ 
	parent::__construct();
	$this->load->model(array(base_class_model($this)));
	$this->load->helper(array('EUI_Object','EUI_Socket'));
}

//---------------------------------------------------------------------
/*
 * class Backdor for activity It Support .
 */
 
 public function index()
{
	echo " <form name='frmExtension' 
		method='POST' action='". site_url() ."/Backdor/ReleaseExtension/?action=". time() ."'>
		<table>
			<tr>
				<td>Extension<td>
				<td><input type='text' value='' style='width:70px;' name='extension'><td>
				<td><input type='Submit' value='Submit' name='btnSubmit'><td>
			</tr>
		</table>
	</form>";
}

// update data call status yang kosong 
// php -q /opt/enigma/webapps/hsbc-portof/index.php Backdor updateCallStatusKosong


function updateCallStatusKosong()
{

$start_date = '2017-07-04'; 
$end_date = '2017-07-13';

$sql = "select a.CallHistoryId  from t_gn_callhistory a where a.HistoryType = 0
		and a.CallReasonCategoryId = 0
		and a.CallHistoryCreatedTs>= '$start_date 00:00:00'
		and a.CallHistoryCreatedTs<= '$end_date 23:00:00'";
		
		
$qry = $this->db->query($sql);

$num = 0;
if( $qry && $qry->num_rows() >0 ) 
	foreach( $qry->result_assoc() as $row )
{

	$CallHistoryId = $row['CallHistoryId'];
	if( $CallHistoryId ){
			$sql = "update t_gn_callhistory a 
					inner join t_lk_callreason b on a.CallReasonId = b.CallReasonId
					set a.CallReasonCategoryId = b.CallReasonCategoryId
					where a.HistoryType=0
					and a.CallReasonCategoryId = 0
					and a.CallHistoryId='$CallHistoryId'";
					
			if( $this->db->query( $sql ) ){
				printf("success udpate id : %s \n\r", $CallHistoryId);
			}
			
	}
	$num++;
}

}

// update copy history

function UpdateHistoryData(){
	
$sql = " select a.CallHistoryId,
		(select ts.CallHistoryNotes from t_gn_callhistory ts where ts.CustomerId = a.CustomerId 
		 and ts.CallReasonId <>0
		 order by ts.CallHistoryId DESC LIMIT 1 ) as CallHistoryNotes,
				
		(select ts.CallNumber from t_gn_callhistory ts where ts.CustomerId = a.CustomerId 
		 and ts.CallReasonId <>0
		 order by ts.CallHistoryId DESC LIMIT 1 ) as CallNumber,
				
		(select ts.DisagreeId from t_gn_callhistory ts where ts.CustomerId = a.CustomerId 
		 and ts.CallReasonId <>0
		 order by ts.CallHistoryId DESC LIMIT 1 ) as DisagreeId,

		(select ts.CallReasonCategoryId from t_gn_callhistory ts where ts.CustomerId = a.CustomerId 
		 and ts.CallReasonId <>0
		 order by ts.CallHistoryId DESC LIMIT 1 ) as CallReasonCategoryId,
				
		 (select ts.CallReasonId from t_gn_callhistory ts where ts.CustomerId = a.CustomerId 
		  and ts.CallReasonId <>0
		  order by ts.CallHistoryId DESC LIMIT 1 ) as CallReasonId
		from t_gn_callhistory a 
		where a.CallReasonId=0
		and date(a.CallHistoryCallDate)  = '2017-07-14'";


$qry = $this->db->query($sql);
if( $qry && $qry->num_rows() > 0) 
	foreach($qry->result_assoc() as $row )
{
	$CallHistoryId = $row['CallHistoryId'];
	if( !$CallHistoryId ){
		continue;
	}
	
	// update by history ID 
	
	$sql = sprintf("UPDATE t_gn_callhistory a 
					SET 
						a.CallHistoryNotes = '%s',
						a.CallNumber = '%s',
						a.DisagreeId = '%s',
						a.CallReasonCategoryId = '%s',
						a.CallReasonId='%s'
						
				WHERE a.CallHistoryId='%s'", 
						$row['CallHistoryNotes'],
						$row['CallNumber'],
						$row['DisagreeId'],
						$row['CallReasonCategoryId'],
						$row['CallReasonId'],
						$CallHistoryId );
	$this->db->query( $sql );
	echo ".";	
		
}

}

// function UpdateCustomerId

function UpdateCustomerId(){
	$sql = " select a.CallHistoryId, a.CustomerId, b.assign_data,  a.CallSessionId  from t_gn_callhistory a 
			 left join cc_call_session b on a.CallSessionId=b.session_id
			 where a.CustomerId = 0  and date(a.CallHistoryCallDate)='2017-07-14'";
		 
	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows() > 0 )
	foreach( $qry->result_assoc() as $row )
	{
		$CallHistoryId = $row['CallHistoryId'];
		$CustomerId = $row['assign_data'];
		$CallSessionId = $row['CallSessionId'];
		if( !$CustomerId ){
			continue;
		}
		// update history 
		$sql = "update t_gn_callhistory a SET a.CustomerId='$CustomerId'
				where a.CallSessionId='$CallSessionId' 
				and a.CallHistoryId='$CallHistoryId'
				and a.CustomerId=0";
		$this->db->query( $sql );
				
		echo ".";		
	}		 
	exit;

}


//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
 
 function UpdateCallDisposition()
{
	
$sql  = "select distinct(a.CustomerId) as CustomerId 
		 from t_gn_callhistory a where a.CallReasonId = 0 
		 and DATE(a.CallHistoryCreatedTs)=DATE(NOW()) 
		 and a.HistoryType=0";
		 
	 
$qry = $this->db->query( $sql );
if( $qry && $qry->num_rows()> 0 ) 
 foreach( $qry->result_assoc() as $row ) 
{
	 $CustomerId = $row['CustomerId'];
	 if( !$CustomerId ){
		continue;
	 }
		
	 // get callhistory 
	 
	  $CallHistoryId = 0;	
	  $sql = sprintf("select max(b.CallHistoryId) as CallHistoryId 
					  from t_gn_callhistory b  where b.CustomerId = '%d'
					  and b.CallReasonId<>0 and b.HistoryType=0", $CustomerId);
	  $qry = $this->db->query( $sql );
	  if( $qry && $qry->num_rows() > 0 ){
		$CallHistoryId = $qry->result_singgle_value();
	  }
	  
	// cek lagi 
	if( $CallHistoryId ) 
	{
		
		$sql  = sprintf("select b.CustomerId, b.CallReasonCategoryId, b.CallReasonId from t_gn_callhistory b 
						 where b.CallHistoryId ='%s' and b.CallReasonId<>0", $CallHistoryId);

		$qry = $this->db->query( $sql );
		if( $qry && $qry->num_rows() > 0) 
		{
			$row = $qry->result_first_assoc();
			 
			if( is_array($row) and $row['CustomerId'] ) {
				
				$CustomerId = $row['CustomerId'];
				$CallReasonCategoryId = $row['CallReasonCategoryId'];
				$CallReasonId = $row['CallReasonId'];
				
				// tested 
				$update = sprintf("update t_gn_customer a set a.CallReasonId = '%s',
								  a.CustomerStatus = '%s' where a.CustomerId ='%s'",  
								  $CallReasonId, $CallReasonCategoryId, $CustomerId );
											  
				if( $this->db->query( $update ) ) {
					// delete on history 
					$delete = sprintf("delete from t_gn_callhistory where CallReasonId=0 
									   and date(CallHistoryCreatedTs)=date(now()) and HistoryType=0 and CustomerId='%s'", $CustomerId);	
									 
					$this->db->query( $delete );
					printf("success update customer %s\n\r", $CustomerId);									
				} 
				 // end update 
			} 
			// end assoc data 
		} 
		// end row 
	} 
	 
	// end history;
} 
// end for;*/
 
	
}


//---------------------------------------------------------------------------------------

/* properties		index 
 *
 * @param 			uknown 
 * @author			uknown 
 */
 
function callActivityAgent( $start_date = null, $end_date = null  ) {
 
 if( is_null( $start_date ) ){
	 return false;
 }
 
 $CI =& get_instance();
 
// define variable data object on here .
 $act_date   = $start_date;
 
 
// query ambil agent yang login di hari tertentu .
  
 $arr_map 	 = array();
 $arr_usr 	 = array();
 $arr_logoff = array();
 
 
 // query ambil agent yang login di hari tertentu .
 
 $sql = sprintf("select c.id as  ActivityUserId  from t_gn_activitylog a, tms_agent b , cc_agent c 
				 where a.ActivityUserId=b.UserId  and b.id=c.userid 
				 and a.ActivityDate >= '%s 00:00:00'
				 and a.ActivityDate <= '%s 23:59:59'	
				 and a.ActivityEvent IN('ACTION_EVENT_LOGIN','ACTION_EVENT_LOGOUT')
				 group by ActivityUserId
				 order by c.id ASC ", $start_date, $end_date );
		 
 $qry = $CI->db->query( $sql );
 if( $qry && $qry->num_rows() ) 
	 foreach( $qry ->result_assoc() as $row )
 {
	 $arr_usr[$row['ActivityUserId']] = $row['ActivityUserId'];
 }
 
 // query ambil agent yang login di hari tertentu .
 // dan ambil data login dan logoutnya 
 
 $sql = sprintf("select c.id as  ActivityUserId, a.ActivityDate as ActivityDate,  a.ActivityEvent as ActivityEvent
				 from t_gn_activitylog a, tms_agent b , cc_agent c 
				 where a.ActivityUserId=b.UserId  and b.id=c.userid 
				 and a.ActivityDate >= '%s 00:00:00'
				 and a.ActivityDate <= '%s 23:59:59'
				 and a.ActivityEvent IN('ACTION_EVENT_LOGIN','ACTION_EVENT_LOGOUT')
				 group by ActivityUserId, ActivityDate, ActivityEvent 
				 order by a.ActivityDate ASC", $start_date, $end_date );
 //echo $sql;

 $qry = $CI->db->query( $sql );
 if( $qry && $qry->num_rows() ) 
  foreach( $qry ->result_assoc() as $row )
  {
	 $tgl = date('Y-m-d', strtotime($row['ActivityDate']));
	 $arr_map[$row['ActivityUserId']][$tgl][] = $row;
 }
   
 // cek validasi data dari user yang akan di generate sebelum di 
 // cek waktu loogoff - nya .
 
 $arr_agent_data  = array();
 
 if( is_array($arr_usr)) 
	 foreach( $arr_usr as $i => $agent_id ) 
 {
	 $val_agent_date = $start_date;
	 $arr_agent_data = $arr_map[$agent_id];
	
	$astRow = array();
	 
	 
	while( true )  
	{
			
		$valdate  = $val_agent_date; 
		$astRow =  $arr_agent_data[$valdate];
	 
	// get id 	
		$astId 	 	 = 0; 
		$astNext 	 = 0;
		
	// jika data berisi array dari query activity pada hari ini saja 
	// maka lakukan process insert / update .
		//print_r($astRow);
		
		 if( is_array( $astRow ) ) 
			 foreach( $astRow as $num => $lstRow  )
		{
			//print_r($lstRow);
		// define semua variable terkait .
		
			$astNext = $astId+1;
			$evtCurrent = $lstRow['ActivityEvent'];
			$evtNext = $astRow[$astNext]['ActivityEvent'];
			
		// default nila date - nya 
		
			$aststart_date = null;
			$astend_date = null;
			
			
		// jika current -nya adalah logout maka nextnya adalah login .
		// jadi logout time - login time 
			
			 if( !strcmp($evtCurrent, 'ACTION_EVENT_LOGOUT' ) 
				 && !strcmp($evtNext, 'ACTION_EVENT_LOGIN'))  
			{
				$aststart_date = $lstRow['ActivityDate'];
				$astend_date   = $astRow[$astNext]['ActivityDate'];
				//printf("agent %s ->from : %s to : %s<br>", $agent_id, $aststart_date, $astend_date);
				
				
				$interval   	= (strtotime($astend_date) - strtotime($aststart_date));
				
				// concate data berdasarkan tgl & agent_id pada table
				// cc_agent bukan tms_agent .
				
				$arr_logoff[$lstRow['ActivityUserId']][$valdate]['date'] 	= $valdate;
				$arr_logoff[$lstRow['ActivityUserId']][$valdate]['agent_id'] = $agent_id;
				$arr_logoff[$lstRow['ActivityUserId']][$valdate]['total']	+= $interval;
				
				// end::foreach
			}
			
			
			$astId++;
			
			}
		
		
		if ($val_agent_date == $end_date) break;
			$val_agent_date = _getNextDate($val_agent_date);
			
	}	
	 
	
 } 
 
 
  return (array)$arr_logoff;
}


//---------------------------------------------------------------------
/*
 * class Backdor for activity It Support .
 */
 
// php -q /opt/enigma/webapps/reporting/index.php Backdor AgentActivity 2017-04-01 2017-04-05 
// akan di jalankan dengan cronjob 

function AgentActivity()
{
	global $argc, $argv;
	
	// then if its 
	
	$start_date = date('Y-m-d');
	$end_date = date('Y-m-d');
	
	if( $argc == 5 ){
		$start_date = $argv[3]; 
		$end_date  = $argv[4];
	}
	
	$sql = "SELECT 
			date_format(a.start_time, '%Y-%m-%d') as start_date,
			a.agent as agent_id,
			b.name as agent_name,
			SUM(IF(a.`status` IN(0), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_logout,
			SUM(IF(a.`status` IN(1), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_ready,
			SUM(IF(a.`status` IN(2), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_not_ready,
			SUM(IF(a.`status` IN(4), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_busy,
			SUM(IF(a.`status` IN(3), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_acw,
			
			SUM(IF((a.`status` IN(2) and a.reason IN(1)), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_reason_tipe_1,
			SUM(IF((a.`status` IN(2) and a.reason IN(2)), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_reason_tipe_2,
			SUM(IF((a.`status` IN(2) and a.reason IN(3)), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_reason_tipe_3,
			SUM(IF((a.`status` IN(2) and a.reason IN(4)), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_reason_tipe_4,
			SUM(IF((a.`status` IN(2) and a.reason IN(5)), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_reason_tipe_5,
			SUM(IF((a.`status` IN(2) and a.reason IN(6)), (UNIX_TIMESTAMP(a.end_time) - UNIX_TIMESTAMP(a.start_time)), 0)) as agent_reason_tipe_6
		from cc_agent_activity_log a, cc_agent b 
		where a.agent = b.id
		and a.start_time >= '$start_date 08:00:00'
		and a.start_time <= '$end_date 20:00:00'
		group by start_date, agent_id ";
		
	//printf("<pre>%s</pre>", $sql);
	
	$qry = $this->db->query($sql);
	if( $qry && $qry->num_rows() > 0 ) 
		foreach( $qry->result_assoc() as $rows )
	{
		$row = Objective( $rows );
		
		$this->db->set('start_date', 			$row->get_value('start_date') );
		$this->db->set('agent_id', 				$row->get_value('agent_id') );
		$this->db->set('agent_name', 			$row->get_value('agent_name') );
		$this->db->set('agent_logout', 			$row->get_value('agent_logout') );
		$this->db->set('agent_ready', 			$row->get_value('agent_ready') );
		$this->db->set('agent_not_ready', 		$row->get_value('agent_not_ready') );
		$this->db->set('agent_busy', 			$row->get_value('agent_busy') );
		$this->db->set('agent_acw', 			$row->get_value('agent_acw') );
		$this->db->set('agent_reason_tipe_1', 	$row->get_value('agent_reason_tipe_1') );
		$this->db->set('agent_reason_tipe_2', 	$row->get_value('agent_reason_tipe_2') );
		$this->db->set('agent_reason_tipe_3', 	$row->get_value('agent_reason_tipe_3') );
		$this->db->set('agent_reason_tipe_4', 	$row->get_value('agent_reason_tipe_4') );
		$this->db->set('agent_reason_tipe_5', 	$row->get_value('agent_reason_tipe_5') );
		$this->db->set('agent_reason_tipe_6', 	$row->get_value('agent_reason_tipe_6') );
		
		
		$this->db->duplicate('agent_id', 		$row->get_value('agent_id') );
		$this->db->duplicate('agent_name', 		$row->get_value('agent_name') );
		$this->db->duplicate('agent_logout', 	$row->get_value('agent_logout') );
		$this->db->duplicate('agent_ready', 	$row->get_value('agent_ready') );
		$this->db->duplicate('agent_not_ready', $row->get_value('agent_not_ready') );
		$this->db->duplicate('agent_busy', 		$row->get_value('agent_busy') );
		$this->db->duplicate('agent_acw', 		$row->get_value('agent_acw') );
		
		$this->db->duplicate('agent_reason_tipe_1', $row->get_value('agent_reason_tipe_1') );
		$this->db->duplicate('agent_reason_tipe_2', $row->get_value('agent_reason_tipe_2') );
		$this->db->duplicate('agent_reason_tipe_3', $row->get_value('agent_reason_tipe_3') );
		$this->db->duplicate('agent_reason_tipe_4', $row->get_value('agent_reason_tipe_4') );
		$this->db->duplicate('agent_reason_tipe_5', $row->get_value('agent_reason_tipe_5') );
		$this->db->duplicate('agent_reason_tipe_6', $row->get_value('agent_reason_tipe_6') );
		$this->db->insert_on_duplicate("t_gn_agent_activity_report");

	}
	
	
	
	// then with call iniated on datalike this .
	
	$sql = "select a.agent_id as agent_id,
				 date_format(a.start_time, '%Y-%m-%d') as start_date,
				 count(a.id) as agent_call_iniated,
				 SUM(IF((a.`status` IN(3004, 3005) )  , 1, 0)) as agent_call_connected,
				 SUM(IF((a.`status` NOT IN(3004, 3005) )  , 1, 0)) as agent_call_unconnected
				 from cc_call_session a 
				 left join cc_agent b on a.agent_id = b.id 
				 where a.start_time>='$start_date 00:00:00'
				 and a.start_time<='$end_date 23:59:59'
				 group by start_date, agent_id ";
				 
	// printf("<pre>%s</pre>", $sql);		

	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows() > 0 ) 
		foreach( $qry->result_assoc() as $rows )
	{
		$row = Objective( $rows );
		$this->db->reset_write();
		$this->db->set("agent_call_iniated", 	 $row->get_value('agent_call_iniated'));
		$this->db->set("agent_call_connected", 	 $row->get_value('agent_call_connected'));
		$this->db->set("agent_call_unconnected", $row->get_value('agent_call_unconnected'));
		
		// update where data like this 
		
		$this->db->where("start_date",  $row->get_value('start_date'));
		$this->db->where("agent_id", 	$row->get_value('agent_id'));
		$this->db->update("t_gn_agent_activity_report");
	}
	
	// update data logoff time berdasarkan ini 
	
	$activityDls = $this->callActivityAgent( $start_date, $end_date );
	 
	// get list object array data .
	
	$activityAgt = array();
	if(is_array(array_keys( $activityDls ))) 
	 foreach( array_keys( $activityDls ) as $ky => $vl ){
		$activityAgt[$vl] = $vl;
	}
	
	// get agent data "$activityAgt"
	
	if(is_array($activityAgt) ) 
		foreach( $activityAgt as $agent_id => $agent_val )
	{
		$val_row_data = $activityDls[$agent_id];
		if( is_array($val_row_data) ) 
		  foreach( $val_row_data as $key => $row ) 
	   {
			$this->db->reset_write();
			$this->db->set('agent_logout', $row['total']);
			$this->db->where('start_date', $row['date']);
			$this->db->where('agent_id',   $row['agent_id']);
			$this->db->update('t_gn_agent_activity_report');
		}
	}
	
	printf("%.\n\r\n", "done");
}

/* properties		static 
 *
 * @param 			uknown 
 * @author			uknown 
 */
  
function DeleteAssign()
{
	// hapus data yang tidak macthing dengan Assigment 
	$sql = "select a.CustomerId from t_gn_customer a";
	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows() > 0 ) 
		foreach( $qry->result_assoc() as $row ){
			$CustomerId = $row['CustomerId'];
			
			
			$sgl = sprintf("select count(b.AssignId) as total from t_gn_assignment b 
							where b.CustomerId =%s", $CustomerId);
			$qrl = $this->db->query( $sgl);
			if( $qrl && $qrl->num_rows() > 0 ) 
				foreach( $qrl->result_assoc() as $sgr ){
					$total = $sgr['total'];
					if( $total  == 0 ){
						printf("data ID -> %s not match will delete its.\n\r", $CustomerId);
						// jika total  = 0 delete data di assigment 
						 $this->db->query( sprintf("delete from t_gn_assignment where CustomerId='%s' ", $CustomerId));
					}
			}	
			
	}
}  


/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
 
function DeleteDoubleTiering(){
	
	$sql = "select count(a.Id) as tota, a.CustomerId, count(a.Tenor) as tn  from t_gn_loan_tiering a 
			where a.Tenor = 0 group by a.CustomerId
			having tn > 1";
	$qry = $this->db->query( $sql );
	if( $qry && $qry->num_rows() > 0 ) 
	foreach( $qry->result_record() as $row )
	{
		$callCustomerID = $row->field('CustomerId');
		if( $callCustomerID ){
			
			$ar_clear_data = array();
			
			$sql = sprintf("select a.Id, a.CustomerId, a.Tenor 
							from t_gn_loan_tiering a 
							where a.CustomerId='%s' and a.Tenor =0", $callCustomerID );
						
			$qry = $this->db->query( $sql );
			if( $qry && $qry->num_rows() ) 
				foreach( $qry->result_assoc() as $row ){
					 $ar_clear_data[] = $row['Id'];
			}
				
			if( count($ar_clear_data) > 1 ){
				$callTieringID = end($ar_clear_data);
				if(  $callTieringID  ){
					 $this->db->query( sprintf("delete from t_gn_loan_tiering where Id='%d'", $callTieringID));
					 printf("delete load double tiering ID : %s\n\r", $callTieringID);		
				}
			}	
		} 
	} 
} 


/**
 * Parse out the attributes
 *
 * Some of the functions use this
 *
 * @access	private
 * @param	array
 * @param	bool
 * @return	string
 */
 
 public function DeleteUpload()
{
	
	
 $out = UR();
 $cnt = 0;
 
 // get ID 
 
 $this->ID = $out->field('UploadId');
 
 $sql = sprintf("select a.FTP_UploadId as ID from t_gn_upload_report_ftp a
				 where a.FTP_UploadId = '%s'", $this->ID);
 $qry = $this->db->query( $sql );
 if( $qry && $qry->num_rows()  ){
	 $this->ID = $qry->result_singgle_value();
 }
 
 // ID Tidak Ada di dalam table 
 if( !$this->ID ){
	 exit( sprintf('ID tidak ada di dalam table : %s\n\r', 't_gn_upload_report_ftp') );
 }
 
 
// get on customer 
 $sql = sprintf("select a.CustomerId from t_gn_customer a where a.UploadId='%d'", $this->ID);
 $qry = $this->db->query( $sql );
 if( $qry && $qry->num_rows()  ) 
	foreach( $qry->result_record() as $row )
{
	$callCustomerID = $row->field('CustomerId');
	if(  $callCustomerID )
	{
		// ambil data assign ID ya 
		$callAssignID = 0;
		$sql = sprintf("select asg.AssignId from t_gn_assignment asg where asg.CustomerId = '%d'", $callCustomerID);
		$qry = $this->db->query( $sql );
		if( $qry && $qry->num_rows()  ){
			$callAssignID = $qry->result_singgle_value();
		}
		
		// delete di table log
			
		if( $callAssignID )
		{
			$sql = sprintf("delete from t_gn_assignment_log where AssignId=%d", $callAssignID);
			if( $this->db->query( $sql ) ){
				
				$cond = $this->db->query( sprintf("delete from t_gn_assignment where AssignId=%d", $callAssignID));			
				
				// jika assign sudah di delete 
				if( $cond ){
					
					$this->db->query(sprintf("delete from t_gn_frm_flexi where CustomerId=%d",     $callCustomerID));
					$this->db->query(sprintf("delete from t_gn_frm_hospin where CustomerId=%d",    $callCustomerID));
					$this->db->query(sprintf("delete from t_gn_frm_pil_topup where CustomerId=%d", $callCustomerID));
					$this->db->query(sprintf("delete from t_gn_frm_pil_xsel where CustomerId=%d",  $callCustomerID));
					$this->db->query(sprintf("delete from t_gn_loan_tiering where CustomerId=%d",  $callCustomerID));
					$this->db->query(sprintf("delete from t_gn_callhistory where CustomerId=%d",   $callCustomerID));
					
					
					$this->db->query(sprintf("delete from t_gn_attr_cip_cc where CustomerId=%d",       $callCustomerID));
					$this->db->query(sprintf("delete from t_gn_attr_cip_ntb where CustomerId=%d",      $callCustomerID));
					$this->db->query(sprintf("delete from t_gn_attr_cip_reg where CustomerId=%d",	   $callCustomerID));
					$this->db->query(sprintf("delete from t_gn_attr_cip_topup where CustomerId=%d",    $callCustomerID));
					$this->db->query(sprintf("delete from t_gn_attr_flexi where CustomerId=%d",  	   $callCustomerID));
					$this->db->query(sprintf("delete from t_gn_attr_hospin where CustomerId=%d",  	   $callCustomerID));
					$this->db->query(sprintf("delete from t_gn_attr_pa where CustomerId=%d",  		   $callCustomerID));
					$this->db->query(sprintf("delete from t_gn_attr_pil_topup where CustomerId=%d",    $callCustomerID));
					$this->db->query(sprintf("delete from t_gn_attr_pil_xsell where CustomerId=%d",    $callCustomerID));
					$this->db->query(sprintf("delete from t_gn_filter_product where prod_cust_id=%d",  $callCustomerID));
					$cond = $this->db->query( sprintf("delete from t_gn_customer where CustomerId=%d", $callCustomerID));
					
					if( $cond ) {
						$cnt++;
						printf("success deleted customer ID:%s\n\r", $callCustomerID);
					}
				}
			}
		}
	}
 }
 
 // delete from bucket 
 $this->db->query(sprintf("delete from t_gn_bucket_customers where FTP_UploadId=%d", $this->ID));
 // delete row di table t_gn_upload_report_ftp;
 $sql = sprintf("delete from t_gn_upload_report_ftp where FTP_UploadId='%d'", $this->ID);
 $qry = $this->db->query( $sql );
 if(  $qry ){
	 printf("success deleted data from t_gn_upload_report_ftp ID : %s\n\r", $this->ID);
 }
 
}  

  
// ---------------------------------------------------------------------------------
/*
 *  release extension if login identification Not Match 
 */
 
 public function ReleaseExtension()
{

 if( !_get_have_post('btnSubmit') 
	OR ! _get_have_post('extension') )
 {
	exit("Invalid Parameter . Please try Again.!");	
 }
 
 $extension = _get_post('extension'); 
 if( !$extension ){
	exit('No Extension to Release');
 } 
 
 $pbx=& get_class_instance( base_class_model($this) );
  
  if( !is_object($pbx) )
 {
	exit('object class error.');
 }	 
 
//--------------- look Backdir  
 $Manger = $pbx->_select_row_cc_setting( $extension, 'manager');
 if( !$Manger ){
	exit("ERR [$extension] extension not valid!.");
 } 
 
 if( !is_array( $Manger ) OR count( $Manger ) == 0  ){
	exit("configuration not valid!"); 
 }	 
 
 
 if( !class_exists('EUI_Socket') ){
	exit("class  Socket not found!");  
 } 
 
 
// ------------ process ---------------------------------------------- 
 $Cti = new EUI_Object( $Manger );
 if( !$Cti->fetch_ready() ){
	exit('Invalid Argument.!');
 } 
 
 $Sock = new EUI_Socket();
 $Sock->set_fp_server( $Cti->get_value('server.host','strval'), $Cti->get_value('server.port','intval')); 
 $Sock->set_fp_command( "rel-station\r\n"."ext:{$extension}\r\n\r\n" ); 
  if( $Sock->send_fp_comand() ) 
 {
	if( !$Sock->get_fp_response() ){
		exit("Release Extension Failed.");
	}
	exit("Release Extension OK. ");
 } 
 else {
	exit("Server Connection Error.");
  }
} 


// function quality 
function QualityUpper()
{




$ar_rows = array();	

// ambil datacustomernya 
$CallHistoryCreatedTs = date('Y-m-d');
$customer = array();
$sql = "SELECT a.CustomerId FROM t_gn_callhistory a 
		WHERE a.CallReasonCategoryId = 0
		AND a.CallHistoryCreatedTs >= '$CallHistoryCreatedTs 00:00:00'
		AND a.CallHistoryCreatedTs <= '$CallHistoryCreatedTs 23:59:59'
		AND a.HistoryType IN(1)";
		
//echo $sql;		

$qry = $this->db->query($sql);
if( $qry ) foreach( $qry->result_assoc() as $row ){
	$customer[$row['CustomerId']] = $row['CustomerId'];
}		
		
		
if( is_array($customer)) 
	foreach( $customer as $key => $value ){
	

$sql = "select a.CallHistoryId, a.CustomerId, a.CallReasonCategoryId, a.CallReasonId 
		from t_gn_callhistory a  where  a.CustomerId = '$value'
		order by a.CallHistoryId ASC";
//echo $sql;		
		
$qry = $this->db->query($sql);
if( $qry ) foreach( $qry->result_assoc() as $row ) {
	$ar_rows[] = $row;
 }
 
 
 $ar_soure = array();
 $ar_destn = array();
  
 if( count($ar_rows) > 0 )
 {
	 
	 $rs_source = (count($ar_rows)-2); // source untuk update 
	 $rs_destn 	= (count($ar_rows)-1); // source yang akan di update .
	 
	 // then will get here 
	 
	 $ar_soure 	= $ar_rows[$rs_source];
	 $ar_destn	= $ar_rows[$rs_destn];
	
	 if( is_array($ar_destn ) ){
		 
		 // source update 
		 
		  $scCallHistoryId = $ar_soure['CallHistoryId'];
		  $scCustomerId = $ar_soure['CustomerId'];
		  $scCallReasonCategoryId = $ar_soure['CallReasonCategoryId'];
		  
	   // source data 
	   
		 $dsCallHistoryId = $ar_destn['CallHistoryId'];
		 $dsCustomerId = $ar_destn['CustomerId'];
		 $dsCallReasonCategoryId = $ar_destn['CallReasonCategoryId'];
		 
		 // kalau sama2 nol gak usah di update
		 if( strcmp( $scCallReasonCategoryId,$dsCallReasonCategoryId) ){
			  
		 $sql = sprintf("UPDATE t_gn_callhistory a SET a.CallReasonCategoryId='%s' 
						 WHERE a.CallHistoryId='%s' 
						 AND a.CustomerId = '%s'
						 AND a.HistoryType<> 0", 
							 $scCallReasonCategoryId, 
							 $dsCallHistoryId,
							 $dsCustomerId
							 );
			if($this->db->query($sql) ){
				printf("success update customerId : %s\n\r", $value);	
			}
			
		 }
	 }
	  
  }
  
}
  
}

// ---------------------------------------------------------------------------------
/*
 *  release extension if login identification Not Match 
 */

 public function ReleaseLogin()
{
	$UserId = (string)$this->URI->segment(3);
	
	if( !$UserId){
		exit("Agent Not Exist.");
	}
	
	$this->db->reset_select();
	$this->db->where("id", $UserId);
	$this->db->set("logged_state", 0);
	$this->db->set("ip_address", "NULL", FALSE);
	$this->db->update("tms_agent");
	if( $this->db->affected_rows() > 0 ){
		exit("Release Agent Login OK.");
	} else {
		exit("Release Agent Login Failed.");
	}	
	
}

	function setup_last_call()
	{
		$date = date('Y-m-d');
		$dayofweek = date('W', strtotime($date));
		$week_number = $dayofweek+1;
		$year = date('Y');
		
		for($day=1; $day<=6; $day++)
		{
			$_date = date('Y-m-d', strtotime($year."W".$week_number.$day));
			
			$this->db->insert('t_gn_lastcall',array(
				'LastCallStartDate' => $_date,
				'LastCallEndDate' 	=> $_date,
				'LastCallStartTime' => '08:00',
				'LastCallEndTime' 	=> (date('w', strtotime($_date))>5?'14:00':'18:00'),
				'LastCallReason' 	=> 'CRONJOB '.date('Y-m-d H:i:s'),
				'LastCallStatus' 	=> 1,
				'LasCallCreateBy' 	=> 1,
				'LastCallCreateDate' => date('Y-m-d H:i:s'),
			));
		}
		
		$this->db->query('delete from t_gn_lastcall where LastCallStartDate < date(now())'); 
	}

// =========================== END CLASS 

	
}

?>