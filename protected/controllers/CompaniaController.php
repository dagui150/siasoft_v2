<?php

class CompaniaController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2'; 
	/**
	 * @return array action filters
	 */
	public function filters(){
      return array(
				array('CrugeAccessControlFilter'),
			);
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Compania;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Compania']))
		{
			$model->attributes=$_POST['Compania'];
			$model->LOGO=CUploadedFile::getInstance($model,'LOGO');
			if($model->save()){
				$model->LOGO->saveAs(Yii::getPathOfAlias('webroot')."/logo/".$model->LOGO);
				$this->redirect(array('index'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$logo=$model->LOGO;

		// Uncomment the following line if AJAX validation is needed
		$this->performAjaxValidation($model);

		if(isset($_POST['Compania']))
		{
			$model->attributes=$_POST['Compania'];
                        $model->LOGO=CUploadedFile::getInstance($model,'LOGO');
			if($_POST['eliminar'] == '1'){
                            unlink(Yii::getPathOfAlias('webroot').'/logo/'.$logo);
                            $model->LOGO = '';
                            $model->save();
                        }
                        else{
                            if($model->LOGO == ''){
                                $model->LOGO = $logo;
                                $model->save();
                            }
                            else{
                                if($model->save() || $_FILES['Compania']['LOGO'] != ''){
                                        $model->LOGO->saveAs(Yii::getPathOfAlias('webroot').'/logo/'.$model->LOGO);
                                        $this->redirect(array('index'));
                                        
                                }
                            }
                        }
                        
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}


	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Compania::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='compania-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionCargar() {
		$data=UbicacionGeografica2::model()->findAll('UBICACION_GEOGRAFICA1='.$_POST['Compania']['UBICACION_GEOGRAFICA1'].' order by NOMBRE');
               
               $data=CHtml::listData($data,'ID','NOMBRE');
               echo "<option value=''>Seleccione...</option>";
               foreach($data as $value=>$name)
               {
                       echo CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);
               }
	}
}
