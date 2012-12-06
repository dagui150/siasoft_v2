<?php

/**
 * This is the model class for table "conf_fa".
 *
 * The followings are the available columns in table 'conf_fa':
 * @property integer $ID
 * @property string $COND_PAGO_CONTADO
 * @property string $BODEGA_DEFECTO
 * @property integer $CATEGORIA_CLIENTE
 * @property string $NIVEL_PRECIO
 * @property integer $DECIMALES_PRECIO
 * @property string $DESCUENTO_PRECIO
 * @property string $DESCUENTO_AFECTA_IMP
 * @property integer $FORMATO_PEDIDO
 * @property integer $FORMATO_FACTURA
 * @property integer $FORMATO_REMISION
 * @property string $USAR_RUBROS
 * @property string $OBSERVACIONES
 * @property string $RUBRO1_NOMBRE
 * @property string $RUBRO2_NOMBRE
 * @property string $RUBRO3_NOMBRE
 * @property string $RUBRO4_NOMBRE
 * @property string $RUBRO5_NOMBRE
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property Bodega $bODEGADEFECTO
 * @property Categoria $cATEGORIACLIENTE
 * @property CodicionPago $cONDPAGOCONTADO
 * @property FormatoImpresion $fORMATOFACTURA
 * @property FormatoImpresion $fORMATOPEDIDO
 * @property FormatoImpresion $fORMATOREMISION
 * @property NivelPrecio $nIVELPRECIO
 */
class ConfFa extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ConfFa the static model class
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
		return 'conf_fa';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DECIMALES_PRECIO, DESCUENTO_PRECIO, DESCUENTO_AFECTA_IMP', 'required'),
			array('CATEGORIA_CLIENTE, DECIMALES_PRECIO, FORMATO_PEDIDO, FORMATO_FACTURA, FORMATO_REMISION', 'numerical', 'integerOnly'=>true),
			array('COND_PAGO_CONTADO, BODEGA_DEFECTO', 'length', 'max'=>4),
			array('NIVEL_PRECIO', 'length', 'max'=>12),
			array('DESCUENTO_PRECIO, DESCUENTO_AFECTA_IMP, USAR_RUBROS', 'length', 'max'=>1),
			array('RUBRO1_NOMBRE, RUBRO2_NOMBRE, RUBRO3_NOMBRE, RUBRO4_NOMBRE, RUBRO5_NOMBRE', 'length', 'max'=>15),
			array('CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('OBSERVACIONES', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, COND_PAGO_CONTADO, BODEGA_DEFECTO, CATEGORIA_CLIENTE, NIVEL_PRECIO, DECIMALES_PRECIO, DESCUENTO_PRECIO, DESCUENTO_AFECTA_IMP, FORMATO_PEDIDO, FORMATO_FACTURA, FORMATO_REMISION, USAR_RUBROS, OBSERVACIONES, RUBRO1_NOMBRE, RUBRO2_NOMBRE, RUBRO3_NOMBRE, RUBRO4_NOMBRE, RUBRO5_NOMBRE, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'bODEGADEFECTO' => array(self::BELONGS_TO, 'Bodega', 'BODEGA_DEFECTO'),
			'cATEGORIACLIENTE' => array(self::BELONGS_TO, 'Categoria', 'CATEGORIA_CLIENTE'),
			'cONDPAGOCONTADO' => array(self::BELONGS_TO, 'CodicionPago', 'COND_PAGO_CONTADO'),
			'fORMATOFACTURA' => array(self::BELONGS_TO, 'FormatoImpresion', 'FORMATO_FACTURA'),
			'fORMATOPEDIDO' => array(self::BELONGS_TO, 'FormatoImpresion', 'FORMATO_PEDIDO'),
			'fORMATOREMISION' => array(self::BELONGS_TO, 'FormatoImpresion', 'FORMATO_REMISION'),
			'nIVELPRECIO' => array(self::BELONGS_TO, 'NivelPrecio', 'NIVEL_PRECIO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'COND_PAGO_CONTADO' => 'Cond Pago Contado',
			'BODEGA_DEFECTO' => 'Bodega Defecto',
			'CATEGORIA_CLIENTE' => 'Categoria Cliente',
			'NIVEL_PRECIO' => 'Nivel Precio',
			'DECIMALES_PRECIO' => 'Decimales Precio',
			'DESCUENTO_PRECIO' => 'Descuento Precio',
			'DESCUENTO_AFECTA_IMP' => 'Descuento Afecta Imp',
			'FORMATO_PEDIDO' => 'Formato Pedido',
			'FORMATO_FACTURA' => 'Formato Factura',
			'FORMATO_REMISION' => 'Formato Remision',
			'USAR_RUBROS' => 'Usar Rubros',
			'OBSERVACIONES' => 'Observaciones',
			'RUBRO1_NOMBRE' => 'Rubro1 Nombre',
			'RUBRO2_NOMBRE' => 'Rubro2 Nombre',
			'RUBRO3_NOMBRE' => 'Rubro3 Nombre',
			'RUBRO4_NOMBRE' => 'Rubro4 Nombre',
			'RUBRO5_NOMBRE' => 'Rubro5 Nombre',
			'CREADO_POR' => 'Creado Por',
			'CREADO_EL' => 'Creado El',
			'ACTUALIZADO_POR' => 'Actualizado Por',
			'ACTUALIZADO_EL' => 'Actualizado El',
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
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('COND_PAGO_CONTADO',$this->COND_PAGO_CONTADO,true);
		$criteria->compare('BODEGA_DEFECTO',$this->BODEGA_DEFECTO,true);
		$criteria->compare('CATEGORIA_CLIENTE',$this->CATEGORIA_CLIENTE);
		$criteria->compare('NIVEL_PRECIO',$this->NIVEL_PRECIO,true);
		$criteria->compare('DECIMALES_PRECIO',$this->DECIMALES_PRECIO);
		$criteria->compare('DESCUENTO_PRECIO',$this->DESCUENTO_PRECIO,true);
		$criteria->compare('DESCUENTO_AFECTA_IMP',$this->DESCUENTO_AFECTA_IMP,true);
		$criteria->compare('FORMATO_PEDIDO',$this->FORMATO_PEDIDO);
		$criteria->compare('FORMATO_FACTURA',$this->FORMATO_FACTURA);
		$criteria->compare('FORMATO_REMISION',$this->FORMATO_REMISION);
		$criteria->compare('USAR_RUBROS',$this->USAR_RUBROS,true);
		$criteria->compare('OBSERVACIONES',$this->OBSERVACIONES,true);
		$criteria->compare('RUBRO1_NOMBRE',$this->RUBRO1_NOMBRE,true);
		$criteria->compare('RUBRO2_NOMBRE',$this->RUBRO2_NOMBRE,true);
		$criteria->compare('RUBRO3_NOMBRE',$this->RUBRO3_NOMBRE,true);
		$criteria->compare('RUBRO4_NOMBRE',$this->RUBRO4_NOMBRE,true);
		$criteria->compare('RUBRO5_NOMBRE',$this->RUBRO5_NOMBRE,true);
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function darConf(){
            $conf = ConfFa::model()->find();
            
            return $conf ? true : false;
        }

}