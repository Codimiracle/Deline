<?php
namespace Deline\Component;

use Monolog\Logger;
use Deline\Proxy\ContainerProxy;

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
        $container = new DelineContainer();
        $this->container = new ContainerProxy();
        $this->componentCenter->setLogger($this->logger);
        $this->container->setLogger($this->logger);
        $this->container->setContainer($container);
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
            $this->container->init();
            $this->container->invoke();
            $this->container->destroy();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}

