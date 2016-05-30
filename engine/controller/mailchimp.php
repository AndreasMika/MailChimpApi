<?php

	class mailchimp extends controller {
		
		public function __construct($cfg) {
			parent::__construct($cfg);
			}	
		
		public function index() {
				$this->view('mailchimp/index', array('cfg' => $this->cfg));
		}		
		
	}