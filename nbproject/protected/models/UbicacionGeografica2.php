<?php

/**
 * This is the model class for table "ubicacion_geografica2".
 *
 * The followings are the available columns in table 'ubicacion_geografica2':
 * @property string $ID
 * @property string $UBICACION_GEOGRAFICA1
 * @property string $NOMBRE
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property Compania[] $companias
 * @property UbicacionGeografica1 $uBICACIONGEOGRAFICA1
 */
class UbicacionGeografica2 extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UbicacionGeografica2 the static model class
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
		return 'ubicacion_geografica2';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID, UBICACION_GEOGRAFICA1, NOMBRE', 'required'),
			array('ID', 'unique', 'attributeName'=>'ID', 'className'=>'UbicacionGeografica2','allowEmpty'=>false),
			array('ID', 'length', 'max'=>5),
			array('UBICACION_GEOGRAFICA1', 'length', 'max'=>2),
			array('NOMBRE', 'length', 'max'=>64),
			array('ACTIVO', 'length', 'max'=>1),
			array('CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, UBICACION_GEOGRAFICA1, NOMBRE, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'companias' => array(self::HAS_MANY, 'Compania', 'UBICACION_GEOGRAFICA2'),
			'uBICACIONGEOGRAFICA1' => array(self::BELONGS_TO, 'UbicacionGeografica1', 'UBICACION_GEOGRAFICA1'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'Código',
			'UBICACION_GEOGRAFICA1' => Yii::t('app','GEOGRAPHIC_LOCATION').' 1',
			'NOMBRE' => Yii::t('app','NAME'),
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
		$criteria->compare('UBICACION_GEOGRAFICA1',$this->UBICACION_GEOGRAFICA1,true);
		$criteria->compare('NOMBRE',$this->NOMBRE,true);
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