<?php

/**
 * This is the model class for table "centro_costos".
 *
 * The followings are the available columns in table 'centro_costos':
 * @property string $ID
 * @property string $DESCRIPCION
 * @property string $TIPO
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 */
class CentroCostos extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CentroCostos the static model class
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
		return 'centro_costos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID, DESCRIPCION, TIPO', 'required'),
                        array('ID', 'unique', 'attributeName'=>'ID', 'className'=>'CentroCostos','allowEmpty'=>false),
			array('ID', 'length', 'max'=>25),
			array('DESCRIPCION', 'length', 'max'=>64),
			array('TIPO, ACTIVO', 'length', 'max'=>1),
			array('CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, DESCRIPCION, TIPO, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'ID' => 'Código',
			'DESCRIPCION' => 'Descripción',
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

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('DESCRIPCION',$this->DESCRIPCION,true);
		$criteria->compare('TIPO',$this->TIPO,true);
		$criteria->compare('ACTIVO','S');
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public function searchPdf()
	{

		$criteria=new CDbCriteria;                 $criteria->compare('ACTIVO','S');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=> CentroCostos::model()->count(),
                        ),
		));
	}
        
        public static function tipo($codigo){
            switch ($codigo){
                case 'G' : return 'Gasto';
                    break;
                case 'I' : return 'Ingreso';
                    break;
                case 'A' : return 'Ambos';
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
        
                public function searchPapelera()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		
		$criteria->compare('ACTIVO','N');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
			'sort'=>false,
		));
	}
}