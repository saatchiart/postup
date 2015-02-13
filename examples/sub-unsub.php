<?php

require __DIR__ . '/bootstrap.php';


/* create recip from array */
$user = array(
    'address' => 'batma@saatchionline.com',
    'externalID' => 3,
    'demographics' => array(
        'FirstName=Bruce',
        'LastName=Wayne',
    )
);

/* see if our user exists, if not create... */
$recip = $client->getRecipientByAddress($user['address']);
if (!$client->isSuccess()) {
    // assume error comes from not existing - so we need to create
    log_call($client);
    exit(1);
}

if (!$recip) {
    $recipId = $client->createRecipient(new \Demand\Postup\Struct\Recipient($user));
    if (!$client->isSuccess()) {
        log_call($client);
        exit(1);
    }
} else {
    $recipId = $recip->getRecipID();
}

/* subscribe our user to the list */
$client->subscribeToList(COLLECTOR_LIST_ID,$recipId,true);
if ($client->isSuccess()) {
    print "the client is subscribed to the collector's list.";
} else {
    log_call($client);
    exit(1);
}