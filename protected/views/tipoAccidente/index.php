<?php
/* @var $this TipoAccidenteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Recursos Humanos' => array('admin'),
	'Tipos de Accidentes' 
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' TipoAccidente', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' TipoAccidente', 'url'=>array('admin')),
);
?>

<h1>Tipos de Accidentes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
