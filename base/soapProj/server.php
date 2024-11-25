<?php
require_once 'Mathematics.php';

// turn off WSDL caching
ini_set("soap.wsdl_cache_enabled", "0");

$path = __DIR__ . '/wsdl_maker.php';
$command = 'php ' . $path;

// create file.wsdl automatically
if (!file_exists("MathematicsSample.wsdl")) {
	exec($command);
}



if (isset($_REQUEST['wsdl'])) {
	// Web Services Description Language (WSDL) 
	$wsdl = file_get_contents("MathematicsSample.wsdl");
	header('Content-type: text/xml');
	print($wsdl);
	exit(200);
}

// initialize SOAP Server
/* $server = new SoapServer("sample.wsdl", [ // a file
	'classmap' => [
		'book' => 'Book', // 'book' complex type in WSDL file mapped to the Book PHP class
	]
]); */

// initialize SOAP Server
$server = new SoapServer("MathematicsSample.wsdl", [
	'uri' => 'http://localhost/soapProj/server.php'
]);


// register available functions
// $server->addFunction("bookYear");

// Set the class that contains the methods to be exposed
$server->setClass('Mathematics');

// start handling requests
$server->handle();


// https://www.youtube.com/watch?v=sCypdSzDoCQ
// composer require zendframework/zend-soap This package is abandoned
// composer require laminas/laminas-soap  This package is abandoned ??
