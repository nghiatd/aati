<?php
class Admin_Bootstrap extends Zend_Application_Module_Bootstrap
{
	public function _initAutoload(){

        $front = Zend_Controller_Front::getInstance();

        $front->registerPlugin(new Zend_Controller_Plugin_ErrorHandler(
        	array(
                'module'     => 'admin',
                'controller' => 'error',
				'action'     => 'index'
        )));

    }

}