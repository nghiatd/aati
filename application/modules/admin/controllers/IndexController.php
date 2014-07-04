<?php
class Admin_IndexController extends Zendvn_Controller_Action {
	
	public function init() {
		
		parent::init ();
		$template_path = TEMPLATE_PATH . "/admin/system";
		$this->loadTemplate ( $template_path, 'template.ini', 'default' );
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		
		// Add icon
		// $view->headLink()->headLink(array('rel' =>
		// 'icon','type'=>'image/x-icon','href' =>
		// 'http://'.URL_CONFIG.'/public/favicon.ico'),'PREPEND');
		// $view->headLink()->headLink(array('rel' => 'shortcut
		// icon','type'=>'image/x-icon','href' =>
		// 'http://'.URL_CONFIG.'/public/favicon.ico'),'PREPEND');
		$view->headLink ()->headLink ( array (
				'rel' => 'icon',
				'type' => 'image/ico',
				'href' => 'http://' . URL_CONFIG . '/public/favicon.ico' 
		), 'PREPEND' );
		
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/jui/css/jquery.ui.all.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/plugins/tipsy/tipsy.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/plugins/fullcalendar/fullcalendar.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/plugins/fullcalendar/fullcalendar.print.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/css/style.css' );
		// $view->headLink()->appendStylesheet($view->baseUrl().'/templates/admin/system/css/google-code-prettify/prettify.css');
		
		// $view->headLink()->appendStylesheet($view->baseUrl().'/templates/admin/system/css/bootstrap-responsive.css');
		
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/jui/js/jquery-ui-1.8.20.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/jui/js/jquery.ui.timepicker.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/jui/js/jquery.ui.touch-punch.min.js' );
		
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/jquery.fileinput.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/jquery.placeholder.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/jquery.mousewheel.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/jquery.tinyscrollbar.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/jquery.metadata.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/core/plugins/dandelion.circularstat.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/core/plugins/dandelion.wizard.min.js' );
		
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/plugins/tipsy/jquery.tipsy-min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/plugins/validate/jquery.validate.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/plugins/fullcalendar/fullcalendar.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/js/google.jsapi.js' );
		
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/jquery.debouncedresize.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/jquery.debouncedresize.js' );
		
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/core/dandelion.core.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/core/dandelion.customizer.js' );
		
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/jquery.tablesorter.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/scripts.js' );
		// Lay ten cua nguoi dung
		$auth = Zend_Auth::getInstance ();
		$infoUser = $auth->getIdentity ();
		// Tao session de luu tru gia tri cua menu hien tai
		$Session = new Zend_Session_Namespace ( 'menu' );
		$Session->level = "1";
		
		// Get du lieu de cau hinh chung
		$Setting = new Admin_Model_Setting ();
		$this->view->setting = $Setting->getSetting ();
		
		$auth = Zend_Auth::getInstance ();
		if ($auth->hasIdentity ()) {
			$infoAdmin = $auth->getIdentity ();
			$this->view->admininfo = $infoAdmin;
		}
	
	}
	public function testAction() {
	
	}
	public function preDispatch() {
	
	}
	public function loginAction() {
		
		$auth = Zend_Auth::getInstance ();
		if ($auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index' );
		}
		$this->_helper->layout ()->disableLayout ();
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/css/zice.style.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/css/icon.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/tipsy/tipsy.css' );
		
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/jquery-1.7.2.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/effect/jquery-jrumble.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/jui/js/jquery-ui-1.8.20.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/tipsy/jquery.tipsy.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/checkboxes/iphone.check.js' );
		
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/login.js' );
		if ($this->_request->isPost ()) {
			
			// 1.Goi ket noi voi Zend Db
			$db = Zend_Registry::get ( 'connectDB' );
			// $db = Zend_Db::factory($dbOption['adapter'],$dbOption['params']);
			// 2. Khoi tao Zend Autho
			$auth = Zend_Auth::getInstance ();
			
			// 3. Khai bao bang va 2 cot se su dung so sanh trong qua tronh
			// login
			$authAdapter = new Zend_Auth_Adapter_DbTable ( $db );
			$authAdapter->setTableName ( 'admin' )->setIdentityColumn ( 'username' )->setCredentialColumn ( 'password' );
			
			// 4. Lay gia tri duoc gui qua tu FORM
			$uname = $this->_request->getParam ( 'username' );
			$paswd = $this->_request->getParam ( 'password' );
			
			// 5. Dua vao so sanh voi du lieu khai bao o muc 3
			$authAdapter->setIdentity ( $uname );
			$authAdapter->setCredential ( md5($paswd) );
			
			// 6. Kiem tra trang thai cua user neu status = 1 moi duoc login
			$select = $authAdapter->getDbSelect ();
			$select->where ( 'status = 1' );
			
			// 7. Lay ket qua truy van
			$result = $auth->authenticate ( $authAdapter );
			
			$flag = false;
			if ($result->isValid ()) {
				// 8. Lay nhung du lieu can thiet trong bang users neu login
				// thanh cong
				$dataadmin = $authAdapter->getResultRowObject ( null, array (
						'password' 
				) );
				
				// 9. Luu nhung du lieu cua member vao session
				$auth->getStorage ()->write ( $dataadmin );
				
				$flag = true;
			}
			if ($flag == true) {
				$this->_redirect ( '/admin/index' );
			}
		}
		$layout->setLayout ( 'login' );
	}
	
