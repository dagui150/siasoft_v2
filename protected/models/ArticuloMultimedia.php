<?php

/**
 * This is the model class for table "articulo_multimedia".
 *
 * The followings are the available columns in table 'articulo_multimedia':
 * @property integer $ID
 * @property string $ARTICULO
 * @property string $TIPO
 * @property string $UBICACION
 * @property string $NOMBRE
 * @property string $DESCRIPCION
 * @property integer $ORDEN
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property Articulo $aRTICULO
 */
class ArticuloMultimedia extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArticuloMultimedia the static model class
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
		return 'articulo_multimedia';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ARTICULO, TIPO, UBICACION, ORDEN, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'required'),
			array('ORDEN', 'numerical', 'integerOnly'=>true),
			array('ARTICULO, CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('TIPO', 'length', 'max'=>3),
			array('UBICACION', 'length', 'max'=>128),
			array('NOMBRE', 'length', 'max'=>64),
			array('ACTIVO', 'length', 'max'=>1),
			array('DESCRIPCION', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, ARTICULO, TIPO, UBICACION, NOMBRE, DESCRIPCION, ORDEN, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
		);
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
        
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'aRTICULO' => array(self::BELONGS_TO, 'Articulo', 'ARTICULO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'ARTICULO' => 'Articulo',
			'TIPO' => 'Tipo',
			'UBICACION' => 'Ubicacion',
			'NOMBRE' => 'Nombre',
			'DESCRIPCION' => 'Descripcion',
			'ORDEN' => 'Orden',
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
		$criteria->compare('ARTICULO',$this->ARTICULO,true);
		$criteria->compare('TIPO',$this->TIPO,true);
		$criteria->compare('UBICACION',$this->UBICACION,true);
		$criteria->compare('NOMBRE',$this->NOMBRE,true);
		$criteria->compare('DESCRIPCION',$this->DESCRIPCION,true);
		$criteria->compare('ORDEN',$this->ORDEN);
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