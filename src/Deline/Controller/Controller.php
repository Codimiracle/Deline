<?php
namespace Deline\Controller;

interface Controller
{
    public function onControllerHandle();

    public function onControllerDefaultHandle();

    public function onControllerStart();

    public function onControllerEnd();
}