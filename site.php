<?php

use \Hcode\Page;
use \Hcode\Model\product;
use \Hcode\Model\Category;
use \Hcode\Model\Cart;

$app->get('/', function() {
    
	$products = product::listAll();

	$page = new Page();

	$page->setTpl("index", [
		'products'=>product::checklist($products)
	]);

});

$app->get("/categories/:idcategory", function($idcategory){

	$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;

	$category = new category();

	$category->get((int)$idcategory);

	$pagination = $category->getProductsPage($page);

	$pages = [];

	for ($i=1; $i <= $pagination['pages']; $i++) {
		array_push($pages, [
			'link'=>'/categories/'.$category->getidcategory().'?page='.$i,
			'page'=>$i
		]);
	}

	$page = new page();

	$page->setTpl("category", [
		'category'=>$category->getValues(),
		'products'=>$pagination["data"],
		'pages'=>$pages
]);
	
});

$app->get("/products/:desurl", function($desurl){
	
	$product = new Product();
	
	$product->getFromURL($desurl);
	
	$page = new Page();
	
	$page->setTpl("product-detail", [
		'product'=>$product->getValues(),
		'categories'=>$product->getCategories()
	]);
	
});

$app->get("/cart", function(){

	$cart = Cart::getFromSession();

	$page = new page();

	$page->setTpl("cart");

});

?>