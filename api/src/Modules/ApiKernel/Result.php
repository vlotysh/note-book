<?php

namespace Notebook\Modules\ApiKernel;

class Result
{
    const CODE_REQ_SUCCESS = 0;
    private $status;
    private $results;
    private $errors;

    public function __construct()
    {
        $this->status = array(
            'code' => 0,
            'msg'  => 'ok'
        );
        $this->results = array();
        $this->errors = array();
    }

    public function isFailure()
    {
        return ($this->status['code'] !== self::CODE_REQ_SUCCESS);
    }

    public function getFailureStr()
    {
        return $this->status['msg'];
    }

    public function setFailure($code, $msg, $errors = array())
    {
        $this->status['code'] = $code;
        $this->status['msg'] = $msg;
        $this->errors = $errors;
        return $this;
    }

    public function setSuccess($results){
        $this->status['code'] = self::CODE_REQ_SUCCESS;
        $this->status['msg'] = "ok";
        $this->results = $results;
        return $this;
    }

    public function toArray(){
        return [
            'status' => $this->status,
            'results' => $this->results,
            'errors' => $this->errors

        ];
    }



}