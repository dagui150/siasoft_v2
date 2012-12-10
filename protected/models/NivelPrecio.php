<?php

/**
 * This is the model class for table "nivel_precio".
 *
 * The followings are the available columns in table 'nivel_precio':
 * @property string $ID
 * @property string $DESCRIPCION
 * @property string $ESQUEMA_TRABAJO
 * @property string $CONDICION_PAGO
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property CodicionPago $cONDICIONPAGO
 */
class NivelPrecio extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return NivelPrecio the static model class
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
		return 'nivel_precio';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID, DESCRIPCION, ESQUEMA_TRABAJO', 'required'),
                        array('ID', 'unique', 'attributeName'=>'ID', 'className'=>'Bodega','allowEmpty'=>false),
			array('ID', 'length', 'max'=>12),
			array('DESCRIPCION', 'length', 'max'=>64),
			array('ESQUEMA_TRABAJO, CONDICION_PAGO', 'length', 'max'=>4),
			array('ACTIVO', 'length', 'max'=>1),
			array('CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, DESCRIPCION, ESQUEMA_TRABAJO, CONDICION_PAGO, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'cONDICIONPAGO' => array(self::BELONGS_TO, 'CodicionPago', 'CONDICION_PAGO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'Codigo',
			'DESCRIPCION' => 'Descripcion',
			'ESQUEMA_TRABAJO' => 'Esquema Trabajo',
			'CONDICION_PAGO' => 'Condicion Pago',
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
		$criteria->compare('DESCRIPCION',$this->DESCRIPCION,true);
		$criteria->compare('ESQUEMA_TRABAJO',$this->ESQUEMA_TRABAJO,true);
		$criteria->compare('CONDICION_PAGO',$this->CONDICION_PAGO,true);
		$criteria->compare('ACTIVO',$this->ACTIVO,true);
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function tipo($codigo){
            switch ($codigo){
                case 'NORM' : return 'Normal';
                    break;
                case 'MULT' : return 'Multiplicador';
                    break;
                case 'MARG' : return 'Margen';
                    break;
                case 'MARK' : return 'Markup';
                    break;
            }
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