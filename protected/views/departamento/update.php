<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Dependencias";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
        'Dependencias'=>array('admin'),
        $model2->ID => array('view', 'id' => $model2->ID),
        'Actualizar',
    );
?>

<h1>Actualizar Dependencia <?php echo $model2->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>