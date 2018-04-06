<?php
namespace Deline\Component;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class DelineAppclication
{
    /** @var Logger */
    private $logger;
    
    /** @var Container */
    private $container;
    
    /** @var ComponentCenter */
    private $componentCenter;
    
    /**
     * @return ComponentCenter
     */
    public function getComponentCenter()
    {
        return $this->componentCenter;
    }

    /**
     * @param ComponentCenter $componentCenter
     */
    public function setComponentCenter($componentCenter)
    {
        $this->componentCenter = $componentCenter;
        $this->container = new DelineContainer();
        $this->container->setComponentCenter($componentCenter);
    }

    /**
     * @return Logger
     */
    public function getLogger()
    {
        return $this->logger;
    }
    /**
     * @param Logger $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param Container $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }
    
    public function run()
    {
        try {
            $this->logger->addDebug("DelineApplication", array("status" => "initializing"));
            $this->container->init();
            $this->logger->addDebug("DelineApplication", array("status" => "invoking"));
            $this->container->invoke();
            $this->logger->addDebug("DelineApplication", array("status" => " destroy"));
            $this->container->destroy();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}

