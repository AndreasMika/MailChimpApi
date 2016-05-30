<?php 

	class client extends controller {
		
		const METHODE_GET = 'GET';
		const METHODE_PATCH = 'PATCH';
		const METHODE_PUT = 'PUT';
		const METHODE_POST = 'POST';
		const METHODE_DELETE = 'DELETE';		
		
		protected $validMethods = array(
			self::METHODE_GET,
			self::METHODE_PATCH,
			self::METHODE_PUT,
			self::METHODE_POST,
			self::METHODE_DELETE
			);
				
		protected $cURL;
		
		public function __construct($cfg) {
			parent::__construct($cfg);	
			}	
					
		
		public function index() {
			echo "client | index";			
		}
	 
	 	public function getLists() {			
			$lists = json_decode($this->get('lists'), true);
						
			$listOut = array();
			foreach($lists['lists'] as $list) {
				$listOut[] = array('id' => $list['id'],
								   'name' => $list['name'],
								   'contact' => $list['contact']
								   );
				}
			$this->cfg['onlyMain'] = true;
			$this->view('client/lists', array('cfg' => $this->cfg, 'lists' => $listOut));
			}
	 
	 	public function getList($url = array(), $params = array()) {
			$list = json_decode($this->get('lists/'.$params[0].'/members'), true);	
			
			$this->cfg['onlyMain'] = true;
			$this->view('client/list', array('cfg' => $this->cfg, 'list' => $list, 'listID' => $params[0]));	
		}	 
	 	
		public function mcSyncUsersToDb($url = array(), $params = array()) {
			
			try { 
					$stmt = $this->repository->prepare("SELECT email from mc_users"); 
					$stmt->execute();
					$res = $stmt->fetchAll();
					
					$emailsInDB = implode(',', $res);
										
				} catch(PDOException $e) {	
					$log[] = $e->getMessage();
					return;	
				}	
						
			$list = json_decode($this->get('lists/'.$params[0].'/members'), true);
			
			$insertCounter = 0;			
			foreach($list['members'] as $member) {				
				
				if(!in_array($member['email_adress'], $emailsInDB)) {
					try { 
						$stmt = $this->repository->prepare("INSERT INTO mc_users (`id`, `firstname`, `lastname`, `email`, `age`) 
															VALUES (NULL, :firstname, :lastname, :email, :age);"); 
															 
						$stmt->bindParam(':firstname', $member['merge_fields']['FNAME']); 
						$stmt->bindParam(':lastname', $member['merge_fields']['LNAME']); 
						$stmt->bindParam(':email', $member['email_address']); 						
						
					  	$tz  = new DateTimeZone('Europe/Brussels');
						$age = DateTime::createFromFormat('Y-m-d', $member['merge_fields']['BIRTHDAY'], $tz)
						 				->diff(new DateTime('now', $tz))
						 				->y;
						
						$stmt->bindParam(':age', $age);          
						$stmt->execute();											
						$insertCounter++;					
					
					} catch(PDOException $e) {	
						$log[] = $e->getMessage();	
					}
				}				
			}
						
			$this->cfg['onlyMain'] = true;
			$this->view('client/sync', array('cfg' => $this->cfg, 'list' => $list, 'listID' => $params[0], 'insertCounter' => $insertCounter));	
		}	 
	 
	 	public function get($url, $params = array()) {	
			return $this->call($url, self::METHODE_GET, array(), $params);
		}
	 
		public function post($url, $data = array(), $params = array()) {
			return $this->call($url, self::METHODE_POST, $data, $params);
		}
	 
		public function put($url, $data = array(), $params = array()) {
			return $this->call($url, self::METHODE_PUT, $data, $params);
		}
		
		public function patch($url, $data = array(), $params = array()) {
			return $this->call($url, self::METHODE_PATCH, $data, $params);
		}
	 
		public function delete($url, $params = array()) {
			return $this->call($url, self::METHODE_DELETE, array(), $params);
		}
	 
	 
		public function call($url, $method = self::METHODE_GET, $data = array(), $params = array()) {
			if (!in_array($method, $this->validMethods)) {
				throw new Exception('Invalid HTTP-Methode: ' . $method);
			}
			
			$queryString = '';
			
			if (count($params) > 0) {
				$queryString .= '/'.implode('/', $params);
			}
			
			$url = $this->cfg['mc_url'].$url.$queryString;
			$dataString = json_encode($data);				
			
			
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $this->cfg['mc_key']);
			curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);																															
		
			$result = curl_exec($ch);
			$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);
			
			
			if($httpCode != 200) {
				$log[] = $result;
				}
				
			return $result;
		}
	 
		
		
	}