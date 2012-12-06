<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
        'Centro de Costos'=>array('admin'),
        $model2->ID => array('view', 'id' => $model2->ID),
        'Actualizar',
    );
?>

<h1>Actualizar Centro de Costos <?php echo $model2->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2, 'config'=>$config,)); ?>