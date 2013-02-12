<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <!-- blueprint CSS framework -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/print.css" media="print" />
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
        <![endif]-->

        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/tables.css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/FormatosImpresion.css" />

        
        
        
        
    </head>

    <body>

        <div class="container" id="page" >

<?php
            $arr = explode("-", $this->solicitud->FECHA_SOLICITUD);
            $ano1 = $arr[0];
            $mes1 = $arr[1];
            $dia1 = $arr[2];
            $arr = explode("-", $this->solicitud->FECHA_REQUERIDA);
            $ano = $arr[0];
            $mes = $arr[1];
            $dia = $arr[2];
            ?>
            
            <div style="text-align: center;" width="700px"> <p style="font-size: 14pt"><strong>Solicitud de Compra</strong></p></div>
            
            <div class="borde" width="372px">
                <strong>Departamento: </strong><?php echo $this->solicitud->dEPARTAMENTO->DESCRIPCION; ?><br>
                <strong>Prioridad: </strong><?php echo SolicitudOc::model()->prioridad($this->solicitud->PRIORIDAD); ?><br>
                <strong>Estado: </strong><?php echo SolicitudOc::model()->estado($this->solicitud->ESTADO); ?>    
            </div>
            
            <div width="140px" style="padding-left: 4px; float: left;">
                <div width="139px" style="padding: 1px;"><div class="borde" style="padding: 2px;" align="center"><strong>Fecha Solicitud</strong></div></div>
                <div style="padding: 1px; " ><div class="borde" style="padding: 2px;" width="26%" align="center"><strong>Dia</strong></div> <div class="borde" width="26%" style="padding: 2px; margin-left: 3px;" align="center"><strong>Mes</strong></div><div class="borde" width="30%" style="padding: 2px; margin-left: 3px;" align="center"><strong>Año</strong></div></div>
                <div style="padding: 1px; " align="center"><div class="borde" style="padding: 2px;" width="26%" align="center"><strong><?php echo $dia1 ?></strong></div><div class="borde" width="26%" style="padding: 2px; margin-left: 3px;" align="center"><strong><?php echo $mes1 ?></strong></div><div class="borde" width="30%" style="padding: 2px; margin-left: 3px;" align="center"><strong><?php echo $ano1 ?></strong></div></div>
            </div>
            
            <div width="140px" style="padding-left: 2px; float: left;">
                <div width="139px" style="padding: 1px;"><div class="borde" style="padding: 2px;" align="center"><strong>Fecha Requerida</strong></div></div>
                <div style="padding: 1px; " ><div class="borde" style="padding: 2px;" width="26%" align="center"><strong>Dia</strong></div> <div class="borde" width="26%" style="padding: 2px; margin-left: 3px;" align="center"><strong>Mes</strong></div><div class="borde" width="30%" style="padding: 2px; margin-left: 3px;" align="center"><strong>Año</strong></div></div>
                <div style="padding: 1px; " align="center"><div class="borde" style="padding: 2px;" width="26%" align="center"><strong><?php echo $dia ?></strong></div><div class="borde" width="26%" style="padding: 2px; margin-left: 3px;" align="center"><strong><?php echo $mes ?></strong></div><div class="borde" width="30%" style="padding: 2px; margin-left: 3px;" align="center"><strong><?php echo $ano ?></strong></div></div>
            </div>
            
            <div style="padding-top: 10px;padding-bottom: 10px;">
              
                <?php echo $content; ?>
                
            </div>
            
            <div class="borde">
                
                <strong>Observaciones:</strong><br>
                <p>&nbsp;</p>
                
            </div>


            
            
<!--            <table width="100%">
 
  <tr>
    <td colspan="2" align="center" valign="middle"><p>&nbsp;</p>
    <p style="font-size: 14pt"><strong>Solicitud de Compra</strong></p>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td><strong>Fecha Solicitud:</strong> <?php //echo $this->solicitud->FECHA_SOLICITUD; ?></td>
    <td><strong>Departamento: </strong><?php //echo $this->solicitud->dEPARTAMENTO->DESCRIPCION; ?></td>
  </tr>
  <tr>
    <td><strong>Fecha Requerida: </strong><?php //echo $this->solicitud->FECHA_REQUERIDA; ?></td>
    <td><strong>Prioridad: </strong><?php //echo SolicitudOc::model()->prioridad($this->solicitud->PRIORIDAD); ?></td>
  </tr>
  <tr>
    <td><strong>Estado: </strong><?php //echo SolicitudOc::model()->estado($this->solicitud->ESTADO); ?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center" valign="middle"><p>&nbsp;</p>      <p><?php //echo $content; ?></p>
    <p>&nbsp;</p></td>
  </tr>
  <tr>
    <td colspan="2"><strong>Observaciones:</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>-->
            
            
            
            
            
            
            
            
        </div><!-- page -->

    </body>
</html>