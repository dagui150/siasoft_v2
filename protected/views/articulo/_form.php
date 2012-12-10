<script>
    function updateBodega(grid_id){
        var id=$.fn.yiiGridView.getSelection(grid_id);
        
        $.getJSON(
            '<?php echo $this->createUrl('bodega/cargarbodega'); ?>&id='+id,
            function(data){
                $('#Articulo_BODEGA').val(data.ID);
                $('#BODEGA2').val(data.DESCRIPCION);

            }
        );
    }
    
    function updateImpuesto(grid_id){
        var id=$.fn.yiiGridView.getSelection(grid_id);
        
        $.getJSON(
            '<?php echo $this->createUrl('impuesto/cargarimpuesto'); ?>&id='+id,
            function(data){
                $('#Articulo_IMPUESTO_COMPRA').val(data.ID);
                $('#IMPUESTO2').val(data.NOMBRE);

            }
        );
    }
    
    function updateImpuesto2(grid_id){
        var id=$.fn.yiiGridView.getSelection(grid_id);
        
        $.getJSON(
            '<?php echo $this->createUrl('impuesto/cargarimpuesto'); ?>&id='+id,
            function(data){
                $('#Articulo_IMPUESTO_VENTA').val(data.ID);
                $('#IMPUESTO3').val(data.NOMBRE);

            }
        );
    }
    
    function updateRetencion(grid_id){
        var id=$.fn.yiiGridView.getSelection(grid_id);
        
        $.getJSON(
            '<?php echo $this->createUrl('retencion/cargarretencion'); ?>&id='+id,
            function(data){
                $('#Articulo_RETENCION_VENTA').val(data.ID);
                $('#RETENCION2').val(data.NOMBRE);

            }
        );
    }
    function updateRetencion2(grid_id){
        var id=$.fn.yiiGridView.getSelection(grid_id);
        
        $.getJSON(
            '<?php echo $this->createUrl('retencion/cargarretencion'); ?>&id='+id,
            function(data){
                $('#Articulo_RETENCION_COMPRA').val(data.ID);
                $('#RETENCION3').val(data.NOMBRE);

            }
        );
    }   
</script>

<div class="form">

