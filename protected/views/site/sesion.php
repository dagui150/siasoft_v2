<script>

        var pagina='<?php echo $this->createUrl('/site/login')?>'
        function redireccionar(){
            location.href=pagina
        } 
       // setTimeout("redireccionar()", 2000);  
</script>
<table align="center" border="0" cellpadding="4" cellspacing="0" width="967">
     <tbody>
          <tr>
            <td colspan="3"><?php echo CHtml::image(Yii::app()->request->baseUrl.'/mantenimiento%20Archivos/1.jpg');?></td>
          </tr>
          <tr>
            <td width="805">
               <table align="center" border="0" cellpadding="4" cellspacing="0" width="783">
                  <tbody>
                      <tr>
                          <td rowspan="3" valign="middle" width="200"><?php echo CHtml::image(Yii::app()->request->baseUrl.'/mantenimiento%20Archivos/5.jpg');?></td>
                        <td colspan="2" align="center"><?php echo CHtml::link(CHtml::image(Yii::app()->request->baseUrl.'/images/sesion-cerrada.jpg','login',array('id'=>'login')),array('/site/login'));?></td>
                        <td width="96">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="112">&nbsp;</td>
                        <td width="343"><h2>SESION EXPIRADA</h2></td>
                        <td>&nbsp;</td>
                      </tr>
                 </tbody>
               </table>
            </td>
          </tr>
          <tr>
            <td colspan="3"><?php echo CHtml::image(Yii::app()->request->baseUrl.'/mantenimiento%20Archivos/4.jpg');?></td>
          </tr>
    </tbody>
</table>