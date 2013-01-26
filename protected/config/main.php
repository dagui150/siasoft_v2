<?php

// Define a path alias for the Bootstrap extension as it's used internally.
// In this example we assume that you unzipped the extension under protected/extensions.
Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

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
                'application.extensions.PdfGrid.*',
                'bootstrap.widgets.*',
                'ext.helpers.*',
		'application.modules.cruge.components.*',
		'application.modules.cruge.extensions.crugemailer.*',
                'ext.decimali18nbehavior.*',
	),
	'modules'=>array(
		'cruge'=>array(
			'tableprefix'=>'cruge_',	
			'superuserName'=>'superadmin',	
                        'buttonStyle'=>'bootstrap',	
                        
			// para que utilice a protected.modules.cruge.models.auth.CrugeAuthDefault.php
			// en vez de 'default' pon 'authdemo' para que utilice el demo de autenticacion alterna
			// para saber mas lee documentacion de la clase modules/cruge/models/auth/AlternateAuthDemo.php
			'availableAuthMethods'=>array('default'),
			'availableAuthModes'=>array('username'),
			'baseUrl'=>'http://coco.com/',
			// NO OLVIDES PONER EN FALSE TRAS INSTALAR
			'debug'=>true,
			'rbacSetupEnabled'=>true,
			'allowUserAlways'=>true,
			// MIENTRAS INSTALAS..PONLO EN: false
			// lee mas abajo respecto a 'Encriptando las claves'
			'useEncryptedPassword' => false,
			// Algoritmo de la funci�n hash que deseas usar
			// Los valores admitidos est�n en: http://www.php.net/manual/en/function.hash-algos.php
			'hash' => 'md5',
			// a donde enviar al usuario tras iniciar sesion, cerrar sesion o al expirar la sesion.
		    //
			// esto va a forzar a Yii::app()->user->returnUrl cambiando el comportamiento estandar de Yii
			// en los casos en que se usa CAccessControl como controlador
			//
			// ejemplo:
			//		'afterLoginUrl'=>array('/site/welcome'),  ( !!! no olvidar el slash inicial / )
			//		'afterLogoutUrl'=>array('/site/page','view'=>'about'),
			//
			'afterLoginUrl'=>null,
			'afterLogoutUrl'=>null,
			'afterSessionExpiredUrl'=>null,
			// manejo del layout con cruge.
			//
			'loginLayout'=>'//layouts/cruge_login',
			'registrationLayout'=>'//layouts/column2',
			'activateAccountLayout'=>'//layouts/column2',
			'editProfileLayout'=>'//layouts/column2',
			// en la siguiente puedes especificar el valor "ui" o "column2" para que use el layout
			// de fabrica, es basico pero funcional.  si pones otro valor considera que cruge
			// requerir� de un portlet para desplegar un menu con las opciones de administrador.
			//
			'generalUserManagementLayout'=>'//layouts/column2',
			'defaultSessionFilter'=>'application.components.MiSesionCruge',
		),
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>false,
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
			 
		),
		
	),

	// application components
	'components'=>array(		
        'ePdf' => array(
                'class'=> 'ext.yii-pdf.EYiiPdf',
                'params'=> array(
                    'mpdf'     => array(
                        'librarySourcePath' => 'application.vendors.mpdf.*',
                        'constants'         => array(
                            '_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
                        ),
                        'class'=>'mpdf', // the literal class filename to be loaded from the vendors folder
                        /*'defaultParams'     => array( // More info: http://mpdf1.com/manual/index.php?tid=184
                            'mode'              => '', //  This parameter specifies the mode of the new document.
                            'format'            => 'A4', // format A4, A5, ...
                            'default_font_size' => 0, // Sets the default document font size in points (pt)
                            'default_font'      => '', // Sets the default font-family for the new document.
                            'mgl'               => 15, // margin_left. Sets the page margins for the new document.
                            'mgr'               => 15, // margin_right
                            'mgt'               => 16, // margin_top
                            'mgb'               => 16, // margin_bottom
                            'mgh'               => 9, // margin_header
                            'mgf'               => 9, // margin_footer
                            'orientation'       => 'P', // landscape or portrait orientation
                        )*/
                    ),                    
                ),
        ),
		'uimanager' => array(
			'class' => 'application.components.UiManager',
		),
        //  IMPORTANTE:  asegurate de que la entrada 'user' (y format) que por defecto trae Yii
			//               sea sustituida por estas a continuaci�n:
			//
		'user'=>array(
			'allowAutoLogin'=>true,
			'class' => 'application.modules.cruge.components.CrugeWebUser',
			'loginUrl' => array('/site/index'),
		),
		'authManager' => array(
			'class' => 'application.modules.cruge.components.CrugeAuthManager',
		),
		'crugemailer'=>array(
			'class' => 'application.modules.cruge.components.CrugeMailer',
			'mailfrom' => 'promociones@tramasoft.com',
			'subjectprefix' => 'Tu Encabezado del asunto - ',
			'debug' => true,
		),
		'format' => array(
			'datetimeFormat'=>"d M, Y h:m:s a",
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
					'levels'=>'error, warning, info, rbac',
					//'ipFilters'=>array('127.0.0.1','192.168.0.11'),
				),
                                 
			),
		),
		'bootstrap'=>array(
			'class'=>'bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
		),
            
            
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);