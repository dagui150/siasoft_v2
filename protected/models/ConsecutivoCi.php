<?php

/**
 * This is the model class for table "consecutivo_ci".
 *
 * The followings are the available columns in table 'consecutivo_ci':
 * @property string $ID
 * @property integer $FORMATO_IMPRESION
 * @property string $DESCRIPCION
 * @property string $MASCARA
 * @property string $SIGUIENTE_VALOR
 * @property string $TODOS_USUARIOS
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property ConsecCiTipoTrans[] $consecCiTipoTrans
 * @property ConsecCiUsuario[] $consecCiUsuarios
 * @property FormatoImpresion $fORMATOIMPRESION
 */
class ConsecutivoCi extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ConsecutivoCi the static model class
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
		return 'consecutivo_ci';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID, DESCRIPCION, MASCARA, SIGUIENTE_VALOR, TODOS_USUARIOS, ACTIVO', 'required'),
			array('FORMATO_IMPRESION', 'numerical', 'integerOnly'=>true),
			array('ID', 'length', 'max'=>10),
			array('DESCRIPCION', 'length', 'max'=>48),
			array('MASCARA, SIGUIENTE_VALOR, CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('TODOS_USUARIOS, ACTIVO', 'length', 'max'=>1),
                    
                        array('ID', 'unique', 'attributeName'=>'ID', 'className'=>'ConsecutivoCi','allowEmpty'=>false),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, FORMATO_IMPRESION, DESCRIPCION, MASCARA, SIGUIENTE_VALOR, TODOS_USUARIOS, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'consecCiTipoTrans' => array(self::HAS_MANY, 'ConsecCiTipoTrans', 'CONSECUTIVO_CI'),
			'consecCiUsuarios' => array(self::HAS_MANY, 'ConsecCiUsuario', 'CONSECUTIVO_CI'),
			'fORMATOIMPRESION' => array(self::BELONGS_TO, 'FormatoImpresion', 'FORMATO_IMPRESION'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'Código',
			'FORMATO_IMPRESION' => 'Formato Impresión',
			'DESCRIPCION' => 'Nombre',
			'MASCARA' => 'Mascara',
			'SIGUIENTE_VALOR' => 'Siguiente Valor',
			'TODOS_USUARIOS' => 'Todos los Usuarios',
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

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('FORMATO_IMPRESION',$this->FORMATO_IMPRESION);
		$criteria->compare('DESCRIPCION',$this->DESCRIPCION,true);
		$criteria->compare('MASCARA',$this->MASCARA,true);
		$criteria->compare('SIGUIENTE_VALOR',$this->SIGUIENTE_VALOR,true);
		$criteria->compare('TODOS_USUARIOS',$this->TODOS_USUARIOS,true);
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
        
        public static function darNombre($id){
            
            $bus= ConsecutivoCi::model()->findByPk($id);
            
            return $bus->DESCRIPCION;
            
            
        }
}