<?php
namespace Deline\Service;

use Deline\Component\Container;
use Deline\Model\DAO\FileInfoDAO;


class DelineFileService implements FileService
{
    /** @var FileInfoDAO */
    private $fileInfoDAO;
    
    /** @var Container */
    private $container;
    
    /** @var UploadService */
    private $uploadService;
    
    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param Container $container
     */
    public function setContainer($container)
    {
        $this->container = $container;
        $this->fileInfoDAO = $container->getComponentCenter()->getDataAccessObject("FileInfoDAO");
    }
    
    public function edit($entity)
    {
        $this->fileInfoDAO->setTarget($entity);
        $this->fileInfoDAO->update();
    }

    public function delete($entity)
    {
        $this->fileInfoDAO->setTarget($entity);
        $this->fileInfoDAO->delete();
    }

    public function append($entity)
    {
        $this->fileInfoDAO->setTarget($entity);
        $this->fileInfoDAO->insert();
    }

    public function queryById($id)
    {
        return $this->fileInfoDAO->queryById($id);
    }
    
    public function query()
    {
        return $this->fileInfoDAO->query();
    }
    
    public function queryByTargetId($targetId)
    {
        return $this->fileInfoDAO->queryByTargetId($targetId);
    }
    public function getLastInsertedId()
    {
        return $this->fileInfoDAO->getLastInsertedId();
    }

}

