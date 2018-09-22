<?php
// turn off WSDL caching
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);
// model, which uses in web service functions as parameter
class Book
{
    public $name;
    public $year;
}

/**
 * Determines published year of the book by name.
 * @param Book $book book instance with name set.
 * @return int published year of the book or 0 if not found.
 */
function bookYears($book)
{
    // list of the books
    $_books=[
        ['name'=>'test 1','year'=>2011],
        ['name'=>'test 2','year'=>2012],
        ['name'=>'test 3','year'=>2013],
    ];
    // search book by name
    foreach($_books as $bk)

        if($bk['name']==$book->name)
            return $bk['year']; // book found

    return 0; // book not found
}
function addUser($username = null,$password = null,$email = null){
    if (is_null($username) || $username == "" || is_null($password) || $password == "" || is_null($email) || $email == ""){
        return array("status_code" => -1);
    }
    else {
        return array("status_code" => 0);
    }
}
function activateUser($username = null) {
    if (is_null($username) || $username == ""){
        return array("status_code" => -1);
    }
    else {
        return array("status_code" => 0);
    }
}
function deactivateUser($username = null){
    if (is_null($username) || $username == ""){
        return array("status_code" => -1);
    }
    else {
        return array("status_code" => 0);
    }
}
function getUser($username = null) {
    if (is_null($username) || $username == ""){
        return array("status_code" => -1);
    }
    else {
        return array("username" => $username,"password" => '$2b$10$FSZuPR3AB57VUYUSsrzw3e2vH1RFpQA0Q5KqH6w9y1j3W.rsvnLpi',"email" => "$username@mail.com");
    }
}
// initialize SOAP Server
$server=new SoapServer("test.wsdl",[
    'classmap'=>[
        'book'=>'Book', // 'book' complex type in WSDL file mapped to the Book PHP class
    ]
]);

// register available functions
$server->addFunction('bookYears');
$server->addFunction('addUser');
$server->addFunction('activateUser');
$server->addFunction('deactivateUser');
$server->addFunction('getUser');

// start handling requests
$server->handle();

