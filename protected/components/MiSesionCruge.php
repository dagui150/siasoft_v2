<?php
/**
	Esta clase sirve para personalizar las acciones de inicio y cierre
	de sesión.

	requiere que la registres en config/main dentro de cruge setup:

		'defaultSessionFilter'=>'application.components.MiSesionCruge',

	@author Christian Salazar (christiansalazarh@gmail.com)
*/
class MiSesionCruge extends DefaultSessionFilter  {


	/**
         * Metodo para indicar a donde va el ususario despues de loguearse
         * @param ICrugeSession $model
         */
	public function onLogin(/*ICrugeSession*/ $model){
		parent::onLogin($model);
                
		if(Yii::app()->user->isSuperAdmin)
			Yii::app()->getController()->redirect(array("/cruge/ui/usermanagementadmin"));
		elseif(UnidadMedida::validarUnidad())
			Yii::app()->getController()->redirect(Yii::app()->user->returnUrl);
                 else
                        Yii::app()->getController()->redirect(array("/unidadMedida/admin"));
	}

	/**
         * Metodo para indicar adonde va el ususario cuando cuando hace logout
         * @param ICrugeSession $model
         */
	public function onLogout(/*ICrugeSession*/ $model) {
		parent::onLogout($model);
                Yii::app()->getController()->redirect(array("/site/login"));
	}

}

?>