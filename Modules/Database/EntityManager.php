<?php
/**
 * Created by PhpStorm.
 * User: codimiracle
 * Date: 17-8-19
 * Time: 下午3:43
 */

namespace Modules\Database;


abstract class EntityManager
{
    private $database;
    /**
     * @var Entity
     */
    private $target;

    public function __construct()
    {
        $this->database = new DatabaseAccessor();
    }

    /**
     * @param Entity $target
     */
    public function setTarget($target)
    {
        $this->target = $target;
    }

    /**
     * @return Entity
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @throws EntityAccessingException
     */
    public abstract function append();
    /**
     * @throws EntityAccessingException
     */
    public abstract function remove();
    /**
     * @throws EntityAccessingException
     */
    public abstract function update();

    /**
     * @throws EntityAccessingException
     */
    public abstract function query();
}