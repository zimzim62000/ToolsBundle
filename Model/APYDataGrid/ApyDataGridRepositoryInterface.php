<?php


namespace ZIMZIM\ToolsBundle\Model\APYDataGrid;

use APY\DataGridBundle\Grid\Source\Entity;
use Symfony\Component\Security\Core\SecurityContext;

interface ApyDataGridRepositoryInterface{

    /** @return source */
    public function getList(Entity $source, SecurityContext $securityContext);

}
