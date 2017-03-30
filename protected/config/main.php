<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
yii::setPathOfAlias('booster', dirname(__FILE__).'/../extensions/booster');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'HR STAFF',

	// preloading 'log' component
	'preload'=>array('log', 'booster'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.ECompositeUniqueValidator.extensions.ECompositeUniqueValidator', // 'ext.*', // <---- this works too
		
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',			
			'password'=>'admin',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1', '192.168.100.26'),
			'generatorPaths' => array(
            	'bootstrap.gii'        	
			),
		),		
	),

	// application components
	'components'=>array(
		'booster'=>array(			
			'class'=>'booster.components.Booster',
			'responsiveCss' => TRUE,
            'fontAwesomeCss' => TRUE,
		),
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
			'class'=>'application.components.EWebUser',//Load web USER

		),

		/**Component Validasi Unique
		*/
		'ECompositeUniqueValidator'=>array(
        	'class' => 'ext.ECompositeUniqueValidator.components.ECompositeUniqueValidator',
        ),
        'hakamFormat'=>array(
        	'class'=>'ext.Formatter',
        ),
		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/
		'dbSqllite'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=hr_staff',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'Lintech32#',
			'charset' => 'utf8',
		),

		'dbAccess'=>array(
			'class'=>'CDbConnection',
			//'connectionString' => 'odbc:DRIVER={Microsoft Access Driver (*.mdb)};Dbq=d:\\db.mdb;',
			'connectionString'=>'odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=//192.168.100.26/att_lsf/att2000.mdb; Uid=; Pwd=;',
			//'username'=>'',
			//'password'=>'',
			//$dbName = "//192.168.100.26/att_lsf/att2000.mdb";
			//string_conn = "odbc:DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=//192.168.100.26/att_lsf/att2000.mdb; Uid=; Pwd=;";
        ),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
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
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
