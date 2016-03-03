<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\URL;
use Cart;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Cart as ModelCart;

class PaypalController extends Controller
{
    private $_api_context;
    public function __construct()
    {
        // gets the content of config/paypal.php file
        $paypal_conf = Config::get('paypal');

        // creates and sets a new ApiContext based on client_id and secret provided in config/paypal.php
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function postPaymentItem($id)
    {


        Session::put('product_id',$id);

        // gets the cart item that corresponds to the  product user wants to buy
        $rowId = Cart::search(array('id' => $id));
        $cartItem = Cart::get($rowId[0]);


        // creates a new PayPal Item based on the fields of the found cart item
        $item = new Item();
        $item->setName($cartItem->name) // item name
        ->setCurrency('USD') //currency
            ->setQuantity($cartItem->qty) // item quantity
            ->setPrice($cartItem->price); // unit price


        // creating item list and populating with corresponding content
        $item_list = new ItemList();

        $item_list->addItem($item);

        // creating new payer
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        //total amount
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal( $cartItem->price);


        // transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Buying Buying Buying!!!');



        // redirect url's
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payments.status')) // Specifies return URL, here we are redirected after the payment
        ->setCancelUrl(URL::route('payments.status'));


        // payment
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {

            die('Some error occur, sorry for inconvenience');

        }


        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        Session::put('paypal_payment_item', $payment->getId());

        if(isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }

    }


    public function getPaymentStatus()
    {

        // Get the payment ID before cleaning the session
        $payment_id = Session::get('paypal_payment_item');

        // retrieves the product id
        $product_id=  Session::get('product_id');

        // clear the session payment ID and product_id
        Session::forget('paypal_payment_item');
        Session::forget('product_id');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            $cart = Cart::content();
            return view('layouts\cart\cart',array('cart'=>$cart))-> with('error', 'Payment failed');

        }
        $payment = Payment::get($payment_id, $this->_api_context);

        // Payment execution object includes information necessary
        // to execute a PayPal account payment.
        // The payer_id is added to the request query parameters
        // when the user is redirected from paypal back to my cart page

        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        //Executes the payment

        $result = $payment->execute($execution, $this->_api_context);

        //echo '<pre>';print_r($result);echo '</pre>';exit; printed out to see the result of payment execution


        if ($result->getState() == 'approved') {
            // payment made

            // finds the user
            $user_id=Auth::user()->id;

            // finds the corresponding product id
            $product=Product::
            where('product_name', '=',$product_id)
                ->get()[0];

            $product_name=$product_id;
            $product_id=$product->id;


            // inserts a new record to cart table
            $values = array('user_id' => $user_id,'product_id' => $product_id);

            // inserts a new row in carts table into the database
            ModelCart::create($values);

            // finds the count of corresponding product
            $product_count=Product::
            where('id', '=',$product_id)
                ->get()[0]->count;

            // updates the quantity of corresponding items (decreases it by one)
            Product::where('id', '=',$product_id)->update(array('count' => $product_count-1));

            // modifies the corresponding content of a Cart
            $rowId = Cart::search(array('id' => $product_name));
            $item = Cart::get($rowId[0]);
            Cart::update($rowId[0], $item->qty - 1);
            $cart = Cart::content();

            return view('layouts\cart\cart', array('cart' => $cart))->with('success','Payment Successful');

        }else {
            $cart = Cart::content();
            return view('layouts\cart\cart',array('cart'=>$cart))-> with('error', 'Error Occurred');
        }

    }


}