<?php
/* @var $this TipoAusenciaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
    'Recursos Humanos' => array('admin'),
	'Tipos de Ausencias',
);

$this->menu=array(
	array('label'=>Yii::t('app','CREATE').' TipoAusencia', 'url'=>array('create')),
	array('label'=>Yii::t('app','MANAGE').' TipoAusencia', 'url'=>array('admin')),
);
?>

<h1>Tipo Ausencias</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
