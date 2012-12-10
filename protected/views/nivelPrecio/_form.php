<div class="form">
    <div>
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'nivel-precio-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
        
        <?php echo $form->errorSummary($model2); ?>

	<?php echo $form->textFieldRow($model2,'ID',array('size'=>12,'maxlength'=>12)); ?>
	<?php echo $form->textAreaRow($model2,'DESCRIPCION'); ?>
        <?php echo $form->dropDownListRow($model2, 'ESQUEMA_TRABAJO', array('NORM'=>'Normal','MULT'=>'Multiplicador', 'MARG' => 'Margen', 'MARK' => 'Markup')); ?>
		<?php echo $form->dropDownListRow($model2,'CONDICION_PAGO', CHtml::listData(CodicionPago::model()->findAll(),'ID','DESCRIPCION'),array('empty'=>'Seleccione...')); ?>
	<div class="row">
		<?php
			echo CHtml::activeHiddenField($model2,'ACTIVO',array('value'=>'S'));
			echo $form->error($model2,'ACTIVO'); 
		?>
	</div>
    </div>
	<?php if($model2->isNewRecord): ?>
        <div class="modal-footer" align="center">
        <?php endif ?>

        <?php if(!$model2->isNewRecord): ?>
        <div class="row-buttons" align="center">
        <?php endif ?>
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model2->isNewRecord ? 'Crear' : 'Guardar')); ?>
 	<?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Cancelar', 'size'=>'small',	'url' => '#', 'icon' => 'remove', 'htmlOptions'=>array('data-dismiss'=>'modal')));  ?>	        
        </div>


<?php $this->endWidget(); ?>

</div><!-- form -->