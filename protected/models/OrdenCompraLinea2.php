<?php

/**
 * This is the model class for table "orden_compra_linea".
 *
 * The followings are the available columns in table 'orden_compra_linea':
 * @property integer $ORDEN_COMPRA_LINEA
 * @property string $ORDEN_COMPRA
 * @property integer $LINEA_NUM
 * @property string $ARTICULO
 * @property string $DESCRIPCION
 * @property string $BODEGA
 * @property string $FECHA_REQUERIDA
 * @property string $FACTURA
 * @property string $CANTIDAD_ORDENADA
 * @property integer $UNIDAD_COMPRA
 * @property string $PRECIO_UNITARIO
 * @property string $PORC_DESCUENTO
 * @property string $MONTO_DESCUENTO
 * @property string $VALOR_IMPUESTO
 * @property string $CANTIDAD_RECIBIDA
 * @property string $CANTIDAD_RECHAZADA
 * @property string $FECHA
 * @property string $OBSERVACION
 * @property string $ESTADO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property UnidadMedida $uNIDADCOMPRA
 * @property Articulo $aRTICULO
 * @property Bodega $bODEGA
 * @property OrdenCompra $oRDENCOMPRA
 * @property SolicitudOrdenCo[] $solicitudOrdenCos
 */
class OrdenCompraLinea2 extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return OrdenCompraLinea the static model class
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
		return 'orden_compra_linea';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('LINEA_NUM, UNIDAD_COMPRA', 'numerical', 'integerOnly'=>true),
			array('ORDEN_COMPRA', 'length', 'max'=>10),
			array('ARTICULO, FACTURA, CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('DESCRIPCION', 'length', 'max'=>128),
			array('BODEGA', 'length', 'max'=>4),
			array('CANTIDAD_ORDENADA, PRECIO_UNITARIO, PORC_DESCUENTO, MONTO_DESCUENTO, VALOR_IMPUESTO, CANTIDAD_RECIBIDA, CANTIDAD_RECHAZADA', 'length', 'max'=>28),
			array('ESTADO', 'length', 'max'=>1),
			array('OBSERVACION', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ORDEN_COMPRA_LINEA, ORDEN_COMPRA, LINEA_NUM, ARTICULO, DESCRIPCION, BODEGA, FECHA_REQUERIDA, FACTURA, CANTIDAD_ORDENADA, UNIDAD_COMPRA, PRECIO_UNITARIO, PORC_DESCUENTO, MONTO_DESCUENTO, VALOR_IMPUESTO, CANTIDAD_RECIBIDA, CANTIDAD_RECHAZADA, FECHA, OBSERVACION, ESTADO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'uNIDADCOMPRA' => array(self::BELONGS_TO, 'UnidadMedida', 'UNIDAD_COMPRA'),
			'aRTICULO' => array(self::BELONGS_TO, 'Articulo', 'ARTICULO'),
			'bODEGA' => array(self::BELONGS_TO, 'Bodega', 'BODEGA'),
			'oRDENCOMPRA' => array(self::BELONGS_TO, 'OrdenCompra', 'ORDEN_COMPRA'),
			'solicitudOrdenCos' => array(self::HAS_MANY, 'SolicitudOrdenCo', 'ORDEN_COMPRA_LINEA'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ORDEN_COMPRA_LINEA' => 'Orden Compra Línea',
			'ORDEN_COMPRA' => 'Orden Compra',
			'LINEA_NUM' => 'Línea Num',
			'ARTICULO' => 'Artículo',
			'DESCRIPCION' => 'Descripción',
			'BODEGA' => 'Bodega',
			'FECHA_REQUERIDA' => 'Fecha Requerida',
			'FACTURA' => 'Factura',
			'CANTIDAD_ORDENADA' => 'Cantidad Ordenada',
			'UNIDAD_COMPRA' => 'Unidad Compra',
			'PRECIO_UNITARIO' => 'Precio Unitario',
			'PORC_DESCUENTO' => 'Porc Descuento',
			'MONTO_DESCUENTO' => 'Monto Descuento',
			'VALOR_IMPUESTO' => 'Valor Impuesto',
			'CANTIDAD_RECIBIDA' => 'Cantidad Recibida',
			'CANTIDAD_RECHAZADA' => 'Cantidad Rechazada',
			'FECHA' => 'Fecha',
			'OBSERVACION' => 'Observacion',
			'ESTADO' => 'Estado',
			'CREADO_POR' => 'Creado Por',
			'CREADO_EL' => 'Creado El',
			'ACTUALIZADO_POR' => 'Actualizado Por',
                        'PORC_IMPUESTO'=>'Porcentaje Impuesto',
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

		$criteria->compare('ORDEN_COMPRA_LINEA',$this->ORDEN_COMPRA_LINEA);
		$criteria->compare('ORDEN_COMPRA',$this->ORDEN_COMPRA,true);
		$criteria->compare('LINEA_NUM',$this->LINEA_NUM);
		$criteria->compare('ARTICULO',$this->ARTICULO,true);
		$criteria->compare('DESCRIPCION',$this->DESCRIPCION,true);
		$criteria->compare('BODEGA',$this->BODEGA,true);
		$criteria->compare('FECHA_REQUERIDA',$this->FECHA_REQUERIDA,true);
		$criteria->compare('FACTURA',$this->FACTURA,true);
		$criteria->compare('CANTIDAD_ORDENADA',$this->CANTIDAD_ORDENADA,true);
		$criteria->compare('UNIDAD_COMPRA',$this->UNIDAD_COMPRA);
		$criteria->compare('PRECIO_UNITARIO',$this->PRECIO_UNITARIO,true);
		$criteria->compare('PORC_DESCUENTO',$this->PORC_DESCUENTO,true);
		$criteria->compare('MONTO_DESCUENTO',$this->MONTO_DESCUENTO,true);
		$criteria->compare('PORC_IMPUESTO',$this->PORC_IMPUESTO,true);
		$criteria->compare('VALOR_IMPUESTO',$this->VALOR_IMPUESTO,true);
		$criteria->compare('CANTIDAD_RECIBIDA',$this->CANTIDAD_RECIBIDA,true);
		$criteria->compare('CANTIDAD_RECHAZADA',$this->CANTIDAD_RECHAZADA,true);
		$criteria->compare('FECHA',$this->FECHA,true);
		$criteria->compare('OBSERVACION',$this->OBSERVACION,true);
		$criteria->compare('ESTADO',$this->ESTADO,true);
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
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
        
        public function getCombo($articulo){
            $bus = Articulo::model()->findByPk($articulo);
            $bus2 = UnidadMedida::model()->find('ID = "'.$bus->UNIDAD_ALMACEN.'"');
            return CHtml::listData(UnidadMedida::model()->findAll('TIPO = "'.$bus2->TIPO.'"'), 'ID', 'NOMBRE');
        }
}