<div class="form">
    <div>
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'dia-feriado-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

        <?php echo $form->errorSummary($model2); ?>
		<?php echo $form->dropDownListRow($model2, 'TIPO', array('F'=>'Fijo','V'=>'Variable')); ?>
		<?php echo $form->textFieldRow($model2,'ANIO'); ?>
		<?php echo $form->dropDownListRow($model2, 'MES', array(
		'01'=>'Enero',
		'02'=>'Febrero',
		'03'=>'Marzo',
		'04'=>'Abril',
		'05'=>'Mayo',
		'06'=>'Junio',
		'07'=>'Julio',
		'08'=>'Agosto',
		'09'=>'Septiembre',
		'10'=>'Octubre',
		'11'=>'Noviembre',
		'12'=>'Diciembre',
		)); ?>
		<?php echo $form->dropDownListRow($model2, 'DIA', array(
		'01'=>'01',
		'02'=>'02',
		'03'=>'03',
		'04'=>'04',
		'05'=>'05',
		'06'=>'06',
		'07'=>'07',
		'08'=>'08',
		'09'=>'09',
		'10'=>'10',
		'11'=>'11',
		'12'=>'12',
		'13'=>'13',
		'14'=>'14',
		'15'=>'15',
		'16'=>'16',
		'17'=>'17',
		'18'=>'18',
		'19'=>'19',
		'20'=>'20',
		'21'=>'21',
		'22'=>'22',
		'23'=>'23',
		'24'=>'24',
		'25'=>'25',
		'26'=>'26',
		'27'=>'27',
		'28'=>'28',
		'29'=>'29',
		'30'=>'30',
		'31'=>'31',
		)); ?>
		<?php echo $form->textAreaRow($model2,'DESCRIPCION'); ?>

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