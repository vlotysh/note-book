<?php

namespace Notebook\Modules\Exception;

class APIException extends \Exception
{
    private $httpCode;
    private $statusCode;
    private $statusMessage;
    private $errors;

    public function __construct($statusCode, $statusMessage, $errorArr = array(), $httpCode = \Symfony\Component\HttpFoundation\Response::HTTP_OK)
    {
        parent::__construct($statusMessage, $statusCode);
        $this->setHttpCode($httpCode);
        $this->setStatusCode($statusCode);
        $this->setStatusMessage($statusMessage);
        $this->setErrors($errorArr);
    }

    public function getHttpCode()
    {
        return $this->httpCode;
    }

    public function setHttpCode($httpCode)
    {
        $this->httpCode = $httpCode;
    }

    /**
     * @param mixed $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param mixed $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param mixed $statusMessage
     */
    public function setStatusMessage($statusMessage)
    {
        $this->statusMessage = $statusMessage;
    }

    /**
     * @return mixed
     */
    public function getStatusMessage()
    {
        return $this->statusMessage;
    }


    public function __toString()
    {
        return sprintf("API Error %d: %s (HTTP #%s). Error stack: %s", $this->getStatusCode(), $this->getStatusMessage(), $this->getHttpCode(), print_r($this->getErrors(), true));
    }

}