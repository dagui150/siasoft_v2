<?php

/**
 * This is the model class for table "transaccion_inv_detalle".
 *
 * The followings are the available columns in table 'transaccion_inv_detalle':
 * @property integer $TRANSACCION_INV_DETALLE
 * @property integer $TRANSACCION_INV
 * @property integer $LINEA
 * @property string $TIPO_TRANSACCION
 * @property integer $SUBTIPO
 * @property string $TIPO_TRANSACCION_CANTIDAD
 * @property string $ARTICULO
 * @property integer $UNIDAD
 * @property string $BODEGA
 * @property string $NATURALEZA
 * @property string $CANTIDAD
 * @property string $COSTO_UNITARIO
 * @property string $PRECIO_UNITARIO
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property Bodega $bODEGA
 * @property TransaccionInv $tRANSACCIONINV
 * @property SubtipoTransaccion $sUBTIPO
 * @property TipoTransaccion $tIPOTRANSACCION
 * @property UnidadMedida $uNIDAD
 * @property Articulo $aRTICULO
 * @property TipoCantidadArticulo $tIPOTRANSACCIONCANTIDAD
 */
class TransaccionInvDetalle extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TransaccionInvDetalle the static model class
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
		return 'transaccion_inv_detalle';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TRANSACCION_INV, LINEA, ARTICULO, UNIDAD, BODEGA, NATURALEZA, CANTIDAD, COSTO_UNITARIO, PRECIO_UNITARIO, ACTIVO', 'required'),
			array('TRANSACCION_INV, LINEA, SUBTIPO, UNIDAD', 'numerical', 'integerOnly'=>true),
			array('TIPO_TRANSACCION, BODEGA', 'length', 'max'=>4),
			array('TIPO_TRANSACCION_CANTIDAD, NATURALEZA, ACTIVO', 'length', 'max'=>1),
			array('ARTICULO, CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('CANTIDAD, COSTO_UNITARIO, PRECIO_UNITARIO', 'length', 'max'=>28),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TRANSACCION_INV_DETALLE, TRANSACCION_INV, LINEA, TIPO_TRANSACCION, SUBTIPO, TIPO_TRANSACCION_CANTIDAD, ARTICULO, UNIDAD, BODEGA, NATURALEZA, CANTIDAD, COSTO_UNITARIO, PRECIO_UNITARIO, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'bODEGA' => array(self::BELONGS_TO, 'Bodega', 'BODEGA'),
			'tRANSACCIONINV' => array(self::BELONGS_TO, 'TransaccionInv', 'TRANSACCION_INV'),
			'sUBTIPO' => array(self::BELONGS_TO, 'SubtipoTransaccion', 'SUBTIPO'),
			'tIPOTRANSACCION' => array(self::BELONGS_TO, 'TipoTransaccion', 'TIPO_TRANSACCION'),
			'uNIDAD' => array(self::BELONGS_TO, 'UnidadMedida', 'UNIDAD'),
			'aRTICULO' => array(self::BELONGS_TO, 'Articulo', 'ARTICULO'),
			'tIPOTRANSACCIONCANTIDAD' => array(self::BELONGS_TO, 'TipoCantidadArticulo', 'TIPO_TRANSACCION_CANTIDAD'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TRANSACCION_INV_DETALLE' => 'Transacción Inv Detalle',
			'TRANSACCION_INV' => 'Transacción Inv',
			'LINEA' => 'Línea',
			'TIPO_TRANSACCION' => 'Tipo Transacción',
			'SUBTIPO' => 'Subtipo',
			'TIPO_TRANSACCION_CANTIDAD' => 'Tipo Transacción Cantidad',
			'ARTICULO' => 'Artículo',
			'UNIDAD' => 'Unidad',
			'BODEGA' => 'Bodega',
			'NATURALEZA' => 'Naturaleza',
			'CANTIDAD' => 'Cantidad',
			'COSTO_UNITARIO' => 'Costo Unitario',
			'PRECIO_UNITARIO' => 'Precio Unitario',
			'ACTIVO' => 'Activo',
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

		$criteria->compare('TRANSACCION_INV_DETALLE',$this->TRANSACCION_INV_DETALLE);
		$criteria->compare('TRANSACCION_INV',$this->TRANSACCION_INV);
		$criteria->compare('LINEA',$this->LINEA);
		$criteria->compare('TIPO_TRANSACCION',$this->TIPO_TRANSACCION,true);
		$criteria->compare('SUBTIPO',$this->SUBTIPO);
		$criteria->compare('TIPO_TRANSACCION_CANTIDAD',$this->TIPO_TRANSACCION_CANTIDAD,true);
		$criteria->compare('ARTICULO',$this->ARTICULO,true);
		$criteria->compare('UNIDAD',$this->UNIDAD);
		$criteria->compare('BODEGA',$this->BODEGA,true);
		$criteria->compare('NATURALEZA',$this->NATURALEZA,true);
		$criteria->compare('CANTIDAD',$this->CANTIDAD,true);
		$criteria->compare('COSTO_UNITARIO',$this->COSTO_UNITARIO,true);
		$criteria->compare('PRECIO_UNITARIO',$this->PRECIO_UNITARIO,true);
		$criteria->compare('ACTIVO','S');
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}