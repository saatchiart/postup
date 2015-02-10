<?php
/**
 * This class stands for Postup_ServiceList originally named List
 * @package Postup_
 * @subpackage Services
 * @author WsdlToPhp Team <contact@wsdltophp.com>
 * @version 20140325-01
 * @date 2015-02-10
 */

namespace Demand\Postup\Service;

use Demand\Postup\WsdlClass;

class ListService extends WsdlClass
{
    /**
     * Sets the authentication SoapHeader param
     * @uses Postup_WsdlClass::setSoapHeader()
     * @param Postup_StructAuthentication $_postup_StructAuthentication
     * @param string $_nameSpace http://skylist.com/services/SoapRequestProcessor
     * @param bool $_mustUnderstand
     * @param string $_actor
     * @return bool true|false
     */
    public function setSoapHeaderAuthentication(Postup_StructAuthentication $_postup_StructAuthentication,$_nameSpace = 'http://skylist.com/services/SoapRequestProcessor',$_mustUnderstand = false,$_actor = null)
    {
        return $this->setSoapHeader($_nameSpace,'authentication',$_postup_StructAuthentication,$_mustUnderstand,$_actor);
    }
    /**
     * Method to call the operation originally named listContents
     * Meta informations extracted from the WSDL
     * - SOAPHeaderNames : authentication
     * - SOAPHeaderNamespaces : http://skylist.com/services/SoapRequestProcessor
     * - SOAPHeaderTypes : {@link Postup_StructAuthentication}
     * - SOAPHeaders : required
     * @uses Postup_WsdlClass::getSoapClient()
     * @uses Postup_WsdlClass::setResult()
     * @uses Postup_WsdlClass::saveLastError()
     * @param string $_string
     * @return ArrayOf_soapenc_string
     */
    public function listContents($_string)
    {
        try
        {
            return $this->setResult(self::getSoapClient()->listContents($_string));
        }
        catch(SoapFault $soapFault)
        {
            return !$this->saveLastError(__METHOD__,$soapFault);
        }
    }
    /**
     * Returns the result
     * @see Postup_WsdlClass::getResult()
     * @return ArrayOf_soapenc_string
     */
    public function getResult()
    {
        return parent::getResult();
    }
    /**
     * Method returning the class name
     * @return string __CLASS__
     */
    public function __toString()
    {
        return __CLASS__;
    }
}
