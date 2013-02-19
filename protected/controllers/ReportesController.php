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

          public function actionformatoPDF() {
            
            /*$total = 0;
            foreach($_GET['data'] as $datos){
                $total = $total + $datos['TOTAL_A_FACTURAR'];
            }*/
            $tipo = $_GET['tipo'];
            $model = new CArrayDataProvider(Yii::app()->getSession()->get('nombreVariable'));
            $model->pagination = false;
            $this->layout = 'Reportes';
            $footer = '<table width="100%">
                    <tr><td align="center" valign="middle"><span class="piePagina"><b>Generado por:</b> ' . Yii::app()->user->name . '</span></td>
                        <td align="center" valign="middle"><span class="piePagina"><b>Generado el:</b> ' . date('Y/m/d') . '</span></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" valign="middle">Desarrollado por Tramasoft Soluciones TIC - <a href="http://www.tramasoft.com">www.tramasoft.com</a></td>
                    </tr>
                    </table>';
            
            $compania = Compania::model()->find();
            if ($compania->LOGO != '') {
                $logo = CHtml::image(Yii::app()->request->baseUrl . "/logo/" . $compania->LOGO, 'Logo');
            } else {
                $logo = CHtml::image(Yii::app()->request->baseUrl . "/logo/default.jpg", 'Logo');
            }
            $header = '<table width="100%" align="center">
                            <tr>
                                <td width="26%" rowspan="4" align="left" valign="middle">'.$logo.'
                                </td>
                                <td width="41%" align="center">'.$compania->NOMBRE_ABREV.'</td>
                                <td width="33%" rowspan="2" align="right" valign="middle">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="center"><b>Nit:</b> '.$compania->NIT.'</td>
                            </tr>
                            <tr>
                                <td align="center">Direccion  '.$compania->DIRECCION.'</td>
                                <td align="right" valign="middle"><strong>Total en este reporte: </strong></td>
                            </tr>
                            <tr>
                                <td align="center"><b>Tels:</b> '.$compania->TELEFONO1.'-'.$compania->TELEFONO2.'</td>
                                <td width="33%" align="center" valign="middle">$ '/*.$total*/.'</td>
                            </tr>
                        </table>';
            //'',array(377,279),0,'',15,15,16,16,9,9, 'P'
            $mPDF1 = Yii::app()->ePdf->mpdf('','A4',0,'','15','15','30','','5','', 'P');
            //$mPDF1->w=210;   //manually set width
            //$mPDF1->h=148.5; //manually set height
            $mPDF1->SetHTMLHeader($header);
            $mPDF1->SetHTMLFooter($footer);
            $mPDF1->WriteHTML($this->render('pdf', array('model' => $model, 'tipo'=>$tipo), true));
            $mPDF1->SetHTMLFooter($footer);

            $mPDF1->Output();
            Yii::app()->end();
        }
          
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'ventas' page.
	 */
	public function actionVentas()
	{
                $provider=new CActiveDataProvider(Factura::model(), array(
			'criteria'=>array(
                                'condition'=>' FACTURA=-1',
                         ),
                         
		));
                
                
                if(isset($_GET['Reportes']['FECHA_DESDE'])){
                    $provider->keyAttribute = 'FACTURA';
                    $provider->criteria = array(
                                'select' => 't.FACTURA, t.CONSECUTIVO, t.CLIENTE, t.FECHA_FACTURA, t.TOTAL_A_FACTURAR, t.BODEGA, t.NIVEL_PRECIO',
                                'condition'=>'t.FECHA_FACTURA BETWEEN "'.$_GET['Reportes']['FECHA_DESDE'].'" AND "'.$_GET['Reportes']['FECHA_HASTA'].'"',
                );
                    
                if(isset($_GET['Reportes']['BODEGAS']))
                    $provider->criteria->compare('t.BODEGA',$_GET['Reportes']['BODEGAS']);
                    
                if(isset($_GET['Reportes']['CLIENTES']))
                    $provider->criteria->compare('t.CLIENTE',$_GET['Reportes']['CLIENTES']);
                }
                $model=new Reportes;                
		$this->render('ventas',array(
			'model'=>$model,
                        'provider'=> $provider
		));
	}
        
        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'ventas' page.
	 */
	public function actionInventario()
	{
                $provider=new CActiveDataProvider(Articulo::model(), array(
			'criteria'=>array(
                                'condition'=>'ARTICULO=-1',
                         ),
                    'pagination'=>false
		));
                
                $provider->keyAttribute = 'ARTICULO';
                $provider->criteria = array(
                                'select' => 't.ARTICULO, t.NOMBRE, t.EXISTENCIA_MINIMA, t.EXISTENCIA_MAXIMA, eb.BODEGA, t.UNIDAD_ALMACEN, eb.CANT_DISPONIBLE',
                                'join' => 'LEFT JOIN existencia_bodega eb ON t.ARTICULO = eb.ARTICULO',
                );
                
                
                if(isset($_GET['Reportes']['BODEGAS']))
                    $provider->criteria->compare('eb.BODEGA',$_GET['Reportes']['BODEGAS']);
                    
                if(isset($_GET['Reportes']['TIPO_ARTICULOS']))
                    $provider->criteria->compare('t.TIPO_ARTICULO',$_GET['Reportes']['TIPO_ARTICULOS']);
                
                if(isset($_GET['Reportes']['ARTICULOS_ACTIVO']))
                    $provider->criteria->compare('t.ACTIVO',$_GET['Reportes']['ARTICULOS_ACTIVO']);
                
                $provider->sort =array(
                            'attributes'=>
                                array(
                                    'ARTICULO',
                                    'NOMBRE',
                                    'EXISTENCIA_MINIMA',
                                    'EXISTENCIA_MAXIMA',
                                    'BODEGA',
                                    'UNIDAD_ALMACEN',
                                    'CANT_DISPONIBLE'=>array(
                                        'asc'=>'eb.CANT_DISPONIBLE',
                                        'desc'=>'eb.CANT_DISPONIBLE DESC',
                                        'label'=>'Cant. Disp.',
                                        'default'=>'asc',
                                    ),
                                ),
                        );
                
                $model=new Reportes;
		$this->render('inventario',array(
			'model'=>$model,
                        'provider'=>$provider,
		));
	}
        
        /**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'ordenCompra' page.
	 */
	public function actionOrdenCompra()
	{
                $model=new Reportes;
		$this->render('ordenCompra',array(
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
