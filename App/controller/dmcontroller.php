<?php
require_once(__DIR__ . '/../../bootstrap.php');
require_once(__DIR__ . '/../rb.php');



$app = new \Slim\Slim();

$app->view = new \Slim\Views\Twig();
$app->view->setTemplatesDirectory("Views");

$view = $app->view();
$view->parserOptions = array('debug' => true);
$view->parserExtensions = array(new \Slim\Views\TwigExtension());

class ResourceNotFoundException extends Exception {}




function getAllTransactions(){
	$app = \Slim\Slim::getInstance();
	$transactions = R::find('transaction');

    $app->response->header('Content-Type', 'application/json');
    echo json_encode(R::exportAll($transactions));
}
  

function addTransaction(){
	$app = \Slim\Slim::getInstance();
	try{
		$data= $app->request()->getBody();
		
    	$input = json_decode($data); 

		$order = R::dispense('transaction');
		
		$order->productid = (string)$input->productid;
		$order->quantity = (string)$input->quantity;
		$order->time = (string)$input->time;
		$order->buyer = (string)$input->buyer;
		$order->seller = (string)$input->seller;
		$order->vendor = (string)$input->vendor;
		

		$id = R::store($order);

		$app->response()->header('Content-Type', 'application/json');
		echo json_encode(R::exportAll($order));
	} catch(Exception $e) {
		$app->response()->status(400);
		$app->response()->header('X-Status-Reason', $e->getMessage());
	}

}

function addProduct(){
	$app = \Slim\Slim::getInstance();
	try{
		$data= $app->request()->getBody();
		
    	$input = json_decode($data); 

		$product = R::dispense('product');
		
		$product->name = (string)$input->name;
		$product->price = (string)$input->price;
		$product->image_link = (string)$input->image_link;
		$product->company = (string)$input->company;
		$product->seller = (string)$input->seller;
		$product->introduction = (string)$input->introduction;

		$id = R::store($product);

		$app->response()->header('Content-Type', 'application/json');
		echo json_encode(R::exportAll($product));
	} catch(Exception $e) {
		$app->response()->status(400);
		$app->response()->header('X-Status-Reason', $e->getMessage());
	}
}


function getAllProducts(){
	$app = \Slim\Slim::getInstance();
	$products = R::find('product');

    $app->response->header('Content-Type', 'application/json');
    echo json_encode(R::exportAll($products));
}


function showProducts() {
	$app = \Slim\Slim::getInstance();
	$products = R::find('product');
	$test = 'test111';
	$app->render('product.twig', array('products'=> $products,
										'test' => $test
														)); 
}

function getProductById($id) {
	$app = \Slim\Slim::getInstance();
	try {
		$product = R::findOne('product', 'id=?', array($id));
		if($product){
		
			 $app->response->header('Content-Type', 'application/json');
			 echo json_encode(R::exportAll($product));
		} else {

			throw new ResourceNotFoundException();
		}
	} catch (ResourceNotFoundException $e) {
		echo "in catch";
		$app->response()->status(404);
	} catch (Exception $e) {
		$app->response()->status(400);
    	$app->response()->header('X-Status-Reason', $e->getMessage());
	} 
}