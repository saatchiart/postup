<?php

$loader = require dirname(__DIR__) . '/vendor/autoload.php';

$username = getenv('POSTUP_USERNAME');
$passwd = getenv('POSTUP_PASSWORD');
$options = array('classmap' => \Demand\Postup\ClassMap::classMap());
$adapter = new \Demand\Soap\ClientAdapter('https://api.postup.com/services/SoapRequestProcessor?wsdl',$options);
$client = new \Demand\Postup\ApiClient($adapter);
$auth = new \Demand\Postup\Struct\Authentication($username,$passwd);
$client->setAuthentication($auth);