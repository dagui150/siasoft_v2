<?php
/* @var $this TipoContratoController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Recursos Humanos' => array('admin'),
	'Tipos de Contratos',
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' TipoContrato', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' TipoContrato', 'url'=>array('admin')),
);
?>

<h1>Tipo Contratos</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
