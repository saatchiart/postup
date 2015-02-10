<?php
/**
 * Recipient structure defined in the WSDL.
 * - from schema : {@link https://api.postup.com/services/SoapRequestProcessor?wsdl}
 * @package Demand\Postup\Struct
 * @date 2015-02-10
 */

namespace Demand\Postup\Struct;

use Demand\Soap\Container;

/**
 * Constructor method for Recipient
 * @see parent::__construct()
 * @param int $recipID
 * @param string $address
 * @param string $externalID
 * @param string $_protocol
 * @param string $_status
 * @param string $_comment
 * @param int $_importID
 * @param string $_password
 * @param string $_signupMethod
 * @param string $_signupIP
 * @param dateTime $_sourceSignupDate
 * @param string $_sourceDescription
 * @param string $_thirdPartySource
 * @param dateTime $_thirdPartySignupDate
 * @param dateTime $_dateLastClicked
 * @param dateTime $_dateLastOpened
 * @param int $_clickCount
 * @param int $_openCount
 * @param int $_numBounces
 * @param string $_blockCode
 * @param dateTime $_dateJoined
 * @param dateTime $_dateBounce
 * @param dateTime $_dateHeld
 * @param dateTime $_dateUnsub
 * @param dateTime $_dateOptout
 * @param Array $_demographics
 * @return Recipient
 */
class Recipient extends Container
{
    /**
     * The recipID
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var int
     */
    protected $recipID;

    /**
     * The address
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var string
     */
    protected $address;

    /**
     * The externalID
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var string
     */
    protected $externalID;

    /**
     * The protocol
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var string
     */
    protected $protocol;

    /**
     * The status
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var string
     */
    protected $status;

    /**
     * The comment
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var string
     */
    protected $comment;

    /**
     * The importID
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var int
     */
    protected $importID;

    /**
     * The password
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var string
     */
    protected $password;

    /**
     * The signupMethod
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var string
     */
    protected $signupMethod;

    /**
     * The signupIP
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var string
     */
    protected $signupIP;

    /**
     * The sourceSignupDate
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var dateTime
     */
    protected $sourceSignupDate;
    /**
     * The sourceDescription
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var string
     */
    protected $sourceDescription;
    /**
     * The thirdPartySource
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var string
     */
    protected $thirdPartySource;
    /**
     * The thirdPartySignupDate
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var dateTime
     */
    protected $thirdPartySignupDate;
    /**
     * The dateLastClicked
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var dateTime
     */
    protected $dateLastClicked;
    /**
     * The dateLastOpened
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var dateTime
     */
    protected $dateLastOpened;
    /**
     * The clickCount
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var int
     */
    protected $clickCount;
    /**
     * The openCount
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var int
     */
    protected $openCount;
    /**
     * The numBounces
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var int
     */
    protected $numBounces;
    /**
     * The blockCode
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var string
     */
    protected $blockCode;
    /**
     * The dateJoined
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var dateTime
     */
    protected $dateJoined;
    /**
     * The dateBounce
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var dateTime
     */
    protected $dateBounce;
    /**
     * The dateHeld
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var dateTime
     */
    protected $dateHeld;
    /**
     * The dateUnsub
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var dateTime
     */
    protected $dateUnsub;
    /**
     * The dateOptout
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var dateTime
     */
    protected $dateOptout;
    /**
     * The demographics
     * Meta informations extracted from the WSDL
     * - nillable : true
     * - from schema : {@link https://api.postup.com/services/SoapRequestProcessor?wsdl}
     * @var Array
     */
    protected $demographics;

    /**
     * @return int
     */
    public function getRecipID()
    {
        return $this->recipID;
    }

