<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHtml::encode(Yii::app()->charset); ?>" />
	<meta name="language" content="<?php echo CHtml::encode(Yii::app()->language); ?>" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php 
		
		 $this->widget('bootstrap.widgets.BootNavbar', array(
                    'fixed'=>false,
                    'brand'=>'',
                    'brandUrl'=>'#',
                    'collapse'=>true, // requires bootstrap-responsive.css
                    'items'=>array(
                        array(
                            'class'=>'bootstrap.widgets.BootMenu',
                            'items'=>array(
                                array('label'=>'Inicio', 'url'=>array('/site/index')),
                                array('label'=>'Sistema', 'url'=>'#', 'items'=>array(
						array('label'=>Yii::t('app','COMPANY'), 'url'=>array('compania/admin')),
						array('label'=>Yii::t('app','ADMINISTRATION_SETTINGS'), 'url'=>array('confAs/admin')),
						array('label'=>Yii::t('app','COUNTRY'), 'url'=>array('pais/admin')),
						array('label'=>Yii::t('app','GEOGRAPHIC_LOCATION').' 1', 'url'=>array('ubicacionGeografica1/admin')),
						array('label'=>Yii::t('app','GEOGRAPHIC_LOCATION').' 2', 'url'=>array('ubicacionGeografica2/admin')),
						array('label'=>Yii::t('app','AREA'), 'url'=>array('zona/admin')),
						array('label'=>'Bodega', 'url'=>array('bodega/admin')),
						array('label'=>'Categoria', 'url'=>array('categoria/admin')),
						array('label'=>'Centro de costos', 'url'=>array('centroCostos/admin')),
						array('label'=>'Condicion de pago', 'url'=>array('codicionPago/admin')),
						array('label'=>'Departamento', 'url'=>array('departamento/admin')),
						array('label'=>'Entidad financiera', 'url'=>array('entidadFinanciera/admin')),
						array('label'=>'Nit', 'url'=>array('nit/admin')),
						array('label'=>'Nivel de precio', 'url'=>array('nivelPrecio/admin')),
						array('label'=>'Tipo de documento', 'url'=>array('tipoDocumento/admin')),
						array('label'=>'Tipo de tarjeta', 'url'=>array('tipoTarjeta/admin')),
						array('label'=>'Dia feriado', 'url'=>array('diaFeriado/admin')),
                        )),
                              array('label'=>Yii::t('app','LOGIN'), 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                              array('label'=>Yii::t('app','LOGOUT (').Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                    ),
                ),
            ),
        )); 
		
		?>
	</div><!-- mainmenu -->
	
	
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('bootstrap.widgets.BootBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
		All Rights Reserved.<br/>
		<?php echo Yii::powered(); ?>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
