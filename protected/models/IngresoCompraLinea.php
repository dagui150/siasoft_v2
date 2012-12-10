<?php

/**
 * This is the model class for table "ingreso_compra_linea".
 *
 * The followings are the available columns in table 'ingreso_compra_linea':
 * @property integer $INGRESO_COMPRA_LINEA
 * @property string $INGRESO_COMPRA
 * @property integer $LINEA_NUM
 * @property integer $ORDEN_COMPRA_LINEA
 * @property string $ARTICULO
 * @property string $BODEGA
 * @property string $CANTIDAD_ORDENADA
 * @property integer $UNIDAD_ORDENADA
 * @property string $CANTIDAD_ACEPTADA
 * @property string $CANTIDAD_RECHAZADA
 * @property string $PRECIO_UNITARIO
 * @property string $COSTO_FISCAL_UNITARIO
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property UnidadMedida $uNIDADORDENADA
 * @property Articulo $aRTICULO
 * @property Bodega $bODEGA
 * @property IngresoCompra $iNGRESOCOMPRA
 * @property OrdenCompraLinea $oRDENCOMPRALINEA
 */
class IngresoCompraLinea extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IngresoCompraLinea the static model class
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
		return 'ingreso_compra_linea';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('INGRESO_COMPRA, LINEA_NUM, ARTICULO, BODEGA, CANTIDAD_ORDENADA, UNIDAD_ORDENADA, CANTIDAD_ACEPTADA, CANTIDAD_RECHAZADA, PRECIO_UNITARIO, COSTO_FISCAL_UNITARIO', 'required'),
			array('LINEA_NUM, ORDEN_COMPRA_LINEA, UNIDAD_ORDENADA', 'numerical', 'integerOnly'=>true),
			array('INGRESO_COMPRA', 'length', 'max'=>10),
			array('ARTICULO, CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('BODEGA', 'length', 'max'=>4),
			array('CANTIDAD_ORDENADA, CANTIDAD_ACEPTADA, CANTIDAD_RECHAZADA, PRECIO_UNITARIO, COSTO_FISCAL_UNITARIO', 'length', 'max'=>28),
			array('ACTIVO', 'length', 'max'=>1),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('INGRESO_COMPRA_LINEA, INGRESO_COMPRA, LINEA_NUM, ORDEN_COMPRA_LINEA, ARTICULO, BODEGA, CANTIDAD_ORDENADA, UNIDAD_ORDENADA, CANTIDAD_ACEPTADA, CANTIDAD_RECHAZADA, PRECIO_UNITARIO, COSTO_FISCAL_UNITARIO, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'uNIDADORDENADA' => array(self::BELONGS_TO, 'UnidadMedida', 'UNIDAD_ORDENADA'),
			'aRTICULO' => array(self::BELONGS_TO, 'Articulo', 'ARTICULO'),
			'bODEGA' => array(self::BELONGS_TO, 'Bodega', 'BODEGA'),
			'iNGRESOCOMPRA' => array(self::BELONGS_TO, 'IngresoCompra', 'INGRESO_COMPRA'),
			'oRDENCOMPRALINEA' => array(self::BELONGS_TO, 'OrdenCompraLinea', 'ORDEN_COMPRA_LINEA'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'INGRESO_COMPRA_LINEA' => 'Ingreso Compra Linea',
			'INGRESO_COMPRA' => 'Ingreso Compra',
			'LINEA_NUM' => 'Linea Num',
			'ORDEN_COMPRA_LINEA' => 'Orden Compra Linea',
			'ARTICULO' => 'Articulo',
			'BODEGA' => 'Bodega',
			'CANTIDAD_ORDENADA' => 'Cantidad Ordenada',
			'UNIDAD_ORDENADA' => 'Unidad Ordenada',
			'CANTIDAD_ACEPTADA' => 'Cantidad Aceptada',
			'CANTIDAD_RECHAZADA' => 'Cantidad Rechazada',
			'PRECIO_UNITARIO' => 'Precio Unitario',
			'COSTO_FISCAL_UNITARIO' => 'Costo Fiscal Unitario',
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

		$criteria->compare('INGRESO_COMPRA_LINEA',$this->INGRESO_COMPRA_LINEA);
		$criteria->compare('INGRESO_COMPRA',$this->INGRESO_COMPRA,true);
		$criteria->compare('LINEA_NUM',$this->LINEA_NUM);
		$criteria->compare('ORDEN_COMPRA_LINEA',$this->ORDEN_COMPRA_LINEA);
		$criteria->compare('ARTICULO',$this->ARTICULO,true);
		$criteria->compare('BODEGA',$this->BODEGA,true);
		$criteria->compare('CANTIDAD_ORDENADA',$this->CANTIDAD_ORDENADA,true);
		$criteria->compare('UNIDAD_ORDENADA',$this->UNIDAD_ORDENADA);
		$criteria->compare('CANTIDAD_ACEPTADA',$this->CANTIDAD_ACEPTADA,true);
		$criteria->compare('CANTIDAD_RECHAZADA',$this->CANTIDAD_RECHAZADA,true);
		$criteria->compare('PRECIO_UNITARIO',$this->PRECIO_UNITARIO,true);
		$criteria->compare('COSTO_FISCAL_UNITARIO',$this->COSTO_FISCAL_UNITARIO,true);
		$criteria->compare('ACTIVO',$this->ACTIVO,true);
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