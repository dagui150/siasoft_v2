<?php

/**
 * This is the model class for table "unidad_medida".
 *
 * The followings are the available columns in table 'unidad_medida':
 * @property integer $ID
 * @property string $NOMBRE
 * @property string $ABREVIATURA
 * @property string $TIPO
 * @property string $BASE
 * @property integer $UNIDAD_BASE
 * @property string $EQUIVALENCIA
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property Clasificacion[] $clasificacions
 * @property UnidadMedida $uNIDADBASE
 * @property UnidadMedida[] $unidadMedidas
 */
class UnidadMedida extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UnidadMedida the static model class
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
		return 'unidad_medida';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('NOMBRE, ABREVIATURA, TIPO, ACTIVO,UNIDAD_BASE, EQUIVALENCIA', 'required'),
			array('EQUIVALENCIA', 'numerical','numberPattern' => '/^\s*[-+]?(\d{1,3}\.*\,*)*?\s*$/'),
			array('NOMBRE', 'length', 'max'=>64),
			array('ABREVIATURA', 'length', 'max'=>5),
			array('TIPO, ACTIVO', 'length', 'max'=>1),
			array('EQUIVALENCIA', 'length', 'max'=>28),
			array('UNIDAD_BASE', 'validarUnidadBase'),
			array('CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, NOMBRE, ABREVIATURA, TIPO, UNIDAD_BASE, EQUIVALENCIA, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
		);
	}/**
         * Validar la unidad base con las permitidas
         * @param string $attribute
         * @param array $params 
         */
        public function validarUnidadBase($attribute,$params){
            if(!in_array($this->UNIDAD_BASE,self::getUnidadesValidas()))
                $this->addError ('UNIDAD_BASE',$this->uNIDADBASE->NOMBRE.' No es permitida como base');
            
        }
	public function behaviors()
	{
		$conf=ConfCi::model()->find();
		return array(
                        'defaults'=>array(
                           'class'=>'application.components.FormatBehavior',
                           'formats'=> array(
                                   'EQUIVALENCIA'=>'###,##0.'.str_repeat('0',$conf->EXISTENCIAS_DEC), 
                                   
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
			'clasificacions' => array(self::HAS_MANY, 'Clasificacion', 'UNIDAD'),
			'uNIDADBASE' => array(self::BELONGS_TO, 'UnidadMedida', 'UNIDAD_BASE'),
			'unidadMedidas' => array(self::HAS_MANY, 'UnidadMedida', 'UNIDAD_BASE'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'Código',
			'NOMBRE' => 'Nombre',
			'ABREVIATURA' => 'Abreviatura',
			'TIPO' => 'Tipo',
			'UNIDAD_BASE' => 'Unidad Base',
			'EQUIVALENCIA' => 'Equivalencia',
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
		$criteria->compare('NOMBRE',$this->NOMBRE,true);
		$criteria->compare('ABREVIATURA',$this->ABREVIATURA,true);
		$criteria->compare('TIPO',$this->TIPO,true);
		$criteria->compare('UNIDAD_BASE',$this->UNIDAD_BASE);
		$criteria->compare('EQUIVALENCIA',$this->EQUIVALENCIA,true);
		$criteria->compare('ACTIVO','S');
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public static function getUnidad(){
            
            return CHtml::ListData(self::model()->findAll(),'ID','NOMBRE');
        }
        public static function getPeso(){
            
            return CHtml::ListData(self::model()->findAll('TIPO = "P"'),'ID','NOMBRE');
        }
        public static function getVolumen(){
            
            return CHtml::ListData(self::model()->findAll('TIPO = "V"'),'ID','NOMBRE');
        }
        
        public static function darTipo($tipo){
            
            switch ($tipo){
                case 'U':
                    return 'Unidad';
                    break;
                case 'L':
                    return 'Longitud';
                    break;
                case 'P':
                    return 'Peso';
                    break;
                case 'V':
                    return 'Volumen';
                    break;
                case 'S':
                    return 'Servicio';
                    break;
            }
            
        }
        
                public function searchPapelera()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		
		$criteria->compare('ACTIVO','N');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>false,
			'sort'=>false,
		));
	}
        /**
         * Crea un arreglo con los id's de unidad base validos 
         * 
         * @return array $unidadesValidas
         */
        public static function getUnidadesValidas(){
            $unidadesBase = self::model()->findAllByAttributes(array('ACTIVO'=>'S','BASE'=>'S'));
            $unidadesValidas = array();
            foreach($unidadesBase as $unidadBase){
                $unidadesValidas[]=$unidadBase->ID;
            }
            return $unidadesValidas;
        }
        /**
         * Metodo para validar que las unidades del sistema
         * esten bien configuradas
         * 
         * @return boolean 
         */
        public static function validarUnidad(){
            $unidadesBase = self::model()->findAllByAttributes(array('ACTIVO'=>'S','BASE'=>'S'));
            $unidades = self::model()->findAllByAttributes(array('ACTIVO'=>'S','BASE'=>'N'));
            $return = true;
            //verifica si la unidad base  de las BASE son correctas
            foreach($unidadesBase as $unidadBase){
                if($unidadBase->UNIDAD_BASE != $unidadBase->ID){
                    $unidadBase->UNIDAD_BASE = $unidadBase->ID;
                    $unidadBase->update();
                }
            }
            //Valida que esten correctas las unidades de medida que esten creeadas
            foreach($unidades as $unidad){
                if(!in_array($unidad->UNIDAD_BASE,self::getUnidadesValidas())){
                     $return = false;
                        break;
                }
            }
            return $return;
        }
}