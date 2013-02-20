<?php $this->pageTitle=Yii::app()->name." - Departamentos";?>

<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Departamentos',
);
?>

<h1>Departamentos</h1>
<div align="right">
    
    <?php $this->darBotonPdfExcel(array('ubicacionGeografica1/excel')); ?>
    <?php $this->darBotonPdfExcel(array('ubicacionGeografica1/pdf'), false, 'PDF', 'danger'); ?>

</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
	'id'=>'ubicacion-geografica1-grid',
        'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
            array('name'=>'PAIS',
                'value'=>'$data->pAIS->NOMBRE'),
		'NOMBRE'
	),
)); ?>