<?php $this->pageTitle=Yii::app()->name." - Clasificaciónes";?>
<?php
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Clasificaciónes'
);

?>
<h1>Clasificaciónes</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<div id="mensaje"></div>
<div align="right">
    <?php $this->darBotonNuevo('#myModal',array('data-toggle'=>'modal'),'mini'); ?>
</div>

<?php 
	$this->widget('bootstrap.widgets.TbGridView', array(
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
                            'class'=>'bootstrap.widgets.TbButtonColumn',
                            'template'=>'{update}{delete}',
                            'afterDelete'=>$this->mensajeBorrar(),
			),
		),
	)); 
	$this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
 
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3>Crear Clasificación</h3>
		<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>
	</div>
	 
	<?php echo $this->renderPartial('_form', array('model2'=>$model2)); ?>
	
 
<?php $this->endWidget(); ?>

