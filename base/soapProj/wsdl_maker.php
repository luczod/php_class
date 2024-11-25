<?php
// wsdl_maker.php
require_once 'vendor/autoload.php'; // composer require php2wsdl/php2wsdl
require_once 'Mathematics.php'; // Service Class

// The class that contains the web service methods.
$serviceClass = 'Mathematics';

// The name of the service.
$serviceName = 'MathematicsService';

// The location of the service
$serviceUri = "http://localhost/soapProj/server.php";

// Create a new instance of PHPClass2WSDL.
$wsdlGenerator = new PHP2WSDL\PHPClass2WSDL($serviceClass, $serviceUri);

// Generate and save the WSDL file.
$wsdlGenerator->generateWSDL(true);

// Save file to the disk
$wsdlGenerator->save('MathematicsSample.wsdl');
