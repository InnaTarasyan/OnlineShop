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
use App\Models\Transaction as ModelTransaction;

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


    public function buyMultiple(Request $request)
    {
        $array=json_decode($request->all()["data"]);

        $item_list = new ItemList();

        $total=0;

        // creating item list
        for($i=0;$i<count($array);$i++) {
            $rowId = Cart::search(array('name' => $array[$i]));
            $cartItem = Cart::get($rowId[0]);


            $item=new Item();
            $item->setName($cartItem->name);
            $item->setCurrency('USD');
            $item->setPrice($cartItem->price);
            $item->setQuantity($cartItem->qty);
            $item_list->addItem($item);
            $total+=$item->getQuantity()*$item->getPrice();

        }

        // creating new payer
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        //total amount
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($total);


        // transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Buying Buying Buying!!!');


        // redirect url's
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payments.statusMultiple')) // Specifies return URL, here we are redirected after the payment
        ->setCancelUrl(URL::route('payments.statusMultiple'));


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
        catch(\Exception $ex)
        {
            echo $ex->getMessage();
        }


        foreach($payment->getLinks() as $link) {
            if($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

        Session::put('paypal_payment_id', $payment->getId());

        if(isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }


    }




    public function getPaymentStatusMultiple()
    {

        // Get the payment ID before cleaning the session
        $payment_id = Session::get('paypal_payment_id');


        // clear the session payment ID and product_id
        Session::forget('paypal_payment_id');


        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            $cart = Cart::content();
            return view('layouts\cart\cart1',array('cart'=>$cart))-> with('error', 'Payment failed');

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

        if ($result->getState() == 'approved') {

            $user_id=Auth::user()->id;
            $products=$result->transactions[0]->item_list;

            foreach($products->getItems() as $item)
            {
                $productName= $item->name;
                $productQuantity=$item->quantity;


                // finds the corresponding product id
                $product_id=Product::
                where('product_name', '=',$productName)
                    ->get()[0]->id;


                // inserts a new record to cart table
                $values = array('user_id' => $user_id,'product_id' => $product_id,'date'=>Date('y-m-d'),'quantity'=>$productQuantity);

                // inserts a new row in carts table into the database
                ModelTransaction::create($values);


                // finds the count of corresponding product
                $product_count=Product::
                where('id', '=',$product_id)
                    ->get()[0]->count;

                // updates the quantity of corresponding items (decreases it by one)
                Product::where('id', '=',$product_id)->update(array('count' => $product_count-$productQuantity));

                // modifies the corresponding content of a Cart
                $rowId = Cart::search(array('id' => $productName));
                $item = Cart::get($rowId[0]);
                Cart::update($rowId[0], $item->qty - $productQuantity);


            }
            $cart = Cart::content();
            return view('layouts\cart\cart1', array('cart' => $cart))->with('success','Payment Successful');


            //echo '<pre>';print_r($result->transactions[0]->item_list->items[0]->name);echo '</pre>';

        }else {
            $cart = Cart::content();
            return view('layouts\cart\cart1',array('cart'=>$cart))-> with('error', 'Error Occurred');
        }

    }


}