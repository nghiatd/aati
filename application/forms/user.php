<?php
class Form_User extends Zend_Form{
	public function init(){
		$this->setAction('')->setMethod('POST');
		$name=$this->createElement("text","name",array(
	                        "label" => "Full Name",
				                                "size" => "30",
				    ));
	}
}