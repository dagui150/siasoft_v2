<?php

/**
 * This is the model class for table "documento_inv_linea".
 *
 * The followings are the available columns in table 'documento_inv_linea':
 * @property integer $DOCUMENTO_INV_LINEA
 * @property string $DOCUMENTO_INV
 * @property integer $LINEA_NUM
 * @property string $TIPO_TRANSACCION
 * @property integer $SUBTIPO
 * @property string $TIPO_TRANSACCION_CANTIDAD
 * @property string $BODEGA
 * @property string $BODEGA_DESTINO
 * @property string $ARTICULO
 * @property string $CANTIDAD
 * @property integer $UNIDAD
 * @property string $COSTO_UNITARIO
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property Articulo $aRTICULO
 * @property Bodega $bODEGA
 * @property Bodega $bODEGADESTINO
 * @property DocumentoInv $dOCUMENTOINV
 * @property SubtipoTransaccion $sUBTIPO
 * @property TipoCantidadArticulo $tIPOTRANSACCIONCANTIDAD
 * @property TipoTransaccion $tIPOTRANSACCION
 * @property UnidadMedida $uNIDAD
 */
class DocumentoInvLinea extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DocumentoInvLinea the static model class
	 */
    
        public $SIGNO;  
        
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'documento_inv_linea';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('TIPO_TRANSACCION, BODEGA, ARTICULO, CANTIDAD, UNIDAD, COSTO_UNITARIO', 'required'),
			array('CANTIDAD, COSTO_UNITARIO,', 'numerical', 'numberPattern' => '/^\s*[-+]?(\d{1,3}\.*\,*)*?\s*$/'),
			array('DOCUMENTO_INV, ARTICULO, CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('TIPO_TRANSACCION, BODEGA, BODEGA_DESTINO', 'length', 'max'=>4),
			array('TIPO_TRANSACCION_CANTIDAD, ACTIVO', 'length', 'max'=>1),
			array('CANTIDAD, COSTO_UNITARIO', 'length', 'max'=>28),
                                            
			array('CANTIDAD', 'validarExistencias'),
			array('UNIDAD', 'validarExistencias'),
                    
			array('BODEGA_DESTINO', 'validarBodegadestino'),
			array('CANTIDAD', 'validarCantidad'),
			array('ARTICULO', 'validarArticulo'),
                    
                        array('BODEGA', 'exist', 'attributeName'=>'ID', 'className'=>'Bodega','allowEmpty'=>true),
                        array('BODEGA_DESTINO', 'exist', 'attributeName'=>'ID', 'className'=>'Bodega','allowEmpty'=>true),
                        array('ARTICULO', 'exist', 'attributeName'=>'ARTICULO', 'className'=>'Articulo','allowEmpty'=>true),
                    
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('DOCUMENTO_INV_LINEA, DOCUMENTO_INV, LINEA_NUM, TIPO_TRANSACCION, SUBTIPO, TIPO_TRANSACCION_CANTIDAD, BODEGA, BODEGA_DESTINO, ARTICULO, CANTIDAD, UNIDAD, COSTO_UNITARIO, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
		);
	}
        /**
         *  valida que la cantidad del articulo
         * 
         *  verifica que la cantidad digitada exista en la bodega
         * @param string $attribute
         * @param mixed $params 
         */
        public function validarExistencias($attribute,$params){
            $cantidadUsar = 'D';
            $textcantidadUsar = 'disponible(s)';
            $existenciaBodega = ExistenciaBodega::model()->findByAttributes(array('ACTIVO'=>'S','ARTICULO'=>$this->ARTICULO,'BODEGA'=>$this->BODEGA));
	    if($this->TIPO_TRANSACCION != '' && $this->TIPO_TRANSACCION_CANTIDAD != '' && $existenciaBodega){
                $cantidad = Controller::darCantidad($existenciaBodega, $this->CANTIDAD, $this->UNIDAD);
                switch($this->TIPO_TRANSACCION_CANTIDAD){
                    case 'D':
                        $cantidadUsar = $existenciaBodega->CANT_DISPONIBLE;
                        $textcantidadUsar = 'disponible(s)';
                    break;
                    case 'C':
                        $cantidadUsar = $existenciaBodega->CANT_CUARENTENA;
                        $textcantidadUsar = 'en cuarentena';
                    break;
                    case 'R':
                        $cantidadUsar = $existenciaBodega->CANT_RESERVADA;
                        $textcantidadUsar = 'reservada(s)';
                    break;
                    case 'T':
                        $cantidadUsar = $existenciaBodega->CANT_REMITIDA;
                        $textcantidadUsar = 'remitida(s)';
                    break;
                    case 'V':
                        $cantidadUsar = $existenciaBodega->CANT_VENCIDA;
                        $textcantidadUsar = 'vencida(s)';
                    break;
                }
                if($this->tIPOTRANSACCION->NATURALEZA == 'S'){
                    if($cantidad > $cantidadUsar)
                        $this->addError('CANTIDAD','Solo hay '.$cantidadUsar.' '.$existenciaBodega->aRTICULO->uNIDADALMACEN->NOMBRE.'(s) '.$textcantidadUsar);
                }elseif($this->tIPOTRANSACCION->NATURALEZA == 'A'){
                    $cantidad = (string)$cantidad;
                    if(strpos($cantidad,'-') == 0){
                        $cantidad = str_replace('-', '', $cantidad);
                        $cantidad = (int)$cantidad;
                        if($cantidad > $cantidadUsar)
                            $this->addError('CANTIDAD','Solo hay '.$cantidadUsar.' '.$existenciaBodega->aRTICULO->uNIDADALMACEN->NOMBRE.'(s) '.$textcantidadUsar);
                    }
                }
            }
	}
        /**
         * Metodo para validar que el articulo exista en la bodega seleccionada
         * @param string $attribute
         * @param mixed $params  
         */
        public function validarArticulo($attribute,$params){
	
            if ($this->BODEGA != null){
                $existenciaBodega = ExistenciaBodega::model()->findByAttributes(array('ARTICULO'=>$this->ARTICULO,'BODEGA'=>$this->BODEGA));
            
		if (!$existenciaBodega)
			$this->addError('ARTICULO','Articulo no esta en esta Bodega');
                
                if ($this->BODEGA_DESTINO != null){
                    $existenciaBodegaDestino = ExistenciaBodega::model()->findByAttributes(array('ARTICULO'=>$this->ARTICULO,'BODEGA'=>$this->BODEGA_DESTINO));
                    
                    if (!$existenciaBodega)
			$this->addError('ARTICULO','Articulo no esta en la Bodega Origen');
                    
                    if (!$existenciaBodegaDestino);
                        $this->addError('ARTICULO','Articulo no esta en la Bodega Destino');
                        
                    if (!$existenciaBodega && !$existenciaBodegaDestino)
                        $this->addError('ARTICULO','Articulo no esta en Ninguna Bodega');
                    
                }
            }            
                
	}
        /**
         * Metodo para validar sea positiva o negativa
         * sgun la naturaleza de la transaccion
         * 
         * @param string $attribute
         * @param mixed $params 
         */
        public function validarCantidad($attribute,$params){
	
            if ($this->TIPO_TRANSACCION != ''){
                $tipo_transaccion = TipoTransaccion::model()->findbyPk($this->TIPO_TRANSACCION);
            
		if ($tipo_transaccion->NATURALEZA != 'A' && $this->CANTIDAD < 0)
			$this->addError('CANTIDAD','Cantidad debe ser Positiva');
            }            
                
	}
        /**
         * Metodo para validar que la bodega destino
         * exista en la bd, y que sea distinta a la de origen
         * solo si el tipo de transaccion es transpaso
         * 
         * @param string $attribute
         * @param mixed $params
         */
        public function validarBodegadestino($attribute,$params){
		
		if ($this->TIPO_TRANSACCION == 'TRAS' && $this->BODEGA_DESTINO == '')
			$this->addError('BODEGA_DESTINO','Bodega Destino no puede ser nulo');
                
                if ($this->TIPO_TRANSACCION == 'TRAS' && $this->BODEGA === $this->BODEGA_DESTINO)
                        $this->addError('BODEGA_DESTINO','Bodegas deben ser distintas');
                        
                
	}
        
        public function behaviors()
	{
		$conf=ConfCi::model()->find();
		return array(
                        'defaults'=>array(
                           'class'=>'application.components.FormatBehavior',
                           'formats'=> array(
                                   'CANTIDAD'=>'###,##0.'.str_repeat('0',$conf->EXISTENCIAS_DEC), 
                                   'COSTO_UNITARIO'=>'###,##0.'.str_repeat('0',$conf->COSTOS_DEC), 
                            ),
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
        
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'aRTICULO' => array(self::BELONGS_TO, 'Articulo', 'ARTICULO'),
			'bODEGA' => array(self::BELONGS_TO, 'Bodega', 'BODEGA'),
			'bODEGADESTINO' => array(self::BELONGS_TO, 'Bodega', 'BODEGA_DESTINO'),
			'dOCUMENTOINV' => array(self::BELONGS_TO, 'DocumentoInv', 'DOCUMENTO_INV'),
			'sUBTIPO' => array(self::BELONGS_TO, 'SubtipoTransaccion', 'SUBTIPO'),
			'tIPOTRANSACCIONCANTIDAD' => array(self::BELONGS_TO, 'TipoCantidadArticulo', 'TIPO_TRANSACCION_CANTIDAD'),
			'tIPOTRANSACCION' => array(self::BELONGS_TO, 'TipoTransaccion', 'TIPO_TRANSACCION'),
			'uNIDAD' => array(self::BELONGS_TO, 'UnidadMedida', 'UNIDAD'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'DOCUMENTO_INV_LINEA' => 'Documento Inv Línea',
			'DOCUMENTO_INV' => 'Documento Inv',
			'LINEA_NUM' => 'Línea Num',
			'TIPO_TRANSACCION' => 'Tipo Transacción',
			'SUBTIPO' => 'Subtipo',
			'TIPO_TRANSACCION_CANTIDAD' => 'Cantidad a Afectar',
			'BODEGA' => 'Bodega',
			'BODEGA_DESTINO' => 'Bodega Destino',
			'ARTICULO' => 'Artículo',
			'CANTIDAD' => 'Cantidad',
			'UNIDAD' => 'Unidad',
			'COSTO_UNITARIO' => 'Costo Unitario',
			'ACTIVO' => 'Activo',
			'CREADO_POR' => 'Creado Por',
			'CREADO_EL' => 'Creado El',
			'ACTUALIZADO_POR' => 'Actualizado Por',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('DOCUMENTO_INV_LINEA',$this->DOCUMENTO_INV_LINEA);
		$criteria->compare('DOCUMENTO_INV',$id);
		$criteria->compare('LINEA_NUM',$this->LINEA_NUM);
		$criteria->compare('TIPO_TRANSACCION',$this->TIPO_TRANSACCION,true);
		$criteria->compare('SUBTIPO',$this->SUBTIPO);
		$criteria->compare('TIPO_TRANSACCION_CANTIDAD',$this->TIPO_TRANSACCION_CANTIDAD,true);
		$criteria->compare('BODEGA',$this->BODEGA,true);
		$criteria->compare('BODEGA_DESTINO',$this->BODEGA_DESTINO,true);
		$criteria->compare('ARTICULO',$this->ARTICULO,true);
		$criteria->compare('CANTIDAD',$this->CANTIDAD,true);
		$criteria->compare('UNIDAD',$this->UNIDAD);
		$criteria->compare('COSTO_UNITARIO',$this->COSTO_UNITARIO,true);
		$criteria->compare('ACTIVO','S');
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}