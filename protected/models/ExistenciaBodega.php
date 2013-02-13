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
 * @property string $EXISTENCIA_MINIMA_ADD
 * @property string $EXISTENCIA_MAXIMA_ADD
 * @property string $PUNTO_REORDEN_ADD
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
 * @property Bodega $bODEGA
 * @property Articulo $aRTICULO
 */
class ExistenciaBodega extends CActiveRecord
{
        /**
         * @var string  $EXISTENCIA_MINIMA_ADD Es para agregar existencia minima a una linea nueva
         * @var string  $EXISTENCIA_MAXIMA_ADD Es para agregar existencia maxima a una linea nueva
         * @var string  $PUNTO_REORDEN_ADD Es para agregar punto de reorden a una linea nueva
         */
        public $EXISTENCIA_MINIMA_ADD;
        public $EXISTENCIA_MAXIMA_ADD;
        public $PUNTO_REORDEN_ADD;
        
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ExistenciaBodega the static model class
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
			array('ARTICULO,EXISTENCIA_MINIMA, EXISTENCIA_MAXIMA, PUNTO_REORDEN, CANT_DISPONIBLE, CANT_RESERVADA, CANT_REMITIDA, CANT_CUARENTENA, CANT_VENCIDA, ACTIVO', 'required'),
			array('BODEGA,','required', 'message'=>''),
			array('ARTICULO, CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('BODEGA', 'length', 'max'=>4),
			array('EXISTENCIA_MINIMA, EXISTENCIA_MAXIMA, PUNTO_REORDEN, CANT_DISPONIBLE, CANT_RESERVADA, CANT_REMITIDA', 'length', 'max'=>28),
			array('ACTIVO', 'length', 'max'=>1),
                        array('BODEGA', 'exist', 'attributeName'=>'ID', 'className'=>'Bodega','allowEmpty'=>false, 'message'=>''),
                        array('ARTICULO', 'exist', 'attributeName'=>'ARTICULO', 'className'=>'Articulo','allowEmpty'=>false, 'message'=>''),
                        array('ARTICULO', 'miValidacion',),
                        array('ARTICULO', 'miValidacion2','on'=>'addLinea'),
                        //array('ARTICULO,EXISTENCIA_MINIMA_ADD, EXISTENCIA_MAXIMA_ADD, PUNTO_REORDEN_ADD','required','on'=>'addLinea'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, ARTICULO, BODEGA, EXISTENCIA_MINIMA, EXISTENCIA_MAXIMA, PUNTO_REORDEN, CANT_DISPONIBLE, CANT_RESERVADA, CANT_REMITIDA, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
		);
	}
        
        public function miValidacion($attribute,$params){
		$trans = array("," => ".");
		if (strtr($this->EXISTENCIA_MAXIMA, $trans) <= strtr($this->EXISTENCIA_MINIMA, $trans)){
				$this->addError('EXISTENCIA_MAXIMA','Debe ser mayor a Mínima');
                }
	}
        
        public function miValidacion2($attribute,$params){
            if($this->EXISTENCIA_MAXIMA_ADD != '' && $this->EXISTENCIA_MINIMA_ADD != ''){
		$trans = array("," => ".");
		if (strtr($this->EXISTENCIA_MAXIMA_ADD, $trans) <= strtr($this->EXISTENCIA_MINIMA_ADD, $trans)){
				$this->addError('EXISTENCIA_MAXIMA_ADD','Debe ser mayor a Mínima');
                }
            }
	}
        
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'bODEGA' => array(self::BELONGS_TO, 'Bodega', 'BODEGA'),
			'aRTICULO' => array(self::BELONGS_TO, 'Articulo', 'ARTICULO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'Código',
			'ARTICULO' => 'Código Artículo',
			'BODEGA' => 'Código Bodega',
			'EXISTENCIA_MINIMA' => 'Mínima',
			'EXISTENCIA_MAXIMA' => 'Máxima',
			'PUNTO_REORDEN' => 'Punto Reorden',
			'CANT_DISPONIBLE' => 'Disponible',
			'CANT_RESERVADA' => 'Reservada',
			'CANT_REMITIDA' => 'Remitida',
			'CANT_CUARENTENA' => 'Cuarentena',
			'CANT_VENCIDA' => 'Vencida',
			'ACTIVO' => 'Activo',
			'CREADO_POR' => 'Creado Por',
			'CREADO_EL' => 'Creado El',
			'ACTUALIZADO_POR' => 'Actualizado Por',
			'ACTUALIZADO_EL' => 'Actualizado El',
                        'EXISTENCIA_MINIMA_ADD'=>'Mínima',
                        'EXISTENCIA_MAXIMA_ADD'=>'Máxima',
                        'PUNTO_REORDEN_ADD'=>'Punto Reorden',
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
		$criteria->compare('ACTIVO','S');
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function search2($articulo)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID);
		$criteria->compare('ARTICULO',$articulo);
		$criteria->compare('BODEGA',$this->BODEGA,true);
		$criteria->compare('EXISTENCIA_MINIMA',$this->EXISTENCIA_MINIMA,true);
		$criteria->compare('EXISTENCIA_MAXIMA',$this->EXISTENCIA_MAXIMA,true);
		$criteria->compare('PUNTO_REORDEN',$this->PUNTO_REORDEN,true);
		$criteria->compare('CANT_DISPONIBLE',$this->CANT_DISPONIBLE,true);
		$criteria->compare('CANT_RESERVADA',$this->CANT_RESERVADA,true);
		$criteria->compare('CANT_REMITIDA',$this->CANT_REMITIDA,true);
		$criteria->compare('ACTIVO','S');
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination' => array(
                            'pageSize' => 6,
                        ),
		));
	}
        
         public function behaviors()
	{
                $conf=ConfCi::model()->find();
		return array(
                    'defaults'=>array(
                            'class'=>'application.components.FormatBehavior',
                            'format'=>'db',
                            'formats'=> array(
                                   'EXISTENCIA_MINIMA'=>'#0.'.str_repeat('0',$conf->EXISTENCIAS_DEC), 
                                   'EXISTENCIA_MAXIMA'=>'#0.'.str_repeat('0',$conf->EXISTENCIAS_DEC), 
                                   'PUNTO_REORDEN'=>'#0.'.str_repeat('0',$conf->EXISTENCIAS_DEC), 
                                   'CANT_DISPONIBLE'=>'#0.'.str_repeat('0',$conf->EXISTENCIAS_DEC), 
                                   'CANT_RESERVADA'=>'#0.'.str_repeat('0',$conf->EXISTENCIAS_DEC), 
                                   'CANT_REMITIDA'=>'#0.'.str_repeat('0',$conf->EXISTENCIAS_DEC), 
                            ),
                            'parseExpression'=> "strtr(\$value,',','.')",
                        ),
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