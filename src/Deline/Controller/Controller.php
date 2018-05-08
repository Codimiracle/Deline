<?php
namespace Deline\Controller;

use Exception;

interface Controller
{
    public function setContainer($container);
    public function getContainer();
    
    /**
     *
     * @throws Exception
     */
    public function onControllerHandle();

    public function onControllerDefaultHandle();

    public function onControllerStart();

    public function onControllerEnd();
}