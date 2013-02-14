<?php

class ReportesController extends Controller
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
	public function actionVentas()
	{   
                $ventas=new CActiveDataProvider(Factura::model(), array(
			'criteria'=>array(
                                'condition'=>' FACTURA=-1',
                         ),
                         'pagination'=>false,
		));
                
                if(isset($_GET['Reportes']['fecha_desde'])){
                    //echo 'entra';
                    $ventas->keyAttribute = 'FACTURA';
                    $ventas->criteria = array(
                                'select' => 't.FACTURA, t.CONSECUTIVO, t.CLIENTE, t.FECHA_FACTURA, t.TOTAL_A_FACTURAR, t.BODEGA, t.NIVEL_PRECIO',
                                'condition'=>'t.FECHA_FACTURA BETWEEN "'.$_GET['Reportes']['fecha_desde'].'" AND "'.$_GET['Reportes']['fecha_hasta'].'"',
                             );
                    
                    if(isset($_GET['Reportes']['bodegas']))
                        $ventas->criteria->compare('t.BODEGA',$_GET['Reportes']['bodegas']);
                    
                    if(isset($_GET['Reportes']['clientes']))
                        $ventas->criteria->compare('t.CLIENTE',$_GET['Reportes']['clientes']);
                    
                    /*
                     * 
                    
                    $pago->sort =array(
                            'attributes'=>
                                array(
                                    'FECHA',
                                    'CLIENTE_POLIZA',
                                    'VALOR_CRV',
                                    'VALOR',
                                    'POLIZA'=>array(
                                        'asc'=>'p.POLIZA',
                                        'desc'=>'p.POLIZA DESC',
                                        'label'=>'Poliza',
                                        'default'=>'asc',
                                    ),
                                    'TIPO_POLIZA'=>array(
                                        'asc'=>'p.TIPO_POLIZA',
                                        'desc'=>'p.TIPO_POLIZA DESC',
                                        'label'=>'Tipo de Poliza',
                                        'default'=>'asc',
                                    ),
                                    'NOMBRE'=>array(
                                        'asc'=>'ter.NOMBRE',
                                        'desc'=>'ter.NOMBRE DESC',
                                        'label'=>'Cliente',
                                        'default'=>'asc',
                                    ),
                                    'NOMBRES'=>array(
                                        'asc'=>'f.NOMBRES',
                                        'desc'=>'f.NOMBRES DESC',
                                        'label'=>'Asesor',
                                        'default'=>'asc',
                                    ),
                                ),
                        );*/
                }
                $model=new Reportes;                
		$this->render('ventas',array(
			'model'=>$model,
                        'ventas'=> $ventas
		));
	}

        /**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=ConfAs::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='reportes-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
