<?php

/**
 * This is the model class for table "impuesto".
 *
 * The followings are the available columns in table 'impuesto':
 * @property string $id
 * @property string $nombre
 * @property string $procentaje
 * @property string $activo
 * @property string $creado_por
 * @property string $creado_el
 * @property string $actualizado_por
 * @property string $actualizado_el
 */
class Impuesto extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Impuesto the static model class
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
		return 'impuesto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, nombre, procentaje', 'required'),
			array('id', 'length', 'max'=>4),
			array('nombre', 'length', 'max'=>64),
			array('procentaje', 'length', 'max'=>28),
			array('activo', 'length', 'max'=>1),
			array('creado_por, actualizado_por', 'length', 'max'=>20),
			array('actualizado_el', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, nombre, procentaje, activo, creado_por, creado_el, actualizado_por, actualizado_el', 'safe', 'on'=>'search'),
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
			'id' => 'Codigo',
			'nombre' => 'Nombre',
			'procentaje' => 'Porcentaje',
			'activo' => 'Activo',
			'creado_por' => 'Creado Por',
			'creado_el' => 'Creado El',
			'actualizado_por' => 'Actualizado Por',
			'actualizado_el' => 'Actualizado El',
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('procentaje',$this->procentaje,true);
		$criteria->compare('activo',$this->activo,true);
		$criteria->compare('creado_por',$this->creado_por,true);
		$criteria->compare('creado_el',$this->creado_el,true);
		$criteria->compare('actualizado_por',$this->actualizado_por,true);
		$criteria->compare('actualizado_el',$this->actualizado_el,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
		public function behaviors()
	{
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'creado_el',
				'updateAttribute' => 'actualizado_el',
				'setUpdateOnCreate' => true,
			),
			
			'BlameableBehavior' => array(
				'class' => 'application.components.BlameableBehavior',
				'createdByColumn' => 'creado_por',
				'updatedByColumn' => 'actualizado_por',
			),
		);
	}
}