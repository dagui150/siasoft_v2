<?php

/**
 * This is the model class for table "nit".
 *
 * The followings are the available columns in table 'nit':
 * @property string $ID
 * @property string $TIIPO_DOCUMENTO
 * @property string $RAZON_SOCIAL
 * @property string $ALIAS
 * @property string $OBSERVACIONES
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property EntidadFinanciera[] $entidadFinancieras
 * @property TipoDocumento $tIIPODOCUMENTO
 */
class Nit extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Nit the static model class
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
		return 'nit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID, TIIPO_DOCUMENTO, RAZON_SOCIAL', 'required'),
                        array('ID', 'unique', 'attributeName'=>'ID', 'className'=>'Nit','allowEmpty'=>false),
			array('ID, TIIPO_DOCUMENTO', 'length', 'max'=>12),
			array('RAZON_SOCIAL, ALIAS', 'length', 'max'=>128),
			array('ACTIVO', 'length', 'max'=>1),
			array('CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('OBSERVACIONES', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, TIIPO_DOCUMENTO, RAZON_SOCIAL, ALIAS, OBSERVACIONES, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'entidadFinancieras' => array(self::HAS_MANY, 'EntidadFinanciera', 'NIT'),
			'tIIPODOCUMENTO' => array(self::BELONGS_TO, 'TipoDocumento', 'TIIPO_DOCUMENTO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'Numero de documento',
			'TIIPO_DOCUMENTO' => 'Tipo de Documento',
			'RAZON_SOCIAL' => 'Razon Social',
			'ALIAS' => 'Alias',
			'OBSERVACIONES' => 'Observaciones',
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
		$criteria->compare('TIIPO_DOCUMENTO',$this->TIIPO_DOCUMENTO,true);
		$criteria->compare('RAZON_SOCIAL',$this->RAZON_SOCIAL,true);
		$criteria->compare('ALIAS',$this->ALIAS,true);
		$criteria->compare('OBSERVACIONES',$this->OBSERVACIONES,true);
		$criteria->compare('ACTIVO',$this->ACTIVO,true);
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
	public function searchModal()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('TIIPO_DOCUMENTO',$this->TIIPO_DOCUMENTO,true);
		$criteria->compare('RAZON_SOCIAL',$this->RAZON_SOCIAL,true);
		$criteria->compare('ALIAS',$this->ALIAS,true);
		$criteria->compare('OBSERVACIONES',$this->OBSERVACIONES,true);
		$criteria->compare('ACTIVO',$this->ACTIVO,true);
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>5
                        ),
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