<?php

namespace Demand\Postup;

use Demand\Postup\Struct\Authentication;
use Demand\Postup\Struct\ListStruct;
use Demand\Postup\Struct\Recipient;
use Demand\Soap\ClientAdapter;

class ServiceClient
{
    /** @var Authentication */
    protected $authentication;

    /** @var ClientAdapter */
    private $adapter;

    public function __construct(ClientAdapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @param ListStruct $request
     * @return ListStruct[]
     */
    public function getLists(ListStruct $request)
    {
        return $this->adapter->getLists($request);
    }

    /**
     * @param Recipient $request
     * @return int
     */
    public function createRecipient(Recipient $request)
    {
        $resp = $this->adapter->createRecipientAndReturnRecipID($request);
        return $resp;
    }

    public function getRecipientByAddress()
    {

    }

    /**
     * @return Authentication
     */
    public function getAuthentication()
    {
        return $this->authentication;
    }

    /**
     * @param Authentication $authentication
     */
    public function setAuthentication($authentication)
    {
        $this->authentication = $authentication;
        $this->setAuthHeader();
    }

    protected function setAuthHeader()
    {
        $hdr = new \SoapHeader(
            'http://skylist.com/services/SoapRequestProcessor',
            'authentication',
            $this->authentication
        );
        $this->adapter->addSoapInputHeader($hdr,true);
    }
}