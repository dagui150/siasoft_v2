<script>
function updateCampos(grid_id){
    var buscar = $.fn.yiiGridView.getSelection(grid_id);
    
    $.getJSON(
        '<?php echo $this->createUrl('proveedor/CargarNit'); ?>&buscar='+buscar,
        function(data)
        {
            $('#EntidadFinanciera_NIT').val(data.ID);  
        }
    )
}
</script>
<?php Yii::import('application.extensions.bootstrap.widgets.*') ?>
<div class="form">
    <div>
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'entidad-financiera-form',
	'type' => 'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
        
    <?php $completar =  $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'model'=>$model2,
        'attribute'=>'NIT',
        'source'=>$this->createUrl('entidadFinanciera/autocompletar'),
        'htmlOptions'=>array(
            'size'=>'12',
            'class'=>'escritoNit'
        ),
    ), true); ?>
        
        <?php $modal = $this->widget('bootstrap.widgets.BootButton', array(
                          'type'=>'info',
                          'size'=>'mini',
                          'url'=>'#',
                          'icon'=>'search',
                          'htmlOptions'=>array('onclick'=>'$("#nit").dialog("open");return false;'),
                    ), true); ?>
        
<?php echo $form->errorSummary($model2); ?>
		<?php echo $form->textFieldRow($model2,'ID'); ?>
                <div class="control-group "><label for="EntidadFinanciera_NIT" class="control-label required">NIT <span class="required">*</span></label><div class="controls"><?php echo $completar; ?> <?php echo $modal; ?></div></div>
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
            
            <!-- Modal fea de Yiiman -->
<?php 
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
                'id'=>'nit',
                'options'=>array(
                    'title'=>'Nit',
                    'width'=>550,
                    'height'=>'auto',
                    'autoOpen'=>false,
                    'resizable'=>false,
                    'modal'=>true,
                    'zIndex'=>1200,
                    'overlay'=>array(
                        'backgroundColor'=>'#000',
                        'opacity'=>'0.5'
                    ),
                    'buttons'=>array(
                        'Aceptar'=>'js:function(){$(this).dialog("close");}',
                    ),
                ),
     )); 
            
            $funcion = 'updateCampos';
            $id = 'nit-grid';
            echo $this->renderPartial('/nit/modalNits', array('nit'=>$nit,'funcion'=>$funcion,'id'=>$id,'check'=>true));

   $this->endWidget('zii.widgets.jui.CJuiDialog');
?>

</div><!-- form -->