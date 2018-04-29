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
    private function load($page_name) {
        $template_file = getcwd() . "/templates/tpl." . $page_name . ".php";
        if (file_exists($template_file)) {
            $attributes = $this->attributes;
            $parameters = $this->parameters;
            $session = $this->container->getSession()->getSessionData();
            require $template_file;
        }
    }
    // 加载 HTML 模板带操作函数
    private function loadPage($page_name)
    {
        require __DIR__.'/view.func.php';
        $this->load($page_name);
    }

    public function render()
    {
        $this->load($this->getAttribute("page-name").".head");
        $this->loadPage($this->getAttribute("page-name"));
        $this->load($this->getAttribute("page-name").".foot");
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