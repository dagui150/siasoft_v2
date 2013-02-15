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
		);
	}
        
        public static function getCombo(){
            $respuesta = array();
            $categorias = Categoria::model()->findAllByAttributes(array('ACTIVO'=>'S','TIPO'=>'C'));
            foreach ($categorias as $categoria)
                    $respuesta[$categoria->DESCRIPCION]= CHtml::listData(Cliente::model()->findAllByAttributes(array('ACTIVO'=>'S','CATEGORIA'=>$categoria->ID)),'CLIENTE','NOMBRE');
            return $respuesta;
        }
}
