<?php

/**
 * This is the model class for table "factura".
 *
 * The followings are the available columns in table 'factura':
 * @property string $FACTURA
 * @property string $CLIENTE
 * @property string $BODEGA
 * @property string $CONDICION_PAGO
 * @property string $NIVEL_PRECIO
 * @property string $PEDIDO
 * @property string $FECHA_FACTURA
 * @property string $FECHA_DESPACHO
 * @property string $FECHA_ENTREGA
 * @property string $ORDEN_COMPRA
 * @property string $FECHA_ORDEN
 * @property string $RUBRO1
 * @property string $RUBRO2
 * @property string $RUBRO3
 * @property string $RUBRO4
 * @property string $RUBRO5
 * @property string $COMENTARIOS_CXC
 * @property string $OBSERVACIONES
 * @property string $TOTAL_MERCADERIA
 * @property string $MONTO_ANTICIPO
 * @property string $MONTO_FLETE
 * @property string $MONTO_SEGURO
 * @property string $MONTO_DESCUENTO1
 * @property string $TOTAL_IMPUESTO1
 * @property string $TOTAL_A_FACTURAR
 * @property string $REMITIDO
 * @property string $RESERVADO
 * @property string $ESTADO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property Pedido $pEDIDO
 * @property Bodega $bODEGA
 * @property Cliente $cLIENTE
 * @property CodicionPago $cONDICIONPAGO
 * @property NivelPrecio $nIVELPRECIO
 * @property FacturaLinea[] $facturaLineas
 */
