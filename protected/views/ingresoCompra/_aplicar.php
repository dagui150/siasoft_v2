<div class="modal-body">     
                <br /><h3 style="color: #C09853;">Advertencias</h3><p>&nbsp;</p><div id="respuesta">Seleccione Ingresos para aplicar</div>              
          </div>
	
        <div class="modal-footer">            
            <table>
                <tr>
                    <td><div align="right"><h3>¿Desea Continuar?</h3></div></td>
                    <td>
            <?php 
                $this->widget('bootstrap.widgets.BootButton', array(
                    'label'=>'Continuar',
                    'buttonType'=>'button',
                    'type'=>'success', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'icon' => 'ok-circle white white',
                    /*'url' => array('aplicar'),
                    'ajaxOptions'=>array(
                        'type'=>'POST',
                        'update'=>'#cargando',                        
                        'beforeSend'=>'cargando()',
                    ), */
                    'htmlOptions'=>array('id'=>'continuar', 'onclick'=>'buscar();'),
                ));
            ?>

            <?php $this->widget('bootstrap.widgets.BootButton', array(
                    'label'=>'Cancelar',
                    'url'=>'#',
                    'htmlOptions'=>array('data-dismiss'=>'modal'),
                )); 
               
            ?>
                        </td>
                </tr>
            </table>                      
        </div>