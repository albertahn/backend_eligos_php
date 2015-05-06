<?php
	
	class help extends controller  {
	
		function __construct() {
		parent::__construct();
		
	}
		function index() {
		   $this->view->render('help/index');
		}
		
		public function other($arg = false) {
			
			
			require 'models/help_model.php';
			$model= new help_model();
			$this->view->test =$model->test();
	}

}

