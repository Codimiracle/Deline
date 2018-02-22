<?php
namespace Deline\Model\Database;

use \PDO;

interface DataSource
{

    /**
     * 获取 PDO 链接。
     *
     * @return PDO
     */
    public function getConnection();
}