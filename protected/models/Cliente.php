<?php

/**
 * This is the model class for table "cliente".
 *
 * The followings are the available columns in table 'cliente':
 * @property string $CLIENTE
 * @property string $REGIMEN
 * @property integer $CATEGORIA
 * @property string $IMPUESTO
 * @property string $NIT
 * @property string $TIPO_PRECIO
 * @property string $CONDICION_PAGO
 * @property string $PAIS
 * @property string $UBICACION_GEOGRAFICA1
 * @property string $UBICACION_GEOGRAFICA2
 * @property integer $ZONA
 * @property string $CIUDAD
 * @property string $NOMBRE
 * @property string $FECHA_INGRESO
 * @property string $ALIAS
 * @property string $CONTACTO
 * @property string $CARGO
 * @property string $TELEFONO1
 * @property string $TELEFONO2
 * @property string $FAX
 * @property string $INTERES_CORRIENTE
 * @property string $INTERES_MORA
 * @property string $DESCUENTO
 * @property string $LIMITE_CREDITO
 * @property string $EMAIL
 * @property string $SITIO_WEB
 * @property string $DIRECCION_COBRO
 * @property string $DIRECCION_EMBARQUE
 * @property string $RUBRO1_FA
 * @property string $RUBRO2_FA
 * @property string $RUBRO3_FA
 * @property string $RUBRO4_FA
 * @property string $RUBRO5_FA
 * @property string $RUBRO1_CC
 * @property string $RUBRO2_CC
 * @property string $RUBRO3_CC
 * @property string $RUBRO4_CC
 * @property string $RUBRO5_CC
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property RegimenTributario $rEGIMEN
 * @property Categoria $cATEGORIA
 * @property CodicionPago $cONDICIONPAGO
 * @property Nit $nIT
 * @property Impuesto $iMPUESTO
 * @property Pais $pAIS
 * @property NivelPrecio $tIPOPRECIO
 * @property UbicacionGeografica1 $uBICACIONGEOGRAFICA1
 * @property UbicacionGeografica2 $uBICACIONGEOGRAFICA2
 * @property Zona $zONA
 */
