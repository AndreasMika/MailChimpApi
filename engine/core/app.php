<?php
	
	// BOOTSTRAPING	
	class app {
		
		protected $controller = 'home';
		protected $method = 'index';
		protected $param = array();
		protected $repository = array();
		
		protected $cfg = array();
		
		public function __construct($cfg) {
			$url = $this->parseUrl();
			$this->cfg = $cfg;			
						
			// CONTROLLER
			if(file_exists('engine/controller/'.$url[0].'.php')) {				
				$this->controller = $url[0];
				unset($url[0]);	
			}
			require_once 'engine/controller/'.$this->controller.'.php';	
			$this->controller = new $this->controller($cfg);		
			
			// METHOD
			if(isset($url[1])) {
				if(method_exists($this->controller, $url[1])) {					
					$this->method = $url[1];
					unset($url[1]);	
				}				
			}
			
			// PARAM
			$this->param = array('config' => $cfg, 'param' => array_values($url));	
			
			
			call_user_func_array(array($this->controller, $this->method), $this->param);			
		}
		
		
		
		public function parseUrl() {
			if(isset($_GET['controller'])) {				
				return $url = explode('/', filter_var(rtrim($_GET['controller'], '/'), FILTER_SANITIZE_URL));
			}	
		}
		
	}