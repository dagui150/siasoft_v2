<?php

/**
 * This is the model class for table "solicitud_oc_linea".
 *
 * The followings are the available columns in table 'solicitud_oc_linea':
 * @property integer $SOLICITUD_OC_LINEA
 * @property string $SOLICITUD_OC
 * @property integer $LINEA_NUM
 * @property string $ARTICULO
 * @property string $DESCRIPCION
 * @property string $CANTIDAD
 * @property string $SALDO
 * @property string $COMENTARIO
 * @property string $FECHA_REQUERIDA
 * @property string $ESTADO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 * @property integer $UNIDAD
 *
 * The followings are the available model relations:
 * @property UnidadMedida $uNIDAD
 * @property Articulo $aRTICULO
 * @property SolicitudOc $sOLICITUDOC
 */
class SolicitudOcLinea3 extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SolicitudOcLinea the static model class
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
		return 'solicitud_oc_linea';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('SOLICITUD_OC, ARTICULO, DESCRIPCION, CANTIDAD, UNIDAD', 'required'),
			array('LINEA_NUM, UNIDAD', 'numerical', 'integerOnly'=>true),
			array('SOLICITUD_OC', 'length', 'max'=>10),
			array('ARTICULO, CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('DESCRIPCION', 'length', 'max'=>128),
			array('CANTIDAD, SALDO', 'length', 'max'=>28),
			array('ESTADO', 'length', 'max'=>1),
			array('COMENTARIO', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('SOLICITUD_OC_LINEA, SOLICITUD_OC, LINEA_NUM, ARTICULO, DESCRIPCION, CANTIDAD, SALDO, COMENTARIO, FECHA_REQUERIDA, ESTADO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL, UNIDAD', 'safe', 'on'=>'search'),
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
			'uNIDAD' => array(self::BELONGS_TO, 'UnidadMedida', 'UNIDAD'),
			'aRTICULO' => array(self::BELONGS_TO, 'Articulo', 'ARTICULO'),
			'sOLICITUDOC' => array(self::BELONGS_TO, 'SolicitudOc', 'SOLICITUD_OC'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'SOLICITUD_OC_LINEA' => 'Solicitud Oc Linea',
			'SOLICITUD_OC' => 'Solicitud Oc',
			'LINEA_NUM' => 'Linea Num',
			'ARTICULO' => 'Articulo',
			'DESCRIPCION' => 'Descripcion',
			'CANTIDAD' => 'Cantidad',
			'SALDO' => 'Saldo',
			'COMENTARIO' => 'Comentario',
			'FECHA_REQUERIDA' => 'Fecha Requerida',
			'ESTADO' => 'Estado',
			'CREADO_POR' => 'Creado Por',
			'CREADO_EL' => 'Creado El',
			'ACTUALIZADO_POR' => 'Actualizado Por',
			'ACTUALIZADO_EL' => 'Actualizado El',
			'UNIDAD' => 'Unidad',
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

		$criteria->compare('SOLICITUD_OC_LINEA',$this->SOLICITUD_OC_LINEA);
		$criteria->compare('SOLICITUD_OC',$this->SOLICITUD_OC,true);
		$criteria->compare('LINEA_NUM',$this->LINEA_NUM);
		$criteria->compare('ARTICULO',$this->ARTICULO,true);
		$criteria->compare('DESCRIPCION',$this->DESCRIPCION,true);
		$criteria->compare('CANTIDAD',$this->CANTIDAD,true);
		$criteria->compare('SALDO',$this->SALDO,true);
		$criteria->compare('COMENTARIO',$this->COMENTARIO,true);
		$criteria->compare('FECHA_REQUERIDA',$this->FECHA_REQUERIDA,true);
		$criteria->compare('ESTADO',$this->ESTADO,true);
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);
		$criteria->compare('UNIDAD',$this->UNIDAD);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'keyAttribute'=>'SOLICITUD_OC_LINEA',
		));
	}
        
        public function search2()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('SOLICITUD_OC_LINEA',$this->SOLICITUD_OC_LINEA);
		$criteria->compare('SOLICITUD_OC',$this->SOLICITUD_OC,true);
		$criteria->compare('LINEA_NUM',$this->LINEA_NUM);
		$criteria->compare('ARTICULO',$this->ARTICULO,true);
		$criteria->compare('DESCRIPCION',$this->DESCRIPCION,true);
		$criteria->compare('CANTIDAD',$this->CANTIDAD,true);
		$criteria->compare('SALDO',$this->SALDO,true);
		$criteria->compare('COMENTARIO',$this->COMENTARIO,true);
		$criteria->compare('FECHA_REQUERIDA',$this->FECHA_REQUERIDA,true);
		$criteria->compare('ESTADO','N');
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);
		$criteria->compare('UNIDAD',$this->UNIDAD);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'keyAttribute'=>'SOLICITUD_OC_LINEA',
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
        
       public function getCombo($articulo){
            $bus = Articulo::model()->findByPk($articulo);
            $bus2 = UnidadMedida::model()->find('ID = "'.$bus->UNIDAD_ALMACEN.'"');
            return CHtml::listData(UnidadMedida::model()->findAll('TIPO = "'.$bus2->TIPO.'"'), 'ID', 'NOMBRE');
        }
}