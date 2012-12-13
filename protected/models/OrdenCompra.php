<?php

/**
 * This is the model class for table "orden_compra".
 *
 * The followings are the available columns in table 'orden_compra':
 * @property string $ORDEN_COMPRA
 * @property string $PROVEEDOR
 * @property string $FECHA
 * @property string $BODEGA
 * @property string $DEPARTAMENTO
 * @property string $FECHA_COTIZACION
 * @property string $FECHA_OFRECIDA
 * @property string $FECHA_REQUERIDA
 * @property string $FECHA_REQ_EMBARQUE
 * @property string $PRIORIDAD
 * @property string $CONDICION_PAGO
 * @property string $DIRECCION_EMBARQUE
 * @property string $DIRECCION_COBRO
 * @property string $RUBRO1
 * @property string $RUBRO2
 * @property string $RUBRO3
 * @property string $RUBRO4
 * @property string $RUBRO5
 * @property string $COMENTARIO_CXP
 * @property string $INSTRUCCIONES
 * @property string $OBSERVACIONES
 * @property string $PORC_DESCUENTO
 * @property string $MONTO_FLETE
 * @property string $MONTO_SEGURO
 * @property string $MONTO_ANTICIPO
 * @property string $TIPO_PRORRATEO_OC
 * @property string $TOTAL_A_COMPRAR
 * @property string $USUARIO_CANCELA
 * @property string $FECHA_CANCELA
 * @property string $ESTADO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property Proveedor $pROVEEDOR
 * @property Bodega $bODEGA
 * @property CodicionPago $cONDICIONPAGO
 * @property Departamento $dEPARTAMENTO
 * @property OrdenCompraLinea[] $ordenCompraLineas
 * @property SolicitudOrdenCo[] $solicitudOrdenCos
 */
