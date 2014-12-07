<?php


namespace ZIMZIM\ToolsBundle\Model\APYDataGrid;

use APY\DataGridBundle\Grid\Source\Entity;

interface ApyDataGridRepositoryInterface{

    /** @return source */
    public function getList(Entity $source);

}
