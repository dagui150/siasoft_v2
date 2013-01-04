<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm', array(
	'id'=>'existencia-bodegas-form',
        'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

    <?php       
            //Consecutivo
    /*
            if($model->ORDEN_COMPRA == ''){
                $mascara = $config->ULT_ORDEN_COMPRA_M;
                $retorna = substr($mascara,0,2);
                $mascara = strlen($mascara);
                $longitud = $mascara - 2;
                $sql = "SELECT count(ORDEN_COMPRA) FROM orden_compra";
                $consulta = OrdenCompra::model()->findAllBySql($sql);
                $connection=Yii::app()->db;
                $command=$connection->createCommand($sql);
                $row=$command->queryRow();
                $bandera=$row['count(ORDEN_COMPRA)'];
                $retorna .= str_pad($bandera, $longitud, "0", STR_PAD_LEFT);
              
                $pestana = $this->renderPartial('lineas', array('form'=>$form, 'linea'=>$linea, 'model'=>$model),true);
            }
            else{
     * 
     */
                $this->renderPartial('lineas', array('form'=>$form, 'model'=>$model),true);
                
                
          //  }
    ?>

	<?php echo $form->errorSummary($model); ?>

	<div align="center">
            <?php $this->widget('bootstrap.widgets.BootButton', array('buttonType'=>'submit', 'type'=>'primary', 'icon'=>'ok-circle white', 'size' =>'small', 'label'=>$model->isNewRecord ? 'Crear' : 'Guardar')); ?>
            <?php $this->widget('bootstrap.widgets.BootButton', array('label'=>'Cancelar', 'size'=>'small',	'url' => array('solicitudOc/admin'), 'icon' => 'remove'));  ?>
	</div>

<?php $this->endWidget(); ?>
    
     <?php 
    $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'articulo')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
          <?php 
                    $funcion = 'cargaArticuloGrilla';
                    $id = 'articulo-grid';
                    $data=$articulo->search();
                    $data->pagination = array('pageSize'=>4);
                    echo $this->renderPartial('/articulo/articulos', array('articulo'=>$articulo,'funcion'=>$funcion,'id'=>$id,'data'=>$data,'check'=>false));
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
    
 <?php 
    $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'articulo2')); ?>
 
	<div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
          <?php 
            $this->widget('bootstrap.widgets.BootGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>'articulo-grid2',
            'template'=>"{items} {pager}",
            'dataProvider'=>$articulo->search(),
            'selectionChanged'=>'cargaArticuloGrilla2',
            'filter'=>$articulo,
            'columns'=>array(
                array(  'name'=>'ARTICULO',
                        'header'=>'Código Artículo',
                        'htmlOptions'=>array('data-dismiss'=>'modal'),
                        'type'=>'raw',
                        'value'=>'CHtml::link($data->ARTICULO,"#")'
                    ),
                    'NOMBRE',
                    'TIPO_ARTICULO',
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
 
<?php $this->endWidget(); ?>
    
<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'lineas')); ?>
    <div class="modal-body">
                <a class="close" data-dismiss="modal">&times;</a>
                <br>
                <?php 
            $this->widget('bootstrap.widgets.BootGridView', array(
            'type'=>'striped bordered condensed',
            'id'=>'lineas-grid',
            'selectableRows'=>2,
            'selectionChanged'=>'obtenerSeleccion',
            'template'=>"{items} {pager}",
            'dataProvider'=>$solicitudLinea->search2(),
            'filter'=>$solicitudLinea,
            'columns'=>array(
                array('class'=>'CCheckBoxColumn'),
                array(  'name'=>'SOLICITUD_OC_LINEA',
                        'header'=>'Código Solicitud'),
                    'SOLICITUD_OC',
                    array('name' => 'ARTICULO', 'value'=>'$data->aRTICULO->NOMBRE'),
                    'FECHA_REQUERIDA',

            ),
    ));
             ?>
	</div>
        <div class="modal-footer">
        <?php $this->widget('bootstrap.widgets.BootButton', array(
                'label'=>'Cargar Líneas',
                'url'=>'#',
                'htmlOptions'=>array('data-dismiss'=>'modal', 'onclick' => 'cargaSolicitud()'),
            )); ?>
        </div>
    <?php $this->endWidget(); ?>
    <?php echo CHtml::HiddenField('check',''); ?>
    <?php echo CHtml::HiddenField('contador', '0'); ?>
    <?php echo CHtml::hiddenField('oculto', ''); ?>
    <?php echo CHtml::hiddenField('afecta', $config->IMP1_AFECTA_DESCTO); ?>
    <?php echo CHtml::hiddenField('numLineas', $config->MAXIMO_LINORDEN); ?>    
</div><!-- form -->