<?php

namespace ZIMZIM\ToolsBundle\Doctrine;

use Doctrine\ORM\EntityManager;
use ZIMZIM\ToolsBundle\Doctrine\Configuration\ConfigurationManagerInterface;

abstract class Manager
{
    protected $className;
    protected $formName;
    protected $entityManager;
    protected $configuration;


    public function __construct(EntityManager $entityManager, ConfigurationManagerInterface $configuration)
    {
        $this->entityManager = $entityManager;

        $this->className = $configuration->getClassName();
        $this->formName = $configuration->getFormName();
        $this->configuration = $configuration;
    }

    public function createEntity()
    {
        return clone $this->configuration->getCLass();
    }

    public function getRepository()
    {
        return $this->entityManager->getRepository($this->className);
    }


    public function find($id)
    {
        return $this->getRepository()->find($id);
    }

    /**
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @return mixed
     */
    public function getFormName()
    {
        return $this->formName;
    }
}
