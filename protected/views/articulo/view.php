<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Artículos";?>
<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Artículos'=>array('admin'),
	$model->ARTICULO,
);

?>

<h1>Ver Artículo #<?php echo $model->ARTICULO; ?></h1>
<br>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ARTICULO',
		'NOMBRE',
                /*array(
                    'name'=>'CLASIFICACION_1',
                    'value'=>$model->cLASIFICACION1->NOMBRE ? $model->cLASIFICACION1->NOMBRE : '',
                ),
                array(
                    'name'=>'CLASIFICACION_2',
                    'value'=>$model->cLASIFICACION2->NOMBRE ? $model->cLASIFICACION2->NOMBRE : '',
                ),
                array(
                    'name'=>'CLASIFICACION_3',
                    'value'=>$model->cLASIFICACION3->NOMBRE ? $model->cLASIFICACION3->NOMBRE : '',
                ),
                array(
                    'name'=>'CLASIFICACION_4',
                    'value'=>$model->cLASIFICACION4->NOMBRE ? $model->cLASIFICACION4->NOMBRE : '',
                ),
                array(
                    'name'=>'CLASIFICACION_5',
                    'value'=>$model->cLASIFICACION5->NOMBRE ? $model->cLASIFICACION5->NOMBRE : '',
                ),
                array(
                    'name'=>'CLASIFICACION_6',
                    'value'=>$model->cLASIFICACION6->NOMBRE ? $model->cLASIFICACION6->NOMBRE : '',
                ),
		'FACTOR_CONVER_1',
		'FACTOR_CONVER_2',
		'FACTOR_CONVER_3',
		'FACTOR_CONVER_4',
		'FACTOR_CONVER_5',
		'FACTOR_CONVER_6',*/
                array(
                    'name'=>'ORIGEN_CORP',
                    'value'=>$model->ORIGEN_CORP == 'T' ? 'Tercero' : 'Corporativo'
                ),
                //'CLASE_ABC',
                array(
                    'name'=>'TIPO_ARTICULO',
                    'value'=>  TipoArticulo::darNombre($model->TIPO_ARTICULO)
                ),
		/*'TIPO_COD_BARRAS',
		'CODIGO_BARRAS',*/
		'EXISTENCIA_MINIMA',
		'EXISTENCIA_MAXIMA',
		'PUNTO_REORDEN',
		'COSTO_FISCAL',
		'DESCRIPCION_COMPRA',
                /*array(
                    'name'=>'IMPUESTO_COMPRA',
                    'value'=>$model->iMPUESTOCOMPRA->NOMBRE,
                ),
                array(
                    'name'=>'BODEGA',
                    'value'=>$model->bODEGA->DESCRIPCION,
                ),
		//'IMP1_AFECTA_COSTO',
                array(
                    'name'=>'RETENCION_COMPRA',
                    'value'=>$model->rETENCIONCOMPRA->NOMBRE,
                ),*/
                'FRECUENCIA_CONTEO',
                array(
                    'name'=>'PESO_NETO',
                    'value'=>$model->PESO_NETO.' - '.$model->pESONETOUNIDAD->NOMBRE,
                ),  
                array(
                    'name'=>'PESO_BRUTO',
                    'value'=>$model->PESO_BRUTO.' - '.$model->pESOBRUTOUNIDAD->NOMBRE,
                ), 
                array(
                    'name'=>'VOLUMEN',
                    'value'=>$model->VOLUMEN.' - '.$model->vOLUMENUNIDAD->NOMBRE,
                ), 
                array(
                    'name'=>'UNIDAD_ALMACEN',
                    'value'=>$model->uNIDADALMACEN->NOMBRE,
                ), 
                array(
                    'name'=>'UNIDAD_EMPAQUE',
                    'value'=>$model->uNIDADEMPAQUE->NOMBRE,
                ), 
                array(
                    'name'=>'UNIDAD_VENTA',
                    'value'=>$model->uNIDADVENTA->NOMBRE,
                ),
                'FACTOR_EMPAQUE',
                'FACTOR_VENTA',
                array(
                    'name'=>'IMPUESTO_VENTA',
                    'value'=>$model->iMPUESTOVENTA->NOMBRE,
                ),
                /*array(
                    'name'=>'RETENCION_VENTA',
                    'value'=>$model->rETENCIONVENTA->NOMBRE,
                ),*/
                'NOTAS',
	),
)); ?>
