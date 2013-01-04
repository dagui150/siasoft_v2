<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
	/*
	*	este metodo sera llamado para retornar un boton de ayuda
	*	@param $texto 
	*/
	public function botonAyuda($texto) {
        $boton = $this->widget('bootstrap.widgets.BootButton', array(
                    'type' => 'nommal', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                    'size' => 'mini', // '', 'large', 'small' or 'mini'
                    'icon' => 'info-sign',
                    'htmlOptions'=>array('data-title'=>'Ayuda', 'data-content'=>Yii::t('ayuda',$texto), 'rel'=>'popover'),
                ),true);
        return $boton;
    }
    /*
	*	este metodo sera llamado para desformatear un numero que venga con comas(,) y puntos (.)
	*	@param $valor 
	*/
    public static function unformat($valor){
        $trans = array('.' => '');
        $trans2 = array(',' => '.');
        $valorunformat=strtr(strtr($valor, $trans), $trans2);
        return $valorunformat;
    }
	
	/*
	*	este metodo sera llamado para retornar el menu del sistema
	*	con los items desplegados por cruge y extras como logout
	*	@return "menu del sistema para el usuario"
	*/
	public function menu(){
		/*$this->menu = Yii::app()->user->rbac->getMenu();
		$this->menu[]= array('label'=>'Administrar Usuarios', 'url'=>Yii::app()->user->ui->userManagementAdminUrl, 'visible'=>!Yii::app()->user->isGuest && Yii::app()->user->isSuperAdmin ? true : false);
		$this->menu[]=array('label'=>'Salir ('.Yii::app()->user->name.')', 'url'=>Yii::app()->user->ui->logoutUrl,'visible'=>!Yii::app()->user->isGuest);
		*/
		
		
        $com = ConfCo::model()->find();
        $fac = ConfFa::model()->find();
        $compa = Compania::model()->find();
        $admin = ConfAs::model()->find();
				
		$this->menu = array(
                            array('label' => 'Inicio', 'url' => array('/site/index')),
                            array('label' => 'Facturación', 'url' => '#',
                                'items' => array(
                                    array('label' => 'Configuración', 'url' => $fac ? array('/confFa/update', 'id' => $fac->ID) : array('/confFa/create')),
                                    array('label'=>'Ensamble de articulos', 'url'=>array('/articuloEnsamble/admin')),
                                    array('label'=>'Precio de articulos', 'url'=>array('/articuloPrecio/admin')),
                                    array('label'=>'Pedidos', 'url'=>array('/pedido/admin')),
                                    array('label'=>'Facturas', 'url'=>array('/factura/admin')),
                                    array('label'=>'Consecutivos', 'url'=>array('/consecutivoFa/admin')),	
                                    array('label'=>'Clientes', 'url'=>array('/cliente/admin')),	
								)
							),
                            array('label' => 'Compras', 'url' => '#',
                                'items' => array(
                                    array('label' => 'Configuración de Compras', 'url' => $com ? array('/confCo/update', 'id' => $com->ID) : array('/confCo/create')),
                                    array('label' => 'Proveedor', 'url' => array('/proveedor/admin')),
                                    array('label' => 'Solicitud de compra', 'url' => array('/solicitudOc/admin')),
                                    array('label' => 'Ordenes de compra', 'url' => array('/ordenCompra/admin')),
                                    array('label' => 'Ingreso de compra', 'url' => array('/ingresoCompra/admin')),
                                )
                            ),
                            array('label' => 'Inventario', 'url' => '#',
                                'items' => array(
                                    array('label' => 'Artíulos', 'url' => array('/articulo/admin')),
                                    array('label' => 'Clasificaciones', 'url' => array('/clasificacionAdi/admin')),
                                    array('label' => 'Valores para Clasificaciones ', 'url' => array('/clasificacionAdiValor/admin')),
                                    array('label' => 'Tipo de artículo', 'url' => array('/tipoArticulo/admin')),
                                    array('label' => 'Unidades de medida', 'url' => array('/unidadMedida/admin')),
                                    array('label' => 'Metodo Valuacion', 'url' => array('/metodoValuacionInv/admin')),
                                    array('label' => 'Tipo de Transacción', 'url' => array('/tipoTransaccion/admin')),
                                    array('label' => 'Consecutivos', 'url' => array('/consecutivoCi/admin')),
                                    array('label' => 'Documentos de Inventario', 'url' => array('/documentoInv/admin')),
                                    array('label' => 'Configuración', 'url' => array('/confCi/create')),
                                )
                            ),
							
                            array('label' => 'Sistema', 'url' => '#',
                                'items' => array(
                                    array('label' => Yii::t('app', 'COMPANY'), 'url' => $compa ? array('/compania/update', 'id' => $compa->ID) : array('/compania/create')),
                                    array('label' => Yii::t('app', 'ADMINISTRATION_SETTINGS'), 'url' => $admin ? array('/confAs/update', 'id' => $admin->ID) : array('/confAs/create')),
                                    array('label' => Yii::t('app', 'COUNTRY'), 'url' => array('pais/admin')),
                                    array('label' => 'Departamento', 'url' => array('/ubicacionGeografica1/admin')),
                                    array('label' => 'Municipio', 'url' => array('/ubicacionGeografica2/admin')),
                                    array('label' => Yii::t('app', 'AREA'), 'url' => array('/zona/admin')),
                                    array('label' => 'Bodega', 'url' => array('/bodega/admin')),
                                    array('label' => 'Categorías clientes y proveedor', 'url' => array('/categoria/admin')),
                                    array('label' => 'Centro de costos', 'url' => array('/centroCostos/admin')),
                                    array('label' => 'Condición de pago', 'url' => array('/codicionPago/admin')),
                                    array('label' => 'Dependencia', 'url' => array('/departamento/admin')),
                                    array('label' => 'Tipo de documento', 'url' => array('/tipoDocumento/admin')),
                                    array('label' => 'Relación de Nits', 'url' => array('nit/admin')),
                                    array('label' => 'Entidad financiera', 'url' => array('/entidadFinanciera/admin')),
                                    array('label'=>'Tipos de precio', 'url'=>array('/nivelPrecio/admin')),
                                    array('label' => 'Tipo de tarjeta', 'url' => array('/tipoTarjeta/admin')),
                                    array('label' => 'Día feriado', 'url' => array('/diaFeriado/admin')),
                                    array('label' => 'Impuesto', 'url' => array('/impuesto/admin')),
                                    array('label' => 'Retención', 'url' => array('/retencion/admin')),
                                    array('label'=>'Regimen Tributario', 'url'=>array('/regimenTributario/admin')),
                                    array('label' => 'Administración de Reportes', 'url' => array('/formatoImpresion/admin')),
                            )),
                            /*array('label' => 'Recursos Humanos', 'url' => '#',
                                'items' => array(
                                    array('label' => 'Cargo', 'url' => array('/cargo/admin')),
                                    array('label' => 'Estado de empleados', 'url' => array('/estadoEmpleado/admin')),
                                    array('label' => 'Horarios', 'url' => array('/horario/admin')),
                                    array('label' => 'Tipos de Academico', 'url' => array('/tipoAcademico/admin')),
                                    array('label' => 'Tipos de Accidente', 'url' => array('/tipoAccidente/admin')),
                                    array('label' => 'Tipos de Ausencia', 'url' => array('/tipoAusencia/admin')),
                                    array('label' => 'Tipos De Contrato', 'url' => array('/tipoContrato/admin')),
                                    
                          
                                    
                                    
                                    
                                    ),
                            ),*/
                            array('label'=>'Administrar Usuarios', 'url'=>Yii::app()->user->ui->userManagementAdminUrl, 'visible'=>!Yii::app()->user->isGuest && Yii::app()->user->isSuperAdmin ? true : false),
                            array('label'=>'Salir ('.Yii::app()->user->name.')', 'url'=>Yii::app()->user->ui->logoutUrl,'visible'=>!Yii::app()->user->isGuest),
                        );
		return $this->menu;
		
	}
	
	//Funcion que actualiza el inventario de un articulo
	function upd_inventario($arti_id, $cantidad, $unidad_id, $operacion)
	{
		$query_unidad_articulo = "SELECT UNIDAD_ID, ARTI_TIPO FROM articulo WHERE arti_id = $arti_id";
		$res_unidad_articulo = mysql_query($query_unidad_articulo, $enlace) or die(rollback());
		$row_unidad_articulo = mysql_fetch_assoc($res_unidad_articulo);
		
		//Si es tipo servicio no se actualiza el inventario
		if($row_unidad_articulo['ARTI_TIPO'] == 'S')
		{
			return true;	
		}
		
		$cantidad_equiv = $cantidad;
		
		if($row_unidad_articulo['UNIDAD_ID'] != $unidad_id)
		{
			//equivalencia
			$factor = factor_conversion($unidad_id, $row_unidad_articulo['UNIDAD_ID'], $db, $enlace);
			$cantidad_equiv = $cantidad * $factor;
		}

		//...	y otras cosas mas q no nos interesan.
	}
	
	//Funcion que retorna factor de conversi�n de una unidad a otra
	function factor_conversion($unidad_origen, $unidad_destino, $db, $enlace)
	{
		mysql_select_db($db, $enlace);
		
		$query_datos_und_origen = "SELECT UNIDAD_EQUIV FROM unidad WHERE UNIDAD_ID = $unidad_origen";
		$res_datos_und_origen = mysql_query($query_datos_und_origen, $enlace) or die(rollback());
		$row_datos_und_origen = mysql_fetch_assoc($res_datos_und_origen);
		
		$query_datos_und_destino = "SELECT UNIDAD_EQUIV FROM unidad WHERE UNIDAD_ID = $unidad_destino";
		$res_datos_und_destino = mysql_query($query_datos_und_destino, $enlace) or die(rollback());
		$row_datos_und_destino = mysql_fetch_assoc($res_datos_und_destino);

		$factor = $row_datos_und_origen['UNIDAD_EQUIV'] / $row_datos_und_destino['UNIDAD_EQUIV'];
		
		return $factor;
	}
	
}