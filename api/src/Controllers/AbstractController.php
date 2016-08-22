<?php

namespace Notebook\Controllers;

use Notebook\Modules\ApiKernel\Result;

abstract class AbstractController {

    /**
     * @var Request
     */
    private $request;

    /**
     * @var UserInterface
     */
    private $user;

    /**
     * @var Application
     */
    private $app;

    function __construct(\Silex\Application $app) {
        $this->setApp($app);

        $this->setRequest($app['request']);
        
    }

    abstract function execute($params);

    public function beforeDispatch() {
        return;
    }

    public function dispatch($params = []) {
        $results = $this->execute($params);



        $response = new Result();
        $response->setSuccess($results);

        return json_encode($response->toArray());
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     */
    public function setRequest(\Symfony\Component\HttpFoundation\Request $request) {
        $this->request = $request;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Request
     */
    public function getRequest() {
        return $this->request;
    }

    /**
     * @param Application $app
     */
    public function setApp($app) {
        $this->app = $app;
    }

    /**
     * @return Application
     */
    public function getApp() {
        return $this->app;
    }

}
