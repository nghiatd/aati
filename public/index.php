<?php


// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH',
              realpath(dirname(dirname(__FILE__)) . '/application'));


define('ROOT_URL', '');
define('PUBLIC_URL', ROOT_URL . '/aati/public');
define('TEMPLATE_URL', PUBLIC_URL . '/templates');
define('ROOT_CONFIG',$_SERVER['DOCUMENT_ROOT'].ROOT_URL);
define('URL_CONFIG',$_SERVER['SERVER_NAME'].'/aati/'.ROOT_URL);

define('TEMPLATE_PATH', dirname(__FILE__) . '/templates');


// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV',
              (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV')
                                         : 'production'));

// Typically, you will also want to add your library/ directory
// to the include_path, particularly if it contains your ZF installed
set_include_path(implode(PATH_SEPARATOR, array(
    dirname(dirname(__FILE__)) . '/library',
    get_include_path(),
)));
/** Zend_Application */
require_once 'Zend/Application.php';

//$autoloader->setFallbackAutoloader('true');
$environment = APPLICATION_ENV;
$options = APPLICATION_PATH . '/configs/application.ini';
$application = new Zend_Application($environment, $options);

$application->bootstrap()->run();




