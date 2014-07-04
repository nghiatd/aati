<?php
class Admin_ErrorController extends Zendvn_Controller_Action{
		
	public function init(){
		parent::init();
		$template_path = TEMPLATE_PATH . "/admin/system";
		$this->loadTemplate($template_path,'template.ini','error');
		$layout = Zend_Layout::getMvcInstance();
		$view = $layout->getView();  
		$view->headLink()->appendStylesheet($view->baseUrl().'/templates/admin/system/css/reset.css');
		$view->headLink()->appendStylesheet($view->baseUrl().'/templates/admin/system/css/fluid');
		$view->headLink()->appendStylesheet($view->baseUrl().'/templates/admin/system/css/dandelion.theme.css');
		$view->headLink()->appendStylesheet($view->baseUrl().'/templates/admin/system/css/dandelion.css');
		$view->headLink()->appendStylesheet($view->baseUrl().'/templates/admin/system/css/demo.css');
		
		$view->headScript()->appendFile($view->baseUrl().'/templates/admin/system/js/core/dandelion.core.js');		
	}
	
	public function indexAction(){
		$layout = Zend_Layout::getMvcInstance();
		$view = $layout->getView();  
		$view->headLink()->appendStylesheet($view->baseUrl().'/templates/admin/system/css/reset.css');
		$view->headLink()->appendStylesheet($view->baseUrl().'/templates/admin/system/css/fluid');
		$view->headLink()->appendStylesheet($view->baseUrl().'/templates/admin/system/css/dandelion.theme.css');
		$view->headLink()->appendStylesheet($view->baseUrl().'/templates/admin/system/css/dandelion.css');
		$view->headLink()->appendStylesheet($view->baseUrl().'/templates/admin/system/css/demo.css');
		
		$view->headScript()->appendFile($view->baseUrl().'/templates/admin/system/js/core/dandelion.core.js');
		
	}
}
