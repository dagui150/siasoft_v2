<?php

/**
 * This is the model class for table "formato_impresion".
 *
 * The followings are the available columns in table 'formato_impresion':
 * @property integer $ID
 * @property string $NOMBRE
 * @property string $OBSERVACION
 * @property string $MODULO
 * @property string $SUBMODULO
 * @property string $RUTA
 * @property string $TIPO
 * @property string $ACTIVO
 * @property string $CREADO_POR
 * @property string $CREADO_EL
 * @property string $ACTUALIZADO_POR
 * @property string $ACTUALIZADO_EL
 *
 * The followings are the available model relations:
 * @property ConsecutivoCi[] $consecutivoCis
 */
class FormatoImpresion extends CActiveRecord {

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return FormatoImpresion the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'formato_impresion';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(' NOMBRE, MODULO, SUBMODULO, RUTA, TIPO', 'required'),
            array('ID', 'numerical', 'integerOnly' => true),
            array('NOMBRE', 'length', 'max' => 64),
            array('MODULO, SUBMODULO, TIPO', 'length', 'max' => 4),
            array('RUTA', 'length', 'max' => 128),
            array('ACTIVO', 'length', 'max' => 1),
            array('CREADO_POR, ACTUALIZADO_POR', 'length', 'max' => 20),
            array('OBSERVACION', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('ID, NOMBRE, OBSERVACION, MODULO, SUBMODULO, RUTA, TIPO, ACTIVO, CREADO_POR, CREADO_EL, ACTUALIZADO_POR, ACTUALIZADO_EL', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'consecutivoCis' => array(self::HAS_MANY, 'ConsecutivoCi', 'FORMATO_IMPRESION'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'ID' => 'ID',
            'NOMBRE' => 'Nombre',
            'OBSERVACION' => 'Observacion',
            'MODULO' => 'Modulo',
            'SUBMODULO' => 'Submodulo',
            'RUTA' => 'Formato',
            'TIPO' => 'Tipo',
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

        $criteria->compare('ID', $this->ID);
        $criteria->compare('NOMBRE', $this->NOMBRE, true);
        $criteria->compare('OBSERVACION', $this->OBSERVACION, true);
        $criteria->compare('MODULO', $this->MODULO, true);
        $criteria->compare('SUBMODULO', $this->SUBMODULO, true);
        $criteria->compare('RUTA', $this->RUTA, true);
        $criteria->compare('TIPO', $this->TIPO, true);
        $criteria->compare('ACTIVO', 'S');
        $criteria->compare('CREADO_POR', $this->CREADO_POR, true);
        $criteria->compare('CREADO_EL', $this->CREADO_EL, true);
        $criteria->compare('ACTUALIZADO_POR', $this->ACTUALIZADO_POR, true);
        $criteria->compare('ACTUALIZADO_EL', $this->ACTUALIZADO_EL, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                ));
    }

    public static function Modulos() {
        return array(
            'FACT' => 'Facturacion',
            'COMP' => 'Compras',
            'INVE' => 'Inventario',
            'ADSI' => 'Administracion del Sistema',
            //'REHU' => 'Recursos Humanos',
        );
    }

    public static function getModulo($modulo) {
        switch ($modulo) {
            case 'FACT' : return 'Facturacion';
                break;
            case 'COMP' : return 'Compras';
                break;
            case 'INVE' : return 'Inventario';
                break;
            case 'ADSI' : return 'Administracion del Sistema';
                break;
            case 'REHU' : return 'Recursos Humanos';
                break;
        }
    }

    public static function SubModulos($modulo) {
        switch ($modulo) {
            case 'FACT' :
                return
                        array(
                            //'COFA' => 'Configuracion Facturacion',
                            '',
                );
                break;
            case 'COMP' :
                return
                        array(
                            //'COCO'=>'Configuracion de Compras',
                            'PROV' => 'Proveedor',
                            'SOCO' => 'Solicitud de Compra',
                            'ORCO' => 'Ordenes de Compra',
                            'INCO' => 'Ingreso de Compra'
                );
                break;
            case 'INVE' :
                return
                        array(
                            //'CONF'=>'Configuracion',
                            'ARTI' => 'Articulos',
                            'CLAS' => 'Clasificaciones',
                            'VACL' => 'Valores para Clasificaciones',
                            'TIAR' => 'Tipo de Articulo',
                            'UNME' => 'Unidades de Medida',
                            'MEVA' => 'Metodo de Valuacion',
                            'TITR' => 'Tipo de Transaccion',
                            'CONS' => 'Consecutivos',
                            //'DOIN' => 'Documentos de Inventario',
                );
                break;
            case 'ADSI' :
                return
                        array(
                            //'DAEM' => 'Datos Empresa',
                            //'COGE' => 'Configuracion General',
                            'PAIS' => 'Pais',
                            'DEPA' => 'Departamento',
                            'MUNI' => 'Municipio',
                            'ZONA' => 'Zona',
                            'BODE' => 'Bodega',
                            'CATE' => 'Categorias',
                            'CECO' => 'Cento de Costos',
                            'COPA' => 'Condicion de Pagos',
                            'DEPE' => 'Dependencias',
                            'TIDO' => 'Tipo de Documento',
                            'RENI' => 'Relacion de Nits',
                            'ENFI' => 'Entidad Finaciera',
                            'NIPR' => 'Nivel de Precio',
                            'TITA' => 'Tipo de Tarjeta',
                            'DIFE' => 'Dia Feriado',
                            'IMPU' => 'Impuesto',
                            'RETE' => 'Retencion',
                            //'ADRE' => 'Administracion de Reportes',   
                );
                break;
            case 'REHU' :
                return
                        array(
                            'CARG' => 'Cargo',
                            'ESEM' => 'Estado de Empleados',
                            'HORA' => 'Hoarios',
                            'TACA' => 'Tipo de Academico',
                            'TACC' => 'Tipo de Accidente',
                            'TAUS' => 'Tipo de Ausencia',
                            'TICO' => 'Tipo Contrato',
                );
                break;
        }
    }
    
    
        public static function Prueba() {

        return array(
            array('FACT' => array(
                    'name' => 'Facturacion',
                    'submodulos' => array(),
                ),
                'COMP' => array(
                    'name' => 'Compras',
                    'submodulos' => array(
                        'PROV' => array(
                            'name' => 'Proveedor',
                            'formatosImpresion' => array()),
                        'SOCO' => array(
                            'name' => 'Solicitud de Compra',
                            'formatosImpresion' => array(
                                'DOIN' => array(
                                    'DocInv' => 'Plantilla 1',
                                ),
                            ),
                        ),
                        'ORCO' => array(
                            'name' => 'Ordenes de Compra',
                            'formatosImpresion' => array(
                            )
                        ),
                        'INCO' => array(
                            'name' => 'Ingreso de Compra',
                            'formatosImpresion' => array()),
                    ),
                ),
                'INVE' => 'Inventario',
                'ADSI' => 'Administracion del Sistema',
            //'REHU' => 'Recursos Humanos',
            ),
        );
    }

    public static function Formato($submodulo) {
        switch ($submodulo) {
            //Documentos Inventario
            case 'DOIN' :
                return
                        array(
                            'DocInv' => 'Plantilla 1',
                );
                break;
            case 'CONS' :
                return
                        array(
                            'DocInv' => 'Plantilla 1',
                            'DocInv2' => 'Plantilla 2',
                );
                break;
            
            
            //Solicitud de Compra
            case 'SOCO' :
                return
                        array(
                            'SolicitudCompra' => 'Plantilla 1',
                );
                break;
            //Orden de Compra
            case 'ORCO' :
                return
                        array(
                            'OrdenCompra' => 'Plantilla 1',
                );
                break;
            case 'INCO' :
                return
                        array(
                            'IngresoCompra' => 'Plantilla 1',
                );
                break;
        }
    }

    public static function getFormato($submodulo) {
        switch ($submodulo) {
            case 'DOIN' : return 'Plantilla 1';
                break;
            case 'CONS' : return 'Plantilla 1';
                break;
            case 'SOCO' : return 'Plantilla 1';
                break;
            case 'ORCO' : return 'Plantilla 1';
                break;
        }
    }

}