<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'articulo-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>true,
	),
	'type'=>'horizontal',
)); ?>

    <br>
	<?php /*echo $form->errorSummary(array($model,$adi));*/?>
        <table>
            <tr>
                <td >
                    <div align="left" style="width: 120px;;">
                        <?php echo $form->textFieldRow($model,'ARTICULO',array('maxlength'=>20));?>
                    </div>
                </td>
                <td>
                    <div align="left" style="width: 230px;">
                        <?php echo $form->textFieldRow($model,'NOMBRE',array('maxlength'=>128)); ?>
                    </div>
                </td>
            </tr>
           
        </table>   
        <?php    
        
            $boton = $this->widget('bootstrap.widgets.BootButton', array(
                'type'=>'info',
                'size'=>'mini',
                'url'=>'#bodega',
                'icon'=>'search',
                'htmlOptions'=>array('data-toggle'=>'modal',),
            ),true);
            
            $boton2 = $this->widget('bootstrap.widgets.BootButton', array(
                'type'=>'info',
                'size'=>'mini',
                'url'=>'#impuesto',
                'icon'=>'search',
                'htmlOptions'=>array('data-toggle'=>'modal',),
            ),true);
            
            $boton3 = $this->widget('bootstrap.widgets.BootButton', array(
                'type'=>'info',
                'size'=>'mini',
                'url'=>'#impuesto2',
                'icon'=>'search',
                'htmlOptions'=>array('data-toggle'=>'modal',),
            ),true);
            
            $boton4 = $this->widget('bootstrap.widgets.BootButton', array(
                'type'=>'info',
                'size'=>'mini',
                'url'=>'#retencion',
                'icon'=>'search',
                'htmlOptions'=>array('data-toggle'=>'modal',),
            ),true);
            $boton5 = $this->widget('bootstrap.widgets.BootButton', array(
                'type'=>'info',
                'size'=>'mini',
                'url'=>'#retencion2',
                'icon'=>'search',
                'htmlOptions'=>array('data-toggle'=>'modal',),
            ),true);
            
            $clas = ClasificacionAdi::model()->findAll();
            
            $this->widget('bootstrap.widgets.BootTabbable', array(
                'type'=>'tabs', // 'tabs' or 'pills'
                'tabs'=>array(
                    array(
                        'label'=>'General',
                        'content'=>'
                            <table>
                                <tr>
                                    <td>
                                        <fieldset style="width: 380px; height: 220px;"><br><br><br>
                                            <legend ><font face="arial" size=3 >Tipo de Articulo</font></legend>'
                                            .$form->dropDownListRow($model,'TIPO_ARTICULO',  CHtml::listData(TipoArticulo::model()->findAll(),'ID','NOMBRE'),array('empty'=>'Seleccione'))
                                            .$form->checkBoxRow($model,'ACTIVO',array('value'=>'S'))
                                        .'<br><br></fieldset>
                                    </td>
                                    <td>
                                        <fieldset style="width: 380px;">
                                            <legend ><font face="arial" size=3 >Existencias</font></legend>'
                                                  .$form->textFieldRow($model,'EXISTENCIA_MINIMA',array('maxlength'=>28))
                                                  .$form->textFieldRow($model,'PUNTO_REORDEN',array('maxlength'=>28))
                                                  .$form->textFieldRow($model,'EXISTENCIA_MAXIMA',array('maxlength'=>28))
                                        .'</fieldset>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <fieldset style="width: 380px;">
                                            <legend ><font face="arial" size=3 >Codigo de Barras Unidad detalle</font></legend>'
                                            .$form->dropDownListRow($model,'TIPO_COD_BARRAS',$tipo,array('empty'=>'Ninguno','disabled'=>$conf->USA_CODIGO_BARRAS ? false : true,'maxlength'=>10))
                                            .$form->textFieldRow($model,'CODIGO_BARRAS',array('disabled'=>$conf->USA_CODIGO_BARRAS ? false : true,'maxlength'=>20))
                                        .'</fieldset>
                                    </td>
                                    <td>
                                        <fieldset style="width: 380px; height: 163px;">
                                            <legend ><font face="arial" size=3 >Costos</font></legend>'
                                             .$form->dropDownListRow($model,'COSTO_FISCAL',MetodoValuacionInv::getMetodo(),array('empty'=>'Seleccione','options'=>array($conf->COSTO_FISCAL=>array('selected'=>'selected'))))
                                        .'</fieldset>
                                    </td>
                                </tr>
                            </table>',
                            'active'=>true
                    ),
                    array(
                        'label'=>'Clasificacion',
                        'content'=>
                            $this->renderPartial('clasificaciones',
                                            array(
                                                'form'=>$form,
                                                'model'=>$model
                                            ),true
                                 )
                        .'<table cellpading="2">
                                
                                <tr>
                                    <td>
                                        <fieldset style="width: 380px;  height: 90px;">
                                            <legend><font face="arial" size=3 >Origen</font></legend>'
                                            .$form->radioButtonListInlineRow($model,'ORIGEN_CORP',array('T'=>'Tercero','C'=>'Propio'))
                                        .'</fieldset>
                                    </td>
                                    <td>
                                        <fieldset style="width: 380px; height: 90px;">
                                            <legend><font face="arial" size=3 >Clase</font></legend>'
                                             .$form->radioButtonListInlineRow($model,'CLASE_ABC',array('A'=>'A','B'=>'B','C'=>'C','D'=>'D',))
                                        .'</fieldset>
                                    </td>
                                </tr>
                            </table>',
                        
                    ),
                    array(
                        'label'=>'Datos de Compra',
                        'content'=>''
                            .$form->textFieldRow($model,'DESCRIPCION_COMPRA',array('maxlength'=>128))
                            .'<table>
                                <tr>
                                    <td>'.$form->textFieldRow($model,'IMPUESTO_COMPRA',array('size'=>4,'ajax'=>array('type' => 'POST','url' => CController::createUrl('Articulo/cargarAjax'),'update' => '#IMPUESTOO'))).'</td> 
                                    <td><div id="IMPUESTOO" style="margin: 0 0 0 -540px">'.CHtml::textField('IMPUESTO2','',array('disabled'=>true)).'</div></td> 
                                    <td><div style="margin: 5px 0 0 -398px">'.$boton2.'</div></td> 
                               </tr>
                               <tr>
                                    <td>'.$form->textFieldRow($model,'BODEGA',array('size'=>4,'ajax'=>array('type' => 'POST','url' => CController::createUrl('Articulo/cargarAjax2'),'update' => '#BODEGAA'))).'</td> 
                                    <td><div id="BODEGAA" style="margin: 0 0 0 -540px">'.CHtml::textField('BODEGA2','',array('disabled'=>true)).'</div></td> 
                                    <td><div style="margin: 5px 0 0 -398px">'.$boton.'</div></td> 
                               </tr>
                               <tr>
                                    <td>'.$form->textFieldRow($model,'RETENCION_COMPRA',array('size'=>4,'ajax'=>array('type' => 'POST','url' => CController::createUrl('Articulo/cargarAjax5'),'update' => '#RETENCIOON2'))).'</td> 
                                    <td><div id="RETENCIOON2" style="margin: 0 0 0 -540px">'.CHtml::textField('RETENCION3','',array('disabled'=>true)).'</div></td> 
                                    <td><div style="margin: 5px 0 0 -398px">'.$boton5.'</div></td> 
                               </tr>
                             </table>'
                            .' <fieldset style="width: 380px; height: 90px;">
                                      <legend><font face="arial" size=3 >Impuesto 1 Afecta Costos</font></legend>'
                                     .$form->radioButtonListInlineRow($model,'IMP1_AFECTA_COSTO',array('S'=>'Si','N'=>'No'))
                            .'</fieldset>'
                                 
                        ,
                    ),
                    array(
                        'label'=>'Otros',
                        'content'=>'
                            <table>
                               <tr>
                                     <td colspan="2">'.$form->textFieldRow($model,'FRECUENCIA_CONTEO',array('size'=>6,'append'=>'Dias')).' </td> 
                               </tr>
                               <tr>
                                   <td>
                                       <br><fieldset >
                                           <table>
                                               <tr>
                                                    <td>'.$form->textFieldRow($model,'PESO_NETO',array('size'=>6)).'</td> 
                                                    <td><div style="margin: 0px 0 0 -125px">'.$form->dropDownList($model,'PESO_NETO_UNIDAD',UnidadMedida::getPeso(),array('empty'=>'--UND--')).'</div></td> 
                                               </tr>
                                               <tr>
                                                    <td>'.$form->textFieldRow($model,'PESO_BRUTO',array('size'=>6)).'</td> 
                                                    <td><div style="margin: 0px 0 0 -125px">'.$form->dropDownList($model,'PESO_BRUTO_UNIDAD',UnidadMedida::getPeso(),array('empty'=>'--UND--')).'</div></td> 
                                               </tr>
                                               <tr>
                                                    <td>'.$form->textFieldRow($model,'VOLUMEN',array('size'=>6)).'</td> 
                                                    <td><div style="margin: 0px 0 0 -125px  ">'.$form->dropDownList($model,'VOLUMEN_UNIDAD',UnidadMedida::getVolumen(),array('empty'=>'--UND--')).'</div></td> 
                                               </tr>
                                          </table>
                                      </fieldset>
                                   </td>
                                   <td>
                                       <fieldset  style="width: 280px; height: 229px;">
                                       <legend ><font face="arial" size=3 >Unidades</font></legend>
                                           <table>
                                               <tr>
                                                    <td>'.$form->dropDownListRow($model,'UNIDAD_ALMACEN',UnidadMedida::getUnidad(),array('empty'=>'Seleccione')).'</td> 
                                                    <td><br><strong>Conversión*</strong></td> 
                                               </tr>
                                               <tr>
                                                    <td>'.$form->dropDownListRow($model,'UNIDAD_EMPAQUE',UnidadMedida::getUnidad(),array('empty'=>'Seleccione')).'</td> 
                                                    <td>'.$form->textField($model,'FACTOR_EMPAQUE',array('size'=>6)).'</td>
                                                   
                                               </tr>
                                               <tr>
                                                    <td>'.$form->dropDownListRow($model,'UNIDAD_VENTA',UnidadMedida::getUnidad(),array('empty'=>'Seleccione')).'</td>  
                                                    <td>'.$form->textField($model,'FACTOR_VENTA',array('size'=>6)).'</td>  
                                                    
                                               </tr>
                                          </table>
                                      </fieldset>
                                   </td>
                               </tr>
                               <tr>
                                    <td colspan="2">
                                        <table>
                                            <tr>
                                                <td>'.$form->textFieldRow($model,'IMPUESTO_VENTA',array('size'=>4,'ajax'=>array('type' => 'POST','url' => CController::createUrl('Articulo/cargarAjax3'),'update' => '#IMPUESTOO2'))).'</td> 
                                                <td><div id="IMPUESTOO2" style="margin: 0 0 0 -550px">'.CHtml::textField('IMPUESTO3','',array('disabled'=>true)).'</div></td> 
                                                <td><div style="margin: 5px 0 0 -405px">'.$boton3.'</div></td> 
                                            </tr>
                                        </table>
                                    </td>
                               </tr>
                               <tr>
                                    <td colspan="2">
                                        <table>
                                            <tr>
                                                <td>'.$form->textFieldRow($model,'RETENCION_VENTA',array('size'=>4,'ajax'=>array('type' => 'POST','url' => CController::createUrl('Articulo/cargarAjax4'),'update' => '#RETENCIOON'))).'</td> 
                                                <td><div id="RETENCIOON" style="margin: 0 0 0 -550px">'.CHtml::textField('RETENCION2','',array('disabled'=>true)).'</div></td> 
                                                <td><div style="margin: 5px 0 0 -405px">'.$boton4.'</div></td> 
                                            </tr>
                                        </table>
                                    </td>
                               </tr>
                               <tr>
                                    <td colspan=2>'
                                        .$form->textAreaRow($model,'NOTAS',array('rows'=>5, 'style'=>'width: 602px; height: 170px;'))
                                    .'</td>
                               </tr>
                           </table>'
                        ,
                    ),
                ),
            )); ?>
            
    
	<div align="center"> 
		<?php 
			$this->widget('bootstrap.widgets.BootButton', array(
						'label'=>'Crear',
						'buttonType'=>'submit',
						'type'=>'primary',
						'icon'=>'ok-circle white',
					)
			);
		?>
		<?php
			$this->widget('bootstrap.widgets.BootButton', array(
						'label'=>'Cancelar',
						'type'=>'action',
						'icon'=>'remove', 
						'url'=>array('admin'), 
					)
			);
			
		?>
	</div>
        
    
