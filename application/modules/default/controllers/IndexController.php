<?php
class IndexController extends Zendvn_Controller_Action {
	
	public function init() {
		parent::init ();
		$template_path = TEMPLATE_PATH . "/user/system";
		$this->loadTemplate ( $template_path, 'template.ini', 'default' );
		
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headMeta ()->setHttpEquiv ( 'Content-Type', 'text/html;charset=utf-8' );
		$view->headTitle ( 'Welcome to website of aati company' );
		$view->headMeta ()->setName ( 'keywords', 'Welcome to website of aati company, aati, aati company' );
		$view->headMeta ()->setName ( 'description', 'Welcome to website of aati company, aati, aati company' );
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
		
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/user/system/css/reset.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/user/system/css/style.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/user/system/css/default/default.css' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/user/system/css/nivo-slider.css' );
		
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/user/system/js/jquery.nivo.slider.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/user/system/js/scripts.js' );
		
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
		
		$Setting = new Default_Model_Setting ();
		$this->view->setting = $Setting->getSetting ();
		
		$Menu = new Default_Model_Menu ();
		$this->view->menu = $Menu->getAllMenu ();
		
		$Slider = new Default_Model_Slider ();
		$this->view->slider = $Slider->getAllSlider ();
		
		$Link = new Default_Model_Link ();
		$this->view->link = $Link->getAllLink ();
		
		$Connect = new Default_Model_Connect ();
		$this->view->connect = $Connect->getAllConnect ();
		
		$Sponsors = new Default_Model_Sponsors ();
		$this->view->sponsors = $Sponsors->getAllSponsors ();
		
