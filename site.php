<?php

use \Hcode\Page;
use \Hcode\Model\product;
use \Hcode\Model\Category;

$app->get('/', function() {
    
	$products = product::listAll();

	$page = new Page();

	$page->setTpl("index", [
		'products'=>product::checklist($products)
	]);

});

$app->get("/categories/:idcategory", function($idcategory){

	$category = new category();

	$category->get((int)$idcategory);

	$page = new page();

	$page->setTpl("category", [
		'category'=>$category->getValues(),
		'products'=>Product::checklist($category->getproducts())
]);
	
});


?>