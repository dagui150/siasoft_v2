<?php

/**
 * This is the model class for table "conf_co".
 *
 * The followings are the available columns in table 'conf_co':
 * @property integer $ID
 * @property string $BODEGA_DEFAULT
 * @property string $ULT_SOLICITUD
 * @property string $ULT_ORDEN_COMPRA
 * @property string $ULT_EMBARQUE
 * @property string $ULT_SOLICITUD_M
 * @property string $ULT_ORDEN_COMPRA_M
 * @property string $ULT_EMBARQUE_M
 * @property string $ULT_DEVOLUCION
 * @property string $ULT_DEVOLUCION_M
 * @property string $USAR_RUBROS
 * @property string $ORDEN_OBSERVACION
 * @property integer $MAXIMO_LINORDEN
 * @property string $POR_VARIAC_COSTO
 * @property string $CP_EN_LINEA
 * @property string $IMP1_AFECTA_DESCTO
 * @property string $FACTOR_REDONDEO
 * @property integer $PRECIO_DEC
 * @property integer $CANTIDAD_DEC
 * @property string $PEDIDOS_SOLICITUD
 * @property string $PEDIDOS_ORDEN
 * @property string $PEDIDOS_EMBARQUE
 * @property string $DIRECCION_EMBARQUE
 * @property string $DIRECCION_COBRO
 * @property string $RUBRO1_SOLNOM
 * @property string $RUBRO2_SOLNOM
 * @property string $RUBRO3_SOLNOM
 * @property string $RUBRO4_SOLNOM
 * @property string $RUBRO5_SOLNOM
 * @property string $RUBRO1_EMBNOM
 * @property string $RUBRO2_EMBNOM
 * @property string $RUBRO3_EMBNOM
 * @property string $RUBRO4_EMBNOM
 * @property string $RUBRO5_EMBNOM
 * @property string $RUBRO1_ORDNOM
 * @property string $RUBRO2_ORDNOM
 * @property string $RUBRO3_ORDNOM
 * @property string $RUBRO4_ORDNOM
 * @property string $RUBRO5_ORDNOM
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property Bodega $bODEGADEFAULT
 */
