<?php

session_start();

// header functions
// header("Cache-control: private"); 
header("Cache-Control: no-cache, must-revalidate");
// header("Pragma: no-cache");
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

error_reporting(0);

// Public HTTP Constants
define ('HTTP_ROOT', "http://www.peachy.ws/");
define ('HTTPS_ROOT', "http://www.peachy.ws/");
define ('PAGES_PATH', HTTP_ROOT . "page/");
define ('IMAGE_PATH', HTTP_ROOT . "images/");
define ('JS_PATH', HTTP_ROOT . "js/");
define ('RPC_PATH', HTTP_ROOT . "rpc/");
define ('SECURE_PATH', HTTPS_ROOT . "");
define ('STYLE_PATH', HTTP_ROOT . "stylesheet/");

// Peachy libraries
define ('LIBRARIES', "/home/webwax/peachy/_libs/");
include (LIBRARIES . "libs.inc.php");

// Application Files
define ('FILEPATH_ROOT', "/home/webwax/peachy/peachy.ws/");
define ('CONFIG_PATH', FILEPATH_ROOT . "config/");
define ('APP_COMPONENTS', FILEPATH_ROOT . "app/components/");
define ('APP_CONTENT', FILEPATH_ROOT . "app/content/");
define ('APP_CONTROLLERS', FILEPATH_ROOT . "app/controllers/");
define ('APP_LAYOUT', FILEPATH_ROOT . "app/layout/");
define ('APP_MODELS', FILEPATH_ROOT . "app/models/");
define ('APP_VIEWS', FILEPATH_ROOT . "app/views/");

// Other config files
include("db_config.inc.php");

// Layout constants
define("CONTENT_INCLUDE_FILE", APP_LAYOUT . "layout.inc.php");
define("HOME_CONTENT", APP_LAYOUT . "home_layout.inc.php");
define("XML_CONTENT_INCLUDE_FILE", LIB_XML . "xml_content.inc.php");
// Maintenance content
// define("CONTENT_INCLUDE_FILE", APP_LAYOUT . "maint_content.inc.php");

// Application Constants
define("SIGNOUT_LANDING_PAGE", "/index");
define("BUSINESS_NAME", "PEACHY.WS (pre-alpha), The Community Web Command Server");
define("EMAIL_ROOT", "peachy.ws");
define('IMAGE_ARROW', "&nbsp;&nbsp;&nbsp;<img src=\"" . IMAGE_PATH . "img_arrow.gif\" border=\"0\">&nbsp;");
define('MESSAGE_UNREAD', 0);
define('MESSAGE_READ', 1);
define('RESULT_PER_PAGE', 10);
define("UNIVERSAL_ENCRYPTION_KEY", "4bfd0f9a0b280eade57bb911b55f10b7eeee3b50");

// Libraries to include on every function
include(LIB_URI . "uriFunctions.inc.php");
include(LIB_HTML . "drawingFunctions.inc.php");
include(LIB_SOCIAL . "memberFunctions.inc.php");
include(LIB_SECURITY . "peachyws_login_functions.inc.php");
include(APP_MODELS . "classes.inc.php");
include(APP_MODELS . "dataAccess.inc.php");
include(APP_VIEWS . "commandFunctions.inc.php");

?>