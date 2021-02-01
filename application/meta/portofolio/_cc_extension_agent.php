<?php
/*
 * E.U.I
 *
 
 * @ meta 	 : tms_application_config
 * @ params	 : _tms_application_config
 * @ link	 : meta_data 
 */
 
$_meta_data['cc_extension_agent'] = array
 (
	'_cols' => array
	(
		'id' => array('type' => 'INT', 'length' => 4, 'unsigned' => '', 'allow' => 'NULL', 'comment' =>'', 'default'=> 'NULL'),
		'pbx' => array('type' => 'INT', 'length' => 10, 'unsigned' => 'UNSIGNED', 'allow' => 'NULL', 'comment' =>'', 'default'=> '0'),
		'ext_number' => array('type' => 'VARCHAR', 'length' => 8, 'unsigned' => '', 'allow' => 'NULL', 'comment' =>'', 'default'=> 'NULL'),
		'ext_desc' => array('type' => 'VARCHAR', 'length' => 64,'unsigned' => '', 'allow' => 'NULL', 'comment' =>'', 'default'=> 'NULL'),
		'ext_type' => array('type' => 'SMALLINT', 'length' => 3, 'unsigned' => '', 'allow' => 'NULL', 'comment' =>'', 'default'=> '0'),
		'ext_status' => array('type' => 'SMALLINT', 'length' => 3, 'unsigned' => '', 'allow' => 'NULL', 'comment' =>'', 'default'=> '0'),
		'ext_location' => array('type' => 'DATETIME', 'length' => 64, 'unsigned' => '', 'allow' => 'NULL', 'comment' =>'', 'default'=> 'NULL')
	),
	
	'_attr' => array
	(
		'primary' => array('id'),
		'engine'  => 'MyISAM',
		'collate' => 'utf8_general_ci', 
		'auto'	  =>  0
	)
  );
	

// END OF FILE 
// LOCATION : ./meta/insurance/t_gn_campaigngroup

?>