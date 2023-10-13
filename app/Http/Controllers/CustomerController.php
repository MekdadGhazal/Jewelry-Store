<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Mail\PurchaseMail;
use App\Models\Customer;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    use ResponseTrait;

    public function sendPurchaseMail()
    {
        Mail::to('wessam.1066@gmail.com')->send(new PurchaseMail());
        return 'Email sent successfully';
    }


    public function register(Request $request) {
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
                return response()->json($validator->errors(), 400);
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

            return $this->successResponse(new CustomerResource($customer),'User successfully registered');
        } catch (\Exception $exception){
            return  $exception->getMessage();
        }
    }

    public function prushes(Request $request){
        Event::create([
            'user_id' => 1,
            'order_number' => 3,
            'card' => 2,
            'status' => 1
        ]);
    }
}
