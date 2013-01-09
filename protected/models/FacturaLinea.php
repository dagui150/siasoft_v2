<?php

/**
 * This is the model class for table "factura_linea".
 *
 * The followings are the available columns in table 'factura_linea':
 * @property integer $ID
 * @property string $FACTURA
 * @property string $ARTICULO
 * @property integer $LINEA
 * @property integer $UNIDAD
 * @property string $CANTIDAD
 * @property string $PRECIO_UNITARIO
 * @property string $PORC_DESCUENTO
 * @property string $MONTO_DESCUENTO
 * @property string $PORC_IMPUESTO
 * @property string $VALOR_IMPUESTO
 * @property integer $TIPO_PRECIO
 * @property string $COMENTARIO
 * @property string $ESTADO
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property ArticuloPrecio $tIPOPRECIO
 * @property Articulo $aRTICULO
 * @property UnidadMedida $uNIDAD
 * @property Factura $fACTURA
 */
class FacturaLinea extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FacturaLinea the static model class
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
		return 'factura_linea';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UNIDAD, CANTIDAD, PRECIO_UNITARIO, PORC_DESCUENTO, MONTO_DESCUENTO, PORC_IMPUESTO, VALOR_IMPUESTO, TIPO_PRECIO', 'required'),
			array('FACTURA', 'length', 'max'=>50),
			array('ARTICULO, CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('CANTIDAD, PRECIO_UNITARIO, PORC_DESCUENTO, MONTO_DESCUENTO, PORC_IMPUESTO, VALOR_IMPUESTO', 'length', 'max'=>28),
			array('COMENTARIO', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, FACTURA, ARTICULO, LINEA, UNIDAD, CANTIDAD, PRECIO_UNITARIO, PORC_DESCUENTO, MONTO_DESCUENTO, PORC_IMPUESTO, VALOR_IMPUESTO, TIPO_PRECIO, COMENTARIO, ESTADO, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'tIPOPRECIO' => array(self::BELONGS_TO, 'ArticuloPrecio', 'TIPO_PRECIO'),
			'aRTICULO' => array(self::BELONGS_TO, 'Articulo', 'ARTICULO'),
			'uNIDAD' => array(self::BELONGS_TO, 'UnidadMedida', 'UNIDAD'),
			'fACTURA' => array(self::BELONGS_TO, 'Factura', 'FACTURA'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'FACTURA' => 'Factura',
			'ARTICULO' => 'Articulo',
			'LINEA' => 'Linea',
			'UNIDAD' => 'Unidad',
			'CANTIDAD' => 'Cantidad',
			'PRECIO_UNITARIO' => 'Precio Unitario',
			'PORC_DESCUENTO' => 'Porc Descuento',
			'MONTO_DESCUENTO' => 'Monto Descuento',
			'PORC_IMPUESTO' => 'Porc Impuesto',
			'VALOR_IMPUESTO' => 'Valor Impuesto',
			'TIPO_PRECIO' => 'Tipo Precio',
			'COMENTARIO' => 'Comentario',
			'ESTADO' => 'Estado',
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
		$criteria->compare('FACTURA',$this->FACTURA,true);
		$criteria->compare('ARTICULO',$this->ARTICULO,true);
		$criteria->compare('LINEA',$this->LINEA);
		$criteria->compare('UNIDAD',$this->UNIDAD);
		$criteria->compare('CANTIDAD',$this->CANTIDAD,true);
		$criteria->compare('PRECIO_UNITARIO',$this->PRECIO_UNITARIO,true);
		$criteria->compare('PORC_DESCUENTO',$this->PORC_DESCUENTO,true);
		$criteria->compare('MONTO_DESCUENTO',$this->MONTO_DESCUENTO,true);
		$criteria->compare('PORC_IMPUESTO',$this->PORC_IMPUESTO,true);
		$criteria->compare('VALOR_IMPUESTO',$this->VALOR_IMPUESTO,true);
		$criteria->compare('TIPO_PRECIO',$this->TIPO_PRECIO);
		$criteria->compare('COMENTARIO',$this->COMENTARIO,true);
		$criteria->compare('ESTADO',$this->ESTADO,true);
		$criteria->compare('ACTIVO',$this->ACTIVO,true);
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
              public function search3($id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('FACTURA',$id,true);
		$criteria->compare('ARTICULO',$this->ARTICULO,true);
		$criteria->compare('LINEA',$this->LINEA);
		$criteria->compare('UNIDAD',$this->UNIDAD);
		$criteria->compare('CANTIDAD',$this->CANTIDAD,true);
		$criteria->compare('PRECIO_UNITARIO',$this->PRECIO_UNITARIO,true);
		$criteria->compare('PORC_DESCUENTO',$this->PORC_DESCUENTO,true);
		$criteria->compare('MONTO_DESCUENTO',$this->MONTO_DESCUENTO,true);
		$criteria->compare('PORC_IMPUESTO',$this->PORC_IMPUESTO,true);
		$criteria->compare('VALOR_IMPUESTO',$this->VALOR_IMPUESTO,true);
		$criteria->compare('TIPO_PRECIO',$this->TIPO_PRECIO);
		$criteria->compare('COMENTARIO',$this->COMENTARIO,true);
		$criteria->compare('ESTADO',$this->ESTADO,true);
		$criteria->compare('ACTIVO',$this->ACTIVO,true);
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'keyAttribute'=>'FACTURA',
		));
	}
}