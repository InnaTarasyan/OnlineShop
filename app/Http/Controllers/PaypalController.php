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

class PaypalController extends Controller
{
    private $_api_context;
    public function __construct()
    {

        $paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }


    public function postPayment()
    {
        // creating new payer
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        // retrieving cart content
        $cartContent = Cart::content();


        // creating item list and populating with corresponding content
        $item_list = new ItemList();

        foreach($cartContent as $cart)
        {
            $item = new Item();

            $item->setName($cart->name) // item name
            ->setCurrency('USD')
                ->setQuantity($cart->qty) // item quantity
                ->setPrice($cart->price); // unit price

            $item_list->addItem($item);
        }


        //total amount
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal(Cart::total());


        // transaction
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Buying Buying Buying!!!');


        // redirect url's
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('payment.status')) // Specify return URL
        ->setCancelUrl(URL::route('payment.status'));


        // payment
        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (\Config::get('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                exit;
            } else{
                    die('Some error occur, sorry for inconvenient');
                }
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



    public function getPaymentStatus()
    {

        $payment_id = Session::get('paypal_payment_id');


        // clear the session payment ID
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            return Redirect::route('cart')
                ->with('error', 'Payment failed');
        }

        $payment = Payment::get($payment_id, $this->_api_context);

        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));


        // execute the payment

        $result = $payment->execute($execution, $this->_api_context);

        echo
        '<pre>';
        print_r($result);
        echo '</pre>';
        exit;


        /*
        if ($result->getState() == 'approved') {

            return Redirect::route('cart')->with('success', 'Payment success');
        };

        return Redirect::route('cart')
            ->with('error', 'Payment failed');
        */
    }

}