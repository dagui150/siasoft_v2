<?php
$this->breadcrumbs=array(
        'Sistema'=>array('update', 'id'=>$model2->ID),
	"Bodega");
?>
<h1>Actualizar Bodega <?php echo $model2->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>