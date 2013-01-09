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

        <style>
            .piePagina{

                color:#999999;
            }    
            body{
                background: white;
            }

        </style>


    </head>

    <body>

        <div class="container" id="page" >

            <table width="100%" >
                <tr>
                    <td height="75" colspan="3">
                        <table width="100%" align="center" >
                            <tr>
                                <td width="26%" rowspan="4" align="left" valign="middle"><?php
                                    $compania = Compania::model()->find();
                                    if ($compania->LOGO != '') {
                                        echo CHtml::image(Yii::app()->request->baseUrl . "/logo/" . $compania->LOGO, 'Logo');
                                    } else {
                                        echo $compania->NOMBRE;
                                    }
                                    ?>
                                </td>
                                <?php $compania = Compania::model()->find(); ?>
                                <td width="41%" align="center"><?php echo $compania->NOMBRE_ABREV; ?></td>
                                <td width="33%" rowspan="2" align="right" valign="middle">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="center"><?php echo '<b>Nit:</b> ' . $compania->NIT; ?></td>
                            </tr>
                            <tr>
                                <td align="center">Direccion  <?php echo $compania->DIRECCION; ?></td>

                                <td align="right" valign="middle"><strong>Pedido Número:</strong></td>
                            </tr>
                            <tr>
                                <td align="center"><?php echo '<b>Tels:</b> ' . $compania->TELEFONO1 . '-' . $compania->TELEFONO2; ?></td>
                                <td width="33%" align="right" valign="middle"><?php echo $this->pedido->PEDIDO; ?></td>
                            </tr>
                        </table></td>
                </tr>
                <tr>
                    <td height="74" colspan="3" align="center" valign="middle">

                        <table width="100%" >
                            <tr>
                                <td width="80%" align="left" valign="middle" ><strong>Señores:</strong></td>
                                <td colspan="4" align="center" valign="middle"><strong>Fecha Pedido</strong></td>
                            </tr>
                            <tr>
                                <?php
                                $arr = explode("-", $this->pedido->FECHA_PEDIDO);
                                $ano = $arr[0];
                                $mes = $arr[1];
                                $dia = $arr[2];
                                ?>
                                <td align="left" valign="middle"><?php echo $this->pedido->cLIENTE->NOMBRE ?></td>
                                <td width="6%" align="center" valign="middle"><strong>Dia</strong> </td>
                                <td width="6%" align="center" valign="middle"><strong>Mes</strong></td>
                                <td width="6%" colspan="2" align="center" valign="middle"><strong>Año</strong></td>
                            </tr>
                            <tr>
                                <td align="left" valign="middle"><strong>Nit/CC No</strong>:<?php echo $this->pedido->CLIENTE ?></td>
                                <td align="center" valign="middle"><?php echo $dia ?></td>
                                <td align="center" valign="middle"><?php echo $mes ?></td>
                                <td colspan="2" align="center" valign="middle"><?php echo $ano ?></td>
                            </tr>

                        </table></td>
                </tr>

                <tr>
                    <td colspan="3" align="center" valign="middle"><p>&nbsp;</p>      <p><?php echo $content; ?></p>
                        <p>&nbsp;</p>
                    </td>
                </tr>

                <tr>
                    <td colspan="3">
                        <table width="100%" >
                            <tr>
                                <td width="70%" rowspan="3"><strong>Son:</strong><?php echo NumText::convert($this->pedido->TOTAL_A_FACTURAR); ?></td>
                                <td width="14%" colspan="-1"><strong>SUBTOTAL $</strong></td>
                                <td width="14%" colspan="-1"><?php echo $this->pedido->TOTAL_MERCADERIA - $this->pedido->MONTO_DESCUENTO1 ?></td>
                            </tr>
                            <tr>
                                <td colspan="-1"><strong>IVA $</strong></td>
                                <td colspan="-1"><?php echo $this->pedido->TOTAL_IMPUESTO1 ?></td>
                            </tr>
                            <tr>
                                <td colspan="-1"><strong>VALOR TOTAL $</strong></td>
                                <td colspan="-1"><?php echo $this->pedido->TOTAL_A_FACTURAR ?></td>
                            </tr>
                        </table></td>
                </tr>
                <tr>
                    <td width="50%"><strong>Notas:</strong></td>
                    <td width="50%"><strong>Elaborador por:</strong> <?php echo $this->pedido->CREADO_POR ?></td>
                </tr>
            </table>


        </div><!-- page -->

    </body>
</html>