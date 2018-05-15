<?php
namespace Deline\Model\DAO;

class DecrementPager implements Pager
{

    private $offset;

    private $length;

    private $key;

    /**
     *
     * @param string $key
     *              NOTE: you must escape the $key
     * @param int $offset
     * @param int $length
     */
    public function __construct($key, $offset, $length)
    {
        $this->offset = $offset;
        $this->length = $length;
        $this->key = $key;
    }

    public function getTranformSQL($sentence)
    {
        return $sentence . "ORDER BY " . $this->key . " LIMIT :offset, :length";
    }

    public function getOffset()
    {
        return $this->offset * $this->length;
    }

    public function getLength()
    {
        return $this->length;
    }
}

