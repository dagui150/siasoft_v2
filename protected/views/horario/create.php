<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Horarios";?>
<?php
/* @var $this HorarioController */
/* @var $model Horario */

$this->breadcrumbs = array(
    'Recursos Humanos' => array('admin'),
    'Horarios' => array('admin'),
    'Nuevo',
);

$this->menu = array(
    array('label' => Yii::t('app','LIST').' Horario', 'url' => array('index')),
    array('label' => Yii::t('app','MANAGE').' Horario', 'url' => array('admin')),
);
?>

<h1>Crear Horario</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>