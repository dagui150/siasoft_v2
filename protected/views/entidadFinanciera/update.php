<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Entidad Financiera";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
        'Entidad Financiera'=>array('admin'),
        $model2->ID => array('view', 'id' => $model2->ID),
        'Actualizar',
    );
?>

<h1>Actualizar Entidad Financiera <?php echo $model2->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2, 'nit'=>$nit,)); ?>