<?php $this->pageTitle=Yii::app()->name." - Impuestos";?>
<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	'Impuestos',
);

?>

<h1>Impuestos</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<div id="mensaje"></div>
<div align="right">
    <?php $this->darBotonPdfExcel(array('impuesto/excel')); ?>
    <?php $this->darBotonPdfExcel(array('impuesto/pdf'), false, 'PDF', 'danger'); ?>
    <?php //$this->darBotonNuevo('#myModal',array('data-toggle'=>'modal'),'mini'); ?>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
        'type'=>'striped bordered condensed',
	'id'=>'impuesto-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'NOMBRE',
		'PROCENTAJE',
//		array(
//                    'class'=>'bootstrap.widgets.TbButtonColumn',
//                    'htmlOptions'=>array('style'=>'width: 50px'),
//                    'afterDelete'=>$this->mensajeBorrar(),
//		),
	),
)); ?>