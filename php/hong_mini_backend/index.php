<?php
//use an auto loader


require 'config/paths.php';
require 'config/database.php';
require 'config/constants.php';

/**
require 'libs/bootstrap.php';
require 'libs/controller.php';
require 'libs/view.php';
require 'libs/model.php';
//library
require 'libs/database.php';
require 'libs/session.php';
require 'libs/hash.php';


**/




function __autoload($class){
    require 'libs/'.$class.'.php';
}



$app = new bootstrap();


//facebook login
//require 'public/facebook/facebook.php';