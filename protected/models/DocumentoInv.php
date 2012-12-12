<?php

/**
 * This is the model class for table "documento_inv".
 *
 * The followings are the available columns in table 'documento_inv':
 * @property string $DOCUMENTO_INV
 * @property string $CONSECUTIVO
 * @property string $FECHA_DOCUMENTO
 * @property string $REFERENCIA
 * @property string $ESTADO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property ConsecutivoCi $cONSECUTIVO
 * @property DocumentoInvLinea[] $documentoInvLineas
 */
class DocumentoInv extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DocumentoInv the static model class
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
		return 'documento_inv';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('DOCUMENTO_INV, CONSECUTIVO, FECHA_DOCUMENTO, REFERENCIA, ESTADO,', 'required'),
			array('DOCUMENTO_INV, CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('CONSECUTIVO', 'length', 'max'=>10),
			array('REFERENCIA', 'length', 'max'=>200),
			array('ESTADO', 'length', 'max'=>1),
                    
                        array('DOCUMENTO_INV', 'unique', 'attributeName'=>'DOCUMENTO_INV', 'className'=>'DocumentoInv','allowEmpty'=>false),
                    
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('DOCUMENTO_INV, CONSECUTIVO, FECHA_DOCUMENTO, REFERENCIA, ESTADO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'cONSECUTIVO' => array(self::BELONGS_TO, 'ConsecutivoCi', 'CONSECUTIVO'),
			'documentoInvLineas' => array(self::HAS_MANY, 'DocumentoInvLinea', 'DOCUMENTO_INV'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'DOCUMENTO_INV' => 'Documento',
			'CONSECUTIVO' => 'Consecutivo',
			'FECHA_DOCUMENTO' => 'Fecha Documento',
			'REFERENCIA' => 'Referencia',
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

		$criteria->compare('DOCUMENTO_INV',$this->DOCUMENTO_INV,true);
		$criteria->compare('CONSECUTIVO',$this->CONSECUTIVO,true);
		$criteria->compare('FECHA_DOCUMENTO',$this->FECHA_DOCUMENTO,true);
		$criteria->compare('REFERENCIA',$this->REFERENCIA,true);
		$criteria->compare('ESTADO',$this->ESTADO,true);
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
        public static function darEstado($id){
            
            switch ($id){
                case 'P':
                    return 'Pendiente';
                    break;
                case 'A':
                    return 'Aprobado';
                    break;
                case 'L':
                    return 'Aplicado';
                    break;
                case 'C':
                    return 'Cancelado';
                    break;
                    
            }
            
        }
       
}