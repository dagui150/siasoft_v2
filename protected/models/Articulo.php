<?php

/**
 * This is the model class for table "articulo".
 *
 * The followings are the available columns in table 'articulo':
 * @property string $ARTICULO
 * @property string $NOMBRE
 * @property string $ORIGEN_CORP
 * @property string $CLASE_ABC
 * @property integer $TIPO_ARTICULO
 * @property string $TIPO_COD_BARRAS
 * @property string $CODIGO_BARRAS
 * @property string $EXISTENCIA_MINIMA
 * @property string $EXISTENCIA_MAXIMA
 * @property string $PUNTO_REORDEN
 * @property string $COSTO_FISCAL
 * @property string $DESCRIPCION_COMPRA
 * @property string $IMPUESTO$IMPUESTO_COMPRA
 * @property string $BODEGA
 * @property string $IMP1_AFECTA_COSTO
 * @property string $RETENCION_COMPRA
 * @property string $NOTAS
 * @property integer $FRECUENCIA_CONTEO
 * @property string $PESO_NETO
 * @property integer $PESO_NETO_UNIDAD
 * @property string $PESO_BRUTO
 * @property integer $PESO_BRUTO_UNIDAD
 * @property string $VOLUMEN
 * @property integer $VOLUMEN_UNIDAD
 * @property integer $UNIDAD_ALMACEN
 * @property integer $UNIDAD_EMPAQUE
 * @property integer $UNIDAD_VENTA
 * @property string $FACTOR_EMPAQUE
 * @property string $FACTOR_VENTA
 * @property string $IMPUESTO_VENTA
 * @property string $RETENCION_VENTA
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property TipoArticulo $tIPOARTICULOUnidadMedida $vOLUMENUNIDAD
 * @property Bodega $bODEGA
 * @property MetodoValuacionInv $cOSTOFISCAL
 * @property Impuesto $iMPUESTO$iMPUESTOCOMPRA
 * @property Impuesto $iMPUESTOVENTA
 * @property UnidadMedida $pESOBRUTOUNIDAD
 * @property UnidadMedida $pESONETOUNIDAD
 * @property Retencion $rETENCIONCOMPRA
 * @property Retencion $rETENCIONVENTA
 * @property TipoArticulo $tIPOARTICULO
 * @property UnidadMedida $uNIDADALMACEN
 * @property UnidadMedida $uNIDADEMPAQUE
 * @property UnidadMedida $uNIDADVENTA
 * @property ArticuloMultimedia[] $articuloMultimedias
 * @property ClasificAdiArticulo[] $clasificAdiArticulos
 * @property ExistenciaBodega[] $existenciaBodegas
 * @property SolicitudOcLinea[] $solicitudOcLineas*/
