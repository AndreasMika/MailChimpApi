<?php 

	class install extends controller {
		
		public function __construct($cfg) {
			 parent::__construct($cfg);			
			}		
		
		
		public function index() {
			$checkUp = $this->checkDbTables();
			$this->view('install/index', array('cfg' => $this->cfg, 'checkUp' => $checkUp));				
		}		
		
		
		// INSTALLS ALL CONFIGURED TABLES
		public function go() {	
				
			foreach($this->cfg['mcTables'] as $tbl) {
				$shema = $this->model('shema');
				$shema->getTableShema($tbl);
				
				if($shema->shema > '') {
					try { 
						$stmt = $this->repository->prepare($shema->shema);            
						$stmt->execute();					
					} catch(PDOException $e) {	
						$log[] = $e->getMessage();						
					}	
				} else {
				$log[] = 'No shema for '.$tbl." configured";	
				}					
			}							
					
			$checkUp = $this->checkDbTables();	
			$this->view('install/tables', array('cfg' => $this->cfg, 'checkUp' => $checkUp));
					
			if($check['status'] !== true) {				
				return;	
			}
			
			$this->view('home/index', array('cfg' => $this->cfg));
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