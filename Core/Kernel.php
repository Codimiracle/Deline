<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 17-8-18
 * Time: 下午3:56
 */

namespace Core;

use Core\Services\ModuleInvokerService;
use Core\Services\Service;

class Kernel
{
    const SERVICE_MODULE_INVOKER = "service_module_invoker";

    /**
     * @var array
     */
    private $services = array();

    public function __construct()
    {
        $this->putService(self::SERVICE_MODULE_INVOKER, new ModuleInvokerService());
    }
    /**
     * @param string $name
     * @param Service $service
     */
    private function putService($name, $service) {
        $this->services[$name] = $service;
    }

    /**
     * @param string $service_name
     * @return Service
     */
    public function getService($service_name) {
        return $this->services[$service_name];
    }

}