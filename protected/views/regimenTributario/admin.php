<?php
/* @var $this RegimenTributarioController */
/* @var $model RegimenTributario */

$this->breadcrumbs=array(
	'Regimen Tributarios'=>array('admin'),
	'Administrar',
);

?>
<h1>Régimen tributario</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<div id="mensaje"></div>
<div align="right">
    <?php $this->darBotonPdfExcel(array('regimenTributario/excel')); ?>
    <?php $this->darBotonPdfExcel(array('regimenTributario/pdf'), false, 'PDF', 'danger'); ?>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
	'id'=>'regimen-tributario-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'REGIMEN',
		'DESCRIPCION',
		/*'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',		
		'ACTUALIZADO_EL',
		array(
                    'class'=>'bootstrap.widgets.TbButtonColumn',
                    'htmlOptions'=>array('style'=>'width: 50px'),
                    'afterDelete'=>$this->mensajeBorrar(),
		),
		*/
	),
)); ?>
