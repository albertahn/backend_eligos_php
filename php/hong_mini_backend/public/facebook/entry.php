<?php
include_once "{$PATH['FACEBOOK']}facebook.php";

// Create our Application instance.
$facebook = new Facebook(array(
  'appId' => '312684782094658',
  'secret' => '9cf8a8ccf6729a40d40363a33930a9ed',
  'cookie' => true,
));

$session = $facebook->getSession();
