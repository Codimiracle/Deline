<?php
namespace Deline\Component;

use Deline\Model\Database\DataSource;
use Deline\View\Renderer;

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
     * @return SessionManager
     */
    public function getSession();

    /**
     *
     * @return NodePath
     */
    public function getNodePath();
}