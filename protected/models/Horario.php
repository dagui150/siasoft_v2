<?php

/**
 * This is the model class for table "horario".
 *
 * The followings are the available columns in table 'horario':
 * @property string $HORARIO
 * @property string $DESCRIPCION
 * @property integer $TOLERA_ENTRADA
 * @property integer $TOLERA_SALIDA
 * @property integer $REDONDEO_ENTRADA
 * @property integer $REDONDEO_SALIDA
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property HorarioConcepto[] $horarioConceptos
 */
class Horario extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Horario the static model class
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
		return 'horario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('HORARIO, DESCRIPCION, TOLERA_ENTRADA, TOLERA_SALIDA, REDONDEO_ENTRADA, REDONDEO_SALIDA', 'required'),
			array('TOLERA_ENTRADA, TOLERA_SALIDA, REDONDEO_ENTRADA, REDONDEO_SALIDA', 'numerical', 'integerOnly'=>true),
			array('HORARIO', 'length', 'max'=>4),
                        array('HORARIO', 'unique'),
			array('DESCRIPCION', 'length', 'max'=>64),
			array('ACTIVO', 'length', 'max'=>1),
			array('CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('HORARIO, DESCRIPCION, TOLERA_ENTRADA, TOLERA_SALIDA, REDONDEO_ENTRADA, REDONDEO_SALIDA', 'safe', 'on'=>'search'),
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
			'horarioConceptos' => array(self::HAS_MANY, 'HorarioConcepto', 'HORARIO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'HORARIO' => 'Horario',
			'DESCRIPCION' => 'Descripción',
			'TOLERA_ENTRADA' => 'Entrada',
			'TOLERA_SALIDA' => 'Salida',
			'REDONDEO_ENTRADA' => 'Entrada',
			'REDONDEO_SALIDA' => 'Salida',
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

		$criteria->compare('HORARIO',$this->HORARIO,true);
		$criteria->compare('DESCRIPCION',$this->DESCRIPCION,true);
		$criteria->compare('TOLERA_ENTRADA',$this->TOLERA_ENTRADA);
		$criteria->compare('TOLERA_SALIDA',$this->TOLERA_SALIDA);
		$criteria->compare('REDONDEO_ENTRADA',$this->REDONDEO_ENTRADA);
		$criteria->compare('REDONDEO_SALIDA',$this->REDONDEO_SALIDA);
		$criteria->compare('ACTIVO','S');

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
 