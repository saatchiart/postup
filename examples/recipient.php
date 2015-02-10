<?php

require __DIR__ . '/bootstrap.php';

/* create recip from array */
$values = array(
    'address' => 'b@saatchionline.com',
    'externalID' => 3,
    'demographics' => array(
        'FirstName=Bruce',
        'LastName=Wayne'
    ));
$recip = new \Demand\Postup\Struct\Recipient($values);
$resp = $client->createRecipient($recip);

print "the raw request\n" . $client->getRawRequest();
print "the raw response\n" . $client->getRawResponse();
print "the response object\n";
print_r($resp);

/* create recip from obj */
$recip = new \Demand\Postup\Struct\Recipient();
$recip->setAddress('superman@saatchionline.com');
$recip->setExternalID(4);
$recip->setDemographics(array('FirstName=Clark','LastName=Kent'));
$resp = $client->createRecipient($recip);

print "the raw request\n" . $client->getRawRequest();
print "the raw response\n" . $client->getRawResponse();
print "the response object\n";
print_r($resp);

/* delete recipients */
