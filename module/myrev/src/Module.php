<?php

namespace myrev;

use myrev\Controller\IndexController;
use myrev\Model\User;
use myrev\Model\UserTable;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return [
            'factories' => [
                UserTable::class => function($container) {
                    $tableGateway = $container->get(UserTableGateway::class);
                    return new Model\UserTable($tableGateway);
                },
                UserTableGateway::class => function ($container) {
                    $dbAdapter = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new User());
                    return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
                },
            ],
        ];
    }

    public function getControllerConfig()
    {
        return [
            'factories' => [
                IndexController::class => function($container) {
                    return new IndexController(
                        $container->get(UserTable::class)
                    );
                },
            ],
        ];
    }
}
