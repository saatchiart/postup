<?php

$loader = require dirname(__DIR__) . '/vendor/autoload.php';

$options = array('classmap' => \Demand\Postup\ClassMap::classMap());
$adapter = new \Demand\Soap\ClientAdapter('https://api.postup.com/services/SoapRequestProcessor?wsdl',$options);
$client = new \Demand\Postup\ServiceClient($adapter);
$auth = new \Demand\Postup\Struct\Authentication();
$client->setAuthentication($auth);

$resp = $client->getLists(new \Demand\Postup\Struct\ListStruct());

print "the raw request\n" . $adapter->getRawRequest();
print "the raw response\n" . $adapter->getRawResponse();
print "the response object\n";
print_r($resp);


//
//$service = new ListService();
//// sample call for Postup_ServiceList::setSoapHeaderAuthentication() in order to initialize required SoapHeader
//$postup_ServiceList->setSoapHeaderAuthentication(new Authentication(/*** update parameters list ***/));
//// sample call for Postup_ServiceList::listContents()
//if($postup_ServiceList->listContents($_string))
//    print_r($postup_ServiceList->getResult());
//else
//    print_r($postup_ServiceList->getLastError());
