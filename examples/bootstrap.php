<?php

const COLLECTOR_LIST_ID = 3858;
const ARTIST_LIST_ID = 3859;

$loader = require dirname(__DIR__) . '/vendor/autoload.php';

function log_call(\Demand\Postup\ApiClient $client)
{
    print "the raw request\n" . $client->getRawRequest() . "\n---\n";
    print "the raw response\n" . $client->getRawResponse() . "\n---\n";
    print "the resuult => \n";
    print_r($client->getResult());
    print "\n---\n";
    if (!$client->isSuccess()) {
        $sf = $client->getSoapError();
        print "SoapFault => \n";
        print_r($sf);
    }
}

$username = getenv('POSTUP_USERNAME');
$passwd = getenv('POSTUP_PASSWORD');
$options = array('classmap' => \Demand\Postup\ClassMap::classMap());
$adapter = new \Demand\Soap\ClientAdapter('https://api.postup.com/services/SoapRequestProcessor?wsdl',$options);
$client = new \Demand\Postup\ApiClient($adapter);
$auth = new \Demand\Postup\Struct\Authentication($username,$passwd);
$client->setAuthentication($auth);