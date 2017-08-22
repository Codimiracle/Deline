<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 17-8-19
 * Time: 下午3:43
 */

namespace Modules\Database;


abstract class Entity
{
    private $data;

    /**
     * Entity constructor.
     * @param \mysqli_result $result
     */
    protected function __construct(\mysqli_result $result)
    {
        $this->data = $result->fetch_assoc();
    }

    /**
     * @param string $field_name
     * @return mixed
     */
    protected function get($field_name) {
        return $this->data[$field_name];
    }

    /**
     * @param string $fiedl_name
     * @param mixed $value
     */
    protected function set($fiedl_name, $value) {
        $this->data[$fiedl_name] = $value;
    }
}