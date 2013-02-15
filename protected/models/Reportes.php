<?php

/**
 * Reportes class.
 * Reportes is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class Reportes extends CFormModel
{
        /**
         * Fecha inicial (desde) utilizada en los filtros de los reportes
         * @var string 
         */
	public $FECHA_DESDE;
        /**
         * Fecha final (hasta) utilizada en los filtros de los reportes
         * @var string 
         */
	public $FECHA_HASTA;
        /**
         * Listado de bodegas utilizada en los filtros de los reportes
         * @var string
         */
        public $BODEGAS;
        /**
         * Listado de clientes utilizada en los filtros de los reportes
         * @var string
         */
        public $CLIENTES;
        
         /**
         * Listado de los tipos de articulo utilizada en los filtros de los reportes
         * @var string
         */
        public $TIPO_ARTICULOS;
        /**
         * Listado de las cantidades utilizada en los filtros de los reportes
         * @var string
         */
        public $CANTIDADES;
        /**
         * Activo (estado) de los articulos utilizada en los filtros de los reportes
         * @var string
         */
        public $ARTICULOS_ACTIVO;
        
        /**
         * Listado de los estados de ordenes de compra utilizada en los filtros de los reportes
         * @var string
         */
        public $ESTADO_ORDEN_COMP;
        /**
         * Listado de los proveedores utilizada en los filtros de los reportes
         * @var string
         */
        public $PROVEEDOR;
        
        
        /**
	 * @return array validation rules for model attributes.
	 */
        public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
                    
			);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'FECHA_DESDE' => 'Fecha - Desde',
			'FECHA_HASTA' => 'Fecha - Hasta',
                        'BODEGAS'=>'Bodegas',
                        'CLIENTES'=>'Clientes',
                        'TIPO_ARTICULOS'=>'Tipos de artículo',
                        'CANTIDADES'=>'Cantidades',
                        'ARTICULOS_ACTIVO'=>'Artículos activos',
                        'ESTADO_ORDEN_COMP'=>'Estado',
                        'PROVEEDOR'=>'Proveedores',
		);
	}
        
        /**
         * String que recibe el tipo de categoria
         * @param String $tipo
         * @return Arreglo con los clientes y sus respectivas categorias
         */
        public static function getCombo($tipo){
            $respuesta = array();
            $categorias = Categoria::model()->findAllByAttributes(array('ACTIVO'=>'S','TIPO'=>$tipo));
            if ($tipo=='C'){
                foreach ($categorias as $categoria)
                        $respuesta[$categoria->DESCRIPCION]= CHtml::listData(Cliente::model()->findAllByAttributes(array('ACTIVO'=>'S','CATEGORIA'=>$categoria->ID)),'CLIENTE','NOMBRE');
            } else {
                if($tipo=='P'){
                    foreach ($categorias as $categoria)
                        $respuesta[$categoria->DESCRIPCION]= CHtml::listData(Proveedor::model()->findAllByAttributes(array('ACTIVO'=>'S','CATEGORIA'=>$categoria->ID)),'PROVEEDOR','NOMBRE');
                }
            }
            return $respuesta;
        }
}
