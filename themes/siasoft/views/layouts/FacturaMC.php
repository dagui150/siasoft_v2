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
<?php //Yii::app()->bootstrap->register(); ?>
       <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/FormatosImpresion.css" />

    </head>

    <body>

        <div class="container" id="page">
            
            <?php
            $arr = explode("-", $this->factura->FECHA_FACTURA);
            $ano1 = $arr[0];
            $mes1 = $arr[1];
            $dia1 = $arr[2];
            $arr = explode("-", $this->factura->FECHA_FACTURA);
            $ano = $arr[0];
            $mes = $arr[1];
            $dia = $arr[2];
            ?>

            <div class="borde" width="514px">
                <strong>Señores:</strong><br>
                <?php echo $this->factura->cLIENTE->NOMBRE ?><br>
                <strong>Nit/CC No</strong>:<?php echo $this->factura->CLIENTE ?>        
            </div>
            
            <div width="140px" style="padding-left: 4px; float: left;">
                <div width="139px" style="padding: 1px;"><div class="borde" style="padding: 2px;" align="center"><strong>Fecha Factura</strong></div></div>
                <div style="padding: 1px; " ><div class="borde" style="padding: 2px;" width="26%" align="center"><strong>Dia</strong></div> <div class="borde" width="26%" style="padding: 2px; margin-left: 3px;" align="center"><strong>Mes</strong></div><div class="borde" width="30%" style="padding: 2px; margin-left: 3px;" align="center"><strong>Año</strong></div></div>
                <div style="padding: 1px; " align="center"><div class="borde" style="padding: 2px;" width="26%" align="center"><strong><?php echo $dia1 ?></strong></div><div class="borde" width="26%" style="padding: 2px; margin-left: 3px;" align="center"><strong><?php echo $mes1 ?></strong></div><div class="borde" width="30%" style="padding: 2px; margin-left: 3px;" align="center"><strong><?php echo $ano1 ?></strong></div></div>
            </div>
            
<!--            <div width="140px" style="padding-left: 2px; float: left;">
                <div width="139px" style="padding: 1px;"><div class="borde" style="padding: 2px;" align="center"><strong>Fecha Vencimiento</strong></div></div>
                <div style="padding: 1px; " ><div class="borde" style="padding: 2px;" width="26%" align="center"><strong>Dia</strong></div> <div class="borde" width="26%" style="padding: 2px; margin-left: 3px;" align="center"><strong>Mes</strong></div><div class="borde" width="30%" style="padding: 2px; margin-left: 3px;" align="center"><strong>Año</strong></div></div>
                <div style="padding: 1px; " align="center"><div class="borde" style="padding: 2px;" width="26%" align="center"><strong><?php //echo $dia ?></strong></div><div class="borde" width="26%" style="padding: 2px; margin-left: 3px;" align="center"><strong><?php //echo $mes ?></strong></div><div class="borde" width="30%" style="padding: 2px; margin-left: 3px;" align="center"><strong><?php //echo $ano ?></strong></div></div>
            </div>-->
            
            <div style="padding-top: 10px;padding-bottom: 10px;">
              
                <?php echo $content; ?>
                
            </div>
            
            <div style="margin-bottom: 3px; margin-top: 3px; ">
                
                
                <div class="borde" width="405px" style="padding-bottom: 0px; height: 75px">
                    <strong>Son:</strong><?php echo NumText::convert(Controller::unformat($this->factura->TOTAL_A_FACTURAR)); ?>
                </div>
                
                <div class="borde" width="250px" style="margin-left: 3px; padding: 0px; height: 20px">
                    
                    <div width="120px" style="float:left;">
                    <div class="borde1" style="padding: 5px;padding-top: 3px; background-color: gainsboro; ">
                        <strong>SUBTOTAL $</strong>
                       
                    </div>  
                    <div style="padding: 5px; padding-top: 3px; padding-bottom: 3px" >
                        <strong>IVA $</strong>
                        
                    </div>  
                    <div  class="borde4" style="padding: 5px; background-color: gainsboro;">
                        <strong>VALOR TOTAL $</strong>
                        
                    </div>  
                </div>
                    
                    
                <div width="126.5px" style="float:left; border-left: 1px solid black;">
                    
                    <div class="borde2" style="padding: 5px; padding-top: 3px;background-color: gainsboro;">
                        <?php echo number_format(Controller::unformat($this->factura->TOTAL_MERCADERIA) - Controller::unformat($this->factura->MONTO_DESCUENTO1), 2, ',', '.'); ?>
                    </div>  
                    <div style="padding: 5px;padding-top: 3px; padding-bottom: 3px">
                        <?php echo $this->factura->TOTAL_IMPUESTO1 ?>
                    </div>  
                    <div  class="borde3" style="padding: 5px; background-color: gainsboro;">
                        
                        <?php echo $this->factura->TOTAL_A_FACTURAR ?>
                    </div>  
                    
                </div>
                    
                    
                </div>
            </div>

            
            <div style="margin-bottom: 3px;margin-top: 3px;height: 60px">
                <div class="borde" width="316px" style="height: 60px;">
                   <strong>Expedida por: </strong><?php echo $this->factura->CREADO_POR ?> 
                </div>
                
                <div class="borde" width="316px" style="margin-left: 3px; height: 60px;">
                    <strong>Recivida y Aceptada</strong>
                </div>
            </div>
            
        </div><!-- page -->
        
        

    </body>
</html>

