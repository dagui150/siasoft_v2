<div class="modal-body" > 
    hola
</div>
<div class="modal-footer">
    <?php
        $this->widget('bootstrap.widgets.TbButton', array(
                         'buttonType'=>'button',
                         'type'=>'normal',
                         'label'=>'Cancelar',
                         'icon'=>'remove',
                         'htmlOptions'=>array('onclick'=>'$(".close").click();')
                      ));
    ?>
</div>