class ConfCo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ConfCo the static model class
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
		return 'conf_co';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('BODEGA_DEFAULT', 'required'),
			array('MAXIMO_LINORDEN, PRECIO_DEC, CANTIDAD_DEC', 'numerical', 'integerOnly'=>true),
			array('BODEGA_DEFAULT', 'length', 'max'=>4),
			array('ULT_SOLICITUD, ULT_ORDEN_COMPRA, ULT_EMBARQUE, ULT_SOLICITUD_M, ULT_ORDEN_COMPRA_M, ULT_EMBARQUE_M, ULT_DEVOLUCION, ULT_DEVOLUCION_M', 'length', 'max'=>10),
			array('USAR_RUBROS, CP_EN_LINEA, IMP1_AFECTA_DESCTO, PEDIDOS_SOLICITUD, PEDIDOS_ORDEN, PEDIDOS_EMBARQUE', 'length', 'max'=>1),
			array('POR_VARIAC_COSTO, FACTOR_REDONDEO', 'numerical', 'max'=>100),
			array('POR_VARIAC_COSTO, FACTOR_REDONDEO', 'numerical', 'min'=>0),
			array('POR_VARIAC_COSTO, FACTOR_REDONDEO', 'numerical', 'min'=>0),
			array('POR_VARIAC_COSTO, FACTOR_REDONDEO', 'type', 'type'=>'float'),
			array('RUBRO1_SOLNOM, RUBRO2_SOLNOM, RUBRO3_SOLNOM, RUBRO4_SOLNOM, RUBRO5_SOLNOM, RUBRO1_EMBNOM, RUBRO2_EMBNOM, RUBRO3_EMBNOM, RUBRO4_EMBNOM, RUBRO5_EMBNOM, RUBRO1_ORDNOM, RUBRO2_ORDNOM, RUBRO3_ORDNOM, RUBRO4_ORDNOM, RUBRO5_ORDNOM', 'length', 'max'=>15),
			array('CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('ORDEN_OBSERVACION, DIRECCION_EMBARQUE, DIRECCION_COBRO', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, BODEGA_DEFAULT, ULT_SOLICITUD, ULT_ORDEN_COMPRA, ULT_EMBARQUE, ULT_SOLICITUD_M, ULT_ORDEN_COMPRA_M, ULT_EMBARQUE_M, ULT_DEVOLUCION, ULT_DEVOLUCION_M, USAR_RUBROS, ORDEN_OBSERVACION, MAXIMO_LINORDEN, POR_VARIAC_COSTO, CP_EN_LINEA, IMP1_AFECTA_DESCTO, FACTOR_REDONDEO, PRECIO_DEC, CANTIDAD_DEC, PEDIDOS_SOLICITUD, PEDIDOS_ORDEN, PEDIDOS_EMBARQUE, DIRECCION_EMBARQUE, DIRECCION_COBRO, RUBRO1_SOLNOM, RUBRO2_SOLNOM, RUBRO3_SOLNOM, RUBRO4_SOLNOM, RUBRO5_SOLNOM, RUBRO1_EMBNOM, RUBRO2_EMBNOM, RUBRO3_EMBNOM, RUBRO4_EMBNOM, RUBRO5_EMBNOM, RUBRO1_ORDNOM, RUBRO2_ORDNOM, RUBRO3_ORDNOM, RUBRO4_ORDNOM, RUBRO5_ORDNOM, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'bODEGADEFAULT' => array(self::BELONGS_TO, 'Bodega', 'BODEGA_DEFAULT'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'BODEGA_DEFAULT' => 'Bodega por Omisi&oacute;n',
			'ULT_SOLICITUD' => 'Ultima Solicitud',
			'ULT_ORDEN_COMPRA' => 'Ultima Orden de Compra',
			'ULT_EMBARQUE' => 'Ultimo Embarque',
			'ULT_SOLICITUD_M' => 'Mascara - Solicitud',
			'ULT_ORDEN_COMPRA_M' => 'Mascara - Orden compra',
			'ULT_EMBARQUE_M' => 'Mascara - Embarque',
			'ULT_DEVOLUCION' => 'Ultima Devolucion',
			'ULT_DEVOLUCION_M' => 'Mascara - Devolucion',
			'USAR_RUBROS' => 'Usar Rubros',
			'ORDEN_OBSERVACION' => 'Observaciones',
			'MAXIMO_LINORDEN' => 'N&uacute;mero m&aacute;ximo de l&iacute;neas en las &oacute;rdenes',
			'POR_VARIAC_COSTO' => 'Porcentaje variaci&oacute;n de costo',
			'CP_EN_LINEA' => 'Generar factura en l&iacute;nea al aplicar embarque',
			'IMP1_AFECTA_DESCTO' => 'Impuesto 1 se afecta por',
			'FACTOR_REDONDEO' => 'Factor de Redondeo',
			'PRECIO_DEC' => 'Precio Decimales',
			'CANTIDAD_DEC' => 'Cantidad Decimales',
			'PEDIDOS_SOLICITUD' => 'Visualizar columnas de pedidos en solicitudes de compra',
			'PEDIDOS_ORDEN' => 'Visualizar columnas de pedidos en &oacute;rdenes de compra',
			'PEDIDOS_EMBARQUE' => 'Visualizar columnas de pedidos en embarque',
			'DIRECCION_EMBARQUE' => 'Direccion de Embarque',
			'DIRECCION_COBRO' => 'Direccion Fiscal Comprador',
			'RUBRO1_SOLNOM' => 'Rubro1',
			'RUBRO2_SOLNOM' => 'Rubro2',
			'RUBRO3_SOLNOM' => 'Rubro3',
			'RUBRO4_SOLNOM' => 'Rubro4',
			'RUBRO5_SOLNOM' => 'Rubro5',
			'RUBRO1_EMBNOM' => 'Rubro1',
			'RUBRO2_EMBNOM' => 'Rubro2',
			'RUBRO3_EMBNOM' => 'Rubro3',
			'RUBRO4_EMBNOM' => 'Rubro4',
			'RUBRO5_EMBNOM' => 'Rubro5',
			'RUBRO1_ORDNOM' => 'Rubro1',
			'RUBRO2_ORDNOM' => 'Rubro2',
			'RUBRO3_ORDNOM' => 'Rubro3',
			'RUBRO4_ORDNOM' => 'Rubro4',
			'RUBRO5_ORDNOM' => 'Rubro5',
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
		$criteria->compare('BODEGA_DEFAULT',$this->BODEGA_DEFAULT,true);
		$criteria->compare('ULT_SOLICITUD',$this->ULT_SOLICITUD,true);
		$criteria->compare('ULT_ORDEN_COMPRA',$this->ULT_ORDEN_COMPRA,true);
		$criteria->compare('ULT_EMBARQUE',$this->ULT_EMBARQUE,true);
		$criteria->compare('ULT_SOLICITUD_M',$this->ULT_SOLICITUD_M,true);
		$criteria->compare('ULT_ORDEN_COMPRA_M',$this->ULT_ORDEN_COMPRA_M,true);
		$criteria->compare('ULT_EMBARQUE_M',$this->ULT_EMBARQUE_M,true);
		$criteria->compare('ULT_DEVOLUCION',$this->ULT_DEVOLUCION,true);
		$criteria->compare('ULT_DEVOLUCION_M',$this->ULT_DEVOLUCION_M,true);
		$criteria->compare('USAR_RUBROS',$this->USAR_RUBROS,true);
		$criteria->compare('ORDEN_OBSERVACION',$this->ORDEN_OBSERVACION,true);
		$criteria->compare('MAXIMO_LINORDEN',$this->MAXIMO_LINORDEN);
		$criteria->compare('POR_VARIAC_COSTO',$this->POR_VARIAC_COSTO,true);
		$criteria->compare('CP_EN_LINEA',$this->CP_EN_LINEA,true);
		$criteria->compare('IMP1_AFECTA_DESCTO',$this->IMP1_AFECTA_DESCTO,true);
		$criteria->compare('FACTOR_REDONDEO',$this->FACTOR_REDONDEO,true);
		$criteria->compare('PRECIO_DEC',$this->PRECIO_DEC);
		$criteria->compare('CANTIDAD_DEC',$this->CANTIDAD_DEC);
		$criteria->compare('PEDIDOS_SOLICITUD',$this->PEDIDOS_SOLICITUD,true);
		$criteria->compare('PEDIDOS_ORDEN',$this->PEDIDOS_ORDEN,true);
		$criteria->compare('PEDIDOS_EMBARQUE',$this->PEDIDOS_EMBARQUE,true);
		$criteria->compare('DIRECCION_EMBARQUE',$this->DIRECCION_EMBARQUE,true);
		$criteria->compare('DIRECCION_COBRO',$this->DIRECCION_COBRO,true);
		$criteria->compare('RUBRO1_SOLNOM',$this->RUBRO1_SOLNOM,true);
		$criteria->compare('RUBRO2_SOLNOM',$this->RUBRO2_SOLNOM,true);
		$criteria->compare('RUBRO3_SOLNOM',$this->RUBRO3_SOLNOM,true);
		$criteria->compare('RUBRO4_SOLNOM',$this->RUBRO4_SOLNOM,true);
		$criteria->compare('RUBRO5_SOLNOM',$this->RUBRO5_SOLNOM,true);
		$criteria->compare('RUBRO1_EMBNOM',$this->RUBRO1_EMBNOM,true);
		$criteria->compare('RUBRO2_EMBNOM',$this->RUBRO2_EMBNOM,true);
		$criteria->compare('RUBRO3_EMBNOM',$this->RUBRO3_EMBNOM,true);
		$criteria->compare('RUBRO4_EMBNOM',$this->RUBRO4_EMBNOM,true);
		$criteria->compare('RUBRO5_EMBNOM',$this->RUBRO5_EMBNOM,true);
		$criteria->compare('RUBRO1_ORDNOM',$this->RUBRO1_ORDNOM,true);
		$criteria->compare('RUBRO2_ORDNOM',$this->RUBRO2_ORDNOM,true);
		$criteria->compare('RUBRO3_ORDNOM',$this->RUBRO3_ORDNOM,true);
		$criteria->compare('RUBRO4_ORDNOM',$this->RUBRO4_ORDNOM,true);
		$criteria->compare('RUBRO5_ORDNOM',$this->RUBRO5_ORDNOM,true);
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