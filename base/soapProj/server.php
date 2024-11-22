<?php
// turn off WSDL caching
ini_set("soap.wsdl_cache_enabled", "0");

// model, which uses in web service functions as parameter
class Book
{
	public string $name;
	public int $year;
}

/**
 * Determines published year of the book by name.
 * @param Book $book book instance with name set.
 * @return int published year of the book or 0 if not found.
 */
function bookYear(Book $book): int
{
	// list of the books
	$_books = [
		['name' => 'test 1', 'year' => 2011],
		['name' => 'test 2', 'year' => 2012],
		['name' => 'test 3', 'year' => 2013],
	];
	// search book by name
	foreach ($_books as $bk) {
		if ($bk['name'] == $book->name) {
			return $bk['year']; // book found
		}
	}

	return 0; // book not found
}

/* 
create file.wsdl automatically
if (!file_exists("sample.wsdl")) {
	require 'Zend/Soap/AutoDiscover.php';
	$ad = new Zend_Soap_AutoDiscover();
	$ad->addFunction('bookYear');
	$wsdl = $ad->toXml();
	file_put_contents("sample.wsdl", $wsdl);
} 
*/


if (isset($_REQUEST['wsdl'])) {
	// Web Services Description Language (WSDL) 
	$wsdl = file_get_contents("sample.wsdl");
	header('Content-type: text/xml');
	print($wsdl);
	exit(200);
}

// initialize SOAP Server
$server = new SoapServer("sample.wsdl", [ // a file
	'classmap' => [
		'book' => 'Book', // 'book' complex type in WSDL file mapped to the Book PHP class
	]
]);

// register available functions
$server->addFunction('bookYear');

// start handling requests
$server->handle();


// https://www.youtube.com/watch?v=sCypdSzDoCQ
// composer require zendframework/zend-soap This package is abandoned
// composer require laminas/laminas-soap  This package is abandoned ??
// composer rm laminas/laminas-soap