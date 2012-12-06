<div class="form">

<?php 
	$form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
		'id'=>'clasificacion-form',
		'enableAjaxValidation'=>true,
		'clientOptions'=>array(
				'validateOnSubmit'=>true,
		),
		'type'=>'horizontal',
	)); 
	
	$conf=ConfCi::model()->find();
?>

	<?php echo $form->errorSummary($model2); ?>

	<div class="row">
		<?php echo $form->textFieldRow($model2,'ID',array('maxlength'=>4)); ?>

		<?php echo $form->textFieldRow($model2,'NOMBRE',array('maxlength'=>64)); ?>
		
		<?php echo $form->dropDownListRow($model2,'UNIDAD',CHtml::ListData(UnidadMedida::model()->findAll(),'ID','NOMBRE'),array('empty'=>'Seleccione')); ?>
		
		<?php echo $form->radioButtonListInlineRow($model2,'AGRUPACION',
						array(
							'1'=>$conf->NOMBRE_CLASIF_1,
							'2'=>$conf->NOMBRE_CLASIF_2,
							'3'=>$conf->NOMBRE_CLASIF_3,
							'4'=>$conf->NOMBRE_CLASIF_4,
							'5'=>$conf->NOMBRE_CLASIF_5,
							'6'=>$conf->NOMBRE_CLASIF_6,
						)
					);
		?>

	<div class="row">
		<?php echo CHtml::activeHiddenField($model2,'ACTIVO',array('value'=>'S')); ?>
		<?php echo $form->error($model2,'ACTIVO'); ?>
	</div>

	<div class="row buttons" align="center">
		<?php
			$this->widget('bootstrap.widgets.BootButton', array(
						'label'=>$model2->isNewRecord ? 'Crear' : 'Guardar',
						'buttonType'=>'submit',
						'type'=>'primary',
						'icon'=>'ok-circle white', 
					)
			);
		?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->