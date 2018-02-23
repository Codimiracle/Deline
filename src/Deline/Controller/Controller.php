<?php
namespace Deline\Controller;

use Exception;

interface Controller
{
    /**
     * @throws Exception
     */
    public function onControllerHandle();

    public function onControllerDefaultHandle();

    public function onControllerStart();

    public function onControllerEnd();
}