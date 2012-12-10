<?php

/**
 * This is the model class for table "solicitud_oc".
 *
 * The followings are the available columns in table 'solicitud_oc':
 * @property string $SOLICITUD_OC
 * @property string $DEPARTAMENTO
 * @property string $FECHA_SOLICITUD
 * @property string $FECHA_REQUERIDA
 * @property string $AUTORIZADA_POR
 * @property string $FECHA_AUTORIZADA
 * @property string $PRIORIDAD
 * @property integer $LINEAS_NO_ASIG
 * @property string $COMENTARIO
 * @property string $CANCELADA_POR
 * @property string $FECHA_CANCELADA
 * @property string $RUBRO1
 * @property string $RUBRO2
 * @property string $RUBRO3
 * @property string $RUBRO4
 * @property string $RUBRO5
 * @property string $ESTADO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property Departamento $dEPARTAMENTO
 * @property SolicitudOcLinea[] $solicitudOcLineas
 */
class SolicitudOc extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SolicitudOc the static model class
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
		return 'solicitud_oc';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DEPARTAMENTO, FECHA_SOLICITUD, FECHA_REQUERIDA, PRIORIDAD', 'required'),
			array('LINEAS_NO_ASIG', 'numerical', 'integerOnly'=>true),
			array('SOLICITUD_OC, DEPARTAMENTO', 'length', 'max'=>10),
			array('AUTORIZADA_POR, CANCELADA_POR, CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('PRIORIDAD, ESTADO', 'length', 'max'=>1),
			array('RUBRO1, RUBRO2, RUBRO3, RUBRO4, RUBRO5', 'length', 'max'=>50),
			array('FECHA_AUTORIZADA, COMENTARIO, FECHA_CANCELADA', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SOLICITUD_OC, DEPARTAMENTO, FECHA_SOLICITUD, FECHA_REQUERIDA, AUTORIZADA_POR, FECHA_AUTORIZADA, PRIORIDAD, LINEAS_NO_ASIG, COMENTARIO, CANCELADA_POR, FECHA_CANCELADA, RUBRO1, RUBRO2, RUBRO3, RUBRO4, RUBRO5, ESTADO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'dEPARTAMENTO' => array(self::BELONGS_TO, 'Departamento', 'DEPARTAMENTO'),
			'solicitudOcLineas' => array(self::HAS_MANY, 'SolicitudOcLinea', 'SOLICITUD_OC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
            
            $conf = ConfCo::model()->find();
		return array(
			'SOLICITUD_OC' => 'Consecutivo',
			'DEPARTAMENTO' => 'Departamento',
			'FECHA_SOLICITUD' => 'Fecha Solicitud',
			'FECHA_REQUERIDA' => 'Fecha Requerida',
			'AUTORIZADA_POR' => 'Autorizada Por',
			'FECHA_AUTORIZADA' => 'Fecha Autorizada',
			'PRIORIDAD' => 'Prioridad',
			'LINEAS_NO_ASIG' => 'Lineas No Asig',
			'COMENTARIO' => 'Comentario',
			'CANCELADA_POR' => 'Cancelada Por',
			'FECHA_CANCELADA' => 'Fecha Cancelada',
			'RUBRO1' => $conf->RUBRO1_SOLNOM,
			'RUBRO2' => $conf->RUBRO2_SOLNOM,
			'RUBRO3' => $conf->RUBRO3_SOLNOM,
			'RUBRO4' => $conf->RUBRO4_SOLNOM,
			'RUBRO5' => $conf->RUBRO5_SOLNOM,
			'ESTADO' => 'Estado',
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

		$criteria->compare('SOLICITUD_OC',$this->SOLICITUD_OC,true);
		$criteria->compare('DEPARTAMENTO',$this->DEPARTAMENTO,true);
		$criteria->compare('FECHA_SOLICITUD',$this->FECHA_SOLICITUD,true);
		$criteria->compare('FECHA_REQUERIDA',$this->FECHA_REQUERIDA,true);
		$criteria->compare('AUTORIZADA_POR',$this->AUTORIZADA_POR,true);
		$criteria->compare('FECHA_AUTORIZADA',$this->FECHA_AUTORIZADA,true);
		$criteria->compare('PRIORIDAD',$this->PRIORIDAD,true);
		$criteria->compare('LINEAS_NO_ASIG',$this->LINEAS_NO_ASIG);
		$criteria->compare('COMENTARIO',$this->COMENTARIO,true);
		$criteria->compare('CANCELADA_POR',$this->CANCELADA_POR,true);
		$criteria->compare('FECHA_CANCELADA',$this->FECHA_CANCELADA,true);
		$criteria->compare('RUBRO1',$this->RUBRO1,true);
		$criteria->compare('RUBRO2',$this->RUBRO2,true);
		$criteria->compare('RUBRO3',$this->RUBRO3,true);
		$criteria->compare('RUBRO4',$this->RUBRO4,true);
		$criteria->compare('RUBRO5',$this->RUBRO5,true);
		$criteria->compare('ESTADO',$this->ESTADO,true);
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