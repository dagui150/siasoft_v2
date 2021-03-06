<?php
	return array(
            // MODULO - ADMINISTRACION DEL SISTEMA
		'IMPUESTO_CONSUMO' => 'Impuesto que será utilizado en el sistema.<br>Ej.: IVA.',
		'MASCARA_CCOSTO' => 'Es el "Formato" que nos restringe ciertos caracteres en el código de centro de costos.',
		'SIMB_MONEDA' => 'El símbolo de la moneda a utilizar en el sistema. <br>Ej.: $ (Pesos, dólares), € (Euro).',
		'NOM_ZONA' => 'Es una división que hace la empresa para clasificar clientes o proveedores. <br>Ej.: Zona caribe, zona cafetera.<br>Este submenú es solo de carácter informativo.',
                'CODIGO' => 'Cadena de caracteres alfanumérico.',
                'CODIGO_BODEGA' => 'Cadena de caracteres alfanumérico. Maximo 4 caracteres.',
		'DESCR_BODEGA' => 'Breve descripción de la bodega.',
		'DESCR_CATEGORIA' => 'Breve descripción de la categoría o un nombre.',
		'CODIGO_CC' => 'Este código depende de la máscara configurada en el submenú "Configuración general".',
		'DESCR_CC' => 'Breve descripción del centro del centro de costo.',
		'TIPO_CC' => 'Seleccione el tipo correspondiente al centro de costo.',
		'DESCR_CP' => 'Breve descripción de la condición de pago.',
		'DIAS_CP' => 'Días hábiles.',
		'DESCR_DEP' => 'Breve descripción del departamento. Ej.: Sistemas, Finanzas.',
		'CODIGO_DOC' => 'Identificador del tipo de documento. Ej.: C.C.',
		'DESCR_DOC' => 'Breve descripción del tipo de documento. Ej.: Cedula de ciudadanía.',
		'MASCARA_DOC' => 'Es el "Formato" que nos define la cantidad de dígitos y caracteres para el tipo de documento creado.',
		'NIT_ENT_FINAN' => 'En este campo, se debe escribir/seleccionar un NIT previamente relaciona/creado en el submenú "Relación de Nits".',
		'DESCR_ENT_FINAN' => 'Breve descripción de la entidad financiera.',
		'DESCR_NIV_PRECI' => 'Breve descripción del nivel de precio.',
		'ESQ_NIV_PRECI' => 'Procedimiento que se utilizará para calcular los precios de los artículos.',
		'DESCR_TIP_TARJE' => 'Breve descripción del tipo de Tarjeta.',
            
            //MODULO - INVENTARIO
		'NOM_UNID_MED' => 'Nombre en singular Ej.: Libra.',
		'ABRE_UNID_MED' => 'Ej.: LB.',
		'TIPO_UNID_MED' => 'Ej.: Peso.',
		'UBASE_UNID_MED' => 'Unidad, Metro, Metro Cubico, Kilogramo o Servicio ',
		'EQUI_UNID_MED' => 'Ej.: 2 LB son 1 KG',
		'CLAS_ADI_VAL_CLAS' => 'Este campo depende del submenú "Clasificaciones". Ej.: Talla.',
		'CLAS_ADI_VAL_VAL' => 'En este campo se asigna un valor según la clasificación seleccionada. Ej.: S.',
		'CLAS_NOM' => 'De este campo depende el submenú "Valores para Clasificaciones".',
		'TRANS_CONF' => 'Seleccione la transacción base para configurar el tipo de transacción.',
                'MASCARA_INV_CONSEC' => 'En este campo debe ir la “mascara” de los “códigos” que tendrán los documentos, teniendo en cuenta que deben cumplir con la máscara definida para este campo “aaa - 9999?9999999999”. Ej.: DEV-9999.',
		
            //MODULO - COMPRAS
                'CONSECUTIVOS' => 'En esta sección se pueden definir las mascaras unicamente 1 vez, ya que despues de definirla, el campo quedara inactivo.',
		'RUBR_SOLICI' => 'En esta pestaña se definen los nombres de los rubros adicionales que pueden ser ingresados en las solicitudes de compra. Se cuenta con cinco rubros adicionales que son editados en la opción Solicitudes de Compra.',
		'RUBR_ORDENE' => 'En esta pestaña se definen los nombres de los rubros adicionales que pueden ser ingresados en las órdenes de compra. Se cuenta con cinco rubros adicionales que son editados en la opción Órdenes de Compra.',
		'RUBR_INGRES' => 'En esta pestaña se definen los nombres de los rubros adicionales que pueden ser ingresados en los embarques de compra. Se cuenta con cinco rubros adicionales que son editados en la opción Embarques de Compra.',
		'ORDENES_COMP' => 'Número máximo de líneas por orden de compra que se pueden imprimir',
		//'FACT_REDONDEO' => 'En este campo deben ir los siguientes valores (sin comillas): "0" = Nada,                                  "1" = Aproxima a 100,              "2" = Aproxima a 1000.',
		'FACT_REDONDEO' => 'En este campo deben ir los siguientes valores (sin comillas): "0" = Nada, "1" = Aproxima a 100, y "2" = Aproxima a 1000.',
		'' => '',
	)
?>