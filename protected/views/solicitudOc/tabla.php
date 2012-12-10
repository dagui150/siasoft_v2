<!-- Tabla que actualiza y hace el ciclo -->
    <div class="form">
        <table>
            <tr><th>Articulo</th><th>&nbsp;</th><th>Descripcion</th><th>Unidad</th><th>Estado</th><th>Cantidad</th><th>Fecha Requerida</th><th>Comentario</th><th>Saldo</th><th>Linea Num</th><th>&nbsp;</th></tr>
        <?php foreach($items as $i=>$item): ?>
        <tr>
        <td><?php echo CHtml::activeTextField($item,"[$i]ARTICULO"); ?></td>
        <td>
             <?php $this->widget('bootstrap.widgets.BootButton', array(
                   'type'=>'info',
                   'size'=>'mini',
                   'url'=>'#articulo',
                   'icon'=>'search',
                   'htmlOptions'=>array('data-toggle'=>'modal', 'class' => 'emergente', 'name' => $i),
             )); ?>
        </td>
        <td><?php echo CHtml::activeTextField($item,"[$i]DESCRIPCION"); ?></td>
        <td><?php echo CHtml::activeDropDownList($item,"[$i]UNIDAD", $linea->getCombo($item->ARTICULO)); ?></td>
        <td><?php echo CHtml::activeTextField($item,"[$i]ESTADO", array('readonly'=>true, 'size'=>'1')); ?></td>
        <td><?php echo CHtml::activeTextField($item,"[$i]CANTIDAD", array('size'=>'5')); ?></td>
        <td><?php echo CHtml::activeTextField($item,"[$i]FECHA_REQUERIDA", array('size'=>'10')); ?></td>
        <td><?php echo CHtml::activeTextField($item,"[$i]COMENTARIO"); ?></td>
        <td><?php echo CHtml::activeTextField($item,"[$i]SALDO", array('readonly'=>true, 'size'=>'5')); ?></td>
        <td><?php echo CHtml::activeTextField($item,"[$i]LINEA_NUM", array('readonly'=>true, 'size'=>'5')); ?></td>
        <td><div class="remove">
                  <?php 
                  $this->widget('bootstrap.widgets.BootButton', array(
                    'buttonType'=>'button',
                    'type'=>'danger',
                    'label'=>'',
                    'icon'=>'minus white',
                    'size' => 'normal',
                  ));
                  ?>
             </div>
        </td>                                       
        </tr>
        <?php endforeach; ?>
        </table>

    </div><!-- form -->