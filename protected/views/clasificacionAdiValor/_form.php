<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'clasificacion-adi-valor-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>true,
	),
	'type'=>'horizontal',
)); ?>

	

	<?php echo $form->errorSummary($model2); ?>

	<div class="modal-body">

		<?php echo $form->dropDownListRow($model2,'CLASIFICACION',CHtml::ListData(ClasificacionAdi::model()->findAll(),'ID','NOMBRE'),array('empty'=>'Seleccione')); ?>

		<?php echo $form->textFieldRow($model2,'VALOR',array('maxlength'=>12)); ?>

	</div>

	<?php echo CHtml::activeHiddenField($model2,'ACTIVO',array('value'=>'S')); ?>

	<?php if($model2->isNewRecord): ?>
        <div class="modal-footer" align="center">
        <?php endif ?>

        <?php if(!$model2->isNewRecord): ?>
        <div class="row-buttons" align="center">
        <?php endif ?>
		<?php
			$this->widget('bootstrap.widgets.BootButton', array(
						'label'=>$model2->isNewRecord ? 'Crear' : 'Guardar',
						'buttonType'=>'submit',
						'type'=>'primary',
						'icon'=>'ok-circle white', 
					)
			);
		?>
            
                 <?php $this->widget('bootstrap.widgets.BootButton', array(
			'label'=>'Cancelar',
			'url'=>$model2->isNewRecord ? '#' : array('admin'),
			'icon'=>'remove',
			'htmlOptions'=>array('data-dismiss'=>'modal'),
		)); ?>
            
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->