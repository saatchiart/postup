<?php

namespace Saatchi\Service\Soap;

class Response
{
    /** @var \SoapFault */
    protected $error;

    /**
     * @return \SoapFault
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @param \SoapFault $error
     */
    public function setError(\SoapFault $error)
    {
        $this->error = $error;
    }

    /**
     * @return bool
     */
    public function hasSoapError()
    {
        return !$this->isSuccess();
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return (null === $this->getError());
    }
}