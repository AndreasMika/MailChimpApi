<?php

	class controller {		
		
		protected $repository;
		protected $cfg = NULL;			
		
		public function __construct($cfg) {				
			$this->cfg = $cfg;
			try { 
				$this->repository = new PDO("mysql:host=".$this->cfg['mysql_host'].";
											 dbname=".$this->cfg['mysql_dbmame'], 
											 $this->cfg['mysql_user'], 
											 $this->cfg['mysql_pwd'], 
											 array(PDO::ATTR_PERSISTENT => true)); 
											 
				$this->repository->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->repository->exec("SET CHARACTER SET utf8");  
			}  
				catch(PDOException $e) {  
				echo $e->getMessage();  
			} 					
		}		
		
		protected function model($model) {
			require_once('engine/model/'.$model.'.php');
			return new $model();
		}
				
		public function view($view, $data = array()) {	
			if(!$this->cfg['onlyMain']) {
				require_once 'engine/view/header.php';
				require_once 'engine/view/'.$view.'.php';
				require_once 'engine/view/footer.php';
			} else {
				require_once 'engine/view/'.$view.'.php';
			}			
		}
		
	}