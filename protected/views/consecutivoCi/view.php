<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','VIEW')." Consecutivos";?>
<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Consecutivos'=>array('admin'),
	$model->DESCRIPCION,
);
?>

<h1>Ver Consecutivo "<?php echo $model->DESCRIPCION; ?>"</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<BR>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'ID',
		array(
                    'name' => 'FORMATO_IMPRESION',
                    'value' => isset($model->fORMATOIMPRESION->NOMBRE) ? $model->fORMATOIMPRESION->NOMBRE : "",
                ),
		'DESCRIPCION',
		'MASCARA',
		'SIGUIENTE_VALOR',
                array(
                    'name'=>'TODOS_USUARIOS',
                    'value'=>$model->TODOS_USUARIOS == 'S' ? 'Si' : 'No'
                ),
	),
)); ?>
