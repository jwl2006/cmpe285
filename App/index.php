<?php
require_once(__DIR__ . '/../bootstrap.php');
require_once(__DIR__ . '/rb.php');
require_once(__DIR__ . '/controller/dmcontroller.php');


// header('Access-Control-Allow-Origin: *');



R::setup('mysql:host=localhost;dbname=diamonddb','root','');
R::freeze(true);


$app->post('/userregister', 'UserRegister');
$app->post('/login', 'Login');
$app->get('/logout', 'Logout');

$app->get('/getproducts', 'getAllProducts');
$app->get('/getproductbyid/:id', 'getProductById');
$app->post('/addproductjson',  'addProductJSON');
$app->get('/showproducts', 'showProducts');


$app->post('/addproduct',  'addProduct');


$app->get('/gettransactions', 'getAllTransactions');
$app->post('/addtransaction',  'addTransaction');

$app->get('/sellerhomepage',  'getSellerHP');
$app->get('/buyerhomepage',  'getBuyerHP');

$app->get('/signup', function () use($app){
     $app->render('signup.twig'); 
});


$app->get('/', function () use($app){
     $app->render('index.twig'); 
});

$app->get('/news', function () use($app){
     $app->render('news.twig'); 
});

$app->get('/account', function () use($app){
     $app->render('account.twig'); 
});

$app->get('/postproduct', function () use($app){
     $app->render('postproduct.twig'); 
});


$app->post('/cart', function () use($app) {
	 $app->render('cart.twig'); 
});

$app->get('/displaycart', function () use($app) {
	 $app->render('cart.twig'); 
});

$app->get('/checkout', function() use($app) {
	 $app->render('checkout.twig'); 
});



$app->get('/change', function () {

    echo "Welcome to the programster's default template.";
});


$app->run();





