<div class="form">

<?php $form= $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'conf-as-form',
	'type'=>'horizontal',
	'enableAjaxValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
        <?php
        /*
            $this->widget('bootstrap.widgets.TbTabs', array(
            'type' => 'tabs', // 'tabs' or 'pills'
            'tabs' => array(
            array('label' => 'General', 'content' =>
            $form->textFieldRow($model2, 'IMPUESTO1_DESC', array('size' => 10, 'maxlength' => 10))
            .$form->textFieldRow($model2, 'PATRON_CCOSTO', array('size' => 25, 'maxlength' => 25))
            .$form->textFieldRow($model2, 'SIMBOLO_MONEDA', array('size' => 3, 'maxlength' => 3))


                    ,'active' => true),
               
            ),
                )
            );
            */
        ?>
    <table style="width: 200px">
        <tr>
            <td>
		<?php echo $form->textFieldRow($model2,'IMPUESTO1_DESC',array('size'=>10,'maxlength'=>10)); ?>
            </td>
            <td><?php echo $this->botonAyuda('IMPUESTO_CONSUMO'); ?></td>
        </tr>
        <tr>
            <td>
        	<?php //echo $form->textFieldRow($model2,'IMPUESTO2_DESC',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->textFieldRow($model2,'PATRON_CCOSTO',array('size'=>25,'maxlength'=>25)); ?>
            </td>
            <td><?php echo $this->botonAyuda('MASCARA_CCOSTO'); ?></td>
        </tr>
        <tr>
            <td>
        	<?php echo $form->textFieldRow($model2,'SIMBOLO_MONEDA',array('size'=>3,'maxlength'=>3)); ?>
            </td>
            <td><?php echo $this->botonAyuda('SIMB_MONEDA'); ?></td>
            </td>
        </tr>
        <tr>
            <td>
        	<?php echo $form->textFieldRow($model2,'PORCENTAJE_DEC',array('size'=>6,'maxlength'=>6)); ?>
            </td>
            <td></td>
            </td>
        </tr>
        </table>
		
		
	<div class="row-buttons" align="center">
        <?php $this->darBotonEnviar($model2->isNewRecord ? 'Crear' : 'Guardar'); ?>
        <?php $this->darBotonCancelar(false, array('site/index')); ?>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->