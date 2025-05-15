<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\PaginateTrait;
use App\Models\Market;
use App\Models\ServiceProvider;
use App\Models\Transaction;
use App\Models\User;
use DateTime;
use App\Models\WalletOperation;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    use PaginateTrait;

    public function payment($total,$type){
        $data['total'] = $total;
        $data['user_id'] = userApi()->id;
        $data['type'] = $type;
        return view('payment',compact('data'));
    }

    public function paymentServices($total,$type){
        $data['total'] = $total;
        $data['user_id'] = service_provider_api()->id;
        $data['type'] = $type;
        return view('payment',compact('data'));
    }

    public function handleCallback($total,$userId,$type)
    {

    
        $id = request()->input('id');
        $data = $this->getPayment($id);
        if($data=='error'){
            return $this->apiResponse('error','success','simple',422);
        }
        $user_id =  $userId;
        $paymentStatus = $data['status'];
        $check = Transaction::where('transaction_id',$id)->first();
        if(!$check){
            if($type=='verification_market'){
                $market = Market::find($user_id);
                $market->paid = 1;  
                $market->save();
                return redirect('https://market.amaraapp.com.sa?status=paid');
            }else{
                Transaction::create([
                    'transaction_id' => $id,
                    'user_id' => $user_id,
                    'total' => $total,
                    "status" => $paymentStatus
                ]);
                if ($paymentStatus === 'paid') {
                    if($type=='wallet'){
                        $user = User::find($user_id);
                        $user->wallet = $user->wallet+$total;
                        $user->save();
                    }else if($type=='wallet_ser'){
                        $user = ServiceProvider::find($user_id);
                        $user->wallet = $user->wallet+$total;
                        $user->save();
                    }
                }
                return $this->apiResponse('success','success','simple');
            }

        }else{
            if($type=='verification_market'){
                return redirect('https://market.amaraapp.com.sa?status=failed');
            }
            return $this->apiResponse('error','success','simple',422);
        }

    }

    public function getPayment($id)
    {
        $apiKey = config('services.moyasar.secret_key'); // Replace with your actual API key

        $response = Http::withBasicAuth($apiKey, '')
            ->get("https://api.moyasar.com/v1/payments/{$id}");

        if ($response->successful()) {
            // Handle the successful response
            return $response->json();
        } else {
            // Handle the error response
            return 'error';
        }
    }
}
