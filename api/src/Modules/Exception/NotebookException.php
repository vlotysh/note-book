<?php

namespace Notebook\Modules\Exception;

class NotebookException extends APIException
{
    protected $statusCode = 10;
    protected $statusMessage = '';

    public function __construct($statusMessage = null, $statusCode = null, $errorArr = array())
    {
        if (!empty($statusCode)) {
            $this->statusCode = $statusCode;
        }

        if (!empty($statusMessage)) {
            $this->statusMessage = $statusMessage;
        }

        parent::__construct($this->statusCode, $this->statusMessage, $errorArr);
    }
}