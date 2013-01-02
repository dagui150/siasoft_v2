<?php
/* @var $this MensajeSistemaController */
/* @var $model MensajeSistema */
/* @var $form CActiveForm */
?>

<div class="form">
    <div>
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'type' => 'horizontal',
	'id'=>'mensaje-sistema-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php echo $form->errorSummary($model2); ?>
            
            <table style="width: 200px">
                <tr>
                    <td>
                        <?php echo $form->textFieldRow($model2,'CODIGO',array('size'=>4,'maxlength'=>4)); ?>
                    </td>
                    <td>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php //echo $form->dropDownListRow($model2,'PAIS', CHtml::listData(Pais::model()->findAll('ACTIVO = "S"'),'ID','NOMBRE'),array('empty'=>'Seleccione...')); ?>
                        <?php echo $form->dropDownListRow($model2,'TIPO',array(''=>'Seleccione...','success'=>'Exito','error'=>'Error','warning'=>'Advertencia')); ?>
                        <?php //echo $form->textFieldRow($model2,'TIPO',array('size'=>10,'maxlength'=>10)); ?>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <?php //echo $form->textFieldRow($model2,'NOMBRE',array('maxlength'=>64)); ?>
                        <?php echo $form->textAreaRow($model2,'MENSAJE',array('rows'=>6, 'cols'=>50)); ?>
                    </td>
                    <td></td>
                </tr>
                </table>
        <div class="row">
		<?php
			echo CHtml::activeHiddenField($model2,'ACTIVO',array('value'=>'S'));
			echo $form->error($model2,'ACTIVO'); 
		?>
	</div>
        <?php /*
	<div class="row">
		<?php echo $form->labelEx($model2,'CODIGO'); ?>
		<?php echo $form->textField($model2,'CODIGO',array('size'=>4,'maxlength'=>4)); ?>
		<?php echo $form->error($model2,'CODIGO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model2,'TIPO'); ?>
		<?php echo $form->textField($model2,'TIPO',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model2,'TIPO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model2,'MENSAJE'); ?>
		<?php echo $form->textArea($model2,'MENSAJE',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model2,'MENSAJE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model2,'ACTIVO'); ?>
		<?php echo $form->textField($model2,'ACTIVO',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model2,'ACTIVO'); ?>
	</div>
*/?>

	</div>
	<div class="modal-footer" align="center">
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model2->isNewRecord ? 'Crear' : 'Guardar')); ?>
	<?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Cancelar', 'size'=>'small',	'url' => array('admin'), 'icon' => 'remove', 'htmlOptions'=>array('data-dismiss'=>'modal')));  ?>	
        </div>


<?php $this->endWidget(); ?>

</div><!-- form -->