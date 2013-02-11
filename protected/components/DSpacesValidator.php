<?php
/**
 * DSpacesValidator class file.
 * @author Daniel Sanchez
 */
class DSpacesValidator extends CValidator
{
	/**
         *
         * @var boolean spaces
         */
	public $spaces = true;
        
        /**
         *
         * @var String $spacesPattern
         */
        public $spacesPattern = '/\W/';
        
        public $message = '{attribute} no puede contener espacios.';
	
	/**
         * 
         * @param type $object
         * @param type $attribute
         */
	protected function validateAttribute($object,$attribute)
	{
		$value=$object->$attribute;
                
		if($this->spaces)
		{
			if(preg_match($this->spacesPattern,"$value"))
			{
				$message=$this->message;
				$this->addError($object,$attribute,$message);
			}
		}
	}

        /**
         * 
         * @param type $object
         * @param type $attribute
         * @return String que contine la validacion del lado del cliente.
         */
	public function clientValidateAttribute($object,$attribute)
	{
		$message= $this->message;
		if($this->spaces)
		{
			$message=strtr($message, array(
				'{value}'=>$this->spaces,
				'{attribute}'=>$object->getAttributeLabel($attribute),
			));
			return "
if(value!=" . CJSON::encode($this->spaces) . ") {
	messages.push(".CJSON::encode($message).");
}
";
		}
		else
		{
			$message=strtr($message, array(
				'{attribute}'=>$object->getAttributeLabel($attribute),
			));
			return "
if(jQuery.trim(value)=='') {
	messages.push(".CJSON::encode($message).");
}
";
		}
	}
}