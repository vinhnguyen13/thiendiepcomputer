<?php

define('DS', '/');
$pathroot = dirname(dirname(__FILE__));
$backend = $pathroot . DIRECTORY_SEPARATOR . 'source/apps/backend/protected';
$frontend = $pathroot . DIRECTORY_SEPARATOR . 'source/apps/frontend/protected';

Yii::setPathOfAlias('pathroot', $pathroot);
Yii::setPathOfAlias('backend', $backend);
Yii::setPathOfAlias('frontend', $frontend);

return array(
	'basePath'=> $backend,
	'name'=>'Admin',
	'theme' => 'cms',
	'runtimePath' => $backend . DIRECTORY_SEPARATOR . 'runtime',
	'preload'=>array('log'),
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.extensions.*',
		'application.modules.cms.models.*',
		'application.modules.user.models.*',
	),
	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'user' => array(
			'debug' => false,
			'usersTable' => 'user',
			'translationTable' => 'translation',
		 	'baseLayout' => '//layouts/main',
			'layout' => '//layouts/yum',
			'loginLayout' => '//layouts/login',
			'adminLayout' => '//layouts/yum',
		),
		'cms',
		'srbac' => array(
			'debug' => true,
			'userclass' => 'YumUser',
			'userid' => 'id',
			'superUser'=>'Administrator',
			'layout' => '//layouts/column1',
			'notAuthorizedView' => 'srbac.views.authitem.unauthorized',
		),
	),
	'components'=> CMap::mergeArray(
		array(
			'user'=>array(
				'class' => 'application.modules.user.components.YumWebUser',
		      	'allowAutoLogin'=>true,
		      	'loginUrl' => array('//user/user/login'),
			),
			// uncomment the following to enable URLs in path-format
			'urlManager'=>array(
				'urlFormat'=>'path',
				'showScriptName' => false,
				'rules'=>array(
					'<controller:\w+>/<id:\d+>'=>'<controller>/view',
					'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
					'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				),
			),
			'image'=>array(     
				'class'=>'application.extensions.image.CImageComponent',            
				'driver'=>'GD', 
			), 
			'db'=>array(
				'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
			),
			// uncomment the following to use a MySQL database
			'errorHandler'=>array(
				// use 'site/error' action to display errors
				'errorAction'=>'site/error',
			),
			'authManager'=>array(
				'class'=>'application.modules.srbac.components.SDbAuthManager',
				'connectionID'=>'db',
				'itemTable' => 'auth_item',
				'itemChildTable' => 'auth_item_child',
				'assignmentTable' => 'auth_assignment',
			),
			'themeManager' => array(
				'basePath'=> dirname(__FILE__).'/../themes/',
	        	'baseUrl'=>'/themes/'
			),
			'log'=>array(
				'class'=>'CLogRouter',
				'routes'=>array(
					array(
						'class'=>'CFileLogRoute',
						'levels'=>'error, warning',
					),
					// uncomment the following to show log messages on web pages
					/*
					array(
						'class'=>'CWebLogRoute',
					),
					*/
				),
			),
			'counter' => array(
	            'class' => 'backend.extensions.UserCounter',
	        ),
		),
		require(dirname(__FILE__).'/_partials/config.php')
	),
	'behaviors' => array(
	
   	),
	'params'=> CMap::mergeArray(
		array(
			'adminEmail'=>'webmaster@example.com',
			'notRequireLogin' => array(
				'user/user/login', 
				'user/auth', 
				'user/auth/login', 
				'api/activeServers',
				'api/rankingList'
			),
		),
		
		
		require(dirname(__FILE__).'/_partials/params.php')
	)
);