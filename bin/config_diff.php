<?php

#
# as new features are added from config.php.example track them
#

$root = dirname(dirname(__FILE__));
ini_set("include_path", "{$root}/www:{$root}/www/include");
	
include("include/config.php");
	
$config = $GLOBALS['cfg'];
	
include("include/config.php.example");
    
$example = $GLOBALS['cfg'];
	
foreach($config as $key => $value) {
   if(!isset($example[$key])) {
   	echo "$key: $value appears only in config\n";
   }
   elseif ($config[$key] != $example[$key]) {
	echo "$key: $value differs from default $example[$key]\n";
   }
}
	
foreach($example as $key => $value) {
   if (!isset($config[$key])) {
      echo "MISSING $key, default is $example[$key]\n";
   }
}
	
