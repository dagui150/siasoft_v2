<?php $this->pageTitle=Yii::app()->name." - Unidades de Medida";?>
<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Unidades de Medida',
);
?>

<h1>Unidades de Medida</h1>
<?php 
if (isset($_GET['men'])){
   $this->mensaje($_GET['men']);
}
?>
<div id="mensaje"></div>
<br>

<div align="right">
<?php 

		$this->widget('bootstrap.widgets.TbButton', array(
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
	$this->widget('bootstrap.widgets.TbGridView', array(
                'type'=>'striped bordered condensed',
		'id'=>'unidad-medida-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'NOMBRE',
			'ABREVIATURA',
                        array(
                            'name'=>'TIPO',
                            'filter'=>array('U'=>'Unidad','L'=>'Longitud','P'=>'Peso','V'=>'Volumen','S'=>'Servicio',),
                            'value'=>'UnidadMedida::darTipo($data->TIPO)'
                        ),
                        /*array(
                            'name'=>'UNIDAD_BASE',
                            'header'=>'Unidad Base',
                            'value'=>'uNIDADBASE.NOMBRE',
                        ),*/
			'EQUIVALENCIA',
			array(
                            'class'=>'bootstrap.widgets.TbButtonColumn',
                                'deleteButtonUrl'=>'"index.php?r=unidadMedida/delete&id=".$data->ID',
                                'updateButtonUrl'=>'($data->BASE == "S") ? "#" : "index.php?r=unidadMedida/update&id=".$data->ID',
                            'htmlOptions'=>array('style'=>'width: 50px'),
                            'afterDelete'=>$this->mensajeBorrar(),
			),
		),
	));
	$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
 
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3>Crear Unidad</h3>
		<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>
	</div>

	<?php $this->renderPartial('_form', array('model2'=>$model2)); ?>
 
<?php $this->endWidget(); ?>
