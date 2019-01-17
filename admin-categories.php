<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\category;

$app->get("/admin/categories", function(){

	User::verifyLogin();

	$categories = category::listAll();

	$page = new pageAdmin();

	$page->setTpl("categories", [
		'categories'=>$categories
	]);

});

$app->get("/admin/categories/create", function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("categories-create");

});

$app->post("/admin/categories/create", function(){

	User::verifyLogin();

	$category = new category();

	$category->setData($_POST);

	$category->save();

	header('Location: /admin/categories');
	exit;

});

$app->get("/admin/categories/:idcategory/delete", function($idcategory){

User::verifyLogin();

$category = new category();

$category->get((int)$idcategory);

$category->delete();

header('Location: /admin/categories');
	exit;

});

$app->get("/admin/categories/:idcategory", function($idcategory){

	User::verifyLogin();

	$category = new category();

	$category->get((int)$idcategory);

	$page = new PageAdmin();

	$page->setTpl("categories-update", [
		'category'=>$category->getValues()
	]);

});

$app->post("/admin/categories/:idcategory", function($idcategory){

	User::verifyLogin();

	$category = new category();

	$category->get((int)$idcategory);

	$category->setData($_POST);

	$category->save();

	header('Location: /admin/categories');
	exit;
	
});

$app->get("/categories/:idcategory", function($idcategory){

	$category = new category();

	$category->get((int)$idcategory);

	$page = new page();

	$page->setTpl("category", [
		'category'=>$category->getValues(),
		'products'=>[]
]);
});


?>