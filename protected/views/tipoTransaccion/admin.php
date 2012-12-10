<?php
if(!ConfCi::darConf())
     $this->redirect(array('/confCi/create'));
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Tipos de Transacción'
);
?>

<h1>Tipos de Transacción</h1>
<br>
<div align="right"> 
<?php 

	$this->widget('bootstrap.widgets.BootButton', array(
		'label'=>'Nuevo',
		'type'=>'success', 
		'size'=>'mini', 
		'icon' => 'plus white',
		'htmlOptions'=>array('onclick'=>'$("#myModal").modal()')
	)); 

	?>
</div>
<br>


<?php 
    $this->widget('bootstrap.widgets.BootGridView', array(
        'type'=>'striped bordered condensed',
	'id'=>'tipo-transaccion-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
                array(
                     'name'=>'TIPO_TRANSACCION',
                     'htmlOptions'=>array('style'=>'width: 50px;'),
                 ),
		'NOMBRE',
                 array(
                     'name'=>'TRANSACCION_BASE',
                     'header'=>'Transaccion Base',
                     'value'=>'$data->tRANSACCIONBASE->NOMBRE',
                     'filter'=>CHtml::listData(TipoTransaccion::model()->findAll(),'TIPO_TRANSACCION' ,'NOMBRE' ),
                     
                     
                 ),
                 array(
                     'name'=>'TRANSACCION_FIJA',
                     'header'=>'Transaccion Fija',
                     'value'=>'($data->TRANSACCION_FIJA == \'S\') ? \'Si\' :\'No\'',
                     'htmlOptions'=>array('style'=>'width: 50px;'),
                     'filter'=>array('S'=>'Si','N'=>'No'),
                 ),
                 array(
                     'name'=>'NATURALEZA',
                     'value'=>'TipoTransaccion::getNatural($data->NATURALEZA)',
                     'filter'=>array('S'=>'Salida','E'=>'Entrada','A'=>'Ambas','N'=>'Ninguna'),
                 ),
		array(
                    'class'=>'bootstrap.widgets.BootButtonColumn',
                    'deleteButtonUrl'=>'Yii::app()->controller->createUrl("delete",array("id"=>($data->TRANSACCION_FIJA == \'N\') ? $data->TIPO_TRANSACCION : 0 ))',
                    'htmlOptions'=>array('style'=>'width: 50px'),
		),
	),
    )); 
    $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'myModal')); ?>
 
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3>Crear Tipo Transacción</h3>
		<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>
	</div>
	 
	<?php echo $this->renderPartial('_form', array('model2'=>$model2,'subTipo'=>$subTipo)); ?>

 
<?php $this->endWidget(); ?>
