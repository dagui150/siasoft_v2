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
            $arr = explode("-", $this->ingreso->FECHA_INGRESO);
            $ano = $arr[0];
            $mes = $arr[1];
            $dia = $arr[2];
            ?>


            <div style="text-align: center;" width="700px"> <p style="font-size: 14pt"><strong>Ingreso de Compra</strong></p></div>

            <div class="borde" width="516px">
                <strong>Proveedor: </strong>
                <br><?php echo $this->ingreso->pROVEEDOR->NOMBRE; ?><br>
                <strong>Estado: </strong><?php echo IngresoCompra::model()->estado($this->ingreso->ESTADO); ?>    
            </div>



            <div width="140px" style="padding-left: 2px; float: left;">
                <div width="139px" style="padding: 1px;"><div class="borde" style="padding: 2px;" align="center"><strong>Fecha Ingreso</strong></div></div>
                <div style="padding: 1px; " ><div class="borde" style="padding: 2px;" width="26%" align="center"><strong>Dia</strong></div> <div class="borde" width="26%" style="padding: 2px; margin-left: 3px;" align="center"><strong>Mes</strong></div><div class="borde" width="30%" style="padding: 2px; margin-left: 3px;" align="center"><strong>Año</strong></div></div>
                <div style="padding: 1px; " align="center"><div class="borde" style="padding: 2px;" width="26%" align="center"><strong><?php echo $dia ?></strong></div><div class="borde" width="26%" style="padding: 2px; margin-left: 3px;" align="center"><strong><?php echo $mes ?></strong></div><div class="borde" width="30%" style="padding: 2px; margin-left: 3px;" align="center"><strong><?php echo $ano ?></strong></div></div>
            </div>

                        <div style="padding-top: 10px;padding-bottom: 10px;">

                            <?php echo $content; ?>

                        </div>

                        <div class="borde">

                            <strong>Notas:</strong><br>
                                <p><?php echo $this->ingreso->NOTAS; ?></p>

                        </div>

        </div><!-- page -->

    </body>
</html>