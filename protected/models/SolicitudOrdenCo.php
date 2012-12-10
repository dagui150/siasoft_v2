<?php

/**
 * This is the model class for table "solicitud_orden_co".
 *
 * The followings are the available columns in table 'solicitud_orden_co':
 * @property integer $ID
 * @property string $SOLICITUD_OC
 * @property integer $SOLICITUD_OC_LINEA
 * @property string $ORDEN_COMPRA
 * @property integer $ORDEN_COMPRA_LINEA
 * @property string $DECIMA
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property SolicitudOc $sOLICITUDOC
 * @property OrdenCompra $oRDENCOMPRA
 * @property OrdenCompraLinea $oRDENCOMPRALINEA
 * @property SolicitudOcLinea $sOLICITUDOCLINEA
 */
class SolicitudOrdenCo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SolicitudOrdenCo the static model class
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
		return 'solicitud_orden_co';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID, SOLICITUD_OC_LINEA, ORDEN_COMPRA_LINEA', 'numerical', 'integerOnly'=>true),
			array('SOLICITUD_OC, ORDEN_COMPRA', 'length', 'max'=>10),
			array('DECIMA', 'length', 'max'=>28),
			array('ACTIVO', 'length', 'max'=>1),
			array('CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, SOLICITUD_OC, SOLICITUD_OC_LINEA, ORDEN_COMPRA, ORDEN_COMPRA_LINEA, DECIMA, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'sOLICITUDOC' => array(self::BELONGS_TO, 'SolicitudOc', 'SOLICITUD_OC'),
			'oRDENCOMPRA' => array(self::BELONGS_TO, 'OrdenCompra', 'ORDEN_COMPRA'),
			'oRDENCOMPRALINEA' => array(self::BELONGS_TO, 'OrdenCompraLinea', 'ORDEN_COMPRA_LINEA'),
			'sOLICITUDOCLINEA' => array(self::BELONGS_TO, 'SolicitudOcLinea', 'SOLICITUD_OC_LINEA'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'SOLICITUD_OC' => 'Solicitud Oc',
			'SOLICITUD_OC_LINEA' => 'Solicitud Oc Linea',
			'ORDEN_COMPRA' => 'Orden Compra',
			'ORDEN_COMPRA_LINEA' => 'Orden Compra Linea',
			'DECIMA' => 'Decima',
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
		$criteria->compare('SOLICITUD_OC',$this->SOLICITUD_OC,true);
		$criteria->compare('SOLICITUD_OC_LINEA',$this->SOLICITUD_OC_LINEA);
		$criteria->compare('ORDEN_COMPRA',$this->ORDEN_COMPRA,true);
		$criteria->compare('ORDEN_COMPRA_LINEA',$this->ORDEN_COMPRA_LINEA);
		$criteria->compare('DECIMA',$this->DECIMA,true);
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