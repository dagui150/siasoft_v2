<?php    
    Yii::app()->clientScript->registerScript('search', "
    $('#reportes-form').submit(function(){
            
            $('html,body').animate({scrollTop:'800px'}, 'slow');
            
            $('#grilla').slideDown('slow');
            
            $.fn.yiiGridView.update('ventas-grid', {
                    data: $(this).serialize()
            });
            
            return false;
    });
    ");
?>
<div class="form">

<?php $form= $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'reportes-form',
        'method'=>'get',
	'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

    <?php switch ($tipo){
        case 'ventas': ?>
    
            <br />
                <div class="well form "style="margin-top: 10px;-webkit-box-shadow: #666 0px 0px 10px;-moz-box-shadow: #666 0px 0px 10px;box-shadow: #666 0px 0px 10px;">
                    <p class="text-info"><i>* Para crear un reporte general, solo dar clic en el botón "Generar".</i></p>

                    <table>
                    <tr>
                        <td>
                            <div style="margin-left: -30px">
                                <label for="FECHA" class="control-label">Fecha - Desde</label>
                                <div class="controls">
                                    <?php echo $this->darCalendario($model, 'fecha_desde'); ?>
                                </div>
                                   <br />
                                <label for="FECHA_2" class="control-label">Fecha - Hasta</label>
                                <div class="controls">
                                    <?php echo $this->darCalendario($model, 'fecha_hasta'); ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div style="margin-left: -70px">
                                <?php echo $form->dropDownListRow($model,'bodegas',CHtml::listData(Bodega::model()->findAllByAttributes(array('ACTIVO'=>'S')),'ID','DESCRIPCION'),array('empty'=>'Todas')); ?>
                                <?php echo $form->dropDownListRow($model,'clientes',CHtml::listData(Cliente::model()->findAllByAttributes(array('ACTIVO'=>'S')),'CLIENTE','NOMBRE'),array('empty'=>'Todos')); ?>
                            </div>
                            
                        </td>
                    </tr>
                    </table>

                    <div class="row-buttons" align="center">
                       <div class="buttons" align="center">
                            <?php $this->widget('bootstrap.widgets.TbButton', array(
                                            'type'=>'submit',
                                            'buttonType'=>'submit',
                                            'icon'=>'search',
                                            'label'=>'Consultar',
                                 )); 
                            ?>
                    </div>
                    </div>
                </div>
    
    
            <?php break;
        case 'otro': ?>
            <?php break;
    } ?>
        
		


<?php $this->endWidget(); ?>

</div><!-- form -->
               
<div id="grilla" style="display: none">
    
    <div style="float: right; margin-bottom: 10px;">
        <?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl.'/images/pdfReportes.png'),array(),array('target'=>'_blank','rel'=>'tooltip', 'data-original-title'=>'Exportar PDF')); ?>
    </div>
    <?php 
        $this->widget('bootstrap.widgets.TbGridView', array(
		'type'=>'striped bordered condensed',
                'id'=>'ventas-grid',
                'pagerCssClass' =>'pagination',
                //'pager' => array('class'=>'BootPager'),
		'dataProvider'=>$ventas,
                'columns'=>array(
                    
                    array(
                        'name'=>'FACTURA',                        
                    ),
                    array(
                        'name'=>'BODEGA',
                        'value'=>'$data->bODEGA->DESCRIPCION',
                    ),
                    array(
                        'name'=>'CLIENTE',
                        'value'=>'$data->cLIENTE->NOMBRE',
                    ),
                    array(
                        'name'=>'TOTAL_A_FACTURAR',                        
                    ),
                    array(
                        'name'=>'FECHA_FACTURA',                        
                    ),                    
                    array(
                        'name'=>'NIVEL_PRECIO',   
                        'value'=>'$data->nIVELPRECIO->DESCRIPCION',
                    ),
		),
	));
        
    ?>
    <div id="respuesta"></div>
</div>