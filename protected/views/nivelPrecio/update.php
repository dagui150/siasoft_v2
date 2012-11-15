<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Nivel de Precios";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
        'Nivel de Precios'=>array('admin'),
        $model2->ID => array('view', 'id' => $model2->ID),
        'Actualizar',
    );
?>

<h1>Actualizar Nivel Precio <?php echo $model2->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>