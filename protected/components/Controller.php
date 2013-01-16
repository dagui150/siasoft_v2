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
	/**
         * Este metodo sera llamado para retornar un boton de ayuda
         * @param string $texto
         * @return string Boton de bootstrap popover 
         */
	public function botonAyuda($texto) {
            $boton = $this->widget('bootstrap.widgets.TbButton', array(
                        'type' => 'nommal', // '', 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
                        'size' => 'normal', // '', 'large', 'small' or 'mini'
                        'icon' => 'info-sign',
                        'htmlOptions'=>array('data-title'=>'Ayuda', 'data-content'=>Yii::t('ayuda',$texto), 'rel'=>'popover'),
                    ),true);
            return $boton;
        }
	/**
         * este metodo sera lamado para mostrar el mensaje al momento de borrar un registro
         * @return string Funcion js para validar mensaje de error 
         */
	public function mensajeBorrar(){
		$borrar_success = MensajeSistema::model()->findByPk('S004');
		$borrar_error = MensajeSistema::model()->findByPk('E004');
		$mensaje_p1='$("#mensaje").html("<div class=';
		$mensaje_p2='><button type=\'button\' class=\'close\' data-dismiss=\'alert\'>&times;</button><font size=\'5\' align=\'left\'>&nbsp &nbsp';
		$mensaje_p3='.</font></div> ");';
		$mensaje_success=$mensaje_p1.'\'alert alert-success\''.$mensaje_p2.'<img src='.Yii::app()->baseUrl."/images/success.png".'>&nbsp&nbsp'.$borrar_success->MENSAJE.$mensaje_p3;
		$mensaje_error=$mensaje_p1.'\'alert alert-error\''.$mensaje_p2.'<img src='.Yii::app()->baseUrl."/images/error.png".'>&nbsp&nbsp'.$borrar_error->MENSAJE.$mensaje_p3;
		return 'function(link,success,data){ if(success){'.$mensaje_success.'}else{window.alert = null;'.$mensaje_error.'}}';
	}
	/**
         * este metodo retorna un mensaje segun la operacion que se este haciendo
         * @param string $men_ 
         */
	public function mensaje($men_){
		$mensaje_ = MensajeSistema::model()->findByPk($men_);
		$img_=substr($men_, 0,1);
		switch ($img_){
			case 'S':
			$img_url="/images/success.png";
			break;
			case 'E':
			$img_url="/images/error.png";
			break;
		}
		Yii::app()->user->setFlash($mensaje_->TIPO, '<font size="5" align="left">&nbsp &nbsp<img src='.Yii::app()->baseUrl.$img_url.'>&nbsp &nbsp'.$mensaje_->MENSAJE.'.</font>');
		$this->widget('bootstrap.widgets.TbAlert');
	}
        /**
         * Este metodo sera llamado para desformatear un numero que venga con comas(,) y puntos (.)
         * @param string $valor
         * @return string Texto sin comas ni puntos 
         */
        public static function unformat($valor){
            $trans = array('.' => '');
            $trans2 = array(',' => '.');
            $valorunformat=strtr(strtr($valor, $trans), $trans2);
            return $valorunformat;
        }
	
	/**
         * Este metodo sera llamado para retornar el menu del sistema
	 * con los items desplegados por cruge y extras como logout
         * @return array con los items para un menu 
         */
	public function menu(){
		/*$this->menu = Yii::app()->user->rbac->getMenu();
		$this->menu[]=  array('label'=>'Administrar Usuarios', 'url'=>Yii::app()->user->ui->userManagementAdminUrl, 'visible'=>!Yii::app()->user->isGuest && Yii::app()->user->isSuperAdmin ? true : false,
                                'items'=>Yii::app()->user->ui->adminItems);
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
                                    array('label' => 'Artículos', 'url' => array('/articulo/admin')),
                                    array('label' => 'Asociación de artículos a Bodegas', 'url' => array('/bodega/inventario')),
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
                                    array('label' => 'Categorías clientes y proveedores', 'url' => array('/categoria/admin')),
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
                                    array('label' => 'Papelera', 'url' => array('/Papelera/index')),
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
                            array('label'=>'Administrar Usuarios', 'url'=>Yii::app()->user->ui->userManagementAdminUrl, 'visible'=>!Yii::app()->user->isGuest && Yii::app()->user->isSuperAdmin ? true : false,
                                'items'=>Yii::app()->user->ui->adminItems),
                            array('label'=>'Salir ('.Yii::app()->user->name.')', 'url'=>Yii::app()->user->ui->logoutUrl,'visible'=>!Yii::app()->user->isGuest),
                        );
		return $this->menu;
		
	}
	
	/**
         * Este metodo convierte una unidad a otra segun su equivalencia
         * @param ExistenciaBodega $existenciaBodega
         * @param integer $cantidad
         * @param integer $id_unidad
         * @return integer cantidad equivalente a restar en el inventario 
         */
	public static function darCantidad($existenciaBodega, $cantidad, $id_unidad)
	{
                $unidad = UnidadMedida::model()->findByPk($id_unidad);
                $cantidad_equiv =$cantidad;
		//Si es tipo servicio no se actualiza el inventario
		if($existenciaBodega->aRTICULO->UNIDAD_ALMACEN != $id_unidad && $existenciaBodega->aRTICULO->uNIDADALMACEN->TIPO != 'S'){
                            //equivalencia
                            $factor = $existenciaBodega->aRTICULO->uNIDADALMACEN->EQUIVALENCIA/$unidad->EQUIVALENCIA;
                            $cantidad_equiv = $cantidad * $factor;
                    
                }
                return $cantidad_equiv;
	}
        /**
         * Metodo para retornar un Boton de Buscar Para modales
         * @param mixed $url Url para la modal
         * @param string $string Define si el boton es un String o no
         * @param array $htmlOptions Opciones HTML del Boton default 'array('data-toggle'=>'modal','style'=>'margin-top: 5px;')'
         * @return TbButton 
         */
        public  function darBotonBuscar($url,$string = false){
            return $this->widget('bootstrap.widgets.TbButton', array(
                                  'type'=>'info',
                                  'url'=>$url,
                                  'icon'=>'search white',
                                  'htmlOptions'=>array('data-toggle'=>'modal','style'=>'margin-top: 5px;'),
                            ),$string);
        }
        /**
         * Metodo para retornar un Boton de Nuevo en admins
         * @return TbButton 
         */
        public  function darBotonNuevo(){
            return $this->widget('bootstrap.widgets.TbButton', array(
                                  'label'=>'Nuevo',
                                  'size'=>'small',
                                  'type'=>'success',
                                  'url'=>array('create'),
                                  'icon'=>'plus white',
                            ));
        }
        /**
         * Metodo para retornar un Boton de Nuevo en Lineas
         * @param string $label Label del Boton default 'Nuevo'
         * @param mixed $htmlOptions Opciones HTML del Boton default 'array()'
         * @return TbButton 
         */
        public  function darBotonAddLinea($label = 'Nuevo',$htmlOptions = array()){
            return $this->widget('bootstrap.widgets.TbButton', array(
                                  'buttonType'=>'button',
                                  'label'=>$label,
                                  'size'=>'small',
                                  'type'=>'success',
                                  'icon'=>'plus white',
                                  'htmlOptions'=>$htmlOptions,
                            ));
        }
        /**
         * Metodo para retornar un Boton de Actualizar en Lineas
         * @param mixed $htmlOptions Opciones HTML del Boton default 'array()'
         * @return TbButton 
         */
        public  function darBotonUpdateLinea($htmlOptions = array()){
            return $this->widget('bootstrap.widgets.TbButton', array(
                                  'buttonType'=>'button',
                                  'size'=>'small',
                                  'icon'=>'pencil',
                                  'htmlOptions'=>$htmlOptions,
                            ));
        }
        /**
         * Metodo para retornar un Boton de Eliminar en Lineas
         * @param string $label Label del Boton default 'Nuevo'
         * @param mixed $htmlOptions Opciones HTML del Boton default 'array()'
         * @return TbButton 
         */
        public  function darBotonDeleteLinea($label = 'Eliminar',$htmlOptions = array()){
            return $this->widget('bootstrap.widgets.TbButton', array(
                                  'buttonType'=>'button',
                                  'label'=>$label,
                                  'size'=>'small',
                                  'type'=>'danger',
                                  'icon'=>'minus white',
                                  'htmlOptions'=>$htmlOptions,
                            ));
        }
        /**
         * Metodo para retornar un Boton de Enviar formulario
         * @param string $label Label del Boton
         * @param array $htmlOptions Opciones HTML del Boton default 'array()'
         * @return TbButton 
         */
        public  function darBotonEnviar($label = '',$htmlOptions = array()){
            return $this->widget('bootstrap.widgets.TbButton', array(
                                  'buttonType'=>'submit',
                                  'type'=>'primary',
                                  'size' =>'small',
                                  'label'=>$label,
                                  'icon'=>'ok-circle white',
                                  'htmlOptions'=>$htmlOptions,
                            ));
        }
        /**
         * Metodo para retornar un Boton de Enviar formulario
         * @param array $htmlOptions Opciones HTML del Boton default 'array()'
         * @param mixed $url url del Boton default 'array("admin")'
         * @return TbButton 
         */
        public  function darBotonCancelar($htmlOptions = array(),$url = array('admin')){
            return $this->widget('bootstrap.widgets.TbButton', array(
                                  'buttonType'=>'link',
                                  'label'=>'Cancelar',
                                  'size' =>'small',
                                  'url'=>$url,
                                  'icon'=>'remove',
                                  'htmlOptions'=>$htmlOptions,
                            ));
        }
}