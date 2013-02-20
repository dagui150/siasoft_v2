<?php

/**
 * This is the model class for table "transaccion_inv".
 *
 * The followings are the available columns in table 'transaccion_inv':
 * @property integer $TRANSACCION_INV
 * @property string $CONSECUTIVO_CI
 * @property string $CONSECUTIVO_CO
 * @property string $CONSECUTIVO_FA
 * @property string $MODULO_ORIGEN
 * @property string $REFERENCIA
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property DocumentoInv $cONSECUTIVOCI
 * @property IngresoCompra $cONSECUTIVOCO
 * @property TransaccionInvDetalle[] $transaccionInvDetalles
 */
class TransaccionInv extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TransaccionInv the static model class
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
		return 'transaccion_inv';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('MODULO_ORIGEN, REFERENCIA, ACTIVO', 'required'),
			array('CONSECUTIVO_CI, CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('CONSECUTIVO_CO, CONSECUTIVO_FA', 'length', 'max'=>10),
			array('MODULO_ORIGEN', 'length', 'max'=>4),
			array('REFERENCIA', 'length', 'max'=>200),
			array('ACTIVO', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TRANSACCION_INV, CONSECUTIVO_CI, CONSECUTIVO_CO, CONSECUTIVO_FA, MODULO_ORIGEN, REFERENCIA, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'cONSECUTIVOCI' => array(self::BELONGS_TO, 'DocumentoInv', 'CONSECUTIVO_CI'),
			'cONSECUTIVOCO' => array(self::BELONGS_TO, 'IngresoCompra', 'CONSECUTIVO_CO'),
			'transaccionInvDetalles' => array(self::HAS_MANY, 'TransaccionInvDetalle', 'TRANSACCION_INV'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TRANSACCION_INV' => 'Transacción Inv',
			'CONSECUTIVO_CI' => 'Consecutivo Ci',
			'CONSECUTIVO_CO' => 'Consecutivo Co',
			'CONSECUTIVO_FA' => 'Consecutivo Fa',
			'MODULO_ORIGEN' => 'Módulo Origen',
			'REFERENCIA' => 'Referencia',
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

		$criteria->compare('TRANSACCION_INV',$this->TRANSACCION_INV);
		$criteria->compare('CONSECUTIVO_CI',$this->CONSECUTIVO_CI,true);
		$criteria->compare('CONSECUTIVO_CO',$this->CONSECUTIVO_CO,true);
		$criteria->compare('CONSECUTIVO_FA',$this->CONSECUTIVO_FA,true);
		$criteria->compare('MODULO_ORIGEN',$this->MODULO_ORIGEN,true);
		$criteria->compare('REFERENCIA',$this->REFERENCIA,true);
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