<script>
    $(document).ready(function(){
        inicio();
    });
    
    function inicio(){
        $(".detalle").click(function (e) {
            $('#myModal').modal();
        });
    }
    
    function obtenerSeleccion(){
        var idcategoria = $.fn.yiiGridView.getSelection('articulo-precio-grid');
        $('#check').val(idcategoria);
    }
</script>
<?php
$this->breadcrumbs=array(
	'Precios de Articulos'=>array('admin'),
	'Administrar',
);
?>

<h1>Precios de Articulos</h1>
<?php $form = $this->beginWidget('bootstrap.widgets.BootActiveForm', array()); ?>
    <?php echo CHtml::HiddenField('check',''); ?>
<div align="right">
    <?php
        $this->widget('bootstrap.widgets.BootButton', array(
            'label'=>'Ver detalle',
            'buttonType'=>'ajaxSubmit',
            'url'=>array('detalle'),
                'ajaxOptions'=>array(
                'type'=>'POST',
                'update'=>'#ver-detalle',
                ),
            'type'=>'', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'mini', // '', 'large', 'small' or 'mini'
            'icon' => 'search',
            'htmlOptions'=>array('class'=>'detalle'),
        ));
    ?>
</div>
<?php $this->widget('bootstrap.widgets.BootGridView', array(
	'id'=>'articulo-precio-grid',
        'type'=>'striped bordered condensed',
        'selectionChanged'=>'obtenerSeleccion',
	'dataProvider'=>$articulo->searchPrecio(),
	'filter'=>$articulo,
	'columns'=>array(
                array('class'=>'CCheckBoxColumn'),
		'ARTICULO',
		'NOMBRE', 
                'PRECIO_BASE',
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
                        'template' => '{update}'
		),
	),
)); ?>

<?php $this->endWidget(); ?>

<?php $this->beginWidget('bootstrap.widgets.BootModal', array('id'=>'myModal')); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h3>Ver detalle</h3>
</div>

    <?php echo $this->renderPartial('_view'); ?>
    <?php $this->endWidget(); ?>