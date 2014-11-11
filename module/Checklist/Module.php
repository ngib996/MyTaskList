<?php
namespace Checklist;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Checklist\Model\TaskMapper;

class Module implements AutoloaderProviderInterface // all 3 methods called by Module manager during start-up
{

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array( // need to enter new classes in autoload_classmap.php
                __DIR__ . '/autoload_classmap.php'
            ),
            'Zend\Loader\StandardAutoloader' => array( // no need to enter new classes in autoload_classmap.php
                'namespaces' => array(
                    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/', __NAMESPACE__)
                )
            )
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'TaskMapper' => function ($sm)
                {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $mapper = new TaskMapper($dbAdapter);       // an example of the Dependency Injection pattern as we have injected the database adapter into the mapper
                    return $mapper;
                }
            )
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e) // here we add listeners for MVC events triggered by EventManager
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
}
