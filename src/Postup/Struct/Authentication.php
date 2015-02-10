<?php

namespace Demand\Postup\Struct;

use Demand\Soap\Container;

class Authentication extends Container
{
    /**
     * The username
     * @var string
     */
    protected $username;

    /**
     * The password
     * @var string
     */
    protected $password;

    /**
     * Constructor method for authentication
     * @see parent::__construct()
     * @param string $username
     * @param string $password
     * @return Authentication
     */
    public function __construct($username = null, $password = null)
    {
        parent::__construct(array('username'=>$username,'password'=>$password),false);
    }

    /**
     * Get username value
     * @return string|null
     */
    public function getUsername()
    {
        return $this->username;
    }
    /**
     * Set username value
     * @param string $username the username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
    /**
     * Get password value
     * @return string|null
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * Set password value
     * @param string $password the password
     * @return string
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

}
