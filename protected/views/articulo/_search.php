<div class="wide form">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
        'type'=>'horizontal',
)); ?>

	<div class="modal-body">
		<?php echo $form->textFieldRow($model,'ARTICULO',array('maxlength'=>20)); ?>
	
		<?php echo $form->textFieldRow($model,'NOMBRE',array('maxlength'=>128)); ?>
	
		<?php echo $form->dropDownListRow($model,'ORIGEN_CORP',array('T'=>'Tercero','C'=>'Corporativo'),array('empty'=>'Seleccione')); ?>
	
		<?php //echo $form->dropDownListRow($model,'CLASE_ABC',array('A'=>'A','B'=>'B','C'=>'C','D'=>'D',),array('empty'=>'Seleccione')); ?>
	
		<?php echo $form->dropDownListRow($model,'TIPO_ARTICULO',CHtml::listData(TipoArticulo::model()->findAll(),'ID','NOMBRE'),array('empty'=>'Seleccione')); ?>
	
		<?php echo $form->textFieldRow($model,'EXISTENCIA_MINIMA',array('maxlength'=>28)); ?>

		<?php echo $form->textFieldRow($model,'EXISTENCIA_MAXIMA',array('maxlength'=>28)); ?>
	
		<?php echo $form->textFieldRow($model,'PUNTO_REORDEN',array('maxlength'=>28)); ?>
	
		<?php echo $form->dropDownListRow($model,'COSTO_FISCAL',  CHtml::listData(MetodoValuacionInv::model()->findAll(),'ID','ID'),array('empty'=>'Seleccione')); ?>
	
		<?php echo $form->dropDownListRow($model,'BODEGA',CHtml::listData(Bodega::model()->findAll(),'ID','DESCRIPCION'),array('empty'=>'Seleccione')); ?>
	
		<?php //echo $form->dropDownListRow($model,'IMP1_AFECTA_COSTO',array('S'=>'Si','N'=>'No'),array('empty'=>'Seleccione')); ?>
	
		<?php echo $form->dropDownListRow($model,'ACTIVO',array('S'=>'Si','0'=>'No'),array('empty'=>'Seleccione')); ?>
	</div>
    
        <div class="modal-footer">
            
                <?php 
                    $this->widget('bootstrap.widgets.BootButton', array(
				'label'=>'Buscar',
				'buttonType'=>'submit',
				'type'=>'primary',
				'icon'=>'search white',
                                'htmlOptions'=>array('onclick'=>'$(".close").click();')
			)
                    );
                ?>
            
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'label'=>'Cancelar',
			'url'=>'#',
			'icon'=>'remove',
			'htmlOptions'=>array('data-dismiss'=>'modal'),
		)); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->