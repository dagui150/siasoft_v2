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
	public $fecha_desde;
        /**
         * Fecha final (hasta) utilizada en los filtros de los reportes
         * @var string 
         */
	public $fecha_hasta;
        /**
         * Listado de bodegas utilizada en los filtros de los reportes
         * @var string
         */
        public $bodegas;
        /**
         * Listado de clientes utilizada en los filtros de los reportes
         * @var string
         */
        public $clientes;
        
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
			'fecha_desde' => 'Fecha - Desde',
			'fecha_hasta' => 'Fecha - Hasta',
                        'bodegas'=>'Bodegas',
                        'clientes'=>'Clientes',
		);
	}
}
