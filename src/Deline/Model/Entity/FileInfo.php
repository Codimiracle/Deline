<?php
namespace Deline\Model\Entity;

class FileInfo implements Entity
{

    /** @var int */
    public $id;

    /** @var int */
    public $targetId;
    
    public $field;

    /** @var string */
    public $path;

    /** @var int */
    public $size;

    /** @var string */
    public $mimeType;

    /** @var string */
    public $uploadedTime;

    /** @var string */
    public $updatedTime;

    /**
     *
     * @return number
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return number
     */
    public function getTargetId()
    {
        return $this->targetId;
    }
    
    

    /**
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param mixed $field
     */
    public function setField($field)
    {
        $this->field = $field;
    }

    /**
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     *
     * @return number
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

    /**
     *
     * @return string
     */
    public function getUploadedTime()
    {
        return $this->uploadedTime;
    }

    /**
     *
     * @return string
     */
    public function getUpdatedTime()
    {
        return $this->updatedTime;
    }

    /**
     *
     * @param number $targetId
     */
    public function setTargetId($targetId)
    {
        $this->targetId = $targetId;
    }

    /**
     *
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     *
     * @param number $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     *
     * @param string $mimeType
     */
    public function setMimeType($mimeType)
    {
        $this->mimeType = $mimeType;
    }

    /**
     *
     * @param string $uploadedTime
     */
    public function setUploadedTime($uploadedTime)
    {
        $this->uploadedTime = $uploadedTime;
    }

    /**
     *
     * @param string $updatedTime
     */
    public function setUpdatedTime($updatedTime)
    {
        $this->updatedTime = $updatedTime;
    }
}

