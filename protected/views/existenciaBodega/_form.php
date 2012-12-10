<script>
    function updateBodega(grid_id){
        var id=$.fn.yiiGridView.getSelection(grid_id);
        
        $.getJSON(
            '<?php echo $this->createUrl('bodega/cargarbodega'); ?>&id='+id,
            function(data){
                $('#ExistenciaBodega_BODEGA').val(data.ID);
                $('#BODEGA2').val(data.DESCRIPCION);

            }
        );
    }
    function updateArticulo(grid_id){
        var id=$.fn.yiiGridView.getSelection(grid_id);
        
        $.getJSON(
            '<?php echo $this->createUrl('articulo/cargararticulo'); ?>&id='+id,
            function(data){
                $('#ExistenciaBodega_ARTICULO').val(data.ID);
                $('#ARTICULO2').val(data.NOMBRE);

            }
        );
    }
</script>

<div class="wide form" style="background-color: white;">

<?php 
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
            'id'=>'existencia-bodega-form',
            'enableAjaxValidation'=>true,
            'clientOptions'=>array(
                            'validateOnSubmit'=>true,
            ),
            'type'=>'horizontal',
    ));
    
    $boton = $this->widget('bootstrap.widgets.BootButton', array(
                'type'=>'info',
                'size'=>'mini',
                'url'=>'#bodega',
                'icon'=>'search',
                'htmlOptions'=>array('data-toggle'=>'modal',),
            ),true);
    $boton2 = $this->widget('bootstrap.widgets.BootButton', array(
                'type'=>'info',
                'size'=>'mini',
                'url'=>'#articulo',
                'icon'=>'search',
                'htmlOptions'=>array('data-toggle'=>'modal',),
            ),true);
?>

	<?php 
            $bbodega = Bodega::model()->findByPk($model->BODEGA);
            $vbodega = $model->isNewRecord? '' : $bbodega->DESCRIPCION;
            echo $form->errorSummary($model); 
        ?>

	<div class="row">
            <table>
                 <tr>
                       <td><?php echo $form->textFieldRow($model,'BODEGA',array('maxlength'=>4,'size'=>4,'ajax'=>array('type' => 'POST','url' => CController::createUrl('existenciaBodega/cargarAjax'),'update' => '#BODEGAA')));?></td> 
                       <td><div id="BODEGAA" style="margin: 0 0 0 -497px"><?php echo CHtml::textField('BODEGA2',$vbodega,array('size'=>18,'disabled'=>true)); ?></div></td> 
                       <td><div style="margin: 5px 0 0 -360px"><?php echo $boton; ?></div></td> 
                 
                       <td><div style="margin: 0 0 0 -352px"><?php echo $form->textFieldRow($model,'ARTICULO',array('value'=>$articulo,'readonly'=>true,'maxlength'=>4,'size'=>4,'ajax'=>array('type' => 'POST','url' => CController::createUrl('existenciaBodega/cargarAjax2'),'update' => '#ARTICULOO')));?></div></td> 
                       <td><div id="ARTICULOO" style="margin: 0 0 0 -157px"><?php echo CHtml::textField('ARTICULO2',$barticulo->NOMBRE,array('size'=>18,'disabled'=>true)); ?></div></td> 
                 </tr>
            </table>
            <fieldset style="float: left;width: 300px;">
                 <legend ><font face="arial" size=3 >Existencias</font></legend>
                 <?php echo $form->textFieldRow($model,'EXISTENCIA_MINIMA',array('size'=>4,'maxlength'=>28)); ?>

                 <?php echo $form->textFieldRow($model,'PUNTO_REORDEN',array('size'=>4,'maxlength'=>28)); ?>

                 <?php echo $form->textFieldRow($model,'EXISTENCIA_MAXIMA',array('size'=>4,'maxlength'=>28)); ?>

           </fieldset>
            
           <fieldset style="float: left; margin: 0 0 0 45px; width: 310px; height: 218px;">
                <legend ><font face="arial" size=3 >Cantidades</font></legend>
                <table>
                    <tr>
                        <td>
                            <?php echo $form->textFieldRow($model,'CANT_DISPONIBLE',array('value'=>0,'size'=>4,'maxlength'=>28,'readonly'=>true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textFieldRow($model,'CANT_CUARENTENA',array('value'=>0,'size'=>4,'maxlength'=>28,'readonly'=>true)); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $form->textFieldRow($model,'CANT_REMITIDA',array('value'=>0,'size'=>4,'maxlength'=>28,'readonly'=>true)); ?>
                        </td>
                        <td>
                            <?php echo $form->textFieldRow($model,'CANT_VENCIDA',array('value'=>0,'size'=>4,'maxlength'=>28,'readonly'=>true)); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $form->textFieldRow($model,'CANT_RESERVADA',array('value'=>0,'size'=>4,'maxlength'=>28,'readonly'=>true)); ?>
                        </td>
                        <td></td>
                    </tr>
                </table>
           </fieldset>
            
            <?php echo CHtml::activeHiddenField($model,'ACTIVO',array('value'=>'S')); ?>
            <br>
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
        $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'bodega')); ?>

            <div class="modal-body">
                    <a class="close" data-dismiss="modal">&times;</a>
                    <br>
                    <?php 
                        $this->widget('bootstrap.widgets.BootGridView', array(
                                 'type'=>'striped bordered condensed',
                                 'id'=>'bodega-grid',
                                 'template'=>"{items}",
                                 'dataProvider'=>$bodega->search(),
                                 'filter'=>$bodega,
                                 'selectionChanged'=>'updateBodega',
                                 'columns'=>array(
                                       array(
                                            'type'=>'raw',
                                            'name'=>'ID',
                                            'header'=>'Codigo Bodega',
                                            'value'=>'CHtml::link($data->ID,"#")',
                                            'htmlOptions'=>array('data-dismiss'=>'modal'),
                                       ),
                                       'DESCRIPCION',
                                       'TIPO',
                                       'TELEFONO',
                                       'DIRECCION',
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