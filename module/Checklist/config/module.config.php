<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Checklist\Controller\Task' => 'Checklist\Controller\TaskController',
        ),
    ),
//     'router' => array(
//         'routes' => array(
//             'checklist' => array( // URL of /checklist/foo/bar maps to the barAction() method of the FooController within the Checklist module
//                 'type'    => 'Literal',
//                 'options' => array(
//                     // Change this to something specific to your module
//                     'route'    => '/task',  // /task is the URL mapped to the index action of controller Task  // Voir manual pour changer la route name to task with a single segment
//                     'defaults' => array(
//                         // Change this value to reflect the namespace in which
//                         // the controllers for your module are found
//                         '__NAMESPACE__' => 'Checklist\Controller',
//                         'controller'    => 'Task',
//                         'action'        => 'index',
//                     ),
//                 ),
//                 'may_terminate' => true,
//                 'child_routes' => array(
//                     // This route is a sane default when developing a module;
//                     // as you solidify the routes for your module, however,
//                     // you may want to remove it and replace it with more
//                     // specific routes.
//                     'default' => array(
//                         'type'    => 'Segment',
//                         'options' => array(
//                             'route'    => '/[:controller[/:action]]', //will be /task/task/add !!!
//                             'constraints' => array(
//                                 'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                                 'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
//                             ),
//                             'defaults' => array(
//                             ),
//                         ),
//                     ),
//                 ),
//             ),
//         ),
//     ),
    'router' => array(
    		'routes' => array(
    				'task' => array(
    						'type'    => 'Segment',
    						'options' => array(
    								'route'    => '/task[/:action[/:id]]',
    								'defaults' => array(
    										'__NAMESPACE__' => 'Checklist\Controller',
    										'controller'    => 'Task',
    										'action'        => 'index',
    								),
    								'constraints' => array(
    										'action' => '(add|edit|delete)',
    										'id'     => '[0-9]+',
    								),
    						),
    				),
    		),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Checklist' => __DIR__ . '/../view',        // module/<module-name>/view/tolower(<module-name>)/tolower(<controller-name>)/<view-name> mc under view
        ),
    ),
);
