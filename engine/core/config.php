<?php
	
	$cfg = array(	
		// Path where App is installed on server, example: https://example.com/mcApi/	 	
		'host_path' => 'https://example.com/mcApi/',
		
		// MySQL
		'mysql_user' => 'mysql_user',
		'mysql_pwd' => 'mysql_pwd',
		'mysql_host' => 'mysql_host',
		'mysql_dbmame' => 'mysql_db_name',		
		
		// MailChimp
		'mc_key' => 'mailchimp_api_key',
		
		// Tables for Mailchimmp in DB
		'mcTables' => array('mc_users')				
		);
	
	
	//  DO NOT CHANGE THIS!! - DATACENTER FOR API 	
	$cfg['mc_url'] = 'https://'.substr($cfg['mc_key'],strpos($cfg['mc_key'],'-')+1).'.api.mailchimp.com/3.0/';