    /**
     * @param int $recipID
     */
    public function setRecipID($recipID)
    {
        $this->recipID = $recipID;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getExternalID()
    {
        return $this->externalID;
    }

    /**
     * @param string $externalID
     */
    public function setExternalID($externalID)
    {
        $this->externalID = $externalID;
    }

    /**
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @param string $protocol
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return int
     */
    public function getImportID()
    {
        return $this->importID;
    }

    /**
     * @param int $importID
     */
    public function setImportID($importID)
    {
        $this->importID = $importID;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getSignupMethod()
    {
        return $this->signupMethod;
    }

    /**
     * @param string $signupMethod
     */
    public function setSignupMethod($signupMethod)
    {
        $this->signupMethod = $signupMethod;
    }

    /**
     * @return string
     */
    public function getSignupIP()
    {
        return $this->signupIP;
    }

    /**
     * @param string $signupIP
     */
    public function setSignupIP($signupIP)
    {
        $this->signupIP = $signupIP;
    }

    /**
     * @return dateTime
     */
    public function getSourceSignupDate()
    {
        return $this->sourceSignupDate;
    }

    /**
     * @param dateTime $sourceSignupDate
     */
    public function setSourceSignupDate($sourceSignupDate)
    {
        $this->sourceSignupDate = $sourceSignupDate;
    }

    /**
     * @return string
     */
    public function getSourceDescription()
    {
        return $this->sourceDescription;
    }

    /**
     * @param string $sourceDescription
     */
    public function setSourceDescription($sourceDescription)
    {
        $this->sourceDescription = $sourceDescription;
    }

    /**
     * @return string
     */
    public function getThirdPartySource()
    {
        return $this->thirdPartySource;
    }

    /**
     * @param string $thirdPartySource
     */
    public function setThirdPartySource($thirdPartySource)
    {
        $this->thirdPartySource = $thirdPartySource;
    }

    /**
     * @return dateTime
     */
    public function getThirdPartySignupDate()
    {
        return $this->thirdPartySignupDate;
    }

    /**
     * @param dateTime $thirdPartySignupDate
     */
    public function setThirdPartySignupDate($thirdPartySignupDate)
    {
        $this->thirdPartySignupDate = $thirdPartySignupDate;
    }

    /**
     * @return dateTime
     */
    public function getDateLastClicked()
    {
        return $this->dateLastClicked;
    }

    /**
     * @param dateTime $dateLastClicked
     */
    public function setDateLastClicked($dateLastClicked)
    {
        $this->dateLastClicked = $dateLastClicked;
    }

    /**
     * @return dateTime
     */
    public function getDateLastOpened()
    {
        return $this->dateLastOpened;
    }

    /**
     * @param dateTime $dateLastOpened
     */
    public function setDateLastOpened($dateLastOpened)
    {
        $this->dateLastOpened = $dateLastOpened;
    }

    /**
     * @return int
     */
    public function getClickCount()
    {
        return $this->clickCount;
    }

    /**
     * @param int $clickCount
     */
    public function setClickCount($clickCount)
    {
        $this->clickCount = $clickCount;
    }

    /**
     * @return int
     */
    public function getOpenCount()
    {
        return $this->openCount;
    }

    /**
     * @param int $openCount
     */
    public function setOpenCount($openCount)
    {
        $this->openCount = $openCount;
    }

    /**
     * @return int
     */
    public function getNumBounces()
    {
        return $this->numBounces;
    }

    /**
     * @param int $numBounces
     */
    public function setNumBounces($numBounces)
    {
        $this->numBounces = $numBounces;
    }

    /**
     * @return string
     */
    public function getBlockCode()
    {
        return $this->blockCode;
    }

    /**
     * @param string $blockCode
     */
    public function setBlockCode($blockCode)
    {
        $this->blockCode = $blockCode;
    }

    /**
     * @return dateTime
     */
    public function getDateJoined()
    {
        return $this->dateJoined;
    }

    /**
     * @param dateTime $dateJoined
     */
    public function setDateJoined($dateJoined)
    {
        $this->dateJoined = $dateJoined;
    }

    /**
     * @return dateTime
     */
    public function getDateBounce()
    {
        return $this->dateBounce;
    }

    /**
     * @param dateTime $dateBounce
     */
    public function setDateBounce($dateBounce)
    {
        $this->dateBounce = $dateBounce;
    }

    /**
     * @return dateTime
     */
    public function getDateHeld()
    {
        return $this->dateHeld;
    }

    /**
     * @param dateTime $dateHeld
     */
    public function setDateHeld($dateHeld)
    {
        $this->dateHeld = $dateHeld;
    }

    /**
     * @return dateTime
     */
    public function getDateUnsub()
    {
        return $this->dateUnsub;
    }

    /**
     * @param dateTime $dateUnsub
     */
    public function setDateUnsub($dateUnsub)
    {
        $this->dateUnsub = $dateUnsub;
    }

    /**
     * @return dateTime
     */
    public function getDateOptout()
    {
        return $this->dateOptout;
    }

    /**
     * @param dateTime $dateOptout
     */
    public function setDateOptout($dateOptout)
    {
        $this->dateOptout = $dateOptout;
    }

    /**
     * @return Array
     */
    public function getDemographics()
    {
        return $this->demographics;
    }

    /**
     * @param Array $demographics
     */
    public function setDemographics($demographics)
    {
        $this->demographics = $demographics;
    }


}
