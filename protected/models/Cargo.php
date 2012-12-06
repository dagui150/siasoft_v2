<?php

/**
 * This is the model class for table "cargo".
 *
 * The followings are the available columns in table 'cargo':
 * @property string $CARGO
 * @property string $DESCRIPCION
 * @property string $SALARIO_MINIMO
 * @property string $SALARIO_INTERMEDIO1
 * @property string $SALARIO_INTERMEDIO2
 * @property string $SALARIO_MAXIMO
 * @property string $SALARIO_ACTUAL
 * @property string $FUNCIONES
 * @property string $NOTAS
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 */
class Cargo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cargo the static model class
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
		return 'cargo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CARGO, DESCRIPCION, ACTIVO', 'required'),
                    array('CARGO','unique','allowEmpty'=>false),
			array('CARGO', 'length', 'max'=>8),
			array('DESCRIPCION', 'length', 'max'=>64),
			array('SALARIO_MINIMO, SALARIO_INTERMEDIO1, SALARIO_INTERMEDIO2, SALARIO_MAXIMO, SALARIO_ACTUAL', 'length', 'max'=>28),
                    array('SALARIO_MINIMO, SALARIO_INTERMEDIO1, SALARIO_INTERMEDIO2, SALARIO_MAXIMO, SALARIO_ACTUAL', 'numerical'),
                    
			array('ACTIVO', 'length', 'max'=>1),
			array('CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('FUNCIONES, NOTAS', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CARGO, DESCRIPCION, SALARIO_MINIMO, SALARIO_INTERMEDIO1, SALARIO_INTERMEDIO2, SALARIO_MAXIMO, SALARIO_ACTUAL, FUNCIONES, NOTAS, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'CARGO' => 'Cargo',
			'DESCRIPCION' => 'Descripci&oacuten',
			'SALARIO_MINIMO' => 'Salario M&iacutenimo',
			'SALARIO_INTERMEDIO1' => 'Salario Intermedio 1',
			'SALARIO_INTERMEDIO2' => 'Salario Intermedio 2',
			'SALARIO_MAXIMO' => 'Salario M&aacuteximo',
			'SALARIO_ACTUAL' => 'Salario Actual',
			'FUNCIONES' => 'Funciones',
			'NOTAS' => 'Notas',
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

		$criteria->compare('CARGO',$this->CARGO,true);
		$criteria->compare('DESCRIPCION',$this->DESCRIPCION,true);
		$criteria->compare('SALARIO_MINIMO',$this->SALARIO_MINIMO,true);
		$criteria->compare('SALARIO_INTERMEDIO1',$this->SALARIO_INTERMEDIO1,true);
		$criteria->compare('SALARIO_INTERMEDIO2',$this->SALARIO_INTERMEDIO2,true);
		$criteria->compare('SALARIO_MAXIMO',$this->SALARIO_MAXIMO,true);
		$criteria->compare('SALARIO_ACTUAL',$this->SALARIO_ACTUAL,true);
		$criteria->compare('FUNCIONES',$this->FUNCIONES,true);
		$criteria->compare('NOTAS',$this->NOTAS,true);
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