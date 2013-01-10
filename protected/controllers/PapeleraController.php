<?php

class PapeleraController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $breadcrumbs = array();
    public $menu = array();
    public $layout = '//layouts/column2';

    public function filters(){
            return array(array('CrugeAccessControlFilter'), );
    }
    
    public function actionCargaGrilla(){
        $count = 0;
        $col=array();
        $submodulo = SubModulo::model()->findByPk($_GET['id']);
        $_GET['modelo']=$submodulo->MODELO;
        $model = new $submodulo->MODELO;
        
        foreach ($model->tableSchema->columns as $column) {
            if($count>1){
                break;
                
            }else{
                ++$count;
                $col[$count]=$column->name;
                
                }
        }
        
        $this->widget('bootstrap.widgets.BootGridView', array(
            'type' => 'striped bordered condensed',
            'id' => $_GET['id'].'-grid',
            'dataProvider' => $model->searchPapelera(),
            'template'=>'{items} {pager}',
            'columns' => array(
                isset($col[1]) ? $col[1] :array('name'=>'CREADO_POR','visible'=>false),
                isset($col[2]) ? $col[2] : array('name'=>'CREADO_POR','visible'=>false),
                isset($col[3]) ? $col[3] : array('name'=>'ACTUALIZADO_POR','visible'=>TRUE),
                isset($col[4]) ? $col[4] : array('name'=>'ACTUALIZADO_EL','visible'=>TRUE),

                array(
                    'class' => 'bootstrap.widgets.TbButtonPapelera',
                    'template'=>'{Restaurar}',
                ),
            ),
        ));
    }
    
    public function actionIndex() {
        $data = $this->getDataFormatted($this->getData());
        $ruta = Yii::app()->request->baseUrl.'/images/cargando.gif';
        
        $treedata = array();
        foreach ($data as $child) {
            $hijo_tmp = array();
            if($child['hasChildren'] == true && $child['children'] != NULL){
                foreach($child['children'] as $hijo){
                    $ajaxOptions = array('update'=>'#papelera','beforeSend'=>'cargando','type'=>'GET','data' =>array('id'=>$hijo['id']));
                    $htmlOptions = array('id' => $hijo['id'], 'class' =>'treenode arbol');
                    $nodeText = CHtml::ajaxLink($hijo['text'],array('cargaGrilla'),$ajaxOptions,$htmlOptions);
                    $hijo['text'] = $nodeText;
                    $hijo_tmp[] = $hijo;
                }
                $child['children'] = $hijo_tmp;
            }
            $treedata[] = $child;
        }
        /*echo '<pre>';
        print_r($treedata);
        echo '</pre>';
        Yii::app()->end();*/
        $this->render('index', array('data' => $treedata,'ruta'=>$ruta));
    }
    
    
  
    

    protected function formatData($person) {
        return array(
            'text' => $person['name'],
            'id' => $person['id'],
            'hasChildren' => isset($person['parents']));
    }

    protected function getDataFormatted($data) {
        $personFormatted='';
        foreach ($data as $k => $person) {
            $personFormatted[$k] = $this->formatData($person);
            $parents = null;
            if (isset($person['parents'])) {
                $parents = $this->getDataFormatted($person['parents']);
                $personFormatted[$k]['children'] = $parents;
            }
        }
        return $personFormatted;
    }

    protected function getData() {
        $data=array();
        $parents=array();
        $modulos=Modulo::model()->findAll('ACTIVO="S"');
        $submodulos=SubModulo::model()->findAll('PAPELERA="S" AND ACTIVO="S"');
        
        foreach($modulos as $modulo){
            foreach($submodulos as $submodulo){
               if($submodulo->MODULO == $modulo->ID)
                   $parents[]=array(
                        'id'=>$submodulo->ID,
                        'name'=> $submodulo->NOMBRE,
                    );
            }
            $data[]=array(
                'id'=>$modulo->ID,
                'name'=> $modulo->NOMBRE,
                'parents' =>$parents 
            );
            $parents=array();
        }
        
        return $data;
    }
	


}