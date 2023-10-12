<?php

namespace App\Http\Controllers;

use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    use ResponseTrait;

    public function register(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|between:2,100',
                'email' => 'required|string|email|max:100|unique:users',
                'password' => 'required|string|min:6',
                'phone' => 'required|string|between:2,15',
                'card' => 'required|string|between:10,100',
                'country' => 'required|exists:countries,id',
                'city' => 'required|string|between:2,50',
                'street' => 'required|string|between:2,50',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
            $user = User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
            ]);
            $customer = Customer::create([
                'user_id' => $user->id,
                'phone' => $request->input('phone'),
                'card' => $request->input('card'),
                'country' => $request->input('country'),
                'city' => $request->input('city'),
                'street' => $request->input('street'),
            ]);

            $data = [
                'user' => $user ,
                'info' => $customer
            ];

            return $this->successResponse(new CustomerResource($data),'User successfully registered');
        } catch (\Exception $exception){
            return  $exception->getMessage();
        }
    }
}
