<?php
namespace Deline\Proxy;

use Deline\Component\PageNotFoundException;
use Deline\Component\PermissionException;
use Deline\Controller\Controller;

class ControllerProxy implements Controller
{

    private $controller;
    private $logger;

    public function setController($controller)
    {
        $this->controller = $controller;
    }
    
    public function getContainer() {
        return $this->controller->getContainer();
    }
    
    public function setContainer($container) {
        $this->controller->setContainer($container);
    }

    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    public function onControllerEnd()
    {
        $this->logger->debug("controller end");
        $this->controller->onControllerEnd();
    }

    public function onControllerHandle()
    {
        $this->logger->debug("controller handling.");
        try {
            $this->controller->onControllerHandle();
        } catch (PermissionException $exception) {
            $this->logger->warning("Controller", array(
                "message" => $exception->getMessage(),
                "trace" => $exception->getTrace(),
            ));
            throw $exception;
        } catch (PageNotFoundException $exception) {
            $this->logger->warning("Controller", array(
                "message" => $exception->getMessage(),
                "trace" => $exception->getTrace(),
            ));
            throw $exception;
        } catch (\Exception $exception) {
            $this->logger->error("Controller", array(
                "message" => $exception->getMessage(),
                "trace" => $exception->getTrace(),
            ));
            throw $exception;
        }
    }

    public function onControllerStart()
    {
        $this->logger->debug("controller start");
        $this->controller->onControllerStart();
    }

    public function onControllerDefaultHandle()
    {
        $this->logger->debug("controller default handling.");
        $this->controller->onControllerDefaultHandle();
    }
}

