<?php

/**
 * This is the model class for table "horario_concepto".
 *
 * The followings are the available columns in table 'horario_concepto':
 * @property integer $ID
 * @property string $HORARIO
 * @property integer $DIA
 * @property string $HORA_INICIO
 * @property string $HORA_FIN
 * @property string $OBSERVACION
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property Horario $hORARIO
 * @property Dia $dIA
 */
class HorarioConcepto extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return HorarioConcepto the static model class
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
		return 'horario_concepto';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('HORA_INICIO, HORA_FIN', 'required'),
			array('DIA', 'numerical', 'integerOnly'=>true),
			array('HORARIO', 'length', 'max'=>4),
			array('OBSERVACION', 'length', 'max'=>64),
			array('ACTIVO', 'length', 'max'=>1),
			array('CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('ACTUALIZADO_EL', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, HORARIO, DIA, HORA_INICIO, HORA_FIN, OBSERVACION, ACTIVO', 'safe', 'on'=>'search'),
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
			'hORARIO' => array(self::BELONGS_TO, 'Horario', 'HORARIO'),
			'dIA' => array(self::BELONGS_TO, 'Dia', 'DIA'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'HORARIO' => 'Horario',
			'DIA' => 'Dia',
			'HORA_INICIO' => 'Hora Inicio',
			'HORA_FIN' => 'Hora Fin',
			'OBSERVACION' => 'Observacion',
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
		$criteria->compare('HORARIO',$this->HORARIO,true);
		$criteria->compare('DIA',$this->DIA);
		$criteria->compare('HORA_INICIO',$this->HORA_INICIO,true);
		$criteria->compare('HORA_FIN',$this->HORA_FIN,true);
		$criteria->compare('OBSERVACION',$this->OBSERVACION,true);
		$criteria->compare('ACTIVO','S');
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