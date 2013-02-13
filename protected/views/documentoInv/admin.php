<script>
    
 function selecionGrilla(grid_id){
     var seleccion = $.fn.yiiGridView.getSelection(grid_id);
     
     $('#seleccion').val(seleccion);
 }
 
 function completado(){
     setTimeout(function(){
         $(".alert").slideUp('slow');
         $('#seleccion').val('');
     }, 15000);
     $.fn.yiiGridView.update('documento-inv-grid');
     
 }
</script>

<?php $this->pageTitle=Yii::app()->name." - Documentos";?>
<?php
if(!ConfCi::darConf())
     $this->redirect(array('/confCi/create'));
$this->breadcrumbs=array(
	'Inventario'=>array('admin'),
	'Documentos'
);

?>

<h1>Documentos</h1>
<?php 
if (isset($_GET['men'])){
    $this->mensaje($_GET['men']);
}
?>
<div id="repuesta"></div>
<div align="right">

    <?php
           
            $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array());

            echo CHtml::hiddenField('seleccion');
            
            $this->widget('bootstrap.widgets.TbButton', array(
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

            $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType'=>'ajaxSubmit',
                    'label'=>'Rev. Aprobación',
                    'type'=>'inverse', 
                    'size'=>'mini', 
                    'icon' => 'arrow-left white',
                    'url'=>array('reversar'),
                    'ajaxOptions'=>array(
                        'type'=>'POST',
                        'update'=>'#repuesta',
                        'complete'=>'completado()',
                    ),
                    'htmlOptions'=>array('id'=>'reversar','confirm'=>'¿Desea Reversar Documento(s) Seleccionado(s)?'),
            )); 

    ?>
    <?php 

            $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType'=>'ajaxSubmit',
                    'label'=>'Cancelar',
                    'type'=>'danger', 
                    'size'=>'mini', 
                    'icon' => 'remove white',
                    'url'=>array('cancelar'),
                    'ajaxOptions'=>array(
                        'type'=>'POST',
                        'update'=>'#repuesta',
                        'complete'=>'completado()',
                    ),
                    'htmlOptions'=>array('id'=>'cancelar','confirm'=>'¿Desea Cancelar Documento(s) Seleccionado(s)?'),
            )); 

    ?>
    <?php 

            $this->widget('bootstrap.widgets.TbButton', array(
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
            $this->darBotonNuevo(array('create'),false,'mini');
            $this->endWidget(); 
    ?>
</div>

<?php 
    $this->widget('bootstrap.widgets.TbGridView', array(
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
			'class'=>'bootstrap.widgets.TbButtonColumn',
                        'template'=>'{update}'
		),
             array(
                         'class'=>'CLinkColumn',
			 'imageUrl'=>Yii::app()->baseUrl.'/images/pdf.png',
			 'urlExpression'=>'Yii::app()->getController()->createUrl("/documentoInv/formatoPDF", array("id"=>$data->DOCUMENTO_INV))',
			 'htmlOptions'=>array('style'=>'text-align:center;'),
			 'linkHtmlOptions'=>array('style'=>'text-align:center','rel'=>'tooltip', 'data-original-title'=>'PDF', 'target'=>'_blank'),
                ),
	),
    ));
?>
