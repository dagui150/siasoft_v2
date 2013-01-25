<?php

/**
 * This is the model class for table "conf_ci".
 *
 * The followings are the available columns in table 'conf_ci':
 * @property integer $ID
 * @property integer $COSTOS_DEC
 * @property integer $EXISTENCIAS_DEC
 * @property integer $PESOS_DEC
 * @property string $COSTO_FISCAL
 * @property string $COSTO_INGR_DEFAULT
 * @property string $UNIDAD_PESO
 * @property string $UNIDAD_VOLUMEN
 * @property string $EXIST_DISPONIBLE
 * @property string $EXIST_REMITIDA
 * @property string $EXIST_RESERVADA
 * @property string $INTEGRACION_CONTA
 * @property string $USA_CODIGO_BARRAS
 * @property integer $LINEAS_MAX_TRANS
 * @property string $USA_UNIDADES_DIST
 * @property string $ASISTENCIA_AUTOMAT
 * @property string $USA_CODIGO_EAN13
 * @property string $USA_CODIGO_EAN8
 * @property string $USA_CODIGO_UCC12
 * @property string $USA_CODIGO_UCC8
 * @property string $EAN13_REGLA_LOCAL
 * @property string $EAN8_REGLA_LOCAL
 * @property string $UCC12_REGLA_LOCAL
 * @property string $PRIORIDAD_BUSQUEDA
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property MetodoValuacionInv $cOSTOFISCAL
 */
class ConfCi extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ConfCi the static model class
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
		return 'conf_ci';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('COSTOS_DEC, EXISTENCIAS_DEC, PESOS_DEC, COSTO_FISCAL, COSTO_INGR_DEFAULT, UNIDAD_PESO, UNIDAD_VOLUMEN, INTEGRACION_CONTA, USA_CODIGO_BARRAS, LINEAS_MAX_TRANS, PRIORIDAD_BUSQUEDA', 'required'),
			array('ID, COSTOS_DEC, EXISTENCIAS_DEC, PESOS_DEC, LINEAS_MAX_TRANS,EAN13_REGLA_LOCAL,EAN8_REGLA_LOCAL,UCC12_REGLA_LOCAL', 'numerical', 'integerOnly'=>true),
			array('COSTO_FISCAL,', 'length', 'max'=>11),
			array('COSTO_INGR_DEFAULT, INTEGRACION_CONTA, USA_CODIGO_BARRAS, USA_UNIDADES_DIST, ASISTENCIA_AUTOMAT, USA_CODIGO_EAN13, USA_CODIGO_EAN8, USA_CODIGO_UCC12, USA_CODIGO_UCC8, PRIORIDAD_BUSQUEDA', 'length', 'max'=>1),
			array('UNIDAD_PESO, UNIDAD_VOLUMEN, UCC12_REGLA_LOCAL', 'length', 'max'=>6),
			array('EAN13_REGLA_LOCAL', 'length', 'max'=>18),
			array('EAN8_REGLA_LOCAL', 'length', 'max'=>3),
			array('CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			
			array('EAN13_REGLA_LOCAL', 'miValidacion1'),
			array('EAN8_REGLA_LOCAL', 'miValidacion2'),
			array('UCC12_REGLA_LOCAL', 'miValidacion3'),
			
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, COSTOS_DEC, EXISTENCIAS_DEC, PESOS_DEC, COSTO_FISCAL, COSTO_COMPARATIVO, COSTO_INGR_DEFAULT, UNIDAD_PESO, UNIDAD_VOLUMEN, EXIST_EN_TOTALES, INTEGRACION_CONTA, USA_CODIGO_BARRAS, LINEAS_MAX_TRANS, USA_UNIDADES_DIST, ASISTENCIA_AUTOMAT, USA_CODIGO_EAN13, USA_CODIGO_EAN8, USA_CODIGO_UCC12, USA_CODIGO_UCC8, EAN13_REGLA_LOCAL, EAN8_REGLA_LOCAL, UCC12_REGLA_LOCAL, PRIORIDAD_BUSQUEDA, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
		);
	}
        
       
        
        public function miValidacion1($attribute,$params){
		
		if ($this->ASISTENCIA_AUTOMAT == true && $this->USA_CODIGO_EAN13 == true)
			if($this->EAN13_REGLA_LOCAL == null)
				$this->addError('EAN13_REGLA_LOCAL','Cod Pais no puede ser nulo');
		
	}
	public function miValidacion2($attribute,$params){
	
		if ($this->ASISTENCIA_AUTOMAT == true && $this->USA_CODIGO_EAN8 == true)
			if ( $this->EAN8_REGLA_LOCAL == null)
				$this->addError('EAN8_REGLA_LOCAL','Cod Pais no puede ser nulo');
		
	}
	public function miValidacion3($attribute,$params){
	
		if ($this->ASISTENCIA_AUTOMAT == true && $this->USA_CODIGO_UCC12 == true)
			if ( $this->UCC12_REGLA_LOCAL == null)
				$this->addError('UCC12_REGLA_LOCAL','Cod Sistema no puede ser nulo');
		
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
			'cOSTOFISCAL' => array(self::BELONGS_TO, 'MetodoValuacionInv', 'COSTO_FISCAL'),
                        'uNIDADPESO' => array(self::BELONGS_TO, 'UnidadMedida', 'UNIDAD_PESO'),
                        'uNIDADVOLUMEN' => array(self::BELONGS_TO, 'UnidadMedida', 'UNIDAD_VOLUMEN'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'COSTOS_DEC' => 'Costos:',
			'EXISTENCIAS_DEC' => 'Existencias:',
			'PESOS_DEC' => 'Pesos:',
			'COSTO_FISCAL' => 'Fiscal:',
			'COSTO_INGR_DEFAULT' => 'Costo Ingresos Especiales',
			'UNIDAD_PESO' => 'Unidad Peso:',
			'UNIDAD_VOLUMEN' => 'Unidad Volumen:',
			'EXIST_DISPONIBLE' => 'Disponible',
                        'EXIST_REMITIDA' => 'Remitida',
                        'EXIST_RESERVADA' => 'Reservada',
			'INTEGRACION_CONTA' => 'Integración Contable',
			'USA_CODIGO_BARRAS' => 'Usa Código de Barras',
			'LINEAS_MAX_TRANS' => 'Número Max Líneas:',
			'USA_UNIDADES_DIST' => 'Unidades de Distribucion',
			'ASISTENCIA_AUTOMAT' => 'Asistencia Automática',
			'USA_CODIGO_EAN13' => 'EAN13',
			'USA_CODIGO_EAN8' => 'EAN8',
			'USA_CODIGO_UCC12' => 'UCC12',
			'USA_CODIGO_UCC8' => 'UCC8',
			'EAN13_REGLA_LOCAL' => '',
			'EAN8_REGLA_LOCAL' => '',
			'UCC12_REGLA_LOCAL' => '',
			'PRIORIDAD_BUSQUEDA' => 'Prioridad:',
			'CREADO_POR' => 'Creado Por',
			'CREADO_EL' => 'Creado El',
			'ACTUALIZADO_POR' => 'Actualizado Por',
			'ACTUALIZADO_EL' => 'Actualizado El',
		);
	}
        
        public static function darConf(){
            $conf = ConfCi::model()->find();
            
            return $conf ? true : false;
        }

}