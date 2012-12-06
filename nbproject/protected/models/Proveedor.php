<?php

/**
 * This is the model class for table "proveedor".
 *
 * The followings are the available columns in table 'proveedor':
 * @property string $PROVEEDOR
 * @property integer $CATEGORIA
 * @property string $NOMBRE
 * @property string $ALIAS
 * @property string $CONTACTO
 * @property string $CARGO
 * @property string $DIRECCION
 * @property string $EMAIL
 * @property string $FECHA_INGRESO
 * @property string $TELEFONO1
 * @property string $TELEFONO2
 * @property string $FAX
 * @property string $NIT
 * @property string $CONDICION_PAGO
 * @property string $ACTIVO
 * @property string $ORDEN_MINIMA
 * @property string $DESCUENTO
 * @property string $TASA_INTERES_MORA
 *
 * The followings are the available model relations:
 * @property Categoria $cATEGORIA
 * @property CentroCostos $cONDICIONPAGO
 * @property Nit $nIT
 */
class Proveedor extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Proveedor the static model class
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
		return 'proveedor';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PROVEEDOR, CATEGORIA, NOMBRE, CONTACTO, CARGO, DIRECCION, FECHA_INGRESO, TELEFONO1, NIT, ACTIVO', 'required'),
			array('CATEGORIA', 'numerical', 'integerOnly'=>true),
			array('PROVEEDOR, TELEFONO1, TELEFONO2, FAX, NIT', 'length', 'max'=>20),
			array('NOMBRE, ALIAS', 'length', 'max'=>80),
			array('CONTACTO, CARGO', 'length', 'max'=>30),
			array('EMAIL', 'length', 'max'=>128),
			array('CONDICION_PAGO', 'length', 'max'=>25),
			array('ACTIVO', 'length', 'max'=>1),
			array('ORDEN_MINIMA, DESCUENTO, TASA_INTERES_MORA', 'length', 'max'=>28),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('PROVEEDOR, CATEGORIA, NOMBRE, ALIAS, CONTACTO, CARGO, DIRECCION, EMAIL, FECHA_INGRESO, TELEFONO1, TELEFONO2, FAX, NIT, CONDICION_PAGO, ACTIVO, ORDEN_MINIMA, DESCUENTO, TASA_INTERES_MORA', 'safe', 'on'=>'search'),
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
			'cATEGORIA' => array(self::BELONGS_TO, 'Categoria', 'CATEGORIA'),
			'cONDICIONPAGO' => array(self::BELONGS_TO, 'CentroCostos', 'CONDICION_PAGO'),
			'nIT' => array(self::BELONGS_TO, 'Nit', 'NIT'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'PROVEEDOR' => 'Proveedor',
			'CATEGORIA' => 'Categoria',
			'NOMBRE' => 'Nombre',
			'ALIAS' => 'Alias',
			'CONTACTO' => 'Contacto',
			'CARGO' => 'Cargo',
			'DIRECCION' => 'Direccion',
			'EMAIL' => 'Email',
			'FECHA_INGRESO' => 'Fecha Ingreso',
			'TELEFONO1' => 'Telefono1',
			'TELEFONO2' => 'Telefono2',
			'FAX' => 'Fax',
			'NIT' => 'Nit',
			'CONDICION_PAGO' => 'Condicion Pago',
			'ACTIVO' => 'Activo',
			'ORDEN_MINIMA' => 'Orden Minima',
			'DESCUENTO' => 'Descuento',
			'TASA_INTERES_MORA' => 'Tasa Interes Mora',
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

		$criteria->compare('PROVEEDOR',$this->PROVEEDOR,true);
		$criteria->compare('CATEGORIA',$this->CATEGORIA);
		$criteria->compare('NOMBRE',$this->NOMBRE,true);
		$criteria->compare('ALIAS',$this->ALIAS,true);
		$criteria->compare('CONTACTO',$this->CONTACTO,true);
		$criteria->compare('CARGO',$this->CARGO,true);
		$criteria->compare('DIRECCION',$this->DIRECCION,true);
		$criteria->compare('EMAIL',$this->EMAIL,true);
		$criteria->compare('FECHA_INGRESO',$this->FECHA_INGRESO,true);
		$criteria->compare('TELEFONO1',$this->TELEFONO1,true);
		$criteria->compare('TELEFONO2',$this->TELEFONO2,true);
		$criteria->compare('FAX',$this->FAX,true);
		$criteria->compare('NIT',$this->NIT,true);
		$criteria->compare('CONDICION_PAGO',$this->CONDICION_PAGO,true);
		$criteria->compare('ACTIVO',$this->ACTIVO,true);
		$criteria->compare('ORDEN_MINIMA',$this->ORDEN_MINIMA,true);
		$criteria->compare('DESCUENTO',$this->DESCUENTO,true);
		$criteria->compare('TASA_INTERES_MORA',$this->TASA_INTERES_MORA,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}