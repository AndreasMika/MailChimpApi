<?php

	class shema extends model {		
		
		public $shema;
		
		public function getTableShema($tbl) {
						
			$shemas = array('mc_users' => 'CREATE TABLE IF NOT EXISTS `mc_users` (
											  `id` int(25) NOT NULL AUTO_INCREMENT,
											  `firstname` varchar(80) COLLATE latin1_german2_ci NOT NULL,
											  `lastname` varchar(80) COLLATE latin1_german2_ci NOT NULL,
											  `email` varchar(80) COLLATE latin1_german2_ci NOT NULL,
											  `age` int(3) NOT NULL,
											  PRIMARY KEY (`id`),
											  UNIQUE KEY `email` (`email`)
											) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_german2_ci AUTO_INCREMENT=1;'
							);
			
			$this->shema = $shemas[$tbl];				
		}
		
	}
