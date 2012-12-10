<?php

/**
 * This is the model class for table "articulo_proveedor".
 *
 * The followings are the available columns in table 'articulo_proveedor':
 * @property integer $ID
 * @property string $ARTICULO
 * @property string $PROVEEDOR
 * @property string $CODIGO_CATALOGO
 * @property string $NOMBRE_CATALOGO
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property Proveedor $pROVEEDOR
 * @property Articulo $aRTICULO
 */
class ArticuloProveedor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ArticuloProveedor the static model class
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
		return 'articulo_proveedor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ARTICULO,PROVEEDOR, CODIGO_CATALOGO', 'required', 'message'=>''),
			array('ARTICULO, PROVEEDOR, CODIGO_CATALOGO, CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('NOMBRE_CATALOGO', 'length', 'max'=>254),
			array('ACTIVO', 'length', 'max'=>1),
                    
                        array('PROVEEDOR', 'exist', 'attributeName'=>'PROVEEDOR', 'className'=>'Proveedor','allowEmpty'=>false, 'message'=>''),
                        
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, ARTICULO, PROVEEDOR, CODIGO_CATALOGO, NOMBRE_CATALOGO, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'pROVEEDOR' => array(self::BELONGS_TO, 'Proveedor', 'PROVEEDOR'),
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
			'PROVEEDOR' => 'Proveedor',
			'CODIGO_CATALOGO' => 'Codigo Catalogo',
			'NOMBRE_CATALOGO' => 'Nombre Catalogo',
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
		$criteria->compare('PROVEEDOR',$this->PROVEEDOR,true);
		$criteria->compare('CODIGO_CATALOGO',$this->CODIGO_CATALOGO,true);
		$criteria->compare('NOMBRE_CATALOGO',$this->NOMBRE_CATALOGO,true);
		$criteria->compare('ACTIVO',$this->ACTIVO,true);
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function search2($articulo)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('ARTICULO',$articulo);
		$criteria->compare('PROVEEDOR',$this->PROVEEDOR,true);
		$criteria->compare('CODIGO_CATALOGO',$this->CODIGO_CATALOGO,true);
		$criteria->compare('NOMBRE_CATALOGO',$this->NOMBRE_CATALOGO,true);
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