		$auth = Zend_Auth::getInstance ();
		if ($auth->hasIdentity ()) {
			$infoUser = $auth->getIdentity ();
			$this->view->userinfo = $infoUser;
		}
	}
	
	
	public function preDispatch() {
	
	}
	
	public function indexAction() {
// 		$service = Zend_Gdata_Docs::AUTH_SERVICE_NAME;
// 		$client = Zend_Gdata_ClientLogin::getHttpClient('tdn1234cntt@gmail.com', '1111111*', $service);
		
// 		$docs = new Zend_Gdata_Docs($client);
// 		$docs->setMajorProtocolVersion(3);
// 		$contentLink = 'https://docs.google.com/document/d/1ej5FOBuaHO8CjIyxE3axzTuPCF3M79Yx5jco6HmOjms/edit';
// 		$data = $docs->get($contentLink)->getHeaders();
		
// 		//header("Location: $contentLink");
// 		print_r($data);die;
		
		
		
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		
		$News = new Default_Model_News ();
		// Select top 1 welcome
		$this->view->welcome = $News->getWelcomeNews ( 1 );
		// Select top 5 last event
		$this->view->lastevent = $News->getLastEventNews ( 5 );
		// Select top 4 news normal
		$this->view->news = $News->getNewsNormal ( 4 );
		
		//Zend_Loader::loadClass('Form_User', '/form/user.php');
		
		
	
	}
	public function eventnewsAction() {
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headMeta ()->setName ( 'keywords', 'Welcome to website of aati company, aati, aati company' );
		$view->headMeta ()->setName ( 'description', 'Event Welcome to website of aati company, aati, aati company' );
		
		$id = $this->getRequest ()->getParam ( 'id' );
		$News = new Default_Model_News ();
		$this->view->lasteventID = $News->getLastEventNewsByID ( $id );
		$this->view->oldNews = $News->getOldActiveNews ( $id );
		$view->headTitle ( " | " . $this->view->lasteventID [0] ['title'] );
		$view->headMeta ()->setName ( 'keywords', $this->view->lasteventID [0] ['title'] );
		$view->headMeta ()->setName ( 'description', $this->view->lasteventID [0] ['title'] );
	}
	public function normalnewsAction() {
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		
		$id = $this->getRequest ()->getParam ( 'id' );
		$News = new Default_Model_News ();
		$this->view->normalID = $News->getNormalNewsByID ( $id );
		$this->view->oldNews = $News->getOldActiveNews ( $id );
		
		$view->headTitle ( " | " . $this->view->normalID [0] ['title'] );
		$view->headMeta ()->setName ( 'keywords', $this->view->normalID [0] ['title'] );
		$view->headMeta ()->setName ( 'description', $this->view->normalID [0] ['title'] );
	}
	public function newsAction() {
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/user/system/js/jquery.pajinate.js' );
		$News = new Default_Model_News ();
		$this->view->newsAll = $News->getAllActiveNews ();
		$id = $this->view->newsAll [count ( $this->view->newsAll ) - 1] ['id'];
		$this->view->oldNews = $News->getOldActiveNews ( $id );
	}
	public function newsdetailAction() {
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headTitle ( "asdfasd" );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/user/system/js/jquery.pajinate.js' );
		$id = $this->getRequest ()->getParam ( 'id' );
		$News = new Default_Model_News ();
		$this->view->normalID = $News->getNormalNewsByID ( $id );
		if (count ( $this->view->normalID ) <= 0) {
			$this->_redirect ( '/admin/error/index/' );
		}
		$this->view->oldNews = $News->getOldActiveNews ( $id );
		
		$view->headTitle ( " | " . $this->view->normalID [0] ['title'] );
		$view->headMeta ()->setName ( 'keywords', $this->view->normalID [0] ['title'] );
		$view->headMeta ()->setName ( 'description', $this->view->normalID [0] ['title'] );
	
	}
	public function aboutAction() {
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		
		$About = new Default_Model_About ();
		$this->view->typeAbout = $About->getAllActiveTypeAbout ();
		$id = "";
		if ($this->getRequest ()->getParam ( 'id' )) {
			$id = $this->getRequest ()->getParam ( 'id' );
		} else {
			$data = $About->getAllActiveTypeAbout ();
			$id = $data [0] ['id'];
		}
		$this->view->data = $About->getAboutByTypeAbout ( $id );
		$this->view->typeAboutID = $About->getTypeAboutByID ( $id );
	
	}
	public function detailaboutAction() {
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		
		$About = new Default_Model_About ();
		$this->view->typeAbout = $About->getAllActiveTypeAbout ();
		$id = "";
		if ($this->getRequest ()->getParam ( 'id' )) {
			$id = $this->getRequest ()->getParam ( 'id' );
		}
		$this->view->data = $About->getAboutByID ( $id );
		
		$view->headTitle ( " | " . $this->view->data [0] ['name'] );
		$view->headMeta ()->setName ( 'keywords', $this->view->data [0] ['name'] );
		$view->headMeta ()->setName ( 'description', $this->view->data [0] ['name'] );
	}
	public function communityAction() {
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/user/system/js/jquery.pajinate.js' );
		
		$Community = new Default_Model_Community ();
		$this->view->typecommunity = $Community->getAllActiveTypeCommunity ();
		$gid = "";
		if ($this->getRequest ()->getParam ( 'gid' )) {
			$gid = $this->getRequest ()->getParam ( 'gid' );
		} else {
			$data = $Community->getAllActiveTypeCommunity ();
			$gid = $data [0] ['id'];
		}
		$this->view->data = $Community->getCommunityByTypeCommunity ( $gid );
		$this->view->typeCommunityID = $Community->getTypeCommunityByID ( $gid );
		
		// Lay thong tin theo author
		$author = "";
		if ($this->getRequest ()->getParam ( 'author' ) != "") {
			$author = $this->getRequest ()->getParam ( 'author' );
		}
		if ($author != "" && isset ( $author )) {
			$this->view->data = $Community->getCommunityByAuthor ( $author );
		}
		// Lay cac tin cu
		$number = 0;
		if (count ( $this->view->data ) == 5) {
			$number = count ( $this->view->data ) - 1;
		}
		$id = $this->view->data [$number] ['id'];
		$this->view->oldCommunity = $Community->getOldActiveCommunity ( $gid, $id );
	}
	public function communitydetailAction() {
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/user/system/js/jquery.pajinate.js' );
		$id = $this->getRequest ()->getParam ( 'id' );
		$gid = $this->getRequest ()->getParam ( 'gid' );
		$Community = new Default_Model_Community ();
		$this->view->community = $Community->getCommunityByID ( $id );
		if (count ( $this->view->community ) <= 0) {
			$this->_redirect ( '/admin/error/index/' );
		}
		$this->view->oldCommunity = $Community->getOldActiveCommunity ( $gid, $id );
		
		$view->headTitle ( " | " . $this->view->community [0] ['title'] );
		$view->headMeta ()->setName ( 'keywords', $this->view->community [0] ['title'] );
		$view->headMeta ()->setName ( 'description', $this->view->community [0] ['title'] );
	}
	public function logoutAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		$auth = Zend_Auth::getInstance ();
		if ($auth->hasIdentity ()) {
			$auth->clearIdentity ();
			$this->_redirect ( 'index/index' );
		}
	}
	
	public function loginAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		if ($this->_request->isPost ()) {
			
			// 1.Goi ket noi voi Zend Db
			$db = Zend_Registry::get ( 'connectDB' );
			// $db = Zend_Db::factory($dbOption['adapter'],$dbOption['params']);
			// 2. Khoi tao Zend Autho
			$auth = Zend_Auth::getInstance ();
			
			// 3. Khai bao bang va 2 cot se su dung so sanh trong qua tronh
			// login
			$authAdapter = new Zend_Auth_Adapter_DbTable ( $db );
			$authAdapter->setTableName ( 'user' )->setIdentityColumn ( 'username' )->setCredentialColumn ( 'password' );
			
			// 4. Lay gia tri duoc gui qua tu FORM
			$uname = $this->_request->getParam ( 'username' );
			$paswd = $this->_request->getParam ( 'password' );
			$remember = $this->_request->getParam ( 'remember' );
			
			// 5. Dua vao so sanh voi du lieu khai bao o muc 3
			$authAdapter->setIdentity ( $uname );
			$authAdapter->setCredential ( $paswd );
			
			// 6. Kiem tra trang thai cua user neu status = 1 moi duoc login
			$select = $authAdapter->getDbSelect ();
			$select->where ( 'status = 1' );
			
			// 7. Lay ket qua truy van
			$result = $auth->authenticate ( $authAdapter );
			$flag = false;
			if ($result->isValid ()) {
				// 8. Lay nhung du lieu can thiet trong bang users neu login
				// thanh cong
				$data = $authAdapter->getResultRowObject ( null, array (
						'password' 
				) );
				
				// 9. Luu nhung du lieu cua member vao session
				$auth->getStorage ()->write ( $data );
				$flag = true;
			}
			if ($flag == true) {
				echo "true";
			} else {
				echo "false";
			}
		}
		
		// $_SESSION['login']="Thanh cong";
		// $username=$this->getRequest()->getPost("username");
		// $password=$this->getRequest()->getPost("password");
		// $remember=$this->getRequest()->getPost("remember");
		// $currentUrl=$this->getRequest()->getPost("currentUrl");
		// $User = new Default_Model_User();
		
		// $data=$User->checklogin($username,$password);
		// if(count($data)>0){
		// $_SESSION['login']="Thanh cong";
		// echo $_SESSION['login'];
		// if($remember==1){
		// setcookie('login', 1, time()+24*7*3600);
		// }else{
		// setcookie('login', "", time()-24*7*3600);
		// }
		// echo "true";
		// }else{
		// echo "false";
		// }
	}
	public function forgotpassAction() {
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
	}
	public function forgotuserAction() {
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
	}
	public function registerAction() {
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/fileupload/ajaxupload.3.5.js' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/js/fileupload/styles.css' );
	}
	public function editaccountAction() {
		$auth = Zend_Auth::getInstance ();
		if (! $auth->hasIdentity ()) {
			$this->_redirect ( '/index/index' );
		}
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckeditor.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/ckeditor/ckfinder/ckfinder.js' );
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/admin/system/js/fileupload/ajaxupload.3.5.js' );
		$view->headLink ()->appendStylesheet ( $view->baseUrl () . '/templates/admin/system/js/fileupload/styles.css' );
		$User = new Default_Model_User ();
		$id = $this->getRequest ()->getParam ( 'id' );
		$this->view->user = $User->getUserByID ( $id );
	}
	public function updateaccountAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		$User = new Default_Model_User ();
		$data = $this->getRequest ()->getPost ( "data" );
		$infouser = array (
				"id" => $data [0],
				"password" => $data [1],
				"company" => $data [2],
				"logo" => $data [3],
				"address" => $data [4],
				"description" => $data [5],
				"email" => $data [6],
				"phone" => $data [7],
				"fax" => $data [8],
				"website" => $data [9],
				"status" => $data [10] 
		);
		$infopass = array (
				"id" => $data [0],
				"password" => $data [1] 
		);
		if ($User->updateInfoUser ( $infouser )) {
			if ($data [1] != "") {
				$User->updatePassUser ( $infopass );
			}
			echo "Update successfull";
		}
	
	}
	public function sendmailAction() {
		$this->_helper->layout ()->disableLayout ();
		$this->_helper->viewRenderer->setNoRender ( true );
		$User = new Default_Model_User ();
		$data = $this->getRequest ()->getPost ( "data" );
		$email = $data [0];
		$flag = $data [1];
		$message = "";
		if ($flag == 1) {
			$date = gettimeofday ();
			$newpass = $date ['sec'];
			$arr = array (
					"email" => $email,
					"password" => $newpass 
			);
			$update = $User->updatePassUserForgot ( $arr );
			if ($update) {
				$userinfo = $User->getUserByEmail ( $email );
				if (count ( $userinfo ) > 0) {
					$message = $this->sendpass ( $userinfo [0] ['username'], $newpass );
				}
			} else {
				return;
			}
		} else {
			$userinfo = $User->getUserByEmail ( $email );
			if (count ( $userinfo ) > 0) {
				$message = $this->sendaccount ( $userinfo [0] ['username'], $userinfo [0] ['password'] );
			} else {
				return;
			}
		}
		if ($message != "") {
			$settings = array (
					'ssl' => 'ssl',
					'port' => 465,
					'auth' => 'login',
					'username' => 'thangslco@gmail.com',
					'password' => 'thangepc' 
			);
			$transport = new Zend_Mail_Transport_Smtp ( 'smtp.gmail.com', $settings );
			$email_from = "thangslco@gmail.com";
			$name_from = "Nguyen Van Thang";
			$email_to = $email;
			$name_to = "Khach hang";
			
			$mail = new Zend_Mail ();
			$mail->setReplyTo ( $email_from, $name_from );
			$mail->setFrom ( $email_from, $name_from );
			$mail->addTo ( $email_to, $name_to );
			$mail->setSubject ( 'Testing email using google accounts and Zend_Mail' );
			$mail->setBodyHtml ( $message );
			$mail->send ( $transport );
			echo "Your request sent";
		}
	}
	public function sendpass($username, $password) {
		$message = "";
		$message .= "<p style=\"font-family: arial, sans-serif; font-size: 11px; \">";
		$message .= "<strong>Dear " . $username . ",&nbsp;</strong><br />";
		$message .= "<br />Password new of you is: " . $password;
		$message .= "</p>";
		return $message;
	}
	public function sendaccount($username, $password) {
		$message = "";
		$message .= "<p style=\"font-family: arial, sans-serif; font-size: 11px; \">";
		$message .= "<strong>Dear " . $username . ",&nbsp;</strong><br />";
		$message .= "<br />Username of you is: " . $username;
		$message .= "<br />Password of you is: " . $password;
		$message .= "</p>";
		return $message;
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
	public function conferencesAction() {
		$cache = Zend_Registry::get('cache');
		if($this->getRequest()->getParam('clear'))
			$cache->remove('confer');
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/user/system/js/jquery.pajinate.js' );
		if(!$data = $cache->load('confer')){
			$Conferences = new Default_Model_Conferences ();
			$data = $Conferences->getAllConferencesActive ();
			$data = json_encode($data);
			$cache->save($data, 'confer');
			
		}
		
	
		$data = $cache->load('confer');
		
		$this->view->data = json_decode($data, true);
		
	}
	public function detailconferencesAction() {
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		
		$id = "";
		if ($this->getRequest ()->getParam ( 'id' )) {
			$id = $this->getRequest ()->getParam ( 'id' );
		}
		$Conferences = new Default_Model_Conferences ();
		$this->view->data = $Conferences->getAllConferencesActiveByID ( $id );
		
		$view->headTitle ( " | " . $this->view->data [0] ['title'] );
		$view->headMeta ()->setName ( 'keywords', $this->view->data [0] ['title'] );
		$view->headMeta ()->setName ( 'description', $this->view->data [0] ['title'] );
	}
	public function publicationsAction() {
		
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		
		$Publications = new Default_Model_Publications ();
		$this->view->data = $Publications->getAllPublicationsActive ();
	}
	public function detailpublicationsAction() {
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		
		$id = "";
		if ($this->getRequest ()->getParam ( 'id' )) {
			$id = $this->getRequest ()->getParam ( 'id' );
		}
		$Publications = new Default_Model_Publications ();
		$this->view->data = $Publications->getAllPublicationsActiveByID ( $id );
		
		$view->headTitle ( " | " . $this->view->data [0] ['title'] );
		$view->headMeta ()->setName ( 'keywords', $this->view->data [0] ['title'] );
		$view->headMeta ()->setName ( 'description', $this->view->data [0] ['title'] );
	}
	public function membershipAction() {
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		
		$Membership = new Default_Model_Membership ();
		$this->view->typeMembership = $Membership->getAllActiveTypeMembership ();
		$id = "";
		if ($this->getRequest ()->getParam ( 'id' )) {
			$id = $this->getRequest ()->getParam ( 'id' );
		} else {
			$data = $Membership->getAllActiveTypeMembership ();
			$id = $data [0] ['id'];
		}
		$this->view->data = $Membership->getMembershipByTypeMembership ( $id );
		$this->view->typeMembershipID = $Membership->getTypeMembershipByID ( $id );
	}
	public function detailmembershipAction() {
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		
		$Membership = new Default_Model_Membership ();
		$this->view->typeMembership = $Membership->getAllActiveTypeMembership ();
		$id = "";
		if ($this->getRequest ()->getParam ( 'id' )) {
			$id = $this->getRequest ()->getParam ( 'id' );
		}
		$this->view->data = $Membership->getMembershipByID ( $id );
		
		$view->headTitle ( " | " . $this->view->data [0] ['title'] );
		$view->headMeta ()->setName ( 'keywords', $this->view->data [0] ['title'] );
		$view->headMeta ()->setName ( 'description', $this->view->data [0] ['title'] );
	}
	public function listmembershipAction() {
		$layout = Zend_Layout::getMvcInstance ();
		$view = $layout->getView ();
		$view->headScript ()->appendFile ( $view->baseUrl () . '/templates/user/system/js/jquery.pajinate.js' );
		
		$User = new Default_Model_User ();
		$this->view->data = $User->getAllActiveUser ();
		
		$Membership = new Default_Model_Membership ();
		$this->view->typeMembership = $Membership->getAllActiveTypeMembership ();
	}
	public function viewAction() {
	
	}

}