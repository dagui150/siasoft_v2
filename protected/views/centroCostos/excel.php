<?php $this->widget('tlbExcelView', array(
    'id'                   => 'some-grid',
    'dataProvider'         => $model->search(),
    'grid_mode'            => 'export', // Same usage as EExcelView v0.33
    'title'                => 'CentroCostos ' . date('d-m-Y'),
    'creator'              => '',
    'subject'              => '',
    'description'          => '',
    'lastModifiedBy'       => '',
    'sheetTitle'           => 'Reporte ' . date('m-d-Y'),
    'keywords'             => '',
    'category'             => '',
    'landscapeDisplay'     => true, // Default: false
    'A4'                   => true, // Default: false - ie : Letter (PHPExcel default)
    'pageFooterText'       => '&RThis is page no. &P of &N pages', // Default: '&RPage &P of &N'
    'automaticSum'         => true, // Default: false
    'decimalSeparator'     => ',', // Default: '.'
    'thousandsSeparator'   => '.', // Default: ','
    //'displayZeros'       => false,
    //'zeroPlaceholder'    => '-',
    'sumLabel'             => 'Column totals:', // Default: 'Totals'
    'borderColor'          => '000000', // Default: '000000'
    'bgColor'              => 'FFFFFF', // Default: 'FFFFFF'
    'textColor'            => '000000', // Default: '000000'
    'rowHeight'            => 15, // Default: 15
    'headerBorderColor'    => '000000', // Default: '000000'
    'headerBgColor'        => 'CCCCCC', // Default: 'CCCCCC'
    'headerTextColor'      => '000000', // Default: '000000'
    'headerHeight'         => 20, // Default: 20
    'footerBorderColor'    => '0000FF', // Default: '000000'
    'footerBgColor'        => '00FFCC', // Default: 'FFFFCC'
    'footerTextColor'      => 'FF00FF', // Default: '0000FF'
    'footerHeight'         => 15, // Default: 20
    'columns'=>array(		'ID',
		'DESCRIPCION',
		array(
                        'name'=>'TIPO',
                        'header'=>'Tipo',
                        'value'=>'CentroCostos::tipo($data->TIPO)',
                        'filter'=>array('G'=>'Gasto','I'=>'Ingreso','A'=>'Ambos'),
                    ),
		
	),
)); ?>


