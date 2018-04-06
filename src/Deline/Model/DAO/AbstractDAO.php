<?php
namespace Deline\Model\DAO;

use Deline\Model\Database\DataSource;
use Deline\Model\Entity\Entity;

abstract class AbstractDAO implements DataAccessObject
{

    /**
     *
     * @var Entity
     */
    private $target;

    /**
     *
     * @var Pager
     */
    private $pager;

    /**
     *
     * @var DataSource
     */
    private $dataSource;

    /**
     * 获取目标
     *
     * @return mixed
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * 设置目标
     *
     * @param mixed $target
     */
    public function setTarget($target)
    {
        $this->target = $target;
    }

    /**
     * 获取分页器
     *
     * @return Pager
     */
    public function getPager()
    {
        return $this->pager;
    }

    /**
     * 设置分页器
     *
     * @param Pager $pager
     */
    public function setPager($pager)
    {
        $this->pager = $pager;
    }

    /**
     * 获取数据库服务器
     *
     * @return DataSource
     */
    public function getDataSource()
    {
        return $this->dataSource;
    }

    /**
     * 数据库访问器
     *
     * @param DataSource $data_source
     */
    public function setDataSource($data_source)
    {
        $this->dataSource = $data_source;
    }

    /**
     * 查询预处理针对多记录
     *
     * @param string $sentence
     * @return \PDOStatement
     */
    private function preparingMultirecords($sentence)
    {
        if (! is_null($this->getPager())) {
            $sentence = $this->getPager()->getTranformSQL($sentence);
        }
        $prepared = $this->getDataSource()
            ->getConnection()
            ->prepare($sentence);
        if (! is_null($this->getPager())) {
            $prepared->bindParam(":offset", $this->getPager()
                ->getOffset());
            $prepared->bindParam(":length", $this->getPager()
                ->getLength());
        }
        return $prepared;
    }

    /**
     * 将结果集映射到 Entity 。
     *
     * @param string $query
     * @return array|null
     */
    protected function getEntities($query, $args, $class)
    {
        $prepared = $this->preparingMultirecords($query);
        foreach ($args as $parameter => $value) {
            $prepared->bindValue($parameter, $value);
        }
        if ($prepared->execute()) {
            return $prepared->fetchAll(\PDO::FETCH_CLASS, $class);
        } else {
            return null;
        }
    }

    /**
     * 将结果集单条记录映射到 Entity 。
     * @param string $query
     * @param mititype:string $args
     * @param string $class
     * @return NULL
     */
    protected function getEntity($query, $args, $class)
    {
        $results = $this->getEntities($query, $args, $class);
        if (isset($results[0])) {
            return $results[0];
        } else {
            return null;
        }
    }
}