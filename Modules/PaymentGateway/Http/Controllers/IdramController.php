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

class IdramController extends Controller
{
    use Accounts;

    public function __construct()
    {
        $this->middleware('maintenance_mode');
    } 

    public function payment($data)
    {
        $orderPaymentService = new OrderRepository;
        $order_payment = $orderPaymentService->orderPaymentDone($data['amount'], 6, 'none', (auth()->check())?auth()->user():null);
        if($order_payment == 'failed'){
            Toastr::error('Invalid Payment');
            LogActivity::errorLog('Invalid Payment');
            return $order_payment;
        }
        return $order_payment->id;
    }
}
