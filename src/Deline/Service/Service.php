<?php
namespace Deline\Service;

use Deline\Component\Context;

interface Service
{

    /**
     *
     * @param Context $context
     */
    public function setContext($context);

    /**
     *
     * @return Context
     */
    public function getContext();
}