<?php
//@session_start();
//$_SESSION['ssv_usr_tipo'] = 1;
//$_SESSION['ssv_usr_id'] = 1;

define('URL','http://localhost/');
define('DIR', __DIR__."\..\\");

/* conexao */
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DB_NAME', 'emailmkt');

/* PASTAS  */
define('JS', 'js/');
define('CSS', 'CSS/');
define('IMG', 'img/');
define('INCLUDES', 'includes/');
define('MODULES', 'modulos/');
define('CLASSES','classes/');
define('TEMPLATES','templates/');
define('FUNCTIONS', 'function/');

$conn = new mysqli(HOST,USER,PASS,DB_NAME);

//echo  $conn ? 'Conexão foi um sucesso' : 'Erro na conexão';

?>