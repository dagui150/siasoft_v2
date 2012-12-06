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

	<div class="row">
		<?php echo $form->labelEx($model,'NOMBRE');  ?>
		<?php echo $form->textField($model,'NOMBRE',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'NOMBRE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NOMBRE_ABREV'); ?>
		<?php echo $form->textField($model,'NOMBRE_ABREV',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'NOMBRE_ABREV'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NIT'); ?>
		<?php echo $form->textField($model,'NIT',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'NIT'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'UBICACION_GEOGRAFICA1'); ?>
		<?php echo $form->dropDownList($model,'UBICACION_GEOGRAFICA1', CHtml::listData(UbicacionGeografica1::model()->findAll(),'ID','NOMBRE'),
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
		<?php echo $form->dropDownList($model,'UBICACION_GEOGRAFICA2',array('empty'=>'Seleccione...')); ?>
		<?php echo $form->error($model,'UBICACION_GEOGRAFICA2'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'PAIS'); ?>
		<?php echo $form->dropDownList($model,'PAIS', CHtml::listData(Pais::model()->findAll(),'ID','NOMBRE'),array('empty'=>'Seleccione...')); ?>
		<?php echo $form->error($model,'PAIS'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DIRECCION'); ?>
		<?php echo $form->textField($model,'DIRECCION',array('size'=>60,'maxlength'=>256)); ?>
		<?php echo $form->error($model,'DIRECCION'); ?>
	</div>

	<div class="row">
    	<?php echo $form->labelEx($model,'TELEFONO1'); ?>
		<?php echo CHtml::textField('INDICATIVO1', '',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->textField($model,'TELEFONO1',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'TELEFONO1'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TELEFONO2'); ?>
        <?php echo CHtml::textField('INDICATIVO2', '',array('size'=>3,'maxlength'=>3)); ?>
		<?php echo $form->textField($model,'TELEFONO2',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'TELEFONO2'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'LOGO'); ?>
		<?php //echo $form->fileField($model,'LOGO'); ?>
		<?php //echo $form->error($model,'LOGO'); ?>
	</div>

	<div class="form-actions">
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model->isNewRecord ? 'Crear' : 'Guardar')); ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Cancelar', 'size'=>'small',	'url' => array('compania/admin'), 'icon' => 'remove'));  ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->