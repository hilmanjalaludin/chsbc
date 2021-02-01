<?php
class DailyNewDashboard extends EUI_Controller  
{

	// test 
	
	var $_temp = array();
	
	function DailyNewDashboard()
	{
		parent::__construct();
		$this->load->model(array(
			'M_DailyNewDashboard'
		));
		
		$this->_temp['detail-per-tso']  = array( 'view' => 'new_detail_per_tso',  'model' => '_query_detail_tso', 'solicited' => '_query_solicited_tso', 'loop' => 'dsb_tso' );
		$this->_temp['detail-per-spv']  = array( 'view' => 'new_detail_per_spv',  'model' => '_query_detail_spv', 'solicited' => '_query_solicited_spv', 'loop' => 'dsb_spv' );
		$this->_temp['detail-per-atm']  = array( 'view' => 'new_detail_per_atm',  'model' => '_query_detail_atm', 'solicited' => '_query_solicited_atm', 'loop' => 'dsb_atm' );
		$this->_temp['detail-per-mgr']  = array( 'view' => 'new_detail_per_mgr',  'model' => '_query_detail_mgr', 'solicited' => '_query_solicited_mgr', 'loop' => 'dsb_mgr' );
		$this->_temp['summary-per-tso'] = array( 'view' => 'new_summary_per_spv', 'model' => '_query_detail_tso', 'solicited' => '_query_solicited_tso', 'loop' => 'dsb_tso' );
		$this->_temp['summary-per-spv'] = array( 'view' => 'new_summary_per_spv', 'model' => '_query_detail_spv', 'solicited' => '_query_solicited_spv', 'loop' => 'dsb_spv' );
		$this->_temp['summary-per-atm'] = array( 'view' => 'new_summary_per_atm', 'model' => '_query_detail_atm', 'solicited' => '_query_solicited_atm', 'loop' => 'dsb_atm' );
		$this->_temp['summary-per-mgr'] = array( 'view' => 'new_summary_per_mgr', 'model' => '_query_detail_mgr', 'solicited' => '_query_solicited_mgr', 'loop' => 'dsb_mgr' );
	}
	
	function index()
	{
		$this->load->view('new_daily_dashboard/new_dashboard_nav',array(
			'tso' => $this->M_DailyNewDashboard->_query_detail_tso()
		));
	}
	
	/* start handle combo by type */
	
