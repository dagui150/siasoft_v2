<?php
/**
 * BootButtonColumn class file.
 * @author Christoffer Niska <ChristofferNiska@gmail.com>
 * @copyright  Copyright &copy; Christoffer Niska 2011-
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 * @package bootstrap.widgets
 * @since 0.9.8
 */

Yii::import('zii.widgets.grid.CButtonColumn');

/**
 * Bootstrap button column widget.
 * Used to set buttons to use Glyphicons instead of the defaults images.
 */
class BootButtonPapelera extends CButtonColumn
{
    
	public $papeleraButtonIcon = 'repeat';
        public $papeleraButtonUrl='Yii::app()->createUrl($_GET["modelo"]."/restaurar",array("id"=>$data->primaryKey))';
        
        
        

        //public $papeleraButtonUrl= '';
	/**
	 * Initializes the default buttons (view, update and delete).
	 */
	protected function initDefaultButtons()
	{
		parent::initDefaultButtons();

        
        //$this->papeleraButtonUrl=Yii::app()->controller->createUrl("restaurar",array("id"=>$data->primaryKey));
        //echo $_GET['modelo'];
        //echo '<pre>';
        //print_r(Yii::app()->controller->module->id);
        //echo '</pre>';
        //Yii::app()->end();
        
                
        if ($this->papeleraButtonIcon !== false && !isset($this->buttons['Restaurar']['icon']))
            $this->buttons['Restaurar']['icon'] = $this->papeleraButtonIcon;
        
        $this->buttons['Restaurar']['imageUrl'] = Yii::app()->baseUrl.'/images/pdf.png';
        
    
        
        //if (isset($this->buttons['Restaurar']['url']))
            $this->buttons['Restaurar']['url'] = $this->papeleraButtonUrl;
            
	}
        
        

	/**
	 * Renders a link button.
	 * @param string $id the ID of the button
	 * @param array $button the button configuration which may contain 'label', 'url', 'imageUrl' and 'options' elements.
	 * @param integer $row the row number (zero-based)
	 * @param mixed $data the data object associated with the row
	 */
	protected function renderButton($id, $button, $row, $data)
	{
		if (isset($button['visible']) && !$this->evaluateExpression($button['visible'], array('row'=>$row, 'data'=>$data)))
			return;

		$label = isset($button['label']) ? $button['label'] : $id;
		$url = isset($button['url']) ? $this->evaluateExpression($button['url'], array('data'=>$data, 'row'=>$row)) : '#';
                
		$options = isset($button['options']) ? $button['options'] : array();
                $options['class']='btn-papelera';
                $options['id']=$data->primaryKey;
		if (!isset($options['title']))
			$options['title'] = $label;

		if (!isset($options['rel']))
			$options['rel'] = 'tooltip';
                
                $options['modelo']=$_GET["modelo"];
                $options['submodulo']=$_GET["id"];
                

                
		if (isset($button['icon']))
		{
			if (strpos($button['icon'], 'icon') === false)
                        $button['icon'] = 'icon-'.implode(' icon-', explode(' ', $button['icon']));
                        $ajaxOptions = array('update'=>'#papelera','type'=>'GET','data' =>array('id'=>$row));
                        //echo '<pre>';
                       // print_r($ajaxOptions);
                       // echo '</pre>';
                        //Yii::app()->end();
			//echo CHtml::ajaxLink('<i class="'.$button['icon'].'"></i>',array('restaurar'),$ajaxOptions, $options);
                        echo CHtml::link('<i class="'.$button['icon'].'"></i>','#', $options);
		}
		//else if (isset($button['imageUrl']) && is_string($button['imageUrl']))
                    
			//echo CHtml::link(CHtml::image($button['imageUrl'], $label), $url, $options);
		//else
			//echo CHtml::link($label, $url, $options);
	}
}