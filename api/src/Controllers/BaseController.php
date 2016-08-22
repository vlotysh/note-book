<?php

namespace Notebook\Controllers;

use Silex\Application;

abstract class BaseController extends AbstractController {

    protected $container;
    protected $session;
    protected $route;
    protected $token;

    public function __construct(Application $app, $container) {
        parent::__construct($app);

        $this->container = $container;
        $this->route = $this->getRequest()->get('_route');
        var_dump($this->route);
        exit();
    }

}
