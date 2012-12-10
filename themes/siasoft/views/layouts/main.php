<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHtml::encode(Yii::app()->charset); ?>" />
	<meta name="language" content="<?php echo CHtml::encode(Yii::app()->language); ?>" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/themes/siasoft/css/tables.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

<table width="960" align="center" cellpadding="0" cellspacing="0">
   <tr>
    <td id="cabecera_sup" height="57">&nbsp;</td>
  </tr>
  <tr>
    <td id="cabecera" height="65">&nbsp;</td>
  </tr>
</table><!-- header -->
<div id="menu">

		<?php if (!Yii::app()->user->isGuest){
		
		$com=ConfCo::model()->find();
		$compa=Compania::model()->find();
		$admin=ConfAs::model()->find();
		
		$this->widget('bootstrap.widgets.BootMenu', array(
			'type'=>'pills', // '', 'tabs', 'pills' (or 'list')
			'stacked'=>false, // whether this is a stacked menu
			'items'=>array(
				array('label'=>'Inicio', 'url'=>array('/site/index')),
				array('label'=>'Compras', 'url'=>'#',	
						'items'=>array(
							array('label'=>'Configuracion de Compras', 'url'=>$com ? array('/confCo/update','id'=>$com->ID): array('/confCo/create')),
							array('label'=>'Proveedor', 'url'=>array('/proveedor/admin')),
                                                        array('label'=>'Solicitud', 'url'=>array('/solicitudOc/admin')),
                                                        array('label'=>'Ordenes', 'url'=>array('/ordenCompra/admin')),
                                                        array('label'=>'IngresoCompra', 'url'=>array('/ingresoCompra/admin')),
						)
				),
				array('label'=>'Inventario', 'url'=>'#',	
						'items'=>array(
                                                        array('label'=>'Articulos', 'url'=>array('/articulo/admin')),
							array('label'=>'Clasificaciones', 'url'=>array('/clasificacionAdi/admin')),
							array('label'=>'Valores para Clasificaciones ', 'url'=>array('/clasificacionAdiValor/admin')),
                                                        array('label'=>'Tipo de Articulo', 'url'=>array('/tipoArticulo/admin')),
							array('label'=>'Unidades de medida', 'url'=>array('/unidadMedida/admin')),
                                                        array('label'=>'Metodo Valuacion', 'url'=>array('/metodoValuacionInv/admin')),
							array('label'=>'Tipo de Transaccion', 'url'=>array('/tipoTransaccion/admin')),
							array('label'=>'Consecutivos', 'url'=>array('/consecutivoCi/admin') ),
							array('label'=>'Documentos de Inventario', 'url'=>array('/documentoInv/admin') ),
							array('label'=>'Configuración', 'url'=>array('/confCi/create')),
						)
				),

				array('label'=>'Sistema', 'url'=>'#',
						
						'items'=>array(
							array('label'=>Yii::t('app','COMPANY'), 'url'=>$compa ? array('/compania/update','id'=>$compa->ID): array('/compania/create')),
                                                        array('label'=>Yii::t('app','ADMINISTRATION_SETTINGS'), 'url'=>$admin ? array('/confAs/update','id'=>$admin->ID): array('/confAs/create')),
                                                        array('label'=>Yii::t('app','COUNTRY'), 'url'=>array('pais/admin')),
                                                        array('label'=>'Departamento', 'url'=>array('/ubicacionGeografica1/admin')),
                                                        array('label'=>'Municipio', 'url'=>array('/ubicacionGeografica2/admin')),
                                                        array('label'=>Yii::t('app','AREA'), 'url'=>array('/zona/admin')),
                                                        array('label'=>'Bodega', 'url'=>array('/bodega/admin')),
                                                        array('label'=>'Categorias clientes y proveedor', 'url'=>array('/categoria/admin')),
                                                        array('label'=>'Centro de costos', 'url'=>array('/centroCostos/admin')),
                                                        array('label'=>'Condicion de pago', 'url'=>array('/codicionPago/admin')),
                                                        array('label'=>'Dependencia', 'url'=>array('/departamento/admin')),
                                                        array('label'=>'Tipo de documento', 'url'=>array('/tipoDocumento/admin')),
                                                        array('label'=>'Relación de Nits', 'url'=>array('nit/admin')),
                                                        array('label'=>'Entidad financiera', 'url'=>array('/entidadFinanciera/admin')),
                                                        array('label'=>'Nivel de precio', 'url'=>array('/nivelPrecio/admin')),
                                                        array('label'=>'Tipo de tarjeta', 'url'=>array('/tipoTarjeta/admin')),
                                                        array('label'=>'Dia feriado', 'url'=>array('/diaFeriado/admin')),
                                                        array('label'=>'Impuesto', 'url'=>array('/impuesto/admin')),
                                                        array('label'=>'Retencion', 'url'=>array('/retencion/admin')),
						),
				),
				array('label'=>'Usuarios', 'url'=>array('/usuarios/admin')),		
				array('label'=>Yii::t('app','LOGIN'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>Yii::t('app','LOGOUT (').Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                             ),
		));
		}
		?>
</div><!-- mainmenu -->
	
<?php if (!Yii::app()->user->isGuest){ 
	 		if(isset($this->breadcrumbs)):
				$this->widget('bootstrap.widgets.BootBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); 
		endif?>
<?php } ?>

	<?php echo $content; ?>

	<div class="clear"></div>

    <div style="width:100%; background-color:#fff; height:100px;">
    <div style="padding-top:20px; float:left; padding-left:50px;">
      <img src="themes/siasoft/images/footer.png" alt="escudos" width="619" height="59" border="0" usemap="#Map">
      <map name="Map" id="Map">
        <area shape="rect" coords="95,4,250,56" href="http://www.tolima.gov.co/tolima/index.php" target="_blank" />
        <area shape="rect" coords="265,5,490,53" href="http://www.adtolima.org/" target="_blank" />
        <area shape="rect" coords="517,5,606,54" href="http://www.ccibague.org/" target="_blank" />
      </map>
      </img>
    </div>
     <div style="float:right; padding-top:20px; padding-right:50px;">
    <a href="http://www.tramasoft.com" target="_blank" title="Tramasoft - Soluciones TIC"><img src="themes/siasoft/images/logo_tramasoft.png" alt="Tramasoft - Soluciones TIC" border="0" /></a>
    </div>
    </div><!-- footer -->

</div><!-- page -->

</body>
</html>