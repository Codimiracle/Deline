<?php
namespace Deline\Proxy;

use Deline\Component\Container;
use Monolog\Logger;

class ContainerProxy implements Container
{

    private $componentCenterInited = false;

    /**@var Container */
    private $container;

    /** @var Logger */
    private $logger;
    
    

    /**
     * @return \Deline\Component\Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @return \Monolog\Logger
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param \Deline\Component\Container $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
    }

    /**
     * @param \Monolog\Logger $logger
     */
    public function setLogger($logger)
    {
        $this->logger = $logger;
    }

    public function redirect($node_pathname)
    {
        $this->logger->debug("redirecting to: " . $node_pathname);
        $this->container->redirect($node_pathname);
    }

    public function setComponentCenter($componentCenter)
    {
        if (! $this->componentCenterInited) {
            $this->logger->debug("component center is inited.");
            $this->componentCenterInited = true;
        } else {
            $this->logger->warning("component center reset.");
        }
        $this->container->setComponentCenter($componentCenter);
    }

    public function getComponentCenter()
    {
        return $this->getComponentCenter();
    }

    public function init()
    {
        $this->logger->debug("init container");
        if (!$this->componentCenterInited) {
            $this->logger->error("you did not initial component center yet!!");
        }
        $this->container->init();
    }

    public function getDataSource()
    {
        $this->logger->debug("getting data source");
        return $this->container->getDataSource();
    }

    public function getRenderer()
    {
        return $this->container->getRenderer();
    }

    public function dispatch($node_pathname)
    {
        $this->logger->debug("dispatching to: " . $node_pathname);
        $this->container->dispatch($node_pathname);
    }

    public function getNodePath()
    {
        $nodePath = $this->container->getNodePath();
        $this->logger->info("node path:" . $nodePath);
        return $nodePath;
    }

    public function destroy()
    {
        $this->logger->debug("container destory.");
        return $this->container->destroy();
    }

    public function invoke()
    {
        $this->logger->debug("container invoke start");
        try {
            $this->container->invoke();
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
        }
        $this->logger->debug("container invoke end");
    }

    public function getAuthorization()
    {
        return $this->container->getAuthorization();
    }

    public function getSession()
    {
        return $this->container->getSession();
    }
}

