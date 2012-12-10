<script>
    
 function selecionGrilla(grid_id){
     var seleccion = $.fn.yiiGridView.getSelection(grid_id);
     
     $('#seleccion').val(seleccion);
 }
 
 function completado(){
     setTimeout(function(){
         $(".alert").slideUp('slow');
         $('#seleccion').val('');
     }, 10000);
     $.fn.yiiGridView.update('documento-inv-grid');
     
 }
</script>

<?php
if(!ConfCi::darConf())
     $this->redirect(array('/confCi/create'));
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Documentos'
);

?>

<h1>Documentos</h1>
<br>
<div id="repuesta"></div>
<div align="right">

    <?php
           
            $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array());

            echo CHtml::hiddenField('seleccion');
            
            $this->widget('bootstrap.widgets.BootButton', array(
                    'buttonType'=>'ajaxSubmit',
                    'label'=>'Aprobar',
                    'size'=>'mini', 
                    'icon' => 'ok',
                    'url'=>array('aprobar'),
                    'ajaxOptions'=>array(
                        'type'=>'POST',
                        'update'=>'#repuesta',
                        'complete'=>'completado()',
                    ),
                    'htmlOptions'=>array('id'=>'aprobar'),
            )); 

    ?>
    <?php 

            $this->widget('bootstrap.widgets.BootButton', array(
                    'buttonType'=>'ajaxSubmit',
                    'label'=>'Rev. Aprovación',
                    'type'=>'danger', 
                    'size'=>'mini', 
                    'icon' => 'arrow-left white',
                    'url'=>array('cancelar'),
                    'ajaxOptions'=>array(
                        'type'=>'POST',
                        'update'=>'#repuesta',
                        'complete'=>'completado()',
                    ),
                    'htmlOptions'=>array('id'=>'cancelar'),
            )); 

    ?>
    <?php 

            $this->widget('bootstrap.widgets.BootButton', array(
                    'buttonType'=>'ajaxSubmit',
                    'label'=>'Aplicar',
                    'type'=>'info', 
                    'size'=>'mini', 
                    'icon' => 'share-alt white',
                    'url'=>array('aplicar'),
                    'ajaxOptions'=>array(
                        'type'=>'POST',
                        'update'=>'#repuesta',
                        'complete'=>'completado()',
                    ),
                    'htmlOptions'=>array('id'=>'aplicar'),
            )); 
            
    ?>
    
    <?php 

            $this->widget('bootstrap.widgets.BootButton', array(
                    'label'=>'Nuevo',
                    'type'=>'success', 
                    'size'=>'mini', 
                    'icon' => 'plus white',
                    'url'=>array('create')
            )); 
            $this->endWidget(); 
    ?>
</div>

<?php 
    $this->widget('bootstrap.widgets.BootGridView', array(
        'type'=>'striped bordered condensed',
	'id'=>'documento-inv-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'selectableRows'=>2,
        'selectionChanged'=>'selecionGrilla',
	'columns'=>array(
                array(
                    'class'=>'CCheckBoxColumn'
                ),
		'DOCUMENTO_INV',
                array(
                    'name'=>'CONSECUTIVO',
                    'value'=>'ConsecutivoCi::darNombre($data->CONSECUTIVO)',
                    'filter'=>CHtml::ListData(ConsecutivoCi::model()->findAll(),'ID','DESCRIPCION')
                ),
		'FECHA_DOCUMENTO',
		'REFERENCIA',
                array(
                    'name'=>'ESTADO',
                    'value'=>'DocumentoInv::darEstado($data->ESTADO)',
                    'filter'=>array('P'=>'Pendiente','A'=>'Aprobado','L'=>'Aplicado','C'=>'Cancelado')
                ),
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
                        'template'=>'{update}'
		),
	),
    ));
?>
