<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'proveedor-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),	
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'PROVEEDOR'); ?>
		<?php echo $form->textField($model,'PROVEEDOR',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'PROVEEDOR'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CATEGORIA'); ?>
        <?php echo $form->dropDownList($model,'CATEGORIA', CHtml::listData(Categoria::model()->findAll(),'ID','DESCRIPCION'),array('empty'=>'Seleccione...')); ?>
		<?php echo $form->error($model,'CATEGORIA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NOMBRE'); ?>
		<?php echo $form->textField($model,'NOMBRE',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'NOMBRE'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ALIAS'); ?>
		<?php echo $form->textField($model,'ALIAS',array('size'=>60,'maxlength'=>80)); ?>
		<?php echo $form->error($model,'ALIAS'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CONTACTO'); ?>
		<?php echo $form->textField($model,'CONTACTO',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'CONTACTO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CARGO'); ?>
		<?php echo $form->textField($model,'CARGO',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'CARGO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DIRECCION'); ?>
		<?php echo $form->textArea($model,'DIRECCION',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'DIRECCION'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'EMAIL'); ?>
		<?php echo $form->textField($model,'EMAIL',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'EMAIL'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'FECHA_INGRESO'); ?>
		<?php
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		'name'=>'FECHA_INGRESO',
		//'language'=>Yii::app()->language=='et' ? 'et' : null,
		'options'=>array(
			'showAnim'=>'fadeIn', // 'show' (the default), 'slideDown', 'fadeIn', 'fold'
			'dateFormat'=>'yy-mm-dd',
			'changeMonth'=>true,
			'changeYear'=>true,
			'showOn'=>'both', // 'focus', 'button', 'both'
			'buttonText'=>Yii::t('ui','Select form calendar'), 
			'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.gif', 
			'buttonImageOnly'=>true,
		),
    'htmlOptions'=>array(
        'style'=>'width:80px;vertical-align:top'
    ),  
)); ?>
		<?php echo $form->error($model,'FECHA_INGRESO'); ?>
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
		<?php echo $form->labelEx($model,'FAX'); ?>
		<?php echo $form->textField($model,'FAX',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'FAX'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'NIT'); ?>
        <?php echo $form->dropDownList($model,'NIT', CHtml::listData(Nit::model()->findAll(),'ID','ID'),array('empty'=>'Seleccione...')); ?>
		<?php echo $form->error($model,'NIT'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'CONDICION_PAGO'); ?>
        <?php echo $form->dropDownList($model,'CONDICION_PAGO', CHtml::listData(CodicionPago::model()->findAll(),'ID','DESCRIPCION'),array('empty'=>'Seleccione...')); ?>
		<?php echo $form->error($model,'CONDICION_PAGO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ORDEN_MINIMA'); ?>
		<?php echo $form->textField($model,'ORDEN_MINIMA',array('size'=>28,'maxlength'=>28)); ?>
		<?php echo $form->error($model,'ORDEN_MINIMA'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'DESCUENTO'); ?>
		<?php echo $form->textField($model,'DESCUENTO',array('size'=>28,'maxlength'=>28)); ?>
		<?php echo $form->error($model,'DESCUENTO'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'TASA_INTERES_MORA'); ?>
		<?php echo $form->textField($model,'TASA_INTERES_MORA',array('size'=>28,'maxlength'=>28)); ?>
		<?php echo $form->error($model,'TASA_INTERES_MORA'); ?>
	</div>
    
    <div class="row">
		<?php
			echo CHtml::activeHiddenField($model,'ACTIVO',array('value'=>'S'));
			echo $form->error($model,'ACTIVO'); 
		?>
	</div>

	<div class="form-actions">
    	<?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model->isNewRecord ? 'Crear' : 'Guardar')); ?>
        <?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Cancelar', 'size'=>'small',	'url' => array('proveedor/admin'), 'icon' => 'remove'));  ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->