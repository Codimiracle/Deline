<?php
namespace Deline\Controller;

use Deline\Component\Container;
use Deline\Component\Mapper;
use Deline\View\RendererBuilder;

/**
 * Class AbstractController
 * 代表一个 抽象动作 。
 * 具体请点击<a href="docs\Structure.md">这里</a>
 *
 * @package Deline\Component\AbstractController
 */
abstract class AbstractController implements Controller
{

    /**
     *
     * @var Container
     */
    protected $container;

    private $mapper;

    /**
     *
     * @var RendererBuilder
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
     *
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     *
     * @param Container $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
        $this->view = new RendererBuilder($container->getRenderer());
    }

    public function attachAction($pattern, $method)
    {
        $this->mapper->map($pattern, $method);
    }

    /**
     *
     * @param string $submit_id
     * @return bool
     */
    public function isSubmit($submit_id)
    {
        return isset($_POST[$submit_id]) && ($_POST[$submit_id] == $submit_id);
    }

    protected function getNodePath()
    {
        return $this->container->getNodePath()->getSubnodePath();
    }

    /**
     *
     * @return string
     */
    private function getCurrentNodePathname()
    {
        global $logger;
        $pathname = strval($this->getNodePath());
        $logger->addDebug("Controller", array("matched" => $pathname, "class" => get_class($this)));
        return $pathname;
    }

    public function onControllerHandle()
    {
        global $logger;
        $method_name = $this->mapper->match($this->getCurrentNodePathname());
        $logger->addDebug("Controller", array("method" => $method_name));
        if ($method_name) {
            $this->$method_name();
        } else {
            $this->onActionDefaultHandle();
        }
    }

    public function onControllerDefaultHandle()
    {}

    public abstract function onControllerStart();

    public abstract function onControllerEnd();
}
