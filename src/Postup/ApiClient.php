<?php

namespace Demand\Postup;

use Demand\Postup\Struct\Authentication;
use Demand\Postup\Struct\ListStruct;
use Demand\Postup\Struct\Recipient;
use Demand\Soap\ClientAdapter;

class ApiClient
{
    /** @var Authentication */
    protected $authentication;

    /** @var ClientAdapter */
    private $adapter;

    /**
     * Contains Soap call result
     * @var mixed
     */
    private $result;

    /**
     * Contains last errors
     * @var \SoapFault
     */
    private $soapError;

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
        return $this->doSoapCall('getLists',$request,array());
    }

    /* Recipient services */

    /**
     * Returns the recipient id of the created recipient.
     * If there is an error, it returns null.
     * @param Recipient $request
     * @return int
     */
    public function createRecipient(Recipient $request)
    {
        return $this->doSoapCall('createRecipientAndReturnRecipID',$request);
    }

    /**
     * @param string $address
     * @return Recipient
     */
    public function getRecipientByAddress($address)
    {
        return $this->doSoapCall('getRecipientByAddress',$address);
    }

    /**
     * @param string $address
     * @return Recipient
     */
    public function getRecipientByExternalID($externalID)
    {
        return $this->doSoapCall('getRecipientByExternalID',$externalID);
    }

    /* subscribe/unsubscribe to lists */

    /**
     *
     * @param int $listID
     * @param int $recipID
     * @param bool $confirmed
     * @param string $sourceID
     * @param int $mailingID
     */
    public function subscribeToList($listID,$recipID,$confirmed = false,$sourceID = '',$mailingID = 0)
    {
        $data = array(
            'listID' => $listID,
            'recipID'=> $recipID,
            'confirmed' => $confirmed,
            'sourceID' => $sourceID,
            'mailingID' => $mailingID
        );
        return $this->doSoapCall('subscribeToList',$data);
    }

    /**
     * @param $listID
     * @param $recipID
     * @param int $mailingID
     * @return mixed|null
     */
    public function unsubscribeFromList($listID, $recipID, $mailingID = 0)
    {
        $data = array(
            'listID' => $listID,
            'recipID' => $recipID,
            'mailingID' => $mailingID
        );
        return $this->doSoapCall('unsubscribeFromList',$data);
    }

    /**
     * Execute the soapMethod and record result
     *
     * @param string $method
     * @param mixed $params
     * @param mixed $errorResponse
     * @return
     */
    protected function doSoapCall($method,$params,$errorResponse = null)
    {
        try {
            if (is_array($params)) {
                $result = call_user_func_array(array($this->adapter,$method),$params);
           } else {
                $result = call_user_func(array($this->adapter, $method), $params);
            }
//            $result = $this->adapter->$method($params);
            $this->setResult($result);
            $this->resetSoapError();
        } catch (\SoapFault $sf) {
            $this->setResult(null);
            $this->setSoapError($sf);
        }
        return ($this->isSuccess()) ? $this->getResult() : $errorResponse;
    }

    /**
     * @return null|string
     */
    public function getRawRequest()
    {
        return $this->adapter->getRawRequest();
    }

    /**
     * @return null|string
     */
    public function getRawResponse()
    {
        return $this->adapter->getRawResponse();
    }

    /**
     * Method returning current result from Soap call
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Method setting current result from Soap call
     * @param mixed $_result
     * @return mixed
     */
    protected function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * Reset the soap error.
     */
    protected function resetSoapError()
    {
        $this->soapError = null;
    }

    /**
     * Method saving the last error returned by the SoapClient
     * @param string $methodName the method called when the error occurred
     * @param \SoapFault $soapFault
     * @return bool true|false
     */
    protected function setSoapError(\SoapFault $soapFault)
    {
        $this->soapError = $soapFault;
    }

    /**
     * Method returning the last error returned by the SoapClient
     *
     * @return \SoapFault
     */
    public function getSoapError()
    {
        return $this->soapError;
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return (null === $this->getSoapError());
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