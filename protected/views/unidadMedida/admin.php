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

<?php if(!UnidadMedida::validarUnidad()): ?>
    <div class="alert alert-block">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php echo CHtml::image(Yii::app()->baseUrl."/images/warning.png",'Informacion',array('style'=>'float: left'));?>
        <h4 style="float: left">&nbsp &nbsp Por favor Ajuste sus Unidades!</h4><br><br>
        Se deben volver a seleccionar las unidades base para las unidades creadas:
        <ul>
            <li>Actualize su unidad</li>
            <li>Vuelva a seleccionar el Tipo</li>
            <li>Automaticamente se debe cargar en el campo unidad base con respecto al tipo</li>
            <li>Los campos Base permitidos son (<?php echo Yii::t('ayuda','UBASE_UNID_MED')?>)</li>
            <li>si es diferente a alguno de estos, no permitira guardar</li>
            <li>Realize estos cambios en sus unidades de medida y podra utilizar el sistema normalmente</li>
        </ul>
    </div>
<?php endif; ?>

<div align="right">
    <?php $this->darBotonNuevo('#myModal',array('data-toggle'=>'modal'),'mini'); ?>
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
                        array(
                            'name'=>'UNIDAD_BASE',
                            'header'=>'Unidad Base',
                            'value'=>'$data->uNIDADBASE->NOMBRE',
                            'filter'=>CHtml::listData(UnidadMedida::model()->findAllByAttributes(array('ACTIVO'=>'S','BASE'=>'S')),'ID','NOMBRE'),
                        ),
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
