<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Condición de Pago";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
        'Condición de Pago'=>array('admin'),
        $model2->ID => array('view', 'id' => $model2->ID),
        'Actualizar',
    );
?>

<h1>Actualizar Condición de Pago <?php echo $model2->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>