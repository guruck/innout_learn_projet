<?php

//definicoes de local tempo idioma
date_default_timezone_set('America/Sao_Paulo');
setlocale(LC_ALL,array('pt_BR','pt_BR.utf-8','portuguese'));

//definir nivel de error reporting
error_reporting(E_ERROR | E_PARSE);

//constantes gerais
define('DAILY_TIME', 60 * 60 * 8);

//Diretorios
define('MODEL_PATH', realpath(dirname(__FILE__) . '/../models'));
define('VIEW_PATH', realpath(dirname(__FILE__) . '/../views'));
define('CONTROLLER_PATH', realpath(dirname(__FILE__) . '/../controllers'));
define('EXCEPTION_PATH', realpath(dirname(__FILE__) . '/../exceptions'));
define('TEMPLATE_PATH', realpath(dirname(__FILE__) . '/../views/template'));

//Arquivos
require_once(dirname(__FILE__) . '/database.php');
require_once(dirname(__FILE__) . '/loader.php');
require_once(dirname(__FILE__) . '/session.php');
require_once(dirname(__FILE__) . '/date_utils.php');
require_once(dirname(__FILE__) . '/utils.php');
require_once(EXCEPTION_PATH . '/AppException.php');
require_once(EXCEPTION_PATH . '/ValidationException.php');
loadModel('Model');
loadModel('User');
loadModel('WorkingHours');

//SESSÃO
// session_start();