<?php $this->endWidget(); ?>
    
<?php 
    $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'bodega')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
		<?php 
                    $this->widget('bootstrap.widgets.BootGridView', array(
                             'type'=>'striped bordered condensed',
                             'id'=>'bodega-grid',
                             'template'=>"{items}{pager}",
                             'dataProvider'=>$bodega->search(),
                             'filter'=>$bodega,
                             'selectionChanged'=>'updateBodega',
                             'columns'=>array(
                                   array(
                                        'type'=>'raw',
                                        'name'=>'ID',
                                        'header'=>'Codigo Bodega',
                                        'value'=>'CHtml::link($data->ID,"#")',
                                        'htmlOptions'=>array('data-dismiss'=>'modal'),
                                   ),
                                   'DESCRIPCION',
                                   'TIPO',
                                   'TELEFONO',
                                   'DIRECCION',
                             ),
                  ));
             ?>
	</div>
        <div class="modal-footer">

            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Cerrar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
    
<?php $this->endWidget(); 

    $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'impuesto')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
		<?php 
                    
                    $funcion = 'updateImpuesto';
                    $id = 'impuesto-grid';
                    echo $this->renderPartial('impuesto', array('impuesto'=>$impuesto,'funcion'=>$funcion,'id'=>$id));
                ?>
	</div>
        <div class="modal-footer">

            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Cerrar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
 
<?php
    $this->endWidget();
    
    $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'impuesto2')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
		<?php 
                    $funcion = 'updateImpuesto2';
                    $id = 'impuesto-grid2';
                    echo $this->renderPartial('impuesto', array('impuesto'=>$impuesto,'funcion'=>$funcion,'id'=>$id));
                ?>
	</div>
        <div class="modal-footer">

            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Cerrar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
 
<?php
    $this->endWidget(); 
    
    $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'retencion')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
		<?php 
                    
                    $funcion = 'updateRetencion';
                    $id = 'retencion-grid';
                    echo $this->renderPartial('retencion', array('retencion'=>$retencion,'funcion'=>$funcion,'id'=>$id));
                ?>
	</div>
        <div class="modal-footer">

            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Cerrar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
 
<?php $this->endWidget(); 
    
    $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'retencion2')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
		<?php
                    $funcion = 'updateRetencion2';
                    $id = 'retencion-grid2';
                    echo $this->renderPartial('retencion', array('retencion'=>$retencion,'funcion'=>$funcion,'id'=>$id));
                ?>
	</div>
        <div class="modal-footer">

            <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Cerrar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
 
<?php $this->endWidget(); ?>
    
    
</div><!-- form -->