<?php

    ini_set("display_errors", 1);
    error_reporting(E_ALL);

    require_once 'vendor/autoload.php';



	try {

        $redis = new Predis\Client();


	    // This connection is for a remote server
        /*

	        $redis = new PredisClient(array(

	            "scheme" => "tcp",

	            "host" => "153.202.124.2",

	            "port" => 6379

	        ));

	    */

	}

	catch (Exception $e) {

        die($e->getMessage());
    }

	$redis->set('message', 'Hello world');
	$value = $redis->get('message');
	print($value);



	echo ($redis->exists('message')) ? " Ouiiiiiiiiiiiiiii" : "please populate the message key";