<?php

/**
 * This is the model class for table "modulo".
 *
 * The followings are the available columns in table 'modulo':
 * @property string $ID
 * @property string $NOMBRE
 * @property string $SUBMODULO
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 */
class Plantilla extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Cargo the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'plantilla';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('NOMBRE', 'required'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('NOMBRE, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'sUBMODULO' => array(self::BELONGS_TO, 'SubModulo', 'ID'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'Id',
            'NOMBRE' => 'Nombre',
            'SUBMODULO' => 'SubModulo',
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
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('ID', $this->ID, true);
        $criteria->compare('NOMBRE', $this->NOMBRE, true);
        $criteria->compare('ACTIVO', 'S');
        $criteria->compare('SUBMODULO', $this->SUBMODULO, true);
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