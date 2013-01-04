<?php

/**
 * This is the model class for table "existencia_bodega".
 *
 * The followings are the available columns in table 'existencia_bodega':
 * @property integer $ID
 * @property string $ARTICULO
 * @property string $BODEGA
 * @property string $EXISTENCIA_MINIMA
 * @property string $EXISTENCIA_MAXIMA
 * @property string $PUNTO_REORDEN
 * @property string $CANT_DISPONIBLE
 * @property string $CANT_RESERVADA
 * @property string $CANT_REMITIDA
 * @property string $CANT_CUARENTENA
 * @property string $CANT_VENCIDA
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property Articulo $aRTICULO
 * @property Bodega $bODEGA
 */
class ExistenciaBodegaLinea extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ExistenciaBodegaLinea the static model class
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
		return 'existencia_bodega';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ARTICULO, BODEGA, EXISTENCIA_MINIMA, EXISTENCIA_MAXIMA, PUNTO_REORDEN, CANT_DISPONIBLE, CANT_RESERVADA, CANT_REMITIDA, CANT_CUARENTENA, CANT_VENCIDA, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'required'),
			array('ARTICULO, CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('BODEGA', 'length', 'max'=>4),
			array('EXISTENCIA_MINIMA, EXISTENCIA_MAXIMA, PUNTO_REORDEN, CANT_DISPONIBLE, CANT_RESERVADA, CANT_REMITIDA, CANT_CUARENTENA, CANT_VENCIDA', 'length', 'max'=>28),
			array('ACTIVO', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, ARTICULO, BODEGA, EXISTENCIA_MINIMA, EXISTENCIA_MAXIMA, PUNTO_REORDEN, CANT_DISPONIBLE, CANT_RESERVADA, CANT_REMITIDA, CANT_CUARENTENA, CANT_VENCIDA, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'bODEGA' => array(self::BELONGS_TO, 'Bodega', 'BODEGA'),
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
			'BODEGA' => 'Bodega',
			'EXISTENCIA_MINIMA' => 'Existencia Minima',
			'EXISTENCIA_MAXIMA' => 'Existencia Maxima',
			'PUNTO_REORDEN' => 'Punto Reorden',
			'CANT_DISPONIBLE' => 'Cant Disponible',
			'CANT_RESERVADA' => 'Cant Reservada',
			'CANT_REMITIDA' => 'Cant Remitida',
			'CANT_CUARENTENA' => 'Cant Cuarentena',
			'CANT_VENCIDA' => 'Cant Vencida',
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
		$criteria->compare('BODEGA',$this->BODEGA,true);
		$criteria->compare('EXISTENCIA_MINIMA',$this->EXISTENCIA_MINIMA,true);
		$criteria->compare('EXISTENCIA_MAXIMA',$this->EXISTENCIA_MAXIMA,true);
		$criteria->compare('PUNTO_REORDEN',$this->PUNTO_REORDEN,true);
		$criteria->compare('CANT_DISPONIBLE',$this->CANT_DISPONIBLE,true);
		$criteria->compare('CANT_RESERVADA',$this->CANT_RESERVADA,true);
		$criteria->compare('CANT_REMITIDA',$this->CANT_REMITIDA,true);
		$criteria->compare('CANT_CUARENTENA',$this->CANT_CUARENTENA,true);
		$criteria->compare('CANT_VENCIDA',$this->CANT_VENCIDA,true);
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