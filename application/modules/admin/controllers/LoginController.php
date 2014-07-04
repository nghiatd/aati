<?php
class Admin_LoginController extends Zendvn_Controller_Action{
		
	public function init(){
		parent::init();
		$template_path = TEMPLATE_PATH . "/admin/system";
		$this->loadTemplate($template_path,'template.ini','login');
		$layout = Zend_Layout::getMvcInstance();
		$view = $layout->getView();  
			
	}
	public function preDispatch() {
	    
	}
	public function indexAction(){
		$layout = Zend_Layout::getMvcInstance();
		$view = $layout->getView();  
		$view->headLink()->appendStylesheet($view->baseUrl().'/templates/admin/system/css/zice.style.css');
		$view->headLink()->appendStylesheet($view->baseUrl().'/templates/admin/system/css/icon.css');
		$view->headLink()->appendStylesheet($view->baseUrl().'/templates/admin/system/tipsy/tipsy.css');

		$view->headScript()->appendFile($view->baseUrl().'/templates/admin/system/js/jquery-1.7.2.min.js');
		$view->headScript()->appendFile($view->baseUrl().'/templates/admin/system/js/effect/jquery-jrumble.js');
		$view->headScript()->appendFile($view->baseUrl().'/templates/admin/system/jui/js/jquery-ui-1.8.20.min.js');
		$view->headScript()->appendFile($view->baseUrl().'/templates/admin/system/tipsy/jquery.tipsy.js');
		$view->headScript()->appendFile($view->baseUrl().'/templates/admin/system/js/checkboxes/iphone.check.js');
		
		$view->headScript()->appendFile($view->baseUrl().'/templates/admin/system/js/login.js');

		if ($this->_request->isPost()) {

	        //1.Goi ket noi voi Zend Db
	        $db = Zend_Registry::get('connectDB');
	        //$db = Zend_Db::factory($dbOption['adapter'],$dbOption['params']);
	        //2. Khoi tao Zend Autho
	        $auth = Zend_Auth::getInstance ();

	        //3. Khai bao bang va 2 cot se su dung so sanh trong qua tronh login
	        $authAdapter = new Zend_Auth_Adapter_DbTable($db);
	        $authAdapter->setTableName('admin')
	                ->setIdentityColumn('username')
	                ->setCredentialColumn('password');

	        //4. Lay gia tri duoc gui qua tu FORM
	        $uname = $this->_request->getParam('username');
	        $paswd = $this->_request->getParam('password');

	        //5. Dua vao so sanh voi du lieu khai bao o muc 3
	        $authAdapter->setIdentity($uname);
	        $authAdapter->setCredential($paswd);

	        //6. Kiem tra trang thai cua user neu status = 1 moi duoc login
	        $select = $authAdapter->getDbSelect();
	        $select->where('status = 1');

	        //7. Lay ket qua truy van
	        $result = $auth->authenticate($authAdapter);
	        $flag = false;
	        if ($result->isValid()) {
	            //8. Lay nhung du lieu can thiet trong bang users neu login thanh cong				
	            $data = $authAdapter->getResultRowObject(null, array('password'));

	            //9. Luu  nhung du lieu cua member vao session
	            $auth->getStorage()->write($data);
	            $flag = true;
	        }
	        if ($flag == true) {
	            $this->_redirect('admin/index');
	        }
	    }		
	}
}
