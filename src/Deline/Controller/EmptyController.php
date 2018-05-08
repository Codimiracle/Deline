<?php
namespace Deline\Controller;

use Deline\Component\PageNotFoundException;

class EmptyController implements Controller
{

    public function onControllerDefaultHandle()
    {
        throw new PageNotFoundException();
    }

    public function onControllerEnd()
    {}

    public function onControllerHandle()
    {
        $this->onControllerDefaultHandle();
    }

    public function onControllerStart()
    {}
    public function getContainer()
    {}

    public function setContainer($container)
    {}

}

