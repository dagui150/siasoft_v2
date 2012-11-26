<?php 
    /*$nombre_bodega = isset($Pnombre_bodega) ? $Pnombre_bodega : '';
    $nombre_bodega_destino = isset($Pnombre_bodega_destino) ? $Pnombre_bodega_destino : '';
    $nombre_articulo = isset($Pnombre_articulo) ? $Pnombre_articulo : '';
    $subtipos = isset($Psubtipos) ? $Psubtipos : array();
    $cantidades = isset($Pcantidades) ? $Pcantidades : array();
    
    $campoActualiza = isset($PcampoActualiza) ? $PcampoActualiza : '';    
    $actualiza = isset($Pactualiza) ? $Pactualiza : 0;*/
    
    $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
                'id'=>'pedido-linea-form',
                'enableAjaxValidation'=>true,
                'clientOptions'=>array(
                     'validateOnSubmit'=>true,
                ),
                 'type'=>'horizontal',
     ));        
?>

<div class="form">
    <div class="modal-body" >
        
       <?php echo $form->errorSummary($linea); ?>

            <?php echo $form->textFieldRow($linea,'ARTICULO', array('readonly'=>true)); ?>
            <?php echo $form->textFieldRow($linea,'UNIDAD'); ?>
            <?php echo $form->textFieldRow($linea,'CANTIDAD'); ?>
            <?php echo $form->textFieldRow($linea,'PRECIO_UNITARIO'); ?>
            <?php echo $form->textFieldRow($linea,'PORC_DESCUENTO'); ?>
            <?php echo $form->textFieldRow($linea,'MONTO_DESCUENTO'); ?>
            <?php echo $form->textAreaRow($linea,'COMENTARIO'); ?>
            <?php echo CHtml::hiddenField('DESCRIPCION', ''); ?>
            <?php //echo $form->textFieldRow($linea,'PORC_RETENCION'); ?>
            <?php //echo $form->textFieldRow($linea,'MONTO_RETENCION'); ?>
            <?php //echo CHtml::hiddenField('CAMPO_ACTUALIZA',$campoActualiza); ?>
            <?php //echo CHtml::hiddenField('ACTUALIZA',$actualiza); ?>
            <?php echo CHtml::hiddenField('SPAN',''); ?>
     </div>
    <div class="modal-footer">
                 <?php
                    $this->widget('bootstrap.widgets.BootButton', array(
                         'buttonType'=>'ajaxSubmit',
                         'type'=>'primary',
                         'label'=>'Aceptar',
                         'icon'=>'ok white',
                         'url'=>array('documentoInv/agregarlinea',),
                         'ajaxOptions'=>array(
                             'type'=>'POST',
                             'update'=>'#form-lineas',
                             'beforeSend' => 'cargando()' ,
                          ),
                          'htmlOptions'=>array('id'=>'linea')
                      ));
                ?>
                 <?php
                    $bolean =Yii::app()->request->isAjaxRequest ? false : true;
                    $this->widget('bootstrap.widgets.BootButton', array(
                         'buttonType'=>'button',
                         'type'=>'normal',
                         'label'=>'Cancelar',
                         'icon'=>'remove',
                         'htmlOptions'=>array('onclick'=>'$(".close").click(); limpiarForm('.$bolean.');')
                      ));
                ?>
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->