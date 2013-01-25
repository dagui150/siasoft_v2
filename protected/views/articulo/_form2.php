<script>
    $(document).ready(inicio);
    
    function inicio(){
        
        if($('#Articulo_COSTO_FISCAL').val() != 'Estándar')
            $('#estandar').slideUp('slow');
        else
            $('#estandar').slideDown('slow');
        
        $('#Articulo_COSTO_FISCAL').change(function(){
            if($(this).val() != 'Estándar'){
                $('#estandar').slideUp('slow');
                $('#Articulo_COSTO_ESTANDAR').attr('disabled',true);
             }else{
                $('#Articulo_COSTO_ESTANDAR').attr('disabled',false);
                $('#estandar').slideDown('slow');
            }
        });
    }
    
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

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'articulo-form',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
			'validateOnSubmit'=>true,
	),
	'type'=>'horizontal',
)); ?>

    <br />
        <table>
                <tr>
                    <td >
                        <div align="left" style="width: 120px;">
                            <?php echo $form->textFieldRow($model,'ARTICULO',array('maxlength'=>20));?>
                        </div>
                    </td>
                    <td>
                        <div align="left" style="width: 228px;">
                            <?php echo $form->textFieldRow($model,'NOMBRE',array('maxlength'=>128)); ?>
                        </div>
                    </td>
                </tr>

       </table>  
        <?php echo $form->errorSummary($model);?>
        <?php    
            
            $impuesto_compra =$model->IMPUESTO_COMPRA?$model->iMPUESTOCOMPRA->NOMBRE:'';
            $cbodega =$model->BODEGA?$model->bODEGA->DESCRIPCION:'';
            $retencion_compra =$model->RETENCION_COMPRA?$model->rETENCIONCOMPRA->NOMBRE:'';
            $impuesto_venta =$model->IMPUESTO_VENTA?$model->iMPUESTOVENTA->NOMBRE:'';
            $retencion_venta =$model->RETENCION_VENTA?$model->rETENCIONVENTA->NOMBRE:'';
            
                      
            $boton = $this->darBotonBuscar('#bodega',true);

            $boton2 = $this->darBotonBuscar('#impuesto',true);

            $boton3 = $this->darBotonBuscar('#impuesto2',true);

            $boton4 = $this->darBotonBuscar('#retencion',true);

            $boton5 = $this->darBotonBuscar('#retencion2',true);
            
            $clas = ClasificacionAdi::model()->findAll();
            
            $this->widget('bootstrap.widgets.TbTabs', array(
                'type'=>'tabs', // 'tabs' or 'pills'
                'tabs'=>array(
                    array(
                        'label'=>'General',
                        'content'=>'
                            <table>
                                <tr>
                                     <td>
                                        <fieldset style="width: 380px; height: 258px;"><br><br><br>
                                            <legend ><font face="arial" size=3 >Tipo de Artículo</font></legend>'
                                            .$form->dropDownListRow($model,'TIPO_ARTICULO',  CHtml::listData(TipoArticulo::model()->findAll(),'ID','NOMBRE'),array('empty'=>'Seleccione'))
                                            .$form->checkBoxRow($model,'ACTIVO',array('value'=>'S'))
                                        .'<br><br></fieldset>
                                    </td>
                                    <td>
                                        <fieldset style="width: 380px;">
                                            <legend ><font face="arial" size=3 >Existencias</font></legend>'
                                                  .$form->textFieldRow($model,'EXISTENCIA_MINIMA',array('maxlength'=>28,'class'=>'decimal'))
                                                  .$form->textFieldRow($model,'PUNTO_REORDEN',array('maxlength'=>28,'class'=>'decimal'))
                                                  .$form->textFieldRow($model,'EXISTENCIA_MAXIMA',array('maxlength'=>28,'class'=>'decimal'))
                                        .'</fieldset>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <fieldset style="width: 380px;">
                                            <legend ><font face="arial" size=3 >Código de Barras Unidad detalle</font></legend>'
                                            .$form->dropDownListRow($model,'TIPO_COD_BARRAS',$tipo,array('empty'=>'Ninguno','disabled'=>$conf->USA_CODIGO_BARRAS ? false : true,'maxlength'=>10))
                                            .$form->textFieldRow($model,'CODIGO_BARRAS',array('disabled'=>$conf->USA_CODIGO_BARRAS ? false : true,'maxlength'=>20))
                                        .'</fieldset>
                                    </td>
                                    <td>
                                        <fieldset style="width: 380px; height: 198px;">
                                            <legend ><font face="arial" size=3 >Costos</font></legend>'
                                             .$form->dropDownListRow($model,'COSTO_FISCAL',MetodoValuacionInv::getMetodo(),array('disabled'=>true,'empty'=>'Seleccione'))
                                                .$model->darCampocosto($model->COSTO_FISCAL,$form,$model,$conf)
                                            .'</fieldset>
                                    </td>
                                </tr>
                            </table>',
                            'active'=>true
                    ),
                    array(
                        'label'=>'Clasificación',
                        'content'=>
                        $this->renderPartial('clasificaciones',
                                            array(
                                                'form'=>$form,
                                                'lineas'=>$lineas,
                                                'model'=>$model
                                            ),true
                                 )
                        .'<table cellpading="2">
                                
                                <tr>
                                    <td>
                                        <fieldset style="width: 380px;  height: 111px;">
                                            <legend><font face="arial" size=3 >Origen</font></legend>'
                                            .$form->radioButtonListInlineRow($model,'ORIGEN_CORP',array('T'=>'Tercero','C'=>'Propio'))
                                        .'</fieldset>
                                    </td>
                                    <td>
                                        <fieldset style="width: 380px; height: 111px;">
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
                                    <td>'.$form->textFieldRow($model,'IMPUESTO_COMPRA',array('size'=>4,'ajax'=>array('type' => 'POST','url' => Yii::app()->getController()->createUrl('Articulo/cargarAjax'),'update' => '#IMPUESTOO'))).'</td> 
                                    <td><div id="IMPUESTOO" style="margin: 0 0 0 -538px">'.CHtml::textField('IMPUESTO2','',array('disabled'=>true)).'</div></td> 
                                    <td><div style="margin: 5px 0 0 -398px">'.$boton2.'</div></td> 
                               </tr>
                               <tr>
                                    <td>'.$form->textFieldRow($model,'BODEGA',array('size'=>4,'ajax'=>array('type' => 'POST','url' => Yii::app()->getController()->createUrl('Articulo/cargarAjax2'),'update' => '#BODEGAA'))).'</td> 
                                    <td><div id="BODEGAA" style="margin: 0 0 0 -538px">'.CHtml::textField('BODEGA2','',array('disabled'=>true)).'</div></td> 
                                    <td><div style="margin: 5px 0 0 -398px">'.$boton.'</div></td> 
                               </tr>
                               <tr>
                                    <td>'.$form->textFieldRow($model,'RETENCION_COMPRA',array('size'=>4,'ajax'=>array('type' => 'POST','url' => Yii::app()->getController()->createUrl('Articulo/cargarAjax5'),'update' => '#RETENCIOON2'))).'</td> 
                                    <td><div id="RETENCIOON2" style="margin: 0 0 0 -538px">'.CHtml::textField('RETENCION3','',array('disabled'=>true)).'</div></td> 
                                    <td><div style="margin: 5px 0 0 -398px">'.$boton5.'</div></td> 
                               </tr>
                             </table>'
                            .' <fieldset style="width: 380px; height: 110px;">
                                      <legend><font face="arial" size=3 >Impuesto 1 Afecta Costos</font></legend>'
                                     .$form->radioButtonListInlineRow($model,'IMP1_AFECTA_COSTO',array('S'=>'Si','N'=>'No'))
                            .'</fieldset>'
                                 
                        ,
                    ),
                    array(
                        'label'=>'Otros',
                        'content'=>
                            '<table>
                               <tr>
                                     <td>'.$form->textFieldRow($model,'FRECUENCIA_CONTEO',array('size'=>6,'append'=>'Dias')).' </td> 
                               </tr>
                               <tr>
                                   <td>
                                        <fieldset style="width: 380px; height: 284px;">
                                           <legend><font face="arial" size=3 >Unidades</font></legend>
                                           <table style="margin-left: -20px;">
                                               <tr>
                                                    <td width="10">'.$form->textFieldRow($model,'PESO_NETO',array('size'=>6,'onkeyup'=>'formato(this)', 'onchange'=>'formato(this)')).'</td> 
                                                    <td>'.$form->dropDownList($model,'PESO_NETO_UNIDAD',UnidadMedida::getPeso(),array('empty'=>'--UND--')).'</td> 
                                               </tr>
                                               <tr>
                                                    <td>'.$form->textFieldRow($model,'PESO_BRUTO',array('size'=>6,'onkeyup'=>'formato(this)', 'onchange'=>'formato(this)')).'</td> 
                                                    <td>'.$form->dropDownList($model,'PESO_BRUTO_UNIDAD',UnidadMedida::getPeso(),array('empty'=>'--UND--')).'</td> 
                                               </tr>
                                               <tr>
                                                    <td>'.$form->textFieldRow($model,'VOLUMEN',array('size'=>6,'onkeyup'=>'formato(this)', 'onchange'=>'formato(this)')).'</td> 
                                                    <td>'.$form->dropDownList($model,'VOLUMEN_UNIDAD',UnidadMedida::getVolumen(),array('empty'=>'--UND--')).'</td> 
                                               </tr>
                                          </table>
                                      </fieldset>
                                   </td>
                                   <td>
                                       <fieldset  style="width: 390px; height: 337px;">
                                       <legend ><font face="arial" size=3 >Unidades</font></legend>
                                           <table>
                                               <tr>
                                                    <td>'.$form->dropDownListRow($model,'UNIDAD_ALMACEN',UnidadMedida::getUnidad(),array('empty'=>'Seleccione')).'</td> 
                                                    <td><br><strong>Conversión*</strong></td> 
                                               </tr>
                                               <tr>
                                                    <td>'.$form->dropDownListRow($model,'UNIDAD_EMPAQUE',UnidadMedida::getUnidad(),array('empty'=>'Seleccione')).'</td> 
                                                    <td>'.$form->textField($model,'FACTOR_EMPAQUE',array('size'=>6,'onkeyup'=>'formato(this)', 'onchange'=>'formato(this)')).'</td>
                                                   
                                               </tr>
                                               <tr>
                                                    <td>'.$form->dropDownListRow($model,'UNIDAD_VENTA',UnidadMedida::getUnidad(),array('empty'=>'Seleccione')).'</td>  
                                                    <td>'.$form->textField($model,'FACTOR_VENTA',array('size'=>6,'onkeyup'=>'formato(this)', 'onchange'=>'formato(this)')).'</td>
                                                    
                                               </tr>
                                          </table>
                                      </fieldset>
                                   </td>
                               </tr>
                               <tr>
                                    <td colspan="2">
                                        <table>
                                            <tr>
                                                <td width="10">'.$form->textFieldRow($model,'IMPUESTO_VENTA',array('size'=>4,'ajax'=>array('type' => 'POST','url' => Yii::app()->getController()->createUrl('Articulo/cargarAjax3'),'update' => '#IMPUESTOO2'))).'</td> 
                                                <td><div id="IMPUESTOO2">'.CHtml::textField('IMPUESTO3',$impuesto_venta,array('disabled'=>true)).'</div></td> 
                                                <td><div style="margin: 5px 0 0 -390px">'.$boton3.'</div></td> 
                                            </tr>
                                        </table>
                                    </td>
                               </tr>
                               <tr>
                                    <td colspan="2">
                                        <table>
                                            <tr>
                                                <td>'.$form->textFieldRow($model,'RETENCION_VENTA',array('size'=>4,'ajax'=>array('type' => 'POST','url' => Yii::app()->getController()->createUrl('Articulo/cargarAjax4'),'update' => '#RETENCIOON'))).'</td> 
                                                <td><div id="RETENCIOON" style="margin: 0 0 0 -537px">'.CHtml::textField('RETENCION2',$retencion_venta,array('disabled'=>true)).'</div></td> 
                                                <td><div style="margin: 5px 0 0 -390px">'.$boton4.'</div></td> 
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
            ));
        ?>
    
	<div align="center"> 
		<?php 
                    $this->darBoton('submit', 'Crear', 'primary', 'normal','#','ok-circle white');
		?>
		<?php 
                    $this->darBoton('link', 'Cancelar', 'action', 'normal',array('admin'),'remove');
		?>
	</div>

<?php $this->endWidget(); ?>
    
<?php 
    $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'bodega')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
		<?php 
                    $funcion = 'updateBodega';
                    $id = 'bodega-grid';
                    $data=$bodega->search();
                    $data->pagination = array('pageSize'=>5);
                    $this->renderPartial('/bodega/bodegas', array('bodega'=>$bodega,'funcion'=>$funcion,'id'=>$id,'data'=>$data,'check'=>false));
             ?>
	</div>
        <div class="modal-footer">

            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Cerrar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
 
<?php $this->endWidget(); 

    $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'impuesto')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
		<?php 
                    
                    $funcion = 'updateImpuesto';
                    $id = 'impuesto-grid';
                    $data=$impuesto->search(); 
                    $data->pagination = array('pageSize'=>5);
                    echo $this->renderPartial('impuesto', array('impuesto'=>$impuesto,'funcion'=>$funcion,'id'=>$id,'data'=>$data));
                ?>
	</div>
        <div class="modal-footer">

            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Cerrar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
 
