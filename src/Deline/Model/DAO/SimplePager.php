<?php
namespace Deline\Model\DAO;

class SimplePager implements Pager
{

    private $offset;

    private $length;

    public function __construct($offset, $length)
    {
        $this->offset = $offset;
        $this->length = $length;
    }

    public function getTranformSQL($sentence)
    {
        return $sentence . " LIMIT :offset, :length";
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

