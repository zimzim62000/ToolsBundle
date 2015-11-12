<?php


namespace ZIMZIM\ToolsBundle\Model\APYDataGrid;

use APY\DataGridBundle\Grid\Source\Entity;
use SensioLabs\Security\SecurityChecker;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

interface ApyDataGridRepositoryInterface{

    /** @return source */
    public function getList(Entity $source, TokenStorage $token, SecurityChecker $securityChecker );

}
