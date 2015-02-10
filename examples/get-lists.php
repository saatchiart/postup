<?php

require __DIR__ . '/bootstrap.php';

$resp = $client->getLists(new \Demand\Postup\Struct\ListStruct());

print "the raw request\n" . $client->getRawRequest();
print "the raw response\n" . $client->getRawResponse();
print "the response object\n";
print_r($resp);

