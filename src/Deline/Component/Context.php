<?php
namespace Deline\Component;

use Deline\View\Renderer;
use Deline\Model\Database\DataSource;

interface Context
{

    /**
     *
     * @return DataSource
     */
    public function getDataSource();

    /**
     *
     * @return Renderer
     */
    public function getRenderer();

    /**
     *
     * @return Session
     */
    public function getSession();

    /**
     *
     * @return NodePath
     */
    public function getNodePath();

    /**
     *
     * @return Authorization
     */
    public function getAuthorization();

    /**
     *
     * @return ComponentCenter
     */
    public function getComponentCenter();
}