<?php

namespace Demand\Soap;

/**
 * A generic adapter around SoapClient to make it easier to send SOAP api requests
 * and parse responses.
 *
 * Class ClientAdapter
 * @package DemandSoap
 */
class ClientAdapter
{
    const WSDL_CACHE_ENABLE = true;
    const WSDL_CACHE_DISABLE = false;


    /** @var \SoapClient */
    protected $soapClient;

    protected $encoding = 'UTF-8';

    /** @var array */
    protected $classmap = null;

    /**
     * SOAP version to use; SOAP_1_2 by default, to allow processing of headers
     * @var int
     */
    protected $_soapVersion = SOAP_1_2;

    /** Set of other SoapClient options */
    protected $uri                 = null;
    protected $location            = null;
    protected $style               = null;
    protected $encodingMethod      = null;
    protected $login               = null;
    protected $password            = null;
    protected $proxy_host          = null;
    protected $proxy_port          = null;
    protected $proxy_login         = null;
    protected $proxy_password      = null;
    protected $local_cert          = null;
    protected $passphrase          = null;
    protected $compression         = null;
    protected $connection_timeout  = null;
    protected $stream_context      = null;
    protected $features            = null;
    protected $cache_wsdl          = null;
    protected $user_agent          = null;

    /**
     * WSDL used to access server
     * It also defines working mode (WSDL vs non-WSDL)
     * @var string
     */
    protected $wsdl = null;

    /**
     * Last invoked method
     *
     * @var string
     */
    protected $lastMethod = '';

    /**
     * SOAP request headers.
     *
     * Array of SoapHeader objects
     *
     * @var array
     */
    protected $soapInputHeaders = array();

    /**
     * Permanent SOAP request headers (shared between requests).
     *
     * Array of SoapHeader objects
     *
     * @var array
     */
    protected $permanentSoapInputHeaders = array();

    /**
     * Output SOAP headers.
     *
     * Array of SoapHeader objects
     *
     * @var array
     */
    protected $soapOutputHeaders = array();

    /**
     * @var mixed SOAP functions may return one, or multiple values.
     * If only one value is returned by the SOAP function, the return value of __soapCall will
     * be a simple value (e.g. an integer, a string, etc). If multiple values are returned, __soapCall
     * will return an associative array of named output parameters.
     */
    protected $response = null;

    /** @var string The last SOAP request, as an XML string. */
    protected $rawRequest = null;

    /** @var string The last SOAP response, as an XML string. */
    protected $rawResponse = null;

    /** @var \SoapFault */
    protected $soapError;


    public function __construct($wsdl = null, array $options = null)
    {
        if (!extension_loaded('soap')) {
            // require_once 'Zend/Soap/Client/Exception.php';
            throw new ClientException('SOAP extension is not loaded.');
        }
        if ($wsdl !== null) {
            $this->setWsdl($wsdl);
        }
        if ($options !== null) {
            $this->setOptions($options);
        }
    }

    /**
     * @return \SoapClient
     */
    public function getSoapClient()
    {
        if ($this->soapClient == null) {
            $this->initSoapClientObject();
        }
        return $this->soapClient;
    }

    /**
     * Initialize SOAP Client object
     *
     * @throws ClientException
     */
    protected function initSoapClientObject()
    {
        $wsdl = $this->getWsdl();
        $options = array_merge($this->getOptions(), array('trace' => true));

        if ($wsdl == null) {
            if (!isset($options['location'])) {
                throw new ClientException('\'location\' parameter is required in non-WSDL mode.');
            }
            if (!isset($options['uri'])) {
                throw new ClientException('\'uri\' parameter is required in non-WSDL mode.');
            }
        } else {
            if (isset($options['use'])) {
                throw new ClientException('\'use\' parameter only works in non-WSDL mode.');
            }
            if (isset($options['style'])) {
                throw new ClientException('\'style\' parameter only works in non-WSDL mode.');
            }
        }
        unset($options['wsdl']);

        $this->soapClient = new Client(array($this, 'doRequest'), $wsdl, $options);
    }

