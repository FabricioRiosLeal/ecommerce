<?php

use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\category;
use \Hcode\Model\Product;

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

$app->get("/admin/categories/:idcategory/products", function($idcategory){

	User::verifyLogin();

	$category = new category();

	$category->get((int)$idcategory);

	$page = new pageAdmin();

	$page->setTpl("categories-products", [
		'category'=>$category->getValues(),
		'productsRelated'=>$category->getproducts(),
		'productsNotRelated'=>$category->getproducts(false)
]);
});

$app->get("/admin/categories/:idcategory/products/:idproduct/add", function($idcategory, $idproduct){

	User::verifyLogin();

	$category = new category();

	$category->get((int)$idcategory);

	$product = new Product();

	$product->get((int)$idproduct);

	$category->addproduct($product);

	header("Location: /admin/categories/".$idcategory."/products");
	exit;
	
});

$app->get("/admin/categories/:idcategory/products/:idproduct/remove", function($idcategory, $idproduct){

	User::verifyLogin();

	$category = new category();

	$category->get((int)$idcategory);

	$product = new Product();

	$product->get((int)$idproduct);

	$category->removeproduct($product);

	header("Location: /admin/categories/".$idcategory."/products");
	exit;
	
});

?>