<?php

/**
 * This is the model class for table "conf_as".
 *
 * The followings are the available columns in table 'conf_as':
 * @property integer $ID
 * @property string $IMPUESTO1_DESC
 * @property string $IMPUESTO2_DESC
 * @property string $PATRON_CCOSTO
 * @property string $SIMBOLO_MONEDA
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 */
class ConfAs extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ConfAs the static model class
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
		return 'conf_as';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('IMPUESTO1_DESC, IMPUESTO2_DESC', 'length', 'max'=>10),
			array('PATRON_CCOSTO', 'length', 'max'=>25),
			array('SIMBOLO_MONEDA', 'length', 'max'=>3),
			array('CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, IMPUESTO1_DESC, IMPUESTO2_DESC, PATRON_CCOSTO, SIMBOLO_MONEDA, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'IMPUESTO1_DESC' => 'Nombre del impuesto de consumo',
			'IMPUESTO2_DESC' => 'Impuesto 2',
			'PATRON_CCOSTO' => 'Mascara para centros de costo',
			'SIMBOLO_MONEDA' => Yii::t('app','CURRENCY_SYMBOL'),
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
		$criteria->compare('IMPUESTO1_DESC',$this->IMPUESTO1_DESC,true);
		$criteria->compare('IMPUESTO2_DESC',$this->IMPUESTO2_DESC,true);
		$criteria->compare('PATRON_CCOSTO',$this->PATRON_CCOSTO,true);
		$criteria->compare('SIMBOLO_MONEDA',$this->SIMBOLO_MONEDA,true);
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