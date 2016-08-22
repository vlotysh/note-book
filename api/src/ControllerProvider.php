<?php

namespace Notebook;

use Symfony\Component\HttpFoundation\Request;
use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Notebook\Modules\Core\Router;
use Notebook\Modules\ApiKernel\Result;
use Notebook\Modules\Exception\NotebookException;
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
class ControllerProvider implements ControllerProviderInterface {

    private $container;

    public function __construct(\Pimple\Container $container) {
        $this->container = $container;
    }

    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app) {
        
        ExceptionHandler::register(false);
        
        $app->error(function (\Exception $e, $code) {
            $result = new Result();

            if($e instanceof NotebookException){
                $result->setFailure($e->getCode(), $e->getMessage());
            }else {
                $result->setFailure(10, $e->getMessage());
            }
            
            return json_encode($result->toArray());
            
        });
        
        


        $app->before(function (Request $request) {
            if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
                $data = json_decode($request->getContent(), true);
                $request->request->replace(is_array($data) ? $data : array());
            }
        });

        $router = new Router($app, $this->container);

        $controllers = $router->controllerMapping();

        return $controllers;
    }

}
