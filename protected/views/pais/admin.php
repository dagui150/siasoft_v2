<?php $this->pageTitle=Yii::app()->name." - ".Yii::t('app','COUNTRIES');?>


<?php
$this->breadcrumbs=array(
        'Sistema'=>array('admin'),
	Yii::t('app','COUNTRIES')
);
?>

<h1><?php echo Yii::t('app','COUNTRIES'); ?></h1>

<div align="right">
    
    <?php $this->darBotonPdfExcel(array('pais/excel')); ?>
    <?php $this->darBotonPdfExcel(array('pais/pdf'), false, 'PDF', 'danger'); ?>

</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped bordered condensed',
	'id'=>'pais-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'ID',
		'NOMBRE',
		'CODIGO_ISO',
		/*'ACTIVO',
		'CREADO_POR',
		'CREADO_EL',
		'ACTUALIZADO_POR',
		'ACTUALIZADIO_EL',
		*/

	),
)); ?>
