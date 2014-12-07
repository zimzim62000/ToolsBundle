<?php

namespace ZIMZIM\ToolsBundle\Doctrine\Configuration;

class Configuration implements ConfigurationManagerInterface
{
    protected $className;
    protected $formName;

    public function __construct($class, $formName)
    {
        $this->class = $class;
        $this->className = get_class($this->class);
        $this->formName = $formName;
    }

    public function getClass(){
        return $this->class;
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
