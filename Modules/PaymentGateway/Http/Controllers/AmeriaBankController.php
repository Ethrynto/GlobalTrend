<?php

namespace Modules\PaymentGateway\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Repositories\OrderRepository;
use Modules\Wallet\Repositories\WalletRepository;
use Brian2694\Toastr\Facades\Toastr;
use Modules\Account\Repositories\TransactionRepository;
use Modules\Account\Entities\Transaction;
use Modules\FrontendCMS\Entities\SubsciptionPaymentInfo;
use App\Traits\Accounts;
use Carbon\Carbon;
use Modules\UserActivityLog\Traits\LogActivity;

class AmeriaBankController extends Controller
{
    use Accounts;

    public function __construct()
    {
        $this->middleware('maintenance_mode');
    } 

    public function payment($data)
    {
        $credential = $this->getCredential();
        
        $MERCHANT_ID = @$credential->perameter_1; // add your id
        $username = @$credential->perameter_2; // add your id
        $password = @$credential->perameter_3; // add your id

        $url = 'https://services.ameriabank.am/VPOS/api/VPOS/InitPayment';
        
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($url, [
            "ClientID" => $MERCHANT_ID,
            "Amount" => $data['amount'],
            "Description" => $data['description'],
            "Username" => $username,
            "Password" => $password,
            "OrderID" => $data['OrderID'],
            "BackURL" => route('frontend.order.summary_after_payment'),
        ]);
        if($response->successful()){
            $response = $response->json();
            $orderPaymentService = new OrderRepository;
            LogActivity::successLog(json_encode($response));
            $order_payment = $orderPaymentService->orderPaymentDone($data['amount'], $credential->method->id, $response['PaymentID'], (auth()->check())?auth()->user():null, $data['OrderID']);
            if($order_payment == 'failed'){
                Toastr::error('Invalid Payment');
                LogActivity::errorLog('Invalid Payment');
                return $order_payment;
            }
            //return response()->json($order_payment);
            // Toastr::info(json_encode($order_payment));
            $payment_id = $order_payment->id;
            LogActivity::successLog('Order payment successful.');
            Toastr::success('Order payment successful.');
            return $payment_id;
        }else{
            Toastr::error('Something went wrong');
            return redirect()->back();
        }
        
    }
    // public function cancelOrRefundOrder($payment_id, $amount, $date){
    //     $credential = $this->getCredential();
    //     // $MERCHANT_ID = @$credential->perameter_1; // add your id
    //     $username = @$credential->perameter_2; // add your id
    //     $password = @$credential->perameter_3; // add your id
    //     $url = "";
    //     $posted = [];
    //     if(strtotime($date. ' + 3 days') >= strtotime(Carbon::now())){
    //         $url = 'https://servicestest.ameriabank.am/VPOS/api/VPOS/CancelPayment';
    //         $posted = [
    //             "Username" => $username,
    //             "Password" => $password,
    //             "PaymentID" => $payment_id,
    //         ];
    //     }else{
    //         $url = 'https://servicestest.ameriabank.am/VPOS/api/VPOS/RefundPayment';
    //         $posted = [
    //             "Amount" => $amount,
    //             "Username" => $username,
    //             "Password" => $password,
    //             "PaymentID" => $payment_id,
    //         ];
    //     }
        
    //     $response = Http::withHeaders([
    //         'Content-Type' => 'application/json',
    //         'Accept' => 'application/json',
    //     ])->post($url, $posted);
    //     if($response->successful()){
    //         return $response->json();
    //     }else{
    //         Toastr::error('Something went wrong');
    //         return redirect()->back();
    //     }
    // }
    public function refund($payment_id, $amount){
        $credential = $this->getCredential();
        $username = @$credential->perameter_2; // add your id
        $password = @$credential->perameter_3; // add your id
        $url = 'https://services.ameriabank.am/VPOS/api/VPOS/RefundPayment';
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($url, [
            "Amount" => $amount,
            "Username" => $username,
            "Password" => $password,
            "PaymentID" => $payment_id,
        ]);
        if($response->successful()){
            // Toastr::success('Refund successful');
            // return redirect()->back();
            $data = $response->json();
            if($data['ResponseCode'] == "00"){
                Toastr::success($data["ResponseMessage"]);
                return redirect()->back();
            }else{
                Toastr::error($data["ResponseMessage"]);
                return redirect()->back();
            }
        }else{
            Toastr::error('Something went wrong');
            return redirect()->back();
        }
    }

    public function cancel($payment_id){
        $credential = $this->getCredential();
        $username = @$credential->perameter_2; // add your id
        $password = @$credential->perameter_3; // add your id
        $url = 'https://services.ameriabank.am/VPOS/api/VPOS/CancelPayment';
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ])->post($url, [
            "Username" => $username,
            "Password" => $password,
            "PaymentID" => $payment_id,
        ]);
        if($response->successful()){
            // Toastr::success('Cancel successful');
            // return redirect()->back();
            $data = $response->json();
            if($data['ResponseCode'] == "00"){
                Toastr::success($data["ResponseMessage"]);
                return redirect()->back();
            }else{
                Toastr::error($data["ResponseMessage"]);
                return redirect()->back();
            }
        }else{
            Toastr::error('Something went wrong');
            return redirect()->back();
        }
    }

    public function getCredential(){
        $url = explode('?',url()->previous());
        if(isset($url[0]) && $url[0] == url('/checkout')){
            $is_checkout = true;
        }else{
            $is_checkout = false;
        }
        if(session()->has('order_payment') && app('general_setting')->seller_wise_payment && session()->has('seller_for_checkout') && $is_checkout){
            $credential = getPaymentInfoViaSellerId(session()->get('seller_for_checkout'), 'ameriabank');
        }else{
            $credential = getPaymentInfoViaSellerId(1, 'ameriabank');
        }
        return $credential;
    }
}
