<?php $this->pageTitle=Yii::app()->name." - Municipios";?>

<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Municipios',
);

?>

<h1>Municipios</h1>

<div align="right">
    
    <?php $this->darBotonPdfExcel(array('ubicacionGeografica2/excel')); ?>
    <?php $this->darBotonPdfExcel(array('ubicacionGeografica2/pdf'), false, 'PDF', 'danger'); ?>
    
</div>
<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
	'id'=>'ubicacion-geografica2-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
                array ('name'=>'UBICACION_GEOGRAFICA1','value'=>'$data->uBICACIONGEOGRAFICA1->NOMBRE','type'=>'text','filter' => CHtml::listData(UbicacionGeografica1::model()->findAll(), 'ID', 'NOMBRE'),),
		//'UBICACION_GEOGRAFICA1',
		'NOMBRE',
	),
)); ?>
