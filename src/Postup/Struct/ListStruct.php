<?php

namespace Demand\Postup\Struct;

use Demand\Soap\Container;

class ListStruct extends Container
{
    /**
     * The listID
     * - nillable : true
     * @var int
     */
    protected $listID;

    /**
     * The listTitle
     * - nillable : true
     * @var string
     */
    protected $listTitle;

    /**
     * The description
     * - nillable : true
     * @var string
     */
    protected $description;

    /**
     * The createTime
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var dateTime
     */
    protected $createTime;

    /**
     * The creator
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var string
     */
    protected $creator;

    /**
     * The populated
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var boolean
     */
    protected $populated;

    /**
     * The seedListID
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var int
     */
    protected $seedListID;

    /**
     * The globalUnsub
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var boolean
     */
    protected $globalUnsub;

    /**
     * The publice
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var boolean
     */
    protected $publicSignup;

    /**
     * The blockDomains
     * Meta informations extracted from the WSDL
     * - nillable : true
     * - from schema : {@link https://api.postup.com/services/SoapRequestProcessor?wsdl}
     * @var Array
     */
    protected $blockDomains;

    /**
     * The countRecips
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var boolean
     */
    protected $countRecips;

    /**
     * The categoryID
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var int
     */
    protected $categoryID;

    /**
     * The externalID
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var string
     */
    protected $externalID;

    /**
     * The friendlyFromName
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var string
     */
    protected $friendlyFromName;

    /**
     * The friendlyTitle
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var string
     */
    protected $friendlyTitle;

    /**
     * The custom1
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var string
     */
    protected $custom1;

    /**
     * The facebookList
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var boolean
     */
    protected $facebookList;

    /**
     * The displayOrder
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var int
     */
    protected $displayOrder;

    /**
     * The channel
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var string
     */
    protected $channel;

    /**
     * The queryWhereClause
     * Meta informations extracted from the WSDL
     * - nillable : true
     * @var string
     */
    protected $queryWhereClause;

    /**
     * Constructor method for List
     * @see parent::__construct()
     * @param int $_listID
     * @param string $_listTitle
     * @param string $_description
     * @param dateTime $_createTime
     * @param string $_creator
     * @param boolean $_populated
     * @param int $_seedListID
     * @param boolean $_globalUnsub
     * @param boolean $_publicSignup
     * @param Array $_blockDomains
     * @param boolean $_countRecips
     * @param int $_categoryID
     * @param string $_externalID
     * @param string $_friendlyFromName
     * @param string $_friendlyTitle
     * @param string $_custom1
     * @param boolean $_facebookList
     * @param int $_displayOrder
     * @param string $_channel
     * @param string $_queryWhereClause
     * @return ListStruct
     */
    public function __construct(array $values=array())
    {
        parent::__construct($values);
    }

    /**
     * @return int
     */
    public function getListID()
    {
        return $this->listID;
    }

    /**
     * @param int $listID
     */
    public function setListID($listID)
    {
        $this->listID = $listID;
    }

    /**
     * @return string
     */
    public function getListTitle()
    {
        return $this->listTitle;
    }

    /**
     * @param string $listTitle
     */
    public function setListTitle($listTitle)
    {
        $this->listTitle = $listTitle;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return dateTime
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * @param dateTime $createTime
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;
    }

    /**
     * @return string
     */
    public function getCreator()
    {
        return $this->creator;
    }

    /**
     * @param string $creator
     */
    public function setCreator($creator)
    {
        $this->creator = $creator;
    }

    /**
     * @return boolean
     */
    public function isPopulated()
    {
        return $this->populated;
    }

    /**
     * @param boolean $populated
     */
    public function setPopulated($populated)
    {
        $this->populated = $populated;
    }

    /**
     * @return int
     */
    public function getSeedListID()
    {
        return $this->seedListID;
    }

    /**
     * @param int $seedListID
     */
    public function setSeedListID($seedListID)
    {
        $this->seedListID = $seedListID;
    }

    /**
     * @return boolean
     */
    public function isGlobalUnsub()
    {
        return $this->globalUnsub;
    }

    /**
     * @param boolean $globalUnsub
     */
    public function setGlobalUnsub($globalUnsub)
    {
        $this->globalUnsub = $globalUnsub;
    }

    /**
     * @return boolean
     */
    public function isPublicSignup()
    {
        return $this->publicSignup;
    }

    /**
     * @param boolean $publicSignup
     */
    public function setPublicSignup($publicSignup)
    {
        $this->publicSignup = $publicSignup;
    }

    /**
     * @return Array
     */
    public function getBlockDomains()
    {
        return $this->blockDomains;
    }

    /**
     * @param Array $blockDomains
     */
    public function setBlockDomains($blockDomains)
    {
        $this->blockDomains = $blockDomains;
    }

    /**
     * @return boolean
     */
    public function isCountRecips()
    {
        return $this->countRecips;
    }

    /**
     * @param boolean $countRecips
     */
    public function setCountRecips($countRecips)
    {
        $this->countRecips = $countRecips;
    }

    /**
     * @return int
     */
    public function getCategoryID()
    {
        return $this->categoryID;
    }

    /**
     * @param int $categoryID
     */
    public function setCategoryID($categoryID)
    {
        $this->categoryID = $categoryID;
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
    public function getFriendlyFromName()
    {
        return $this->friendlyFromName;
    }

    /**
     * @param string $friendlyFromName
     */
    public function setFriendlyFromName($friendlyFromName)
    {
        $this->friendlyFromName = $friendlyFromName;
    }

    /**
     * @return string
     */
    public function getFriendlyTitle()
    {
        return $this->friendlyTitle;
    }

    /**
     * @param string $friendlyTitle
     */
    public function setFriendlyTitle($friendlyTitle)
    {
        $this->friendlyTitle = $friendlyTitle;
    }

    /**
     * @return string
     */
    public function getCustom1()
    {
        return $this->custom1;
    }

    /**
     * @param string $custom1
     */
    public function setCustom1($custom1)
    {
        $this->custom1 = $custom1;
    }

    /**
     * @return boolean
     */
    public function isFacebookList()
    {
        return $this->facebookList;
    }

    /**
     * @param boolean $facebookList
     */
    public function setFacebookList($facebookList)
    {
        $this->facebookList = $facebookList;
    }

    /**
     * @return int
     */
    public function getDisplayOrder()
    {
        return $this->displayOrder;
    }

    /**
     * @param int $displayOrder
     */
    public function setDisplayOrder($displayOrder)
    {
        $this->displayOrder = $displayOrder;
    }

    /**
     * @return string
     */
    public function getChannel()
    {
        return $this->channel;
    }

    /**
     * @param string $channel
     */
    public function setChannel($channel)
    {
        $this->channel = $channel;
    }

    /**
     * @return string
     */
    public function getQueryWhereClause()
    {
        return $this->queryWhereClause;
    }

    /**
     * @param string $queryWhereClause
     */
    public function setQueryWhereClause($queryWhereClause)
    {
        $this->queryWhereClause = $queryWhereClause;
    }


}
