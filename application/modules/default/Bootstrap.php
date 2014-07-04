<?php
class Default_Bootstrap extends Zend_Application_Module_Bootstrap
{
	protected function _initRouterTests(){


		//Trang index co dang ten domain/index.aati
		$indexRoute = "index";
		$indexDefaults= array(
				'module'	=>'default',
				'controller'=>'index',
				'action'	=>'index'
			);
		$indexRoute = new Zend_Controller_Router_Route_Static($indexRoute,$indexDefaults);

		$front = Zend_Controller_Front::getInstance();
		$frontRouter = $front->getRouter();
		$frontRouter->addRoute('index',$indexRoute);
		/*
		//Trang Last Event co dang ten domain/event/10/tenevent.aati
		$eventRoute = "event/(\d{1,10})+/?(.*).aati";
		$eventDefaults= array(
				'module'	=>'default',
				'controller'=>'index',
				'action'	=>'eventnews'
			);
		$eventMap  = array(1 => 'id',2=>'name');
		$eventRoute = new Zend_Controller_Router_Route_Regex($eventRoute,$eventDefaults,$eventMap);
		$frontRouter->addRoute('eventnews',$eventRoute);

		//Trang Last Event co dang ten domain/news/10/ten news.aati
		$normalnewsRoute = "news/(\d{1,10})+/?(.*).aati";
		$normalnewsDefaults= array(
				'module'	=>'default',
				'controller'=>'index',
				'action'	=>'normalnews'
			);
		$normalnewsMap  = array(1 => 'id',2=>'name');
		$normalnewsRoute = new Zend_Controller_Router_Route_Regex($normalnewsRoute,$normalnewsDefaults,$normalnewsMap);
		$frontRouter->addRoute('normalnews',$normalnewsRoute);*/

		//News
		$indexRoute = "news";
		$indexDefaults= array(
				'module'	=>'default',
				'controller'=>'index',
				'action'	=>'news'
			);
		$indexRoute = new Zend_Controller_Router_Route_Static($indexRoute,$indexDefaults);

		$frontRouter = $front->getRouter();
		$frontRouter->addRoute('news',$indexRoute);
		//About
		$indexRoute = "about";
		$indexDefaults= array(
				'module'	=>'default',
				'controller'=>'index',
				'action'	=>'about'
			);
		$indexRoute = new Zend_Controller_Router_Route_Static($indexRoute,$indexDefaults);

		$frontRouter = $front->getRouter();
		$frontRouter->addRoute('about',$indexRoute);

		//Community
		$indexRoute = "community";
		$indexDefaults= array(
				'module'	=>'default',
				'controller'=>'index',
				'action'	=>'community'
			);
		$indexRoute = new Zend_Controller_Router_Route_Static($indexRoute,$indexDefaults);

		$frontRouter = $front->getRouter();
		$frontRouter->addRoute('community',$indexRoute);

		//membership
		$indexRoute = "membership";
		$indexDefaults= array(
				'module'	=>'default',
				'controller'=>'index',
				'action'	=>'membership'
			);
		$indexRoute = new Zend_Controller_Router_Route_Static($indexRoute,$indexDefaults);

		$frontRouter = $front->getRouter();
		$frontRouter->addRoute('membership',$indexRoute);

		//conferences
		$indexRoute = "conferences";
		$indexDefaults= array(
				'module'	=>'default',
				'controller'=>'index',
				'action'	=>'conferences'
			);
		$indexRoute = new Zend_Controller_Router_Route_Static($indexRoute,$indexDefaults);

		$frontRouter = $front->getRouter();
		$frontRouter->addRoute('conferences',$indexRoute);

		//publications
		$indexRoute = "publications";
		$indexDefaults= array(
				'module'	=>'default',
				'controller'=>'index',
				'action'	=>'publications'
			);
		$indexRoute = new Zend_Controller_Router_Route_Static($indexRoute,$indexDefaults);

		$frontRouter = $front->getRouter();
		$frontRouter->addRoute('publications',$indexRoute);

		//link
		$indexRoute = "links";
		$indexDefaults= array(
				'module'	=>'default',
				'controller'=>'index',
				'action'	=>'links'
			);
		$indexRoute = new Zend_Controller_Router_Route_Static($indexRoute,$indexDefaults);

		$frontRouter = $front->getRouter();
		$frontRouter->addRoute('links',$indexRoute);
	}
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
