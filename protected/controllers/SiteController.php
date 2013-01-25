<?php

class SiteController extends Controller
{
	public $layout='//layouts/column2';
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
        public function filters()
        {
          return array('accessControl',);
        }
        public function accessRules(){
            return array(
                array('allow',
                 'actions'=>array('index','prueba','login','error'),
                 'users'=>array('*'),)
            );
        }
        public function actionPrueba(){
            $factura = new Factura;
            $linea = new FacturaLinea;
            
            JLinesForm::validate($linea,'lineas-form');
            
            $this->render('prueba',array('linea'=>$linea,'factura'=>$factura));
        }
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		
		if (Yii::app()->user->isGuest){
			$model=new LoginForm;
                        $this->layout='cruge_login';
			// if it is ajax validation request
			if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
			{
				echo CActiveForm::validate($model);
				Yii::app()->end();
			}

			// collect user input data
			if(isset($_POST['LoginForm']))
			{
				$model->attributes=$_POST['LoginForm'];
				// validate user input and redirect to the previous page if valid
				if($model->validate() && $model->login())
					$this->redirect(Yii::app()->user->returnUrl);
			}
                        // display the login form
			$this->render('login',array('model'=>$model ));
			
		}
		else{
			$this->layout='column1';
			$this->render('index');
		}
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
        {
            if($error=Yii::app()->errorHandler->error)
            {
                if(Yii::app()->request->isAjaxRequest)
                        echo $error['message'];
                else
                        $this->render('error', $error);
            }
        }
	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
            
                Yii::app()->user->setFlash('info', CHtml::image(Yii::app()->baseUrl."/images/warning.png",'Informacion',array('style'=>'float: left')).'&nbspSu sesión ha expirado, &nbsppor favor ingresar <br> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp nuevamente');
		$model=new LoginForm;
                $this->layout='cruge_login';
		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form'){
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm'])){
			$model->attributes=$_POST['LoginForm'];
				// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
                // display the login form
		$this->render('login',array('model'=>$model ));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
	}
}