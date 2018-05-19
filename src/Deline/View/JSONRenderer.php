<?php
namespace Deline\View;

use Deline\Component\Container;

class JSONRenderer implements Renderer
{
    const RESULT_TYPE_DATA = "data";

    const RESULT_TYPE_ERROR = "error";

    private $container;

    private $attributes = array();

    private $json = array();

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

    public function setParameter($key, $value)
    {
        $this->json[$key] = $value;
    }

    public function getParameter($key)
    {
        return isset($this->json[$key]) ? $this->json[$key] : null;
    }

    public function render()
    {
        ob_clean();
        header("Content-Type: text/json");
        echo json_encode($this->json);
    }

    public function setAttribute($attribute_name, $attribute_value)
    {
        $this->attributes[$attribute_name] = $attribute_value;
    }

    public function getAttribute($attribute_name)
    {
        return $this->attributes[$attribute_name];
    }
}