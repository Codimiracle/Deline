<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 18-1-26
 * Time: 下午4:18
 */

namespace CAstore\Component;


use PDO;

class MySQLDataSource implements DataSource
{
    /**
     * @var \PDO
     */
    private $connection;

    public function __construct($config = null)
    {
        if (is_null($config)) {
            $config = $GLOBALS["database"];
        }
        $dns = "mysql:host=".$config["database_host"].";dbname=".$config["database_name"].";charset=utf8";
        $this->connection = new PDO($dns, $config["database_username"], $config["database_password"]);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * 获取 PDO 链接。
     * @return PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }

}