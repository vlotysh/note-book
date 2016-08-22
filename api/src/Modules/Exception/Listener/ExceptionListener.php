<?php

namespace Notebook\Modules\Exception\Listener;

use Notebook\Modules\Exception\APIException;

class ExceptionListener extends APIException
{
    private $triggered = false;
    private $app;

    public function __construct(\Silex\Application $app)
    {
        $this->app = $app;
        
    }

    public function onException(\Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent $event)
    {
        if (!$event->hasResponse()) {
            $e = $event->getException();

            $result = new Result();
            $result->setFailure(10, $e->getMessage());

            $event->setResponse(new Response(json_encode($result->toArray())));
        }
    }

    public function setTriggered()
    {
        $this->triggered = true;
    }

    public function getTriggered()
    {
        return $this->triggered;
    }

}