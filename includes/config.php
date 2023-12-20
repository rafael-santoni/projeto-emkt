<?php
//@session_start();
//$_SESSION['ssv_usr_tipo'] = 1;
//$_SESSION['ssv_usr_id'] = 1;

//define('URL', 'http://localhost/php/www/test/ssv/');
define('URL','https://rafasantoni.heliohost.us/EMkt/');
define('DIR', '/home/rafasantoni.heliohost.us/httpdocs/EMkt/');

//echo DIR;
//echo '<a href="">'.DIR.'</a>';

/* conexao */
define('HOST', 'localhost:3306');
define('USER', 'conn');
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

$conn = new mySQLi(HOST,USER,PASS,DB_NAME);

//$conn = mysql_connect(HOST, USER, PASS);
//mysql_select_db(DB_NAME);



//echo  $conn ? 'Conex?o foi um sucesso' : 'Erro na conex?o';

?>
