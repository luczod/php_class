<?php

/* class Book
{
	public $name;
	public $year;
}

// create instance and set a book name
$book = new Book();
$book->name = 'test 2'; */

// initialize SOAP client and call web service function
$client = new SoapClient('http://localhost/soapProj/server.php?wsdl', ['trace' => 1, 'cache_wsdl' => WSDL_CACHE_NONE]);

// Test the sum method
$resultSum = $client->sum(5, 10);
echo "Sum: " . $resultSum . "<br/>"; // Outputs: Sum: 15

// Test the subtract method
$resultSubtract = $client->subtract(10, 5);
echo "Subtract: " . $resultSubtract . "<br/>"; // Outputs: Subtract: 5

// Test the multiply method
$resultMultiply = $client->multiply(4, 5);
echo "Multiply: " . $resultMultiply . "<br/>"; // Outputs: Multiply: 20
