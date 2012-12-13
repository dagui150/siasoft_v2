<script>
function Elimina(){
    $("#subirLogo").css('display','block');
    $("#imagen").css('display','none');
    $("#eliminar").val('1');    
}
</script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'compania-form',
	'htmlOptions' => array('enctype' => 'multipart/form-data'),
	'enableAjaxValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note"><?php echo Yii::t('app','FIELDS_WITH'); ?><span class="required"> * </span><?php echo Yii::t('app','ARE_REQUIRED'); ?>.</p>

	<?php echo $form->errorSummary($model); ?>
        
        <table>
            <tr>
                <td><fieldset>
                    <div class="row">
                            <?php echo $form->labelEx($model,'NOMBRE');  ?>
                            <?php echo $form->textField($model,'NOMBRE',array('size'=>40,'maxlength'=>128)); ?>
                            <?php echo $form->error($model,'NOMBRE'); ?>
                    </div>

                    <div class="row">
                            <?php echo $form->labelEx($model,'NOMBRE_ABREV'); ?>
                            <?php echo $form->textField($model,'NOMBRE_ABREV',array('size'=>40,'maxlength'=>64)); ?>
                            <?php echo $form->error($model,'NOMBRE_ABREV'); ?>
                    </div>
                    <div class="row">
                            <?php echo $form->labelEx($model,'PAIS'); ?>
                            <?php echo $form->dropDownList($model,'PAIS', CHtml::listData(Pais::model()->findAll('ACTIVO = "S"'),'ID','NOMBRE'),array('empty'=>'Seleccione...')); ?>
                            <?php echo $form->error($model,'PAIS'); ?>
                    </div>
                    <div class="row">
                            <?php echo $form->labelEx($model,'UBICACION_GEOGRAFICA1'); ?>
                            <?php echo $form->dropDownList($model,'UBICACION_GEOGRAFICA1', CHtml::listData(UbicacionGeografica1::model()->findAll('ACTIVO = "S"'),'ID','NOMBRE'),
                            array(
                                'ajax'=>array(
				'type' => 'POST',
				'url' => CController::createUrl('Compania/cargar'),
				'update' => '#Compania_UBICACION_GEOGRAFICA2'
				), 'prompt' => 'Seleccione...'
				
                                )
                            ); ?>
                            <?php echo $form->error($model,'UBICACION_GEOGRAFICA1'); ?>
                    </div>
                    <div class="row">
                            <?php echo $form->labelEx($model,'UBICACION_GEOGRAFICA2'); ?>
                            <?php
                            if ($model->isNewRecord==1)
                                 //Si se está creando un registro nuevo
                                 {
                                 echo $form->dropDownList($model,'UBICACION_GEOGRAFICA2',
                                 array('0' => 'Seleccione...'));
                                 // se muestra solo Seleccione un Organismo
                                 }
                                 else {
                                     $tipo=$model->UBICACION_GEOGRAFICA1;
                                     // Si se está modificando un registro
                                     $sql="select count(ID) from ubicacion_geografica2 where ubicacion_geografica2.UBICACION_GEOGRAFICA1='$tipo';";
                                     $connection=Yii::app()->db;
                                     $command=$connection->createCommand($sql);
                                     $row=$command->queryRow();
                                     $bandera=$row['count(ID)'];
                                     if ($bandera==0) {
                                        echo $form->dropDownList($model,'UBICACION_GEOGRAFICA2',
                                        array('0' => 'Seleccione...')); }
                                        else {
                                            echo $form->dropDownList($model,'UBICACION_GEOGRAFICA2',
                                            CHtml::listData(UbicacionGeografica2::model()->findAllBySql("select * from ubicacion_geografica2 where ACTIVO = 'S' AND UBICACION_GEOGRAFICA1 = ".$model->UBICACION_GEOGRAFICA1), 'ID','NOMBRE'));
                                        }
                                    } ?>
                        </div>

                    </fieldset></td>
                <td><fieldset>
                    <div class="row">
                        <?php echo $form->labelEx($model,'NIT'); ?>
                        <?php echo $form->textField($model,'NIT',array('size'=>20,'maxlength'=>20)); ?>
                        <?php echo $form->error($model,'NIT'); ?>
                    </div>
                    <div class="row">
                            <?php echo $form->labelEx($model,'DIRECCION'); ?>
                            <?php echo $form->textField($model,'DIRECCION',array('size'=>40,'maxlength'=>256)); ?>
                            <?php echo $form->error($model,'DIRECCION'); ?>
                    </div>

                    <div class="row">
                    <?php echo $form->labelEx($model,'TELEFONO1'); ?>
                            <?php echo $form->textField($model,'TELEFONO1',array('size'=>20,'maxlength'=>20)); ?>
                            <?php echo $form->error($model,'TELEFONO1'); ?>
                    </div>

                    <div class="row">
                            <?php echo $form->labelEx($model,'TELEFONO2'); ?>
                            <?php echo $form->textField($model,'TELEFONO2',array('size'=>20,'maxlength'=>20)); ?>
                            <?php echo $form->error($model,'TELEFONO2'); ?>
                    </div>
                    <div class="row">
                            <?php   if($model->LOGO != NULL || $model->LOGO != ''){ ?> 
                            <div id="imagen"> <?php echo CHtml::image(Yii::app()->request->baseUrl."/logo/".$model->LOGO, 'Logo'); ?> 
                            <?php $this->widget('bootstrap.widgets.BootButton', array(
                                    'buttonType'=>'button',
                                    'type'=>'danger',
                                    'label'=>'',
                                    'icon'=>'remove white',
                                    'size' => 'mini',
                                    'htmlOptions'=> array('onclick'=>'Elimina()'),
                                        )); ?>
                           </div>
                                       <div id="subirLogo" style="display:none;">
                                            <?php echo $form->labelEx($model,'LOGO'); ?>
                                            <?php echo $form->fileField($model,'LOGO'); ?>
                                            <?php echo $form->error($model,'LOGO'); ?>
                                        </div>
                                    <?php }
                                    else{ ?>
                                        <div id="subirLogo">
                                            <?php echo $form->labelEx($model,'LOGO'); ?>
                                            <?php echo $form->fileField($model,'LOGO', array('onclick'=>'cambiar()')); ?>
                                            <?php echo $form->error($model,'LOGO'); ?>
                                        </div>
                                    <?php }
                            ?>
                            <blockquote>
                                    <small>Imagenes tipo JPG, PNG, GIF, Maximo de 1Mb</small>
                            </blockquote>
                            <?php echo CHtml::hiddenField('eliminar', '0'); ?>                           
                    </div>
                    </fieldset></td>
            </tr>
        </table>
	<div align="center">
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model->isNewRecord ? 'Crear' : 'Guardar')); ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Cancelar', 'size'=>'small',	'url' => array('site/index'), 'icon' => 'remove'));  ?>
	</div>

    <?php $this->endWidget(); ?> 
</div><!-- form -->