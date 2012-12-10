<?php
$this->breadcrumbs=array(
        'Sistema'=>array('update', 'id'=>$model2->ID),
	"Tipo de Tarjeta");
?>

<h1>Actualizar Tipo Tarjeta <?php echo $model2->ID; ?></h1>

<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>