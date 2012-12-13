<?php

/**
 * This is the model class for table "ingreso_compra".
 *
 * The followings are the available columns in table 'ingreso_compra':
 * @property string $INGRESO_COMPRA
 * @property string $PROVEEDOR
 * @property string $FECHA_INGRESO
 * @property string $TIENE_FACTURA
 * @property string $RUBRO1
 * @property string $RUBRO2
 * @property string $RUBRO3
 * @property string $RUBRO4
 * @property string $RUBRO5
 * @property string $NOTAS
 * @property string $ESTADO
 * @property string $APLICADO_POR
 * @property string $APLICADO_EL
 * @property string $CANCELADO_POR
 * @property string $CANCELADO_EL
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $MODIFICADO_POR
 * @property string $MODIFICADO_EL
 *
 * The followings are the available model relations:
 * @property Proveedor $pROVEEDOR
 * @property IngresoCompraLinea[] $ingresoCompraLineas
 */
class IngresoCompra extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return IngresoCompra the static model class
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
		return 'ingreso_compra';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('PROVEEDOR, FECHA_INGRESO', 'required'),
			array('INGRESO_COMPRA', 'length', 'max'=>10),
			array('PROVEEDOR, APLICADO_POR, CANCELADO_POR, CREADO_POR, MODIFICADO_POR', 'length', 'max'=>20),
			array('TIENE_FACTURA, ESTADO', 'length', 'max'=>1),
			array('RUBRO1, RUBRO2, RUBRO3, RUBRO4, RUBRO5', 'length', 'max'=>50),
			array('NOTAS, APLICADO_EL, CANCELADO_EL', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('INGRESO_COMPRA, PROVEEDOR, FECHA_INGRESO, TIENE_FACTURA, RUBRO1, RUBRO2, RUBRO3, RUBRO4, RUBRO5, NOTAS, ESTADO, APLICADO_POR, APLICADO_EL, CANCELADO_POR, CANCELADO_EL, CREADO_POR, CREADO_EL, MODIFICADO_POR, MODIFICADO_EL', 'safe', 'on'=>'search'),
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
			'ingresoCompraLineas' => array(self::HAS_MANY, 'IngresoCompraLinea', 'INGRESO_COMPRA'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'INGRESO_COMPRA' => 'Ingreso Compra',
			'PROVEEDOR' => 'Proveedor',
			'FECHA_INGRESO' => 'Fecha Ingreso',
			'TIENE_FACTURA' => 'Tiene Factura',
			'RUBRO1' => 'Rubro1',
			'RUBRO2' => 'Rubro2',
			'RUBRO3' => 'Rubro3',
			'RUBRO4' => 'Rubro4',
			'RUBRO5' => 'Rubro5',
			'NOTAS' => 'Notas',
			'ESTADO' => 'Estado',
			'APLICADO_POR' => 'Aplicado Por',
			'APLICADO_EL' => 'Aplicado El',
			'CANCELADO_POR' => 'Cancelado Por',
			'CANCELADO_EL' => 'Cancelado El',
			'CREADO_POR' => 'Creado Por',
			'CREADO_EL' => 'Creado El',
			'MODIFICADO_POR' => 'Modificado Por',
			'MODIFICADO_EL' => 'Modificado El',
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

		$criteria->compare('INGRESO_COMPRA',$this->INGRESO_COMPRA,true);
		$criteria->compare('PROVEEDOR',$this->PROVEEDOR,true);
		$criteria->compare('FECHA_INGRESO',$this->FECHA_INGRESO,true);
		$criteria->compare('TIENE_FACTURA',$this->TIENE_FACTURA,true);
		$criteria->compare('RUBRO1',$this->RUBRO1,true);
		$criteria->compare('RUBRO2',$this->RUBRO2,true);
		$criteria->compare('RUBRO3',$this->RUBRO3,true);
		$criteria->compare('RUBRO4',$this->RUBRO4,true);
		$criteria->compare('RUBRO5',$this->RUBRO5,true);
		$criteria->compare('NOTAS',$this->NOTAS,true);
		$criteria->compare('ESTADO',$this->ESTADO,true);
		$criteria->compare('APLICADO_POR',$this->APLICADO_POR,true);
		$criteria->compare('APLICADO_EL',$this->APLICADO_EL,true);
		$criteria->compare('CANCELADO_POR',$this->CANCELADO_POR,true);
		$criteria->compare('CANCELADO_EL',$this->CANCELADO_EL,true);
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('MODIFICADO_POR',$this->MODIFICADO_POR,true);
		$criteria->compare('MODIFICADO_EL',$this->MODIFICADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function estado($codigo){
            switch ($codigo){
                case 'C' : return 'Cancelado';
                break;
                case 'R' : return 'Recibido';
                break;
                case 'P' : return 'Planeado';
                break;
            }
        }
        
        public function behaviors()
	{
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'CREADO_EL',
				'updateAttribute' => 'MODIFICADO_EL',
				'setUpdateOnCreate' => true,
			),
			
			'BlameableBehavior' => array(
				'class' => 'application.components.BlameableBehavior',
				'createdByColumn' => 'CREADO_POR',
				'updatedByColumn' => 'MODIFICADO_POR',
			),
		);
	}
}