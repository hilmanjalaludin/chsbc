<?php
/*
 * E.U.I
 *
 
 * @ meta 	 : tms_application_config
 * @ params	 : _tms_application_config
 * @ link	 : meta_data 
 */
 
$_meta_data['tms_application_config'] = array
 (
	'_cols' => array
	(
		'module_name' 	=> array('type' => 'VARCHAR', 'length' => 30, 'unsigned' => '', 'allow' => 'NULL', 'comment' =>'', 'default'=> 'NULL'),
		'param_name' 	=> array('type' => 'VARCHAR', 'length' => 30, 'unsigned' => '', 'allow' => 'NULL', 'comment' =>'', 'default'=> 'NULL'),
		'param_value' 	=> array('type' => 'VARCHAR', 'length' => 50, 'unsigned' => '', 'allow' => 'NULL', 'comment' =>'', 'default'=> 'NULL'),
		'description' 	=> array('type' => 'VARCHAR', 'length' => 225,'unsigned' => '', 'allow' => 'NULL', 'comment' =>'', 'default'=> 'NULL'),
		'content' 		=> array('type' => 'MEDIUMTEXT', 'length' => 0, 'unsigned' => '', 'allow' => 'NULL', 'comment' =>'', 'default'=> 'NULL'),
		'updated_by' 	=> array('type' => 'VARCHAR', 'length' => 32, 'unsigned' => '', 'allow' => 'NULL', 'comment' =>'', 'default'=> 'NULL'),
		'last_update' 	=> array('type' => 'DATETIME', 'length' => 0, 'unsigned' => '', 'allow' => 'NULL', 'comment' =>'', 'default'=> 'NULL')
	),
	
	'_attr' => array
	(
		'primary' => array('module_name','param_name'),
		'engine'  => 'MyISAM',
		'collate' => 'utf8_general_ci', 
		'auto'	  =>  0
	)
  );
	

// END OF FILE 
// LOCATION : ./meta/insurance/t_gn_campaigngroup

?>