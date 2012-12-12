<script>
    function updateProveedor(grid_id){
        var id=$.fn.yiiGridView.getSelection(grid_id);
        
        $.getJSON(
            '<?php echo $this->createUrl('proveedor/cargarproveedor'); ?>&id='+id,
            function(data){
                $('#ArticuloProveedor_PROVEEDOR').val(data.PROVEEDOR);
                $('#PROVEEDOR2').val(data.NOMBRE);

            }
        );
    }
</script>
<div class="wide form" style="background-color: white;">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'articulo-proveedor-form',
	'enableAjaxValidation'=>true,
            'clientOptions'=>array(
                            'validateOnSubmit'=>true,
        ),
        'type'=>'horizontal',
)); ?>

	<?php
            
            $bproveedor = Proveedor::model()->findByPk($model->PROVEEDOR);
            $vproveedor = $model->isNewRecord? '' : $bproveedor->NOMBRE;
            
            $boton = $this->widget('bootstrap.widgets.BootButton', array(
                'type'=>'info',
                'size'=>'mini',
                'url'=>'#proveedor',
                'icon'=>'search',
                'htmlOptions'=>array('data-toggle'=>'modal',),
            ),true);
            
            echo $form->errorSummary($model);
            
        ?>

	<div class="row">
            <table>
                 <tr>
                       <td><?php echo $form->textFieldRow($model,'PROVEEDOR',array('maxlength'=>8,'size'=>5,'ajax'=>array('type' => 'POST','url' => CController::createUrl('articuloProveedor/cargarAjax'),'update' => '#PROVEEDORR')));?></td> 
                       <td><div id="PROVEEDORR" style="margin: 0 0 0 -497px"><?php echo CHtml::textField('PROVEEDOR2',$vproveedor,array('size'=>15,'disabled'=>true)); ?></div></td> 
                       <td><div style="margin: 5px 0 0 -380px"><?php echo $boton; ?></div></td> 
                 
                       <td><div style="margin: 0 0 0 -370px"><?php echo $form->textFieldRow($model,'ARTICULO',array('value'=>$articulo,'readonly'=>true,'maxlength'=>4,'size'=>4,'ajax'=>array('type' => 'POST','url' => CController::createUrl('existenciaBodega/cargarAjax2'),'update' => '#ARTICULOO')));?></div></td> 
                       <td><div id="ARTICULOO" style="margin: 0 0 0 -173px"><?php echo CHtml::textField('ARTICULO2',$barticulo->NOMBRE,array('size'=>18,'disabled'=>true)); ?></div></td> 
                 </tr>
            </table>
            <div style="float: left;">
                <?php echo $form->textFieldRow($model,'CODIGO_CATALOGO'); ?>
            </div>
            <div style="float: left; margin: 0 0 0 94px;">
                <?php echo $form->textFieldRow($model,'NOMBRE_CATALOGO'); ?>
            </div>
	
                <?php echo CHtml::activeHiddenField($model,'ACTIVO',array('value'=>'S')); ?>
                <div class="row buttons" align ="center" style="margin: 0 0 0 -132px">
                        <?php 
                                $this->widget('bootstrap.widgets.BootButton', array(
                                            'label'=>$model->isNewRecord ? 'Crear' : 'Guardar',
                                            'buttonType'=>'submit',
                                            'type'=>'primary',
                                            'icon'=>$model->isNewRecord ? 'ok-circle white' : 'pencil white',
                                    )
                                );
                        ?>
               </div>
        </div>

<?php 
        $this->endWidget(); 
        $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'proveedor')); ?>

            <div class="modal-body">
                    <a class="close" data-dismiss="modal">&times;</a>
                    <br>
                    <?php 
                        $this->widget('bootstrap.widgets.BootGridView', array(
                                 'type'=>'striped bordered condensed',
                                 'id'=>'proveedor-grid',
                                 'template'=>"{items}",
                                 'dataProvider'=>$proveedor->search(),
                                 'filter'=>$proveedor,
                                 'selectionChanged'=>'updateProveedor',
                                 'columns'=>array(
                                       array(
                                            'type'=>'raw',
                                            'name'=>'PROVEEDOR',
                                            'header'=>'Proveedor',
                                            'value'=>'CHtml::link($data->ID,"#")',
                                            'htmlOptions'=>array('data-dismiss'=>'modal'),
                                       ),
                                        'PROVEEDOR',
                                        'NOMBRE',
                                        'CATEGORIA',
                                        'ALIAS',
                                        'CONTACTO',
                                        'CARGO',
                                 ),
                      ));
                 ?>
            </div>
            <div class="modal-footer">

                <?php $this->widget('bootstrap.widgets.BootButton', array(
                    'label'=>'Cerrar',
                    'url'=>'#',
                    'htmlOptions'=>array('data-dismiss'=>'modal'),
                )); ?>
            </div>

    <?php  $this->endWidget();?>
</div><!-- form -->
