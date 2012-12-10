<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Horarios";?>
<?php
/* @var $this HorarioController */
/* @var $model Horario */

$this->breadcrumbs = array(
    'Recursos Humanos' => array('admin'),
    'Horarios' => array('admin'),
    $model->HORARIO => array('view', 'id' => $model->HORARIO),
    'Actualizar',
);

$this->menu = array(
    array('label' => Yii::t('app','LIST').' Horario', 'url' => array('index')),
    array('label' => Yii::t('app','CREATE').' Horario', 'url' => array('create')),
    array('label' => Yii::t('app','VIEW').' Horario', 'url' => array('view', 'id' => $model->HORARIO)),
    array('label' => Yii::t('app','MANAGE').' Horario', 'url' => array('admin')),
);
?>

<h1>Actualizar Horario <?php echo $model->HORARIO; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'tablaConceptos'=>$tablaConceptos)); ?>