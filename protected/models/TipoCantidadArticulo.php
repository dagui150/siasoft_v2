<?php

/**
 * This is the model class for table "tipo_cantidad_articulo".
 *
 * The followings are the available columns in table 'tipo_cantidad_articulo':
 * @property string $ID
 * @property string $NOMBRE
 * @property string $DESCRIPCION
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property TipoTransaccionCantidad[] $tipoTransaccionCantidads
 */
class TipoCantidadArticulo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TipoCantidadArticulo the static model class
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
		return 'tipo_cantidad_articulo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ID, NOMBRE, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'required'),
			array('ID, ACTIVO', 'length', 'max'=>1),
			array('NOMBRE', 'length', 'max'=>16),
			array('CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
			array('DESCRIPCION', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ID, NOMBRE, DESCRIPCION, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
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
			'tipoTransaccionCantidads' => array(self::HAS_MANY, 'TipoTransaccionCantidad', 'CANTIDAD'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'NOMBRE' => 'Nombre',
			'DESCRIPCION' => 'Descripcion',
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
		$criteria->compare('NOMBRE',$this->NOMBRE,true);
		$criteria->compare('DESCRIPCION',$this->DESCRIPCION,true);
		$criteria->compare('ACTIVO',$this->ACTIVO,true);
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        public static function darNombre($id){
            $bus = TipoCantidadArticulo::model()->findByPk($id);
            
            return  $bus->NOMBRE;
        }
        
        public static function darCombo(){
            $data = TipoCantidadArticulo::model()->findAll();
                
            return CHtml::listData($data,'ID','NOMBRE') ;
        }
        
        public static function darCantidades(){
            
            return CHtml::listData(TipoCantidadArticulo::model()->findAll(),'ID','NOMBRE');
        }
        
}