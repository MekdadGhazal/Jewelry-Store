<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ResponseTrait;

    public function index() {
        return $this->successResponse(Category::get());
    }
}