<?php
    $this->endWidget();
    
    $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'impuesto2')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
		<?php 
                    
                     $funcion = 'updateImpuesto2';
                    $id = 'impuesto-grid2';
                    $data=$impuesto->search(); 
                    $data->pagination = array('pageSize'=>5);
                    echo $this->renderPartial('impuesto', array('impuesto'=>$impuesto,'funcion'=>$funcion,'id'=>$id,'data'=>$data));
                ?>
	</div>
        <div class="modal-footer">

            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Cerrar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
 
<?php
    $this->endWidget(); 
    
    $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'retencion')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
		<?php 
                    
                    $funcion = 'updateRetencion';
                    $id = 'retencion-grid';
                    $data=$retencion->search();
                    $data->pagination = array('pageSize'=>5);
                    echo $this->renderPartial('retencion', array('retencion'=>$retencion,'funcion'=>$funcion,'id'=>$id,'data'=>$data));
                ?>
	</div>
        <div class="modal-footer">

            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Cerrar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
 
<?php $this->endWidget(); 
    
    $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'retencion2')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
		<?php
                    $funcion = 'updateRetencion2';
                    $id = 'retencion-grid2';
                    $data=$retencion->search();
                    $data->pagination = array('pageSize'=>5);
                    echo $this->renderPartial('retencion', array('retencion'=>$retencion,'funcion'=>$funcion,'id'=>$id,'data'=>$data));
                ?>
	</div>
        <div class="modal-footer">

            <?php $this->widget('bootstrap.widgets.TbButton', array(
                'label'=>'Cerrar',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal'),
            )); ?>
        </div>
 
<?php $this->endWidget(); ?>
    
    
</div><!-- form -->