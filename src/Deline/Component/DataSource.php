<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 17-8-19
 * Time: 下午3:04
 */

namespace CAstore\Component;

use \PDO;

interface DataSource
{
    /**
     * 获取 PDO 链接。
     * @return PDO
     */
    public function getConnection();
}