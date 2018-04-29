<?php
namespace Deline\View;

use Deline\Component\Container;

class HTMLRenderer implements Renderer
{

    private $parameters = array();

    private $attributes = null;

    private $container;

    public function __construct()
    {
        global $website;
        $this->attributes = $website;
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
    }

    // 设置 Renderer Variable.
    public function setParameter($key, $value)
    {
        $this->parameters[$key] = $value;
    }

    // 获取 Renderer Variable.
    public function getParameter($key)
    {
        if (isset($this->parameters[$key])) {
            return $this->parameters[$key];
        } else {
            return null;
        }
    }

    private function load($template_name)
    {
        $template_file = "templates/tpl." . $template_name . ".php";
        if (file_exists($template_file)) {
            $attributes = $this->attributes;
            $parameters = $this->parameters;
            $session = $this->container->getSession()->getSessionData();
            require __DIR__ . '/view.func.php';
            require $template_file;
        }
    }

    public function render()
    {
        $page_tpl_name = $this->getAttribute("page-name");
        $this->load($page_tpl_name);
    }

    public function setAttribute($attribute_name, $attribute_value)
    {
        $this->attributes[$attribute_name] = $attribute_value;
    }

    public function getAttribute($attribute_name)
    {
        if (isset($this->attributes[$attribute_name])) {
            return $this->attributes[$attribute_name];
        } else {
            return null;
        }
    }
}