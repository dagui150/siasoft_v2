<?php

/**
 * This is the model class for table "formato_impresion".
 *
 * The followings are the available columns in table 'formato_impresion':
 * @property integer $ID
 * @property string $NOMBRE
 * @property string $OBSERVACION
 * @property string $MODULO
 * @property string $SUBMODULO
 * @property string $RUTA
 * @property string $TIPO
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property ConsecutivoCi[] $consecutivoCis
 */
class FormatoImpresion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FormatoImpresion the static model class
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
		return 'formato_impresion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID, NOMBRE, MODULO, SUBMODULO, RUTA, TIPO, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'required'),
			array('ID', 'numerical', 'integerOnly'=>true),
			array('NOMBRE', 'length', 'max'=>64),
			array('MODULO, SUBMODULO, TIPO', 'length', 'max'=>4),
			array('RUTA', 'length', 'max'=>128),
			array('ACTIVO', 'length', 'max'=>1),
			array('CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('OBSERVACION', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, NOMBRE, OBSERVACION, MODULO, SUBMODULO, RUTA, TIPO, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'consecutivoCis' => array(self::HAS_MANY, 'ConsecutivoCi', 'FORMATO_IMPRESION'),
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
			'OBSERVACION' => 'Observacion',
			'MODULO' => 'Modulo',
			'SUBMODULO' => 'Submodulo',
			'RUTA' => 'Ruta',
			'TIPO' => 'Tipo',
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
		$criteria->compare('OBSERVACION',$this->OBSERVACION,true);
		$criteria->compare('MODULO',$this->MODULO,true);
		$criteria->compare('SUBMODULO',$this->SUBMODULO,true);
		$criteria->compare('RUTA',$this->RUTA,true);
		$criteria->compare('TIPO',$this->TIPO,true);
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