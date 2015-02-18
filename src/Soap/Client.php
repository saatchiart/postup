<?php

namespace Demand\Soap;

/**
 *
 * Class Client
 *
 * Add a pre-processing hook into \SoapClient
 *
 * @package Demand\Soap
 */
class Client extends \SoapClient
{
    /**
     * doRequest() pre-processing method
     *
     * @var callback
     */
    protected $_doRequestCallback;

    /**
     * Common Soap Client constructor
     *
     * @param callback $doRequestMethod
     * @param string $wsdl
     * @param array $options
     */
    function __construct($doRequestCallback, $wsdl, $options)
    {
        $this->_doRequestCallback = $doRequestCallback;

        parent::__construct($wsdl, $options);
    }

    /**
     * Performs SOAP request over HTTP.
     * Overridden to implement different transport layers, perform additional XML processing or other purpose.
     *
     * @param string $request
     * @param string $location
     * @param string $action
     * @param int    $version
     * @param int    $one_way
     * @return mixed
     */
    function __doRequest($request, $location, $action, $version, $one_way = null)
    {
        if ($one_way === null) {
            return call_user_func($this->_doRequestCallback, $this, $request, $location, $action, $version);
        } else {
            return call_user_func($this->_doRequestCallback, $this, $request, $location, $action, $version, $one_way);
        }
    }

}