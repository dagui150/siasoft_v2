<?php

/**
 * This is the model class for table "compania".
 *
 * The followings are the available columns in table 'compania':
 * @property integer $ID
 * @property string $NOMBRE
 * @property string $NOMBRE_ABREV
 * @property string $NIT
 * @property string $UBICACION_GEOGRAFICA1
 * @property string $UBICACION_GEOGRAFICA2
 * @property string $PAIS
 * @property string $DIRECCION
 * @property string $TELEFONO1
 * @property string $TELEFONO2
 * @property string $LOGO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property UbicacionGeografica2 $uBICACIONGEOGRAFICA2
 * @property Pais $pAIS
 */
class Compania extends CActiveRecord
{
	
	public $LOGO;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Compania the static model class
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
		return 'compania';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NOMBRE, NOMBRE_ABREV, PAIS, UBICACION_GEOGRAFICA1, UBICACION_GEOGRAFICA2', 'required'),
			array('NOMBRE', 'length', 'max'=>128),
			array('NOMBRE_ABREV', 'length', 'max'=>64),
			array('NIT, TELEFONO1, TELEFONO2, CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('UBICACION_GEOGRAFICA1', 'length', 'max'=>2),
			array('UBICACION_GEOGRAFICA2', 'length', 'max'=>5),
			array('PAIS', 'length', 'max'=>4),
			array('DIRECCION', 'length', 'max'=>256),
                        array('TELEFONO1, TELEFONO2', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, NOMBRE, NOMBRE_ABREV, NIT, UBICACION_GEOGRAFICA1, UBICACION_GEOGRAFICA2, PAIS, DIRECCION, TELEFONO1, TELEFONO2, LOGO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
			array('LOGO','unsafe'),
                        array('LOGO', 'file', 'types'=>'jpg, gif, png', 'message' => 'Solo puedes subir imagenes tipo JPG, GIF o PNG', 'allowEmpty' => true, 'on' => 'update'),
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
			'uBICACIONGEOGRAFICA1' => array(self::BELONGS_TO, 'UbicacionGeografica1', 'UBICACION_GEOGRAFICA1'),
			'uBICACIONGEOGRAFICA2' => array(self::BELONGS_TO, 'UbicacionGeografica2', 'UBICACION_GEOGRAFICA2'),
			'pAIS' => array(self::BELONGS_TO, 'Pais', 'PAIS'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'NOMBRE' => Yii::t('app','NAME'),
			'NOMBRE_ABREV' => Yii::t('app','ABBREVIATED_NAME'),
			'NIT' => 'Nit',
			'UBICACION_GEOGRAFICA1' => 'Departamento',
			'UBICACION_GEOGRAFICA2' => 'Municipio',
			'PAIS' => Yii::t('app','COUNTRY'),
			'DIRECCION' => Yii::t('app','ADDRESS'),
			'TELEFONO1' => Yii::t('app','PHONE').' 1',
			'TELEFONO2' => Yii::t('app','PHONE').' 2',
			'LOGO' => 'Logo',
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
		$criteria->compare('NOMBRE_ABREV',$this->NOMBRE_ABREV,true);
		$criteria->compare('NIT',$this->NIT,true);
		$criteria->compare('UBICACION_GEOGRAFICA1',$this->UBICACION_GEOGRAFICA1,true);
		$criteria->compare('UBICACION_GEOGRAFICA2',$this->UBICACION_GEOGRAFICA2,true);
		$criteria->compare('PAIS',$this->PAIS,true);
		$criteria->compare('DIRECCION',$this->DIRECCION,true);
		$criteria->compare('TELEFONO1',$this->TELEFONO1,true);
		$criteria->compare('TELEFONO2',$this->TELEFONO2,true);
		$criteria->compare('LOGO',$this->LOGO,true);
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