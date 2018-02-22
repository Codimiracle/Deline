<?php
namespace Deline\Component;

use Deline\Controller\ControllerFactory;
use Deline\Model\DAO\DataAccessObjectFactory;
use Deline\Service\ServiceFactory;
use Deline\View\RendererFactory;

interface ComponentCenter extends ControllerFactory, DataAccessObjectFactory, ServiceFactory, RendererFactory
{

    public function setContainer($container);

    public function getContainer();
}