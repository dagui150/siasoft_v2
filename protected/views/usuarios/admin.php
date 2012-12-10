<?php
$this->breadcrumbs=array(
	'Usuarios'=>array('admin'),
	'Administrar',
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('usuarios-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Usuarios</h1>
<br>
<div align="right">
    <?php 

	$this->widget('bootstrap.widgets.BootButton', array(
			'label'=>'Permisos',
			'type'=>'action', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
			'size'=>'mini', // '', 'large', 'small' or 'mini'
			'url'=>array('/srbac'),
			'icon' => 'user',
		)); 

    ?>
    
    <?php 

            $this->widget('bootstrap.widgets.BootButton', array(
                    'label'=>'Listar',
                    'type'=>'primary', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size'=>'mini', // '', 'large', 'small' or 'mini'
                    'url' => array('index'),
                    'icon' => 'list-alt white'
            )); 

    ?>

    <?php 

            $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Nuevo',
                'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                'size'=>'mini', // '', 'large', 'small' or 'mini'
                'icon' => 'plus white',
                'url'=>'#myModal',
                'htmlOptions'=>array('data-toggle'=>'modal'),
            )); 

    ?>

</div>

<?php
	 $this->widget('bootstrap.widgets.BootGridView', array(
                'type'=>'striped bordered condensed',
		'id'=>'usuarios-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'ID',
			'USERNAME',
			'PASS',
			//'ACTIVO',
			array(
				'class'=>'bootstrap.widgets.BootButtonColumn',
                                'htmlOptions'=>array('style'=>'width: 50px'),
			),
		),
	));
	
	$this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'myModal')); ?>
 
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3>Crear Usuario</h3>
		<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>
	</div>
	 
	<div class="modal-body">
		<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>
	</div>
	 
	<div class="modal-footer">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'label'=>'Cerrar',
			'url'=>'#',
			'htmlOptions'=>array('data-dismiss'=>'modal'),
		)); ?>
	</div>
 
<?php $this->endWidget(); ?>
