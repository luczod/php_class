<?php
// model
class Book
{
	public string $name;
	public int $year;
}

// create instance and set a book name
$book = new Book();
$book->name = 'test 2';

// initialize SOAP client and call web service function
$client = new SoapClient('http://127.0.0.1/soapProj/server.php?wsdl', ['trace' => 1, 'cache_wsdl' => WSDL_CACHE_NONE]);
$resp  = $client->bookYear($book);

// dump response
var_dump($resp);
