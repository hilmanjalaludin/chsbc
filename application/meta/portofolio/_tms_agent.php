<?php
/*
 * E.U.I
 *
 
 * @ meta 	 : tms_agent
 * @ params	 : _tms_agent
 * @ link	 : meta_data 
 */
 
$_meta_data['tms_agent'] = array
 (
	'_cols' => array
	(
		'UserId' 			=> array('type' => 'INT', 	  	'length' => 10,  'unsigned' => 'UNSIGNED',  'allow' => 'NOT NULL',  'comment' =>'',  'default' => 'AUTO_INCREMENT' ),
		'id' 				=> array('type' => 'VARCHAR', 	'length' => 16,  'unsigned' => 'UNSIGNED',  'allow' => 'NOT NULL',  'comment' =>'',  'default' => 'NULL'),
		'code_user' 		=> array('type' => 'VARCHAR', 	'length' => 6,   'unsigned' => 'UNSIGNED',  'allow' => 'NOT NULL',  'comment' =>'',  'default' => 'NULL'),
		'full_name' 		=> array('type' => 'VARCHAR', 	'length' => 40,  'unsigned' => 'UNSIGNED',  'allow' => 'NOT NULL',  'comment' =>'',  'default' => 'NULL'),
		'init_name' 		=> array('type' => 'VARCHAR', 	'length' => 16,  'unsigned' => 'UNSIGNED',  'allow' => 'NOT NULL',  'comment' =>'',  'default' => 'NULL'),
		'profile_id' 		=> array('type' => 'INT', 		'length' => 32,  'unsigned' => 'UNSIGNED',  'allow' => 'NOT NULL',  'comment' =>'',  'default' => 'NULL'),
		'group_id' 			=> array('type' => 'INT', 		'length' => 32,  'unsigned' => 'UNSIGNED',  'allow' => 'NOT NULL',  'comment' =>'',  'default' => 'NULL'),
		'handling_type' 	=> array('type' => 'INT', 		'length' => 1,   'unsigned' => 'UNSIGNED',  'allow' => 'NOT NULL',  'comment' =>'',  'default' => 'NULL'),
		'agency_id' 		=> array('type' => 'VARCHAR', 	'length' => 2,   'unsigned' => 'UNSIGNED',  'allow' => 'NOT NULL',  'comment' =>'',  'default' => 'NULL'),
		'spv_id' 			=> array('type' => 'INT', 		'length' => 2,   'unsigned' => 'UNSIGNED',  'allow' => 'NOT NULL',  'comment' =>'',  'default' => 'NULL'),
		'mgr_id' 			=> array('type' => 'INT', 		'length' => 4,   'unsigned' => 'UNSIGNED',  'allow' => 'NOT NULL',  'comment' =>'',  'default' => 'NULL'),
		'password' 			=> array('type' => 'VARCHAR', 	'length' => 255, 'unsigned' => 'UNSIGNED',  'allow' => 'NOT NULL',  'comment' =>'',  'default' => 'NULL'),
		'ip_address' 		=> array('type' => 'VARCHAR', 	'length' => 16,  'unsigned' => 'UNSIGNED',  'allow' => 'NOT NULL',  'comment' =>'',  'default' => 'NULL'),
		'user_state' 		=> array('type' => 'INT', 		'length' => 1,   'unsigned' => 'UNSIGNED',  'allow' => 'NOT NULL',  'comment' =>'',  'default' => 'NULL'),
		'logged_state' 		=> array('type' => 'INT', 		'length' => 1,   'unsigned' => 'UNSIGNED',  'allow' => 'NOT NULL',  'comment' =>'',  'default' => 'NULL'),
		'login_count' 		=> array('type' => 'INT', 		'length' => 10,  'unsigned' => 'UNSIGNED',  'allow' => 'NOT NULL',  'comment' =>'',  'default' => 'NULL'),
		'updated_by' 		=> array('type' => 'VARCHAR', 	'length' => 30,  'unsigned' => 'UNSIGNED',  'allow' => 'NOT NULL',  'comment' =>'',  'default' => 'NULL'),
		'last_update' 	 	=> array('type' => 'DATETIME',  'length' => 0,   'unsigned' => 'UNSIGNED',  'allow' => 'NOT NULL',  'comment' =>'',  'default' => 'NULL'),
		'update_password' 	=> array('type' => 'DATETIME',  'length' => 0,   'unsigned' => 'UNSIGNED',  'allow' => 'NOT NULL',  'comment' =>'',  'default' => 'NULL'),
		'telphone' 			=> array('type' => 'TINYINT', 	'length' => 3    'unsigned' => 'UNSIGNED',  'allow' => 'NOT NULL',  'comment' =>'',  'default' => 'NULL')
	),
	
	'_attr' => array
	(
		'primary' => array('UserId'),
		'engine'  => 'InnoDB',
		'collate' => 'latin1_swedish_ci', 
		'auto'	  =>  0
	)
);

// END OF FILE 
// LOCATION : ./meta/insurance/t_gn_campaigngroup

?>
	