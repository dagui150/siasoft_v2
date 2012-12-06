<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Cargo";?>
<?php
/* @var $this CargoController */
/* @var $model Cargo */

$this->pageTitle=Yii::app()->name." - ".Yii::t('app','CREATE')." Cargo";

$this->breadcrumbs = array(
    'Recursos Humanos' => array('admin'),
    'Cargo' => array('admin'),
    'Nuevo',
);
?>

<h1><?php echo Yii::t('app','CREATE')?> Cargo</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>