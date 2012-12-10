<?php
$this->breadcrumbs=array(
	'Inventario'=>array('update','id'=>$model->ID),
	'Configuración'
);
?>

<h1>Configuración de Inventario</h1>

<?php echo $this->renderPartial('_form2',
        array(
            'model'=>$model,
            'regla1'=>$regla1,
            'regla2'=>$regla2,
            'regla3'=>$regla3,
            'regla4'=>$regla4,
        )
      ); ?>