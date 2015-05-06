<?php

class view {

	function __construct() {
	
	}
	
		public function render($name, $noinclude = false)
		
		{
			if ($noinclude== true){
			 require'views/header.php';
		   	require 'views/'.$name. '.php';
              require'views/footer.php';
			}
			else{
		
                           require'views/header.php';
                          
                           require 'views/'.$name. '.php';
			require'views/side.php';
			require'views/footer.php';
			}
		}

}












