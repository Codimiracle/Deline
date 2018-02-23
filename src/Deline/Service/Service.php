<?php
namespace Deline\Service;

use Deline\Component\Container;

interface Service
{

    /**
     *
     * @param Container $container
     */
    public function setContainer($container);

    /**
     *
     * @return Container
     */
    public function getContainer();
}