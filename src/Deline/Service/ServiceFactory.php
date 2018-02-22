<?php
namespace Deline\Service;

interface ServiceFactory
{

    /**
     *
     * @param string $name
     *            服务名称
     * @return Service
     */
    public function getService($name);
}