<?php

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
class ServerMonitoring extends EUI_Controller
{



/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
 
public function ServerMonitoring()
{
	parent::__construct();
}


/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
function index()
{
	if( $this ->EUI_Session -> _have_get_session('UserId') )
	{
		$this -> load->view('mon_server_view/view_server_index', array('server' => null));
	}
}

/*
 * @ def 		: index / default pages controller 
 * -----------------------------------------
 *
 * @ params  	: post & definition paymode 
 * @ return 	: void(0)
 */
 
public function ServerInfo()
{
	$sysinfo =& sysinfo::get_instance();
	$load    = $sysinfo->loadavg();
	$uptime	 = $sysinfo->uptime();
	
	//set all information to neded show in client 
	
	$memory 		= $sysinfo->memory();
	$memory_app 	= isset($memory["ram"]["app"]) ? $memory["ram"]["app"] : $memory["ram"]["total"] - $memory["ram"]["t_free"];
	$memory_tot 	= $memory["ram"]["total"];
	$memory_use 	= ($memory_app/$memory_tot)*100;
	$swap_use 		= $memory["swap"]["total"]-$memory["swap"]["free"];        
	$swap_tot		= $memory["swap"]["total"];
	$disks 			= $sysinfo->disk();
	$networks 		= $sysinfo->network();
	
//set all network to neded show in client 

	$content_array = array();
	$list_networks = array();
	$list_data = array();
	
	foreach($networks as $net_name => $net)
	{
		$net_name = trim($net_name);
		if ($net_name == 'lo' || $net_name == 'sit0' || preg_match('/w.g./',$net_name)) continue;
			$tx = new average_rate_calculator($_SESSION["netstats"][$net_name]["tx"], 10); // 30s max age
			$rx = new average_rate_calculator($_SESSION["netstats"][$net_name]["rx"], 10); // 30s max age
			$rx -> add($net["rx_bytes"] );
			$tx -> add($net["tx_bytes"] );
			
		$list_networks[]= array ( 
			'tx_bytes' => array('net_name' => $net_name, 'avg' => $tx->average()),
			'rx_bytes' => array( 'net_name' => $net_name, 'avg' => $rx->average())
		);
	}
	
	
	
/** set memory array session **/

	$list_disk = array();	
	foreach($disks as $disk){ 
		$percent_free = 100*$disk['free']/$disk['size'];
		$list_disk[$disk['disk']] = array( 'disk_free' => $disk['free'], 'disk_size' => $disk['size'], 'free_disk_size' => $percent_free );
	}
	
/** content array ***/
	
	$content_array['server'] = array
	(
		'sys_uptime'  => $uptime,  
		'sys_load' 	  =>  array('sys_load_avg' => $load['avg'][0], 'sys_load_cpu' => $load['cpupercent']),
		'sys_memory'  => array('sys_memory_apps' => $memory_app, 'sys_memory_tot' => $memory_tot, 'sys_memory_used' => $memory_use),
		'sys_swap' 	  => array('sys_swap_used' => $swap_use, 'sys_swap_tots' => $swap_tot ),
		'sys_disk' 	  => $list_disk,
		'sys_network' => $list_networks
	);
		
	echo json_encode($content_array);
}	

/** function shutdown ***/

public function shutdown()
{
	system("sudo /sbin/shutdown -h now");
	echo json_encode(array('error'=>1));
	exit;
 }

/** function shutdown ***/

public function reboot()
 {
	system("sudo /sbin/reboot");
	echo json_encode(array('error'=>1));
	exit;
 }

/** function restartService centerback ***/

public function restartCenterback()
 {
	system("sudo /sbin/service centerback restart");
	echo json_encode(array('error'=>1));
	exit;
}


/** function restartHttpd ***/

public function restartHttpd()
{
	system("sudo /sbin/service httpd restart");
	echo json_encode(array('error'=>1));
	exit;
 }
	
/** function shutdown ***/

public function restartMYSQL()
{
	system("sudo /sbin/service mysqld restart");
	echo json_encode(array('error'=>1));
	exit;
 }	
	
	
/** function shutdown ***/

public function restartNetwork()
{
	system("sudo /sbin/service network restart");
	echo json_encode(array('error'=>1));
	exit;
 }	
	
}
	
?>