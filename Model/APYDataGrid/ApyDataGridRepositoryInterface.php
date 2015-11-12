<?php


namespace ZIMZIM\ToolsBundle\Model\APYDataGrid;

use APY\DataGridBundle\Grid\Source\Entity;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;

interface ApyDataGridRepositoryInterface{
    /** @return source */
    public function getList(Entity $source, TokenStorage $token, AuthorizationChecker $checker );
}
