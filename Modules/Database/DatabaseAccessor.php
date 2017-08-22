<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 17-8-19
 * Time: 下午3:04
 */

namespace Modules\Database;


class DatabaseAccessor
{
    /**
     * @var \mysqli
     */
    private $connection;
    public function __construct()
    {
        $this->connection = mysqli_connect(
            DatabaseConfig::DATABASE_HOST,DatabaseConfig::DATABASE_NAME,
            DatabaseConfig::DATABASE_PASSWORD,DatabaseConfig::DATABASE_NAME,
            DatabaseConfig::DATABASE_PORT);

    }

    /**
     * @param $sql
     * @return \mysqli_stmt
     */
    public function prepare($sql) {
        return $this->connection->prepare($sql);
    }

    /**
     * @param $sql
     * @return bool|\mysqli_result
     */
    public function query($sql) {
        return $this->connection->query($sql);
    }

    public function __destruct()
    {
        $this->connection->close();
    }
}