    /**
     * Do request proxy method.
     *
     * May be overridden in subclasses
     *
     * @internal
     * @param Client $client
     * @param string $request
     * @param string $location
     * @param string $action
     * @param int    $version
     * @param int    $one_way
     * @return mixed
     */
    public function doRequest(Client $client, $request, $location, $action, $version, $one_way = null)
    {
        // Perform request as is
        if ($one_way == null) {
            return call_user_func(array($client,'SoapClient::__doRequest'), $request, $location, $action, $version);
        } else {
            return call_user_func(array($client,'SoapClient::__doRequest'), $request, $location, $action, $version, $one_way);
        }
    }

    /**
     * Perform a SOAP call
     *
     * @param string $name
     * @param array  $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $soapClient = $this->getSoapClient();

        $this->lastMethod = $name;

        $soapHeaders = array_merge($this->permanentSoapInputHeaders, $this->soapInputHeaders);
        $result = $soapClient->__soapCall($name,
            $this->preProcessArguments($arguments),
            null, /* Options are already set to the SOAP client object */
            (count($soapHeaders) > 0)? $soapHeaders : null,
            $this->soapOutputHeaders);

        // Reset non-permanent input headers
        $this->soapInputHeaders = array();

        return $this->preProcessResult($result);
    }

    /**
     * @param $method
     * @param $params
     */
    public function doCall($method, $params)
    {
        $startTime = microtime(true);
        try {

            $this->response = $this->soapClient->$method($params);
//            $duration = number_format(microtime(true) - $startTime, 4);
//            $this->fileLog('Request for ' . $method);
//            $this->fileLog("Raw request\n" . $this->formatXml($this->rawRequest));
//            $this->fileLog('duration = ' . $duration . ' seconds').
//            $this->fileLog("Response for " . $method);
//            $this->fileLog("Raw response\n" .$this->formatXml($this->rawResponse));
        } catch (\SoapFault $sf) {
//            $duration       = number_format(microtime(true) - $startTime, 4);
//            $this->fileLog('Request for ' . $method);
//            $this->fileLog("Raw request\n" . $this->formatXml($this->rawRequest));
//            $this->fileLog('duration = ' . $duration . ' seconds');
//            $this->fileLog("Response for " . $method);
//            $this->fileLog("Raw response\n" .$this->formatXml($this->rawResponse));
            throw $sf;
        }
    }

    /**
     * get the current response
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * get the current request as xml
     * @return null|string
     */
    public function getRawRequest()
    {
        if ($this->soapClient !== null) {
            return $this->formatXml($this->soapClient->__getLastRequest());
        }
        return '';
    }

    /**
     * get the current response as xml
     * @return null|string
     */
    public function getRawResponse()
    {
        if ($this->soapClient !== null) {
            $xml = $this->soapClient->__getLastResponse();
            return $this->formatXml($xml);
        }
        return '';
    }

    /**
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
     * Add SOAP input header
     *
     * @param \SoapHeader $header
     * @param boolean $permanent
     * @return ClientAdapter
     */
    public function addSoapInputHeader(\SoapHeader $header, $permanent = false)
    {
        if ($permanent) {
            $this->permanentSoapInputHeaders[] = $header;
        } else {
            $this->soapInputHeaders[] = $header;
        }

        return $this;
    }

    /**
     * Perform arguments pre-processing
     *
     * My be overridden in descendant classes
     *
     * @param array $arguments
     */
    protected function preProcessArguments($arguments)
    {
        // Do nothing
        return $arguments;
    }

    /**
     * Perform result pre-processing
     *
     * My be overridden in descendant classes
     *
     * @param array $arguments
     */
    protected function preProcessResult($result)
    {
        // Do nothing
        return $result;
    }

    /* utility functions */

    /**
     * format xml string for output
     *
     * @param string $xml
     * @return string
     */
    public function formatXml($xml)
    {
        if (empty($xml)) {
            return '';
        }

        $dom = new \DOMDocument;
        $dom->preserveWhiteSpace = false;
        $dom->loadXML($xml);
        $dom->formatOutput = true;

        return $dom->saveXml();
    }

    /**
     * @param $string
     * @return string
     */
    public function formatRaw($string)
    {
        return '<pre>' . htmlspecialchars($string, ENT_QUOTES | ENT_XML1) . '</pre>';
    }

    /**
     * Check for valid URN
     *
     * @param  string $urn
     * @return true
     * @throws ClientException on invalid URN
     */
    public function validateUrn($urn)
    {
        $scheme = parse_url($urn, PHP_URL_SCHEME);
        if ($scheme === false || $scheme === null) {
            throw new ClientException('Invalid URN');
        }

        return true;

    }

    protected function handleWsdlCaching($isEnabled)
    {
        assert(is_bool($isEnabled));
        $cacheFlag = (true === $isEnabled) ? 1 : 0;
        ini_set('soap.wsdl_cache_enabled', $cacheFlag);
    }

    /* Getters/Setters */

    /**
     * Set wsdl
     *
     * @param string $wsdl
     * @return ClientAdapter
     */
    public function setWsdl($wsdl)
    {
        $this->wsdl = $wsdl;
        $this->soapClient = null;

        return $this;
    }

    /**
     * Get wsdl
     *
     * @return string
     */
    public function getWsdl()
    {
        return $this->wsdl;
    }

    /**
     * Set Options
     *
     * Allows setting options as an associative array of option => value pairs.
     *
     * @param  array $options
     * @return ClientAdapter
     * @throws ClientException
     */
    public function setOptions($options)
    {
        foreach ($options as $key => $value) {
            switch ($key) {
                case 'classmap':
                    $this->setClassmap($value);
                    break;
                case 'encoding':
                    $this->setEncoding($value);
                    break;
                case 'wsdl':
                    $this->setWsdl($value);
                    break;
//                case 'soapVersion':
//                case 'soap_version':
//                    $this->setSoapVersion($value);
//                    break;
                case 'uri':
                    $this->setUri($value);
                    break;
//                case 'location':
//                    $this->setLocation($value);
//                    break;
//                case 'style':
//                    $this->setStyle($value);
//                    break;
                case 'use':
                    $this->setEncodingMethod($value);
                    break;
//                case 'login':
//                    $this->setHttpLogin($value);
//                    break;
//                case 'password':
//                    $this->setHttpPassword($value);
//                    break;
//                case 'proxy_host':
//                    $this->setProxyHost($value);
//                    break;
//                case 'proxy_port':
//                    $this->setProxyPort($value);
//                    break;
//                case 'proxy_login':
//                    $this->setProxyLogin($value);
//                    break;
//                case 'proxy_password':
//                    $this->setProxyPassword($value);
//                    break;
//                case 'local_cert':
//                    $this->setHttpsCertificate($value);
//                    break;
//                case 'passphrase':
//                    $this->setHttpsCertPassphrase($value);
//                    break;
//                case 'compression':
//                    $this->setCompressionOptions($value);
//                    break;
//                case 'stream_context':
//                    $this->setStreamContext($value);
//                    break;
//                case 'features':
//                    $this->setSoapFeatures($value);
//                    break;
//                case 'cache_wsdl':
//                    $this->setWsdlCache($value);
//                    break;
//                case 'useragent':
//                case 'userAgent':
//                case 'user_agent':
//                    $this->setUserAgent($value);
//                    break;
                default:
                    throw new ClientException('Unknown SOAP client option');
                    break;
            }
        }

        return $this;
    }

    /**
     * Return array of options suitable for using with SoapClient constructor
     *
     * @return array
     */
    public function getOptions()
    {
        $options = array();

        $options['classmap']       = $this->getClassmap();
        $options['encoding']       = $this->getEncoding();
//        $options['soap_version']   = $this->getSoapVersion();
        $options['wsdl']           = $this->getWsdl();
        $options['uri']            = $this->getUri();
//        $options['location']       = $this->getLocation();
//        $options['style']          = $this->getStyle();
        $options['use']            = $this->getEncodingMethod();
//        $options['login']          = $this->getHttpLogin();
//        $options['password']       = $this->getHttpPassword();
//        $options['proxy_host']     = $this->getProxyHost();
//        $options['proxy_port']     = $this->getProxyPort();
//        $options['proxy_login']    = $this->getProxyLogin();
//        $options['proxy_password'] = $this->getProxyPassword();
//        $options['local_cert']     = $this->getHttpsCertificate();
//        $options['passphrase']     = $this->getHttpsCertPassphrase();
//        $options['compression']    = $this->getCompressionOptions();
//        $options['stream_context'] = $this->getStreamContext();
//        $options['cache_wsdl']     = $this->getWsdlCache();
//        $options['features']       = $this->getSoapFeatures();
//        $options['user_agent']     = $this->getUserAgent();

        foreach ($options as $key => $value) {
            /*
             * ugly hack as I don't know if checking for '=== null'
             * breaks some other option
             */
//            if (in_array($key, array('user_agent', 'cache_wsdl', 'compression'))) {
//                if ($value === null) {
//                    unset($options[$key]);
//                }
//            } else {
                if ($value == null) {
                    unset($options[$key]);
                }
//            }
        }

        return $options;
    }

    /**
     * Set classmap
     *
     * @param  array $classmap
     * @return ClientAdapter
     * @throws ClientException for any invalid class in the class map
     */
    public function setClassmap(array $classmap)
    {
        foreach ($classmap as $type => $class) {
            if (!class_exists($class)) {
                throw new ClientException('Invalid class (' . $class . ') in class map');
            }
        }
        $this->classmap = $classmap;
        $this->soapClient = null;
        return $this;
    }

    /**
     * Retrieve classmap
     *
     * @return mixed
     */
    public function getClassmap()
    {
        return $this->classmap;
    }

    /**
     * Set encoding
     *
     * @param  string $encoding
     * @return ClientAdapter
     * @throws ClientException with invalid encoding argument
     */
    public function setEncoding($encoding)
    {
        if (!is_string($encoding)) {
            throw new ClientException('Invalid encoding specified');
        }
        $this->encoding = $encoding;
        $this->soapClient = null;
        return $this;
    }

    /**
     * Get encoding
     *
     * @return string
     */
    public function getEncoding()
    {
        return $this->encoding;
    }

    /**
     * Set URI
     *
     * URI in Web Service the target namespace
     *
     * @param  string $uri
     * @return ClientAdapter
     * @throws ClientException with invalid uri argument
     */
    public function setUri($uri)
    {
        $this->validateUrn($uri);
        $this->uri = $uri;
        $this->soapClient = null;
        return $this;
    }

    /**
     * Retrieve URI
     *
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Set message encoding method
     *
     * @param  int $use One of the SOAP_ENCODED or SOAP_LITERAL constants
     * @return ClientAdapter
     * @throws ClientException with invalid message encoding method argument
     */
    public function setEncodingMethod($use)
    {
        if (!in_array($use, array(SOAP_ENCODED, SOAP_LITERAL))) {
            // require_once 'Zend/Soap/Client/Exception.php';
            throw new ClientException('Invalid message encoding method. Use SOAP_ENCODED or SOAP_LITERAL constants.');
        }
        $this->encodingMethod = $use;
        $this->soapClient = null;

        return $this;
    }

    /**
     * Get message encoding method
     *
     * @return int
     */
    public function getEncodingMethod()
    {
        return $this->encodingMethod;
    }
}