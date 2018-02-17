<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-2-1
 * Time: 下午8:42
 */

namespace CAstore\Action;


use CAstore\Component\DataSource;
use CAstore\Component\NodePath;
use CAstore\Component\SessionManager;
use CAstore\Template\Renderer;

interface Context
{
    /**
     * @return DataSource
     */
    public function getDataSource();

    /**
     * @return Renderer
     */
    public function getRenderer();

    /**
     * @return SessionManager
     */
    public function getSession();

    /**
     * @return NodePath
     */
    public function getNodePath();
}