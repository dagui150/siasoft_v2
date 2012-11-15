<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','UPDATE')." Tipos de Documento";?>
<?php
$this->breadcrumbs=array(
    'Sistema'=>array('admin'),
    'Tipos de Documento'=>array('admin'),
        $model2->ID => array('view', 'id' => $model2->ID),
        'Actualizar',
    );
?>

<h1>Actualizar Tipo Documento <?php echo $model2->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>