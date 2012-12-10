<?php

/**
 * This is the model class for table "retencion".
 *
 * The followings are the available columns in table 'retencion':
 * @property string $ID
 * @property string $NOMBRE
 * @property string $PORCENTAJE
 * @property string $MONTO_MINIMO
 * @property string $TIPO
 * @property string $APLICA_MONTO
 * @property string $APLICA_SUBTOTAL
 * @property string $APLICA_SUB_DESC
 * @property string $APLICA_IMPUESTO1
 * @property string $APLICA_RUBRO1
 * @property string $APLICA_RUBRO2
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 */
class Retencion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Retencion the static model class
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
		return 'retencion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID, NOMBRE, PORCENTAJE, MONTO_MINIMO, TIPO, ACTIVO', 'required'),
			array('ID', 'length', 'max'=>4),
			array('NOMBRE', 'length', 'max'=>64),
			array('PORCENTAJE, MONTO_MINIMO', 'length', 'max'=>28),
			array('TIPO, APLICA_MONTO, APLICA_SUBTOTAL, APLICA_SUB_DESC, APLICA_IMPUESTO1, APLICA_RUBRO1, APLICA_RUBRO2, ACTIVO', 'length', 'max'=>1),
			array('CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('ACTUALIZADO_EL', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, NOMBRE, PORCENTAJE, MONTO_MINIMO, TIPO, APLICA_MONTO, APLICA_SUBTOTAL, APLICA_SUB_DESC, APLICA_IMPUESTO1, APLICA_RUBRO1, APLICA_RUBRO2, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'NOMBRE' => 'Nombre',
			'PORCENTAJE' => 'Porcentaje',
			'MONTO_MINIMO' => 'Monto Minimo',
			'TIPO' => 'Tipo',
			'APLICA_MONTO' => 'Monto',
			'APLICA_SUBTOTAL' => 'Subtotal',
			'APLICA_SUB_DESC' => 'Subtotal - Descuento',
			'APLICA_IMPUESTO1' => '1er. Impuesto',
			'APLICA_RUBRO1' => '1er. Rubro',
			'APLICA_RUBRO2' => '2do. Rubro',
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

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('NOMBRE',$this->NOMBRE,true);
		$criteria->compare('PORCENTAJE',$this->PORCENTAJE,true);
		$criteria->compare('MONTO_MINIMO',$this->MONTO_MINIMO,true);
		$criteria->compare('TIPO',$this->TIPO,true);
		$criteria->compare('APLICA_MONTO',$this->APLICA_MONTO,true);
		$criteria->compare('APLICA_SUBTOTAL',$this->APLICA_SUBTOTAL,true);
		$criteria->compare('APLICA_SUB_DESC',$this->APLICA_SUB_DESC,true);
		$criteria->compare('APLICA_IMPUESTO1',$this->APLICA_IMPUESTO1,true);
		$criteria->compare('APLICA_RUBRO1',$this->APLICA_RUBRO1,true);
		$criteria->compare('APLICA_RUBRO2',$this->APLICA_RUBRO2,true);
		$criteria->compare('ACTIVO',$this->ACTIVO,true);
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
}