	public function logoutAction() {
		$auth = Zend_Auth::getInstance ();
		if ($auth->hasIdentity ()) {
			$auth->clearIdentity ();
		}
		$this->_redirect ( 'admin/login' );
	}
	
	public function indexAction() {
		
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$newSession = new Zend_Session_Namespace('new_session');
		$newSession->nghia = 'Phuong';
		$_SESSION['new_session'] = 'phuongaa';
		print_r($_SESSION);die;
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.dashboard.js' );
		$_SESSION ['menu'] ['level'] = "1";
		// Get data to view
		// Lay tong so nguoi dung cho ra view
		$User = new Admin_Model_User ();
		$this->view->sumUser = count ( $User->getAllUser () );
		// Lay tong so Connect cho ra view
		$Connect = new Admin_Model_Connect ();
		$this->view->sumConnect = count ( $Connect->getAllConnect () );
		// Lay tong so News cho ra view
		$News = new Admin_Model_News ();
		$this->view->sumNews = count ( $News->getAllNews () );
		
		// Lay tong so Sponsors cho ra view
		$Sponsors = new Admin_Model_Sponsors ();
		$this->view->sumSponsors = count ( $Sponsors->getAllSponsors () );
		// Lay top 10 tin moi nhat
		$this->view->topNews = $News->getTopNews ( 10 );
	
	}
	public function fileAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/components/colorpicker/css/colorpicker.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/components/elfinder/css/elfinder.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/components/datatables/dataTables.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/components/validationEngine/validationEngine.jquery.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/components/jscrollpane/jscrollpane.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/components/fancybox/jquery.fancybox.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/components/tipsy/tipsy.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/components/editor/jquery.cleditor.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/components/chosen/chosen.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/components/confirm/jquery.confirm.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/components/sourcerer/sourcerer.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/components/fullcalendar/fullcalendar.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/components/Jcrop/jquery.Jcrop.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/components/css/zice.style.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/components/css/icon.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/components/css/ui-custom.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/components/css/timepicker.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/components/css/button.css' );
		$_SESSION ['menu'] ['level'] = "16";
	}
	public function sliderAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/plugins/datatables/jquery.dataTables.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.tables.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/fileupload/ajaxupload.3.5.js' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/js/fileupload/styles.css' );
		
		$Slider = new Admin_Model_Slider ();
		$this->view->data = $Slider->getAllSlider ();
		$_SESSION ['menu'] ['level'] = "10";
	}
	public function addsliderAction() {
		
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"name" => $data [0],
				"image" => $data [1],
				"url" => $data [2],
				"status" => $data [3],
				"order" => $data [4],
				"dateAdd" => $data [5] 
		);
		$Slider = new Admin_Model_Slider ();
		$Slider->insertSlider ( $arr );
	}
	public function getsliderAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		
		$Slider = new Admin_Model_Slider ();
		$data = $Slider->getSliderByID ( $id );
		$json = Zend_Json::encode ( $data );
		echo $json;
		unset ( $json );
		unset ( $data );
		unset ( $id );
	}
	public function updatesliderAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"id" => $data [0],
				"name" => $data [1],
				"image" => $data [2],
				"url" => $data [3],
				"status" => $data [4],
				"order" => $data [5],
				"dateAdd" => $data [6] 
		);
		$Slider = new Admin_Model_Slider ();
		$Slider->updateSlider ( $arr );
	}
	public function deletesliderAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		
		$Slider = new Admin_Model_Slider ();
		$Slider->deleteSlider ( $id );
	}
	
	public function settingAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/core_editor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/fileupload/ajaxupload.3.5.js' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/js/fileupload/styles.css' );
		
		$Setting = new Admin_Model_Setting ();
		$this->view->data = $Setting->getSetting ();
		$_SESSION ['menu'] ['level'] = "15";
	}
	public function updatesettingAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"company" => $data [0],
				"description" => $data [1],
				"logo" => $data [2],
				"address" => $data [3],
				"email" => $data [4],
				"telephone" => $data [5],
				"fax" => $data [6],
				"website" => $data [7] 
		);
		
		$Setting = new Admin_Model_Setting ();
		$Setting->updateSetting ( $arr );
	}
	public function menuAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/plugins/datatables/jquery.dataTables.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.tables.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.ui.js' );
		
		$Menu = new Admin_Model_Menu ();
		$this->view->data = $Menu->getAllMenu ();
		$_SESSION ['menu'] ['level'] = "12";
	}
	public function addmenuAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"name" => $data [0],
				"link" => $data [1],
				"order" => $data [2],
				"status" => $data [3] 
		);
		$Menu = new Admin_Model_Menu ();
		$Menu->insertMenu ( $arr );
	}
	public function getmenuAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		$Menu = new Admin_Model_Menu ();
		$data = $Menu->getMenuByID ( $id );
		$json = Zend_Json::encode ( $data );
		echo $json;
		unset ( $json );
		unset ( $data );
		unset ( $id );
	}
	public function updatemenuAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"id" => $data [0],
				"name" => $data [1],
				"link" => $data [2],
				"order" => $data [3],
				"status" => $data [4] 
		);
		$Menu = new Admin_Model_Menu ();
		$data = $Menu->updateMenu ( $arr );
	
	}
	public function deletemenuAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		
		$Menu = new Admin_Model_Menu ();
		$Menu->deleteMenu ( $id );
	
	}
	public function newsAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/plugins/datatables/jquery.dataTables.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.tables.js' );
		
		$News = new Admin_Model_News ();
		$this->view->data = $News->getAllNews ();
		$_SESSION ['menu'] ['level'] = "13";
	}
	public function addnewsAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/fileupload/ajaxupload.3.5.js' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/js/fileupload/styles.css' );
		$News = new Admin_Model_News ();
		$this->view->data = $News->getAllTypeNews ();
	
	}
	public function savenewsAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"title" => $data [0],
				"description" => $data [1],
				"content" => $data [2],
				"date" => $data [3],
				"image" => $data [4],
				"idType" => $data [5],
				"link" => $data [6],
				"author" => $data [7],
				"order" => $data [8],
				"status" => $data [9] 
		);
		$News = new Admin_Model_News ();
		$News->insertNews ( $arr );
	}
	public function viewnewsAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/plugins/datatables/jquery.dataTables.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.tables.js' );
		
		$id = $this->getRequest ()->getParam ( 'id' );
		$News = new Admin_Model_News ();
		$this->view->data = $News->getNewsByID ( $id );
	}
	public function editnewsAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/fileupload/ajaxupload.3.5.js' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/js/fileupload/styles.css' );
		
		$id = $this->getRequest ()->getParam ( 'id' );
		$News = new Admin_Model_News ();
		$this->view->typeNews = $News->getAllTypeNews ();
		$this->view->data = $News->getNewsByID ( $id );
	}
	public function updatenewsAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"id" => $data [0],
				"title" => $data [1],
				"description" => $data [2],
				"content" => $data [3],
				"date" => $data [4],
				"image" => $data [5],
				"idType" => $data [6],
				"link" => $data [7],
				"author" => $data [8],
				"order" => $data [9],
				"status" => $data [10] 
		);
		$News = new Admin_Model_News ();
		$News->updateNews ( $arr );
	}
	public function deletenewsAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		$News = new Admin_Model_News ();
		$News->deleteNews ( $id );
	}
	
	public function linkAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/plugins/datatables/jquery.dataTables.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.tables.js' );
		
		$Link = new Admin_Model_Link ();
		$this->view->data = $Link->getAllLink ();
		$_SESSION ['menu'] ['level'] = "11";
	}
	public function addlinkAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"name" => $data [0],
				"title" => $data [0],
				"link" => $data [1],
				"date" => $data [2],
				"order" => $data [3],
				"status" => $data [4] 
		);
		$Link = new Admin_Model_Link ();
		$Link->insertLink ( $arr );
	}
	public function getlinkAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		
		$Link = new Admin_Model_Link ();
		$data = $Link->getLinkByID ( $id );
		$json = Zend_Json::encode ( $data );
		echo $json;
		unset ( $json );
		unset ( $data );
		unset ( $id );
	}
	public function updatelinkAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"id" => $data [0],
				"name" => $data [1],
				"title" => $data [1],
				"link" => $data [2],
				"date" => $data [3],
				"order" => $data [4],
				"status" => $data [5] 
		);
		$Link = new Admin_Model_Link ();
		$Link->updateLink ( $arr );
	}
	public function deletelinkAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		$Link = new Admin_Model_Link ();
		$Link->deleteLink ( $id );
	}
	
	public function sponsorsAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/plugins/datatables/jquery.dataTables.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.tables.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/fileupload/ajaxupload.3.5.js' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/js/fileupload/styles.css' );
		
		$Sponsors = new Admin_Model_Sponsors ();
		$this->view->data = $Sponsors->getAllSponsors ();
		$_SESSION ['menu'] ['level'] = "14";
	}
	public function addsponsorsAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"name" => $data [0],
				"image" => $data [1],
				"link" => $data [2],
				"date" => $data [3],
				"order" => $data [4],
				"status" => $data [5] 
		);
		$Sponsors = new Admin_Model_Sponsors ();
		$Sponsors->insertSponsors ( $arr );
	}
	public function getsponsorsAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		$Sponsors = new Admin_Model_Sponsors ();
		$data = $Sponsors->getSponsorsByID ( $id );
		$json = Zend_Json::encode ( $data );
		echo $json;
		unset ( $json );
	}
	public function updatesponsorsAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"id" => $data [0],
				"name" => $data [1],
				"image" => $data [2],
				"link" => $data [3],
				"date" => $data [4],
				"order" => $data [5],
				"status" => $data [6] 
		);
		$Sponsors = new Admin_Model_Sponsors ();
		$Sponsors->updateSponsors ( $arr );
	}
	public function deletesponsorsAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		$Sponsors = new Admin_Model_Sponsors ();
		$Sponsors->deleteSponsors ( $id );
	}
	
	public function connectAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/plugins/datatables/jquery.dataTables.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.tables.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/fileupload/ajaxupload.3.5.js' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/js/fileupload/styles.css' );
		
		$Connect = new Admin_Model_Connect ();
		$this->view->data = $Connect->getAllConnect ();
		$_SESSION ['menu'] ['level'] = "9";
	}
	public function getconnectAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		$Connect = new Admin_Model_Connect ();
		$data = $Connect->getConnectByID ( $id );
		$json = Zend_Json::encode ( $data );
		echo $json;
		unset ( $json );
		unset ( $data );
		unset ( $id );
	}
	public function addconnectAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"icon" => $data [0],
				"title" => $data [1],
				"link" => $data [2],
				"date" => $data [3],
				"order" => $data [4],
				"status" => $data [5] 
		);
		$Connect = new Admin_Model_Connect ();
		$Connect->insertConnect ( $arr );
	}
	public function updateconnectAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"id" => $data [0],
				"icon" => $data [1],
				"title" => $data [2],
				"link" => $data [3],
				"date" => $data [4],
				"order" => $data [5],
				"status" => $data [6] 
		);
		$Connect = new Admin_Model_Connect ();
		$Connect->updateConnect ( $arr );
	}
	public function deleteconnectAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		$Connect = new Admin_Model_Connect ();
		$Connect->deleteConnect ( $id );
	}
	public function userAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/plugins/datatables/jquery.dataTables.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.tables.js' );
		
		$User = new Admin_Model_User ();
		$this->view->data = $User->getAllUser ();
		$_SESSION ['menu'] ['level'] = "2";
	}
	public function adduserAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/fileupload/ajaxupload.3.5.js' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/js/fileupload/styles.css' );
	}
	public function saveuserAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"username" => $data [0],
				"password" => $data [1],
				"company" => $data [2],
				"logo" => $data [3],
				"address" => $data [4],
				"description" => $data [5],
				"email" => $data [6],
				"phone" => $data [7],
				"fax" => $data [8],
				"website" => $data [9],
				"date" => $data [10],
				"status" => $data [11] 
		);
		$User = new Admin_Model_User ();
		$User->insertUser ( $arr );
	}
	public function viewuserAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		
		$id = $this->getRequest ()->getParam ( 'id' );
		$User = new Admin_Model_User ();
		$this->view->data = $User->getUserByID ( $id );
	
	}
	public function edituserAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/fileupload/ajaxupload.3.5.js' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/js/fileupload/styles.css' );
		
		$id = $this->getRequest ()->getParam ( 'id' );
		$User = new Admin_Model_User ();
		$this->view->data = $User->getUserByID ( $id );
	}
	public function updateinfouserAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"id" => $data [0],
				"company" => $data [1],
				"logo" => $data [2],
				"address" => $data [3],
				"description" => $data [4],
				"email" => $data [5],
				"phone" => $data [6],
				"fax" => $data [7],
				"website" => $data [8],
				"status" => $data [9] 
		);
		$User = new Admin_Model_User ();
		$User->updateinfoUser ( $arr );
	}
	public function updatepassuserAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"id" => $data [0],
				"password" => $data [1] 
		);
		$User = new Admin_Model_User ();
		$User->updatepassUser ( $arr );
	}
	public function deleteuserAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "id" );
		$User = new Admin_Model_User ();
		$User->deleteUser ( $id );
	}
	public function checkpassuserAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "id" );
		$pass = $this->getRequest ()->getPost ( "pass" );
		$User = new Admin_Model_User ();
		$User->checkpass ( $id, $pass );
	}
	
	public function adminAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/plugins/datatables/jquery.dataTables.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.tables.js' );
		
		$Admin = new Admin_Model_Admin ();
		$this->view->data = $Admin->getAllAdmin ();
		$_SESSION ['menu'] ['level'] = "3";
	}
	public function addadminAction() {
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		
		$Admin = new Admin_Model_Admin ();
		$this->view->data = $Admin->getAllPermission ();
	}
	public function saveadminAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"username" => $data [0],
				"password" => $data [1],
				"fullname" => $data [2],
				"gender" => $data [3],
				"birthday" => $data [4],
				"address" => $data [5],
				"email" => $data [6],
				"phone" => $data [7],
				"perID" => $data [8],
				"date" => $data [9],
				"status" => $data [10] 
		);
		$Admin = new Admin_Model_Admin ();
		$Admin->insertAdmin ( $arr );
	}
	public function viewadminAction() {
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		
		$id = $this->getRequest ()->getParam ( 'id' );
		$Admin = new Admin_Model_Admin ();
		$this->view->data = $Admin->getAdminByID ( $id );
	}
	public function editadminAction() {
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		
		$id = $this->getRequest ()->getParam ( 'id' );
		$Admin = new Admin_Model_Admin ();
		$this->view->data = $Admin->getAdminByID ( $id );
		$this->view->permission = $Admin->getAllPermission ();
	}
	public function updateinfoadminAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"id" => $data [0],
				"fullname" => $data [1],
				"gender" => $data [2],
				"birthday" => $data [3],
				"address" => $data [4],
				"email" => $data [5],
				"phone" => $data [6],
				"perID" => $data [7],
				"status" => $data [8] 
		);
		$Admin = new Admin_Model_Admin ();
		$Admin->updateinfoAdmin ( $arr );
	}
	public function updatepassadminAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"id" => $data [0],
				"password" => $data [1] 
		);
		$Admin = new Admin_Model_Admin ();
		$Admin->updatepassAdmin ( $arr );
	}
	public function deleteadminAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "id" );
		$Admin = new Admin_Model_Admin ();
		$Admin->deleteAdmin ( $id );
	}
	public function checkpassAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "id" );
		$pass = $this->getRequest ()->getPost ( "pass" );
		$Admin = new Admin_Model_Admin ();
		$Admin->checkpass ( $id, $pass );
	}
	public function aboutAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/plugins/datatables/jquery.dataTables.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.tables.js' );
		
		$About = new Admin_Model_About ();
		$this->view->data = $About->getAllAbout ();
		$_SESSION ['menu'] ['level'] = "4";
	}
	public function addaboutAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/fileupload/ajaxupload.3.5.js' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/js/fileupload/styles.css' );
		
		$About = new Admin_Model_About ();
		$this->view->typeabout = $About->getAllActiveTypeAbout ();
	
	}
	public function saveaboutAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"name" => $data [0],
				"link" => $data [1],
				"image" => $data [2],
				"address" => $data [3],
				"email" => $data [4],
				"introductions" => $data [5],
				"content" => $data [6],
				"date" => $data [7],
				"typeid" => $data [8],
				"order" => $data [9],
				"status" => $data [10] 
		);
		$About = new Admin_Model_About ();
		$About->insertAbout ( $arr );
	}
	public function viewaboutAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		
		$id = $this->getRequest ()->getParam ( 'id' );
		$About = new Admin_Model_About ();
		// Get all type about
		$this->view->typeabout = $About->getAllActiveTypeAbout ();
		// Get data about
		$this->view->about = $About->getAboutByID ( $id );
	}
	public function editaboutAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/fileupload/ajaxupload.3.5.js' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/js/fileupload/styles.css' );
		
		$id = $this->getRequest ()->getParam ( 'id' );
		$About = new Admin_Model_About ();
		// Get all type about
		$this->view->typeabout = $About->getAllActiveTypeAbout ();
		// Get data about
		$this->view->about = $About->getAboutByID ( $id );
	}
	public function updateaboutAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"id" => $data [0],
				"name" => $data [1],
				"link" => $data [2],
				"image" => $data [3],
				"address" => $data [4],
				"email" => $data [5],
				"introductions" => $data [6],
				"content" => $data [7],
				"date" => $data [8],
				"typeid" => $data [9],
				"order" => $data [10],
				"status" => $data [11] 
		);
		$About = new Admin_Model_About ();
		$About->updateAbout ( $arr );
	}
	public function deleteaboutAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		$About = new Admin_Model_About ();
		$About->deleteAbout ( $id );
	}
	
	// Membership
	public function membershipAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/plugins/datatables/jquery.dataTables.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.tables.js' );
		
		$Membership = new Admin_Model_Membership ();
		$this->view->data = $Membership->getAllMembership ();
		$_SESSION ['menu'] ['level'] = "8";
	}
	public function addmembershipAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/fileupload/ajaxupload.3.5.js' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/js/fileupload/styles.css' );
		
		$Membership = new Admin_Model_Membership ();
		$this->view->typemembership = $Membership->getAllActiveTypeMembership ();
	
	}
	public function savemembershipAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"title" => $data [0],
				"content" => $data [1],
				"date" => $data [2],
				"typeid" => $data [3],
				"status" => $data [4] 
		);
		$Membership = new Admin_Model_Membership ();
		$Membership->insertMembership ( $arr );
	}
	public function viewmembershipAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		
		$id = $this->getRequest ()->getParam ( 'id' );
		$Membership = new Admin_Model_Membership ();
		// Get all type about
		$this->view->typemembership = $Membership->getAllActiveTypeMembership ();
		// Get data about
		$this->view->membership = $Membership->getMembershipByID ( $id );
	}
	public function editmembershipAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/fileupload/ajaxupload.3.5.js' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/js/fileupload/styles.css' );
		
		$id = $this->getRequest ()->getParam ( 'id' );
		$Membership = new Admin_Model_Membership ();
		// Get all type about
		$this->view->typemembership = $Membership->getAllActiveTypeMembership ();
		// Get data about
		$this->view->membership = $Membership->getMembershipByID ( $id );
	}
	public function updatemembershipAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"id" => $data [0],
				"title" => $data [1],
				"content" => $data [2],
				"typeid" => $data [3],
				"status" => $data [4] 
		);
		$Membership = new Admin_Model_Membership ();
		$Membership->updateMembership ( $arr );
	}
	public function deletemembershipAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		$Membership = new Admin_Model_Membership ();
		$Membership->deleteMembership ( $id );
	}
	
	// Conferences
	public function conferencesAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/plugins/datatables/jquery.dataTables.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.tables.js' );
		
		$Conferences = new Admin_Model_Conferences ();
		$this->view->data = $Conferences->getAllConferences ();
		$_SESSION ['menu'] ['level'] = "6";
	}
	public function addconferencesAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/fileupload/ajaxupload.3.5.js' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/js/fileupload/styles.css' );
	
	}
	public function saveconferencesAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"title" => $data [0],
				"image" => $data [1],
				"description" => $data [2],
				"content" => $data [3],
				"date" => $data [4],
				"start_date" => $data [5],
				"end_date" => $data [6],
				"location" => $data [7],
				"contact" => $data [8],
				"status" => $data [9] 
		);
		$Conferences = new Admin_Model_Conferences ();
		$Conferences->insertConferences ( $arr );
	}
	public function viewconferencesAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		
		$id = $this->getRequest ()->getParam ( 'id' );
		$Conferences = new Admin_Model_Conferences ();
		// Get data Conferences
		$this->view->conferences = $Conferences->getConferencesByID ( $id );
	}
	public function editconferencesAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/fileupload/ajaxupload.3.5.js' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/js/fileupload/styles.css' );
		
		$id = $this->getRequest ()->getParam ( 'id' );
		$Conferences = new Admin_Model_Conferences ();
		// Get data Conferences
		$this->view->conferences = $Conferences->getConferencesByID ( $id );
	}
	public function updateconferencesAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"id" => $data [0],
				"title" => $data [1],
				"image" => $data [2],
				"description" => $data [3],
				"content" => $data [4],
				"start_date" => $data [5],
				"end_date" => $data [6],
				"location" => $data [7],
				"contact" => $data [8],
				"status" => $data [9] 
		);
		$Conferences = new Admin_Model_Conferences ();
		$Conferences->updateConferences ( $arr );
	}
	public function deleteconferencesAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		$Conferences = new Admin_Model_Conferences ();
		$Conferences->deleteConferences ( $id );
	}
	
	// Publications
	public function publicationsAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/plugins/datatables/jquery.dataTables.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.tables.js' );
		
		$Publications = new Admin_Model_Publications ();
		$this->view->data = $Publications->getAllPublications ();
		$_SESSION ['menu'] ['level'] = "7";
	}
	public function addpublicationsAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/fileupload/ajaxupload.3.5.js' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/js/fileupload/styles.css' );
	
	}
	public function savepublicationsAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"title" => $data [0],
				"image" => $data [1],
				"description" => $data [2],
				"content" => $data [3],
				"date" => $data [4],
				"start_date" => $data [5],
				"end_date" => $data [6],
				"organisers" => $data [7],
				"location" => $data [8],
				"status" => $data [9] 
		);
		$Publications = new Admin_Model_Publications ();
		$Publications->insertPublications ( $arr );
	}
	public function viewpublicationsAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		
		$id = $this->getRequest ()->getParam ( 'id' );
		$Publications = new Admin_Model_Publications ();
		// Get data Conferences
		$this->view->publications = $Publications->getPublicationsByID ( $id );
	}
	public function editpublicationsAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/fileupload/ajaxupload.3.5.js' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/js/fileupload/styles.css' );
		
		$id = $this->getRequest ()->getParam ( 'id' );
		$Publications = new Admin_Model_Publications ();
		// Get data Conferences
		$this->view->publications = $Publications->getPublicationsByID ( $id );
	}
	public function updatepublicationsAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"id" => $data [0],
				"title" => $data [1],
				"image" => $data [2],
				"description" => $data [3],
				"content" => $data [4],
				"start_date" => $data [5],
				"end_date" => $data [6],
				"contact" => $data [7],
				"location" => $data [8],
				"status" => $data [9] 
		);
		$Publications = new Admin_Model_Publications ();
		$Publications->updatePublications ( $arr );
	}
	public function deletepublicationsAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		$Publications = new Admin_Model_Publications ();
		$Publications->deletePublications ( $id );
	}
	
	public function typeaboutAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/plugins/datatables/jquery.dataTables.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.tables.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.ui.js' );
		
		$id = $this->getRequest ()->getParam ( 'id' );
		$About = new Admin_Model_About ();
		// Get all type about
		$this->view->data = $About->getAllTypeAbout ();
		// Get data about
		$this->view->about = $About->getAboutByID ( $id );
		$_SESSION ['menu'] ['level'] = "4";
	}
	public function gettypeaboutAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		$About = new Admin_Model_About ();
		$data = $About->getTypeAboutByID ( $id );
		$json = Zend_Json::encode ( $data );
		echo $json;
		unset ( $json );
		unset ( $data );
		unset ( $id );
	}
	public function updatetypeaboutAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"id" => $data [0],
				"name" => $data [1],
				"seo" => $data [2],
				"order" => $data [3],
				"status" => $data [4] 
		);
		$About = new Admin_Model_About ();
		$data = $About->updateTypeAbout ( $arr );
	
	}
	public function deletetypeaboutAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		
		$About = new Admin_Model_About ();
		$About->deleteTypeAbout ( $id );
	
	}
	public function addtypeaboutAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"name" => $data [0],
				"seo" => $data [1],
				"order" => $data [2],
				"status" => $data [3] 
		);
		$About = new Admin_Model_About ();
		$About->insertTypeAbout ( $arr );
	}
	
	// Type Membership
	public function typemembershipAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/plugins/datatables/jquery.dataTables.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.tables.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.ui.js' );
		
		$id = $this->getRequest ()->getParam ( 'id' );
		$Membership = new Admin_Model_Membership ();
		// Get all type Membership
		$this->view->data = $Membership->getAllTypeMembership ();
		// Get data Membership
		// $this->view->membership=$Membership->getMembershipByID($id);
		$_SESSION ['menu'] ['level'] = "8";
	}
	public function gettypemembershipAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		$Membership = new Admin_Model_Membership ();
		$data = $Membership->getTypeMembershipByID ( $id );
		$json = Zend_Json::encode ( $data );
		echo $json;
		unset ( $json );
		unset ( $data );
		unset ( $id );
	}
	public function updatetypemembershipAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"id" => $data [0],
				"name" => $data [1],
				"seo" => $data [2],
				"order" => $data [3],
				"status" => $data [4] 
		);
		$Membership = new Admin_Model_Membership ();
		$data = $Membership->updateTypeMembership ( $arr );
	
	}
	public function deletetypemembershipAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		
		$Membership = new Admin_Model_Membership ();
		$Membership->deleteTypeMembership ( $id );
	
	}
	public function addtypemembershipAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"name" => $data [0],
				"seo" => $data [1],
				"order" => $data [2],
				"status" => $data [3] 
		);
		$Membership = new Admin_Model_Membership ();
		$Membership->insertTypeMembership ( $arr );
	}
	
	// Community
	public function communityAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/plugins/datatables/jquery.dataTables.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.tables.js' );
		
		$Community = new Admin_Model_Community ();
		$this->view->data = $Community->getAllCommunity ();
		$_SESSION ['menu'] ['level'] = "5";
	}
	public function addcommunityAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/fileupload/ajaxupload.3.5.js' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/js/fileupload/styles.css' );
		
		$Community = new Admin_Model_Community ();
		$this->view->typecommunity = $Community->getAllActiveTypeCommunity ();
	
	}
	public function savecommunityAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"title" => $data [0],
				"link" => $data [1],
				"description" => $data [2],
				"content" => $data [3],
				"date" => $data [4],
				"author" => $data [5],
				"typeid" => $data [6],
				"status" => $data [7] 
		);
		$Community = new Admin_Model_Community ();
		$Community->insertCommunity ( $arr );
	}
	public function viewcommunityAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		
		$id = $this->getRequest ()->getParam ( 'id' );
		$Community = new Admin_Model_Community ();
		// Get all type about
		$this->view->typecommunity = $Community->getAllActiveTypeCommunity ();
		// Get data about
		$this->view->community = $Community->getCommunityByID ( $id );
	}
	public function editcommunityAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/fileupload/ajaxupload.3.5.js' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/js/fileupload/styles.css' );
		
		$id = $this->getRequest ()->getParam ( 'id' );
		$Community = new Admin_Model_Community ();
		// Get all type about
		$this->view->typecommunity = $Community->getAllActiveTypeCommunity ();
		// Get data about
		$this->view->community = $Community->getCommunityByID ( $id );
	}
	public function updatecommunityAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"id" => $data [0],
				"title" => $data [1],
				"link" => $data [2],
				"description" => $data [3],
				"content" => $data [4],
				"date" => $data [5],
				"author" => $data [6],
				"typeid" => $data [7],
				"status" => $data [8] 
		);
		$Community = new Admin_Model_Community ();
		$Community->updateCommunity ( $arr );
	}
	public function deletecommunityAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		$Community = new Admin_Model_Community ();
		$Community->deleteCommunity ( $id );
	}
	
	// Type community
	public function typecommunityAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( 'admin/index/login' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/plugins/datatables/jquery.dataTables.min.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.tables.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/demo/demo.ui.js' );
		
		$id = $this->getRequest ()->getParam ( 'id' );
		$Community = new Admin_Model_Community ();
		// Get all type about
		$this->view->data = $Community->getAllTypeCommunity ();
		// Get data about
		$this->view->community = $Community->getCommunityByID ( $id );
		$_SESSION ['menu'] ['level'] = "5";
	}
	public function gettypecommunityAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		$Community = new Admin_Model_Community ();
		$data = $Community->getTypeCommunityByID ( $id );
		$json = Zend_Json::encode ( $data );
		echo $json;
		unset ( $json );
		unset ( $data );
		unset ( $id );
	}
	public function updatetypecommunityAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"id" => $data [0],
				"name" => $data [1],
				"seo" => $data [2],
				"order" => $data [3],
				"status" => $data [4] 
		);
		$Community = new Admin_Model_Community ();
		$data = $Community->updateTypeCommunity ( $arr );
	
	}
	public function deletetypecommunityAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "data" );
		
		$Community = new Admin_Model_Community ();
		$Community->deleteTypeCommunity ( $id );
	
	}
	public function addtypecommunityAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$data = $this->getRequest ()->getPost ( "data" );
		$arr = array (
				"name" => $data [0],
				"seo" => $data [1],
				"order" => $data [2],
				"status" => $data [3] 
		);
		$Community = new Admin_Model_Community ();
		$Community->insertTypeCommunity ( $arr );
	}
	
	public function uploadfileAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$uploaddir = ROOT_CONFIG . "/public/data/logo/";
		$file = $uploaddir . basename ( $_FILES ['uploadfile'] ['name'] );
		if (move_uploaded_file ( $_FILES ['uploadfile'] ['tmp_name'], $file )) {
			echo "success";
		} else {
			echo "error";
		}
	}
	public function uploadlogosponsorsAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$uploaddir = ROOT_CONFIG . "/public/data/sponsors/";
		$file = $uploaddir . basename ( $_FILES ['uploadfile'] ['name'] );
		if (move_uploaded_file ( $_FILES ['uploadfile'] ['tmp_name'], $file )) {
			echo "success";
		} else {
			echo "error";
		}
	}
	public function uploadimagesliderAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		// $uploaddir = ROOT_CONFIG."/public/data/slider/";
		
		$uploaddir = "/home/napthe360/domains/lamweb365.com/public_html/public/data/slider/";
		$file = $uploaddir . basename ( $_FILES ['uploadfile'] ['name'] );
		if (move_uploaded_file ( $_FILES ['uploadfile'] ['tmp_name'], $file )) {
			echo "success";
		} else {
			echo "error";
		}
	}
	public function uploadiconconnectAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$uploaddir = ROOT_CONFIG . "/public/data/connect/";
		$file = $uploaddir . basename ( $_FILES ['uploadfile'] ['name'] );
		if (move_uploaded_file ( $_FILES ['uploadfile'] ['tmp_name'], $file )) {
			echo "success";
		} else {
			echo "error";
		}
	}
	public function uploadimagenewsAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$uploaddir = ROOT_CONFIG . "/public/data/news/";
		$file = $uploaddir . basename ( $_FILES ['uploadfile'] ['name'] );
		if (move_uploaded_file ( $_FILES ['uploadfile'] ['tmp_name'], $file )) {
			echo "success";
		} else {
			echo "error";
		}
	}
	public function uploadimageuserAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$uploaddir = ROOT_CONFIG . "/public/data/user/";
		$file = $uploaddir . basename ( $_FILES ['uploadfile'] ['name'] );
		if (move_uploaded_file ( $_FILES ['uploadfile'] ['tmp_name'], $file )) {
			echo "success";
		} else {
			echo "error";
		}
	}
	public function deleteavatarAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$avatar = $this->getRequest ()->getPost ( "root_base" ) . $this->getRequest ()->getPost ( "avatar" );
		
		$tblUser = new Admin_Model_User ();
		$tblUser->deleteAvatar ( $avatar );
		echo $avatar;
	}
	public function updateavatarAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		
		$id = $this->getRequest ()->getPost ( "id" );
		$avatar = $this->getRequest ()->getPost ( "avatar" );
		$arr = array (
				'ID_user' => $id,
				'avatar' => $avatar 
		);
		$tblUser = new Admin_Model_User ();
		$tblUser->updateAvatar ( $arr );
	}
	public function deletefileAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		$file = $this->getRequest ()->getPost ( "data" );
		if (file_exists ( $file )) {
			unlink ( $file );
		}
	}

}

