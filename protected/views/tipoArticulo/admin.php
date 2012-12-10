<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Tipos de Articulos'
);
?>

<h1>Tipos de Articulos</h1>
<br>


<?php 
    $this->widget('bootstrap.widgets.BootGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>'tipo-articulo-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'columns'=>array(
                    'ID',
                    'NOMBRE',
                    'DESCRIPCION',
                    'ACTIVO',
            ),
    )); 
?>

