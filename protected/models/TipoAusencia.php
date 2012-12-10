<?php

/**
 * This is the model class for table "tipo_ausencia".
 *
 * The followings are the available columns in table 'tipo_ausencia':
 * @property integer $TIPO_AUSENCIA
 * @property string $NOMBRE
 * @property string $JUSTIFICADA
 * @property string $PAGO
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 */
class TipoAusencia extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TipoAusencia the static model class
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
		return 'tipo_ausencia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NOMBRE, JUSTIFICADA, PAGO', 'required'),
			array('NOMBRE', 'length', 'max'=>16),
			array('JUSTIFICADA, PAGO, ACTIVO', 'length', 'max'=>1),
			array('CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('TIPO_AUSENCIA, NOMBRE, JUSTIFICADA, PAGO, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
        
        
        public static function getJustificada($codigo){
            switch ($codigo){
                case 'S' : return 'Si';
                break;
                case 'N' : return'No';
                break;
            }
        }


    public static function getPago($codigo){
            switch ($codigo){
                case 'S' : return 'Si';
                break;
                case 'N' : return'No';
                break;
            }
        }
        

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'TIPO_AUSENCIA' => 'Tipo Ausencia',
			'NOMBRE' => 'Nombre',
			'JUSTIFICADA' => 'Justificada',
			'PAGO' => 'Pago',
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

		$criteria->compare('TIPO_AUSENCIA',$this->TIPO_AUSENCIA);
		$criteria->compare('NOMBRE',$this->NOMBRE,true);
		$criteria->compare('JUSTIFICADA',$this->JUSTIFICADA,true);
		$criteria->compare('PAGO',$this->PAGO,true);
		$criteria->compare('ACTIVO','S');
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
                
                
                
	}
        
        
                public function behaviors() {
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