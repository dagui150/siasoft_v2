<?php
        class UiManager extends CApplicationComponent {
                public function init(){
                        parent::init();
                }
                public function getCurrentUserNames(){
                        return Yii::app()->user->email;
                }

                public function getMenuCurrentUser(){
                        if(!Yii::app()->user->isGuest){
                                return array(
                                        'label'=>$this->currentUserNames,
                                        'class'=>'bootstrap.widgets.BootMenu',
                                        'items'=>array(
                                                array('label'=>'Editar mi Perfil','icon'=>'user'
                                                        , 'url'=>Yii::app()->user->ui->editProfileUrl),
                                                array('label'=>'Cerrar Sesion','icon'=>'off'
                                                        , 'url'=>Yii::app()->user->ui->logoutUrl),
                                        ),
                                );
                        }else{
                                return array('label'=>'Iniciar Sesion','url'=>Yii::app()->user->ui->loginUrl);
                        }
                }

                public function getMenuAdministradorUsuarios(){

                        if(!Yii::app()->user->isSuperAdmin)
                                return array();

                        return array(
                                array('label'=>'Usuarios', 'url'=>'#', 'items'=>Yii::app()->user->ui->adminItems),
                        );
                }

                public function getMenuSistema(){
                        if(!Yii::app()->user->checkAccess('operaciones'))
                                return array();
                        return array(
                                array('label'=>'Operaciones', 'url'=>'#',
                                        'items'=>
                                                array(
                                                        array('label'=>'PREMIACION'),
                                                        array('label'=>'Premiacion de Sorteos'
                                                                , 'url'=>array('/premiacion/index')),
                                                        array('label'=>'OPERACIONES DE CUENTA'),
                                                        array('label'=>'Crear Cargo a Cuenta'
                                                                , 'url'=>'#'),//Yii::app()->cyaui->getCrearCargoUrl('cuenta')),
                                                        array('label'=>'Crear Abono a Cuenta'
                                                                , 'url'=>'#'),//Yii::app()->cyaui->getCrearAbonoUrl('cuenta')),
                                                        array('label'=>'Consultar Cuenta'
                                                                , 'url'=>'#'),//Yii::app()->cyaui->getConsultarUrl('cuenta')),
                                                ),
                                ),
                        );
                }
        }
?>