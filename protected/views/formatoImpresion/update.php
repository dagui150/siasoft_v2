<?php $this->pageTitle=Yii::app()->name.' - '.Yii::t('app','UPDATE').' FormatoImpresion';?>
<?php
/* @var $this FormatoImpresionController */
/* @var $model2 FormatoImpresion */




$this->breadcrumbs=array(
    'Sistema'=>array('admin'),
	'Administración de Reportes'=>array('admin'),
	$model2->ID=>array('view','id'=>$model2->ID),
	'Actualizar',
);

$this->menu=array(
	array('label'=>Yii::t('app','LIST'). 'FormatoImpresion', 'url'=>array('index')),
	array('label'=>Yii::t('app','CREATE'). 'FormatoImpresion', 'url'=>array('create')),
	array('label'=>Yii::t('app','VIEW'). 'FormatoImpresion', 'url'=>array('view', 'id'=>$model2->ID)),
	array('label'=>Yii::t('app','MANAGE'). 'FormatoImpresion', 'url'=>array('admin')),


	array('label'=>'List FormatoImpresion', 'url'=>array('index')),
	array('label'=>'Create FormatoImpresion', 'url'=>array('create')),
	array('label'=>'View FormatoImpresion', 'url'=>array('view', 'id'=>$model2->ID)),
	array('label'=>'Manage FormatoImpresion', 'url'=>array('admin')),
);
?>

<h1>Actualizar Formato de Impresión <?php echo $model2->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>