class Articulo extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Articulo the static model class
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
		return 'articulo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ORIGEN_CORP, TIPO_ARTICULO, EXISTENCIA_MINIMA, EXISTENCIA_MAXIMA, PUNTO_REORDEN,', 'required'),
			array('ARTICULO, NOMBRE, FRECUENCIA_CONTEO,PESO_NETO, PESO_NETO_UNIDAD, PESO_BRUTO, PESO_BRUTO_UNIDAD, VOLUMEN, VOLUMEN_UNIDAD, UNIDAD_ALMACEN, UNIDAD_EMPAQUE, UNIDAD_VENTA, FACTOR_EMPAQUE, FACTOR_VENTA, IMPUESTO_VENTA,', 'required', 'message'=>''),
                        array('EXISTENCIA_MINIMA, EXISTENCIA_MAXIMA,PUNTO_REORDEN,FRECUENCIA_CONTEO, PESO_NETO, PESO_BRUTO, VOLUMEN, FACTOR_EMPAQUE,FACTOR_VENTA', 'numerical',),
                        array('ARTICULO, CODIGO_BARRAS, CREADO_POR, ACTUALIZADO_POR', 'length', 'max'=>20),
                        array('NOMBRE, DESCRIPCION_COMPRA', 'length', 'max'=>128),
                        array('EXISTENCIA_MINIMA, EXISTENCIA_MAXIMA, PUNTO_REORDEN, PESO_NETO, PESO_BRUTO, VOLUMEN, FACTOR_EMPAQUE, FACTOR_VENTA', 'length', 'max'=>28),
                        array('ORIGEN_CORP, CLASE_ABC, IMP1_AFECTA_COSTO, ACTIVO', 'length', 'max'=>1),
                        array('TIPO_COD_BARRAS, COSTO_FISCAL', 'length', 'max'=>10),
                        array('IMPUESTO_COMPRA, BODEGA, RETENCION_COMPRA, IMPUESTO_VENTA, RETENCION_VENTA', 'length', 'max'=>4),
                        array('NOTAS', 'safe'),
                    
                        array('IMPUESTO_VENTA', 'exist', 'attributeName'=>'ID', 'className'=>'Impuesto','allowEmpty'=>false, 'message'=>''),
                    
                        array('ARTICULO', 'unique', 'attributeName'=>'ARTICULO', 'className'=>'Articulo','allowEmpty'=>false),
                        array('EXISTENCIA_MAXIMA', 'miValidacion3', ),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('ARTICULO, NOMBRE, ORIGEN_CORP, CLASE_ABC, TIPO_ARTICULO, TIPO_COD_BARRAS, CODIGO_BARRAS, EXISTENCIA_MINIMA, EXISTENCIA_MAXIMA, PUNTO_REORDEN, COSTO_FISCAL, DESCRIPCION_COMPRA, IMPUESTO, BODEGA, IMP1_AFECTA_COSTO, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on'=>'search'),
		);
	}
        public function miValidacion3($attribute,$params){
		
		if ($this->EXISTENCIA_MAXIMA <= $this->EXISTENCIA_MINIMA){
				$this->addError('EXISTENCIA_MAXIMA','Debe ser mayor a Minima');
                }
	}
        
        public function behaviors()
	{
                $conf=ConfCi::model()->find();
                $trans = array("," => ".");
		return array(
                       /* 'defaults'=>array(
                            'class'=>'ext.decimali18nbehavior.DecimalI18NBehavior',
                            'format'=>'db',
                            'formats'=> array(
                                   'EXISTENCIA_MINIMA'=>'#0.'.str_repeat('0',$conf->EXISTENCIAS_DEC), 
                                   'EXISTENCIA_MAXIMA'=>'#0.'.str_repeat('0',$conf->EXISTENCIAS_DEC), 
                                   'PUNTO_REORDEN'=>'#0.'.str_repeat('0',$conf->EXISTENCIAS_DEC), 
                                   'PESO_BRUTO'=>'#0.'.str_repeat('0',$conf->EXISTENCIAS_DEC), 
                                   'VOLUMEN'=>'#0.'.str_repeat('0',$conf->EXISTENCIAS_DEC), 
                                   'FACTOR_EMPAQUE'=>'#0.'.str_repeat('0',$conf->EXISTENCIAS_DEC),  
                                   'FACTOR_VENTA'=>'#0.'.str_repeat('0',$conf->EXISTENCIAS_DEC), 
                            ),
                            'parseExpression'=> "strtr(\$value,',','.')",
                        ),*/
                        
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
			'vOLUMENUNIDAD' => array(self::BELONGS_TO, 'UnidadMedida', 'VOLUMEN_UNIDAD'),
                        'bODEGA' => array(self::BELONGS_TO, 'Bodega', 'BODEGA'),
                        'cOSTOFISCAL' => array(self::BELONGS_TO, 'MetodoValuacionInv', 'COSTO_FISCAL'),
                        'iMPUESTOCOMPRA' => array(self::BELONGS_TO, 'Impuesto', 'IMPUESTO_COMPRA'),
                        'iMPUESTOVENTA' => array(self::BELONGS_TO, 'Impuesto', 'IMPUESTO_VENTA'),
                        'pESOBRUTOUNIDAD' => array(self::BELONGS_TO, 'UnidadMedida', 'PESO_BRUTO_UNIDAD'),
                        'pESONETOUNIDAD' => array(self::BELONGS_TO, 'UnidadMedida', 'PESO_NETO_UNIDAD'),
                        'rETENCIONCOMPRA' => array(self::BELONGS_TO, 'Retencion', 'RETENCION_COMPRA'),
                        'rETENCIONVENTA' => array(self::BELONGS_TO, 'Retencion', 'RETENCION_VENTA'),
                        'tIPOARTICULO' => array(self::BELONGS_TO, 'TipoArticulo', 'TIPO_ARTICULO'),
                        'uNIDADALMACEN' => array(self::BELONGS_TO, 'UnidadMedida', 'UNIDAD_ALMACEN'),
                        'uNIDADEMPAQUE' => array(self::BELONGS_TO, 'UnidadMedida', 'UNIDAD_EMPAQUE'),
                        'uNIDADVENTA' => array(self::BELONGS_TO, 'UnidadMedida', 'UNIDAD_VENTA'),
                        'articuloMultimedias' => array(self::HAS_MANY, 'ArticuloMultimedia', 'ARTICULO'),
                        'clasificAdiArticulos' => array(self::HAS_MANY, 'ClasificAdiArticulo', 'ARTICULO'),
                        'existenciaBodegas' => array(self::HAS_MANY, 'ExistenciaBodega', 'ARTICULO'),
                        'solicitudOcLineas' => array(self::HAS_MANY, 'SolicitudOcLinea', 'ARTICULO'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
                $conf=ConfCi::model()->find();
                
		return array(
			'ARTICULO' => 'Referencia',
			'NOMBRE' => 'Nombre Articulo',
			'ORIGEN_CORP' => 'Origen',
			'CLASE_ABC' => 'Clase',
			'TIPO_ARTICULO' => 'Tipo Articulo',
			'TIPO_COD_BARRAS' => 'Tipo Cod Barras',
			'CODIGO_BARRAS' => 'Codigo Barras',
			'EXISTENCIA_MINIMA' => 'Minima',
			'EXISTENCIA_MAXIMA' => 'Maxima',
			'PUNTO_REORDEN' => 'Punto Reorden',
			'COSTO_FISCAL' => 'Costo Fiscal',
			'DESCRIPCION_COMPRA' => 'Descripcion Compra',
			'IMPUESTO_COMPRA' => 'Impuesto de Compra',
			'BODEGA' => 'Bodega',
			'IMP1_AFECTA_COSTO' => '',
                        'RETENCION_COMPRA' => 'Retencion Compra',
			'NOTAS' => 'Notas',
			'FRECUENCIA_CONTEO' => 'Frecuencia Conteo',
			'PESO_NETO' => 'Peso Neto',
			'PESO_NETO_UNIDAD' => 'UND',
			'PESO_BRUTO' => 'Peso Bruto',
			'PESO_BRUTO_UNIDAD' => 'UND',
			'VOLUMEN' => 'Volumen',
			'VOLUMEN_UNIDAD' => 'UND',
			'UNIDAD_ALMACEN' => 'Almacenamiento',
			'UNIDAD_EMPAQUE' => 'Empaque',
			'UNIDAD_VENTA' => 'Múltiplo Venta',
			'FACTOR_EMPAQUE' => 'Factor Empaque',
			'FACTOR_VENTA' => 'Factor Venta',
			'IMPUESTO_VENTA' => 'Impuesto Venta',
			'RETENCION_VENTA' => 'Retencion Venta',
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

		$criteria->compare('ARTICULO',$this->ARTICULO,true);
		$criteria->compare('NOMBRE',$this->NOMBRE,true);
		$criteria->compare('ORIGEN_CORP',$this->ORIGEN_CORP,true);
		$criteria->compare('CLASE_ABC',$this->CLASE_ABC,true);
		$criteria->compare('TIPO_ARTICULO',$this->TIPO_ARTICULO);
		$criteria->compare('TIPO_COD_BARRAS',$this->TIPO_COD_BARRAS,true);
		$criteria->compare('CODIGO_BARRAS',$this->CODIGO_BARRAS,true);
		$criteria->compare('EXISTENCIA_MINIMA',$this->EXISTENCIA_MINIMA,true);
		$criteria->compare('EXISTENCIA_MAXIMA',$this->EXISTENCIA_MAXIMA,true);
		$criteria->compare('PUNTO_REORDEN',$this->PUNTO_REORDEN,true);
		$criteria->compare('COSTO_FISCAL',$this->COSTO_FISCAL,true);
		$criteria->compare('DESCRIPCION_COMPRA',$this->DESCRIPCION_COMPRA,true);
		$criteria->compare('IMPUESTO_COMPRA',$this->IMPUESTO_COMPRA,true);
		$criteria->compare('BODEGA',$this->BODEGA,true);
		$criteria->compare('IMP1_AFECTA_COSTO',$this->IMP1_AFECTA_COSTO,true);
                $criteria->compare('RETENCION_COMPRA',$this->RETENCION_COMPRA,true);
		$criteria->compare('NOTAS',$this->NOTAS,true);
		$criteria->compare('FRECUENCIA_CONTEO',$this->FRECUENCIA_CONTEO);
		$criteria->compare('PESO_NETO',$this->PESO_NETO,true);
		$criteria->compare('PESO_NETO_UNIDAD',$this->PESO_NETO_UNIDAD);
		$criteria->compare('PESO_BRUTO',$this->PESO_BRUTO,true);
		$criteria->compare('PESO_BRUTO_UNIDAD',$this->PESO_BRUTO_UNIDAD);
		$criteria->compare('VOLUMEN',$this->VOLUMEN,true);
		$criteria->compare('VOLUMEN_UNIDAD',$this->VOLUMEN_UNIDAD);
		$criteria->compare('UNIDAD_ALMACEN',$this->UNIDAD_ALMACEN);
		$criteria->compare('UNIDAD_EMPAQUE',$this->UNIDAD_EMPAQUE);
		$criteria->compare('UNIDAD_VENTA',$this->UNIDAD_VENTA);
		$criteria->compare('FACTOR_EMPAQUE',$this->FACTOR_EMPAQUE,true);
		$criteria->compare('FACTOR_VENTA',$this->FACTOR_VENTA,true);
		$criteria->compare('IMPUESTO_VENTA',$this->IMPUESTO_VENTA,true);
		$criteria->compare('RETENCION_COMPRA',$this->RETENCION_COMPRA,true);
		$criteria->compare('ACTIVO',$this->ACTIVO,true);
		$criteria->compare('CREADO_POR',$this->CREADO_POR,true);
		$criteria->compare('CREADO_EL',$this->CREADO_EL,true);
		$criteria->compare('ACTUALIZADO_POR',$this->ACTUALIZADO_POR,true);
		$criteria->compare('ACTUALIZADO_EL',$this->ACTUALIZADO_EL,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function searchModal()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ARTICULO',$this->ARTICULO,true);
		$criteria->compare('NOMBRE',$this->NOMBRE,true);
		$criteria->compare('TIPO_ARTICULO',$this->TIPO_ARTICULO);
		$criteria->compare('EXISTENCIA_MINIMA',$this->EXISTENCIA_MINIMA,true);
		$criteria->compare('EXISTENCIA_MAXIMA',$this->EXISTENCIA_MAXIMA,true);
		$criteria->compare('PUNTO_REORDEN',$this->PUNTO_REORDEN,true);
		$criteria->compare('BODEGA',$this->BODEGA,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=>5
                        ),
		));
	}
        
        public static function darNombre($id){
            $bus = Articulo::model()->findByPk($id);
            
            return $bus->NOMBRE;
        }
            
}
