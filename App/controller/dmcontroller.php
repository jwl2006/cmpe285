<?php
require_once(__DIR__ . '/../../bootstrap.php');
require_once(__DIR__ . '/../rb.php');
require_once(__DIR__ . '/loginControl.php');

// header('Access-Control-Allow-Origin: *');


$app = new \Slim\Slim();

$corsOptions = array(
    "origin" => "*",
    "exposeHeaders" => array("Content-Type", "X-Requested-With", "X-authentication", "X-client"),
    "allowMethods" => array('GET', 'POST', 'PUT', 'DELETE', 'OPTIONS')
);
$cors = new \CorsSlim\CorsSlim($corsOptions);

$app->add($cors);

$app->view = new \Slim\Views\Twig();
$app->view->setTemplatesDirectory("Views");

$view = $app->view();
$view->parserOptions = array('debug' => true);
$view->parserExtensions = array(new \Slim\Views\TwigExtension());

class ResourceNotFoundException extends Exception {}

function Login() {
	session_start();
	
	$app = \Slim\Slim::getInstance();
	$login = new loginControl();

	if (isset($_POST['user']) && isset($_POST['password'])) {
		$user =$_POST['user'];
    	$pwd = $_POST['password'];
    	
   		$returnInfo = $login->validate($user,$pwd);

   		//$app->render('account.twig', array('msg'=> $returnInfo)); 

   		if($login->isLoggedin()) {
   		

            $_SESSION['user'] = $user; 

            $identity = findUserIdentity($user);

        
           
            if($identity == 'buyer') {

            	$url = "/diamondslim/app/buyerhomepage?user=" . $user;
            	$login->redirectTo($url, "0");
            	
            	
            	
            } else if($identity == 'seller') {

            	$url = "/diamondslim/app/sellerhomepage?user=" . $user;
            	
            	$login->redirectTo($url, "0");
            	
            }
            } else {
            	$login->logout();
            	$app->render('account.twig', array('msg'=> "Identity not defined."));    
            }
   	}
}

function Logout() {
	$login = new loginControl();
	$login->logout();
	$login->redirectTo('/diamondslim/app/account', "0");
}

function getBuyerHP() {
	session_start();
	$user = $_GET['user'];

	$app = \Slim\Slim::getInstance();
	$purchased  =  R::find('transaction', ' buyer=?', array($user)); 
	$profile = R::find('buyer', ' email=?', array($user));

	$app->render('buyerHP.twig', array('orders'=> $purchased,
										'profiles' => $profile)); 
}

function getSellerHP() {
	session_start();
	$user = $_GET['user'];

	$app = \Slim\Slim::getInstance();
	$products =  R::find('product', ' seller=?', array($user)); 
	         	
    $app->render('sellerHP.twig', array('products'=> $products)); 
} 

function findUserIdentity($user) {
	$app = \Slim\Slim::getInstance();
	
	$userFound = R::getAll( 'SELECT * FROM buyer WHERE email = :username',
                    array(':username'=>$user)); 
	
	if($userFound){
		foreach($userFound as $ret) {
			return  $ret['identity'];
		}
	} 
	return NULL;
}







function UserRegister() {
		session_start();
		$app = \Slim\Slim::getInstance();
	
		$login = new loginControl();
    	$email = $_POST['user'];
    	$firstname = $_POST['firstname'];
    	$lastname = $_POST['lastname'];
    	$address = $_POST['address'];
    	$home_phone = $_POST['homephone'];
    	$cell_phone = $_POST['cellphone'];
    	$password = $_POST['password'];
    	$password_again = $_POST['confirmpasswd'];
    	$identity = $_POST['identity'];

    	$returnInfo = $login->signUpValidate($email, $password, $password_again, 
                            $firstname, $lastname, $address, 
                            $home_phone, $cell_phone, $identity);

    	$app->render('signup.twig', array('msg'=> $returnInfo)); 

    	if ($login->isSignedUp()) {
    		  $login->redirectTo("/diamondslim/app/account", "3");
    		  unset($_SESSION['user']);
    	} 
}



function addProduct(){
		session_start();
		$app = \Slim\Slim::getInstance();
	
		$login = new loginControl();
    	$name = $_POST['productname'];
    	$price = $_POST['price'];
    	$imagelink = $_POST['imagelink'];
    	$company = $_POST['company'];
    	$seller = $_POST['seller'];
    	$introduction = $_POST['introduction'];

    	$product = R::dispense('product');
    	$product->name = $name;
    	$product->price = $price;
    	$product->image_link = $imagelink;
    	$product->company = $company;
    	$product->seller = $seller;
    	$product->introduction = $introduction;

    	$id = R::store($product);
    	if ($id) {
    		$url = "/diamondslim/app/sellerhomepage?user=" . $seller;
    		$login->redirectTo($url, "0");
    	}
    	
}


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

		
	} catch(Exception $e) {
		$app->response()->status(400);
		$app->response()->header('X-Status-Reason', $e->getMessage());
	}

}

function addProductJSON(){
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
	$app->render('product.twig', array('products'=> $products)); 
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