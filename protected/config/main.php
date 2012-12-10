<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Siasoft V2',
	'charset' => 'utf-8',
	'language' => 'es',
	'theme' => 'siasoft',

	// preloading 'log' component
	'preload'=>array(
		'log',
		'bootstrap',
	),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.controllers.*',
		'application.components.*',
		'application.extensions.helpers.*',
		'application.modules.srbac.controllers.SBaseController',
        'ext.helpers.*',
	),
	'modules'=>array(
		'srbac'=>array(
			// Your application's user class (default: User)
			"userclass"=>"Usuarios",
			// Your users' table user_id column (default: userid)
			"userid"=>"ID",
			// your users' table username column (default: username)
			"username"=>"USERNAME",
			// Debug mode(default: false)
			// In debug mode every user (even guest) can admin srbac, also
			//if you use internationalization untranslated words/phrases
			//will be marked with a red star
			"debug"=>false,
			// The number of items shown in each page (default:15)
			"pageSize"=>10,
			// The name of the super user
			"superUser" =>"SuperAdministrador",
			//The css file to use
			"css"=>"srbac.css", // must be in srbac css folder
			//The layout to use
			"layout"=>"webroot.themes.siasoft.views.layouts.main",
			//The not authorized page to render when a user tries to access an page
			//tha he's not authorized to
			"notAuthorizedView"=>"srbac.views.authitem.unauthorized",
			// The actions that are always allowed to every user (when using the
			// auto create mode of srbac)
			"alwaysAllowed"=>array(),
			// The operationa assigned to users (when using the
			// auto create mode of srbac)
			"userActions"=>array(
			"Show","View","List","Admin"
			),
			//The number of lines in assign listboxes (default 10)
			"listBoxNumberOfLines" => 15,
			'imagesPath' => 'srbac.images', // default: srbac.images 'imagesPack'=>'noia', //default: noia 'iconText'=>true, // default : false 'header'=>'srbac.views.authitem.header', //default : srbac.views.authitem.header,
			//must be an existing alias 'footer'=>'srbac.views.authitem.footer', //default: srbac.views.authitem.footer,
			//must be an existing alias 'showHeader'=>true, // default: false 'showFooter'=>true, // default: false
			'alwaysAllowedPath'=>'srbac.components', // default: srbac.components
			// must be an existing alias 
			"imagesPack"=>"noia",
			// Whether to show text next to the menu icons (default false)
			"iconText"=>true,
		),
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>false,
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			 
			'generatorPaths'=>array(
				'bootstrap.gii', // since 0.9.1
			),
		),
		
	),

	// application components
	'components'=>array(
		'authManager'=>array(
			// The type of Manager (Database)
			'class'=>'CDbAuthManager',
			// The database connection used
			'connectionID'=>'db',
			// The itemTable name (default:authitem)
			'itemTable'=>'auth_items',
			// The assignmentTable name (default:authassignment)
			'assignmentTable'=>'auth_asignacion',
			// The itemChildTable name (default:authitemchild)
			'itemChildTable'=>'auth_relaciones',
		),
        'user'=>array(
            // enable cookie-based authentication
            'allowAutoLogin'=>true,
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
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=siasoft',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'enableProfiling'=>true,
			'enableParamLogging'=>true,
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
					//'ipFilters'=>array('127.0.0.1','192.168.0.11'),
				),
			),
		),
		/*'log'=>array(
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
            /*
			),
		),*/
		
		'bootstrap'=>array(
			'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
		),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);