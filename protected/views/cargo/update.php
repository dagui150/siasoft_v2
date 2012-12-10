<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Cargo";?>
<?php
/* @var $this CargoController */
/* @var $model Cargo */

$this->breadcrumbs = array(
    'Recursos Humanos' => array('admin'),
    'Cargo' => array('admin'),
    $model->CARGO => array('view', 'id' => $model->CARGO),
    'Actualizar',
);
?>

<h1>Actualizar Cargo <?php echo $model->CARGO; ?></h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>