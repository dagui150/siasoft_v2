<?php $this->pageTitle=Yii::app()->name." - Retenciones";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Retenciones',
);
?>

<h1>Administrar Retenciones</h1>
<div align="right">
    <?php $this->darBotonPdfExcel(array('retencion/excel')); ?>
    <?php $this->darBotonPdfExcel(array('retencion/pdf'), false, 'PDF', 'danger'); ?>
</div>

<?php  $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
	'id'=>'retencion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'NOMBRE',
		'PORCENTAJE',
		'MONTO_MINIMO',
		//'TIPO',
		//'APLICA_MONTO',
		/*
		'APLICA_SUBTOTAL',
		'APLICA_SUB_DESC',
		'APLICA_IMPUESTO1',
		'APLICA_RUBRO1',
		'APLICA_RUBRO2',
		'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADO_EL',
		*/
<<<<<<< HEAD
=======
//		array(
//                    'class'=>'bootstrap.widgets.TbButtonColumn',
//                    'template'=>'{view}',
//		),
>>>>>>> 9ca759032cd2997cd88c7d79561f8a1f3e9d2ec8
	),
)); ?>