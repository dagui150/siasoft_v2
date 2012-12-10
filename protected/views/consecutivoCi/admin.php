<?php
if(!ConfCi::darConf())
     $this->redirect(array('/confCi/create'));
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Consecutivos'
);

?>

<h1>Consecutivos</h1>
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
<?php 
    $this->widget('bootstrap.widgets.BootGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>'consecutivo-ci-grid',
            'dataProvider'=>$model->search(),
            'filter'=>$model,
            'columns'=>array(
                    'ID',
                    'DESCRIPCION',
                    'MASCARA',
                    'SIGUIENTE_VALOR',
                    'FORMATO_IMPRESION',
                    array(
                         'name'=>'TODOS_USUARIOS',
                         'value'=>'($data->TODOS_USUARIOS == \'S\') ? \'Si\' :\'No\'',
                         'filter'=>array('S'=>'Si','N'=>'No'),
                     ),
                    array(
                        'class'=>'bootstrap.widgets.BootButtonColumn',
                        'htmlOptions'=>array('style'=>'width: 50px'),
                    ),
            ),
    ));
    
    $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'myModal')); ?>
 
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3>Crear Consecutivo</h3>
		<p class="note">Los Campos con <span class="required">*</span> Son requeridos.</p>
	</div>
	 
	<?php echo $this->renderPartial('_form', array('model2'=>$model2,)); ?>

 
<?php $this->endWidget(); ?>