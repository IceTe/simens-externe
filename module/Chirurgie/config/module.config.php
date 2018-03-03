<?php
return array (
		'controllers' => array (
				'invokables' => array (
						'Chirurgie\Controller\Chirurgie' => 'Chirurgie\Controller\ChirurgieController'
				)
		),
		'router' => array (
				'routes' => array (
						'chirurgie' => array (
								'type' => 'segment',
								'options' => array (
										'route' => '/chirurgie[/][:action][/:id][/:val]',
										'constraints' => array (
												'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
												'id' => '[a-zA-Z][a-zA-Z0-9_-]*',
												'val' => '[0-9]+'
										),
										'defaults' => array (
												'controller' => 'Chirurgie\Controller\Chirurgie',
												'action' => 'liste-patient'
										)
								)
						)
				)
		),
		'view_manager' => array (
				'template_map' => array (
						'layout/chirurgie' => __DIR__ .'/../view/layout/chirurgie.phtml',
						'layout/menugauche' => __DIR__ .'/../view/layout/menugauche.phtml',
						'layout/piedpage' => __DIR__ .'/../view/layout/piedpage.phtml'
				),
				'template_path_stack' => array (
						'chirurgie' => __DIR__ .'/../view'
				),
				'strategies' => array(
						'ViewJsonStrategy',
				),
		)
);