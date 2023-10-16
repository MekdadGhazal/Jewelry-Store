<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Mail\PurchaseMail;
use App\Models\Customer;
use App\Models\Event;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    use ResponseTrait;

    public function sendPurchaseMail($user, $list, $id)
    {
        Mail::to($user->email)->send(new PurchaseMail($user, $list, $id));
        return 'Email sent successfully';
    }


    public function purchaseProcess(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email|max:100|unique:users',
                'phone' => 'required|string|between:2,15',
                'card' => 'required|string|between:10,100',
                'country' => 'required|exists:countries,id',
                'city' => 'required|string|between:2,50',
                'street' => 'required|string|between:2,50',
            ]);

            if ($validator->fails()) {
                return $this->invalidResponse($validator->errors());
            }

            $list = [];
            $missedProducts = [];
            foreach ($request->products as $product) {
                $productDB = Product::find($product['id']);
                if ($productDB->count >= $product['count']) {
                    $productDB->update([
                        'count' => $productDB->count - $product['count'],
                    ]);
                    $list[] = [
                        'id' => $product['id'],
                        'price' => $productDB->price,
                        'count' => $product['count']
                    ];
                } else {
                    $missedProducts[] = $productDB;
                }
            }
            $customer = Customer::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'card' => $request->input('card'),
                'country' => $request->input('country'),
                'city' => $request->input('city'),
                'street' => $request->input('street'),
            ]);

            $process = $this->purchase($request, $customer->id);
            $this->sendPurchaseMail($customer, $list , $process->order_number);

            $data = [
                'customer' => new CustomerResource($customer),
                'missedProducts' => $missedProducts
            ];
            return $this->successResponse($data,'The purchase process successfully Done.');

        } catch (\Exception $exception){
            return  $exception->getMessage();
        }
    }

    public function purchase(Request $request, $id)
    {
        $event = Event::create([
            'user_id' => $id,
            'card' => $request->card,
            'status' => 0,
        ]);
        return $event;
    }
}
