<?php

namespace ZIMZIM\ToolsBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use APY\DataGridBundle\Grid\Mapping as GRID;

trait MetaSEO{

    /**
     * @var string
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     * @ORM\Column(name="title_seo", type="string", length=255)
     */
    public $titleSeo;

    /**
     * @var string
     *
     * @GRID\Column(operatorsVisible=false, visible=false, filterable=false)
     * @ORM\Column(name="desc_seo", type="text")
     */
    public $descSeo;

    /**
     * @return string
     */
    public function getTitleSeo()
    {
        return $this->titleSeo;
    }

    /**
     * @param string $titleSeo
     *
     * @return Object use this trait
     */
    public function setTitleSeo($titleSeo)
    {
        $this->titleSeo = $titleSeo;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescSeo()
    {
        return $this->descSeo;
    }

    /**
     * @param string $descSeo
     *
     * @return Object use this trait
     */
    public function setDescSeo($descSeo)
    {
        $this->descSeo = $descSeo;

        return $this;
    }
}
