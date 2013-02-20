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
            $animacion=array(
                'fade',
                'grow',
                'swing',
                'fall',
            );
            $this->widget('ext.tooltipster.tooltipster',array(
                          'identifier'=>'.men-ayuda',
                          'options'=>array(
                                'animation'=>$animacion[rand(0,3)],
                                'iconTouch'=>true,
                                'delay'=>10,
                                'fixedWidth'=>300,
                                'position'=>'right',
                                'interactive'=>true,
                                'interactiveTolerance'=>'5000',
                                'speed'=>800,
                                'theme'=>'.tooltipster-shadow',
                                'trigger'=>'hover'
                           )
                    ));
            $imagen= CHtml::image(Yii::app()->baseUrl."/images/warning.png",'Ayuda',array('class'=>'img men-ayuda','title'=>Yii::t('ayuda',$texto), 'style'=>'width: 20px;'));
            return $imagen;
        }
	/**
         * este metodo sera lamado para mostrar el mensaje al momento de borrar un registro
         * @return string Funcion js para validar mensaje de error 
         */
	public function mensajeBorrar(){
		$borrar_success = MensajeSistema::model()->findByPk('S004');
		$borrar_error = MensajeSistema::model()->findByPk('E004');
		$mensaje_p1='$("#mensaje").html("<div class=';
		$mensaje_p2='><button type=\'button\' class=\'close\' data-dismiss=\'alert\'>&times;</button><font size=\'4\' align=\'left\'>&nbsp &nbsp';
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
		Yii::app()->user->setFlash($mensaje_->TIPO, '<font size="4" align="left">&nbsp &nbsp<img src='.Yii::app()->baseUrl.$img_url.'>&nbsp &nbsp'.$mensaje_->MENSAJE.'.</font>');
		//$this->widget('bootstrap.widgets.TbAlert');
                $this->widget('bootstrap.widgets.TbAlert', array(
                    'block'=>true, // display a larger alert block?
                    'fade'=>true, // use transitions?
                    'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
                    'htmlOptions'=>array('class'=>'reducir'),
                ));
	}
        
        /**
         * Metodo para ser llamado desde las opciones de compras para retornar mensajes sobre las operaciones
         * @param string $codigo
         * @param string $imagen
         * @param int $contador
         * @param string $ids
         */
        
        public function men_compras($codigo, $imagen, $contador, $ids){
            $mensaje = MensajeSistema::model()->findByPk($codigo);
            Yii::app()->user->setFlash($mensaje->TIPO, '<font size="4" align="left">&nbsp &nbsp<img src='.Yii::app()->baseUrl.$imagen.'>&nbsp &nbsp'.$mensaje->MENSAJE.', '.$contador.' petición(es) procesada(s): ('.$ids.')</font>');
            $this->widget('bootstrap.widgets.TbAlert', array(
                    'block'=>true, // display a larger alert block?
                    'fade'=>true, // use transitions?
                    'closeText'=>'&times;', // close link text - if set to false, no close link is displayed
                ));
            
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
         * Este metodo es usado para verificar si ya se ha creado una configuracion
         * en cualquier modulo del sitema
         * @return boolean Retorna true si la configuracion ya ha sido creada, 
         * y false si aun no ha sido configurada.
         */
        protected function isConfig($model) {
        $model = new $model;
        if ($model->find())
            return true;
        return false;
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
        
        $faltaConfig = array('style'=>'background-color: #BEF781;font-style: italic;font-weight: bold;');
				
		$this->menu = array(
                            array('label' => 'Inicio', 'url' => array('/site/index')),
                    array('label' => 'Reportes', 'url' => '#',
                                'items' => array(
                                    array('label'=>'Cierre de ventas', 'url'=>array('/reportes/ventas')),
                                    array('label'=>'Inventario', 'url'=>array('/reportes/inventario')),
                                    array('label'=>'Ordenes de compra', 'url'=>array('/reportes/ordenCompra')),
                    )),
                            array('label' => 'Facturación', 'url' => '#',
                                'items' => array(
                                    array('label'=>'Ensamble de articulos', 'url'=>array('/articuloEnsamble/admin')),
                                    array('label'=>'Precios de Articulos', 'url'=>array('/articuloPrecio/admin')),
                                    array('label'=>'Pedidos', 'url'=>array('/pedido/admin')),
                                    array('label'=>'Facturas', 'url'=>array('/factura/admin')),
                                    '-',
                                    array('label'=>'Clientes', 'url'=>array('/cliente/admin'),'linkOptions'=>$this->isConfig('Cliente') ? array(): $faltaConfig),
                                    array('label'=>'Consecutivos', 'url'=>array('/consecutivoFa/admin'),'linkOptions'=>$this->isConfig('ConsecutivoFa') ? array(): $faltaConfig),
                                    array('label' => 'Configuración', 'url' => $fac ? array('/confFa/update', 'id' => $fac->ID) : array('/confFa/create'),'linkOptions'=>$this->isConfig('ConfFa') ? array(): $faltaConfig),
                                    '-',
                                    array('label'=>'Ayuda', 'url'=>'http://tramasoft.com/manuales-siasoft/Modulo%206%20-%20Facturacion.pdf','linkOptions'=>array('target'=>'_blank')),
                                    )
							),
                            array('label' => 'Compras', 'url' => '#',
                                'items' => array(
                                    array('label' => 'Solicitudes', 'url' => array('/solicitudOc/admin')),
                                    array('label' => 'Ordenes', 'url' => array('/ordenCompra/admin')),
                                    array('label' => 'Ingresos', 'url' => array('/ingresoCompra/admin')),
                                    '-',
                                    array('label' => 'Proveedores', 'url' => array('/proveedor/admin'),'linkOptions'=>$this->isConfig('Proveedor') ? array(): $faltaConfig),
                                    array('label' => 'Configuración', 'url' => $com ? array('/confCo/update', 'id' => $com->ID) : array('/confCo/create'),'linkOptions'=>$this->isConfig('ConfCo') ? array(): $faltaConfig),
                                    '-',
                                    array('label'=>'Ayuda', 'url'=>'http://tramasoft.com/manuales-siasoft/Modulo%205%20-%20Compras.pdf','linkOptions'=>array('target'=>'_blank')),
                                    
                                )
                            ),
                            array('label' => 'Inventario', 'url' => '#',
                                'items' => array(
                                    array('label' => 'Artículos', 'url' => array('/articulo/admin')),
                                    array('label' => 'Asociación de artículos a Bodegas', 'url' => array('/bodega/inventario')),
                                    array('label' => 'Clasificaciones', 'url' => array('/clasificacionAdi/admin')),
                                    array('label' => 'SubClasificaciones ', 'url' => array('/clasificacionAdiValor/admin')),
                                    array('label' => 'Documentos', 'url' => array('/documentoInv/admin')),
                                    '-',
                                    array('label' => 'Tipos de artículo', 'url' => array('/tipoArticulo/admin')),
                                    array('label' => 'Metodos de Valuacion', 'url' => array('/metodoValuacionInv/admin')),
                                    array('label' => 'Tipos de Transacción', 'url' => array('/tipoTransaccion/admin'),'linkOptions'=>$this->isConfig('TipoTransaccion') ? array(): $faltaConfig),
                                    array('label' => 'Consecutivos', 'url' => array('/consecutivoCi/admin'),'linkOptions'=>$this->isConfig('ConsecutivoCi') ? array(): $faltaConfig),
                                    array('label' => 'Unidades de medida', 'url' => array('/unidadMedida/admin'),'linkOptions'=>$this->isConfig('UnidadMedida') ? array(): $faltaConfig),
                                    array('label' => 'Configuración', 'url' => array('/confCi/create'),'linkOptions'=>$this->isConfig('ConfCi') ? array(): $faltaConfig),
                                    '-',
                                    array('label'=>'Ayuda', 'url'=>'http://tramasoft.com/manuales-siasoft/Modulo%204%20-%20Inventario.pdf','linkOptions'=>array('target'=>'_blank')),
                                    
                                )
                            ),
							
                            array('label' => 'Sistema', 'url' => '#',
                                'items' => array(
                                    array('label' => Yii::t('app', 'COMPANY'), 'url' => $compa ? array('/compania/update', 'id' => $compa->ID) : array('/compania/create'),'linkOptions'=>$this->isConfig('Compania') ? array(): $faltaConfig),
                                    array('label' => Yii::t('app', 'ADMINISTRATION_SETTINGS'), 'url' => $admin ? array('/confAs/update', 'id' => $admin->ID) : array('/confAs/create'),'linkOptions'=>$this->isConfig('ConfAs') ? array(): $faltaConfig),
                                    array('label' => 'Zonas', 'url' => array('/zona/admin'),'linkOptions'=>$this->isConfig('Zona') ? array(): $faltaConfig),
                                    array('label' => 'Bodegas', 'url' => array('/bodega/admin'),'linkOptions'=>$this->isConfig('Bodega') ? array(): $faltaConfig),
                                    array('label' => 'Categorías clientes y proveedores', 'url' => array('/categoria/admin'),'linkOptions'=>$this->isConfig('Categoria') ? array(): $faltaConfig),
                                    array('label' => 'Centros de costos', 'url' => array('/centroCostos/admin'),'linkOptions'=>$this->isConfig('CentroCostos') ? array(): $faltaConfig),
                                    array('label' => 'Condiciónes de pago', 'url' => array('/codicionPago/admin'),'linkOptions'=>$this->isConfig('CodicionPago') ? array(): $faltaConfig),
                                    array('label' => 'Dependencias', 'url' => array('/departamento/admin'),'linkOptions'=>$this->isConfig('Departamento') ? array(): $faltaConfig),
                                    array('label' => 'Tipos de documento', 'url' => array('/tipoDocumento/admin'),'linkOptions'=>$this->isConfig('TipoDocumento') ? array(): $faltaConfig),
                                    array('label' => 'Relación de Nits', 'url' => array('nit/admin'),'linkOptions'=>$this->isConfig('Nit') ? array(): $faltaConfig),
                                    array('label' => 'Entidades Financieras', 'url' => array('/entidadFinanciera/admin'),'linkOptions'=>$this->isConfig('EntidadFinanciera') ? array(): $faltaConfig),
                                    array('label'=>'Tipos de precio', 'url'=>array('/nivelPrecio/admin'),'linkOptions'=>$this->isConfig('NivelPrecio') ? array(): $faltaConfig),
                                    array('label' => 'Tipos de tarjeta', 'url' => array('/tipoTarjeta/admin'),'linkOptions'=>$this->isConfig('TipoTarjeta') ? array(): $faltaConfig),
                                    array('label' => 'Días Feriados', 'url' => array('/diaFeriado/admin'),'linkOptions'=>$this->isConfig('DiaFeriado') ? array(): $faltaConfig),
                                    array('label' => 'Administración de Reportes', 'url' => array('/formatoImpresion/admin'),'linkOptions'=>$this->isConfig('FormatoImpresion') ? array(): $faltaConfig),
                                    array('label' => 'Papelera de Reciclaje', 'url' => array('/Papelera/index')),
                                    '-',
                                    array('label'=>'Ayuda', 'url'=>'http://tramasoft.com/manuales-siasoft/Modulo%203%20-%20Sistema.pdf','linkOptions'=>array('target'=>'_blank')),
                                    
                            )),
                    array('label' => 'Varios', 'url' => '#',
                                'items' => array(
                                    array('label' => Yii::t('app', 'COUNTRY'), 'url' => array('/pais/admin')),
                                    array('label' => 'Departamento', 'url' => array('/ubicacionGeografica1/admin')),
                                    array('label' => 'Municipio', 'url' => array('/ubicacionGeografica2/admin')),
                                    array('label' => 'Impuestos', 'url' => array('/impuesto/admin')),
                                    array('label' => 'Retenciones', 'url' => array('/retencion/admin')),
                                    array('label'=>'Régimen Tributario', 'url'=>array('/regimenTributario/admin')),
                                    '-',
                                    array('label'=>'Ayuda', 'url'=>'http://tramasoft.com/manuales-siasoft/Modulo%202%20-%20Varios.pdf','linkOptions'=>array('target'=>'_blank')),
                                    
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
                            array('label' => 'Usuarios', 'url' => '#',
                                'items' => array(
                                    array('label' => 'Crear', 'url' => array('/cruge/ui/usermanagementcreate')),
                                    array('label' => 'Administrar', 'url' => array('/cruge/ui/usermanagementadmin')),
                                    '-',
                                    array('label' => 'Roles', 'url' => array('/cruge/ui/rbaclistroles')),
                                    array('label' => 'Asignar Roles a usuarios', 'url' => array('/cruge/ui/rbacusersassignments')),
                                    array('label' => 'Registro de Sesiones', 'url' => array('/cruge/ui/sessionadmin')),
                                    '-',
                                    array('label'=>'Ayuda', 'url'=>'http://tramasoft.com/manuales-siasoft/Modulo%201%20-%20Usuarios.pdf','linkOptions'=>array('target'=>'_blank')),
                                    
                                 ),
                            ),
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
                                $factor = $existenciaBodega->aRTICULO->uNIDADALMACEN->EQUIVALENCIA/Controller::unformat($unidad->EQUIVALENCIA);
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
        public  function darBotonBuscar($url,$string = false,$htmlOptions=array('data-toggle'=>'modal','style'=>'margin-top: 5px;')){
            return $this->widget('bootstrap.widgets.TbButton', array(
                                  'type'=>'info',
                                  'url'=>$url,
                                  'icon'=>'search white',
                                  'htmlOptions'=>$htmlOptions,
                            ),$string);
        }
        /**
         * Metodo para retornar un Boton de Nuevo en admins
         * @param mixed $url Url del Boton
         * @param array $htmlOptions Opciones HTML del Boton default 'array()'
         * @param array $size tamaño del boton
         * @return TbButton 
         */
        public  function darBotonNuevo($url=array('create'),$htmlOptions=array(),$size='small'){
            return $this->widget('bootstrap.widgets.TbButton', array(
                                  'label'=>'Nuevo',
                                  'size'=>$size,
                                  'type'=>'success',
                                  'url'=>$url,
                                  'icon'=>'plus white',
                                  'htmlOptions'=>$htmlOptions,
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
                                  'size'=>'normal',
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
        /**
         * Metodo para retornar un Boton de PDF y EXCEL
         * @param string $label Label del Boton default 'EXCEL'
         * @param mixed $url Url del Boton
         * @param mixed $type type del Boton default 'inverse'
         * @param array $htmlOptions Opciones HTML del Boton default 'array()'
         * @param mixed $url url del Boton default 'array("admin")'
         * @return TbButton 
         */
        public  function darBotonPdfExcel($url,$htmlOptions = array(),$label='EXCEL',$type='inverse'){
            return $this->widget('bootstrap.widgets.TbButton', array(
                                  'label'=>$label,
                                  'type'=>$type,
                                  'size' =>'mini',
                                  'url'=>$url,
                                  'icon' => 'download-alt white',
                                  'htmlOptions'=>$htmlOptions,
                            ));
        }
        /**
         * Metodo para retornar un Boton de Generar en reportes
         * @param array $htmlOptions Opciones HTML del Boton default 'array()'
         * @return TbButton 
         */
        public  function darBotonGenerarReporte($htmlOptions=array()){
            return $this->widget('bootstrap.widgets.TbButton', array(
                                  'buttonType'=>'submit',
                                  'type'=>'primary',
                                  'size' =>'small',
                                  'label'=>'Generar',
                                  'icon'=>'search white',
                                  'htmlOptions'=>$htmlOptions,
                            ));
        }
        /**
         * Metodo para retornar la opcion de calendario
         * @param array $model modelo correspondiente al campo
         * @param array $attribute atributo correspondiente al campo
         * @param array $name nombre correspondiente al campo
         * @param array $htmlOptions Opciones HTML del Boton default 'array()'
         * @return TbButton 
         */
        public  function darCalendario($model=null, $attribute=null, $name=null, $htmlOptions=array('style'=>'width:80px;vertical-align:top')){
            
            if(!isset($htmlOptions['value']) || $htmlOptions['value'] == '')
                    $htmlOptions['value']=date("Y-m-d");
            
            return $this->widget('zii.widgets.jui.CJuiDatePicker',
                         array(
                              'model'=>isset($model) ? $model : null,
                              'attribute'=>isset($attribute) ? $attribute : null,
                              'name'=>isset($name) ? $name : null,
                              'language'=>'es',
                              'options'=>array(
                                     'changeMonth'=>true,
                                     'changeYear'=>true,
                                     'dateFormat'=>'yy-mm-dd',
                                     'constrainInput'=>'false',
                                     'showAnim'=>'fadeIn',
                                     'showOn'=>'both',
                                    'buttonText'=>Yii::t('ui','Seleccione una fecha'), 
                                     'buttonImage'=>Yii::app()->request->baseUrl.'/images/calendar.gif',
                                     'buttonImageOnly'=>true,
                              ),
                              'htmlOptions'=>$htmlOptions,
                ),true);
        }
        
        /**
    * Metodo para mostrar botones del CGridView
    * Segun Permisos, Recibe como parametro
    * los nombres de las 3 acciones del widget
    *
    * @param string $view
    * @param string $update
    * @param string $delete
    * @return mixed $respuesta
    */
   public function getAccess($view,$update,$delete){
       $respuesta = array(
           'class'=>'CButtonColumn',
           'template'=>'',
           'htmlOptions'=>array('style'=>'width: 50px'),
           'afterDelete'=>$this->mensajeBorrar(),
       );
       if(isset($view) && Yii::app()->user->checkAccess($view))
               $respuesta['template'] .='{view}';
       if(isset($update) && Yii::app()->user->checkAccess($update))
           $respuesta['template'] .='{update}';
       if(isset($delete) && Yii::app()->user->checkAccess($delete))
           $respuesta['template'] .='{delete}';
       if($respuesta['template'] != '')
               $respuesta['visible'] = true;
       else
           $respuesta['visible'] = false;
       return $respuesta;
       
   }
}