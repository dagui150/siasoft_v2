<?php

/**
 * This is the model class for table "estado_empleado".
 *
 * The followings are the available columns in table 'estado_empleado':
 * @property string $ESTADO_EMPLEADO
 * @property string $DESCRIPCION
 * @property string $ACTIVO
 * @property string $PAGO
 * @property string $TEMPORAL
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 */
class EstadoEmpleado extends CActiveRecord {
    
    
   

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return EstadoEmpleado the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'estado_empleado';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('ESTADO_EMPLEADO, DESCRIPCION', 'required'),
            array('ESTADO_EMPLEADO', 'unique','allowEmpty'=>true),
            array('ESTADO_EMPLEADO', 'length', 'max' => 4),
            array('DESCRIPCION', 'length', 'max' => 64),
            array('ACTIVO, PAGO, TEMPORAL', 'length', 'max' => 1),
            array('CREADO_POR, ACTUALIZADO_POR', 'length', 'max' => 20),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ESTADO_EMPLEADO, DESCRIPCION, ACTIVO, PAGO, TEMPORAL, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

        public static function getPago($codigo){
            switch ($codigo){
                case 'S' : return 'Si';
                break;
                case 'N' : return'No';
                break;
            }
        }


    public static function getTemporal($codigo){
            switch ($codigo){
                case 'S' : return 'Si';
                break;
                case 'N' : return'No';
                break;
            }
        }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ESTADO_EMPLEADO' => 'Estado Empleado',
            'DESCRIPCION' => 'Descripci&oacuten',
            'ACTIVO' => 'Activo',
            'PAGO' => 'Pago',
            'TEMPORAL' => 'Temporal',
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
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('ESTADO_EMPLEADO', $this->ESTADO_EMPLEADO, true);
        $criteria->compare('DESCRIPCION', $this->DESCRIPCION, true);
        $criteria->compare('ACTIVO', 'S');
        $criteria->compare('PAGO', $this->PAGO, true);
        $criteria->compare('TEMPORAL', $this->TEMPORAL, true);
        $criteria->compare('CREADO_POR', $this->CREADO_POR, true);
        $criteria->compare('CREADO_EL', $this->CREADO_EL, true);
        $criteria->compare('ACTUALIZADO_POR', $this->ACTUALIZADO_POR, true);
        $criteria->compare('ACTUALIZADO_EL', $this->ACTUALIZADO_EL, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public function behaviors() {
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