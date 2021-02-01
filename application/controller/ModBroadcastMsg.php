<?php
class ModBroadcastMsg extends EUI_Controller
{

 function ModBroadcastMsg()
 {
	parent::__construct();
	$this -> load -> model('M_ModBroadcastMsg');
	
 }
 
/*
 * EUI :: M_ModBroadcastMsg // construtor() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
 
function index()
 {
	
	if( $this -> EUI_Session -> _have_get_session('UserId'))
	{
		if( class_exists('M_ModBroadcastMsg') )
		{
			$this -> M_ModBroadcastMsg -> _getAllUser();
			
			//echo $this -> EUI_Session -> _get_session('HandlingType');
			
			$this -> load -> view('mod_broadcast/view_broadcast_message');
		}	
	}
 }
 
/*
 * EUI :: M_ModBroadcastMsg // construtor() 
 * -----------------------------------------
 *
 * @ def		function get detail content list page 
 * @ param		not assign parameter
 */	
 
 function getUserOnline()
 {
	if( $this -> EUI_Session -> _have_get_session('UserId'))
	{
		if( class_exists('M_ModBroadcastMsg') )
		{
			$Users = array('Users' => $this -> M_ModBroadcastMsg -> _getAllUser() );
			$this -> load -> view( 'mod_broadcast/view_broadcast_users', $Users );
		}	
	}	
 }
 
 function getUserBy(){
	if( $this -> EUI_Session -> _have_get_session('UserId'))
	{
		if( class_exists('M_ModBroadcastMsg') )
		{
			$data=$this->URI->_get_all_request();
			$Users = array('Users' => $this -> M_ModBroadcastMsg -> _getAllby($data['handling']) );
			$this -> load -> view( 'mod_broadcast/view_broadcast_users', $Users );
		}	
	}	
 }

/*
 * @ def	: function get detail content list page 
 * -----------------------------------------------------
 *
 * @ return : array()
 * @ param	: not assign parameter
 */	
function SendUserOnline()
 {
	$_conds = array('success'=> 0); $Online = array();
	
	if( $this -> EUI_Session -> _have_get_session('UserId'))
	{
		if( class_exists('M_ModBroadcastMsg') )
		{
			$data = null; $TextMessage = $this -> URI ->_get_post('TextMessage');
			
			if( $this -> URI -> _get_have_post('UserData') ) 
			{
				$Online = array_keys($this -> M_ModBroadcastMsg ->_getUserOnline());
				foreach( $this -> URI -> _get_array_post('UserData') as $k => $v )
				{
					if( in_array($v, $Online)){
						$data[$k] = $v; 
					}
				}
			}
			
			// process &&&
			
			if(!is_null($data))
			{
				if( $this -> M_ModBroadcastMsg -> _setSendUserOnline(
					array
					(
						'Users' => $data,
						'Message' => $TextMessage
					)
				))
				{
					$_conds = array('success'=> 1);
				}
			}
		}
	}
	
	echo json_encode($_conds);
		
 }
 
/*
 * @ def	: function get detail content list page
 * ---------------------------------------------------
 * 
 * @ return : array()
 * @ param	: not assign parameter
 */	
 
 function SendUserOffline()
 {
	$_conds = array('success'=> 0); $Offline = array();
	
	if( $this -> EUI_Session -> _have_get_session('UserId'))
	{
		if( class_exists('M_ModBroadcastMsg') )
		{
			$data = null; $TextMessage = $this -> URI ->_get_post('TextMessage');
			
			if( $this -> URI -> _get_have_post('UserData') ) 
			{
				$Offline = array_keys($this -> M_ModBroadcastMsg ->_getUserOffline());
				foreach( $this -> URI -> _get_array_post('UserData') as $k => $v )
				{
					if( in_array($v, $Offline)){
						$data[$k] = $v; 
					}
				}
			}
			
			// process &&&
			
			if(!is_null($data))
			{
				if( $this -> M_ModBroadcastMsg -> _setSendUserOffline(
					array
					(
						'Users' => $data,
						'Message' => $TextMessage
					)
				))
				{
					$_conds = array('success'=> 1);
				}
			}
		}
	}
	
	echo json_encode($_conds);
		
 }
 
/*
 * @ def	: SendUserAll
 * ---------------------------------------------------
 * 
 * @ return : array()
 * @ param	: not assign parameter
 */	
 
 function SendUserAll()
 {
	$_conds = array('success'=> 0);
	
	if( $this -> EUI_Session -> _have_get_session('UserId'))
	{
		if( class_exists('M_ModBroadcastMsg') )
		{
			$data = null; $TextMessage = $this -> URI ->_get_post('TextMessage');
			
			if( $this -> URI -> _get_have_post('UserData') ) 
			{
				foreach( $this -> URI -> _get_array_post('UserData') as $k => $v ) {
					$data[$k] = $v;
				}
			}
			
			// process &&&
			
			if(!is_null($data))
			{
				if( $this -> M_ModBroadcastMsg ->_setSendUserAll(
					array
					(
						'Users' => $data,
						'Message' => $TextMessage
					)
				))
				{
					$_conds = array('success'=> 1);
				}
			}
		}
	}
	
	echo json_encode($_conds);
		
 }
 
 /*
 * @ def	: function get detail content list page
 * ---------------------------------------------------
 * 
 * @ return : array()
 * @ param	: not assign parameter
 */	
 
 function PoolMessage()
 {
	if( !$this -> EUI_Session -> _have_get_session('UserId') ){
		exit(0);
	} 

	//print_r($this -> EUI_Session -> _have_get_session('UserId'));
	//print_r($this -> EUI_Session -> _have_get_session('Username'));
	
	$datas= array();
		$sql = " select a.id as MsgId,  b.full_name as Username,b.id as fromId, a.message ,a.sent as datetime
				 from tms_agent_msgbox a 
				 left join tms_agent b on a.[from]=b.UserId
				 where a.[to]='".$this -> EUI_Session ->_get_session('UserId')."' and a.recd=0
				 ORDER BY a.id DESC";
		#echo $sql;die();
		 
		$qry = $this -> db->query($sql);
		
		if( $qry -> result_num_rows() > 0 )
		{
			$i =0;
			foreach( $qry -> result_assoc() as $rows )
			{
				$datas['result'] = 1;
				$datas[$i]['msgid']	   = $rows['MsgId'];
				$datas[$i]['from']	   = $rows['Username'];
				$datas[$i]['fromId']	   = $rows['fromId'];
				$datas[$i]['message']  = $rows['message'];
				$datas[$i]['datetime'] = $rows['datetime'];
				$i++;
			}
		} 
		$total = $qry -> result_num_rows();
		if( $total > 0 ){
			$pesan['pesan'] = $datas;
		}
		else{
			$pesan['pesan'] = array('result'=>0);
		}	
		
		echo json_encode($pesan);	
 }
 
 
/*
 * @ def	: UpdateAll
 * ---------------------------------------------------
 * 
 * @ return : array()
 * @ param	: not assign parameter
 */	
 
 function UpdateAll()
 {
	echo json_encode
	(
		$this -> {base_class_model($this)}->_setUpdateAll
		(
			$this -> EUI_Session -> _get_session('UserId')
		)
	);
 }
 
/*
 * @ def	: UpdateMessage
 * ---------------------------------------------------
 * 
 * @ return : array()
 * @ param	: not assign parameter
 */	
 
function UpdateMessage()
{
	echo json_encode
	(
		$this -> {base_class_model($this)}->_setUpdateMessage
		(
			$this->URI->_get_post('messageid')
		)
	);
} 
 
 
}
?>