<?php
namespace Deline\View;

interface RendererFactory
{

    public function getRenderer($type = "html");
}