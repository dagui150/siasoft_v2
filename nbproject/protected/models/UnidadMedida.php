<?php

/**
 * This is the model class for table "unidad_medida".
 *
 * The followings are the available columns in table 'unidad_medida':
 * @property integer $ID
 * @property string $NOMBRE
 * @property string $ABREVIATURA
 * @property string $TIPO
 * @property integer $UNIDAD_BASE
 * @property string $EQUIVALENCIA
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property Clasificacion[] $clasificacions
 * @property UnidadMedida $uNIDADBASE
 * @property UnidadMedida[] $unidadMedidas
 */
class UnidadMedida extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UnidadMedida the static model class
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
		return 'unidad_medida';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NOMBRE, ABREVIATURA, TIPO, ACTIVO', 'required'),
			array('UNIDAD_BASE', 'numerical', 'integerOnly'=>true),
			array('NOMBRE', 'length', 'max'=>64),
			array('ABREVIATURA', 'length', 'max'=>5),
			array('TIPO, ACTIVO', 'length', 'max'=>1),
			array('EQUIVALENCIA', 'length', 'max'=>28),
			array('CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, NOMBRE, ABREVIATURA, TIPO, UNIDAD_BASE, EQUIVALENCIA, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'clasificacions' => array(self::HAS_MANY, 'Clasificacion', 'UNIDAD'),
			'uNIDADBASE' => array(self::BELONGS_TO, 'UnidadMedida', 'UNIDAD_BASE'),
			'unidadMedidas' => array(self::HAS_MANY, 'UnidadMedida', 'UNIDAD_BASE'),
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
			'ABREVIATURA' => 'Abreviatura',
			'TIPO' => 'Tipo',
			'UNIDAD_BASE' => 'Unidad Base',
			'EQUIVALENCIA' => 'Equivalencia',
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

		$criteria->compare('ID',$this->ID);
		$criteria->compare('NOMBRE',$this->NOMBRE,true);
		$criteria->compare('ABREVIATURA',$this->ABREVIATURA,true);
		$criteria->compare('TIPO',$this->TIPO,true);
		$criteria->compare('UNIDAD_BASE',$this->UNIDAD_BASE);
		$criteria->compare('EQUIVALENCIA',$this->EQUIVALENCIA,true);
		$criteria->compare('ACTIVO',$this->ACTIVO,true);
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}