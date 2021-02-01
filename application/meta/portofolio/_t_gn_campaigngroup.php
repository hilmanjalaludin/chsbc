<?php
/*
 * E.U.I
 *
 
 * @ meta 	 : t_gn_campaigngroup
 * @ params	 : _t_gn_campaigngroup
 * @ link	 : meta_data 
 */
 
$_meta_data['t_gn_campaigngroup'] = array
(
	'_cols' => array
	(
		'CampaignGroupId' 		   => array('type' => 'INT', 	 'length' => 10,  'unsigned'=> 'UNSIGNED',  'allow'=> 'NOT NULL', 'comment' => '', 'default' => 'AUTO_INCREMENT' ),		
		'CampaignGroupCode' 	   => array('type' => 'VARCHAR', 'length' => 50,  'unsigned' =>'', 			'allow'=> 'NOT NULL', 'comment' => '', 'default' => '' ),
		'CampaignGroupName' 	   => array('type' => 'VARCHAR', 'length' =>50,   'unsigned' =>'', 			'allow'=> 'NOT NULL', 'comment' => '', 'default' => '' ),
		'CampaignGroupStatusFlag'  => array('type' => 'TINYINT', 'length' => 1,   'unsigned' =>'', 			'allow'=> 'NOT NULL', 'comment' => '', 'default' => '' )
		
	),
	'_attr' => array
	(
		'primary' => array('CampaignGroupId'),
		'engine'  => 'InnoDB',
		'collate' => 'latin1_swedish_ci', 
		'auto'	  =>  0
	)
);


// END OF FILE 
// LOCATION : ./meta/insurance/t_gn_campaigngroup
?>
