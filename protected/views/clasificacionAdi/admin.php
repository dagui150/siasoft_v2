<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Clasificaciones'
);

?>
<h1>Clasificaciones</h1>
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
		'id'=>'clasificacion-adi-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'ID',
			'NOMBRE',
                        array(
                            'name'=>'OBLIGATORIO',
                            'filter'=>array('S'=>'Si','N'=>'No'),
                            'value'=>'$data->OBLIGATORIO == "S" ? "Si" : "No" '
                        ),
			'POSICION',
			array(
				'class'=>'bootstrap.widgets.BootButtonColumn',
                                'template'=>'{update}{delete}',
			),
		),
	)); 
	$this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'myModal')); ?>
 
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3>Crear Clasificación</h3>
		<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>
	</div>
	 
	<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>
	
 
<?php $this->endWidget(); ?>

