<?php

namespace Notebook\Modules\Core;

use Symfony\Component\HttpFoundation\Request;

class Router {

    private $HTTPMethods = array(
        'GET',
        'POST',
        'PUT',
        'DELETE',
    );
    private $container;
    private $app;
    private $routes;

    public function __construct(\Silex\Application $app, \Pimple\Container $container) {
        $this->app = $app;
        $this->container = $container;
        $this->routes = $this->container['notebook.routes'];
    }

    public function controllerMapping() {
        $controllerCollection = $this->app['controllers_factory'];

        foreach ($this->routes as $routeName => $params) {
            if (!$this->checkHTTPMethod($params['method'])) {
                continue;
            };

            $controller = $params['controller'];
            $path = $params['path'];
            $method = strtolower($params['method']);
            $app = $this->app;
            $container = $this->container;

            $controllerCollection->{$method}($path, function (Request $request) use ($app, $controller, $container, $path) {
                $params = $this->paramsParser($path, $request);
                $app['request'] = $request;
                $controller = new $controller($app, $container);
                $controller->beforeDispatch();

                return $controller->dispatch($params);
            });
        }
        return $controllerCollection;
    }

    public function paramsParser($url, Request $request) {
        $params = array();
        preg_match_all('/{(.*)}/U', $url, $matches);
        $matches = $matches[1];

        foreach ($matches as $matche) {
            $params[$matche] = $request->attributes->get($matche);
        }

        return $params;
    }

    protected function checkHTTPMethod($method) {
        return in_array($method, $this->HTTPMethods);
    }

}