class Factura extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Factura the static model class
	 */
         public $ARTICULO;
         public $UNIDAD;
         public $CANTIDAD;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'factura';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CONSECUTIVO,CLIENTE,FACTURA, FECHA_FACTURA, TOTAL_MERCADERIA, MONTO_ANTICIPO, MONTO_FLETE, MONTO_SEGURO, MONTO_DESCUENTO1, TOTAL_IMPUESTO1, TOTAL_A_FACTURAR, REMITIDO, RESERVADO, ESTADO', 'required'),
			array('FACTURA, PEDIDO, RUBRO1, RUBRO2, RUBRO3, RUBRO4, RUBRO5, COMENTARIOS_CXC', 'length', 'max'=>50),
			array('CLIENTE, CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('BODEGA, CONDICION_PAGO', 'length', 'max'=>4),
			array('NIVEL_PRECIO', 'length', 'max'=>12),
			array('ORDEN_COMPRA', 'length', 'max'=>30),
                        array('ARTICULO', 'exist', 'attributeName'=>'ARTICULO', 'className'=>'Articulo','allowEmpty'=>true),
			array('TOTAL_MERCADERIA, MONTO_ANTICIPO, MONTO_FLETE, MONTO_SEGURO, MONTO_DESCUENTO1, TOTAL_IMPUESTO1, TOTAL_A_FACTURAR', 'length', 'max'=>28),
			array('REMITIDO, RESERVADO, ESTADO', 'length', 'max'=>1),
			array('FECHA_DESPACHO, FECHA_ENTREGA, FECHA_ORDEN, OBSERVACIONES', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('FACTURA, CLIENTE, BODEGA, CONDICION_PAGO, NIVEL_PRECIO, PEDIDO, FECHA_FACTURA, FECHA_DESPACHO, FECHA_ENTREGA, ORDEN_COMPRA, FECHA_ORDEN, RUBRO1, RUBRO2, RUBRO3, RUBRO4, RUBRO5, COMENTARIOS_CXC, OBSERVACIONES, TOTAL_MERCADERIA, MONTO_ANTICIPO, MONTO_FLETE, MONTO_SEGURO, MONTO_DESCUENTO1, TOTAL_IMPUESTO1, TOTAL_A_FACTURAR, REMITIDO, RESERVADO, ESTADO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
		);
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
        
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'pEDIDO' => array(self::BELONGS_TO, 'Pedido', 'PEDIDO'),
			'bODEGA' => array(self::BELONGS_TO, 'Bodega', 'BODEGA'),
			'cLIENTE' => array(self::BELONGS_TO, 'Cliente', 'CLIENTE'),
			'cONDICIONPAGO' => array(self::BELONGS_TO, 'CodicionPago', 'CONDICION_PAGO'),
			'nIVELPRECIO' => array(self::BELONGS_TO, 'NivelPrecio', 'NIVEL_PRECIO'),
			'facturaLineas' => array(self::HAS_MANY, 'FacturaLinea', 'FACTURA'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
                $conf_fa = ConfFa::model()->find();
		return array(
			'FACTURA' => 'Factura',
			'CONSECUTIVO' => 'Factura',
			'CLIENTE' => 'Cliente',
			'ARTICULO' => 'Articulo',
			'BODEGA' => 'Bodega',
			'CONDICION_PAGO' => 'Cond. Pago',
			'NIVEL_PRECIO' => 'Tipo Precio',
			'PEDIDO' => 'Pedido',
			'FECHA_FACTURA' => 'Fecha',
			'FECHA_DESPACHO' => 'Despacho',
			'FECHA_ENTREGA' => 'Entrega',
			'ORDEN_COMPRA' => 'Orden',
			'FECHA_ORDEN' => 'Fecha',
                        'RUBRO1' => $conf_fa->USAR_RUBROS && $conf_fa->RUBRO1_NOMBRE != '' ? $conf_fa->RUBRO1_NOMBRE : 'Rubro 1',
			'RUBRO2' => $conf_fa->USAR_RUBROS && $conf_fa->RUBRO2_NOMBRE != '' ? $conf_fa->RUBRO2_NOMBRE : 'Rubro 2',
			'RUBRO3' => $conf_fa->USAR_RUBROS && $conf_fa->RUBRO3_NOMBRE != '' ? $conf_fa->RUBRO3_NOMBRE : 'Rubro 3',
			'RUBRO4' => $conf_fa->USAR_RUBROS && $conf_fa->RUBRO4_NOMBRE != '' ? $conf_fa->RUBRO4_NOMBRE : 'Rubro 4',
			'RUBRO5' => $conf_fa->USAR_RUBROS && $conf_fa->RUBRO5_NOMBRE != '' ? $conf_fa->RUBRO5_NOMBRE : 'Rubro 5',
			'COMENTARIOS_CXC' => 'Comentarios Cxc',
			'OBSERVACIONES' => 'Observaciones',
			'TOTAL_MERCADERIA' => 'Total Mercaderia',
			'MONTO_ANTICIPO' => 'Monto Anticipo',
			'MONTO_FLETE' => 'Monto Flete',
			'MONTO_SEGURO' => 'Monto Seguro',
			'MONTO_DESCUENTO1' => 'Monto Descuento1',
			'TOTAL_IMPUESTO1' => 'Total Impuesto1',
			'TOTAL_A_FACTURAR' => 'Total A Facturar',
			'REMITIDO' => 'Remitido',
			'RESERVADO' => 'Reservado',
			'ESTADO' => 'Estado',
			'CREADO_POR' => 'Creado Por',
			'CREADO_EL' => 'Creado El',
			'ACTUALIZADO_POR' => 'Actualizado Por',
			'ACTUALIZADO_EL' => 'Actualizado El',
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

		$criteria->compare('FACTURA',$this->FACTURA,true);
		$criteria->compare('CLIENTE',$this->CLIENTE,true);
		$criteria->compare('BODEGA',$this->BODEGA,true);
		$criteria->compare('CONDICION_PAGO',$this->CONDICION_PAGO,true);
		$criteria->compare('NIVEL_PRECIO',$this->NIVEL_PRECIO,true);
		$criteria->compare('PEDIDO',$this->PEDIDO,true);
		$criteria->compare('FECHA_FACTURA',$this->FECHA_FACTURA,true);
		$criteria->compare('FECHA_DESPACHO',$this->FECHA_DESPACHO,true);
		$criteria->compare('FECHA_ENTREGA',$this->FECHA_ENTREGA,true);
		$criteria->compare('ORDEN_COMPRA',$this->ORDEN_COMPRA,true);
		$criteria->compare('FECHA_ORDEN',$this->FECHA_ORDEN,true);
		$criteria->compare('RUBRO1',$this->RUBRO1,true);
		$criteria->compare('RUBRO2',$this->RUBRO2,true);
		$criteria->compare('RUBRO3',$this->RUBRO3,true);
		$criteria->compare('RUBRO4',$this->RUBRO4,true);
		$criteria->compare('RUBRO5',$this->RUBRO5,true);
		$criteria->compare('COMENTARIOS_CXC',$this->COMENTARIOS_CXC,true);
		$criteria->compare('OBSERVACIONES',$this->OBSERVACIONES,true);
		$criteria->compare('TOTAL_MERCADERIA',$this->TOTAL_MERCADERIA,true);
		$criteria->compare('MONTO_ANTICIPO',$this->MONTO_ANTICIPO,true);
		$criteria->compare('MONTO_FLETE',$this->MONTO_FLETE,true);
		$criteria->compare('MONTO_SEGURO',$this->MONTO_SEGURO,true);
		$criteria->compare('MONTO_DESCUENTO1',$this->MONTO_DESCUENTO1,true);
		$criteria->compare('TOTAL_IMPUESTO1',$this->TOTAL_IMPUESTO1,true);
		$criteria->compare('TOTAL_A_FACTURAR',$this->TOTAL_A_FACTURAR,true);
		$criteria->compare('REMITIDO',$this->REMITIDO,true);
		$criteria->compare('RESERVADO',$this->RESERVADO,true);
		$criteria->compare('ESTADO',$this->ESTADO,true);
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}