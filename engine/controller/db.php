<?php 

	class db extends controller {
		
		public function __construct($cfg) {
			 parent::__construct($cfg);			
			}		
		
		
		public function index() {						
			$this->view('db/index', array('cfg' => $this->cfg));			
		}		
		
		
		public function showTable($cfg, $param) {
			try { 
				$stmt = $this->repository->prepare("SELECT * FROM ".$param[0]); 				         
				$stmt->execute();											
				$res = $stmt->fetchAll(PDO::FETCH_ASSOC);	
			} catch(PDOException $e) {	
				$log[] = $e->getMessage();	
			}			
			$this->cfg['onlyMain'] = true;
			$this->view('db/showTable', array('cfg' => $this->cfg, 'tblName' => $param[0], 'mc_users' => $res));			
		}
		
		
	}