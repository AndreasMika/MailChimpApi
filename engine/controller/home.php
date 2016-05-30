<?php 

	class home extends controller {
		
	
		public function __construct($cfg) {
			 parent::__construct($cfg);			
			}
		
				
		public function index() {					
			$check = $this->checkConnections();	
			$this->view('home/connections', array('cfg' => $this->cfg, 'checkUp' => $check));	
		}
		
				
		
		public function checkConnections() {								
			$check = array();
			$status = true;
			
			// PDO
			if($this->repository instanceof PDO) {
				$check['MySQL Connection'] = true;
			} else  {
				$check['MySQL Connection'] = false;
				$status = false;
			}			
			
			// Tables
			$check['Tables'] = $this->checkDbTables();			
			$status = $check['Tables']['status'];	
			
			return array('status' => $status, 'connections' => $check);
		}
				
		
		
		public function checkDbTables() {
			$check = array();
			$status = true;
						
			foreach($this->cfg['mcTables'] as $mcTable) {
				try { 
					$stmt = $this->repository->prepare("DESCRIBE ".$mcTable);            
					$stmt->execute();
					$res = $stmt->fetch(PDO::FETCH_ASSOC);
					$check['MySQL Table '.$mcTable] = true;	
				} catch(PDOException $e) {	
					$check['MySQL Table '.$mcTable] = false;	
					$status = false;
				}						
			}			
			return array('status' => $status, 'connections' => $check);			
		}
		
		
		
		
	}