	function handle_type_mgr()
	{
		switch( $this->URI->_get_post('type') )
		{
			case 'detail-per-tso' :
				switch( _get_session('HandlingType') )
				{
					case USER_ROOT : // root
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_ACCOUNT_MANAGER
						));
						
						echo form() -> combo('dsb_mgr','select long',$_user,null,array('change'=>"Ext.DOM.load_atm({mgr:this.value,form:'combo'});"));
					break;
					
					case USER_ADMIN : // admin
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_ACCOUNT_MANAGER
						));
						
						echo form() -> combo('dsb_mgr','select long',$_user,null,array('change'=>"Ext.DOM.load_atm({mgr:this.value,form:'combo'});"));
					break;
					
					case USER_ACCOUNT_MANAGER : // mgr
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_ACCOUNT_MANAGER
						));
						
						echo form() -> combo('dsb_mgr','select long',$_user,_get_session('UserId'),null,array('disabled'=>true));
					break;
					
					case USER_SUPERVISOR : // atm
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_ACCOUNT_MANAGER
						));
						
						echo form() -> combo('dsb_mgr','select long',$_user,_get_session('AccountManager'),null,array('disabled'=>true));
					break;
					
					case USER_LEADER : // spv
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_ACCOUNT_MANAGER
						));
						
						echo form() -> combo('dsb_mgr','select long',$_user,_get_session('AccountManager'),null,array('disabled'=>true));
					break;
				}
			break;
			
			case 'detail-per-spv' :
				switch( _get_session('HandlingType') )
				{
					case USER_ROOT : // root
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_ACCOUNT_MANAGER
						));
						
						echo form() -> combo('dsb_mgr','select long',$_user,null,array('change'=>"Ext.DOM.load_atm({mgr:this.value,form:'combo'});"));
					break;
					
					case USER_ADMIN : // admin
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_ACCOUNT_MANAGER
						));
						
						echo form() -> combo('dsb_mgr','select long',$_user,null,array('change'=>"Ext.DOM.load_atm({mgr:this.value,form:'combo'});"));
					break;
					
					case USER_ACCOUNT_MANAGER : // mgr
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_ACCOUNT_MANAGER
						));
						
						echo form() -> combo('dsb_mgr','select long',$_user,_get_session('UserId'),null,array('disabled'=>true));
					break;
					
					case USER_SUPERVISOR : // atm
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_ACCOUNT_MANAGER
						));
						
						echo form() -> combo('dsb_mgr','select long',$_user,_get_session('AccountManager'),null,array('disabled'=>true));
					break;
				}
			break;
			
			case 'detail-per-atm' :
				switch( _get_session('HandlingType') )
				{
					case USER_ROOT : // root
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_ACCOUNT_MANAGER
						));
						
						echo form() -> combo('dsb_mgr','select long',$_user,null,array('change'=>"Ext.DOM.load_atm({mgr:this.value,form:'combo'});"));
					break;
					
					case USER_ADMIN : // admin
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_ACCOUNT_MANAGER
						));
						
						echo form() -> combo('dsb_mgr','select long',$_user,null,array('change'=>"Ext.DOM.load_atm({mgr:this.value,form:'listcombo'});"));
					break;
					
					case USER_ACCOUNT_MANAGER : // mgr
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_ACCOUNT_MANAGER
						));
						
						echo form() -> combo('dsb_mgr','select long',$_user,_get_session('UserId'),null,array('disabled'=>true));
					break;
				}
			break;
			
			case 'detail-per-mgr' :
				$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
					'handling_type' => USER_ACCOUNT_MANAGER
				));
				
				echo form() -> listcombo('dsb_mgr','select long',$_user);
			break;
			
			case 'summary-per-tso' :
				echo form() -> combo('dsb_mgr','select long',array(),null,null,array('disabled'=>true));
			break;
			
			case 'summary-per-spv' :
				echo form() -> combo('dsb_mgr','select long',array(),null,null,array('disabled'=>true));
			break;
			
			case 'summary-per-atm' :
				echo form() -> combo('dsb_mgr','select long',array(),null,null,array('disabled'=>true));
			break;
			
			case 'summary-per-mgr' :
				$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
					'handling_type' => USER_ACCOUNT_MANAGER
				));
				
				echo form() -> listcombo('dsb_mgr','select long',$_user);
			break;
			
			default :
				echo form() -> combo('dsb_mgr','select long',array(),null,null,array('disabled'=>true));
			break;
		}
	}
	
	function handle_type_atm()
	{
		switch( $this->URI->_get_post('type') )
		{
			case 'detail-per-tso' :
				switch( _get_session('HandlingType') )
				{
					case USER_ROOT : // root
						echo form() -> combo('dsb_atm','select long',array(),null,null,array('disabled'=>true));
					break;
					
					case USER_ADMIN : // admin
						echo form() -> combo('dsb_atm','select long',array(),null,null,array('disabled'=>true));
					break;
					
					case USER_ACCOUNT_MANAGER : // mgr
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_SUPERVISOR,
							'act_mgr' => _get_session('UserId'),
						));
						
						echo form() -> combo('dsb_atm','select long',$_user,null,array('change'=>"Ext.DOM.load_spv({atm:this.value,form:'combo'});"));
					break;
					
					case USER_SUPERVISOR : // atm
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_SUPERVISOR,
						));
						
						echo form() -> combo('dsb_atm','select long',$_user,_get_session('UserId'),null,array('disabled'=>true));
					break;
					
					case USER_LEADER : // spv
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_SUPERVISOR,
						));
						
						echo form() -> combo('dsb_atm','select long',$_user,_get_session('SupervisorId'),null,array('disabled'=>true));
					break;
				}
			break;
			
			case 'detail-per-spv' :
				switch( _get_session('HandlingType') )
				{
					case USER_ROOT : // root
						echo form() -> combo('dsb_atm','select long',array(),null,null,array('disabled'=>true));
					break;
					
					case USER_ADMIN : // admin
						echo form() -> combo('dsb_atm','select long',array(),null,null,array('disabled'=>true));
					break;
					
					case USER_ACCOUNT_MANAGER : // mgr
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_SUPERVISOR,
							'act_mgr' => _get_session('UserId'),
						));
						
						echo form() -> combo('dsb_atm','select long',$_user,null,array('change'=>"Ext.DOM.load_spv({atm:this.value,form:'listcombo'});"));
					break;
					
					case USER_SUPERVISOR : // atm
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_SUPERVISOR,
						));
						
						echo form() -> combo('dsb_atm','select long',$_user,_get_session('UserId'),null,array('disabled'=>true));
					break;
				}
			break;
			
			case 'detail-per-atm' :
				switch( _get_session('HandlingType') )
				{
					case USER_ROOT : // root
						echo form() -> combo('dsb_atm','select long',array(),null,null,array('disabled'=>true));
					break;
					
					case USER_ADMIN : // admin
						echo form() -> combo('dsb_atm','select long',array(),null,null,array('disabled'=>true));
					break;
					
					case USER_ACCOUNT_MANAGER : // mgr
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_SUPERVISOR,
							'act_mgr' => _get_session('UserId'),
						));
						
						echo form() -> listcombo('dsb_atm','select long',$_user);
					break;
				}
			break;
			
			case 'detail-per-mgr' :
				echo form() -> combo('dsb_atm','select long',array(),null,null,array('disabled'=>true));
			break;
			
			case 'summary-per-tso' :
				echo form() -> combo('dsb_atm','select long',array(),null,null,array('disabled'=>true));
			break;
			
			case 'summary-per-spv' :
				echo form() -> combo('dsb_atm','select long',array(),null,null,array('disabled'=>true));
			break;
			
			case 'summary-per-atm' :
				$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
					'handling_type' => USER_SUPERVISOR
				));
				
				echo form() -> listcombo('dsb_atm','select long',$_user);
			break;
			
			case 'summary-per-mgr' :
				echo form() -> combo('dsb_atm','select long',array(),null,null,array('disabled'=>true));
			break;
			
			default :
				echo form() -> combo('dsb_atm','select long',array(),null,null,array('disabled'=>true));
			break;
		}
	}
	
	function handle_type_spv()
	{
		switch( $this->URI->_get_post('type') )
		{
			case 'detail-per-tso' :
				switch( _get_session('HandlingType') )
				{
					case USER_ROOT : // root
						echo form() -> combo('dsb_spv','select long',array(),null,null,array('disabled'=>true));
					break;
					
					case USER_ADMIN : // admin
						echo form() -> combo('dsb_spv','select long',array(),null,null,array('disabled'=>true));
					break;
					
					case USER_ACCOUNT_MANAGER : // mgr
						echo form() -> combo('dsb_spv','select long',array(),null,null,array('disabled'=>true));
					break;
					
					case USER_SUPERVISOR : // atm
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_LEADER,
							'act_mgr' => _get_session('AccountManager'),
							'spv_id' => _get_session('UserId'),
						));
						
						echo form() -> combo('dsb_spv','select long',$_user,null,array('change'=>"Ext.DOM.load_tso({spv:this.value,form:'listcombo'});"));
					break;
					
					case USER_LEADER : // spv
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_LEADER,
						));
						
						echo form() -> combo('dsb_spv','select long',$_user,_get_session('UserId'),null,array('disabled'=>true));
					break;
				}
			break;
			
			case 'detail-per-spv' :
				switch( _get_session('HandlingType') )
				{
					case USER_ROOT : // root
						echo form() -> combo('dsb_spv','select long',array(),null,null,array('disabled'=>true));
					break;
					
					case USER_ADMIN : // admin
						echo form() -> combo('dsb_spv','select long',array(),null,null,array('disabled'=>true));
					break;
					
					case USER_ACCOUNT_MANAGER : // mgr
						echo form() -> combo('dsb_spv','select long',array(),null,null,array('disabled'=>true));
					break;
					
					case USER_SUPERVISOR : // atm
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_LEADER,
							'act_mgr' => _get_session('AccountManager'),
							'spv_id' => _get_session('UserId'),
						));
						
						echo form() -> listcombo('dsb_spv','select long',$_user);
					break;
				}
			break;
			
			case 'detail-per-atm' :
				switch( _get_session('HandlingType') )
				{
					case USER_ROOT : // root
						echo form() -> combo('dsb_spv','select long',array(),null,null,array('disabled'=>true));
					break;
					
					case USER_ADMIN : // admin
						echo form() -> combo('dsb_spv','select long',array(),null,null,array('disabled'=>true));
					break;
					
					case USER_ACCOUNT_MANAGER : // mgr
						echo form() -> combo('dsb_spv','select long',array(),null,null,array('disabled'=>true));
					break;
				}
			break;
			
			case 'detail-per-mgr' :
				echo form() -> combo('dsb_spv','select long',array(),null,null,array('disabled'=>true));
			break;
			
			case 'summary-per-spv' :
				$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
					'handling_type' => USER_LEADER,
				));
				
				echo form() -> listcombo('dsb_spv','select long',$_user,_get_session('UserId'));
			break;
			
			case 'summary-per-tso' :
				echo form() -> combo('dsb_spv','select long',array(),null,null,array('disabled'=>true));
			break;
			
			case 'summary-per-atm' :
				echo form() -> combo('dsb_spv','select long',array(),null,null,array('disabled'=>true));
			break;
			
			case 'summary-per-mgr' :
				echo form() -> combo('dsb_spv','select long',array(),null,null,array('disabled'=>true));
			break;
			
			default :
				echo form() -> combo('dsb_spv','select long',array(),null,null,array('disabled'=>true));
			break;
		}
	}
	
	function handle_type_tso()
	{
		switch( $this->URI->_get_post('type') )
		{
			case 'detail-per-tso' :
				switch( _get_session('HandlingType') )
				{
					case USER_ROOT : // root
						echo form() -> combo('dsb_tso','select long', array(),null,null,array('disabled'=>true));
					break;
					
					case USER_ADMIN : // admin
						echo form() -> combo('dsb_tso','select long', array(),null,null,array('disabled'=>true));
					break;
					
					case USER_ACCOUNT_MANAGER : // mgr
						echo form() -> combo('dsb_tso','select long', array(),null,null,array('disabled'=>true));
					break;
					
					case USER_SUPERVISOR : // atm
						echo form() -> combo('dsb_tso','select long', array(),null,null,array('disabled'=>true));
					break;
					
					case USER_LEADER : // spv
						$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
							'handling_type' => USER_AGENT_OUTBOUND,
							'act_mgr' => _get_session('AccountManager'),
							'spv_id' => _get_session('SupervisorId'),
							'tl_id' => _get_session('UserId'),
						));
						
						echo form() -> listcombo('dsb_tso','select long',$_user);
					break;
				}
			break;
			
			case 'detail-per-spv' :
				switch( _get_session('HandlingType') )
				{
					case USER_ROOT : // root
						echo form() -> combo('dsb_tso','select long', array(),null,null,array('disabled'=>true));
					break;
					
					case USER_ADMIN : // admin
						echo form() -> combo('dsb_tso','select long', array(),null,null,array('disabled'=>true));
					break;
					
					case USER_ACCOUNT_MANAGER : // mgr
						echo form() -> combo('dsb_tso','select long', array(),null,null,array('disabled'=>true));
					break;
					
					case USER_SUPERVISOR : // atm
						echo form() -> combo('dsb_tso','select long', array(),null,null,array('disabled'=>true));
					break;
				}
			break;
			
			case 'detail-per-atm' :
				switch( _get_session('HandlingType') )
				{
					case USER_ROOT : // root
						echo form() -> combo('dsb_tso','select long', array(),null,null,array('disabled'=>true));
					break;
					
					case USER_ADMIN : // admin
						echo form() -> combo('dsb_tso','select long', array(),null,null,array('disabled'=>true));
					break;
					
					case USER_ACCOUNT_MANAGER : // mgr
						echo form() -> combo('dsb_tso','select long', array(),null,null,array('disabled'=>true));
					break;
				}
			break;
			
			case 'detail-per-mgr' :
				echo form() -> combo('dsb_tso','select long', array(),null,null,array('disabled'=>true));
			break;
			
			case 'summary-per-spv' :
				echo form() -> combo('dsb_tso','select long', array(),null,null,array('disabled'=>true));
			break;
			
			case 'summary-per-atm' :
				echo form() -> combo('dsb_tso','select long', array(),null,null,array('disabled'=>true));
			break;
			
			case 'summary-per-mgr' :
				echo form() -> combo('dsb_tso','select long', array(),null,null,array('disabled'=>true));
			break;
			
			case 'summary-per-tso' :
				$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
					'handling_type' => USER_AGENT_OUTBOUND,
				));
				
				echo form() -> listcombo('dsb_tso','select long',$_user,_get_session('UserId'));
			break;
			
			default :
				echo form() -> combo('dsb_tso','select long', array(),null,null,array('disabled'=>true));
			break;
		}
	}
	
	function load_atm()
	{
		$form = form() -> combo('dsb_atm','select long',array(),null,array(),array('disabled'=>true));
		
		if( $this->URI->_get_have_post('mgr') && $this->URI->_get_have_post('form') )
		{
			$uri_form = $this->URI->_get_post('form');
			$uri_event = ($this->URI->_get_have_post('event')?array('change'=>$this->URI->_get_post('event')):null);
			
			$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
				'handling_type' => USER_SUPERVISOR,
				'act_mgr' => $this->URI->_get_post('mgr')
			));
			
			$form = form()->$uri_form('dsb_atm','select long',$_user,null,$uri_event);
		}
		
		echo $form;
	}
	
	function load_spv()
	{
		$form = form() -> combo('dsb_spv','select long',array(),null,array(),array('disabled'=>true));
		
		if( $this->URI->_get_have_post('atm') && $this->URI->_get_have_post('form') )
		{
			$uri_form = $this->URI->_get_post('form');
			$uri_event = ($this->URI->_get_have_post('event')?array('change'=>$this->URI->_get_post('event')):null);
			
			$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
				'handling_type' => USER_LEADER,
				'spv_id' => $this->URI->_get_post('atm')
			));
			
			$form = form()->$uri_form('dsb_spv','select long',$_user,null,$uri_event);
		}
		
		echo $form;
	}
	
	function load_tso()
	{
		$form = form() -> combo('dsb_tso','select long',array(),null,array(),array('disabled'=>true));
		
		if( $this->URI->_get_have_post('spv') && $this->URI->_get_have_post('form') )
		{
			$uri_form = $this->URI->_get_post('form');
			$uri_event = ($this->URI->_get_have_post('event')?array('change'=>$this->URI->_get_post('event')):null);
			
			$_user = $this->M_DailyNewDashboard->_get_combo_user_query(array(
				'handling_type' => USER_AGENT_OUTBOUND,
				'tl_id' => $this->URI->_get_post('spv')
			));
			
			$form = form()->$uri_form('dsb_tso','select long',$_user,null,$uri_event);
		}
		
		echo $form;
	}
	
	/* end of handle combo by type */
	
	function ShowDashboard()
	{
		// if( isset($this->_temp[$this->URI->_get_post('dsb_type')]) )
		// {
			// $_conn = $this->_temp[$this->URI->_get_post('dsb_type')];
			// echo $_conn;
			// echo "<pre>";
			// var_dump($this->M_DailyNewDashboard->_query_detail_tso($this->URI->_get_all_request()));
			// echo "</pre>";die();
			$this->load->view('new_daily_dashboard/new_dashboard_show',array(
				'datas' => $this->M_DailyNewDashboard->_query_detail_tso($this->URI->_get_all_request()),
				// 'touch' => $this->M_DailyNewDashboard->{$_conn['solicited']}($this->URI->_get_all_request()),
				// 'times' => $this->M_DailyNewDashboard->_get_jam_current($this->URI->_get_all_request()),
				// 'loops' => ($this->URI->_get_have_post($_conn['loop'])?$this->URI->_get_post($_conn['loop']):null),
				// 'users' => $this->M_DailyNewDashboard->_get_combo_user_query(),
				'param' => $this->URI->_get_all_request()
			));
		// }
	}

	//tambahan irul
	function showDailyCallHistory() {
		$_user = $this->M_DailyNewDashboard->_getChart(_get_session('UserId'));
		echo json_encode(array('success'=> 1, 'data' => $_user));
	}
	//tutup tambahan irul
}
?>