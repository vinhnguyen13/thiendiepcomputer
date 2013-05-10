<?php
define('DS', DIRECTORY_SEPARATOR);
$pathroot = dirname(dirname(__FILE__));
$frontend = $pathroot . DS . 'source/apps/frontend/protected';
$backend = $pathroot . DS . 'source/apps/backend/protected';
$themes = $pathroot . DS . 'themes';

Yii::setPathOfAlias('pathroot', $pathroot);
Yii::setPathOfAlias('frontend', $frontend);
Yii::setPathOfAlias('backend', $backend);
Yii::setPathOfAlias('themes', $themes);

return array(
	'basePath'=> $frontend,
	'name'=>'THIÊN ĐIỆP COMPUTER',
	'theme' => 'thiendiep',
	'runtimePath' => $frontend . DS . 'runtime',
	'modulePath' => $backend.'/modules',
	'preload'=>array('log'),
	'language' => 'vi',
	'import'=>array(
		'backend.vendors.*',
		'backend.components.*',
		'backend.extensions.ymds.*',
		'backend.extensions.ymds.extra.*',
		'backend.modules.user.models.*',
		'backend.modules.cms.models.*',
		'application.models.*',
		'application.components.*',
		'backend.extensions.CDropDownMenu.*',
	),
	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123456',
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),
	'components'=> CMap::mergeArray(
		array(
			'user'=>array(
				'allowAutoLogin'=>true,
				'class' => 'backend.modules.user.components.YumWebUser',
			),
			'urlManager'=>array(
				'showScriptName' => false,
				'urlFormat'=>'path',
				'rules'=>  CMap::mergeArray(
					array(),
					require(dirname(__FILE__).'/_partials/urls.php')
				),
			),
			'errorHandler'=>array(
				'errorAction'=>'site/error',
			),
			'log'=>array(
				'class'=>'CLogRouter',
				'routes'=>array(
					array(
						'class'=>'CFileLogRoute',
						'levels'=>'error, warning',
					),
				),
			),
			'assetManager'=>array(
	        	'basePath'=> dirname(__FILE__).'/../source/apps/frontend/assets/',
	            'baseUrl'=>'/source/apps/frontend/assets/'
	        ),
	        'themeManager' => array(
				'basePath'=> dirname(__FILE__).'/../themes/',
	        	'baseUrl'=>'/themes/'
			),
			'cache' => array('class' => 'system.caching.CFileCache'),
			'session' => array (
			    'class' => 'system.web.CDbHttpSession',
			    'connectionID' => 'db',
			    'sessionTableName' => 'sessions',
				'sessionName' => 'Site Session',
				'useTransparentSessionID'   =>(!empty($_POST['PHPSESSID'])) ? true : false,
				'autoStart' => 'false',
				'cookieMode' => 'only',
				'timeout' => 900
			),
			'CURL' =>array(
				'class' => 'backend.extensions.curl.Curl',
			),
			'swiftMailer' => array(
			    'class' => 'backend.extensions.swiftMailer.SwiftMailer',
			),
		),
		require(dirname(__FILE__).'/_partials/config.php')
	),
	'behaviors' => array(
		'onBeginRequest' => array(
	 		'class'=>'application.components.BeginRequestBehavior'
		)
   	),
	'params'=> CMap::mergeArray(
		require(dirname(__FILE__).'/_partials/params.php'),
		array(
			'adminEmail'=>'contact@thiendiep.com',
		)
	)
);