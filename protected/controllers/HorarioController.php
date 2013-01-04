<?php

class HorarioController extends Controller
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
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id) {


        $tablaConceptos = HorarioConcepto::model()->findAllByAttributes(array('HORARIO' => $id,));


        $this->render('view', array(
            'model' => $this->loadModel($id),
            'tablaConceptos' => $tablaConceptos,
        ));
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
        $model = new Horario;
        $transaction = $model->dbConnection->beginTransaction();
        // Uncomment the following line if AJAX validation is needed
        $this->performAjaxValidation($model);

        if (isset($_POST['Horario'])) {
            try {
                $model->attributes = $_POST['Horario'];
                if($model->save()){
                    //NUEVOS REGISTROS TABLA DE CONCEPTOS
                    if (isset($_POST['ConceptoNuevo'])) {
                            foreach ($_POST['ConceptoNuevo'] as $datos) {
                                $horarioConcepto = new HorarioConcepto;
                                $horarioConcepto->HORARIO = $model->HORARIO;
                                $horarioConcepto->DIA = $datos['DIA'];
                                $horarioConcepto->HORA_INICIO = $datos['INICIO'];
                                $horarioConcepto->HORA_FIN = $datos['FIN'];
                                $horarioConcepto->ACTIVO = 'S';

                                $horarioConcepto->save();
                            }
                    }
                }
                $transaction->commit();
                $this->redirect(array('admin'));
            } catch (Exception $e) {
                echo $e;
                $transaction->rollback();
                Yii::app()->end();
            }
        }

        $this->render('create', array(
            'model' => $model
        ));
    }

    /**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
    
    public function actionUpdate()
	{   
                if(isset($_GET['id'])){
                    $model=$this->loadModel($_GET['id']);
                    $this->performAjaxValidation($model);
                    $tablaConceptos = HorarioConcepto::model()->findAllByAttributes(array('HORARIO'=>$model->HORARIO));
                    
                }

		if(isset($_POST['Horario']))
		{
                      
			$model->attributes=$_POST['Horario'];
                        
                        
                        $transaction = $model->dbConnection->beginTransaction();
                        try{
                            $model->save();
                            
                            
                            //NUEVOS REGISTROS TABLA DE COMISIONES COLECTIVAS
                               if (isset($_POST['ConceptoNuevo'])) {
                            foreach ($_POST['ConceptoNuevo'] as $datos) {
                                $horarioConcepto = new HorarioConcepto;
                                $horarioConcepto->HORARIO = $model->HORARIO;
                                $horarioConcepto->DIA = $datos['DIA'];
                                $horarioConcepto->HORA_INICIO = $datos['INICIO'];
                                $horarioConcepto->HORA_FIN = $datos['FIN'];
                                $horarioConcepto->ACTIVO = 'S';

                                $horarioConcepto->save();
                            }
                            }
                            
                            
                                       //ACTUALIZAR REGISTROS TABLA DE COMISIONES COLECTIVAS
                            if (isset($_POST['HorarioConcepto'])) {
                                foreach ($_POST['HorarioConcepto'] as $datos) {
                                    $horarioConcepto = HorarioConcepto::model()->findByPk($datos['ID']);
                                    $horarioConcepto->DIA = $datos['DIA'];
                                    $horarioConcepto->HORA_INICIO = $datos['HORA_INICIO'];
                                    $horarioConcepto->HORA_FIN = $datos['HORA_FIN'];

                                    $horarioConcepto->save();
                                }
                            }
                            
                           
                            
                             //ELIMINAR REGISTROS DE COMISION
                              if(isset($_POST['eliminarConcepto'])){
                                $arEliminar = explode(',',$_POST['eliminarConcepto']);
                                foreach($arEliminar as $elimina){
                                    $borrar = HorarioConcepto::model()->deleteByPk($elimina);
                                }
                                
                              }
                              
                              
                              
                            $transaction->commit();
                            $this->redirect(array('admin'));
                            
                        }catch(Exception $e){
                            echo $e;
                            $transaction->rollback();
                            Yii::app()->end();
                        }
				
		}elseif(isset($model)){
                    $this->render('update',array(
			'model'=>$model,
			'tablaConceptos'=>$tablaConceptos,
			
			
                    ));
                }
	}

    
    
    
    
    
    
    
    
    
    
    
    


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
            /*
		$this->loadModel($id)->updateByPk($id,array('ACTIVO'=>'N'));

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	
                */
                
                if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			Horario::model()->updateByPk($id,array('ACTIVO'=>'N'));

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Solicitud Invalida. Por favor, no repita esta solicitud de nuevo.');
                
                
        }

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Horario');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Horario('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Horario']))
			$model->attributes=$_GET['Horario'];

		$this->render('admin',array(
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
		$model=Horario::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='horario-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
