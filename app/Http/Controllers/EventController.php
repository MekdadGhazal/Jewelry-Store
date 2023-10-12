<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    use ResponseTrait;

    public function getData(){
        try {
            return $this->successResponse(Event::get());
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }
}
