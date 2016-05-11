<?php
require_once(__DIR__ . '/../bootstrap.php');
require_once(__DIR__ . '/rb.php');
require_once(__DIR__ . '/controller/dmcontroller.php');


R::setup('mysql:host=localhost;dbname=diamonddb','root','');
R::freeze(true);


$app->get('/getproducts', 'getAllProducts');
$app->get('/getproductbyid/:id', 'getProductById');
$app->post('/addproduct',  'addProduct');
$app->get('/showproducts', 'showProducts');

$app->get('/gettransactions', 'getAllTransactions');
$app->post('/addtransaction',  'addTransaction');


$app->get('/', function () use($app){
	 $page = 'test';
     $app->render('product.twig', array('page'=> $page)); 
});


$app->get('/change', function () {

    echo "Welcome to the programster's default template.";
});


$app->run();