class OrdenCompra extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrdenCompra the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'orden_compra';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ORDEN_COMPRA, PROVEEDOR, FECHA, BODEGA, DEPARTAMENTO, PRIORIDAD, CONDICION_PAGO, PORC_DESCUENTO, MONTO_FLETE, MONTO_SEGURO, MONTO_ANTICIPO, ESTADO', 'required'),
			array('ORDEN_COMPRA, DEPARTAMENTO', 'length', 'max'=>10),
			array('PROVEEDOR, USUARIO_CANCELA, CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('BODEGA, CONDICION_PAGO', 'length', 'max'=>4),
			array('PRIORIDAD, ESTADO', 'length', 'max'=>1),
			array('DIRECCION_EMBARQUE, DIRECCION_COBRO, COMENTARIO_CXP, INSTRUCCIONES', 'length', 'max'=>250),
			array('RUBRO1, RUBRO2, RUBRO3, RUBRO4, RUBRO5', 'length', 'max'=>50),
			array('PORC_DESCUENTO, MONTO_FLETE, MONTO_SEGURO, MONTO_ANTICIPO, TOTAL_A_COMPRAR', 'length', 'max'=>28),
			array('TIPO_PRORRATEO_OC', 'length', 'max'=>3),
			array('FECHA_COTIZACION, FECHA_OFRECIDA, FECHA_REQUERIDA, FECHA_REQ_EMBARQUE, OBSERVACIONES, FECHA_CANCELA', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ORDEN_COMPRA, PROVEEDOR, FECHA, BODEGA, DEPARTAMENTO, FECHA_COTIZACION, FECHA_OFRECIDA, FECHA_REQUERIDA, FECHA_REQ_EMBARQUE, PRIORIDAD, CONDICION_PAGO, DIRECCION_EMBARQUE, DIRECCION_COBRO, RUBRO1, RUBRO2, RUBRO3, RUBRO4, RUBRO5, COMENTARIO_CXP, INSTRUCCIONES, OBSERVACIONES, PORC_DESCUENTO, MONTO_FLETE, MONTO_SEGURO, MONTO_ANTICIPO, TIPO_PRORRATEO_OC, TOTAL_A_COMPRAR, USUARIO_CANCELA, FECHA_CANCELA, ESTADO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'pROVEEDOR' => array(self::BELONGS_TO, 'Proveedor', 'PROVEEDOR'),
			'bODEGA' => array(self::BELONGS_TO, 'Bodega', 'BODEGA'),
			'cONDICIONPAGO' => array(self::BELONGS_TO, 'CodicionPago', 'CONDICION_PAGO'),
			'dEPARTAMENTO' => array(self::BELONGS_TO, 'Departamento', 'DEPARTAMENTO'),
			'ordenCompraLineas' => array(self::HAS_MANY, 'OrdenCompraLinea', 'ORDEN_COMPRA'),
			'solicitudOrdenCos' => array(self::HAS_MANY, 'SolicitudOrdenCo', 'ORDEN_COMPRA'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
                $conf = ConfCo::model()->find();
		return array(
			'ORDEN_COMPRA' => 'Orden Compra',
			'PROVEEDOR' => 'Proveedor',
			'FECHA' => 'Fecha',
			'BODEGA' => 'Bodega',
			'DEPARTAMENTO' => 'Departamento',
			'FECHA_COTIZACION' => 'Fecha Cotizacion',
			'FECHA_OFRECIDA' => 'Fecha Ofrecida',
			'FECHA_REQUERIDA' => 'Fecha Requerida',
			'FECHA_REQ_EMBARQUE' => 'Fecha Req Ingreso',
			'PRIORIDAD' => 'Prioridad',
			'CONDICION_PAGO' => 'Condicion Pago',
			'DIRECCION_EMBARQUE' => 'Direccion Ingreso',
			'DIRECCION_COBRO' => 'Direccion Cobro',
			'RUBRO1' => $conf->RUBRO1_ORDNOM,
			'RUBRO2' => $conf->RUBRO2_ORDNOM,
			'RUBRO3' => $conf->RUBRO3_ORDNOM,
			'RUBRO4' => $conf->RUBRO4_ORDNOM,
			'RUBRO5' => $conf->RUBRO5_ORDNOM,
			'COMENTARIO_CXP' => 'Comentario para cuentas por pagar',
			'INSTRUCCIONES' => 'Instrucciones',
			'OBSERVACIONES' => 'Observaciones',
			'PORC_DESCUENTO' => 'Porc Descuento',
			'MONTO_FLETE' => 'Monto Flete',
			'MONTO_SEGURO' => 'Monto Seguro',
			'MONTO_ANTICIPO' => 'Monto Anticipo',
			'TIPO_PRORRATEO_OC' => 'Tipo Prorrateo',
			'TOTAL_A_COMPRAR' => '=',
			'USUARIO_CANCELA' => 'Usuario Cancela',
			'FECHA_CANCELA' => 'Fecha Cancela',
			'ESTADO' => 'Estado',
			'CREADO_POR' => 'Creado Por',
			'CREADO_EL' => 'Creado El',
			'ACTUALIZADO_POR' => 'Actualizado Por',
			'ACTUALIZADO_EL' => 'Actualizado El',
			'USUARIO_CIERRA' => 'Cerrado Por',
			'FECHA_CIERRA' => 'Cerrado El',
			'AUTORIZADA_POR' => 'Autorizado Por',
			'FECHA_AUTORIZADA' => 'Autorizado El',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ORDEN_COMPRA',$this->ORDEN_COMPRA,true);
		$criteria->compare('PROVEEDOR',$this->PROVEEDOR,true);
		$criteria->compare('FECHA',$this->FECHA,true);
		$criteria->compare('BODEGA',$this->BODEGA,true);
		$criteria->compare('DEPARTAMENTO',$this->DEPARTAMENTO,true);
		$criteria->compare('FECHA_COTIZACION',$this->FECHA_COTIZACION,true);
		$criteria->compare('FECHA_OFRECIDA',$this->FECHA_OFRECIDA,true);
		$criteria->compare('FECHA_REQUERIDA',$this->FECHA_REQUERIDA,true);
		$criteria->compare('FECHA_REQ_EMBARQUE',$this->FECHA_REQ_EMBARQUE,true);
		$criteria->compare('PRIORIDAD',$this->PRIORIDAD,true);
		$criteria->compare('CONDICION_PAGO',$this->CONDICION_PAGO,true);
		$criteria->compare('DIRECCION_EMBARQUE',$this->DIRECCION_EMBARQUE,true);
		$criteria->compare('DIRECCION_COBRO',$this->DIRECCION_COBRO,true);
		$criteria->compare('RUBRO1',$this->RUBRO1,true);
		$criteria->compare('RUBRO2',$this->RUBRO2,true);
		$criteria->compare('RUBRO3',$this->RUBRO3,true);
		$criteria->compare('RUBRO4',$this->RUBRO4,true);
		$criteria->compare('RUBRO5',$this->RUBRO5,true);
		$criteria->compare('COMENTARIO_CXP',$this->COMENTARIO_CXP,true);
		$criteria->compare('INSTRUCCIONES',$this->INSTRUCCIONES,true);
		$criteria->compare('OBSERVACIONES',$this->OBSERVACIONES,true);
		$criteria->compare('PORC_DESCUENTO',$this->PORC_DESCUENTO,true);
		$criteria->compare('MONTO_FLETE',$this->MONTO_FLETE,true);
		$criteria->compare('MONTO_SEGURO',$this->MONTO_SEGURO,true);
		$criteria->compare('MONTO_ANTICIPO',$this->MONTO_ANTICIPO,true);
		$criteria->compare('TIPO_PRORRATEO_OC',$this->TIPO_PRORRATEO_OC,true);
		$criteria->compare('TOTAL_A_COMPRAR',$this->TOTAL_A_COMPRAR,true);
		$criteria->compare('USUARIO_CANCELA',$this->USUARIO_CANCELA,true);
		$criteria->compare('FECHA_CANCELA',$this->FECHA_CANCELA,true);
		$criteria->compare('ESTADO',$this->ESTADO,true);
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);
		$criteria->compare('USUARIO_CIERRA',$this->CREADO_POR,true);
		$criteria->compare('FECHA_CIERRA',$this->CREADO_EL,true);
		$criteria->compare('AUTORIZADA_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('FECHA_AUTORIZADA',$this->ACTUALIZADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function estado($codigo){
            switch ($codigo){
                case 'P' : return 'Planeado';
                break;
                case 'B' : return 'Backorder';
                break;
                case 'R' : return 'Recibido';
                break;
                case 'C' : return 'Cancelado';
                break;
                case 'A' : return 'Autorizado';
                break;
                case 'E' : return 'Cerrada';
                break;
            }
        }
        
        public static function prioridad($codigo){
            
            switch($codigo){
                case 'A' : return 'Alta';
                    break;
                case 'M' : return 'Media';
                    break;
                case 'B' : return 'Baja';
                    break;
            }
        }

        public function behaviors()
	{
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'CREADO_EL',
				'updateAttribute' => 'ACTUALIZADO_EL',
				'setUpdateOnCreate' => true,
			),
			
			'BlameableBehavior' => array(
				'class' => 'application.components.BlameableBehavior',
				'createdByColumn' => 'CREADO_POR',
				'updatedByColumn' => 'ACTUALIZADO_POR',
			),
		);
	}
}