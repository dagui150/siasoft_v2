<?php $this->pageTitle=Yii::app()->name." - Unidades de Medida";?>
<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Unidades de Medida',
);
?>

<h1>Unidades de Medida</h1>
<br>

<div align="right">
<?php 

		$this->widget('bootstrap.widgets.BootButton', array(
			'label'=>'Nuevo',
			'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			'size'=>'mini', // '', 'large', 'small' or 'mini'
			'url'=>'#myModal',
			'icon' => 'plus white',
			'htmlOptions'=>array('data-toggle'=>'modal')
		)); 

	?>
</div>
<?php 
	$this->widget('bootstrap.widgets.BootGridView', array(
                'type'=>'striped bordered condensed',
		'id'=>'unidad-medida-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'NOMBRE',
			'ABREVIATURA',
                        array(
                            'name'=>'TIPO',
                            'filter'=>array('U'=>'Unidad','L'=>'Longitud','P'=>'Peso','V'=>'Volumen'),
                            'value'=>'UnidadMedida::darTipo($data->TIPO)'
                        ),
                        /*array(
                            'name'=>'UNIDAD_BASE',
                            'header'=>'Unidad Base',
                            'value'=>'uNIDADBASE.NOMBRE',
                        ),*/
			'EQUIVALENCIA',
			array(
				'class'=>'bootstrap.widgets.BootButtonColumn',
                                'htmlOptions'=>array('style'=>'width: 50px'),
			),
		),
	));
	$this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'myModal')); ?>
 
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3>Crear Unidad</h3>
		<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>
	</div>

	<?php $this->renderPartial('_form', array('model2'=>$model2)); ?>
 
<?php $this->endWidget(); ?>
