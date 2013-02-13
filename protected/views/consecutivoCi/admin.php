<?php $this->pageTitle=Yii::app()->name." - Consecutivos";?>
<?php
if(!ConfCi::darConf())
     $this->redirect(array('/confCi/create'));
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Consecutivos'
);

?>

<h1>Consecutivos</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<div id="mensaje"></div>
<div align="right">
    <?php $this->darBotonNuevo('',array('onclick'=>'$("#myModal").modal()'),'mini'); ?>
</div>
<?php 
    $this->widget('bootstrap.widgets.TbGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>'consecutivo-ci-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'columns'=>array(
                    'ID',
                    'DESCRIPCION',
                    'MASCARA',
                    'SIGUIENTE_VALOR',
                    array(
                         'name' => 'FORMATO_IMPRESION',
                         'value'=>'isset($data->fORMATOIMPRESION->NOMBRE) ? $data->fORMATOIMPRESION->NOMBRE : ""',
                     ),
                    array(
                         'name'=>'TODOS_USUARIOS',
                         'value'=>'($data->TODOS_USUARIOS == \'S\') ? \'Si\' :\'No\'',
                         'filter'=>array('S'=>'Si','N'=>'No'),
                     ),
                    array(
                        'class'=>'bootstrap.widgets.TbButtonColumn',
                        'htmlOptions'=>array('style'=>'width: 50px'),
                        'afterDelete'=>$this->mensajeBorrar(),
                    ),
            ),
    ));
    
    $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'myModal')); ?>
 
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3>Crear Consecutivo</h3>
		<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>
	</div>
	 
	<?php echo $this->renderPartial('_form', array('model2'=>$model2,)); ?>

 
<?php $this->endWidget(); ?>