class Cliente extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Cliente the static model class
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
		return 'cliente';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CLIENTE, NOMBRE, ACTIVO', 'required'),
			array('TELEFONO1, TELEFONO2,FAX', 'numerical', 'integerOnly'=>true),
			array('INTERES_CORRIENTE, INTERES_MORA, DESCUENTO, LIMITE_CREDITO,', 'numerical'),
			array('REGIMEN, TIPO_PRECIO', 'length', 'max'=>12),
			array('IMPUESTO, CONDICION_PAGO, PAIS', 'length', 'max'=>4),
			array('NIT', 'length', 'max'=>10),
			array('EMAIL', 'email'),
			array('UBICACION_GEOGRAFICA1', 'length', 'max'=>2),
			array('UBICACION_GEOGRAFICA2', 'length', 'max'=>5),
			array('CIUDAD, NOMBRE, ALIAS, CONTACTO, RUBRO1_FA, RUBRO2_FA, RUBRO3_FA, RUBRO4_FA, RUBRO5_FA, RUBRO1_CC, RUBRO2_CC, RUBRO3_CC, RUBRO4_CC, RUBRO5_CC', 'length', 'max'=>64),
			array('CARGO', 'length', 'max'=>32),
			array('TELEFONO1, TELEFONO2, FAX', 'length', 'max'=>16),
			array('INTERES_CORRIENTE, INTERES_MORA, DESCUENTO, LIMITE_CREDITO', 'length', 'max'=>28),
			array('EMAIL, SITIO_WEB, DIRECCION_COBRO, DIRECCION_EMBARQUE', 'length', 'max'=>128),
			array('FECHA_INGRESO', 'safe'),
                    
                        array('CLIENTE', 'unique', 'attributeName'=>'CLIENTE', 'className'=>'Cliente','allowEmpty'=>false),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('CLIENTE, REGIMEN, CATEGORIA, IMPUESTO, NIT, TIPO_PRECIO, CONDICION_PAGO, PAIS, UBICACION_GEOGRAFICA1, UBICACION_GEOGRAFICA2, ZONA, CIUDAD, NOMBRE, FECHA_INGRESO, ALIAS, CONTACTO, CARGO, TELEFONO1, TELEFONO2, FAX, INTERES_CORRIENTE, INTERES_MORA, DESCUENTO, LIMITE_CREDITO, EMAIL, SITIO_WEB, DIRECCION_COBRO, DIRECCION_EMBARQUE, RUBRO1_FA, RUBRO2_FA, RUBRO3_FA, RUBRO4_FA, RUBRO5_FA, RUBRO1_CC, RUBRO2_CC, RUBRO3_CC, RUBRO4_CC, RUBRO5_CC, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'rEGIMEN' => array(self::BELONGS_TO, 'RegimenTributario', 'REGIMEN'),
			'cATEGORIA' => array(self::BELONGS_TO, 'Categoria', 'CATEGORIA'),
			'cONDICIONPAGO' => array(self::BELONGS_TO, 'CodicionPago', 'CONDICION_PAGO'),
			'nIT' => array(self::BELONGS_TO, 'Nit', 'NIT'),
			'iMPUESTO' => array(self::BELONGS_TO, 'Impuesto', 'IMPUESTO'),
			'pAIS' => array(self::BELONGS_TO, 'Pais', 'PAIS'),
			'tIPOPRECIO' => array(self::BELONGS_TO, 'NivelPrecio', 'TIPO_PRECIO'),
			'uBICACIONGEOGRAFICA1' => array(self::BELONGS_TO, 'UbicacionGeografica1', 'UBICACION_GEOGRAFICA1'),
			'uBICACIONGEOGRAFICA2' => array(self::BELONGS_TO, 'UbicacionGeografica2', 'UBICACION_GEOGRAFICA2'),
			'zONA' => array(self::BELONGS_TO, 'Zona', 'ZONA'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
            $conf_fa = ConfFa::model()->find();
		return array(
			'CLIENTE' => 'Cliente',
			'REGIMEN' => 'Regimen',
			'CATEGORIA' => 'Categoría',
			'IMPUESTO' => 'Impuesto',
			'NIT' => 'Nit',
			'TIPO_PRECIO' => 'Nivel de Precio',
			'CONDICION_PAGO' => 'Condicion de Pago',
			'PAIS' => 'Pais',
			'UBICACION_GEOGRAFICA1' => 'Departamento',
			'UBICACION_GEOGRAFICA2' => 'Municipio',
			'ZONA' => 'Zona',
			'CIUDAD' => 'Ciudad',
			'NOMBRE' => 'Nombre',
			'FECHA_INGRESO' => 'Fecha de Ingreso',
			'ALIAS' => 'Alias',
			'CONTACTO' => 'Contacto',
			'CARGO' => 'Cargo',
			'TELEFONO1' => 'Teléfonos',
			'TELEFONO2' => 'Teléfono',
			'FAX' => 'Fax',
			'INTERES_CORRIENTE' => 'Intereses Corrientes',
			'INTERES_MORA' => 'Intereses de Mora',
			'DESCUENTO' => 'Descuento',
			'LIMITE_CREDITO' => 'Limite de Credito',
			'EMAIL' => 'Email',
			'SITIO_WEB' => 'Sitio Web',
			'DIRECCION_COBRO' => 'Dirección Cobro',
			'DIRECCION_EMBARQUE' => 'Dirección de envío de articulos',
			'RUBRO1_FA' => $conf_fa->USAR_RUBROS && $conf_fa->RUBRO1_NOMBRE != '' ? $conf_fa->RUBRO1_NOMBRE : 'N/A',
			'RUBRO2_FA' => $conf_fa->USAR_RUBROS && $conf_fa->RUBRO2_NOMBRE != '' ? $conf_fa->RUBRO2_NOMBRE : 'N/A',
			'RUBRO3_FA' => $conf_fa->USAR_RUBROS && $conf_fa->RUBRO3_NOMBRE != '' ? $conf_fa->RUBRO3_NOMBRE : 'N/A',
			'RUBRO4_FA' => $conf_fa->USAR_RUBROS && $conf_fa->RUBRO4_NOMBRE != '' ? $conf_fa->RUBRO4_NOMBRE : 'N/A',
			'RUBRO5_FA' => $conf_fa->USAR_RUBROS && $conf_fa->RUBRO5_NOMBRE != '' ? $conf_fa->RUBRO5_NOMBRE : 'N/A',
			'RUBRO1_CC' => 'Rubro1 Cc',
			'RUBRO2_CC' => 'Rubro2 Cc',
			'RUBRO3_CC' => 'Rubro3 Cc',
			'RUBRO4_CC' => 'Rubro4 Cc',
			'RUBRO5_CC' => 'Rubro5 Cc',
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

		$criteria->compare('CLIENTE',$this->CLIENTE,true);
		$criteria->compare('REGIMEN',$this->REGIMEN,true);
		$criteria->compare('CATEGORIA',$this->CATEGORIA);
		$criteria->compare('IMPUESTO',$this->IMPUESTO,true);
		$criteria->compare('NIT',$this->NIT,true);
		$criteria->compare('TIPO_PRECIO',$this->TIPO_PRECIO,true);
		$criteria->compare('CONDICION_PAGO',$this->CONDICION_PAGO,true);
		$criteria->compare('PAIS',$this->PAIS,true);
		$criteria->compare('UBICACION_GEOGRAFICA1',$this->UBICACION_GEOGRAFICA1,true);
		$criteria->compare('UBICACION_GEOGRAFICA2',$this->UBICACION_GEOGRAFICA2,true);
		$criteria->compare('ZONA',$this->ZONA);
		$criteria->compare('CIUDAD',$this->CIUDAD,true);
		$criteria->compare('NOMBRE',$this->NOMBRE,true);
		$criteria->compare('FECHA_INGRESO',$this->FECHA_INGRESO,true);
		$criteria->compare('ALIAS',$this->ALIAS,true);
		$criteria->compare('CONTACTO',$this->CONTACTO,true);
		$criteria->compare('CARGO',$this->CARGO,true);
		$criteria->compare('TELEFONO1',$this->TELEFONO1,true);
		$criteria->compare('TELEFONO2',$this->TELEFONO2,true);
		$criteria->compare('FAX',$this->FAX,true);
		$criteria->compare('INTERES_CORRIENTE',$this->INTERES_CORRIENTE,true);
		$criteria->compare('INTERES_MORA',$this->INTERES_MORA,true);
		$criteria->compare('DESCUENTO',$this->DESCUENTO,true);
		$criteria->compare('LIMITE_CREDITO',$this->LIMITE_CREDITO,true);
		$criteria->compare('EMAIL',$this->EMAIL,true);
		$criteria->compare('SITIO_WEB',$this->SITIO_WEB,true);
		$criteria->compare('DIRECCION_COBRO',$this->DIRECCION_COBRO,true);
		$criteria->compare('DIRECCION_EMBARQUE',$this->DIRECCION_EMBARQUE,true);
		$criteria->compare('RUBRO1_FA',$this->RUBRO1_FA,true);
		$criteria->compare('RUBRO2_FA',$this->RUBRO2_FA,true);
		$criteria->compare('RUBRO3_FA',$this->RUBRO3_FA,true);
		$criteria->compare('RUBRO4_FA',$this->RUBRO4_FA,true);
		$criteria->compare('RUBRO5_FA',$this->RUBRO5_FA,true);
		$criteria->compare('RUBRO1_CC',$this->RUBRO1_CC,true);
		$criteria->compare('RUBRO2_CC',$this->RUBRO2_CC,true);
		$criteria->compare('RUBRO3_CC',$this->RUBRO3_CC,true);
		$criteria->compare('RUBRO4_CC',$this->RUBRO4_CC,true);
		$criteria->compare('RUBRO5_CC',$this->RUBRO5_CC,true);
		$criteria->compare('ACTIVO','S');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}