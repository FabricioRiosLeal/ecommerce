<?php 

require_once("vendor/autoload.php");
//require_once './vendor/sistur/config.php';

use \Hcode\DB\Sql;

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {
    
	$sql = new Hcode\DB\sql();

	$result = $sql->select('SELECT * FROM tb_ordersstatus');

	echo json_encode($result);

});

$app->run();

 ?>