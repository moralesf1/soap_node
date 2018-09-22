<?php

$arrContextOptions=array("ssl"=>array( "verify_peer"=>false, "verify_peer_name"=>false,'crypto_method' => STREAM_CRYPTO_METHOD_TLS_CLIENT));
$wsdlUrl = 'http://127.0.0.1/soap/server.php?wsdl';

$options = array(
    'soap_version'=>SOAP_1_2,
    'exceptions'=>true,
    'trace'=>1,
    'cache_wsdl'=>WSDL_CACHE_NONE,
    'stream_context' => stream_context_create($arrContextOptions),
    'features' => SOAP_SINGLE_ELEMENT_ARRAYS
);

class Request {
    public $request;

    public function getMethod(){
        return $_SERVER["REQUEST_METHOD"];
    }
    public function isMethod($method){
        return $this->getMethod() == $method;
    }
    public function getParams(){
        if ($this->isMethod("PUT")){
            parse_str(file_get_contents("php://input"),$arguments);
        }
        if ($this->isMethod("POST")){
            $arguments = $_POST;
        }
        if ($this->isMethod("GET")){
            $arguments = $_GET;
        }
        return $arguments;
    }
    public function getEndPoint(){
        if (!isset($_GET["endpoint"])){
            return "endpoint not defined!!";
        }
        return $_GET["endpoint"];
    }
    public function __construct() {
        $this->request = $this->getMethod();
    }
}
class run {

}
try{

    $request = new Request();
    $client=new SoapClient($wsdlUrl,$options);
    $endpoint = $request->getEndPoint();
    $flag = true;
    $params = $request->getParams();
    if ($endpoint == "addUser" && $request->isMethod("PUT")){
        $resp = $client->addUser($params["username"],$params["password"],$params["email"]);
        var_dump($resp);
        $flag = false;
    }
    if ($endpoint == "activateUser" && $request->isMethod("POST")){
        $resp = $client->activateUser($params["username"]);
        var_dump($resp);
        $flag = false;
    }
    if ($endpoint == "deactivateUser" && $request->isMethod("POST")){
        $resp = $client->deactivateUser($params["username"]);
        var_dump($resp);
        $flag = false;
    }
    if ($endpoint == "getUser" && $request->isMethod("GET")){
        $resp = $client->getUser($params["username"]);
        var_dump($resp);
        $flag = false;
    }
    if ($flag) {
        var_dump("Method not allowed!!");
    }
}catch (Exception $e){
    echo $e->getMessage();
}
