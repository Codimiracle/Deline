<?php

namespace Deline\Action;

use Deline\Component\Container;
use Deline\Component\DelineContainer;
use Deline\Component\Mapper;
use Deline\Component\SessionManager;
use Deline\Template\Renderer;
use Deline\Template\RendererSetter;

/**
 * Class AbstractAction
 * 代表一个 抽象动作 。
 * 具体请点击<a href="docs\Structure.md">这里</a>
 * @package CAstore\AbstractAction
 */
abstract class AbstractAction
{
    /**
     * @var Container
     */
    protected $container;

    private $mapper;

    /**
     * @var RendererSetter
     */
    protected $view;

    /**
     * AbstractAction constructor.
     */
    public function __construct()
    {
        $this->mapper = new Mapper();
    }

    /**
     * @return Context
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param Context $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
        $this->view = new RendererSetter($container->getRenderer());
    }

    public function attachAction($pattern, $method) {
        $this->mapper->map($pattern, $method);
    }

    /**
     * @param string $submit_id
     * @return bool
     */
    public function isSubmit($submit_id) {
        return isset($_POST[$submit_id]) && ($_POST[$submit_id] == $submit_id);
    }

    protected function getNodePath() {
        return $this->container->getNodePath()->getSubnodePath();
    }
    /**
     * @return string
     */
    private function getCurrentNodePathname()
    {
        global $logger;
        $pathname = strval($this->getNodePath());
        $logger->addDebug("Action Pathname matching: ".$pathname);
        return $pathname;
    }
    public function onActionHandle() {
        global $logger;
        $method_name = $this->mapper->match($this->getCurrentNodePathname());
        $logger->addDebug("Action Method invoking: ".$method_name);
        if ($method_name) {
            $this->$method_name();
        } else {
            $this->onActionDefaultHandle();
        }
    }
    public function onActionDefaultHandle() {}
    public abstract function onActionStart();
    public abstract function onActionEnd();
}
